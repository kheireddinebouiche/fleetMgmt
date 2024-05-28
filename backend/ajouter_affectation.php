<?php
session_start();
require("getter/connect.php");

if(isset($_SESSION["id"])){
    if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){

   

    }else{
        
        header("Location:index.php");
    }
    
}else{
    
    header("Location:index.php");
}


 
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Fleet management | Crée une affectation </title>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Affectations</a></li>
                                            <li class="breadcrumb-item active">Crée une affectation</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Crée une affectation</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" action="php_add_affectation.php" enctype="multipart/form-data">
                                              
                                              <div class="row">
                                                     
                                                  <div class="col-md-6">
                                                      <div class="row col-md-12">
                                                      <div class="col-md-8 col-6">
                                                          <label>Sélectionnez un véhicule : *</label>
                                                      
                                                          <select class="form-control" onchange="disp();" id="id_du_vehicule" name="vehicule" placeholder="Veuillez selectionner un type...">
                                                              <option>Veuillez sélectionner un véhicule ... </option>
                                                            <?php
                                                              $sql = mysqli_query($cnx,"SELECT * FROM voitures");
                                                
                                                            
                                                              while ($row = mysqli_fetch_assoc($sql)){
                                                            ?>
                                                                <option value="<?php echo $row['id']; ?>" > <?php echo $row["vehicule"]; ?> </option>
                                                            <?php
                                                              }
                                                            ?>
                                                                                                     
                                                           </select>
                                                          </div>
                                                      <div class="col-md-4 col-6">
                                                           <label>Identifiant du véhicule :</label>
                                                           <input type="text" readonly onFocus="GetDetail(this.value)" value=""  id="idVehicule" name="idVehicule" class="form-control" />
                                                      </div>
                                                    </div>
                                                  </div>
                                                  
                                                
                                               <div class="col-md-6">
                                                      
                                                      <label>Conducteur : *</label>
                                                       <select  class="form-control" name="conducteur">
                                                          <option>Veuillez sélectionner un conducteur ... </option>
                                                            <?php
                                                              $sql = mysqli_query($cnx,"SELECT * FROM user");
                                                              while ($row = mysqli_fetch_assoc($sql)){
                                                            ?>
                                                                <option value="<?php echo $row['id']; ?>" ><?php echo $row["username"]; ?> </option>
                                                            <?php
                                                              }
                                                            ?>
                                                                                                 
                                                       </select>
                                                      
                                                  </div>
                                                  
                                              </div>
                                              
                                              <div class="row mt-2">
                                                     
                                                  <div class="col-md-6 col-6">
                                                      
                                                      <label>Date de début : *</label>
                                                
                                                      <input type="date" id="basic-datepicker" name="date_debut" class="form-control" placeholder="2000-01-01">
                                                      
                                                  </div>
                                                  
                                                  <div class="col-md-6 col-6">
                                                      <label>Heure de début : *</label>
                                                
                                                      <input type="time" id="basic-datepicker" name="h_debut" class="form-control" placeholder="2000-01-01">
                                                  </div>

                                              </div>
                                              
                                              <div class="row mt-2">
                                                  
                                                   <div class="col-md-6 col-6">
                                                      
                                                      <label>Date de fin : *</label>
                                                      <input type="date"  name="date_fin" class="form-control" />
                                                      
                                                  </div>
                                                  
                                                  <div class="col-md-6 col-6">
                                                      <label>Heure de fin : *</label>
                                                
                                                      <input type="time"  name="h_fin" class="form-control" />
                                                      
                                                  </div>
                                                  
                                              </div>
                                              
                                              <div class="row mt-2">
                                                  <div class="col-md-12">
                                                      
                                                      <label>Mode d'affectation : *</label>
                                                      <select class="form-control" name="mode_affectation" placeholder="Veuillez selectionner un type...">
                                                          <option value='Temporaire'>Temporaire</option>
                                                          <option value='Definitif'>Définitif</option>          
                                                       </select>
                                                      
                                                  </div>
                                              </div>
                                              
                                              <div class="row mt-2">
                                                  <div class="col-md-6 col-6">
                                                      
                                                      <label>Kilométrage récent : </label>
                                                      <input type="text" readonly id="vehicKm" name="kilometrage" class="form-control" />
                                                      
                                                  </div>
                                                  <div class="col-md-6 col-6">
                                                      
                                                      <label>Kilométrage d'affectation : * </label>
                                                      <input type="text" name="affected_kilometrage" class="form-control" />
                                                      
                                                  </div>
                                              </div>
                                              
                                              <div class="row mt-2">
                                                  <div class="col-md-12">
                                                      
                                                      <label>Observation : </label>
                                                      <input type="text" name="observation" class="form-control" />
                                                      
                                                  </div>
                                              </div>
                                                
                                            <div class="col-md-12 mt-3">
                                                <center><input type="submit" name="creer" class="btn btn-primary" value="Créer l'affectation" /></center>
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
        
        <script>
            
            function disp(){
                var x = document.getElementById("id_du_vehicule").value;
                document.getElementById("idVehicule").value = x;
                document.getElementById("idVehicule").focus();
            }
            
        </script>
        
        <script>
    
     
        function GetDetail(str) {
            if (str.length == 0) {
                document.getElementById("vehicKm").value = "";
                return;
            }
            else {
  
                // Creates a new XMLHttpRequest object
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
  
                    // Defines a function to be called when
                    // the readyState property changes
                    if (this.readyState == 4 && 
                            this.status == 200) {
                          
                        // Typical action to be performed
                        // when the document is ready
                        var myObj = JSON.parse(this.responseText);
  
                     
                          
                        document.getElementById
                            ("vehicKm").value = myObj[0];
                          
                    }
                };
  
                // xhttp.open("GET", "filename", true);
                xmlhttp.open("GET", "get_km.php?id=" + str, true);
                  
                // Sends the request to the server
                xmlhttp.send();
            }
        }
    </script>

        
    </body>
</html>