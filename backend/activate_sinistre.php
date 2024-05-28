<?php
session_start();
require("getter/connect.php");

date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');


if(isset($_SESSION["id"])){
    
    if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){
    
    if(isset($_GET["id"])){
    
      $id=$_GET["id"];
      
      $req = mysqli_query($cnx,"UPDATE sinistres set etat='1', updated_at='$curdate'  WHERE id='$id'  ");
      
      
      if($req){
        
        $_SESSION["status"] = "Le dossier de sinistre est réactivé.";
        $_SESSION["success"] = 1;
          
        header("Location:list_sinistres.php");   
     }else{
         
        $_SESSION["status"] = "Une erreur est survenu lors du traitement de la requete.";
        $_SESSION["success"] = 0;
          
        header("Location:list_sinistres.php"); 
         
     }
    
 }
}else{
    
    header("Location:index.php");
    
}
    
}else{
    header("Location:index.php");
}





?>