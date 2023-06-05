<?php

session_start();
// $_SESSION['email_send_msg'] = "Please Check Your Email to Reset Password";
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sendmail.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';



if (isset($_POST['submit'])) {
    extract($_POST);
    $user_id = $_SESSION['user_id'];

    $usern = mysqli_query($con, "SELECT * FROM users WHERE ID = '$user_id'");
    $re43 = mysqli_fetch_assoc($usern);
    $username = $re43['username'];
    
    if (empty($password)) {
        $_SESSION['error_msg1'] = "Please Enter Your New Password!";
        header('location:/reset');
    }
    if (empty($retype_password)) {
        $_SESSION['error_msg2'] = "Please Enter Your Retype Password!";
        header('location:/reset');
    }
    if (!empty($password) && !empty($retype_password)) {
       
        $password = $_POST['password'];
        $retype_password = $_POST['retype_password'];

        if ($password == $retype_password) {
       
            $hash_pass = password_hash($password, PASSWORD_DEFAULT);

            $sql =  "UPDATE `users` SET password ='" . $hash_pass . "' WHERE ID='" .$user_id. "'";
            mysqli_query($con, $sql);
            $_SESSION['password_edit_message'] = "Your Password Update Successfully!";
            header("location:/edit_settings/$username");
        } else {
            $_SESSION['password_edit_error'] = "Password Not Match!";
            header('location:/edit_password');
        }
    }
}
