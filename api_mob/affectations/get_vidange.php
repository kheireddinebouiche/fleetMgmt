<?php

require("../db_connect.php");

$response = array();

if(isset($_GET["id"])){
    
    $id = $_GET["id"];
    
    $dd = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id='$id'");
    $rd = mysqli_fetch_assoc($dd);
    $vehicule = $rd["id_vehicule"];
    
    $req = mysqli_query($cnx, "SELECT * FROM vidanges WHERE id_vehicule='$vehicule' and etat = '1' ");
    $result = mysqli_fetch_array($req);
    
    $tmp = array();
    $response["result"] = array();
    
    if(mysqli_num_rows($req) > 0){
        
    
        $tmp["futur_km"] = $result["futur_km"];
        $tmp["id"] = $result["id"];
        
        array_push($response["result"], $tmp);
        
        $response["success"] = 1;
        $response["message"] = "True";
        echo json_encode($response);
    }
    
    
}else{
    
    $response["success"] = 0;
    $response["message"] = "Error";
    echo json_encode($response);
}