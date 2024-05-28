<?php
session_start();
require("getter/connect.php");

if(isset($_SESSION["id"])){
    
    if(isset($_POST["save"])){
        
        
        $date = $_POST["date"];
        $motif = $_POST["motif"];
        $vehicule = $_POST["vehicule"];
        $description = $_POST["description"];
        
        $req = mysqli_query($cnx,"INSERT INTO maintenance (date_maintenance, motifs_maintenance, description, etat) 
                              VALUES ('$date','$motif','$vehicule','$description','$etat')");
        
    }else{
        $_SESSION["status"] = "Une erreur est survenue lors du traitement de votre requete.";
        $_SESSION["success"] = 0;
        
        header("Location:list_affectations.php");
    }
    
}else{
    
    header("Location:index.php");
}

?>