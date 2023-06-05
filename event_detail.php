<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
session_start();

if (!$_SESSION['user_id']) {
    header("location: /login");
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `users` WHERE id = $user_id";
$exe = mysqli_query($con, $sql);

if (!$exe) {
    // handle query error
    echo "Error executing query: " . mysqli_error($con);
    // you might want to log the error instead of displaying it to the user
} else {
    if (mysqli_num_rows($exe) > 0) {
        $fetch = mysqli_fetch_assoc($exe);
        $suffix = $fetch['suffix'];
        $firstname = $fetch['firstname'];
        $username = $fetch['username'];
        $middlename = $fetch['middlename'];
        $lastname = $fetch['lastname'];
        $gender = $fetch['gender'];
        $date_of_birth = $fetch['date_of_birth'];
    } else {
        // handle no data found error
        echo "No data found for user ID: " . $user_id;
    }
}

$title_name = $_GET['title'];
$sql1 = "SELECT * FROM `events` WHERE title = '$title_name'";
$exe1 = mysqli_query($con, $sql1);
$fetched = mysqli_fetch_assoc($exe1);
$title = $fetched['title'];
$description = $fetched['description'];
$date = date("F jS, Y", strtotime($fetched['date']));
$time = date("g:ia", strtotime($fetched['time']));
$location = $fetched['location'];
$event_link = $fetched['event_link'];
$image = $fetched['image'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $firstname . " " . $lastname ?>'s Events | Keeper
    </title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/js/script.js">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        .memo-services-background {
            background-image: url("/php/events_picture/<?php echo $image ?>");
            background-size: cover;
            background-position: center;
            /* height: 250px; */
            border-radius: 10px 10px 0px 0px;
        }

        .reply-form {
            display: none;
        }

        .about-colom {
            background-color: #f8f9fa;
            border-radius: 15px;
            margin-right: -20px !important;

        }

        @media(max-width:476px) {
            .input-field {
                width: 50%;
            }

            .flex-col {
                display: flex;
                flex-direction: column;
                font-size: small;
            }
        }
    </style>
</head>

<body>

    <?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/subheader.php';

    ?>





    <section class="gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="">

                    <div class="card">
                        <div class=" row pt-4 text-black mt-4">

                            <div class="mb-3 col-md-12 main-about-colom-1">
                                <div class=" mb-3 about-sect ">

                                    <div class="memo-services-background">

                                    </div>

                                    <div class="row">
                                        <div class="colo-md-12 ">
                                            <div class="p-4 ">
                                                <div class="row hr-div">

                                                    <div class="text-center">
                                                        <h1 class="py-2"><?php echo $title ?></h1>
                                                        <h3 class="py-2"><?php echo $date ?></h3>
                                                    </div>
                                                    <hr>
                                                    <div class="">
                                                        <p class="py-2"><?php echo $description ?></p>
                                                    </div>

                                                    <div class="col-md-12  d-flex justify-content-right align-items-right h-100">
                                                        <h3 class=""> About</h3>
                                                    </div>
                                                    <div class="">
                                                        <hr>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="col-md-2 p-2 disp-block tofi">
                                                            <div class="about-sec-larg-icon">
                                                                <div class="ti-user blue">
                                                                    <!-- <img src="/location-icon-78-78.jpg" alt=""> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10 wid">
                                                            <div class="pt-tp">
                                                                <div class="about-borser-bottom">
                                                                    <div class="d-flex py-2">
                                                                        <table>
                                                                            <tr class="about-borser">
                                                                                <td class="about-borser-td-1">Date</td>
                                                                                <td class="about-borser-td-2">
                                                                                    <?php echo $date ?>
                                                                                    <!-- <a class="txt-non" href="/edit_profile/<!?php echo $username?>#basic-information"><i
                                                                                            class="ti-pencil blue"></i></a> -->
                                                                                </td>
                                                                            </tr>
                                                                        </table>


                                                                    </div>
                                                                </div>
                                                                <div class="about-borser-bottom">
                                                                    <div class="d-flex py-2">
                                                                        <table>
                                                                            <tr class="about-borser">
                                                                                <td class="about-borser-td-1">Time</td>
                                                                                <td class="about-borser-td-2"><?php echo $time ?> (GMT-7:00) Pacific Time (US and Canada)
                                                                                </td>
                                                                            </tr>
                                                                        </table>

                                                                    </div>
                                                                </div>
                                                                <div class='about-borser-bottom'>
                                                                    <div class='d-flex py-2'>
                                                                        <table>
                                                                            <tr class='about-borser'>
                                                                                <td class='about-borser-td-1'>Location</td>
                                                                                <td class='about-borser-td-2'> <a href="<?php echo $location ?>"><?php echo $location ?></a></td>
                                                                            </tr>
                                                                        </table>

                                                                    </div>
                                                                </div>
                                                                <div class='about-borser-bottom'>
                                                                    <div class='d-flex py-2'>
                                                                        <table>
                                                                            <tr class='about-borser'>
                                                                                <td class='about-borser-td-1'>Event Link</td>
                                                                                <td class='about-borser-td-2'><a href='<?php echo $event_link ?>'><?php echo $title ?></a>
                                                                                </td>

                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- <div class="row ">
                                        <div class="colo-md-12 ">
                                            <div class="p-4 ">
                                                <div class="row hr-div">
                                                    <div class="d-flex">
                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3381.4098961721556!2d72.70581527459777!3d32.05816052037717!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x392177fe8abb9b7b%3A0x70eb72e1b437eb99!2z2YLbjNmG2obbjCDZhdmI2pE!5e0!3m2!1sen!2s!4v1682001991859!5m2!1sen!2s" width="800" height="350" class="pro-map" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="row ">
                                        <div class="colo-md-12 " style="position: releative ;">
                                            <div class="p-4 ">
                                                <div class="row hr-div">
                                                    <div class="col-md-12  d-flex justify-content-right align-items-right h-100">
                                                        <h3 class="">RSVP</h3>
                                                    </div>
                                                    <div class="">
                                                        <hr>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="col-md-2 p-2 disp-block tofi">
                                                            <div class="about-sec-larg-icon">
                                                                <div class="ti-flag-alt blue"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <div id="invite_box">
                                                                <form method="POST" id="invitation_email">
                                                                    <h5 class="my-4">Send Event Invitation by Email</h5>
                                                                    <div class="mb-3">
                                                                        <input type="text" class="form-control" name="user_name" id="exampleFormControlInput1" placeholder="Name">
                                                                        <div id="user_name_error" style="color:red;"></div>
                                                                    </div>
                                                                    <div class="row" id="targetElement" >
                                                                        <div class="col-md-4" id="sourceElement">
                                                                            <div class="mb-3">
                                                                                <input type="email" class="form-control" name="email[]" id="exampleFormControlInput1" placeholder="Enter Email">
                                                                                <div id="email_error" style="color:red;"></div>

                                                                            </div>
                                                                        </div>
                                                                        
                                                                
                                                                
                                                                        
                                                                        
                                                                        
                                                                            


                                                                    </div>
                                                                    
                                                                    <div>
                                                                        <span id="addInputButton" style="padding: 6px 12px; border-radius:50%;line-height:35px; text-align: center; background-color: #59596d; color: white;">+</span>
                                                                    </div>
                                                                    
                                                         
                                                                    <div class="pb-3">
                                                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="message_box" rows="7" placeholder="Include a personal message to guests here. This email invitation will contain important information about the event, as well as a link for guests to RSVP."></textarea>
                                                                        <input type="hidden" name="title_name" value="<?php echo $title_name ?>">
                                                                        <div id="message_box_error" style="color:red;"></div>

                                                                    </div>
                                                                    <div class=" my-3">
                                                                        <button class="prof-button" type="submit" name="submit" style="text-decoration: none; color: white;"> Send Invitation</button>
                                                                    </div>
                                                                    <div id="success_message"></div>
                                                                </form>
                                                                
                                                            
                                                                <div class=" py-3">
                                                                    <button id="show_invite_box_btn" class="prof-button" style="text-decoration: none; "> <span class="ti-plus"></span> Can you Attend</button>
                                                                </div>
                                                            </div>

                                                            <div id="party_box" style="display:none;">
                                                                <form method="POST" id="party_form">
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="mb-3">
                                                                                    <input type="text" class="form-control input-field" name="first[]" id="exampleFormControlInput1" placeholder="First Name">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="mb-3">
                                                                                    <input type="text" class="form-control input-field" name="last[]" id="exampleFormControlInput1" placeholder="Last Name">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="mb-3">
                                                                                    <input type="email" class="form-control input-field" name="email[]" id="exampleFormControlInput1" placeholder="Email">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3 d-flex flex-col" style="justify-content: space-between;">
                                                                        <div>
                                                                            <p><b>Response:</b></p>
                                                                        </div>
                                                                        <div class="d-flex ">
                                                                            <input type="hidden" name="rsvp_response" id="response" value="">
                                                                            <button data-btn-value="1" id="btnEventRSVPFormResponseFirst" class="m-2 prof-butn response-btn" onclick="this.classList.add('clicked')">Yes</button>
                                                                            <button data-btn-value="0" id="btnEventRSVPFormResponseSecond" class="m-2 prof-butn response-btn" onclick="this.classList.add('clicked')">No</button>
                                                                            <button data-btn-value="2" id="btnEventRSVPFormResponseThird" class="m-2 prof-butn response-btn" onclick="this.classList.add('clicked')">Maybe</button>
                                                                        </div>
                                                                    </div>

                                                                   <div id="target_Element">
                                                                        <div class="col-md-12"  >
                                                                        <div >
                                                                            <div>
                                                                                <p>
                                                                                    <b>Guest 1:</b>
                                                                                </p>
                                                                            </div>
                                                                            <div >
                                                                                <input type="text" class="form-control input-field mb-2" name="first[]" id="exampleFormControlInput1" placeholder="First Name">
                                                                                <input type="text" class="form-control input-field mb-2" name="last[]" id="exampleFormControlInput1" placeholder="Last Name">
                                                                                <input type="email" class="form-control input-field mb-2" name="email[]" id="exampleFormControlInput1" placeholder="Email">

                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12" >
                                                                        <div class="">
                                                                            <div >
                                                                                <p>
                                                                                    <b>Guest 2:</b>
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <input type="text" class="form-control input-field mb-2" name="first[]" id="exampleFormControlInput1" placeholder="First Name">
                                                                                <input type="text" class="form-control input-field mb-2" name="last[]" id="exampleFormControlInput1" placeholder="Last Name">
                                                                                <input type="email" class="form-control input-field mb-2" name="email[]" id="exampleFormControlInput1" placeholder="Email">
                                                                                <button type="submit" name="rsvp" class="my-2 prof-button">RSVP</button><br>

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                   </div>
                                                                    
                                                                      
                                                                </form>
                                                                <div class=" py-3">
                                                                    <button id="show_party_box_btn" class="prof-button" style="text-decoration: none; "> <span class="ti-plus"></span> Invite Others</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class=" row pt-4 text-black ">
                            <div class="mb-3 col-md-12 main-about-colom-1">
                                <div class=" mb-3 about-sect ">
                                    <div class="row">
                                        <div class="colo-md-12 ">
                                            <div class="p-4 ">
                                                <div class="row hr-div" >
                                                    <!-- <button class="my-2 prof-button"><a href="#" style="text-decoration: none;color: white;">Ask a Question or Comment about the Event </a></button><br>
                                                    <button class="my-2 prof-button"><a href="#" style="text-decoration: none;color: white;">Share a Memory or Send a Tribute</a></button><br> -->
                                                    <h3>Comment for <?php echo $title_name ?> event</h3>
                                                    <!-- Comment Display Area -->
                                                    <div id="commentArea">
                                                        <!-- Existing comments will be displayed here -->
                                                    </div>

                                                    <?php
                                                    // if (isset($_SESSION['user_id'])) {
                                                        // User is logged in, show the comment form
                                                    ?>
                                                        <!-- Comment Form -->
                                                        <form id="commentForm">
                                                            <div class="mb-3">
                                                                <label for="comment" class="form-label">Comment:</label>
                                                                <input type="hidden" id="title" value="<?php echo $title_name; ?>">
                                                                <textarea class="form-control" id="comment" rows="3" style="width:50%; placeholder="Add Comment" required></textarea>
                                                            </div>
                                                            <button class="prof-button" type="submit" name="submit" style="text-decoration: none; color: white;">Post Comment</button>
                                                        </form>
                                                    <?php
                                                    // } else {
                                                    //     // User is not logged in, do not show the comment form
                                                    //     // You can optionally display a message or a login prompt here
                                                    // }
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
            </div>
        </div>
    </section>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   

  
function myFunction() {


var sourceElement = document.getElementById('sourceElement');
  var htmlContent = sourceElement.innerHTML;
  
  
  var targetElement = document.createElement('div');
  targetElement.className = 'col-md-4';
  targetElement.innerHTML = htmlContent;
  
  
  var targetContainer = document.getElementById('targetElement');
  targetContainer.appendChild(targetElement);
  
};


var button = document.getElementById('addInputButton');
button.addEventListener('click', myFunction);



function create() {

alert('hello');

var sourceElement2 = document.getElementById('innertext');
  targetElement.className = 'text';
  var htmlContent2 = sourceElement2.innerHTML;
  
  console.log(htmlContent);
  var targetElement2 = document.createElement('div');
  targetElement2.innerHTML = htmlContent2;
  
  
  var targetContainer2 = document.getElementById('target_Element');
  document.getElementById('target_Element').appendChild("<div class='col-md-12' ><div class=''><div ><p><b>Guest 2:</b></p></div><div> <input type='text' class='form-control input-field mb-2' name='first[]' id='exampleFormControlInput1' placeholder='First Name'><input type='text' class='form-control input-field mb-2' name='last[]' id='exampleFormControlInput1' placeholder='Last Name'><input type='email' class='form-control input-field mb-2' name='email[]' id='exampleFormControlInput1' placeholder='Email'><button type='submit' name='rsvp' class='my-2 prof-button'>RSVP</button><br></div></div></div>");
 
};


var button = document.getElementById('addInputButton2');
button.addEventListener('click', create);

</script>
           
    <script>
        $(document).ready(function() {
            // Load existing comments on page load
            loadComments();

            // Submit comment form
            $("#commentForm").submit(function(e) {
                e.preventDefault();

                // Get form values
                // var name = $("#name").val();
                var title = $("#title").val();
                var comment = $("#comment").val();

                // Ajax post request to submit comment
                $.ajax({
                    url: "/php/events_comment.php",
                    type: "POST",
                    data: {
                        title: title,
                        comment: comment
                    },
                    success: function(response) {
                        // Clear form values
                        // $("#name").val("");
                        $("#comment").val("");

                        // Check the response
                        if (response === "success") {
                            // Reload comments
                            loadComments();
                        } else {
                            // Handle error or display a message to the user
                            console.error("Comment submission failed.");
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error or display a message to the user
                        console.error("AJAX request failed. Error: " + error);
                    }
                });
            });

            // Reply button click event
            $(document).on('click', '.reply-btn', function() {
                var commentId = $(this).data('comment-id');
                $('#replyForm_' + commentId).toggle(1000);
            });
        });

        // Function to load comments
        function loadComments() {
            var title = $("#title").val(); // Retrieve the value of the hidden input field
            $.ajax({
                url: "/php/get_comments.php",
                type: "GET",
                data: {
                    title: title
                }, // Pass the title value as a parameter in the AJAX request
                success: function(response) {
                    $("#commentArea").html(response);
                },
                error: function(xhr, status, error) {
                    // Handle error or display a message to the user
                    console.error("AJAX request failed. Error: " + error);
                }
            });
        }

        // Function to reply to a comment
        function replyComment(commentId) {
            // Get the reply content
            var title = $("#title").val(); // Retrieve the value of the hidden input field
            var replyContent = $("#replyInput_" + commentId).val();

            // Ajax post request to submit the reply
            $.ajax({
                url: "/php/events_reply_comment.php",
                type: "POST",
                data: {
                    title: title,
                    commentId: commentId,
                    replyContent: replyContent
                },
                success: function(response) {
                    // Clear the reply input field
                    $("#replyInput_" + commentId).val("");

                    // Check the response
                    if (response === "success") {
                        // Reload comments
                        loadComments();
                    } else {
                        // Handle error or display a message to the user
                        console.error("Reply submission failed.");
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error or display a message to the user
                    console.error("AJAX request failed. Error: " + error);
                }
            });
        }



        $(document).ready(function() {


            $("#show_party_box_btn").click(function() {
                $("#party_box").hide();
                $("#invite_box").show();
            });

            $("#show_invite_box_btn").click(function() {
                $("#invite_box").hide();
                $("#party_box").show();
            });



            // Validation Start Here
            $('form#invitation_email').submit(function(e) {
                e.preventDefault(); // prevent default submit behavior

                // Get the form data
                var formData = new FormData(this);

                // Get the name, email, and message_box fields
                var name = formData.get('user_name');
                var emails = formData.getAll('email[]');
                var message = formData.get('message_box');

                // Validate the name field
                var nameField = document.getElementById('exampleFormControlInput1');
                var nameError = document.getElementById('user_name_error');
                if (name.trim() === '') {
                    nameField.classList.add('is-invalid');
                    nameError.innerText = '*Please enter your name.';
                } else {
                    nameField.classList.remove('is-invalid');
                    nameError.innerText = '';
                }

                // Validate the first email field only
                var emailFieldSet1 = document.getElementsByName('email[]')[1];
                var emailFieldSet2 = document.getElementsByName('email[]')[2];
                var emailFieldSet3 = document.getElementsByName('email[]')[3];
                var emailField = document.getElementsByName('email[]')[0];
                var emailError = document.getElementById('email_error');
                var email = emails[0].trim();
                if (email === '') {
                    emailFieldSet1.classList.add('is-invalid');
                    emailFieldSet2.classList.add('is-invalid');
                    emailFieldSet3.classList.add('is-invalid');
                    emailError.innerText = '*Please enter an email address.';
                } else if (!isValidEmail(email)) {
                    emailFieldSet1.classList.add('is-invalid');
                    emailFieldSet2.classList.add('is-invalid');
                    emailFieldSet3.classList.add('is-invalid');
                    emailError.innerText = '*Please enter a valid email address.';
                } else {
                    emailFieldSet1.classList.remove('is-invalid');
                    emailFieldSet2.classList.remove('is-invalid');
                    emailFieldSet3.classList.remove('is-invalid');
                    emailError.innerText = '';
                }


                // Validate the message_box field
                var messageField = document.getElementById('exampleFormControlTextarea1');
                var messageError = document.getElementById('message_box_error');
                if (message.trim() === '') {
                    messageField.classList.add('is-invalid');
                    messageError.innerText = '*Please enter a message.';
                } else {
                    messageField.classList.remove('is-invalid');
                    messageError.innerText = '';
                }

                // Check if there are any errors
                var errors = document.querySelectorAll('.is-invalid');
                if (errors.length === 0) {
                    // Submit the form using AJAX
                    $.ajax({
                        url: '/php/invitation_email.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            console.log(response);
                            $('#success_message').removeClass('d-none');
                            $('#success_message').addClass('d-block');
                            $('#success_message').html(response);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                }
            });

            // Function to validate email format
            function isValidEmail(email) {
                // Regular expression for email format
                var regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
                return regex.test(email);
            }

            // Ajax Ends Here For Invitation



            // add click event listener to buttons
            $(".response-btn").on("click", function(event) {
                event.preventDefault(); // add this line to prevent the button's default behavior
                $(".response-btn").removeClass("active");
                $(this).addClass("active");
                $("#response").val($(this).data("btn-value"));
            });


            // add click event listener to RSVP button
            $("button[name='rsvp']").on("click", function(event) {
                // Prevent default form submission
                event.preventDefault();

                // Get form data
                var formData = $("#party_form").serialize();

                // Send AJAX request
                $.ajax({
                    url: '/php/process_party_form.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle successful response here
                        console.log(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Handle error here
                        console.log(textStatus + ': ' + errorThrown);
                    }
                });
            });




        });



        const buttons = document.querySelectorAll('.response-btn');

        buttons.forEach((button) => {
            button.addEventListener('click', () => {
                buttons.forEach((otherButton) => {
                    otherButton.classList.remove('clicked'); /* Remove the "clicked" class from all other buttons */
                });

                button.classList.add('clicked'); /* Add the "clicked" class to the clicked button */
            });
        });
    </script>

<?php
    
	require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';

?>
</body>

</html>