<?php
require("../db_connect.php");

$response=array();

$req = mysqli_query($cnx, "SELECT * FROM voitures");

if(mysqli_num_rows($req) > 0){
    
    $tmp=array();
    $response["cars"]=array();
    
    while($cur=mysqli_fetch_array($req)){
        
        $tmp["id"] = $cur["id"];
        $tmp["vehicule"]=$cur["vehicule"];
        $tmp["dernier_km"] = $cur["dernier_km"];
       
        array_push($response["cars"], $tmp);
    }
    
    $response["success"] = 1;
    echo json_encode($response);
}

else{
    
    $response["success"] = 0;
    $response["message"] = "Data not found";
    
    echo json_encode($response);
    
}



?>