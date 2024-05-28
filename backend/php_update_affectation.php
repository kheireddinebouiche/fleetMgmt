<?php
session_start();
require("getter/connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');

if(isset($_SESSION["id"])){
    if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){
      
      $id = $_GET["id"];
      
      $h_debut = $_POST["h_debut"];
      $h_fin = $_POST["h_fin"];
      $date_debut = $_POST["date_debut"];
      $date_fin = $_POST["date_fin"];
      $observation = $_POST["observation"];
      
      $req = mysqli_query($cnx, "UPDATE suivie_affectation SET h_debut='$h_debut', h_fin='$h_fin', date_debut='$date_debut', date_fin='$date_fin', observation='$observation' WHERE id='$id'  ");
      $notif= mysqli_query($cnx, "INSERT INTO notifications (id_user, titre, contenu, created_at, etat) VALUES ('','Affectation','Votre emprunt à été modifier','$curdate','unread')");
      
      if($req){
          
          $_SESSION["status"] = "Modification effectuer avec succès";
          $_SESSION["success"] = 1;
          
          header("Location:details_affectation.php?id=$id");
          
      }else{
          
          $_SESSION["status"] = "Une erreur est survenu lors du traitement de la requete.";
          $_SESSION["success"] = 0;
          
          header("Location:details_affectation.php?id=$id");
      }
        
    }else{
        
        header("Location:index.php");
    }
    
}else{
    header("Location:index.php");
}