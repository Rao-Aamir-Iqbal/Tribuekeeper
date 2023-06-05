<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

if (!$_SESSION['user_id']) {
    header("location: /login");
}

$user_id = $_SESSION['user_id'];
$gender = $_GET['gender'];
$get_id = $_GET['id'];
if ($gender == 'm') {
    $gendermodified = 'm';
}
if ($gender == 'f') {
    $gendermodified = 'f';
}
if ($gender == 'o') {
    $gendermodified = 'o';
}
if ($gender == 'male-father-side') {
    $gendermodified = 'm';
}
if ($gender == 'male-mother-side') {
    $gendermodified = 'm';
}
if ($gender == 'female-father-side') {
    $gendermodified = 'f';
}
if ($gender == 'female-mother-side') {
    $gendermodified = 'f';
}
//die();

$sql = "SELECT * FROM `users` WHERE ID = '" . $_SESSION['user_id'] . "'";
$exe = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($exe);

$firstname = $fetch['firstname'];
$username = $fetch['username'];
$middlename = $fetch['middlename'];
$lastname = $fetch['lastname'];


$relationship = $_GET['relationship'];
//echo $relationship;
//die()

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Family page</title>
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link rel="stylesheet" href="/assets/js/script.js" />
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/themify-icons.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        .profile-image {
            width: 125px;
            height: 125px;
            display: inline-block;
            border: 3px solid #eee;
            box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);
            border-radius: 50%;
            background-color: white;
        }

        #search-results {
            max-height: 200px;
            /* set a fixed height for the dropdown */
            overflow-y: auto;
            /* enable vertical scrolling */
        }

        /* Define the default style for the element */
        .custom-card {
            border: 1px solid #ccc;
            background-color: #fff;
            color: #000;
        }

        /* Define the hover style for the element */
        .custom-card:hover {
            border: 1px solid black;
            background-color: darkgray;
            color: black;
        }

        /* Style the file input button */
        .custom-file-upload {
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            background-color: #f8f8f8;
            color: #333;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Hide the default file input button */
        input[type="file"] {
            display: none;
        }

        /* Add hover effect to the file input button */
        .custom-file-upload:hover {
            background-color: #e5e5e5;
        }

        /* disable input filed css */
        #input-field {
            cursor: not-allowed;
        }

        #input-field:hover {
            cursor: not-allowed;
            position: relative;
        }

        #input-field:hover::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 100%;
            transform: translate(-50%, -50%);
            width: 12px;
            height: 12px;
            background-color: red;
            border-radius: 50%;
        }

        #input-field:hover::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 100%;
            transform: translate(-50%, -50%) rotate(45deg);
            width: 8px;
            height: 8px;
            background-color: white;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/subheader.php';

    ?>
    <section class="h-100 gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="">
                    <div class="card">
                        <div class=" row pt-4 text-black">
                            <div class=" col-md-12 ">
                                <div class="p-4 edit-profile-border">
                                    <div class="row">

                                        <div class="col-md-12 ">
                                            <h3 class="pt-3">User Family</h3>
                                        </div>
                                        <div class="">
                                            <hr>
                                        </div>
                                        <form method="POST" action="/php/edit-family.php" enctype="multipart/form-data">
                                            <div class="row ">
                                                <div class="col-md-6 p-3">
                                                    <div class="row">
                                                        <?php
                                                        if (isset($_SESSION['family_cancelation_message'])) {
                                                            session_start();
                                                        ?>
                                                            <div class="alert alert-success" role="alert">
                                                                <?php
                                                                echo $_SESSION['family_cancelation_message'];
                                                                unset($_SESSION['family_cancelation_message']);
                                                                ?>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>

                                                        <?php
                                                        $mysqli = mysqli_query($con, "SELECT * FROM family_member WHERE `selected_user_id` = '$get_id' AND user_id = '$user_id' AND `gender` = '$gender'");
                                                        //echo "SELECT * FROM family_member WHERE id = '$get_id' OR selected_user_id = '$get_id' AND user_id = '$user_id'";
                                                        if (mysqli_num_rows($mysqli) > 0) {
                                                            $fetch_data  = mysqli_fetch_assoc($mysqli);
                                                            $selected_user_id = $fetch_data['selected_user_id'];
                                                            $imgfor_selected = $fetch_data['image'];
                                                            $relationship = $fetch_data['relationship'];
                                                            $parent_side = $fetch_data['parent_side_one'];
                                                            $parent_side2 = $fetch_data['parent_side_two'];
                                                            // if ($selected_user_id == $get_id) {}
                                                            $mysqli2 = mysqli_query($con, "SELECT * FROM `users` WHERE `ID` = '$get_id'");
                                                            $fetch2 = mysqli_fetch_assoc($mysqli2);
                                                            $single_id = $fetch2['ID'];
                                                            $fname = $fetch2['firstname'];
                                                            $lname = $fetch2['lastname'];
                                                        ?>
                                                            <div class="row mb-3" id="hide-name-input">
                                                                <div class="">
                                                                    <label for="input-field" class="mb-2">Name</label>
                                                                    <input type="hidden" value="" id="id-hidd">
                                                                    <input type="hidden" class="remo" name="input_id" value="<?php echo $single_id ?>">
                                                                    <input type="text" id="input-field" placeholder="" class="form-control" autocomplete="off" value="<?php echo $fname . ' ' . $lname; ?>" style="border-radius: 3px; font-size: medium;" required />
                                                                    <div id="search-results"></div>
                                                                </div>
                                                            </div>
                                                            <div class="" id="single-input">
                                                            </div>
                                                        <?php
                                                        } else {
                                                            $mysqli2 = mysqli_query($con, "SELECT * FROM family_member WHERE `id` = '$get_id' AND user_id = '$user_id'");
                                                            $fetch_data2  = mysqli_fetch_assoc($mysqli2);
                                                            $selected_user_id = $fetch_data2['selected_user_id'];
                                                            $fname = $fetch_data2['firstname'];
                                                            $lname = $fetch_data2['lastname'];
                                                            $mname = $fetch_data2['middlename'];
                                                            $suffix = $fetch_data2['suffix'];
                                                            $relationship = $fetch_data2['relationship'];
                                                            $parent_side = $fetch_data2['parent_side_one'];
                                                            $parent_side2 = $fetch_data2['parent_side_two'];
                                                            //die();
                                                            $dob = $fetch_data2['date_of_birth'];
                                                            list($yeardob, $monthdob, $daydob) = explode('-', $dob);
                                                            $dod = $fetch_data2['date_of_death'];
                                                            list($yeardod, $monthdod, $daydod) = explode('-', $dod);
                                                            $email = $fetch_data2['email'];
                                                            $img = $fetch_data2['image'];

                                                        ?>
                                                            <input type="hidden" id="relationship" name="relationship" value="<?php echo $relationship; ?>" placeholder="" class="form-control" style="border-radius: 3px; font-size: medium;">
                                                            <div class="additional-fields" id="">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="field-1" class="mb-2">First Name:</label>
                                                                        <input type="text" name="firstname" placeholder="" value="<?php echo $fname ?>" class="form-control" style="border-radius: 3px; font-size: medium;">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="field-2" class="mb-2">Middle Name:</label>
                                                                        <input type="text" name="middlename" placeholder="" value="<?php echo $mname ?>" class="form-control" style="border-radius: 3px; font-size: medium;">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="field-2" class="mb-2">Last Name:</label>
                                                                        <input type="text" name="lastname" placeholder="" value="<?php echo $lname ?>" class="form-control" style="border-radius: 3px; font-size: medium;">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="field-2" class="mb-2">Suffix (Jr., M.D., etc.):</label>
                                                                        <input type="text" name="suffix" placeholder="" value="<?php echo $suffix ?>" class="form-control" style="border-radius: 3px; font-size: medium;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="mb-4 " id="hide-divs2">
                                                        <div class="form-outline">
                                                            <label for="" class="my-2">Their Date of Birth:</label>
                                                            <br>

                                                            <select name="date_of_birth_year" style="border: none;" class="form-control-sm input">
                                                                <option value="2023" <?php echo ($yeardob === '2023') ? 'selected' : ''; ?>>2023</option>
                                                                <option value="2022" <?php echo ($yeardob === '2022') ? 'selected' : ''; ?>>2022</option>
                                                                <option value="2021" <?php echo ($yeardob === '2021') ? 'selected' : ''; ?>>2021</option>
                                                                <option value="2020" <?php echo ($yeardob === '2020') ? 'selected' : ''; ?>>2020</option>
                                                                <option value="2019" <?php echo ($yeardob === '2019') ? 'selected' : ''; ?>>2019</option>
                                                                <option value="2018" <?php echo ($yeardob === '2018') ? 'selected' : ''; ?>>2018</option>
                                                                <option value="2017" <?php echo ($yeardob === '2017') ? 'selected' : ''; ?>>2017</option>
                                                                <option value="2016" <?php echo ($yeardob === '2016') ? 'selected' : ''; ?>>2016</option>
                                                                <option value="2015" <?php echo ($yeardob === '2015') ? 'selected' : ''; ?>>2015</option>
                                                                <option value="2014" <?php echo ($yeardob === '2014') ? 'selected' : ''; ?>>2014</option>
                                                                <option value="2013" <?php echo ($yeardob === '2013') ? 'selected' : ''; ?>>2013</option>
                                                                <option value="2012" <?php echo ($yeardob === '2012') ? 'selected' : ''; ?>>2012</option>
                                                                <option value="2011" <?php echo ($yeardob === '2011') ? 'selected' : ''; ?>>2011</option>
                                                                <option value="2010" <?php echo ($yeardob === '2010') ? 'selected' : ''; ?>>2010</option>
                                                                <option value="2009" <?php echo ($yeardob === '2009') ? 'selected' : ''; ?>>2009</option>
                                                                <option value="2008" <?php echo ($yeardob === '2008') ? 'selected' : ''; ?>>2008</option>
                                                                <option value="2007" <?php echo ($yeardob === '2007') ? 'selected' : ''; ?>>2007</option>
                                                                <option value="2006" <?php echo ($yeardob === '2006') ? 'selected' : ''; ?>>2006</option>
                                                                <option value="2005" <?php echo ($yeardob === '2005') ? 'selected' : ''; ?>>2005</option>
                                                                <option value="2004" <?php echo ($yeardob === '2004') ? 'selected' : ''; ?>>2004</option>
                                                                <option value="2003" <?php echo ($yeardob === '2003') ? 'selected' : ''; ?>>2003</option>
                                                                <option value="2002" <?php echo ($yeardob === '2002') ? 'selected' : ''; ?>>2002</option>
                                                                <option value="2001" <?php echo ($yeardob === '2001') ? 'selected' : ''; ?>>2001</option>
                                                                <option value="2000" <?php echo ($yeardob === '2000') ? 'selected' : ''; ?>>2000</option>
                                                                <option value="1999" <?php echo ($yeardob === '1999') ? 'selected' : ''; ?>>1999</option>
                                                                <option value="1998" <?php echo ($yeardob === '1998') ? 'selected' : ''; ?>>1998</option>
                                                                <option value="1997" <?php echo ($yeardob === '1997') ? 'selected' : ''; ?>>1997</option>
                                                                <option value="1996" <?php echo ($yeardob === '1996') ? 'selected' : ''; ?>>1996</option>
                                                                <option value="1995" <?php echo ($yeardob === '1995') ? 'selected' : ''; ?>>1995</option>
                                                                <option value="1994" <?php echo ($yeardob === '1994') ? 'selected' : ''; ?>>1994</option>
                                                                <option value="1993" <?php echo ($yeardob === '1993') ? 'selected' : ''; ?>>1993</option>
                                                                <option value="1992" <?php echo ($yeardob === '1992') ? 'selected' : ''; ?>>1992</option>
                                                                <option value="1991" <?php echo ($yeardob === '1991') ? 'selected' : ''; ?>>1991</option>
                                                                <option value="1990" <?php echo ($yeardob === '1990') ? 'selected' : ''; ?>>1990</option>
                                                                <option value="1989" <?php echo ($yeardob === '1989') ? 'selected' : ''; ?>>1989</option>
                                                                <option value="1988" <?php echo ($yeardob === '1988') ? 'selected' : ''; ?>>1988</option>
                                                                <option value="1987" <?php echo ($yeardob === '1987') ? 'selected' : ''; ?>>1987</option>
                                                                <option value="1986" <?php echo ($yeardob === '1986') ? 'selected' : ''; ?>>1986</option>
                                                                <option value="1985" <?php echo ($yeardob === '1985') ? 'selected' : ''; ?>>1985</option>
                                                                <option value="1984" <?php echo ($yeardob === '1984') ? 'selected' : ''; ?>>1984</option>
                                                                <option value="1983" <?php echo ($yeardob === '1983') ? 'selected' : ''; ?>>1983</option>
                                                                <option value="1982" <?php echo ($yeardob === '1982') ? 'selected' : ''; ?>>1982</option>
                                                                <option value="1981" <?php echo ($yeardob === '1981') ? 'selected' : ''; ?>>1981</option>
                                                                <option value="1980" <?php echo ($yeardob === '1980') ? 'selected' : ''; ?>>1980</option>
                                                                <option value="1979" <?php echo ($yeardob === '1979') ? 'selected' : ''; ?>>1979</option>
                                                                <option value="1978" <?php echo ($yeardob === '1978') ? 'selected' : ''; ?>>1978</option>
                                                                <option value="1977" <?php echo ($yeardob === '1977') ? 'selected' : ''; ?>>1977</option>
                                                                <option value="1976" <?php echo ($yeardob === '1976') ? 'selected' : ''; ?>>1976</option>
                                                                <option value="1975" <?php echo ($yeardob === '1975') ? 'selected' : ''; ?>>1975</option>
                                                                <option value="1974" <?php echo ($yeardob === '1974') ? 'selected' : ''; ?>>1974</option>
                                                                <option value="1973" <?php echo ($yeardob === '1973') ? 'selected' : ''; ?>>1973</option>
                                                                <option value="1972" <?php echo ($yeardob === '1972') ? 'selected' : ''; ?>>1972</option>
                                                                <option value="1971" <?php echo ($yeardob === '1971') ? 'selected' : ''; ?>>1971</option>
                                                                <option value="1970" <?php echo ($yeardob === '1970') ? 'selected' : ''; ?>>1970</option>
                                                                <option value="1969" <?php echo ($yeardob === '1969') ? 'selected' : ''; ?>>1969</option>
                                                                <option value="1968" <?php echo ($yeardob === '1968') ? 'selected' : ''; ?>>1968</option>
                                                                <option value="1967" <?php echo ($yeardob === '1967') ? 'selected' : ''; ?>>1967</option>
                                                                <option value="1966" <?php echo ($yeardob === '1966') ? 'selected' : ''; ?>>1966</option>
                                                                <option value="1965" <?php echo ($yeardob === '1965') ? 'selected' : ''; ?>>1965</option>
                                                                <option value="1964" <?php echo ($yeardob === '1700') ? 'selected' : ''; ?>>1964</option>
                                                                <option value="1963" <?php echo ($yeardob === '1963') ? 'selected' : ''; ?>>1963</option>
                                                                <option value="1962" <?php echo ($yeardob === '1962') ? 'selected' : ''; ?>>1962</option>
                                                                <option value="1961" <?php echo ($yeardob === '1961') ? 'selected' : ''; ?>>1961</option>
                                                                <option value="1960" <?php echo ($yeardob === '1960') ? 'selected' : ''; ?>>1960</option>
                                                                <option value="1959" <?php echo ($yeardob === '1959') ? 'selected' : ''; ?>>1959</option>
                                                                <option value="1958" <?php echo ($yeardob === '1958') ? 'selected' : ''; ?>>1958</option>
                                                                <option value="1957" <?php echo ($yeardob === '1957') ? 'selected' : ''; ?>>1957</option>
                                                                <option value="1956" <?php echo ($yeardob === '1956') ? 'selected' : ''; ?>>1956</option>
                                                                <option value="1955" <?php echo ($yeardob === '1955') ? 'selected' : ''; ?>>1955</option>
                                                                <option value="1954" <?php echo ($yeardob === '1954') ? 'selected' : ''; ?>>1954</option>
                                                                <option value="1953" <?php echo ($yeardob === '1953') ? 'selected' : ''; ?>>1953</option>
                                                                <option value="1952" <?php echo ($yeardob === '1952') ? 'selected' : ''; ?>>1952</option>
                                                                <option value="1951" <?php echo ($yeardob === '1951') ? 'selected' : ''; ?>>1951</option>
                                                                <option value="1950" <?php echo ($yeardob === '1950') ? 'selected' : ''; ?>>1950</option>
                                                                <option value="1949" <?php echo ($yeardob === '1949') ? 'selected' : ''; ?>>1949</option>
                                                                <option value="1948" <?php echo ($yeardob === '1948') ? 'selected' : ''; ?>>1948</option>
                                                                <option value="1947" <?php echo ($yeardob === '1947') ? 'selected' : ''; ?>>1947</option>
                                                                <option value="1946" <?php echo ($yeardob === '1946') ? 'selected' : ''; ?>>1946</option>
                                                                <option value="1945" <?php echo ($yeardob === '1945') ? 'selected' : ''; ?>>1945</option>
                                                                <option value="1944" <?php echo ($yeardob === '1944') ? 'selected' : ''; ?>>1944</option>
                                                                <option value="1943" <?php echo ($yeardob === '1943') ? 'selected' : ''; ?>>1943</option>
                                                                <option value="1942" <?php echo ($yeardob === '1942') ? 'selected' : ''; ?>>1942</option>
                                                                <option value="1941" <?php echo ($yeardob === '1941') ? 'selected' : ''; ?>>1941</option>
                                                                <option value="1940" <?php echo ($yeardob === '1940') ? 'selected' : ''; ?>>1940</option>
                                                                <option value="1939" <?php echo ($yeardob === '1939') ? 'selected' : ''; ?>>1939</option>
                                                                <option value="1938" <?php echo ($yeardob === '1938') ? 'selected' : ''; ?>>1938</option>
                                                                <option value="1937" <?php echo ($yeardob === '1937') ? 'selected' : ''; ?>>1937</option>
                                                                <option value="1936" <?php echo ($yeardob === '1936') ? 'selected' : ''; ?>>1936</option>
                                                                <option value="1935" <?php echo ($yeardob === '1935') ? 'selected' : ''; ?>>1935</option>
                                                                <option value="1934" <?php echo ($yeardob === '1934') ? 'selected' : ''; ?>>1934</option>
                                                                <option value="1933" <?php echo ($yeardob === '1933') ? 'selected' : ''; ?>>1933</option>
                                                                <option value="1932" <?php echo ($yeardob === '1932') ? 'selected' : ''; ?>>1932</option>
                                                                <option value="1931" <?php echo ($yeardob === '1931') ? 'selected' : ''; ?>>1931</option>
                                                                <option value="1930" <?php echo ($yeardob === '1930') ? 'selected' : ''; ?>>1930</option>
                                                                <option value="1929" <?php echo ($yeardob === '1929') ? 'selected' : ''; ?>>1929</option>
                                                                <option value="1928" <?php echo ($yeardob === '1928') ? 'selected' : ''; ?>>1928</option>
                                                                <option value="1927" <?php echo ($yeardob === '1927') ? 'selected' : ''; ?>>1927</option>
                                                                <option value="1926" <?php echo ($yeardob === '1926') ? 'selected' : ''; ?>>1926</option>
                                                                <option value="1925" <?php echo ($yeardob === '1925') ? 'selected' : ''; ?>>1925</option>
                                                                <option value="1924" <?php echo ($yeardob === '1924') ? 'selected' : ''; ?>>1924</option>
                                                                <option value="1923" <?php echo ($yeardob === '1923') ? 'selected' : ''; ?>>1923</option>
                                                                <option value="1922" <?php echo ($yeardob === '1922') ? 'selected' : ''; ?>>1922</option>
                                                                <option value="1921" <?php echo ($yeardob === '1921') ? 'selected' : ''; ?>>1921</option>
                                                                <option value="1920" <?php echo ($yeardob === '1920') ? 'selected' : ''; ?>>1920</option>
                                                                <option value="1919" <?php echo ($yeardob === '1919') ? 'selected' : ''; ?>>1919</option>
                                                                <option value="1918" <?php echo ($yeardob === '1918') ? 'selected' : ''; ?>>1918</option>
                                                                <option value="1917" <?php echo ($yeardob === '1917') ? 'selected' : ''; ?>>1917</option>
                                                                <option value="1916" <?php echo ($yeardob === '1916') ? 'selected' : ''; ?>>1916</option>
                                                                <option value="1915" <?php echo ($yeardob === '1915') ? 'selected' : ''; ?>>1915</option>
                                                                <option value="1914" <?php echo ($yeardob === '1914') ? 'selected' : ''; ?>>1914</option>
                                                                <option value="1913" <?php echo ($yeardob === '1913') ? 'selected' : ''; ?>>1913</option>
                                                                <option value="1912" <?php echo ($yeardob === '1912') ? 'selected' : ''; ?>>1912</option>
                                                                <option value="1911" <?php echo ($yeardob === '1911') ? 'selected' : ''; ?>>1911</option>
                                                                <option value="1910" <?php echo ($yeardob === '1910') ? 'selected' : ''; ?>>1910</option>
                                                                <option value="1909" <?php echo ($yeardob === '1909') ? 'selected' : ''; ?>>1909</option>
                                                                <option value="1908" <?php echo ($yeardob === '1908') ? 'selected' : ''; ?>>1908</option>
                                                                <option value="1907" <?php echo ($yeardob === '1907') ? 'selected' : ''; ?>>1907</option>
                                                                <option value="1906" <?php echo ($yeardob === '1906') ? 'selected' : ''; ?>>1906</option>
                                                                <option value="1905" <?php echo ($yeardob === '1905') ? 'selected' : ''; ?>>1905</option>
                                                                <option value="1904" <?php echo ($yeardob === '1904') ? 'selected' : ''; ?>>1904</option>
                                                                <option value="1903" <?php echo ($yeardob === '1903') ? 'selected' : ''; ?>>1903</option>
                                                                <option value="1902" <?php echo ($yeardob === '1902') ? 'selected' : ''; ?>>1902</option>
                                                                <option value="1901" <?php echo ($yeardob === '1901') ? 'selected' : ''; ?>>1901</option>
                                                                <option value="1900" <?php echo ($yeardob === '1900') ? 'selected' : ''; ?>>1900</option>
                                                                <option value="1899" <?php echo ($yeardob === '1899') ? 'selected' : ''; ?>>1899</option>
                                                                <option value="1898" <?php echo ($yeardob === '1898') ? 'selected' : ''; ?>>1898</option>
                                                                <option value="1897" <?php echo ($yeardob === '1897') ? 'selected' : ''; ?>>1897</option>
                                                                <option value="1896" <?php echo ($yeardob === '1896') ? 'selected' : ''; ?>>1896</option>
                                                                <option value="1895" <?php echo ($yeardob === '1895') ? 'selected' : ''; ?>>1895</option>
                                                                <option value="1894" <?php echo ($yeardob === '1894') ? 'selected' : ''; ?>>1894</option>
                                                                <option value="1893" <?php echo ($yeardob === '1893') ? 'selected' : ''; ?>>1893</option>
                                                                <option value="1892" <?php echo ($yeardob === '1892') ? 'selected' : ''; ?>>1892</option>
                                                                <option value="1891" <?php echo ($yeardob === '1891') ? 'selected' : ''; ?>>1891</option>
                                                                <option value="1890" <?php echo ($yeardob === '1890') ? 'selected' : ''; ?>>1890</option>
                                                                <option value="1889" <?php echo ($yeardob === '1889') ? 'selected' : ''; ?>>1889</option>
                                                                <option value="1888" <?php echo ($yeardob === '1888') ? 'selected' : ''; ?>>1888</option>
                                                                <option value="1887" <?php echo ($yeardob === '1887') ? 'selected' : ''; ?>>1887</option>
                                                                <option value="1886" <?php echo ($yeardob === '1886') ? 'selected' : ''; ?>>1886</option>
                                                                <option value="1885" <?php echo ($yeardob === '1885') ? 'selected' : ''; ?>>1885</option>
                                                                <option value="1884" <?php echo ($yeardob === '1884') ? 'selected' : ''; ?>>1884</option>
                                                                <option value="1883" <?php echo ($yeardob === '1883') ? 'selected' : ''; ?>>1883</option>
                                                                <option value="1882" <?php echo ($yeardob === '1882') ? 'selected' : ''; ?>>1882</option>
                                                                <option value="1881" <?php echo ($yeardob === '1881') ? 'selected' : ''; ?>>1881</option>
                                                                <option value="1880" <?php echo ($yeardob === '1880') ? 'selected' : ''; ?>>1880</option>
                                                                <option value="1879" <?php echo ($yeardob === '1879') ? 'selected' : ''; ?>>1879</option>
                                                                <option value="1878" <?php echo ($yeardob === '1878') ? 'selected' : ''; ?>>1878</option>
                                                                <option value="1877" <?php echo ($yeardob === '1877') ? 'selected' : ''; ?>>1877</option>
                                                                <option value="1876" <?php echo ($yeardob === '1876') ? 'selected' : ''; ?>>1876</option>
                                                                <option value="1875" <?php echo ($yeardob === '1700') ? 'selected' : ''; ?>>1875</option>
                                                                <option value="1874" <?php echo ($yeardob === '1874') ? 'selected' : ''; ?>>1874</option>
                                                                <option value="1873" <?php echo ($yeardob === '1873') ? 'selected' : ''; ?>>1873</option>
                                                                <option value="1872" <?php echo ($yeardob === '1872') ? 'selected' : ''; ?>>1872</option>
                                                                <option value="1871" <?php echo ($yeardob === '1871') ? 'selected' : ''; ?>>1871</option>
                                                                <option value="1870" <?php echo ($yeardob === '1870') ? 'selected' : ''; ?>>1870</option>
                                                                <option value="1869" <?php echo ($yeardob === '1869') ? 'selected' : ''; ?>>1869</option>
                                                                <option value="1868" <?php echo ($yeardob === '1868') ? 'selected' : ''; ?>>1868</option>
                                                                <option value="1867" <?php echo ($yeardob === '1867') ? 'selected' : ''; ?>>1867</option>
                                                                <option value="1865" <?php echo ($yeardob === '1865') ? 'selected' : ''; ?>>1865</option>
                                                                <option value="1864" <?php echo ($yeardob === '1864') ? 'selected' : ''; ?>>1864</option>
                                                                <option value="1863" <?php echo ($yeardob === '1863') ? 'selected' : ''; ?>>1863</option>
                                                                <option value="1862" <?php echo ($yeardob === '1862') ? 'selected' : ''; ?>>1862</option>
                                                                <option value="1861" <?php echo ($yeardob === '1861') ? 'selected' : ''; ?>>1861</option>
                                                                <option value="1860" <?php echo ($yeardob === '1860') ? 'selected' : ''; ?>>1860</option>
                                                                <option value="1859" <?php echo ($yeardob === '1859') ? 'selected' : ''; ?>>1859</option>
                                                                <option value="1858" <?php echo ($yeardob === '1858') ? 'selected' : ''; ?>>1858</option>
                                                                <option value="1857" <?php echo ($yeardob === '1857') ? 'selected' : ''; ?>>1857</option>
                                                                <option value="1856" <?php echo ($yeardob === '1856') ? 'selected' : ''; ?>>1856</option>
                                                                <option value="1855" <?php echo ($yeardob === '1855') ? 'selected' : ''; ?>>1855</option>
                                                                <option value="1854" <?php echo ($yeardob === '1854') ? 'selected' : ''; ?>>1854</option>
                                                                <option value="1853" <?php echo ($yeardob === '1853') ? 'selected' : ''; ?>>1853</option>
                                                                <option value="1852" <?php echo ($yeardob === '1852') ? 'selected' : ''; ?>>1852</option>
                                                                <option value="1851" <?php echo ($yeardob === '1851') ? 'selected' : ''; ?>>1851</option>
                                                                <option value="1850" <?php echo ($yeardob === '1850') ? 'selected' : ''; ?>>1850</option>
                                                                <option value="1849" <?php echo ($yeardob === '1849') ? 'selected' : ''; ?>>1849</option>
                                                                <option value="1848" <?php echo ($yeardob === '1848') ? 'selected' : ''; ?>>1848</option>
                                                                <option value="1847" <?php echo ($yeardob === '1847') ? 'selected' : ''; ?>>1847</option>
                                                                <option value="1846" <?php echo ($yeardob === '1846') ? 'selected' : ''; ?>>1846</option>
                                                                <option value="1845" <?php echo ($yeardob === '1845') ? 'selected' : ''; ?>>1845</option>
                                                                <option value="1844" <?php echo ($yeardob === '1844') ? 'selected' : ''; ?>>1844</option>
                                                                <option value="1843" <?php echo ($yeardob === '1843') ? 'selected' : ''; ?>>1843</option>
                                                                <option value="1842" <?php echo ($yeardob === '1842') ? 'selected' : ''; ?>>1842</option>
                                                                <option value="1841" <?php echo ($yeardob === '1841') ? 'selected' : ''; ?>>1841</option>
                                                                <option value="1840" <?php echo ($yeardob === '1840') ? 'selected' : ''; ?>>1840</option>
                                                                <option value="1839" <?php echo ($yeardob === '1839') ? 'selected' : ''; ?>>1839</option>
                                                                <option value="1838" <?php echo ($yeardob === '1838') ? 'selected' : ''; ?>>1838</option>
                                                                <option value="1837" <?php echo ($yeardob === '1837') ? 'selected' : ''; ?>>1837</option>
                                                                <option value="1836" <?php echo ($yeardob === '1836') ? 'selected' : ''; ?>>1836</option>
                                                                <option value="1835" <?php echo ($yeardob === '1835') ? 'selected' : ''; ?>>1835</option>
                                                                <option value="1834" <?php echo ($yeardob === '1834') ? 'selected' : ''; ?>>1834</option>
                                                                <option value="1833" <?php echo ($yeardob === '1833') ? 'selected' : ''; ?>>1833</option>
                                                                <option value="1832" <?php echo ($yeardob === '1832') ? 'selected' : ''; ?>>1832</option>
                                                                <option value="1831" <?php echo ($yeardob === '1831') ? 'selected' : ''; ?>>1831</option>
                                                                <option value="1830" <?php echo ($yeardob === '1830') ? 'selected' : ''; ?>>1830</option>
                                                                <option value="1829" <?php echo ($yeardob === '1829') ? 'selected' : ''; ?>>1829</option>
                                                                <option value="1828" <?php echo ($yeardob === '1828') ? 'selected' : ''; ?>>1828</option>
                                                                <option value="1827" <?php echo ($yeardob === '1827') ? 'selected' : ''; ?>>1827</option>
                                                                <option value="1826" <?php echo ($yeardob === '1826') ? 'selected' : ''; ?>>1826</option>
                                                                <option value="1825" <?php echo ($yeardob === '1825') ? 'selected' : ''; ?>>1825</option>
                                                                <option value="1824" <?php echo ($yeardob === '1824') ? 'selected' : ''; ?>>1824</option>
                                                                <option value="1823" <?php echo ($yeardob === '1823') ? 'selected' : ''; ?>>1823</option>
                                                                <option value="1822" <?php echo ($yeardob === '1822') ? 'selected' : ''; ?>>1822</option>
                                                                <option value="1821" <?php echo ($yeardob === '1821') ? 'selected' : ''; ?>>1821</option>
                                                                <option value="1820" <?php echo ($yeardob === '1820') ? 'selected' : ''; ?>>1820</option>
                                                                <option value="1819" <?php echo ($yeardob === '1819') ? 'selected' : ''; ?>>1819</option>
                                                                <option value="1818" <?php echo ($yeardob === '1818') ? 'selected' : ''; ?>>1818</option>
                                                                <option value="1817" <?php echo ($yeardob === '1817') ? 'selected' : ''; ?>>1817</option>
                                                                <option value="1816" <?php echo ($yeardob === '1816') ? 'selected' : ''; ?>>1816</option>
                                                                <option value="1815" <?php echo ($yeardob === '1815') ? 'selected' : ''; ?>>1815</option>
                                                                <option value="1814" <?php echo ($yeardob === '1814') ? 'selected' : ''; ?>>1814</option>
                                                                <option value="1813" <?php echo ($yeardob === '1813') ? 'selected' : ''; ?>>1813</option>
                                                                <option value="1812" <?php echo ($yeardob === '1812') ? 'selected' : ''; ?>>1812</option>
                                                                <option value="1811" <?php echo ($yeardob === '1811') ? 'selected' : ''; ?>>1811</option>
                                                                <option value="1810" <?php echo ($yeardob === '1810') ? 'selected' : ''; ?>>1810</option>
                                                                <option value="1809" <?php echo ($yeardob === '1809') ? 'selected' : ''; ?>>1809</option>
                                                                <option value="1808" <?php echo ($yeardob === '1808') ? 'selected' : ''; ?>>1808</option>
                                                                <option value="1807" <?php echo ($yeardob === '1807') ? 'selected' : ''; ?>>1807</option>
                                                                <option value="1806" <?php echo ($yeardob === '1806') ? 'selected' : ''; ?>>1806</option>
                                                                <option value="1805" <?php echo ($yeardob === '1805') ? 'selected' : ''; ?>>1805</option>
                                                                <option value="1804" <?php echo ($yeardob === '1804') ? 'selected' : ''; ?>>1804</option>
                                                                <option value="1803" <?php echo ($yeardob === '1803') ? 'selected' : ''; ?>>1803</option>
                                                                <option value="1802" <?php echo ($yeardob === '1802') ? 'selected' : ''; ?>>1802</option>
                                                                <option value="1801" <?php echo ($yeardob === '1801') ? 'selected' : ''; ?>>1801</option>
                                                                <option value="1800" <?php echo ($yeardob === '1800') ? 'selected' : ''; ?>>1800</option>
                                                                <option value="1799" <?php echo ($yeardob === '1799') ? 'selected' : ''; ?>>1799</option>
                                                                <option value="1798" <?php echo ($yeardob === '1798') ? 'selected' : ''; ?>>1798</option>
                                                                <option value="1797" <?php echo ($yeardob === '1797') ? 'selected' : ''; ?>>1797</option>
                                                                <option value="1796" <?php echo ($yeardob === '1796') ? 'selected' : ''; ?>>1796</option>
                                                                <option value="1795" <?php echo ($yeardob === '1795') ? 'selected' : ''; ?>>1795</option>
                                                                <option value="1794" <?php echo ($yeardob === '1794') ? 'selected' : ''; ?>>1794</option>
                                                                <option value="1793" <?php echo ($yeardob === '1793') ? 'selected' : ''; ?>>1793</option>
                                                                <option value="1792" <?php echo ($yeardob === '1792') ? 'selected' : ''; ?>>1792</option>
                                                                <option value="1791" <?php echo ($yeardob === '1791') ? 'selected' : ''; ?>>1791</option>
                                                                <option value="1790" <?php echo ($yeardob === '1790') ? 'selected' : ''; ?>>1790</option>
                                                                <option value="1789" <?php echo ($yeardob === '1789') ? 'selected' : ''; ?>>1789</option>
                                                                <option value="1788" <?php echo ($yeardob === '1788') ? 'selected' : ''; ?>>1788</option>
                                                                <option value="1787" <?php echo ($yeardob === '1787') ? 'selected' : ''; ?>>1787</option>
                                                                <option value="1786" <?php echo ($yeardob === '1786') ? 'selected' : ''; ?>>1786</option>
                                                                <option value="1785" <?php echo ($yeardob === '1785') ? 'selected' : ''; ?>>1785</option>
                                                                <option value="1784" <?php echo ($yeardob === '1784') ? 'selected' : ''; ?>>1784</option>
                                                                <option value="1783" <?php echo ($yeardob === '1783') ? 'selected' : ''; ?>>1783</option>
                                                                <option value="1782" <?php echo ($yeardob === '1782') ? 'selected' : ''; ?>>1782</option>
                                                                <option value="1781" <?php echo ($yeardob === '1781') ? 'selected' : ''; ?>>1781</option>
                                                                <option value="1780" <?php echo ($yeardob === '1780') ? 'selected' : ''; ?>>1780</option>
                                                                <option value="1779" <?php echo ($yeardob === '1779') ? 'selected' : ''; ?>>1779</option>
                                                                <option value="1778" <?php echo ($yeardob === '1778') ? 'selected' : ''; ?>>1778</option>
                                                                <option value="1777" <?php echo ($yeardob === '1777') ? 'selected' : ''; ?>>1777</option>
                                                                <option value="1776" <?php echo ($yeardob === '1776') ? 'selected' : ''; ?>>1776</option>
                                                                <option value="1775" <?php echo ($yeardob === '1775') ? 'selected' : ''; ?>>1775</option>
                                                                <option value="1774" <?php echo ($yeardob === '1774') ? 'selected' : ''; ?>>1774</option>
                                                                <option value="1773" <?php echo ($yeardob === '1773') ? 'selected' : ''; ?>>1773</option>
                                                                <option value="1772" <?php echo ($yeardob === '1772') ? 'selected' : ''; ?>>1772</option>
                                                                <option value="1771" <?php echo ($yeardob === '1771') ? 'selected' : ''; ?>>1771</option>
                                                                <option value="1770" <?php echo ($yeardob === '1770') ? 'selected' : ''; ?>>1770</option>
                                                                <option value="1769" <?php echo ($yeardob === '1769') ? 'selected' : ''; ?>>1769</option>
                                                                <option value="1768" <?php echo ($yeardob === '1768') ? 'selected' : ''; ?>>1768</option>
                                                                <option value="1767" <?php echo ($yeardob === '1757') ? 'selected' : ''; ?>>1767</option>
                                                                <option value="1766" <?php echo ($yeardob === '1766') ? 'selected' : ''; ?>>1766</option>
                                                                <option value="1765" <?php echo ($yeardob === '1765') ? 'selected' : ''; ?>>1765</option>
                                                                <option value="1764" <?php echo ($yeardob === '1764') ? 'selected' : ''; ?>>1764</option>
                                                                <option value="1763" <?php echo ($yeardob === '1763') ? 'selected' : ''; ?>>1763</option>
                                                                <option value="1762" <?php echo ($yeardob === '1762') ? 'selected' : ''; ?>>1762</option>
                                                                <option value="1761" <?php echo ($yeardob === '1761') ? 'selected' : ''; ?>>1761</option>
                                                                <option value="1760" <?php echo ($yeardob === '1760') ? 'selected' : ''; ?>>1760</option>
                                                                <option value="1759" <?php echo ($yeardob === '1759') ? 'selected' : ''; ?>>1759</option>
                                                                <option value="1758" <?php echo ($yeardob === '1758') ? 'selected' : ''; ?>>1758</option>
                                                                <option value="1757" <?php echo ($yeardob === '1757') ? 'selected' : ''; ?>>1757</option>
                                                                <option value="1756" <?php echo ($yeardob === '1756') ? 'selected' : ''; ?>>1756</option>
                                                                <option value="1755" <?php echo ($yeardob === '1755') ? 'selected' : ''; ?>>1755</option>
                                                                <option value="1754" <?php echo ($yeardob === '1754') ? 'selected' : ''; ?>>1754</option>
                                                                <option value="1753" <?php echo ($yeardob === '1753') ? 'selected' : ''; ?>>1753</option>
                                                                <option value="1752" <?php echo ($yeardob === '1752') ? 'selected' : ''; ?>>1752</option>
                                                                <option value="1751" <?php echo ($yeardob === '1751') ? 'selected' : ''; ?>>1751</option>
                                                                <option value="1750" <?php echo ($yeardob === '1750') ? 'selected' : ''; ?>>1750</option>
                                                                <option value="1749" <?php echo ($yeardob === '1749') ? 'selected' : ''; ?>>1749</option>
                                                                <option value="1748" <?php echo ($yeardob === '1748') ? 'selected' : ''; ?>>1748</option>
                                                                <option value="1747" <?php echo ($yeardob === '1747') ? 'selected' : ''; ?>>1747</option>
                                                                <option value="1746" <?php echo ($yeardob === '1746') ? 'selected' : ''; ?>>1746</option>
                                                                <option value="1745" <?php echo ($yeardob === '1745') ? 'selected' : ''; ?>>1745</option>
                                                                <option value="1744" <?php echo ($yeardob === '1744') ? 'selected' : ''; ?>>1744</option>
                                                                <option value="1743" <?php echo ($yeardob === '1743') ? 'selected' : ''; ?>>1743</option>
                                                                <option value="1742" <?php echo ($yeardob === '1742') ? 'selected' : ''; ?>>1742</option>
                                                                <option value="1741" <?php echo ($yeardob === '1741') ? 'selected' : ''; ?>>1741</option>
                                                                <option value="1740" <?php echo ($yeardob === '1740') ? 'selected' : ''; ?>>1740</option>
                                                                <option value="1739" <?php echo ($yeardob === '1739') ? 'selected' : ''; ?>>1739</option>
                                                                <option value="1738" <?php echo ($yeardob === '1738') ? 'selected' : ''; ?>>1738</option>
                                                                <option value="1737" <?php echo ($yeardob === '1737') ? 'selected' : ''; ?>>1737</option>
                                                                <option value="1736" <?php echo ($yeardob === '1736') ? 'selected' : ''; ?>>1736</option>
                                                                <option value="1735" <?php echo ($yeardob === '1735') ? 'selected' : ''; ?>>1735</option>
                                                                <option value="1734" <?php echo ($yeardob === '1734') ? 'selected' : ''; ?>>1734</option>
                                                                <option value="1733" <?php echo ($yeardob === '1733') ? 'selected' : ''; ?>>1733</option>
                                                                <option value="1732" <?php echo ($yeardob === '1732') ? 'selected' : ''; ?>>1732</option>
                                                                <option value="1731" <?php echo ($yeardob === '1731') ? 'selected' : ''; ?>>1731</option>
                                                                <option value="1730" <?php echo ($yeardob === '1730') ? 'selected' : ''; ?>>1730</option>
                                                                <option value="1729" <?php echo ($yeardob === '1729') ? 'selected' : ''; ?>>1729</option>
                                                                <option value="1728" <?php echo ($yeardob === '1728') ? 'selected' : ''; ?>>1728</option>
                                                                <option value="1727" <?php echo ($yeardob === '1727') ? 'selected' : ''; ?>>1727</option>
                                                                <option value="1726" <?php echo ($yeardob === '1726') ? 'selected' : ''; ?>>1726</option>
                                                                <option value="1725" <?php echo ($yeardob === '1725') ? 'selected' : ''; ?>>1725</option>
                                                                <option value="1724" <?php echo ($yeardob === '1724') ? 'selected' : ''; ?>>1724</option>
                                                                <option value="1723" <?php echo ($yeardob === '1723') ? 'selected' : ''; ?>>1723</option>
                                                                <option value="1722" <?php echo ($yeardob === '1722') ? 'selected' : ''; ?>>1722</option>
                                                                <option value="1721" <?php echo ($yeardob === '1721') ? 'selected' : ''; ?>>1721</option>
                                                                <option value="1720" <?php echo ($yeardob === '1720') ? 'selected' : ''; ?>>1720</option>
                                                                <option value="1719" <?php echo ($yeardob === '1719') ? 'selected' : ''; ?>>1719</option>
                                                                <option value="1718" <?php echo ($yeardob === '1718') ? 'selected' : ''; ?>>1718</option>
                                                                <option value="1717" <?php echo ($yeardob === '1717') ? 'selected' : ''; ?>>1717</option>
                                                                <option value="1716" <?php echo ($yeardob === '1716') ? 'selected' : ''; ?>>1716</option>
                                                                <option value="1715" <?php echo ($yeardob === '1715') ? 'selected' : ''; ?>>1715</option>
                                                                <option value="1714" <?php echo ($yeardob === '1714') ? 'selected' : ''; ?>>1714</option>
                                                                <option value="1713" <?php echo ($yeardob === '1713') ? 'selected' : ''; ?>>1713</option>
                                                                <option value="1712" <?php echo ($yeardob === '1712') ? 'selected' : ''; ?>>1712</option>
                                                                <option value="1711" <?php echo ($yeardob === '1711') ? 'selected' : ''; ?>>1711</option>
                                                                <option value="1710" <?php echo ($yeardob === '1710') ? 'selected' : ''; ?>>1710</option>
                                                                <option value="1709" <?php echo ($yeardob === '1709') ? 'selected' : ''; ?>>1709</option>
                                                                <option value="1708" <?php echo ($yeardob === '1708') ? 'selected' : ''; ?>>1708</option>
                                                                <option value="1707" <?php echo ($yeardob === '1707') ? 'selected' : ''; ?>>1707</option>
                                                                <option value="1706" <?php echo ($yeardob === '1706') ? 'selected' : ''; ?>>1706</option>
                                                                <option value="1705" <?php echo ($yeardob === '1705') ? 'selected' : ''; ?>>1705</option>
                                                                <option value="1704" <?php echo ($yeardob === '1704') ? 'selected' : ''; ?>>1704</option>
                                                                <option value="1703" <?php echo ($yeardob === '1703') ? 'selected' : ''; ?>>1703</option>
                                                                <option value="1702" <?php echo ($yeardob === '1702') ? 'selected' : ''; ?>>1702</option>
                                                                <option value="1701" <?php echo ($yeardob === '1701') ? 'selected' : ''; ?>>1701</option>
                                                                <option value="1700" <?php echo ($yeardob === '1700') ? 'selected' : ''; ?>>1700</option>
                                                            </select>
                                                            <select name="date_of_birth_month" style="border: none;" class="form-control-sm input">
                                                                <option value="01" <?php echo ($monthdob === '01') ? 'selected' : ''; ?>>01</option>
                                                                <option value="02" <?php echo ($monthdob === '02') ? 'selected' : ''; ?>>02</option>
                                                                <option value="03" <?php echo ($monthdob === '03') ? 'selected' : ''; ?>>03</option>
                                                                <option value="04" <?php echo ($monthdob === '04') ? 'selected' : ''; ?>>04</option>
                                                                <option value="05" <?php echo ($monthdob === '05') ? 'selected' : ''; ?>>05</option>
                                                                <option value="06" <?php echo ($monthdob === '06') ? 'selected' : ''; ?>>06</option>
                                                                <option value="07" <?php echo ($monthdob === '07') ? 'selected' : ''; ?>>07</option>
                                                                <option value="08" <?php echo ($monthdob === '08') ? 'selected' : ''; ?>>08</option>
                                                                <option value="09" <?php echo ($monthdob === '09') ? 'selected' : ''; ?>>09</option>
                                                                <option value="10" <?php echo ($monthdob === '10') ? 'selected' : ''; ?>>10</option>
                                                                <option value="11" <?php echo ($monthdob === '11') ? 'selected' : ''; ?>>11</option>
                                                                <option value="12" <?php echo ($monthdob === '12') ? 'selected' : ''; ?>>12</option>
                                                            </select>

                                                            <select name="date_of_birth_day" style="border: none;" class="form-control-sm input">
                                                                <option value="01" <?php echo ($daydob === '01') ? 'selected' : ''; ?>>01</option>
                                                                <option value="02" <?php echo ($daydob === '02') ? 'selected' : ''; ?>>02</option>
                                                                <option value="03" <?php echo ($daydob === '03') ? 'selected' : ''; ?>>03</option>
                                                                <option value="04" <?php echo ($daydob === '04') ? 'selected' : ''; ?>>04</option>
                                                                <option value="05" <?php echo ($daydob === '05') ? 'selected' : ''; ?>>05</option>
                                                                <option value="06" <?php echo ($daydob === '06') ? 'selected' : ''; ?>>06</option>
                                                                <option value="07" <?php echo ($daydob === '07') ? 'selected' : ''; ?>>07</option>
                                                                <option value="08" <?php echo ($daydob === '08') ? 'selected' : ''; ?>>08</option>
                                                                <option value="09" <?php echo ($daydob === '09') ? 'selected' : ''; ?>>09</option>
                                                                <option value="10" <?php echo ($daydob === '10') ? 'selected' : ''; ?>>10</option>
                                                                <option value="11" <?php echo ($daydob === '11') ? 'selected' : ''; ?>>11</option>
                                                                <option value="12" <?php echo ($daydob === '12') ? 'selected' : ''; ?>>12</option>
                                                                <option value="13" <?php echo ($daydob === '13') ? 'selected' : ''; ?>>13</option>
                                                                <option value="14" <?php echo ($daydob === '14') ? 'selected' : ''; ?>>14</option>
                                                                <option value="15" <?php echo ($daydob === '15') ? 'selected' : ''; ?>>15</option>
                                                                <option value="16" <?php echo ($daydob === '16') ? 'selected' : ''; ?>>16</option>
                                                                <option value="17" <?php echo ($daydob === '17') ? 'selected' : ''; ?>>17</option>
                                                                <option value="18" <?php echo ($daydob === '18') ? 'selected' : ''; ?>>18</option>
                                                                <option value="19" <?php echo ($daydob === '19') ? 'selected' : ''; ?>>19</option>
                                                                <option value="20" <?php echo ($daydob === '20') ? 'selected' : ''; ?>>20</option>
                                                                <option value="21" <?php echo ($daydob === '21') ? 'selected' : ''; ?>>21</option>
                                                                <option value="22" <?php echo ($daydob === '22') ? 'selected' : ''; ?>>22</option>
                                                                <option value="23" <?php echo ($daydob === '23') ? 'selected' : ''; ?>>23</option>
                                                                <option value="24" <?php echo ($daydob === '24') ? 'selected' : ''; ?>>24</option>
                                                                <option value="25" <?php echo ($daydob === '25') ? 'selected' : ''; ?>>25</option>
                                                                <option value="26" <?php echo ($daydob === '26') ? 'selected' : ''; ?>>26</option>
                                                                <option value="27" <?php echo ($daydob === '27') ? 'selected' : ''; ?>>27</option>
                                                                <option value="28" <?php echo ($daydob === '28') ? 'selected' : ''; ?>>28</option>
                                                                <option value="29" <?php echo ($daydob === '29') ? 'selected' : ''; ?>>29</option>
                                                                <option value="30" <?php echo ($daydob === '30') ? 'selected' : ''; ?>>30</option>
                                                                <option value="31" <?php echo ($daydob === '31') ? 'selected' : ''; ?>>31</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4 " id="hide-divs3">
                                                        <div class="form-outline"></div>
                                                        <div class="hasPassedAway">
                                                            <label for="checkPassedAway" class="mb-2">
                                                                Has passed away ?
                                                                <label>
                                                                    <input type="checkbox" id="show-divs" <?php if ($img != '') echo 'checked'; ?>>
                                                                </label>
                                                                <div class="my-divs">

                                                                    <div class="form-outline mt-2">
                                                                        <label for="" class="mb-2"> Date of Death (YYYY-MM-DD):</label>
                                                                        <br>
                                                                        <select name="date_of_death_year" style="border: none;" class="form-control-sm input">
                                                                            <option value="2023" <?php echo ($yeardod === '2023') ? 'selected' : ''; ?>>2023</option>
                                                                            <option value="2022" <?php echo ($yeardod === '2022') ? 'selected' : ''; ?>>2022</option>
                                                                            <option value="2021" <?php echo ($yeardod === '2021') ? 'selected' : ''; ?>>2021</option>
                                                                            <option value="2020" <?php echo ($yeardod === '2020') ? 'selected' : ''; ?>>2020</option>
                                                                            <option value="2019" <?php echo ($yeardod === '2019') ? 'selected' : ''; ?>>2019</option>
                                                                            <option value="2018" <?php echo ($yeardod === '2018') ? 'selected' : ''; ?>>2018</option>
                                                                            <option value="2017" <?php echo ($yeardod === '2017') ? 'selected' : ''; ?>>2017</option>
                                                                            <option value="2016" <?php echo ($yeardod === '2016') ? 'selected' : ''; ?>>2016</option>
                                                                            <option value="2015" <?php echo ($yeardod === '2015') ? 'selected' : ''; ?>>2015</option>
                                                                            <option value="2014" <?php echo ($yeardod === '2014') ? 'selected' : ''; ?>>2014</option>
                                                                            <option value="2013" <?php echo ($yeardod === '2013') ? 'selected' : ''; ?>>2013</option>
                                                                            <option value="2012" <?php echo ($yeardod === '2012') ? 'selected' : ''; ?>>2012</option>
                                                                            <option value="2011" <?php echo ($yeardod === '2011') ? 'selected' : ''; ?>>2011</option>
                                                                            <option value="2010" <?php echo ($yeardod === '2010') ? 'selected' : ''; ?>>2010</option>
                                                                            <option value="2009" <?php echo ($yeardod === '2009') ? 'selected' : ''; ?>>2009</option>
                                                                            <option value="2008" <?php echo ($yeardod === '2008') ? 'selected' : ''; ?>>2008</option>
                                                                            <option value="2007" <?php echo ($yeardod === '2007') ? 'selected' : ''; ?>>2007</option>
                                                                            <option value="2006" <?php echo ($yeardod === '2006') ? 'selected' : ''; ?>>2006</option>
                                                                            <option value="2005" <?php echo ($yeardod === '2005') ? 'selected' : ''; ?>>2005</option>
                                                                            <option value="2004" <?php echo ($yeardod === '2004') ? 'selected' : ''; ?>>2004</option>
                                                                            <option value="2003" <?php echo ($yeardod === '2003') ? 'selected' : ''; ?>>2003</option>
                                                                            <option value="2002" <?php echo ($yeardod === '2002') ? 'selected' : ''; ?>>2002</option>
                                                                            <option value="2001" <?php echo ($yeardod === '2001') ? 'selected' : ''; ?>>2001</option>
                                                                            <option value="2000" <?php echo ($yeardod === '2000') ? 'selected' : ''; ?>>2000</option>
                                                                            <option value="1999" <?php echo ($yeardod === '1999') ? 'selected' : ''; ?>>1999</option>
                                                                            <option value="1998" <?php echo ($yeardod === '1998') ? 'selected' : ''; ?>>1998</option>
                                                                            <option value="1997" <?php echo ($yeardod === '1997') ? 'selected' : ''; ?>>1997</option>
                                                                            <option value="1996" <?php echo ($yeardod === '1996') ? 'selected' : ''; ?>>1996</option>
                                                                            <option value="1995" <?php echo ($yeardod === '1995') ? 'selected' : ''; ?>>1995</option>
                                                                            <option value="1994" <?php echo ($yeardod === '1994') ? 'selected' : ''; ?>>1994</option>
                                                                            <option value="1993" <?php echo ($yeardod === '1993') ? 'selected' : ''; ?>>1993</option>
                                                                            <option value="1992" <?php echo ($yeardod === '1992') ? 'selected' : ''; ?>>1992</option>
                                                                            <option value="1991" <?php echo ($yeardod === '1991') ? 'selected' : ''; ?>>1991</option>
                                                                            <option value="1990" <?php echo ($yeardod === '1990') ? 'selected' : ''; ?>>1990</option>
                                                                            <option value="1989" <?php echo ($yeardod === '1989') ? 'selected' : ''; ?>>1989</option>
                                                                            <option value="1988" <?php echo ($yeardod === '1988') ? 'selected' : ''; ?>>1988</option>
                                                                            <option value="1987" <?php echo ($yeardod === '1987') ? 'selected' : ''; ?>>1987</option>
                                                                            <option value="1986" <?php echo ($yeardod === '1986') ? 'selected' : ''; ?>>1986</option>
                                                                            <option value="1985" <?php echo ($yeardod === '1985') ? 'selected' : ''; ?>>1985</option>
                                                                            <option value="1984" <?php echo ($yeardod === '1984') ? 'selected' : ''; ?>>1984</option>
                                                                            <option value="1983" <?php echo ($yeardod === '1983') ? 'selected' : ''; ?>>1983</option>
                                                                            <option value="1982" <?php echo ($yeardod === '1982') ? 'selected' : ''; ?>>1982</option>
                                                                            <option value="1981" <?php echo ($yeardod === '1981') ? 'selected' : ''; ?>>1981</option>
                                                                            <option value="1980" <?php echo ($yeardod === '1980') ? 'selected' : ''; ?>>1980</option>
                                                                            <option value="1979" <?php echo ($yeardod === '1979') ? 'selected' : ''; ?>>1979</option>
                                                                            <option value="1978" <?php echo ($yeardod === '1978') ? 'selected' : ''; ?>>1978</option>
                                                                            <option value="1977" <?php echo ($yeardod === '1977') ? 'selected' : ''; ?>>1977</option>
                                                                            <option value="1976" <?php echo ($yeardod === '1976') ? 'selected' : ''; ?>>1976</option>
                                                                            <option value="1975" <?php echo ($yeardod === '1975') ? 'selected' : ''; ?>>1975</option>
                                                                            <option value="1974" <?php echo ($yeardod === '1974') ? 'selected' : ''; ?>>1974</option>
                                                                            <option value="1973" <?php echo ($yeardod === '1973') ? 'selected' : ''; ?>>1973</option>
                                                                            <option value="1972" <?php echo ($yeardod === '1972') ? 'selected' : ''; ?>>1972</option>
                                                                            <option value="1971" <?php echo ($yeardod === '1971') ? 'selected' : ''; ?>>1971</option>
                                                                            <option value="1970" <?php echo ($yeardod === '1970') ? 'selected' : ''; ?>>1970</option>
                                                                            <option value="1969" <?php echo ($yeardod === '1969') ? 'selected' : ''; ?>>1969</option>
                                                                            <option value="1968" <?php echo ($yeardod === '1968') ? 'selected' : ''; ?>>1968</option>
                                                                            <option value="1967" <?php echo ($yeardod === '1967') ? 'selected' : ''; ?>>1967</option>
                                                                            <option value="1966" <?php echo ($yeardod === '1966') ? 'selected' : ''; ?>>1966</option>
                                                                            <option value="1965" <?php echo ($yeardod === '1965') ? 'selected' : ''; ?>>1965</option>
                                                                            <option value="1964" <?php echo ($yeardod === '1700') ? 'selected' : ''; ?>>1964</option>
                                                                            <option value="1963" <?php echo ($yeardod === '1963') ? 'selected' : ''; ?>>1963</option>
                                                                            <option value="1962" <?php echo ($yeardod === '1962') ? 'selected' : ''; ?>>1962</option>
                                                                            <option value="1961" <?php echo ($yeardod === '1961') ? 'selected' : ''; ?>>1961</option>
                                                                            <option value="1960" <?php echo ($yeardod === '1960') ? 'selected' : ''; ?>>1960</option>
                                                                            <option value="1959" <?php echo ($yeardod === '1959') ? 'selected' : ''; ?>>1959</option>
                                                                            <option value="1958" <?php echo ($yeardod === '1958') ? 'selected' : ''; ?>>1958</option>
                                                                            <option value="1957" <?php echo ($yeardod === '1957') ? 'selected' : ''; ?>>1957</option>
                                                                            <option value="1956" <?php echo ($yeardod === '1956') ? 'selected' : ''; ?>>1956</option>
                                                                            <option value="1955" <?php echo ($yeardod === '1955') ? 'selected' : ''; ?>>1955</option>
                                                                            <option value="1954" <?php echo ($yeardod === '1954') ? 'selected' : ''; ?>>1954</option>
                                                                            <option value="1953" <?php echo ($yeardod === '1953') ? 'selected' : ''; ?>>1953</option>
                                                                            <option value="1952" <?php echo ($yeardod === '1952') ? 'selected' : ''; ?>>1952</option>
                                                                            <option value="1951" <?php echo ($yeardod === '1951') ? 'selected' : ''; ?>>1951</option>
                                                                            <option value="1950" <?php echo ($yeardod === '1950') ? 'selected' : ''; ?>>1950</option>
                                                                            <option value="1949" <?php echo ($yeardod === '1949') ? 'selected' : ''; ?>>1949</option>
                                                                            <option value="1948" <?php echo ($yeardod === '1948') ? 'selected' : ''; ?>>1948</option>
                                                                            <option value="1947" <?php echo ($yeardod === '1947') ? 'selected' : ''; ?>>1947</option>
                                                                            <option value="1946" <?php echo ($yeardod === '1946') ? 'selected' : ''; ?>>1946</option>
                                                                            <option value="1945" <?php echo ($yeardod === '1945') ? 'selected' : ''; ?>>1945</option>
                                                                            <option value="1944" <?php echo ($yeardod === '1944') ? 'selected' : ''; ?>>1944</option>
                                                                            <option value="1943" <?php echo ($yeardod === '1943') ? 'selected' : ''; ?>>1943</option>
                                                                            <option value="1942" <?php echo ($yeardod === '1942') ? 'selected' : ''; ?>>1942</option>
                                                                            <option value="1941" <?php echo ($yeardod === '1941') ? 'selected' : ''; ?>>1941</option>
                                                                            <option value="1940" <?php echo ($yeardod === '1940') ? 'selected' : ''; ?>>1940</option>
                                                                            <option value="1939" <?php echo ($yeardod === '1939') ? 'selected' : ''; ?>>1939</option>
                                                                            <option value="1938" <?php echo ($yeardod === '1938') ? 'selected' : ''; ?>>1938</option>
                                                                            <option value="1937" <?php echo ($yeardod === '1937') ? 'selected' : ''; ?>>1937</option>
                                                                            <option value="1936" <?php echo ($yeardod === '1936') ? 'selected' : ''; ?>>1936</option>
                                                                            <option value="1935" <?php echo ($yeardod === '1935') ? 'selected' : ''; ?>>1935</option>
                                                                            <option value="1934" <?php echo ($yeardod === '1934') ? 'selected' : ''; ?>>1934</option>
                                                                            <option value="1933" <?php echo ($yeardod === '1933') ? 'selected' : ''; ?>>1933</option>
                                                                            <option value="1932" <?php echo ($yeardod === '1932') ? 'selected' : ''; ?>>1932</option>
                                                                            <option value="1931" <?php echo ($yeardod === '1931') ? 'selected' : ''; ?>>1931</option>
                                                                            <option value="1930" <?php echo ($yeardod === '1930') ? 'selected' : ''; ?>>1930</option>
                                                                            <option value="1929" <?php echo ($yeardod === '1929') ? 'selected' : ''; ?>>1929</option>
                                                                            <option value="1928" <?php echo ($yeardod === '1928') ? 'selected' : ''; ?>>1928</option>
                                                                            <option value="1927" <?php echo ($yeardod === '1927') ? 'selected' : ''; ?>>1927</option>
                                                                            <option value="1926" <?php echo ($yeardod === '1926') ? 'selected' : ''; ?>>1926</option>
                                                                            <option value="1925" <?php echo ($yeardod === '1925') ? 'selected' : ''; ?>>1925</option>
                                                                            <option value="1924" <?php echo ($yeardod === '1924') ? 'selected' : ''; ?>>1924</option>
                                                                            <option value="1923" <?php echo ($yeardod === '1923') ? 'selected' : ''; ?>>1923</option>
                                                                            <option value="1922" <?php echo ($yeardod === '1922') ? 'selected' : ''; ?>>1922</option>
                                                                            <option value="1921" <?php echo ($yeardod === '1921') ? 'selected' : ''; ?>>1921</option>
                                                                            <option value="1920" <?php echo ($yeardod === '1920') ? 'selected' : ''; ?>>1920</option>
                                                                            <option value="1919" <?php echo ($yeardod === '1919') ? 'selected' : ''; ?>>1919</option>
                                                                            <option value="1918" <?php echo ($yeardod === '1918') ? 'selected' : ''; ?>>1918</option>
                                                                            <option value="1917" <?php echo ($yeardod === '1917') ? 'selected' : ''; ?>>1917</option>
                                                                            <option value="1916" <?php echo ($yeardod === '1916') ? 'selected' : ''; ?>>1916</option>
                                                                            <option value="1915" <?php echo ($yeardod === '1915') ? 'selected' : ''; ?>>1915</option>
                                                                            <option value="1914" <?php echo ($yeardod === '1914') ? 'selected' : ''; ?>>1914</option>
                                                                            <option value="1913" <?php echo ($yeardod === '1913') ? 'selected' : ''; ?>>1913</option>
                                                                            <option value="1912" <?php echo ($yeardod === '1912') ? 'selected' : ''; ?>>1912</option>
                                                                            <option value="1911" <?php echo ($yeardod === '1911') ? 'selected' : ''; ?>>1911</option>
                                                                            <option value="1910" <?php echo ($yeardod === '1910') ? 'selected' : ''; ?>>1910</option>
                                                                            <option value="1909" <?php echo ($yeardod === '1909') ? 'selected' : ''; ?>>1909</option>
                                                                            <option value="1908" <?php echo ($yeardod === '1908') ? 'selected' : ''; ?>>1908</option>
                                                                            <option value="1907" <?php echo ($yeardod === '1907') ? 'selected' : ''; ?>>1907</option>
                                                                            <option value="1906" <?php echo ($yeardod === '1906') ? 'selected' : ''; ?>>1906</option>
                                                                            <option value="1905" <?php echo ($yeardod === '1905') ? 'selected' : ''; ?>>1905</option>
                                                                            <option value="1904" <?php echo ($yeardod === '1904') ? 'selected' : ''; ?>>1904</option>
                                                                            <option value="1903" <?php echo ($yeardod === '1903') ? 'selected' : ''; ?>>1903</option>
                                                                            <option value="1902" <?php echo ($yeardod === '1902') ? 'selected' : ''; ?>>1902</option>
                                                                            <option value="1901" <?php echo ($yeardod === '1901') ? 'selected' : ''; ?>>1901</option>
                                                                            <option value="1900" <?php echo ($yeardod === '1900') ? 'selected' : ''; ?>>1900</option>
                                                                            <option value="1899" <?php echo ($yeardod === '1899') ? 'selected' : ''; ?>>1899</option>
                                                                            <option value="1898" <?php echo ($yeardod === '1898') ? 'selected' : ''; ?>>1898</option>
                                                                            <option value="1897" <?php echo ($yeardod === '1897') ? 'selected' : ''; ?>>1897</option>
                                                                            <option value="1896" <?php echo ($yeardod === '1896') ? 'selected' : ''; ?>>1896</option>
                                                                            <option value="1895" <?php echo ($yeardod === '1895') ? 'selected' : ''; ?>>1895</option>
                                                                            <option value="1894" <?php echo ($yeardod === '1894') ? 'selected' : ''; ?>>1894</option>
                                                                            <option value="1893" <?php echo ($yeardod === '1893') ? 'selected' : ''; ?>>1893</option>
                                                                            <option value="1892" <?php echo ($yeardod === '1892') ? 'selected' : ''; ?>>1892</option>
                                                                            <option value="1891" <?php echo ($yeardod === '1891') ? 'selected' : ''; ?>>1891</option>
                                                                            <option value="1890" <?php echo ($yeardod === '1890') ? 'selected' : ''; ?>>1890</option>
                                                                            <option value="1889" <?php echo ($yeardod === '1889') ? 'selected' : ''; ?>>1889</option>
                                                                            <option value="1888" <?php echo ($yeardod === '1888') ? 'selected' : ''; ?>>1888</option>
                                                                            <option value="1887" <?php echo ($yeardod === '1887') ? 'selected' : ''; ?>>1887</option>
                                                                            <option value="1886" <?php echo ($yeardod === '1886') ? 'selected' : ''; ?>>1886</option>
                                                                            <option value="1885" <?php echo ($yeardod === '1885') ? 'selected' : ''; ?>>1885</option>
                                                                            <option value="1884" <?php echo ($yeardod === '1884') ? 'selected' : ''; ?>>1884</option>
                                                                            <option value="1883" <?php echo ($yeardod === '1883') ? 'selected' : ''; ?>>1883</option>
                                                                            <option value="1882" <?php echo ($yeardod === '1882') ? 'selected' : ''; ?>>1882</option>
                                                                            <option value="1881" <?php echo ($yeardod === '1881') ? 'selected' : ''; ?>>1881</option>
                                                                            <option value="1880" <?php echo ($yeardod === '1880') ? 'selected' : ''; ?>>1880</option>
                                                                            <option value="1879" <?php echo ($yeardod === '1879') ? 'selected' : ''; ?>>1879</option>
                                                                            <option value="1878" <?php echo ($yeardod === '1878') ? 'selected' : ''; ?>>1878</option>
                                                                            <option value="1877" <?php echo ($yeardod === '1877') ? 'selected' : ''; ?>>1877</option>
                                                                            <option value="1876" <?php echo ($yeardod === '1876') ? 'selected' : ''; ?>>1876</option>
                                                                            <option value="1875" <?php echo ($yeardod === '1700') ? 'selected' : ''; ?>>1875</option>
                                                                            <option value="1874" <?php echo ($yeardod === '1874') ? 'selected' : ''; ?>>1874</option>
                                                                            <option value="1873" <?php echo ($yeardod === '1873') ? 'selected' : ''; ?>>1873</option>
                                                                            <option value="1872" <?php echo ($yeardod === '1872') ? 'selected' : ''; ?>>1872</option>
                                                                            <option value="1871" <?php echo ($yeardod === '1871') ? 'selected' : ''; ?>>1871</option>
                                                                            <option value="1870" <?php echo ($yeardod === '1870') ? 'selected' : ''; ?>>1870</option>
                                                                            <option value="1869" <?php echo ($yeardod === '1869') ? 'selected' : ''; ?>>1869</option>
                                                                            <option value="1868" <?php echo ($yeardod === '1868') ? 'selected' : ''; ?>>1868</option>
                                                                            <option value="1867" <?php echo ($yeardod === '1867') ? 'selected' : ''; ?>>1867</option>
                                                                            <option value="1865" <?php echo ($yeardod === '1865') ? 'selected' : ''; ?>>1865</option>
                                                                            <option value="1864" <?php echo ($yeardod === '1864') ? 'selected' : ''; ?>>1864</option>
                                                                            <option value="1863" <?php echo ($yeardod === '1863') ? 'selected' : ''; ?>>1863</option>
                                                                            <option value="1862" <?php echo ($yeardod === '1862') ? 'selected' : ''; ?>>1862</option>
                                                                            <option value="1861" <?php echo ($yeardod === '1861') ? 'selected' : ''; ?>>1861</option>
                                                                            <option value="1860" <?php echo ($yeardod === '1860') ? 'selected' : ''; ?>>1860</option>
                                                                            <option value="1859" <?php echo ($yeardod === '1859') ? 'selected' : ''; ?>>1859</option>
                                                                            <option value="1858" <?php echo ($yeardod === '1858') ? 'selected' : ''; ?>>1858</option>
                                                                            <option value="1857" <?php echo ($yeardod === '1857') ? 'selected' : ''; ?>>1857</option>
                                                                            <option value="1856" <?php echo ($yeardod === '1856') ? 'selected' : ''; ?>>1856</option>
                                                                            <option value="1855" <?php echo ($yeardod === '1855') ? 'selected' : ''; ?>>1855</option>
                                                                            <option value="1854" <?php echo ($yeardod === '1854') ? 'selected' : ''; ?>>1854</option>
                                                                            <option value="1853" <?php echo ($yeardod === '1853') ? 'selected' : ''; ?>>1853</option>
                                                                            <option value="1852" <?php echo ($yeardod === '1852') ? 'selected' : ''; ?>>1852</option>
                                                                            <option value="1851" <?php echo ($yeardod === '1851') ? 'selected' : ''; ?>>1851</option>
                                                                            <option value="1850" <?php echo ($yeardod === '1850') ? 'selected' : ''; ?>>1850</option>
                                                                            <option value="1849" <?php echo ($yeardod === '1849') ? 'selected' : ''; ?>>1849</option>
                                                                            <option value="1848" <?php echo ($yeardod === '1848') ? 'selected' : ''; ?>>1848</option>
                                                                            <option value="1847" <?php echo ($yeardod === '1847') ? 'selected' : ''; ?>>1847</option>
                                                                            <option value="1846" <?php echo ($yeardod === '1846') ? 'selected' : ''; ?>>1846</option>
                                                                            <option value="1845" <?php echo ($yeardod === '1845') ? 'selected' : ''; ?>>1845</option>
                                                                            <option value="1844" <?php echo ($yeardod === '1844') ? 'selected' : ''; ?>>1844</option>
                                                                            <option value="1843" <?php echo ($yeardod === '1843') ? 'selected' : ''; ?>>1843</option>
                                                                            <option value="1842" <?php echo ($yeardod === '1842') ? 'selected' : ''; ?>>1842</option>
                                                                            <option value="1841" <?php echo ($yeardod === '1841') ? 'selected' : ''; ?>>1841</option>
                                                                            <option value="1840" <?php echo ($yeardod === '1840') ? 'selected' : ''; ?>>1840</option>
                                                                            <option value="1839" <?php echo ($yeardod === '1839') ? 'selected' : ''; ?>>1839</option>
                                                                            <option value="1838" <?php echo ($yeardod === '1838') ? 'selected' : ''; ?>>1838</option>
                                                                            <option value="1837" <?php echo ($yeardod === '1837') ? 'selected' : ''; ?>>1837</option>
                                                                            <option value="1836" <?php echo ($yeardod === '1836') ? 'selected' : ''; ?>>1836</option>
                                                                            <option value="1835" <?php echo ($yeardod === '1835') ? 'selected' : ''; ?>>1835</option>
                                                                            <option value="1834" <?php echo ($yeardod === '1834') ? 'selected' : ''; ?>>1834</option>
                                                                            <option value="1833" <?php echo ($yeardod === '1833') ? 'selected' : ''; ?>>1833</option>
                                                                            <option value="1832" <?php echo ($yeardod === '1832') ? 'selected' : ''; ?>>1832</option>
                                                                            <option value="1831" <?php echo ($yeardod === '1831') ? 'selected' : ''; ?>>1831</option>
                                                                            <option value="1830" <?php echo ($yeardod === '1830') ? 'selected' : ''; ?>>1830</option>
                                                                            <option value="1829" <?php echo ($yeardod === '1829') ? 'selected' : ''; ?>>1829</option>
                                                                            <option value="1828" <?php echo ($yeardod === '1828') ? 'selected' : ''; ?>>1828</option>
                                                                            <option value="1827" <?php echo ($yeardod === '1827') ? 'selected' : ''; ?>>1827</option>
                                                                            <option value="1826" <?php echo ($yeardod === '1826') ? 'selected' : ''; ?>>1826</option>
                                                                            <option value="1825" <?php echo ($yeardod === '1825') ? 'selected' : ''; ?>>1825</option>
                                                                            <option value="1824" <?php echo ($yeardod === '1824') ? 'selected' : ''; ?>>1824</option>
                                                                            <option value="1823" <?php echo ($yeardod === '1823') ? 'selected' : ''; ?>>1823</option>
                                                                            <option value="1822" <?php echo ($yeardod === '1822') ? 'selected' : ''; ?>>1822</option>
                                                                            <option value="1821" <?php echo ($yeardod === '1821') ? 'selected' : ''; ?>>1821</option>
                                                                            <option value="1820" <?php echo ($yeardod === '1820') ? 'selected' : ''; ?>>1820</option>
                                                                            <option value="1819" <?php echo ($yeardod === '1819') ? 'selected' : ''; ?>>1819</option>
                                                                            <option value="1818" <?php echo ($yeardod === '1818') ? 'selected' : ''; ?>>1818</option>
                                                                            <option value="1817" <?php echo ($yeardod === '1817') ? 'selected' : ''; ?>>1817</option>
                                                                            <option value="1816" <?php echo ($yeardod === '1816') ? 'selected' : ''; ?>>1816</option>
                                                                            <option value="1815" <?php echo ($yeardod === '1815') ? 'selected' : ''; ?>>1815</option>
                                                                            <option value="1814" <?php echo ($yeardod === '1814') ? 'selected' : ''; ?>>1814</option>
                                                                            <option value="1813" <?php echo ($yeardod === '1813') ? 'selected' : ''; ?>>1813</option>
                                                                            <option value="1812" <?php echo ($yeardod === '1812') ? 'selected' : ''; ?>>1812</option>
                                                                            <option value="1811" <?php echo ($yeardod === '1811') ? 'selected' : ''; ?>>1811</option>
                                                                            <option value="1810" <?php echo ($yeardod === '1810') ? 'selected' : ''; ?>>1810</option>
                                                                            <option value="1809" <?php echo ($yeardod === '1809') ? 'selected' : ''; ?>>1809</option>
                                                                            <option value="1808" <?php echo ($yeardod === '1808') ? 'selected' : ''; ?>>1808</option>
                                                                            <option value="1807" <?php echo ($yeardod === '1807') ? 'selected' : ''; ?>>1807</option>
                                                                            <option value="1806" <?php echo ($yeardod === '1806') ? 'selected' : ''; ?>>1806</option>
                                                                            <option value="1805" <?php echo ($yeardod === '1805') ? 'selected' : ''; ?>>1805</option>
                                                                            <option value="1804" <?php echo ($yeardod === '1804') ? 'selected' : ''; ?>>1804</option>
                                                                            <option value="1803" <?php echo ($yeardod === '1803') ? 'selected' : ''; ?>>1803</option>
                                                                            <option value="1802" <?php echo ($yeardod === '1802') ? 'selected' : ''; ?>>1802</option>
                                                                            <option value="1801" <?php echo ($yeardod === '1801') ? 'selected' : ''; ?>>1801</option>
                                                                            <option value="1800" <?php echo ($yeardod === '1800') ? 'selected' : ''; ?>>1800</option>
                                                                            <option value="1799" <?php echo ($yeardod === '1799') ? 'selected' : ''; ?>>1799</option>
                                                                            <option value="1798" <?php echo ($yeardod === '1798') ? 'selected' : ''; ?>>1798</option>
                                                                            <option value="1797" <?php echo ($yeardod === '1797') ? 'selected' : ''; ?>>1797</option>
                                                                            <option value="1796" <?php echo ($yeardod === '1796') ? 'selected' : ''; ?>>1796</option>
                                                                            <option value="1795" <?php echo ($yeardod === '1795') ? 'selected' : ''; ?>>1795</option>
                                                                            <option value="1794" <?php echo ($yeardod === '1794') ? 'selected' : ''; ?>>1794</option>
                                                                            <option value="1793" <?php echo ($yeardod === '1793') ? 'selected' : ''; ?>>1793</option>
                                                                            <option value="1792" <?php echo ($yeardod === '1792') ? 'selected' : ''; ?>>1792</option>
                                                                            <option value="1791" <?php echo ($yeardod === '1791') ? 'selected' : ''; ?>>1791</option>
                                                                            <option value="1790" <?php echo ($yeardod === '1790') ? 'selected' : ''; ?>>1790</option>
                                                                            <option value="1789" <?php echo ($yeardod === '1789') ? 'selected' : ''; ?>>1789</option>
                                                                            <option value="1788" <?php echo ($yeardod === '1788') ? 'selected' : ''; ?>>1788</option>
                                                                            <option value="1787" <?php echo ($yeardod === '1787') ? 'selected' : ''; ?>>1787</option>
                                                                            <option value="1786" <?php echo ($yeardod === '1786') ? 'selected' : ''; ?>>1786</option>
                                                                            <option value="1785" <?php echo ($yeardod === '1785') ? 'selected' : ''; ?>>1785</option>
                                                                            <option value="1784" <?php echo ($yeardod === '1784') ? 'selected' : ''; ?>>1784</option>
                                                                            <option value="1783" <?php echo ($yeardod === '1783') ? 'selected' : ''; ?>>1783</option>
                                                                            <option value="1782" <?php echo ($yeardod === '1782') ? 'selected' : ''; ?>>1782</option>
                                                                            <option value="1781" <?php echo ($yeardod === '1781') ? 'selected' : ''; ?>>1781</option>
                                                                            <option value="1780" <?php echo ($yeardod === '1780') ? 'selected' : ''; ?>>1780</option>
                                                                            <option value="1779" <?php echo ($yeardod === '1779') ? 'selected' : ''; ?>>1779</option>
                                                                            <option value="1778" <?php echo ($yeardod === '1778') ? 'selected' : ''; ?>>1778</option>
                                                                            <option value="1777" <?php echo ($yeardod === '1777') ? 'selected' : ''; ?>>1777</option>
                                                                            <option value="1776" <?php echo ($yeardod === '1776') ? 'selected' : ''; ?>>1776</option>
                                                                            <option value="1775" <?php echo ($yeardod === '1775') ? 'selected' : ''; ?>>1775</option>
                                                                            <option value="1774" <?php echo ($yeardod === '1774') ? 'selected' : ''; ?>>1774</option>
                                                                            <option value="1773" <?php echo ($yeardod === '1773') ? 'selected' : ''; ?>>1773</option>
                                                                            <option value="1772" <?php echo ($yeardod === '1772') ? 'selected' : ''; ?>>1772</option>
                                                                            <option value="1771" <?php echo ($yeardod === '1771') ? 'selected' : ''; ?>>1771</option>
                                                                            <option value="1770" <?php echo ($yeardod === '1770') ? 'selected' : ''; ?>>1770</option>
                                                                            <option value="1769" <?php echo ($yeardod === '1769') ? 'selected' : ''; ?>>1769</option>
                                                                            <option value="1768" <?php echo ($yeardod === '1768') ? 'selected' : ''; ?>>1768</option>
                                                                            <option value="1767" <?php echo ($yeardod === '1757') ? 'selected' : ''; ?>>1767</option>
                                                                            <option value="1766" <?php echo ($yeardod === '1766') ? 'selected' : ''; ?>>1766</option>
                                                                            <option value="1765" <?php echo ($yeardod === '1765') ? 'selected' : ''; ?>>1765</option>
                                                                            <option value="1764" <?php echo ($yeardod === '1764') ? 'selected' : ''; ?>>1764</option>
                                                                            <option value="1763" <?php echo ($yeardod === '1763') ? 'selected' : ''; ?>>1763</option>
                                                                            <option value="1762" <?php echo ($yeardod === '1762') ? 'selected' : ''; ?>>1762</option>
                                                                            <option value="1761" <?php echo ($yeardod === '1761') ? 'selected' : ''; ?>>1761</option>
                                                                            <option value="1760" <?php echo ($yeardod === '1760') ? 'selected' : ''; ?>>1760</option>
                                                                            <option value="1759" <?php echo ($yeardod === '1759') ? 'selected' : ''; ?>>1759</option>
                                                                            <option value="1758" <?php echo ($yeardod === '1758') ? 'selected' : ''; ?>>1758</option>
                                                                            <option value="1757" <?php echo ($yeardod === '1757') ? 'selected' : ''; ?>>1757</option>
                                                                            <option value="1756" <?php echo ($yeardod === '1756') ? 'selected' : ''; ?>>1756</option>
                                                                            <option value="1755" <?php echo ($yeardod === '1755') ? 'selected' : ''; ?>>1755</option>
                                                                            <option value="1754" <?php echo ($yeardod === '1754') ? 'selected' : ''; ?>>1754</option>
                                                                            <option value="1753" <?php echo ($yeardod === '1753') ? 'selected' : ''; ?>>1753</option>
                                                                            <option value="1752" <?php echo ($yeardod === '1752') ? 'selected' : ''; ?>>1752</option>
                                                                            <option value="1751" <?php echo ($yeardod === '1751') ? 'selected' : ''; ?>>1751</option>
                                                                            <option value="1750" <?php echo ($yeardod === '1750') ? 'selected' : ''; ?>>1750</option>
                                                                            <option value="1749" <?php echo ($yeardod === '1749') ? 'selected' : ''; ?>>1749</option>
                                                                            <option value="1748" <?php echo ($yeardod === '1748') ? 'selected' : ''; ?>>1748</option>
                                                                            <option value="1747" <?php echo ($yeardod === '1747') ? 'selected' : ''; ?>>1747</option>
                                                                            <option value="1746" <?php echo ($yeardod === '1746') ? 'selected' : ''; ?>>1746</option>
                                                                            <option value="1745" <?php echo ($yeardod === '1745') ? 'selected' : ''; ?>>1745</option>
                                                                            <option value="1744" <?php echo ($yeardod === '1744') ? 'selected' : ''; ?>>1744</option>
                                                                            <option value="1743" <?php echo ($yeardod === '1743') ? 'selected' : ''; ?>>1743</option>
                                                                            <option value="1742" <?php echo ($yeardod === '1742') ? 'selected' : ''; ?>>1742</option>
                                                                            <option value="1741" <?php echo ($yeardod === '1741') ? 'selected' : ''; ?>>1741</option>
                                                                            <option value="1740" <?php echo ($yeardod === '1740') ? 'selected' : ''; ?>>1740</option>
                                                                            <option value="1739" <?php echo ($yeardod === '1739') ? 'selected' : ''; ?>>1739</option>
                                                                            <option value="1738" <?php echo ($yeardod === '1738') ? 'selected' : ''; ?>>1738</option>
                                                                            <option value="1737" <?php echo ($yeardod === '1737') ? 'selected' : ''; ?>>1737</option>
                                                                            <option value="1736" <?php echo ($yeardod === '1736') ? 'selected' : ''; ?>>1736</option>
                                                                            <option value="1735" <?php echo ($yeardod === '1735') ? 'selected' : ''; ?>>1735</option>
                                                                            <option value="1734" <?php echo ($yeardod === '1734') ? 'selected' : ''; ?>>1734</option>
                                                                            <option value="1733" <?php echo ($yeardod === '1733') ? 'selected' : ''; ?>>1733</option>
                                                                            <option value="1732" <?php echo ($yeardod === '1732') ? 'selected' : ''; ?>>1732</option>
                                                                            <option value="1731" <?php echo ($yeardod === '1731') ? 'selected' : ''; ?>>1731</option>
                                                                            <option value="1730" <?php echo ($yeardod === '1730') ? 'selected' : ''; ?>>1730</option>
                                                                            <option value="1729" <?php echo ($yeardod === '1729') ? 'selected' : ''; ?>>1729</option>
                                                                            <option value="1728" <?php echo ($yeardod === '1728') ? 'selected' : ''; ?>>1728</option>
                                                                            <option value="1727" <?php echo ($yeardod === '1727') ? 'selected' : ''; ?>>1727</option>
                                                                            <option value="1726" <?php echo ($yeardod === '1726') ? 'selected' : ''; ?>>1726</option>
                                                                            <option value="1725" <?php echo ($yeardod === '1725') ? 'selected' : ''; ?>>1725</option>
                                                                            <option value="1724" <?php echo ($yeardod === '1724') ? 'selected' : ''; ?>>1724</option>
                                                                            <option value="1723" <?php echo ($yeardod === '1723') ? 'selected' : ''; ?>>1723</option>
                                                                            <option value="1722" <?php echo ($yeardod === '1722') ? 'selected' : ''; ?>>1722</option>
                                                                            <option value="1721" <?php echo ($yeardod === '1721') ? 'selected' : ''; ?>>1721</option>
                                                                            <option value="1720" <?php echo ($yeardod === '1720') ? 'selected' : ''; ?>>1720</option>
                                                                            <option value="1719" <?php echo ($yeardod === '1719') ? 'selected' : ''; ?>>1719</option>
                                                                            <option value="1718" <?php echo ($yeardod === '1718') ? 'selected' : ''; ?>>1718</option>
                                                                            <option value="1717" <?php echo ($yeardod === '1717') ? 'selected' : ''; ?>>1717</option>
                                                                            <option value="1716" <?php echo ($yeardod === '1716') ? 'selected' : ''; ?>>1716</option>
                                                                            <option value="1715" <?php echo ($yeardod === '1715') ? 'selected' : ''; ?>>1715</option>
                                                                            <option value="1714" <?php echo ($yeardod === '1714') ? 'selected' : ''; ?>>1714</option>
                                                                            <option value="1713" <?php echo ($yeardod === '1713') ? 'selected' : ''; ?>>1713</option>
                                                                            <option value="1712" <?php echo ($yeardod === '1712') ? 'selected' : ''; ?>>1712</option>
                                                                            <option value="1711" <?php echo ($yeardod === '1711') ? 'selected' : ''; ?>>1711</option>
                                                                            <option value="1710" <?php echo ($yeardod === '1710') ? 'selected' : ''; ?>>1710</option>
                                                                            <option value="1709" <?php echo ($yeardod === '1709') ? 'selected' : ''; ?>>1709</option>
                                                                            <option value="1708" <?php echo ($yeardod === '1708') ? 'selected' : ''; ?>>1708</option>
                                                                            <option value="1707" <?php echo ($yeardod === '1707') ? 'selected' : ''; ?>>1707</option>
                                                                            <option value="1706" <?php echo ($yeardod === '1706') ? 'selected' : ''; ?>>1706</option>
                                                                            <option value="1705" <?php echo ($yeardod === '1705') ? 'selected' : ''; ?>>1705</option>
                                                                            <option value="1704" <?php echo ($yeardod === '1704') ? 'selected' : ''; ?>>1704</option>
                                                                            <option value="1703" <?php echo ($yeardod === '1703') ? 'selected' : ''; ?>>1703</option>
                                                                            <option value="1702" <?php echo ($yeardod === '1702') ? 'selected' : ''; ?>>1702</option>
                                                                            <option value="1701" <?php echo ($yeardod === '1701') ? 'selected' : ''; ?>>1701</option>
                                                                            <option value="1700" <?php echo ($yeardod === '1700') ? 'selected' : ''; ?>>1700</option>
                                                                        </select>
                                                                        <select name="date_of_death_month" style="border: none;" class="form-control-sm input">
                                                                            <option value="01" <?php echo ($monthdod === '01') ? 'selected' : ''; ?>>01</option>
                                                                            <option value="02" <?php echo ($monthdod === '02') ? 'selected' : ''; ?>>02</option>
                                                                            <option value="03" <?php echo ($monthdod === '03') ? 'selected' : ''; ?>>03</option>
                                                                            <option value="04" <?php echo ($monthdod === '04') ? 'selected' : ''; ?>>04</option>
                                                                            <option value="05" <?php echo ($monthdod === '05') ? 'selected' : ''; ?>>05</option>
                                                                            <option value="06" <?php echo ($monthdod === '06') ? 'selected' : ''; ?>>06</option>
                                                                            <option value="07" <?php echo ($monthdod === '07') ? 'selected' : ''; ?>>07</option>
                                                                            <option value="08" <?php echo ($monthdod === '08') ? 'selected' : ''; ?>>08</option>
                                                                            <option value="09" <?php echo ($monthdod === '09') ? 'selected' : ''; ?>>09</option>
                                                                            <option value="10" <?php echo ($monthdod === '10') ? 'selected' : ''; ?>>10</option>
                                                                            <option value="11" <?php echo ($monthdod === '11') ? 'selected' : ''; ?>>11</option>
                                                                            <option value="12" <?php echo ($monthdod === '12') ? 'selected' : ''; ?>>12</option>
                                                                        </select>
                                                                        <select name="date_of_death_day" style="border: none;" class="form-control-sm input">
                                                                            <option value="01" <?php echo ($daydod === '01') ? 'selected' : ''; ?>>01</option>
                                                                            <option value="02" <?php echo ($daydod === '02') ? 'selected' : ''; ?>>02</option>
                                                                            <option value="03" <?php echo ($daydod === '03') ? 'selected' : ''; ?>>03</option>
                                                                            <option value="04" <?php echo ($daydod === '04') ? 'selected' : ''; ?>>04</option>
                                                                            <option value="05" <?php echo ($daydod === '05') ? 'selected' : ''; ?>>05</option>
                                                                            <option value="06" <?php echo ($daydod === '06') ? 'selected' : ''; ?>>06</option>
                                                                            <option value="07" <?php echo ($daydod === '07') ? 'selected' : ''; ?>>07</option>
                                                                            <option value="08" <?php echo ($daydod === '08') ? 'selected' : ''; ?>>08</option>
                                                                            <option value="09" <?php echo ($daydod === '09') ? 'selected' : ''; ?>>09</option>
                                                                            <option value="10" <?php echo ($daydod === '10') ? 'selected' : ''; ?>>10</option>
                                                                            <option value="11" <?php echo ($daydod === '11') ? 'selected' : ''; ?>>11</option>
                                                                            <option value="12" <?php echo ($daydod === '12') ? 'selected' : ''; ?>>12</option>
                                                                            <option value="13" <?php echo ($daydod === '13') ? 'selected' : ''; ?>>13</option>
                                                                            <option value="14" <?php echo ($daydod === '14') ? 'selected' : ''; ?>>14</option>
                                                                            <option value="15" <?php echo ($daydod === '15') ? 'selected' : ''; ?>>15</option>
                                                                            <option value="16" <?php echo ($daydod === '16') ? 'selected' : ''; ?>>16</option>
                                                                            <option value="17" <?php echo ($daydod === '17') ? 'selected' : ''; ?>>17</option>
                                                                            <option value="18" <?php echo ($daydod === '18') ? 'selected' : ''; ?>>18</option>
                                                                            <option value="19" <?php echo ($daydod === '19') ? 'selected' : ''; ?>>19</option>
                                                                            <option value="20" <?php echo ($daydod === '20') ? 'selected' : ''; ?>>20</option>
                                                                            <option value="21" <?php echo ($daydod === '21') ? 'selected' : ''; ?>>21</option>
                                                                            <option value="22" <?php echo ($daydod === '22') ? 'selected' : ''; ?>>22</option>
                                                                            <option value="23" <?php echo ($daydod === '23') ? 'selected' : ''; ?>>23</option>
                                                                            <option value="24" <?php echo ($daydod === '24') ? 'selected' : ''; ?>>24</option>
                                                                            <option value="25" <?php echo ($daydod === '25') ? 'selected' : ''; ?>>25</option>
                                                                            <option value="26" <?php echo ($daydod === '26') ? 'selected' : ''; ?>>26</option>
                                                                            <option value="27" <?php echo ($daydod === '27') ? 'selected' : ''; ?>>27</option>
                                                                            <option value="28" <?php echo ($daydod === '28') ? 'selected' : ''; ?>>28</option>
                                                                            <option value="29" <?php echo ($daydod === '29') ? 'selected' : ''; ?>>29</option>
                                                                            <option value="30" <?php echo ($daydod === '30') ? 'selected' : ''; ?>>30</option>
                                                                            <option value="31" <?php echo ($daydod === '31') ? 'selected' : ''; ?>>31</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </label>
                                                            <a href="#" id="popover" rel="popover">
                                                                <span class="glyphicon glyphicon-info-sign"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4 hide-email" id="hide-divs4">
                                                        <div class="form-outline">
                                                            <label for="" class="mb-2">Their email (optional)</label>
                                                            <input type="text" name="email" placeholder="" class="form-control" style="border-radius: 3px; font-size: medium;" />
                                                        </div>
                                                    </div>

                                                <?php
                                                        }
                                                ?>
                                                <div class="row">
                                                    <div class="">
                                                        <div id="hide-gender">
                                                            <p><strong>Gender:</strong></p>

                                                            <label class="" style="display: inline-flex !important;">
                                                                <input type="radio" name="gender" class="form-check-label male m-2" id="male" value="m" <?php if ($gendermodified === 'm') echo 'checked'; ?> autocomplete="off"> Male
                                                            </label>
                                                            <label class="" style="display: inline-flex !important;">
                                                                <input type="radio" name="gender" class="form-check-label female m-2" id="female" value="f" <?php if ($gendermodified === 'f') echo 'checked'; ?> autocomplete="off"> Female
                                                            </label>
                                                            <label class="" style="display: inline-flex !important;">
                                                                <input type="radio" name="gender" class="form-check-label other m-2" id="other" value="o" <?php if ($gendermodified === 'o') echo 'checked'; ?> autocomplete="off"> Other
                                                            </label>
                                                        </div>
                                                        <br>
                                                        <label class="gender-label" for=""><strong>He</strong> is your:</label>
                                                        <select class="form-select form-select-sm family py-2" name="my-relation-select" id="select_required" aria-label="Default select example" required>
                                                            <option value=""></option>
                                                            <option class="female">mother</option>
                                                            <option class="male">father</option>
                                                            <option class="female">sister</option>
                                                            <option class="male">brother</option>
                                                            <option class="female" id="newTextBoxUp">grandmother</option>
                                                            <option class="male" id="newTextBoxUp">grandfather</option>
                                                            <option class="male female other" id="newTextBoxBoth">cousin</option>
                                                            <option class="female" id="newTextBoxUp">aunt</option>
                                                            <option class="male" id="newTextBoxUp">uncle</option>
                                                            <option class="male">brother-in-law</option>
                                                            <option class="female">daughter</option>
                                                            <option class="female">daughter-in-law</option>
                                                            <option class="male">ex-husband</option>
                                                            <option class="female">ex-wife</option>
                                                            <option class="male">father-in-law</option>
                                                            <option class="female" id="newTextBoxDown">granddaughter</option>
                                                            <option class="male" id="newTextBoxDown">grandson</option>
                                                            <option class="female" id="newTextBoxUp">great aunt</option>
                                                            <option class="female" id="newTextBoxUp">great grand aunt</option>
                                                            <option class="male" id="newTextBoxDown">great grand nephew</option>
                                                            <option class="female" id="newTextBoxDown">great grand niece</option>
                                                            <option class="male" id="newTextBoxUp">great grand uncle</option>
                                                            <option class="male" id="newTextBoxDown">great nephew</option>
                                                            <option class="female" id="newTextBoxDown">great niece</option>
                                                            <option class="male" id="newTextBoxUp">great uncle</option>
                                                            <option class="female" id="newTextBoxDown">great-grand-daughter</option>
                                                            <option class="male" id="newTextBoxUp">great-grandfather</option>
                                                            <option class="female" id="newTextBoxUp">great-grandmother</option>
                                                            <option class="male" id="newTextBoxDown">great-grandson</option>
                                                            <option class="female">great-great-granddaughter</option>
                                                            <option class="male">great-great-grandfather</option>
                                                            <option class="female">great-great-grandmother</option>
                                                            <option class="male">great-great-grandson</option>
                                                            <option class="male">husband</option>
                                                            <option class="female">mother-in-law</option>
                                                            <option class="male" id="newTextBoxDown">nephew</option>
                                                            <option class="female" id="newTextBoxDown">niece</option>
                                                            <option class="male female">significant other</option>
                                                            <option class="female">sister-in-law</option>
                                                            <option class="male">son</option>
                                                            <option class="male">son-in-law</option>
                                                            <option class="female" id="newTextBoxUp">step-aunt</option>
                                                            <option class="male" id="newTextBoxBoth">step-brother</option>
                                                            <option class="male female" id="newTextBoxBoth">step-cousin</option>
                                                            <option class="female">step-daughter</option>
                                                            <option class="male">step-father</option>
                                                            <option class="female" id="newTextBoxDown">step-granddaughter</option>
                                                            <option class="male" id="newTextBoxUp">step-grandfather</option>
                                                            <option class="female" id="newTextBoxUp">step-grandmother</option>
                                                            <option class="male" id="newTextBoxDown">step-grandson</option>
                                                            <option class="female" id="newTextBoxDown">step-great-granddaughter</option>
                                                            <option class="male" id="newTextBoxUp">step-great-grandfather</option>
                                                            <option class="female" id="newTextBoxUp">step-great-grandmother</option>
                                                            <option class="male" id="newTextBoxDown">step-great-grandson</option>
                                                            <option class="female">step-great-great-granddaughter</option>
                                                            <option class="male">step-great-great-grandfather</option>
                                                            <option class="female">step-great-great-grandmother</option>
                                                            <option class="male">step-great-great-grandson</option>
                                                            <option class="female">step-mother</option>
                                                            <option class="male" id="newTextBoxDown">step-nephew</option>
                                                            <option class="female" id="newTextBoxDown">step-niece</option>
                                                            <option class="female" id="newTextBoxBoth">step-sister</option>
                                                            <option class="male">step-son</option>
                                                            <option class="male" id="newTextBoxUp">step-uncle</option>
                                                            <option class="female">wife</option>
                                                            <option class="other">parent</option>
                                                            <option class="other">sibling</option>
                                                            <option class="other" id="newTextBoxUp">grandparent</option>
                                                            <option class="other" id="newTextBoxUp">parents' sibling</option>
                                                            <option class="other">sibling-in-law</option>
                                                            <option class="other">ex-spouse/partner</option>
                                                            <option class="other">parent-in-law</option>
                                                            <option class="other" id="newTextBoxDown">grandchild</option>
                                                            <option class="other" id="newTextBoxDown">siblings great grandchild</option>
                                                            <option class="other" id="newTextBoxUp">great-grandparents sibiling</option>
                                                            <option class="other" id="newTextBoxDown">siblings grandchild</option>
                                                            <option class="other" id="newTextBoxUp">grandparents sibiling</option>
                                                            <option class="other" id="newTextBoxUp">great-grandparent</option>
                                                            <option class="other" id="newTextBoxDown">great-grandchild</option>
                                                            <option class="other">great-great-grandparent</option>
                                                            <option class="other">great-great-grandchild</option>
                                                            <option class="other">spouse/partner</option>
                                                            <option class="other" id="newTextBoxDown">siblings child</option>
                                                            <option class="other">significant other</option>
                                                            <option class="other">child</option>
                                                            <option class="other">child-in-law</option>
                                                            <option class="other" id="newTextBoxBoth">step-sibling</option>
                                                            <option class="other" id="newTextBoxBoth">step-cousin</option>
                                                            <option class="other">step-parent</option>
                                                            <option class="other" id="newTextBoxUp">step-grandparent</option>
                                                            <option class="other" id="newTextBoxDown">step-grandchild</option>
                                                            <option class="other" id="newTextBoxUp">step-great-grandparent</option>
                                                            <option class="other" id="newTextBoxDown">step-great-grandchild</option>
                                                            <option class="other">step-great-great-grandparent</option>
                                                            <option class="other">step-great-great-grandchild</option>
                                                            <option class="other" id="newTextBoxDown">step-siblings child</option>
                                                            <option class="other">step-child</option>
                                                            <option class="other" id="newTextBoxUp">step-parents sibling</option>
                                                        </select>
                                                        <div id="hide">
                                                            <label class="textUp bothlabel" for="">Parent Side:</label>
                                                            <select class="form-select form-select-sm textUpSelect bothselect py-2" name="parent-side-one" id="" aria-label="Default select example">
                                                                <option value="1" <?php echo ($parent_side === '1') ? 'selected' : ''; ?>>Father's side</option>
                                                                <option value="2" <?php echo ($parent_side === '2') ? 'selected' : ''; ?>>Mother's side</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="">
                                                        <hr>
                                                    </div>
                                                    <div class="">
                                                        <label for="" class="label-2"><strong>You</strong> are <strong>his</strong>:</label>
                                                        <input type="text" class="form-control form-control-sm text-new py-2" name="daughter" value="Daughter" disabled>
                                                        <!-- <select class="form-select data-new" disabled aria-label="Default select example">
                                                                    <option value="">daughter</option>
                                                                </select> -->
                                                        <div id="hide1" style="display:none;">
                                                            <label class="textDown bothlabel2" for="">Parent Side:</label>
                                                            <select class="form-select form-select-sm textDownSelect bothselect2 py-2" id="parent-side-two" name="parent-side-two" aria-label="Default select example">
                                                                <option value="1" <?php echo ($parent_side2 === '1') ? 'selected' : ''; ?>>Father's side</option>
                                                                <option value="2" <?php echo ($parent_side2 === '2') ? 'selected' : ''; ?>>Mother's side</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <?php
                                                // if($imgfor_selected != ''){

                                                // }
                                                ?>
                                                <div class="col-md-6" id="hide-image" style="border-left: 1px solid gray;">
                                                    <div class="p-3">
                                                        <div class="my-divs">

                                                            <h3>Choose Profile Picture</h3>
                                                            <div class="p-4 mb-3" style="border:1px solid gray;  justify-content: center; text-align: center; align-items: center;">
                                                                <div class="mb-3 ms-1">
                                                                    <img id="profile-image" src="/assets/profile/<?php echo $img ?>" class="profile-image" alt="Test Test" title="Test Test">

                                                                    <!-- <img src="/assets/profile/<?php echo $img ?>" class="profile-image" alt="Test Test" title="Test Test"> -->
                                                                </div>
                                                                <span class="fa-solid fa-image p-2"></span>
                                                                <label for="file-upload" class="custom-file-upload text-white" style="background-color: #003b59;">
                                                                    <span class="fa-solid fa-image "></span> Choose File
                                                                </label>
                                                                <input id="file-upload" type="file" name="image" />
                                                                <p id="file-name"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <?php
                                            if (!isset($_SESSION['family_confermation_message'])) {
                                            ?> <div class="row mt-2">
                                                    <div class="col-md-12">
                                                        <a href="/remove_family.php?id=<?php echo $get_id; ?>&username=<?php echo $username; ?>" class="prof-button-9 btn-danger text-white text-decoration-none"><i class="ti-close fw-bold" style="font-size: 13px;"></i>&nbsp Remove Family</a>
                                                        <button type="submit" name="submit" class=" prof-button text-white ">Update Family Member</button>
                                                    </div>
                                                </div>
                                            <?php
                                            } else {
                                            ?>

                                                <div class="">
                                                    <hr>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-12">
                                                        <a href="/family/<?php echo $username; ?>" class="btn btn-info text-white mt-3 ms-3" style="background-color:#0099cc;">Return To Family Tree</a>
                                                        <a href="/cancel_familyrequest.php/<?php echo  $_SESSION['hidden_field_id']; ?>" class="btn btn-danger text-white mt-3 ms-3" style="background-color:#d2322d;">Cancel Request</a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="d-flex flex-row"><span class="ti-check" style="margin-top: 13px!important;margin-right: 10px!important;"> </span>
                                                            <div class="mt-2"><?php echo $_SESSION['family_confermation_message']; ?></div>
                                                        </div>

                                                    </div>
                                                </div>
                                            <?php
                                                unset($_SESSION['family_confermation_message']);
                                            }
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                // disable inputfield js
                                $('#input-field').prop('disabled', true);

                                /////////
                                var getId = '<?php echo $selected_user_id; ?>';

                                // Check if the 'id' variable is set and not empty
                                if (getId !== '') {
                                    // Remove div elements based on the 'id'
                                    $('#hide-image').hide();
                                    $('#hide-gender').hide();
                                }
                                $('.my-divs').hide();
                                $(document).ready(function() {
                                    // Check the checkbox based on the $img variable
                                    <?php if ($img != '') { ?>
                                        $('#show-divs').prop('checked', true);
                                        $('.my-divs').show();
                                        $('.hide-email').hide();
                                    <?php } ?>
                                    // Show/hide divs based on the checkbox state
                                    $('#show-divs').click(function() {
                                        if ($(this).prop('checked')) {
                                            $('.my-divs').slideDown(1000);
                                            $('.hide-email').slideUp(1000);
                                        } else {
                                            $('.my-divs').slideUp(1000);
                                            $('.hide-email').slideDown(1000);
                                        }
                                    });
                                });
                                var searchTimer = null; // initialize a timer variable

                                $('#input-field').keyup(function() {
                                    var query = $(this).val();
                                    if (query === '') {
                                        $('#search-results').hide();
                                        return;
                                    }

                                    if (searchTimer) {
                                        clearTimeout(searchTimer); // clear the previous timer
                                    }
                                    searchTimer = setTimeout(function() { // set a new timer
                                        if (query.length >= 1) {
                                            $.ajax({
                                                url: '/ajax/search.php',
                                                type: 'POST',
                                                dataType: 'json',
                                                data: {
                                                    q: query
                                                },
                                                timeout: 5000, // set a timeout of 5 seconds
                                                beforeSend: function() {
                                                    // Show loading icon
                                                    $('#input-field').addClass('loading');
                                                },
                                                success: function(response) {
                                                    if (response) {

                                                        var output = response.output;
                                                        //var output1 = response.output1;
                                                        // var output2 = response.output2;
                                                        var output4 = response.output4;
                                                        console.log(response);

                                                        // Display the separate response strings on the page
                                                        if (output == '' && output4 == '') {
                                                            $('#search-results').html(output).hide();
                                                            $('#single-input').html(output4).hide();
                                                            //$('#error-message').show();

                                                        } else {
                                                            $('#search-results').html(output).show();
                                                            //$('#search-results').show()
                                                            $('#single-input').html(output4).show();
                                                            $('.hidden-input').show();
                                                            console.log(output);

                                                            $('.input-trigger').click(function(event) {
                                                                event.preventDefault();
                                                                var inputField = $($(this).data('input'));
                                                                $('.input-field').not(inputField).remove();
                                                                $('#search-results').remove();
                                                                $('#hide-image').remove();
                                                                $('#hide-name-input').show();
                                                                $('#single-input').hide();
                                                                $('.remo').remove();
                                                                inputField.toggle();
                                                            });
                                                        }

                                                    } else {
                                                        // If there are no results, hide any previous results and show an error messag
                                                        $('#search-results').show();

                                                    }
                                                },
                                                complete: function() {
                                                    // Hide loading icon
                                                    $('#input-field').removeClass('loading');
                                                },
                                            });
                                        }
                                    }, 30); // set a delay of 500 milliseconds before sending the request
                                });
                                // -------------------------------------------------------------------------//

                                // //for gender feilds all functionality

                                const maleRadio = document.querySelector('.male');

                                // Add an event listener to the male radio button to listen for changes
                                maleRadio.addEventListener('change', function() {
                                    // Get all options with class "male"
                                    const allOptions = document.querySelectorAll('.family option');

                                    // Loop through each option and show or hide it based on whether the radio button is checked or not
                                    allOptions.forEach(function(option) {
                                        if (option.classList.contains('male')) {
                                            if (maleRadio.checked) {
                                                option.style.display = 'block';
                                            } else {
                                                option.style.display = 'none';
                                            }
                                        } else {
                                            if (maleRadio.checked) {
                                                option.checked = false;
                                                option.style.display = 'none';
                                            } else {
                                                option.style.display = 'none';
                                            }
                                        }
                                    });
                                });


                                // Show options with class "male" and select the first option
                                if (maleRadio.checked) {
                                    const maleOptions = document.querySelectorAll('.male');
                                    let maleIndex = 0; // Initialize index for male options

                                    maleOptions.forEach(function(option, index) {
                                        option.style.display = 'block';
                                        if (option.classList.contains('male')) {
                                            if (maleIndex === 0) {
                                                option.selected = true;
                                            }
                                            maleIndex++;
                                        }
                                    });

                                    const otherOptions = document.querySelectorAll('.family option:not(.male)');
                                    otherOptions.forEach(function(option) {
                                        option.checked = false;
                                        option.style.display = 'none';
                                    });
                                }
                                const input = document.querySelector('input[type="file"]');
                                const fileName = document.getElementById('file-name');
                                const profileImage = document.querySelector('.profile-image');
                                const originalImageSrc = "<?php echo $img ?>";
                                const originalImageName = "<?php echo $imgname ?>";

                                // Set the initial file name and image source
                                fileName.textContent = originalImageName;
                                profileImage.src = "/assets/profile/" + originalImageSrc;

                                input.addEventListener('change', () => {
                                    const file = input.files[0];
                                    if (file) {
                                        fileName.textContent = file.name;
                                        profileImage.src = URL.createObjectURL(file); // Update the profile image preview
                                    } else {
                                        fileName.textContent = originalImageName; // Restore the original file name
                                        profileImage.src = "/assets/profile/" + originalImageSrc; // Restore the original image
                                    }
                                });

                                // Restore the same image name or file name on page load
                                window.addEventListener('DOMContentLoaded', () => {
                                    input.value = ''; // Clear the file input field
                                    fileName.textContent = originalImageName; // Restore the original file name
                                });


                                // Restore the same image name or file name on page load
                                window.addEventListener('DOMContentLoaded', () => {
                                    input.value = ''; // Clear the file input field
                                    fileName.textContent = originalImageSrc; // Restore the original file name
                                });

                                // Get the radio button with class "female"
                                const femaleRadio = document.querySelector('.female');

                                // Add an event listener to the female radio button to listen for changes
                                femaleRadio.addEventListener('change', function() {
                                    // Get all options with class "female"
                                    const allOptions = document.querySelectorAll('.family option');

                                    // Loop through each option and show or hide it based on whether the radio button is checked or not
                                    allOptions.forEach(function(option, index) {
                                        if (option.classList.contains('female')) {
                                            if (femaleRadio.checked) {
                                                option.style.display = 'block';
                                                if (index === 0) {
                                                    option.selected = true;
                                                }
                                            } else {
                                                option.style.display = 'none';
                                            }
                                        } else {
                                            option.style.display = 'none';
                                        }
                                    });
                                });

                                // Show options with class "female" and select the first option if the radio button is already checked
                                if (femaleRadio.checked) {
                                    const femaleOptions = document.querySelectorAll('.female');
                                    let femaleIndex = 0; // Initialize index for male options

                                    femaleOptions.forEach(function(option, index) {
                                        option.style.display = 'block';
                                        if (femaleIndex === 0) {
                                            option.selected = true;
                                        }
                                        femaleIndex++;
                                    });

                                    const otherOptions = document.querySelectorAll('.family option:not(.female)');
                                    otherOptions.forEach(function(option) {
                                        option.checked = false;
                                        option.style.display = 'none';
                                    });
                                }

                                // Get the radio button with class "other"
                                const otherRadio = document.querySelector('.other');

                                // Add an event listener to the other radio button to listen for changes
                                otherRadio.addEventListener('change', function() {
                                    // Get all options with class "other"
                                    const allOptions = document.querySelectorAll('.family option');

                                    // Loop through each option and show or hide it based on whether the radio button is checked or not
                                    allOptions.forEach(function(option, index) {
                                        if (option.classList.contains('other')) {
                                            if (otherRadio.checked) {
                                                option.style.display = 'block';
                                                if (index === 0) {
                                                    option.selected = true;
                                                }
                                            } else {
                                                option.style.display = 'none';
                                            }
                                        } else {
                                            option.style.display = 'none';
                                        }
                                    });
                                });


                                const genderLabel = document.querySelector('.gender-label');
                                const label2 = document.querySelector('.label-2');

                                // Add an event listener to all radio buttons to listen for changes
                                const allRadioButtons = document.querySelectorAll('input[type="radio"]');
                                allRadioButtons.forEach(function(radioButton) {
                                    radioButton.addEventListener('change', function() {
                                        // Get the value of the selected radio button
                                        const selectedGender = document.querySelector('input[name="gender"]:checked').value;

                                        // Update the labels based on the selected gender
                                        if (selectedGender === 'm') {
                                            genderLabel.innerHTML = '<strong>He</strong> is your:';
                                            label2.innerHTML = '<strong>You</strong> are <strong>his</strong>:';
                                        } else if (selectedGender === 'f') {
                                            genderLabel.innerHTML = '<strong>She</strong> is your:';
                                            label2.innerHTML = '<strong>You</strong> are <strong>her</strong>:';
                                        } else if (selectedGender === 'o') {
                                            genderLabel.innerHTML = '<strong>They</strong> are your:';
                                            label2.innerHTML = '<strong>You</strong> are <strong>theirs</strong>:';
                                        }
                                    });
                                });


                                const textBox = document.querySelector('.family');
                                const labelUp = document.querySelector('.textUp');
                                const selectBoxUp = document.querySelector('.textUpSelect');
                                const labelDown = document.querySelector('.textDown');
                                const selectBoxDown = document.querySelector('.textDownSelect');
                                const labelBoth = document.querySelector('.bothlabel');
                                const selectBoxBoth1 = document.querySelector('.bothselect');
                                const labelBoth2 = document.querySelector('.bothlabel2');
                                const selectBoxBoth2 = document.querySelector('.bothselect2');

                                // Hide all labels and select boxes initially
                                // labelUp.style.display = 'none';
                                // selectBoxUp.style.display = 'none';
                                // labelDown.style.display = 'none';
                                // selectBoxDown.style.display = 'none';
                                // labelBoth.style.display = 'none';
                                // selectBoxBoth1.style.display = 'none';
                                // labelBoth2.style.display = 'none';
                                // selectBoxBoth2.style.display = 'none';

                                // Add event listener to the select box to check for changes
                                textBox.addEventListener('change', function(event) {
                                    // Get the selected option's ID
                                    const selectedOptionId = this.options[this.selectedIndex].id;
                                    console.log(selectedOptionId);

                                    switch (selectedOptionId) {
                                        case 'newTextBoxUp':
                                            // Display the label and select box for textUp
                                            labelUp.style.display = 'inline-block';
                                            selectBoxUp.style.display = 'inline-block';
                                            labelDown.style.display = 'none';
                                            selectBoxDown.style.display = 'none';
                                            break;
                                        case 'newTextBoxDown':
                                            // Display the label and select box for textDown
                                            labelUp.style.display = 'none';
                                            selectBoxUp.style.display = 'none';
                                            labelDown.style.display = 'inline-block';
                                            selectBoxDown.style.display = 'inline-block';
                                            break;
                                        case 'newTextBoxBoth':
                                            // Display both labels and select boxes for both
                                            labelBoth.style.display = 'inline-block';
                                            selectBoxBoth1.style.display = 'inline-block';
                                            labelBoth2.style.display = 'inline-block';
                                            selectBoxBoth2.style.display = 'inline-block';
                                            break;
                                        default:
                                            // Hide all labels and select boxes
                                            labelUp.style.display = 'none';
                                            selectBoxUp.style.display = 'none';
                                            labelDown.style.display = 'none';
                                            selectBoxDown.style.display = 'none';
                                            labelBoth.style.display = 'none';
                                            selectBoxBoth1.style.display = 'none';
                                            labelBoth2.style.display = 'none';
                                            selectBoxBoth2.style.display = 'none';
                                            break;
                                    }
                                });



                                const familySelect = document.querySelector('.family');
                                const textNewInput = document.querySelector('.text-new');

                                familySelect.addEventListener('change', function() {
                                    switch (this.value) {
                                        case 'mother':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'daughter';
                                            break;
                                        case 'father':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'son';
                                            break;
                                        case 'brother':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'sister';
                                            break;
                                        case 'sister':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'sister';
                                            break;
                                        case 'grandmother':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'granddaughter';
                                            break;
                                        case 'grandfather':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'granddaughter';
                                            break;
                                        case 'cousin':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'cousin';
                                            break;
                                        case 'aunt':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'niece';
                                            break;
                                        case 'uncle':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'niece';
                                            break;
                                        case 'brother-in-law':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'sister-in-law';
                                            break;
                                        case 'daughter':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'mother';
                                            break;
                                        case 'daughter-in-law':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'mother-in-law';
                                            break;
                                        case 'ex-husband':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'ex-wife';
                                            break;
                                        case 'ex-wife':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'ex-wife';
                                            break;
                                        case 'father-in-law':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'daughter-in-law';
                                            break;
                                        case 'granddaughter':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'grandmother';
                                            break;
                                        case 'grandson':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'grandmother';
                                            break;
                                        case 'great aunt':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great niece';
                                            break;
                                        case 'great grand aunt':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great grand nephew';
                                            // check??

                                            break;
                                        case 'great grand nephew':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great grand aunt';
                                            break;
                                        case 'great grand niece':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great grand aunt';
                                            break;
                                        case 'great grand uncle':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great grand niece';
                                            break;
                                        case 'great nephew':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great aunt';
                                            break;
                                        case 'great niece':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great aunt';
                                            break;
                                        case 'great uncle':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great niece';
                                            break;
                                        case 'great-grand-daughter':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great-grand-mother';
                                            break;
                                        case 'great-grandfather':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great-grand-daughter';
                                            break;
                                        case 'great-grandmother':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great-grand-daughter';
                                            break;
                                        case 'great-grandson':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great-grandmother';
                                            break;
                                        case 'great-great-granddaughter':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great-great-grandmother';
                                            break;
                                        case 'great-great-grandfather':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great-great-granddaughter';
                                            break;
                                        case 'great-great-grandmother':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great-great-granddaughter';
                                            break;
                                        case 'great-great-grandson':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great-great-grandmother';
                                            break;
                                        case 'husband':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'wife';
                                            break;
                                        case 'mother-in-law':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'daughter-in-law';
                                            break;
                                        case 'nephew':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'aunt';
                                            break;
                                        case 'niece':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'aunt';
                                            break;
                                        case 'significant other':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'significant other';
                                            break;
                                        case 'sister-in-law':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'sister-in-law';
                                            break;
                                        case 'son':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'mother';
                                            break;
                                        case 'son-in-law':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'mother-in-law';
                                            break;
                                        case 'step-aunt':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-niece';
                                            break;
                                        case 'step-brother':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-sister';
                                            break;
                                        case 'step-cousin':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-cousin';
                                            break;
                                        case 'step-daughter':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-mother';
                                            break;
                                        case 'step-father':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-daughter';
                                            break;
                                        case 'step-granddaughter':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-grandmother';
                                            break;
                                        case 'step-grandfather':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-granddaughter';
                                            break;
                                        case 'step-grandmother':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-granddaughter';
                                            break;
                                        case 'step-grandson':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-grandmother';
                                            break;
                                        case 'step-great-granddaughter':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-great-grandmother';
                                            break;
                                        case 'step-great-grandfather':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-great-granddaughter';
                                            break;
                                        case 'step-great-grandmother':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-great-granddaughter';
                                            break;
                                        case 'step-great-grandson':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-great-grandmother';
                                            break;
                                        case 'step-great-great-granddaughter':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-great-great-grandmother';
                                            break;
                                        case 'step-great-great-grandfather':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-great-great-granddaughter';
                                            break;
                                        case 'step-great-great-grandmother':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-great-great-granddaughter';
                                            break;
                                        case 'step-great-great-grandson':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-great-great-grandmother';
                                            break;
                                        case 'step-mother':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-daughter';
                                            break;
                                        case 'step-nephew':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-aunt';
                                            break;
                                        case 'step-niece':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-aunt';
                                            break;
                                        case 'step-sister':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-sister';
                                            break;
                                        case 'step-son':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-mother';
                                            break;
                                        case 'step-uncle':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-niece';
                                            break;
                                        case 'wife':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'wife';
                                            break;
                                        case 'parent':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'daughter';
                                            break;
                                        case 'sibling':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'sister';
                                            break;
                                        case 'grandparent':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'granddaughter';
                                            break;
                                        case 'parent’s sibling':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'niece';
                                            break;
                                        case 'sibling-in-law':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'sister-in-law';
                                            break;
                                        case 'ex-spouse/partner':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'ex-wife';
                                            break;
                                        case 'parent-in-law':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'daughter-in-law';
                                            break;
                                        case 'grandchild':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'grandmother';
                                            break;
                                        case 'sibling’s great grandchild':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great grand aunt';
                                            break;
                                        case 'great-grandparent’s sibiling':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great grand niece';
                                            break;
                                        case 'sibling’s grandchild':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great aunt';
                                            break;
                                        case 'grandparent’s sibiling':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great niece';
                                            break;
                                        case 'great-grandparent':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great-grand-daughter';
                                            break;
                                        case 'great-grandchild':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great-grand-mother';
                                            break;
                                        case 'great-great-grandparent':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great-great-granddaughter';
                                            break;
                                        case 'great-great-grandchild':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'great-great-grandmother';
                                            break;
                                        case 'spouse/partner':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'wife';
                                            break;
                                        case 'siblings child':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'aunt';
                                            break;
                                        case 'significant other':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'significant other';
                                            break;
                                        case 'child':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'mother';
                                            break;
                                        case 'child-in-law':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'mother-in-law';
                                            break;
                                        case 'step-sibling':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-sister';
                                            break;
                                        case 'step-cousin':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-cousin';
                                            break;
                                        case 'step-parent':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-daughter';
                                            break;
                                        case 'step-grandparent':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-granddaughter';
                                            break;
                                        case 'step-grandchild':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-grandmother';
                                            break;
                                        case 'step-great-grandparent':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-great-granddaughter';
                                            break;
                                        case 'step-great-grandchild':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-great-grandmother';
                                            break;
                                        case 'step-great-great-grandparent':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-great-great-granddaughter';
                                            break;
                                        case 'step-great-great-grandchild':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-great-great-grandmother';
                                            break;
                                        case 'step-siblings child':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-aunt';
                                            break;
                                        case 'step-child':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-mother';
                                            break;
                                        case 'step-parents sibling':
                                            textNewInput.disabled = true;
                                            textNewInput.value = 'step-niece';
                                            break;
                                        default:
                                            textNewInput.disabled = true;
                                            textNewInput.value = '';
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
        var parent_s = <?php echo json_encode($parent_side); ?>;
        var myVariable = <?php echo json_encode($relationship); ?>;
        const input = document.getElementById('select_required');
        input.value = myVariable;
        var paragraphToShow = document.getElementById("parent-side-one");
        if (input.value === "grandmother") {
            hide.style.display = "block";
            paragraphToShow.style.display = "block";
        } else if (input.value === "grandfather") {
            hide.style.display = "block";
            paragraphToShow.style.display = "block";
        }
        const hide1 = document.getElementById("hide1");
        if (input.value === "father") {
            // alert('umar');
            hide1.style.display = "none";
            hide.style.display = "none";
        }
        if (input.value === "mother") {
            //alert('umar');
            hide1.style.display = "none";
            hide.style.display = "none";
        }
        input.addEventListener("change", function() {
            if (input.value === "cousin") {
                hide1.style.display = "block";
                hide.style.display = "block";
            } else if (input.value === "grandfather") {
                hide1.style.display = "none";
                hide.style.display = "block";
            } else if (input.value === "uncle") {
                hide.style.display = "block";
            } else if (input.value === "great grand uncle") {
                hide.style.display = "block";
            } else if (input.value === "great nephew") {
                hide1.style.display = "block";
            } else if (input.value === "great uncle") {
                hide.style.display = "block";
            } else if (input.value === "great-grandfather") {
                hide.style.display = "block";
            } else if (input.value === "great-grandson") {
                hide1.style.display = "block";
            } else if (input.value === "step-uncle") {
                hide.style.display = "block";
            } else if (input.value === "step-nephew") {
                hide1.style.display = "block";
            } else if (input.value === "grandmother") {
                hide.style.display = "block";
            } else if (input.value === "aunt") {
                hide.style.display = "block";
            } else if (input.value === "granddaughter") {
                hide1.style.display = "block";
            } else if (input.value === "great aunt") {
                hide.style.display = "block";
            } else if (input.value === "great grand aunt") {
                hide.style.display = "block";
            } else if (input.value === "great grand niece") {
                hide1.style.display = "block";
            } else if (input.value === "great niece") {
                hide1.style.display = "block";
            } else if (input.value === "great-grand-daughter") {
                hide.style.display = "block";
            } else if (input.value === "great-grandmother") {
                hide.style.display = "block";
            } else if (input.value === "niece") {
                hide1.style.display = "block";
            } else if (input.value === "step-aunt") {
                hide.style.display = "block";
            } else if (input.value === "step-cousin") {
                hide.style.display = "block";
                hide1.style.display = "block";
            } else if (input.value === "step-grandmother") {
                hide.style.display = "block";
            } else if (input.value === "step-great-granddaughter") {
                hide1.style.display = "block";
            } else if (input.value === "step-niece") {
                hide1.style.display = "block";
            } else {
                hide.style.display = "none";
                hide1.style.display = "none";
            }
        });



        $(".alert").delay(5000).slideUp(1000, function() {
            $(this).alert('close');
        });

        $(".custom_alert").delay(15000).slideUp(2000, function() {
            $(this).alert('close');
        });
    </script>
     <?php
    
	require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';

?>
</body>

</html>