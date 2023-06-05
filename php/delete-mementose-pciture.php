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

        if(isset($_POST['mementose_picture_id']) && !empty($_POST['mementose_picture_id'])){
            
            $user_fetch = $check_response->fetch_assoc();

            $select = $connect->prepare("SELECT * FROM `mementose_pictures` WHERE `ID` = ? AND `user_id` = ?");
            $select->bind_param("ss", $_POST['mementose_picture_id'], $_SESSION['user_id']);
            $select->execute();
            $select_response = $select->get_result();
            if($select_response->num_rows > 0){

                $select_response_fetch = $select_response->fetch_assoc();
                unlink( $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $select_response_fetch['image_path'] );
                $delete = $connect->prepare("DELETE FROM `mementose_pictures` WHERE `ID` = ? AND `user_id` = ?");
                $delete->bind_param("ss", $_POST['mementose_picture_id'], $_SESSION['user_id']);
                if($delete->execute()){
    
                    header('Location: /edit/mementose/' . $user_fetch['username']);
    
                } else {
    
                    header('Location: /edit/mementose/' . $user_fetch['username']);
    
                }

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
