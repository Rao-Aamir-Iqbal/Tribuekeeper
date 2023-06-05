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

        if(isset($_FILES['mementose_videos']) && count($_FILES['mementose_videos']['tmp_name']) > 0){
            
            $user_fetch = $check_response->fetch_assoc();
            for($i = 0; $i < count($_FILES['mementose_videos']['tmp_name']); $i++){
                
                $extension = strtolower( pathinfo( $_FILES['mementose_videos']['name'][$i], PATHINFO_EXTENSION ) );
                $filename = time() . uniqid(true) . "." . $extension;
                $video_path = $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $filename;
                
                if($extension == "mp4" || $extension == "mov" || $extension == "wmv" || $extension == "avi" || $extension == "mkv" || $extension == "webm"){
                
                    if(move_uploaded_file($_FILES['mementose_videos']['tmp_name'][$i], $video_path)){
                        
                        $type = 2;
                        $insert = $connect->prepare("INSERT INTO `mementose_videos` (`ID`, `user_id`, `video_path`, `type`) VALUES (NULL, ?, ?, ?)");
                        $insert->bind_param("sss", $_SESSION['user_id'], $filename, $type);
                        $insert->execute();
                        
                    }
                    
                }
                
            }
            
            header('Location: /edit/mementose/' . $user_fetch['username']);
            
        }

	} else {

		unset($_SESSION['user_id']);
		header('Location: /login');

	}

} else {
    
	header('Location: /login');
    
}
