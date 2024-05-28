<?php
session_start();
require("getter/connect.php");


if(isset($_SESSION["id"])){
    
    if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){
        
        $id = $_GET["id"];
        
        $req = mysqli_query($cnx,"SELECT * FROM vidanges WHERE id='$id' ");
        $result = mysqli_fetch_assoc($req);
        
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
        <title>Fleet Management| Détails de l'utilisateur </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        
        <!-- third party css -->
        <link href="assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css" rel="stylesheet" type="text/css" />

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Entretien & maintenance</a></li>
                                            <li class="breadcrumb-item active">Suivie des vidanges</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Modification des la vidange</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <div class="ps-xl-3 mt-3 mt-xl-0">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                 
                                                            <div>
                                                                
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Effectuer le : <?php echo $result["date"]; ?> </p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Kilometrage annoncé : <?php echo $result["futur_km"]," km"; ?> </p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Kilometrage réel : <?php echo $result["actual_km"]," km"; ?> </p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Créer le : <?php echo $result["created_at"]; ?> </p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Dérniere modification : <?php echo $result["updated_at"]; ?></p>
                                                                
                                                                <label class="mb-2">Changement de filtres :</label>
                                                                <div class="form-check">
                                                                  <input <?php if($result["filtre_huile"] == 'on' ){ echo "checked"; } ?> class="form-check-input" name="filtre_huile" type="checkbox" id="flexCheckDefault">
                                                                  <label class="form-check-label" for="flexCheckDefault">Changement filtre à huile</label>
                                                                </div>
                                                                
                                                                <div class="form-check">
                                                                  <input <?php if($result["filtre_es_gas"] == "on"){ echo "checked"; } ?> class="form-check-input" type="checkbox" name="filtre_es_gas" value="" id="flexCheckDefault1">
                                                                  <label class="form-check-label" for="flexCheckDefault1">Changement filtre à essence/gasoile</label>
                                                                </div>
                                                                
                                                                <div class="form-check mb-2">
                                                                  <input <?php if($result["filtre_aire"] == "on"){ echo "checked"; } ?> class="form-check-input" type="checkbox" name="filtre_aire" value="" id="flexCheckDefault2">
                                                                  <label class="form-check-label" for="flexCheckDefault2">Changement filtre à aire</label>
                                                                </div>
                                                                
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Autre : <?php echo $result["autre"]; ?></p>
                                                                
                                                                
                                                                
                                                                <?php 
                                                                  if($result["etat"] == 1){
                                                                ?>
                                                                  <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Etat : <span class="badge bg-primary">Prochaine vidange</span></p>
                                                           
                                                                <?php
                                                                  }else{
                                                                      ?>
                                                                       <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Etat : <span class="badge bg-warning">Vidange effectuer</span></p>
                                                                      <?php
                                                                  }
                                                                 ?>
                                                                     
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" >
                                                        <center>                                       
                                                        
                                                            <a <?php if($result["etat"] == 0){echo "hidden";} ?> data-bs-toggle="modal" data-bs-target="#vidange-new-modal" type="button" class="btn btn-danger waves-effect waves-light" >Effectuer</a>
                                                            
                                                            <a type="button" data-bs-toggle="modal" data-bs-target="#upd-vidange-modal" class="btn btn-warning waves-effect waves-light">Modifier</a>
                                                        </center> 
                                                    </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
      
                                    
                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->
    
                    </div> <!-- container -->

                </div> <!-- content -->
                
                <!-- affectation modal content -->
                <div id="upd-vidange-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="text-center mt-2 mb-4">
                                
                                    <h4><b>Mise à jours des informations de la vidange </b></h4>
                                </div>
                                <hr>
                              <form action="php_admin_update_vidange.php?id=<?php echo $id; ?>" method="POST" class="px-3">
                                  
                                    <div class="mb-3">
                                        <label for="new_km" class="form-label">Kilometrage Réel :</label>
                                        <input class="form-control" type="text" value="<?php echo $result["actual_km"];?>" required="true" id="actual_km" name="actual_km1" />
                                    </div>
                                    
                                    <label class="mb-2">Changement de filtres :</label>
                                    <div class="form-check">
                                      <input <?php if($result["filtre_huile"] == "on" ) {echo "checked";} ?> class="form-check-input" name="filtre_huile1" type="checkbox" id="flexCheckDefault11">
                                      <label class="form-check-label" for="flexCheckDefault11">Changement filtre à huile</label>
                                    </div>
                                    
                                    <div class="form-check">
                                      <input <?php if($result["filtre_es_gas"] == "on" ) {echo "checked";} ?> class="form-check-input" type="checkbox" name="filtre_es_gas1" id="flexCheckDefault12">
                                      <label class="form-check-label" for="flexCheckDefault12">Changement filtre à essence/gasoile</label>
                                    </div>
                                    
                                    <div class="form-check">
                                      <input <?php if($result["filtre_aire"] == "on" ) {echo "checked";} ?> class="form-check-input" type="checkbox" name="filtre_aire1" id="flexCheckDefault23">
                                      <label class="form-check-label" for="flexCheckDefault23">Changement filtre à aire</label>
                                    </div>
                                    
                                    <div class="mt-2 mb-3">
                                        <label for="autre" class="form-label">Autre :</label>
                                        <input value="<?php echo $result["autre"]; ?>" class="form-control" type="text" id="autre" name="autre1" />
                                    </div>

                                    <div class="mb-2 text-center">
                                        <button class="btn rounded-pill btn-warning text-white" name="submit" type="submit">Confirmer les modifications</button>
                                    </div>

                                </form>

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                
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
        
         <!-- third party js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <!-- third party js ends -->

        <!-- Datatables init -->
        <script src="assets/js/pages/datatables.init.js"></script>
        
        
        <script language="JavaScript" type="text/javascript">
            function checkDelete(){
                return confirm('Voulez vous vraiment annuler l\'affectation ?');
            }
        </script>

    </body>
</html>