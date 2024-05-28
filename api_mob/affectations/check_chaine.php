<?php
require("../db_connect.php");
$response= array();

if(isset($_GET["id"])){
    
    $id = $_GET["id"];
    
    $req = mysqli_query($cnx, "SELECT count(*) FROM vidanges WHERE id_vehicule='$id' and etat='1' ");
    
    if($req >= 7 ){
        $response["success"] = 1;
        
        echo json_encode($response);
    }else{
        
        $response["success"] = 0;
        
        echo json_encode($response);
    }
    
    
}else{
    $response["success"]=0;
    
    echo json_encode($response);
}

?>