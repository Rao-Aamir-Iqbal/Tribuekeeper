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
        
        if(isset($_POST['username']) && !empty($_POST['username'])){
            
            require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
            $check_username = $connect->prepare("SELECT * FROM `users` WHERE `username` = ?");
            $check_username->bind_param("s", $_POST['username']);
            $check_username->execute();
            $check_username_response = $check_username->get_result();
            if($check_username_response->num_rows > 0){
        
                $check_username_fetch = $check_username_response->fetch_assoc();
        
                $zip = new ZipArchive();
                $zipname = $_POST['username'] . ".zip";
                if(file_exists( $_SERVER['DOCUMENT_ROOT'] . '/download/' . $zipname )){
        
                    unlink( $_SERVER['DOCUMENT_ROOT'] . '/download/' . $zipname );
                    
                }
        
                if($zip->open( $_SERVER['DOCUMENT_ROOT'] . "/download/" . $zipname, ZIPARCHIVE::CREATE )){
                    
                    $mementose_public_pictures = $connect->prepare("SELECT * FROM `mementose_pictures` WHERE `user_id` = ?");
                    $mementose_public_pictures->bind_param("s", $check_username_fetch['ID']);
                    $mementose_public_pictures->execute();
                    $mementose_public_pictures_response = $mementose_public_pictures->get_result();
                    if($mementose_public_pictures_response->num_rows > 0){
                        
                        while($mementose_public_pictures_fetch = $mementose_public_pictures_response->fetch_assoc()){
                            
                            if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $mementose_public_pictures_fetch['image_path'])){
                                
                                if(is_file( $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $mementose_public_pictures_fetch['image_path'] )){
        
                                    $zip->addFile($_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $mementose_public_pictures_fetch['image_path'], $mementose_public_pictures_fetch['image_path']);
        
                                }
        
                            }
            
                        }
            
                    }
                    
                    $response = [
                        "request"           =>  true,
                        "download_link"     =>  '/download/' . $zipname,
                        "error"             =>  ""
                    ];
        
                } else {
        
                    $response = [
                        "request"           =>  false,
                        "download_link"     =>  null,
                        "error"             =>  "Sorry, unable to create the .zip file! Please try again..."
                    ];
        
                }
        
            } else {
        
                $response = [
                    "request"           =>  false,
                    "download_link"     =>  null,
                    "error"             =>  "Sorry, this account doesn't exists! Please try again..."
                ];
        
            }
            
        } else {
            
            $response = [
                "request"           =>  false,
                "download_link"     =>  null,
                "error"             =>  "Missing required fields! Please try again..."
            ];
            
        }

	} else {

        $response = [
            "request"           =>  false,
            "download_link"     =>  null,
            "error"             =>  "Please login and try again..."
        ];

	}

} else {
    
    $response = [
        "request"           =>  false,
        "download_link"     =>  null,
        "error"             =>  "Please login and try again..."
    ];
    
}



$json_response = json_encode( $response );
print_r( $json_response );
