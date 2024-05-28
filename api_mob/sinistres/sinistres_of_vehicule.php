<?php
require("../db_connect.php");

$response=array();



if(isset($_GET["id"])){
    
    
    $id = $_GET["id"];
    
    $req = mysqli_query($cnx, "SELECT * FROM sinistres where id_voiture='$id'");
    
    if(mysqli_num_rows($req) > 0){
        
        $tmp=array();
        $response["results"]=array();
        
        while($cur=mysqli_fetch_array($req)){
            
            $id_v = $cur["id_voiture"];
            $v = mysqli_query($cnx, "SELECT vehicule FROM voitures WHERE id='$id_v'");
            $cv = mysqli_fetch_assoc($v);
            
            $tmp["id"]=$cur["id"];
            $tmp["date_sinistre"]=$cur["date_sinistre"];
            $tmp["nom_vehicule"] = $cv["vehicule"];
           
        
            array_push($response["results"], $tmp);
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