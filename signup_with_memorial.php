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

		} else {

			unset($_SESSION['user_id']);

		}

	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title> Create a Free Online Memorial -  Tribute Keeper </title>
	<link rel="stylesheet" href="/assets/css/style.css"/>
	<link rel="stylesheet" href="/assets/js/script.js"/>
	<link rel="stylesheet" href="/assets/css/footer.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"/>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/assets/css/themify-icons.css"/>
	<link rel="preconnect" href="https://fonts.googleapis.com"/>
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet"/>
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
			background-color: #0099cc;
		}
		
		.sign-up-second-input-box {
			border: none;
			border-radius: 10px;
			font-size: medium;
		}
		
		.signup-lov-text h1 {
			font-size: 29px;
			font-weight: 500;
		}
		
		.signup-lov-text h3 {
			font-size: 25px;
			font-weight: 700;
		}
		
		.form-label{
		    font-size: 16px;
		}

		.steps .step.active{
			background-color: #00759d !important;
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
				<div class="my-4 col-md-6">
					<div class="card card-registration my-4 card-background" style="background-color: #f8f9fa">
						<div class="row g-0">
							<div class="col-xl-12" style="font-size: small !important">

								<?php

									if($user_login == true){

										$is_reached_memorial = false;
										if($user_fetch['membership'] == 2){
	
											$check_memorial_profile = $connect->prepare("SELECT * FROM `keepers` WHERE `user_id` = ?");
											$check_memorial_profile->bind_param("s", $_SESSION['user_id']);
											$check_memorial_profile->execute();
											$check_memorial_profile_response = $check_memorial_profile->get_result();
											if($check_memorial_profile_response->num_rows == 3){
									
												$is_reached_memorial = true;
												
											}
	
										}

									}

									if($is_reached_memorial == true){

										?>

											<h5 class='text-center my-5 py-5 mb-4 pb-0'> You've reached the limit for memorial profiles with Keeper. Please upgrade to Keeper Plus for creating more memorial profiles </h5>
											<button class="prof-button m-auto mb-5 mt-2 d-block">
												<a href="/payment" style="text-decoration: none; color: white"> Upgrade to Keeper Plus </a>
											</button>

										<?php

									} else {

										?>

											<div class="card-body p-md-5 text-black signup-lov-text">
												<h1 class="pt-2 pb-4 text-center blue"> <strong> Create a Memorial </strong> for a Loved One</h1>
												<div class="row steps">
													<div class="col-md-3 p-1">
														<div class="py-4 step step-1 <?php !isset($_SESSION['is_next_step']) ? print( "active" ) : null ?>" style="cursor: pointer; display: flex; background-color: #0099cc; color: white; justify-content: center; text-align: center; align-items: center; padding: 20px">
															<p style="font-size: 20px; margin: 0 !important">Step-1</p>
														</div>
													</div>
													<div class="col-md-3 p-1">
														<div class="py-4 step step-2 <?php isset($_SESSION['is_next_step']) ? print( "active" ) : null ?>" style="cursor: pointer; display: flex; background-color: #0099cc; color: white; justify-content: center; text-align: center; align-items: center; padding: 20px">
															<p style="font-size: 20px; margin: 0 !important">Step-2</p>
														</div>
													</div>
													<div class="col-md-3 p-1">
														<div class="py-4 step step-3" style="cursor: pointer; display: flex; background-color: #0099cc; color: white; justify-content: center; text-align: center; align-items: center; padding: 20px">
															<p style="font-size: 20px; margin: 0 !important">Step-3</p>
														</div>
													</div>
													<div class="col-md-3 p-1">
														<div class="py-4 step step-4" style="cursor: pointer; display: flex; background-color: #0099cc; color: white; justify-content: center; text-align: center; align-items: center; padding: 20px">
															<p style="font-size: 20px; margin: 0 !important">Step-4</p>
														</div>
													</div>
												</div>

												<?php 

													if(!isset($_SESSION['is_next_step'])){

														?>

															<div class="step-1">

																<h3 class="mb-2 text-uppercase text-center py-3 mt-2"> ABOUT YOUR LOVED ONE </h3>
																<div class="container signup-hr">
																	<hr class="py-3"/>
																</div>

																<form action="/php/memorial-first-step.php" method="POST" id='form-step-1'>

																	<?php

																		if(isset($_SESSION['error']) && !empty($_SESSION['error'])){

																			?>

																				<div class="alert alert-danger" role="alert">
																					<?php print( $_SESSION['error'] ) ?>
																				</div>

																			<?php

																			unset($_SESSION['error']);

																		}

																	?>

																	<div class="row">

																		<div class="col-md-6">
																			<div class="mb-3">
																				<label for="firstname" class="form-label"> Firstname </label>
																				<input type="text" class="form-control" name='firstname' id="firstname">
																				<div class="invalid-feedback firstname-invalid-feedback"></div>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="mb-3">
																				<label for="middlename" class="form-label"> Middlename </label>
																				<input type="text" class="form-control" name='middlename' id="middlename">
																				<div class="invalid-feedback middlename-invalid-feedback"></div>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="mb-3">
																				<label for="lastname" class="form-label"> Lastname </label>
																				<input type="text" class="form-control" name='lastname' id="lastname">
																				<div class="invalid-feedback lastname-invalid-feedback"></div>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="mb-3">
																				<label for="gender" class="form-label"> Gender </label>
																				<select class="form-select" name='gender' id='gender'>
																					<option disabled> Choose... </option>
																					<option value="male"> Male </option>
																					<option value="female"> Female </option>
																					<option value="others"> Others </option>
																				</select>
																				<div class="invalid-feedback gender-invalid-feedback"></div>
																			</div>
																		</div>
																		<div class="col-md-12">
																			<div class="mb-3 mx-1">
																				<div class="form-check" style="display: flex; align-items: center; font-size: 16px">
																					<input class="form-check-input" type="checkbox" name='has_passed_away' id="has-passed-away" checked>
																					<label class="form-check-label" for="has-passed-away" style="margin: 0px 5px">
																						Has passed away?
																					</label>
																				</div>
																			</div>
																		</div>
																		<div class="col-md-6 d-none email-wrapper">
																			<div class="mb-3">
																				<label for="email" class="form-label"> Email Address </label>
																				<input type="email" class="form-control" name='email' id="email">
																				<div class="invalid-feedback email-invalid-feedback"></div>
																			</div>
																		</div>
																		<div class="col-md-12 birthdate-wrapper">
																			<div class="mb-3">
																				<label for="birthdate" class="form-label"> Date of Birth </label>
																				<input type="date" class="form-control" name='birthdate' id="birthdate">
																				<div class="invalid-feedback birthdate-invalid-feedback"></div>
																			</div>
																		</div>
																		<div class="col-md-12 deathdate-wrapper">
																			<div class="mb-3">
																				<label for="deathdate" class="form-label"> Date of Death </label>
																				<input type="date" class="form-control" name='deathdate' id="deathdate">
																				<div class="invalid-feedback deathdate-invalid-feedback"></div>
																			</div>
																		</div>
																		<div class="col-md-12">
																			<div class="mb-3">
																				<button type="button" class="btn btn-lg px-4 submit-step-1" style="background-color: #0099cc; color: white; border: none; font-size: medium; float: right"> Finish </button>
																			</div>
																		</div>
																	</div>

																</form>

															</div>

														<?php

													}

													if(isset($_SESSION['is_next_step'])){

														?>

															<div class="step-1">

																<h3 class="mb-2 text-uppercase text-center py-3 mt-2"> ABOUT YOUR YOURSELF </h3>
																<div class="container signup-hr">
																	<hr class="py-3">
																</div>

																<form action="/php/memorial-second-step.php" method="POST" id='form-step-2'>

																	<?php

																		if(isset($_SESSION['error']) && !empty($_SESSION['error'])){

																			?>

																				<div class="alert alert-danger" role="alert">
																					<?php print( $_SESSION['error'] ) ?>
																				</div>

																			<?php

																			unset($_SESSION['error']);

																		}

																	?>

																	<div class="row">

																		<div class="col-md-6">
																			<div class="mb-3">
																				<label for="firstname" class="form-label"> Firstname </label>
																				<input type="text" class="form-control" name='firstname' id="firstname">
																				<div class="invalid-feedback firstname-invalid-feedback"></div>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="mb-3">
																				<label for="middlename" class="form-label"> Middlename </label>
																				<input type="text" class="form-control" name='middlename' id="middlename">
																				<div class="invalid-feedback middlename-invalid-feedback"></div>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="mb-3">
																				<label for="lastname" class="form-label"> Lastname </label>
																				<input type="text" class="form-control" name='lastname' id="lastname">
																				<div class="invalid-feedback lastname-invalid-feedback"></div>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="mb-3">
																				<label for="username" class="form-label"> Username </label>
																				<input type="text" class="form-control" name='username' id="username">
																				<div class="invalid-feedback username-invalid-feedback"></div>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="mb-3">
																				<label for="gender" class="form-label"> Gender </label>
																				<select class="form-select" name='gender' id='gender'>
																					<option disabled> Choose... </option>
																					<option value="male"> Male </option>
																					<option value="female"> Female </option>
																					<option value="others"> Others </option>
																				</select>
																				<div class="invalid-feedback gender-invalid-feedback"></div>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="mb-3">
																				<label for="birthdate" class="form-label"> Date of Birth </label>
																				<input type="date" class="form-control" name='birthdate' id="birthdate">
																				<div class="invalid-feedback birthdate-invalid-feedback"></div>
																			</div>
																		</div>
																		<div class="col-md-12">
																			<div class="mb-3">
																				<label for="email" class="form-label"> Email Address </label>
																				<input type="email" class="form-control" name='email' id="email">
																				<div class="invalid-feedback email-invalid-feedback"></div>
																			</div>
																		</div>
																		<div class="col-md-12">
																			<div class="mb-3">
																				<label for="password" class="form-label"> Password </label>
																				<input type="password" class="form-control" name='password' id="password">
																				<div class="invalid-feedback password-invalid-feedback"></div>
																			</div>
																		</div>
																		<div class="col-md-12">
																			<div class="mb-3">
																				<label for="confirm-password" class="form-label"> Confirm Password </label>
																				<input type="password" class="form-control" name='confirm_password' id="confirm-password">
																				<div class="invalid-feedback confirm-password-invalid-feedback"></div>
																			</div>
																		</div>
																		<div class="col-md-12">
																			<div class="mb-3">
																				<button type="button" class="btn btn-lg px-4 submit-step-2" style="background-color: #0099cc; color: white; border: none; font-size: medium; float: right"> Finish </button>
																			</div>
																		</div>
																	</div>

																</form>

															</div>

														<?php

													}

												?>
												
											</div>

										<?php

									}

								?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script>

		<?php 

			if(!isset($_SESSION['is_next_step'])){

				?>

					document.querySelector('.submit-step-1').onclick = function(){

						let errors = false;
						let firstname = document.querySelector('#firstname');
						let middlename = document.querySelector('#middlename');
						let lastname = document.querySelector('#lastname');
						let gender = document.querySelector('#gender');
						let birthdate = document.querySelector('#birthdate');
						let deathdate = document.querySelector('#deathdate');
						let email = document.querySelector('#email');

						if(firstname.value == ""){

							errors = true;
							firstname.classList.add('is-invalid');
							document.querySelector('.firstname-invalid-feedback').innerHTML = "Please enter the firstname!";

						} else {

							firstname.classList.remove('is-invalid');
							document.querySelector('.firstname-invalid-feedback').innerHTML = "";

						}

						// if(middlename.value == ""){

						// 	errors = true;
						// 	middlename.classList.add('is-invalid');
						// 	document.querySelector('.middlename-invalid-feedback').innerHTML = "Please enter the middlename!";

						// } else {

						// 	middlename.classList.remove('is-invalid');
						// 	document.querySelector('.middlename-invalid-feedback').innerHTML = "";

						// }

						if(lastname.value == ""){

							errors = true;
							lastname.classList.add('is-invalid');
							document.querySelector('.lastname-invalid-feedback').innerHTML = "Please enter the lastname!";

						} else {

							lastname.classList.remove('is-invalid');
							document.querySelector('.lastname-invalid-feedback').innerHTML = "";

						}

						if(gender.value == ""){

							errors = true;
							gender.classList.add('is-invalid');
							document.querySelector('.gender-invalid-feedback').innerHTML = "Please enter the gender!";

						} else {

							gender.classList.remove('is-invalid');
							document.querySelector('.gender-invalid-feedback').innerHTML = "";

						}

						if(birthdate.value == ""){

							errors = true;
							birthdate.classList.add('is-invalid');
							document.querySelector('.birthdate-invalid-feedback').innerHTML = "Please enter the birthdate!";

						} else {

							birthdate.classList.remove('is-invalid');
							document.querySelector('.birthdate-invalid-feedback').innerHTML = "";

						}
						
						if(document.querySelector('#has-passed-away').checked == true){

							if(deathdate.value == ""){

								errors = true;
								deathdate.classList.add('is-invalid');
								document.querySelector('.deathdate-invalid-feedback').innerHTML = "Please enter the deathdate!";

							} else {

								deathdate.classList.remove('is-invalid');
								document.querySelector('.deathdate-invalid-feedback').innerHTML = "";

							}
							
						} else {
							
							if(email.value == ""){

								errors = true;
								email.classList.add('is-invalid');
								document.querySelector('.email-invalid-feedback').innerHTML = "Please enter the email!";

							} else {

								email.classList.remove('is-invalid');
								document.querySelector('.email-invalid-feedback').innerHTML = "";

							}

						}

						if(errors == false){

							document.querySelector("#form-step-1").submit();

						}
						
					}

					document.querySelector('#has-passed-away').onchange = function(event){

						if(event.target.checked == true){

							document.querySelector('.deathdate-wrapper').classList.remove('d-none');
							document.querySelector('.birthdate-wrapper').classList.add('col-md-12');
							document.querySelector('.birthdate-wrapper').classList.remove('col-md-6');
							document.querySelector('.email-wrapper').classList.add('d-none');

						} else if(event.target.checked == false){

							document.querySelector('.deathdate-wrapper').classList.add('d-none');
							document.querySelector('.birthdate-wrapper').classList.remove('col-md-12');
							document.querySelector('.birthdate-wrapper').classList.add('col-md-6');
							document.querySelector('.email-wrapper').classList.remove('d-none');

						}

					}

				<?php

			}

			if(isset($_SESSION['is_next_step'])){

				?>

					document.querySelector('.submit-step-2').onclick = function(){

						let errors = false;
						let firstname = document.querySelector('#firstname');
						let middlename = document.querySelector('#middlename');
						let lastname = document.querySelector('#lastname');
						let username = document.querySelector('#username');
						let gender = document.querySelector('#gender');
						let birthdate = document.querySelector('#birthdate');
						let deathdate = document.querySelector('#deathdate');
						let email = document.querySelector('#email');
						let password = document.querySelector('#password');
						let confirmPassword = document.querySelector('#confirm-password');

						if(firstname.value == ""){

							errors = true;
							firstname.classList.add('is-invalid');
							document.querySelector('.firstname-invalid-feedback').innerHTML = "Please enter the firstname!";

						} else {
							
							firstname.classList.remove('is-invalid');
							document.querySelector('.firstname-invalid-feedback').innerHTML = "";

						}

						// if(middlename.value == ""){

						// 	errors = true;
						// 	middlename.classList.add('is-invalid');
						// 	document.querySelector('.middlename-invalid-feedback').innerHTML = "Please enter the middlename!";

						// } else {
							
						// 	middlename.classList.remove('is-invalid');
						// 	document.querySelector('.middlename-invalid-feedback').innerHTML = "";

						// }

						if(lastname.value == ""){

							errors = true;
							lastname.classList.add('is-invalid');
							document.querySelector('.lastname-invalid-feedback').innerHTML = "Please enter the lastname!";

						} else {
							
							lastname.classList.remove('is-invalid');
							document.querySelector('.lastname-invalid-feedback').innerHTML = "";

						}

						if(username.value == ""){

							errors = true;
							username.classList.add('is-invalid');
							document.querySelector('.username-invalid-feedback').innerHTML = "Please enter the username!";

						} else {
							
							username.classList.remove('is-invalid');
							document.querySelector('.username-invalid-feedback').innerHTML = "";

						}

						if(gender.value == ""){

							errors = true;
							gender.classList.add('is-invalid');
							document.querySelector('.gender-invalid-feedback').innerHTML = "Please enter the gender!";

						} else {
							
							gender.classList.remove('is-invalid');
							document.querySelector('.gender-invalid-feedback').innerHTML = "";

						}

						if(birthdate.value == ""){

							errors = true;
							birthdate.classList.add('is-invalid');
							document.querySelector('.birthdate-invalid-feedback').innerHTML = "Please enter the birthdate!";

						} else {
							
							birthdate.classList.remove('is-invalid');
							document.querySelector('.birthdate-invalid-feedback').innerHTML = "";

						}
						
						if(email.value == ""){

							errors = true;
							email.classList.add('is-invalid');
							document.querySelector('.email-invalid-feedback').innerHTML = "Please enter the email!";

						} else {
							
							email.classList.remove('is-invalid');
							document.querySelector('.email-invalid-feedback').innerHTML = "";

						}
						
						if(password.value == ""){
							
							errors = true;
							password.classList.add('is-invalid');
							document.querySelector('.password-invalid-feedback').innerHTML = "Please enter the password!";

						} else {
							
							password.classList.remove('is-invalid');
							document.querySelector('.password-invalid-feedback').innerHTML = "";

						}
						
						if(confirmPassword.value == ""){

							errors = true;
							confirmPassword.classList.add('is-invalid');
							document.querySelector('.confirm-password-invalid-feedback').innerHTML = "Please enter the confirm password!";

						} else {
							
							confirmPassword.classList.remove('is-invalid');
							document.querySelector('.confirm-password-invalid-feedback').innerHTML = "";

						}

						if(password.value != "" && confirmPassword.value != ""){

							if(password.value == confirmPassword.value){

								password.classList.remove('is-invalid');
								document.querySelector('.password-invalid-feedback').innerHTML = "";

								confirmPassword.classList.remove('is-invalid');
								document.querySelector('.confirm-password-invalid-feedback').innerHTML = "";

							} else {

								errors = true;
								
								password.classList.add('is-invalid');
								document.querySelector('.password-invalid-feedback').innerHTML = "Password isn't matched! Please try again...";
								
								confirmPassword.classList.add('is-invalid');
								document.querySelector('.confirm-password-invalid-feedback').innerHTML = "Password isn't matched! Please try again...";

							}

						}

						if(errors == false){

							document.querySelector("#form-step-2").submit();

						}
						
					}

				<?php

			}

		?>

	</script>
 <?php
    
	require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';

?>
</body>
</html>
