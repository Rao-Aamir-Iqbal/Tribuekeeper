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

            $user_login = true;
            $user_fetch = $check_response->fetch_assoc();
            $user_id = $_SESSION['user_id'];

            if(isset($_GET['username']) && !empty($_GET['username'])){
                
                $check_username = $connect->prepare("SELECT * FROM `users` WHERE `username` = ?");
                $check_username->bind_param("s", $_GET['username']);
                $check_username->execute();
                $check_username_response = $check_username->get_result();
                if($check_username_response->num_rows > 0){
        
                    $check_username_fetch = $check_username_response->fetch_assoc();
        
                } else {
        
                    http_response_code(404);
                    exit();
        
                }
                
            } else {
                
                http_response_code(404);
                exit();
                
            }

        } else {

            unset($_SESSION['user_id']);

        }

    } else {

        header("Location: /login");

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Edit Mementos - Tribute Keeper </title>
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
                                    
                                <h3 class="pt-3"> Add Mementos Pictures </h3>
                                <hr>
                                <div class="py-5 my-5">
                                    
                                    <h5 class='text-center'> Add Mementos Pictures </h5>
                                    <p class='text-center'> Only JPG, PNG, JPEG, GIF images are allowed and others will be skipped </p>
                                    <form class='mementose-images-form' method='POST' action='/php/add-mementose-images.php' enctype="multipart/form-data">
                                        
                                        <h5 class="text-center py-5 d-none"> Uploading... </h5>
                                        <input type='file' class="form-control w-25 d-block m-auto mementose-images" name='mementose_images[]' multiple/>
                                        
                                    </form>
                                    
                                </div>

                            </div>
                        </div>

                        <div class="pt-4 text-black">
                            <div class="p-4 edit-profile-border">
                                    
                                <h3 class="pt-3"> Add Mementos Videos </h3>
                                <hr>
                                <div class="py-5 my-5">
                                
                                    <?php

                                        $is_mementose_videos_limit = false;
                                        if($user_fetch['membership'] == 2){

                                            $check_mementose_video_limit = $connect->prepare("SELECT * FROM `mementose_videos` WHERE `user_id` = ?");
                                            $check_mementose_video_limit->bind_param("s", $_SESSION['user_id']);
                                            $check_mementose_video_limit->execute();
                                            $check_mementose_video_limit_response = $check_mementose_video_limit->get_result();
                                            if($check_mementose_video_limit_response->num_rows >= 1){
    
                                                $is_mementose_videos_limit = true;
    
                                            }

                                        }

                                        if($is_mementose_videos_limit == true){

                                            ?>

                                                <h5 class='text-center my-5 py-5 mb-4 pb-0'> You've reached the limit for uploading videos with Keeper. Please upgrade to Keeper Plus for uploading more videos </h5>
                                                <button class="prof-button m-auto mb-5 mt-2 d-block">
                                                    <a href="/payment" style="text-decoration: none; color: white"> Upgrade to Keeper Plus </a>
                                                </button> 

                                            <?php

                                        } else {

                                            ?>

                                                <h5 class='text-center'> Add Mementos Videos </h5>
                                                <p class='text-center'> Only MP4, MOV, WMV, AVI, MKV, WEBM videos are allowed and others will be skipped </p>
                                                <form class='mementose-videos-form' method='POST' action='/php/add-mementose-videos.php' enctype="multipart/form-data">
                                                    
                                                    <h5 class="text-center py-5 d-none"> Uploading... </h5>
                                                    <input type='file' class="form-control w-25 d-block m-auto mementose-videos" name='mementose_videos[]' multiple/>
                                                    
                                                </form>

                                            <?php

                                        }

                                    ?>
                                    
                                </div>

                            </div>
                        </div>
                        
                        <div class="pt-4 text-black">
                            <div class="p-4 edit-profile-border">
                                    
                                <h3 class="pt-3"> All Mementos Pictures </h3>
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
                        
                                    <a href='/mementose/<?php print( $_GET['username'] ) ?>' style="text-align: center; color: white; text-decoration: none" class="prof-button  mx-1"> View Mementos </a>
                                    <button class="prof-button  mx-1 download-all-mementose-pictures"> Download all photos </button>
                                    
                                </div>

                            </div>
                        </div>
                        
                        <div class="pt-4 text-black">
                            <div class="p-4 edit-profile-border">
                                
                                <h3 class="pt-3"> All Mementos Videos </h3>
                                <div class="alert alert-danger all-mementose-upgrade-to-keeper-plus d-none" role="alert">
                                    Please upgrade to Keeper Plus for downloading photos in a single file!
                                </div>
                                <hr>
                                
                                <div class='row px-2'>
                                    
                                    <?php

                                		$mementose_videos = $connect->prepare("SELECT * FROM `mementose_videos` WHERE `user_id` = ?");
                                		$mementose_videos->bind_param("s", $check_username_fetch['ID']);
                                		$mementose_videos->execute();
                                		$mementose_videos_response = $mementose_videos->get_result();
                                		if($mementose_videos_response->num_rows > 0){
                                		    
                                		    while($mementose_videos_fetch = $mementose_videos_response->fetch_assoc()){
                                		        
                                		        ?>
                                		        
                                                    <div class='col-6 col-xl-2 col-lg-3 col-md-4 my-1 px-1'>
                                                        <div data-bs-toggle="modal" data-bs-target="#mementose-videos-<?php print( $mementose_videos_fetch['ID'] ) ?>" data-id='<?php print( $mementose_videos_fetch['ID'] ) ?>' style="width: 100%; height: 125px; border-radius: 5px; cursor: pointer; overflow: hidden; display: flex; align-items: center; justify-content: center">
                                                    
                                                            <video width="100%" height="125">
                                                                <source src="/uploads/<?php print( $mementose_videos_fetch['video_path'] ) ?>">
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
                                    <form action="/php/update-mementose-pciture.php" method="POST">

                                        <input type="hidden" name="mementose_picture_id" value='<?php print( $mementose_pictures_fetch['ID'] ) ?>'/>
                                        <select required class="form-select w-50 d-block m-auto my-3" name="type">
                                            <option value="3" <?php $mementose_pictures_fetch['type'] == '3' ? print( "selected" ) : null ?>> Public </option>
                                            <option value="2" <?php $mementose_pictures_fetch['type'] == '2' ? print( "selected" ) : null ?>> Myself </option>
                                        </select>
                                        <button class="btn btn-info d-block m-auto w-50 my-1"> Save changes </button>
                                        
                                    </form>
                                    <form action="/php/delete-mementose-pciture.php" method="POST">

                                        <input type="hidden" name="mementose_picture_id" value='<?php print( $mementose_pictures_fetch['ID'] ) ?>'/>
                                        <button type='submit' class="btn btn-danger d-block m-auto w-50 my-1"> Delete Picture </button>
                                        
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
		            
		        <?php
		        
		    }
		    
		}

		$mementose_videos = $connect->prepare("SELECT * FROM `mementose_videos` WHERE `user_id` = ?");
		$mementose_videos->bind_param("s", $check_username_fetch['ID']);
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
                                    <hr class='my-4'/>
                                    <form action="/php/update-mementose-video.php" method="POST">

                                        <input type="hidden" name="mementose_video_id" value='<?php print( $mementose_videos_fetch['ID'] ) ?>'/>
                                        <select required class="form-select w-50 d-block m-auto my-3" name="type">
                                            <option value="3" <?php $mementose_videos_fetch['type'] == '3' ? print( "selected" ) : null ?>> Public </option>
                                            <option value="2" <?php $mementose_videos_fetch['type'] == '2' ? print( "selected" ) : null ?>> Myself </option>
                                        </select>
                                        <button class="btn btn-info d-block m-auto w-50 my-1"> Save changes </button>
                                        
                                    </form>
                                    <form action="/php/delete-mementose-video.php" method="POST">

                                        <input type="hidden" name="mementose_video_id" value='<?php print( $mementose_videos_fetch['ID'] ) ?>'/>
                                        <button type='submit' class="btn btn-danger d-block m-auto w-50 my-1"> Delete Video </button>
                                        
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
		            
		        <?php
		        
		    }
		    
		}
    
    ?>
    
    <script>
        
        document.querySelector('.mementose-images').onchange = function(){
            
            document.querySelector('.mementose-images-form h5').classList.remove('d-none');
            document.querySelector('.mementose-images-form input').classList.add('d-none');
            document.querySelector('.mementose-images-form').submit();
            
        }
        
        document.querySelector('.mementose-videos').onchange = function(){
            
            document.querySelector('.mementose-videos-form h5').classList.remove('d-none');
            document.querySelector('.mementose-videos-form input').classList.add('d-none');
            document.querySelector('.mementose-videos-form').submit();
            
        }

        document.querySelector('.download-all-mementose-pictures').onclick = function(){
            
            let membership = <?php $user_fetch['membership'] == 1 ? print("true") : print("false") ?>;
            if(membership == true){

                document.querySelector('.download-all-mementose-pictures').innerHTML = "Downloading...";
                let xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                    
                    if(this.readyState === 4 && this.status === 200) {
    
                        let response = JSON.parse(this.responseText);
                        if(response.request == true){
                            
                            document.querySelector('.download-all-mementose-pictures').innerHTML = "Download all photos";
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
        
    </script>
    
</body>
</html>