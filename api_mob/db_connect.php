<?php
$db_name = "saldaesy_myauto";
$username = "saldaesy_auto";
$password = "HjuLp?VCde43";
$servername = "localhost";


$cnx = mysqli_connect($servername, $username, $password, $db_name);

if(!$cnx){
    
    echo "Erreur de connexion au serveur";
    
}


?>