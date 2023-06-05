<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sendmail.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

 $id = $_GET['id'];
 $selected_id = $id;
 $username = $_GET['username'];
//die();
if (isset($id)) {
    //$id = $_GET['id'];
    $sql = mysqli_query($con, "DELETE FROM `family_member` WHERE id = '$id'");
    if ($sql) {
        header("location:/family.php/$username");
    } else {
    }
}

if (isset($selected_id)) {
    
    $sql = mysqli_query($con, "DELETE FROM `family_member` WHERE selected_user_id = '$selected_id'");
    if ($sql) {
        header("location:/family.php/$username");
    } else {
    }
}