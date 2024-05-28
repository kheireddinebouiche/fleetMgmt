<?php
session_start();
require("getter/connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');


$id_user = $_SESSION["id"];

if(isset($_SESSION["id"])){
    
    $id_vehicule = $_GET["id"];
    $prev_km = $_POST["prev_km"];
    $reel_km = $_POST["new_km_chaine"];
    $date_maintenance = date('y-m-d');
    
    
    $req = mysqli_query($cnx, "INSERT INTO maintenance (id_user, created_at, id_vehicule, km, motifs_maintenance,etat, date_maintenance) 
                               VALUES ('$id_user','$curdate','$id_vehicule', '$reel_km','Changement de chaine de distribution','1','$date_maintenance')");
    
    $ki = intval($reel_km) + 80000;
    
    $upd_ges_chaine = mysqli_query($cnx,"UPDATE ges_chaine SET km='$reel_km', km_change='$ki' WHERE id_vehicule='$id_vehicule' ");
    
    if($req){
        
        $_SESSION["status"] ="Opération réussi avec succès";
        $_SESSION["success"]= 1;
        
        header("Location:mon_affectation.php");
        
    }else{
        
        $_SESSION["status"] ="Une erreur c'est produite lors du traitement de votre requête.";
        $_SESSION["success"]= 0;
        
        header("Location:mon_affectation.php");
        
    }
    
    
}else{
    
    header("Location:index.php");
}