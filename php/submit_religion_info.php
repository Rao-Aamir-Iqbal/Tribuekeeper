<?php
// Start the session and include the database connection file
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$user_id = $_SESSION['user_id'];

if (isset($_POST['religion'])) {
  $religion = $_POST["religion"];

  $sql = "UPDATE users SET religion='$religion' WHERE id=$user_id";

  if ($con->query($sql) === TRUE) {
    echo "<p style='color: #008800;'>Data Saved!</p>";
  } else {
    echo "Error updating religion: ";
  }
}

if (isset($_POST['custom-religion'])) {
  $religion = $_POST["custom-religion"];

  $sql = "UPDATE users SET religion='$religion' WHERE id=$user_id";

  if ($con->query($sql) === TRUE) {
    echo "<p style='color: #008800;'>Data Saved!</p>";
  } else {
    echo "Error updating religion: ";
  }
}

// close the database connection
$con->close();


?>