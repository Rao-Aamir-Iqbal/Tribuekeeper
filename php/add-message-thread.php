<?php

session_start();
session_regenerate_id();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$user_login = false;
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){

	$check = $connect->prepare("SELECT * FROM `users` WHERE `ID` = ?");
	$check->bind_param("s", $_SESSION['user_id']);
	$check->execute();
	$check_response = $check->get_result();
	if($check_response->num_rows > 0){

        if(isset($_GET['username']) && !empty($_GET['username'])){
            
            $user_login = true;
    		$user_fetch = $check_response->fetch_assoc();
		    
            $check_user = $connect->prepare("SELECT * FROM `users` WHERE `username` = ?");
            $check_user->bind_param("s", $_GET['username']);
            $check_user->execute();
            $check_user_response = $check_user->get_result();
            
            if($check_user_response->num_rows > 0){

                $check_user_fetch = $check_user_response->fetch_assoc();
    
                $insert_message_thread = $connect->prepare("INSERT INTO `messages_threads` (`ID`, `sender_id`, `receiver_id`) VALUES (NULL, ?, ?)");
                $insert_message_thread->bind_param("ss", $_SESSION['user_id'], $check_user_fetch['ID']);
                $insert_message_thread->execute();

                header("Location: /message/" . $_GET['username']);

            } else {

				$_SESSION['error'] = "Sorry, this user was not found! Please try again...";
                header("Location: /message");

            }
            
        } else {
            
			$_SESSION['error'] = "Missing required fields! Please try again...";
			header('Location: /message');
            
        }

	} else {

		unset($_SESSION['user_id']);
		header('Location: /login');

	}

} else {
    
	header('Location: /login');
    
}
    