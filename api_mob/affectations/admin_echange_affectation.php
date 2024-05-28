<?php
require("../db_connect.php");
date_default_timezone_set('Africa/Algiers');

$response = array();

if(isset($_GET["id_vehicule"]) && isset($_GET["id_user"])){
    
   
    $id_user = $_GET["id_user"];
    $id_vehicule = $_GET["id_vehicule"];
    $mode = $_GET["mode"];
    $observation = $_GET["observation"];
    $date_debut = $_GET["date_debut"];
    $date_fin = $_GET["date_fin"];
    
    
    $curdate = date('y-m-d h:i:s');
    $date_test = strtotime($date_fin);
    
    $curent= "en cours";
    $search = mysqli_query($cnx, "SELECT id_user ,date_fin, mode FROM suivie_affectation WHERE id_vehicule='$id_vehicule'");
    $res = mysqli_fetch_assoc($search);
    
    if($res["type"] == "Définitif") {
    
        $response["success"]=0;
        $response["message"]= "Le vehicule que vous voulais affecté, a été deja effecté";
        echo json_encode($response);
            
    } else{
        
        if($res["id_user"] == $id_user){
        
            $response["success"]=0;
            $response["message"]= "Le vehicule est déja affecté à l'utilisateur";
            echo json_encode($response);
        
        }else{
        
        
            $sql = "INSERT INTO suivie_affectation(id_user,id_vehicule,date_debut,date_fin,mode,observation,etat,created_at) 
                            VALUES ('$id_user','$id_vehicule','$date_debut','$date_fin','$mode','$observation','$curent','$curdate') ";
    
            $req = mysqli_query($cnx,$sql);
            
            $mes="Un véhicule vous a ete affecter";
            $unrea = "unread";
            
            $sq = mysqli_query($cnx, "INSERT INTO notifications(id_user,contenu,etat,created_at) VALUES ('$id_user','$mes','$unrea','$curdate') ");
        
            if($req){
                $response["success"]=1;
                $response["message"]="Success.";
                echo json_encode($response);
                
            }else{
                    $response["success"]=0;
                    $response["message"]="Success.";
                    echo json_encode($response);
            }
        
     }
    }
        
}else{
    
    $response["success"]=0;
    $response["message"]="required filed is missing";
    echo json_encode($response);
}

?>