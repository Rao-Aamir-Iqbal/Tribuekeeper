<?php
session_start();
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

if (!$_SESSION['user_id']) {
  header("location: /login");
}

$sql = "SELECT * FROM `users` WHERE ID = $user_id";
$exe = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($exe);
$image = $fetch['image'];
$firstname = $fetch['firstname'];
$lastname = $fetch['lastname'];
$username = $fetch['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Setting Profile</title>
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
</head>

<body>

  <?php

  require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/subheader.php';

  ?>

  <section class="h-100 gradient-custom-2">



    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="">
          <div class="card">

            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/editheader.php';
            ?>

            <div class=" row pt-4 text-black d-none">
              <div class=" col-md-12 ">
                <div class="p-4 edit-profile-border" style="position: relative;">
                  <div class="row hr-div">
                    <form action="" method="post" id="general_settings">
                      <div class="col-md-12 ">
                        <h3 class="pt-3">Settings</h3>
                      </div>
                      <div class="">
                        <hr>
                      </div>
                      <div class="">
                        <label for="language" class="py-2">Language:</label>
                        <br>
                        <select id="language" class="" name="language" style="border:none; padding:10px 20px 10px 20px;">
                          <option value="english">English</option>
                          <option value="french">French</option>
                          <option value="spanish">Spanish</option>
                        </select>

                        <div class="pb-4">
                          <label for="email_notification" class="py-2">Email notification:</label> <br>
                          <div class="d-flex">
                            <input type="checkbox" id="email_notification" name="email_notification" style="margin-right:10px;">
                            <label for="email_notification" class="py-2">Receive emails for each notification</label>
                          </div>

                          <label for="keeper_updates" class="py-2">Keeper News and Updates:</label><br>
                          <div class="d-flex">
                            <input type="checkbox" id="keeper_updates" name="keeper_updates" style="margin-right:10px;">
                            <label for="keeper_updates" class="py-2">Receive updates on Keeper features, and
                              more.</label>
                          </div>

                        </div>
                        <div>
                          <button class="m-2 prof-button" type="submit" name="submit">Save Changes</button><br>
                        </div>
                        <div id="success_msg" class="sav-dta" style="position:absolute; left: 220px; bottom: 27px;">
                        </div>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
            </div>

            <div class=" row pt-4 text-black">
              <div class=" col-md-12 ">
                <div class="p-4 edit-profile-border">
                  <div class="row hr-div">
                    <div class="col-md-12 ">
                      <h3 class="pt-3">Account Setting</h3>
                    </div>
                    <div class="">
                      <hr>
                    </div>
                    <?php
                    $email_db = mysqli_query($con, "SELECT email FROM users WHERE ID = '$user_id'");
                    $res = mysqli_fetch_assoc($email_db);
                    $email = $res['email'];
                    ?>
                    <div class="">
                      <label for="html" class="py-2">Email</label> <br>
                      <?php echo $email; ?>
                      <br>

                      <a href="/edit_email" class="blue text-decoration-none">Change Email</a><br>

                      <label for="html" class="py-2">Password</label> <br>
                      <a href="/edit_password" class="blue text-decoration-none">Edit Password</a><br>
                      <?php
                      if (isset($_SESSION['email_update_message'])) {
                        session_start();
                      ?>
                        <div class="text-success mt-5" role="alert">
                          <?php
                          echo '<i class="fa-solid fa-check"></i>' . $_SESSION['email_update_message'];
                          unset($_SESSION['email_update_message']);
                          ?>
                        </div>
                      <?php
                      }
                      if (isset($_SESSION['password_edit_message'])) {
                        session_start();
                      ?>
                        <div class="text-success mt-5" role="alert">
                          <?php
                          echo '<i class="fa-solid fa-check"></i>' . $_SESSION['password_edit_message'];
                          unset($_SESSION['password_edit_message']);
                          ?>
                        </div>
                      <?php
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class=" row pt-4 text-black d-none">
              <div class=" col-md-12 ">
                <div class="p-4 edit-profile-border" style="position: relative;">
                  <div class="row hr-div">
                    <form action="" method="post" id="privacy_view">
                      <div class="col-md-12 ">
                        <h3 class="pt-3">Privacy Setting</h3>
                      </div>
                      <div class="">
                        <hr>
                      </div>
                      <div class="">
                        <?php
                        $queryselect = mysqli_query($con, "SELECT * FROM user_settings WHERE user_id = '$user_id'");
                        $fetch23 = mysqli_fetch_assoc($queryselect);
                        $privacy_selected = $fetch23['privacy_view'];
                        ?>
                        <div>
                          <h6>Who can see this profile:</h6>
                          <div class="">
                            <div class="pri-bor d-flex">
                              <div class="p-2">
                                <input type="radio" id="public" name="privacy_setting" value="1" <?php if ($privacy_selected == 1) echo "checked"; ?>>
                              </div>
                              <div>
                                <p class="pt-2"><b>Public:</b> Recommended Setting. Anyone visiting the Keeper site can view and contribute to the profile.</p>
                              </div>
                            </div>

                            <div class="pri-bor d-flex">
                              <div class="p-2">
                                <input type="radio" id="family" name="privacy_setting" value="2" <?php if ($privacy_selected == 2) echo "checked"; ?>>
                              </div>
                              <div>
                                <p class="pt-2"><b>Family:</b> Only Keeper users in the Family Tree of this page can view and contribute to the profile when logged in.</p>
                              </div>
                            </div>

                            <div class="pri-bor d-flex">
                              <div class="p-2">
                                <input type="radio" id="myself" name="privacy_setting" value="3" <?php if ($privacy_selected == 3) echo "checked"; ?>>
                              </div>
                              <div>
                                <p class="pt-2"><b>Myself:</b> Only you and other Keeper administrators of this page can view and contribute to the profile when logged in.</p>
                              </div>
                            </div>

                          </div>
                        </div>
                        <div>
                          <button class="m-2 prof-button" type="submit" name="submit">Save Changes</button><br>
                        </div>
                        <div id="success_msg2" class="sav-dta" style="position:absolute; left: 220px; bottom: 27px; right:120px;"></div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class=" row pt-4 text-black d-none">
              <div class=" col-md-12 ">
                <div class="p-4 edit-profile-border">
                  <div class="row hr-div">
                    <div class="col-md-12 ">
                      <h3 class="pt-3">URL</h3>
                    </div>
                    <div class="">
                      <hr>
                    </div>
                    <div class="">
                      <a href="#" class="blue py-2">https://www.mykeeper.com</a>
                      <p class="pad-rit pt-2">Create a meaningful URL to add a personal touch to your profile.</p>
                      <button class="m-2 prof-button"><a href="#" style="text-decoration: none;color: white;">Edit
                          Picture</a></button><br>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class=" row pt-4 text-black">
              <div class=" col-md-12 ">
                <div class="p-4 edit-profile-border" style="position:relative;">
                  <div class="row hr-div">
                    <div class="col-md-12 ">
                      <h3 class="pt-3">Deactivate Your Account</h3>
                    </div>
                    <div class="">
                      <hr>
                    </div>
                    <div class="">
                      <a href="#" style=" color:red" data-toggle="modal" data-target="#deactivateModal">Deactivate your account</a>
                    </div>
                    <div id="deactivate_msg" style="position: absolute; bottom: 9px; left: 220px;"></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Bootstrap modal -->
            <div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog" aria-labelledby="deactivateModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="deactivateModalLabel">Deactivate Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Are you sure you want to deactivate your account?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="deactivate-yes-btn" data-dismiss="modal">Yes</button>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#general_settings').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        // Get the email notification and keeper updates checkbox values
        var emailNotification = $("#email_notification").prop("checked") ? 1 : 0;
        var keeperUpdates = $("#keeper_updates").prop("checked") ? 1 : 0;

        // Add the checkbox values to the form data
        var formData = $(this).serialize() + "&email_notification=" + emailNotification + "&keeper_updates=" + keeperUpdates;

        // Send the AJAX request
        $.ajax({
          type: 'POST',
          url: '/php/privacy_settings.php', // Replace with the URL of the script that updates the settings
          data: formData,
          success: function(response) {
            // Handle the response from the server
            console.log(response); // Replace with your own code
            $('#success_msg').html(response); // Display success message on the page

          },
          error: function(xhr, status, error) {
            // Handle errors
            console.log(xhr.responseText); // Replace with your own code
          }
        });
      });

      // Privacy Settings Ajax
      $('#privacy_view').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        // Get the email notification and keeper updates checkbox values

        // Add the checkbox values to the form data
        var formData = $(this).serialize();

        // Send the AJAX request
        $.ajax({
          type: 'POST',
          url: '/php/privacy_settings.php', // Replace with the URL of the script that updates the settings
          data: formData,
          success: function(response) {
            // Handle the response from the server
            console.log(response); // Replace with your own code
            $('#success_msg2').html(response); // Display success message on the page

          },
          error: function(xhr, status, error) {
            // Handle errors
            console.log(xhr.responseText); // Replace with your own code
          }
        });
      });

      // Deactivation Ajax
      $('#deactivate-yes-btn').click(function() {
        $.ajax({
          url: '/php/deactivate_account.php',
          type: 'POST', // or GET
          data: {
            'deactivate': true
          },
          success: function(response) {
            // do something with the response
            console.log(response);
            $('#deactivate_msg').html(response); // Display success message on the page
            setTimeout(function() {
              location.reload();
            }, 3000); // 3000 milliseconds = 3 seconds
          },
          error: function(xhr, status, error) {
            // handle the error
            console.log(error);
          }
        });
      });



    });
  </script>
   <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';
    ?>
</body>

</html>