<?php
  
session_start();

$id = $_REQUEST['id'];
  
// Database connection
require("getter/connect.php");
  
if ($id != " ") {
      
    $query = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_vehicule='$id' and mode='Definitif' ORDER BY id DESC LIMIT 1");
  
    $row = mysqli_fetch_array($query);
  
    if($row["km"]){
        
        $km = $row["km"];
        
    }else{
        
        $km= "Aucun enregistrement.";
    }
    
  
    
}
  
// Store it in a array
$result = array("$km");
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>