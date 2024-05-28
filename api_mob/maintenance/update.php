<?php
require_once("../db_connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');


$response=array();

if(isset($_GET["id"])){
    
        
    $id = $_GET["id"];
    $motifs = $_GET["motifs_maintenance"];
    $description = $_GET["description"];
    $date_maintenance = $_GET["date_maintenance"];
    
    $id_vehicule = $_GET["id_vehicule"];
    $id_user = $_GET["id_user"];
    
    $req = mysqli_query($cnx,"UPDATE maintenance SET description='$description' , motifs_maintenance='$motifs', date_maintenance='$date_maintenance' ,id_user='$id_user', id_vehicule='$id_vehicule' , updated_at='$curdate'  WHERE id='$id'");
  
    if($req){
        
        $response["success"]=1;
        $response["message"]="success";
        echo json_encode($response);
        
    }else{
        
        $response["success"]=0;
        $response["message"]="failed";
        echo json_encode($response);
    }
    
    
    
}else{
    
    $response["success"]=0;
    $response["message"]="required filed is missing";
    echo json_encode($response);
    
}

?>