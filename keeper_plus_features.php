<?php
session_start();
//session_regenerate_id(); 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$user_id = $_SESSION['user_id'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keeper-plus-features</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/js/script.js">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        .bg-fluid {
            padding-top: 84px;
            padding-bottom: 100px;
            background: #fff;
            text-align: center;
            margin: 0 auto;
        }

        .text-center {
            text-align: center;
        }

        .h2-style {
            margin-bottom: 80px;
            font-size: 40px;
        }

        .container img {
            margin-left: 7px;
            display: inline-block;
        }

        .center-p {
            font-weight: bolder;
            width: 75%;
            font-size: 18px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        .mt {
            padding-top: 12px;
            padding-bottom: 15px;
            text-transform: uppercase;
            margin: 0 auto;
            display: block !important;
        }

        .p-25 {
            display: flex;
        }

        .row {
            margin-right: -15px;
            margin-left: -15px;
        }

        .bg-img {
            background-size: cover;
            min-height: 352px;
            max-width: 352px;
            height: 100%;
            background-repeat: no-repeat;
            background-position: 0% 0%;
            background-size: cover;
            margin: 0 auto;
            text-align: center;
        }

        .col-text {
            height: 100%;
            padding: 25px;
            text-align: left;
            color: #fff;
        }

        .col-top-img {
            width: 100%;
            text-align: right;
            margin-top: 20px;
            margin-right: 20px;
        }

        .h3-style {
            margin-top: 35px !important;
            max-width: 75% !important;
            font-size: 22px;
        }

        .f-18 {
            font-size: 18px;
        }

        .k-plus {
            padding-top: 58px;
            padding-bottom: 58px;
            color: #fff;
            text-align: center;
            margin: 0 auto;
        }

        .gradient {
            background: #428bca;
            background: linear-gradient(113.3deg, rgb(134, 209, 228) -1.8%, rgb(60, 80, 115) 86.4%);
        }

        .k-plus-container {
            max-width: 50%;
            text-align: center;
            margin: 0 auto;
        }

        .img-new {
            display: inline-block;
            max-width: 250px;
        }

        .font-20 {
            font-size: 20px;
            margin-top: 10px;
        }

        .font-80 {
            font-size: 80px;
            font-weight: bolder;
            display: inline-block;
        }

        .font-24 {
            font-size: 24px;
            font-weight: bolder;
        }

        .m-2 {
            max-width: 100%;
            background-color: #003B59;
            padding: 10px 8%;
            word-break: break-all;
            white-space: normal;
            overflow-wrap: break-word;
        }

        .f-28 {
            font-size: 28px;
            font-weight: normal;
        }

        .light-blue {
            background: rgb(134, 209, 228);
            color: #fff;
        }

        .dark-blue {
            color: #fff;
            background: linear-gradient(113.3deg, rgb(134, 209, 228) -1.8%, rgb(60, 80, 115) 86.4%);
        }

        .badge {
            display: inline-block;
            min-width: 10px;
            padding: 10px 10px;
            font-size: 12px;
            font-weight: bold;
            color: #003B59;
            text-align: center;
            white-space: nowrap;
            background-color: #fff;
            border-radius: 10px;
        }

        .light-blue-true {
            background: rgba(132, 220, 242, 0.1) !important;
            color: rgb(134, 209, 228);
        }

        .dark-blue-true {
            color: rgb(60, 80, 115);
            background: rgb(227, 236, 245) !important;
        }

        .pa-h2 {
            margin-top: 40px;
            margin-bottom: 20px !important;
        }

        th,
        td {
            border-left: 10px solid #fff;
        }

        .space {
            border-top: 10px solid #fff !important;
        }

        td {
            width: 33% !important;
            border-bottom: 1px solid #ddd !important;
        }

        .f-14 {
            font-size: 14px;
        }

        .f-18b {
            font-size: 18px;
            font-weight: bold;
        }

        .tfoot-a {
            text-decoration: none;
            color: white;
        }

        .tfoot-a:hover {
            color: white;
        }

        .f-24b {
            font-size: 24px;
            font-weight: bold;
        }

        .img-p {
            margin-right: 3px;
            margin-left: 3px;
            display: inline-block;
        }

        @media screen and (max-width: 470px) {
            .table-borderless {
                font-size: 10px;
            }

            .f-18b {
                font-size: 14px;

            }

            .f-24b {
                font-size: 20px;

            }
        }
    </style>
</head>

<body>

    <?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
    ?>
    <section>
        <div class="container-fluid bg-fluid">
            <div class="container">
                <div class="container">
                    <h2 class="h2-style blue">Create <strong>better memorials</strong> with <br><strong>Keeper</strong>
                        <img src="/assets/imaages/features-plus-degrad-small.svg">
                    </h2>

                    <p class="center-p">View unlimited images in a gallery, download local copies of images, create a full family tree, create unlimited memorial pages, and more.</p>
                    <div class="row p-25">
                        <div class="mt col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="bg-img" style="background-image: linear-gradient(45deg, rgba(117, 203, 224, 0.7), rgb(60, 80, 115,0.7)),url('/assets/imaages/1.jpg');">
                                <div class="col-text">
                                    <div class="col-top-img">
                                        <img src="/assets/imaages/features-icon-share-inlimited-photos.svg">
                                    </div>
                                    <h3 class="h3-style">SHARE UNLIMITED PHOTOS &amp; VIDEOS</h3>
                                    <p class="f-18">Easily upload batches of photos and HD videos, and allow others to share their own.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="bg-img" style="background-image: linear-gradient(45deg, rgba(117, 203, 224, 0.7), rgb(60, 80, 115,0.7)),url('/assets/imaages/Recording-Expenses-Company-Party-CROP-ID-138769-960x600.jpg');">
                                <div class="col-text">
                                    <div class="col-top-img">
                                        <img src="/assets/imaages/features-icon-create-events.svg">
                                    </div>
                                    <h3 class="h3-style">CREATE EVENTS</h3>
                                    <p class="f-18">Create dedicate event pages, invite friends and family, and track guestlists.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="bg-img" style="background-image: linear-gradient(45deg, rgba(117, 203, 224, 0.7), rgb(60, 80, 115,0.7)),url('/assets/imaages/senior-couple-laughing-assisted-living-SFW-400x300.jpg');">
                                <div class="col-text">
                                    <div class="col-top-img">
                                        <img src="/assets/imaages/features-icon-interactive-tree.svg">
                                    </div>
                                    <h3 class="h3-style" style="max-width: 70% !important;">INTERACTIVE FAMILY TREE</h3>
                                    <p class="f-18">Build out your genealogy and automatically create Keeper pages for relatives.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="bg-img" style="background-image: linear-gradient(45deg, rgba(117, 203, 224, 0.7), rgb(60, 80, 115,0.7)),url('/assets/imaages/family-book-reading-with-grandma-baby-relax-sofa-morning-story-learning-happiness-love-happy-education-with-grandmother-girl-with-story-care-creative-joy_590464-86237.jpg');">
                                <div class="col-text">
                                    <div class="col-top-img">
                                        <img src="/assets/imaages/features-icon-download-personal-copies.svg">
                                    </div>
                                    <h3 class="h3-style">DOWNLOAD PERSONAL COPIES</h3>
                                    <p class="f-18">Get a local copy of all images and allow others to download them.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="bg-img" style="background-image: linear-gradient(45deg, rgba(117, 203, 224, 0.7), rgb(60, 80, 115,0.7)),url('/assets/imaages/beverage-blog-blogger-1799342-400x270.jpg');">
                                <div class="col-text">
                                    <div class="col-top-img">
                                        <img src="/assets/imaages/features-icon-unlimited-memorial-page.svg">
                                    </div>
                                    <h3 class="h3-style">UNLIMITED MEMORIAL PAGES</h3>
                                    <p class="f-18">Build unlimited memorial pages dedicated to your loved ones, and connect them in your Family Tree.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="bg-img" style="background-image: linear-gradient(45deg, rgba(117, 203, 224, 0.7), rgb(60, 80, 115,0.7)),url('/assets/imaages/Programs-1-1000x600.jpg');">
                                <div class="col-text">
                                    <div class="col-top-img">
                                        <img src="/assets/imaages/features-icon-unlimited-memorials-admin.svg">
                                    </div>
                                    <h3 class="h3-style" style="max-width: 90% !important;">UNLIMITED MEMORIAL ADMINISTRATORS</h3>
                                    <p class="f-18">Invite others to help edit and manage your Keeper pages with administrative privileges.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid k-plus gradient">
            <div class="container k-plus-container">
                <div>
                    <img class="img-new" src="/assets/imaages/Logo-new.png" alt="">
                </div>
                <p class="font-20">A true celebration of life. Online forever.</p>
                <div>
                    <span class="font-80">$40</span>
                    <!--<span class="font-80">$40<sup class="kplus-kp-create-m-price-pennies">99</sup></span>-->
                </div>
                <p class="font-24">ONE TIME PAYMENT</p>
                <button class="m-2"><a href="#" style="text-decoration: none;color: white;">Create Memorial</a></button><br>
            </div>
        </div>
    </section>

    <section class="pt-5 pb-5">
        <div class="container">
            <h2 class="h2-style blue text-center pa-h2">Full <strong>Features Breakdown</strong></h2>

            <p class="f-28 text-center">All <strong> Keeper memorials</strong> come with these features</p>
            <div class="row">
                <div class="col">
                    <table class="table-responsive table-borderless mt-5 w-100">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col" class="light-blue text-white p-3 p-lg-3 ml-2  text-center">FREE VERSION</th>
                                <th scope="col" class="dark-blue text-white p-3 p-lg-3 ml-2 text-center"> Keeper Plus&nbsp;
                                    <span style="margin-left:10px;" class="badge">Recommended</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="bg-white p-3 p-lg-3 ">
                                    <h4 class="f-18b">Memento Images</h4>
                                    <p class="f-14">A central gallery of all images and videos that have been uploaded.</p>
                                </td>
                                <td class="bg-white p-3 p-lg-3 light-blue-true text-center">
                                    <p>5 images</p>
                                </td>
                                <td class="bg-white p-3 p-lg-3 dark-blue-true text-center">
                                    <p>Unlimited</p>
                                </td>

                            </tr>

                            <tr>
                                <td class="bg-white p-3 p-lg-3">
                                    <h4 class="f-18b">Guestbook and Tributes</h4>
                                    <p class="f-14">Invite others to collaborate with unlimited memories, images and stories.</p>
                                </td>
                                <td class="bg-white p-3 p-lg-3 light-blue-true text-center">
                                    <span class="ti-check px-2"></span>
                                </td>
                                <td class="bg-white p-3 p-lg-3 dark-blue-true text-center">
                                    <span class="ti-check px-2"></span>
                                </td>

                            </tr>

                            <tr>
                                <td class=" bg-white p-3 p-lg-3">
                                    <h4 class="f-18b">Biography and Obituary</h4>
                                    <p class="f-14">Share their full story, and all your favourite memories.</p>
                                </td>
                                <td class="bg-white p-3 p-lg-3 light-blue-true text-center">
                                    <span class="ti-check px-2"></span>
                                </td>
                                <td class="bg-white p-3 p-lg-3 dark-blue-true text-center">
                                    <span class="ti-check px-2"></span>
                                </td>

                            </tr>

                            <!--<tr>-->
                            <!--    <td class=" bg-white p-3 p-lg-3">-->
                            <!--        <h4 class="f-18b">In Memoriam Donation Link</h4>-->
                            <!--        <p class="f-14">Add a link to your charity of choice, crowdfunding site or in memoriam donation fund.</p>-->
                            <!--    </td>-->
                            <!--    <td class="bg-white p-3 p-lg-3 light-blue-true text-center">-->
                            <!--        <p>1 Link</p>-->
                            <!--    </td>-->
                            <!--    <td class="bg-white p-3 p-lg-3 dark-blue-true text-center">-->
                            <!--        <p>2 Links</p>-->
                            <!--    </td>-->

                            <!--</tr>-->

                            <tr>
                                <td class=" bg-white p-3 p-lg-3">
                                    <h4 class="f-18b">Online Forever</h4>
                                    <p class="f-14">Your memorial page will stay on the internet for as long as you keep your account active.</p>
                                </td>
                                <td class="bg-white p-3 p-lg-3 light-blue-true text-center">
                                    <span class="ti-check px-2"></span>
                                </td>
                                <td class="bg-white p-3 p-lg-3 dark-blue-true text-center">
                                    <span class="ti-check px-2"></span>
                                </td>

                            </tr>

                            <tr>
                                <td class=" bg-white p-3 p-lg-3">
                                    <h4 class="f-18b">Unlimited Milestones</h4>
                                    <p class="f-14">Highlight all the important moments and accomplishments in your loved one's life.</p>
                                </td>
                                <td class="bg-white p-3 p-lg-3 light-blue-true text-center">
                                    <span class="ti-check px-2"></span>
                                </td>
                                <td class="bg-white p-3 p-lg-3 dark-blue-true text-center">
                                    <span class="ti-check px-2"></span>
                                </td>

                            </tr>

                            <!--<tr>-->
                            <!--    <td class=" bg-white p-3 p-lg-3">-->
                            <!--        <h4 class="f-18b">Share Cemetery & Grave Location</h4>-->
                            <!--        <p class="f-14">Store and share funeral home, cemetery, grave and mausoleum locations and map directions.</p>-->
                            <!--    </td>-->
                            <!--    <td class="bg-white p-3 p-lg-3 light-blue-true text-center">-->
                            <!--        <span class="ti-check px-2"></span>-->
                            <!--    </td>-->
                            <!--    <td class="bg-white p-3 p-lg-3 dark-blue-true text-center">-->
                            <!--        <span class="ti-check px-2"></span>-->
                            <!--    </td>-->

                            <!--</tr>-->

                            <tr>
                                <td class=" bg-white p-3 p-lg-3">
                                    <h4 class="f-18b">Full Privacy Settings</h4>
                                    <p class="f-14">Control who is able to see your Keeper pages.</p>
                                </td>
                                <td class="bg-white p-3 p-lg-3 light-blue-true text-center">
                                    <p>Limited</p>
                                </td>
                                <td class="bg-white p-3 p-lg-3 dark-blue-true text-center">
                                    <span class="ti-check px-2"></span>
                                </td>

                            </tr>


                            <tr>
                                <td class="bg-white p-3 p-lg-3 ">

                                </td>
                                <td class="bg-white p-3 p-lg-3 text-center" colspan="2">
                                    <p class="f-24b">Keeper <img class="img-p" src="/assets/imaages/features-plus-degrad-small.svg"> Features Below</p>
                                </td>

                            </tr>

                            <tr>
                                <td class=" bg-white p-3 p-lg-3">
                                    <h4 class="f-18b">Download images</h4>
                                    <p class="f-14">Get a local copy of all tribute and memento images.</p>
                                </td>
                                <td class="bg-white p-3 p-lg-3 light-blue-true text-center">
                                    <span class="ti-close px-2"></span>
                                </td>
                                <td class="bg-white p-3 p-lg-3 dark-blue-true text-center">
                                     <span class="ti-check px-2"></span>
                                </td>

                            </tr>

                            <tr>
                                <td class=" bg-white p-3 p-lg-3">
                                    <h4 class="f-18b">Memorial Pages</h4>
                                    <p class="f-14">How many Keeper pages you are able to create.</p>
                                </td>
                                <td class="bg-white p-3 p-lg-3 light-blue-true text-center">
                                    <p>3 Memorial Pages</p>
                                </td>
                                <td class="bg-white p-3 p-lg-3 dark-blue-true text-center">
                                    <p>Unlimited</p>
                                </td>

                            </tr>

                            <tr>
                                <td class=" bg-white p-3 p-lg-3">
                                    <h4 class="f-18b">Family Tree</h4>
                                    <p class="f-14">Build out your genealogy and automatically create Keeper pages for relatives.</p>
                                </td>
                                <td class="bg-white p-3 p-lg-3 light-blue-true text-center">
                                     <span class="ti-check px-2"></span>
                                </td>
                                <td class="bg-white p-3 p-lg-3 dark-blue-true text-center">
                                   <span class="ti-check px-2"></span>
                                </td>

                            </tr>

                            <tr>
                                <td class=" bg-white p-3 p-lg-3">
                                    <h4 class="f-18b">Events pages</h4>
                                    <p class="f-14">Plan events, invite friends and family, and track guestlist.</p>
                                </td>
                                <td class="bg-white p-3 p-lg-3 light-blue-true text-center">
                                    <span class="ti-close px-2"></span>
                                </td>
                                <td class="bg-white p-3 p-lg-3 dark-blue-true text-center">
                                    <span class="ti-check px-2"></span>
                                </td>

                            </tr>

                            <tr>
                                <td class=" bg-white p-3 p-lg-3">
                                    <h4 class="f-18b">Keeper Administrators</h4>
                                    <p class="f-14">Invite others to edit and manage your Keeper pages with administrative privileges.</p>
                                </td>
                                <td class="bg-white p-3 p-lg-3 light-blue-true text-center">
                                    <p>One Administrator</p>
                                </td>
                                <td class="bg-white p-3 p-lg-3 dark-blue-true text-center">
                                    <p>Unlimited Administrators</p>
                                </td>

                            </tr>

                            <!--<tr>-->
                            <!--    <td class=" bg-white p-3 p-lg-3">-->
                            <!--        <h4 class="f-18b">Customizable URL</h4>-->
                            <!--        <p class="f-14">Create a meaningful web address unique to your loved one.</p>-->
                            <!--    </td>-->
                            <!--    <td class="bg-white p-3 p-lg-3 light-blue-true text-center">-->
                            <!--        <span class="ti-close px-2"></span>-->
                            <!--    </td>-->
                            <!--    <td class="bg-white p-3 p-lg-3 dark-blue-true text-center">-->
                            <!--        <span class="ti-check px-2"></span>-->
                            <!--    </td>-->

                            <!--</tr>-->
                            <tr>
                                <td class=" bg-white p-3 p-lg-3">
                                    <h4 class="f-18b">Video Uploading</h4>
                                    <p class="f-14">Share video memories of your loved ones.</p> 
                                </td>
                                <td class="bg-white p-3 p-lg-3 light-blue-true text-center">
                                    <p>Upload 1 Videos</p>
                                </td>
                                <td class="bg-white p-3 p-lg-3 dark-blue-true text-center">
                                    <p>Upload Unlimited Videos</p>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="space">
                            <tr>
                                <th></th>
                                <?php
                                if (!isset($user_id)) {
                                ?>
                                    <th class="light-blue text-white  p-3 p-lg-3 ml-2  text-center">
                                        <a href="/signup/profile" class="tfoot-a">Create Keeper Account</a>
                                    </th>
                                    <?php
                                }
                                if (isset($user_id)) {
                                    $sql_membership = mysqli_query($con, "SELECT * FROM `users` WHERE `ID` = '$user_id'");
                                    $fetch_membership = mysqli_fetch_assoc($sql_membership);
                                    $membership = $fetch_membership['membership'];
                                    if ($membership == 2) {
                                    ?>
                                        <th class="dark-blue text-white p-3 p-lg-3 ml-2 text-center">
                                            <a href="/payment" class="tfoot-a">Create Keeper Plus Account</a>
                                        </th>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <th class="dark-blue text-white p-3 p-lg-3 ml-2 text-center">
                                        <a href="/signup/profile?keeper_plus=true" class="tfoot-a">Create Keeper Plus Account</a>
                                    </th>
                                <?php
                                }
                                ?>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php
    
	require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';

?>
</body>

</html>