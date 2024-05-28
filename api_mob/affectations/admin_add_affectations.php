<?php
require("../db_connect.php");
error_reporting(E_ALL);
date_default_timezone_set('Africa/Algiers');

$response = array();

if(isset($_GET["id_vehicule"]) && isset($_GET["id_user"])){
   
    $id_user = $_GET["id_user"];
    $id_vehicule = $_GET["id_vehicule"];
    $mode = $_GET["mode"];
    $observation = $_GET["observation"];
    $date_debut = $_GET["date_debut"];
    $date_fin = $_GET["date_fin"];
    $km = $_GET["km"];
    
    $curdate = date('y-m-d h:i:s');
    $date_test = strtotime($date_fin);
    
    $curent= "en cours";
    $dif = "Definitif";
    $temp = "Temporaire";
    $pause = "Pause";
    
    $chek_car_exsit = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_vehicule='$id_vehicule' ");
    $cce = mysqli_fetch_assoc($chek_car_exsit);
    
    $search_car = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_vehicule='$id_vehicule' and mode='$dif' ");
    $res = mysqli_fetch_assoc($search_car);
    
    $search_car_dif_enc = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_vehicule='$id_vehicule' and mode='$dif' and etat='$curent'");
    $resv = mysqli_fetch_assoc($search_car_dif_enc);
    
    $search_car_temporaire_encours = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_vehicule='$id_vehicule' and mode='$temp' and etat='$curent'");
    $scte = mysqli_fetch_assoc($search_car_temporaire_encours);
    
    $search_user_temporaire = mysqli_query($cnx,"SELECT * FROM suivie_affectation WHERE id_user='$id_user' and etat='$curent' and mode='$temp' ");
    $sut = mysqli_fetch_assoc($search_user_temporaire);
    
    $search_user_difinitif = mysqli_query($cnx,"SELECT * FROM suivie_affectation WHERE id_user='$id_user' and etat='$curent' and mode='$dif' ");
    $sud=mysqli_fetch_assoc($search_user_difinitif);
    $dn = $sud["id_user"];
    
    $j = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_vehicule='$id_vehicule' and etat='$curent' and mode='$dif' ");
    $hf = mysqli_fetch_assoc($j);
    $gg = $hf["id_vehicule"];
    $gt = $hf["id_user"];
    $po = $hf["mode"];
    
    if(mysqli_num_rows($j) > 0 and mysqli_num_rows($search_user_difinitif) > 0){
        
        if(($gg == $id_vehicule and $dn == $id_user) and $mode == $dif){
            
            $response["success"]=0;
            $response["message"]= "Le véhicule ne peux pas étre affecter plus d'une fois à la même personne. 00";
            echo json_encode($response);
            
        }else{
            
            $jhu = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$pause' WHERE id_user='$dn' and etat='$curent' and mode='$dif' ");
            $jhv = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$pause' WHERE id_vehicule='$gg' and etat='$curent' and mode='$dif' ");
            
            
            $notif100 = mysqli_query($cnx,"INSERT INTO notifications (id_user, contenu, created_at) VALUES ('$dn','Utilisation de votre véhicule en pause','$curdate')");
            $notif101 = mysqli_query($cnx,"INSERT INTO notifications (id_user, contenu, created_at) VALUES ('$gt','Utilisation de votre véhicule en pause','$curdate')");
    
            
            $g = mysqli_query($cnx,"INSERT INTO suivie_affectation (id_user, id_vehicule, date_debut, date_fin, mode, observation, etat, created_at) 
                                VALUES ('$id_user', '$id_vehicule','$date_debut','$date_fin','Temporaire', '$observation','$curent','$curdate')");
                                
            $notif102 = mysqli_query($cnx,"INSERT INTO notifications (id_user, contenu, created_at) VALUES ('$id_user','Utilisation de votre véhicule en pause','$curdate')");
                   
                    
            if($g){
                
                $response["success"]=1;
                $response["message"]= "Le vehicule à été affecter temporairement 1004";
                echo json_encode($response);
                
            }else{
                $response["success"]=0;
                $response["message"]= "Erreur lors du traitement de votre requête. 1";
                echo json_encode($response);
            }
        }
        
        
    }else{
        
         if((mysqli_num_rows($search_car) > 0  and $res["id_vehicule"] == $id_vehicule) or (mysqli_num_rows($search_car_temporaire_encours) > 0)) {
            
            if($res["id_user"] == $id_user and $res["etat"] == "en cours" ){
            
                $response["success"]=0;
                $response["message"]="L'utilisateur dispose déja d'une affectation pour le même véhicule.";
                echo json_encode($response);
                
            }else{
                
                 if(mysqli_num_rows($search_user_temporaire)){
                     
                      $response["success"]=0;
                        $response["message"]="L'utilisateur dispose déja d'une affectation temporaire.";
                        echo json_encode($response);
                             
                     
                 }else{
                     
                 if($res["etat"] == "en cours" and mysqli_num_rows($search_user_temporaire)) {
                         
                        $e = mysqli_query($cnx,"INSERT INTO suivie_affectation (id_user, id_vehicule, date_debut, date_fin, mode, observation, etat, created_at) 
                                    VALUES ('$id_user', '$id_vehicule','$date_debut','$date_fin','Temporaire', '$observation','$curent','$curdate')");
                        
                         $notif103 = mysqli_query($cnx,"INSERT INTO notifications (id_user, contenu, created_at) VALUES ('$id_user','Votre emprunt temporaire à commencer.','$curdate')");
                                    
                         //update de l'etat du véhicule de celui qui detient le véhicule vers pause
                        $up = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$pause', date_fin='$date_debut', updated_at='$curdate' WHERE id_user='$id_user' and mode='$dif' ");
                        
                        $notif104 = mysqli_query($cnx,"INSERT INTO notifications (id_user, contenu, created_at) VALUES ('$dn','Utilisation de votre véhicule usuelle en pause','$curdate')");
                    
                        if($e and $up ){
                            
                            $response["success"]=1;
                            $response["message"]= "Le vehicule à été affecter temporairement 1.";
                            echo json_encode($response);
                            
                        }else{
                            
                            $response["success"]=0;
                            $response["message"]= "Erreur lors du traitement de votre requête 2";
                            echo json_encode($response);
                        }
                    
                   
                    
                        
                 }else{
                    
                    //rechercher si le véhicule est affecter temporairement vers quelqu'un
                    
                    if(mysqli_num_rows($search_car_temporaire_encours) > 0){
                        
                        $response["success"]=0;
                        $response["message"]="Le véhicule est déja affecter temporairement à une personne";
                        echo json_encode($response);
                        
                    }else{
                        
                        if($mode == $dif and $po == $dif){
                            
                            if($mode = $temp and $id_user != $gt ){
                                
                                //créer l'affectation
                        
                                $e = mysqli_query($cnx,"INSERT INTO suivie_affectation (id_user, id_vehicule, date_debut, date_fin, km, mode, observation, etat, created_at) 
                                        VALUES ('$id_user', '$id_vehicule','$date_debut','$date_fin','$km','Temporaire', '$observation','$curent','$curdate')");
                                
                                $fdf = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$pause' WHERE id_user='$gt' and etat='$curent' and mode='$dif' ");
                                if($e){
                                    
                                    $response["success"]=1;
                                    $response["message"]= "Le vehicule à été affecter temporairement à '$id_user' 1";
                                    echo json_encode($response);
                                    
                                }else{
                                    
                                    $response["success"]=0;
                                    $response["message"]= "Erreur lors du traitement de votre requête";
                                    echo json_encode($response);
                                }
                                
                            }else{
                                
                                $response["success"]=0;
                                $response["message"]="Le véhicule est déja affecté diffinitivement à un utilisateur.100";
                                echo json_encode($response);
                                
                            }
                            
                        }else{
                            
                            //créer l'affectation
                        
                            $e = mysqli_query($cnx,"INSERT INTO suivie_affectation (id_user, id_vehicule, date_debut, date_fin, mode,km ,observation, etat, created_at) 
                                    VALUES ('$id_user', '$id_vehicule','$date_debut','$date_fin','$mode', '$km','$observation','$curent','$curdate')");
                                    
                            $notif = mysqli_query($cnx,"INSERT INTO notifications (id_user,text, created_at) VALUES('$id_user', 'Votre emprunt viens de débuter.' ,'$curdate')");
                            
                            if(mysqli_num_rows($search_car_dif_enc) > 0){
                                 $fdf = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$pause' WHERE id_vehicule='$id_vehicule' and etat='$curent' and mode='$dif' ");
                            }
                            
                            if($mode == $dif){
                                
                                $tst = mysqli_query($cnx, "SELECT * FROM vidanges WHERE id_vehicule='$id_vehicule' and etat=1");
                                
                                if(mysqli_num_rows($tst)>0){
                                    
                                }else{
                                    
                                    $futur_km = intval($km) + 10000;  
                                
                                    $ki = mysqli_query($cnx,"INSERT INTO vidanges(id_vehicule, id_user, created_at, km, etat, futur_km) 
                                                        VALUES ($id_vehicule','0', '$curdate', '$km', '1', '$futur_km')" );
                                }
                               
                            }
                        
                            if($e){
                                
                                $response["success"]=1;
                                $response["message"]= "Le vehicule à été affecter temporairement à '$id_user' 2294";
                                echo json_encode($response);
                                
                            }else{
                                
                                $response["success"]=0;
                                $response["message"]= "Erreur lors du traitement de votre requête";
                                echo json_encode($response);
                            }
                        }
                        
                        
                    }
                    
                }
                 }
                
            }
            
        }else{
            
            //si l'utilisateru dispose d'une affectation temporaire en cours
            
            if(mysqli_num_rows($search_car_temporaire_encours) > 0 and $mode == $temp){
                
                $response["success"]=0;
                $response["message"]="L'utilisateur dispose déja d'une affectation temporaire 2";
                echo json_encode($response);
                
            }else{
                
                //si l'utilisateur dispose d'une affectation définitif en cours
                
                if(mysqli_num_rows($search_user_difinitif) > 0 and $mode == $dif ){
                    
                    $response["success"]=0;
                    $response["message"]="L'utilisateur dispose déja d'une affectation définitif.";
                    echo json_encode($response);
                    
                } else{
                    
                    if(mysqli_num_rows($search_user_difinitif) > 0 and $mode == $temp ){
                        
                        $lp = mysqli_query($cnx,"INSERT INTO suivie_affectation (id_user, id_vehicule, date_debut, date_fin, mode, observation, etat, created_at) 
                                VALUES ('$id_user', '$id_vehicule','$date_debut','$date_fin','$temp','$observation','$curent','$curdate')");
                                
                         //update de l'etat du véhicule de celui qui detient le véhicule vers pause
                        $up = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$pause', date_fin='$date_debut', updated_at='$curdate' WHERE id_user='$id_user' and mode='$dif' ");
                        
                        if($lp and $up){
                            
                            $response["success"]=1;
                            $response["message"]= "Le vehicule à été affecter temporairement. 6";
                            echo json_encode($response);
                            
                        }else{
                            
                            $response["success"]=0;
                            $response["message"]= "Erreur lors du traitement de votre requête 8";
                            echo json_encode($response);
                        }
                        
                    } else{
                        
                            if(mysqli_num_rows($search_user_temporaire) > 0 or mysqli_num_rows($chek_car_exsit) > 0){
                                
                                if(mysqli_num_rows($search_user_temporaire) > 0 and ($mode == "Definitif" or $mode=="Temporaire") ){
                                    
                                    $response["success"]=0;
                                    $response["message"]= "L'utilisateur dispose d'une affectation en cours 89";
                                    echo json_encode($response); 
                                    
                                }else{
                                    
                                    $lo = mysqli_query($cnx,"INSERT INTO suivie_affectation (id_user, id_vehicule, date_debut, date_fin, mode, observation, etat, created_at) 
                                        VALUES ('$id_user', '$id_vehicule','$date_debut','$date_fin','$temp','$observation','$curent','$curdate')");
                                    
                                    if($lo){
                                        
                                        $response["success"]=1;
                                        $response["message"]= "Affectation temporaire effectué avec succès 100";
                                        echo json_encode($response); 
                                        
                                    }else{
                                        
                                        $response["success"]=0;
                                        $response["message"]= "L'utilisateur ne peux pas avoir deux affectations temporaires 1003";
                                        echo json_encode($response); 
                                    }
                                 
                                    
                                    
                                }
                              
                    
                            }else{
                                
                                $lo = mysqli_query($cnx,"INSERT INTO suivie_affectation (id_user, id_vehicule, date_debut, date_fin, mode, km,observation, etat, created_at) 
                                    VALUES ('$id_user', '$id_vehicule','$date_debut','$date_fin','$mode','$km','$observation','$curent','$curdate')");
                                    
                                
                                if($mode == $dif){
                                    
                                    $tst = mysqli_query($cnx, "SELECT * FROM vidanges WHERE id_vehicule='$id_vehicule' and etat='1'");
                                    
                                    if(mysqli_num_rows($tst)> 0){
                                        
                                    }else{
                                        
                                        $futur_km = intval($km) + 10000;    
                                    
                                        $ki = mysqli_query($cnx,"INSERT INTO vidanges(id_vehicule, id_user, created_at, km, etat, futur_km) 
                                                                    VALUES ('$id_vehicule','0', '$curdate', '$km', '1', '$futur_km')" );
                                    }
                                    
                                }    
                                    
                               
                                    
                                if($lo){
                                    
                                    $response["success"]=1;
                                    $response["message"]= "Le vehicule à été affecter. 145 ";
                                    echo json_encode($response);
                                    
                                }else{
                                    
                                    $response["success"]=0;
                                    $response["message"]= "Erreur lors du traitement de votre requête";
                                    echo json_encode($response);
                                }
                                
                            }
                        
                    }
                    
                }
                
            }
            
        }
        
        
    }
    
       
    
    
    
}else{
    
    $response["success"]=0;
    $response["message"]="required filed is missing";
    echo json_encode($response);
}

?>