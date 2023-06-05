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

		// print_r($_POST);
		// exit();
        if(isset($_POST['receiver_id']) && !empty($_POST['receiver_id']) && isset($_POST['thread_id']) && !empty($_POST['thread_id']) && isset($_POST['message']) && !empty($_POST['message'])){
            
            $user_login = true;
    		$user_fetch = $check_response->fetch_assoc();

            $select_thread_messages_receiver = $connect->prepare("SELECT * FROM `users` WHERE `ID` = ?");
            $select_thread_messages_receiver->bind_param("s", $_POST['receiver_id']);
            $select_thread_messages_receiver->execute();
            $select_thread_messages_receiver_response = $select_thread_messages_receiver->get_result();
            $select_thread_messages_receiver_fetch = $select_thread_messages_receiver_response->fetch_assoc();
		    
            $is_read = "0";
    		$insert = $connect->prepare("INSERT INTO `messages` (`ID`, `thread_id`, `sender_id`, `receiver_id`, `message`, `is_read`) VALUES (NULL, ?, ?, ?, ?, ?)");
    		$insert->bind_param("sssss", $_POST['thread_id'], $_SESSION['user_id'], $_POST['receiver_id'], $_POST['message'], $is_read);
    		if($insert->execute()){
    		    
    			header('Location: /message/' . $select_thread_messages_receiver_fetch['username']);
    		    
    		} else {
    		    
    			header('Location: /message/' . $select_thread_messages_receiver_fetch['username']);
    		    
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
    