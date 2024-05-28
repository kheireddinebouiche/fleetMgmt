<?php
require("../db_connect.php");

$response=array();

if(isset($_GET["id_vehicule"])){
    $id= $_GET["id_vehicule"];
    
    $req = mysqli_query($cnx, "SELECT * FROM suivie_kilometrage WHERE id_vehicule='$id'");

    if(mysqli_num_rows($req) > 0){
        
        $tmp=array();
        $response["kms"]=array();
        
        while($cur=mysqli_fetch_array($req)){
            
            $vehicule=$cur["id_vehicule"];
            $re = mysqli_query($cnx, "SELECT  * FROM voitures WHERE id='$vehicule'");
            $f = mysqli_fetch_array($re);
            
            $tmp["id"]=$cur["id"];
            $tmp["nom_vehicule"]=$f["vehicule"];
            $tmp["kilometrage"] = $cur["kilometrage"];
            $tmp["id_vehicule"] = $cur["id_vehicule"];
            $tmp["date_mesure"]=$cur["date_mesure"];
            $tmp["created_at"] = $cur["created_at"];
            
        
            array_push($response["kms"], $tmp);
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