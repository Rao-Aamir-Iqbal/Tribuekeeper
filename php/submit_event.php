<?php
// This is the AJAX file that processes the form data and updates the user's record in the database

// Start the session and include the database connection file
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

// Get the form data
$title = $_POST['title'];
$description = $_POST['description'];
$date = $_POST['date']; 
$time = $_POST['time'];
$location = $_POST['location'];
$event_link = $_POST['event_link'];

// Image Start
$imgname = $_FILES['Image']['name'];
$extension = pathinfo($imgname, PATHINFO_EXTENSION);

$randomno = rand(0, 100000);
$rename = 'Upload' . date('Ymd') . $randomno;

$newname = $rename . '.' . $extension;
$filename = $_FILES['Image']['tmp_name'];

move_uploaded_file($filename, 'events_picture/' . $newname);
// Image End

// Sanitize the form data
$title = mysqli_real_escape_string($con, $title);
$description = mysqli_real_escape_string($con, $description);
$date = mysqli_real_escape_string($con, $date);
$time = mysqli_real_escape_string($con, $time);
$location = mysqli_real_escape_string($con, $location);
$event_link = mysqli_real_escape_string($con, $event_link);


// Get the user's ID from the session
$user_id = $_SESSION['user_id'];

// Update the user's record in the database
$sql = "INSERT INTO `events` (`user_id`,`title`,`description`,`date`,`time`,`location`,`event_link`,`image`) VALUES('$user_id','$title','$description','$date','$time','$location','$event_link','$newname')";
if (mysqli_query($con, $sql)) {
  echo "<p style='color: #008800;'>Data Saved!</p>";
} else {
  echo "error";
}

mysqli_close($con);
?>
