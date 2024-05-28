<?php
  session_start();
  
  include("api_web/connect.php");
  date_default_timezone_set('Africa/Algiers');
  $curdate = date('y-m-d h:i:s');
 
  if (isset($_POST["valide"]) && isset($_POST["username"]) && isset($_POST["password"])){
      
      $username = $_POST["username"];
      $password = $_POST["password"];
      
      
      $sql = "SELECT * FROM user WHERE username='$username' && pass='$password' ";
      
      $result = mysqli_query($cnx, $sql);
      
      if (!$result) {
            die('query Failed' . mysqli_error($conn));
        }

    
      while ($row = mysqli_fetch_array($result)) {
            
            $user_id = $row['id'];
            $user_name = $row['username'];
            $user_email = $row['email'];
            $user_password = $row['pass'];
            $user_niveau = $row["niveau"];
            $user_etat = $row["etat"];
        }
    
      if ($user_name == $username  &&  $user_password == $password && $user_etat == 1) {

            $_SESSION['id'] = $user_id;       
            $_SESSION['name'] = $user_name;   
            $_SESSION['email'] = $user_email;
            $_SESSION['niveau'] = $user_niveau; 
 
            $ins = mysqli_query($cnx,"INSERT INTO suivie_connexion(id_user,date_connexion) VALUES ('$user_id','$curdate') ");
            
            header('Location:backend/index.php');
            
          } else{
              
             $_SESSION["message"] = "Aucun identifiant correspendant, veuillez réessayer.";
            
            header('Location:index.php');
          }
        }
      
  
?>