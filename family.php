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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

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
            width: 125px;
            height: 125px;
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
                                        <h3 class="pt-3">User Family</h3>
                                    </div>
                                    <div class="hr-div">
                                        <hr>
                                    </div>
                                    <div class="hr-div">
                                        <div class="grid mt-5">
                                            <div class="row cent">
                                                <div class="col-3 ">
                                                    <div class="text-center">
                                                        <?php
                                                        $quesql = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '" . $user_id . "' AND `relationship` = 'grandfather' AND gender = 'male-father-side' AND `parent_side_one` = '1'");
                                                        // echo "SELECT * FROM `family_member` WHERE `user_id` = '" . $user_id . "' AND `relationship` = 'father'";
                                                        if (mysqli_num_rows($quesql) > 0) {
                                                            $sqlres = mysqli_fetch_assoc($quesql);
                                                            $id = $sqlres['id'];
                                                            $selected_user_id = $sqlres['selected_user_id'];
                                                            $fname = $sqlres['firstname'];
                                                            $mname = $sqlres['middlename'];
                                                            $lname = $sqlres['lastname'];
                                                            $suffix = $sqlres['suffix'];
                                                            $gender = $sqlres['gender'];
                                                            $img  = $sqlres['image'];
                                                            $dob = $sqlres['date_of_birth'];
                                                            $year_dob = date('Y', strtotime($dob));
                                                            $dod = $sqlres['date_of_death'];
                                                            $year_dod = date('Y', strtotime($dod));
                                                            $hidden_selected_id = $sqlres['selected_user_id'];
                                                            $varify = $sqlres['varify'];
                                                            //die();
                                                            if ($selected_user_id != '') {
                                                                if ($varify == 1) {
                                                                    //$hidden_selected_id = $sqlres['selected_user_id'];
                                                                    //die();
                                                                    $selectessql = mysqli_query($con, "SELECT * FROM users WHERE `ID` = '" . $selected_user_id . "'");
                                                                    //echo "SELECT * FROM users WHERE `ID` = '".$hidden_selected_id."'";
                                                                    //die()
                                                                    $selectres = mysqli_fetch_assoc($selectessql);
                                                                    $idd = $selectres['ID'];
                                                                    $fname = $selectres['firstname'];
                                                                    $mname = $selectres['middlename'];
                                                                    $lname = $selectres['lastname'];
                                                                    $username = $selectres['username'];
                                                                    $suffix = $selectres['suffix'];
                                                                    $dob = $selectres['date_of_birth'];
                                                                    $year_dob = date('Y', strtotime($dob));
                                                                    $dod = $selectres['date_of_death'];
                                                                    $year_dod = date('Y', strtotime($dod));
                                                                    $img  = $selectres['image'];
                                                                    if ($img == "") {
                                                                        ?>
                                                                        <div class="">
                                                                            <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                        </div>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <div class="">
                                                                            <img src="/assets/profile/<?php echo $img; ?>" class="profile-image" alt="Test Test" title="Test Test">
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <div class="d-flex flex-row justify-content-center">
                                                                        <p class="pt-3 sml-siz" style="font-size: large;">

                                                                            <a href="/profile/<?php echo $username;?>" class="text-decoration-none fst-italic" style="font-weight: 700!important;font-size: 16px;"><?php echo $fname . ' ' . $mname . ' ' . $lname . ',' . $suffix; ?></a>&nbsp&nbsp <a href="/edit-family-member/<?php echo $gender?>/<?php echo $idd?>" class="ti-pencil text-decoration-none fw-bold mt-1"></a>
                                                                        </p>
                                                                    </div>
                                                                    <p class=""><?php echo $year_dob . '-' . $year_dod; ?></p>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <p class="pt-3 sml-siz" style="font-size: large;">
                                                                        <a href="/add-family-member/m" class="ti-plus text-decoration-none fw-bold"></a>
                                                                    </p>
                                                                    <?php
                                                                }
                                                            } else {
                                                                if ($img == "") {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/<?php echo $img; ?>" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <div class="d-flex flex-row justify-content-center">
                                                                    <p class="pt-3 sml-siz" style="font-size: large;">

                                                                    <p class="fw-bold text-decoration-none fst-italic"><?php echo $fname . ' ' . $mname . ' ' . $lname . ',' . $suffix; ?></p>&nbsp&nbsp <a href="/edit-family-member/<?php echo $gender?>/<?php echo $id;?>" class="ti-pencil text-decoration-none fw-bold mt-1"></a>
                                                                    </p>

                                                                </div>
                                                                <p class=""><?php echo $year_dob . '-' . $year_dod; ?></p>
                                                                <?php
                                                            }
                                                            //die();
                                                            ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class="">
                                                                <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                            </div>
                                                            <p class="pt-3 sml-siz" style="font-size: large;">
                                                                <div onclick="save('grand_father')"  class="ti-plus text-decoration-none fw-bold"></div>
                                                            </p>
                                                            <?php
                                                        }
                                                        ?>
                                                        <p class="sml-siz">
                                                            <b class="fs-rel">Grandfather</b>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-3 ">
                                                    <div class="text-center">
                                                        <?php
                                                        $quesql = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '" . $user_id . "' AND `relationship` = 'grandmother' AND `gender` = 'female-father-side' AND `parent_side_one` = '1'");
                                                        // echo "SELECT * FROM `family_member` WHERE `user_id` = '" . $user_id . "' AND `relationship` = 'father'";

                                                        if (mysqli_num_rows($quesql) > 0) {
                                                            $sqlres = mysqli_fetch_assoc($quesql);
                                                            $id = $sqlres['id'];
                                                            $selected_user_id = $sqlres['selected_user_id'];
                                                            $fname = $sqlres['firstname'];
                                                            $mname = $sqlres['middlename'];
                                                            $lname = $sqlres['lastname'];
                                                            $suffix = $sqlres['suffix'];
                                                            $gender = $sqlres['gender'];
                                                            $img  = $sqlres['image'];
                                                            $dob = $sqlres['date_of_birth'];
                                                            $year_dob = date('Y', strtotime($dob));
                                                            $dod = $sqlres['date_of_death'];
                                                            $year_dod = date('Y', strtotime($dod));
                                                            $hidden_selected_id = $sqlres['selected_user_id'];
                                                            $varify = $sqlres['varify'];
                                                            //die();
                                                            if ($selected_user_id != '') {
                                                                if ($varify == 1) {
                                                                    // $hidden_selected_id = $sqlres['selected_user_id'];
                                                                    //die();
                                                                    $selectessql = mysqli_query($con, "SELECT * FROM users WHERE `ID` = '" . $selected_user_id . "'");
                                                                    //echo "SELECT * FROM users WHERE `ID` = '".$hidden_selected_id."'";
                                                                    //die()
                                                                    $selectres = mysqli_fetch_assoc($selectessql);
                                                                    $idd = $selectres['ID'];
                                                                    $fname = $selectres['firstname'];
                                                                    $mname = $selectres['middlename'];
                                                                    $lname = $selectres['lastname'];
                                                                    $username = $selectres['username'];
                                                                    $suffix = $selectres['suffix'];
                                                                    $dob = $selectres['date_of_birth'];
                                                                    $year_dob = date('Y', strtotime($dob));
                                                                    $dod = $selectres['date_of_death'];
                                                                    $year_dod = date('Y', strtotime($dod));
                                                                    $img  = $selectres['image'];
                                                                    if ($img == "") {
                                                                        ?>
                                                                        <div class="">
                                                                            <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                        </div>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <div class="">
                                                                            <img src="/assets/profile/<?php echo $img; ?>" class="profile-image" alt="Test Test" title="Test Test">
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <div class="d-flex flex-row justify-content-center">
                                                                        <p class="pt-3 sml-siz" style="font-size: large;">

                                                                            <a href="/profile/<?php echo $username;?>" class="text-decoration-none fst-italic" style="font-weight: 700!important;font-size: 16px;"><?php echo $fname . ' ' . $mname . ' ' . $lname . ',' . $suffix; ?></a>&nbsp&nbsp <a href="/edit-family-member/<?php echo $gender?>/<?php echo $idd;?>" class="ti-pencil text-decoration-none fw-bold mt-1"></a>
                                                                        </p>
                                                                    </div>
                                                                    <p class=""><?php echo $year_dob . '-' . $year_dod; ?></p>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <p class="pt-3 sml-siz" style="font-size: large;">
                                                                        <a href="/add-family-member/f" class="ti-plus text-decoration-none fw-bold"></a>
                                                                    </p>
                                                                    <?php
                                                                }
                                                            } else {
                                                                if ($img == "") {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/<?php echo $img; ?>" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <div class="d-flex flex-row justify-content-center">
                                                                    <p class="pt-3 sml-siz" style="font-size: large;">

                                                                    <p class="fw-bold text-decoration-none fst-italic"><?php echo $fname . ' ' . $mname . ' ' . $lname . ',' . $suffix; ?></p>&nbsp&nbsp <a href="/edit-family-member/<?php echo $gender?>/<?php echo $id;?>" class="ti-pencil text-decoration-none fw-bold mt-1"></a>
                                                                    </p>

                                                                </div>
                                                                <p class=""><?php echo $year_dob . '-' . $year_dod; ?></p>
                                                                <?php
                                                            }
                                                            //die();
                                                            ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class="">
                                                                <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                            </div>
                                                            <p class="pt-3 sml-siz" style="font-size: large;">
                                                                <div  onclick="save('grand_mother')" class="ti-plus text-decoration-none fw-bold"></div>
                                                            </p>
                                                            <?php
                                                        }
                                                        ?>
                                                        <p class="sml-siz">
                                                            <b class="fs-rel">Grandmother</b>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-3 ">
                                                    <div class="text-center">
                                                        <?php
                                                        $quesql = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '" . $user_id . "' AND `relationship` = 'grandfather' AND `gender` = 'male-mother-side' AND `parent_side_one` = '2'");
                                                        // echo "SELECT * FROM `family_member` WHERE `user_id` = '" . $user_id . "' AND `relationship` = 'father'";

                                                        if (mysqli_num_rows($quesql) > 0) {
                                                            $sqlres = mysqli_fetch_assoc($quesql);
                                                            $id = $sqlres['id'];
                                                            $selected_user_id = $sqlres['selected_user_id'];
                                                            $fname = $sqlres['firstname'];
                                                            $mname = $sqlres['middlename'];
                                                            $lname = $sqlres['lastname'];
                                                            $suffix = $sqlres['suffix'];
                                                            $gender = $sqlres['gender'];
                                                            $img  = $sqlres['image'];
                                                            $dob = $sqlres['date_of_birth'];
                                                            $year_dob = date('Y', strtotime($dob));
                                                            $dod = $sqlres['date_of_death'];
                                                            $year_dod = date('Y', strtotime($dod));
                                                            $hidden_selected_id = $sqlres['selected_user_id'];
                                                            $varify = $sqlres['varify'];
                                                            //die();
                                                            if ($selected_user_id != '') {
                                                                if ($varify == 1) {
                                                                    //$hidden_selected_id = $sqlres['selected_user_id'];
                                                                    //die();
                                                                    $selectessql = mysqli_query($con, "SELECT * FROM users WHERE `ID` = '" . $selected_user_id . "'");
                                                                    //echo "SELECT * FROM users WHERE `ID` = '".$hidden_selected_id."'";
                                                                    //die()
                                                                    $selectres = mysqli_fetch_assoc($selectessql);
                                                                    $idd = $selectres['ID'];
                                                                    $fname = $selectres['firstname'];
                                                                    $mname = $selectres['middlename'];
                                                                    $lname = $selectres['lastname'];
                                                                    $username = $selectres['username'];
                                                                    $suffix = $selectres['suffix'];
                                                                    $dob = $selectres['date_of_birth'];
                                                                    $year_dob = date('Y', strtotime($dob));
                                                                    $dod = $selectres['date_of_death'];
                                                                    $year_dod = date('Y', strtotime($dod));
                                                                    $img  = $selectres['image'];
                                                                    if ($img == "") {
                                                                        ?>
                                                                        <div class="">
                                                                            <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                        </div>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <div class="">
                                                                            <img src="/assets/profile/<?php echo $img; ?>" class="profile-image" alt="Test Test" title="Test Test">
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <div class="d-flex flex-row justify-content-center">
                                                                        <p class="pt-3 sml-siz" style="font-size: large;">

                                                                            <a href="/profile/<?php echo $username;?>" class="text-decoration-none fst-italic" style="font-weight: 700!important;font-size: 16px;"><?php echo $fname . ' ' . $mname . ' ' . $lname . ',' . $suffix; ?></a>&nbsp&nbsp <a href="/edit-family-member/<?php echo $gender?>/<?php echo $idd?>" class="ti-pencil text-decoration-none fw-bold mt-1"></a>
                                                                        </p>
                                                                    </div>
                                                                    <p class=""><?php echo $year_dob . '-' . $year_dod; ?></p>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <p class="pt-3 sml-siz" style="font-size: large;">
                                                                        <a href="/add-family-member/m" class="ti-plus text-decoration-none fw-bold"></a>
                                                                    </p>
                                                                    <?php
                                                                }
                                                            } else {
                                                                if ($img == "") {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/<?php echo $img; ?>" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <div class="d-flex flex-row justify-content-center">
                                                                    <p class="pt-3 sml-siz" style="font-size: large;">

                                                                    <p class="fw-bold text-decoration-none fst-italic"><?php echo $fname . ' ' . $mname . ' ' . $lname . ',' . $suffix; ?></p>&nbsp&nbsp <a href="/edit-family-member/<?php echo $gender?>/<?php echo $id?>" class="ti-pencil text-decoration-none fw-bold mt-1"></a>
                                                                    </p>

                                                                </div>
                                                                <p class=""><?php echo $year_dob . '-' . $year_dod; ?></p>
                                                                <?php
                                                            }
                                                            //die();
                                                            ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class="">
                                                                <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                            </div>
                                                            <p class="pt-3 sml-siz" style="font-size: large;">
                                                                <div onclick="save('grand_father')" class="ti-plus text-decoration-none fw-bold"></div>
                                                            </p>
                                                            <?php
                                                        }
                                                        ?>
                                                        <p class="sml-siz">
                                                            <b class="fs-rel">Grandfather</b>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-3 ">
                                                    <div class="text-center">
                                                        <!-- <div class="">
                                                            <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                        </div> -->
                                                        <?php
                                                        $quesql = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '" . $user_id . "' AND `relationship` = 'grandmother' AND `gender` = 'female-mother-side' AND `parent_side_one` = '2'");
                                                        // echo "SELECT * FROM `family_member` WHERE `user_id` = '" . $user_id . "' AND `relationship` = 'father'";

                                                        if (mysqli_num_rows($quesql) > 0) {
                                                            $sqlres = mysqli_fetch_assoc($quesql);
                                                            $id = $sqlres['id'];
                                                            $selected_user_id = $sqlres['selected_user_id'];
                                                            $fname = $sqlres['firstname'];
                                                            $mname = $sqlres['middlename'];
                                                            $lname = $sqlres['lastname'];
                                                            $suffix = $sqlres['suffix'];
                                                            $gender = $sqlres['gender'];
                                                            $img  = $sqlres['image'];
                                                            $dob = $sqlres['date_of_birth'];
                                                            $year_dob = date('Y', strtotime($dob));
                                                            $dod = $sqlres['date_of_death'];
                                                            $year_dod = date('Y', strtotime($dod));
                                                            $hidden_selected_id = $sqlres['selected_user_id'];
                                                            $varify = $sqlres['varify'];
                                                            //die();
                                                            if ($selected_user_id != '') {
                                                                if ($varify == 1) {
                                                                    $hidden_selected_id = $sqlres['selected_user_id'];
                                                                    //die();
                                                                    $selectessql = mysqli_query($con, "SELECT * FROM users WHERE `ID` = '" . $selected_user_id . "'");
                                                                    //echo "SELECT * FROM users WHERE `ID` = '".$hidden_selected_id."'";
                                                                    //die()
                                                                    $selectres = mysqli_fetch_assoc($selectessql);
                                                                    $idd = $selectres['ID'];
                                                                    $fname = $selectres['firstname'];
                                                                    $mname = $selectres['middlename'];
                                                                    $lname = $selectres['lastname'];
                                                                    $suffix = $selectres['suffix'];
                                                                    $username = $selectres['username'];
                                                                    $dob = $selectres['date_of_birth'];
                                                                    $year_dob = date('Y', strtotime($dob));
                                                                    $dod = $selectres['date_of_death'];
                                                                    $year_dod = date('Y', strtotime($dod));
                                                                    $img  = $selectres['image'];
                                                                    if ($img == "") {
                                                                        ?>

                                                                        <div class="">
                                                                            <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                        </div>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <div class="">
                                                                            <img src="/assets/profile/<?php echo $img; ?>" class="profile-image" alt="Test Test" title="Test Test">
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <div class="d-flex flex-row justify-content-center">
                                                                        <p class="pt-3 sml-siz" style="font-size: large;">

                                                                            <a href="/profile/<?php echo $username;?>" class="text-decoration-none fst-italic" style="font-weight: 700!important;font-size: 16px;"><?php echo $fname . ' ' . $mname . ' ' . $lname . ',' . $suffix; ?></a>&nbsp&nbsp <a href="/edit-family-member/<?php echo $gender?>/<?php echo $idd?>" class="ti-pencil text-decoration-none fw-bold mt-1"></a>
                                                                        </p>
                                                                    </div>
                                                                    <p class=""><?php echo $year_dob . '-' . $year_dod; ?></p>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <p class="pt-3 sml-siz" style="font-size: large;">
                                                                        <a href="/add-family-member/f" class="ti-plus text-decoration-none fw-bold"></a>
                                                                    </p>
                                                                    <?php
                                                                }
                                                            } else {
                                                                if ($img == "") {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/<?php echo $img; ?>" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <div class="d-flex flex-row justify-content-center">
                                                                    <p class="pt-3 sml-siz" style="font-size: large;">

                                                                    <p class="fw-bold text-decoration-none fst-italic"><?php echo $fname . ' ' . $mname . ' ' . $lname . ',' . $suffix; ?></p>&nbsp&nbsp <a href="/edit-family-member/<?php echo $gender?>/<?php echo $id?>" class="ti-pencil text-decoration-none fw-bold mt-1"></a>
                                                                    </p>

                                                                </div>
                                                                <p class=""><?php echo $year_dob . '-' . $year_dod; ?></p>
                                                                <?php
                                                            }
                                                            //die();
                                                            ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class="">
                                                                <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                            </div>
                                                            <p class="pt-3 sml-siz" style="font-size: large;">
                                                                <div  onclick="save('grand_mother')" class="ti-plus text-decoration-none fw-bold"></div>
                                                            </p>
                                                            <?php
                                                        }
                                                        ?>
                                                        <p class="sml-siz" >
                                                            <b class="fs-rel">Grandmother</b>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row second-row ">
                                                <div class="col-6 text-center mar-laf">
                                                    <div class="">
                                                        <?php
                                                        $quesql = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '" . $user_id . "' AND `relationship` = 'father'");
                                                        // echo "SELECT * FROM `family_member` WHERE `user_id` = '" . $user_id . "' AND `relationship` = 'father'";

                                                        if (mysqli_num_rows($quesql) > 0) {
                                                            $sqlres = mysqli_fetch_assoc($quesql);
                                                            $id = $sqlres['id'];
                                                            $selected_user_id = $sqlres['selected_user_id'];
                                                            $fname = $sqlres['firstname'];
                                                            $mname = $sqlres['middlename'];
                                                            $lname = $sqlres['lastname'];
                                                            $suffix = $sqlres['suffix'];
                                                            $img  = $sqlres['image'];
                                                            $gender = $sqlres['gender'];
                                                            $dob = $sqlres['date_of_birth'];
                                                            $year_dob = date('Y', strtotime($dob));
                                                            $dod = $sqlres['date_of_death'];
                                                            $year_dod = date('Y', strtotime($dod));
                                                            $hidden_selected_id = $sqlres['selected_user_id'];
                                                            $varify = $sqlres['varify'];
                                                            //die();
                                                            if ($selected_user_id != '') {
                                                                if ($varify == 1) {
                                                                    $hidden_selected_id = $sqlres['selected_user_id'];
                                                                    //die();
                                                                    $selectessql = mysqli_query($con, "SELECT * FROM users WHERE `ID` = '" . $selected_user_id . "'");
                                                                    //echo "SELECT * FROM users WHERE `ID` = '".$hidden_selected_id."'";
                                                                    //die()
                                                                    $selectres = mysqli_fetch_assoc($selectessql);
                                                                    $idd = $selectres['ID'];
                                                                    $fname = $selectres['firstname'];
                                                                    $mname = $selectres['middlename'];
                                                                    $lname = $selectres['lastname'];
                                                                    $username = $selectres['username'];
                                                                    $suffix = $selectres['suffix'];
                                                                    $dob = $selectres['date_of_birth'];
                                                                    $year_dob = date('Y', strtotime($dob));
                                                                    $dod = $selectres['date_of_death'];
                                                                    $year_dod = date('Y', strtotime($dod));
                                                                    $img  = $selectres['image'];
                                                                    if ($img == "") {
                                                                        ?>
                                                                        <div class="">
                                                                            <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                        </div>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <div class="">
                                                                            <img src="/assets/profile/<?php echo $img; ?>" class="profile-image" alt="Test Test" title="Test Test">
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <div class="d-flex flex-row justify-content-center">
                                                                        <p class="pt-3 sml-siz" style="font-size: large;">

                                                                        <a href="/profile/<?php echo $username;?>" class="text-decoration-none fst-italic" style="font-weight: 700!important;font-size: 16px;"><?php echo $fname . ' ' . $mname . ' ' . $lname . ',' . $suffix; ?></a>&nbsp&nbsp <a href="/edit-family-member/<?php echo $gender?>/<?php echo $idd?>" class="ti-pencil text-decoration-none fw-bold mt-1"></a>
                                                                        </p>
                                                                    </div>
                                                                    <p class=""><?php echo $year_dob . '-' . $year_dod; ?></p>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <p class="pt-3 sml-siz" style="font-size: large;">
                                                                        <a href="/add-family-member/m" class="ti-plus text-decoration-none fw-bold"></a>
                                                                    </p>
                                                                    <?php
                                                                }
                                                            } else {
                                                                if ($img == "") {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/<?php echo $img; ?>" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <div class="d-flex flex-row justify-content-center">
                                                                    <p class="pt-3 sml-siz" style="font-size: large;">

                                                                    <p class="fw-bold text-decoration-none fst-italic"><?php echo $fname . ' ' . $mname . ' ' . $lname . ',' . $suffix; ?></p>&nbsp&nbsp <a href="/edit-family-member/<?php echo $gender?>/<?php echo $id?>" class="ti-pencil text-decoration-none fw-bold mt-1"></a>
                                                                    </p>

                                                                </div>
                                                                <p class=""><?php echo $year_dob . '-' . $year_dod; ?></p>
                                                                <?php
                                                            }
                                                            //die();
                                                            ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class=""  >
                                                                <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                            </div>
                                                            <p class="pt-3 sml-siz" style="font-size: large;">
                                                                <div onclick="save('father')" class="ti-plus text-decoration-none fw-bold"></div>
                                                            </p>
                                                            <?php
                                                        }
                                                        ?>
                                                        <p class=" sml-siz">
                                                            <b class="fs-rel" >Father</b>

                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-6 text-center mar-rig">
                                                    <div class="">
                                                        <?php
                                                        $quesql = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '" . $user_id . "' AND `relationship` = 'mother'");
                                                        // echo "SELECT * FROM `family_member` WHERE `user_id` = '" . $user_id . "' AND `relationship` = 'father'";
                                                        if (mysqli_num_rows($quesql) > 0) {
                                                            $sqlres = mysqli_fetch_assoc($quesql);
                                                            $selected_user_id = $sqlres['selected_user_id'];
                                                            $id = $sqlres['id'];
                                                            $fname = $sqlres['firstname'];
                                                            $mname = $sqlres['middlename'];
                                                            $lname = $sqlres['lastname'];
                                                            $suffix = $sqlres['suffix'];
                                                            $gender = $sqlres['gender'];
                                                            $img  = $sqlres['image'];
                                                            $dob = $sqlres['date_of_birth'];
                                                            $year_dob = date('Y', strtotime($dob));
                                                            $dod = $sqlres['date_of_death'];
                                                            $year_dod = date('Y', strtotime($dod));
                                                            $hidden_selected_id = $sqlres['selected_user_id'];
                                                            $varify = $sqlres['varify'];
                                                            //die();
                                                            if ($selected_user_id != '') {
                                                                if ($varify == 1) {
                                                                    //$hidden_selected_id = $sqlres['selected_user_id'];
                                                                    //die();
                                                                    $selectessql = mysqli_query($con, "SELECT * FROM users WHERE `ID` = '" . $selected_user_id . "'");
                                                                    //echo "SELECT * FROM users WHERE `ID` = '".$hidden_selected_id."'";
                                                                    //die()
                                                                    $selectres = mysqli_fetch_assoc($selectessql);
                                                                    $idd = $selectres['ID'];
                                                                    $fname = $selectres['firstname'];
                                                                    $mname = $selectres['middlename'];
                                                                    $lname = $selectres['lastname'];
                                                                    $username = $selectres['username'];
                                                                    $suffix = $selectres['suffix'];
                                                                    $dob = $selectres['date_of_birth'];
                                                                    $year_dob = date('Y', strtotime($dob));
                                                                    $dod = $selectres['date_of_death'];
                                                                    $year_dod = date('Y', strtotime($dod));
                                                                    $img  = $selectres['image'];
                                                                    if ($img == "") {
                                                                        ?>
                                                                        <div class="">
                                                                            <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                        </div>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <div class="">
                                                                            <img src="/assets/profile/<?php echo $img; ?>" class="profile-image" alt="Test Test" title="Test Test">
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <div class="d-flex flex-row justify-content-center">
                                                                        <p class="pt-3 sml-siz" style="font-size: large;">

                                                                        <a href="/profile/<?php echo $username;?>" class="text-decoration-none fst-italic" style="font-weight: 700!important;font-size: 16px;"><?php echo $fname . ' ' . $mname . ' ' . $lname . ',' . $suffix; ?></a>&nbsp&nbsp <a href="/edit-family-member/<?php echo $gender?>/<?php echo $idd?>" class="ti-pencil text-decoration-none fw-bold mt-1"></a>
                                                                        </p>
                                                                    </div>
                                                                    <p class=""><?php echo $year_dob . '-' . $year_dod; ?></p>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <p class="pt-3 sml-siz" style="font-size: large;">
                                                                        <a href="/add-family-member/f" class="ti-plus text-decoration-none fw-bold"></a>
                                                                    </p>
                                                                    <?php
                                                                }
                                                            } else {
                                                                if ($img == "") {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/<?php echo $img; ?>" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <div class="d-flex flex-row justify-content-center">
                                                                    <p class="pt-3 sml-siz" style="font-size: large;">

                                                                    <p class="fw-bold text-decoration-none fst-italic"><?php echo $fname . ' ' . $mname . ' ' . $lname . ',' . $suffix; ?></p>&nbsp&nbsp <a href="/edit-family-member/<?php echo $gender?>/<?php echo $id?>" class="ti-pencil text-decoration-none fw-bold mt-1"></a>
                                                                    </p>

                                                                </div>
                                                                <p class=""><?php echo $year_dob . '-' . $year_dod; ?></p>
                                                                <?php
                                                            }
                                                            //die();
                                                            ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class="" >
                                                                <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                            </div>
                                                            <p class="pt-3 sml-siz" style="font-size: large;">
                                                                <div onclick="save('mother')" class="ti-plus text-decoration-none fw-bold"></div>
                                                            </p>
                                                            <?php
                                                        }
                                                        ?>
                                                        <p class=" sml-siz">
                                                            <b class="fs-rel">Mother</b>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row center " style="padding-top: 50px;">
                                                <div class="col-12 ">
                                                    <div class="text-center">
                                                        <div class="">
                                                            <?php
                                                            if ($image != '') {
                                                                ?>
                                                                <img src="/assets/profile/<?php echo $image; ?>" class="profile-image" alt="Test Test" title="Test Test">
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
                                                            <a href="/profile/<?php echo $username?>" class="fw-bold text-decoration-none fst-italic fs-rel"><?php echo $firstname; ?> <?php echo $lastname; ?></a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-5">
                                            <div class="link-text col-xs-12">
                                                <a class="" href="/add-family-member/">
                                                    <i class="ti-plus"></i> &nbsp;Add a Child, Sibling or other Family Member </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" row pt-4 text-black">
                        <div class=" col-md-12 ">
                            <div class="p-4 edit-profile-border">
                                <div class="row text">
                                    <div class="col-md-12 hr-div">
                                        <h3 class="pt-3">Siblings & Family Members</h3>
                                    </div>
                                    <div class="hr-div">
                                        <hr>
                                    </div>
                                    <div class="row cent">
                                        <?php
                                        $quesql = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` IN ('brother','sister','cousin','aunt',
                                            'uncle','brother-in-law','daughter','daughter-in-law', 'ex-husband','ex-wife', 'father-in-law', 'granddaughter','grandson','great aunt','great grand aunt',
                                            'great grand nephew', 'great grand niece','great grand uncle','great nephew','great niece','great uncle','great-grand-daughter','great-grandfather',
                                            'great-grandmother','great-grandson','great-great-granddaughter','great-great-grandfather','great-great-grandfather', 'great-great-grandmother',
                                            'great-great-grandson','husband','mother-in-law','nephew','niece','significant other','sister-in-law', 'son','son-in-law','step-aunt','step-brother',
                                            'step-cousin','step-daughter','step-father','step-granddaughter','step-grandfather', 'step-grandmother','step-grandson','step-great-granddaughter',
                                            'step-great-grandfather','step-great-grandmother','step-great-grandson', 'step-great-great-granddaughter','step-great-great-grandfather',
                                            'step-great-great-grandmother','step-great-great-grandson','step-mother', 'step-nephew','step-niece','step-sister','step-son','step-uncle',
                                            'wife','parent','sibling','grandparent','parents','sibling','sibling-in-law', 'ex-spouse/partner','parent-in-law','grandchild','sibling’s great grandchild',
                                            'great-grandparents sibiling','sibling’s grandchild','grandparents sibiling', 'great-grandparent','great-grandchild','great-great-grandparent','great-great-grandchild',
                                            'spouse/partner','siblings child','significant other', 'child','child-in-law','step-sibling','step-cousin','step-grandparent','step-grandchild',
                                            'step-great-grandparent','step-great-grandchild', 'step-great-great-grandparent','step-great-great-grandchild','step-siblings child','step-child',
                                            'step-parents sibling') AND (gender = 'o' OR gender = 'm' OR gender = 'f')");
                                        //echo "SELECT * FROM family_member WHERE user_id = '15' AND `He-is-your` = 'brother'  AND (gender = 'o' OR gender = 'm' OR gender = 'f')";
                                        if (mysqli_num_rows($quesql) > 0) {
                                            while ($sqlres = mysqli_fetch_assoc($quesql)) {
                                                $id = $sqlres['id'];
                                                $fname = $sqlres['firstname'];
                                                $mname = $sqlres['middlename'];
                                                $lname = $sqlres['lastname'];
                                                $suffix = $sqlres['suffix'];
                                                $img = $sqlres['image'];
                                                $varify = $sqlres['varify'];
                                                $gender = $sqlres['gender'];
                                                $dob = $selectres['date_of_birth'];
                                                $year_dob = date('Y', strtotime($dob));
                                                $dod = $selectres['date_of_death'];
                                                $year_dod = date('Y', strtotime($dod));
                                                $Theyareyour = $sqlres['relationship'];
                                                $hidden_selected_id = $sqlres['selected_user_id'];
                                                ?>
                                                <div class="col-md-3">
                                                    <?php
                                                    //die();
                                                    if ($hidden_selected_id != '') {

                                                        if ($varify == '1') {

                                                            $hidden_selected_id = $sqlres['selected_user_id'];
                                                            //die();
                                                            $selectessql = mysqli_query($con, "SELECT * FROM users WHERE `ID` = '" . $hidden_selected_id . "'");
                                                            //echo "SELECT * FROM users WHERE `ID` = '".$hidden_selected_id."'";
                                                            //die()
                                                            while ($selectres = mysqli_fetch_assoc($selectessql)) {
                                                                $idd = $selectres['ID'];
                                                                $fname = $selectres['firstname'];
                                                                $mname = $selectres['middlename'];
                                                                $lname = $selectres['lastname'];
                                                                $username = $selectres['username'];
                                                                $suffix = $selectres['suffix'];
                                                                $img  = $selectres['image'];
                                                                $gender = $selectres['gender'];
                                                                if ($gender == 'male') {
                                                                    $gender = 'm';
                                                                } else if ($gender == 'female') {
                                                                    $gender = 'f';
                                                                } else {
                                                                    $gender = 'o';
                                                                }
                                                                if ($img == "") {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="">
                                                                        <img src="/assets/profile/<?php echo $img; ?>" class="profile-image" alt="Test Test" title="Test Test">
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <div class="d-flex flex-row justify-content-center">
                                                                    <p class="pt-3 sml-siz" style="font-size: large;">

                                                                        <a href="/profile/<?php echo $username;?>" class="text-decoration-none fst-italic" style="font-weight: 700!important;font-size: 16px;"><?php echo $fname . ' ' . $mname . ' ' . $lname . ',' . $suffix; ?></a>&nbsp&nbsp <a href="/edit-family-member/<?php echo $gender?>/<?php echo $idd?>" class="ti-pencil text-decoration-none fw-bold mt-1"></a>

                                                                    </p>
                                                                </div>
                                                                <p class="" style="margin-top: -18px;"><?php echo $year_dob . '-' . $year_dod; ?></p>
                                                                <p class="" style="margin-top: -24px;">
                                                                    <b class="fs-rel"><?php echo $Theyareyour ?>
                                                                    </b>
                                                                </p>
                                                                <?php
                                                            }
                                                        }
                                                    } else {
                                                        if ($img == "") {
                                                            ?>
                                                            <div class="">
                                                                <img src="/assets/profile/profile-default-photo-300x300.png" class="profile-image" alt="Test Test" title="Test Test">
                                                            </div>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class="">
                                                                <img src="/assets/profile/<?php echo $img; ?>" class="profile-image" alt="Test Test" title="Test Test">
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                        <div class="d-flex flex-row justify-content-center">
                                                            <p class="pt-3 sml-siz" style="font-size: large;">

                                                            <p class="fw-bold text-decoration-none fst-italic"><?php echo $fname . ' ' . $mname . ' ' . $lname . ',' . $suffix; ?></p>&nbsp&nbsp <a href="/edit-family-member/<?php echo $gender?>/<?php echo $id?>" class="ti-pencil text-decoration-none fw-bold mt-1"></a>

                                                            </p>
                                                        </div>
                                                        <p class="" style="margin-bottom: 6px ;margin-top: -14px;"><?php echo $year_dob . '-' . $year_dod; ?></p>
                                                        <p class="" style="margin-top: -14px;">
                                                            <b class="fs-rel"><?php echo $Theyareyour ?></b>
                                                        </p>
                                                        <?php
                                                    }
                                                    //die();
                                                    ?>
                                                </div>
                                                <?php
                                            }
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
<script>
    function save(name) {
     //   alert('clicked on '+name);

        localStorage.setItem('member_name',name)
        if(name === "grand_mother"){
            window.location.href = "/add-family-member/f";
        }else if (name === "mother") {
            window.location.href = "/add-family-member/f";
        }else{
            window.location.href = "/add-family-member/m";
        }

    }
</script>
</html>
