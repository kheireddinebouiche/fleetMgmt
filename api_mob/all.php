<?php
include("db_connect.php");

$response=array();

$req = mysqli_query($cnx, "SELECT * FROM user");
if(mysqli_num_rows($req) > 0){
    
    $tmp=array();
    $response["users"]=array();
    
    while($cur=mysqli_fetch_array($req)){
        
        $tmp["id"]=$cur["id"];
        $tmp["nom"]=$cur["nom"];
        $tmp["age"]=$cur["age"];
        
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



?>