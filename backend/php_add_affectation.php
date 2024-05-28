<?php
session_start();
require("getter/connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');

if(isset($_POST['creer']) and isset($_POST["vehicule"]) and isset($_POST["conducteur"]) and isset($_POST["mode_affectation"])){
    
    $date_debut = $_POST["date_debut"];
    $date_fin = $_POST["date_fin"];
    $mode = $_POST["mode_affectation"];
    $id_vehicule = $_POST["vehicule"];
    $id_user = $_POST["conducteur"];
    $last_kilometrage = $_POST["kilometrage"];
    $new_kilometrage  = $_POST['affected_kilometrage'];
    $observation = $_POST["observation"];
    $h_debut = $_POST["h_debut"];
    $h_fin = $_POST["h_fin"];
    
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
    if(mysqli_num_rows($j) > 0){
        $hf = mysqli_fetch_assoc($j);
        
        $gg = $hf["id_vehicule"];
        $gt = $hf["id_user"];
        $po = $hf["mode"];
    }
    
    
    //Kilometrage du véhicule
    if($last_kilometrage == "Aucun enregistrement."){
        
        $km = $_POST["affected_kilometrage"];
        
    }else{
        
        if($last_kilometrage < $new_kilometrage){
            
            $km = $_POST["affected_kilometrage"];
        } 
        
    }
    
    
    
    if($date_debut > $date_fin and $mode_affectation == "Temporaire"){
        
        $_SESSION["status"] = "La date de debut ne peut pas être supérieur a celle de la date de fin.";
        $_SESSION["success"] = 0;
          
        header("Location:ajouter_affectation.php");
        
    }else{
        
        if(mysqli_num_rows($j) > 0 and mysqli_num_rows($search_user_difinitif) > 0){
        
        if(($gg == $id_vehicule and $dn == $id_user) and $mode == $dif){
            
            $_SESSION["success"]=0;
            $_SESSION["status"]= "Le véhicule ne peux pas étre affecter plus d'une fois à la même personne.";
            
            header("Location:list_affectations.php");
            
        }else{
            
            $jhu = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$pause' WHERE id_user='$dn' and etat='$curent' and mode='$dif' ");
            $jhv = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$pause' WHERE id_vehicule='$gg' and etat='$curent' and mode='$dif' ");
            
            
            $notif100 = mysqli_query($cnx,"INSERT INTO notifications (id_user, contenu,etat, created_at) VALUES ('$dn','Utilisation de votre véhicule en pause','unread','$curdate')");
            $notif101 = mysqli_query($cnx,"INSERT INTO notifications (id_user, contenu,etat, created_at) VALUES ('$gt','Utilisation de votre véhicule en pause','unread','$curdate')");
    
            
            $g = mysqli_query($cnx,"INSERT INTO suivie_affectation (h_debut, h_fin, id_user, id_vehicule, date_debut, date_fin, mode, observation, etat, created_at) 
                                VALUES ('$h_debut','$h_fin','$id_user', '$id_vehicule','$date_debut','$date_fin','Temporaire', '$observation','$curent','$curdate')");
                                
            $notif102 = mysqli_query($cnx,"INSERT INTO notifications (id_user, contenu, etat ,created_at) VALUES ('$id_user','Utilisation de votre véhicule en pause','unread' , '$curdate')");
                   
                    
            if($g){
                
                $_SESSION["success"]=1;
                $_SESSION["status"]= "Le vehicule à été affecter temporairement. 1";
                
                header("Location:list_affectations.php");
                
            }else{
                $_SESSION["success"]=0;
                $_SESSION["status"]= "Erreur lors du traitement de votre requête.";
                
                header("Location:list_affectations.php");
            }
        }
        
        
    }else{
        
         if((mysqli_num_rows($search_car) > 0  and $res["id_vehicule"] == $id_vehicule) or (mysqli_num_rows($search_car_temporaire_encours) > 0)) {
            
            if($res["id_user"] == $id_user and $res["etat"] == "en cours" ){
            
                $_SESSION["success"]=0;
                $_SESSION["status"]="L'utilisateur dispose déja d'une affectation pour le même véhicule.";
                
                header("Location:list_affectations.php");
                
            }else{
                
                 if(mysqli_num_rows($search_user_temporaire)){
                     
                      $_SESSION["success"]=0;
                      $_SESSION["status"]="L'utilisateur dispose déja d'une affectation temporaire.";
                        
                       header("Location:list_affectations.php");
                             
                     
                 }else{
                     
                 if($res["etat"] == "en cours" and mysqli_num_rows($search_user_temporaire)) {
                         
                        $e = mysqli_query($cnx,"INSERT INTO suivie_affectation (h_debut,h_fin,id_user, id_vehicule, date_debut, date_fin, mode, observation, etat, created_at) 
                                    VALUES ('$h_debut','$h_fin','$id_user', '$id_vehicule','$date_debut','$date_fin','Temporaire', '$observation','$curent','$curdate')");
                        
                         $notif103 = mysqli_query($cnx,"INSERT INTO notifications (id_user, contenu,etat,created_at) VALUES ('$id_user','Votre emprunt temporaire à commencer.','unread','$curdate')");
                                    
                         //update de l'etat du véhicule de celui qui detient le véhicule vers pause
                        $up = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$pause', date_fin='$date_debut', updated_at='$curdate' WHERE id_user='$id_user' and mode='$dif' ");
                        
                        $notif104 = mysqli_query($cnx,"INSERT INTO notifications (id_user, contenu, created_at) VALUES ('$dn','Utilisation de votre véhicule usuelle en pause','unread','$curdate')");
                    
                        if($e and $up ){
                            
                            $_SESSION["success"]=1;
                            $_SESSION["status"]= "Le vehicule à été affecter temporairement. 2";
                            
                            header("Location:list_affectations.php");
                            
                        }else{
                            
                            $_SESSION["success"]=0;
                            $_SESSION["status"]= "Erreur lors du traitement de votre requête.";
                            
                            header("Location:list_affectations.php");
                        }
                    
                   
                    
                        
                 }else{
                    
                    //rechercher si le véhicule est affecter temporairement vers quelqu'un
                    
                    if(mysqli_num_rows($search_car_temporaire_encours) > 0){
                        
                        $_SESSION["success"]=0;
                        $_SESSION["status"]="Le véhicule est déja affecter temporairement à une personne";
                        
                        header("Location:list_affectations.php");
                        
                    }else{
                        
                        if($mode == $dif and $po == $dif){
                            
                            if($mode = $temp and $id_user != $gt ){
                                
                                //créer l'affectation
                        
                                $e = mysqli_query($cnx,"INSERT INTO suivie_affectation (h_debut,h_fin,id_user, id_vehicule, date_debut, date_fin, km, mode, observation, etat, created_at) 
                                        VALUES ('$h_debut','$h_fin','$id_user', '$id_vehicule','$date_debut','$date_fin','$km','Temporaire', '$observation','$curent','$curdate')");
                                
                                $fdf = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$pause' WHERE id_user='$gt' and etat='$curent' and mode='$dif' ");
                                if($e){
                                    
                                    $_SESSION["success"]=1;
                                    $_SESSION["status"]= "Le vehicule à été affecter temporairement. 3";
                                    
                                    header("Location:list_affectations.php");
                                    
                                }else{
                                    
                                    $_SESSION["success"]=0;
                                    $_SESSION["status"]= "Erreur lors du traitement de votre requête";
                                    
                                    header("Location:list_affectations.php");
                                }
                                
                            }else{
                                
                                $_SESSION["success"]=0;
                                $_SESSION["status"]="Le véhicule est déja affecté diffinitivement à un utilisateur.";
                                
                                header("Location:list_affectations.php");
                                
                            }
                            
                        }else{
                            
                            //créer l'affectation
                        
                            $e = mysqli_query($cnx,"INSERT INTO suivie_affectation (h_debut,h_fin,id_user, id_vehicule, date_debut, date_fin, mode,km ,observation, etat, created_at) 
                                    VALUES ('$h_debut','$h_fin','$id_user', '$id_vehicule','$date_debut','$date_fin','$mode', '$km','$observation','$curent','$curdate')");
                                    
                            $notif = mysqli_query($cnx,"INSERT INTO notifications (id_user,contenu,etat, created_at) VALUES('$id_user', 'Votre emprunt viens de débuter.' ,'unread','$curdate')");
                            
                            if(mysqli_num_rows($search_car_dif_enc) > 0){
                                 $fdf = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$pause' WHERE id_vehicule='$id_vehicule' and etat='$curent' and mode='$dif' ");
                            }
                            
                            if($mode == $dif){
                                
                                $tst = mysqli_query($cnx, "SELECT * FROM vidanges WHERE id_vehicule='$id_vehicule' and etat=1");
                                
                                if(mysqli_num_rows($tst)>0){
                                    
                                }else{
                                    
                                    $futur_km = intval($km) + 10000;  
                                
                                    $ki = mysqli_query($cnx,"INSERT INTO vidanges(id_vehicule, id_user, created_at, km, etat, futur_km, indice) 
                                                        VALUES ('$id_vehicule','0', '$curdate', '$km', '1', '$futur_km','0')" );
                                    
                                    $lkj = intval($km) + 80000;
                                    
                                    $kp = mysqli_query($cnx,"INSERT INTO ges_chaine(id_vehicule, km, km_change) VALUES ('$id_vehicule','$km','$kp') ");
                                }
                               
                            }
                        
                            if($e){
                                
                                $_SESSION["success"]=1;
                                $_SESSION["status"]= "Le vehicule à été affecter temporairement.";
                                
                                header("Location:list_affectations.php");
                                
                            }else{
                                
                                $_SESSION["success"]=0;
                                $_SESSION["status"]= "Erreur lors du traitement de votre requête";
                                
                                header("Location:list_affectations.php");
                            }
                        }
                        
                        
                    }
                    
                }
                 }
                
            }
            
        }else{
            
            //si l'utilisateru dispose d'une affectation temporaire en cours
            
            if(mysqli_num_rows($search_car_temporaire_encours) > 0 and $mode == $temp){
                
                $_SESSION["success"]=0;
                $_SESSION["status"]="L'utilisateur dispose déja d'une affectation temporaire.";
                
                header("Location:list_affectations.php");
                
            }else{
                
                //si l'utilisateur dispose d'une affectation définitif en cours
                
                if(mysqli_num_rows($search_user_difinitif) > 0 and $mode == $dif ){
                    
                    $_SESSION["success"]=0;
                    $_SESSION["status"]="L'utilisateur dispose déja d'une affectation définitif.";
                    
                    header("Location:list_affectations.php");
                    
                } else{
                    
                    if(mysqli_num_rows($search_user_difinitif) > 0 and $mode == $temp ){
                        
                        $lp = mysqli_query($cnx,"INSERT INTO suivie_affectation (h_debut,h_fin,id_user, id_vehicule, date_debut, date_fin, mode, observation, etat, created_at) 
                                VALUES ('$h_debut','$h_fin','$id_user', '$id_vehicule','$date_debut','$date_fin','$temp','$observation','$curent','$curdate')");
                                
                         //update de l'etat du véhicule de celui qui detient le véhicule vers pause
                        $up = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$pause', date_fin='$date_debut', updated_at='$curdate' WHERE id_user='$id_user' and mode='$dif' ");
                        
                        if($lp and $up){
                            
                            $_SESSION["success"]=1;
                            $_SESSION["status"]= "Le vehicule à été affecter temporairement.";
                            
                            header("Location:list_affectations.php");
                            
                        }else{
                            
                            $_SESSION["success"]=0;
                            $_SESSION["status"]= "Erreur lors du traitement de votre requête.";
                            
                            header("Location:list_affectations.php");
                        }
                        
                    } else{
                        
                            if(mysqli_num_rows($search_user_temporaire) > 0 or mysqli_num_rows($chek_car_exsit) > 0){
                                
                                if(mysqli_num_rows($search_user_temporaire) > 0 and ($mode == "Definitif" or $mode=="Temporaire") ){
                                    
                                    $_SESSION["success"]=0;
                                    $_SESSION["status"]= "L'utilisateur dispose d'une affectation en cours.";
                                    
                                    header("Location:list_affectations.php");
                                    
                                }else{
                                    
                                    if($mode == $dif){
                                        
                                         $lo = mysqli_query($cnx,"INSERT INTO suivie_affectation (h_debut,h_fin,id_user, id_vehicule, date_debut, date_fin, mode, observation, etat, created_at) 
                                            VALUES ('$h_debut','$h_fin','$id_user', '$id_vehicule','$date_debut','$date_fin','$mode','$observation','$curent','$curdate')");
                                            
                                        $tst = mysqli_query($cnx, "SELECT * FROM vidanges WHERE id_vehicule='$id_vehicule' and etat='1'");
                                    
                                        if(mysqli_num_rows($tst) > 0){
                                            
                                        }else{
                                            
                                            $futur_km = intval($km) + 10000;    
                                        
                                            $ki = mysqli_query($cnx,"INSERT INTO vidanges(id_vehicule, id_user, created_at, km, etat, futur_km, indice) 
                                                                        VALUES ('$id_vehicule','0', '$curdate', '$km', '1', '$futur_km','0' )" );
                                                                        
                                            $lkbv = intval($km) + 80000;
                                        
                                            $kp = mysqli_query($cnx,"INSERT INTO ges_chaine(id_vehicule, km, km_change) VALUES ('$id_vehicule','$km','$lkbv') ");
                                        }
                                        
                                        if($lo){
                                            
                                            $_SESSION["success"]=1;
                                            $_SESSION["status"]= "Affectation effectué avec succès.";
                                            
                                            header("Location:list_affectations.php"); 
                                            
                                        }else{
                                            
                                            $_SESSION["success"]=0;
                                            $_SESSION["status"]= "Une erreur est survenue lors du traitement de l'information";
                                            
                                            header("Location:list_affectations.php"); 
                                        }
                                        
                                    } else{
                                         $lo = mysqli_query($cnx,"INSERT INTO suivie_affectation (h_debut,h_fin,id_user, id_vehicule, date_debut, date_fin, mode, observation, etat, created_at) 
                                            VALUES ('$h_debut','$h_fin','$id_user', '$id_vehicule','$date_debut','$date_fin','$temp','$observation','$curent','$curdate')");
                                        
                                        if($lo){
                                            
                                            $_SESSION["success"]=1;
                                            $_SESSION["status"]= "Affectation effectué avec succès.";
                                            
                                            header("Location:list_affectations.php"); 
                                            
                                        }else{
                                            
                                            $_SESSION["success"]=0;
                                            $_SESSION["status"]= "Une erreur est survenue lors du traitement de l'information";
                                            
                                            header("Location:list_affectations.php"); 
                                        }   
                                    }
                                
                                }
                              
                    
                            }else{
                                
                                $lo = mysqli_query($cnx,"INSERT INTO suivie_affectation (h_debut,h_fin,id_user, id_vehicule, date_debut, date_fin, mode, km,observation, etat, created_at) 
                                    VALUES ('$h_debut','$h_fin','$id_user', '$id_vehicule','$date_debut','$date_fin','$mode','$km','$observation','$curent','$curdate')");
                                    
                                $notif = mysqli_query($cnx,"INSERT INTO notifications (id_user,contenu,etat,created_at) VALUES('$id_user', 'Votre emprunt viens de débuter.' ,'unread','$curdate')");
                                
                                if($mode == $dif){
                                    
                                    $tst = mysqli_query($cnx, "SELECT * FROM vidanges WHERE id_vehicule='$id_vehicule' and etat='1'");
                                    
                                    if(mysqli_num_rows($tst)> 0){
                                        
                                    }else{
                                        
                                        $futur_km = intval($km) + 10000;    
                                    
                                        $ki = mysqli_query($cnx,"INSERT INTO vidanges(id_vehicule, id_user, created_at, km, etat, futur_km, indice) 
                                                                    VALUES ('$id_vehicule','0', '$curdate', '$km', '1', '$futur_km','0' )" );
                                                                    
                                        $lkbv = intval($km) + 80000;
                                    
                                        $kp = mysqli_query($cnx,"INSERT INTO ges_chaine(id_vehicule, km, km_change) VALUES ('$id_vehicule','$km','$lkbv') ");
                                    }
                                    
                                }    
                                    
                               
                                    
                                if($lo){
                                    
                                    $_SESSION["success"]=1;
                                    $_SESSION["status"]= "Le vehicule à été affecter.";
                                    
                                    header("Location:list_affectations.php");
                                    
                                }else{
                                    
                                    $_SESSION["success"]=0;
                                    $_SESSION["status"]= "Erreur lors du traitement de votre requête";
                                    
                                    header("Location:list_affectations.php");
                                }
                                
                            }
                        
                    }
                    
                }
                
            }
            
        }
        
        
    }
    
    }
    
    
}else{
    
    
  $_SESSION["status"] = "Veuillez remplire tous le champs requis !";
  $_SESSION["success"] = 0;
  
  header("Location:ajouter_affectation.php");
  
}



?>