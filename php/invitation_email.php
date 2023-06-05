<?php
// This is the AJAX file that processes the form data and sends emails to the addresses provided in the form

// Start the session and include the database connection file
session_start();
// require_once '/functions/sendmail.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sendmail.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

// Get the user's ID from the session
$user_id = $_SESSION['user_id'];




// if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
//     echo "<script>alert('hdicgysdyg')</script>";
    
//     $user_name = $_POST['user_name'];
//     $email = $_POST['email'];
//     $message_box = $_POST['message_box'];
    
    
//     for ($i = 0; $i < count($names); $i++) {
//     $to = $email[$i];


//     // Call the sendMail() function
//     if (sendMail($user_name, $subject, $message_box)) {
//       echo "Email sent successfully to $to<br>";
//     } else {
//       echo "Email could not be sent to $to<br>";
//     }
//   }
    
    
// }



if (isset($_POST['user_name'])) {
   
    
      // Get the form data
 echo $user_name = $_POST['user_name'];

  $message_box = $_POST['message_box'];
 $emails = $_POST['email'];
 
//  for ($i = 0; $i < count($user_name); $i++) {
//     $to = $email[$i];


//     // Call the sendMail() function
//     if (sendMail($to, $user_name, $message_box)) {
//       echo "Email sent successfully to $to<br>";
//     } else {
//       echo "Email could not be sent to $to<br>";
//     }
//   }

  
  
  

  
  
  $title_name = $_POST['title_name'];
  $sql1 = "SELECT * FROM `events` WHERE title = '$title_name'";
  $exe1 = mysqli_query($con, $sql1);
  $fetched = mysqli_fetch_assoc($exe1);
  $title = $fetched['title'];
  $description = $fetched['description'];
  $date = date("F jS, Y", strtotime($fetched['date']));
  $time = date("g:ia", strtotime($fetched['time']));
  $location = $fetched['location'];
  $event_link = $fetched['event_link'];
  $image = $fetched['image'];
 

  foreach ($emails as $email) {
    $to = $email;
    $subject = "Your Invitation to $title";
    $message = "Hello,<br><br>" . $user_name . " would like to invite you to an event in honor of event_username.<br><br><h3>$title</h3><br>$date<br>$time<br>$location<br><br>" . $message_box."<br><br>Thank You,<br>Tributekeeper Team";
    $headers = "From: info@tributekeeper.com\r\n";
    // $headers .= "MIME-Version: 1.0\r\n";
    // $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    
    sendMail($to, $subject, $message, "");
  }
  
  echo "<p style='color: #008800;'>Invitation Sent Successfully!</p>";
 






}


?>
