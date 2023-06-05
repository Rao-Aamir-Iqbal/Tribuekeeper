<?php

session_start();
session_regenerate_id();

$user_login = false;
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){

    require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
    
	$check = $connect->prepare("SELECT * FROM `users` WHERE `ID` = ?");
	$check->bind_param("s", $_SESSION['user_id']);
	$check->execute();
	$check_response = $check->get_result();
	if($check_response->num_rows > 0){

        if(isset($_POST['mementose_picture_id']) && !empty($_POST['mementose_picture_id']) && isset($_POST['type']) && !empty($_POST['type'])){
            
            $user_fetch = $check_response->fetch_assoc();
            $update = $connect->prepare("UPDATE `mementose_pictures` SET `type` = ? WHERE `ID` = ? AND `user_id` = ?");
            $update->bind_param("sss", $_POST['type'], $_POST['mementose_picture_id'], $_SESSION['user_id']);
            if($update->execute()){

                header('Location: /edit/mementose/' . $user_fetch['username']);

            } else {

                header('Location: /edit/mementose/' . $user_fetch['username']);

            }
            
        }

	} else {

		unset($_SESSION['user_id']);
		header('Location: /login');

	}

} else {
    
	header('Location: /login');
    
}
