<?php
session_start();
require("getter/connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');

if(isset($_SESSION["id"])){
    if(isset($_GET["id"])){
    
    $id_vehicule = $_GET["id"];
    
    $date_debut = $_POST["date_debut"];
    $date_fin = $_POST["date_fin"];
    $id_future_conducteur = $_POST["next_user"];
    
    $id_owner = $_SESSION["id"];
    
    $find_owner_affect = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_user='$id_future_conducteur'");
    $roa = mysqli_fetch_assoc($find_owner_affect);
    
    $find_affectation_of_next = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_user='$id_future_conducteur' and etat='en cours' and mode='Definitif'");
    $res1 = mysqli_fetch_assoc($find_affectation_of_next);
    $id_aff_of_next = $res1["id"];
    
    if($date_debut <= $date_fin){
        
        if(mysqli_num_rows($find_owner_affect) > 0){
        
            if(mysqli_num_rows($find_affectation_of_next) > 0 ){
                
                $upd_owner = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='Pause' WHERE id_user='$id_owner' and etat='en cours' and mode='Definitif' ");
                
                $upd_future = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='Pause' WHERE id_user='$id_future_conducteur' and etat='en cours' and mode='Definitif'");
                
                $new = mysqli_query($cnx,"INSERT INTO suivie_affectation(id_user,id_vehicule,date_debut,date_fin,mode,created_at,etat) 
                                                                VALUES ('$id_future_conducteur','$id_vehicule','$date_debut','$date_fin','Temporaire','$curdate','en cours' ) ");
                
                $notif561 = mysqli_query($cnx,"INSERT INTO notifications (titre,contenu,created_at,id_user,etat)
                                                                VALUES ('Affectation','Votre emprunt vient de débuter', '$curdate','$id_future_conducteur','unread')");
                                                                
                $notif2456 = mysqli_query($cnx,"INSERT INTO notifications (titre,contenu,created_at,id_user,etat) 
                                                                VALUES ('Affectation','Votre emprunt vient de se mettre en pause','$curdate', '$id_owner','unread')");
                                                                
                $notif34567 = mysqli_query($cnx,"INSERT INTO notifications (titre,contenu,created_at,id_user,etat) 
                                                                VALUES ('Affectation','Utilisation de votre véhicule en pause','$curdate', '$id_future_conducteur','unread')");
                
                if($upd_future and $upd_owner and $new){
                    
                    $_SESSION["status"]="Succès 1";
                    $_SESSION["success"] = 1;
                    
                    header("Location:mon_affectation.php");
                
                }else{
                    
                    $_SESSION["status"]="Une erreur est survenu lors du traitement de la requête.";
                    $_SESSION["success"] = 0;
                    
                    header("Location:mon_affectation.php");
                    
                }
                
            }else{
                
                if($roa["etat"] == "en cours" and $roa["mode"] == "Temporaire"){
                    
                    $_SESSION["status"]="L'utilisateur dispose déja d'une affectation en cours.";
                    $_SESSION["success"] = 0;
                    
                    header("Location:mon_affectation.php");
                    
                }else{
                    
                    $upd_owner = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='Pause' WHERE id_user='$id_owner' and etat='en cours' and mode='Definitif'");
                    
                    $new = mysqli_query($cnx,"INSERT INTO suivie_affectation(id_user,id_vehicule,date_debut,date_fin,mode,created_at,etat) 
                                                                VALUES ('$id_future_conducteur','$id_vehicule','$date_debut','$date_fin','Temporaire','$curdate','en cours') ");
                                                                
                    $notif103 = mysqli_query($cnx,"INSERT INTO notifications (titre,contenu,created_at,id_user,etat)
                                                                VALUES ('Affectation','Votre emprunt vient de débuter','$curdate', '$id_future_conducteur','unread')");
                                                                
                    $notif203 = mysqli_query($cnx,"INSERT INTO notifications (titre,contenu,created_at,id_user,etat) 
                                                                VALUES ('Affectation','Votre emprunt vient de se mettre en pause','$curdate', '$id_owner','unread')");
                                    
                    
                    
                    if($upd_owner and $new ){
                        
                        $_SESSION["status"]="Succès";
                        $_SESSION["success"] = 1;
                        
                        header("Location:mon_affectation.php");
                        
                    }else{
                        
                        $_SESSION["status"]="Une erreur est survenu lors du traitement de la requête.";
                        $_SESSION["success"] = 0;
                        
                        header("Location:mon_affectation.php");
                    }
                }
                
             }
        
        
        }else{
            
            $upd_owner = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='Pause' WHERE id_user='$id_owner' and etat='en cours' and mode='Definitif'");
                    
            $new = mysqli_query($cnx,"INSERT INTO suivie_affectation(id_user,id_vehicule,date_debut,date_fin,mode,created_at,etat) 
                                                                VALUES ('$id_future_conducteur','$id_vehicule','$date_debut','$date_fin','Temporaire','$curdate','en cours' ) ");
                                                                
            $notif189 = mysqli_query($cnx,"INSERT INTO notifications (titre,contenu,created_at,id_user,etat)
                                                                VALUES ('Affectation','Votre emprunt vient de débuter','$curdate', '$id_future_conducteur','unread')");
                                                                
            $notif20964 = mysqli_query($cnx,"INSERT INTO notifications (titre,contenu,created_at,id_user,etat) 
                                                                VALUES ('Affectation','Votre emprunt vient de se mettre en pause','$curdate', '$id_owner','unread')");
                    
                    
            if($upd_owner and $new){
                        
                $_SESSION["status"]="Succès 3";
                $_SESSION["success"] = 1;
                        
                header("Location:mon_affectation.php");
                        
            }else{
                        
                $_SESSION["status"]="Une erreur est survenu lors du traitement de la requête.";
                $_SESSION["success"] = 0;
                        
                header("Location:mon_affectation.php");
            }
        }
        
        
    }else{
        
        $_SESSION["status"] = "La date de début ne peut pas étre supérieur a la date de fin d'emprunt.";
        $_SESSION["success"] = 0;
        
        header("Location:mon_affectation.php");
        
    }
    
}else{
    
    $_SESSION["status"] = "Une erreur c'est produite lors du traitement de la requête 3";
    $_SESSION["success"] = 0;
    
    header("Location:mon_affectation.php");
    
}
}else{
    header("Location:index.php");
}

?>
