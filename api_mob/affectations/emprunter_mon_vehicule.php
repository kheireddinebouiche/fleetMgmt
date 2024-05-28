<?php
require("../db_connect.php");
date_default_timezone_set('Africa/Algiers');

$response = array();

if(isset($_GET["id_user"])){
    
    $id = $_GET["id"];
    $id_user = $_GET["id_user"];
    $observation = $_GET["observation"];
    $date_debut = $_GET["date_debut"];
    $date_fin = $_GET["date_fin"];
    
    
    $curent= "en cours";
    $mode = "Temporaire";
    $mode2 = "Definitif";
    $pause= "Pause";
    
    $search = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_user='$id_user'");
    $res = mysqli_fetch_assoc($search);
    
    $se = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_user='$id' and mode='$mode2' and etat='$curent' ");
    $re = mysqli_fetch_assoc($se);
    
    $id_vehicule = $re["id_vehicule"];
    
    if($id == $id_user){
        
        $response["success"]=0;
        $response["message"]="Vous ne pouvais pas effectuer une affectation a vous même.";
        echo json_encode($response);
        
    }else{
        
        if(mysqli_num_rows($search) > 0){
        
        $curdate = date('y-m-d h:i:s');
        
        if($res["etat"] == $curent){
            
            if($res["mode"] == "$mode"){
            
                $response["success"]=0;
                $response["message"]="Le conducteur posséde déja un véhicule en cours d'utilisation temporairement.";
                echo json_encode($response);
            
            }else{
                
                $upd_use1 = mysqli_query($cnx, "UPDATE suivie_affectation SET etat='$pause' WHERE id_user='$id_user' and mode='$mode2' ");
                $upd_use2 = mysqli_query($cnx, "UPDATE suivie_affectation SET etat='$pause' WHERE id_user='$id' and mode='$mode2' ");
                
                $notif100 = mysqli_query($cnx," INSERT INTO notifications (id_user,contenu,created_at) VALUES ('$id_user','Votre véhicule et pause.','$curdate') ");
                $notif101 = mysqli_query($cnx," INSERT INTO notifications (id_user,contenu,created_at) VALUES ('$id','Votre véhicule et pause.','$curdate') ");
                
                $sx = mysqli_query($cnx,"INSERT INTO suivie_affectation (id_user, id_vehicule, date_debut, date_fin, mode, etat ,observation, created_at) 
                                    VALUES('$id_user','$id_vehicule','$date_debut','$date_fin','$mode','$curent','$observation','$curdate') ");
                                    
                $notif103 = mysqli_query($cnx," INSERT INTO notifications (id_user,contenu,created_at) VALUES ('$id_user','Votre emprunt temporaire est désormais actif.','$curdate') ");
                
                if($sx){
                    $response["success"]=1;
                    $response["message"]="Ajouter avec succès";
                    echo json_encode($response);
                    
                }else{
                    
                     $response["success"]=0;
                     $response["message"]="Erreur";
                     echo json_encode($response);
                }
                
                
            }
            
        }else{
            
            
            $sd = mysqli_query($cnx,"INSERT INTO suivie_affectation (id_user, id_vehicule, date_debut, date_fin, mode, etat ,observation, created_at) 
                                    VALUES('$id_user','$id_vehicule','$date_debut','$date_fin','$mode','$curent','$observation','$curdate') ");
                                    
            $upd= mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$pause' WHERE id_user='$id' and mode='$mode2' ");
            
            $notif = mysqli_query($cnx," INSERT INTO notifications (id_user,contenu,created_at) VALUES ('$id_user','Votre emprunt vien de débuter','$curdate') ");
            
                                    
            if($sd){
                
                $response["success"]=1;
                $response["message"]="Ajouter avec succès";
                echo json_encode($response);
                
            }else{
                
                $response["success"]=0;
                $response["message"]="Erreur";
                echo json_encode($response);
            }
            
        }
        
    }else{
        
        //user disponible
        
        $sd = mysqli_query($cnx,"INSERT INTO suivie_affectation (id_user, id_vehicule, date_debut, date_fin, mode, etat, observation, created_at) 
                                    VALUES('$id_user','$id_vehicule','$date_debut','$date_fin','$mode','$curent','$observation','$curdate') ");
                                    
        $upd= mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$pause' WHERE id_user='$id' and mode='$mode2' ");
        
        $notif = mysqli_query($cnx," INSERT INTO notifications (id_user,contenu,created_at) VALUES ('$id_user','Votre emprunt vien de débuter','$curdate') ");
        
                                
        if($sd){
            
            $response["success"]=1;
            $response["message"]="Ajouter avec succès";
            echo json_encode($response);
            
        }else{
            
            $response["success"]=0;
            $response["message"]="Erreur";
            echo json_encode($response);
        }
        
    }
        
    }
    
    
}else{
    
    $response["success"]=0;
    $response["message"]="required filed is missing";
    echo json_encode($response);
}

?>