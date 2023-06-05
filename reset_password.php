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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/themify-icons.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
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
                        <div class="row g-0">
                            <div class="col-xl-12" style="font-size: small !important">
                                <div class="card-body p-md-5 text-black">
                                    <h1 class="py-4 text-center">CREATE YOUR OWN PROFILE</h1>
                                    <h3 class="mb-2 text-uppercase text-center">ABOUT YOU</h3>
                                    <p class="py-3 text-center">
                                        Join Keeper to start preserving your own legacy, to become the Keeper <br />
                                        administrator of an existing memorial, and much more!
                                    </p>
                                    <div class="container">
                                            <hr class="py-3" />
                                        </div>
                                    <p class="py-3 text-center">
                                        We’ve sent an email to your email address. Click on the link provided in the email to update your password or select Log In if you don’t want to change your password at this time.
                                    </p>
                                    <div class="d-flex justify-content-end pt-3">
											<!-- <button type="button" class="reject-all-btn btn btn-light btn-lg">Reset all</button> -->
											<button class="submit-button btn btn-lg ms-2" ><a href="/login" class="text-white text-decoration-none">Login</a></button>
										</div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>