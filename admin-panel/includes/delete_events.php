<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
	
	require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-panel/requires/connect.php";
	if(isset($_GET['delete'])){

    $id = $_GET['delete'];
    
    $sql = "DELETE FROM `events` WHERE id = {$id}";
    
     $result = mysqli_query($connect , $sql);

    
    if($result){
         $_SESSION['delete-success'] = " " . " Events has been deleted successfully";
        header("Location: /admin-panel/events");
       }


};




?>