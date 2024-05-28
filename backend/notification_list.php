<?php
session_start();
require("check_session.php");
require("getter/connect.php");

$user_id = $_SESSION["id"];

$req = mysqli_query($cnx,"SELECT * FROM notifications WHERE id_user='$user_id' ");


?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Fleet management | Liste des notifications </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- third party css -->
        <link href="assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Notifications</a></li>
                                            <li class="breadcrumb-item active">Liste des notifications</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Liste des notifications</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                      

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                                                <thead>
                                                <tr>
                                                    <th> Id # </th>
                                                    <th>Titre</th>
                                                    <th>Contenu</th>
                                                    <th>Créer le </th>
                                                    <th>Etat</th>
                                                    <th class="hidden-sm">Action</th>
                                                </tr>
                                                </thead>
        
                                                <tbody>
                                                
                                                <?php
                                                  while($cur=mysqli_fetch_assoc($req)){
                                                      
                                                ?>
                                                <tr>
                                                    <td><b><?php echo $cur["id"];?></b></td>
                                                    <td> <?php echo $cur["titre"];?> </td>
        
                                                    <td><?php echo $cur["contenu"];?></td>
        
                                                    <td><?php echo $cur["created_at"];?></td>
        
        
                                                    <td><?php if($cur["etat"]=="readed"){ echo "<span class='badge bg-success'> Lu </span>"; } else { echo "<span class='badge bg-warning'> Non Lu </span>"; } ;?></td>
                                                    
                                                        
                                                 
                                                    <td>
                                                        <div class="btn-group dropdown">
                                                            <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="notification_details.php?id=<?php echo $cur["id"]; ?> "><i class="mdi mdi-pencil me-2 text-muted font-18 vertical-middle"></i>Détails</a>
                                                                
                                                                <a class="dropdown-item" href="notification_delete.php?id=<?php echo $cur["id"]; ?>"><i class="mdi mdi-delete me-2 text-muted font-18 vertical-middle"></i>Supprimer</a>
                                                                
                                                                <?php 
                                                                  if($cur["etat"] == "readed"){
                                                                ?>
                                                                  <a class="dropdown-item" href="notification_mark_as_unread.php?id=<?php echo $cur["id"]; ?>"><i class="mdi mdi-star me-2 font-18 text-muted vertical-middle"></i>Marquer comme non lu</a>
                                                                  
                                                                <?php
                                                                  }else{
                                                                      ?>
                                                                         <a class="dropdown-item" href="notification_mark_as_read.php?id=<?php echo $cur["id"]; ?>"><i class="mdi mdi-star me-2 font-18 text-muted vertical-middle"></i>Marquer comme lu</a>
                                                                      <?php
                                                                  }
                                                                ?> 
                                                                
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                                <?php
                                                  }
                                                 ?> 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
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

        <!-- third party js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
        <!-- third party js ends -->

        <!-- Tickets js -->
        <script src="assets/js/pages/tickets.js"></script>

        
    </body>
</html>