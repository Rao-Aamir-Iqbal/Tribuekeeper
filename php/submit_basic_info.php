<?php
// This is the AJAX file that processes the form data and updates the user's record in the database

// Start the session and include the database connection file
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

// Get the form data
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname']; 
$username = $_POST['username']; 
$suffix = $_POST['suffix'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
// Sanitize the form data
$firstname = mysqli_real_escape_string($con, $firstname);
$middlename = mysqli_real_escape_string($con, $middlename);
$lastname = mysqli_real_escape_string($con, $lastname);
$suffix = mysqli_real_escape_string($con, $suffix);
$dob = mysqli_real_escape_string($con, $dob);
$gender = mysqli_real_escape_string($con, $gender);


// Get the user's ID from the session
$user_id = $_SESSION['user_id'];

// Update the user's record in the database
$sql = "UPDATE `users` SET suffix='$suffix',firstname='$firstname', middlename='$middlename', lastname='$lastname', username='$username', date_of_birth='$dob', gender='$gender' WHERE id='$user_id'";

if (mysqli_query($con, $sql)) {
  echo "<p style='color: #008800;'>Data Saved!</p>";
} else {
  echo "error";
}

mysqli_close($con);
?>
