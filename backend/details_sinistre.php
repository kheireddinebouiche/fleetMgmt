<?php
session_start();
require("check_session.php");
require("getter/connect.php");

if(isset($_GET["id"])){
    $id=$_GET["id"];
    
    $req = mysqli_query($cnx,"SELECT * FROM sinistres WHERE id='$id'");
    $result = mysqli_fetch_assoc($req);
    $id_voiture = $result["id_voiture"];
    $id_user = $result["conducteur"];
    
    $vehicule = mysqli_query($cnx, "SELECT * FROM voitures WHERE id='$id_voiture' ");
    $find_voiture = mysqli_fetch_assoc($vehicule);
    $nom_vehicule = $find_voiture["vehicule"];
    
    $user = mysqli_query($cnx, "SELECT * FROM user WHERE id='$id_user' ");
    $find_user = mysqli_fetch_assoc($user);
    $nom_conducteur = $find_user["username"];
    
    
    $file = mysqli_query($cnx, "SELECT * FROM documents_sinistre WHERE id_sinistre='$id' ");
    
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Fleet Management| Détails du sinistre </title>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Sinistres</a></li>
                                            <li class="breadcrumb-item active">Détails du sinistre</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Détails du sinistre</h4>
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
                                                            
                                                            <h4>Informations du sinistre : </h4>
                                                            <hr>
                                                            
                                                            <div>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Numéro de dossier : <?php echo $result["num_dossier"]; ?> </p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Véhicule : <?php echo $nom_vehicule; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Conducteur : <?php echo $nom_conducteur; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Date du sinistre : <?php echo $result["date_sinistre"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Lieu du sinistre : <?php echo $result["lieu"]; ?></p>
            
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Description : <?php echo $result["description"]; ?></p>
                                                                
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Montant de réparation : <?php echo $result["mnt_reparation"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Montant de remboursement : <?php echo $result["mnt_rembour"]; ?></p>
                                                                
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Dossier crée le : <?php echo $result["created_at"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Dossier mis à jour le : <?php echo $result["updated_at"]; ?></p>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
    
                                                    <div>
                                                        <center>                                       
                                                            <a href="update_sinistre.php?id=<?php echo $id; ?> "  class="btn btn-warning waves-effect waves-light"  style='width:100px;' >
                                                              <b> Modifier</b>
                                                            </a>
                                                            
                                                            
                                                            <?php
                                                              if($result["etat"] == 1){
                                                            ?>  
                                                               <a href='deactivate_sinistre.php?id=<?php echo $id; ?>' onclick='return archive()' style='width:100px;' class='btn btn-danger waves-effect waves-light'>Archiver</a>
                                                            <?php
                                                              }else{
                                                            ?>
                                                            
                                                              <a href='deactivate_sinistre.php?id=<?php echo $id; ?>' onclick='return activate()' style='width:100px;' class='btn btn-success waves-effect waves-light'>Activer</a>
                                                            <?php
                                                              }
                                                            ?>
                                                            
                                                            
                                                            
                                                        </center> 
                                                    </div>
                                                    
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                        
                                         <hr></hr>
                                    
                                        
                                        <div class="table-responsive mt-4">
                                            <div class="row col-md-8 mb-3">
                                                <div class="col-md-3">
                                                    <h4><u> Documents joint : </u></h4>
                                                </div>
                                                
                                                <div class="col-md-9">
                                                    <a href="up_file_sinistre.php?id=<?php echo $id; ?> " class="btn btn-primary float-left" >Joindre un fichier </a>
                                                </div>
                                                
                                            </div>
                                        
                                            <table class="table table-striped dt-responsive nowrap w-100"  id="datatable-buttons"  >
                                                <thead class="table-light">
                                                    <tr>
                                                       
                                                        <th>Lien</th>
                                                        <th>Ajouté le</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <?php
                                                      while($row = mysqli_fetch_assoc($file)){
                                                          
                                                         echo "<tr>";
                                                         
                                                            
                                                             echo "<td>".$row["link"]."</td>";
                                                             echo "<td>".$row["created_at"]."</td>";
                                                             
                                                             echo " <td>
                                                                      <div class='row'>
                                                                           <div class='col-md-12'>
                                                                           <center>
                                                                             <a href='upload/$row[link]' class='btn btn-primary'>Aperçu</a></nobr>
                                                                             <a href='upload/$row[link]' class='btn btn-success' download >Telecharger</a></nobr>
                                                                             <a href='del_file_sinistre.php?id=$row[id]'  onclick='return confirmation()' class='btn btn-danger' >Supprimer</a>
                                                                           </center>
                                                                            </div>
                                                                      </div>
                                                                    </td> ";
                                                             
                                                             
                                                         echo "</tr>";
                                                          
                                                      }
                                                     
                                                     
                                                   ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        
                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col-->
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
            function confirmation(){
              return confirm('Voulez vous vraiment supprimer le fichier ?');
            }
            
            function archive(){
              return confirm('Voulez vous vraiment archivé le dossier ?');
            }
            
            function activate(){
              return confirm('Voulez vous vraiment reactivé le dossier ?');
            }
        </script>

    </body>
</html>