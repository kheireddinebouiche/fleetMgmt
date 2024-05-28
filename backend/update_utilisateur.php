<?php
session_start();
require("getter/connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');


if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){
    
if(isset($_GET["id"])){
    
    $id = $_GET["id"];
    
    $req = mysqli_query($cnx,"SELECT * FROM user WHERE id='$id'");
    $result = mysqli_fetch_assoc($req);
    
    $username = $result["username"];
    $email = $result["email"];
    $niveau = $result["niveau"];
    $contact = $result["mobile"];
    $permis  = $result["num_permis"];
    $identification = $result["identification"];
    
    if($niveau == 1){
        $niv == "Administrateur";
        
    }else{
        
        if($niveau == 2){
            $niv == "Gestionnaire";
            
        }else{
            
            if($niveau == 3){
                $niv == "Utilisateur";
            }else{
                if($niveau == 4){
                    $niv = "Utilisateur Temporaire";
                }
            }
        }
    }
    
}

if(isset($_POST["update"])){

  

}

}else{
    header("Location:index.php");
}


?>



<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Fleet management | Modifier les information d'utilisateur </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Plugins css -->
        <link href="assets/libs/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />

		<!-- Theme Config Js -->
		<script src="assets/js/head.js"></script>

		<!-- Bootstrap css -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="app-style" />

		<!-- App css -->
		<link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

		<!-- Icons css -->
		<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

         <?php include("left_menu.php"); ?>
            

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">

            <?php include("top_barr.php"); ?>
            <?php include("notification.php"); ?>

                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Fleet management</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Utilisateurs</a></li>
                                            <li class="breadcrumb-item active">Modifier les informations d'utilisateur</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Modifier les informations d'utilisateur</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title --> 
                        
                        

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        
                                      
                                        <form method="POST" action="php_update_user.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                                              
                                              <div class="row">
                                                     
                                                  <div class="col-md-6">
                                                      
                                                      <label>Nom d'utilisateur:</label>
                                                      <input class="form-control" maxlength="25" id="defaultconfig" value='<?php echo $result["username"]; ?>' type="text" name="username">
                                                      
                                                      
                                                  </div>
                                                  
                                                  <div class="col-md-6">
                                                      
                                                      <label>Email :</label>
                                                      <input class="form-control" maxlength="25" id="defaultconfig" value='<?php echo $result["email"]; ?>' type="text" name="email">
                                                      
                                                  </div>
                                              </div>
                                              
                                              <div class="row mt-2">
                                                     
                                                  <div class="col-md-4">
                                                      
                                                      <label>N° Permis de conduire:</label>
                                                      <input class="form-control" maxlength="25" id="defaultconfig"  value='<?php echo $result["num_permis"]; ?>' type="text" name="num_permis">
                                                      
                                                      
                                                  </div>
                                                  
                                                  <div class="col-md-4">
                                                      
                                                      <label>N° identification :</label>
                                                      <input class="form-control" maxlength="25" id="defaultconfig" value='<?php echo $result["identification"]; ?>' type="text" name="num_identification">
                                                      
                                                  </div>
                                                  
                                                  <div class="col-md-4">
                                                      
                                                      <label>N° de contact :</label>
                                                      <input class="form-control" maxlength="25" id="defaultconfig" value='<?php echo $result["mobile"]; ?>' type="text" name="num_contact">
                                                      
                                                  </div>
                                                  
                                              </div>
                                              
                                              <div class="row mt-2">
                                                  <div class="col-md-12">
                                                                                       
                                                      <label>Type utilisateur :</label>
                                                      <select class="form-control" name="niveau" placeholder="Veuillez selectionner un type...">
                                                          
                                                        <option value="1" <?php if($result['niveau'] == 1){echo "selected"; } ?> >Administrateur</option>
                                                        <option value="2" <?php if($result['niveau'] == 2){echo "selected"; } ?>>Gestionnaire</option>
                                                        <option value="3" <?php if($result['niveau'] == 3){echo "selected"; } ?>>Utilisateur</option>
                                                        <option value="3" <?php if($result['niveau'] == 4){echo "selected"; } ?>>Utilisateur Temporaire</option>
                                                                                                 
                                                    </select>
                                                      
                                                  </div>
                                              
                                              </div>
                                              
                                             
         
                                                
                                            <div class="col-md-12 mt-3">
                                                <center><input type="submit" name="update" class="btn btn-primary" value="Modifier" /></center>
                                            </div>
                                                
                                        </form>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->


                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include("footer.php"); ?>

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        
        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

        <script src="assets/libs/selectize/js/standalone/selectize.min.js"></script>
        <script src="assets/libs/mohithg-switchery/switchery.min.js"></script>
        <script src="assets/libs/multiselect/js/jquery.multi-select.js"></script>
        <script src="assets/libs/select2/js/select2.min.js"></script>
        <script src="assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
        <script src="assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
        <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

        <!-- Init js-->
        <script src="assets/js/pages/form-advanced.init.js"></script>

        
    </body>
</html>