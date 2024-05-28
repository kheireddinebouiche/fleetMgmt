<?php
session_start();

require("getter/connect.php");

date_default_timezone_set('Africa/Algiers');
$curdate = date('y-m-d h:i:s');


if(isset($_GET["id"]) and isset($_GET["id_owner"])){
    
    $id_next= $_GET["id"];
    
    $id_owner = $_GET["id_owner"];
    
    $req1 = mysqli_query($cnx,"SELECT * FROM suivie_affectation WHERE id_user='$id_next' and etat='en cours' and mode='Temporaire' ");
    $res1 = mysqli_fetch_assoc($req1);
    $id_temp_affec = $res1["id"];
    
    $req2 = mysqli_query($cnx,"SELECT * FROM suivie_affectation WHERE id_user='$id_owner' and etat='Pause' and mode='Definitif' ");
    $res2 = mysqli_fetch_assoc($req2);
    $id_affec_owner = $res2["id"];
    
    $req3 = mysqli_query($cnx, "SELECT * FROM suivie_affectation WHERE id_user='$id_next' and etat='Pause' and mode='Definitif' ");
    $res3 = mysqli_fetch_assoc($req3);
    $id_affect_next = $res3["id"];
    
    
    $end_affectation = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='annulé', updated_at='$curdate'  WHERE id='$id_temp_affec' ");
    
    $notif1123 = mysqli_query($cnx,"INSERT INTO notifications (titre, contenu, created_at, etat, id_user) 
                                                   VALUES ('Affectation','Votre affectation temporaire a été coloturer','$curdate', 'unread','$id_next') ");
                                                   
                                    
    
    $enc_owner_affect = mysqli_query($cnx, "UPDATE suivie_affectation SET etat='en cours', updated_at='$curdate' WHERE id='$id_affec_owner' ");
    
    
    $notif245 = mysqli_query($cnx,"INSERT INTO notifications (titre, contenu, created_at, etat, id_user) 
                                                   VALUES ('Affectation','Affectation de votre véhicule est rétablie','$curdate','unread','$id_owner') ");
    
    if(mysqli_num_rows($req3) > 0){
        
       $enc_next_user_affect = mysqli_query($cnx,"UPDATE suivie_affectation SET etat='en cours', updated_at='$curdate' WHERE id='$id_affect_next' ");
       
       $notif3 = mysqli_query($cnx,"INSERT INTO notifications (titre, contenu, created_at, etat, id_user) 
                                                   VALUES ('Affectation','Votre affectation est désormais actifs','$curdate','unread', '$id_owner' )");
        
    }
    
    if($end_affectation and $enc_owner_affect ){
        
        $_SESSION["status"] = "Succès";
        $_SESSION["success"] = 1;
        
        header("Location:mon_affectation.php");
        
    }else{
        
        $_SESSION["status"] = "Une erreur est survenu lors du traitement de la requête. 1";
        $_SESSION["success"] = 0;
        
        header("Location:mon_affectation.php");
    }
    
    
}else{
    
    $_SESSION["status"] = "Une erreur c'est produite lors de l'execution de la requête. 2";
    $_SESSION["success"] = 0;
    
    header("Location:mon_affectation.php");
    
}
    
    

?>