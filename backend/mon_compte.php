<?php
session_start();
require("getter/connect.php");

if(isset($_SESSION["id"])){
    
    $id = $_SESSION["id"];

    $req = mysqli_query($cnx, "SELECT * FROM user WHERE id='$id' ");
    $result = mysqli_fetch_assoc($req);
    
    
}else{
    
    header("Location:index.php");
}



?>
<!DOCTYPE html>
<html lang="en">


    <head>
        <meta charset="utf-8" />
        <title>Fleet management | Détails de mon compte</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Profile</a></li>
                                            <li class="breadcrumb-item active">Mont compte</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Mon compte</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12 col-xl-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <img src="assets/images/users/profile-img.png" class="rounded-circle avatar-lg img-thumbnail"
                                        alt="profile-image">

                                        <h4 class="mb-0"><?php echo $result["username"]; ?></h4>
                                        <p class="text-muted"><?php if($result["niveau"]== 1){ echo "Administrateur"; } else {if($result["niveau"]==2){echo "Gestionnaire";}else{ if($result["niveau"]==3){echo "Conducteur";}  } }  ?> </p>

                                        
                                        
                                        <button <?php if($_SESSION["niveau"] == 3 or $_SESSION["niveau"] == 4) { echo 'hidden';} ?> type="button" data-bs-toggle="modal" data-bs-target="#upd-profile-modal" class="btn btn-danger btn-xs waves-effect mb-2 waves-light">
                                            Mettre à jours mes informations
                                        </button>

                                        <div class="text-start mt-3">
                                            
                                            <p class="text-muted mb-2 font-13"><strong>Nom d'utilisateur :</strong> <span class="ms-2"><?php echo $result["username"]; ?></span></p>
                                        
                                            <p class="text-muted mb-2 font-13"><strong>Email :</strong><span class="ms-2"><?php echo $result["email"]; ?></span></p>
                                        
                                            <p class="text-muted mb-2 font-13"><strong>N° Identification :</strong> <span class="ms-2"><?php echo $result["identification"]; ?></span></p>
                                        
                                            <p class="text-muted mb-1 font-13"><strong>N° Permis de conduire :</strong> <span class="ms-2"><?php echo $result["num_permis"]; ?></span></p>
                                            
                                            <p class="text-muted mb-1 font-13"><strong>Mobile :</strong> <span class="ms-2"><?php echo $result["mobile"]; ?></span></p>
                                        </div>                              
                                    </div>                                 
                                </div> <!-- end card -->

                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->

                    </div> <!-- container -->

                </div> <!-- content -->
                
                <!-- SignIn modal content -->
                <div id="upd-profile-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    
                                    <h4><b>Mise à jours des informations du profile</b></h4>
                                </div>
                                <hr>
                              <form action="user_update_profile.php?id=<?php echo $id; ?> " method="POST" class="px-3">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Nom d'utilisateur :</label>
                                        <input class="form-control" type="text" value="<?php echo $result["username"]; ?>" required="true" id="username" name="username"  />
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email :</label>
                                        <input class="form-control" type="email" value="<?php echo $result["email"]; ?>" required="true" id="email" name="email" />
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="num_permis" class="form-label">N° permis de conduire :</label>
                                        <input class="form-control" type="text" value="<?php echo $result["num_permis"]; ?>" required="true" id="num_permis" name="num_permis" />
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="identification" class="form-label">N° identification :</label>
                                        <input class="form-control" type="text" value="<?php echo $result["identification"]; ?>" required="true" id="identification" name="identification" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="num_telephone" class="form-label">N° Téléphone :</label>
                                        <input class="form-control" type="phone" value="<?php echo $result["mobile"]; ?>" required="true" id="num_telephone" name="num_telephone" />
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

    </body>

</html>