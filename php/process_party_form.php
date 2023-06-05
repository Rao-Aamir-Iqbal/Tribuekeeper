<?php
// Get form data
$first_names = $_POST['first'];
$last_names = $_POST['last'];
$emails = $_POST['email'];
$response = $_POST['rsvp_response'];

foreach ($emails as $key => $email) {
    $to = $email;
    $subject = "RSVP from Keeper";
    $message = "<html><body><p>Hello ";
    $full_name = $first_names[$key] . " " . $last_names[$key];
    $message .= $full_name . ",</p><br>";
    $message .= "<p>This is a confirmation that you have responded ";
    if ($response == 1) {
      $message .= "Yes";
    } else if ($response == 0) {
      $message .= "No";
    } else if ($response == 2) {
      $message .= "Maybe";
    }
    $message .= " to Linda's Virtual Memorial Service.</p><br>";
    $message .= "<p>Keep up to date with the event by checking back in here.</p><br>";
    $message .= "<p>Thank you,</p><br><p>Keeper Team</p></body></html>";

    $headers = "From: info@tributekeeper.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    
    mail($to, $subject, $message, $headers);
}
  
echo "<p style='color: #008800;'>Email Sent Successfully!</p>";

?>
