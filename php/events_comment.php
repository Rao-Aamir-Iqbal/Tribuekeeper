<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
$user_id = $_SESSION['user_id'];
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get comment data
    $title = $_POST['title'];
    $comment = $_POST['comment'];
    $currentTimestamp = date("Y-m-d H:i:s");
    $sql = mysqli_query($con, "INSERT INTO `event_comments`(`user_id`, `title`, `comment`, `timestamp`) VALUES ('$user_id', '$title', '$comment','$currentTimestamp')");
    // echo "INSERT INTO `event_comments`(`user_id`, `name`, `comment`) VALUES ('$user_id','$name','$comment')";
    // die();

    if($sql){

        echo "success";
    }

    // Save comment to database or perform necessary actions
    // Replace this with your database logic

    // Return success response
   
}
?>
