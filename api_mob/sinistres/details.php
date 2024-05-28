<?php

require_once("../db_connect.php");

$response=array();

if(isset($_GET["id"])){
    
    $id= $_GET["id"];
    
    $req = mysqli_query($cnx, "SELECT * FROM sinistres WHERE id='$id' ");

    
    if(mysqli_num_rows($req)>0){
        
        $tmp=array();
        
        
        
        $response["sinistre"]=array();
        $cur=mysqli_fetch_array($req);
        
        $vehicule=$cur["id_voiture"];
        $username = $cur["id_user"];
        $conducteur = $cur["conducteur"];
        
        $re = mysqli_query($cnx, "SELECT  * FROM voitures WHERE id='$vehicule'");
        $f = mysqli_fetch_array($re);
        
        $xc = mysqli_query($cnx,"SELECT * FROM user WHERE id='$username'");
        $qs = mysqli_fetch_assoc($xc);
        
        $fs = mysqli_query($cnx,"SELECT * FROM user WHERE id='$conducteur'");
        $jk = mysqli_fetch_assoc($fs);
        
        
        $tmp["id"]=$cur["id"];
        $tmp["id_voiture"]=$f["vehicule"];
        $tmp["num_dossier"]= $cur["num_dossier"];
        $tmp["conducteur"] = $jk["username"];
        $tmp["id_conduct"] = $jk["id"];
        $tmp["identifiant_vehicule"] = $f["id"];
        $tmp["date_sinistre"]=$cur["date_sinistre"];
        $tmp["description"] = $cur["description"];
        $tmp["created_at"] = $cur["created_at"];
        $tmp["updated_at"] = $cur["updated_at"];
        $tmp["lieu"] = $cur["lieu"];
        $tmp["etat"] = $cur["etat"];
        $tmp["created_by"]= $qs["username"];
        
        array_push($response["sinistre"], $tmp);
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