<?php

require("../db_connect.php");

$response=array();

if(isset($_GET["id"])){
    
    $id= $_GET["id"];
    
    $req = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id='$id' ");
    
    if(mysqli_num_rows($req)>0){
        
        $tmp=array();
        
        $response["affectation"]=array();
        $cur=mysqli_fetch_array($req);
        
        $us = $cur["id_user"];
        $username = mysqli_query($cnx,"SELECT username FROM user WHERE id='$us'");
        $conducteur = mysqli_fetch_assoc($username);
        
        $vi = $cur["id_vehicule"];
        $vehi = mysqli_query($cnx,"SELECT vehicule FROM voitures WHERE id='$vi'");
        $label = mysqli_fetch_assoc($vehi);
        
        $tmp["id"]=$cur["id"];
        
        $tmp["id_vehicule"] = $label["vehicule"];
        $tmp["id_user"] = $conducteur["username"];
        
        $tmp["identifiant_vehicule"] = $cur["id_vehicule"];
        $tmp["identifiant_user"] = $cur["id_user"];
        
        $tmp["date_debut"] = $cur["date_debut"];
        $tmp["date_fin"] = $cur["date_fin"];
        $tmp["mode"] = $cur["mode"];
        $tmp["km"] = $cur["km"];
        $tmp["observation"] = $cur["observation"];
        $tmp["created_at"] = $cur["created_at"];
        $tmp["updated_at"] = $cur["updated_at"];
        
        
        array_push($response["affectation"], $tmp);
        
        $response["success"] = 1;
        echo json_encode($response);
        
    }else{
        
        $response["success"] = 0;
        $response["message"] = "No data found";
        echo json_encode($response);
    }
    
    
}else{
    
    $response["success"] = 0;
    $response["message"] = "required field is missing";
    echo json_encode($response);
    
}


?>