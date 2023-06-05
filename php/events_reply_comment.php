<?php
// Check if form is submitted
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get reply data
    $title = $_POST['title'];
    $commentId = $_POST['commentId'];
    $replyContent = $_POST['replyContent'];
    $currentTimestamp = date("Y-m-d H:i:s");
    $sql = mysqli_query($con, "INSERT INTO `event_comments`(`user_id`, `reply_id`, `title`, `comment`, `timestamp`) VALUES ('$user_id','$commentId', '$title', '$replyContent','$currentTimestamp')");
    if($sql){
        echo "success";
    }
    // Save reply to database or perform necessary actions
    // Replace this with your database logic

    // Return success response
   
}
