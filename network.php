<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

if (!$_SESSION['user_id']) {
    header("location: /login");
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `users` WHERE ID = '" . $_SESSION['user_id'] . "'";
$exe = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($exe);

$firstname = $fetch['firstname'];
$username = $fetch['username'];
$middlename = $fetch['middlename'];
$lastname = $fetch['lastname'];
$image = $fetch['image'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Page</title>
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
   <style>
        .btn-new {
            width: 25% !important;
        }

        .style-text {
            max-width: 350px;
            display: inline-block;
            margin-bottom: 8px;
        }

        .btn-button {
            padding: 0px 20px !important;
            border-radius: 0px !important;
            margin-left: 10px !important;
            max-width: 300px;
            display: inline-block;
            margin-bottom: 8px;
            width: 25% !important;
        }

        .profile-image {
            width: 225px;
            height: 225px;
            display: inline-block;
            border: 3px solid #eee;
            box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);
            border-radius: 50%;
            background-color: white;
        }

        .events-image {
            width: 30%!important;
            height: 30%!important;
            display: inline-block;
            border: 3px solid #eee;
            box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);
            /* border-radius: 50%; */
            background-color: white;
        }

        .profile-image-small {
            width: 50px;
            height: 50px;
            display: inline-block;
            border: 3px solid #eee;
            box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);
            border-radius: 50%;
            background-color: white;
        }

        .second-row {
            display: flex;
            justify-content: space-between;
            text-align: center;
            align-items: center;
            width: 100%;
            margin-top: 50px;
        }

        .col-xs-3 {
            width: 25% !important;
        }

        .grid p {
            margin: 0px;
        }

        .cent {
            display: flex;
            justify-content: center;
            text-align: center;
            align-items: center;
            width: 100%;
        }

        .col-xs-6 {
            width: 50% !important;
        }

        .col-xs-12 {
            width: 100% !important;
        }

        .link-text {
            text-align: right !important;
        }

        .link-text a {
            text-decoration: none;
        }

        .center {
            display: flex;
            justify-content: center;
            text-align: center;
            align-items: center;
            width: 100%;
        }

        .fom-wid {
            width: 400px;
        }

        @media (max-width: 768px) {
            .profile-image {
                width: 100px;
                height: 100px;
                display: inline-block;
                border: 3px solid #eee;
                box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);
                border-radius: 50%;
                background-color: white;
            }
            .events-image {
            width: 30%;
            height: 30%;
            display: inline-block;
            border: 3px solid #eee;
            box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);
            /* border-radius: 50%; */
            background-color: white;
        }
            .sml-siz p {
                font-size: small !important;
                margin-top: -7px;
            }
        }

        .fs-rel {
            font-size: 13px !important;
        }

        @media (max-width: 462px) {
            .profile-image {
                width: 70px;
                height: 70px;
                display: inline-block;
                border: 3px solid #eee;
                box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);
                border-radius: 50%;
                background-color: white;
            }
            .events-image {
            width: 60%!important;
            height: 60% !important;
            display: inline-block;
            border: 3px solid #eee;
            box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);
            /* border-radius: 50%; */
            background-color: white;
            .sml-siz {
                font-size: 7px !important;
            }
        }

        @media (max-width: 440px) {
            .sml-siz {
                font-size: 10px !important;
            }

            .fom-wid {
                width: auto;
            }
        }

        @media (max-width: 390px) {
            .sml-siz {
                font-size: 8px !important;
            }
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
                <div class="">
                    <div class="card">
                        <div class=" row pt-4 text-black">
                            <div class=" col-md-12 ">
                                <div class="p-4 edit-profile-border">
                                    <div class="row">
                                        <div class="col-md-12 hr-div">
                                            <!-- <h1 class="pt-3 "><i class="fas fa-home-lg-alt"></i></i>Your Network</h1> -->
                                            <h1 class="pt-3 "><i class="ti-home fw-bold"></i></i> Your Network</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php

                    $sql = mysqli_query($con, "SELECT * FROM `keepers` WHERE `user_id` = '" . $_SESSION['user_id'] . "'");
                    while ($fetchkeeperid = mysqli_fetch_assoc($sql)) {
                        $keeper_idd = $fetchkeeperid['kepper_ids'];
                        $sql22 = mysqli_query($con, "SELECT * FROM `users` WHERE `ID` = '" . $keeper_idd . "' AND `type` = '2'");
                        //echo "SELECT * FROM `users` WHERE `ID` = '" . $keeper_idd . "' AND `type` = '2'";

                        while ($fetch = mysqli_fetch_assoc($sql22)) {
                            $memorial_id = $fetch['ID'];
                            $kfirstname = $fetch['firstname'];
                            $kusername = $fetch['username'];
                            $kmiddlename = $fetch['middlename'];
                            $klastname = $fetch['lastname'];
                            $img = $fetch['image'];
                            $date = $fetch['date'];
                            $date_of_birth = $fetch['date_of_birth'];
                            $formattedDate_of_birth = date("F jS, Y", strtotime($date_of_birth));
                            $date_of_death = $fetch['date_of_death'];
                            $formattedDate_of_death = date("F jS, Y", strtotime($date_of_death));

                            $datetimeString = "$date $time";
                            $datetime = strtotime($datetimeString);
                            $currentDatetime = time();

                            $elapsedTime = ($currentDatetime - $datetime) / 3600; // Divide by 3600 to convert seconds to hours

                            if ($elapsedTime >= 24) {
                                $elapsedDays = floor($elapsedTime / 24); // Calculate the number of elapsed days
                                if ($elapsedDays == 1) {
                                    $timespend = $elapsedDays . " day";
                                } else {
                                    $timespend = $elapsedDays . " days";
                                }
                            } else {
                                $elapsedHours = intval($elapsedTime); // Calculate the number of elapsed hours
                                $timespend = $elapsedHours . " hours";
                            }
                            //die();
                    ?>
                            <div class="card">
                                <div class=" row pt-4 text-black">
                                    <div class=" col-md-12 ">

                                        <div class="p-4 edit-profile-border">
                                            <div class="row">
                                                <div class="col-md-12 hr-div">
                                                    <div class="d-flex flex-row">
                                                        <?php
                                                        if ($image != '') {
                                                        ?>
                                                            <img src="/assets/profile/<?php echo $image; ?>" class="profile-image-small" alt="Test Test" title="Test Test">
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image-small" alt="Test Test" title="Test Test">
                                                        <?php

                                                        }
                                                        ?>
                                                        <p><a href="/profile/<?php echo $username ?>" class="ms-3 fw-bold text-decoration-none"><?php echo $firstname; ?> <?php echo $lastname; ?> </a>created a new memorial profile for <a href="/profile/<?php echo $kusername ?>" class="fw-bold text-decoration-none"><?php echo $kfirstname; ?> <?php echo $klastname; ?></a> About <?php echo $timespend ?> ago.</p>
                                                    </div>
                                                    <div class="text-center">
                                                        <div class="">
                                                            <?php
                                                            if ($img != '') {
                                                            ?>
                                                                <img src="/assets/profile/<?php echo $img; ?>" class="profile-image" alt="Test Test" title="Test Test">
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                            <?php

                                                            }
                                                            ?>
                                                        </div>
                                                        <p class="pt-3 sml-siz" style="font-size: large;">

                                                        </p>
                                                        <p class=" sml-siz">
                                                            <a href="/memorial_session/<?php echo $memorial_id.'/'.$kusername ?>" class="fw-bold text-decoration-none fs-5"><?php echo $kfirstname; ?> <?php echo $klastname; ?></a>
                                                        </p>
                                                        <p class=" sml-siz">
                                                        <p class="fw-bold"><?php echo $formattedDate_of_birth ?> - <?php echo $formattedDate_of_death ?></p>
                                                        </p>
                                                        <div class="">
                                                            <a class="mx-4 my-3 prof-button" href="#" style="text-decoration: none; color: white">
                                                                <i class="ti-pencil p-1"></i> Send a Tribute
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>

            </div>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="">
                    <div class="card">
                        <div class=" row pt-4 text-black">
                            <div class=" col-md-12 ">
                                <div class="p-4 edit-profile-border">
                                    <div class="row">
                                        <div class="col-md-12 hr-div">
                                            <!-- <h1 class="pt-3 "><i class="fas fa-home-lg-alt"></i></i>Your Network</h1> -->
                                            <h1 class="pt-3 "><i class="ti-calendar fw-bold"></i></i> Your Events</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php

                    $sql = mysqli_query($con, "SELECT * FROM `events` WHERE `user_id` = '" . $_SESSION['user_id'] . "'");
                    while ($fetch = mysqli_fetch_assoc($sql)) {
                        $title = $fetch['title'];
                        $description = $fetch['description'];
                        $date = $fetch['date'];
                        $time = $fetch['time'];
                        $location = $fetch['location'];
                        $img1 = $fetch['image'];
                        $formattedDate = date("F jS, Y", strtotime($date));

                        $datetimeString = "$date $time";
                        $datetime = strtotime($datetimeString);
                        $currentDatetime = time();

                        $elapsedTime = ($currentDatetime - $datetime) / 3600; // Divide by 3600 to convert seconds to hours

                        if ($elapsedTime >= 24) {
                            $elapsedDays = floor($elapsedTime / 24); // Calculate the number of elapsed days
                            if ($elapsedDays == 1) {
                                $timespend = $elapsedDays . " day";
                            } else {
                                $timespend = $elapsedDays . " days";
                            }
                        } else {
                            $elapsedHours = intval($elapsedTime); // Calculate the number of elapsed hours
                            $timespend = $elapsedHours . " hours";
                        }





                        //die();
                    ?>
                        <div class="card">
                            <div class=" row pt-4 text-black">
                                <div class=" col-md-12 ">
                                    <div class="p-4 edit-profile-border">
                                        <div class="row">
                                            <div class="col-md-12 hr-div">
                                                <div class="d-flex flex-row">
                                                    <?php
                                                    if ($image != '') {
                                                    ?>
                                                        <img src="/assets/profile/<?php echo $image; ?>" class="profile-image-small" alt="Test Test" title="Test Test">
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image-small" alt="Test Test" title="Test Test">
                                                    <?php

                                                    }
                                                    ?>
                                                    <p><a href="/profile/<?php echo $username ?>" class="ms-3 fw-bold text-decoration-none"><?php echo $firstname; ?> <?php echo $lastname; ?> </a>created a new Event About <?php echo $timespend ?> ago.</p>
                                                </div>
                                                <div class="text-center">
                                                    <div class="">
                                                        <?php
                                                        if ($img1 != '') {
                                                        ?>
                                                            <img src="/php/events_picture/<?php echo $img1; ?>" class="events-image" alt="Test Test" title="Test Test">
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                        <?php

                                                        }
                                                        ?>
                                                    </div>
                                                    <p class="pt-3 sml-siz" style="font-size: large;">

                                                    </p>
                                                    <p class=" sml-siz">
                                                        <span class="fw-bold text-decoration-none fs-5"><?php echo $title; ?></span>
                                                    </p>
                                                    <p class=" sml-siz">
                                                    <p class="fw-bold"><?php echo $formattedDate . ' , ' . $time ?></p>
                                                    </p>
                                                    <div class="">
                                                        <a class="mx-4 my-3 prof-button" href="/event/<?php echo $title ?>" style="text-decoration: none; color: white">
                                                            <i class="ti-pencil p-1"></i> Event Details
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
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
    </section>
    <?php
    
	require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';

?>
</body>

</html>