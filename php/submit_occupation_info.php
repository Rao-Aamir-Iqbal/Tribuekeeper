<?php
// Start the session and include the database connection file
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$user_id = $_SESSION['user_id'];

$sql_occupy = "SELECT * FROM `occupation` WHERE `user_id`='$user_id'";
$exe_occupy = mysqli_query($con, $sql_occupy);
$table_ids = array(); // Create an array to store all the table ids
while($fetch_occupy = mysqli_fetch_assoc($exe_occupy)){
    $table_id = $fetch_occupy['id'];
    $table_user_id = $fetch_occupy['user_id'];
    array_push($table_ids, $table_id); // Add the current table id to the array

    // Check if the current table id is not in the main_id array
    if(!in_array($table_id, $_POST['mainID'])){
        // Delete the record with the current table id
        $sql_delete = "DELETE FROM `occupation` WHERE `id`='$table_id'";
        mysqli_query($con, $sql_delete);
    }
}

// Get the form data
if(isset($_POST['occupation']) && isset($_POST['company']) && isset($_POST['occu_from_year']) && isset($_POST['occu_to_year'])){
    $main_ids = $_POST['mainID']; 
    $occupations = $_POST['occupation']; 
    $companies = $_POST['company']; 
    $from_years = $_POST['occu_from_year']; 
    $to_years = $_POST['occu_to_year']; 
    
    foreach ($main_ids as $key => $main_id){
        if(empty($main_id)){
            $sql = "INSERT INTO `occupation` (`user_id`, `occupation`, `company`, `from_year`, `to_year`) VALUES ('$user_id', '$occupations[$key]', '$companies[$key]', '$from_years[$key]', '$to_years[$key]')";
            mysqli_query($con, $sql);
        } else {
            // Check if the current main id is in the table ids array
            if(in_array($main_id, $table_ids)){
                // Update the record with the current main id
                $sql = "UPDATE `occupation` SET `occupation`='$occupations[$key]', `company`='$companies[$key]', `from_year`='$from_years[$key]', `to_year`='$to_years[$key]' WHERE `id`='$main_id'";
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