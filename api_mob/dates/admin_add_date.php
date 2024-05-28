<?php

require_once("../db_connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');

$response=array();

if(isset($_GET["type_document"]) and isset($_GET["id"]) and isset($_GET["date"])){
    
    $id_vehicule = $_GET["id"];
    $id_user = $_GET["id_user"];
    $datee= $_GET["date"];
    $type_document = $_GET["type_document"];
    
    
    if($type_document == "Assurance"){
        
        $req = mysqli_query($cnx, "UPDATE voitures SET date_assurance='$datee', user_id='$id_user', updated_at='$curdate' WHERE id='$id_vehicule' ");
        
        if($req){
            
            $response["success"]=1;
            $response["message"]="Succes 1";
            echo json_encode($response);
            
        }else{
            
            
            $response["success"]=0;
            $response["message"]="Erreur 1";
            echo json_encode($response);
            
        }
        
    }else{
        
        if($type_document == "Controle technique"){
            
            $req = mysqli_query($cnx, "UPDATE voitures SET date_controle='$datee', user_id='$id_user', updated_at='$curdate' WHERE id='$id_vehicule' ");
        
            if($req){
                            
                $response["success"]=1;
                echo json_encode($response);
                
            }else{
                
                $response["success"]=0;
                $response["message"]="Erreur 2";
                echo json_encode($response);
                
            }
            
            
            
        }else{
            
            if($type_document == "Vignette"){
                
                $req = mysqli_query($cnx, "UPDATE voitures SET date_vignette='$datee', user_id='$id_user', updated_at='$curdate' WHERE id='$id_vehicule' ");
        
                if($req){
                    
                    $response["success"]=1;
                    echo json_encode($response);
                }else{
                    
                    $response["success"]=0;
                    $response["message"]="Erreur 3";
                    echo json_encode($response);
                }
                
                
            }else{
                
                $response["success"]=0;
                $response["message"]="Erreur 4";
                echo json_encode($response);
                
                
            }
            
      
        }
        

    }
    
}else{
                $response["success"]=0;
                $response["message"]="Erreur 5";
                echo json_encode($response);
    
}


?>