<?php
require("../db_connect.php");
$response=array();

if(isset($_GET["id"])){
    
    $id=$_GET["id"];
    
    $req = mysqli_query($cnx, "UPDATE sinistres SET etat='1' WHERE id='$id'");
    
    if($req){
        
        $response["success"]=1;
        
        echo json_encode($response);
        
    }else{
        
        $response["success"]=0;
    
         echo json_encode($response);
    }
    
    
}else{
    
    $response["success"]=0;
    
    echo json_encode($response);
    
}



?>