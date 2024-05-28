<?php
include("../db_connect.php");

$response=array();

if(isset($_GET["id_vehicule"])){
    
    $id = $_GET["id_vehicule"];
    
    $req = mysqli_query($cnx, "SELECT * FROM maintenance WHERE id_vehicule='$id'");
    if(mysqli_num_rows($req) > 0){
        
        $tmp=array();
        $response["maintenances"]=array();
        
        while($cur=mysqli_fetch_array($req)){
            
            
            $id_v = $cur["id_vehicule"];
            $v = mysqli_query($cnx, "SELECT vehicule FROM voitures WHERE id='$id_v'");
            $cv = mysqli_fetch_assoc($v);
            
            $tmp["id"]=$cur["id"];
            $tmp["vehicule"]=$cv["vehicule"];
            $tmp["description"]=$cur["description"];
            $tmp["date_maintenance"] = $cur["date_maintenance"];
            $tmp["created_at"]=$cur["created_at"];
            
            array_push($response["maintenances"], $tmp);
        }
        
        $response["success"] = 1;
        echo json_encode($response);
    }
    
    else{
        
        $response["success"] = 0;
        $response["message"] = "Data not found";
        
        echo json_encode($response);
        
    }
    
}




?>