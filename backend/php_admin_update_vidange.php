<?php
session_start();
require("getter/connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');


if(isset($_SESSION["id"])){
  if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){
      
      $id = $_GET["id"];
      
      $filtre_huile = $_POST["filtre_huile1"];
      $filtre_es_gas = $_POST["filtre_es_gas1"];
      $filtre_aire = $_POST["filtre_aire1"];
      
      $actual_km = $_POST["actual_km1"];
      $autre = $_POST["autre1"];
      
      $req = mysqli_query($cnx,"UPDATE vidanges SET actual_km='$actual_km', filtre_huile='$filtre_huile', filtre_es_gas='$filtre_es_gas', autre='$autre', filtre_aire='$filtre_aire', updated_at='$curdate' WHERE id='$id'");
      
      if($req){
          
          $_SESSION["status"] = "Les informations ont été modifier avec succès.";
          $_SESSION["success"]  = 1;
          
          header("Location:details_vidange.php?id=$id");
          
      }else{
          
          $_SESSION["status"] = "Une erreur est survenu lors du traitement de la requete.";
          $_SESSION["success"]  = 0;
          
          header("Location:details_vidange.php?id=$id");
      }
      
  }else{
      header("Location:index.php");
  }
}else{
    header("Location:index.php");
}

?>