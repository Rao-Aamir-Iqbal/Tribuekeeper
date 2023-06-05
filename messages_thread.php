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
        
                    $select_message_thread = $connect->prepare("SELECT * FROM `messages_threads` WHERE `sender_id` = ? OR `receiver_id` = ?");
                    $select_message_thread->bind_param("ss", $check_username_fetch['ID'], $check_username_fetch['ID']);
                    $select_message_thread->execute();
                    $select_message_thread_response = $select_message_thread->get_result();

                    if($select_message_thread_response->num_rows > 0){

                        $select_message_thread_fetch = $select_message_thread_response->fetch_assoc();
                        
                        $select_thread_messages = $connect->prepare("SELECT * FROM `messages` WHERE `thread_id` = ? ORDER BY `ID` ASC");
                        $select_thread_messages->bind_param("s", $select_message_thread_fetch['ID']);
                        $select_thread_messages->execute();
                        $select_thread_messages_response = $select_thread_messages->get_result();

                    } else {

                        header("Location: /php/add-message-thread.php?username=" . $check_username_fetch['username']);
                        
                    }

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
    <title> - Tribute Keeper </title>
	<link rel="stylesheet" href="/assets/css/style.css"/>
    <link rel="stylesheet" href="/assets/js/script.js">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
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

        <div class="container py-5 h-100">
            <div class="card">
                <div class="row pt-4 text-black" style="margin: 0px 150px 0px 150px">
                    <div class="col-md-12">
                        <div class="p-4 edit-profile-border">
                            <div class="row">
                                <div class="col-md-12 hr-div">
                                    <h3 class="pt-3"> Messages </h1>
                                </div>
                                <div class="hr-div">
                                    <hr>
                                </div>
                                <div>

                                    <div class="row">

                                        <?php 
                                        
                                            if($select_thread_messages_response->num_rows > 0){

                                                while($select_thread_messages_fetch = $select_thread_messages_response->fetch_assoc()){
    
                                                    $select_thread_messages_receiver = $connect->prepare("SELECT * FROM `users` WHERE `ID` = ?");
                                                    $select_thread_messages_receiver->bind_param("s", $select_thread_messages_fetch['sender_id']);
                                                    $select_thread_messages_receiver->execute();
                                                    $select_thread_messages_receiver_response = $select_thread_messages_receiver->get_result();
                                                    $select_thread_messages_receiver_fetch = $select_thread_messages_receiver_response->fetch_assoc();
    
                                                    ?>
    
                                                        <div>
                                                            <div class='row'>
                                                                <div class="img-head col-1">
                                                                    <img src="/assets/profile/<?php print( $select_thread_messages_receiver_fetch['image'] ) ?>" class="profile-image">
                                                                </div>
                                                                <div class="name-td pt-2 col-11">
                                                                    <div class='row align-items-center'>
                                                                        <p class='col-6'> <?php print_r( $select_thread_messages_receiver_fetch['firstname'] . " " . $select_thread_messages_receiver_fetch['lastname'] ) ?> </p>
                                                                        <p class='col-6' style='display: flex; justify-content: right; align-items: center'>
                                                                            <?php print( date("d M Y", strtotime( $select_thread_messages_fetch['date'] )) . " at " . date("h:m A", strtotime( $select_thread_messages_fetch['date'] )) ) ?>
                                                                            <span class="ti-close delete-message" data-id='<?php print( $select_thread_messages_fetch['ID'] ) ?>' style="padding: 10px; color: rgb(165, 165, 165)"></span>
                                                                        </p>
                                                                    </div>
                                                                    <p> <?php print( $select_thread_messages_fetch['message'] ) ?> </p>
                                                                </div>
                                                            </div>
                                                        </div>
    
                                                    <?php
    
                                                }

                                            } else {

                                                ?>

                                                    <h5 class='my-5 text-center'> No messages found! </h5>

                                                <?php
                                                
                                            }

                                        ?>

                                        <div class="">
                                            <hr>
                                        </div>
                                        <div style="margin-left: 90px">
                                        
                                            <form action="/php/submit-message.php" method="POST">

                                                <input type="hidden" name="receiver_id" value='<?php print( $check_username_fetch['ID'] ) ?>'/>
                                                <input type="hidden" name="thread_id" value='<?php print( $select_message_thread_fetch['ID'] ) ?>'/>
                                                <textarea class="form-control" rows="5" placeholder="Message" id="comment" name='message' style="width: 87%"></textarea>
                                                <button class="my-3 prof-button d-flex align-items-center" style="text-decoration: none; color: white"> <i class='ti-arrow-top-right mx-2'></i> Send Message </button>

                                            </form>

                                        </div>
                                        <div>
                                            <hr>
                                        </div>
                                        <div>

                                            <button class="my-2 prof-button ti-email"> 
                                                <a href="/message" style="text-decoration: none; color: white"> Inbox </a>
                                            </button>
                                            
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

    <script>

        let deleteToggle = document.querySelectorAll('.delete-message');
        for(let i = 0; i < deleteToggle.length; i++){

            deleteToggle[i].onclick = function(){

                let xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                    
                    if(this.readyState === 4 && this.status === 200) {

                        let response = JSON.parse(this.responseText);
                        if(response.request == true){
                            
                            deleteToggle[i].parentNode.parentNode.parentNode.parentNode.parentNode.remove();
                            
                        }

                    }
                    
                }
                xhttp.open("POST", "/php/delete-message.php");
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("id=" + deleteToggle[i].getAttribute("data-id"));

            }

        }
        
    </script>

</body>
</html>