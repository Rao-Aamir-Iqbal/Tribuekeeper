<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

	require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-panel/requires/connect.php";

	if(isset($_GET['delete'])){

    $id = $_GET['delete'];
    
    $sql = "DELETE FROM `mementose_videos` WHERE id = {$id}";
    
     $result = mysqli_query($connect , $sql);
     
    
    //  $row = $result->fetch_assoc();
    //  $filePath = $row["video_path"];

    //   $folderPath = "/path/to/images/";

    
    if($result){
           $_SESSION['delete-success'] = " " ." Video has been deleted successfully";
            header("Location: /admin-panel/mementose_videos");
            
       }
       
      
       

  

};
    
    





?>