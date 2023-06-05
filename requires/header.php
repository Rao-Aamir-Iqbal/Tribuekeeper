<?php

    !isset($user_login) ? $user_login == false : null;
    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
            
        $check = $connect->prepare("SELECT * FROM `users` WHERE `ID` = ?");
        $check->bind_param("s", $_SESSION['user_id']);
        $check->execute();
        $check_response = $check->get_result();
        if($check_response->num_rows > 0){

            $user_login = true;
            $user_fetch = $check_response->fetch_assoc();

        }

    }

?>
<?php
// $user_id = $_SESSION['user_id'];
?>
<style>
   
    .profile-dropdown-toggle{
        background: none;
        border: none;
        color: #003B59;
        font-weight: 600;
    }
    
    .profile-dropdown-toggle:hover,
    .profile-dropdown-toggle:focus{
        background: none !important;
        border: none !important;
        color: black !important;
        font-weight: #003B59 !important;
    }
    
@media (max-width: 1200px) {
  .navbar-nav{
        font-size:13px;
    }
    .btn-secondary{
        font-size:13px;
    }
     .navbar-brand img{
        width:218px!important;
    }
}
     
@media (max-width: 786px) {
  .navbar-nav{
        font-size:16px;
    }
    .btn-secondary{
        font-size:16px;
    } 
   
}  
</style>

<section class="nav-section bg-color" style=" position: sticky; top: 0; width: 100%; z-index:999;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
    <div class="container">
        <nav class="navbar  navbar-expand-lg">
            <div class="container-fluid">
                <a href="/" class="navbar-brand"><img src="/assets/imaages/Logo-new.png"></a>
                <button type="button" class="navbar-toggler"  data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav">
                        
                        <?php
                        
                            if($user_login == true){
                                
                                ?>
                                
                                    <li>
                                        <a href="/faqs" class="nav-item nav-link blue"> 
                                            <span class="font-siz ti-help-alt blue" ></span> Help 
                                        </a>
                                    </li> 
                                    <li>
                                        <a href="/profile/<?php print( $user_fetch['username'] ) ?>" class="nav-item nav-link blue"> 
                                            <span class="font-siz ti-user blue" ></span>  My Profile 
                                        </a>
                                    </li>
                                    
                                    <!-- <li>-->
                                    <!--    <a href="/message" class="nav-item nav-link blue"> -->
                                    <!--        <span class="font-siz ti-email blue" ></span>  Messages -->
                                    <!--    </a>-->
                                    <!--</li>-->
                                    <li>
                                        <a href="/mementose/<?php print( $user_fetch['username'] ) ?>" class="nav-item nav-link blue"> 
                                            <span class="font-siz ti-heart blue" ></span>  Mementos
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle profile-dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-top:1px;">
                                                <?php print( $user_fetch['firstname'] ) ?>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="/profile/<?php print( $user_fetch['username'] ) ?>"> My Profile </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="/network/<?php print( $user_fetch['username'] ) ?>"> My Network </a>
                                                </li>
                                                 <li>
                                                    <a class="dropdown-item" href="/mementose/<?php print( $user_fetch['username'] ) ?>"> View Mementos </a>
                                                </li>
                                                 <li>
                                                    <a class="dropdown-item" href="/family/<?php print( $user_fetch['username'] ) ?>"> View Family </a>
                                                </li>
                                                 <li>
                                                    <a class="dropdown-item" href="/events/<?php print( $user_fetch['username'] ) ?>"> View Events </a>
                                                </li>
                                                 <li>
                                                    <a class="dropdown-item" href="/message"> Messages </a>
                                                </li>
                                                <!-- <li>
                                                    <a class="dropdown-item" href="/notifications/<?php print( $user_fetch['username'] ) ?>"> Notifications </a>
                                                </li> -->
                                                <li>
                                                    <a class="dropdown-item" href="/logout"> Logout </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                
                                <?php
                                
                            } else {
                                
                                ?>
                                
                                    <li>
                                        <a href="/faqs" class="nav-item nav-link blue"> 
                                            <span class="font-siz ti-help-alt blue" ></span>  HELP 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/signup" class="nav-item nav-link blue">
                                            <span class="ti-home blue font-siz-17"></span> Signup 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/login" class="nav-item nav-link blue">
                                            <span class="ti-home blue font-siz-17"></span> Login 
                                        </a>
                                    </li>

                                <?php

                            }

                        ?>

                        <form action="/search" method="GET">

                            <input class="form-control serch w-100" value='<?php isset( $_GET['query'] ) ? print( $_GET['query'] ) : null ?>' name='query' type="text" placeholder="Search">

                        </form>
                         
                    </div>
                </div>
            </div>
        </nav>
    </div>
</section>