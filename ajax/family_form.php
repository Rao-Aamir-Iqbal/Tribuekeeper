<?php
session_start();
$user_id = $_SESSION['user_id'];
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
//  $output = "";
//  if (isset($_POST['submit'])) {
//     extract($_POST);

//     $response = array();

//     if ($_POST['firstname'] != '' && $_POST['lastname'] != '') {
//         $imgname = $_FILES['image']['name'];
//         $extension = pathinfo($imgname, PATHINFO_EXTENSION);
//         $randomno = rand(0, 100000);
//         $rename = 'Upload' . date('Ymd') . $randomno;
//         $newname = $rename . '.' . $extension;
//         $filename = $_FILES['image']['tmp_name'];
//         move_uploaded_file($filename, '../assets/profile/' . $newname);

//         $query = "INSERT INTO `family_member`( `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`, `user_id`, `image`) VALUES ('$firstname','$middlename','$lastname','$suffix','$date_of_birth_year-$date_of_birth_month-$date_of_death_year','$date_of_death_year-$date_of_death_month-$date_of_death_day','$email','$user_id','$newname')";
//         $execute = mysqli_query($con, $query);

//         if ($execute) {
//             $response['status'] = 'success';
//             $response['image'] = $newname;
//         } else {
//             $response['status'] = 'failed';
//         }
//     }

//     echo json_encode($response);
// }

// Retrieve the data sent via POST
$form = $_POST['form'];
$field = $_POST['field'];
$myHiddenFieldValue = $_POST['myHiddenFieldValue'];

// Perform any required processing on the data
// ...

// Send a response back to the AJAX request
$response = array('message' => 'Data received successfully');
echo json_encode($response);




// if (isset($_POST['hiddenFieldValue'])) {
//     $hiddenFieldValue = $_POST['hiddenFieldValue'];
//     echo $hiddenFieldValue;
// }
