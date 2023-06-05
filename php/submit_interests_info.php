<?php
// Start the session and include the database connection file
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$user_id = $_SESSION['user_id'];

$sql_occupy = "SELECT * FROM `interests` WHERE `user_id`='$user_id'";
$exe_occupy = mysqli_query($con, $sql_occupy);
$table_ids = array(); // Create an array to store all the table ids
while($fetch_occupy = mysqli_fetch_assoc($exe_occupy)){
    $table_id = $fetch_occupy['id'];
    $table_user_id = $fetch_occupy['user_id'];
    array_push($table_ids, $table_id); // Add the current table id to the array

    // Check if the current table id is not in the main_id array
    if(!in_array($table_id, $_POST['mainID2'])){
        // Delete the record with the current table id
        $sql_delete = "DELETE FROM `interests` WHERE `id`='$table_id'";
        mysqli_query($con, $sql_delete);
    }
}

// Get the form data
if(isset($_POST['interest_name'])){
    $main_ids = $_POST['mainID2']; 
    $interest_name = $_POST['interest_name']; 

    
    foreach ($main_ids as $key => $main_id){
        if(empty($main_id)){
            $sql = "INSERT INTO `interests` (`user_id`, `interest_name`) VALUES ('$user_id', '$interest_name[$key]')";
            mysqli_query($con, $sql);
        } else {
            // Check if the current main id is in the table ids array
            if(in_array($main_id, $table_ids)){
                // Update the record with the current main id
                $sql = "UPDATE `interests` SET `interest_name`='$interest_name[$key]' WHERE `id`='$main_id'";
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