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
                if(isset( $slug ) && !empty( $slug ) ){
                
                    $query_fetch = $query_response->fetch_assoc();
                    $slug_value = $connect -> real_escape_string($slug);
                    $category_query = $connect->prepare("SELECT * FROM categories WHERE slug = ?");
                    $category_query->bind_param("s", $slug_value);
                    $category_query->execute();
                    $category_query_response = $category_query->get_result();
                    
                    if($category_query_response->num_rows > 0 && $category_query_response->num_rows !== 0){

                        $category_query_fetch = $category_query_response->fetch_assoc();

                    } else {

                        header("Location: /admin-panel/categories");

                    }
                   
                } else {

                    header("Location: /admin-panel/categories");

                }

            } else {

                unset($_SESSION['admin_id']);
                header("Location: /admin-panel/login?callback=" . $REQUEST_SCHEME . "://". $HTTP_HOST ."/admin-panel/update/category/" . $_GET['slug']);
                exit();

            }

        } else {

            header("Location: /admin-panel/login?callback=" . $REQUEST_SCHEME . "://". $HTTP_HOST ."/admin-panel/update/category/" . $_GET['slug']);
            exit();

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
								<h4> Edit Category </h4>
							</div>
							<nav role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="/admin-panel"> Home </a></li>
									<li class="breadcrumb-item active"> Edit Category </li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class=" bg-white border-radius-4 box-shadow mb-30">
                    
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

                        <form method='post' action="/admin-panel/includes/update.php" enctype="multipart/form-data">

                            <input type="hidden" required name='request' value='category'/>
                            <input type="hidden" required name='slug' value='<?php print( $slug_value ) ?>'/>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label> Name </label>
                                        <input required name='name' value='<?php print( $category_query_fetch['category_name'] ) ?>' type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Image (Select to Replace) </label>
                                        <input name='image' type="file" class="form-control-file form-control height-auto">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label> Description </label>
                                        <input required name='description' value='<?php print( $category_query_fetch['short_description'] ) ?>' type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> Long Description </label>
                                        <textarea required name='long_description' class="form-control"><?php print( $category_query_fetch['long_desc'] ) ?></textarea>
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