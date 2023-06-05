<?php

session_start();
// $_SESSION['email_send_msg'] = "Please Check Your Email to Reset Password";
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sendmail.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';


if (isset($_POST['submit'])) {
    extract($_POST);
    $emailnew = $_POST['email'];
    $retype_email = $_POST['retype_email'];

    $user_id = $_SESSION['user_id'];

    $uemail = mysqli_query($con, "SELECT * FROM users WHERE ID = '$user_id'");
    $re43 = mysqli_fetch_assoc($uemail);
    $email = $re43['email'];
    $status = $re43['status'];
    $_SESSION['username'] = $re43['username'];
    $username =  $_SESSION['username'];

    //die();
    if (empty($email)) {
        $_SESSION['error_msg1'] = "Please Enter Your New Email!";
        header("location:/edit_settings/$username");
    }
    if (empty($retype_email)) {
        $_SESSION['error_msg2'] = "Please Enter Your Retype Email!";
        header("location:/edit_settings/$username");
    }
    if (!empty($email) && !empty($retype_email)) {
        //echo "jfajsdlfkjsdlkfj";
        $useremail = mysqli_query($con, "SELECT * FROM users WHERE email = '$emailnew'");
       // echo "SELECT * FROM users WHERE email = '$emailnew'";
        //die();
        if (mysqli_num_rows($useremail) > 0) {
            $_SESSION['email_edit_error'] = "This Email Already In Use!";
            header("location:/edit_email");
            exit;
        } else {

            if ($emailnew == $retype_email) {

                mysqli_query($con, "UPDATE users SET status = '0' WHERE ID = '$user_id'");
                // echo "UPDATE users SET status = '0' WHERE ID = '$user_id'";
                //die();
                $otp = rand(100000, 999999);
                if ($status == 1) {
                    // echo "no ok";
                    // die();
                    $sql =  "UPDATE `users` SET email ='" . $emailnew . "', otp_code='".$otp."' WHERE ID = '" . $user_id . "'";
                    mysqli_query($con, $sql);
                    $_SESSION['email_edit_message'] = "Your Email Update Successfully!";
                    header("location:/edit_settings/");
                } else {
                    // echo "yes ok";
                    // die();
                    $to = $emailnew;
                    $subject = "OTP Varification";
                    $message = "<html><body><div style='font-family: Arial, sans-serif; font-size: 16px;'>
                    <p>Thank you for creating an account with Tributekeeper. To ensure the security of your account, we require all users to verify their email address.</p>
                    <p>Please Copy the below OTP Code or copy and paste it into your OTP Form to complete the verification process:</p>\n\n
                    <b>$otp</b>\n\n
                    <p>If you did not request this email, please ignore it. However, please note that your account will remain inactive until you verify your email address.</p>
                    <p>Thank you for choosing Tributekeeper.</p>
                    <p>Best regards,</p>
                    <p>Tributekeeper Team</p>
                   </div></body></html>";
                    // $headers .= "MIME-Version: 1.0\r\n";
                    // $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                    if (sendMail($to, $subject, $message, "")) {


                        $sql =  "UPDATE `users` SET email ='" . $emailnew . "', otp_code='".$otp."' WHERE ID='" . $user_id . "'";

                        $sql56 = mysqli_query($con, $sql);
                        if ($sql56) {
                            $_SESSION['otp_message'] = "Please Check Your Mail To Get OTP!";
                            $_SESSION['user_id'] = $user['ID'];
                            $_SESSION['username'] = $re43['username'];

                            header("location:/otp_email");
                            exit;
                        }
                    } else {
                        $_SESSION['email_edit_error'] = "Mail sending failed!";
                        header("location:/edit_email");
                        exit;
                    }
                }
            } else {
                $_SESSION['email_edit_error'] = "Email Not Match!";
                header('location:/edit_email');
            }
        }
    }
}
