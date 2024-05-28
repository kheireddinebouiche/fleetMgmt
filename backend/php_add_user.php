<?php
session_start();
require("getter/connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');


if($_SESSION["id"]){
    
    if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){
        
        if(isset($_POST["submit"])){
    
            $username = $_POST["username"];
            $email = $_POST["email"];
            $niveau = $_POST["niveau"];
            $passe = $_POST["passe"];
            $contact = $_POST["num_contact"];
            $permis  = $_POST["num_permis"];
            $identification = $_POST["num_identification"];

            
            $req = mysqli_query($cnx, "INSERT INTO user (etat,email, username, niveau, pass, num_permis, identification, mobile, created_at) 
                                        VALUES ('1','$email','$username','$niveau','$passe','$permis','$identification','$contact','$curdate' )");
                                        
                                        
            if($req){
                
              $_SESSION['status'] = "Utilisateur ajouter avec succès";
              $_SESSION['success'] = 1;
              
              header("Location:list-utilisateurs.php");  
              
            }else{
                
              $_SESSION['status'] = "Erreur"; 
              $_SESSION['success'] = 0;
              header("Location:ajouter-utilisateur.php");
                
            }
    
}

        }else{
          
          header("Location:index.php");
          
        }
    
}else{
     header("Location:index.php");
}


?>