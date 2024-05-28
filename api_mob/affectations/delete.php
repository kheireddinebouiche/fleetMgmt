<?php

include("../db_connect.php");

$response = array();

if(isset($_GET["id"])){
    
    $id = $_GET["id"];
    
    $state = "Annulé";
    $enc = "en cours";
    $m = "Definitif";
    $pause = "Pause";
    
   
    
    $rd = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id='$id'");
    $info = mysqli_fetch_assoc($rd);
    $u = $info["id_vehicule"];
    $k = $info["id_user"];
    
    $find_vehicule = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_vehicule='$u' and mode='$m' and etat='$pause' ");
    $p = mysqli_fetch_assoc($find_vehicule);
    $g = $p["id_user"];
    
    $find_user = mysqli_query($cnx,"SELECT * FROM suivie_affectation WHERE id_user='$k' and mode='$m' and etat='$pause' ");
    $q = mysqli_fetch_assoc($find_user);
    $v = $q["id_user"];
    
    
    if(mysqli_num_rows($find_vehicule) > 0 and mysqli_num_rows($find_user) > 0){
        
        $req = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$state' WHERE id='$id'");
        $rf = mysqli_query($cnx, "UPDATE suivie_affectation SET etat='$enc' WHERE id_user='$g' and etat='$pause' and mode='$m'");
        $rk = mysqli_query($cnx, "UPDATE suivie_affectation SET etat='$enc' WHERE id_user='$v' and etat='$pause' and mode='$m' ");
        
        
        if($req){
            
            $response["success"] = 1;
            $response["message"] = "Succès";
            echo json_encode[$response];
            
        }else{
            
            $response["success"] = 0;
            $response["message"] = "Erreur 1";
            echo json_encode[$response];
            
        }
        
        
    }else{
        
        if(mysqli_num_rows($find_user)> 0 or mysqli_num_rows($find_vehicule)> 0){
            
             $req = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$state' WHERE id='$id'");
             $rf = mysqli_query($cnx, "UPDATE suivie_affectation SET etat='$enc' WHERE id_user='$g' and mode='$m' and etat='$pause' ");
             
             if($req){
                $response["success"] = 1;
                $response["message"] = "Succès";
                echo json_encode[$response];
                
             }else{
                 
                  $response["success"] = 0;
                  $response["message"] = "Erreur 2";
                  echo json_encode[$response];
             }
            
        }else{
            
            $req = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='$state' WHERE id='$id'");
            
            if ($req){
                 $response["success"] = 1;
                $response["message"] = "Succès";
                echo json_encode[$response];
             }else{
                 
                  $response["success"] = 0;
                    $response["message"] = "Erreur 3";
                    echo json_encode[$response];
             }
            
            
        }
        
    }

   
}else{
    
    $response["success"] = 0;
    $response["message"] = "required field is missing";
     
    echo json_encode[$response];
    
}



?>