<style>
  .modal-header .btn-close {
    padding: .5rem .5rem;
    margin: -.5rem -.5rem 5.5rem auto;
  }

  .modal {
    --bs-modal-width: 600px !important;
  }

  #containerFields {
    display: block;
    text-align: left;
    margin-top: 5px;
    margin-left: 0px;
    margin-right: 0px;
    padding-left: 0px;
    padding-right: 0px;
    width: 100px;
    color: #0083BE;
    cursor: pointer;
  }

  textarea .form-control {
    height: auto;
  }
</style>
<?php
// session_start();
// require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

//  $user_id = $_SESSION['user_id'];

$namequery = "SELECT * FROM `users` WHERE ID = $user_id";
$exe_name = mysqli_query($con, $namequery);
$fetch1 = mysqli_fetch_assoc($exe_name);
$username = $fetch1['username'];
$firstname = $fetch1['firstname'];
$lastname = $fetch1['lastname'];
$image = $fetch1['image'];
$cover_image = $fetch1['cover_image'];
$mem_log=$fetch1['eembership'];
$id = $fetch1['ID'];
echo "<style>
.img-1 {
  background-image: url(".(($cover_image!=null)? '/uploads/'.$cover_image :'/assets/profile/cover.jpg').");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: left;
  height: 260px;
}
</style>";
?>

<!-- Modal -->
<form action="" id="share_mem" method="post" class="ajax">
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <p class="modal-title mt-5" id="exampleModalLabel"><strong>Share
              <?php echo $firstname ?>'s Memorial by Email
            </strong><br>Invite
            friends &amp; family to leave a tribute message and photo.</p>
          <button type="button" class="btn-close mt-0" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <input type="text" placeholder="Your Name" name="name" class="form-control" id="recipient-name">
            </div>
            <div class="row mb-3" id="append_email">
              <div class="col-md-4">
                <input type="text" placeholder="Enter Email" name="email[]" class="form-control" id="recipient-name">
              </div>
            </div>
            <div id="containerFields" title="Add Email" style="width: 100px;margin-top: 5px;">
              <i class="ti-plus"></i> Add Email
            </div>
            <div class="mb-3 mt-2">
              <textarea rows="9" placeholder="Include a personal message here." name="message" class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" value="submit" class="btn btn-primary form-control">Send Email</button>
        </div>
      </div>
    </div>
  </div>
</form>

<div class="img-1 text-white d-flex flex-row ">
  <div class="ms-4 mt-5 d-flex flex-column pro-img-check" style="padding:90px;">
    <img src="/assets/profile/<?=(($image!=null)? $image :'user.png') ?>" alt="Generic placeholder image" class="img-fluid   mt-4 mb-2">
  </div>
</div>

<div class="p-4 text-black  circle-img" style="margin-bottom:-20px;">
  <div class="prof-nam">
    <div class=" circle-img-text">
      <div style="display:flex!important; flex-direction:row!important;">
        <h5><?php echo $firstname . " " . $lastname ?></h5>
        <!-- <?php if((isset($mem)) or $mem_log==1){?> <img src="/assets/imaages/pro.png" class="m-1" alt="lodding" width="20px" height="20px" ><?php } ?> -->
      </div>

      <div class="d-flex justify-content-end text-center ">
        <div class="px-1 pt-1 d-flex font-sz">
          <!-- <a href="#" data-bs-toggle="" data-bs-target="" style="text-decoration:none; margin-right:-8px"><span class="ti-facebook px-1 blue"></span></a> -->
          <div id="share_link">
              
              <span class='profile-link d-none'></span>
              <a href="#"  id="link"  style="text-decoration:none; margin-right:-8px">
                  <span class="ti-link px-3 blue"></span>
              </a>
          
          </div>
          <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" style="text-decoration:none; margin-right:-8px"><span class="ti-email px-2 blue"></span></a>
        </div>
      </div>

    </div>
    <div class="header-marg">
      <hr>
    </div>

  </div>
  <div class="hed-btn">
      <?php
             if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])  && $user_id==$_SESSION['user_id']){

     ?>
    <a href='/signup/memorial' class="prof-button px-4" style="color: white; text-decoration: none">Create a Memorial</a>
            <?php

              }
              else{ ?>
                <a href="" class="" style="margin-top:30px;"></a>
                <?php } ?>

             
  </div>


  <div class="main-profile-icons mrgn-tp" style="margin-top: -70px; margin-bottom: 10px;">
    <div class="d-flex mar-top">
      <div class="">
        <a href="/profile/<?php echo $username; ?>" class="ti-user  circle"><span class="fa">Profile</span></a>
      </div>
      <div class="">
        <a href="/mementose/<?php print($username) ?>" class="ti-image  circle"><span class="fa">Memento</span></a>
      </div>
      <div>
        <a href="/keeper/<?php echo $username; ?>" class="ti-lock circle"><span class="fa">Keeper</span></a>
      </div>
      <div>
        <a href="/family/<?php echo $username; ?>" class="ti-user circle "><span class="fa">Family</span></a>
      </div>
      <div>
        <a href="/events/<?php echo $username; ?>" class="ti-calendar circle "><span class="fa">Event</span></a>
      </div>
      <div>
        <a href="/message/<?php print( $username ) ?>" class="ti-email circle "><span class="fa">Message</span></a>
      </div>
      <div>
        <a href="/keeper_plus" class="ti-plus circle " style="margin-right: -5px;"><span class="fa">Keeper</span></a>
      </div>

    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {



    var email = '<div class="col-md-4"><input type="text" placeholder="Enter Email" name="email[]" class="form-control" id="recipient-name"></div>';

    $('#containerFields').click(function() {
      $('#append_email').append(email);
    });


    // Handle form submission
    $("#share_mem").submit(function(event) {
      event.preventDefault(); // Prevent default form submit behavior

      // Send AJAX request
      $.ajax({
        url: "/php/share_memory.php",
        type: "POST",
        data: $(this).serialize(), // Serialize form data
        success: function(response) {
          // Handle success response
          console.log(response);
        },
        error: function(xhr, status, error) {
          // Handle error response
          console.log(xhr.responseText);
        }
      });
    });

    
    $("#share_link a").click(function(event) {
      event.preventDefault(); // Prevent default form submit behavior

    
      var dummy = document.createElement('input'),
    text = window.location.href;

          document.body.appendChild(dummy);
           dummy.value = text;
          dummy.select();
          
          try {
    
    var msg = document.execCommand('copy') ? 'successful' : 'unsuccessful';
        document.querySelector(".profile-link").classList.remove('d-none');
        document.querySelector(".profile-link").classList.add('text-success');
        document.querySelector(".profile-link").innerHTML = "Copy link successfully!";
    
          document.body.removeChild(dummy);
  } catch (err) {

        document.querySelector(".profile-link").classList.remove('d-none');
        document.querySelector(".profile-link").classList.add('text-danger');
        document.querySelector(".profile-link").innerHTML = "Unable to copy link!";

  }
    });
  });
</script>