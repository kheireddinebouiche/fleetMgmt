<?php
include("db_connect.php");

$response=array();

if (isset($_GET["id"]) && isset($_GET["nom"]) && isset($_GET["age"])){
    
    $id=$_GET["id"];
    $nom = $_GET["nom"];
    $age=$_GET["age"];
    
    $req = mysqli_query($cnx, 
        "UPDATE user SET nom='$nom', age='$age' WHERE id='$id'"
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