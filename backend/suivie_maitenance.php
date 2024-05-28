<?php
  session_start();
  
  require('getter/connect.php');

if(isset($_SESSION["id"])){
    
    $req = mysqli_query($cnx, "SELECT * FROM maintenance ORDER BY id DESC");
    
}else{
    header("Location:index.php");
}
  

?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Fleet Management | Suivie maitenance </title>
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
        <!-- third party css end -->

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Entretien & maitenance</a></li>
                                            <li class="breadcrumb-item active">Suivie de la maintenance</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Suivie de la maintenance</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Véhicule</th>
                                                    <th>Motif de maintenance</th>
                                                    <th>Créer le</th>
                                                    <th>Actions</th>
                                                   
                                                </tr>
                                            </thead>
                                        
                                            <tbody>

                                            <?php 
                                                while($row=mysqli_fetch_array($req)){
                                                    
                                                    $find_veh = mysqli_query($cnx,"SELECT * FROM voitures WHERE id=$row[id_vehicule] ");
                                                    $rs = mysqli_fetch_assoc($find_veh);
                                            ?>
                                                  <tr>
                                                       <td><?php echo $rs["vehicule"]; ?></td>
                                                       <td><b><?php echo $row["motifs_maintenance"]; ?></b></td>
                                                       <td><?php echo $row["created_at"]; ?></td>"
                                                      
                                                       <td>
                                                           <center>
                                                               <a href="details_maintenance.php?id=<?php echo $row['id']; ?>" type="button" class="btn btn-warning" >Détails</a>
                                                           </center>
                                                       </td>
                                                  </tr>
                                            <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                        
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->

                        
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
                return confirm('Voulez vous vraiment supprimer l\'enregistrement ?');
            }
        </script>

        
    </body>
</html>