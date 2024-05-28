<?php

session_start();
require("getter/connect.php");


if(isset($_GET["id"])){
    
  $id=$_GET["id"];    
    
  $delete = mysqli_query($cnx, "DELETE FROM voitures WHERE id='$id' ");
  
  if($delete){
      
       $_SESSION["status"] = "La suppréssion à été effectuer avec succès";
       $_SESSION["success"]= "1";
       header("Location:list-vehicules.php");
      
  }else{
      
       $_SESSION["status"] = "Une erreur est survenue lors de l'execution de la requête.";
       $_SESSION["success"]= "0";
       header("Location:list-vehicules.php");
      
  }
}


?>