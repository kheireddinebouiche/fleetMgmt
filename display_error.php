<?php
	            if(isset($_SESSION["message"])){
	            ?>
    	          <div class="col-md-6" style="display:block; margin:auto;">             
                    <div class="alert alert-danger alert-dismissible text-center fade show" role="alert">
                        
                            <?php
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);    
                            ?>
                    </div>
                            
                   </div> <!-- end col-->
               
                  <?php
    	            }
    	    ?>