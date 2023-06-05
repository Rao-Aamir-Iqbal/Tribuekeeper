<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sendmail.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

if (isset($_POST['otpsubmit'])) {
    extract($_POST);
    if (empty($otp)) {
        $_SESSION['error_msg1'] = "Please Enter Your OTP";
        header('location:/otp');
    }

    if (!empty($otp)) {
        $otp = $_POST['otp'];

        $query = "SELECT * FROM users WHERE otp_code = '" . $otp . "'";
        $res = mysqli_query($con, $query);
        if (mysqli_num_rows($res) > 0) {

            $re = mysqli_fetch_assoc($res);
            $email = $re['email'];
            $_SESSION['user_id'] = $re['ID'];
            $username = $re['username'];
            mysqli_query($con, "UPDATE users set status = 1 WHERE otp_code = '" . $otp . "'");
            if($_SESSION['keeper_plus'] == true){
                header("location:/payment");
            }else{
                header("location:/profile/$username");
            }
           
        } else {
            $_SESSION['error_msg1'] = "Your OTP Not Match!";
            header('location:/otp');
        }
    }
}
