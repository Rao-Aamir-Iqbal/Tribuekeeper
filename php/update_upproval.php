<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
session_regenerate_id();




   require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
   
    $username = $_GET['username'];

	if(isset($_GET['id'])){

    $id = $_GET['id'];
    $sql = "UPDATE `memorial_comments` SET `status`='1' WHERE id = $id";
    
     $result = mysqli_query($connect , $sql);

    
    if($result){
    header("Location: /tributes_approval/" . $username );
      }else{
          echo "Error";
      }
      
    


};




?>