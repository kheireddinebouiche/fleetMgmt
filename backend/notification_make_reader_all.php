<?php
session_start();
require("check_session.php");
require("getter/connect.php");

if(isset($_SESSION["id"])){
    
    $user_id = $_SESSION["id"];
    
    $req = mysqli_query($cnx, "UPDATE notifications SET etat='readed' WHERE id_user='$user_id' and etat='unread'   ");
    
    if($req){
        
       $_SESSION["status"] = "Les notifications ont été supprimer avec succès.";
       $_SESSION["success"] = 1;
                      
       header("Location:index.php");
        
    }else{
        
       $_SESSION["status"] = "Une erreur est survenu lors du traitement de la requête.";
       $_SESSION["success"] = 0;
                      
       header("Location:index.php");
    }
    
    
}else{
    header("Location:index.php");
}

?>