<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

// if(!$_SESSION['user_id']){
//     header("location: /login");
// }
//$keeper_id = $_GET['ID'];

// if(isset($_GET['ID'])){

//     $_SESSION['user_id'] = $_GET['ID'];
// }
// $user_id = $_SESSION['user_id'];
//die();
$username = $_GET['username'];
$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
$exe = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($exe);

$user_id = $fetch['ID'];
$firstname = $fetch['firstname'];
$username = $fetch['username'];
$middlename = $fetch['middlename'];
$lastname = $fetch['lastname'];
$suffix = $fetch['suffix'];
$dob = $fetch['date_of_birth'];
$formatted_dob = date("F jS, Y", strtotime($dob));


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $firstname . " " . $lastname . " "?> - Tribute Keeper </title>
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link rel="stylesheet" href="/assets/js/script.js" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/themify-icons.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
</head>

<body>

    <?php

        require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/subheader.php';

    ?>

    <section class="h-100 gradient-custom-2" style="margin-top:-40px!important;">
        
        <div class="container py-5 h-100">
            <div class="row ">
                <div class="">
                    <div class="card">
                        
                        <div class=" row pt-4 text-black mt-4">
                            <div class="mb-3 col-md-9 ">
                                <div class="p-4 mb-3 about-sect ">
                                    <div class="row">
                                        <div class=" ">
                                            <div class="p-4 ">
                                                <div class="row ">
                                                    <div class="col-md-12">
                                                        <h3 class=""> About</h3>
                                                    </div>
                                                    <div class="">
                                                        <hr>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="col-md-2 p-2 disp-block tofi">
                                                            <div class="about-sec-larg-icon">
                                                                <div class="ti-user blue"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10 wid">
                                                            <div class="pt-tp">
                                                                <div class="about-borser-bottom">
                                                                    <div class="d-flex py-2">
                                                                        <table>
                                                                            <tr class="about-borser">
                                                                                <td class="about-borser-td-1">Name</td>
                                                                                <td class="about-borser-td-2">
                                                                                    <?php
                                                                                    echo $firstname . " ";
                                                                                    if (!empty($middlename)) {
                                                                                        echo "$middlename";
                                                                                    }
                                                                                    echo " " . $lastname . " ";
                                                                                    if (!empty($suffix)) {
                                                                                        echo "$suffix";
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                        </table>


                                                                    </div>
                                                                </div>
                                                                <div class="about-borser-bottom">
                                                                    <div class="d-flex py-2">
                                                                        <table>
                                                                            <tr class="about-borser">
                                                                                <td class="about-borser-td-1"> Date of
                                                                                    Birth</td>
                                                                                <td class="about-borser-td-2">
                                                                                    <?php echo $formatted_dob; ?>
                                                                                </td>
                                                                            </tr>
                                                                        </table>

                                                                    </div>
                                                                </div>



                                                                <?php
                                                                $sql3 = "SELECT * FROM `home_town` WHERE user_id = $user_id";
                                                                $exe3 = mysqli_query($con, $sql3);
                                                                $fetch3 = mysqli_fetch_assoc($exe3);
                                                                $home_town_city_name = $fetch3['city_name'];



                                                                if (!empty($home_town_city_name)) {
                                                                    echo "<div class='about-borser-bottom'>
                                                                    <div class='d-flex py-2'>
                                                                        <table>
                                                                            <tr class='about-borser'>
                                                                                <td class='about-borser-td-1'>Home Town </td>
                                                                                <td class='about-borser-td-2'> <a href='#'>$home_town_city_name</a>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        
                                                                    </div>
                                                                </div>";
                                                                }
                                                                ?>








                                                                <?php
                                                                $sql4 = "SELECT * FROM `other_city` WHERE user_id = $user_id";
                                                                $exe4 = mysqli_query($con, $sql4);
                                                                $fetch4 = mysqli_fetch_assoc($exe4);
                                                                $other_city_name = $fetch4['city_name'];



                                                                if (!empty($other_city_name)) {
                                                                    echo "<div class='about-borser-bottom'>
                                                                    <div class='d-flex py-2'>
                                                                        <table>
                                                                            <tr class='about-borser'>
                                                                                <td class='about-borser-td-1'>Other City
                                                                                </td>
                                                                                <td class='about-borser-td-2'><a
                                                                                        href='#'>$other_city_name</a>
                                                                                </td>

                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>";
                                                                }
                                                                ?>

                                                                <?php
                                                                $sql1 = "SELECT * FROM `interests` WHERE user_id=$user_id";
                                                                $exe1 = mysqli_query($con, $sql1);
                                                                $interests = array();
                                                                while ($row = mysqli_fetch_assoc($exe1)) {
                                                                    $interests[] = $row['interest_name'];
                                                                }
                                                                $interests_count = count($interests);
                                                                if ($interests_count > 0) {
                                                                    echo "<div class='about-borser-bottom'>
                                                                    <div class='d-flex py-2'>
                                                                        <table>
                                                                            <tr class='about-borser'>
                                                                                <td class='about-borser-td-1'>Interests</td>
                                                                                <td class='about-borser-td-2'>";
                                                                    for ($i = 0; $i < $interests_count; $i++) {
                                                                        echo $interests[$i];
                                                                        if ($i < $interests_count - 1) {
                                                                            echo ", ";
                                                                        }
                                                                    }
                                                                    echo "
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </div>";
                                                                }
                                                                ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="">
                                            <div class="p-4 ">
                                                <div class="row ">
                                                    <div
                                                        class="col-md-12">
                                                        <h3 class="">Milestones</h3>
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
                                                            <div class="pt-tp">
                                                                <?php
                                                                $sql2 = "SELECT * FROM `academic_history` WHERE user_id = $user_id";
                                                                $exe = mysqli_query($con, $sql2);
                                                                while ($fetch2 = mysqli_fetch_assoc($exe)) {
                                                                    $diploma = $fetch2['diploma'];
                                                                    $school = $fetch2['school'];
                                                                    $from_year = $fetch2['from_year'];
                                                                    $to_year = $fetch2['to_year'];
                                                                    echo "<div class='about-borser-bottom'>
                                                                            <div class='d-flex py-2'>
                                                                            <table><tr class='about-borser'>
                                                                                        <td class='about-borser-td-1' >$from_year - $to_year</td>
                                                                                        <td class='about-borser-td-2'>$school , $diploma</td>
                                                                                    </tr>
                                                                                    </table>
                                                                                    </div>
                                                                                    </div>";
                                                                }
                                                                ?>

                                                                <?php
                                                                $sql2 = "SELECT * FROM `occupation` WHERE user_id = $user_id";
                                                                $exe = mysqli_query($con, $sql2);
                                                                while ($fetch2 = mysqli_fetch_assoc($exe)) {
                                                                    $occupation = $fetch2['occupation'];
                                                                    $company = $fetch2['company'];
                                                                    $from_year = $fetch2['from_year'];
                                                                    $to_year = $fetch2['to_year'];
                                                                    echo "<div class='about-borser-bottom'>
                                                                            <div class='d-flex py-2'>
                                                                            <table><tr class='about-borser'>
                                                                                        <td class='about-borser-td-1'>$from_year - $to_year</td>
                                                                                        <td class='about-borser-td-2'>$company , $occupation</td>
                                                                                    </tr>
                                                                                    </table>
                                                                                    </div>
                                                                                    </div>";
                                                                }
                                                                ?>

                                                                <?php
                                                                $sql2 = "SELECT * FROM `milestones` WHERE user_id = $user_id";
                                                                $exe = mysqli_query($con, $sql2);
                                                                while ($fetch2 = mysqli_fetch_assoc($exe)) {
                                                                    $description = $fetch2['description'];
                                                                    $year = $fetch2['year'];
                                                                    echo "<div class='about-borser-bottom'>
                                                                            <div class='d-flex py-2'>
                                                                            <table><tr class='about-borser'>
                                                                                        <td class='about-borser-td-1'>$year</td>
                                                                                        <td class='about-borser-td-2'>$description</td>
                                                                                    </tr>
                                                                                    </table>
                                                                                    </div>
                                                                                    </div>";
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">

                                        <?php

                                            if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){

                                                ?>

                                                    <a class="mx-4 prof-button" href="/edit_profile/<?php print( $username ) ?>" style="text-decoration: none; color: white"> 
                                                        <i class='ti-pencil p-1'></i> Edit Profile
                                                    </a>

                                                <?php

                                            }

                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 p-3 main-about-colom-2">
                                <div class="">
                                    <h3 class="p-2 blue">Memorials</h3>
                                </div>
                                <div class="profile d-flex">
                                    <img src="/assets/imaages/istockphoto-1077577946-612x612.jpg"
                                        alt="My Profile Picture">
                                    <div class="px-3  profile-text">
                                        <h5>Olivia</h5>
                                    </div>
                                </div>
                                <div class="profile d-flex">
                                    <img src="/assets/imaages/istockphoto-1356078552-612x612.jpg"
                                        alt="My Profile Picture">
                                    <div class="px-3 profile-text">
                                        <h5>Emma</h5>
                                    </div>
                                </div>
                                <div class="profile d-flex">
                                    <img src="/assets/imaages/istockphoto-1473103874-612x612.jpg"
                                        alt="My Profile Picture">
                                    <div class="px-3 profile-text">
                                        <h5>Charlotte</h5>
                                    </div>
                                </div>
                                <div class="profile d-flex">
                                    <img src="/assets/imaages/istockphoto-577659332-612x612.jpg"
                                        alt="My Profile Picture">
                                    <div class="px-3 profile-text">
                                        <h5>Isabella</h5>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>