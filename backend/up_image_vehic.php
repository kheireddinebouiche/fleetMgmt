<?php
session_start();
require("getter/connect.php");
date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');

if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){
    $id = $_GET["id"];

    if(isset($_POST['upload'])){ 
        
        $output_dir = "images/";/* Path for file upload */
    	$RandomNum   = time();
    	$ImageName      = str_replace(' ','-',strtolower($_FILES['image']['name'][0]));
    	$ImageType      = $_FILES['image']['type'][0];
     
    	$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
    	$ImageExt       = str_replace('.','',$ImageExt);
    	$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
    	$NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
        $ret[$NewImageName]= $output_dir.$NewImageName;
    	
    	/* Try to create the directory if it does not exist */
    	if (!file_exists($output_dir))
    	{
    		@mkdir($output_dir, 0777);
    	}               
    	move_uploaded_file($_FILES["image"]["tmp_name"][0],$output_dir."/".$NewImageName );
    	    
    	     $sql = "UPDATE voitures SET image='$NewImageName' WHERE id='$id' ";
        		if (mysqli_query($cnx, $sql)) {
        		    
        			header("Location:details_voitures.php?id=$id");
        			
        			
        		}else {
    		        echo "Error: " . $sql . "" . mysqli_error($cn);
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
        <title>Photo du véhicule</title>
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
                                            <li class="breadcrumb-item active">Joindre une photo</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Joindre une photo</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
 
                                        <form method="post"  enctype="multipart/form-data" >
                                            <input type="file" class="form-control" name="image[]" /></nobr>
                                            <center><button type="submit" class="btn btn-primary mt-4" name="upload">Enregistrer</button></center>
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