<?php
include("db_connect.php");

$response=array();

if(isset($_GET["username"])){
    
    $username = $_GET["username"];
    
    
    $req = mysqli_query($cnx,"SELECT * FROM user WHERE username='$username' ");
    $info = mysqli_fetch_assoc($req);
    $id = $info["id"];
    
    $psw = $info["pass"];
    $em = $info["email"];
    
 
    
    if($info["niveau"] == 1){
        
        $response["success"] = 1;
        $response["id"] = $id;
        $response["pass"] = $psw;
        echo json_encode($response);
        
    }else{
        if($info["niveau"] == 2){
            
            $response["success"] = 2;
            $response["id"] = $id;
            echo json_encode($response);
            
        }else{
            if($info["niveau"] == 3){
                
                $response["success"] = 3;
                $response["id"] = $id;
                echo json_encode($response);
                
            }else{
            
                $response["success"] = 0;
    
                echo json_encode($response);
            
          }
        }
    
    }
}


?>