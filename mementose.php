<?php

    session_start();
    session_regenerate_id();

    if(isset($_GET['username']) && !empty($_GET['username'])){
        
        require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
        $check_username = $connect->prepare("SELECT * FROM `users` WHERE `username` = ?");
        $check_username->bind_param("s", $_GET['username']);
        $check_username->execute();
        $check_username_response = $check_username->get_result();
        if($check_username_response->num_rows > 0){

            $check_username_fetch = $check_username_response->fetch_assoc();

            $user_login = false;
            if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
        
                $check = $connect->prepare("SELECT * FROM `users` WHERE `ID` = ?");
                $check->bind_param("s", $_SESSION['user_id']);
                $check->execute();
                $check_response = $check->get_result();
                if($check_response->num_rows > 0){
        
                    $user_login = true;
                    $user_fetch = $check_response->fetch_assoc();
                    $user_id = $_SESSION['user_id'];

                } else {
        
                    unset($_SESSION['user_id']);
        
                }
        
            } else {

                $check = $connect->prepare("SELECT * FROM `users` WHERE `username` = ?");
                $check->bind_param("s", $_GET['username']);
                $check->execute();
                $check_response = $check->get_result();
                if($check_response->num_rows > 0){
                    
                    $user_fetch = $check_response->fetch_assoc();
                    $user_id = $user_fetch['ID'];

                }

            }

        } else {

            http_response_code(404);
            exit();

        }
        
    } else {
        
        http_response_code(404);
        exit();
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mementos - Tribute Keeper </title>
	<link rel="stylesheet" href="/assets/css/style.css"/>
    <link rel="stylesheet" href="/assets/js/script.js">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/assets/css/themify-icons.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css">
    <style>
    
       

        .gradient {
            background: #428bca;
            background: linear-gradient(195deg, #5b1346 -24.65%, #46c0e1 97.7%);
        }
        
    </style>
</head>
<body>

    <section class="h-100 gradient-custom-2">
       
       	<?php

    	    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
    	    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/subheader.php';
    
    	?>
        
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div>
                    <div class="card">
                        <div class="pt-4 text-black">
                            <div class="p-4 edit-profile-border">
                                
                                <h3 class="pt-3"> Public Mementos Pictures </h3>
                                <div class="alert alert-danger public-mementose-upgrade-to-keeper-plus d-none" role="alert">
                                    Please upgrade to Keeper Plus for downloading photos in a single file!
                                </div>
                                <?php

                                    if($user_login == true){

                                        ?>

                                            <p class="py-2"> Anyone that visits the page will be able to view these photos you've selected below. </p>

                                        <?php

                                    }

                                ?>
                                
                                <hr>
                                
                                <div class='public-mementose-pictures'>
                                    
                                    <div class='row px-2'>
                                        
                                        <?php
                                        
                                            $type = '3';
                                    		$mementose_pictures = $connect->prepare("SELECT * FROM `mementose_pictures` WHERE `user_id` = ? AND `type` = ?");
                                    		$mementose_pictures->bind_param("ss", $check_username_fetch['ID'], $type);
                                    		$mementose_pictures->execute();
                                    		$mementose_pictures_response = $mementose_pictures->get_result();
                                    		if($mementose_pictures_response->num_rows > 0){
                                    		    
                                    		    while($mementose_pictures_fetch = $mementose_pictures_response->fetch_assoc()){
                                    		        
                                    		        ?>
                                    		        
                                    		            <div class='col-6 col-xl-2 col-lg-3 col-md-4 my-1 px-1'>
                                                            <div data-bs-toggle="modal" data-bs-target="#mementose-picture-<?php print( $mementose_pictures_fetch['ID'] ) ?>" data-id='<?php print( $mementose_pictures_fetch['ID'] ) ?>' style="background: url(/uploads/<?php print( $mementose_pictures_fetch['image_path'] ) ?>); background-position-x: center; background-position-y: center; background-repeat: no-repeat; background-size: cover; width: 100%; height: 125px; border-radius: 5px; cursor: pointer"></div>
                                    		            </div>
                                    		        
                                    		        <?php
                                    		        
                                    		    }
                                    		    
                                    		} else {
                                    		    
                                    		    ?>
                                    		    
                                    		        <div class='col-12'>
                                        		        <p class="py-5 my-5 text-center"> There are no mementos for this profile </p>
                                    		        </div>
                                    		    
                                    		    <?php
                                    		    
                                    		}
                                        
                                        ?>
                                    
                                    </div>
                                    <div class="d-flex my-4">
                                        
                                        <?php
                                        
                                            if($user_login == 'true' && $check_username_fetch['ID'] == $user_fetch['ID']){
                                                
                                                ?>
                                                
                                                    <button class="prof-button  mx-1 select-public-mementose-pictures"> Select Public Mementos </button>
                                                
                                                <?php
                                                
                                            }

                                            if($user_login == true){

                                                ?>

                                                    <button class="prof-button mx-1 download-public-mementose-pictures"> Download all photos </button>

                                                <?php

                                            } else {

                                                if($user_login == false && $user_fetch['membership'] == 1){

                                                    ?>

                                                        <button class="prof-button mx-1 download-public-mementose-pictures"> Download all photos </button>

                                                    <?php

                                                }

                                            }                                             
                                        
                                        ?>
                                        
                                    </div>
                                    
                                </div>
                                
                                <?php
                                
                                    if($user_login == 'true' && $check_username_fetch['ID'] == $user_fetch['ID']){
                                        
                                        ?>

                                            <div class='public-mementose-pictures-selections' style='display: none'>
                                    
                                                <div class="alert alert-danger upgrade-to-keeper-plus d-none" role="alert">
                                                    Please upgrade to Keeper Plus for selecting more then 5 pictures!
                                                </div>
                                                <div class='row'>
                                                    
                                                    <?php 
            
                                                		$mementose_selection_pictures = $connect->prepare("SELECT * FROM `mementose_pictures` WHERE `user_id` = ?");
                                                		$mementose_selection_pictures->bind_param("s", $check_username_fetch['ID']);
                                                		$mementose_selection_pictures->execute();
                                                		$mementose_selection_pictures_response = $mementose_selection_pictures->get_result();
                                                		if($mementose_selection_pictures_response->num_rows > 0){
                                                		    
                                                		    while($mementose_selection_pictures_fetch = $mementose_selection_pictures_response->fetch_assoc()){
                                                		        
                                                		        ?>
                                                		        
                                                		            <div class='col-6 col-xl-2 col-lg-3 col-md-4 my-1'>
                                                		                <input class="form-check-input" type="checkbox" <?php $mementose_selection_pictures_fetch['type'] == 3 ? print('checked') : null ?> style="z-index: 99999; position: relative; bottom: -25px; left: 5px; font-size: 20px">
                                                                        <div class='mementose-picture' data-id='<?php print( $mementose_selection_pictures_fetch['ID'] ) ?>' style="background: url(/uploads/<?php print( $mementose_selection_pictures_fetch['image_path'] ) ?>); background-position-x: center; background-position-y: center; background-repeat: no-repeat; background-size: cover; width: 100%; height: 125px; border-radius: 5px; cursor: pointer"></div>
                                                		            </div>
                                                		        
                                                		        <?php
                                                		        
                                                		    }
                                                		    
                                                		} else {
                                                		    
                                                		    ?>
                                                		    
                                                		        <div class='col-12'>
                                                    		        <p class="py-5 my-5 text-center"> There are no mementos for this profile </p>
                                                		        </div>
                                                		    
                                                		    <?php
                                                		    
                                                		}
                                                    
                                                    ?>
                                                
                                                </div>
                                                <div class="d-flex my-4">
                                                    
                                                    <button class="prof-button  mx-1 confirm-selection-public-mementose-pictures"> Confirm Selection </button>
                                                    <button class="prof-button  mx-1 cancel-selection-public-mementose-pictures"> Cancel </button>
                                                    
                                                </div>
                                                
                                            </div>

                                        <?php
                                        
                                    }
                                
                                ?>

                            </div>
                        </div>
                        
                        <?php
                        
                            if($user_login == 'true' && $check_username_fetch['ID'] == $user_fetch['ID']){
                                
                                ?>
                                
                                    <div class="pt-4 text-black">
                                        <div class="p-4 edit-profile-border">
                                                
                                            <h3 class="pt-3"> All Mementos </h3>
                                            <div class="alert alert-danger all-mementose-upgrade-to-keeper-plus d-none" role="alert">
                                                Please upgrade to Keeper Plus for downloading photos in a single file!
                                            </div>
                                            <hr>
                                            
                                            <div class='row px-2'>

                                                <?php
        
                                            		$mementose_pictures = $connect->prepare("SELECT * FROM `mementose_pictures` WHERE `user_id` = ?");
                                            		$mementose_pictures->bind_param("s", $check_username_fetch['ID']);
                                            		$mementose_pictures->execute();
                                            		$mementose_pictures_response = $mementose_pictures->get_result();
                                            		if($mementose_pictures_response->num_rows > 0){
                                            		    
                                                        while($mementose_pictures_fetch = $mementose_pictures_response->fetch_assoc()){
                                            		        
                                            		        ?> 
                                            		        
                                                                <div class='col-6 col-xl-2 col-lg-3 col-md-4 my-1 px-1'>
                                                                    <div data-bs-toggle="modal" data-bs-target="#mementose-picture-<?php print( $mementose_pictures_fetch['ID'] ) ?>" data-id='<?php print( $mementose_pictures_fetch['ID'] ) ?>' style="background: url(/uploads/<?php print( $mementose_pictures_fetch['image_path'] ) ?>); background-position-x: center; background-position-y: center; background-repeat: no-repeat; background-size: cover; width: 100%; height: 125px; border-radius: 5px; cursor: pointer"></div>
                                                                </div>
                                            		        
                                            		        <?php
                                            		        
                                            		    }
                                            		   
                                            		} else {
                                            		    
                                            		    ?>
    
                                            		        <div class='col-12'>
                                                		        <p class="py-5 my-5 text-center"> There are no mementos for this profile </p>
                                            		        </div>
                                            		    
                                            		    <?php
                                            		    
                                            		}
                                                
                                                ?>
                                            
                                            </div>
                                            
                                            <div class="d-flex my-4">
                                    
                                                <?php
                                                
                                                    if($user_login == 'true' && $check_username_fetch['ID'] == $user_fetch['ID']){
                                                        
                                                        ?>
                                                        
                                                            <a href='/edit/mementose/<?php print( $check_username_fetch['username'] ) ?>' style="text-align: center; color: white; text-decoration: none" class="prof-button  mx-1"> Add & Edit Mementos </a>
                                                        
                                                        <?php
                                                        
                                                    }
                                                
                                                    if($user_login == true){

                                                        ?>

                                                            <button class="prof-button mx-1 download-all-mementose-pictures"> Download all photos </button>

                                                        <?php

                                                    } else {

                                                        if($user_login == false && $user_fetch['membership'] == 1){

                                                            ?>

                                                                <button class="prof-button mx-1 download-all-mementose-pictures"> Download all photos </button>

                                                            <?php

                                                        }

                                                    } 

                                                ?>
                                                
                                            </div>
        
                                        </div>
                                    </div>
                                
                                <?php
                                
                            }
                        
                        ?>
                        
                        <div class="pt-4 text-black">
                            <div class="p-4 edit-profile-border">
                                    
                                <h3 class="pt-3"> Public Mementos Videos </h3>
                                <hr>
                                
                                <div class='row px-2'>

                                    <?php

                                        $type = 3;
                                        $mementose_video = $connect->prepare("SELECT * FROM `mementose_videos` WHERE `user_id` = ? AND `type` = ?");
                                        $mementose_video->bind_param("ss", $check_username_fetch['ID'], $type);
                                        $mementose_video->execute();
                                        $mementose_video_response = $mementose_video->get_result();
                                        if($mementose_video_response->num_rows > 0){
                                            
                                            while($mementose_video_fetch = $mementose_video_response->fetch_assoc()){

                                                ?> 
                                                
                                                    <div class='col-6 col-xl-2 col-lg-3 col-md-4 my-1 px-1'>
                                                        <div data-bs-toggle="modal" data-bs-target="#mementose-videos-<?php print( $mementose_video_fetch['ID'] ) ?>" data-id='<?php print( $mementose_video_fetch['ID'] ) ?>' style="width: 100%; height: 125px; border-radius: 5px; cursor: pointer; overflow: hidden; display: flex; align-items: center; justify-content: center">
                                                    
                                                            <video width="100%" height="125">
                                                                <source src="/uploads/<?php print( $mementose_video_fetch['video_path'] ) ?>">
                                                                Your browser does not support the video tag.
                                                            </video>

                                                        </div>
                                                    </div>
                                                
                                                <?php
                                                
                                            }
                                            
                                        } else {
                                            
                                            ?>

                                                <div class='col-12'>
                                                    <p class="py-5 my-5 text-center"> There are no video for this profile </p>
                                                </div>
                                            
                                            <?php
                                            
                                        }
                                    
                                    ?>
                                
                                </div>

                            </div>
                        </div>

                        <?php

                            if($user_fetch['membership'] == 2 && $user_login == true){

                                ?>

                                    <div class="row pt-4 text-black">
                                        <div class="col-md-12">
                                            <div class="p-4 edit-profile-border gradient">
                                                <div class="row">
                                                    <div class="col-md-12 edit-profile-row d-flex justify-content-right align-items-right h-100"></div>
                                                    <div class="hr-div">
                                                        <h3 class="pt-3 white"> Better Mementos with Keeper Plus </h3>
                                                        <p class="white"> When you upgrade to Keeper Plus, your friends and family will be able to view all uploaded Mementos and download their own copy of these pictures in a single file. </p>
                                                        <button class="m-2 prof-button ">
                                                            <a href="/payment" style="text-decoration: none;color: white"> Upgrade to Keeper Plus </a>
                                                        </button>
                                                        <br>
                                                    </div>
                                                    <div class="hr-div">
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php

                            }

                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php

        require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';

    ?>

    <?php

		$mementose_pictures = $connect->prepare("SELECT * FROM `mementose_pictures` WHERE `user_id` = ?");
		$mementose_pictures->bind_param("s", $check_username_fetch['ID']);
		$mementose_pictures->execute();
		$mementose_pictures_response = $mementose_pictures->get_result();
		if($mementose_pictures_response->num_rows > 0){

		    while($mementose_pictures_fetch = $mementose_pictures_response->fetch_assoc()){
		        
		        ?>
		        
	                <div class="modal fade" style='--bs-modal-width: 700px !important' id="mementose-picture-<?php print( $mementose_pictures_fetch['ID'] ) ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div style='display: flex; justify-content: right; align-items: center; height: 30px'>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
            		                <img src='/uploads/<?php print( $mementose_pictures_fetch['image_path'] ) ?>' class='my-2' data-id='<?php print( $mementose_pictures_fetch['ID'] ) ?>' height="400px" style="display: block; margin: 0 auto; border-radius: 5px; border-style: groove; border-width: 15px"/>
            		                <hr class='my-4'/>
            		                
            		                <?php
            		                
    		                    		$mementose_comments = $connect->prepare("SELECT * FROM `mementose_comments` WHERE `mementose_id` = ? ORDER BY `ID` DESC");
                                		$mementose_comments->bind_param("s", $mementose_pictures_fetch['ID']);
                                		$mementose_comments->execute();
                                		$mementose_comments_response = $mementose_comments->get_result();
                                		if($mementose_comments_response->num_rows > 0){
                                
                                		    while($mementose_comments_fetch = $mementose_comments_response->fetch_assoc()){
                                		        
            		                    		$mementose_comment_user = $connect->prepare("SELECT * FROM `users` WHERE `ID` = ?");
                                        		$mementose_comment_user->bind_param("s", $mementose_comments_fetch['user_id']);
                                        		$mementose_comment_user->execute();
                                        		$mementose_comment_user_response = $mementose_comment_user->get_result();
                                        		if($mementose_comment_user_response->num_rows > 0){
                                        		    
                                            		$mementose_comment_user_fetch = $mementose_comment_user_response->fetch_assoc();
                                            		
                                    		        ?>
                                    		        
                                		                <div class='row px-4 my-4'>
                                		                    <div class='col-1 d-flex align-items-top justify-content-center'>
                                		                        <img src='<?php empty($mementose_comment_user_fetch['image']) || !file_exists( $_SERVER['DOCUMENT_ROOT'] . "/assets/profile/" . $mementose_comment_user_fetch['image'] ) ? print("/assets/profile/user.png") : print( "/assets/profile/" . $mementose_comment_user_fetch['image'] ) ?>' style="height: 50px; border-radius: 100%"/>
                                		                    </div>
                                		                    <div class='col-10'>
                                		                        
                                		                        <p class="m-0 p-0" style="font-size: 18px"> <?php print( $mementose_comment_user_fetch['firstname'] . " " . $mementose_comment_user_fetch['lastname'] ) ?> </p>
                                		                        <p class="m-0 p-0"> <?php print( $mementose_comments_fetch['comment'] ) ?> </p>
                                		                        <p class="m-0 p-0"> Posted on: <?php print( date("d M Y h:m A", strtotime( $mementose_comments_fetch['date'] )) ) ?> </p>
                                		                        
                                		                    </div>
                                		                    <div class='col-1 d-flex align-items-top justify-content-center'>
                                		                        
                                		                        <?php
                                		                        
                                                                    if($user_login == true){
    
                                                                        if($_SESSION['user_id'] == $mementose_comment_user_fetch['ID']){
                                                                            
                                                                            ?>
    
                                                                                <form action="/php/delete-mementose-comment.php" method="POST">
    
                                                                                    <input type="hidden" name="mementose_comment_id" value='<?php print( $mementose_comments_fetch['ID'] ) ?>'/>
                                                                                    <button  type='submit' class="btn btn-danger">
                                                                                        <i class='ti-trash'></i>
                                                                                    </button>
    
                                                                                </form>
    
                                                                            <?php
                                                                            
                                                                        }

                                                                    }
                                		                        
                                		                        ?>
                                		                        
                                		                    </div>
                                		                </div>
                                    		        
                                    		        <?php
                                        		    
                                        		}
                                		        
                                		    }
                                		    
                                		} else {
                                        		    
                                		    ?>
                                		    
                                		        <h6 class="text-center my-5"> No comments found! </h6>
                                		    
                                		    <?php
                                		    
                                		}
                                		
    		                            if($user_login == true){
    		                                
    		                                ?>
    		                                
                        		                <hr class='my-4'/>
                        		                <div class='row px-4'>
                        		                    <div class='col-1 d-flex align-items-top justify-content-center'>
                        		                        <img src='<?php empty($user_fetch['image']) || !file_exists( $_SERVER['DOCUMENT_ROOT'] . "/assets/profile/" . $user_fetch['image'] ) ? print("/assets/profile/user.png") : print( "/assets/profile/" . $user_fetch['image'] ) ?>' style="height: 50px; border-radius: 100%"/>
                        		                    </div>
                        		                    <div class='col-11'>
                        		                        
                        		                        <form method='POST' action='/php/add-mementose-comment.php'>
                        		                            
                        		                            <input type='hidden' name='mementose_id' value='<?php print( $mementose_pictures_fetch['ID'] ) ?>'/>
                            		                        <div class="mb-3">
                                                                <textarea required name='comment' class="form-control" placeholder='Add Comment'></textarea>
                                                            </div>
                            		                        <div class="mb-3">
                                                                <button type="submit" class="btn btn-info"> Post comment </button>
                                                            </div>
                                                            
                        		                        </form>
                        		                        
                        		                    </div>
                        		                </div>
    		                                
    		                                <?php
    		                                
    		                            }
            		                
            		                ?>
            		                
                                </div>
                            </div>
                        </div>
                    </div>
		            
		        <?php
		        
		    }
		    
		}

        $type = 3;
        $mementose_videos = $connect->prepare("SELECT * FROM `mementose_videos` WHERE `user_id` = ? AND `type` = ?");
		$mementose_videos->bind_param("ss", $check_username_fetch['ID'], $type);
		$mementose_videos->execute();
		$mementose_videos_response = $mementose_videos->get_result();
		if($mementose_videos_response->num_rows > 0){

		    while($mementose_videos_fetch = $mementose_videos_response->fetch_assoc()){
		        
		        ?>
		        
	                <div class="modal fade" style='--bs-modal-width: 700px !important' id="mementose-videos-<?php print( $mementose_videos_fetch['ID'] ) ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">

                                    <div style='display: flex; justify-content: right; align-items: center; height: 30px'>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <video class="my-4" width="100%" height="330" controls>
                                        <source src="/uploads/<?php print( $mementose_videos_fetch['video_path'] ) ?>">
                                        Your browser does not support the video tag.
                                    </video>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
		            
		        <?php
		        
		    }
		    
		}
    
    ?>
    
    <script>

        <?php
        
            if($user_login == true){

                $type = 3;
                $selected_mementtose_pictures = "";
                $mementose_selection_pictures = $connect->prepare("SELECT * FROM `mementose_pictures` WHERE `user_id` = ? AND `type` = ?");
                $mementose_selection_pictures->bind_param("ss", $check_username_fetch['ID'], $type);
                $mementose_selection_pictures->execute();
                $mementose_selection_pictures_response = $mementose_selection_pictures->get_result();
                if($mementose_selection_pictures_response->num_rows > 0){
                    
                    $i = 1;
                    while($mementose_selection_pictures_fetch = $mementose_selection_pictures_response->fetch_assoc()){
    
                        if($i == $mementose_selection_pictures_response->num_rows){
                            
                            $selected_mementtose_pictures .= "". $mementose_selection_pictures_fetch['ID'] ."";
                            
                        } else {
                            
                            $selected_mementtose_pictures .= $mementose_selection_pictures_fetch['ID'] . ', ';
                            
                        }
                        
                        $i++;
                        
                    }
                    
                }

                ?>

                    let membership = <?php $user_fetch['membership'] == 1 ? print("true") : print("false") ?>;
                    let publicMementosePicturesSelections = [];
                    let publicMementoseSelectedPictures = [<?php print( $selected_mementtose_pictures ) ?>];
                    for(let i = 0; i < publicMementoseSelectedPictures.length; i++){

                        publicMementosePicturesSelections.push(publicMementoseSelectedPictures[i].toString());
                        
                    }

                    let publicMementosePictures = document.querySelectorAll('.public-mementose-pictures-selections .mementose-picture');
                    for(let i = 0; i < publicMementosePictures.length; i++){
                        
                        publicMementosePictures[i].onclick = function(){
                            
                            if(membership == true){
                                
                                let id = publicMementosePictures[i].getAttribute('data-id');
                                if(publicMementosePicturesSelections.includes(id)){
                                    
                                    let index = publicMementosePicturesSelections.indexOf(id);  
                                    if(index > -1){
                                        
                                        publicMementosePicturesSelections.splice(index, 1);
                                        
                                    }
                                    
                                    publicMementosePictures[i].parentNode.querySelector('.form-check-input').removeAttribute('checked');
                                    
                                } else {
                                    
                                    publicMementosePictures[i].parentNode.querySelector('.form-check-input').setAttribute('checked', true);
                                    publicMementosePicturesSelections.push(id);
                                    
                                }

                            } else {
                                
                                console.log(publicMementosePicturesSelections.length);
                                let id = publicMementosePictures[i].getAttribute('data-id');
                                if(publicMementosePicturesSelections.includes(id)){
                                    
                                    let index = publicMementosePicturesSelections.indexOf(id);  
                                    if(index > -1){
                                        
                                        publicMementosePicturesSelections.splice(index, 1);
                                        
                                    }
                                    
                                    publicMementosePictures[i].parentNode.querySelector('.form-check-input').removeAttribute('checked');
                                    
                                } else {
                                    
                                    if(publicMementosePicturesSelections.length < 5){

                                        publicMementosePictures[i].parentNode.querySelector('.form-check-input').setAttribute('checked', true);
                                        publicMementosePicturesSelections.push(id);

                                    } else {

                                        document.querySelector(".upgrade-to-keeper-plus").classList.remove("d-none");

                                    }
                                    
                                }

                            }
                            
                        }
                        
                    }

                    document.querySelector('.confirm-selection-public-mementose-pictures').onclick = function(){
                        
                        document.querySelector('.public-mementose-pictures').style.display = 'none';
                        document.querySelector('.public-mementose-pictures-selections').style.display = 'block';
                        
                        let xhttp = new XMLHttpRequest();
                        xhttp.onload = function(){
                            
                            if(this.readyState === 4 && this.status === 200) {

                                let response = JSON.parse(this.responseText);
                                if(response.request == true){
                                    
                                    window.location.reload();
                                    
                                }

                            }
                            
                        }
                        xhttp.open("POST", "/php/confirm-public-mementose.php");
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send("mementose=" + JSON.stringify( publicMementosePicturesSelections ));
                        
                    }

                    document.querySelector('.select-public-mementose-pictures').onclick = function(){
                        
                        document.querySelector('.public-mementose-pictures').style.display = 'none';
                        document.querySelector('.public-mementose-pictures-selections').style.display = 'block';
                        
                    }

                    document.querySelector('.cancel-selection-public-mementose-pictures').onclick = function(){
                        
                        document.querySelector('.public-mementose-pictures').style.display = 'block';
                        document.querySelector('.public-mementose-pictures-selections').style.display = 'none';
                        document.querySelector(".upgrade-to-keeper-plus").classList.add("d-none");
                        
                    }

                    document.querySelector('.download-all-mementose-pictures').onclick = function(){
                        
                        if(membership == true){
                            
                            document.querySelector('.download-all-mementose-pictures').innerHTML = "Downloading...";
                            let xhttp = new XMLHttpRequest();
                            xhttp.onload = function(){
                                
                                if(this.readyState === 4 && this.status === 200) {
    
                                    let response = JSON.parse(this.responseText);
                                    if(response.request == true){
                                        
                                        document.querySelector('.download-all-mementose-pictures').innerHTML = "Downloading...";
                                        window.open(response.download_link, "_self");
                                        
                                    }
    
                                }
                                
                            }
                            xhttp.open("POST", "/php/download-all-mementose-pictures.php");
                            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp.send("username=<?php print( $check_username_fetch['username'] ) ?>");

                        } else {
                            
                            document.querySelector(".all-mementose-upgrade-to-keeper-plus").classList.remove("d-none");

                        }
                        
                    }

                <?php

            }
            
        ?>

        document.querySelector('.download-public-mementose-pictures').onclick = function(){
            
            let membership = <?php $user_fetch['membership'] == 1 ? print("true") : print("false") ?>;
            if(membership == true){

                document.querySelector('.download-public-mementose-pictures').innerHTML = "Downloading...";
                let xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                    
                    if(this.readyState === 4 && this.status === 200) {
    
                        let response = JSON.parse(this.responseText);
                        if(response.request == true){
                            
                            document.querySelector('.download-public-mementose-pictures').innerHTML = "Download all photos";
                            window.open(response.download_link, "_self");
                            
                        }
                        
                    }
                    
                }
                xhttp.open("POST", "/php/download-public-mementose-pictures.php");
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("username=<?php print( $check_username_fetch['username'] ) ?>");

            } else {
                
                document.querySelector(".public-mementose-upgrade-to-keeper-plus").classList.remove("d-none");

            }
            
        }
        
    </script>

</body>
</html>