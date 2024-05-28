<?php
require("../db_connect.php");
date_default_timezone_set('Africa/Algiers');

$response=array();

if (isset($_GET["id"])){
    
    $id=$_GET["id"];
    $vehicule = $_GET["vehicule"];
    $puissance =$_GET["puissance"];
    $marque  = $_GET["marque"];
    $numero_serie = $_GET["numero_serie"];
    $carte_grise = $_GET["carte_grise"];
    $immatriculation = $_GET["immatriculation"];
    $motorisation = $_GET["motorisation"];
    
    
    $curdate = date('y-m-d h:i:s');
    
    
    $req = mysqli_query($cnx, 
        "UPDATE voitures SET vehicule='$vehicule',num_immatriculation='$immatriculation', motorisation='$motorisation' , marque='$marque', puissance='$puissance', numero_serie='$numero_serie', carte_grise='$carte_grise',updated_at='$curdate' WHERE id='$id'"
        );
        
    if($req){
        $response["success"]=1;
        $response["message"]="updated successfully !";
        
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