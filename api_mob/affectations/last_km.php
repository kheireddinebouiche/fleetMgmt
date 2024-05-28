<?php
require("../db_connect.php");

$response=array();

if(isset($_GET["id_vehicule"])){
    
    $id_v = $_GET["id_vehicule"];
    
    $req = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_vehicule='$id_v' ORDER BY id DESC LIMIT 1");
    $d = mysqli_fetch_assoc($req);
    
    if(mysqli_num_rows($req) > 0){
    
       $km = $d["km"];
       
        
        $response["success"] = 1;
        $response["km"] = $km;
        $response["message"] = "D";
        
        echo json_encode($response);
        
    }else{
        
        $reponse["success"]=0;
        $resonse["message"]="Nothing to show";
        
        echo json_encode($response);
        
    }
    
}else{
    
    $reponse["success"]=0;
    $resonse["message"]="Required field is missing";
    echo json_encode($response);
    
}


?>