<?php
require("../db_connect.php");

$response=array();

$req = mysqli_query($cnx, "SELECT * FROM notifications");

if(mysqli_num_rows($req) > 0){
    
    $tmp=array();
    $response["results"]=array();
    
    while($cur=mysqli_fetch_array($req)){
        
        $tmp["id"]=$cur["id"];
        $tmp["contenu"]=$cur["contenu"];
        $tmp["created_at"]=$cur["created_at"];
        
        
        array_push($response["results"], $tmp);
    }
    
    $response["success"] = 1;
    echo json_encode($response);
}

else{
    
    $response["success"] = 0;
    $response["message"] = "Data not found";
    
    echo json_encode($response);
    
}


