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
                if(isset( $submit ) && isset( $slug ) && !empty( $slug ) ){
                
                    $query_fetch = $query_response->fetch_assoc();
                    $slug_value = $connect -> real_escape_string($slug);
                    $select_query = $connect->prepare("SELECT * FROM users WHERE slug = ?");
                    $select_query->bind_param("s", $slug_value);
                    $select_query->execute();
                    $select_query_response = $select_query->get_result();
                    
                    if($select_query_response->num_rows > 0 && $select_query_response->num_rows !== 0){

                        $select_query_fetch = $select_query_response->fetch_assoc();

                    } else {

                        header("Location: ../users");

                    }
                   
                } else {

                    header("Location: ../users");

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
								<h4> Edit User </h4>
							</div>
							<nav role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="/admin-panel"> Home </a></li>
									<li class="breadcrumb-item active"> Edit User </li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class=" bg-white border-radius-4 box-shadow mb-30">
                    
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

                        <form method='post' action="/admin-panel/includes/update.php" enctype="multipart/form-data">

                            <input type="hidden" required name='request' value='user'/>
                            <input type="hidden" required name='slug' value='<?php print( $slug_value ) ?>'/>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label> Firstname </label>
                                        <input required name='firstname' value='<?php print( $select_query_fetch['firstname'] ) ?>' type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label> Lastname </label>
                                        <input required name='lastname' value='<?php print( $select_query_fetch['lastname'] ) ?>' type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label> Email </label>
                                        <input required name='email' value='<?php print( $select_query_fetch['email'] ) ?>' type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Image (Select to Replace) </label>
                                        <input name='image' type="file" class="form-control-file form-control height-auto">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label> Phone </label>
                                        <input required name='phone' value='<?php print( $select_query_fetch['phone'] ) ?>' type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label> Address </label>
                                        <input required name='address' value='<?php print( $select_query_fetch['address'] ) ?>' type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label> City </label>
                                        <input required name='city' value='<?php print( $select_query_fetch['city'] ) ?>' type="text" class="form-control">
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