<?php
require("../db_connect.php");
$response = array();

if(isset($_GET["id"])){
    
    $id=$_GET["id"];
    
    $req = mysqli_query($cnx, "SELECT * FROM vidanges WHERE id_vehicule='$id' and etat='0' ");
    
    $tmp = array();
    $response["results"] = array();
    
    while($cur=mysqli_fetch_array($req)){
        
        $tmp["id"] = $cur["id"];
        $tmp["actual_km"] = $cur["actual_km"];
        $tmp["date"] = $cur["date"];
        $tmp["etat"] = $cur["etat"];
        
        array_push($response["results"], $tmp);
        
    }
    
    $response["success"] = 1;
    
    echo json_encode($response);
    
    
}else{
    
    $response["success"] = 0;
    
    echo json_encode($response);
    
}

?>