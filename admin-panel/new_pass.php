<?php 
ob_start();
session_start();
session_regenerate_id();


if(isset($_SESSION['page']) && !empty($_SESSION['page'])){
     
     if($_SESSION['page'] != 3){
        //   header("Location: /admin-panel/code");
         if($_SESSION['page'] == 2){
              header("Location: /admin-panel/code");
         }else if($_SESSION['page'] == 3){
             header("Location: /admin-panel/newpassword");
         }
             
         }
     


  
}else{
      header("Location: /admin-panel/code");
}
   
    
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once "requires/head.php"; ?>
	<?php 

		require_once "requires/config.php";
		$_SESSION['ltoken'] = bin2hex(openssl_random_pseudo_bytes(256));
		if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']) && is_numeric($_SESSION['admin_id'])){

			$admin_id = $connect -> real_escape_string($_SESSION['admin_id']);
			$query = $connect->prepare("SELECT * FROM admins WHERE ID = ?");
			$query->bind_param("s", $admin_id);
			$query->execute();
			$query_response = $query->get_result();
			if($query_response->num_rows > 0){

				header("Location: /admin-panel/");

			} else {

				unset($_SESSION['admin_id']);

			}

		} 

	?> 
</head>
<body>
	<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
		<div class="login-box bg-white box-shadow pd-30 border-radius-5">
			<h2 class="text-center mb-30">Create Password</h2>
			<?php 
					
				if(isset($_SESSION['error'])){
					?>

						<div class="alert alert-danger" role="alert">
							<?php print( $_SESSION['error'] ) ?>
						</div>

					<?php 
				}
					if(isset($_SESSION['success'])){
					    
					?>

						<div class="alert alert-success" role="alert">
							<?php print( $_SESSION['success'] ) ?>
						</div>
						

					<?php 
					unset($_SESSION['success']);
				}
				
			?>
			<form method='post' id='forgot' action='/admin-panel/includes/check_pass.php?<?php isset($_GET['callback']) && !empty($_GET['callback']) ? print("callback=" . $_GET['callback']) : null; ?>'>
				<input type="hidden" name='ltoken' value='<?php print( $_SESSION['ltoken'] ) ?>'/>
				<div class="input-group custom input-group-lg">
				    
					<input required name='password' type="password" id='password' class="form-control" placeholder="New Password">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-lock"></i></span>
					</div>
				</div>
				<div class="input-group custom input-group-lg">
					<input required name='password2' type="password" id='password2' class="form-control" placeholder="Confirm Passworr">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-lock"></i></span>
					</div>
				</div> 
				
			
				<div class="row">
					<div class="col-sm-6">
					
					</div>
					<div class="col-sm-6">
							<div class="input-group">
							<button type='submit' name='submit' class="btn btn-outline-primary btn-lg btn-block">Check</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php include_once "requires/script.php" ?>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</body>
</html>

<?php 

unset($_SESSION['error']);