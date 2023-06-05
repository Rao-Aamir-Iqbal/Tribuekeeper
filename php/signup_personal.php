<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sendmail.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';


if (isset($_POST['submit'])) {
    extract($_POST);

    if (empty($firstname)) {
        $_SESSION['error_msg1'] = "Please Enter Your First Name";
        header('location:/signup/profile');
    }
    if (empty($lastname)) {
        $_SESSION['error_msg2'] = "Please Enter Your Last Name";
        header('location:/signup/profile');
    }
    if (empty($username)) {
        $_SESSION['error_msg3'] = "Please Enter Your Username";
        header('location:/signup/profile');
    }
    if (empty($email)) {
        $_SESSION['error_msg4'] = "Please Enter Your Email";
        header('location:/signup/profile');
    }
    if (empty($password)) {
        $_SESSION['error_msg5'] = "Please Enter Your Password";
        header('location:/signup/profile');
    }
    if (empty($cpassword)) {
        $_SESSION['error_msg6'] = "Please Enter Your Conform Password";
        header('location:/signup/profile');
    }
    if (empty($date)) {
        $_SESSION['error_msg7'] = "Please Choose Date";
        header('location:/signup/profile');
    }
    if (empty($gender)) {
        $_SESSION['error_msg8'] = "Please Select Your Gender";
        header('location:/signup/profile');
    }

    if (!empty($firstname) && !empty($lastname) && !empty($username) && !empty($email) && !empty($password) && !empty($cpassword) && !empty($date) && !empty($gender)) {

        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        if ($password ==  $cpassword) {

            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            //$hash_cpassword = password_hash($cpassword, PASSWORD_DEFAULT);

            $otp = rand(100000, 999999);
            $status = "0";

            $query = "SELECT * FROM users WHERE email = '" . $email . "'";
            $res = mysqli_query($con, $query);
            if (mysqli_num_rows($res) > 0) {
                $_SESSION['signup_error_message'] = "This Email Already in use!";
                header("location:/signup/profile");
            } else {
                $query2 = "INSERT INTO `users` (firstname, lastname, username, email, password, gender, otp_code, status, membership) 
            VALUES ('" . $firstname . "','" . $lastname . "','" . $username . "','" . $email . "','" . $hash_password . "','" . $gender . "','" . $otp . "','" . $status . "', 2)";

                //die();
                $res2 = mysqli_query($con, $query2);

                if ($res2) {
                    $new_user_id = mysqli_insert_id($con);
                    
                    $query3 ="INSERT INTO user_settings (user_id, language, email_notifications, keeper_news_updates, privacy_view) VALUES ('".$new_user_id."', 'english', '1', '1', '1')";
                    $res3 = mysqli_query($con, $query3);
                  
                    $to = $email;
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
                    $sendmail = json_decode(sendMail($to, $subject, $message, ""));
                    if ($sendmail) {
                        //echo "Mail sent successfully!";
                        $_SESSION['otp_message'] = "Please Check Your Mail To Get OTP";
                        header("location:/otp");
                    } else {
                        $_SESSION['signup_error_message'] = "Mail sent Failed!";
                        header("location:/signup/profile/$username");
                    }
                } else {
                    $_SESSION['signup_error_message'] = "Mail sent Failed!";
                    header("location:/signup/profile/$username");
                }
            }
        } else {
            $_SESSION['signup_error_message'] = "Password Not Match!";
            header("location:/signup/profile");
        }
    }

    // echo "yes fdddsgdf kkaldkfl;sdk kdfl;akdf";
    // die();


}
