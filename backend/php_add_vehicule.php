<?php
session_start();
require("getter/connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');

if($_SESSION["niveau"] == 1 or $_SESSION["niveau"]== 2){
    
    $label = $_POST["label"];
    $marque = $_POST["marque"];
    $numero_serie = $_POST["numero_serie"];
    $immatriculation = $_POST["num_immatriculation"];
    $motorisation = $_POST["motorisation"];
    $carte_grise = $_POST["carte_grise"];
    $prem_ann = $_POST["prem_ann"];
    $anc_imm = $_POST["anc_imm"];
    $assurance = $_POST["assurance"];
    $control = $_POST["control_technique"];
    $vignette = $_POST["vignette"];
    
    
    $search_vehicule = mysqli_query($cnx,"SELECT * FROM voitures WHERE num_immatriculation='$immatriculation' ");
    
    if(mysqli_num_rows($search_vehicule) > 0 ){
        
        $_SESSION["status"] = "Vous avez déja enregistrer un véhicule sous la même immatriculationù.";
        $_SESSION["success"] = 0;
        
        header("Location:ajouter-vehicule.php");
        
    }else{
        
        $insert = mysqli_query($cnx,"INSERT INTO voitures (created_at,vehicule,marque,carte_grise,numero_serie,num_immatriculation,motorisation,premiere_circulation,ancien_imm, date_assurance, date_controle, date_vignette) 
                                         VALUES ('$curdate','$label','$marque','$carte_grise','$numero_serie','$immatriculation','$motorisation','$prem_ann','$anc_imm','$assurance','$control','$vignette') ");
        
        if($insert){
            
            $_SESSION["status"] = "Ajouter avec succès";
            $_SESSION["success"] = 1;
            
            header("Location:list-vehicules.php");
            
        }else{
            
            $_SESSION["status"] = "Une erreur c'est produite lors du traitement de la requête.";
            $_SESSION["success"] = 0;
            
            header("Location:ajouter-vehicule.php");
        }
        
    }
    
}else{
    
    header("Location:index.php");
}



?>