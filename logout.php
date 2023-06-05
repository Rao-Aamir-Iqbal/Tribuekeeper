<?php
    session_start();

    $user_id = $_SESSION['user_id'];

    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Unset the user_id variable
    unset($user_id);

    // Redirect to the login page
    header('location: /login');
?>
