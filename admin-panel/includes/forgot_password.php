<?php

session_start();
session_regenerate_id();
extract($_POST);

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sendmail.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/admin-panel/requires/connect.php";




if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    
    if(isset($_POST['email']) && !empty($_POST['email'])){
        
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            
             $email = $_POST['email'];
            $sql = "SELECT * FROM `admins` WHERE email = '$email' ";
            $result = mysqli_query($connect , $sql);
            if(mysqli_num_rows($result) > 0){
               
      $to = $email;
      $otp = rand(100000, 999999);
      $subject = "The Otp code is send to " . " " . $email;
    $message = "Check your mail box and check the  will be send" . " " . $otp;
    $headers = "From: info@tributekeeper.com\r\n";
    // $headers .= "MIME-Version: 1.0\r\n";
    // $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
     $_SESSION['otp'] = $otp;
    
    
    if(sendMail($to, $subject, $message, "")){
        
      $_SESSION['page'] = 2;
         header("Location: /admin-panel/code");
         
    }else{
        header("Location: /admin-panel/forgot");
    }
        
                
            }else{
                $_SESSION['error'] = "Email Does not exist !!!";
                
        header("Location: /admin-panel/forgot");
        
    }
            
    
    
  
            
        }
        
    }
    

   
     
  
  

 
    
}

?>