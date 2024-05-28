<?php
require("../db_connect.php");
date_default_timezone_set('Africa/Algiers');

$response=array();

if (isset($_GET["id"])){
    
    $id=$_GET["id"];
    $username = $_GET["username"];
    $identification=$_GET["identification"];
    $pass = $_GET["pass"];
    $email = $_GET["email"];
    $mobile = $_GET["mobile"];
    
    
    $curdate = date('y-m-d h:i:s');
    
    
    $req = mysqli_query($cnx, 
        "UPDATE user SET username='$username', identification='$identification', email='$email', pass='$pass', mobile='$mobile',updated_at='$curdate' WHERE id='$id'"
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