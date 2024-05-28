<?php
session_start();
require("getter/connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');


if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2 ){
    
    if(isset($_POST['upload'])){   
 
     $id = $_GET["id"];
     $file = rand(1000,100000)."-".$_FILES['file']['name'];
     $file_loc = $_FILES['file']['tmp_name'];
     $file_size = $_FILES['file']['size'];
     $file_type = $_FILES['file']['type'];
     $folder="upload/";
     
     /* new file size in KB */
     $new_size = $file_size/1024;  
     /* new file size in KB */
     
     /* make file name in lower case */
     $new_file_name = strtolower($file);
     /* make file name in lower case */
     
     $final_file=str_replace(' ','-',$new_file_name);
     
     if(move_uploaded_file($file_loc,$folder.$final_file)){
         
          $sql="INSERT INTO documents_sinistre(id_sinistre, link, created_at) VALUES('$id', '$final_file','$curdate') ";
          mysqli_query($cnx,$sql);
          
           $_SESSION["status"] = "Document ajouter avec succès.";
           $_SESSION["success"] = 0;
          
          header("Location:details_sinistre.php?id=$id ");
            
  
 }else{
     
     $_SESSION["status"] = "Une erreur est survenu lors traitement de la requete.";
     $_SESSION["success"] = 0;
  
     header("Location:details_sinistre.php?id=$id ");
		
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
        <title>Fleet management | Joindre des fichiers </title>
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
                                        <h4 class="header-title">Zone d'upload des documents de sinistres (Constats, Photos de sinistre, ...).</h4>
                                        <p class="sub-header">
                                            Touts les documents du sinistre sont uploader à partir d'ici au format (pdf, png, jpeg)
                                        </p>
                                    
                                     <form method="post"  enctype="multipart/form-data">
                                         
                                         <div class="row">
                                             <div class="col-md-11">
                                                 <input class="form-control" type="file" name="file" />
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