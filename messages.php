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
            $user_id = $user_fetch['ID'];

            $select_messages_threads = $connect->prepare("SELECT * FROM `messages_threads` WHERE `sender_id` = ? OR `receiver_id` = ?");
            $select_messages_threads->bind_param("ss", $_SESSION['user_id'], $_SESSION['user_id']);
            $select_messages_threads->execute();
            $select_messages_threads_response = $select_messages_threads->get_result();

		} else {

			unset($_SESSION['user_id']);
            header("Location: /login");

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
    <title> Messages - Tribute Keeper </title>
	<link rel="stylesheet" href="/assets/css/style.css"/>
    <link rel="stylesheet" href="/assets/js/script.js">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/assets/css/themify-icons.css"/>
    <link rel="preconect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <style>

        .profile-image {
            width: 70px;
            height: 70px;
            border: 3px solid #eee;
            box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);
            border-radius: 50%;
            background-color: white;
        }

        .name-td a {
            font-weight: bold;
            color: #003B59;
            text-decoration: none;
            padding-left: 20px;
        }

    </style>

</head>
<body>
    
    <section class="h-100 gradient-custom-2">

        <?php

            require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/subheader.php';

        ?>

        <div class="container py-5 h-100 ">
            <div class="card">
                <div class=" row pt-4 text-black" style="margin:0px 150px 0px 150px">
                    <div class=" col-md-12 ">
                        <div class="p-4 edit-profile-border">
                            <div class="row ">
                                <div class="col-md-12 hr-div">
                                    <h3 class="pt-3"> Messages </h1>

                                    <?php

                                        if(isset($_SESSION['error']) && !empty($_SESSION['error'])){

                                            ?>

                                                <div class="alert alert-danger" role="alert">
                                                    <?php print( $_SESSION['error'] ) ?>
                                                </div>

                                            <?php

                                            unset($_SESSION['error']);

                                        }

                                    ?>

                                </div>
                                <div class="hr-div">
                                    <hr>
                                </div>
                                <div class='px-4'>

                                    <div class="row">
                                        <div>
                                        
                                            <?php 

                                                if($select_messages_threads_response->num_rows > 0){

                                                    while($select_messages_threads_fetch = $select_messages_threads_response->fetch_assoc()){
    
                                                        $select_sender = $connect->prepare("SELECT * FROM `users` WHERE `ID` = ?");
                                                        $select_sender->bind_param("s", $select_messages_threads_fetch['sender_id']);
                                                        $select_sender->execute();
                                                        $select_sender_response = $select_sender->get_result();
    
                                                        $select_receiver = $connect->prepare("SELECT * FROM `users` WHERE `ID` = ?");
                                                        $select_receiver->bind_param("s", $select_messages_threads_fetch['receiver_id']);
                                                        $select_receiver->execute();
                                                        $select_receiver_response = $select_receiver->get_result();
    
                                                        if($select_sender_response->num_rows > 0 && $select_receiver_response->num_rows > 0){
    
                                                            $select_sender_fetch = $select_sender_response->fetch_assoc();
                                                            $select_receiver_fetch = $select_receiver_response->fetch_assoc();
    
                                                            ?>
    
                                                                <a href="/message/<?php print( $select_receiver_fetch['username'] ) ?>" style='color: inherit; text-decoration: inherit'>
    
                                                                    <div class="my-1" style="display: flex; flex-direction: row; border: 1px solid rgb(201, 201, 201); padding: 15px; border-radius: 7px;">
                                                                        <div class="img-head">
                                                                            <img src="<?php empty($select_receiver_fetch['image']) || !file_exists( $_SERVER['DOCUMENT_ROOT'] . "/assets/profile/" . $select_receiver_fetch['image'] ) ? print("/assets/profile/user.png") : print( "/assets/profile/" . $select_receiver_fetch['image'] ) ?>" class="profile-image">
                                                                        </div>
                                                                        <div class="name-td pt-2">
                                                                            <p class="px-4 mt-2"> <?php print( $select_receiver_fetch['firstname'] . " " . $select_receiver_fetch['lastname'] ) ?> </p>
                                                                        </div>
                                                                    </div>
    
                                                                <a>
    
                                                            <?php
    
                                                        }
    
                                                    }

                                                } else {

                                                    ?>

                                                        <h5 class='my-5 text-center'> No messages found! </h5>

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
            </div>
        </div>
    </section>

    <?php

        require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';

    ?>

</body>
</html>