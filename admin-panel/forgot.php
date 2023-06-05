<?php 
ob_start();
session_start();
session_regenerate_id();



if(isset($_SESSION['page']) && !empty($_SESSION['page'])){
     
    
        //   header("Location: /admin-panel/code");
         if($_SESSION['page'] == 2){
              header("Location: /admin-panel/code");
         }else if($_SESSION['page'] == 3){
             header("Location: /admin-panel/newpassword");
         }
             
         
     


  
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
			<h2 class="text-center mb-30">Forgot Password</h2>
			<?php 
					
				if(isset($_SESSION['error'])){
					?>

						<div class="alert alert-danger" role="alert">
							<?php print( $_SESSION['error'] ) ?>
						</div>

					<?php 
				}
				
			?>
			<form method='post' id='forgot' action='/admin-panel/includes/forgot_password.php?<?php isset($_GET['callback']) && !empty($_GET['callback']) ? print("callback=" . $_GET['callback']) : null; ?>'>
				<input type="hidden" name='ltoken' value='<?php print( $_SESSION['ltoken'] ) ?>'/>
				<div class="input-group custom input-group-lg">
				    
					<input required name='email' type="text" id='email' class="form-control" placeholder="Email address">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-user"></i></span>
					</div>
				</div>
			
				<div class="row">
					<div class="col-sm-6">
					
					</div>
					<div class="col-sm-6">
							<div class="input-group">
							<button type='submit' name='submit' class="btn btn-outline-primary btn-lg btn-block">Send Mail</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php include_once "requires/script.php" ?>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script>
	
		document.getElementById("password").onkeyup = function(){

			if(document.getElementById("password").value !== ""){

				if(document.getElementById("email").value !== ""){

					document.getElementById("recaptcha").style.display = "block";

				} else {

					document.getElementById("recaptcha").style.display = "none";

				}

			}  else {

				document.getElementById("recaptcha").style.display = "none";

			}

		}

		document.getElementById("email").onkeyup = function(){

			if(document.getElementById("email").value !== ""){

				if(document.getElementById("password").value !== ""){

					document.getElementById("recaptcha").style.display = "block";

				} else {

					document.getElementById("recaptcha").style.display = "none";

				}

			}  else {

				document.getElementById("recaptcha").style.display = "none";

			}

		}

	</script>
</body>
</html>

<?php 

unset($_SESSION['error']);