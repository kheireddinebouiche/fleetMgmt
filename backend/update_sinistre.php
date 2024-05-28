<?php
session_start();
require("getter/connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');

if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){
    if(isset($_GET["id"])){
        
        $id = $_GET["id"];
        
        $find = mysqli_query($cnx,"SELECT * FROM sinistres WHERE id='$id' ");
        
        $result = mysqli_fetch_assoc($find);
        $id_voiture = $result["id_voiture"];
        $id_conducteur  =$result["conducteur"];
        
        $find_vehicule = mysqli_query($cnx,"SELECT * FROM voitures WHERE id='$id_voiture' ");
        $vehicule = mysqli_fetch_assoc($find_vehicule);
        $nom_vehicule = $vehicule["vehicule"];
        
        $find_conducteur = mysqli_query($cnx,"SELECT * FROM user WHERE id='$id_conducteur' ");
        $conducteur = mysqli_fetch_assoc($find_conducteur);
        $nom_conducteur = $conducteur["username"];
    
}

if(isset($_POST["update"])){
      
      $id_dossier = $_GET["id"];    
    
      $date_sinistre = $_POST["date_sinistre"];
      $lieu = $_POST["lieu_sinistre"];
      $description = $_POST["description"];
      $num_dossier = $_POST["num_dossier"];
      $conducteur = $_POST["conducteur"];
      $vehicule = $_POST["vehicule"];
      $reparation = $_POST["reparation"];
      $rembouresement = $_POST["remboursement"];
      
      $update = mysqli_query($cnx, "UPDATE sinistres SET mnt_rembour='$rembouresement', mnt_reparation='$reparation', num_dossier='$num_dossier', id_voiture='$vehicule' , conducteur='$conducteur' , date_sinistre='$date_sinistre' , description='$description' , lieu='$lieu' ,updated_at='$curdate' WHERE id='$id_dossier' ");
             
      if($update){
          
          $_SESSION["status"] = "La déclaration de sinistre à été mis à jours avec succès.";
          $_SESSION["success"] = 1;
          
          header("Location:update_sinistre.php?id=$id_dossier");
          
      }else{
          
          $_SESSION["status"] = "Une erreur est survenu lors du traitement de l'information.";
          $_SESSION["success"] = 0;
          
         
          header("Location:update_sinistre.php?id=$id_dossier");
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
        <title>Fleet management | Modification des informations du sinistre </title>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Sinistres</a></li>
                                            <li class="breadcrumb-item active">Mise à jours des informations du sinistre </li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Mise à jours des informations du sinistre</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <form method="POST" enctype="multipart/form-data">
                                              
                                              <div class="row">
                                                     
                                                  <div class="col-md-4">
                                                      
                                                      <label>Numéro du dossier :</label>
                                                      <input class="form-control" value="<?php echo $result["num_dossier"] ?> " maxlength="25" id="defaultconfig" type="text" name="num_dossier">
                                                      
                                                      
                                                  </div>
                                                  
                                                  <div class="col-md-4">
                                                      
                                                      <label>Véhicule concérner : <i><b> <?php echo $nom_vehicule; ?> </b></i> </label>
                                                      <select class="form-control" name="vehicule">
                                                          
                                                       <option>Veuillez sélectionnez un véhicule ...</option>      
                                                       <?php
                                                         $sql1 = mysqli_query($cnx,"SELECT * FROM voitures ");
                                                         
                                                         while($row1=mysqli_fetch_assoc($sql1)){

                                                          ?>
                                                           <option <?php if($id_voiture == $row1["id"]){echo "selected";} ?> value="<?php echo $row1["id"]; ?>" ><?php echo $row1["vehicule"]; ?></option>
                                                        <?php
                                                         }   
                                                       ?>     
                                                    </select>
                                                      
                                                  </div>
                                                  
                                                  <div class="col-md-4">
                                                      
                                                      <label>Conducteur concérner : <i><b> <?php echo $nom_conducteur; ?> </b></i></label>
                                                      <select class="form-control" name="conducteur" placeholder="Veuillez selectionner un type...">
                                                         <option value="selected" selected >Veuillez sélectionnez un conducteur ...</option>
                                                       <?php
                                                         $sql2 = mysqli_query($cnx,"SELECT * FROM user ");
                                                         while($row2=mysqli_fetch_assoc($sql2)){

                                                       ?>
                                                           <option <?php if($id_conducteur == $row2["id"]){echo "selected";} ?> value="<?php echo $row2["id"]; ?>" ><?php echo $row2["username"]; ?></option>
                                                        <?php
                                                         }   
                                                       ?>     
                                                    </select>
                                                      
                                                  </div>
                                                  
                                                  
                                              </div>
                                              
                                              <div class="row mt-2">
                                                     
                                                  <div class="col-md-3">
                                                      
                                                      <label>Date du sinistre :</label>
                                                      <input type="date" value="<?php echo $result["date_sinistre"] ?>" id="basic-datepicker" name="date_sinistre" class="form-control" >
                        
                                                  </div>
                                                  
                                                  <div class="col-md-3">
                                                      
                                                      <label>Lieu du sinistre :</label>
                                                      <input type="text" value="<?php echo $result["lieu"] ?> " name="lieu_sinistre" class="form-control"/>
                        
                                                  </div>
                                                  
                                                  <div class="col-md-6">
                                                      
                                                      <label>Description :</label>
                                                      <input type="text"  value="<?php echo $result["description"] ?> " name="description" class="form-control" />
                        
                                                  </div>
                                                  
                                              </div>
                                              
                                              <div class="row mt-2">
                                                  <div class="col-md-6">
                                                      <label for="reparation">Montant de réparation :</label>
                                                      <input type="text" class="form-control" id="reparation" name="reparation" value="<?php echo $result['mnt_reparation'];?>" />
                                                  </div>
                                                  
                                                  <div class="col-md-6">
                                                      <label for="remboursement">Montant remboursement :</label>
                                                      <input type="text" class="form-control" id="remboursement" name="remboursement"  value="<?php echo $result['mnt_rembour'];?>"/>
                                                  </div>
                                              </div>
                                                
                                            <div class="col-md-12 mt-3">
                                                <center><button type="submit" name="update" class="btn btn-warning">Modifier les informations</button></center>
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