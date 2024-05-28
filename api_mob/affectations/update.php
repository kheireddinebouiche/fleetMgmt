<?php

require_once("../db_connect.php");
date_default_timezone_set('Africa/Algiers');

$response=array();

if (isset($_GET["id_user"]) && isset($_GET["id_vehicule"]) && isset($_GET["type"])){
    
    $id=$_GET["id"];
    
    $id_user = $_GET["id_user"];
    $id_vehicule = $_GET["id_vehicule"];
    
    $date_debut = $_GET["date_debut"];
    $date_fin = $_GET["date_fin"];
    $mode = $_GET["mode"];
    $observation = $_GET["observation"];
    
    $curdate = date('y-m-d h:i:s');
    
    $req = mysqli_query($cnx, 
        "UPDATE suivie_affectation SET id_user='$id_user', id_vehicule='$id_vehicule', mode='$mode', date_debut='$date_debut', date_fin='$date_fin', observation='$observation',updated_at='$curdate' WHERE id='$id'"
        );
        
    if($req){
        $response["success"]=1;
        $response["message"]="updated successfully !";
        
        echo json_encode($response);
        
    }else{
        $response["success"]=0;
        $response["message"]="request error !";
        echo json_encode($response);
    }
    
    
}else{
    
    $response["success"]=0;
    $response["message"]="required filed is missing";
    echo json_encode($response);
}

?>