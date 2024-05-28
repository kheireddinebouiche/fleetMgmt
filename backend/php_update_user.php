<?php
session_start();
require("getter/connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');

if(isset($_GET["id"]) and isset($_POST["update"])){

  $id = $_GET["id"];
  
  $username = $_POST["username"];
  $email = $_POST["email"];
  $permis = $_POST["num_permis"];
  $identification = $_POST["num_identification"];
  $contact = $_POST["num_contact"];
  $niveau = $_POST["niveau"];
 
  
  $update = mysqli_query($cnx,"UPDATE user set email='$email', username='$username',mobile='$contact' , niveau='$niveau', num_permis='$permis', identification='$identification', updated_at='$curdate' WHERE id='$id' ");
  
  if($update){
      
      $_SESSION["status"] ="Les informations de l'utilisateur ont été mis à jours avec succès";
      $_SESSION["success"] = "1";
      header("Location:update_utilisateur.php?id=$id");
      
  }else{
      
      $_SESSION["status"] ="Une erreur est survenue lors du traitement de la requête.";
      $_SESSION["success"] = "0";
      header("Location:update_utilisateur.php?id=$id");
      
  }
    
    
}