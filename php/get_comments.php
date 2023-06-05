<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
$user_id = $_SESSION['user_id'];
$title = $_GET['title'];
$sql = mysqli_query($con, "SELECT * FROM `event_comments` WHERE `title` = '$title'");
if ($sql) {
    $comments = array();
    while ($row = mysqli_fetch_assoc($sql)) {
        $comments[] = array(
            'id' => $row['id'],
            'user_id' => $row['user_id'],
            'title' => $row['title'],
            'comment' => $row['comment'],
            'timestamp' => $row['timestamp'],
            'reply_id' => $row['reply_id']
        );
    }

    // Render comments
    foreach ($comments as $comment) {
        $selectimg = mysqli_query($con, "SELECT * FROM `users` WHERE `ID` = '" . $comment['user_id'] . "'");
        $fetchimg = mysqli_fetch_assoc($selectimg);
        $image = $fetchimg['image'];
        $fname = $fetchimg['firstname'];
        $lname = $fetchimg['lastname'];

        echo '<div class="card mb-3 border">';
        echo '<div class="card-body">';
        echo '<div class="d-flex flex-row"><img src="'.((!empty($image)) ? '/assets/profile/'.$image : '/assets/profile/user.png') .'" class="keper-of" style=" border-radius:50%; height: 40px; width:40px; border:2px solid #eee;
    box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);" aria-label="Placeholder: 100x100" alt="..."><h5 class="card-title mt-2 ms-2">' . $fname . ' ' . $lname . '</h5></div>';
        echo '<div class="d-flex flex-row"><p class="card-text">' . $comment['comment'] . '</p>
    <button type="button" class="prof-button reply-btn ms-auto" data-comment-id="' . $comment['id'] . '" style="text-decoration: none; color: white;">Reply</button>
    </div>';
        // echo '<p class="card-text"><small class="text-muted">' . $comment['timestamp'] . '</small></p>';

        // Check if the comment has replies
        if (!empty($comment['reply_id'])) {
            $replyIds = explode(',', $comment['reply_id']);
            foreach ($replyIds as $replyId) {
                // Retrieve the reply details from the database
                $replySql = mysqli_query($con, "SELECT * FROM `event_comments` WHERE `id` = '$replyId'");
                if ($replySql) {
                    $reply = mysqli_fetch_assoc($replySql);
                    $reply_user_id = $reply['user_id'];
                    $replyName = $reply['name'];
                    $replyComment = $reply['comment'];
                    $replyTimestamp = $reply['timestamp'];
                    $selectimg = mysqli_query($con, "SELECT * FROM `users` WHERE `ID` = '" . $reply_user_id . "'");
                    $fetchimg = mysqli_fetch_assoc($selectimg);
                    $image = $fetchimg['image'];
                    $fname = $fetchimg['firstname'];
                    $lname = $fetchimg['lastname'];
                    ?>
                    <!-- // Render the reply -->
                     
                    <div class="card mb-3 ms-5 border">
                    <div class="card-body">
                    <div class="d-flex flex-row"><img src="/assets/profile/<?= (!empty($image))? $image : 'user.png' ?>" class="keper-of" style=" border-radius:50%; height: 40px; width:40px; border:2px solid #eee;
                    box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);" aria-label="Placeholder: 100x100" alt="..."><h5 class="card-title mt-2 ms-2"> <?=$fname .' '.$lname?> </h5></div>
                    <p class="card-text"><?= $replyComment ?></p>
                    <!-- <p class="card-text"><small class="text-muted">' . $replyTimestamp . '</small></p> -->
                    </div>
                    </div>
                    <?php
                }
            }
        }

        // Reply Form
        echo '<form id="replyForm_' . $comment['id'] . '" class="reply-form">';
        echo '<div class="mb-3">';
        echo '<label for="replyInput_' . $comment['id'] . '" class="form-label">Reply:</label>';
        echo '<textarea class="form-control" id="replyInput_' . $comment['id'] . '" rows="2"></textarea>';
        echo '</div>';
        echo '<button type="button" class="prof-button" onclick="replyComment(' . $comment['id'] . ')" style="">Submit Reply</button>';
        echo '</form>';

        echo '</div>';
        echo '</div>';
    }
}
else {
    echo "Error: " . mysqli_error($con);
}


// Render comments
// foreach ($comments as $comment) {
   
// }
