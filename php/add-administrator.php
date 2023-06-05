<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sendmail.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `users` WHERE ID = '" . $_SESSION['user_id'] . "'";
// echo "SELECT * FROM `users` WHERE ID = '" . $_SESSION['user_id'] . "'";
// die();
$exe = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($exe);

// $firstname = $fetch['firstname'];
$username = $fetch['username'];
//$username = urlencode($username1);
$membership = $fetch['membership'];
if (isset($_POST['input_id'])) {
    $idd = $_POST['input_id'];
    $admin_id = str_replace('#', '', $idd);
    // echo 'ok';
    //die();
    if ($admin_id) {
        $get_email = mysqli_query($con, "SELECT * FROM `users` WHERE `ID` = '$admin_id'");
        $fetch_email = mysqli_fetch_assoc($get_email);
        $emailadmin = $fetch_email['email'];
        $firstname = $fetch_email['firstname'];
        $lastname = $fetch_email['lastname'];
        if ($membership == 2) {
            $check_free_membership = mysqli_query($con, "SELECT * FROM `admin_request` WHERE `user_id` = '$user_id'");
            if (mysqli_num_rows($check_free_membership) > 0) {
                mysqli_query($con, "UPDATE `admin_request` SET `user_id`='$user_id',`free_membership`='used' WHERE `user_id` = '$user_id'");
                $_SESSION['membership_confermation_message'] = "You have already used your free request. To Invite unlimited administrators use Upgrade to Keeper Plus.";
                header("location:/keeper/$username");
            } else {
                $used_membership = mysqli_query($con, "INSERT INTO `admin_request`(`user_id`, `free_membership`) VALUES ('$user_id','used')");
                $to = $emailadmin;
                $subject = "Keeper Administrator Conformation";
                $message = "<html><body><p>Dear <b>$firstname $lastname</b>,<br>We hope this message finds you well. We would like to invite you as Keeper Administrator on Tributekeeper, please click on the following Button:<br></p><p><a href='https://app.tributekeeper.com/approved_admin/$admin_id' style='display:inline-block;padding:10px;background-color:#007bff;color:#fff;text-decoration:none;border-radius:4px;'>Click To Approved</a>
                 <p>Thank you for choosing Tributekeeper.</p>
                 <p>Best regards,</p>
                 <p>Tributekeeper Team</p>
             </p></body></html>";
                // $headers .= "MIME-Version: 1.0\r\n";
                // $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                $sendmail = json_decode(sendMail($to, $subject, $message, ""));
                // print_r($sendmail);
                if ($sendmail) {
                    $_SESSION['usR_name'] = $firstname . " " . $lastname;
                    $_SESSION['administrator_confermation_message'] = "<p><b>Request Pending: '" . $_SESSION['usR_name'] . "'</b> must accept the Keeper Administrator Request before it can appear in your Keepers. </p>";
                    header("location:/keeper/$username");
                    exit;
                } else {
                    $_SESSION['administrator_confermation_message'] = "Failed To send to add New Keeper Administrator Request!";

                    // die();
                    header("location:/keeper/$username");
                    exit;
                }
            }
        }else{
                //$used_membership = mysqli_query($con, "INSERT INTO `admin_request`(`user_id`, `free_membership`) VALUES ('$user_id','used')");
                $to = $emailadmin;
                $subject = "Keeper Administrator Conformation";
                $message = "<html><body><p>Dear <b>$firstname $lastname</b>,<br>We hope this message finds you well. We would like to invite you as Keeper Administrator on Tributekeeper, please click on the following Button:<br></p><p><a href='https://tributekeeper.com/approved_admin/$admin_id' style='display:inline-block;padding:10px;background-color:#007bff;color:#fff;text-decoration:none;border-radius:4px;'>Click To Approved</a>
                 <p>Thank you for choosing Tributekeeper.</p>
                 <p>Best regards,</p>
                 <p>Tributekeeper Team</p>
             </p></body></html>";
                // $headers .= "MIME-Version: 1.0\r\n";
                // $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                $sendmail = json_decode(sendMail($to, $subject, $message, ""));
                // print_r($sendmail);
                if ($sendmail) {
                    $_SESSION['usR_name'] = $firstname . " " . $lastname;
                    $_SESSION['administrator_confermation_message'] = "<p><b>Request Pending: '" . $_SESSION['usR_name'] . "'</b> must accept the Keeper Administrator Request before it can appear in your Keepers. </p>";
                    header("location:/keeper/$username");
                    exit;
                } else {
                    $_SESSION['administrator_confermation_message'] = "Failed To send to add New Keeper Administrator Request!";

                    // die();
                    header("location:/keeper/$username");
                    exit;
                }
        }

        // echo 'done';
    }
}
