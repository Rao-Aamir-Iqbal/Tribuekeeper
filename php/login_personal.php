<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sendmail.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

if (isset($_POST['submit'])) {
    extract($_POST);

    if (empty($email)) {
        $_SESSION['error_msg1'] = "Please Enter Your Email";
        header('location:/login');
        exit;
    }

    if (empty($password)) {
        $_SESSION['error_msg2'] = "Please Enter Your Password";
        header('location:/login');
        exit;
    }

    $query = "SELECT * FROM users WHERE email = '" . $email . "'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
         $status = $user['status'];
        
        $db_password = $user['password'];
        $username = $user['username'];
        if (password_verify($password, $db_password)) {
            if ($status == 0) {
                $otp = rand(100000, 999999);
                $sql = "UPDATE `users` SET `otp_code` = '$otp', `status` = '1' WHERE email = '" . $email . "'";

                mysqli_query($con, $sql);

                $to = $email;
                $subject = "OTP Varification";
               // $message = "<html><body><p>Your OTP code <b>$otp</b></p></body></html>";
               $message = "<html><body><div style='font-family: Arial, sans-serif; font-size: 16px;'>
                    <p>Thank you for creating an account with Tributekeeper. To ensure the security of your account, we require all users to verify their email address.</p>
                    <p>Please Copy the below OTP Code or copy and paste it into your OTP Form to complete the verification process:</p>\n\n
                    <b>$otp</b>\n\n
                    <p>If you did not request this email, please ignore it. However, please note that your account will remain inactive until you verify your email address.</p>
                    <p>Thank you for choosing Tributekeeper.</p>
                    <p>Best regards,</p>
                    <p>Tributekeeper Team</p>
                   </div></body></html>";
                   $sendmail = json_decode(sendMail($to, $subject, $message, ""));
                if ($sendmail) {
                    $_SESSION['otp_message'] = "Please Check Your Mail To Get OTP!";
                    $_SESSION['user_id'] = $user['ID'];
                    header("location:/otp");

                    exit;
                } else {
                    $_SESSION['login_error_message'] = "Mail sending failed!";
                    header("location:/login");
                    exit;
                }
            } elseif ($user['status'] == 2) {

                $to = $email;
                $subject = "Keeper Confirmation";
                $message = "<html><body><p>Hi $username,</p><p>You are only one step away from completing your Keeper account.</p><p>Please click on the button below to secure your email address:</p><p><a href='https://app.tributekeeper.com/reactivation_page?secret_code_gen=$email' style='display:inline-block;padding:10px;background-color:#007bff;color:#fff;text-decoration:none;border-radius:4px;'>Confirmation Link</a></p><p>Thank You,</p><p>Keeper Team</p></body></html>";
                $headers = "From: test@softileo.com\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                if (mail($to, $subject, $message, $headers))


                    $_SESSION['reactivation'] = "<b></b>Could not login...</b><br>
                The Keeper account for hamza@app.com has been deactivated by the user.
                A reactivation email has been resent to you.
                Please open the email and click on the secure link to start using Keeper again!";
                header("location: /login");
                exit;
            } else {
                $_SESSION['user_id'] = $user['ID'];
                $_SESSION['email'] = $user['email'];

                if (isset($_POST['remember_me']) && $_POST['remember_me'] == '1') {
                    // Set cookie with user's email and password
                    setcookie('email', $email, time() + (60 * 60 * 24 * 30), '/');
                    setcookie('password', $password, time() + (60 * 60 * 24 * 30), '/');
                }
                header("location:/profile/$username");
                exit;
            }
        } else {
            $_SESSION['login_error_message'] = "Your Password Incorrect!";
            header("location:/login");
            exit;
        }
    } else {
        $_SESSION['login_error_message'] = "This Email Not Register Yet! Please SignUp!";
        header("location:/login");
        exit;
    }
}