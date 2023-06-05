<?php

    session_start();
    session_regenerate_id();

    $user_login = false;
    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){

        require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
        $check = $connect->prepare("SELECT * FROM `users` WHERE `ID` = ?");
        $check->bind_param("s", $_SESSION['user_id']);
        $check->execute();
        $check_response = $check->get_result();
        if($check_response->num_rows > 0){

            $user_login = true;
            $user_fetch = $check_response->fetch_assoc();
            $user_id = $_SESSION['user_id'];
            
            $search_results = array();
            if(isset($_GET['query']) && !empty($_GET['query'])){

                $query = '%' . $_GET['query'] . "%";
                $search_result = $connect->prepare("SELECT * FROM `users` WHERE (`firstname` LIKE ?) OR (`middlename` LIKE ?) OR (`lastname` LIKE ?) OR (`username` LIKE ?) ORDER BY `ID` DESC");
                $search_result->bind_param("ssss", $query, $query, $query, $query);
                $search_result->execute();
                $search_result_response = $search_result->get_result();
                if($search_result_response->num_rows > 0){
                    
                    $search_results = array();
                    while($search_result_fetch = $search_result_response->fetch_assoc()){

                        array_push($search_results, $search_result_fetch);

                    }

                }
                
            } else {

                http_response_code(404);
                exit();

            }

        } else {

            unset($_SESSION['user_id']);

        }

    } else {

        header("Location: /login");
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php print( $_GET['query'] ) ?> - Tribute Keeper </title>
	<link rel="stylesheet" href="/assets/css/style.css"/>
    <link rel="stylesheet" href="/assets/js/script.js">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">

    <style>

        .table {
            width: 100%;
        }

        .serc-pad {
            margin-left: 150px;
            margin-top: 3px;
        }

        .align-right {
            text-align: right;
            justify-content: right;
            align-items: right;
            display: flex;
            width: 100%;
        }

        #select-style {
            display: inline-block;
            max-width: 150px;
        }

        .form-control {
            height: 34px;
            padding: 0px 12px;
            font-size: 14px;
            color: #555;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        }

        option {
            font-weight: normal;
            display: block;
            white-space: nowrap;
            min-height: 1.2em;
            padding: 0px 2px 1px;
        }

        .img {
            width: 60px;
        }

        .img-head {
            width: 100px;
            height: 100px;
            display: inline-block;
            vertical-align: top;
            margin: 10px;
        }

        .profile-image {
            width: 100px;
            height: 100px;
            border: 3px solid #eee;
            box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);
            border-radius: 50%;
            background-color: white;
        }

        .name-td a {
            font-weight: bold;
            color: #003B59;
            text-decoration: none;
            margin-top: 20px !important;
        }

        .pfooter {
            padding: 10px 15px;
        }

        .input-search {
            margin-bottom: 3px;
            background-color: #003B59;
            color: white;
        }

        .input-search:hover {
            margin-bottom: 3px;
            background-color: #003B59;
            color: white;
        }

        .mrle {
            margin-left: 20px;
        }

        @media (max-width: 992px) {
            .serc-pad {
                margin-left: 50px;
            }

            .input-search {
                margin-top: 30px;
            }

            .mrle {
                margin-left: 0px;
            }
        }

        @media (max-width: 768px) {
            .serc-pad {
                margin-left: 0px;
                margin-bottom: -10px;
            }
        }

        @media (max-width: 420px) {
            .hr-div {
                margin-left: -25px;
            }

        }

    </style>

</head>
<body>

    <section class="h-100 gradient-custom-2">

        <?php

            require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/subheader.php';

        ?>

        <div class="container py-5 h-100">
            <div class="card">
                <div class=" row pt-4 text-black">
                    <div class=" col-md-12 ">
                        <div class="p-4 edit-profile-border">
                            <div class="row ">
                                <div class="col-md-12 hr-div">
                                    <h3 class="pt-3"> Showing Results (<?php print( count($search_results) ) ?>) </h1>
                                </div>
                                <div class="hr-div">
                                    <hr>
                                </div>

                                <div class="hr-div">
                                    <div class=" row ">
                                        <div class="">
                                            <table class="table ">
                                                <div class="d-flex mt-3">
                                                    <div class="serc-pad">
                                                        <b class=" ">Name</b>
                                                    </div>
                                                    <div class="align-right">
                                                        <!-- <label class="p-1" for="">Sort By: </label>
                                                        <select name="" id="select-style" class="form-control">
                                                            <option value="date_of_death">Date Of Death</option>
                                                            <option value="firstname">First Name</option>
                                                            <option value="lastname">Last Name</option>
                                                            <option value="relevance" selected="selected">Relevance</option>
                                                        </select> -->
                                                    </div>
                                                </div>
                                                <tbody>

                                                    <?php 

                                                        if(count($search_results) > 0){

                                                            foreach($search_results as $item){

                                                                ?>

                                                                    <tr>
                                                                        <td class="img">

                                                                            <div class="img-head">

                                                                                <img src="/assets/profile/<?=  ( !empty($item['image']) && file_exists("{$_SERVER['DOCUMENT_ROOT']}/assets/profile/{$item['image']}"))? $item['image']: 'user.png'; ?>" class="profile-image">

                                                                            </div>

                                                                        </td>
                                                                        <td class="name-td" colspan="2">

                                                                            <div class="mt-5">

                                                                                <a href="/profile/<?php print( $item['username'] ) ?>" class="mt-4"> 
                                                                                    <?php print( $item['firstname'] . "" . $item['lastname'] ) ?> 
                                                                                </a>
                                                                                
                                                                            </div>

                                                                        </td>
                                                                    </tr>

                                                                <?php
                                                                
                                                            }

                                                        } else {

                                                            ?>

                                                                <tr>

                                                                    <h5 class="text-center my-5 py-5"> Sorry, no result found for <strong> "<?php print( $_GET['query'] ) ?>" </strong> </h5>

                                                                </tr>

                                                            <?php

                                                        }

                                                    ?>
                                                    
                                                </tbody>

                                            </table>
                                        </div>
                                        <div class="pfooter">
                                            
                                            <form role="/search" method="GET">
                                                <input required value='<?php isset( $_GET['query'] ) ? print( $_GET['query'] ) : null ?>' class="form-control" id="input-search" type="text" name="query" placeholder="Search" style="display: inline; max-width: 400px; height: 38px">
                                                <button class="btn input-search mrle" id="input-search" type="submit" > Search </button>
                                            </form>
                                            
                                        </div>
                                    </div>
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

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/popper.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/main.js"></script>

</body>
</html>