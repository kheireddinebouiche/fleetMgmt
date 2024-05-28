<?php

require("../db_connect.php");

$response=array();


if(isset($_GET["id"])){
    
    $id = $_GET["id"];
    $etat = "en cours";
    $etat2 = "Pause";
    
    $sql = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE (id_user='$id' and etat='$etat') or (id_user='$id' and etat='$etat2')");
    
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
        $response["message"] = "Vous n'avez aucun véhicule affecté. veuillez proceder a une demande de véhicule.";
        echo json_encode($response);
    }
    
    
}