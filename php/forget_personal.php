<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sendmail.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

if (isset($_POST['forget'])) {
    extract($_POST);

    if (empty($email)) {
        $_SESSION['error_msg1'] = "Please Enter Your Email";
        header('location:/forget');
    }

    if (!empty($email)) {
        $ql = "SELECT * FROM users WHERE email = '" . $email . "'";
        $ru = mysqli_query($con, $ql);
        if (mysqli_num_rows($ru) > 0) {
            $token = rand(10, 9999);
            $qury = "UPDATE `users` SET token ='" . $token . "' WHERE email='" . $email . "'";
            mysqli_query($con, $qury);
            //$link = "< href='https://tributekeeper.softileo.com/reset?key=" . $email . "&token=" . $token . "'>Click To Reset password";
            $to = $email;
            $subject = "TributeKeeper Password Reset Confirmation";
            $message = "<html><body><p>We see that you have forgotten your password.<br>Please click here to reset your password:<br></p><p><a href='https://app.tributekeeper.com/reset/" . $_POST['email'] . "' style='display:inline-block;padding:10px;background-color:#007bff;color:#fff;text-decoration:none;border-radius:4px;'>Click To Reset password</a>
                <p>If you did not request this email, please ignore it. However, please note that your Password will remain same until you verify your email address.</p>
                    <p>Thank you for choosing Tributekeeper.</p>
                    <p>Best regards,</p>
                    <p>Tributekeeper Team</p>
                </p></body></html>";
            //$message = "<html><body><p>Your Reset Password Link $link</p></body></html>";
            // $headers .= "MIME-Version: 1.0\r\n";
            // $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            if (sendMail($to, $subject, $message, "")) {
                //$_SESSION['forget_password_message'] = "Please Check Your Mail to Reset Password!";
                //echo "Mail sent successfully!";
                header("location:/reset_notice");
            } else {
                $_SESSION['forget_error_message'] = "Mail sending failed!";
                header("location:/forget");
            }
        } else {
            $_SESSION['forget_error_message'] = "Invalid Email Address!";
            header("location:/forget");
        }
    }
}
