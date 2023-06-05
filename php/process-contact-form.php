<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$user_id = $_SESSION['user_id'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Database connection (replace with your own details)


    // Insert data into the database
    $sql = "INSERT INTO contact_us (user_id, firstname, lastname, email, message) VALUES ('$user_id','$firstname', '$lastname', '$email', '$message')";

    if (mysqli_query($con, $sql)) {
        // Send email (replace with your own email handling code)
        $to = "amirraoiqbal@gmail.com";
        $subject = "New Contact Form Submission";
        $message = "<html>
            <body>
            <div style='font-family: Arial, sans-serif; font-size: 16px;'>
                <p>You have received a new contact form submission from the website. The details of the submission are as follows:</p>
                <p><strong>First Name:</strong> $firstname</p>
                <p><strong>Last Name:</strong> $lastname</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Message:</strong></p>
                <p>$message</p>
                <p>Best regards,</p>
                <p>Tributekeeper Team</p>
            </div>
            </body>
            </html>";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        mail($to, $subject, $message, $headers);

        // Output success message
        echo "<p style='color:#008800;'>Message sent successfully!</p>";
    } else {
        echo "<p style='color:#FF0000;'>Error: ' . $sql . '<br>' . mysqli_error($conn)</p>";
    }

    // Close the connection
    mysqli_close($conn);
}
