<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
if(!empty($_SESSION['user_id'])){
    // header("location: /login");
    
    
    
    $log_uid=$_SESSION['user_id'];
    
    $sql_log = "SELECT * FROM `users` WHERE `id` = '$log_uid'";
$exe_log = mysqli_query($con, $sql_log);
$fetch_log = mysqli_fetch_assoc($exe_log);
$log_uname=$fetch_log['username'];
    
    $log_fname = $fetch_log['firstname'];
$log_mname = $fetch_log['middlename'];
$log_lname = $fetch_log['lastname'];
    
    
}
$user_id = $_GET['user_id'];
$sql = mysqli_query($con, "SELECT * FROM `memorial_comments` WHERE `user_id` = '$user_id' AND `status`= 1");
if ($sql) {
    $comments = array();
    while ($row = mysqli_fetch_assoc($sql)) {
        $comments[] = array(
            'id' => $row['id'],
            'user_id' => $row['user_id'],
            'log_uid' => $row['log_uid'],
            'name' => $row['name'],
            'comment' => $row['comment'],
            'image' => $row['image'],
            'timestamp' => $row['timestamp'],
            'reply_id' => $row['reply_id']
        );
    }

    // Render comments
 foreach ($comments as $comment) {
     if($comment['log_uid']===null){
          $selectimg = mysqli_query($con, "SELECT * FROM `users` WHERE `ID` = '" . $comment['log_uid'] . "'");
        $fetchimg = mysqli_fetch_assoc($selectimg);
        $image = $fetchimg['image'];
     }
        // $selectimg = mysqli_query($con, "SELECT * FROM `users` WHERE `ID` = '" . $comment['user_id'] . "'");
        // $fetchimg = mysqli_fetch_assoc($selectimg);
        // $image = $fetchimg['image'];
        // $fname = $fetchimg['firstname'];
        // $lname = $fetchimg['lastname'];
        $cms=$comment['id'];
        $smc=$comment['reply_id'];
if($comment['reply_id']===null){
        echo '<div class="card mb-3 border">';
        echo '<div class="card-body" style=" margin-top:0px;">';
        echo '<div class="pb-2 d-flex" >' .'<img src="/assets/profile/'.(($image!=null)? $image :'user.png').'"class=" m-1" style=" text-align: center; border-radius:50%; height: 40px; width:40px; border:2px solid #eee;
        box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);  padding-top:6px;" aria-label="Placeholder: 100x100" alt="...">' .'<h5 class="card-title mt-2 ms-2">' . $comment['name'] . '</h5></div>'  .(($comment['image']!=null)?'<img src="/uploads/'. $comment['image'] . '" class="keper-of"  style=" margin-left: 50px!important; height: 150px; width:150px; border:2px solid #eee;
        box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);" aria-label="Placeholder: 100x100" alt="...">':''); 
        echo '<div class="d-flex flex-row"><p class="card-text py-3 smal-fnt" style=" margin-left:50px;">' . $comment['comment'] . '</p>
    <input type="hidden"  data-comment-id="' . $comment['id'] . '">
    </div>';
        // echo '<p class="card-text smal-fnt" style=" margin-left:50px; margin-top:-30px;"><small class="text-muted"> Published at '. $comment['timestamp'] . '</small></p>';
         
}    
   

        // Check if the comment has replies
        
            // $replyIds = explode(',', $comments['reply_id']);
            // foreach ($replyIds as $replyId) {
            foreach ($comments as $comment) {
               if (!empty($comment['reply_id'])) {
                if($comment['reply_id']===$cms) {
                // Retrieve the reply details from the database
                // $replySql = mysqli_query($con, "SELECT * FROM `memorial_comments` WHERE `id` = '$replyId'");
                // if ($replySql) {
                //     $reply = mysqli_fetch_assoc($replySql);
                //     $reply_user_id = $reply['user_id'];
                //     $replyName = $reply['name'];
                //     $replyComment = $reply['comment'];
                //     $replyTimestamp = $reply['timestamp'];
                    // $selectimg = mysqli_query($con, "SELECT * FROM `users` WHERE `ID` = '" . $reply_user_id . "'");
                    // $fetchimg = mysqli_fetch_assoc($selectimg);
                    // $image = $fetchimg['image'];
                    // $fname = $fetchimg['firstname'];
                    // $lname = $fetchimg['lastname'];
            
                    // Render the reply
                    
                    echo '  <hr style=" margin-left:50px;">
                    <div class="card mb-3 ms-5 border">';
                    echo '<div class="card-body">';
                    echo '<div class="d-flex flex-row"><div class="condolence-image">
                          <div class="img-profile-50x50">
                           <div class="custom-avatar-container custom-avatar-container-o custom-avatar-container-4"><img src="/assets/profile/'.(($image!=null)? $image :'user.png').'"class=" m-1" style=" text-align: center; border-radius:50%; height: 40px; width:40px; border:2px solid #eee;
                             " aria-label="Placeholder: 100x100" alt="..."></div> </div>
                          </div><h5 class="card-title mt-2 ms-2">' . $comment['name'] . '</h5></div>';
                    echo '<p class="card-text smal-fnt" style=" margin-left:50px;">' . $comment['comment'] . '</p>';
                    // echo '<p class="card-text smal-fnt" style=" margin-left:50px;  margin-top:-10px;" ><small class="text-muted">  Published at  ' . $comment['timestamp'] . '</small></p>';
                    echo '</div>';
                    echo '</div>';
                  }
                }
            }


        

        // Reply Form
        if($smc===null){
        echo '<form id="replyForm_' . $cms . '" class="reply-form" style=" margin-left:5px;">';
        echo '<div class="mb-3">';
        if (empty($_SESSION['user_id'])){
            echo '<label for="name_' . $cms . '" >Name:</label><br>
            <input type="text" id="name_' . $cms . '" name="name_' . $cms . '" required><br><br></div>';}
            else{
                echo '<input type="hidden" id="name_' . $cms . '" name="name_' . $cms . '" value="'.$log_fname.' '.$log_mname.' '.$log_lname.'" required>
              <input type="hidden" id="log_uid" name="log_uid" value="'.$_SESSION['user_id'].'" required><br><br>';
            }
        echo '<label for="replyInput_' . $cms . '" class="form-label"  >Reply:</label>';
        echo '<textarea class="form-control" id="replyInput_' . $cms . '" rows="2" required ></textarea>';
        echo '<button type="submit" class="prof-button mt-3" id="replyInput_' . $cms . '"  style="text-decoration: none; color: white;">Submit Reply</button>';

        echo '</div>';
        echo '</form>';

        echo '</div>';
        echo '</div>';
           }
        }
    
}
else {
    echo "Error: " . mysqli_error($con);
}


// Render comments
// foreach ($comments as $comment) {
   
// }
