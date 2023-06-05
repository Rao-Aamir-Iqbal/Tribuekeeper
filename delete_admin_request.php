<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `users` WHERE ID = '" . $_SESSION['user_id'] . "'";
// echo "SELECT * FROM `users` WHERE ID = '" . $_SESSION['user_id'] . "'";
// die();
$exe = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($exe);
$username = $fetch['username'];

$sql22 = mysqli_query($con, "DELETE FROM `admin_request` WHERE `user_id` = '" . $_SESSION['user_id'] . "'");
$sql22 = mysqli_query($con, "DELETE FROM `keepers` WHERE `kepper_ids` = '" . $_SESSION['user_id'] . "'");


if($sql22){
    $_SESSION['delete_confermation_message'] = "First free Keeper Adminstrator request  Deleted successfully!";

    header("location:/keeper/$username");
    
}
