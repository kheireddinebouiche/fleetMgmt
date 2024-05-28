<?php
$db_name = "esclabdz_myauto";
$username = "esclabdz_auto";
$password = "HjuLp?VCde43";
$servername = "localhost";


$cnx = mysqli_connect($servername, $username, $password, $db_name);

if(!$cnx){
    
    echo "Erreur de connexion au serveur";
    
}


?>