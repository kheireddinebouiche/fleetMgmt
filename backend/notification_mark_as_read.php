<?php
session_start();
require("check_session.php");
require("getter/connect.php");

if(isset($_GET["id"])){
    
    $id = $_GET["id"];
    
    $req = mysqli_query($cnx, "UPDATE notifications SET etat='readed' WHERE id='$id'  ");
    
    if($req){
        
        $_SESSION["success"] = 1;
        $_SESSION["status"] = "Effectué avec succès.";
        
        header("Location:notification_list.php");
        
    }else{
        
        $_SESSION["success"] = 0;
        $_SESSION["status"] = "Une erreur est survenu lors du traitement de l'action.";
        
        header("Location:notification_list.php");
    }
    
    
}