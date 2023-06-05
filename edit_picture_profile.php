<?php
session_start();
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
  <link rel="stylesheet" href="/assets/css/footer.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/assets/css/themify-icons.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">







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
  </style>
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

            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/editheader.php'; ?>

            <div class="row pt-4 text-black">
              <div class="col-md-12">
                <div class="p-2 edit-profile-border" style="position:relative;">
                  <div class="row py-3">
                    <form id="profile_picture_form" action="" method="post" enctype="multipart/form-data">
                      <div class="col-md-12 hr-div">
                        <h2 class="pt-3">Profile Picture</h2>
                      </div>
                      <div class="hr-div">
                        <hr>
                      </div>
                      <div class="hr-div">
                        <div class="row py-4">
                          <div id="loading_profile" class="pro-img-bor">
                            <img class="pro-img" src="/assets/profile/<?php echo $image ?>" alt="">
                          </div>
                        </div>
                        <input type="file" name="Profile" id="profile_update">
                      </div>
                      <div>
                        <div class="hr-div">
                          <button class="prof-button px-4 mt-5" type="submit" name="submit">Submit</button>
                        </div>
                        <div id="profile_success_msg" class="sav-dta" style="position: absolute; bottom: 20px; left: 150px;"></div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="row pt-4 text-black">
              <div class="col-md-12">
                <div class="p-2 edit-profile-border" style="position:relative;">
                  <div class="row py-3">
                    <form id="cover_picture_form" action="" method="post" enctype="multipart/form-data">
                      <div class="col-md-12 hr-div">
                        <h2 class="pt-3">Cover Picture</h2>
                      </div>
                      <div class="hr-div">
                        <hr>
                      </div>
                      <div class="hr-div">
                        <div class="row py-4">
                          <div id="loading_cover" class="">
                            <img class="cover_image" src="/uploads/<?php echo $cover_image ?>" alt="">
                          </div>
                        </div>
                        <input type="file" name="Cover" id="cover_update">
                      </div>
                      <div>
                        <div class="hr-div">
                          <button class="prof-button px-4 mt-5" type="submit" name="submit">Submit</button>
                        </div>
                        <div id="cover_success_msg" class="sav-dta" style="position: absolute; bottom: 20px; left: 150px;"></div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class=" row pt-4 text-black">
              <div class=" col-md-12 ">
                <div class="p-4 edit-profile-border">
                  <div class="row">
                    <div class="col-md-12 hr-div">
                      <p class="pt-3 pad">Don't have access to a photo at the moment? Select a profile image from our
                        library.</p>
                    </div>
                    <div class="hr-div">
                      <hr>
                    </div>
                    <div class="hr-div">
                      <div class="">
                        <div class="row profile-images mt-5">
                          <form id="cover-form">
                            <div class="row" style="position:relative;">
                              <div class="col-md-3 mb-3">
                                <div class="main-profile-img">
                                  <img src="/uploads/1-200x200.jpg" onclick="selectImage(this)" class="imagess px-0" alt="">
                                </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                <div class="main-profile-img">
                                  <img src="/uploads/2-200x200.jpg" onclick="selectImage(this)" class="imagess px-0" alt="">
                                </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                <div class="main-profile-img">
                                  <img src="/uploads/3-200x200.jpg" onclick="selectImage(this)" class="imagess px-0" alt="">
                                </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                <div class="main-profile-img">
                                  <img src="/uploads/4-200x200.jpg" onclick="selectImage(this)" class="imagess px-0" alt="">
                                </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                <div class="main-profile-img">
                                  <img src="/uploads/5-200x200.jpg" onclick="selectImage(this)" class="imagess px-0" alt="">
                                </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                <div class="main-profile-img">
                                  <img src="/uploads/6-200x200.jpg" onclick="selectImage(this)" class="imagess px-0" alt="">
                                </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                <div class="main-profile-img">
                                  <img src="/uploads/7-200x200.jpg" onclick="selectImage(this)" class="imagess px-0" alt="">
                                </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                <div class="main-profile-img">
                                  <img src="/uploads/8-200x200.jpg" onclick="selectImage(this)" class="imagess px-0" alt="">
                                </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                <div class="main-profile-img">
                                  <img src="/uploads/9-200x200.jpg" onclick="selectImage(this)" class="imagess px-0" alt="">
                                </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                <div class="main-profile-img">
                                  <img src="/uploads/10-200x200.jpg" onclick="selectImage(this)" class="imagess px-0" alt="">
                                </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                <div class="main-profile-img">
                                  <img src="/uploads/11-200x200.jpg" onclick="selectImage(this)" class="imagess px-0" alt="">
                                </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                <div class="main-profile-img">
                                  <img src="/uploads/12-200x200.jpg" onclick="selectImage(this)" class="imagess px-0" alt="">
                                </div>
                              </div>

                            </div>
                            <input type="hidden" id="selected-image" name="profile-picture" value="">
                            <div class="hr-div">
                              <button class="prof-button mt-5" type="submit" style="padding:10px 40px 10px 40px;">Submit</button>
                              <div id="success_message" style="position:absolute; bottom: 20px; left: 150px;"></div>
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
        </div>
      </div>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function loadTable() {
      var setload = 123;
      $.ajax({
        url: '/php/profile_update.php',
        method: 'POST',
        data: {
          setload: setload
        },
        success: function(result) {
          $('#loading_profile').html(result);
        }
      });
    }

    function loadcover() {
      var setload2 = 223;
      $.ajax({
        url: '/php/profile_update.php',
        method: 'POST',
        data: {
          setload2: setload2
        },
        success: function(result) {
          $('#loading_cover').html(result);
        }
      });
    }
    $(document).ready(function() {
      // Profile Picture Form Submission
      $('#profile_picture_form').submit(function(event) {
        event.preventDefault(); // prevent the form from submitting normally
        var formData = new FormData(this); // create a new FormData object
        $.ajax({
          url: '/php/profile_update.php', // replace with the actual endpoint URL
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            // handle success response
            $('#profile_success_msg').html(response);
            //$('#profile_success_msg').text('Profile picture updated successfully');
            loadTable();
          },
          error: function(xhr, status, error) {
            // handle error response
            console.log(error); // Log any errors to the console
          }
        });
      });

      // Cover Picture Form Submission
      $('#cover_picture_form').submit(function(event) {
        event.preventDefault(); // prevent the form from submitting normally

        var formData = new FormData(this); // create a new FormData object
        $.ajax({
          url: '/php/profile_update.php', // replace with the actual endpoint URL
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            // handle success response
            $('#cover_success_msg').html(response);
            loadcover();
          },
          error: function(xhr, status, error) {
            // handle error response
            console.log(error); // Log any errors to the console
          }
        });
      });
    });

    $(function() {
      $('#cover-form').on('submit', function(event) {
        event.preventDefault(); // prevent default form submission behavior
        var selectedImage = $('#selected-image').val();
        $.ajax({
          type: 'POST',
          url: '/php/profile_update.php',
          data: {
            'cover-picture': selectedImage
          },
          success: function(event) {
            // handle success response
            console.log(event);
            $('#success_message').html(event);
            // redirect to the success page
            loadcover();
          },
          error: function(xhr, textStatus, errorThrown) {
            // handle error response
            console.log(xhr, textStatus, errorThrown);
          }
        });
      });
    });

    function selectImage(imagess) {
      $('.imagess').removeClass('selected');
      $(imagess).addClass('selected');
      $('#selected-image').val($(imagess).attr('src'));
    }
  </script>
  <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';
    ?>
</body>

</html>
