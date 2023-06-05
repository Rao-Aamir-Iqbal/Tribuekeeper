<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
 session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
// $username = $_GET['username'];
// $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
// $exe = mysqli_query($con, $sql);
// $fetch = mysqli_fetch_assoc($exe);

// $user_id = $fetch['ID'];
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get comment data
    $final_image=null;$log_uid=null;
    $name = $_POST['name'];
    $comment = $_POST['comment'];
     $user_id = $_POST['user_id'];
     if(!empty($_SESSION['user_id'])){
     $log_uid=$_POST['log_uid'];
     }
     $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = $_SERVER['DOCUMENT_ROOT'] . "/uploads/"; // upload directory
if(!empty($_FILES['image']['tmp_name']))
{
$img = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function
$final_image = rand(1000,1000000).$img;
// check's valid format
if(in_array($ext, $valid_extensions)) 
{ 
$final_image = strtolower($final_image); 
$path= $path.strtolower($final_image);
move_uploaded_file($tmp,$path);
}
}
    //$currentTimestamp = date("Y-m-d H:i:s");
     $sql = mysqli_query($con, "INSERT INTO `memorial_comments`(`user_id`, `log_uid`,`name`,`image`, `comment`, `status`) VALUES ('$user_id','$log_uid', '$name','$final_image' ,'$comment','0')");
   //  $sql = mysqli_query($con,"INSERT INTO `memorial_comments` (`id`, `user_id`, `log_uid`, `name`, `title`, `image`, `comment`, `timestamp`, `reply_id`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)");
    echo "INSERT INTO `memorial_comments`(`user_id`, `name`,`image`,`log_uid`, `comment`, `timestamp`) VALUES ('$user_id', '$name','$final_image','$log_uid' ,'$comment','$currentTimestamp')";
//  echo"$sql";
      //  echo     "INSERT INTO `memorial_comments`(`user_id`, `log_uid`,`name`,`image`, `comment`, `timestamp`) VALUES ('$user_id','$log_uid', '$name','$final_image' ,'$comment','$currentTimestamp')";
// var_dump($sql);
    if($sql == true){

       echo "success";
    }

    // Save comment to database or perform necessary actions
    // Replace this with your database logic

    // Return success response
//   exit($response);
}
?>