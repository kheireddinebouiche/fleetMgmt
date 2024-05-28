<?php 
session_start();
require("getter/connect.php");


 if(isset($_SESSION["id"])){
     
     $id = $_SESSION["id"];
 
     $req = mysqli_query($cnx,"SELECT * FROM suivie_affectation WHERE id_user='$id' and etat='en cours' or etat='pause' ");
     $result = mysqli_fetch_assoc($req);
     $id_vehicule = $result["id_vehicule"];
     $mode = $result["mode"];
     $etat= $result["etat"];
     
     $vehic_req = mysqli_query($cnx,"SELECT * FROM voitures WHERE id='$id_vehicule'");
     $details_vehicule = mysqli_fetch_assoc($vehic_req);
     
     $vid = mysqli_query($cnx, "SELECT * FROM vidanges WHERE id_vehicule='$id_vehicule' and etat='1' ");
     $km_vidange = mysqli_fetch_assoc($vid);
     
     $ges_chaine = mysqli_query($cnx,"SELECT * FROM ges_chaine WHERE id_vehicule='$id_vehicule' ");
     $rff = mysqli_fetch_assoc($ges_chaine);
     
     $maint = mysqli_query($cnx, "SELECT * FROM maintenance WHERE id_vehicule='$id_vehicule' ");
     
     if($etat=="Pause"){
      
      $find_vehic = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_vehicule='$id_vehicule' and etat='en cours' and mode='Temporaire' ");
      $res = mysqli_fetch_assoc($find_vehic);
      
      $id_user_new = $res["id_user"];
      $find_user = mysqli_query($cnx,"SELECT * FROM user WHERE id='$id_user_new' ");
      $resfin_us = mysqli_fetch_assoc($find_user);
         
     }
     
     if(mysqli_num_rows($req) > 0){
         
         
     }else{
         
         
         $_SESSION["status"] = "Vous n'avez aucune affectation pour le moment";
         $_SESSION["success"] = 0;
         
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
        <title>Fleet Management| Détails de l'affectation </title>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mon affectation</a></li>
                                            <li class="breadcrumb-item active">Détails de l'affectation</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Détails de l'affectation</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <!-- Gestion vidange et maintenance -->
                        <div class="row">
                            <div class="col-lg-6" <?php if($mode == "Temporaire"){echo "hidden";}?>>
                                <div class="card ribbon-box">
                                    <div class="card-body">
                                        <div class="ribbon ribbon-warning float-start"><i class="mdi mdi-access-point me-1"></i> Vidange du véhicule </div>
                                        
                                        <div class="ribbon-content">
                                            <p class="mb-0">Prochaine vidange à prévoir : <b> <?php echo $km_vidange["futur_km"]," km"; ?> </b></p>
                                            
                                            <center><a href="" class="btn btn-warning text-white mt-3 waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#vidange-new-modal"> Effectuer </a> </center>
                                        </div>
                                    </div>
                                </div>
                        </div>
                            <div class="col-lg-6" <?php if($mode == "Temporaire"){echo "hidden";}?>>
                                <div class="card ribbon-box">
                                    <div class="card-body">
                                        <div class="ribbon ribbon-danger float-start"><i class="mdi mdi-access-point me-1"></i> Maintenance du véhicule </div>
                                        
                                        <div class="ribbon-content" id="check_chaine">
                                            
                                            
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fin Gestion vidange et maintenance -->
                        
                        <!-- Information sur l'affectation -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="ps-xl-3 mt-3 mt-xl-0">
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                
                                                            <h4>Informations du véhicule :</h4>
                                                            <hr>
                                                            <div>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Véhicule : <?php echo $details_vehicule["vehicule"]; ?> </p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Motorisation : <?php echo $details_vehicule["motorisation"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Immatriculation : <?php echo $details_vehicule["num_immatriculation"]; ?></p>
                  
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                
                                                            <h4>Informations de l'affectation :</h4>
                                                            <hr>
                                                            <div>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Date de début : <?php echo $result["date_debut"]; ?> / Heure : <?php echo $result["h_debut"]; ?> </p>
                                                                <p <?php if($mode=="Definitif"){ echo "hidden"; } ?>><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Date de fin : <?php echo $result["date_fin"]; ?> / Heure : <?php echo $result["h_fin"]; ?></p>
                                                                <p><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary me-2"></i>Mode d'affectation : <?php echo "<span class='badge bg-primary'>$mode</span>"; ?></p>
                                                               
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
    
                                                    <div>
                                                        <center>     
                                                         
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#affecter-mon-vehicule-modal" <?php if($etat != "en cours"){echo "hidden";} ?> class="btn btn-warning waves-effect waves-light text-white">
                                                              <b> Emprunter mon véhicule </b>
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
                        <!-- fin Information sur l'affectation -->
                        
                        <!-- Affectation du véhicule pour autre conducteur -->
                        <div <?php if($etat=="en cours" or $etat=="annulé"){echo "hidden"; }?> class="col-lg-12">
                            <div class="card ribbon-box">
                                <div class="card-body">
                                    <div class="ribbon ribbon-blue float-start"><i class="mdi mdi-access-point me-1"></i> Affectation de votre véhicule </div>
                                    
                                    <div class="ribbon-content">
                                        <p class="mb-0">Vous avez affecter votre véhicule à : <b> <?php echo $resfin_us["username"]; ?> </b></p>
                                        <p class="mb-0"><b>A compter du :</b> <?php echo $res["date_debut"]; ?> <b> Au </b> <?php echo $res["date_fin"]; ?> </p>
                                        <center><a href="user_end_affectation.php?id=<?php echo $id_user_new;?>&id_owner=<?php echo $id; ?>" onclick='return checkEnd()' class="btn btn-warning text-white mt-3 waves-effect waves-light"> Terminer </a> </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fin Affectation du véhicule pour autre conducteur -->
                    
                        
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
                
                <!-- New vidange modal content -->
                <div id="vidange-new-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="text-center mt-2 mb-4">
                                    <div class="auth-brand">
                                        <div class="logo-box">
                                            <!-- Brand Logo Light -->
                                            <a href="#" class="logo-light">
                                               <img src="images/368FCE77.png" style="width:100px; height:60px;" alt="dark logo" class="logo-lg">
                                                <img src="images/368FCE77.png" style="width:70px; height:40px;" alt="small logo" class="logo-sm">
                                            </a>
                        
                                            <!-- Brand Logo Dark -->
                                            <a href="#" class="logo-dark">
                                                <img src="images/368FCE77.png" style="width:100px; height:60px;" alt="dark logo" class="logo-lg">
                                                <img src="images/368FCE77.png" style="width:70px; height:40px;" alt="small logo" class="logo-sm">
                                            </a>
                            </div>
                                    </div>
                                </div>
                                <hr>
                              <form action="user_new_vidange.php?id=<?php echo $id_vehicule; ?>" method="POST" class="px-3">
                                    <div class="mb-3">
                                        <label for="kilometrage" class="form-label">Kilometrage avant vidange : </label>
                                        <input class="form-control" type="text" value="<?php echo $km_vidange["futur_km"]," km"; ?>" readonly id="kilometrage" name="kilometrage" />
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="new_km" class="form-label">Nouveau kilometrage :</label>
                                        <input class="form-control" type="text" required="true" id="new_km" name="new_km" />
                                    </div>
                                    
                                    <label class="mb-2">Changement de filtres :</label>
                                    <div class="form-check">
                                      <input class="form-check-input" name="filtre_huile" type="checkbox" id="flexCheckDefault">
                                      <label class="form-check-label" for="flexCheckDefault">Changement filtre à huile</label>
                                    </div>
                                    
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="filtre_es_gas" id="flexCheckDefault1">
                                      <label class="form-check-label" for="flexCheckDefault1">Changement filtre à essence/gasoile</label>
                                    </div>
                                    
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="filtre_aire" id="flexCheckDefault2">
                                      <label class="form-check-label" for="flexCheckDefault2">Changement filtre à aire</label>
                                    </div>
                                    
                                    <div class="mt-2 mb-3">
                                        <label for="autre" class="form-label">Autre :</label>
                                        <input class="form-control" type="text" id="autre" name="autre" />
                                    </div>

                                    <div class="mb-2 text-center">
                                        <button class="btn rounded-pill btn-warning text-white" name="submit" type="submit">Enregistrer</button>
                                    </div>

                                </form>

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                
                <!-- Affecter mon véhicule -->
                <div id="affecter-mon-vehicule-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="text-center mt-2 mb-4">
                                    <div class="auth-brand">
                                        <div class="logo-box">
                                            <!-- Brand Logo Light -->
                                            <a href="#" class="logo-light">
                                               <img src="images/368FCE77.png" style="width:100px; height:60px;" alt="dark logo" class="logo-lg">
                                                <img src="images/368FCE77.png" style="width:70px; height:40px;" alt="small logo" class="logo-sm">
                                            </a>
                        
                                            <!-- Brand Logo Dark -->
                                            <a href="#" class="logo-dark">
                                                <img src="images/368FCE77.png" style="width:100px; height:60px;" alt="dark logo" class="logo-lg">
                                                <img src="images/368FCE77.png" style="width:70px; height:40px;" alt="small logo" class="logo-sm">
                                            </a>
                            </div>
                                    </div>
                                </div>
                                <hr>
                              <form action="user_affecter_mon_vehicule.php?id=<?php echo $id_vehicule; ?>" method="POST" class="px-3">
                                    <div class="mb-3">
                                        <label>Utilisateur :</label>
                                        <select class="form-control" name="next_user">
                                            
                                            <option value="">Veuillez selectionner un conducteur...</option>
                                            <hr>
                                            <?php
                                            
                                              $list_user=mysqli_query($cnx, "SELECT * FROM user");
                                              
                                              while($cur=mysqli_fetch_assoc($list_user)){
                                            ?>
                                               <option value="<?php echo $cur["id"];?>"><?php echo $cur["username"]; ?></option>
                                               
                                            <?php
                                              }
                                            ?>
                                                                                     
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="date_debut" class="form-label">Date de début :</label>
                                                <input class="form-control" type="date" required="true" id="date_debut" name="date_debut" />
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <label for="date_fin" class="form-label">Date de fin :</label>
                                                <input class="form-control" type="date" required="true" id="date_fin" name="date_fin" />
                                            </div>
                                            
                                        </div>
                                        
                                    </div>

                                 

                                    <div class="mb-2 text-center">
                                        <button class="btn rounded-pill btn-warning text-white" name="submit" type="submit">Enregistrer</button>
                                    </div>

                                </form>

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                
                <!-- New chaine modal content -->
                <div id="check-chaine-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                              <div class="text-center mt-2 mb-4">
                                    <div class="auth-brand">
                                        <div class="logo-box">
                                            <!-- Brand Logo Light -->
                                            <a href="#" class="logo-light">
                                               <img src="images/368FCE77.png" style="width:100px; height:60px;" alt="dark logo" class="logo-lg">
                                                <img src="images/368FCE77.png" style="width:70px; height:40px;" alt="small logo" class="logo-sm">
                                            </a>
                        
                                            <!-- Brand Logo Dark -->
                                            <a href="#" class="logo-dark">
                                                <img src="images/368FCE77.png" style="width:100px; height:60px;" alt="dark logo" class="logo-lg">
                                                <img src="images/368FCE77.png" style="width:70px; height:40px;" alt="small logo" class="logo-sm">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                
                              <form action="user_change_chaine.php?id=<?php echo $id_vehicule; ?>" method="POST" class="px-3">
                                    <div class="mb-3">
                                        <label for="kilometrage" class="form-label">Kilometrage avant changement chaine : </label>
                                        <input class="form-control" type="text" value="<?php echo $rff["km_change"]," km"; ?>" readonly id="kilometrage" name="prev_km" />
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="new_km" class="form-label">Nouveau kilometrage :</label>
                                        <input class="form-control" type="text" required="true" id="new_km" name="new_km_chaine" />
                                    </div>
                
                                                 
                
                                    <div class="mb-2 text-center">
                                        <button class="btn rounded-pill btn-warning text-white" name="submit" type="submit">Enregistrer</button>
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
        
        <script>

            function loadXMLDocChaine() {
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("check_chaine").innerHTML =
                  this.responseText;
                }
              };
              xhttp.open("GET", "user_check_chaine.php", true);
              xhttp.send();
            }
            setInterval(function(){
                loadXMLDocChaine();
            }, 1000);
            
            window.onload = loadXMLDocChaine;
        </script>
        
         <script language="JavaScript" type="text/javascript">
            function checkEnd(){
                return confirm("Voulez vous vraiment annuler l'affectation de votre véhicule ?");
            }
        </script>


    </body>
</html>

