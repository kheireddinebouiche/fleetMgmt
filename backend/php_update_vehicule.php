<?php
session_start();
require("getter/connect.php");

date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');

$id=$_GET["id"];

if(!isset($_SESSION["id"])){
    header("Location:index.php");
}else{
    
    if(isset($_POST["update"])){
        
        $label = $_POST["label"];
        $motorisation  = $_POST["motorisation"];
        $marque = $_POST["marque"];
        $num_serie = $_POST["numero_serie"];
        $prem_ann = $_POST["prem_ann"];
        $anc_imm  = $_POST["anc_imm"];
        $carte_grise = $_POST["carte_grise"];
        $immatriculation = $_POST["num_immatriculation"];
        
        $assurance = $_POST["assurance"];
        $controle  = $_POST["control_technique"];
        $vignette = $_POST["vignette"];
        
        $update = mysqli_query($cnx, "UPDATE voitures SET date_assurance='$assurance' , date_vignette='$vignette' , date_controle='$controle' , motorisation='$motorisation', premiere_circulation='$prem_ann', ancien_imm='$anc_imm' , vehicule='$label', marque='$marque', num_immatriculation='$immatriculation', numero_serie='$num_serie', carte_grise='$carte_grise', updated_at='$curdate'  WHERE id = '$id '");
        
        if($update){
            
            $_SESSION["status"] = "Les modifications ont été enregistre avec succès";
            $_SESSION["success"]= "1";
            header("Location:update_voiture.php?id=$id");
            
        }else{
            
            $_SESSION["status"] = "Une erreur est survenue lors de l'execution de la requête.";
            $_SESSION["success"]= "0";
            header("Location:update_voiture.php?id=$id");
        }
        
        
    }
}



?>