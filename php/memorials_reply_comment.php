<?php
// Check if form is submitted
// session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
// $user_id = $_GET['user_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get reply data
    $log_uid= $_POST['log_uid'];
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $commentId = $_POST['commentId'];
    $replyContent = $_POST['replyContent'];
    //$currentTimestamp = date("Y-m-d H:i:s");
    $sql = mysqli_query($con, "INSERT INTO `memorial_comments`(`user_id`,`log_uid`, `reply_id`, `name`, `comment`, `status`) VALUES ('$user_id','$log_uid','$commentId', '$name', '$replyContent','0')");
    if($sql){
        echo "success";
        
    }
    // Save reply to database or perform necessary actions
    // Replace this with your database logic

    // Return success response
   
}