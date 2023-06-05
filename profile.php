<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

if (!empty($_SESSION['user_id'])) {
    // header("location: /login");



    $log_uid = $_SESSION['user_id'];

    $sql_log = "SELECT * FROM `users` WHERE `id` = '$log_uid'";
    $exe_log = mysqli_query($con, $sql_log);
    $fetch_log = mysqli_fetch_assoc($exe_log);
    $log_uname = $fetch_log['username'];
    $log_mem = $fetch_log['membership'];
    $log_fname = $fetch_log['firstname'];
    $log_mname = $fetch_log['middlename'];
    $log_lname = $fetch_log['lastname'];
}
// $keeper_id = $_GET['ID'];

// if(isset($_GET['ID'])){

//     $_SESSION['user_id'] = $_GET['ID'];
// }
// $user_id = $_SESSION['user_id'];
// die();

$username = $_GET['username'];
$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
$exe = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($exe);

$user_id = $fetch['ID'];
$firstname = $fetch['firstname'];
$username = $fetch['username'];
$middlename = $fetch['middlename'];
$lastname = $fetch['lastname'];
$mem = $fetch['membership'];
$suffix = $fetch['suffix'];
$type = $fetch['type'];
$dob = $fetch['date_of_birth'];
$formatted_dob = date("F jS, Y", strtotime($dob));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $firstname . " " . $lastname . " " ?> - Tribute Keeper </title>
    <link rel="stylesheet" href="/assets/css/style.css" />
    <script src="/assets/js/script.js" ></script>
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/themify-icons.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <style>
        @media screen and(max-width: 430px) {
            .smal-width {
                width: 95%;
            }

        }

        @media screen and(max-width: 400px) {
            .smal-width {
                width: 90%;
            }

        }

        @media screen and(max-width: 375px) {
            .smal-width {
                width: 85%;
            }

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
            
                <div class="">
                    <div class="card">
                        <div class=" row pt-4 text-black mt-4">
                            <div class="mb-3 col-md-9 main-about-colom-1">
                                <div class="p-4 mb-3 about-sect ">
                                    <div class="row">

                                        <div class="p-4 ">
                                            <div class="row">
                                                <div class="col-md-12  d-flex justify-content-right align-items-right h-100">
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
                                    <div class="row ">

                                        <div class="p-4 ">
                                            <div class="row">
                                                <div class="col-md-12  ">
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
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal-r">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <p>Thank you for your submission. Replys must be reviewed by  administrator befor it is published.</p>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" id="modalOKButton-r">OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="myModal">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <p>Thank you for your submission. Tributes must be reviewed by site administrator befor it is published.</p>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" id="modalOKButton">OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="u_id" name="u_id" value="<?= $user_id ?>">
                                    <div class="p-4">
                                        <div class="row comment-div">
                                            <?php if ($type == 2) {

                                            $sqlkl = "SELECT * FROM `keepers` WHERE `kepper_ids` = $user_id";
                                               //echo "SELECT * FROM `keepers` WHERE `kepper_ids` = $user_id";

                                               $exel = mysqli_query($con, $sqlkl);
                                               while ($fetchk = mysqli_fetch_assoc($exel)) {
                                                $k_id = $fetchk['user_id'];
                                                
                                               
                                                echo '
                                                    <div class="col-md-12  d-flex flex-row">
                                                        <h3 class="">Tributes</h3>';


                                      
                                                        if($k_id==$_SESSION['user_id']){
                                                                      echo '<a href="/tributes_approval/' . $username . '" class="prof-button text-white text-decoration-none ms-auto">Pending Tributes Approval</a>';
                                                                    }
                                                   echo '</div>';
                                               
                                            }
                                                echo '<div class="">
                                                        <hr>
                                                    </div>
                                                    <div class="d-flex" >
                                                       
                                                        
                                                        <div class="col-md-12">
                                                            <div class="" >
                                                                <div id="comments" class="smal-width"></div>
                                                                
                                                        
                                                                <form method="POST" id="commentForm"  enctype="multipart/form-data" >';
                                                echo '<div class="col-md-12 pt-4 ">
                                                                                    <h3 class="">New Tributes</h3>
                                                                                </div>
                                                                                <div class="">
                                                                                    <hr>
                                                                                </div><input type="hidden" id="u_id" name="u_id" value="'. $user_id .'">';
                                                if (empty($_SESSION['user_id'])) {
                                                    echo '<label for="name" >Name:</label><br>
                                                                                <input type="text" id="name" name="name" required><br><br></div>';
                                                } else {
                                                    echo '<input type="hidden" id="name" name="name" value="' . $log_fname . ' ' . $log_mname . ' ' . $log_lname . '" required>
                                                                                <input type="hidden" id="log_uid" name="log_uid" value="' . $_SESSION['user_id'] . '" required><br><br>';
                                                }


                                                echo '<label for="comment">Tribute:</label><br>
                                                                    <textarea id="comment" name="comment" rows="6" style="width:100%; border:1px solid #ced4da; border-radius:7px;" required></textarea><br><br>
                                                                    
                                                                    <h5 class="text-left " style=" margin-top:-10px;"> Upload Image </h5>
                                                                    <input type="file" style="margin-top:10px;" accept="image/*"  name="image" /><br>
                                                                    <button type="submit" class="prof-button" style=" margin-top:20px;">Submit</button>
                                                                  </form>
                                                            </div>
                                                    </div>
                                            </div>
                                    ';
                                            }
                                            ?>
                                               </div>
                                         
                                        <div class="">

                                            <?php

                                            if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && $user_id == $_SESSION['user_id']) {

                                            ?>

                                                <a class=" prof-button" href="/edit_profile/<?php print($username) ?>" style="text-decoration: none; color: white">
                                                    <i class='ti-pencil p-1'></i> Edit Profile
                                                </a>

                                            <?php

                                            }

                                            ?>

                                       
                                </div>

                            </div>
                            
                    
                            </div>

