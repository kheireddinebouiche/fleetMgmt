<?php
session_start();
require("getter/connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');


if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){
    
    if(isset($_POST["submit"])){
  
      $date_sinistre = $_POST["date_sinistre"];
      $lieu = $_POST["lieu_sinistre"];
      $description = $_POST["description"];
      $num_dossier = $_POST["num_dossier"];
      $conducteur = $_POST["conducteur"];
      $vehicule = $_POST["vehicule"];
      $rembourssement = $_POST["remboursement"];
      $reparation = $_POST["reparation"];
      
      $insert = mysqli_query($cnx, "INSERT INTO sinistres (num_dossier, id_voiture, conducteur, date_sinistre, description, lieu, etat, created_at,mnt_reparation,mnt_rembour) 
                                      VALUES ('$num_dossier','$vehicule','$conducteur','$date_sinistre','$description','$lieu','1','$curdate','$reparation','$rembourssement') ");
     
      if($insert){
          
          $_SESSION["success"]= 1;
          $_SESSION["status"]= "Ajouter avec succès";
          
          header("Location:list_sinistres.php");
          
      }else{
          
          header("Location:ajouter_sinistre.php");
      }

}
    
}else{
    
    header("Location:index.php");
}


?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Fleet management | Déclaration d'un sinistre </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        
        
        <!-- Plugins css -->
        <link href="assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
        <link href="assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Sinistres</a></li>
                                            <li class="breadcrumb-item active">Déclaration d'un sinistre </li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Déclaration d'un sinistre </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST"  enctype="multipart/form-data">
                                              
                                              <div class="row">
                                                     
                                                  <div class="col-md-4">
                                                      
                                                      <label>Numéro du dossier :</label>
                                                      <input class="form-control" maxlength="25" id="defaultconfig" type="text" name="num_dossier">
                                                      
                                                      
                                                  </div>
                                                  
                                                  <div class="col-md-4">
                                                      
                                                      <label>Véhicule :</label>
                                                      <select class="form-control" name="vehicule">
                                                          
                                                       <option value="selected" selected >Veuillez sélectionnez un véhicule ...</option>      
                                                       <?php
                                                         $sql = mysqli_query($cnx,"SELECT * FROM voitures ");
                                                         while($row=mysqli_fetch_assoc($sql)){

                                                       ?>
                                                           <option value="<?php echo $row["id"]; ?>" ><?php echo $row["vehicule"]; ?></option>
                                                        <?php
                                                         }   
                                                       ?>     
                                                    </select>
                                                      
                                                  </div>
                                                  
                                                  <div class="col-md-4">
                                                      
                                                      <label>Conducteur :</label>
                                                      <select class="form-control" name="conducteur" placeholder="Veuillez selectionner un type...">
                                                         <option value="selected" selected >Veuillez sélectionnez un conducteur ...</option>
                                                       <?php
                                                         $sql = mysqli_query($cnx,"SELECT * FROM user ");
                                                         while($row=mysqli_fetch_assoc($sql)){

                                                       ?>
                                                           <option value="<?php echo $row["id"]; ?>" ><?php echo $row["username"]; ?></option>
                                                        <?php
                                                         }   
                                                       ?>     
                                                    </select>
                                                      
                                                  </div>
                                                  
                                                  
                                              </div>
                                              
                                              <div class="row mt-2">
                                                     
                                                  <div class="col-md-3">
                                                      
                                                      <label>Date du sinistre :</label>
                                                      <input type="date" id="basic-datepicker" name="date_sinistre" class="form-control" placeholder="2000-01-01">
                        
                                                  </div>
                                                  
                                                  <div class="col-md-3">
                                                      
                                                      <label>Lieu du sinistre :</label>
                                                      <input type="text"  name="lieu_sinistre" class="form-control"/>
                        
                                                  </div>
                                                  
                                                  <div class="col-md-6">
                                                      
                                                      <label>Description :</label>
                                                      <input type="text"  name="description" class="form-control" />
                        
                                                  </div>
                                                  
                                              </div>
                                              
                                              <div class="row mt-2">
                                                  <div class="col-md-6">
                                                      <label for="reparation">Montant de réparation :</label>
                                                      <input type="text" class="form-control" id="reparation" name="reparation" />
                                                  </div>
                                                  
                                                  <div class="col-md-6">
                                                      <label for="reparation">Montant remboursement :</label>
                                                      <input type="text" class="form-control" id="remboursement" name="remboursement" />
                                                  </div>
                                              </div>
                                                
                                            <div class="col-md-12 mt-3">
                                                <center><input type="submit" name="submit" class="btn btn-primary" value="Créer le dossier" /></center>
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
        
        <!-- Plugins js-->
        <script src="assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
        <script src="assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
        <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <!-- Init js-->
        <script src="assets/js/pages/form-advanced.init.js"></script>
        <!-- Init js-->
        <script src="assets/js/pages/form-pickers.init.js"></script>

        
    </body>
</html>