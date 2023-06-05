<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sendmail.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$hidden_field_id = $_SESSION['hidden_field_id'];
// echo $hidden_field_id;
//die();
$sql = mysqli_query($con, "DELETE FROM `family_member` WHERE selected_user_id = '$hidden_field_id'");
if($sql){
   
    $_SESSION['family_cancelation_message'] = "<p>Family Request Cancel Successfully!. </p>";
    header("location:/add-family-member/");
}else{

}
?>
