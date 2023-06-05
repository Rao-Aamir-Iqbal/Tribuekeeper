<?php
session_start();
session_regenerate_id();
extract($_POST);

 
if(isset($_SESSION['otp']) && !empty($_SESSION['otp'])){
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['code1'])){
      $StoreOtp = $_SESSION['otp'];  
      $otp1 = $_POST['code1'];
     
      
      if($StoreOtp == $otp1 ){
          $_SESSION['success'] = "Otp Match Successfully";
         header("Location: /admin-panel/newpassword");
         
           unset($_SESSION['otp']);
          $_SESSION['page'] = 3 ;
              
        
      }else{
          
            $_SESSION['error'] = "Invalid OTP. Please try again.!";
              header("Location: /admin-panel/code");
      
           
       }
      }
      
   
  }
  

   
    
    

    






?>