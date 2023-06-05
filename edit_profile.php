<?php

  session_start();
  
?>
<style>
  .is-invalid {
    outline: 2px solid red;
  }
</style>
<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

if (!$_SESSION['user_id']) {
  header("location: /login");
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `users` WHERE id = $user_id";
$exe = mysqli_query($con, $sql);

if (!$exe) {
  // handle query error
  echo "Error executing query: " . mysqli_error($con);
  // you might want to log the error instead of displaying it to the user
} else {
  if (mysqli_num_rows($exe) > 0) {
    $fetch = mysqli_fetch_assoc($exe);
    $suffix = $fetch['suffix'];
    $firstname = $fetch['firstname'];
    $username = $fetch['username'];
    $middlename = $fetch['middlename'];
    $lastname = $fetch['lastname'];
    $gender = $fetch['gender'];
    $date_of_birth = $fetch['date_of_birth'];
  } else {
    // handle no data found error
    echo "No data found for user ID: " . $user_id;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile |<?php echo $firstname ." ". $lastname?></title>
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/js/script.js">
  <link rel="stylesheet" href="/assets/css/footer.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/assets/css/themify-icons.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


</head>

<body>

  <?php

  require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/subheader.php';

  ?>

  <section class="">

    <div class="container py-5">
      <div class="row d-flex justify-content-center align-items-center">
            <div class="card">


              <?php     require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/editheader.php'; ?>
    
              <div class=" row pt-4 text-black" id="basic-information">
                  <div class=" col-md-12 ">
                    <div class="p-4 edit-profile-border">
                      <div class="row" style="padding-right:-35px;">
                        <div class="col-md-12 hr-div">
                          <h3 class="pt-3">Basic information</h3>
                        </div>
                        <div class="hr-div">
                          <hr>
                        </div>
                        <form action="" id="basic_info" method="post">
                          <div class="hr-div" style="margin:-12px;">
                            <div class="row py-4">
                              <div class="col-md-4 mb-4">
                                <div class="form-outline">
                                  <input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>"
                                    placeholder="First Name" class="form-control form-control-lg edit-prof-input-1" />
                                  <div id="firstname_error"></div>
                                </div>
                              </div>
                              <div class="col-md-4 mb-4">
                                <div class="form-outline">
                                  <input type="text" id="middlename" name="middlename" value="<?php echo $middlename; ?>"
                                    placeholder="Middle Name" class="form-control form-control-lg edit-prof-input-1 " />
                                </div>
                              </div>
                              <div class="col-md-4 mb-4 ">
                                <div class="form-outline">
                                  <input type="text" id="lastname" name="lastname" value="<?php echo $lastname; ?>"
                                    placeholder="Last Name" class="form-control form-control-lg edit-prof-input-1" />
                                  <div id="lastname_error"></div>
                                </div>
                              </div>
                              <div class="col-md-4 mb-4 ">
                                <div class="form-outline">
                                  <input type="text" id="username" name="username" value="<?php echo $username; ?>"
                                    placeholder="User Name" class="form-control form-control-lg edit-prof-input-1" />
                                  <div id="username_error"></div>
                                </div>
                              </div>
                              <div class="col-md-4  mb-4 ">
                                <div class="form-outline">
                                  <input type="text" id="suffix" name="suffix" value="<?php echo $suffix; ?>"
                                    placeholder="Suffix (Jr., M.D., etc.):"
                                    class="form-control form-control-lg edit-prof-input-1" />
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-outline">
                                <label for="" class="mb-2 fw-bold ms-1">Date of Birth</label>
                                  <input type="date" id="dob" name="dob" value="<?php echo $date_of_birth; ?>"
                                    placeholder="dd/mm/yy" class="form-control form-control-lg edit-prof-input-1" />
                                </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="dropdown form-outline">
                                      <select class="form-select prof-buttonoggle form-control form-control-lg edit-prof-input-1 fld-mar" type="text" name="privacy_settings" id="privacy_settings" data-bs-toggle="dropdown" aria-expanded="false">
                                        <option selected>Make Public</option>
                                        <option value="1">Make Public</option>
                                        <option value="2">Make Private</option>
                                        <option value="3">Only Me</option>
                                      </select>
                                    </div>
                                   
                              </div>
                              <div class="d-md-flex justify-content-start align-items-center mt-4 mb-4 pb-2"
                                style="margin-left: 10px;">
                                <h6 class="mb-0 me-4">Gender: </h6>
                                <div class="form-check form-check-inline mb-0 me-4">
                                  <input class="form-check-input edit-prof-input-button" type="radio" name="gender"
                                    id="maleGender" value="male" <?php if ($gender == "male")
                                      echo "checked"; ?> />
                                  <label class="form-check-label" for="maleGender">Male</label>
                                </div>
                                <div class="form-check form-check-inline mb-0 me-4">
                                  <input class="form-check-input edit-prof-input-button" type="radio" name="gender"
                                    id="femaleGender" value="female" <?php if ($gender == "female")
                                      echo "checked"; ?> />
                                  <label class="form-check-label" for="femaleGender">Female</label>
                                </div>
                                <div class="form-check form-check-inline mb-0">
                                  <input class="form-check-input edit-prof-input-button" type="radio" name="gender"
                                    id="otherGender" value="other" <?php if ($gender == "other")
                                      echo "checked"; ?> />
                                  <label class="form-check-label" for="otherGender">Other</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="hr-div">
                            <button class="prof-button" type="submit" name="submit">Save Changes</button>
                          </div>
                          <div id="success_message" class="sav-dta" style="position: absolute; left: 200px; bottom: 37px;">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              
              <div class=" row pt-4 text-black d-none">
                <div class=" col-md-12 ">
                  <div class="p-4 edit-profile-border">
                    <div class="row">
                      <div class="col-md-12 hr-div">
                        <h3 class="pt-3">Edit Your Profile</h3>
                      </div>
                      <div class="hr-div">
                        <hr>
                      </div>
                      <div class="hr-div">
                        <div class="mb-3">
                          <input style="width: 200px;" type="text" id="" name="" value="" placeholder=""
                            class="form-control edit-prof-input-1" />
                        </div>
                        <div class="">
                          <iframe class=""
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3381.409896172155!2d72.70581527459777!3d32.058160520377186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x392177fe8abb9b7b%3A0x70eb72e1b437eb99!2z2YLbjNmG2obbjCDZhdmI2pE!5e0!3m2!1sen!2s!4v1681554658500!5m2!1sen!2s"
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                      </div>
                      <div class="hr-div">
                        <button type="submit" name="occupation_save" id="occupation_save" class="mt-4 prof-button">Save
                          Changes</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- *****************************  Occupational History Start **************************************-->
              <div class=" row pt-4 text-black" id="occupation">
                <div class=" col-md-12 ">
                  <div class="p-4 edit-profile-border" style="position: relative;">
                    <?php
                    // Fetch the occupation data for the user
                    $sql = "SELECT * FROM `occupation` WHERE `user_id` = '$user_id'";
                    $result = mysqli_query($con, $sql);
                    $occupation_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
                    // Generate the input fields dynamically
                    $html = '';
                    foreach ($occupation_data as $row) {
                      $html .= '<tr>';
                      $html .= '<td><input class="form-control frm-ctrl" type="text" name="occupation[]"  value="' . $row['occupation'] . '"><input class="form-control" type="hidden" name="mainID[]"  value="' . $row['id'] . '"></td>';
                      $html .= '<td><input class="form-control frm-ctrl" type="text" name="company[]"  value="' . $row['company'] . '"></td>';
                      $html .= '<td><input class="form-control frm-ctrl" type="text" name="occu_from_year[]"  value="' . $row['from_year'] . '"></td>';
                      $html .= '<td><input class="form-control frm-ctrl" type="text" name="occu_to_year[]"  value="' . $row['to_year'] . '"></td>';
                      $html .= '<td><i class="ti-close" type="button" name="remove" id="remove" value="remove"></i></td>';
                      $html .= '</tr>';
                    }
    
                    // Output the input fields
                    echo '
    <form class="insert-form" id="occupation_form" method="post" action="">
        <div class="row">
            <div class="col-md-12 hr-div">
                <h3 class="pt-3"> Occupational History</h3>
            </div>
            <div class="hr-div">
                <hr>
            </div>
            <div class="hr-div">
                <div class="input-field">
                    <table class="table-sm" id="table_field">
                        <tr>
                            <th>Occupation</th>
                            <th>Company</th>
                            <th>From Year</th>
                            <th>To Year</th>
                            <th>&nbsp;</th>
                        </tr>
                        ' . $html . '
                    </table>
                </div>
                <a type="button" name="add" id="add" value="Add" class="ti-plus blue prof-link pt-2">Add occupation</a>
            </div>
            <div class="hr-div">
                <button type="submit" name="occupation_save" id="occupation_save" class="mt-4 prof-button">Save Changes</button>
            </div>
        </div>
    </form>
    ';
                    ?>
                    <div id="success_msg" class="sav-dta" style="margin-left:16px; ">
                    </div>
                  </div>
                </div>
              </div>
              <!-- *****************************  Academic History Start **************************************-->
              <div class=" row pt-4 text-black" id="academic-history">
                <div class=" col-md-12 ">
                  <div class="p-4 edit-profile-border" style="position: relative;">
                    <?php
                    // Fetch the Academic data for the user
                    $sql = "SELECT * FROM `academic_history` WHERE `user_id` = '$user_id'";
                    $result = mysqli_query($con, $sql);
                    $academic_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
                    // Generate the input fields dynamically
                    $academic = '';
                    foreach ($academic_data as $row5) {
                      $academic .= '<tr>';
                      $academic .= '<td><input class="form-control frm-ctrl" type="text" name="diploma[]"  value="' . $row5['diploma'] . '"><input class="form-control" type="hidden" name="mainID5[]"  value="' . $row5['id'] . '"></td>';
                      $academic .= '<td><input class="form-control frm-ctrl" type="text" name="school[]" value="' . $row5['school'] . '"></td>';
                      $academic .= '<td><input class="form-control frm-ctrl" type="text" name="from_year[]" value="' . $row5['from_year'] . '"></td>';
                      $academic .= '<td><input class="form-control frm-ctrl" type="text" name="to_year[]" value="' . $row5['to_year'] . '"></td>';
                      $academic .= '<td><i class="ti-close" type="button" name="remove5" id="remove5" value="remove5"></i></td>';
                      $academic .= '</tr>';
                    }
    
                    // Output the input fields
                    echo '
    <form class="insert-form" id="academic_form" method="post" action="">
        <div class="row">
            <div class="col-md-12 hr-div">
                <h3 class="pt-3"> Academic History</h3>
            </div>
            <div class="hr-div">
                <hr>
            </div>
            <div class="hr-div">
                <div class="input-field">
                    <table class="table-sm" id="academic_field">
                        <tr>
                            <th>Diploma</th>
                            <th>School</th>
                            <th>From Year</th>
                            <th>To Year</th>
                            <th>&nbsp;</th>
                        </tr>
                        ' . $academic . '
                    </table>
                </div>
                <a type="button" name="add5" id="add5" value="Add5" class="ti-plus blue prof-link pt-2"> Add academic</a>
            </div>
             <div  class="hr-div">
            <button type="submit" name="academic_save" id="academic_save" class="mt-4 prof-button">Save Changes</button>
             </div>
        </div>
    </form>
    ';
                    ?>
                    <div id="success_msg5" class="sav-dta" style="margin-left:16px; ">
                    </div>
                  </div>
                </div>
              </div>
              <!-- *****************************  MileStones Start **************************************-->
              <div class=" row pt-4 text-black" id="milestones">
                <div class=" col-md-12 ">
                  <div class="p-4 edit-profile-border" style="position: relative;">
                    <?php
                    // Fetch the occupation data for the user
                    $sql = "SELECT * FROM `milestones` WHERE `user_id` = '$user_id'";
                    $result = mysqli_query($con, $sql);
                    $milestones_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
                    // Generate the input fields dynamically
                    $milestone = '';
                    foreach ($milestones_data as $fetchh) {
                      $milestone .= '<tr id="mile_tr">';
                      $milestone .= '<td><input class="form-control frm-ctrl" type="text" name="description[]" value="' . $fetchh['description'] . '"><input class="form-control" type="hidden" name="mainID1[]" value="' . $fetchh['id'] . '"></td>';
                      $milestone .= '<td><input class="form-control frm-ctrl" type="text" name="year[]" value="' . $fetchh['year'] . '"></td>';
                      $milestone .= '<td><i class="ti-close" type="button" name="remove1" id="remove1" value="remove1"></i></td>';
                      $milestone .= '</tr>';
                    }
    
                    // Output the input fields
                    echo "
                    <form class='insert-form' id='milestones_form' method='post' action=''>
                        <div class='row'>
                            <div class='col-md-12 hr-div'>
                                <h3 class='pt-3'> Milestones </h3>
                            </div>
                            <div class='hr-div'>
                                <hr>
                            </div>
                            <div class='hr-div'>
                            <p class='py-3'>A milestone is a significant event in a person's life. For example: a wedding date
                            or winning award!</p>
                                <div class='input-field'>
                                    <table class='table-sm' id='milestone_field'>
                                        <tr>
                                            <th>Milestones</th>
                                            <th>Year</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        " . $milestone . "
                                    </table>
                                </div>
                                <a type='button' name='add1' id='add1' value='Add1' class='ti-plus blue prof-link pt-2'>Add milestone line</a>
                            </div>
                             <div  class='hr-div'>
                            <button type='submit' name='milestones_save' id='milestones_save' class='mt-4 prof-button'>Save Changes</button>
                         </div>
                        </div>
                    </form>
                    ";
    
                    ?>
                    <div id="success_msg1" class="sav-dta" style="margin-left:16px; ">
                    </div>
                  </div>
                </div>
              </div>
              <div class=" row pt-4 text-black">
                <div class=" col-md-12 ">
                  <div class="p-4 edit-profile-border" style="position: relative;">
    
    
                    <?php
                    $sql = "SELECT religion FROM users WHERE id=$user_id";
                    $result = $con->query($sql);
    
                    if ($result->num_rows > 0) {
                      $row = $result->fetch_assoc();
                      $_SESSION['religion'] = $row['religion'];
                    }
                    ?>
    
    
    
    
                    <form action="" method="post" id="religion_form" id="religion">
                      <div class="row">
                        <div class="col-md-12 hr-div">
                          <h3 class="pt-3">Religious Views</h3>
                        </div>
                        <div class="hr-div">
                          <hr>
                        </div>
                        <div class="regional_class hr-div">
                          <p>Religious Views:</p>
                          <div class="col-md-8">
                            <div style="display: flex; align-items: center;">
                              <input id="radio-religion-choice " name="radio-religion" type="radio"
                                style="margin-right: 10px;" checked>
                              <select id="religion-id" name="religion" class="form-control form-select input-alone"
                                title="Enter your religion" data-bind="value: religion_id">
                                <option value=""></option>
                                <option value="Islam" <?php if ($_SESSION['religion'] == 'Islam')
                                  echo 'selected'; ?>>Islam
                                </option>
                                <option value="Buddhism" <?php if ($_SESSION['religion'] == 'Buddhism')
                                  echo 'selected'; ?>>
                                  Buddhism</option>
                                <option value="Chinese_folk_religion" <?php if ($_SESSION['religion'] == 'Chinese_folk_religion')
                                  echo 'selected'; ?>>Chinese folk
                                  religion</option>
                                <option value="Christianity" <?php if ($_SESSION['religion'] == 'Christianity')
                                  echo 'selected'; ?>>Christianity</option>
                                <option value="Hinduism" <?php if ($_SESSION['religion'] == 'Hinduism')
                                  echo 'selected'; ?>>
                                  Hinduism</option>
                                <option value="Agnostic" <?php if ($_SESSION['religion'] == 'Agnostic')
                                  echo 'selected'; ?>>
                                  Agnostic</option>
                                <option value="Atheist" <?php if ($_SESSION['religion'] == 'Atheist')
                                  echo 'selected'; ?>>
                                  Atheist</option>
                                <option value="Catholicism" <?php if ($_SESSION['religion'] == 'Catholicism')
                                  echo 'selected'; ?>>Catholicism</option>
                                <option value="Eastern_Orthodox" <?php if ($_SESSION['religion'] == 'Eastern_Orthodox')
                                  echo 'selected'; ?>>Eastern Orthodox</option>
                                <option value="Judaism" <?php if ($_SESSION['religion'] == 'Judaism')
                                  echo 'selected'; ?>>
                                  Judaism</option>
                                <option value="New_Age" <?php if ($_SESSION['religion'] == 'New_Age')
                                  echo 'selected'; ?>>New
                                  Age</option>
                                <option value="Protestantism" <?php if ($_SESSION['religion'] == 'Protestantism')
                                  echo 'selected'; ?>>Protestantism</option>
                                <option value="Sikhism" <?php if ($_SESSION['religion'] == 'Sikhism')
                                  echo 'selected'; ?>>
                                  Sikhism</option>
                              </select>
                            </div>
                            <p class="small mt-3">Your Religious Views are not there? Enter them here:</p>
                            <div style="display: flex; align-items: center;">
                              <input id="radio-religion-custom" name="radio-religion" type="radio"
                                style="margin-right: 10px;">
                              <input id="custom-religion" name="custom-religion" type="text"
                                class="form-control input-alone" title="Enter your custom religion"
                                data-bind="value: custom_religion" <?php
                                if (!in_array($_SESSION['religion'], ['Islam', 'Buddhism', 'Chinese_folk_religion', 'Christianity', 'Hinduism', 'Agnostic', 'Atheist', 'Catholicism', 'Eastern_Orthodox', 'Judaism', 'New_Age', 'Protestantism', 'Sikhism'])) {
                                  echo 'value="' . $_SESSION['religion'] . '"';
                                }
                                ?> />
                            </div>
                          </div>
    
                        </div>
                        <div class="hr-div">
                          <button class="mt-4 prof-button" type="submit" name="submit">Save Changes</button>
                        </div>
    
                      </div>
                    </form>
                    <div id="success_msg7" class="sav-rign-dta" style="margin-left:16px; "></div>
                  </div>
                </div>
              </div>
              <div class=" row pt-4 text-black" id="interests">
                <div class=" col-md-12 ">
                  <div class="p-4 edit-profile-border" style="position:relative;">
                    <?php
                    // Fetch the occupation data for the user
                    $sql = "SELECT * FROM `interests` WHERE `user_id` = '$user_id'";
                    $result = mysqli_query($con, $sql);
                    $interests_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
                    // Generate the input fields dynamically
                    $interest = '';
                    foreach ($interests_data as $take) {
                      $interest .= '<tr id="mile_tr">';
                      $interest .= '<td><input class="form-control frm-ctrl" type="text" name="interest_name[]" value="' . $take['interest_name'] . '"><input class="form-control" type="hidden" name="mainID2[]" value="' . $take['id'] . '"></td>';
                      $interest .= '<td><i class="ti-close" type="button" name="remove2" id="remove2" value="remove2"></i></td>';
                      $interest .= '</tr>';
                    }
                    // Output the input fields
                    echo "
                    <form class='insert-form' id='interest_form' method='post' action=''>
                        <div class='row'>
                            <div class='col-md-12 hr-div'>
                                <h3 class='pt-3'> Interests </h3>
                            </div>
                            <div class='hr-div'>
                                <hr>
                            </div>
                            <div class='hr-div'>
                                <div class='input-field'>
                                    <table class='table-sm' id='interest_field'>
                                        <tr>
                                            <th>Interest Name</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        " . $interest . "
                                    </table>
                                </div>
                                <a type='button' name='add2' id='add2' value='Add2' class='ti-plus blue prof-link pt-2'>Add interest</a>
                            </div>
                             <div  class='hr-div'>
                            <button type='submit' name='interest_save' id='interest_save' class='mt-3  prof-button'>Save Changes</button>
                             </div>
                        </div>
                    </form>
                    ";
    
                    ?>
                    <div id="success_msg2" class="sav-dta" style="margin-left:16px; ">
                    </div>
                  </div>
                </div>
              </div>
             </div>
      </div>
    </div>
               
           
  </section>
   
    <?php
    
        require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';
    
    ?>
  <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    $(document).ready(function () {
      // Basic Info Form Ajax Submission
      $('form#basic_info').submit(function (e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var formData = $(this).serialize(); // Get form data
        var error = false;

        // Validate firstname field
        var firstname = $('#firstname').val().trim();
        if (firstname == '') {
          error = true;
          $('#firstname').addClass('is-invalid');
          $('#firstname_error').html('<p style="color: red;">*Please enter your First Name.</p>'); // Add error message
          $('#firstname').focus();
        } else if (!/^[a-zA-Z ]*$/.test(firstname)) {
          error = true;
          $('#firstname').addClass('is-invalid');
          $('#firstname_error').html('<p style="color: red;">*Numbers are not accepted in First Name</p>'); // Add error message
          $('#firstname').focus();
        } else {
          $('#firstname').removeClass('is-invalid').addClass('is-valid');
          $('#firstname_error').html(''); // Remove error message
        }

        // Validate lastname field
        var lastname = $('#lastname').val().trim();
        if (lastname == '') {
          error = true;
          $('#lastname').addClass('is-invalid');
          $('#lastname_error').html('<p style="color: red;">*Please enter your Last Name.</p>'); // Add error message
          if (!error) {
            $('#lastname').focus();
          }
        } else if (!/^[a-zA-Z ]*$/.test(lastname)) {
          error = true;
          $('#lastname').addClass('is-invalid');
          $('#lastname_error').html('<p style="color: red;">*Numbers are not accepted in Last Name</p>'); // Add error message
          if (!error) {
            $('#lastname').focus();
          }
        } else {
          $('#lastname').removeClass('is-invalid').addClass('is-valid');
          $('#lastname_error').html(''); // Remove error message
        }

        var username = $('#username').val().trim();
        if (username == '') {
          error = true;
          $('#username').addClass('is-invalid');
          $('#username_error').html('<p style="color: red;">*Please enter your User Name.</p>'); // Add error message
          if (!error) {
            $('#username').focus();
          }
        } else if (!/^[a-zA-Z0-9]*$/.test(username)) {
          error = true;
          $('#username').addClass('is-invalid');
          $('#username_error').html('<p style="color: red;">*Space are not accepted in User Name</p>'); // Add error message
          if (!error) {
            $('#username').focus();
          }
        } else {
          $('#username').removeClass('is-invalid').addClass('is-valid');
          $('#username_error').html(''); // Remove error message
        }
        // If there is an error, stop the form from submitting and display error message
        if (error) {
          return false;
        }

        // Submit form data using AJAX
        $.ajax({
          url: '/php/submit_basic_info.php', // The PHP file that will handle the form data
          type: 'POST',
          data: formData,
          success: function (response) {
            // Handle the response from the PHP file
            console.log(response);
            $('#success_message').html(response); // Display success message on the page
          },
          error: function (xhr, status, error) {
            // Handle any errors that occurred during the AJAX request
            console.log(xhr.responseText);
          }
        });
      });






      // Occupation Start
      var html = '<tr><td><input class="form-control frm-ctrl" type="text" name="occupation[]" "><input class="form-control frm-ctrl" type="hidden" name="mainID[]" value="" ></td><td><input class="form-control frm-ctrl" type="text" name="company[]" ></td><td><input class="form-control frm-ctrl" type="text" name="occu_from_year[]" ></td><td><input class="form-control frm-ctrl" type="text" name="occu_to_year[]"></td><td><i class="ti-close" type="button" name="remove" id="remove" value="remove"></i></td></tr>';

      var max = 5;

      var x = 1;
      $('#add').click(function () {
        if (x <= max) {
          $('#table_field').append(html);
          x++;
        }
      });

      $('#table_field').on('click', '#remove', function () {
        $(this).closest('tr').remove();
        x--;
      });


      // Ajax for Occupation Form

      $('form#occupation_form').submit(function (event) {
        event.preventDefault(); // prevent default form submission

        var isFieldsValid = true; // flag to keep track of field validation

        $('input[name="occupation[]"], input[name="company[]"], input[name="occu_from_year[]"], input[name="occu_to_year[]"]').each(function () { // loop through each input field
          if ($(this).val() == '') { // check if the input value is empty
            isFieldsValid = false; // set flag to false if any input field is empty
            $(this).addClass('is-invalid'); // add validation class to the input field
          } else { // remove validation class if input value is not empty
            $(this).removeClass('is-invalid').addClass('is-valid');;
          }
        });

        var isValidYear = true; // flag to keep track of year field validation
        $('input[name="occu_from_year[]"], input[name="occu_to_year[]"]').each(function () { // loop through each year field
          var year = $(this).val();
          if (!$.isNumeric(year) || year < 1900 || year > 2050) { // check if the year is not a number or is not between 1900 and 2050
            isValidYear = false; // set flag to false if any year field is invalid
            $(this).addClass('is-invalid'); // add validation class to the year field
          } else { // remove validation class if year is valid
            $(this).removeClass('is-invalid').addClass('is-valid');;
          }
        });

        if (isFieldsValid && isValidYear) { // proceed with form submission if all fields are valid
          var formData = $(this).serialize(); // get form data
          $.ajax({
            url: '/php/submit_occupation_info.php', // replace with your PHP file
            type: 'POST',
            data: formData,
            success: function (response) {
              // handle successful response
              console.log(response);
              $('#success_msg').html(response); // Display success message on the page
            },
          });
        } else { // display error message if any input field is empty or any year field is invalid
          if (!isFieldsValid) {
            $('#success_msg').html('<p style="color: red;">*Please enter data in all Fields.</p>');
          } else {
            $('#success_msg').html('<p style="color: red;">*Year must be a valid date.</p>');
          }
        }
      });


      // Academic History Start For Dynamic Fields
      var academic = '<tr><td><input class="form-control frm-ctrl" type="text" name="diploma[]"><input class="form-control frm-ctrl" type="hidden" name="mainID5[]" value=""></td><td><input class="form-control frm-ctrl" type="text" name="school[]"></td><td><input class="form-control frm-ctrl" type="text" name="from_year[]"></td><td><input class="form-control frm-ctrl" type="text" name="to_year[]"></td><td><i class="ti-close" type="button" name="remove5" id="remove5" value="remove5"></i></td></tr>';

      var max5 = 5;

      var a = 1;
      $('#add5').click(function () {
        if (a <= max5) {
          $('#academic_field').append(academic);
          a++;
        }
      });

      $('#academic_field').on('click', '#remove5', function () {
        $(this).closest('tr').remove();
        a--;
      });

      // Validate Academic History Form

      $('form#academic_form').submit(function (event) {
        event.preventDefault(); // prevent default form submission

        var isFieldsValid = true; // flag to keep track of field validation

        $('input[name="diploma[]"], input[name="school[]"], input[name="from_year[]"], input[name="to_year[]"]').each(function () { // loop through each input field
          if ($(this).val() == '') { // check if the input value is empty
            isFieldsValid = false; // set flag to false if any input field is empty
            $(this).addClass('is-invalid'); // add validation class to the input field
          } else { // remove validation class if input value is not empty
            $(this).removeClass('is-invalid').addClass('is-valid');;
          }
        });

        var isValidYear = true; // flag to keep track of year field validation
        $('input[name="from_year[]"], input[name="to_year[]"]').each(function () { // loop through each year field
          var year = $(this).val();
          if (!$.isNumeric(year) || year < 1900 || year > 2050) { // check if the year is not a number or is not between 1900 and 2050
            isValidYear = false; // set flag to false if any year field is invalid
            $(this).addClass('is-invalid'); // add validation class to the year field
          } else { // remove validation class if year is valid
            $(this).removeClass('is-invalid').addClass('is-valid');;
          }
        });

        if (isFieldsValid && isValidYear) { // proceed with form submission if all fields are valid
          var formData = $(this).serialize(); // get form data
          $.ajax({
            url: '/php/submit_academic_info.php', // replace with your PHP file
            type: 'POST',
            data: formData,
            success: function (response) {
              // handle successful response
              console.log(response);
              $('#success_msg5').html(response); // Display success message on the page
            },
          });
        } else { // display error message if any input field is empty or any year field is invalid
          if (!isFieldsValid) {
            $('#success_msg5').html('<p style="color: red;">*Please enter data in all Fields.</p>');
          } else {
            $('#success_msg5').html('<p style="color: red;">*Year must be a valid date.</p>');
          }
        }
      });


      // Milestones Start For Dynamic Fields
      var description = '<?php echo $fetchh['description']; ?>';
      var year = '<?php echo $fetchh['year']; ?>';

      var milestone = '<tr><td><input class="form-control frm-ctrl" type="text" name="description[]" ><input class="form-control frm-ctrl" type="hidden" name="mainID1[]" value=""></td><td><input class="form-control frm-ctrl" type="text" name="year[]"></td><td><i class="ti-close" type="button" name="remove1" id="remove1" value="remove1"></i></td></tr>';

      var max1 = 5;
      var y = 1;

      $('#add1').click(function () {
        if (y <= max1) {
          $('#milestone_field').append(milestone);
          y++;
        }
      });

      $('#milestone_field').on('click', '#remove1', function () {
        $(this).closest('tr').remove();
        y--;
      });

      // Validate milestone year field
      function validateYearField(yearField) {
        var yearVal = yearField.val();
        var isValid = false;

        // check if year value is between 1900 and 2050 and is a number
        if ($.isNumeric(yearVal) && yearVal >= 1900 && yearVal <= 2050) {
          isValid = true;
        }

        return isValid;
      }

      // Ajax for Milestone Form

      $('form#milestones_form').submit(function (event) {
        event.preventDefault(); // prevent default form submission
        var isFieldsValid = true; // flag to keep track of field validation
        $('input[name="description[]"], input[name="year[]"]').each(function () { // loop through each dynamically generated input field
          if ($(this).val() == '') { // check if the input value is empty
            isFieldsValid = false; // set flag to false if any input field is empty
            $(this).addClass('is-invalid'); // add validation class to the input field
          } else {
            $(this).removeClass('is-invalid').addClass('is-valid'); // remove validation class and add valid class if input field is not empty
          }
        });

        var isYearValid = true; // flag to keep track of year field validation
        $('input[name="year[]"]').each(function () { // loop through each year field
          var yearField = $(this);
          var yearVal = yearField.val();
          if ((yearVal == '') || (yearVal != '' && (isNaN(yearVal) || yearVal < 1900 || yearVal > 2050))) { // check if the year value is empty or not valid
            isYearValid = false; // set flag to false if year value is not valid
            yearField.addClass('is-invalid'); // add validation class to the year field
          } else {
            yearField.removeClass('is-invalid').addClass('is-valid'); // remove validation class and add valid class if year field is not empty and valid
          }
        });

        if (isFieldsValid && isYearValid) { // proceed with form submission if all fields are valid
          var formData = $(this).serialize(); // get form data
          $.ajax({
            url: '/php/submit_milestones_info.php', // replace with your PHP file
            type: 'POST',
            data: formData,
            success: function (response) {
              // handle successful response
              console.log(response);
              $('#success_msg1').html(response); // Display success message on the page
            },
          });
        } else if (!isFieldsValid) { // display generic error message if any input field is empty
          $('#success_msg1').html('<p style="color: red;">*Please enter data in all Fields.</p>');
        } else { // display error message for year field if it is not valid
          $('#success_msg1').html('<p style="color: red;">*Year must be a valid date.</p>');
        }
      });

      // Remove validation classes on input field focus
      $('input[name="description[]"], input[name="year[]"]').focus(function () {
        $(this).removeClass('is-invalid is-valid');
      });

      $('input[name="year[]"]').on('input', function () {
        var yearField = $(this);
        var yearVal = yearField.val();
        if ((yearVal == '') || (yearVal != '' && (!isNaN(yearVal) && yearVal >= 1900 && yearVal <= 2050))) {
          yearField.removeClass('is-invalid').addClass('is-valid');
        } else {
          yearField.removeClass('is-valid').addClass('is-invalid');
        }
      });







      // Interests Start For Dynamic Fields
      var description = '<?php echo $take['interest_name']; ?>';

      var interest = '<tr><td><input class="form-control frm-ctrl" type="text" name="interest_name[]"><input class="form-control" type="hidden" name="mainID2[]" value=""></td><td><i class="ti-close" type="button" name="remove2" id="remove2" value="remove2"></i></td></tr>';

      var max2 = 5;
      var z = 1;

      $('#add2').click(function () {
        if (y <= max2) {
          $('#interest_field').append(interest);
          z++;
        }
      });

      $('#interest_field').on('click', '#remove2', function () {
        $(this).closest('tr').remove();
        z--;
      });
      // Interests End For Dynamic Fields
      // Ajax for Milestone Form

      $('form#interest_form').submit(function (event) {
        event.preventDefault();
        var isFieldsValid = true; // flag to keep track of field validation
        $('input[name="interest_name[]"]').each(function () { // loop through each dynamically generated input field
          if ($(this).val() == '') { // check if the input value is empty
            isFieldsValid = false; // set flag to false if any input field is empty
            $(this).addClass('is-invalid'); // add validation class to the input field
            $(this).removeClass('is-valid'); // remove is-valid class if present
          } else { // add is-valid class if input field is not empty
            $(this).removeClass('is-invalid'); // remove validation class from input field
            $(this).addClass('is-valid'); // add is-valid class to the input field
          }
        });

        if (isFieldsValid) { // proceed with form submission if all fields are valid
          var formData = $(this).serialize();
          $.ajax({
            url: '/php/submit_interests_info.php',
            type: 'POST',
            data: formData,
            success: function (response) {
              console.log(response);
              $('#success_msg2').html(response);
            },
          });
        } else { // display error message if any input field is empty
          $('#success_msg2').html('<p style="color: red;">*Please enter data in all Fields.</p>');
        }
      });

      // Remove validation class on input field focus
      $('input[name="interest_name[]"]').focus(function () {
        $(this).removeClass('is-invalid');
        $(this).removeClass('is-valid');
      });



      $(document).ready(function () {
        // check if custom religion is already set
        var customReligion = getCustomReligion();
        if (customReligion) {
          // set custom religion radio button and enable custom religion field
          $("#radio-religion-custom").prop("checked", true);
          $("#religion-id").prop("disabled", true);
          $("#custom-religion").prop("disabled", false);
          $("#custom-religion").val(customReligion);
        } else {
          // set default religion radio button and enable religion select field
          $("#radio-religion-choice").prop("checked", true);
          $("#religion-id").prop("disabled", false);
          $("#custom-religion").prop("disabled", true);
        }

        // Radio Button Disabled Functionality
        $("#radio-religion-choice").click(function () {
          $("#religion-id").prop("disabled", false);
          $("#custom-religion").prop("disabled", true);
          setCustomReligion('');
        });

        $("#radio-religion-custom").click(function () {
          $("#religion-id").prop("disabled", true);
          $("#custom-religion").prop("disabled", false);
        });

        // save custom religion on form submission
        $("#religion_form").submit(function () {
          if ($("#radio-religion-custom").prop("checked")) {
            var customReligion = $("#custom-religion").val();
            setCustomReligion(customReligion);
          }
        });

        // function to retrieve custom religion from cookie
        function getCustomReligion() {
          var customReligion = '';
          var cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)customReligion\s*\=\s*([^;]*).*$)|^.*$/, "$1");
          if (cookieValue) {
            customReligion = cookieValue.replace(/%20/g, ' ');
          }
          return customReligion;
        }

        // function to store custom religion in cookie
        function setCustomReligion(customReligion) {
          document.cookie = "customReligion=" + encodeURIComponent(customReligion) + "; path=/";
        }
      });

      $("form#religion_form").submit(function (event) {
        event.preventDefault(); // Prevent default form submission behavior


        if ($("#radio-religion-custom").prop("checked") && $("#custom-religion").val() == "") {
          $("#success_msg7").html('<p style="color: red;">*Please enter a custom religion.</p>');
          return;
        }

        if ($("#radio-religion-choice").prop("checked") && $("#religion-id").val() == "") {
          $("#success_msg7").html('<p style="color: red;">*Please select religion from dropdown menu.</p>');
          return;
        }
        // Get form data
        var formData = $(this).serialize();

        // Send AJAX request
        $.ajax({
          url: "/php/submit_religion_info.php", // Replace with your own PHP script that handles the form submission
          type: "POST",
          data: formData,
          success: function (response) {
            // Handle success response
            $("#success_msg7").html(response);
          },
          error: function (jqXHR, textStatus, errorThrown) {
            // Handle error response
            console.error(textStatus, errorThrown);
          }
        });
      });

      // Ends here
    });
  </script>
 
</body>
</html>