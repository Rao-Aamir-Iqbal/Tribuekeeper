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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
</head>
<body>
	<?php include('requires/header.php'); ?>
	<?php include('requires/sidebar.php'); ?>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4> Mementose </h4>
							</div>
							<nav role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="/admin-panel"> Home </a></li>
									<li class="breadcrumb-item active"> Comments</li>
									<li class="breadcrumb-item active">Mementose Comments </li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class=" bg-white border-radius-4 box-shadow mb-30">
                    <div class="bg-white border-radius-4 box-shadow height-100-p py-3 px-4" style="overflow: auto ">
                        
                        
                        
                        <table id="myTable" class="display py-3 px-0">
                            
         <?php
         
         
                              if(isset($_SESSION['delete-success'])){
                                            ?>
                        
                           <div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>Success!</strong><?php print_r( $_SESSION['delete-success'] ) ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>
                                             
                                                
                                               
                        
                                            <?php 
                                            
                                               unset($_SESSION['delete-success']);
                                        }
         
         ?>
    <thead>
        <tr>
            <th>#</th>
         
            <th>User Name</th>
            <th>Mementose Image</th>
            <th>Comment</th>
            <th>Date</th>
            <th>Actions</th>
            
        </tr>
    </thead>
    <tbody>
       <?php
         if(isset($_GET['view'])){
             $id = $_GET['view'];
               $sql = "SELECT * FROM `mementose_comments` WHERE mementose_id = {$id} ";
                $result = mysqli_query($connect , $sql);
  
            $i = 1;
                           while ($row = mysqli_fetch_assoc($result)) {
                               
                                $query = "SELECT * FROM `users` WHERE ID =".$row['user_id'];
                                  $test = mysqli_query($connect , $query);
                                  if($test){
                                    $data =mysqli_fetch_assoc($test);
                                      }
                                        $mysql = "SELECT * FROM `mementose_pictures` WHERE ID =".$row['mementose_id'];
                                  $check = mysqli_query($connect , $mysql);
                                  if($check){
                                    $data2 =mysqli_fetch_assoc($check);
                                      }
                                      
                                      $date = date_create(($row['date'])); 
                                      $publishDate = date_format($date,"d-m-Y");
                                     
                               
                               ?>
                             <tr>
                             <th scope='row'><?php echo($i) ?></th>
                            
                             
                             <td><?php echo $data['firstname'] . " " . $data['lastname'] ?></td>
                             <td><img src="/uploads/<?php echo $data2['image_path'] ?>" width="20%" height="20%"></td>
                             <td><?php echo $row['comment'] ?></td>
                             <td><?php echo $publishDate ?></td>
                            
                              <td><div class='dropdown'><a class='btn btn-outline-primary dropdown-toggle' role='button' data-toggle='dropdown'><i class='fa fa-ellipsis-h'></i> </a><div class='dropdown-menu dropdown-menu-right'>

                                                                                    
																					
                                                                                    <button class='dropdown-item' style='cursor: pointer' type='submit'><a href='includes/delete_mementosecomments.php?delete=<?php echo $row['ID'] ?> '><i class='fa fa-trash'></i> Delete</a></button>
                                                                               
                                                                                
                                                                               
                                                                            </div>
                                                                        </div>

                                                                   </td>
                             
                            
                          </tr>
                          <?php
                              $i++;
                           
                              
                             }
                             
         }
                             
                           
       
       ?>
        
    </tbody>
</table>

					    
                    </div>
				</div>
			</div>
			<?php include('requires/footer.php'); ?>
		</div>
	</div>
	<?php include('requires/script.php'); ?>
   <script src="/DataTables/datatables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> 
   <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script> 

       let table = new DataTable('#myTable');


        
    </script>


</body>
</html>

<?php 

    unset($_SESSION['update_success']);
    unset($_SESSION['update_error']);
    unset($_SESSION['delete_success']);
    unset($_SESSION['delete_error']);

?>