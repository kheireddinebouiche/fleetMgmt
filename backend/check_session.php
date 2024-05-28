<?php
session_start();

if(!isset($_SESSION["name"]) and !isset($_SESSION["niveau"])){
     
    header("Location:../index.php");
  
}

?>

