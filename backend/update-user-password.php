<?php
session_start();
require("getter/connect.php");

date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');

if(isset($_SESSION["id"])){
    if(isset($_GET["id"])){
    
    $id = $_GET["id"];
    
    $pass1 = $_POST["password1"];
    $pass2 = $_POST["password2"];
    
    
    if(strlen($pass1) > 0 or strlen($pass2) > 0){
        
        if($pass1 == $pass2){
            
            $req = mysqli_query($cnx,"UPDATE user set pass='$pass1', updated_at='$curdate' WHERE id='$id'  ");
            
            if($req){
                
                $_SESSION["status"] = "Les modifications ont été enregistrer avec succès.";
                $_SESSION["success"] = 1;
            
                header("Location:details_utilisateur.php?id=$id ");
                
            }else{
                
                $_SESSION["status"] = "Une erreur est survenue lors du traitement de la requête";
                $_SESSION["success"] = 0;
                
                header("Location:details_utilisateur.php?id=$id ");
            }
        
      }else{
            
            $_SESSION["status"] = "Les deux mots de passe sont différents.";
            $_SESSION["success"] = 0;
            
            header("Location:details_utilisateur.php?id=$id ");
            
        }
        
    }else{
        
        $_SESSION["status"] = "Tous les champs doivent être remplis.";
        $_SESSION["success"] = 0;
            
        header("Location:details_utilisateur.php?id=$id ");
        
    }
    
    
    
}
}else{
  
  header("Location:index.php");
    
}


?>