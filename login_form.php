<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign up for personal</title>
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link rel="stylesheet" href="/assets/js/script.js" />
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/themify-icons.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <style>
        .card-background {
            background-color: #f8f9fa;
            border: none;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .reject-all-btn {
            border: none;
            border-radius: 10px;
            font-size: medium;
        }

        .submit-button {
            border: none;
            border-radius: 10px;
            font-size: medium;
            background-color: #003B59;
            color: white;
        }

        .submit-button:hover {
            border: none;
            border-radius: 10px;
            font-size: medium;
            background-color: #003B59;
            color: white;
        }

        .sign-up-second-input-box {
            border: none;
            border-radius: 10px;
            font-size: medium;
        }

        .error {
            color: red;
        }

        .custom_alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
            font-size: 0.8rem;
        }

        .custom_alert.alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>

<body>

    <?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';

    ?>

    <section class="h-100 b-color">
        <div class="container pb-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="my-5 col-md-6">
                    <div class="card card-registration my-4 card-background">
                        <form id="login-form" method="POST" action="/php/login_personal.php">
                            <div class="row g-0">
                                <div class="col-xl-12" style="font-size: small !important">
                                    <div class="card-body p-md-5 text-black">
                                        <h1 class="py-4 text-center">CREATE YOUR OWN PROFILE</h1>
                                        <h3 class="mb-2 text-uppercase text-center">ABOUT YOU</h3>
                                        <p class="py-3 text-center">
                                            Join Keeper to start preserving your own legacy, to become the Keeper <br />
                                            administrator of an existing memorial, and much more!
                                        </p>
                                        <?php
                                        if (isset($_SESSION['login_error_message'])) {
                                            session_start();
                                            ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php
                                                echo $_SESSION['login_error_message'];
                                                unset($_SESSION['login_error_message']);
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        if (isset($_SESSION['password_reset_message'])) {
                                            session_start();
                                            ?>
                                            <div class="alert alert-secondary" role="alert">
                                                <?php
                                                echo $_SESSION['password_reset_message'];
                                                unset($_SESSION['password_reset_message']);
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if (isset($_SESSION['reactivation'])) {
                                            session_start();
                                            ?>
                                            <div class="custom_alert alert-danger" role="alert">
                                                <?php
                                                echo $_SESSION['reactivation'];
                                                unset($_SESSION['reactivation']);
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="container">
                                            <hr class="py-3" />
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-outline mb-4">
                                                    <input type="text" id="email" name="email"
                                                        placeholder="Email Address"
                                                        class="form-control form-control-lg sign-up-second-input-box" />
                                                    <div class="text-danger">
                                                        <?php
                                                        if (isset($_SESSION['error_msg1'])) {
                                                            echo $_SESSION['error_msg1'];
                                                            unset($_SESSION['error_msg1']);
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-4">
                                                <div class="form-outline mb-4">
                                                    <input type="password" id="password" name="password"
                                                        placeholder="Password"
                                                        class="form-control form-control-lg sign-up-second-input-box" />
                                                    <div class="text-danger">
                                                        <?php
                                                        if (isset($_SESSION['error_msg2'])) {
                                                            echo $_SESSION['error_msg2'];
                                                            unset($_SESSION['error_msg2']);
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 ms-2">
                                                    <label class="checkbox">
                                                        <input id="remember-me" type="checkbox" name="remember_me"
                                                            value="1">
                                                        Remember me </label>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-4 m-3">
                                                    <a href="/forget" class="fw-bold text-decoration-none">Forget
                                                        Password</a>
                                                </div>
                                        </div>
                                        <div class="d-flex justify-content-end pt-3">

                                            <!-- <button type="button" class="reject-all-btn btn btn-light btn-lg">Reset all</button> -->
                                            <div class="mt-2 fw-bold">Not A Member?<a href="/signup/profile"
                                                    class="ms-2 me-3 text-decoration-none">Signup Here</a></div>
                                            <button type="submit" name="submit"
                                                class="submit-button btn btn-lg ms-2">Login</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
    <script>
        $(".alert").delay(5000).slideUp(1000, function () {
            $(this).alert('close');
        });

        $(".custom_alert").delay(15000).slideUp(2000, function () {
            $(this).alert('close');
        });

        $(document).ready(function () {
            $('#login-form').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    email: {
                        required: "Please enter an email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter a password",
                        minlength: "Password should be at least 6 characters long"
                    },
                },
                submitHandler: function (form) {
                    // submit the form data to the server using a regular form submission
                    form.submit();
                }
            });
        });
    </script>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';
    ?>
</body>

</html>