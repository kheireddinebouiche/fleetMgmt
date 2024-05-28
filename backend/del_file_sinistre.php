<?php
session_start();

require("getter/connect.php");


if(isset($_GET["id"])){
  
  
  $id = $_GET["id"];
  
  $find = mysqli_query($cnx,"SELECT id_sinistre FROM documents_sinistre WHERE id='$id' ");
  $result = mysqli_fetch_assoc($find);
  $id_sinistre = $result["id_sinistre"];
  
  $req = mysqli_query($cnx,"DELETE FROM documents_sinistre WHERE id='$id' ");
  
  if($req){
      
      $_SESSION["status"] ="Le document à été supprimé avec succès";
      $_SESSION["success"] = 1;
      
      header("Location:details_sinistre.php?id=$id_sinistre ");
      
  }else{
      
      
      $_SESSION["status"] ="Une erreur est survenue lors de l'execution de la requête.";
      $_SESSION["success"] = 0;
      
      header("Location:details_sinistre.php?id=$id_sinistre ");
      
  }
    
}


?>
