<?php
require("../db_connect.php");
date_default_timezone_set('Africa/Algiers');

$response = array();

if(isset($_GET["kilometrage"])){
    
    $id_vehicule = $_GET["id_vehicule"];
    $kilometrage = $_GET["kilometrage"];
    $user_id = $_GET["user_id"];
    
    
    $curdate = date('y-m-d h:i:s');
    
    $sql = "INSERT INTO suivie_kilometrage (id_vehicule,kilometrage,date_mesure,created_at, user_id) VALUES('$id_vehicule','$kilometrage','$curdate','$curdate','$user_id')";
    
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