</div>
                            <div class="col-md-3">

                                <?php

                                if ($mem == 2 && $user_id != $_SESSION['user_id']) {
                                } else {
                                ?>
                                    <div class="p-3 main-about-colom-2">
                                        <div class="">
                                            <h3 class="p-2 blue">Mementos</h3>
                                        </div>
                                        <?php  $mementose_pictures = $connect->prepare("SELECT  * FROM `mementose_pictures`  WHERE `user_id` = $user_id  ORDER BY `ID` DESC LIMIT 9");

                                            $mementose_pictures->execute();
                                            $mementose_pictures_response = $mementose_pictures->get_result();
                                             if ($mem == 1) {



                                            echo '<div class="row px-2">';



                                           
                                            if ($mementose_pictures_response->num_rows > 0) {

                                                while ($mementose_pictures_fetch = $mementose_pictures_response->fetch_assoc()) {



                                                    echo '<div class="col-3  my-1 px-1">
                                                     <div  style="background: url(/uploads/' . $mementose_pictures_fetch['image_path'] . ' ); background-position-x: center; background-position-y: center; background-repeat: no-repeat; background-size: cover; width: 100%; height: 51px; border-radius: 5px; cursor: pointer"></div>
                                                 </div>';
                                                }
                                            } 

                                            echo '</div>';
                                        } 
                                        elseif ($mem == 1 && $mementose_pictures_response->num_rows ==0 ){



                                            echo '<div class="col-12">
                                             <p class="py-5 my-5 text-center"> No Mementos Found</p>
                                         </div>';
                                        }

                                        ?>

                                        <div class=" my-2">

                                            <?php

                                            if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && $user_id == $_SESSION['user_id']) {

                                            ?>
                                                <?php if ($mem == 2) { ?>
                                                    <div class="col-12">
                                                 <p class="py-2 text-center"> View all images and videos in a gallery and download your own personal copy when this account upgrades to Keeper Plus.</p>
                                             </div>
                                                    <div class="">
                                                        <button class="m-1 prof-button ">
                                                            <a href="/payment" style="text-decoration: none;color: white"> Upgrade to Keeper Plus </a>
                                                        </button>
                                                        <br>
                                                    </div>
                                                <?php } ?>
                                                <a href='/edit/mementose/<?php print($username) ?>' style="text-align: center;  text-decoration: none" class="mx-2"> Add & Edit Mementos </a>

                                            <?php

                                            }



                                            ?>

                                        </div>
                                    </div>
                                <?php

                                }

                                ?>
                                
                                        <?php if ($type != 2) {
                                            echo '<div class="my-2 p-3 main-about-colom-2">
                                            <div class="">
                                        <div class="">
                                    <h3 class="p-2 blue">Memorials</h3>
                                          </div>';

                                            $sqlk = "SELECT * FROM `keepers` WHERE user_id = '$user_id'";

                                            $exe = mysqli_query($con, $sqlk);
                                            
                                            while ($fetchk = mysqli_fetch_assoc($exe)) {
                                                $k_id = $fetchk['kepper_ids'];
                                                $sqlm = "SELECT * FROM `users` WHERE ID = '$k_id' AND type='2'";

                                                $exem = mysqli_query($con, $sqlm);
                                                $fetchm = mysqli_fetch_assoc($exem);
                                                $fname = $fetchm['firstname'];
                                                $mname = $fetchm['middlename'];
                                                $lname = $fetchm['lastname'];
                                                $sname = $fetchm['suffix'];
                                                $mimage = $fetchm['image'];
                                                $username = $fetchm['username'];

                                                echo '<div class="profile d-flex">
                                                                        <img src="/assets/profile/' . (($mimage != null) ? $mimage : 'user.png') . '"
                                                                            alt="My Profile Picture">
                                                                        <div class="px-3  profile-text">
                                                                          <a href="/profile/' . $username . '"><h5> ' . $fname . '  ' . $mname . ' ' . $lname . ' ' . $sname . '</h5></a>
                                                                            </div>
                                                                        </div>';
                                            }
                                            if (mysqli_num_rows($exe) == 0) {
                                                echo '<div class="col-12">
                                                 <p class="py-5 my-5 text-center"> No Memorials Found</p>
                                             </div>   
                                              </div>
                                             </div>';
                                            }
                                        }
                                        ?>
                                
                               
                                        <?php 
                                            echo ' <div class="my-2 p-3 main-about-colom-2">
                                            <div class="">
                                        <div class="">
                                         <h3 class="p-2 blue">Keepers</h3>
                                          </div>';

                                            $sqlkl = "SELECT * FROM `keepers` WHERE `kepper_ids` = $user_id";
                                            //echo "SELECT * FROM `keepers` WHERE `kepper_ids` = $user_id";

                                            $exel = mysqli_query($con, $sqlkl);
                                            while ($fetchkl = mysqli_fetch_assoc($exel)) {
                                                $k_idl = $fetchkl['user_id'];
                                                $sqlml = "SELECT * FROM `users` WHERE `ID` = '$k_idl'";

                                                $exeml = mysqli_query($con, $sqlml);
                                                $fetchml = mysqli_fetch_assoc($exeml);
                                                $fname = $fetchml['firstname'];
                                                $mname = $fetchml['middlename'];
                                                $lname = $fetchml['lastname'];
                                                $sname = $fetchml['suffix'];
                                                $mimage = $fetchml['image'];
                                                $username = $fetchml['username'];

                                                echo '<div class="profile d-flex">
                                                                        <img src="/assets/profile/' . (($mimage != null) ? $mimage : 'user.png') . '"
                                                                            alt="My Profile Picture">
                                                                        <div class="px-3  profile-text">
                                                                          <a href="/profile/' . $username . '"><h5> ' . $fname . '  ' . $mname . ' ' . $lname . ' ' . $sname . '</h5></a>
                                                                            </div>
                                                                        </div>';
                                            }
                                            if (mysqli_num_rows($exel) == 0) {
                                                echo '<div class="col-12">
                                                 <p class="py-5 my-5 text-center"> No Keepers Found</p>
                                             </div>';
                                            }
                                            echo '    </div>
                                            </div>';
                                         
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
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Load existing comments on page load
        loadComments();

        // Submit comment form
        $(document).on("submit", "#commentForm", function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            // Get form values
            // var name = $("#name").val();
            
            //  var comment = $("#comment").val();
            
            var user_id = $("#u_id").val();
            // var log_uid = $("#log_uid").val();
            formData.append("user_id", user_id);
            //    formData.append("log_uid",log_uid);
            // Ajax post request to submit comment
            $.ajax({
                url: "/php/memorials_comment.php",
                type: "POST",
                contentType: false,
                data: formData,
                processData: false,
                success: function(response) {
                    // console.log(response);
                    // Clear form values


                    // Check the response
                    if (response === "success") {
                        // Reload comments
                        $('#commentForm').trigger("reset");
                        loadComments();
                        $("#name").val("");
                        $("#comment").val("");
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

        function loadComments() {
            var user_id = $("#u_id").val(); // Retrieve the value of the hidden input field
            $.ajax({
                url: "/php/get_mcomments.php",
                type: "GET",
                data: {
                    user_id: user_id
                }, // Pass the title value as a parameter in the AJAX request
                success: function(response) {
                    $("#comments").html(response);
                },
                error: function(xhr, status, error) {
                    // Handle error or display a message to the user
                    console.error("AJAX request failed. Error: " + error);
                }
            });
        }


        //  $(document).on('click', '.reply-btn', function() {
        //         var commentId = $(this).data('comment-id');
        //         $('#replyForm_' + commentId).toggle(1000);
        //     });
        // });
        //     $(document).on('click', '.reply-btn', function() {
        //     var Id = $(this).attr('id');
        //      console.log(Id);
        //      var cid=Id.split('_');
        //     document.getElementById(Id).addEventListener('click', replyComment(cid[1]), true);
        //   });

        // Function to reply to a comment
        $(document).on("submit", ".reply-form", function(e) {
            // Get the reply content
            e.preventDefault();

            
    

            var Id = $(this).attr('id');

            var cid = Id.split('_');
            $('#myModal-r').modal('show');
            document.getElementById("modalOKButton-r").addEventListener("click", function() {
        $('#myModal').modal('hide');
    });
            var user_id = $("#u_id").val(); // Retrieve the value of the hidden input field
            var log_uid = $("#log_uid").val();
            var name = $("#name_" + cid[1]).val();
            var replyContent = $("#replyInput_" + cid[1]).val();

            // Ajax post request to submit the reply
            $.ajax({
                url: "/php/memorials_reply_comment.php",
                type: "POST",
                data: {
                    log_uid: log_uid,
                    user_id: user_id,
                    name: name,
                    commentId: cid[1],
                    replyContent: replyContent
                },
                success: function(response) {
                    // Clear the reply input field
                    // $("#replyInput_" + commentId).val("");

                    // Check the response
                    if (response === "success") {
                        // Reload comments
                        
             
                        $('.reply-form').trigger("reset");
                       
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

        });

    });
</script>
<script>
    document.getElementById("commentForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent form submission

        // Show the modal
        $('#myModal').modal('show');

        // Clear the form fields
        // document.getElementById("commentForm").reset();
    });

    // Close the modal when OK button is clicked
    document.getElementById("modalOKButton").addEventListener("click", function() {
        $('#myModal').modal('hide');
    });
</script>
