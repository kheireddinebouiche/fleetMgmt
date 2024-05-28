<?php
session_start();
require("getter/connect.php");


if(isset($_SESSION["id"])){
    
    if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){
        
        if(isset($_GET["id"])){
    
            
            $id=$_GET["id"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $identification = $_POST["identification"];
            $num_permis = $_POST["num_permis"];
            $mobile = $_POST["num_telephone"];
            
            
            $req = mysqli_query($cnx, "UPDATE user SET username='$username', email='$email' , identification='$identification', num_permis='$num_permis', mobile='$mobile' WHERE id='$id' " );
    
            if($req){
                
                $_SESSION["status"] = "Les modifications ont été effectuer avec succès.";
                $_SESSION["success"] = 1;
                
                header("Location:mon_compte.php");
                
            }else{
                
                $_SESSION["status"] = "Une erreur est survenu lors du traitement de la requête.";
                $_SESSION["success"] = 0;
                
                header("Location:mon_compte.php");
            }
    
        }
        
    }else{
        header("Location:index.php");
    }
    
}else{
    
    header("Location:index.php");
}

?>