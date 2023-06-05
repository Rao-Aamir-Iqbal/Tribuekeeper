<?php
// Start the session and include the database connection file
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$user_id = $_SESSION['user_id'];


// Get the form data
if (isset($_POST['deactivate'])) {
    $sql = "UPDATE `users` SET `status`='2' WHERE ID = $user_id";
    $exe = mysqli_query($con, $sql);
    // Destroy the session to log the user out
    session_destroy();


    echo "<p style='color: #008800;'>Your account is successfully deactivated!</p>";
}

if (isset($_POST['secret_code_gen'])) {
    $user_email = $_POST['secret_code_gen'];
    $sql2 = "UPDATE `users` SET `status`='1' WHERE email = '$user_email'";
    $exe2 = mysqli_query($con, $sql2);
    if ($exe2) {
        echo "<p style='color: #008800'>Note: Your Account is Activated Successfully. You can login Now </p><br> <a href='/login' style='color:#fff; text-decoration: none;' class='m-2 prof-button btn-new'>Login Now</a>";
    }
}

?>