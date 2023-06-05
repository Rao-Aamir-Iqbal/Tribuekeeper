<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign up for personal</title>
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link rel="stylesheet" href="/assets/js/script.js" />
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
        .react {
            height: 100vh;
            display: flex;
            justify-content: center;
            text-align: center;
            align-items: center;

        }

        .container__react {
            width: 50%;
        }

        @media (max-width: 520px) {
            .container__react {
                font-size: small;
                width: 80%;
            }
        }
    </style>
</head>

<body>

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
    $secret_code_gen = $_GET['secret_code_gen'];
    ?>
    <section class="react b-color">
        <div class="container container__react">
            <div class="row ">
                <div class="col-md-12">
                    <div class="p-4 edit-profile-border card-registration">
                        <div class="row">
                            <h3 class="pt-3">Please confirm!</h3>
                            <div class="hr-div">
                                <hr>
                            </div>
                            <div class="hr-div" id="activate_data">
                                <p>You are only one step away from completing your Keeper account.</p>
                                <form id="activationForm">
                                    <input type="hidden" name="secret_code_gen" value="<?php echo $secret_code_gen; ?>">
                                    <button type="submit" id="confirm_activate" class="m-2 prof-button btn-new">Confirm
                                        Activation</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#activationForm').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    url: '/php/deactivate_account.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        console.log(response);
                        $('#activate_data').html(response);
                        // Handle successful response here
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                        // Handle error here
                    }
                });
            });
        });

    </script>
</body>

</html>