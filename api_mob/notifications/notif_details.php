<?php

include("../db_connect.php");

$response=array();

if(isset($_GET["id"])){
    
    $id= $_GET["id"];
    
    $req = mysqli_query($cnx, "SELECT * FROM notifications WHERE id='$id' ");
    
    if(mysqli_num_rows($req)>0){
        
        $tmp=array();
        
        $response["result"]=array();
        $cur=mysqli_fetch_array($req);
        
        $tmp["id"]=$cur["id"];
        $tmp["contenu"]=$cur["contenu"];
        $tmp["created_at"]=$cur["created_at"];
        
        $read= mysqli_query($cnx,"UPDATE notifications SET etat='readed' WHERE id='$id'");
        
        array_push($response["result"], $tmp);
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