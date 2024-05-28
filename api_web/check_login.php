<?php
  
  include("connect.php");
  
  session_start();
  
  if (isset($_POST["POST"]) && isset($_POST["username"]) && isset($_POST["password"])){
      
      $username = $_POST["username"];
      $password = $_POST["password"];
      
      $sql = "SELECT username, pass FROM user WHERE username='$username' && pass='$password' ";
      
      $result = mysqli_query($cnx, $sql);
      
      if(mysqli_num_rows($result) > 0 ){
          
          $_SESSION["username"] = $username;
          $_SESSION["password"] = $password;
          
          header('Location:admin.php');
          
      }else {
          header('Location:404.php');
      }
      
      
  }else{
      
      echo "erreur d'execution";
  }

?>