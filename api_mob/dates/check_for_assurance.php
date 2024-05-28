<?php

require("../db_connect.php");

$response=array();


if(isset($_GET["id_user"])){
    
    $id = $_GET["id_user"];
    $etat = "en cours";
    
    $sql = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_user='$id' and state='$etat'");
    
    if(mysqli_num_rows($sql) > 0){
        
        $tmp=array();
        
        $response["result"]=array();
        $cur=mysqli_fetch_array($sql);
        
        $tmp["id_vehicule"] = $cur["id_vehicule"];
        
        
        array_push($response["result"], $tmp);
        
        $response["success"] = 1;
        echo json_encode($response);
        
        
    }else{
        
        $response["success"] = 0;
        $response["message"] = "Auncune affectation pour le véhicule";
        echo json_encode($response);
    }
    
    
}