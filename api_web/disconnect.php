<?php

if (isset($_POST['signout'])) {
  session_destroy();            //  destroys session 
  header('Location: index.php');
  
}
?>