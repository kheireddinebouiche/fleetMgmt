
<?php

session_start();


if (!isset($_SESSION['name'])) {         
  header('location: index.php');   
}

include('api_web/disconnect.php');

?>



<html>
    
    <head><title>Administration</title></head>
    <body>
        <?php
        
            echo $_SESSION["name"];
            
            
        ?>
        
        <form method="POST">
            <input type="submit" name="signout" value="deconnect" />
        </form>
    </body>
</html>