<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

if (!$_SESSION['user_id']) {
  header("location: /login");
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM `profile_memorial` WHERE user_id = $user_id";
$exe = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($exe);
$memorial_textarea = $fetch['memorial_textarea'];
$favorite_saying = $fetch['favorite_saying'];
$status = $fetch['status'];
//die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Memorial page</title>
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/js/script.js">
  <link rel="stylesheet" href="/assets/css/footer.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/assets/css/themify-icons.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">


  <style>
    .imagess {
      width: 150px;
      height: 150px;
      margin: 10px;
      cursor: pointer;
    }

    .imagess.selected {
      border: 3px solid #2F5E76;
    }

    .error {
      border: 1px solid red;
    }
  </style>
</head>

<body>

  <?php

  require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/subheader.php';

  ?>

  <section class="h-100 gradient-custom-2">

    <div class="container py-5 h-100">
      <div class="row">
        <div class="">
          <div class="card">
            <!--<div class="p-4 text-black  circle-img">-->

              <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/editheader.php'; ?>
            <!--</div>-->
            <div class=" row pt-4 text-black">
              <div class=" col-md-12 ">
                <div class="p-4 edit-profile-border">
                  <div class="row ">
                    <div class="col-md-12 hr-div">
                      <h3 class="pt-3">Memorial</h3>
                    </div>
                    <div class="hr-div">
                      <hr>
                  
                    <form id="memorial_form" action="">
                      <div class="">
                        <div class="row pad-rit-memo-page">
                          <div class="">
                            <label for="textbox1" class="py-2">Biography / Obituary</label>
                            <br>
                            <div class="summernode">
                              <textarea id="memorial" name="memorial_textarea" maxlength="19999"><?php echo $memorial_textarea ?></textarea>
                              <span class="float-end" id="charCount" style="color:red;"></span>
                            </div>
                            <br>
                            <label for="textbox2" class="py-2">Favorite Saying</label>
                            <br>
                            <textarea id="textbox2" class="txt-box-memo-page" placeholder="Life's a Box of Chocolates" name="textbox2" rows="5" cols="50"><?php echo $favorite_saying ?></textarea>
                            <br>
                            <label for="dropdown" class="py-2">Status</label>
                            <br>
                            <div id="alertContainer"></div>
                            <select id="dropdown" name="status">
                              <option value="1" <?php if ($status == 1) echo "selected" ?>>Alive</option>
                              <option value="0" <?php if ($status == 0) echo "selected" ?>>Deceased</option>
                            </select>
                          </div>
                        </div>
                        <div class="flex-row d-flex">
                          <button id="submitFormBtn" class="m-2 ms-0 mt-4 prof-button" type="submit">Save Change</button>
                          <div id="memorial_msg" class="" style="margin-top: 33px!important; margin-left: 30px!important;"></div>
                          <div id="alert_msg" class="" style="margin-top: 33px!important; margin-left: 0px!important;"></div>
                        </div>
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
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

  <script>
    $(document).ready(function() {
      // Listen for change event on the status dropdown
      $('#dropdown').change(function() {
        var selectedValue = $(this).val();

        // Check if the selected value is "0" (Deceased)
        if (selectedValue === "0") {
          // Display the Bootstrap alert message
          var alertHtml = '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
          alertHtml += 'Only your Keeper can change your status to Deceased. <a href="#" class="text-decoration-none">Learn More</a>.';
          alertHtml += '</div>';
          // Update the content of the alertContainer
          $('#alertContainer').html(alertHtml);
          $('#alertContainer').show(1000);
        }
        if (selectedValue === "1") {
         
          $('#alertContainer').hide(1000);
        }
      });

    });
    $(document).ready(function() {
      $('#submitFormBtn').click(function(e) {
        e.preventDefault(); // Prevent the default form submit behavior

        var selectedValue = $('#dropdown').val();

        // Check if the selected value is "0" (Deceased)
        if (selectedValue === "0") {
          // Display the Bootstrap alert message
          var alertHtml = '<div class="fade show" role="alert">';
          alertHtml += 'Only your Keeper can change your status to Deceased. <a class="text-decoration-none" href="#">Learn More</a>.';
          alertHtml += '</div>';

          // Update the content of the alertContainer
          $('#alert_msg').html(alertHtml);
          setTimeout(function() {
        $('#alert_msg').empty();
      }, 5000);
        } else {
          // Get the form data
          var formData = $('#memorial_form').serialize();

          // Send the form data using AJAX
          $.ajax({
            type: 'POST',
            url: '/php/memorial_profile.php', // URL of the PHP script that handles form submission
            data: formData,
            success: function(response) {
              // Display the response message
              $('#memorial_msg').html(response);

              setTimeout(function() {
              $('#memorial_msg').empty();
            }, 4000);
              // Reset the form
              // $('#memorial_form')[0].reset();
              // $('#memorial').val('');

              // // Clear the alert message
              // $('#alertContainer').empty();
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText); // Log the error response
              // Additional actions upon error
            }
          });
        }
      });
    });





    $(document).ready(function() {
      // Display initial character count
      updateCharacterCount();

      // Track input changes
      $('#memorial').on('input', function() {
        updateCharacterCount();
      });

      function updateCharacterCount() {
        var maxLength = parseInt($('#memorial').attr('maxlength'));
        var currentLength = $('#memorial').val().length;
        var remainingLength = maxLength - currentLength;

        // Update character count display
        $('#charCount').text('Characters: ' + remainingLength);

        // Disable form submission if the limit is exceeded
        if (currentLength > maxLength) {
          $('#submitFormBtn').prop('disabled', true);
        } else {
          $('#submitFormBtn').prop('disabled', false);
        }
      }
    });

    $(document).ready(function() {
      $('#submitFormBtn').click(function(e) {
        e.preventDefault(); // Prevent the default form submit behavior

        // Get the form data
        var formData = $('#memorial_form').serialize();

        // Send the form data using AJAX
        $.ajax({
          type: 'POST',
          url: '/php/memorial_profile.php', // URL of the PHP script that handles form submission
          data: formData,
          success: function(response) {
            $('#memorial_msg').html(response);

            // Hide the response message after 3 seconds
           

            // Reset the form
            // $('#memorial_form')[0].reset();
            // $('#memorial').val(''); // Clear the textarea
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText); // Log the error response
            // Additional actions upon error
          }
        });
      });
    });


    $(document).ready(function() {
      $('#memorial').summernote();
    });
  </script>
   <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';
    ?>
</body>

</html>