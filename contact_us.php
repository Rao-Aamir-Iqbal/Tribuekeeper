<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

if (!$_SESSION['user_id']) {
  header("location: /login");
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM `users` WHERE ID = $user_id";
$exe = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($exe);
$image = $fetch['image'];
$cover_image = $fetch['cover_image'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Picture Profile</title>
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/js/script.js">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/assets/css/themify-icons.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


  <style>
    .input-style {
      border: none;
      border-radius: 10px;
      font-size: medium;
    }

    .form-outline textarea {
      height: auto !important;
    }

    .error {
      border: 2px solid red;
    }

    /* .text-right {
      float: right !important;
      padding-right: 40px;
      padding-top: 20px;
    } */
  </style>
</head>

<body>
  <?php

  require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
  ?>

  <section class="h-100 gradient-custom-2">
    <div class="container">
      <div class="card">
        <div class=" row pt-4 text-black">
          <div class="col-md-12 ">
            <div class="p-4 edit-profile-border">
              <div class="row ">
                <div class="col-md-12 hr-div">
                  <h3 class="pt-3">Contact Us Form</h1>
                </div>
                <div class="hr-div">
                  <hr>
                </div>
                <div class="hr-div">
                  <div class=" row ">
                    <form id="contactForm" action="">
                      <div class="col-md-10">
                        <div class="row py-2">
                          <div class="col-md-5 mb-4">
                            <div class="form-outline">
                              <label for="form3Example1n">Your First Name:</label>
                              <input type="text" id="firstname" name="firstname" placeholder="First Name" class="form-control form-control-lg input-style" />
                            </div>
                          </div>
                          <div class="col-md-5 mb-4">
                            <div class="form-outline">
                              <label for="form3Example1m">Your Last Name:</label>
                              <input type="text" id="lastname" placeholder="Last Name" name="lastname" class="form-control form-control-lg input-style" />
                            </div>
                          </div>
                          <div class="col-md-5 mb-4">
                            <div class="form-outline">
                              <label for="form3Example1m">Your Email</label>
                              <input type="email" id="email" placeholder="name@email.com" name="email" class="form-control form-control-lg input-style" />
                            </div>
                          </div>
                          <div class="col-sm-10 mb-4">
                            <div class="form-outline">
                              <label for="txtMsg">Message:</label>
                              <textarea id="message" rows="5" name="message" class="form-control form-control-lg input-style" placeholder="Message"></textarea>
                            </div>
                          </div>
                          <div class="mt-4 d-flex flex-row">
                          <button class="prof-button" type="submit" style="padding:10px 40px 10px 40px;">Send</button>
                            <!-- <button type="submit" class="btn btn-primary form-control-sm mx-3">Send</button> -->
                            <div id="submit-message" class="ms-5"></div>
                          </div>

                        </div>
                      </div>
                      <div class="col-md-12 mt-4">
                        <p class="text-right">
                          Contact us by email:
                          <a id="email-info" href="mailto:info@mykeeper.com">info@Tributekeeper.com</a> | <a id="email-support" href="mailto:support@mykeeper.com">support@mykeeper.com</a>
                        </p>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // $(document).ready(function() {
    //   $('#contactForm').submit(function(event) {
    //     event.preventDefault(); // prevent the form from submitting normally

    //     // Validate form fields
    //     var firstname = $('#firstname').val().trim();
    //     var lastname = $('#lastname').val().trim();
    //     var email = $('#email').val().trim();
    //     var message = $('#message').val().trim();

    //     if (firstname === '' || lastname === '' || email === '' || message === '') {
    //       // Display an error message or perform specific actions for validation failure
    //       $('#submit-message').html("Please fill in all the required fields.");

    //       return;
    //     }

    //     // Get form data
    //     var formData = $(this).serialize();

    //     // Send AJAX request
    //     $.ajax({
    //       url: '/php/process-contact-form.php', // replace with the actual PHP file to handle form submission
    //       type: 'POST',
    //       data: formData,
    //       success: function(response) {
    //         // Handle success response
    //         // alert('Message sent successfully!');
    //         $('#submit-message').html(response);
    //         // Reset the form
    //         $('#contactForm')[0].reset();
    //       },
    //       error: function(error) {
    //         // Handle error response
    //         alert('Error sending message. Please try again.');
    //       }
    //     });
    //   });
    // });
    $(document).ready(function() {
  $('#contactForm').submit(function(event) {
    event.preventDefault(); // prevent the form from submitting normally

    // Reset error styles
    $('.error').removeClass('error');

    // Get form data
    var formData = $(this).serialize();
    var fields = ['firstname', 'lastname', 'email', 'message'];

    // Validate form fields
    var isValid = true;
    for (var i = 0; i < fields.length; i++) {
      var field = fields[i];
      var value = $('[name="' + field + '"]').val().trim();

      if (value === '') {
        $('[name="' + field + '"]').addClass('error');
        isValid = false;
      }
    }

    if (!isValid) {
      $('#submit-message').html("<p style='color:#FF0000;'>Please fill in all the required fields.</p>");
      return;
    }

    // Send AJAX request
    $.ajax({
      url: '/php/process-contact-form.php', // replace with the actual PHP file to handle form submission
      type: 'POST',
      data: formData,
      success: function(response) {
        // Handle success response
        $('#submit-message').html(response);
        // Reset the form
        $('#contactForm')[0].reset();
      },
      error: function(error) {
        // Handle error response
        alert('Error sending message. Please try again.');
      }
    });
  });
});

  </script>

</body>

</html>