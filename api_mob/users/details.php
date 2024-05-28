<?php

require("../db_connect.php");

$response=array();

if(isset($_GET["id"])){
    
    $id= $_GET["id"];
    
    $req = mysqli_query($cnx, "SELECT * FROM user WHERE id='$id' ");
    
    if(mysqli_num_rows($req)>0){
        
        $tmp=array();
        
        $response["user"]=array();
        $cur=mysqli_fetch_array($req);
        
        $tmp["id"]=$cur["id"];
        $tmp["username"]=$cur["username"];
        $tmp["email"]=$cur["email"];
        $tmp["identification"]=$cur["identification"];
        $tmp["mobile"]=$cur["mobile"];
        $tmp["created_at"]=$cur["created_at"];
        $tmp["updated_at"]=$cur["updated_at"];
        $tmp["last_connexion"]=$cur["last_connexion"];
        $tmp["pass"] = $cur["pass"];
        
        array_push($response["user"], $tmp);
        
        $response["success"] = 1;
        echo json_encode($response);
        
    }else{
        
        $response["success"] = 0;
        $response["message"] = "No data found";
        echo json_encode($response);
    }
    
    
}else{
    
    $response["success"] = 0;
    $response["message"] = "required field is missing";
    echo json_encode($response);
    
}


?>