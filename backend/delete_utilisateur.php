<?php
session_start();
require("check_session.php");
require("getter/connect.php");

if(isset($_GET["id"])){
    
  $id = $_GET["id"];
  
  $req = mysqli_query($cnx, "DELETE FROM user WHERE id='$id' ");
  
  
  if($req){
      
      $_SESSION["status"] = "Utilisateur supprimé avec succès";
      header("Location:list-utilisateurs.php");
      
      
  }else{
   
       $_SESSION["status"] = "Une erreur est survenue lors de l'execution de la requête";
      header("Location:list-utilisateurs.php");
      
  }
  
}

?>