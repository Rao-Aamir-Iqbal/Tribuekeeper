<?php

session_start();
session_regenerate_id();
extract($_POST);
require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-panel/requires/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password']) && isset($_POST['password2'])){
    
      $password = $_POST['password'];
      $confirmPassword = $_POST['password2'];
      
    //   echo $comn = $password . $confirmPassword;
      
      if($password == $confirmPassword){
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT, array("cost" => 12));
          $sql = "UPDATE `admins` SET `password`='$hashedPassword'";
          $result = mysqli_query($connect , $sql);
          
          if($result){
              $_SESSION['success'] = "Your Password Rest Succesfully";
                header("Location: /admin-panel/login");

               

              
          }else{
             $_SESSION['error'] = "Password will not match!";

                header("Location: /admin-panel/newpassword");

          }
         
         
      }else{
             $_SESSION['error'] = "Password will not match!";

                header("Location: /admin-panel/newpassword");

          }

    
    
    
    
}





?>