<?php
session_start();

if(isset($_POST["disconnect"])){
    
   session_destroy();
   
   header("Location:../index.php");
    
}

?>