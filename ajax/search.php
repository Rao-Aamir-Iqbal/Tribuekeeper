<?php
session_start();
// $_SESSION['email_send_msg'] = "Please Check Your Email to Reset Password";
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/sendmail.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
$user_id = $_SESSION['user_id'];


if (isset($_POST['q'])) {
  //echo "sajdfl";
  $q = $_POST['q'];
  // echo $q;
  $search = str_replace(' ', '%', $q); // Replace spaces with wildcard character
  $sql = "SELECT * FROM users 
  WHERE (firstname LIKE '%" . $search . "%' 
         OR lastname LIKE '%" . $search . "%' 
         OR middlename LIKE '%" . $search . "%' 
         OR username LIKE '%" . $search . "%') 
    AND `ID` != '" . $user_id . "'";

  // $sql = "SELECT * FROM users WHERE (firstname LIKE '%" . $q . "%' OR lastname LIKE '%" . $q . "%' OR middlename LIKE '%" . $q . "%' OR username LIKE '%" . $q . "%')";
  $result = mysqli_query($con, $sql);

  // construct the HTML output for the search results
  $response = array();
  $output = "";
  $output4 = "";

  if (mysqli_num_rows($result) > 0) {
    //  $output = '';
    while ($row = mysqli_fetch_array($result)) {
      $output .= "<p class='mt-2'><a href='#' class='input-trigger text-decoration-none text-black' data-input='#" . $row['ID'] . "' data-gender='" . $row['gender'] . "' data-firstname='" . $row['firstname'] . "' data-lastname='" . $row['lastname'] . "'><div class='card custom-card shadow my-2 text-decoration-none' style='border-radius:0px;'>
       
      <div class='row g-0'>
          <div class='col-md-4'>";
      if ($row['image'] == '') {
        $output .= "<img src='/assets/profile/user.png' style='width:80px; height:80px;' class='img-fluid rounded-start m-2' alt='...'>";
      } else {
        $output .= "<img src='/assets/profile/" . $row['image'] . "' style='width:80px; height:80px;' class='img-fluid rounded-start m-2' alt='...'>
            ";
      }
      $output .= "</div>";
      $output .= "<div class='col-md-8'>
          <div class='card-body text-start fw-bold'>
            " . $row['firstname'] . " " . $row['lastname'] . "
            <div class='mt-2'>" . $row['date_of_birth'] . "-" . $row['date_of_death'] . "</div>
          </div>
        </div>
      </div></div> </a></p>";
      $output4 .= "<input id='" . $row['ID'] . "' name='input_id' type='text' class='form-control input-field' value='" . $row['ID'] . "' data-gender='" . $row['gender'] . "' data-firstname='" . $row['firstname'] . "' data-lastname='" . $row['lastname'] . "' placeholder='' style='display:none;'>
      <input type='hidden' id='genderInput' name='gender' value=''>
      ";
    }
  }

  // Add the separate response strings to the response array
  $response['output'] = $output;
  $response['output4'] = $output4;

  // send the response as a JSON object
  echo json_encode($response);
}


// if(isset($_POST['output4_id'])){
//   $output_id = $_POST['output4_id'];
//   echo $output_id;
// }