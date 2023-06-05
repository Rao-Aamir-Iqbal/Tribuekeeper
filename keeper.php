<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

if (!$_SESSION['user_id']) {
	header("location: /login");
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM `users` WHERE ID = '" . $_SESSION['user_id'] . "'";
$exe = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($exe);

$firstname = $fetch['firstname'];
$username = $fetch['username'];
$middlename = $fetch['middlename'];
$lastname = $fetch['lastname'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title> Keeper - Tribute Keeper </title>
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
	<style>
		.btn-new {
			width: 25% !important;
		}

		.gradient {
			background: #428bca;
			background: linear-gradient(195deg, #5b1346 -24.65%, #46c0e1 97.7%);
		}

		/* Define the CSS for the hidden part of the form */
		.hidden-div {
			opacity: 0;
			visibility: hidden;
			height: 0;
			overflow: hidden;
			transition: opacity 5s ease-out, visibility 5s ease-out, height 5s ease-out;
		}

		/* Define the CSS for the visible part of the form */
		.visible-div {
			opacity: 1;
			visibility: visible;
			height: auto;
			overflow: auto;
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

						<div class="row pt-4 text-black">
							<div class="col-md-12">
								<div class="p-4 edit-profile-border">
									<div class="row">
										<div class="col-md-12 hr-div">
											<h3 class="pt-3">Keeper of:</h3>
											<p>The profiles that <strong><?php echo $firstname . ' ' . $lastname; ?></strong> manages.</p>
											<!-- <p><b><?php echo $firstname . ' ' . $lastname ?></b> No Keeper of.</p> -->
										</div>
										<div class="hr-div">
											<hr />
										</div>

										<div class="hr">
											<div class="justify-content-center  d-flex flex-row">

												<?php
												$userid = $_SESSION['user_id'];
												$sqli = "SELECT * FROM keepers WHERE user_id = '" . $_SESSION['user_id'] . "'";
												//echo "SELECT * FROM keepers WHERE user_id = '".$_SESSION['user_id']."'";

												//die();

												$result3 = mysqli_query($con, $sqli);
												if (mysqli_num_rows($result3) > 0) {
													// Extract the related product IDs from the result set
												?>
													<div class="row">
														<?php
														while ($row3 = mysqli_fetch_assoc($result3)) {
															$keeper_id = $row3['kepper_ids'];

															//$keeper_ids = explode(',', $related_keepers);
															$sql23 = "SELECT * FROM users WHERE ID = $keeper_id";
															//echo "SELECT * FROM users WHERE ID = $keeper_id";
															$result4 = mysqli_query($con, $sql23);

															while ($row4 = mysqli_fetch_assoc($result4)) {
																$username4 = $row4['username'];
																$firstname4 = $row4['firstname'];
																$image4 = $row4['image'];
																$keeper_id = $row4['ID'];
																//$_SESSION['keeper_id'] = $row4['ID'];
														?>
																<div class="col-md-3 col-sm-6" style=" display: flex; flex-direction:column; justify-content: center; text-align: center; align-items: center;">
																	<div class="px-5">
																		<?php if ($image4 != '') {
																		?>
																			<a href="/keeper_session/<?php echo $keeper_id . '/' . $username4; ?>">
																				<img src="/assets/profile/<?php echo $image4; ?>" class="keper-of" style=" border-radius:50%; height: 100px; width:100px; border:5px solid #eee;
                                                                         box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);" aria-label="Placeholder: 100x100" alt="..."></a>
																		<?php
																		} else {
																		?>
																			<a href="/keeper_session/<?php echo $keeper_id; ?>">
																				<img src="/assets/profile/user.png" class="keper-of" style=" border-radius:50%; height: 100px; width:100px; border:5px solid #eee;
    														            box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);" aria-label="Placeholder: 100x100" alt="..."></a>
																		<?php
																		}
																		?>
																	</div>
																	<div>
																		<p class="fw-bold mt-1"><a href="/keeper_session/<?php echo $keeper_id . '/' . $username4; ?>" class="text-decoration-none"><?php echo $firstname4; ?></a></p>
																	</div>
																</div>
														<?php
															}
														}
														?>
													</div>
												<?php
												} else {
													echo '<div class="col-md-3 ">
															
															<p>No Keeper of</p>
														  </div>';
												}
												?>

											</div>
											<a href="/signup/memorial" class='prof-button ms-2' style="text-decoration: none; color: white"> Create a Memorial Profile </a>
										</div>


									</div>
								</div>
							</div>
						</div>
						<?php
						$fetaql = mysqli_query($con, "SELECT * FROM `keepers` WHERE `kepper_ids` = '$user_id'");
						$count = mysqli_num_rows($fetaql);
						if ($count == 1) {
							//$fetch_admn = mysqli_fetch_assoc($fetaql);
						?>
							<div class="row pt-4 text-black">
								<div class="col-md-12">
									<div class="p-4 edit-profile-border">
										<div class="row">
											<div class="col-md-12 hr-div">
												<h3 class="pt-3">Your Keepers:</h3>
												<p>Your Keeper can publish and manage your profile once you have passed.</p>
											</div>
											<?php
											if (isset($_SESSION['administrator_confermation_message'])) {
												session_start();
											?>
												<div class="alert alert-success" role="alert" style="width: fit-content;margin-left: 25px;">
													<?php
													echo $_SESSION['administrator_confermation_message'];
													unset($_SESSION['administrator_confermation_message']);
													?>
												</div>
											<?php
											}
											?>
											<div class="hr-div">
												<hr />
											</div>
											<div class="hr-div">
												<div class="justify-content-center  d-flex flex-row">

													<?php


													//echo "SELECT * FROM `keepers` WHERE `kepper_ids` =  '".$_SESSION['user_id']."'";
													//die();

													// $result1 = mysqli_query($con, $sql1);
													// if (mysqli_num_rows($result1) > 0) {
													?>
													<div class="row">
														<?php
														$row1 = mysqli_fetch_assoc($fetaql);
														$user_idd = $row1['user_id'];
														// $update = mysqli_query($con, "UPDATE `users` SET `membership` = '1' WHERE `ID` = '$user_idd'");
														//$keeper_ids = explode(',', $related_keepers);
														$sql34 = "SELECT * FROM users WHERE `ID` = '" . $user_idd . "'";
														//	echo "SELECT * FROM users WHERE ID = '".$user_idd."'";
														//die();
														$result2 = mysqli_query($con, $sql34);
														if (mysqli_num_rows($result2) > 0) {
															$row2 = mysqli_fetch_assoc($result2);
															$username2 = $row2['username'];
															$firstname2 = $row2['firstname'];
															$image2 = $row2['image'];
															$keeper_id2 = $row2['ID'];
															echo $membership1 = $row2['membership'];
														?>

															<div class="col-md-3 col-sm-6" style=" display: flex; flex-direction:column; justify-content: center; text-align: center; align-items: center;">
																<div class="">
																	<?php if ($image2 != '') {
																	?>

																		<a href="/keeper_session/<?php echo $keeper_id2 . '/' . $username2; ?>">
																			<img src="/assets/profile/<?php echo $image2; ?>" class="keper-of" style=" border-radius:50%; height: 100px; width:100px; border:5px solid #eee;
        																		 box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);" aria-label="Placeholder: 100x100" alt="..."></a>

																	<?php
																	} else {
																	?>
																		<a href="/keeper_session/<?php echo $keeper_id2 . '/' . $username2; ?>">
																			<img src="/assets/profile/user.png" class="keper-of" style=" border-radius:50%; height: 100px; width:100px; border:5px solid #eee;
    															 box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);" aria-label="Placeholder: 100x100" alt="..."></a>
																	<?php
																	}
																	?>
																</div>
																<div>
																	<p class="fw-bold mt-1"><a href="/keeper_session/<?php echo $keeper_id2 . '/' . $username2; ?>" class="text-decoration-none"><?php echo $firstname2; ?></a></p>
																</div>
															</div>

														<?php
														} else {
															echo '<div class="col-md-12" >
																			
																			<p>No Your Keeper</p>
																		</div>';
														}
														// Extract the related product IDs from the result set

														?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
							$check_membership12 = mysqli_query($con, "SELECT * FROM users WHERE `ID` = '$user_id'");
							$fetch_membership12 = mysqli_fetch_assoc($check_membership12);
							$membership12 = $fetch_membership12['membership'];
							if ($membership12 == 2) {
							?>
								<div class="col-md-12 hr-div">
									<h3 class="pt-3">Invite Keeper Administrators</h3>
									<p>Invite unlimited administrators to help you manage every memorial page you have.</p>
									<p><b>First time,</b> You can only submit one request for free.</p>
								</div>
								<div class="hr-div">
									<hr />
								</div>
								<form id="myForm" method="POST" action="/php/add-administrator.php">
									<div class="row ">

										<div class="col-md-6 p-3">
											<div class="row">
												<div class="mb-4" id="hide-name-input">
													<div class="form-outline self_hide ms-2">
														<label for="input-field" class="mb-2">Name</label>
														<input type="hidden" value="" id="id-hidd">
														<input type="text" id="input-field" placeholder="" class="form-control" autocomplete="off" style="border-radius: 3px; font-size: medium;" />
														<div id="error-message" style="color: red;"></div>
														<div id="search-results"></div>
													</div>
												</div>
												<div class="" id="single-input">
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12 ms-3 d-flex flex-row">
										<button type="submit" name="submit" class="prof-button">Invite Administrator</button>

										<?php
										if (isset($_SESSION['membership_confermation_message'])) {
										?>
											<div class="text-success mt-2" role="alert" style="width: fit-content;margin-left: 25px;">
												<?php
												echo $_SESSION['membership_confermation_message'];
												unset($_SESSION['membership_confermation_message']);
												?>
											</div>
											<a href="/delete_admin_request.php" class="prof-button text-decoration-none text-white ms-2">Delete Previous Request</a>
										<?php
										}
										?>
										<?php
										if (isset($_SESSION['delete_confermation_message'])) {
										?>
											<div class="text-danger mt-2" role="alert" style="width: fit-content;margin-left: 25px;">
												<?php
												echo $_SESSION['delete_confermation_message'];
												unset($_SESSION['delete_confermation_message']);
												?>
											</div>
										<?php
										}
										?>

									</div>
								</form>
							<?php
							}
							$check_membership1 = mysqli_query($con, "SELECT * FROM users WHERE `ID` = '$user_id'");
							$fetch_membership1 = mysqli_fetch_assoc($check_membership1);
							$membership1 = $fetch_membership1['membership'];
							if ($membership1 == 2) {
							?>
								<div class="row pt-4 text-black">
									<div class="col-md-12">
										<div class="p-4 edit-profile-border gradient">
											<div class="row">
												<div class="col-md-12 edit-profile-row d-flex justify-content-right align-items-right h-100"></div>
												<div class="hr-div">
													<h3 class="pt-3 white">Become a Keeper with Keeper Plus</h3>
													<p class="white">This page can have unlimited admins when the account is upgraded to Keeper Plus.</p>
													<p class="white">To Invite unlimited administrators use Upgrade to Keeper Plus</p>
													<button class="m-2 prof-button "><a href="/keeper_payment" style="text-decoration: none; color: white">Upgrade to Keeper Plus</a></button><br />
												</div>
												<div class="hr-div">
													<hr />
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php
							} else {
							?>
								<!-- <div class="hr-div">
									<hr />
								</div> -->
								<div class="col-md-12 hr-div">
									<h3 class="pt-3">Invite Keeper Administrators</h3>
									<p>Invite unlimited administrators to help you manage every memorial page you have.</p>
								</div>
								<div class="hr-div">
									<hr />
								</div>
								<form id="myForm" method="POST" action="/php/add-administrator.php">
									<div class="row ">

										<div class="col-md-6 p-3">
											<div class="row">
												<div class="mb-4" id="hide-name-input">
													<div class="form-outline self_hide" style="margin-left: 25px;">
														<label for="input-field" class="mb-2">Name</label>
														<input type="hidden" value="" id="id-hidd">
														<input type="text" id="input-field" placeholder="" class="form-control" autocomplete="off" style="border-radius: 3px; font-size: medium;" />
														<div id="error-message" style="color: red;"></div>
														<div id="search-results"></div>
													</div>
												</div>
												<div class="" id="single-input">
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12" style="margin-left: 25px;">
										<button type="submit" name="submit" class="prof-button">Invite Administrator</button>
									</div>
								</form>
							<?php
							}
							?>
						<?php
						} else if ($count == '') {

						?>
							<div class="row pt-4 text-black">
								<div class="col-md-12">
									<div class="p-4 edit-profile-border">
										<div class="row">
											<div class="col-md-12 hr-div">
												<h3 class="pt-3">Your Keepers:</h3>
												<p>Your Keeper can publish and manage your profile once you have passed.</p>
												<p><b><?php echo $firstname . ' ' . $lastname ?></b> does not have a Keeper.</p>
											</div>
											<?php
											if (isset($_SESSION['administrator_confermation_message'])) {
											?>
												<div class="alert alert-success" role="alert" style="width: fit-content;margin-left: 25px;">
													<?php
													echo $_SESSION['administrator_confermation_message'];
													unset($_SESSION['administrator_confermation_message']);
													?>
												</div>
											<?php
											}
											?>
											<div class="hr-div">
												<hr />
											</div>
											<div class="col-md-12 hr-div">
												<h3 class="pt-3">Invite Keeper Administrators</h3>
												<p>Invite unlimited administrators to help you manage every memorial page you have.</p>
												<p><b>First time,</b> You can only submit one request for free.</p>
											</div>
											<div class="hr-div">
												<hr />
											</div>
											<form id="myForm" method="POST" action="/php/add-administrator.php">
												<div class="row ">

													<div class="col-md-6 p-3">
														<div class="row">
															<div class="mb-4" id="hide-name-input">
																<div class="form-outline self_hide ms-2">
																	<label for="input-field" class="mb-2">Name</label>
																	<input type="hidden" value="" id="id-hidd">
																	<input type="text" id="input-field" placeholder="" class="form-control" autocomplete="off" style="border-radius: 3px; font-size: medium;" />
																	<div id="error-message" style="color: red;"></div>
																	<div id="search-results"></div>
																</div>
															</div>
															<div class="" id="single-input">
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-12 ms-3 d-flex flex-row">
													<button type="submit" name="submit" class="prof-button">Invite Administrator</button>

													<?php
													if (isset($_SESSION['membership_confermation_message'])) {
													?>
														<div class="text-success mt-2" role="alert" style="width: fit-content;margin-left: 25px;">
															<?php
															echo $_SESSION['membership_confermation_message'];
															unset($_SESSION['membership_confermation_message']);
															?>
														</div>
														<a href="/delete_admin_request.php" class="prof-button text-decoration-none text-white ms-2" style="text-align:center;">Delete Previous Request</a>
													<?php
													}
													?>
													<?php
													if (isset($_SESSION['delete_confermation_message'])) {
													?>
														<div class="text-danger mt-2" role="alert" style="width: fit-content;margin-left: 25px;">
															<?php
															echo $_SESSION['delete_confermation_message'];
															unset($_SESSION['delete_confermation_message']);
															?>
														</div>
													<?php
													}
													?>

												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<?php
							$check_membership2 = mysqli_query($con, "SELECT * FROM users WHERE `ID` = '$user_id'");
							$fetch_membership2 = mysqli_fetch_assoc($check_membership2);
							$membership2 = $fetch_membership2['membership'];
							if ($membership2 == 2) {
							?>
								<div class="row pt-4 text-black">
									<div class="col-md-12">
										<div class="p-4 edit-profile-border gradient">
											<div class="row">
												<div class="col-md-12 edit-profile-row d-flex justify-content-right align-items-right h-100"></div>
												<div class="hr-div">
													<h3 class="pt-3 white">Become a Keeper with Keeper Plus</h3>
													<p class="white">This page can have unlimited admins when the account is upgraded to Keeper Plus.</p>
													<p class="white">To Invite unlimited administrators use Upgrade to Keeper Plus</p>
													<button class="m-2 prof-button "><a href="/keeper_payment" style="text-decoration: none; color: white">Upgrade to Keeper Plus</a></button><br />
												</div>
												<div class="hr-div">
													<hr />
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php
							}
						} else {
							?>
							<div class="row pt-4 text-black">
								<div class="col-md-12">
									<div class="p-4 edit-profile-border">
										<div class="row">
											<div class="col-md-12 hr-div">
												<h3 class="pt-3">Your Keepers:</h3>
												<p>Your Keeper can publish and manage your profile once you have passed.</p>
											</div>
											<?php
											if (isset($_SESSION['administrator_confermation_message'])) {
												session_start();
											?>
												<div class="alert alert-success" role="alert" style="width: fit-content;margin-left: 25px;">
													<?php
													echo $_SESSION['administrator_confermation_message'];
													unset($_SESSION['administrator_confermation_message']);
													?>
												</div>
											<?php
											}
											?>
											<div class="hr-div">
												<hr />
											</div>
											<div class="hr-div">
												<div class="justify-content-center  d-flex flex-row">
													<div class="row">
														<?php
														while ($row2 = mysqli_fetch_assoc($fetaql)) {
															$user_idd2 = $row2['user_id'];
															$sql342 = "SELECT * FROM users WHERE `ID` = '" . $user_idd2 . "'";
															$result22 = mysqli_query($con, $sql342);
															if (mysqli_num_rows($result22) > 0) {

																while ($row22 = mysqli_fetch_assoc($result22)) {
																	$username2 = $row22['username'];
																	$firstname2 = $row22['firstname'];
																	$image2 = $row22['image'];
																	$keeper_id2 = $row22['ID'];
														?>
																	<div class="col-md-3 col-sm-6" style=" display: flex; flex-direction:column; justify-content: center; text-align: center; align-items: center;">
																		<div class="">
																			<?php if ($image2 != '') {
																			?>

																				<a href="/keeper_session/<?php echo $keeper_id2 . '/' . $username2; ?>" style="margin:0px 50px!important;">
																					<img src="/assets/profile/<?php echo $image2; ?>" class="keper-of" style=" border-radius:50%; height: 100px; width:100px; border:5px solid #eee;
        																		 box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);" aria-label="Placeholder: 100x100" alt="..."></a>

																			<?php
																			} else {
																			?>
																				<a href="/keeper_session/<?php echo $keeper_id2 . '/' . $username2; ?>" style="margin: 0px 50px!important;">
																					<img src="/assets/profile/user.png" class="keper-of" style=" border-radius:50%; height: 100px; width:100px; border:5px solid #eee;
    															 box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);" aria-label="Placeholder: 100x100" alt="..."></a>
																			<?php
																			}
																			?>
																		</div>
																		<div>
																			<p class="fw-bold mt-1"><a href="/keeper_session/<?php echo $keeper_id2 . '/' . $username2; ?>" class="text-decoration-none"><?php echo $firstname2; ?></a></p>
																		</div>
																	</div>

														<?php
																}
															} else {
																// echo '<div class="col-md-12" >

																// 		<p>No Your Keeper</p>
																// 	</div>';
															}

															// Extract the related product IDs from the result set
														}
														?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row pt-4 text-black">
								<div class="col-md-12">
									<div class="p-4 edit-profile-border">
										<div class="row">
											<div class="col-md-12 hr-div">
												<h3 class="pt-3">Invite Keeper Administrators</h3>
												<p>Invite unlimited administrators to help you manage every memorial page you have.</p>
											</div>
											<div class="hr-div">
												<hr />
											</div>
											<form id="myForm" method="POST" action="/php/add-administrator.php">
												<div class="row ">
													<div class="col-md-6 p-3">
														<div class="row">
															<div class="mb-4" id="hide-name-input">
																<div class="form-outline self_hide">
																	<label for="input-field" class="mb-2">Name</label>
																	<input type="hidden" value="" id="id-hidd">
																	<input type="text" id="input-field" placeholder="" class="form-control" autocomplete="off" style="border-radius: 3px; font-size: medium;" />
																	<div id="error-message" style="color: red;"></div>
																	<div id="search-results"></div>
																</div>
															</div>
															<div class="" id="single-input">
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-12">
													<button type="submit" name="submit" class="prof-button">Invite Administrator</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						<?php
						}
						// $check_membership = mysqli_query($con, "SELECT * FROM users WHERE `ID` = '$user_id'");
						// $fetch_membership = mysqli_fetch_assoc($check_membership);
						// $membership = $fetch_membership['membership'];
						// if ($membership == 2) {
						?>
						<!-- <div class="row pt-4 text-black">
								<div class="col-md-12">
									<div class="p-4 edit-profile-border gradient">
										<div class="row">
											<div class="col-md-12 edit-profile-row d-flex justify-content-right align-items-right h-100"></div>
											<div class="hr-div">
												<h3 class="pt-3 white">Become a Keeper with Keeper Plus</h3>
												<p class="white">This page can have unlimited admins when the account is upgraded to Keeper Plus.</p>
												<p class="white">To Invite unlimited administrators use Upgrade to Keeper Plus</p>
												<button class="m-2 prof-button "><a href="/keeper_payment" style="text-decoration: none; color: white">Upgrade to Keeper Plus</a></button><br />
											</div>
											<div class="hr-div">
												<hr />
											</div>
										</div>
									</div>
								</div>
							</div> -->
						<?php
						// }
						?>
					</div>
				</div>
			</div>
		</div>
	</section>


	<script>
		$(document).ready(function() {


			document.getElementById("myForm").addEventListener("submit", function(event) {
				var inputField = document.getElementById("input-field");
				var errorMessage = document.getElementById("error-message");
				if (inputField.value.trim() === "") {
					event.preventDefault();
					inputField.style.borderColor = "red";
					errorMessage.textContent = "Please enter a name.";
				} else {
					inputField.style.borderColor = ""; // Reset border color if input is not empty
					errorMessage.textContent = ""; // Clear error message if input is not empty
				}
			});
			document.getElementById("input-field").addEventListener("input", function() {
				var inputField = document.getElementById("input-field");
				var errorMessage = document.getElementById("error-message");
				inputField.style.borderColor = ""; // Reset border color when user starts typing
				errorMessage.textContent = ""; // Clear error message when user starts typing
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
										$('#hide-divs1').show();
										//$('#error-message').show();

									} else {
										$('#hide-divs1').hide();
										$('#search-results').html(output).show();
										//$('#search-results').show()
										$('#single-input').html(output4).show();
										$('.hidden-input').show();

										console.log(output);


										$('.custom_click').click(function() {
											$('#single-input').remove();

										});
										// $('#input-fields').click(function() {
										//     $('#single-input').remove();
										// });
										$('#slect-id').click(function() {
											$('#single-input').remove();

										});


										$('.input-trigger').click(function(event) {
											event.preventDefault();
											var inputField = $($(this).data('input'));
											var id = inputField.attr('id');
											var gender = $(this).data('gender');
											$('#genderInput').val(gender);
											var firstname = $(this).data('firstname');
											var lastname = $(this).data('lastname');
											var fullname = firstname + ' ' + lastname; // Concatenate firstname and lastname
											console.log('Fullname:', fullname); // Display the concatenated fullname value
											$('#input-field').val(fullname);
											// console.log('ID:', id);
											// console.log('Gender:', gender);
											$('.input-field').not(inputField).remove();
											$('#search-results').hide();
											$('#hide-name-input').show();
											$('#single-input').hide();
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
					} else {
						$('#search-results').html('');
					}
				}, 10); // set a delay of 500 milliseconds before sending the request
			});

		});
	</script>
	<script>
		// $(".alert").delay(20000).slideUp(1000, function() {
		//     $(this).alert('close');
		// });

		// $(".custom_alert").delay(15000).slideUp(2000, function() {
		//     $(this).alert('close');
		// });
	</script>
	 <?php
    
	require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';

?>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">