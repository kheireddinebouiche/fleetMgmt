<?php
require("../db_connect.php");
date_default_timezone_set('Africa/Algiers');

$response = array();

if(isset($_GET["id_user"])){
    
   
    $id_user = $_GET["id_user"];
    $demandeur = $_GET["demandeur"];
    $id_vehicule = $_GET["id_vehicule"];
    $type = $_GET["type"];
    $observation = $_GET["observation"];
    $date_debut = $_GET["date_debut"];
    $date_fin = $_GET["date_fin"];
    
    $enc_state = "en cours";
    $fin_state = "annulé";
    
    $curdate = date('y-m-d h:i:s');
    $date_test = strtotime($date_fin);
    
    $sq = mysqli_query($cnx, "UPDATE suivie_affectation set state='$fin_state', date_fin='$date_debut', updated_at='$curdate' WHERE id_user='$id_user'");
    

    $sql = "INSERT INTO suivie_affectation (id_user,id_vehicule,date_debut,date_fin,type,observation,state,created_at) 
             VALUES('$demandeur','$id_vehicule','$date_debut','$date_fin','$type','$observation','$enc_state','$curdate')";

    $req = mysqli_query($cnx,$sql);
    
        
    if($req){
        
        $response["success"]=1;
        $response["message"]="inserted !";
        echo json_encode($response);
        
    } else {
        $response["success"]=0;
        $response["message"]="request error !";
        echo json_encode($response);
    }

}

    

?>