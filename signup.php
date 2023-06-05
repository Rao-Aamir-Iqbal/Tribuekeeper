<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title> Signup - Tribute Keeper </title>
	<link rel="stylesheet" href="assets/css/style.css" />
	<link rel="stylesheet" href="assets/js/script.js" />
	<link rel="stylesheet" href="/assets/css/footer.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/assets/css/themify-icons.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
	<style>
		
		.header-section {
			justify-content: center;
			text-align: center;
			align-items: center;
			width: 100%;
		}

		.header-section h1 {
			font-size: 45px;
			font-weight: 700px;
			color: #003B59;
			padding-bottom: 60px;
		}

		.main-signup {
			display: flex;
			justify-content: center;
			text-align: center;
			align-items: center;
			width: 100%;

		}

		.main-signup-border {
			border-radius: 20px;
			background-color: white;
			width: 25%;


		}

		.main-signup h2 {
			font-size: 22px;
			font-weight: 900;
		}

		.main-signup p {
			font-size: 14px;
			font-weight: 400;

		}

		.main-signup button {
			font-weight: 700;
			font-size: small;
			background-color: #003B59;
			border-radius: 10px;
		}

		.main-signup a {
			color: white;
			text-decoration: none;
		}

		@media (max-width: 1047px) {
			.main-signup-border {
				width: 30%;
			}
		}

		@media (max-width: 871px) {
			.main-signup-border {
				width: 50%;
			}
		}

		@media (max-width: 587px) {
			.main-signup {
				display: flex;
				flex-direction: column;
			}

			.main-signup-border {
				width: 90%;
			}

		}

	</style>

</head>
<body>

	<?php

		require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';

	?>

	<section class="b-color">
		<div class="container pt-5">
			<div class="row">
				<div class="col-md-12 py-3 header-section">
					<h1>I WANT TO</h1>
				</div>
			</div>
		</div>
		<div class="text-center d-flex main-signup">
			<div class="m-3 p-3 mb-5 mrg-rit-lef main-signup-border">
				<div class="logo-1">
					<div class="log0-1-1">
						<i class="ti-heart" style="font-size:50px;"></i>
					</div>
				</div>
				<h2 class="pt-4">Create a Memorial</h2>
				<p class="py-1 px-4">
					To connect to an existing Keeper Memorial
					page or to Write out my own Legacy
				</p>

				<button>
					<a href="/signup/memorial">Get Started</a>
				</button>
				
			</div>
			<div class="m-3 p-3 mb-5 mrg-rit-lef main-signup-border">
				<div class="logo-1">
					<div class="log0-1-1">
						<i class="ti-user" style="font-size:50px;"></i>
					</div>
				</div>
				<h2 class="pt-4">Create My Own Profile</h2>
				<p class="py-1 px-4">
					To connect to an existing Keeper Memorial
					page or to Write out my own Legacy
				</p>
				<button><a href="/signup/profile">Get Started</a></button>
			</div>
		</div>
	</section>
	<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';
    ?>
</body>

</html>