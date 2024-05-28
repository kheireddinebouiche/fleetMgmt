<?php
require("../db_connect.php");
date_default_timezone_set('Africa/Algiers');

$response = array();

if(isset($_GET["id_vehicule"])){
    
   
    $id_vehicule = $_GET["id_vehicule"];
    $id_user = $_GET["id_user"];
    $date_maintenance = $_GET["date_maintenance"];
    $motifs = $_GET["motifs_maintenance"];
    $description = $_GET["description"];

    
    $curdate = date('y-m-d h:i:s');
    
    $sql = "INSERT INTO maintenance (id_vehicule, id_user,motifs_maintenance,date_maintenance,description,created_at) 
                   VALUES('$id_vehicule','$id_user','$motifs','$date_maintenance','$description','$curdate')";
    
    $req = mysqli_query($cnx,$sql);
        
    if($req){
        
        $response["success"]=1;
        $response["message"]="inserted !";
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