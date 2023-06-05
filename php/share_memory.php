<?php
// Start the session and include the database connection file
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sendmail.php';

$user_id = $_SESSION['user_id'];

// Get the form data
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])){
    $username = $_POST['name']; 
    $message_box = $_POST['message'];
    $emails = $_POST['email'];

    // Loop through the emails and send an email to each address
    foreach($emails as $email) {
        $to = $email;
        $subject = 'Dear' ." ". $username . " " . 'You have a memorial invitation' ;
        $message = $message_box;
        $headers = 'From: Your Name:'. $username . "\r\n" .
            'Reply-To: your_email@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        sendMail($to, $subject, $message, $headers);
    }

    // Return a success message
    echo "Emails sent successfully";
} else {
    echo "Error: Form fields not set";
}
?>
