<?php
session_start();
require("check_session.php");
require("getter/connect.php");

if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){
    
    if(isset($_GET["id"])){
        
        $id = $_GET["id"];
        
        $req = mysqli_query($cnx, "DELETE notifications WHERE id='$id' ");
        
        if($req){
            
            $_SESSION["status"] = " La notification à été supprimer avec succès. ";
            $_SESSION["success"] = 1;
            
            header("Location:notification_list.php");
             
        }else{
            
            $_SESSION["status"] = " Une erreur est survenu lors de l'execution de la requête. ";
            $_SESSION["success"] = 0;
            
            header("Location:notification_list.php");
        }
        
    }else{
        
    }
    
    
}else{
    header("Location:index.php");
}


?>