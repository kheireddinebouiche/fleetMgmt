<?php

require("../db_connect.php");

$response=array();

if(isset($_GET["id"])){
    
    $id= $_GET["id"];
    
    
    $req = mysqli_query($cnx, "SELECT * FROM maintenance WHERE id='$id' ");
    
    if(mysqli_num_rows($req)>0){
        
        $tmp=array();
        
        $response["maintenance"]=array();
        $cur=mysqli_fetch_array($req);
        
        $id_user=$cur["id_user"];
        $name_query = mysqli_query($cnx, "SELECT username FROM user WHERE id='$id_user'");
        $username = mysqli_fetch_assoc($name_query);
        
        $id_voiture=$cur["id_vehicule"];
        $vehicule_query = mysqli_query($cnx, "SELECT vehicule FROM voitures WHERE id='$id_voiture'");
        $vehicule = mysqli_fetch_assoc($vehicule_query);
        
        $tmp["id"]=$cur["id"];
        
        $tmp["id_vehicule"]=$cur["id_vehicule"];
        
        $tmp["id_user"] = $cur["id_user"];
        $tmp["username"] = $username["username"];
        
        $tmp["vehicule"] = $vehicule["vehicule"];
        
        $tmp["date_maintenance"] = $cur["date_maintenance"];
        $tmp["description"] = $cur["description"];
        $tmp["motifs_maintenance"] = $cur["motifs_maintenance"];
        
        $tmp["created_at"] = $cur["created_at"];
        $tmp["updated_at"]=$cur["updated_at"];
        
        
        
        array_push($response["maintenance"], $tmp);
        
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