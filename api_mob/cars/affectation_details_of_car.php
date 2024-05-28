<?php

include("../db_connect.php");

$response=array();

if(isset($_GET["id"])){
    
    $id= $_GET["id"];
    $id_poss = $_GET["id_possedeur"];
    
    $curent = "en cours";
    $pause = "Pause";
    
    $req = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_user='$id_poss' and id_vehicule='$id' and etat='$curent' or id_user='$id_poss' and id_vehicule='$id' and etat='$pause'");
    
    if(mysqli_num_rows($req)>0){
        
        $tmp=array();
        
        $response["result"]=array();
        $cur=mysqli_fetch_array($req);
        
        $tmp["id"]=$cur["id"];
        $tmp["date_debut"]=$cur["date_debut"];
        $tmp["date_fin"]=$cur["date_fin"];
        $tmp["mode"] = $cur["mode"];
        $tmp["km"] = $cur["km"];
  
        
        array_push($response["result"], $tmp);
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