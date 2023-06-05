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
            $user_id = $user_fetch['ID'];

		} else {

			unset($_SESSION['user_id']);
	        header("Location: /login");

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
	<section class="h-100 b-color">
		<div class="container pb-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="my-4 col-md-12">
				   <table id="myTable">
    <thead>
        <tr>
           <th>Sr#</th>
            <th>Name</th>
            <th>Reply </th>
            <th>Status </th>
            <th>Actions</th>
           
        </tr>
    </thead>
    
    <tbody>
        <?php
        
        if(isset($_GET['view'])){
            $id = $_GET['view'];
           $sql = "SELECT * FROM `memorial_comments` WHERE id = {$id} ";
           $result = mysqli_query($connect , $sql);
           
           $name_id =  $_GET['username'];
           echo $name_id;
           $cql = "SELECT * FROM `users` WHERE `ID` = '$name_id'";
           $new = mysqli_query($connect ,  $cql);
           $row2 = mysqli_fetch_assoc($new);
           var_dump($row2);
           
          
           
           
            $i = 1;
                           while ($row = mysqli_fetch_assoc($result)) {
                         
                                       $reply =  $row['id'];
                                      $query2 = "SELECT * FROM `memorial_comments` WHERE `reply_id` = $reply";
                                  $test2 = mysqli_query($connect , $query2);
                                  if ($testfetch = mysqli_fetch_assoc($test2)){
                                      
                                  }
                                     
                               
                               ?>
                             <tr>
                             <th scope='row'><?php echo($i) ?></th>
                            
                             <td><?php echo $row['name']  ?></td>
                             <td><?php echo $testfetch['comment'] ?></td>
                           
                            
                              <td><span>Pending</span></td>
                              <td> 
                             <div class="btn-group">
  <button class="btn btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Actions
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="/php/delete_comment.php?delete=<?php echo $row['id'] ?>">Delete</a></li>
  
  </ul>
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
