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

        if(isset($_POST['comment']) && !empty($_POST['comment']) && isset($_POST['mementose_id']) && !empty($_POST['mementose_id'])){
            
            $user_login = true;
    		$user_fetch = $check_response->fetch_assoc();
		    
			$check_mementose_picture = $connect->prepare("SELECT * FROM `mementose_pictures` WHERE `ID` = ?");
			$check_mementose_picture->bind_param("s", $_POST['mementose_id']);
			$check_mementose_picture->execute();
			$check_mementose_picture_response = $check_mementose_picture->get_result();
			if($check_mementose_picture_response->num_rows > 0){

				$check_mementose_picture_fetch = $check_mementose_picture_response->fetch_assoc();

				$check_mementose_user = $connect->prepare("SELECT * FROM `users` WHERE `ID` = ?");
				$check_mementose_user->bind_param("s", $check_mementose_picture_fetch['user_id']);
				$check_mementose_user->execute();
				$check_mementose_user_response = $check_mementose_user->get_result();
				$check_mementose_user_fetch = $check_mementose_user_response->fetch_assoc();

				$comment = $connect->real_escape_string($_POST['comment']);
				$insert = $connect->prepare("INSERT INTO `mementose_comments` (`ID`, `user_id`, `mementose_id`, `comment`) VALUES (NULL, ?, ?, ?)");
				$insert->bind_param("sss", $_SESSION['user_id'], $_POST['mementose_id'], $comment);
				if($insert->execute()){
					
					header('Location: /mementose/' . $check_mementose_user_fetch['username']);
					
				} else {
					
					header('Location: /mementose/' . $check_mementose_user_fetch['username']);
					
				}

			} else {

				header('Location: /mementose/' . $check_mementose_user_fetch['username']);

			}
            
        } else {
            
			header('Location: /mementose/' . $check_mementose_user_fetch['username']);
            
        }

	} else {

		unset($_SESSION['user_id']);
		header('Location: /login');

	}

} else {
    
	header('Location: /login');
    
}
    