<?php

require_once("../db_connect.php");

$response=array();

if(isset($_GET["id"])){
    
    $tmp=array();
    $response["affectations"]=array();
    
    
    
    $etat = "en cours";
    $etat1 = "Pause";
    
    $id = $_GET["id"];
    $sql = mysqli_query($cnx,"SELECT * FROM suivie_affectation WHERE id_user='$id' and etat='$etat' or id_user='$id' and etat='$etat1'");
    $nombre = mysqli_num_rows($sql);
    
    while($cur = mysqli_fetch_array($sql)){
        
        
        
        $tmp["id_user"] = $cur["id_user"];
        $tmp["id_vehicule"] = $cur["id_vehicule"];
        $tmp["date_debut"] = $cur["date_debut"];
        $tmp["date_fin"] = $cur["date_fin"];
        $tmp["etat"] = $cur["etat"];
        $tmp["mode"] = $cur["mode"];
        $tmp["created_at"] = $cur["created_at"];
        $tmp["updated_at"] = $cur["updated_at"];
    
        array_push($response["affectations"], $tmp);
    }
    
        $response["success"] = 1;
        $response["nb"] = $nombre;
        echo json_encode($response);
            
}else{
    
    $response["success"] = 0;
    $response["message"] = "Data not found";
    
    echo json_encode($response);
}



?>