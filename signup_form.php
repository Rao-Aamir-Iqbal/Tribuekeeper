<?php

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

//$keeper_plus = $_GET['keeper_plus'];
if(isset($_GET['keeper_plus'])){
	$_SESSION['keeper_plus'] = $_GET['keeper_plus'];
}

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





		@media (max-width: 1198px) {

			.cont-wid {

				width: 100% !important;

				margin: 0 auto;

				display: block;

			}

		}

		.cont-wid {

			width: 48%;

			margin: 0 auto;

			display: block;

		}

		@media (max-width: 768px) {

			.sign-up-input-box {

				width: 100%;

			}

			.sign-up-second-input-box {

				width: 100%;

			}



		}

		@media (max-width: 442px) {

			.submit-button {

				font-size: small !important;

			}

			@media (max-width: 410px) {

				.submit-button {

					font-size: 10px !important;

				}

			}

			.error {

				color: red;

			}
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



	<section class="b-color">

		<div class=" pb-5 ">

			<div class=" row d-flex justify-content-center align-items-center cont-wid h-100">

				<div class="my-5 ">

					<div class="card card-registration my-4 card-background">

						<form id="signup-form" method="POST" action="/php/signup_personal.php">

							<div class="row g-0">

								<div class="col-xl-12" style="font-size: small !important">

									<div class="card-body p-md-5 text-black">

										<h1 class="py-4 text-center blue">CREATE YOUR OWN PROFILE</h1>

										<h3 class="mb-2 text-uppercase text-center">ABOUT YOU</h3>

										<p class="py-3 text-center">

											Join Keeper to start preserving your own legacy, to become the Keeper <br />

											administrator of an existing memorial, and much more!

										</p>

										<?php

										if (isset($_SESSION['signup_error_message'])) {

											session_start();

										?>

											<div class="alert alert-danger" role="alert">

												<?php

												echo $_SESSION['signup_error_message'];

												unset($_SESSION['signup_error_message']);

												?>

											</div>

										<?php

										}

										?>

										<div>

											<hr class="py-3" />

										</div>

										<div class="row">

											<div class="col-md-6 mb-4">

												<div class="form-outline">

													<input type="text" class="sign-up-input-box" id="firstname" name="firstname" id="form3Example1m" placeholder="First Name" class="form-control form-control-lg" />

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

											<div class="col-md-6 mb-4">

												<div class="form-outline">

													<input type="text" class="sign-up-input-box" id="lastname" name="lastname" placeholder="Last Name" class="form-control form-control-lg" />

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

										</div>

										<div class="row">

											<div class="col-md-6 mb-4">

												<div class="form-outline">

													<input type="text" class="sign-up-input-box" id="username" name="username" placeholder="Username" class="form-control form-control-lg" />

													<div class="text-danger">

														<?php

														if (isset($_SESSION['error_msg3'])) {

															echo $_SESSION['error_msg3'];

															unset($_SESSION['error_msg3']);
														}

														?>

													</div>

												</div>



											</div>

											<div class="col-md-6 mb-4">

												<div class="form-outline ">

													<input type="text" class="sign-up-input-box" id="email" name="email" placeholder="Email Address" class="form-control form-control-lg" />

													<div class="text-danger">

														<?php

														if (isset($_SESSION['error_msg4'])) {

															echo $_SESSION['error_msg4'];

															unset($_SESSION['error_msg4']);
														}

														?>

													</div>

												</div>

											</div>

										</div>

										<div class="row">

											<div class="col-md-6 mb-4">

												<div class="form-outline">

													<input type="password" class="sign-up-input-box" id="password" name="password" placeholder="Password" class="form-control form-control-lg" />

													<div class="text-danger">

														<?php

														if (isset($_SESSION['error_msg5'])) {

															echo $_SESSION['error_msg5'];

															unset($_SESSION['error_msg5']);
														}

														?>

													</div>

												</div>



											</div>

											<div class="col-md-6 mb-4">

												<div class="form-outline mb-4">

													<input type="password" class="sign-up-input-box" id="cpassword" name="cpassword" placeholder="Conform Password" class="form-control form-control-lg" />

													<div class="text-danger">

														<?php

														if (isset($_SESSION['error_msg6'])) {

															echo $_SESSION['error_msg6'];

															unset($_SESSION['error_msg6']);
														}

														?>

													</div>

												</div>

											</div>

										</div>



										<div class="row">

											<div class="col-md-12 mb-4">

												<div class="form-outline mb-4">
												<label for="" class="mb-2 fw-bold ms-1">Date of Birth</label>
													<input type="date" id="date" name="date" placeholder="dd/mm/yy" class="form-control form-control-lg sign-up-second-input-box" />

													<div class="text-danger">

														<?php

														if (isset($_SESSION['error_msg7'])) {

															echo $_SESSION['error_msg7'];

															unset($_SESSION['error_msg7']);
														}

														?>

													</div>

												</div>

											</div>

										</div>

										<div class="row">

											<div class="d-md-flex justify-content-start align-items-center py-2">

												<h6 class="mb-0 me-4 ms-2">Gender:</h6>

												<select class="sign-up-input-box" id="gender" name="gender">

													<option value="">Select Gender</option>

													<option value="male">Male</option>

													<option value="female">Female</option>

													<option value="other">Other</option>

												</select>
                                      
												<div class="text-danger">

													<?php

													if (isset($_SESSION['error_msg8'])) {

														echo $_SESSION['error_msg8'];

														unset($_SESSION['error_msg8']);
													}

													?>

												</div>

											</div>

										</div>

										<div class="d-flex justify-content-end pt-3">

											<!-- <button type="button" class="reject-all-btn btn btn-light btn-lg">Reset all</button> -->

											<div class="mt-2 fw-bold">Already Member?<a href="/login" class="ms-2 me-3  blue">Login here</a></div>

											<button type="submit" name="submit" class="submit-button btn btn-lg ">Sign Up</button>

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



	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">

	</script>

	<script>
		$(".alert").delay(5000).slideUp(1000, function() {

			$(this).alert('close');

		});

		$(document).ready(function() {
			$('#signup-form').validate({
				rules: {
					firstname: {
						required: true,
						minlength: 2
					},
					lastname: {
						required: true,
						minlength: 2
					},
					username: {
						required: true,
						minlength: 4,
						nowhitespace: true // Custom rule for no whitespace
					},
					email: {
						required: true,
						email: true
					},
					password: {
						required: true,
						minlength: 6
					},
					cpassword: {
						required: true,
						minlength: 6,
						equalTo: "#password"
					},
					date: {
						required: true
					},
					gender: {
						required: true
					}
				},
				messages: {
					firstname: {
						required: "Please enter your first name",
						minlength: "First name should be at least 2 characters long"
					},
					lastname: {
						required: "Please enter your last name",
						minlength: "Last name should be at least 2 characters long"
					},
					username: {
						required: "Please enter a username",
						minlength: "Username should be at least 4 characters long",
						nowhitespace: "Spaces are not allowed in the username"
					},
					email: {
						required: "Please enter an email address",
						email: "Please enter a valid email address"
					},
					password: {
						required: "Please enter a password",
						minlength: "Password should be at least 6 characters long"
					},
					cpassword: {
						required: "Please confirm your password",
						minlength: "Confirm password should be at least 6 characters long",
						equalTo: "Passwords do not match"
					},
					date: {
						required: "Please enter your date of birth"
					},
					gender: {
						required: "Please select your gender"
					}
				},
				submitHandler: function(form) {
					// submit the form data to the server using a regular form submission
					form.submit();
				}
			});

			// Custom rule for no whitespace
			$.validator.addMethod("nowhitespace", function(value, element) {
				return this.optional(element) || /^\S+$/i.test(value);
			}, "Spaces are not allowed in the username");
		});
	</script>
 <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';
    ?>
</body>



</html>