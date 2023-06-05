<?php

session_start();
// $_SESSION['email_send_msg'] = "Please Check Your Email to Reset Password";
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sendmail.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

// if(isset($_POST['email'])){
    
//     echo $email;
// }else{
//     echo"not set";
// }

// $token = $_GET['token'];

if (isset($_POST['submit'])) {
    extract($_POST);
    $email = $_POST['email'];
    // echo $email;
    // die();
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
            // echo 'hi';

            $hash_pass = password_hash($password, PASSWORD_DEFAULT);

            $sql =  "UPDATE `users` SET password ='" . $hash_pass . "' WHERE email='" . $email . "'";
           // echo "UPDATE `users` SET password ='" . $hash_pass . "' WHERE email='" . $email . "'";
           // die();
            mysqli_query($con, $sql);
            $_SESSION['password_reset_message'] = "Your Password Reset Successfully! Now you can Login.";
            header('location:/login');
        } else {
            //echo 'no';

            $_SESSION['password_reset_error'] = "Password Not Match!";
            header('location:/reset');
        }
    }
}
