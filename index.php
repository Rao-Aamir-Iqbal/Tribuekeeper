<?php
session_start();
session_regenerate_id(); 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tribute Keeper</title>
    <!-- css link -->
    <link rel="stylesheet" href="/assets/css/style_h.css">
    <link rel="stylesheet" href="/assets/css/style.css">
     <link rel="stylesheet" href="/assets/css/footer.css">
     <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <!-- java script link -->
    <link rel="stylesheet" href="/assets/js/script.js">
    <!-- Boostrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- fontawsom 6.3.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- poppin font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet">

  
</head>
<body>

    <?php
    
        require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
    
    ?>
    <!-- <section class="nav-section b-color"  style=" position: fixed; top: 0; width: 100%;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="container"  >
          <nav class="navbar navbar-expand-lg navbar-light bg-light" >
            <div class="container-fluid pt-2" >
              <a class="navbar-brand" href="#"  style="margin-top: -15px;"><img src="/images/Logo-new.png" alt="" class="log-img" width="250px"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse nav-right" id="navbarNav">
                <ul class="navbar-nav ">
                  <li><a href="#" class="nav-item nav-link ">For Bussiness</a></li>
                  <li><a href="#" class="nav-item nav-link ">FAQ</a></li>
                  <li><a href="#" class="nav-item nav-link ">Feature</a></li>
                  <li><a href="#" class="nav-item nav-link ">Keeper Plus</a></li>
                  <li><a href="#" class="nav-item nav-link ">Sign Up</a></li>
                  <li><a href="#" class="nav-item nav-link ">Login</a></li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
    </section> -->

    <section>
        <div class="main-back-img d-flex" style=" text-align: center; justify-content: center; align-items: center; height:100vh;">
            <div class="" >
                <h1 style="color:white;">KEEPING MEMORIES ALIVE</h1>
                <p style="font-size: 24px; color:white;">Beautiful, Free Online Memorials & Tributes <br> <br>
                    Keeper online tributes are a simple way <br>
                    to preserve, celebrate and share a loved one's legacy.
                </p>
                <div class="p-2">
                    <button  class="button-1 font-futura-3 btn-wid"><a href="/signup/memorial"  style="text-decoration: none; color: white">Click here to create a memorial</a></button>
                   </div>
            </div>
        </div>
    </section>

   <section class="section-1 py-5 bg-color">
    <div class="container" style="font-size: 16px!important;">
        <div class="row py-5">
            <div class="col-md-6">
                <h1 class="font-futura-3 hed-font">Craft the Perfect Ceremony for Your Loved One</h1>
                <p class="py-2 colr">Keeper’s team of experts make it easy to host a virtual or hybrid memorial service to honor the memory of your loved one. When you partner with us, you’ll have access to our:</p>
                <div class="" >
                   <ul class="pb-3">
                    <li><b>Memorial Coordinators </b>       <span class="colr"> - We’ll help you eulogize, send event invites, manage the guest list, and more</li></span>
                    <li><b>Virtual or Hybrid Technology</b> <span class="colr"> - We provide hybrid, livestream, or fully virtual ceremony options to fit with your needs</li></span>
                    <li><b>Technical Directors </b>         <span class="colr"> - We’ll host and manage your memorial day-of so you can participate fully</li></span>
                   </ul>
                    
                </div>
                <!--<div class="w-100 d-flex">-->
                <!--  <div class="p-2">-->
                <!--    <button class="button-1 font-futura-3 btn-wid">Learn More</button>-->
                <!--  </div>-->
                <!--   <div class="p-2">-->
                <!--    <button class="button-2 font-futura-3 btn-wid">Book Free Consultation</button>-->
                <!--   </div>-->
                   
                <!--</div>-->
            </div>
            <div class="col-md-6 text-center py-3">
              <video class="vid-wid" width="480" height="400" controls>
                <source src="https://video-mykeeper.s3.us-east-2.amazonaws.com/mykeeper-video/VMS_Updated_Video_Jun-01.mp4" type="video/mp4" >
              </video>
             </div>
        </div>
    </div>
   </section>

   <setion class="section-6 ">
    <div class="bw-color" >
        <div class="container pt-4 py-4 "  style="font-size: 16px!important;">
            <div class="row  ">
                <div class="col-md-12 text-center mt-4 ">
                    <h1 class="font-futura-3 " style="margin-top: 30px!important;">We Serve In</h1>
                    <p class="">We are serving in following areas</p>
                </div>
            </div>
            <div class="row text-center box ">
                <div class="col-md-4 " >
                   <div class="text-center  m-2">
                      <img class="m-3" src="/uploads/images/create-a-free-memorial.png" alt="">
                        <h3 class="font-futura-3 py-2">CREATE A FREE MEMORIAL</h3>
                        <p class="p-1">by adding basic or detailed information</p>
                   </div>
                </div>
                <div class="col-md-4" >
                    <div class="text-center m-2">
                        <img class="m-3" src="/uploads/images/add-unlimited-content.png" alt="">
                        <h3 class="font-futura-3 py-2 ">ADD UNLIMITED CONTENT</h3>
                        <p class="p-1">Including photos, videos and life history</p>
                   </div>
                </div>
                <div class="col-md-4 " >
                    <div class="text-center  m-2">
                        <img class="m-3" src="/uploads/images/share-their-story.png" alt="">
                        <h3 class="font-futura-3 py-2">SHARE THEIR LIFE STORY</h3>
                        <p class="p-2">and allow others to collaborate and pay tribute</p>
                   </div>
                </div>
              <!--  <div class="col-md-3 " >-->
              <!--    <div class="text-center  m-2">-->
              <!--        <img class="m-3" src="/uploads/images/geotag-the-final-resting-place.png" alt="">-->
              <!--        <h3 class="font-futura-3 py-2">GEOTAG FINAL RESTING PLACE</h3>-->
              <!--        <p class="p-2">for precise cemetery directions</p>-->
              <!--        <a href="/seo services.html">-->
                          
              <!--        </a>-->
              <!--   </div>-->
              <!--</div>-->
            </div>
            <!--<div class="my-4" style="text-align: center;">-->
            <!--  <button class=" button-1 font-futura-3" > Explore Details </button>-->
            <!--</div>-->
            
        </div>
    </div>
    </setion>

 
