<?php
session_start();
require("getter/connect.php");

date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');

if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){
    
    $id = $_GET["id"];

    if(isset($_POST['upload'])){   
        
        $totalfiles = count($_FILES['file']['name']);

        // Looping over all files
        for($i=0;$i<$totalfiles;$i++){
            $filename = $_FILES['file']['name'][$i];
            // Upload files and store in database
            if(move_uploaded_file($_FILES["file"]["tmp_name"][$i],'upload/'.$filename)){
                    // Image db insert sql
                    $insert = "INSERT into documents_voiture(id_vehicule,link,created_at) values('$id','$filename','$curdate')";
                    if(mysqli_query($cnx, $insert)){
                        $_SESSION["status"] ="Les documents du véhicule ont été enregistrer avec succès";
                        $_SESSION["success"] = "1";
                        header("Location:details_voitures.php?id=$id ");
                    }
                    else{
                    echo 'Error: '.mysqli_error($cnx);
                    }
                }else{
                    echo 'Error in uploading file - '.$_FILES['file']['name'][$i].'<br/>';
                }
        }  
        
    }    
         
}


?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Joindre un document du véhicule</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Plugins css -->
        <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />

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
                                            <li class="breadcrumb-item active">Joindre un document</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Joindre un documents</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Zone d'upload des documents du véhicule</h4>
                                        <p class="sub-header">
                                            Touts les documents du véhicules sont uploader à partir d'ici au format (pdf, png, jpeg)
                                        </p>
                                    
                                     <form method="post"  enctype="multipart/form-data">
                                         
                                         <div class="row">
                                             <div class="col-md-11">
                                                 <input class="form-control" type="file" name="file[]" multiple  />
                                             </div>
                                             
                                             <div class="col-md-1">
                                                 <button class="btn btn-success" type="submit" name="upload">Joindre</button>
                                             </div>
                                         </div>
                                    </form>
                                         

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->  


                       
                                               
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

        <!-- Plugins js -->
        <script src="assets/libs/dropzone/min/dropzone.min.js"></script>
        <script src="assets/libs/dropify/js/dropify.min.js"></script>

        <!-- Init js-->
        <script src="assets/js/pages/form-fileuploads.init.js"></script>

        
    </body>
</html>