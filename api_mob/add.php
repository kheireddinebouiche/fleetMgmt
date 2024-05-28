<?php

include("db_connect.php");

$response = array();

if(isset($_GET["nom"]) && isset($_GET["age"]) && isset($_GET["username"])){
    
    $nom = $_GET["nom"];
    $age = $_GET["age"];
    $username=$_GET["username"];
    
    $sql = "INSERT INTO user(nom,age,username) VALUES('$nom','$age','$username')";
    
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