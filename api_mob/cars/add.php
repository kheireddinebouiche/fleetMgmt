<?php
require("../db_connect.php");
date_default_timezone_set('Africa/Algiers');

$response = array();

if(isset($_GET["vehicule"]) && isset($_GET["numero_serie"]) && isset($_GET["carte_grise"])){
    
   
    $vehicule = $_GET["vehicule"];
    $marque = $_GET["marque"];
    $carte_grise = $_GET["carte_grise"];
    $numeroserie = $_GET["numero_serie"];
    $puissance = $_GET["puissance"];
    $user_id = $_GET["user_id"];
    $immatriculation = $_GET["immatriculation"];
    $motorisation = $_GET["motorisation"];
    
    $curdate = date('y-m-d h:i:s');
    
    $sql = "INSERT INTO voitures (vehicule, marque, carte_grise, numero_serie, puissance, user_id,num_immatriculation,motorisation ,state ,created_at) 
                       VALUES('$vehicule','$marque','$carte_grise','$numeroserie','$puissance','$user_id','$immatriculation','$motorisation','2','$curdate')";
    
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