<?php

session_start();
session_regenerate_id();

$response = [];
$user_login = false;
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){

    require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
    
	$check = $connect->prepare("SELECT * FROM `users` WHERE `ID` = ?");
	$check->bind_param("s", $_SESSION['user_id']);
	$check->execute();
	$check_response = $check->get_result();
	if($check_response->num_rows > 0){

        if(isset($_POST['id']) && !empty($_POST['id'])){
            
            $user_fetch = $check_response->fetch_assoc();
            $delete = $connect->prepare("DELETE FROM `messages` WHERE `ID` = ?");
            $delete->bind_param("s", $_POST['id']);
            if($delete->execute()){

                $response = [
                    "request"       =>  true,
                    "error"         =>  ""
                ];

            } else {

                $response = [
                    "request"       =>  false,
                    "error"         =>  "Unable to process the request! Please try again..."
                ];

            }
            
        }

	} else {

        $response = [
            "request"       =>  false,
            "error"         =>  "Please login to continue"
        ];

	}

} else {
    
    $response = [
        "request"       =>  false,
        "error"         =>  "Please login to continue"
    ];
    
}

$json_repsonse = json_encode( $response );
print_r( $json_repsonse );
