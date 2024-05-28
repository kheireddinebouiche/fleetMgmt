<?php
session_start();
require("getter/connect.php");

if(isset($_SESSION["id"])){
    
    if(isset($_GET["id"])){
  
      $id = $_GET["id"];
      
      $find = mysqli_query($cnx, "SELECT * FROM documents_voiture WHERE id='$id'");
      $veh = mysqli_fetch_assoc($find);
      $id_vehicule = $veh["id_vehicule"];      

      $req = mysqli_query($cnx,"DELETE FROM documents_voiture WHERE id='$id' ");
      
      
      if($req){
          
          $_SESSION["status"] ="Le document à été supprimé avec succès";
          $_SESSION["success"] = 1;
          
          header("Location:details_voitures.php?id=$id_vehicule");
          
      }else{
          
          
          $_SESSION["status"] ="Une erreur est survenue lors de l'execution de la requête.";
          $_SESSION["success"] = 0;
          
          header("Location:details_voitures.php?id=$id_vehicule ");
          
  }
    
}
    
}else{
    header("Location:index.php");
    
}



?>
