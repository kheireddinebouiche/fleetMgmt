<?php
require("../db_connect.php");
date_default_timezone_set('Africa/Algiers');

$response=array();

if (isset($_GET["id"])){
    
    $id = $_GET["id"];
    $conducteur= $_GET["conducteur"];
    $id_voiture = $_GET["id_voiture"];
    $date_sinistre = $_GET["date_sinistre"];
    $lieu =$_GET["lieu"];
    $description = $_GET["description"];

    $curdate = date('y-m-d h:i:s');
    
    $req = mysqli_query($cnx, 
        "UPDATE sinistres SET date_sinistre='$date_sinistre', id_voiture='$id_voiture', lieu='$lieu', description='$description',conducteur='$conducteur',updated_at='$curdate' WHERE id='$id'"
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