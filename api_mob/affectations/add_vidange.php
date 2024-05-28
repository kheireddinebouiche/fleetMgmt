<?php

require("../db_connect.php");
date_default_timezone_set('Africa/Algiers');
$response= array();

$curdate = date('y-m-d h:i:s');

if(isset($_GET["id"])){
    
    $id = $_GET["id"];
    $id_vehicule = $_GET["id_vehicule"];
    $actual_km = $_GET["new_kilom"];
    
    $futur_km = intval($actual_km) + 10000;
    $curent = "en cours";
    
    $req = mysqli_query($cnx, "UPDATE vidanges set actual_km='$actual_km', date='$curdate', updated_at='$curdate', etat='0' WHERE id='$id'");
    $upd_aff = mysqli_query($cnx, "UPDATE suivie_affectation SET km= '$actual_km' WHERE id_vehicule='$id_vehicule' and etat='$curent'");
    $insert = mysqli_query($cnx, "INSERT INTO vidanges (id_user,id_vehicule, km, created_at, futur_km, etat) VALUES ('0','$id_vehicule','$actual_km','$curdate','$futur_km', '1')");
    
    
    if($req){
        
        $response["success"] = 1;
        $response["message"] = "Ajouter avec succes";
        echo json_encode($response);
        
    }else{
        
        $response["success"] = 0;
        $response["message"] = "Erreur";
        echo json_encode($response);
        
    }
    
}else{
    
    $reponse["success"] = 1;
    $resonse["message"] = "Erreur";
    echo json_encode($response);
}

?>