<?php

require_once("../db_connect.php");
date_default_timezone_set('Africa/Algiers');


$response = array();

if(isset($_GET["id_voiture"]) && isset($_GET["id_user"])){
    
    $id_voiture = $_GET["id_voiture"];
    $id_user = $_GET["id_user"];
    $date_sinistre = $_GET["date_sinistre"];
    $description = $_GET["description"];
    $lieu = $_GET["lieu"];
    $conducteur = $_GET["conducteur"];
    
    
    $curdate = date('y-m-d h:i:s');
 
    $sql = "INSERT INTO sinistres(id_voiture,id_user,date_sinistre,description,lieu,conducteur, created_at) 
              VALUES('$id_voiture','$id_user','$date_sinistre','$description','$lieu','$conducteur','$curdate')";
    
    $req = mysqli_query($cnx,$sql);
        
    if($req){
        $response["success"]=1;
        $response["message"]="inserted !";
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