<?php

session_start();
require("getter/connect.php");

if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){

     
}else{
    
    header("Location:index.php");
}
 
 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Fleet management | Ajout un véhicule </title>
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
		
		<style>
		    
		    #defaultconfig{
		        text-transform : uppercase;
		    }
		</style>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Vehicules</a></li>
                                            <li class="breadcrumb-item active">Ajouter un véhicule</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Véhicules</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" action="php_add_vehicule.php" enctype="multipart/form-data">
                                              
                                              <div class="row">
                                                     
                                                  <div class="col-md-6">
                                                      
                                                      <label>Nom du véhicule :</label>
                                                      <input class="form-control" maxlength="25" id="defaultconfig" type="text" name="label">
                                                      
                                                      
                                                  </div>
                                                  
                                                  <div class="col-md-6">
                                                      
                                                      <label>Marque du véhicule :</label>
                                                      <input class="form-control" maxlength="25" id="defaultconfig" type="text" name="marque">
                                                      
                                                  </div>
                                              </div>
                                              
                                              <div class="row mt-2">
                                                     
                                                  <div class="col-md-4">
                                                      
                                                      <label>N° de série:</label>
                                                      <input class="form-control" maxlength="25" id="defaultconfig" type="text" name="numero_serie">
                                                      
                                                      
                                                  </div>
                                                  
                                                  <div class="col-md-4">
                                                      
                                                      <label>N° immatriculation :</label>
                                                      <input class="form-control" maxlength="25" id="defaultconfig" type="text" name="num_immatriculation">
                                                      
                                                  </div>
                                                  
                                                  <div class="col-md-4">
                                                      
                                                      <label>Motorisation :</label>
                                                      <select class="form-control" name="motorisation" placeholder="Veuillez selectionner un type...">
                                                        <option value="Diesel">Diesel</option>
                                                        <option value="Essence">Essence</option>
                                                        <option value="Hybride">Hybride</option>
                                                        <option value="Electrique">Electrique</option>                                                      
                                                    </select>
                                                      
                                                  </div>
                                                  
                                              </div>
                                              
                                              <div class="row mt-2">
                                                  <div class="col-md-4">
                                                      
                                                      <label>N° Carte grise :</label>
                                                      <input class="form-control" maxlength="25" id="defaultconfig" type="text" name="carte_grise">
                                                      
                                                  </div>
                                              
                                                  <div class="col-md-4">
                                                      
                                                      <label>Année de mise en circulation :</label>
                                                      <input class="form-control" maxlength="25" id="defaultconfig" type="text" name="prem_ann">
                                                      
                                                  </div>
                                                  
                                                  <div class="col-md-4">
                                                      
                                                      <label>Ancien immatriculation :</label>
                                                      <input class="form-control" maxlength="25" id="defaultconfig" type="text" name="anc_imm">
                                                      
                                                  </div>
                                              </div>
                                              
                                              <h4 class="mt-3">Autres informations</h4>
                                              <hr>
                                              <div class="row">
                                                  <div class="col-md-4">
                                                      <label>Date assurance :</label>
                                                      <input class="form-control"  type="date" name="assurance">
                                                  </div>
                                                  
                                                  <div class="col-md-4">
                                                      <label>Date contrôle technique  :</label>
                                                      <input class="form-control" type="date" name="control_technique">
                                                  </div>
                                                  
                                                  <div class="col-md-4">
                                                      <label>Date vignette :</label>
                                                      <input class="form-control" type="date" name="vignette">
                                                  </div>
                                              </div>
                                              
                                                
                                            <div class="col-md-12 mt-3">
                                                <center><input type="submit" name="submit" class="btn btn-primary" value="Ajouter" /></center>
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