<?php
session_start();
include('getter/connect.php');

if(isset($_POST['view'])){

if($_POST["view"] != '')
{
   $update_query = "UPDATE comments SET etat = readed WHERE comment_status=undread";
   mysqli_query($con, $update_query);
}
$query = "SELECT * FROM notifications ORDER BY id DESC LIMIT 5";
$result = mysqli_query($cnx, $query);
$output = '';

if(mysqli_num_rows($result) > 0)
{
while($row = mysqli_fetch_array($result))
{
  $output .= '
  <li>
  <a href="#">
  <small><em>'.$row["contenu"].'</em></small>
  </a>
  </li>
  ';
}

}
else{
    $output .= '<li><a href="#" class="text-bold text-italic">Aucune notification.</a></li>';
}
$status_query = "SELECT * FROM notifications WHERE etat=0";
$result_query = mysqli_query($cnx, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
   'notification' => $output,
   'unseen_notification'  => $count
);
echo json_encode($data);
}
?>