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

                extract($_POST);
                extract($_GET);
                if(isset( $slug ) && !empty( $slug )){
                    
                    $query_fetch = $query_response->fetch_assoc();
                    $slug_value = $connect -> real_escape_string($slug);
                    $admin_query = $connect->prepare("SELECT * FROM admins WHERE slug = ?");
                    $admin_query->bind_param("s", $slug_value);
                    $admin_query->execute();
                    $admin_query_response = $admin_query->get_result();
                    
                    if($admin_query_response->num_rows > 0 && $admin_query_response->num_rows !== 0){

                        $admin_query_fetch = $admin_query_response->fetch_assoc();

                    } else {

                        header("Location: ../admins");

                    }
                   
                } else {

                    header("Location: ../admins");

                }

            } else {

                unset($_SESSION['admin_id']);
                header("Location: ../login");

            }

        } else {

            header("Location: ../login");

        }

    ?>
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
								<h4> Edit Admin </h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="/admin-panel"> Home </a></li>
									<li class="breadcrumb-item active" aria-current="page"> Edit Admin </li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class=" bg-white border-radius-4 box-shadow mb-30">
                    
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

                        <form method='post' action="/admin-panel/includes/update.php">

                            <input type="hidden" required name='request' value='admin'/>
                            <input type="hidden" required name='slug' value='<?php print( $slug_value ) ?>'/>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label> Name </label>
                                        <input required name='name' value='<?php print( $admin_query_fetch['name'] ) ?>' type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label> Email </label>
                                        <input required name='email' value='<?php print( $admin_query_fetch['email'] ) ?>' type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label> Password </label>
                                        <input placeholder='*******' name='password' type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label> Status </label>
                                        <select required name='status' class="form-control">
                                            
                                            <?php 
                                                
                                                if($admin_query_fetch['status'] == 2){

                                                    print( "<option selected value='2'> Active </option>" );
                                                    print( "<option value='1'> Disable </option>" );

                                                } else if($admin_query_fetch['status'] == 1) {

                                                    print( "<option selected value='1'> Disable </option>" );
                                                    print( "<option value='2'> Active </option>" );

                                                }
                                            
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div style='display: flex; align-items: center' class="col-md-6 col-sm-12">
                                    
                                    <button style='width: 50%' name='submit' type="submit" class="mt-3 btn btn-primary"> Update </button>
                                    
                                </div>
                            </div>

                        </form>

                    </div>
                    
				</div>
			</div>
			<?php include('../requires/footer.php'); ?>
		</div>
	</div>
	<?php include('../requires/script.php'); ?>


</body>
</html>

<?php 

    unset($_SESSION['add_success']);
    unset($_SESSION['add_error']);

?>