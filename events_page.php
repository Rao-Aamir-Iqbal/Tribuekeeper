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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $firstname . " " . $lastname ?>'s Events | Keeper
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
        .btn-new {
            width: 25% !important;
        }

        .gradient {
            background: #428bca;
            /* background: linear-gradient(195deg, #5b1346 -24.65%,#46c0e1 97.7%); */
            background: linear-gradient(113.3deg, rgb(134, 209, 228) -1.8%, rgb(60, 80, 115) 86.4%);
        }

        .img-responsive {
            display: block;
            height: auto;
            max-width: 100%;
        }

        .p-25 {
            height: 370px;
        }

        .bg-img {
            background-position: center 50%;
            width: 100%;
            height: 100%;
            min-height: 320px;
            /* height: 370px; */
            /* position: relative; */
            z-index: 1;
            margin-top: 15px;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .col-text {
            z-index: 2;
            width: 100%;
            text-align: center;
            margin: 0 auto;
            color: #fff;
            font-size: 18px;
        }

        .wrap {
            background: rgba(193, 193, 193, 0.4);
            padding-top: 35px;
            padding-bottom: 35px;
            min-height: 370px;
        }

        .f-22 {
            font-size: 25px;
        }

        .link-event-detail {
            font-size: 18px;
        }

        .link-event-detail:hover {
            color: red;
            /* Change the color to your preferred hover color */
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
                        <?php
                        $membership = mysqli_query($con, "SELECT * FROM users WHERE `ID` = '$user_id'");
                        $fetchmem = mysqli_fetch_assoc($membership);
                        $membership_approved = $fetchmem['membership'];
                        if ($membership_approved == '1') {

                        ?>
                            <div class=" row pt-4 text-black">
                                <div class=" col-md-12 ">
                                    <div class="p-4 edit-profile-border">
                                        <div class="row">
                                            <div class="col-md-12 edit-profile-row d-flex justify-content-right align-items-right h-100">
                                            </div>
                                            <div class="hr-div">
                                                <div class="row">
                                                    <?php
                                                    $sql_lite = "SELECT * FROM `events` WHERE user_id = $user_id";
                                                    
                                                    $exe_lite = mysqli_query($con, $sql_lite);
                                                    
                                                    if (mysqli_num_rows($exe_lite) > 0) {
                                                         
                                                    ?>
                                                        <div class="mt-5 d-flex flex-row-reverse mb-4">
                                                            <a class="prof-button" href="/events_form/<?php echo $username ?>" style="text-decoration: none; color: white;margin-top:30px;">
                                                                Add Events
                                                            </a>
                                                        </div>
                                                        <?php
                                                        while ($row = mysqli_fetch_assoc($exe_lite)) {
                                                            $title = $row['title'];
                                                            $description = $row['description'];
                                                            $date = date("F jS, Y", strtotime($row['date']));
                                                            $time = date("g:ia", strtotime($row['time']));
                                                            $location = $row['location'];
                                                            $event_link = $row['event_link'];
                                                            $image = $row['image'];
                                                        ?>

                                                            <div class=" p-25 col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-5">
                                                                <div class="bg-img" style="background-image:url('/php/events_picture/<?php echo $image ?>');">
                                                                    <div class="wrap">
                                                                        <div class="col-text">
                                                                            <div class="">
                                                                                <h2 class="f-22">
                                                                                    <?php echo $title ?>
                                                                                </h2>
                                                                                <p>
                                                                                    <?php echo $date ?>
                                                                                </p>
                                                                                <p>
                                                                                    <?php echo $time ?>
                                                                                </p>
                                                                                <p>
                                                                                    <?php echo $location ?>
                                                                                </p>
                                                                                <p>Austin, </p>
                                                                                <p>
                                                                                    <a href="/event/<?php echo $title ?>" class="link-event-detail text-dark fw-bold text-decoration-none">View Details</a>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>

                                                        <div class=" p-25 col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-5">
                                                            <div class="wrap">
                                                                <div class="col-text">
                                                                    <div class="">
                                                                        <h2 class="f-22 mt-5 text-dark">
                                                                            No Events!
                                                                        </h2>

                                                                    </div>
                                                                    <div class="mt-5">
                                                                        <a class="prof-button" href="/events_form/<?php echo $title ?>" style="text-decoration: none; color: white;margin-top:30px;">
                                                                            Add Events
                                                                        </a>
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
                                </div>
                            </div>

                            <div class=" row pt-4 text-black">
                                <div class=" col-md-12 ">
                                    <div class="p-4 ">
                                        <a href="">
                                            <img src="/Website-VMS-for-Events-footer1.png" alt="" class="img-responsive">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="row pt-4 text-black">
                                <div class="col-md-12">
                                    <div class="p-4 edit-profile-border gradient">
                                        <div class="row">
                                            <div class="col-md-12 edit-profile-row d-flex justify-content-right align-items-right h-100"></div>
                                            <div class="hr-div">
                                                <h3 class="pt-3 white">Create Events with Keeper Plus</h3>
                                                <p class="white">Create your own event pages, and track RSVPs with Keeper Plus.</p>
                                                <button class="m-2 prof-button "><a href="/payment" style="text-decoration: none; color: white">Upgrade to Keeper Plus</a></button><br />
                                            </div>
                                            <div class="hr-div">
                                                <hr />
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
</body>

</html>