<?php

include("../db_connect.php");

$response=array();

if(isset($_GET["id"])){
    
    
     $id = $_GET["id"];
     
     $req = mysqli_query($cnx, "SELECT * FROM voitures WHERE id='$id' ");
     
     if(mysqli_num_rows($req) > 0){
         
          $tmp=array();
          
          $response["result"]=array();
          $cur=mysqli_fetch_array($req);
          
          $tmp["date_controle"]=$cur["date_controle"];
          
          $date = $tmp["date_controle"];
          
          if($date!=null){
              
              array_push($response["result"], $tmp);
        
              $response["success"] = 1;
              echo json_encode($response);
              
          }else{
              
              $response["success"] = 0;
              echo json_encode($response);
              
              
          }
          
     }
     
}

?>
