<?php
session_start();
require("getter/connect.php");

if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){
    
if(isset($_GET["id"])){
    $id = $_GET["id"];
    
    $req = mysqli_query($cnx, "SELECT * FROM user WHERE id='$id' ");
    $result= mysqli_fetch_assoc($req);
    
    $affect = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_user='$id' ");
    
    $sinistre = mysqli_query($cnx, "SELECT * FROM sinistres WHERE conducteur='$id' ");

    
    $niveau = $result["niveau"];
    
    if($niveau == 1){
        $niv = "Administrateur";
    }else{
        if($niveau == 2){
            $niv = "Gestionnaire";
            
        }else{
            if($niveau == 3){
                $niv = "Utilisateur";
            }else{
                if($niveau == 4){
                    $niv = "Utilisateur Temporaire";
                }
            }
        }
        
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Utilisateurs</a></li>
                                            <li class="breadcrumb-item active">Détails de l'utilisateur</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Détails de l'utilisateur</h4>
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
                                                        <div class="col-md-6">
                                                            
                                                            <h4>Informations de l'utilisateur : </h4>
                                                            <hr>
                                                            
                                                            <div>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Nom d'utilisateur : <?php echo $result["username"]; ?> </p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Email : <?php echo $result["email"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>N° Permis de conduire : <?php echo $result["num_permis"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Type de compte: <?php echo $niv; ?></p>
                                                               
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            
                                                            <h4 >Autres informations : </h4>
                                                            <hr>
                                                            
                                                            <div>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>N° Identification : <?php echo $result["identification"]; ?> </p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>N° Mobile : <?php echo $result["mobile"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Compte crée le : <?php echo $result["created_at"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Dérniere mise à jour le : <?php echo $result["updated_at"]; ?></p>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
    
                                                    <div>
                                                        <center>                                       
                                                            <a href="update_utilisateur.php?id=<?php echo $id; ?> " class="btn btn-warning waves-effect waves-light"  style='width:220px;' >
                                                              <b> Modifier les informations </b>
                                                            </a>
                                            
                                                            <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#gen-pass-modal">Réenitialiser le mot de passe</button>
                                                            
                                                            <?php
                                                             if($result["etat"] == 0){
                                                            ?>
                                                            <a href="user_reactivate_profile.php?id=<?php echo $id; ?>&p=2" onclick="return checkActivate()" class="btn btn-success waves-effect waves-light"  style='width:220px;' >
                                                              <b> Activer </b>
                                                            </a>
                                                            
                                                            <?php
                                                             }else{
                                                                 ?>
                                                                 <a href="user_deactivate_profile.php?id=<?php echo $id; ?>&p=2 " onclick="return checkDeactivate()" class="btn btn-danger waves-effect waves-light"  style='width:220px;' >
                                                                   <b> Désactiver </b>
                                                                 </a>
                                                                 <?php
                                                             }
                                                             ?>
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
                        
                        <!--Autres informations de l'utilisateur -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-4">Autres informations</h4>
                                        <hr>
                                        <ul class="nav nav-pills navtab-bg nav-justified">
                                            <li class="nav-item">
                                                <a href="#affec" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                    Affectation
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#sinis" data-bs-toggle="tab" aria-expanded="false" class="nav-link ">
                                                    Sinistres
                                                </a>
                                            </li>
                                        </ul>
                                        
                                        <div class="tab-content">
                                            <div class="tab-pane show active " id="affec">        
                                            
                                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th>Vehicule</th>
                                                            <th>Mode d'emprunt</th>
                                                            <th>Date de debut</th>
                                                            <th>Date de fin</th>
                                                            <th> Etat </th>
                                                            <th>Actions</th>
                                                           
                                                        </tr>
                                                    </thead>
                                        
                                        
                                                    <tbody>
        
                                                    <?php 
                                                        while($row_aff=mysqli_fetch_array($affect)){
                                                            
                                                          $veh = $row_aff["id_vehicule"];
                                                        
                                                          $sql_veh = mysqli_query($cnx, "SELECT * FROM voitures WHERE id='$veh' ");
                                                          $r = mysqli_fetch_assoc($sql_veh);
                                                            
                                                          echo "<tr>";
                                                          echo "<td>".$r["vehicule"]."</td>";
                                                          echo "<td>".$row_aff["mode"]."</td>";
                                                          echo "<td>".$row_aff["date_debut"]."</td>";
                                                          echo "<td>".$row_aff["date_fin"]."</td>";
                                                          echo "<td>".$row_aff["etat"]."</td>";
                                                          
                                                          echo "<td><center><a href='details_affectation.php?id=".$row_aff[id]." ' class='btn btn-primary'>Détails</a> </center></td>" ;
                                                          echo "</tr>";
                                                        }
                                                    ?>
                                                    </tbody>
                                                </table>
                                                
                                            </div>
                                            
                                            <div class="tab-pane " id="sinis">
                                                
                                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>Vehicule</th>
                                                            <th>Date du sinistre</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    
                                                      if(mysqli_num_rows($sinistre)>0){
                                                      
                                                        while($row_sin=mysqli_fetch_array($sinistre)){
                                                            
                                                          $sin_veh = $row_sin["id_voiture"];
                                                            
                                                          $sql_sin = mysqli_query($cnx, "SELECT * FROM voitures WHERE id='$sin_veh' ");
                                                          $reer = mysqli_fetch_assoc($sql_sin);
                                                            
                                                          echo "<tr>";
                                                          echo "<td>".$reer["vehicule"]."</td>";
                                                          echo "<td>".$row_sin["created_at"]."</td>";
                                                          echo "<td><center><a href='details_sinistre.php?id=".$row_sin["id"]." ' class='btn btn-primary'>Détails</a> </center></td>" ;
                                                          echo "</tr>";
                                                        }
                                                      }else{
                                                          
                                                          echo "<tr>";
                                                          echo "<td colspan='3'><center>Aucune information.</center></td>";
                                                          echo "</tr>";
                                                      }
                                                    ?>
                                                    </tbody>
                                                </table>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!--fin Autres informations de l'utilisateur -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->
                
                <!-- SignIn modal content -->
                <div id="gen-pass-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="text-center mt-2 mb-4">
                                    <div class="auth-brand">
                                        <div class="logo-box">
                                            <!-- Brand Logo Light -->
                                            <a href="index.html" class="logo-light">
                                               <img src="images/368FCE77.png" style="width:100px; height:60px;" alt="dark logo" class="logo-lg">
                                                <img src="images/368FCE77.png" style="width:70px; height:40px;" alt="small logo" class="logo-sm">
                                            </a>
                        
                                            <!-- Brand Logo Dark -->
                                            <a href="index.html" class="logo-dark">
                                                <img src="images/368FCE77.png" style="width:100px; height:60px;" alt="dark logo" class="logo-lg">
                                                <img src="images/368FCE77.png" style="width:70px; height:40px;" alt="small logo" class="logo-sm">
                                            </a>
                            </div>
                                    </div>
                                </div>
                                <hr>
                              <form action="update-user-password.php?id=<?php echo $id; ?> " method="POST" class="px-3">
                                    <div class="mb-3">
                                        <label for="password1" class="form-label">Mot de passe :</label>
                                        <input class="form-control" type="password" required="" id="password1" name="password1" placeholder="Mot de passe ....">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="password2" class="form-label">Confirmation du mot de passe :</label>
                                        <input class="form-control" type="password" required="" id="password2" name="password2" placeholder="Confirmation du mot de passe ....">
                                    </div>

                                 

                                    <div class="mb-2 text-center">
                                        <button class="btn rounded-pill btn-warning" type="submit">Confirmer les modifications</button>
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
        
        
        <script>
            function confirmation(){
              var result = confirm("Voulez vous vraiment supprimé le fichier ?");
              
              if(result){
                return true;
              }else{
                  return false;
              }
            }
        </script>
        
        <script language="JavaScript" type="text/javascript">
            function checkDeactivate(){
                return confirm('Voulez vous vraiment désactiver le compte ?');
            }
            
            function checkActivate(){
                return confirm('Voulez vous vraiment activer le compte ?');
            }
        </script>

    </body>
</html>