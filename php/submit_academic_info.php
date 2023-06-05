<?php
// Start the session and include the database connection file
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$user_id = $_SESSION['user_id'];

$sql_occupy = "SELECT * FROM `academic_history` WHERE `user_id`='$user_id'";
$exe_occupy = mysqli_query($con, $sql_occupy);
$table_ids = array(); // Create an array to store all the table ids
while($fetch_occupy = mysqli_fetch_assoc($exe_occupy)){
    $table_id = $fetch_occupy['id'];
    $table_user_id = $fetch_occupy['user_id'];
    array_push($table_ids, $table_id); // Add the current table id to the array

    // Check if the current table id is not in the main_id array
    if(!in_array($table_id, $_POST['mainID5'])){
        // Delete the record with the current table id
        $sql_delete = "DELETE FROM `academic_history` WHERE `id`='$table_id'";
        mysqli_query($con, $sql_delete);
    }
}

// Get the form data
if(isset($_POST['diploma'])){
    $main_ids = $_POST['mainID5']; 
    $diploma = $_POST['diploma']; 
    $school = $_POST['school']; 
    $from_year = $_POST['from_year']; 
    $to_year = $_POST['to_year']; 

    
    foreach ($main_ids as $key => $main_id){
        if(empty($main_id)){
            $sql = "INSERT INTO `academic_history` (`user_id`, `diploma`,`school`,`from_year`,`to_year`) VALUES ('$user_id', '$diploma[$key]','$school[$key]','$from_year[$key]','$to_year[$key]')";
            mysqli_query($con, $sql);
        } else {
            // Check if the current main id is in the table ids array
            if(in_array($main_id, $table_ids)){
                // Update the record with the current main id
                $sql = "UPDATE `academic_history` SET `diploma`='$diploma[$key]',`school`='$school[$key]',`from_year`='$from_year[$key]',`to_year`='$to_year[$key]' WHERE `id`='$main_id'";
                mysqli_query($con, $sql);
            } else {
                echo "Error: Invalid main ID";
            }
        }
    }
    echo "<p style='color: #008800;'>Data Saved!</p>";
} else {
    echo "Error: Form fields not set";
}

?>