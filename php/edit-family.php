<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sendmail.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM `users` WHERE ID = '" . $_SESSION['user_id'] . "'";
$exe = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($exe);

$firstname = $fetch['firstname'];
$username = $fetch['username'];
//$username = urlencode($username1);
$middlename = $fetch['middlename'];
$lastname = $fetch['lastname'];
$image = $fetch['image'];

if (isset($_POST['submit'])) {
    extract($_POST);
    $selected_option1 = $_POST['my-relation-select'];
    $parent_side_one = $_POST['parent-side-one'];
    $parent_side_two = $_POST['parent-side-two'];
    $gender = $_POST['gender'];


    if (isset($_POST['input_id'])) {

        $idd = $_POST['input_id'];

        $hidden_field_id = str_replace('#', '', $idd);
        //die();

        $sql = "SELECT * FROM `users` WHERE  `ID` = '" . $hidden_field_id . "'";
        $executsql = mysqli_query($con, $sql);
        $res = mysqli_fetch_assoc($executsql);

        $user_ID = $res['ID'];
        $image = $res['image'];
        $email = $res['email'];

        if ($selected_option1 == 'father') {
            $alreadysql1 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = 'father' AND `gender` = 'm'");
            if (mysqli_num_rows($alreadysql1) > 0) {
                $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`user_id`='$user_id',`varify` = 1
                 WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
            } else {
                $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` != '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = 'father' AND `gender` = 'm'");
                if (mysqli_num_rows($alreadysql2) > 0) {
                    $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                    `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`user_id`='$user_id',`varify` = 0
                     WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                    mysqli_query($con, "DELETE FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id'");
                } else {
                    $family_rela = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                    $family_rela = mysqli_fetch_assoc($family_rela);
                    $familygender = $family_rela['gender'];
                    $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` != 'father' AND `gender` = '$familygender'");
                    if (mysqli_num_rows($alreadysql3) > 0) {
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = 'father' AND `gender` = 'm'");
                        $query1 = "INSERT INTO `family_member`( `selected_user_id`,`gender`,`relationship`,`He-is-your`, `user_id`,`varify`)
                VALUES ('$hidden_field_id','$gender','$selected_option1','$selected_option1','$user_id','0')";
                    }
                }
            }
        } elseif ($selected_option1 == 'mother') {
            //$alreadysql1 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` != 'NULL' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'");
            $alreadysql1 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = 'mother' AND `gender` = 'f'");
            if (mysqli_num_rows($alreadysql1) > 0) {
                $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                `gender`='$gender',`relationship`='$selected_option1',`She-is-your`='$selected_option1',`user_id`='$user_id',`varify` = 1
                 WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
            } else {
                $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` != '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = 'mother' AND `gender` = 'f'");
                if (mysqli_num_rows($alreadysql2) > 0) {
                    $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                `gender`='$gender',`relationship`='$selected_option1',`She-is-your`='$selected_option1',`user_id`='$user_id',`varify` = 0
                 WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                } else {
                    $family_rela = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                    $family_rela = mysqli_fetch_assoc($family_rela);
                    $familygender = $family_rela['gender'];
                    $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` != 'mother' AND `gender` = '$familygender'");
                    if (mysqli_num_rows($alreadysql3) > 0) {
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = 'mother' AND `gender` = 'f'");
                        $query1 = "INSERT INTO `family_member`(`selected_user_id`,`gender`,`relationship`,`She-is-your`, `user_id`,`varify`)
                        VALUES (' $hidden_field_id','$gender','$selected_option1','$selected_option1','$user_id','0')";
                    }
                }
            }
        } elseif ($selected_option1 == 'grandfather' && $parent_side_one == 1) {
            $gender = 'male-father-side';
            //$alreadysql1 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` != 'NULL' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender' AND `parent_side_one`='$parent_side_one'");
            $alreadysql1 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = 'grandfather' AND `gender` = 'male-father-side' AND `parent_side_one`='$parent_side_one'");
            if (mysqli_num_rows($alreadysql1) > 0) {
                $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`parent_side_one`='$parent_side_one',`user_id`='$user_id',`varify` = 1
                 WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender' AND `parent_side_one`='$parent_side_one'";
            } else {
                $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` != '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = 'grandfather' AND `gender` = 'male-father-side' AND `parent_side_one`='$parent_side_one'");
                if (mysqli_num_rows($alreadysql2) > 0) {
                    $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`parent_side_one`='$parent_side_one',`user_id`='$user_id',`varify` = 0
                 WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender' AND `parent_side_one`='$parent_side_one'";
                } else {
                    $family_rela = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                    $family_rela = mysqli_fetch_assoc($family_rela);
                    $familygender = $family_rela['gender'];
                    $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` != 'grandfather' AND `gender` = '$familygender'");
                    if (mysqli_num_rows($alreadysql3) > 0) {
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = 'grandfather' AND `gender` = 'male-father-side' AND `parent_side_one` = 1");
                        $query1 = "INSERT INTO `family_member`(`selected_user_id`,`gender`,`relationship`,`He-is-your`,`parent_side_one`,`user_id`,`varify`)
                        VALUES ('$hidden_field_id','$gender','$selected_option1','$selected_option1','$parent_side_one','$user_id','0')";
                    }
                }
            }
        } elseif ($selected_option1 == 'grandmother' && $parent_side_one == 1) {

            $gender = 'female-father-side';
            //$alreadysql1 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` != 'NULL' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender' AND `parent_side_one`='$parent_side_one'");
            $alreadysql1 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = 'grandmother' AND `gender` = 'female-father-side' AND `parent_side_one`='$parent_side_one'");
            if (mysqli_num_rows($alreadysql1) > 0) {
                $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`parent_side_one`='$parent_side_one',`user_id`='$user_id',`varify` = 1
                 WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender' AND `parent_side_one`='$parent_side_one'";
            } else {
                $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` != '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = 'grandmother' AND `gender` = 'female-father-side' AND `parent_side_one`='$parent_side_one'");
                if (mysqli_num_rows($alreadysql2) > 0) {
                    $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`parent_side_one`='$parent_side_one',`user_id`='$user_id',`varify` = 0
                 WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender' AND `parent_side_one`='$parent_side_one'";
                } else {
                    $family_rela = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                    $family_rela = mysqli_fetch_assoc($family_rela);
                    $familygender = $family_rela['gender'];
                    $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` != 'grandmother' AND `gender` = '$familygender'");
                    if (mysqli_num_rows($alreadysql3) > 0) {
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = 'grandmother' AND `gender` = 'female-father-side' AND `parent_side_one` = 1");
                        $query1 = "INSERT INTO `family_member`(`selected_user_id`,`gender`,`relationship`,`He-is-your`,`parent_side_one`,`user_id`,`varify`)
                        VALUES ('$hidden_field_id','$gender','$selected_option1','$selected_option1','$parent_side_one','$user_id','0')";
                    }
                }
            }
        } elseif ($selected_option1 == 'grandfather' && $parent_side_one == 2) {
            $gender = 'male-mother-side';
            //$alreadysql1 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` != 'NULL' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender' AND `parent_side_one`='$parent_side_one'");
            $alreadysql1 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = 'grandfather' AND `gender` = 'male-mother-side' AND `parent_side_one`='$parent_side_one'");
            if (mysqli_num_rows($alreadysql1) > 0) {
                $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`parent_side_one`='$parent_side_one',`user_id`='$user_id',`varify` = 1
                 WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender' AND `parent_side_one`='$parent_side_one'";
            } else {
                $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` != '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = 'grandfather' AND `gender` = 'male-mother-side' AND `parent_side_one`='$parent_side_one'");
                if (mysqli_num_rows($alreadysql2) > 0) {
                    $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`parent_side_one`='$parent_side_one',`user_id`='$user_id',`varify` = 0
                 WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option' AND `gender` = '$gender' AND `parent_side_one`='$parent_side_one'";
                } else {
                    $family_rela = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                    $family_rela = mysqli_fetch_assoc($family_rela);
                    $familygender = $family_rela['gender'];
                    $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` != 'grandfather' AND `gender` = '$familygender'");
                    if (mysqli_num_rows($alreadysql3) > 0) {
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = 'grandfather' AND `gender` = 'male-mother-side' AND `parent_side_one` = 2");
                        $query1 = "INSERT INTO `family_member`( `selected_user_id``gender`,`relationship`,`She-is-your`,`parent_side_one`,`user_id`,`varify`)
                        VALUES ('$hidden_field_id','$gender','$selected_option1','$selected_option1','$parent_side_one','$user_id','0')";
                    }
                }
            }
        } elseif ($selected_option1 == 'grandmother' && $parent_side_one == 2) {
            $gender = 'female-mother-side';
            //$alreadysql1 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` != 'NULL' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender' AND `parent_side_one`='$parent_side_one'");
            $alreadysql1 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = 'grandmother' AND `gender` = 'female-mother-side' AND `parent_side_one`='$parent_side_one'");
            if (mysqli_num_rows($alreadysql1) > 0) {
                $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`parent_side_one`='$parent_side_one',`user_id`='$user_id',`varify` = 1
                 WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender' AND `parent_side_one`='$parent_side_one'";
            } else {
                $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` != '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = 'grandmother' AND `gender` = 'female-mother-side' AND `parent_side_one`='$parent_side_one'");
                if (mysqli_num_rows($alreadysql2) > 0) {
                    $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`parent_side_one`='$parent_side_one',`user_id`='$user_id',`varify` = 0
                 WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender' AND `parent_side_one`='$parent_side_one'";
                } else {
                    $family_rela = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                    $family_rela = mysqli_fetch_assoc($family_rela);
                    $familygender = $family_rela['gender'];
                    $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` != 'grandmother' AND `gender` = '$familygender'");
                    if (mysqli_num_rows($alreadysql3) > 0) {
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = 'grandmother' AND `gender` = 'female-mother-side' AND `parent_side_one` = 2");
                        $query1 = "INSERT INTO `family_member`( `selected_user_id`,`gender`,`relationship`,`she-is-your`,`parent_side_one`,`user_id`,`varify`)
                    VALUES ('$hidden_field_id','$gender','$selected_option1','$selected_option1','$parent_side_one','$user_id','0')";
                    }
                }
            }
        } elseif ($selected_option1) {

            $alreadysql1 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = 'm'");
            if (mysqli_num_rows($alreadysql1) > 0) {
                $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`parent_side_one`='$parent_side_one',`parent_side_two`='$parent_side_two',`user_id`='$user_id',`varify` = 1
                WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
            } else {
                $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` != '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = 'm'");
                if (mysqli_num_rows($alreadysql2) > 0) {
                    $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`parent_side_one`='$parent_side_one',`parent_side_two`='$parent_side_two',`user_id`='$user_id',`varify` = 0
                WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                } else {
                    $family_rela = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                    $family_rela = mysqli_fetch_assoc($family_rela);
                    $familygender = $family_rela['gender'];
                    $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` != '$selected_option1' AND `gender` = '$familygender'");
                    if (mysqli_num_rows($alreadysql3) > 0) {
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `parent_side_one` = $parent_side_one");
                        $query1 = "INSERT INTO `family_member`( `selected_user_id`,`gender`,`relationship`,`He-is-your`,`parent_side_one`,`parent_side_two`,`user_id`,`varify`)
                    VALUES ('$hidden_field_id','$gender','$selected_option1','$selected_option1','$parent_side_one','$parent_side_two','$user_id','0')";
                    }
                }
            }
        } elseif ($selected_option1) {
            $alreadysql1 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = 'f'");
            if (mysqli_num_rows($alreadysql1) > 0) {
                $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                `gender`='$gender',`relationship`='$selected_option1',`They-are-your`='$selected_option1',`parent_side_one`='$parent_side_one',`parent_side_two`='$parent_side_two',`user_id`='$user_id',`varify` = 1
                WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = 'f'";
            } else {
                $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` != '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = 'f'");
                if (mysqli_num_rows($alreadysql2) > 0) {
                    $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                `gender`='$gender',`relationship`='$selected_option1',`They-are-your`='$selected_option1',`parent_side_one`='$parent_side_one',`parent_side_two`='$parent_side_two',`user_id`='$user_id',`varify` = 0
                WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = 'f'";
                } else {
                    $family_rela = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                    $family_rela = mysqli_fetch_assoc($family_rela);
                    $familygender = $family_rela['gender'];
                    $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` != '$selected_option1' AND `gender` = '$familygender'");
                    if (mysqli_num_rows($alreadysql3) > 0) {
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `parent_side_one` = $parent_side_one");
                        $query1 = "INSERT INTO `family_member`( `selected_user_id`,`gender`,`relationship`,`They-are-your`,`parent_side_one`,`parent_side_two`,`user_id`,`varify`)
                        VALUES ('$hidden_field_id','$gender','$selected_option1','$selected_option1','$parent_side_one','$parent_side_two','$user_id','0')";
                    }
                }
            }
        } elseif ($selected_option1) {
            $alreadysql1 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = 'o'");
            if (mysqli_num_rows($alreadysql1) > 0) {
                $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                `gender`='$gender',`relationship`='$selected_option1',`They-are-your`='$selected_option1',`parent_side_one`='$parent_side_one',`parent_side_two`='$parent_side_two',`user_id`='$user_id',`varify` = 1
                WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
            } else {
                $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` != '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = 'o'");
                if (mysqli_num_rows($alreadysql2) > 0) {
                    $query1 = "UPDATE `family_member` SET `selected_user_id`='$hidden_field_id',
                    `gender`='$gender',`relationship`='$selected_option1',`They-are-your`='$selected_option1',`parent_side_one`='$parent_side_one',`parent_side_two`='$parent_side_two',`user_id`='$user_id',`varify` = 0
                    WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                } else {
                    $family_rela = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                    $family_rela = mysqli_fetch_assoc($family_rela);
                    $familygender = $family_rela['gender'];
                    $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id' AND `relationship` != '$selected_option1' AND `gender` = '$familygender'");
                    if (mysqli_num_rows($alreadysql3) > 0) {
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id' AND `user_id` = '$user_id'");
                        mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `parent_side_one` = $parent_side_one");
                        $query1 = "INSERT INTO `family_member`(`selected_user_id`,`gender`,`relationship`,`They-are-your`,`parent_side_one`,`parent_side_two`,`user_id`, `varify`)
                VALUES ('$hidden_field_id','$gender','$selected_option1','$selected_option1','$parent_side_one','$parent_side_two','$user_id','0')";
                    }
                }
            }
        }
        // echo 'yes';
        $execute1 = mysqli_query($con, $query1);
        // echo 'ok';
        if ($execute1) {
            $get_varify = mysqli_query($con, "SELECT varify FROM `family_member` WHERE `selected_user_id` = '$hidden_field_id'");
            $fetch_varify = mysqli_fetch_assoc($get_varify);
            $varifyy = $fetch_varify['varify'];

            if ($varifyy != 1) {
                $to = $email;
                $subject = "Family Member Conformation";
                $message = "<html><body><p>Dear [Recipient],<br>We hope this message finds you well. We would like to invite you to be a part of our family tree on Tributekeeper, a platform that allows us to document and preserve our family history.
                Allow to add our family tree, please click on the following Button:<br></p><p><a href='https://app.tributekeeper.com/approved/" . $selected_option1 . "/" . $hidden_field_id . "' style='display:inline-block;padding:10px;background-color:#007bff;color:#fff;text-decoration:none;border-radius:4px;'>Click To Approved</a>
                <p>Thank you for choosing Tributekeeper to strengthen your family bonds.</p>
                        <p>Thank you for choosing Tributekeeper.</p>
                        <p>Best regards,</p>
                        <p>Tributekeeper Team</p>
                    </p></body></html>";
                // $headers .= "MIME-Version: 1.0\r\n";
                // $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                $sendmail = json_decode(sendMail($to, $subject, $message, ""));
                if ($sendmail) {
                    $slquery = mysqli_query($con, "SELECT * FROM users WHERE `ID` = '$hidden_field_id'");
                    $slfetch = mysqli_fetch_assoc($slquery);
                    $firstname = $slfetch['firstname'];
                    $lastname = $slfetch['lastname'];
                    $_SESSION['usR_name'] = $firstname . " " . $lastname;
                    $_SESSION['hidden_field_id'] = $hidden_field_id;
                    $_SESSION['family_confermation_message'] = "<p><b>Request Pending: '" . $_SESSION['usR_name'] . "'</b> must accept the Family Relation before it can appear in your Family Tree. </p>";
                    // echo "success";
                    // die();
                    header("location:/edit-family-member/$gender/$hidden_field_id");
                    exit;
                } else {
                    $_SESSION['family_error_message'] = "Failed To send to add New Family Member Request!";
                    // echo "success2";
                    // die();
                    header("location:/add-family-member/$gender/$hidden_field_id");
                    exit;
                }
            } else {
                header("location: /family/$username");
            }
        } else {

            $_SESSION['family_error_message'] = "Failed To add New Family Member!";
            header("location:/add-family-member/");
            //die();
        }
    } else {

        //echo $relationship;
        //die();
        $imgname = $_FILES['image']['name'];

        $extension = pathinfo($imgname, PATHINFO_EXTENSION);

        $randomno = rand(0, 100000);
        $rename = 'Upload' . date('Ymd') . $randomno;

        $newname = $rename . '.' . $extension;

        $filename = $_FILES['image']['tmp_name'];
       //die();
        move_uploaded_file($filename, '../assets/profile/' . $imgname);
        if ($selected_option1 == 'father' && $gender == 'm') {
            $alreadysql = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'");
            if (mysqli_num_rows($alreadysql) > 0) {
                if ($imgname == '') {
                    $query = "UPDATE `family_member` SET `firstname`='$firstname',
                    `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                    `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                    `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`user_id`='$user_id'
                     WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`user_id`='$user_id'
                                 WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                } else {
                    $query = "UPDATE `family_member` SET `firstname`='$firstname',
                    `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                    `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                    `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`user_id`='$user_id',
                    `image`='$imgname' WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`user_id`='$user_id',
                                `image`='$imgname' WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                }
            } else {
                $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                if (mysqli_num_rows($alreadysql3) > 0) {
                    while ($fetch3 = mysqli_fetch_assoc($alreadysql3)) {
                        $fname = $fetch3['firstname'];
                        $lname = $fetch3['lastname'];
                        $mname = $fetch3['middlename'];
                        $suf = $fetch3['suffix'];
                        $relationdb = $fetch3['relationship'];
                        if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                            mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`He-is-your`, `user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$user_id','$imgname')";
                        } else {
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`He-is-your`, `user_id`, `image`)
                        VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$user_id','$imgname')";
                        }
                    }
                }
            }
        } elseif ($selected_option1 == 'mother' && $gender == 'f') {
            $alreadysql = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'");
            if (mysqli_num_rows($alreadysql) > 0) {
                if ($imgname == '') {
                    $query = "UPDATE `family_member` SET `firstname`='$firstname',
                    `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                    `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                    `gender`='$gender',`relationship`='$selected_option1',`She-is-your`='$selected_option1',`user_id`='$user_id'
                     WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`She-is-your`='$selected_option1',`user_id`='$user_id',
                                WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                } else {
                    $query = "UPDATE `family_member` SET `firstname`='$firstname',
                    `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                    `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                    `gender`='$gender',`relationship`='$selected_option1',`She-is-your`='$selected_option1',`user_id`='$user_id',
                    `image`='$imgname' WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`She-is-your`='$selected_option1',`user_id`='$user_id',
                                `image`='$imgname' WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                }
            } else {
                $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                if (mysqli_num_rows($alreadysql3) > 0) {
                    while ($fetch3 = mysqli_fetch_assoc($alreadysql3)) {
                        $fname = $fetch3['firstname'];
                        $lname = $fetch3['lastname'];
                        $mname = $fetch3['middlename'];
                        $suf = $fetch3['suffix'];
                        $relationdb = $fetch3['relationship'];
                        if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                            mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`She-is-your`, `user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$user_id','$imgname')";
                        } else {
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`She-is-your`, `user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$user_id','$imgname')";
                        }
                    }
                }
            }
        } elseif ($selected_option1 == 'grandfather' && $gender == 'm' && $parent_side_one == '1') {
            $gender = 'male-father-side';
            $alreadysql = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'");
            if ($res = mysqli_num_rows($alreadysql) > 0) {
                if ($imgname == '') {
                    $query = "UPDATE `family_member` SET `firstname`='$firstname',
                    `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                    `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                    `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`user_id`='$user_id'
                     WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`user_id`='$user_id'
                                 WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                } else {
                    $query = "UPDATE `family_member` SET `firstname`='$firstname',
                    `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                    `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                    `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`user_id`='$user_id',
                    `image`='$imgname' WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`user_id`='$user_id',
                                `image`='$imgname' WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                }
            } else {
                $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                if (mysqli_num_rows($alreadysql3) > 0) {
                    while ($fetch3 = mysqli_fetch_assoc($alreadysql3)) {
                        $fname = $fetch3['firstname'];
                        $lname = $fetch3['lastname'];
                        $mname = $fetch3['middlename'];
                        $suf = $fetch3['suffix'];
                        $relationdb = $fetch3['relationship'];
                        if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                            mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`He-is-your`,`parent_side_one`,`user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$parent_side_one','$user_id','$imgname')";
                        } else {
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`He-is-your`,`parent_side_one`,`user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$parent_side_one','$user_id','$imgname')";
                        }
                    }
                }
            }
        } elseif ($selected_option1 == 'grandmother' && $gender == 'f' && $parent_side_one == '1') {
            $gender = 'female-father-side';
            $alreadysql = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'");
            if (mysqli_num_rows($alreadysql) > 0) {
                if ($imgname == '') {
                    $query = "UPDATE `family_member` SET `firstname`='$firstname',
                    `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                    `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                    `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`user_id`='$user_id'
                     WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`user_id`='$user_id'
                                WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                } else {
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`user_id`='$user_id',
                                `image`='$imgname' WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                }
            } else {
                $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                if (mysqli_num_rows($alreadysql3) > 0) {
                    while ($fetch3 = mysqli_fetch_assoc($alreadysql3)) {
                        $fname = $fetch3['firstname'];
                        $lname = $fetch3['lastname'];
                        $mname = $fetch3['middlename'];
                        $suf = $fetch3['suffix'];
                        $relationdb = $fetch3['relationship'];
                        if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                            mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`He-is-your`,`parent_side_one`,`user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$parent_side_one','$user_id','$imgname')";
                        } else {
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`He-is-your`,`parent_side_one`,`user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$parent_side_one','$user_id','$imgname')";
                        }
                    }
                }
            }
        } elseif ($selected_option1 == 'grandfather' && $gender == 'm' && $parent_side_one == '2') {
            $gender = 'male-mother-side';
            $alreadysql = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'");
            if (mysqli_num_rows($alreadysql) > 0) {
                if ($imgname == '') {
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`She-is-your`='$selected_option1',`user_id`='$user_id'
                                WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                } else {
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`She-is-your`='$selected_option1',`user_id`='$user_id',
                                `image`='$imgname' WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                }
            } else {
                $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                if (mysqli_num_rows($alreadysql3) > 0) {
                    while ($fetch3 = mysqli_fetch_assoc($alreadysql3)) {
                        $fname = $fetch3['firstname'];
                        $lname = $fetch3['lastname'];
                        $mname = $fetch3['middlename'];
                        $suf = $fetch3['suffix'];
                        $relationdb = $fetch3['relationship'];
                        if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                            mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`She-is-your`,`parent_side_one`,`user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$parent_side_one','$user_id','$imgname')";
                        } else {
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`She-is-your`,`parent_side_one`,`user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$parent_side_one','$user_id','$imgname')";
                        }
                    }
                }
            }
        } elseif ($selected_option1 == 'grandmother' && $gender == 'f' && $parent_side_one == '2') {
            $gender = 'female-mother-side';
            $alreadysql = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'");
            if (mysqli_num_rows($alreadysql) > 0) {
                if ($imgname == '') {
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`She-is-your`='$selected_option1',`user_id`='$user_id'
                                WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                } else {
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`She-is-your`='$selected_option1',`user_id`='$user_id',
                                `image`='$imgname' WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                }
            } else {
                $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                if (mysqli_num_rows($alreadysql3) > 0) {
                    while ($fetch3 = mysqli_fetch_assoc($alreadysql3)) {
                        $fname = $fetch3['firstname'];
                        $lname = $fetch3['lastname'];
                        $mname = $fetch3['middlename'];
                        $suf = $fetch3['suffix'];
                        $relationdb = $fetch3['relationship'];
                        if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                            mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`she-is-your`,`parent_side_one`,`user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$parent_side_one','$user_id','$imgname')";
                        } else {
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`she-is-your`,`parent_side_one`,`user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$parent_side_one','$user_id','$imgname')";
                        }
                    }
                }
            }
        } elseif ($selected_option1 && $gender == 'm') {
            $alreadysql = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'");
            if (mysqli_num_rows($alreadysql) > 0) {
                if ($imgname == '') {
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`parent_side_one` = '$parent_side_one',`parent_side_two` = '$parent_side_two',`user_id`='$user_id'
                                WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                } else {
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`parent_side_one` = '$parent_side_one',`parent_side_two` = '$parent_side_two',`user_id`='$user_id',
                                `image`='$imgname' WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                }
            } else {
                $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                if (mysqli_num_rows($alreadysql3) > 0) {
                    while ($fetch3 = mysqli_fetch_assoc($alreadysql3)) {
                        $fname = $fetch3['firstname'];
                        $lname = $fetch3['lastname'];
                        $mname = $fetch3['middlename'];
                        $suf = $fetch3['suffix'];
                        $relationdb = $fetch3['relationship'];
                        if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                            mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`He-is-your`, `parent_side_one`,`parent_side_two`,`user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$parent_side_one','$parent_side_two','$user_id','$imgname')";
                        } else {
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`He-is-your`,`parent_side_one`,`parent_side_two`,`user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$parent_side_one','$parent_side_two','$user_id','$imgname')";
                        }
                    }
                }
            }
        } elseif ($selected_option1 && $gender == 'f') {
            $alreadysql = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'");
            if (mysqli_num_rows($alreadysql) > 0) {
                if ($imgname == '') {
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`parent_side_one` = '$parent_side_one',`parent_side_two` = '$parent_side_two',`user_id`='$user_id'
                                 WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                } else {
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`parent_side_one` = '$parent_side_one',`parent_side_two` = '$parent_side_two',`user_id`='$user_id',
                                `image`='$imgname' WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                }
            } else {
                $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                if (mysqli_num_rows($alreadysql3) > 0) {
                    while ($fetch3 = mysqli_fetch_assoc($alreadysql3)) {
                        $fname = $fetch3['firstname'];
                        $lname = $fetch3['lastname'];
                        $mname = $fetch3['middlename'];
                        $suf = $fetch3['suffix'];
                        $relationdb = $fetch3['relationship'];
                        if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                            mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`They-are-your`, `parent_side_one`,`parent_side_two`,`user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$parent_side_one','$parent_side_two','$user_id','$imgname')";
                        } else {
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`They-are-your`, `parent_side_one`,`parent_side_two`,`user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$parent_side_one','$parent_side_two','$user_id','$imgname')";
                        }
                    }
                }
            }
        } elseif ($selected_option1 && $gender == 'o') {
            $alreadysql = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'");
            if (mysqli_num_rows($alreadysql) > 0) {
                if ($imgname == '') {
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`parent_side_one` = '$parent_side_one',`parent_side_two` = '$parent_side_two',`user_id`='$user_id'
                                 WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                } else {
                    $alreadysql2 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                    if (mysqli_num_rows($alreadysql2) > 0) {
                        while ($fetch2 = mysqli_fetch_assoc($alreadysql2)) {
                            $fname = $fetch2['firstname'];
                            $lname = $fetch2['lastname'];
                            $mname = $fetch2['middlename'];
                            $suf = $fetch2['suffix'];
                            $relationdb = $fetch2['relationship'];
                            if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                                mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            } else {
                                $query = "UPDATE `family_member` SET `firstname`='$firstname',
                                `middlename`='$middlename',`lastname`='$lastname',`suffix`='$suffix',`date_of_birth`='$date_of_birth_year-$date_of_birth_month-$date_of_birth_day',
                                `date_of_death`='$date_of_death_year-$date_of_death_month-$date_of_death_day',`email`='$email',
                                `gender`='$gender',`relationship`='$selected_option1',`He-is-your`='$selected_option1',`parent_side_one` = '$parent_side_one',`parent_side_two` = '$parent_side_two',`user_id`='$user_id',
                                `image`='$imgname' WHERE `user_id` = '$user_id' AND `relationship` = '$selected_option1' AND `gender` = '$gender'";
                            }
                        }
                    }
                }
            } else {
                $alreadysql3 = mysqli_query($con, "SELECT * FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` != '$selected_option1'");
                if (mysqli_num_rows($alreadysql3) > 0) {
                    while ($fetch3 = mysqli_fetch_assoc($alreadysql3)) {
                        $fname = $fetch3['firstname'];
                        $lname = $fetch3['lastname'];
                        $mname = $fetch3['middlename'];
                        $suf = $fetch3['suffix'];
                        $relationdb = $fetch3['relationship'];
                        if ($fname == $firstname && $lname == $lastname && $selected_option1 != $relationdb) {
                            mysqli_query($con, "DELETE FROM `family_member` WHERE `user_id` = '$user_id' AND `relationship` = '$relationdb' AND `firstname` = '$firstname' AND `lastname` = '$lastname'");
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`They-are-your`, `parent_side_one`,`parent_side_two`,`user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$parent_side_one','$parent_side_two','$user_id','$imgname')";
                        } else {
                            $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`,`gender`,`relationship`,`They-are-your`, `parent_side_one`,`parent_side_two`,`user_id`, `image`)
                            VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_birth_day','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$gender','$selected_option1','$selected_option1','$parent_side_one','$parent_side_two','$user_id','$imgname')";
                        }
                    }
                }
            }
        }
        //die();
        $execute = mysqli_query($con, $query);
        //die();
        if ($execute) {

            //die();
            header("location: /family/$username");
            exit;
        } else {

            $_SESSION['family_error_message'] = "Failed To add New Family Member!";
            header("location:/edit-family-member/");
            exit;
        }
    }
}
