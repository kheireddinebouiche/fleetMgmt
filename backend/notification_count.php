<?php
session_start();
include("getter/connect.php");

$id_user = $_SESSION["id"];

$req = mysqli_query($cnx, "SELECT * FROM notifications WHERE id_user='$id_user' and etat='unread' ");
$count = mysqli_num_rows($req);

?>

<span class="badge bg-danger rounded-circle noti-icon-badge"><?php echo $count; ?></span>