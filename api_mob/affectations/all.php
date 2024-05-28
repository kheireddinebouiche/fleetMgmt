<?php
require_once("../db_connect.php");

$response=array();

$req = mysqli_query($cnx, "SELECT * FROM suivie_affectation");
if(mysqli_num_rows($req) > 0){
    
    $tmp=array();
    $response["affectations"]=array();
    
    while($cur=mysqli_fetch_array($req)){
        
        
        $us = $cur["id_user"];
        $username = mysqli_query($cnx,"SELECT username FROM user WHERE id='$us'");
        $conducteur = mysqli_fetch_array($username);
        
        $vi = $cur["id_vehicule"];
        $vehi = mysqli_query($cnx,"SELECT vehicule FROM voitures WHERE id='$vi'");
        $label = mysqli_fetch_array($vehi);
        
        $tmp["id"] = $cur["id"];
        $tmp["id_vehicule"]=$label["vehicule"];
        $tmp["id_user"]=$conducteur["username"];
        $tmp["mode"] = $cur["mode"];
        $tmp["created_at"] = $cur["created_at"];
        $tmp["etat"] = $cur["etat"];
        $tmp["updated_at"] = $cur["update_at"];
        array_push($response["affectations"], $tmp);
    }
    
    $response["success"] = 1;
    echo json_encode($response);
}

else{
    
    $response["success"] = 0;
    $response["message"] = "Data not found";
    
    echo json_encode($response);
    
}



?>