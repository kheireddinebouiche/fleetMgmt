<?php
session_start();
require("getter/connect.php");

$id_user = $_SESSION["id"];

$req = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_user='$id_user' and etat='en cours' ");
$result = mysqli_fetch_assoc($req);

$id_vehicule = $result["id_vehicule"];

$find = mysqli_query($cnx, "SELECT * FROM ges_chaine WHERE id_vehicule='$id_vehicule' ");
$rs = mysqli_fetch_assoc($find);

$change= $rs["km_change"];

$j = intval($rs["km_change"]) - intval($rs["km"]);


if($j < 8000 ){
    
    echo "<p>Un remplacement de la chaine de distribution est à prévoir avant : <b> $change km </b> </p>
          
          <center><a href='' class='btn btn-danger mt-1' data-bs-toggle='modal' data-bs-target='#check-chaine-modal' >Effectuer</a></center>
        
         ";
    
}else{
    
    
        
    echo "<p>Aucune maintenance n'est à prévoir pour le moment. </p>";
        
    
    
    
}


?>





