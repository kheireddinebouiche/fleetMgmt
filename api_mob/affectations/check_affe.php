<?php

require("../db_connect.php");

$response=array();


if(isset($_GET["id"])){
    
    $id = $_GET["id"];
    $etat = "en cours";
    $mode = "Temporaire";
    
    $sql = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_vehicule='$id' and etat='$etat' and mode='$mode' ");
    
    if(mysqli_num_rows($sql) > 0){
        
        $tmp=array();
        
        $response["result"]=array();
        $cur=mysqli_fetch_array($sql);
        
        $df = $cur["id_user"];
        
        $conducteur = mysqli_query($cnx, "SELECT * FROM user WHERE id='$df' ");
        $cd = mysqli_fetch_assoc($conducteur);
        
        $tmp["id_vehicule"] = $cur["id_vehicule"];
        $tmp["id_user"] = $cur["id_user"];
        $tmp["username"] = $cd["username"];
        $tmp["date_fin"] = $cur["date_fin"];
        $tmp["date_debut"] = $cur["date_debut"];
        
        
        array_push($response["result"], $tmp);
        
        $response["success"] = 1;
        echo json_encode($response);
        
        
    }else{
        
        $response["success"] = 0;
        $response["message"] = "Auncune affectation pour le véhicule";
        echo json_encode($response);
    }
    
    
}
?>