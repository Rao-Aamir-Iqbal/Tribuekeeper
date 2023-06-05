<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_FILES['Profile'])) {
    $allowedFormats = ['jpg', 'jpeg', 'png'];
    $imgname = $_FILES['Profile']['name'];
    $extension = strtolower(pathinfo($imgname, PATHINFO_EXTENSION));

    // Validate file format
    if (!in_array($extension, $allowedFormats)) {
      echo "<p style='color: #FF0000;'>Invalid file format. Only JPG, JPEG, and PNG files are allowed.</p>";
      exit;
    }

    $randomno = rand(0, 100000);
    $rename = 'Upload' . date('Ymd') . $randomno;
    $newname = $rename . '.' . $extension;
    $filename = $_FILES['Profile']['tmp_name'];

    move_uploaded_file($filename, '../assets/profile/' . $newname);

    // Prepare the SQL statement using prepared statements
    $sql = "UPDATE `users` SET image = ? WHERE ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $newname, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
      echo "<p style='color: #008800;'>Profile Picture Updated Successfully!</p>";
    } else {
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
  }
}

  if (isset($_FILES['Cover'])) {
    $allowedFormats = ['jpg', 'jpeg', 'png'];
    $imgname = $_FILES['Cover']['name'];
    $extension = strtolower(pathinfo($imgname, PATHINFO_EXTENSION));

    // Validate file format
    if (!in_array($extension, $allowedFormats)) {
        echo "<p style='color: #FF0000;'>Invalid file format. Only JPG, JPEG, and PNG files are allowed.</p>";
        exit;
    }

    $randomno = rand(0, 100000);
    $rename = 'Upload' . date('Ymd') . $randomno;
    $newname = $rename . '.' . $extension;
    $filename = $_FILES['Cover']['tmp_name'];

    move_uploaded_file($filename, '../uploads/' . $newname);

    // Prepare the SQL statement using prepared statements
    $sql = "UPDATE `users` SET cover_image = ? WHERE ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $newname, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<p style='color: #008800;'>Cover Picture Updated Successfully!</p>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}




if(isset($_POST["cover-picture"])){
  $profilePicture = $_POST["cover-picture"];
  $filename = basename($profilePicture);
  // echo $filename; // outputs "8-200x200.jpg"
  // code to update the user's profile picture in the database
  $sql3= "UPDATE `users` SET `cover_image`='$filename' WHERE ID = $user_id";
  $exe3 = mysqli_query($con, $sql3);
  if($exe3){
    echo "<p style='color: #008800;'>Cover Picture Updated Successfully!</p>";
  }
}

if(isset($_POST['setload'])){
  $sql = "SELECT * FROM `users` WHERE ID = $user_id";
  $exe = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($exe);
  $image = $fetch['image'];

  // Echo the image tag
  echo "<img class='pro-img' src='/assets/profile/$image' alt=''>";

}

if(isset($_POST['setload2'])){
  $sql = "SELECT * FROM `users` WHERE ID = $user_id";
  $exe = mysqli_query($con, $sql);
  $fetch = mysqli_fetch_assoc($exe);
  $coverimage = $fetch['cover_image'];

  // Echo the image tag
  echo "<img class='cover_image' src='/uploads/$coverimage' alt=''>";

}





$con->close();
?>
