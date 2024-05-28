<?php
require("../db_connect.php");
date_default_timezone_set('Africa/Algiers');

$response = array();

if(isset($_GET["username"]) && isset($_GET["email"]) && isset($_GET["pass"])){
    
    $username = $_GET["username"];
    $email = $_GET["email"];
    $pass=$_GET["pass"];
    $identification = $_GET["identification"];
    $mobile = $_GET["mobile"];
    $niveau = $_GET["niveau"];
    $permis = $_GET["permis"];
    
    if($niveau == "Administrateur"){
        $niveau = 1;
    }else{
        if($niveau == "Gestionnaire"){
            $niveau = 2;
        } else {
            if($niveau == "Utilisateur"){
                $niveau = 3;
            }
        }
    }
    
    $curdate = date('y-m-d h:i:s');
    
    $sql = "INSERT INTO user (username,email,pass,num_permis,identification,mobile,niveau,created_at) VALUES('$username','$email','$pass','$permis','$identification','$mobile','$niveau','$curdate')";
    
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