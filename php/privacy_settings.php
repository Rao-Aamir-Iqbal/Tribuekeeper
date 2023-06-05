<?php
// Start the session and include the database connection file
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$user_id = $_SESSION['user_id'];

// Get the form data
if(isset($_POST['email_notification'])){
    $email_notification = $_POST['email_notification']; 
    $keeper_updates = $_POST['keeper_updates']; 
    $language = $_POST['language']; 
    
    $sql = "UPDATE `user_settings` SET `language`='$language', `email_notifications`='$email_notification' , `keeper_news_updates`= '$keeper_updates' WHERE user_id = $user_id";
    $exe = mysqli_query($con, $sql);
    if($exe){
    echo "<p style='color: #008800;'>Data Saved!</p>";
    }else{
        echo "Query Error!";
    }
} 

if(isset($_POST['privacy_setting'])){
    $privacy_setting = $_POST['privacy_setting']; 

    $privacy_setting;
    
    $sql = "UPDATE `user_settings` SET `privacy_view`='$privacy_setting' WHERE user_id = $user_id";
    $exe = mysqli_query($con, $sql);
    if($exe){
    echo "<p style='color: #008800;'>Data Saved!</p>";
    }else{
        echo "Query Error!";
    }
} 

?>