<!-- 
   <section class="section-3 bg-color">
    <div class="container py-5" style="font-size: 16px!important;">
        <div class="row">
            <div class="col-md-12 text-center ma">
                <h1 class="font-futura-3 pt-5 py-2 ">Create a Memorial Website</h1>
                <p class="pt-2">Preserve and share memories of your loved one.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 pt-5" >
                <h3 class="font-futura-3">I WANT TO SHARE MEMORIES OF</h3>
                <div class="">
                  <label for="" class="py-2">First Name : </label> <br>
                  <input class="inpt" type="text" placeholder="First Name" style="border:1px solid black; padding: 5px; border-radius: 5px; width: 360px;"><br>
                  <label for=""  class="py-2">Last Name : </label><br>
                  <input class="inpt" type="text" placeholder="Last Name"  style="border:1px solid black;  padding: 5px;  border-radius: 5px;  width: 360px;"><br>
                  <label for=""  class="py-2">Email: </label> <br>
                  <input class="inpt" type="email" placeholder="Email"  style="border:1px solid black;  padding: 5px;  border-radius: 5px;  width: 360px;"> <br>
                </div>
                <button class="button-1 font-futura-3 mt-3"> Get Started </button>
            </div>
            <div class="col-md-6 pt-5 pb-3" style=" text-align: right; justify-content: right; align-items: right;">
                <img src="/images/Social share-amico.svg"  alt="">
            </div>
        </div>
    </div>
   </section> 
     -->
  

   <!-- <section class="minimal-section bg-color">-->
   <!--     <div class="container">-->
   <!--         <div class="row py-5" style="font-size: 16px!important;">-->
   <!--             <div class="col-md-12 text-center pt-2">-->
   <!--                 <b class="p-1" style="color: #5B5B5B;">- Best Solution for creative website -</b>-->
   <!--                 <h1  class="font-futura-3 p-1" style="font-size: 23px;">AWESOME MULTICONCEPT THEME</h1>-->
   <!--                 <p class="p-1" style="color: #878378">It is a long established fact that a reader will be distracted by the readable content of a <br> -->
   <!--                     page when looking at its layout Lorem dolor sit amet consectetur adipisicing elit.  Voluptate <br>vitae distinctio beatae fugiat eligendi officiis nisi sapiente.</p>-->
   <!--             </div>-->
   <!--         </div>-->
   <!--         <div class="row" style="font-size: 16px!important;">-->
   <!--             <div class="col-md-4 ">-->
   <!--                 <div class="min-1">-->
   <!--                     <div class="">-->
   <!--                         <i class="fa-regular fa-lightbulb pb-3 clor" style="font-size: 33px; "></i>-->
   <!--                     </div>-->
   <!--                     <div class="pb-5">-->
   <!--                         <h1 class="font-futura-3" style="font-size: 23px;">Our Creativity</h1>-->
   <!--                         <hr style="width: 17%;">-->
   <!--                         <hr style="width: 10%; margin-top: -12px;">-->
   <!--                         <p class="minimal">-->
   <!--                             Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ratione corrupti tempora explicabo iste laborum incidunt officia.-->
   <!--                         </p>-->
   <!--                         <a href="#" class="clor"  style="text-decoration: none; ">Read more</a>-->
   <!--                     </div>-->
   <!--                 </div>-->
   <!--             </div>-->
   <!--             <div class="col-md-4 ">-->
   <!--                 <div class="min-1">-->
   <!--                     <div class="">-->
   <!--                         <i class="fa-solid fa-business-time pb-3 clor" style="font-size: 33px; "></i>-->
   <!--                     </div>-->
   <!--                     <div class="pb-5">-->
   <!--                         <h1 class="font-futura-3" style="font-size: 23px;">Our Passion</h1>-->
   <!--                         <hr style="width: 17%;">-->
   <!--                         <hr style="width: 10%; margin-top: -12px;">-->
   <!--                         <p class="minimal">-->
   <!--                             Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ratione corrupti tempora explicabo iste laborum incidunt officia.-->
   <!--                         </p>-->
   <!--                         <a href="#" class="clor"  style="text-decoration: none; ">Read more</a>-->
   <!--                     </div>-->
   <!--                 </div>-->
   <!--             </div>-->
   <!--             <div class="col-md-4 ">-->
   <!--                 <div class="min-1">-->
   <!--                     <div class="">-->
   <!--                         <i class="fa-solid fa-layer-group pb-3 clor" style="font-size: 33px; "></i>-->
   <!--                     </div>-->
   <!--                     <div class="pb-5">-->
   <!--                         <h1 class="font-futura-3" style="font-size: 23px;">Our Expertise</h1>-->
   <!--                         <hr style="width: 17%;">-->
   <!--                         <hr style="width: 10%; margin-top: -12px;">-->
   <!--                         <p class="minimal">-->
   <!--                             Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ratione corrupti tempora explicabo iste laborum incidunt officia.-->
   <!--                         </p>-->
   <!--                         <a href="#" class="clor"  style="text-decoration: none; ">Read more</a>-->
   <!--                     </div>-->
   <!--                 </div>-->
   <!--             </div>-->
   <!--         </div>-->
            
            
   <!--     </div>-->
   <!--</section> -->

   <!--<section class="bw-color section-4 ">-->
   <!--     <div class="container py-5 " style="font-size: 16px!important;">-->
   <!--         <div class="row my-5">-->
   <!--             <div class="col-md-6 py-5">-->
   <!--                 <img src="/uploads/images/designhome.jpg" alt="">-->
   <!--             </div>-->
   <!--             <div class="col-md-6 pt-5 pl-2">-->
   <!--                 <p class="fon-siz pt-2">OUR PROCESS</p>-->
   <!--                 <h2 class="font-futura-3 " >4 Simple Steps & Get Your Professional Online Presence</h2>-->
   <!--                 <div class="" style="line-height: 12px;">-->
   <!--                     <div class="d-flex">-->
   <!--                         <i class="fa-sharp fa-solid fa-check" style="padding-right: 5px;"></i><p>Fillout our qustionare about your business details</p>-->
   <!--                     </div>-->
   <!--                     <div class="d-flex">-->
   <!--                         <i class="fa-sharp fa-solid fa-check" style="padding-right: 5px;"></i><p>Our developers, content writers & hosting team will work</p>-->
   <!--                     </div>-->
   <!--                     <div class="d-flex">-->
   <!--                         <i class="fa-sharp fa-solid fa-check" style="padding-right: 5px;"></i><p>Our digital marketing team will ensure your social presence</p>-->
   <!--                     </div>-->
   <!--                     <div class="d-flex">-->
   <!--                         <i class="fa-sharp fa-solid fa-check" style="padding-right: 5px;"></i><p>Head over a zoom call & checkout your website.</p>-->
   <!--                     </div>-->
   <!--                 </div>-->
   <!--                 <button class="bton button-5 font-futura-3"> Choose Package </button>-->
   <!--             </div>-->
   <!--         </div>-->
   <!--     </div>-->
   <!--</section>-->

  
 

 
    <!-- <section class="sild b-color" style="font-size: 16px!important;">
        <div id="carouselExampleControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-inner py-5" style="font-size: 16px!important;">
                <div class="col-md-12 pt-3 text-center">
                    <h1 class="font-futura-3 py-2 mb-5" style="font-size: 35px;"> Best For You </h3>
                </div>
                <div class="carousel-item active">
                        <div class="card-wrapper container-sm d-flex  justify-content-around">
                            <div class="card " style="width: 18rem;">
                                <img src="/images/businessman-3300907__340.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h2 class="font-futura-3 " style="font-size:25px;">Quality Guarante</h2>
                                    <p>Softileo’s team is professional. Our work would be of great quality, it is guaranteed, we are working with corporate clients from last 10 years.</p>
                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="/images/istockphoto-1385170533-612x612.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h2 class="font-futura-3 " style="font-size:25px;">Custom Teams</h2>
                                    <p>Softileo makes new custom team each time for each project. Larger the project, Larger would be the team.</p>
                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <img src="/images/business-5261745__340.webp" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h2 class="font-futura-3 " style="font-size:25px;">Experts On Duty</h2>
                                    <p>Softileo provides 24 hours service, Our experts are on duty. Our day and night teams work to generate best results for clients.</p>
                                </div>
                            </div>
                        </div>
                </div>
                
                <div class="carousel-item">
                    <div class="card-wrapper container-sm d-flex  justify-content-around">
                        <div class="card" style="width: 18rem;">
                            <img src="/images/businessman-3300907__340.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h2 class="font-futura-3 " style="font-size:27px;">Quality Guarante</h2>
                                <p>Softileo’s team is professional. Our work would be of great quality, it is guaranteed, we are working with corporate clients from last 10 years.</p>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <img src="/images/istockphoto-1385170533-612x612.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h2 class="font-futura-3 " style="font-size:27px;">Custom Teams</h2>
                                <p>Softileo makes new custom team each time for each project. Larger the project, Larger would be the team.</p>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <img src="/images/business-5261745__340.webp" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h2 class="font-futura-3 " style="font-size:27px;">Experts On Duty</h2>
                                <p>Softileo provides 24 hours service, Our experts are on duty. Our day and night teams work to generate best results for clients.</p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev carousel-control" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next carousel-control" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
   </section>  -->

   
    <?php
    
        require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';
    
    ?>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>
