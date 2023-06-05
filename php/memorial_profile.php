<?php
session_start();
$user_id = $_SESSION['user_id'];
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    if (isset($_POST['memorial_textarea']) && isset($_POST['textbox2']) && isset($_POST['status']) && !empty($_POST['status'])) {
        $memorial = $_POST['memorial_textarea'];
        $favoriteSaying = $_POST['textbox2'];
        $status = $_POST['status'];

        // Escape special characters to prevent SQL injection
        $memorial = mysqli_real_escape_string($con, $memorial);
        $favoriteSaying = mysqli_real_escape_string($con, $favoriteSaying);
        $status = mysqli_real_escape_string($con, $status);

        $sql34 = mysqli_query($con, "SELECT * FROM profile_memorial WHERE `user_id`= '$user_id'");
        if (mysqli_num_rows($sql34) > 0) {
            $update23 = mysqli_query($con, "UPDATE `profile_memorial` SET `user_id`='$user_id',`memorial_textarea`=' $memorial',`favorite_saying`='$favoriteSaying',`status`='$status' WHERE `user_id`='$user_id'");
            if ($update23) {
                echo "<p style='color: #008800;'>Data Saved <span class='ti-check bold'></span></p>";
            } else {
                echo "<p style='color: #FF0000;'>Error: ' . $sql . '<br>' . mysqli_error($con)</p>";
            }
        } else {
        
            // Perform the database query
            $sql = "INSERT INTO profile_memorial (user_id, memorial_textarea, favorite_saying, status) VALUES ('$user_id', '$memorial', '$favoriteSaying', '$status')";

            if (mysqli_query($con, $sql)) {
                echo "<p style='color: #008800;'>Data Saved <span class='ti-check bold'></span></p>";
            } else {
                echo "<p style='color: #FF0000;'>Error: ' . $sql . '<br>' . mysqli_error($con)</p>";
            }
        }
    } 
    mysqli_close($conn);
}
