<?php
session_start();


if(isset($_SESSION["id"])){
    
    header("Location:backend/index.php");
}

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Authentification</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="src_login/css/style.css">
	<link rel="manifest" href="/manifest.json">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
            <?php include("display_error.php"); ?> 
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
        		      	<img src="src_login/images/new_fleet_mgmt.jpg" style="width : 100px; height:90px; display:block; margin:auto;" />
        		      	<hr>
        		      	<h3 class="text-center mb-4" style="color:#071686;">Connexion</h3>
        				<form method="POST" action="trait_conn.php" class="login-form">
        		      		<div class="form-group">
        		      			<input type="text" name="username" class="form-control rounded-left" placeholder="Nom d'utilisateur" required>
        		      		</div>
        		      		
            	            <div class="form-group d-flex">
            	              <input type="password" name="password" class="form-control rounded-left" placeholder="Mot de passe" required>
            	            </div>
            	            
            	            <div class="form-group">
            	            	<button style="background-color:#071686;" type="submit" name="valide" class="btn text-white rounded submit p-3 px-5">Connexion</button>	
            	            </div>
                        </form>
	                </div>
				</div>
			</div>
			
			 
	          
		</div>
	</section>
    
    <div style="left:0; bottom:0;width: 100%;text-align: center;">
      v 0.0.1 - Fleet Management System - 2023
    </div>
  <script src="src_login/js/jquery.min.js"></script>
  <script src="src_login/js/popper.js"></script>
  <script src="src_login/js/bootstrap.min.js"></script>
  <script src="src_login/js/main.js"></script>

	</body>
</html>

