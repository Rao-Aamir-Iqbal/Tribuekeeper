<?php 
ob_start();
session_start();
session_regenerate_id();
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once "requires/head.php"; ?>
    <?php 

        require_once "requires/config.php";
        if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']) && is_numeric($_SESSION['admin_id'])){

            $admin_id = $connect -> real_escape_string($_SESSION['admin_id']);
            $query = $connect->prepare("SELECT * FROM admins WHERE ID = ?");
            $query->bind_param("s", $admin_id);
            $query->execute();
            $query_response = $query->get_result();
            if($query_response->num_rows > 0){

                if($_SESSION['USER_AGENT'] == $_SERVER['HTTP_USER_AGENT']){
                    
                    $query_fetch = $query_response->fetch_assoc(); 
				    $_SESSION['ctoken'] = bin2hex(openssl_random_pseudo_bytes(256));
                    
                } else {
                    
                    unset($_SESSION['admin_id']);
                    header("Location: /admin-panel/login?callback=" . $REQUEST_SCHEME . "://". $HTTP_HOST ."/admin-panel/admins");
                    exit(); 
                    
                }
   

            } else {

                unset($_SESSION['admin_id']);
                header("Location: /admin-panel/login?callback=" . $REQUEST_SCHEME . "://". $HTTP_HOST ."/admin-panel/admins");
                exit();

            }

        } else {

            header("Location: /admin-panel/login?callback=" . $REQUEST_SCHEME . "://". $HTTP_HOST ."/admin-panel/admins");
            exit();

        }

    ?>
	<script src="https://www.google.com/recaptcha/api.js?render=<?php print( $site_key ) ?>"></script>
</head>
<body>
	<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
		<div class="login-box bg-white box-shadow pd-30 border-radius-5">
			<h2 class="text-center mb-30"> Change Password </h2>
			<?php 
					
				if(isset($_SESSION['update_error'])){
					?>

						<div class="alert alert-danger" role="alert">
							<?php print( $_SESSION['update_error'] ) ?>
						</div>

					<?php 
				}
				
			?>
			<form method='post' id='login' action='/admin-panel/includes/update.php'>

				<input type="hidden" name='ctoken' value='<?php print( $_SESSION['ctoken'] ) ?>'/>
				<input type="hidden" name='request' value='password'/>
				<input type="hidden" name='ID' value='null'/>
				
                <div class="input-group custom input-group-lg">
					<input required name='current_password' type="password" id='current_password' class="form-control" placeholder="Current Password">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-user"></i></span>
					</div>
				</div>
				<div class="input-group custom input-group-lg">
					<input required name='new_password' type="password" id='new_password' class="form-control" placeholder="New Password">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-lock"></i></span>
					</div>
				</div>
				<div id='recaptcha' class="input-group custom input-group-lg">
					<div class="g-recaptcha" data-sitekey="<?php print( $site_key ) ?>"></div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="input-group">
							<button type='submit' name='submit' class="btn btn-primary btn-lg btn-block"> Update </button>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="forgot-password padding-top-10"><a href="/admin-panel/">Goto Home</a></div>
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

unset($_SESSION['update_error']);