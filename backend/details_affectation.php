<?php
session_start();
require("getter/connect.php");


if(isset($_GET["id"])){
    
    $id = $_GET["id"];
    
    $req = mysqli_query($cnx,"SELECT * FROM suivie_affectation WHERE id='$id' ");
    $result = mysqli_fetch_assoc($req);
    $id_conducteur = $result["id_user"];
    $id_vehicule = $result["id_vehicule"];
    
    $req1 = mysqli_query($cnx, "SELECT * FROM user WHERE id='$id_conducteur' ");
    $result1 = mysqli_fetch_assoc($req1);
    $conducteur = $result1["username"];
    
    $req2 = mysqli_query($cnx, "SELECT * FROM voitures WHERE id='$id_vehicule' ");
    $result2 = mysqli_fetch_assoc($req2);
    $vehicule = $result2["vehicule"];
    
    
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Affectations & Emprunt</a></li>
                                            <li class="breadcrumb-item active">Détails de l'affectation</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Détails de l'affectation</h4>
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
                                                                
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Conducteur : <?php echo $conducteur; ?> </p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Véhicule : <?php echo $vehicule; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Mode d'affectation : <?php  echo $result["mode"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Date de debut : <?php echo $result["date_debut"]; ?> <b>à</b> <?php echo $result["h_debut"]; ?> </p> 
                                                                <p <?php if($result["mode"] == "Definitif"){ echo "hidden"; } ?>><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Date de fin : <?php echo $result["date_fin"]; ?> <b>à</b> <?php echo $result["h_fin"]; ?> </p> 
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Observation : <?php echo $result["observation"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Etat : <span class="badge bg-primary"><?php echo $result["etat"]; ?></span></p>
                                                                
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" >
                                                        <center>                                       
                                                            <a href="list_affectations.php" class="btn btn-success waves-effect waves-light"  >
                                                              <b> Retours vers list </b>
                                                            </a>
                                
                                                            <a <?php if($result["etat"] == "annulé"){echo "hidden"; } ?> href="admin_end_affectation.php?id=<?php echo $id;?>" type="button" class="btn btn-danger waves-effect waves-light" onclick='return checkDelete()' >Annuler l'affectation</a>
                                                            
                                                            <a <?php if($result["etat"] == "annulé"){echo "hidden"; } ?> type="button" data-bs-toggle="modal" data-bs-target="#upd-affectation-modal" class="btn btn-warning waves-effect waves-light">Modifier</a>
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
                <div id="upd-affectation-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="text-center mt-2 mb-4">
                                
                                    <h4><b>Mise à jours des informations de l'affectation</b></h4>
                                </div>
                                <hr>
                              <form action="php_update_affectation.php?id=<?php echo $id; ?> " method="POST" class="px-3">
                                  
                                    <div class="mb-3">
                                        <label for="date_debut" class="form-label">Date de debut :</label>
                                        <input class="form-control" type="date" value="<?php echo $result["date_debut"]; ?>" id="date_debut" name="date_debut"  />
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="date_fin" class="form-label">Date de fin :</label>
                                        <input class="form-control" type="date" value="<?php echo $result["date_fin"]; ?>" id="date_fin" name="date_fin" />
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="h_debut" class="form-label">Heure de debut :</label>
                                        <input class="form-control" type="time" value="<?php echo $result["h_debut"]; ?>" id="h_debut" name="h_debut" />
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="h_fin" class="form-label">Heure de fin :</label>
                                        <input class="form-control" type="time" value="<?php echo $result["h_fin"]; ?>" id="h_fin" name="h_fin" />
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="observation" class="form-label">Observation :</label>
                                        <input class="form-control" type="text" value="<?php echo $result["observation"]; ?>" id="observation" name="observation" />
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