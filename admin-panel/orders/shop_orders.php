<?php 
ob_start();
session_start();
session_regenerate_id(); 
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../requires/head.php'); ?>
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
    				$_SESSION['utoken'] = bin2hex(openssl_random_pseudo_bytes(256));
    				$_SESSION['dtoken'] = bin2hex(openssl_random_pseudo_bytes(256));
                    
                } else {
                    
                    unset($_SESSION['admin_id']);
                    header("Location: /admin-panel/login?callback=" . $REQUEST_SCHEME . "://". $HTTP_HOST ."/admin-panel/");
                    exit();
                    
                }


            } else {

                unset($_SESSION['admin_id']);
                header("Location: /admin-panel/login?callback=" . $REQUEST_SCHEME . "://". $HTTP_HOST ."/admin-panel/");
                exit();

            }

        } else {

            header("Location: /admin-panel/login?callback=" . $REQUEST_SCHEME . "://". $HTTP_HOST ."/admin-panel/");
            exit();

        }

    ?>
    <link rel="stylesheet" type="text/css" href="src/plugins/jquery-steps/build/jquery.steps.css">
</head>
<body>
	<?php include('../requires/header.php'); ?>
	<?php include('../requires/sidebar.php'); ?>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4> Welcome to EcomKill Dashboard </h4>
							</div>
							<nav role="navigation">
								<ol class="breadcrumb"></ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="row clearfix progress-box">
					<div class="col-lg-4 col-md-6 col-sm-12 mb-30">
						<a style='display: block; width: 100%' href='/admin-panel/orders/shop/1kill' class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
							<div class="project-info clearfix">
								<div class="project-info-left">
									<div class="icon box-shadow bg-blue text-white">
										<i class="fa fa-briefcase"></i>
									</div>
								</div>
								<div class="project-info-right">
									<span class="no text-blue weight-500 font-24"> 1-Kill Orders </span>
									<p class="weight-400 font-18"> Shop 1-Kill orders </p>
								</div>
							</div> 
						</a>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12 mb-30">
						<a style='display: block; width: 100%' href='/admin-panel/orders/shop/3kill' class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
							<div class="project-info clearfix">
								<div class="project-info-left">
									<div class="icon box-shadow bg-blue text-white">
										<i class="fa fa-briefcase"></i>
									</div>
								</div>
								<div class="project-info-right">
									<span class="no text-blue weight-500 font-24"> 3-Kill Orders </span>
									<p class="weight-400 font-18"> Shop 3-Kill orders </p>
								</div>
							</div> 
						</a>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12 mb-30">
						<a style='display: block; width: 100%' href='/admin-panel/orders/shop/5kill' class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
							<div class="project-info clearfix">
								<div class="project-info-left">
									<div class="icon box-shadow bg-blue text-white">
										<i class="fa fa-briefcase"></i>
									</div>
								</div>
								<div class="project-info-right">
									<span class="no text-blue weight-500 font-24"> 5-Kill Orders </span>
									<p class="weight-400 font-18"> Shop 5-Kill orders </p>
								</div>
							</div> 
						</a>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12 mb-30">
						<a style='display: block; width: 100%' href='/admin-panel/orders/shop/10kill' class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
							<div class="project-info clearfix">
								<div class="project-info-left">
									<div class="icon box-shadow bg-blue text-white">
										<i class="fa fa-briefcase"></i>
									</div>
								</div>
								<div class="project-info-right">
									<span class="no text-blue weight-500 font-24"> 10-Kill Orders </span>
									<p class="weight-400 font-18"> Shop 10-Kill orders </p>
								</div>
							</div> 
						</a>
					</div>
				</div>
			</div>
			<?php include('../requires/footer.php'); ?>
		</div>
	</div>
	<?php include('../requires/script.php'); ?>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> 
    <script> 

        $('#datatable').DataTable(); 
        $('#datatable2').DataTable(); 

    </script>


</body>
</html>

<?php 

    unset($_SESSION['update_success']);
    unset($_SESSION['update_error']);
    unset($_SESSION['delete_success']);
    unset($_SESSION['delete_error']);

?>