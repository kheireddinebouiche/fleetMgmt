<?php
session_start();
require("getter/connect.php");


if(isset($_SESSION["id"]) and isset($_GET["id"])){
    
    $id_affec = $_GET["id"];
    
    $req = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id='$id_affec' ");
    $result = mysqli_fetch_assoc($req);
    
    $id_user = $result["id_user"];
    $id_vehicule = $result["id_vehicule"];
    $mode = $result["mode"];
    $etat=$result["etat"];
    
    if($mode == "Temporaire"){
        
        $req1 = mysqli_query($cnx,"SELECT * FROM suivie_affectation WHERE id_vehicule='$id_vehicule' and etat='Pause' and mode='Definitif' ");
        $res1 = mysqli_fetch_assoc($req1);
        $id = $res1["id"];
        
        if(mysqli_num_rows($req1)>0){
            
            $req2 = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='en cours' WHERE id='$id'  ");
            $req3 = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='annulé' WHERE id='$id_affec' ");
            
            if($req2 and $req3){
                
                $_SESSION["status"]="Succès.";
                $_SESSION["success"] = 1;
                
                header("Location:list_affectations.php");
                
            }else{
                
                $_SESSION["status"]="Erreur.";
                $_SESSION["success"] = 0;
                
                header("Location:list_affectations.php");
            }
            
        }else{
            
            $req3 = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='annulé' WHERE id='$id_affec' ");
            
            if($req3){
                
                $_SESSION["status"]="Succès.";
                $_SESSION["success"] = 1;
                
                header("Location:list_affectations.php");
                
            }else{
                
                $_SESSION["status"]="Erreur.";
                $_SESSION["success"] = 0;
                
                header("Location:list_affectations.php");
            }
            
        }
        
    }else{
        
        if($mode == "Definitif"){
            
            $req3 = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='annulé' WHERE id='$id_affec' ");
            
            if($req3){
                
                $_SESSION["status"]="Succès.";
                $_SESSION["success"] = 1;
                
                header("Location:list_affectations.php");
                
            }else{
                
                $_SESSION["status"]="Erreur.";
                $_SESSION["success"] = 0;
                
                header("Location:list_affectations.php");
            }
            
        }else{
            
            $_SESSION["status"]="Erreur.";
            $_SESSION["success"] = 0;
                
            header("Location:list_affectations.php");
            
        }
        
    }
    
    
}else{
    
    
    header("Location:index.php");
}