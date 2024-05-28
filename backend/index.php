<?php

session_start();
require("check_session.php");
require("getter/connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d');


if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2 ){
    
    
    $req = mysqli_query($cnx, "SELECT * FROM voitures" );
    $co = mysqli_num_rows($req);
    
    
    $req1 = mysqli_query($cnx, "SELECT * FROM sinistres WHERE etat='1' " );
    $co1 = mysqli_num_rows($req1);
    
    $req2 = mysqli_query($cnx, "SELECT * FROM sinistres WHERE etat='0' " );
    $co2 = mysqli_num_rows($req2);
    
    
    $req3 = mysqli_query($cnx,"SELECT * FROM suivie_affectation WHERE etat='en cours'  ");
    $req31 = mysqli_query($cnx,"SELECT * FROM suivie_affectation WHERE etat='en cours' LIMIT 5 ");
    $number = mysqli_num_rows($req3);
    
    $req4 = mysqli_query($cnx, "SELECT * FROM vidanges WHERE etat = '1' LIMIT 5 ");
    
    
    
    $assu = mysqli_query($cnx," SELECT id, vehicule, date_assurance FROM voitures WHERE date_assurance != ' '");
    $response=array();
    
    while($da=mysqli_fetch_assoc($assu)){
 
        if((((strtotime($da["date_assurance"]) - strtotime($curdate))) / (60 * 60 * 24) ) < 30 ){
            
            $response[$da['vehicule']] = $da['date_assurance'];
            
        }
    }
    
    $controle = mysqli_query($cnx," SELECT id, vehicule, date_controle FROM voitures WHERE date_controle != ' '");
    $resp=array();
    
    while($dat=mysqli_fetch_assoc($controle)){
 
        if((((strtotime($dat["date_controle"]) - strtotime($curdate))) / (60 * 60 * 24) ) < 30 ){
            
            $resp[$dat['vehicule']] = $dat['date_controle'];
            
        }
    }
    
    $vignette = mysqli_query($cnx," SELECT id, vehicule, date_vignette FROM voitures WHERE date_vignette != ' '");
    $respe=array();
    
    while($dayt=mysqli_fetch_assoc($vignette)){
 
        if((((strtotime($dayt["date_vignette"]) - strtotime($curdate))) / (60 * 60 * 24) ) < 30 ){
            
            $respe[$dayt['vehicule']] = $dayt['date_vignette'];
            
        }
    }
}else{
    
        $myid = $_SESSION["id"];
    
        $myaff = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_user ='$myid' and etat='en cours' ");
        $myvehi = mysqli_fetch_array($myaff);
        $vehi_id = $myvehi["id_vehicule"];
        
        $myveh_vid  = mysqli_query($cnx, "SELECT * FROM vidanges WHERE id_vehicule = '$vehi_id' and etat = '1' ");
        $km_next_vidange = mysqli_fetch_array($myveh_vid);
    
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Tableau de bord</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Plugins css -->
        <link href="assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     
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
                                    <h4 class="page-title">Tableau de bord</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                    
                        <div <?php if($_SESSION["niveau"] == 3){echo "hidden";} ?> class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-primary border-primary border shadow ">
                                                    <i class="mdi mdi-36px  mdi-car avatar-title text-white" style="padding:14px;"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <h3 class="text-dark mt-1"><?php echo $co; ?></h3>
                                                    <p class="text-muted mb-1 text-truncate">Parc Automobile</p>
                                                    <a href="list-vehicules.php"><p class="text-muted mb-1 text-truncate"><u>Afficher</u></p></a>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->
                            
                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-warning border-primary border shadow ">
                                                    <i class="mdi  mdi-36px  mdi-car-arrow-right avatar-title text-white" style="padding:14px;"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <h3 class="text-dark mt-1"><?php echo $number; ?></h3>
                                                    <p class="text-muted mb-1 text-truncate">Affectation en cours</p>
                                                    <a href="list_affectations.php"><p class="text-muted mb-1 text-truncate"><u>Afficher</u></p></a>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-success border-success border shadow">
                                                    <i class="fa fa-file fa-3x avatar-title text-white" style="margin:15px;" ></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $co1; ?></span></h3>
                                                    <p class="text-muted mb-1 text-truncate">Sinistres en cours</p>
                                                    <a href="list_sinistres.php"><p class="text-muted mb-1 text-truncate"><u>Afficher</u></p></a>
                                                    
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col--> 

                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-info border-info border shadow">
                                                    <i class="fa fa-file-archive-o fa-3x avatar-title text-white" style="margin:15px;" ></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $co2; ?></span></h3>
                                                    <p class="text-muted mb-1 text-truncate">Sinistres archivé</p>
                                                     <a href="archive_sinistre.php"><p class="text-muted mb-1 text-truncate"><u>Afficher</u></p></a>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                        </div>
                        <!-- end row-->

                   
                        <div <?php if($_SESSION["niveau"] == 3){echo "hidden";} ?> class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <div style="justify-content:space-between;display: flex;">
                                            <div><h4 class="header-title mb-3">Affectation en cours (5 Dernières )</h4> </div> 
                                            <div><a href="list_affectations.php"><u>Afficher tous</u></a></div>
                                        </div>
                                        
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Conducteur</th>
                                                        <th>Véhicule</th>
                                                        <th>Mode D'affectation</th>
                                                        <th>Date de début</th>
                                                        <th>Date de fin </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <?php 
                                                       
                                                       if(mysqli_num_rows($req31)){
                                                           
                                                       
                                                          while($cur=mysqli_fetch_assoc($req31)){
                                                              
                                                              $con=mysqli_query($cnx, "SELECT * FROM user WHERE id='$cur[id_user] ' ");      
                                                              $cond = mysqli_fetch_assoc($con);
                                                              
                                                              $veh=mysqli_query($cnx, "SELECT * FROM voitures WHERE id='$cur[id_vehicule] ' ");      
                                                              $vehi = mysqli_fetch_assoc($veh);
                                                    ?>
                                                   <tr>
                                                        
                                                        <td> <?php echo $cond["username"]; ?></td>

                                                        <td> <?php echo $vehi["vehicule"]; ?> </td>

                                                        <td> <?php echo $cur["mode"]; ?> </td>

                                                        <td> <?php echo $cur["date_debut"]; ?> </td>

                                                        <td> <?php if($cur["mode"]=="Definitive"){echo "----";}else{echo $cur["date_fin"];}  ?> </td>

                                                    </tr>
                                                  
                                                    <?php
   
                                                      }
                                                      
                                                       }else{
                                                           ?>
                                                            <tr colspan="5"><td>Aucune affectation pour le moment.</td></tr>
                                                           <?php
                                                       }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">

                                        <div style="justify-content:space-between;display: flex;">
                                            <div> <h4 class="header-title mb-3">Prochaines vidanges (5 Dernières )</h4></div> 
                                            <div><a href="suivie_vidange.php"><u>Afficher tous</u></a></div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-nowrap table-hover table-centered m-0">

                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Véhicule</th>
                                                        <th>Km Actuel</th>
                                                        <th>Prochiane vidange</th>
                                                        <th>Créer le</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <?php
                                                    
                                                     if(mysqli_num_rows($req4)){
                                                      while($vid = mysqli_fetch_assoc($req4)){
                                                          
                                                         $vehc = mysqli_query($cnx,"SELECT * FROM voitures WHERE id='$vid[id_vehicule]' ");
                                                         $nom_veh = mysqli_fetch_assoc($vehc);
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $nom_veh["vehicule"]; ?></td>

                                                        <td><?php echo $vid["km"]," km"; ?></td>

                                                        <td><b><?php echo $vid["futur_km"]," km"; ?>  </b></td>

                                                        <td><?php echo $vid["created_at"]; ?> </td>

                                                    </tr>
                                                    
                                                    <?php
                                                      
                                                      }
                                                     }else{
                                                         ?>
                                                           <tr><td>Aucune vidange a prévoir pour le moment.</td></tr>
                                                         <?php
                                                     }
                                                    ?>  
                                                </tbody>
                                            </table>
                                        </div> <!-- end .table-responsive-->
                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                        <!--Controle date assurance -->
                        <div <?php if($_SESSION["niveau"] == 3){echo "hidden";} ?> class="row">
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <h4 class="header-title mb-3">Suivie assurance</h4>

                                        <div class="table-responsive">
                                            <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Vehicule</th>
                                                        <th>Avant le</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  
                                                  <?php
                                                    foreach($response as $x => $val){
                                                  ?>
                                                  <tr>
                                                      <td><?php echo "$x"; ?></td>
                                                      <td style="color:red;" ><?php echo "$val"; ?></td>
                                                  </tr>
                                                  
                                                  <?php
                                                    }
                                                  ?>
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <h4 class="header-title mb-3">Suivie contrôle technique</h4>

                                        <div class="table-responsive">
                                            <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Vehicule</th>
                                                        <th>Avant le</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  
                                                  
                                                  <?php
                                                   
                                                   
                                                    foreach($resp as $x => $val){
                                                  ?>
                                                  <tr>
                                                      <td><?php echo "$x"; ?></td>
                                                      <td style="color:red;" ><?php echo "$val"; ?></td>
                                                  </tr>
                                                  
                                                  <?php
                                                    }
                                                   
                                                   
                                                  ?>
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <h4 class="header-title mb-3">Suivie vignette</h4>

                                        <div class="table-responsive">
                                            <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Vehicule</th>
                                                        <th>Avant le</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  
                                                  <?php
                                                    foreach($respe as $x => $val){
                                                  ?>
                                                  <tr>
                                                      <td><?php echo "$x"; ?></td>
                                                      <td style="color:red;" ><?php echo "$val"; ?></td>
                                                  </tr>
                                                  
                                                  <?php
                                                    }
                                                  ?>
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!--Controle date assurance -->
                        
                        <div <?php if($_SESSION["niveau"] == 3){ $t = "visible"; } else { $t = "hidden"; } ?> <?php echo $t; ?> class="row">
                            
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Détails de mon affectation/ Emprunt </h4>
                                      
                                            <?php 
                                                 if(mysqli_num_rows($myaff) == 0) {
                                                    echo "<span><b>Vous disposé d'aucune affectation pour le moment</b></span>";
                                                 } else {
     
                                                    ?>
                                                        <p>Date de début : <b> <?php echo $myvehi['date_debut']; ?> </b></p>
                                                        <p <?php if($myvehi["mode"] == "Definitif"){echo "hidden"; } ?> > Date de fin : <b><?php echo $myvehi['date_fin']; ?> </b> </p>
                                                        <p>Mode d'emprunt : <b><?php echo $myvehi['mode']; ?></b></p>
                                                        <center><a href="mon_affectation.php" class="btn btn-success" >Plus de détails</a></center>
                                                    <?php
                                                 }
                                             ?>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <h4 class="header-title mb-3">Maintenance/Vidange du véhicule</h4>
                                        
                                        
                                        <?php 
                                           
                                            if(mysqli_num_rows($myveh_vid) == 0 ){
                                               
                                               echo "<span><b>Aucune vidange n'est à prévoir pour le moment.</b></span>"; 
                                              
                                             } else{
                                                ?>
                                                
                                                <p>Prochaine vidange à : <b> <?php echo $km_next_vidange['futur_km']," km" ; ?> </b></p>
                                                
                                                <center><a href="mon_affectation.php" class="btn btn-warning text-white" > Détails  </a> </center>
                                                
                                                <?php
                                            }
                                        ?>
                                      
                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>

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

        <!-- Plugins js-->
        <script src="assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
        <script src="assets/libs/selectize/js/standalone/selectize.min.js"></script>

        <!-- Dashboar 1 init js-->
        <script src="assets/js/pages/dashboard-1.init.js"></script>

    </body>

</html>