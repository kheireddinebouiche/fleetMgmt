<?php

require("../db_connect.php");
date_default_timezone_set('Africa/Algiers');


$response=array();

if(isset($_GET["id_of_difinitif"])){
    
    $id= $_GET["id"];
    
    $owner = $_GET["id_of_difinitif"];
    
    $etat = "en cours";
    $etat2 = "annulé";
    $pause = "Pause";
    $mod = "Definitif";
    
    $req = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_vehicule='$id' and etat='$etat' ");
    $fd = mysqli_fetch_assoc($req); 
    
    $l = $fd["id_user"];
    
    $prev = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_user = '$l' and mode='$mod'");
   
    
    if(mysqli_num_rows($req)>0){
        
    
        
        $curdate = date('y-m-d h:i:s');
        
        $e = mysqli_query($cnx, "UPDATE suivie_affectation SET etat='$etat2', date_fin='$curdate', updated_at='$curdate' WHERE id_vehicule='$id' and etat='$etat'");
        $ef = mysqli_fetch_assoc($e);
        $prev_user=$ef["id_user"];
        
        $f = mysqli_query($cnx, "UPDATE suivie_affectation SET etat='$etat' , date_debut='$curdate' ,  updated_at='$curdate' WHERE id_user='$owner' and etat='$pause' ");
        
        if(mysqli_num_rows($prev) > 0){
            
             $f = mysqli_query($cnx, "UPDATE suivie_affectation SET etat='$etat' , date_debut='$curdate' ,  updated_at='$curdate' WHERE id_user='$l' and etat='$pause' ");
        }
        
        $notif = mysqli_query($cnx," INSERT INTO notifications (id_user, contenu, etat ,created_at) 
                                       VALUES ('$prev_user','Votre emprunt de véhicule à été cloturé.','unread','$curdate') ");
                                       
        $notif2 = mysqli_query($cnx," INSERT INTO notifications (contenu, etat ,created_at) 
                                       VALUES ('Un emprunt de véhicule à été cloturé.','unread','$curdate') ");
        
        if($e){
            
            $response["success"]=1;
            $response["message"]="updated successfully !";
            
            echo json_encode($response);
            
        }else{
            
            $response["success"]=0;
            $response["message"]="request error !";
            echo json_encode($response);
        }
        
        
        
    }else{
        
        $response["success"] = 0;
        $response["message"] = "No data found";
        echo json_encode($response);
    }
    
    
}else{
    
    $response["success"] = 0;
    $response["message"] = "required field is missing";
    echo json_encode($response);
    
}


?>