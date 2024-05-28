<?php
session_start();
require("getter/connect.php");

if(isset($_SESSION["id"])){
    
 if($_SESSION["niveau"] == 1 or $_SESSION["niveau"]){
     
    $id = $_GET["id"];
    
    $req = mysqli_query($cnx,"SELECT * FROM maintenance WHERE id='$id' ");
    $result = mysqli_fetch_assoc($req);
    
    $find_veh = mysqli_query($cnx, "SELECT * FROM voitures WHERE id='$result[id_vehicule]' ");
    $r = mysqli_fetch_assoc($find_veh);
     
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
        <title>Fleet Management|Détails de la maintenance</title>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Maintenance du véhicule</a></li>
                                            <li class="breadcrumb-item active">Détails de la maintenance</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Détails de la maintenance</h4>
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
                                                            
                                                            <h4>Informations sur la maintenance : </h4>
                                                            <hr>
                                                            
                                                            <div>
                                    
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Véhicule : <?php echo $r["vehicule"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Motif de la maintenance : <?php echo $result["motifs_maintenance"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Date de la maintenance : <?php echo $result["date_maintenance"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Kilometrage du véhicule : <?php echo $result["km"],' km'; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Description : <?php echo $result["description"]; ?></p>
                                                                                                      
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Crée le : <?php echo $result["created_at"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Mis à jour le : <?php echo $result["updated_at"]; ?></p>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
    
                                                    <div>
                                                        <center>                                       
                                                            <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#upd-maintenance-modal" class="btn btn-warning waves-effect waves-light text-white"  style='width:100px;' >
                                                              <b> Modifier</b>
                                                            </a>
                                                        </center> 
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
                
                <!-- maintenance modal content -->
                <div id="upd-maintenance-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="text-center mt-2 mb-4">
                                    <h4><b>Mise à jours des informations de la maintnenance</b></h4>
                                </div>
                                <hr>
                              <form action="php_update_maintenance.php?id=<?php echo $id; ?> " method="POST" class="px-3">
                                    <div class="mb-3">
                                        <label for="date_maintenance" class="form-label">Date maintenance:</label>
                                        <input class="form-control" type="date" value="<?php echo $result["date_maintenance"]; ?>" id="date_maintenance" name="date_maintenance"  />
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description :</label>
                                        <input class="form-control" type="text" value="<?php echo $result["description"]; ?>" required="true" id="description" name="description" />
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="km" class="form-label">Kilometrage :</label>
                                        <input class="form-control" type="text" value="<?php echo $result["km"]; ?>" required="true" id="km" name="km" />
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
            function confirmation(){
              return confirm('Voulez vous vraiment archivé le dossier ?');
            }
        </script>

    </body>
</html>