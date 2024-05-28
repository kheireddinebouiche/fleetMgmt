<?php
require("db_connect.php");

$response=array();



if(isset($_GET["id"])){
    
    
    $id = $_GET["id"];
    $req = mysqli_query($cnx, "SELECT * FROM notifications where id_user='$id'");
    
    if(mysqli_num_rows($req) > 0){
        
        $tmp=array();
        $response["notifications"]=array();
        
        while($cur=mysqli_fetch_array($req)){
            
            $tmp["id"]=$cur["id"];
            $tmp["contenu"]=$cur["contenu"];
            $tmp["created_at"]=$cur["created_at"];
           
            
            array_push($response["notifications"], $tmp);
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