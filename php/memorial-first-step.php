<?php

session_start();
session_regenerate_id();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

extract($_POST);
$user_login = false;
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
    
	$check = $connect->prepare("SELECT * FROM `users` WHERE `ID` = ?");
	$check->bind_param("s", $_SESSION['user_id']);
	$check->execute();
	$check_response = $check->get_result();
	if($check_response->num_rows > 0){

        $user_login = true;
        $user_fetch = $check_response->fetch_assoc();
        
    } else {
        
		unset($_SESSION['user_id']);

	}

}

if(isset($firstname) && !empty($firstname) && isset($lastname) && !empty($lastname) && isset($gender) && !empty($gender) && isset($birthdate) && !empty($birthdate)){  

    $type = 2;
    $username = str_replace(" ", "", $firstname) . rand(0000, 9999) . time();

    if(isset($has_passed_away) && !empty($has_passed_away) && $has_passed_away == "on"){

        if(isset($deathdate) && !empty($deathdate)){

            $status = 0;
            $membership = 2;
            $middlename = isset($middlename) && !empty($middlename) ? $middlename : "";
            $insert = $connect->prepare("INSERT INTO `users` (`ID`, `firstname`, `middlename`, `username`, `lastname`, `date_of_birth`, `date_of_death`, `gender`, `type`, `status`, `membership`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insert->bind_param("ssssssssss", $firstname, $middlename, $username, $lastname, $birthdate, $deathdate, $gender, $type, $status, $membership);
            if($insert->execute()){
                
                if($user_login == false){

                    $_SESSION['is_next_step'] = true;
                    $_SESSION['memorial_id'] = $insert->insert_id;
                    header("Location: /signup/memorial");

                } else if($user_login == true){

                    $memorial_id = $insert->insert_id;
                    $insert = $connect->prepare("INSERT INTO `keepers` (`id`, `user_id`, `kepper_ids`) VALUES (NULL, ?, ?)");
                    $insert->bind_param("ss", $_SESSION['user_id'], $memorial_id);
                    $insert->execute();

                    header("Location: /profile/" . $username);

                }

            } else {
                
                $_SESSION['error'] = "Unable to process the request! Please try again...";
                header("Location: /signup/memorial");

            }

        } else {

            $_SESSION['error'] = "Please enter the date of death!";
            header("Location: /signup/memorial");

        }

    } else {

        if(isset($email) && !empty($email)){

            if(filter_var($email, FILTER_VALIDATE_EMAIL)){

                $check_email = $connect->prepare("SELECT * FROM `users` WHERE `email` = ?");
                $check_email->bind_param("s", $email);
                $check_email->execute();
                $check_email_response = $check_email->get_result();
                if($check_email_response->num_rows <= 0){

                    $status = 0;
                    $membership = 2;
                    $insert = $connect->prepare("INSERT INTO `users` (`ID`, `firstname`, `middlename`, `username`, `lastname`, `date_of_birth`, `email`, `gender`, `type`, `status`, `membership`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $insert->bind_param("ssssssssss", $firstname, $middlename, $username, $lastname, $birthdate, $email, $gender, $type, $status, $membership);
                    if($insert->execute()){
                        
                        if($user_login == false){

                            $_SESSION['is_next_step'] = true;
                            $_SESSION['memorial_id'] = $insert->insert_id;
                            header("Location: /signup/memorial");
        
                        } else if($user_login == true){
        
                            $memorial_id = $insert->insert_id;
                            $insert = $connect->prepare("INSERT INTO `keepers` (`id`, `user_id`, `kepper_ids`) VALUES (NULL, ?, ?)");
                            $insert->bind_param("ss", $_SESSION['user_id'], $memorial_id);
                            $insert->execute();
        
                            header("Location: /profile/" . $username);
        
                        }
    
                    } else {
                        
                        $_SESSION['error'] = "Unable to process the request! Please try again...";
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

            $_SESSION['error'] = "Please enter the email address!";
            header("Location: /signup/memorial");

        }
        
    }

} else {

    $_SESSION['error'] = "Missing required fields! Please try again...";
    header("Location: /signup/memorial");

}
