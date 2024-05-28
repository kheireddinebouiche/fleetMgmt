<?php
require("../db_connect.php");

$response=array();

$document = $_GET["type_document"];
$date = $_GET["date"];
$id = $_GET["id"];


if($document == "Assurance"){
    
    $req = mysqli_query($cnx, "SELECT * FROM voitures WHERE id='$id' ");
    $info = mysqli_fetch_assoc($req);
    $prev_date = $info["date_assurance"];
    
    if(strlen($prev_date) > 4 ){
        
        $tmp = array();
        $response["result"] = array();
        
        $tmp["date"] = $info["date_assurance"];
        
        array_push($response["result"], $tmp);
        $response["success"] = 1;
        echo json_encode($response);
        
    }else{
        
        $response["success"] = 0;
        $response["message"] = "Aucune date configuré";
        echo json_encode($response);
    }
    
}

else{
    
    if($document == "Controle technique"){
        
        $req = mysqli_query($cnx, "SELECT * FROM voitures WHERE id='$id' ");
        $info = mysqli_fetch_assoc($req); 
        $prev_date = $info["date_controle"];
        
            if(strlen($prev_date) > 4 ){
                
                $tmp = array();
                $response["result"] = array();
                
                $tmp["date"] = $info["date_controle"];
                
                array_push($response["result"], $tmp);
                $response["success"] = 1;
                echo json_encode($response);
            
            }else{
                
                $response["success"] = 0;
                $response["message"] = "Aucune date configuré";
                echo json_encode($response);
            }
        
        
    }else{
        if($document == "Vignette"){
            
            $req = mysqli_query($cnx, "SELECT * FROM voitures WHERE id='$id' ");
            $info = mysqli_fetch_assoc($req);
            $prev_date = $info["date_vignette"];
            
             if(strlen($prev_date) > 4 ){
                
                $tmp = array();
                $response["result"] = array();
                
                $tmp["date"] = $info["date_vignette"];
                
                array_push($response["result"], $tmp);
                $response["success"] = 1;
                echo json_encode($response);
                
            }else{
                
                $response["success"] = 0;
                $response["message"] = "Aucune date configuré";
                echo json_encode($response);
            }
            
        }
    }
}
    

        

    
    
    
    
?>