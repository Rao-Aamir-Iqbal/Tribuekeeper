<?php

    session_start();

?>
<style>
    .is-invalid {
        outline: 2px solid red;
    }
</style>
<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event |
        <?php echo $firstname . " " . $lastname ?>
    </title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/js/script.js">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


</head>

<body>

    <?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/subheader.php';

    ?>

    <section class="h-100 gradient-custom-2">

        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="card">
                    <div class=" row pt-4 text-black" id="basic-information">
                        <div class=" col-md-12 ">
                            <div class="p-4 edit-profile-border">
                                <div class="row" style="padding-right:-35px;">
                                    <div class="col-md-12 hr-div">
                                        <h3 class="pt-3">Add Event</h3>
                                    </div>
                                    <div class="hr-div">
                                        <hr>
                                    </div>
                                    <form action="" id="submit_event" method="post">
                                        <div class="hr-div">
                                            <div class="row py-4">
                                                <div class="col-md-4 mb-4">
                                                    <div class="form-outline">
                                                        <input type="text" id="title" name="title"
                                                            placeholder="Enter title of event"
                                                            class="form-control form-control-lg edit-prof-input-1" />
                                                        <div id="title_error"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <div class="form-outline">
                                                        <input type="text" id="description" name="description"
                                                            placeholder="Enter description of event"
                                                            class="form-control form-control-lg edit-prof-input-1 " />
                                                        <div id="description_error"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4 ">
                                                    <div class="form-outline">
                                                        <input type="date" id="date" name="date"
                                                            placeholder="Enter date of description"
                                                            class="form-control form-control-lg edit-prof-input-1" />
                                                        <div id="date_error"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4 ">
                                                    <div class="form-outline">
                                                        <input type="time" id="time" name="time"
                                                            placeholder="Enter time of description"
                                                            class="form-control form-control-lg edit-prof-input-1" />
                                                        <div id="time_error"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4 ">
                                                    <div class="form-outline">
                                                        <input type="text" id="location" name="location"
                                                            placeholder="Enter location of description"
                                                            class="form-control form-control-lg edit-prof-input-1" />
                                                        <div id="location_error"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4 ">
                                                    <div class="form-outline">
                                                        <input type="text" id="event_link" name="event_link"
                                                            placeholder="Enter event link(e.g zoom meeting link)"
                                                            class="form-control form-control-lg edit-prof-input-1" />
                                                        <div id="event_link_error"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4 ">
                                                    <div class="form-outline">
                                                        <input type="file" class="form-control" name="Image" />
                                                        <div id="Image_error"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hr-div">
                                            <button class="prof-button" type="submit" name="submit">Save
                                                Changes</button>
                                        </div>
                                        <div id="success_message" class="sav-dta"
                                            style="position: absolute; left: 200px; bottom: 16px;">
                                        </div>
                                    </form>
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
        $(document).ready(function () {
            // Basic Info Form Ajax Submission
            $('#submit_event').submit(function (e) {
                e.preventDefault(); // Prevent the form from submitting normally

                var formData = $(this).serialize(); // Get form data
                var error = false;

                // Validate firstname field
                var title = $('#title').val().trim();
                if (title == '') {
                    error = true;
                    $('#title').addClass('is-invalid');
                    $('#title_error').html('<p style="color: red;">*Please enter your title name.</p>'); // Add error message
                    $('#title').focus();
                } else {
                    $('#title').removeClass('is-invalid').addClass('is-valid');
                    $('#title_error').html(''); // Remove error message
                }

                // Validate description field
                var description = $('#description').val().trim();
                if (description == '') {
                    error = true;
                    $('#description').addClass('is-invalid');
                    $('#description_error').html('<p style="color: red;">*Please enter your description.</p>'); // Add error message
                    $('#description').focus();
                } else {
                    $('#description').removeClass('is-invalid').addClass('is-valid');
                    $('#description_error').html(''); // Remove error message
                }
                // Validate location field
                var location = $('#location').val().trim();
                if (location == '') {
                    error = true;
                    $('#location').addClass('is-invalid');
                    $('#location_error').html('<p style="color: red;">*Please enter your location.</p>'); // Add error message
                    $('#location').focus();
                } else {
                    $('#location').removeClass('is-invalid').addClass('is-valid');
                    $('#location_error').html(''); // Remove error message
                }
                // Validate event_link field
                var event_link = $('#event_link').val().trim();
                if (event_link == '') {
                    error = true;
                    $('#event_link').addClass('is-invalid');
                    $('#event_link_error').html('<p style="color: red;">*Please enter your event link.</p>'); // Add error message
                    $('#event_link').focus();
                } else {
                    $('#event_link').removeClass('is-invalid').addClass('is-valid');
                    $('#event_link_error').html(''); // Remove error message
                }
                // Validate date field
                var date = $('#location').val().trim();
                if (date == '') {
                    error = true;
                    $('#date').addClass('is-invalid');
                    $('#date_error').html('<p style="color: red;">*Please enter your date.</p>'); // Add error message
                    $('#date').focus();
                } else {
                    $('#date').removeClass('is-invalid').addClass('is-valid');
                    $('#date_error').html(''); // Remove error message
                }
                // Validate time field
                var time = $('#location').val().trim();
                if (time == '') {
                    error = true;
                    $('#time').addClass('is-invalid');
                    $('#time_error').html('<p style="color: red;">*Please enter your time.</p>'); // Add error message
                    $('#time').focus();
                } else {
                    $('#time').removeClass('is-invalid').addClass('is-valid');
                    $('#time_error').html(''); // Remove error message
                }

                // If there is an error, stop the form from submitting and display error message
                if (error) {
                    return false;
                }

                var formData = new FormData(this);

                // Submit form data using AJAX
                $.ajax({
                    url: '/php/submit_event.php', // The PHP file that will handle the form data
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // Handle the response from the PHP file
                        console.log(response);
                        $('#success_message').html(response); // Display success message on the page
                    },
                    error: function (xhr, status, error) {
                        // Handle any errors that occurred during the AJAX request
                        console.log(xhr.responseText);
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