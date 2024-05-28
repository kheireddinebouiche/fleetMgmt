<?php
session_start();
require("getter/connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');

if($_SESSION["id"]){
    
    if(isset($_GET["id"])){
        
    
        $id_user= $_SESSION["id"];
        
        $id_vehicule = $_GET["id"];
        
        $new_km = $_POST["new_km"];
        $prev_km = $_POST["kilometrage"];
        
        $filtre_huile = $_POST["filtre_huile"];
        $filtre_es_gas = $_POST["filtre_es_gas"];
        $filtre_aire = $_POST["filtre_aire"];
        $autre = $_POST["autre"];
        
        $futur_km = intval($new_km) + 10000;
        
        
        $upd_vid = mysqli_query($cnx,"UPDATE vidanges SET filtre_huile='$filtre_huile', filtre_es_gas='$filtre_es_gas', filtre_aire='$filtre_aire', autre='$autre', id_user='$id_user', etat='0', actual_km='$new_km', updated_at='$curdate', date='$curdate' WHERE id_vehicule='$id_vehicule' and etat='1'  ");
        $new_vid = mysqli_query($cnx,"INSERT INTO vidanges (id_user,id_vehicule, created_at, km,futur_km,etat, indice) VALUES ('$id_user','$id_vehicule','$curdate','$new_km','$futur_km','1', '0') ");
        
        $upd_ges_chaine = mysqli_query($cnx,"UPDATE ges_chaine SET km='$new_km' WHERE id_vehicule='$id_vehicule' ");
        
        if($upd_vid and $new_vid){
            
            $_SESSION["status"] = "Opération réussi";
            $_SESSION["success"] = 1;
            
            header("Location:mon_affectation.php");
            
        }else{
            
            $_SESSION["status"] = "Une erreur est survenu lors du traitement de la requête";
            $_SESSION["success"] = 0;
            
            header("Location:mon_affectation.php");
            
        }
        
    }
    
}else{

       $_SESSION["status"] = "Une erreur est survenu lors du traitement de la requête.2";
       $_SESSION["success"] = 0;
        
       header("Location:mon_affectation.php");
    
}
    

?>