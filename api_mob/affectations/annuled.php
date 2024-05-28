<?php

require("../db_connect.php");

$response=array();

if(isset($_GET["id"])){
    
    $id= $_GET["id"];
    
    $req = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id='$id' ");
    $d = mysqli_fetch_assoc($req);
    
    if($d["etat"] == "Annulé" or $d["etat"] == "annulé"){
        
        $response["success"] = 1;
        $response["message"] = "required field is missing";
        echo json_encode($response);
    }else{
        
        $response["success"] = 0;
   
        echo json_encode($response);
    }
    
    
    
    
}else{
    
    $response["success"] = 0;
    $response["message"] = "required field is missing";
    echo json_encode($response);
    
}


?>