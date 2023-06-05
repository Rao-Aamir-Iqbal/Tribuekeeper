<?php

session_start();
session_regenerate_id();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sendmail.php';

extract($_POST);
if(isset($firstname) && !empty($firstname) && isset($lastname) && !empty($lastname) && isset($username) && !empty($username) && isset($email) && !empty($email) && isset($gender) && !empty($gender) && isset($birthdate) && !empty($birthdate) && isset($password) && !empty($password) && isset($confirm_password) && !empty($confirm_password)){  

    if(filter_var($email, FILTER_VALIDATE_EMAIL)){

        $check_email = $connect->prepare("SELECT * FROM `users` WHERE `email` = ?");
        $check_email->bind_param("s", $email);
        $check_email->execute();
        $check_email_response = $check_email->get_result();
        if($check_email_response->num_rows <= 0){

            $check_username = $connect->prepare("SELECT * FROM `users` WHERE `username` = ?");
            $check_username->bind_param("s", $username);
            $check_username->execute();
            $check_username_response = $check_username->get_result();
            if($check_username_response->num_rows <= 0){

                if($password == $confirm_password){

                    $type = 1;
                    $status = 0;
                    $membership = 2;
                    $middlename = isset($middlename) && !empty($middlename) ? $middlename : "";
                    $hash = password_hash($password, PASSWORD_DEFAULT, array("cost" => 11));
                    $insert = $connect->prepare("INSERT INTO `users` (`ID`, `firstname`, `middlename`, `username`, `lastname`, `date_of_birth`, `email`, `password`, `gender`, `type`, `status`, `membership`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $insert->bind_param("sssssssssss", $firstname, $middlename, $username, $lastname, $birthdate, $email, $hash, $gender, $type, $status, $membership);
                    if($insert->execute()){
                        
                        if(isset($_SESSION['memorial_id']) && !empty($_SESSION['memorial_id'])){

                            $user_id = $insert->insert_id;
                            $memorial_id = $_SESSION['memorial_id'];
                            $insert = $connect->prepare("INSERT INTO `keepers` (`id`, `user_id`, `kepper_ids`) VALUES (NULL, ?, ?)");
                            $insert->bind_param("ss", $user_id, $memorial_id);
                            $insert->execute();

                            sendMail($email, "Registration has been completed successfully on Tributekeeper", "Thank you! We're excited to have you on board and would like to extend a warm welcome", "Thank you! We're excited to have you on board and would like to extend a warm welcome");

                            unset($_SESSION['memorial_id']);
                            unset($_SESSION['is_next_step']);

                        }
    
                        header("Location: /login");
    
                    } else {
                        
                        $_SESSION['error'] = "Unable to process the request! Please try again...";
                        header("Location: /signup/memorial");
    
                    }
                    
                } else {

                    $_SESSION['error'] = "Sorry, the password isn't matched! Please try again...";
                    header("Location: /signup/memorial");

                }

            } else {

                $_SESSION['error'] = "Username is already exist! Please try again...";
                header("Location: /signup/memorial");

            }

        } else {

            $_SESSION['error'] = "Email address is already exist! Please try again...";
            header("Location: /signup/memorial");

        }

    } else {

        $_SESSION['error'] = "Email address is invalid! Please try again...";
        header("Location: /signup/memorial");

    }

} else {

    $_SESSION['error'] = "Missing required fields! Please try again...";
    header("Location: /signup/memorial");

}
