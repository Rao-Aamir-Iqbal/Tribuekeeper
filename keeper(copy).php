<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

if (!$_SESSION['user_id']) {
	header("location: /login");
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM `users` WHERE ID = '".$_SESSION['user_id']."'";
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
	<title>Keeper page</title>
	<link rel="stylesheet" href="/assets/css/style.css" />
	<link rel="stylesheet" href="/assets/js/script.js" />
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
										</div>
										<div class="hr-div">
											<hr />
										</div>
										<div class="hr-div">
											<p class="pb-5">The profiles that <strong><?php echo($username);?></strong> manages.</p>
											<div class="justify-content-center  d-flex flex-row">
												<?php
												$userid = $_SESSION['user_id'];
												//die();
												$sql1 = "SELECT * FROM `keepers` WHERE `kepper_ids` =  '".$_SESSION['user_id']."'";
											//	echo "SELECT * FROM `keepers` WHERE `kepper_ids` =  '".$_SESSION['user_id']."'";
												//die();

												$result1 = mysqli_query($con, $sql1);
												if (mysqli_num_rows($result1) > 0) {
													while ($row1 = mysqli_fetch_assoc($result1)) {
														$user_idd = $row1['user_id'];

														//$keeper_ids = explode(',', $related_keepers);
														$sql34 = "SELECT * FROM users WHERE ID = '".$user_idd."'";
													//	echo "SELECT * FROM users WHERE ID = '".$user_idd."'";
														//die();
														$result2 = mysqli_query($con, $sql34);

														while ($row2 = mysqli_fetch_assoc($result2)) {
															$username2 = $row2['username'];
															$firstname2 = $row2['firstname'];
															$image2 = $row2['image'];
															$keeper_id2 = $row2['ID'];
												             ?>
															<div class="col-md-3" style="width:100%; justify-content:center; text-align:center; align-items:center; display:flex ">
																<?php if ($image2 != '') {
																?>
																	<a href="/profile/<?php echo $username2;?>/<?php echo $keeper_id2; ?>">
																		<img src="/assets/profile/<?php echo $image2; ?>" class="" style=" border-radius:50%; height: 100px; width:100px; border:5px solid #eee;
																		 box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);" aria-label="Placeholder: 100x100" alt="..."></a>
																<?php
																} else {
																?>
																	<a href="/profile/<?php echo $username2;?>/<?php echo $keeper_id2; ?>">
																		<img src="/assets/profile/user.png" class="" style=" border-radius:50%; height: 100px; width:100px; border:5px solid #eee;
															 box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);" aria-label="Placeholder: 100x100" alt="..."></a>
																<?php
																}
																?>

																<p class="fw-bold mt-1" ><a href="/profile/<?php echo $username2;?>/<?php echo $keeper_id2; ?>" class="text-decoration-none"><?php echo $firstname2; ?></a></p>
															</div>
												            <?php
														}
													}
												} else {
													echo '<div class="col-md-3" style="width:20%;">
															
															<p>No Keeper of</p>
														  </div>';
												}
												// Extract the related product IDs from the result set

												?>
											</div>
											<button class="m-2 prof-button "><a href="#" style="text-decoration: none; color: white">Create Memorial Profile</a></button><br />
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
											<h3 class="pt-3">Your Keepers</h3>
										</div>
										<div class="hr-div">
											<hr />
										</div>

										<div class="hr">
											<div class="justify-content-center  d-flex flex-row">
												<?php
												$userid = $_SESSION['user_id'];
												$sqli = "SELECT * FROM keepers WHERE user_id = '".$_SESSION['user_id']."'";
												//echo "SELECT * FROM keepers WHERE user_id = '".$_SESSION['user_id']."'";
											
												//die();

												$result3 = mysqli_query($con, $sqli);
												if (mysqli_num_rows($result3) > 0) {
													// Extract the related product IDs from the result set
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
															<div class="col-md-3" style="width:20%;">
																<?php if ($image4 != '') {
																?>
																	<a href="/profile/<?php echo $username4;?>/<?php echo $keeper_id; ?>">
																		<img src="/assets/profile/<?php echo $image4; ?>" class="" style=" border-radius:50%; height: 100px; width:100px; border:5px solid #eee;
                                                                     box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);" aria-label="Placeholder: 100x100" alt="..."></a>
																<?php
																} else {
																?>
																	<a href="/profile/<?php echo $username4;?>/<?php echo $keeper_id; ?>">
																		<img src="/assets/profile/user.png" class="" style=" border-radius:50%; height: 100px; width:100px; border:5px solid #eee;
														 box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);" aria-label="Placeholder: 100x100" alt="..."></a>
																<?php
																}
																?>

																<p class="fw-bold mt-1" style="margin-left: 30px;"><a href="/profile/<?php echo $username4;?>/<?php echo $keeper_id; ?>" class="text-decoration-none"><?php echo $firstname4; ?></a></p>
															</div>
												            <?php
														}
													}
												} else {
													echo '<div class="col-md-3" style="width:20%;">
															
															<p>No Yours Keeper</p>
														  </div>';
												}
												?>
											</div>
										</div>

										<p>Your Keeper can publish and manage your profile once you have passed.</p>
										<p><strong>Username </strong>does not have a Keeper.</p>
									</div>
								</div>
							</div>
						</div>

						<div class="row pt-4 text-black">
							<div class="col-md-12">
								<div class="p-4 edit-profile-border gradient">
									<div class="row">
										<div class="col-md-12 edit-profile-row d-flex justify-content-right align-items-right h-100"></div>
										<div class="hr-div">
											<h3 class="pt-3 white">Become a Keeper with Keeper Plus</h3>
											<p class="white">This page can have unlimited admins when the account is upgraded to Keeper Plus.</p>
											<button class="m-2 prof-button "><a href="#" style="text-decoration: none; color: white">Upgrade to Keeper Plus</a></button><br />
										</div>
										<div class="hr-div">
											<hr />
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
</body>

</html>