<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

   require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
   
	if(isset($_GET['delete'])){

    $id = $_GET['delete'];
    $sql = "DELETE FROM `memorial_comments` WHERE id = $id";
    
     $result = mysqli_query($connect , $sql);

    
    if($result){
      header("Location: /view_comments/" );
      }else{
          echo "not deleated it";
      }
      
    


};




?>