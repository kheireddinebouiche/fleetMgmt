<?php

require("../db_connect.php");


if(isset($_GET["id"])){
    
    $response=array();
    
    $id = $_GET["id"];
    $etat ="unread";
    
    $sql = mysqli_query($cnx, "SELECT * FROM notifications WHERE id_user='$id' and etat='$etat' ");
    
    if(mysqli_num_rows($sql) > 0){
        
        $tmp = array();
        $response["results"]=array();
        
        while($cur = mysqli_fetch_array($sql)){
            
            $tmp["id"] = $cur["id"];
            $tmp["contenu"] = $cur["contenu"];
            $tmp["created_at"] = $cur["created_at"];
            
            array_push($response["results"], $tmp);
            
        }
        
        $response["success"] = 1;
        echo json_encode($response);
        
    }else{
        
        $response["success"] = 0;
        $response["message"] = "Data not found";
        
        echo json_encode($response);
    
    }
    
}


?>