<?php
session_start();
require("getter/connect.php");


if(isset($_SESSION["id"])){
    
    if($_SESSION["niveau"] == 1 or $_SESSION["niveau"]== 2){
        if(isset($_GET["id"])){
    
            $id = $_GET["id"];
            
            $req=mysqli_query($cnx,"SELECT * FROM voitures WHERE id='$id' ");
            $result = mysqli_fetch_assoc($req);
            
            if(mysqli_num_rows($req)>0){
                
                $ident = $result["id"];
                $marque = $result["marque"];
                $label = $result["vehicule"];
                $n_serie = $result["numero_serie"];
                $n_imm = $result["num_immatriculation"];
                $prem_circulation = $result["premiere_circulation"];
                $moto = $result["motorisation"];
                $img = $result["image"];
                
                $assurance= $result["date_assurance"];
                $control = $result["date_controle"];
                $vignette = $result["date_vignette"];
                
                $created = $result["created_at"];
                $last_upd = $result["updated_at"];
                
            }
            
            $file = mysqli_query($cnx, "SELECT * FROM documents_voiture WHERE id_vehicule='$id' ");
            
            $affectation = mysqli_query($cnx,"SELECT * FROM suivie_affectation WHERE id_vehicule='$id' ");
            $vidanges = mysqli_query($cnx,"SELECT * FROM vidanges WHERE id_vehicule='$id' ");
            $sinistres = mysqli_query($cnx,"SELECT * FROM sinistres WHERE id_voiture='$id' ");
    
    
        }else{
            
            header("Location:index.php");
        }
    }else{
        
    }
    
}else{
    header("Location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Fleet Management| Détails du véhicule </title>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Véhicules</a></li>
                                            <li class="breadcrumb-item active">Détails du véhicule</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Détails du véhicule</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-5">
    
                                                <div class="tab-content pt-0">
                                                    <div class="tab-pane active show" id="product-1-item">
                                                        <?php
                                                          
                                                          if(strlen($img) > 4){
                                                              echo "<img src='images/$img' alt='' class='img-fluid mx-auto d-block rounded' style='height:500px; width:500px;'>";
                                                          }else{
                                                              echo "<img src='images/no_image.png' alt='' class='img-fluid mx-auto d-block rounded' style='height:500px; width:500px;'>";
                                                          }
                                                          
                                                        ?>
                                                    </div>
                                                    <div class="row">
                                                        <a href="up_image_vehic.php?id=<?php echo $id;  ?>" class="btn btn-warning mx-auto" style='width:500px;'> <b>Modifier la photo</b></a>
                                                    </div>
          
                                                </div>                                      
                                            </div> <!-- end col -->
                                            
                                           
                                            
                                            <div class="col-lg-7">
                                                <div class="ps-xl-3 mt-3 mt-xl-0">
                                                    <a href="#" class="text-primary"><?php echo $marque; ?> </a>
                                                    <h4 class="mb-3"> <?php echo $label; ?> </h4>
                                                    
                                                     <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            
                                                            <h4>Informations du véhicule : </h4>
                                                            <hr>
                                                            
                                                            <div>
                                                                
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Numéro de série : <?php echo $n_serie; ?> </p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Numéro d'immatriculation : <?php echo $n_imm; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Numéro carte grise : <?php echo $result["carte_grise"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Motorisation : <?php echo $moto; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Ancien immatriculation : <?php echo $result["ancien_imm"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Date de mise en circulation : <?php echo $prem_circulation; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Assurance : <?php if($assurance == NULL) {echo "Aucune date configurer";} else{ echo $assurance; } ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Control Technique : <?php if($control == NULL) {echo "Aucune date configurer";} else{ echo $control; } ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i> Vignette : <?php if($vignette == NULL) {echo "Aucune date configurer";} else{ echo $vignette; } ?></p>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
    
                                                    <div>
                                
                                                        <a href="update_voiture.php?id=<?php echo $id; ?> "  class="btn btn-warning waves-effect waves-light"  style='width:100px;' >
                                                          <b> Modifier</b>
                                                        </a>
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
                                                    <a href="up_file_vehic.php?id=<?php echo $id; ?> " class="btn btn-primary float-left" >Joindre un fichier </a>
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
                                                                             <a href='upload/$row[link]'  class='btn btn-primary' >Aperçu</a></nobr>
                                                                             <a href='upload/$row[link]'  class='btn btn-success' download >Telecharger</a></nobr>
                                                                             <a href='del_file_vehic.php?id=$row[id]'  onclick='return checkDelete()' class='btn btn-danger' >Supprimer</a>
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
                        
                        <!--Autres informations de la voiture -->
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
                                            <li class="nav-item">
                                                <a href="#vidan" data-bs-toggle="tab" aria-expanded="false" class="nav-link ">
                                                    Vidanges
                                                </a>
                                            </li>
                                        </ul>
                                        
                                        <div class="tab-content">
                                            
                                            <!-- Historique des affectations -->
                                            <div class="tab-pane show active " id="affec">        
                                            
                                                <table class="table table-striped dt-responsive nowrap w-100"  id="datatable-buttons"  >
                                                <thead class="table-light">
                                                    <tr>
                                                       
                                                        <th>Conducteur</th>
                                                        <th>Mode d'affectation</th>
                                                        <th>Date début</th>
                                                        <th>Date fin</th>
                                                        <th>Créer le.</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <?php
                                                    
                                                     if(mysqli_num_rows($affectation) > 0 ){
                                                      while($row = mysqli_fetch_assoc($affectation)){
                                                          
                                                          $username = mysqli_fetch_assoc(mysqli_query($cnx,"SELECT username FROM user WHERE id='$row[id_user]' "));
                                                    ?>   
                                                         <tr>
                                                             <td><?php echo $username["username"] ?></td>
                                                             <td><?php echo $row["mode"] ?></td>
                                                             <td><?php echo $row["date_debut"]; ?> <?php echo $row['h_debut']; ?></td>
                                                             <td><?php echo $row["date_fin"]; ?> <?php echo $row['h_fin']; ?></td>
                                                             <td><?php echo $row["created_at"] ?></td>
                                                         </tr>
                                                      <?php    
                                                      }
                                                     }else{
                                                         ?>
                                                            <tr>
                                                                <td colspan="5"><center><b>Le véhicule n'a aucun historique d'affectation</b></center></td>
                                                            </tr>
                                                         <?php
                                                     }
                                                   ?>
                                                </tbody>
                                            </table>
                                                
                                            </div>
                                            
                                            <!-- Historique des sinistres -->
                                            <div class="tab-pane " id="sinis">
                                                
                                                <table class="table table-striped dt-responsive nowrap w-100"  id="datatable-buttons"  >
                                                <thead class="table-light">
                                                    <tr>
                                                       
                                                        <th>Date du sinistre</th>
                                                        <th>Observation</th>
                                                        <th>N° Dossier Assurance</th>
                                                        <th>Créer le.</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <?php
                                                    
                                                     if(mysqli_num_rows($sinistres) > 0 ){
                                                      while($row = mysqli_fetch_assoc($sinistres)){
                                                          
                                                         
                                                    ?>   
                                                         <tr>
                                                             <td><?php echo $row["date_sinistre"] ?></td>
                                                             <td><?php echo $row["description"] ?></td>
                                                             <td><?php echo $row["num_dossier"]; ?></td>
                                                             <td><?php echo $row["created_at"] ?></td>
                                                         </tr>
                                                      <?php    
                                                      }
                                                     }else{
                                                         ?>
                                                            <tr>
                                                                <td colspan="5"><center><b>Le véhicule n'a aucun historique de sinistre.</b></center></td>
                                                            </tr>
                                                         <?php
                                                     }
                                                   ?>
                                                </tbody>
                                            </table>
                                                
                                            </div>
                                            
                                            <!-- Historique des vidanges -->
                                            <div class="tab-pane " id="vidan">
                                                
                                               <table class="table table-striped dt-responsive nowrap w-100"  id="datatable-buttons"  >
                                                <thead class="table-light">
                                                    <tr>
                                                       
                                                        <th>Date de la vidange</th>
                                                        <th>Etat</th>
                                                        <th>Km pour vidange </th>
                                                        <th>Kilometrage Réel</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <?php
                                                    
                                                     if(mysqli_num_rows($vidanges) > 0 ){
                                                      while($row = mysqli_fetch_assoc($vidanges)){
                                                          
                                                         
                                                    ?>   
                                                         <tr>
                                                             <td>
                                                                 
                                                                 <?php if(!is_null($row['date'])) {echo $row['date']; } else{ echo "<b>Pas encore effectué.</b>";}?>
                                                                 
                                                             </td>
                                                             
                                                             <td><?php if($row["etat"]== 1){ ?>
                                                               <span class="badge bg-success"><?php echo "Prochaine vidange"; ?></span> 
                                                                 <?php
                                                                   }else{
                                                                       
                                                                       echo "<span class='badge bg-danger'>Vidange effecuté </span>";
                                                                   }
                                                                 ?>
                                                             </td>
                                                             <td><?php echo $row["futur_km"] ?></td>
                                                             <td><?php echo $row["actual_km"]; ?></td>
                                                             
                                                         </tr>
                                                      <?php    
                                                      }
                                                     }else{
                                                         ?>
                                                            <tr>
                                                                <td colspan="4"><center><b>Le véhicule n'a aucun historique de vidange.</b></center></td>
                                                            </tr>
                                                         <?php
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
                        <!--fin Autres informations de la voiture -->
                        
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
                return confirm('Voulez vous vraiment supprimer le véhicule ?');
            }
        </script>

    </body>
</html>