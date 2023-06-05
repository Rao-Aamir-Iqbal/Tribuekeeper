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

        if(isset($_POST['mementose_comment_id']) && !empty($_POST['mementose_comment_id'])){
            
            $user_fetch = $check_response->fetch_assoc();

            $check_mementose_comment = $connect->prepare("SELECT * FROM `mementose_comments` WHERE `ID` = ?");
			$check_mementose_comment->bind_param("s", $_POST['mementose_comment_id']);
			$check_mementose_comment->execute();
			$check_mementose_comment_response = $check_mementose_comment->get_result();
			if($check_mementose_comment_response->num_rows > 0){

				$check_mementose_comment_fetch = $check_mementose_comment_response->fetch_assoc();

				$check_mementose = $connect->prepare("SELECT * FROM `mementose_pictures` WHERE `ID` = ?");
				$check_mementose->bind_param("s", $check_mementose_comment_fetch['mementose_id']);
				$check_mementose->execute();
				$check_mementose_response = $check_mementose->get_result();

                if($check_mementose_comment_response->num_rows > 0){

                    $check_mementose_fetch = $check_mementose_response->fetch_assoc();

                    $check_mementose_user = $connect->prepare("SELECT * FROM `users` WHERE `ID` = ?");
                    $check_mementose_user->bind_param("s", $check_mementose_fetch['user_id']);
                    $check_mementose_user->execute();
                    $check_mementose_user_response = $check_mementose_user->get_result();
                    $check_mementose_user_fetch = $check_mementose_user_response->fetch_assoc();
    
                    $delete = $connect->prepare("DELETE FROM `mementose_comments` WHERE `ID` = ? AND `user_id` = ?");
                    $delete->bind_param("ss", $_POST['mementose_comment_id'], $_SESSION['user_id']);
                    if($delete->execute()){
        
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
            
            header('Location: /mementose/' . $check_mementose_user_fetch['username']);

        }

	} else {

		unset($_SESSION['user_id']);
		header('Location: /login');

	}

} else {
    
	header('Location: /login');
    
}
