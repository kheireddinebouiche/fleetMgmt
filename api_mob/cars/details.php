<?php

require("../db_connect.php");

$response=array();

if(isset($_GET["id"])){
    
    $id= $_GET["id"];
    
    $req = mysqli_query($cnx, "SELECT * FROM voitures WHERE id='$id' ");
    
    if(mysqli_num_rows($req)>0){
        
        $tmp=array();
        
        $response["car"]=array();
        $cur=mysqli_fetch_array($req);
        
        $tmp["id"]=$cur["id"];
        $tmp["vehicule"]=$cur["vehicule"];
        $tmp["marque"]=$cur["marque"];
        $tmp["numero_serie"]=$cur["numero_serie"];
        $tmp["carte_grise"]=$cur["carte_grise"];
        $tmp["created_at"]=$cur["created_at"];
        $tmp["puissance"] = $cur["puissance"];
        $tmp["date_assurance"] = $cur["date_assurance"];
        $tmp["date_controle"] = $cur["date_controle"];
        $tmp["date_vignette"] = $cur["date_vignette"];
        $tmp["updated_at"]=$cur["updated_at"];
        $tmp["last_connexion"]=$cur["last_connexion"];
        $tmp["state"] = $cur["state"];
        $tmp["motorisation"] = $cur["motorisation"];
        $tmp["immatriculation"] = $cur["num_immatriculation"];
        
        array_push($response["car"], $tmp);
        
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