<?php
require("../db_connect.php");

$response=array();

$req = mysqli_query($cnx, "SELECT * FROM sinistres WHERE etat='0'");
if(mysqli_num_rows($req) > 0){
    
    $tmp=array();
    $response["results"]=array();
    
    while($cur=mysqli_fetch_array($req)){
        
        $vehicule=$cur["id_voiture"];
        
        $re = mysqli_query($cnx, "SELECT  * FROM voitures WHERE id='$vehicule'");
        $f = mysqli_fetch_array($re);
        
        $tmp["id"] = $cur["id"];
        $tmp["id_voiture"]=$f["vehicule"];
        $tmp["date_sinistre"]=$cur["date_sinistre"];
        $tmp["num_dossier"] = $cur["num_dossier"];
      
        
        array_push($response["results"], $tmp);
    }
    
    $response["success"] = 1;
    echo json_encode($response);
}

else{
    
    $response["success"] = 0;
    $response["message"] = "Data not found";
    
    echo json_encode($response);
    
}



?>