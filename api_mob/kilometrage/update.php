<?php
include("db_connect.php");

$response=array();

if (isset($_GET["id"])){
    
    $id=$_GET["id"];
    $kilometrage = $_GET["kilometrage"];
    
    $curdate = date('y-m-d h:i:s');
    $req = mysqli_query($cnx, 
        "UPDATE kilomertrage SET kilometrage='$kilometrage', updated_at='$curdate' WHERE id='$id'"
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