<?php

session_start();
session_regenerate_id();

$response = [];
if(isset($_POST['mementose']) && !empty($_POST['mementose'])){
    
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
    
    $user_login = false;
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){

		$check = $connect->prepare("SELECT * FROM `users` WHERE `ID` = ?");
		$check->bind_param("s", $_SESSION['user_id']);
		$check->execute();
		$check_response = $check->get_result();
		if($check_response->num_rows > 0){

            $user_login = true;
    		$user_fetch = $check_response->fetch_assoc();
		
		    $type = 2;
    		$update = $connect->prepare("UPDATE `mementose_pictures` SET `type` = ? WHERE `user_id` = ?");
    		$update->bind_param("ss", $type, $_SESSION['user_id']);
    		$update->execute();
    		
    		$mementose = json_decode($_POST['mementose']);
    		for($i = 0; $i < count($mementose); $i++){
    		    
    		    
    		    $type = 3;
	    		$update = $connect->prepare("UPDATE `mementose_pictures` SET `type` = ? WHERE `ID` = ?");
        		$update->bind_param("ss", $type, $mementose[$i]);
        		$update->execute();
    		    
    		}
    		
		    $response = [
                "request"       =>  true,
                "error"         =>  ""
            ];

		} else {

			unset($_SESSION['user_id']);
			
		    $response = [
                "request"       =>  false,
                "error"         =>  "Please login and try again..."
            ];

		}

	} else {
	    
	    $response = [
            "request"       =>  false,
            "error"         =>  "Please login and try again..."
        ];
	    
	}
    
} else {
    
    $response = [
        "request"       =>  false,
        "error"         =>  "Missing required fields! Please try again..."
    ];
    
}

$json_response = json_encode($response);
print_r( $json_response );

    