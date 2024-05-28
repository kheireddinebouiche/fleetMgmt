<?php
  session_start();
  require('getter/connect.php');
  
  if($_SESSION['niveau'] == 1 or $_SESSION['niveau'] == 2){
      if(isset($_SESSION["id"])){
      
      $req = mysqli_query($cnx, "SELECT * FROM user");
      
      }else{
          header("Location:index.php");
      }

  }else{
      
      header("Location:index.php");
  }
  
  if(isset($_SESSION["id"])){
      
      $req = mysqli_query($cnx, "SELECT * FROM user");
      
  }else{
      header("Location:index.php");
  }

  

?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Fleet Management | Liste des utilisateurs</title>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Utilisateurs</a></li>
                                            <li class="breadcrumb-item active">Liste des véhicules</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Utilisateurs</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    
                                    <div class="card-header">
                                        <a href="ajouter-utilisateur.php" class="btn btn-success">Ajouter un utilisateur</a>
                                    </div>
                                    <div class="card-body">
            
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Nom d'utilisateur</th>
                                                    <th>@ Email</th>
                                                    <th>Date d'inscription</th>
                                                    <th>N° permis de conduire</th>
                                                    <th>Niveau d'accès</th>
                                                    <th>Actions</th>
                                                   
                                                </tr>
                                            </thead>
                                        
                                        
                                            <tbody>

                                            <?php 
                                                while($row=mysqli_fetch_array($req)){
                                                    if($row["niveau"] == 1){
                                                       $role = "Administrateur";
                                                     }else{
                                                      if($row["niveau"] == 2){
                                                          $role = "Géstionnaire";
                                                      }else{
                                                          if($row["niveau"] == 3){
                                                              $role = "Utilisateur";
                                                          }else{
                                                              if($row["niveau"] == 4){
                                                                  $role = "Utilisateur Temporaire";
                                                              }
                                                          }
                                                      }
                                                  }
                                            ?>
                                                  <tr>
                                                      <td><?php echo $row["username"]; ?></td>
                                                      <td><?php echo $row["email"]; ?></td>
                                                      <td><?php echo $row["created_at"]; ?></td>
                                                      <td><?php echo $row["num_permis"]; ?></td>
                                            
                                                  <td> <?php echo $role; ?></td>
                                                  <td><center>
                                                                <a href="details_utilisateur.php?id=<?php echo $row['id']; ?>" class='btn btn-primary'>Détails</a> 
                                                                <a href="update_utilisateur.php?id=<?php echo $row['id']; ?>" class='btn btn-warning'>Modifier</a>
                                                                <?php if($row["etat"] == 1 ){ ?>
                                                                   <a href='user_deactivate_profile.php?id=<?php echo $row['id']; ?>&p=1' onclick="return checkDelete()" class='btn btn-danger'>Désactiver</a> 
                                                                <?php       
                                                                }else{
                                                                   ?> 
                                                                    <a href="user_reactivate_profile.php?id=<?php echo $row['id'];?>&p=1" onclick="return checkActive() " class='btn btn-success'>Activer</a> 
                                                                    <?php
                                                                }
                                                             ?>
                                                            
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
                return confirm('Voulez vous vraiment désactiver le profile ?');
            }
            
             function checkActive(){
                return confirm('Voulez vous vraiment activer le profile ?');
            }
        </script>
    </body>
</html>