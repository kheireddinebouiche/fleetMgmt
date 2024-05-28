<?php
session_start();
require("getter/connect.php");


if(isset($_SESSION["id"])){
    
    if($_SESSION["niveau"] = 1 or $_SESSION["niveau"] == 2){
        
        $id_user = $_GET["id"];
        $page = $_GET["p"];
        
        $req = mysqli_query($cnx,"UPDATE user SET etat='0' WHERE id='$id_user' ");
        
        if($req){
            
            $_SESSION["status"]="Le profile de l'utilisateur est désactivé.";
            $_SESSION["success"] = 1;
            
            if($page==1){
                
                header("Location:list-utilisateurs.php");
                
            }else{
              
              if ($page == 2) {
                
                header("Location:details_utilisateur.php?id=$id_user");
                
              }
            }
            
            
        }else{
            
            $_SESSION["status"]="Une erreur est survenu lors du traitement de la requête.";
            $_SESSION["success"] = 0;
            
            header("Location:list-utilisateurs.php");
            
        }
        
    }else{
        
        header("Location:index.php");
    }
    
}else{
    header("Location:index.php");
}


?>