<?php
require_once("../db_connect.php");

$response=array();


$state = "en cours";

$req = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE state='$state'");
if(mysqli_num_rows($req) > 0){
    
    $tmp=array();
    $response["users"]=array();
    
    while($cur=mysqli_fetch_array($req)){
        
        
        $us = $cur["id_user"];
        $username = mysqli_query($cnx,"SELECT username FROM user WHERE id='$us'");
        $conducteur = mysqli_fetch_array($username);
        
        
        $tmp["username"]=$conducteur["username"];
        $tmp["id_user"]= $cur["id_user"];
        $tmp["id_vehicule"] = $cur["id_vehicule"];
        
        
        array_push($response["users"], $tmp);
    }
    
    $response["success"] = 1;
    echo json_encode($response);
}

else{
    
    $response["success"] = 0;
    $response["message"] = "Data not found";
    
    echo json_encode($response);
    
}