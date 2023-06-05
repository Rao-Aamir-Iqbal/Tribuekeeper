<?php 
ob_start();
session_start();
session_regenerate_id();
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('requires/head.php'); ?>
	<?php 
    
		if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']) && is_numeric($_SESSION['admin_id'])){

			$admin_id = $connect -> real_escape_string($_SESSION['admin_id']);
			$query = $connect->prepare("SELECT * FROM admins WHERE ID = ?");
			$query->bind_param("s", $admin_id);
			$query->execute();
			$query_response = $query->get_result();
			if($query_response->num_rows > 0){

                if($_SESSION['USER_AGENT'] == $_SERVER['HTTP_USER_AGENT']){
                    
                    $query_fetch = $query_response->fetch_assoc();
				    $_SESSION['ptoken'] = bin2hex(openssl_random_pseudo_bytes(256));
                    
                } else {
                    
                    unset($_SESSION['admin_id']);
                    header("Location: /admin-panel/login");
    				exit();
                    
                }


			} else {

				unset($_SESSION['admin_id']);
                header("Location: /admin-panel/login");
				exit();

			}

		} else {

			header("Location: /admin-panel/login");
			exit();

		}

	?>
</head>
<body>
	<?php include('requires/header.php'); ?>
	<?php include('requires/sidebar.php'); ?>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4> Profile </h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="/admin-panel"> Home </a></li>
									<li class="breadcrumb-item active"> Profile </li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 bg-white border-radius-4 box-shadow">
							<div class="profile-info">
								<h5 class="mb-20 weight-500"> Profile Information </h5>
								<ul>
									<li>
										<span> Name: </span>
										<?php print( htmlspecialchars( $query_fetch['name'] ) ) ?>
									</li>
									<li>
										<span> Email Address: </span>
										<?php print( htmlspecialchars( $query_fetch['email'] ) ) ?>
									</li>
									<li>
										<span> Date </span>
										<?php print( htmlspecialchars( $query_fetch['date'] ) ) ?>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-9 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="bg-white border-radius-4 box-shadow height-100-p">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#tab1" role="tab"> Information </a>
										</li>
									</ul>
									<div class="tab-content">
										
										<div class="tab-pane fade show active" id="tab1" role="tabpanel">
											<div class="pd-20">
												
												<form method='post' action="/admin-panel/includes/update.php">

													<?php 

														if(isset($_SESSION['update_success'])){
															?>
										
																<div class="alert alert-success" role="alert">
																	<?php print( $_SESSION['update_success'] ) ?>
																</div>
										
															<?php 
														}

														if(isset($_SESSION['update_error'])){
															?>
										
																<div class="alert alert-danger" role="alert">
																	<?php print( $_SESSION['update_error'] ) ?>
																</div>
										
															<?php 
														}
														
													?>

													<input type="hidden" name='request' value='profile'/>
													<input type="hidden" name='ID' value='null'/>
													<input type="hidden" name='ptoken' value='<?php print( $_SESSION['ptoken'] ) ?>'/>

													<div class="row">
														<div class="col-md-12 col-sm-12">
															<div class="form-group">
																<label> Name </label>
																<input required name='name' value='<?php print( $query_fetch['name'] ) ?>' type="text" class="form-control">
															</div>
														</div>
														<div class="col-md-12 col-sm-12">
															<div class="form-group">
																<label> Email Address </label>
																<input required name='email' value='<?php print( $query_fetch['email'] ) ?>' type="email" class="form-control">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6 col-sm-12">
															<div class="form-group">
																<button type="submit" name='submit' class="w-100 mt-3 btn btn-primary"> Update </button>
															</div>
														</div>
														<div class="col-md-6 col-sm-12">
															<div class="form-group">
																<a type="button" href='/admin-panel/password' class="w-100 mt-3 btn btn-outline-primary"> Change Password </a>
															</div>
														</div>
													</div>

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
		</div>
	</div>
	<?php include('requires/script.php'); ?>
</body>
</html>

<?php 

    unset($_SESSION['update_success']); 
    unset($_SESSION['update_error']);

?>