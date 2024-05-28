<?php
session_start();
require("getter/connect.php");

$id_user = $_SESSION["id"];

$rd = mysqli_query($cnx, "SELECT * FROM notifications WHERE id_user='$id_user' and etat='unread' ");

?>

<?php 

  if(mysqli_num_rows($rd)>0){

?>

<?php
  while($cur=mysqli_fetch_assoc($rd)){
?>
<!-- item-->
<a href="notification_details.php?id=<?php echo $cur["id"]; ?> " class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-1">
    <div class="card-body">
        
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <div class="notify-icon bg-primary">
                    <i class="mdi mdi-comment-account-outline"></i>
                </div>
            </div>
            <div class="flex-grow-1 text-truncate ms-2">
                <h5 class="noti-item-title fw-semibold font-14"> <?php if($cur["titre"]!= NULL) {echo $cur["titre"]; }else{ echo "Notification"; }  ?> </h5>
                <small class="noti-item-subtitle text-muted"><?php echo $cur["contenu"]; ?></small>
            </div>
        </div>
    </div>
</a>

<?php

}

?>

<?php
}else{
    
    echo "<center><span><b>Aucune notification !</b></span></center>";
    
}
?>