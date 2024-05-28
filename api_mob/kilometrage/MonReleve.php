<?php
require("../db_connect.php");

$response=array();


if(isset($_GET["id"])){

    $id = $_GET["id"];
    $req = mysqli_query($cnx, "SELECT * FROM suivie_kilometrage where user_id='$id'");
    
    if(mysqli_num_rows($req) > 0){
        
        $tmp=array();
        $response["results"]=array();
        
        while($cur=mysqli_fetch_array($req)){
            
            $id_v = $cur["id_vehicule"];
            $v = mysqli_query($cnx, "SELECT vehicule FROM voitures WHERE id='$id_v'");
            $cv = mysqli_fetch_assoc($v);
            
            $tmp["id"]=$cur["id"];
            $tmp["id_vehicule"]=$cur["id_vehicule"];
            $tmp["vehicule"] = $cv["vehicule"];
            $tmp["kilometrage"]=$cur["kilometrage"];
            $tmp["date_mesure"] = $cur["date_mesure"];
            $tmp["created_at"] = $cur["created_at"];
            $tmp["updated_at"] = $cur["updated_at"];
            
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