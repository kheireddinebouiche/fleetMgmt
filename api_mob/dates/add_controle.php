<?php

include("../db_connect.php");
date_default_timezone_set('Africa/Algiers');

$response = array();

if(isset($_GET["id"]) && isset($_GET["date_controle"])){
    
    $id=$_GET["id"];
    
    $date_controle = $_GET["date_controle"];
    
    
    $sql = "UPDATE voitures SET date_controle='$date_controle' WHERE id='$id'";
    
    $etat="unread";
    
    $curdate = date('y-m-d h:i:s');
    $notif = mysqli_query($cnx,"INSERT INTO notifications (text, etat,created_at) VALUES ('Une nouvelle/modification de la date du controle technique à été enregistrer.','$etat','$curdate') ");
    
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