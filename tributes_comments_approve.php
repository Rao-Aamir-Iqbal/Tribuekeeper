<?php

	session_start();
	session_regenerate_id();

	$user_login = false;
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
	
		require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
		$check = $connect->prepare("SELECT * FROM `users` WHERE `ID` = ?");
		$check->bind_param("s", $_SESSION['user_id']);
		$check->execute();
		$check_response = $check->get_result();
		if($check_response->num_rows > 0){

            $user_login = true;
    		$user_fetch = $check_response->fetch_assoc();

            if(isset($_GET['username']) && !empty($_GET['username'])){
                
                $check_username = $connect->prepare("SELECT * FROM `users` WHERE `username` = ?");
                $check_username->bind_param("s", $_GET['username']);
                $check_username->execute();
                $check_username_response = $check_username->get_result();
                if($check_username_response->num_rows > 0){

                    $check_username_fetch = $check_username_response->fetch_assoc();
                    $user_id = $check_username_fetch['ID'];

                } else {

                    http_response_code(404);
                    exit();

                }
                
            } else {
                
                http_response_code(404);
                exit();
                
            }

		} else {

			unset($_SESSION['user_id']);

		}

	} else {

        header("Location: /login");

    }
    


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title> Tributes Comments -  Tribute Keeper </title>
	<link rel="stylesheet" href="/assets/css/style.css"/>
	<link rel="stylesheet" href="/assets/js/script.js"/>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"/>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/assets/css/themify-icons.css"/>
	<link rel="preconnect" href="https://fonts.googleapis.com"/>
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet"/>
	  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
	
	<style>
	
		.card-background {
			background-color: #f8f9fa;
			border: none;
			border-radius: 20px;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
		}
		
		.reject-all-btn {
			border: none;
			border-radius: 10px;
			font-size: medium;
		}
		
		.submit-button {
			border: none;
			border-radius: 10px;
			font-size: medium;
			background-color: #0099cc;
		}
		
		.sign-up-second-input-box {
			border: none;
			border-radius: 10px;
			font-size: medium;
		}
		
		.signup-lov-text h1 {
			font-size: 29px;
			font-weight: 500;
		}
		
		.signup-lov-text h3 {
			font-size: 25px;
			font-weight: 700;
		}
		
		.form-label{
		    font-size: 16px;
		}

		.steps .step.active{
			background-color: #00759d !important;
		}
		.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.show {
  display: block;
}
		
	</style>
</head>
<body>
    
	<?php

	    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
	    require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/subheader.php';

	?>
<pre>
<section class="">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="card">
                <div class=" row pt-4 text-black">
                    <div class=" col-md-12 ">
                        <div class="p-4 edit-profile-border">
                             <div class="row" >
                                <table id="myTable">
                                    <thead>
                                        <tr>
                                           <th>Sr#</th>
                                            <th>Name</th>
                                            <th>Main Comments</th>
                                            <th>View Replys </th>
                                            <th>Status </th>
                                            <th>Actions</th>
                                           
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                       <?php
                                       
                                       $login_id = $_SESSION['user_id'];
                                       $user_name = $_GET['username'];
                                       $mysql = "SELECT * FROM `users` WHERE username = '$user_name'";
                                       $test = mysqli_query($connect , $mysql);
                                       $check = mysqli_fetch_assoc($test);
                                       $user_id = $check['ID'];
                                       $new = "SELECT * FROM `keepers` WHERE user_id = '$login_id' AND kepper_ids = '$user_id'";
                                       $checkit = mysqli_query($connect , $new);
                                       if(mysqli_num_rows($checkit) > 0){
                                           
                                               $sql = "SELECT * FROM `memorial_comments` WHERE `status` = '0' AND `reply_id` IS NULL";
                                       $result = mysqli_query($connect , $sql);
                                            $i = 1;
                                                           while ($row = mysqli_fetch_assoc($result)) {
                                                            //   print_r($row);
                                                                // $query = "SELECT * FROM `users` WHERE ID =".$row['user_id'];
                                                                //   $test = mysqli_query($connect , $query);
                                                                //   if($test){
                                                                //     $data =mysqli_fetch_assoc($test);
                                                                
                                                                //       }
                                                                    $reply =  $row['id'];
                                                                      $query2 = "SELECT * FROM `memorial_comments` WHERE `reply_id` = $reply";
                                                                  $test2 = mysqli_query($connect , $query2);
                                                                  if ($testfetch = mysqli_fetch_assoc($test2)){
                                                                      
                                                                    
                                                                      
                                                                  }
                                                               
                                                                      
                                                                     
                                                               
                                                               ?>
                                                             <tr>
                                                             <th scope='row'><?php echo($i) ?></th>
                                                            
                                                             <td><?php echo $row['name']  ?></td>
                                                             <td><?php echo $row['comment'] ?></td>
                                                             <td><a href="/view_comments/<?php echo $row['id'] ?>" target="_blank"><span class="ti-email"></span></a></td>
                                                            
                                                              <td><span>Pending</span></td>
                                                              <td> 
                                                                <div class="btn-group">
                                                                    <button class="btn btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                     Actions
                                                                   </button>
                                                                     <ul class="dropdown-menu">
                                                                      <li><a class="dropdown-item" href="/php/delete_approval.php?delete=<?php echo $row['id'] ?>&username=<?php echo $user_name ?>">Delete</a></li>
                                                                      <li><a class="dropdown-item" href="/php/update_upproval.php?id=<?php echo $row['id'] ?>&username=<?php echo $user_name ?>">Approval</a></li>
                                                                 </ul>
                                                                </div>
                                                              </td>
                                                             
                                                            
                                                          </tr>
                                                          <?php
                                                              $i++;
                                                           
                                                              
                                                             }
                                                             
                                       }else{
                                           
                                      header("Location: /profile/" . $username );
                                           
                                       }
                                      
                                   
                                                             
                                                           
                                       
                                       ?>
                                        
                                    </tbody>
                               </table>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script>
 $(document).ready(function() {
            $('#myTable').DataTable();
        });
        
        
     
	</script>

</body>
</html>
