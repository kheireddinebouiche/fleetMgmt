<?php
session_start();
require("getter/connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');

if(isset($_SESSION["niveau"]) == 1 or isset($_SESSION["niveau"]) == 2 ){
    
    $id = $_GET["id"];
    
    $date_maintenance = $_POST["date_maintenance"];
    $description = $_POST["description"];
    $km = $_POST["km"];
    
    $req = mysqli_query($cnx, "UPDATE maintenance SET date_maintenance='$date_maintenance', description='$description', km='$km', updated_at='$curdate' WHERE id='$id'");
    
    if($req){
        
        $_SESSION["success"] = 1;
        $_SESSION["status"] = "Modification effectuer avec succès";
        
        header("Location:details_maintenance.php?id=$id");
        
    }else{
        
        $_SESSION["success"] = 0;
        $_SESSIOS["status"] = "Une erreur est survenu lors du traitement de la requête.";
        
        header("Location:details_maintenance.php?id=$id");
        
    }
    
    
}else{
    
    header("Location:index.php");
}

?>