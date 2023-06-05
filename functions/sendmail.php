<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Loading Requires
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

// Defining the response array
$response = [];

function sendMail($email, $subject, $body, $altbody){
    
    $mail = new PHPMailer(true);
    try {

        // Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'mail.tributekeeper.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@tributekeeper.com';
        $mail->Password   = 'wVlQ$)-GhZ5%';
        $mail->SMTPSecure = "ssl";
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('info@tributekeeper.com', 'Tribute Keeper');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $altbody;

        if($mail->send()){

            $response = [
                "request"       =>  true, 
                "error"         =>  ""
            ];

        } else {

            $response = [
                "request"       =>  false, 
                "error"         =>  "Unable to send the email! Please try again..."
            ];

        }
        
    } catch (Exception $e) {
        
        $response = [
            "request"       =>  false, 
            "error"         =>  "Unable to send the email! Please try again..."
        ];
        
    }

    return json_encode($response);

}


