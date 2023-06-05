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
            $user_id = $_SESSION['user_id'];

        } else {

            unset($_SESSION['user_id']);

        }

    }

?>
<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title> FAQs - Tribute Keeper </title>

	<link rel="stylesheet" href="/assets/css/style.css"/>
    <link rel="stylesheet" href="/assets/js/script.js">
    <link rel="stylesheet" href="/assets/css/footer.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>

  <link rel="stylesheet" href="/assets/css/themify-icons.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">

  <style>
    a {

      color: #428bca;

      text-decoration: none;

    }

    .img-responsive {

      display: block !important;

      height: auto;

      max-width: 100%;

    }
  </style>

</head>

<body>

  <section class="h-100 gradient-custom-2">

    <?php

        require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
        
    ?>





    <div class="container py-5 h-100">

      <div class="row d-flex justify-content-center align-items-center h-100">

        <div class="">

          <div class="card">

            <div class=" row pt-4 text-black">

              <div class=" col-md-12 ">

                <div class="p-4 edit-profile-border">

                  <div class="row">

                    <div class="col-md-12 edit-profile-row d-flex justify-content-right align-items-right h-100">

                      <h3 class="pt-3">GENERAL FAQ</h3>

                    </div>

                    <div class="hr-div">

                      <hr>

                    </div>

                    <div class="hr-div">
                      <div class="accordion" id="accordionExample">

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingOne">

                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

                              What Is Keeper?

                            </button>

                          </h2>

                          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              Good question! Keeper is a social memorial website dedicated to remembering the lives of
                              the departed. Our passion is storytelling, so we built a tool to help people preserve a
                              life story and all the memories that come with it. You can create a collaborative
                              memorial, where friends and family can leave tributes, upload photos, like, share,
                              comment, connect, and remember those who are dearly missed. Whether you would like to
                              share these memories with the world, or privately with a few close relatives, Keeper's
                              platform is secure, simple and flexible.



                              <br><br>



                              <a target="_blank" href="https://www.mykeeper.com/about-us/"
                                title="Read our Founding Story">Read our Founding Story</a>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingTwo">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">

                              What is an online memorial?

                            </button>

                          </h2>

                          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              Online Memorials are virtual spaces of remembrance, celebration and commemoration for the
                              deceased. At the touch of a button you can revisit the life of a loved one, leave a
                              tribute message, view their life through photographs and videos and connect with family
                              members and friends.

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingThree">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">

                              Why should I make an online memorial?

                            </button>

                          </h2>

                          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              We used to commemorate our loved ones by sharing analogue photo books, home videos and
                              memories with each other. Today, almost all of our photos and videos are created and
                              stored digitally, and our family and friends are spread across the country and the world.

                              <br><br>

                              Online memorials are the perfect way to store and share these memories, while bringing
                              everyone together in a collaborative commemoration. Rather than save the images in a
                              personal cloud storage that only you can see, online memorials let you and your family
                              collect your favorite memories, share stories and give your loved one a dignified legacy
                              for generations to come.

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFour">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">

                              How can I create a memorial?

                            </button>

                          </h2>

                          <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              Click on the

                              <a href="" title="Sign Up">'Sign Up'</a>

                              link at the top right of the page. You'll be asked to input some basic information about
                              your loved one to get their memorial started. You will also have to fill out some
                              information about yourself because you become the Keeper (i.e. the administrator) of their
                              memorial.

                              <br>

                              <img alt="How do I create an Organization Page for my business?"
                                src="/image/gif-image.gif" data-src="img/faq/how-can-I-create-a-memorial.jpg"
                                data-src-gif="img/faq/how-can-I-create-a-memorial.gif" class="img-responsive" />

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFive">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">

                              If I Sign Up with Facebook, will Keeper post on my behalf?

                            </button>

                          </h2>

                          <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              No, Keeper does not post anything on your behalf. We simply use your email address and
                              name to create your account.

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingSix">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">

                              How much does an online memorial cost?

                            </button>

                          </h2>

                          <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <p>Keeper offers two account options:</p>

                              <p style="margin-top:20px;"><strong>Keeper Free</strong>: Enables you to build up to two
                                memorial pages to preserve and share the lifestory of your loved ones. Your free account
                                will never expire, and your memorial pages will always stay online. You can upgrade to
                                Keeper Plus at any time to unlock added benefits and features.</p>

                              <p style="margin-top:20px;"><strong>Keeper Plus</strong>: Includes many expanded features
                                designed for your community to be able to help create a true celebration of life. Here
                                are just some of the added benefits of Keeper Plus: unlimited image and HD video
                                uploads, download all images, full family tree, unlimited memorial pages, and much
                                more.<br />

                                <strong>Keeper Plus costs $74.99 - one time payment.</strong>

                              </p>

                              <a target="_blank"
                                href="https://www.mykeeper.com/keeper-plus-features/#all-features">Keeper Plus vs Free
                                Features</a>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingSeven">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">

                              What is Keeper Plus?

                            </button>

                          </h2>

                          <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <p>Keeper Plus is the new expanded, feature-rich version of Keeper. It includes unlimited
                                online memorials, image sharing, HD video uploads, full family tree, and much more. The
                                cost to create a Keeper Plus account, or to upgrade your current free account is $74.99
                                (one time payment). </p>

                              <a target="_blank" href="https://www.mykeeper.com/keeper-plus-features/">Learn More about
                                Keeper Plus</a>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingEight">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">

                              Can I create a Keeper profile without creating a memorial?

                            </button>

                          </h2>

                          <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              Yes you can! On the <a title="Sign Up" href="https://www.mykeeper.com/signup-steps/">Sign
                                Up page</a>, select the <a title="Sign Up"
                                href="https://www.mykeeper.com/signup-steps/">Create my Own Profile</a> option. We just
                              need some basic information, including your email, which will be used as your login. Once
                              you've signed up, you can create a memorial, connect with an existing memorial, become
                              part of a family tree or even begin building your legacy.

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingNine">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">

                              Can I write out my legacy and create my memorial before I die?

                            </button>

                          </h2>

                          <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              At Keeper, we believe that everyone should <a target="_blank" title="plan ahead"
                                target="_blank"
                                href="http://www.talkdeath.com/funeral-pre-planning-everything-you-need-to-know/">plan
                                ahead</a>. When you sign up to Keeper, you can write out your own biography, create your
                              family tree, and begin uploading your treasured photos and videos. <a
                                title="Designate a family member to become your Keeper"
                                href="https://www.mykeeper.com/faq/#how-do-i-add-another-qeepr-to-my-loved-one-memorial">Designate
                                a family member to become your Keeper</a> so that when you pass away, they can gain
                              control of your profile and add any other information to keep your memory alive. <a
                                title="Sign Up"
                                href="https://www.mykeeper.com/signup-steps/?is_self_account_view=1">Give it a try
                                here</a>.

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingTen">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">

                              Can I make a memorial private for family & friends?

                            </button>

                          </h2>

                          <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              As a Keeper, you have total control of your loved one's memorial. Memorials can be 100%
                              public or 100% private. Want to share your memorial with family only? You can do that.
                              Want a public profile but private images? You can do that as well. Learn more about <a
                                title="Privacy Settings"
                                href="https://www.mykeeper.com/faq/#memorial-management-how-do-i-change-a-memorial-privacy-settings">Privacy
                                Settings Here</a>.

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingEleven">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">

                              How long do memorials stay online?

                            </button>

                          </h2>

                          <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              Unlike newspaper obituaries which may only last a few days, or other websites that charge
                              to keep it online, Keeper memorials are designed to last a lifetime. We do not delete any
                              profile (but you can always remove any memorial you create). There are no trial periods or
                              hidden costs.

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingTwelve">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">

                              Can I link an online memorial to a burial or cremation location?

                            </button>

                          </h2>

                          <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              Keeper memorials can easily be linked to a loved one's resting place. Our <a
                                target="_blank" title="Keeper Mobile App"
                                href="https://play.google.com/store/apps/details?id=com.qeepr.app">Mobile App</a> lets
                              you geotag the exact coordinates of your loved one's location, allowing family members and
                              friends to be guided directly to their monument with Google Maps.

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingThirteen">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">

                              Does Keeper have a Mobile App?

                            </button>

                          </h2>

                          <div id="collapseThirteen" class="accordion-collapse collapse"
                            aria-labelledby="headingThirteen" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              Our <a target="_blank" title="Keeper Mobile App"
                                href="https://play.google.com/store/apps/details?id=com.qeepr.app">Mobile App</a> for
                              Android phones can be downloaded from the Play Store for free! With our app, you can view
                              memorials, edit any memorial you manage, view and upload photos, geotag a monument and
                              more. <a title="Mobile App" href="https://www.mykeeper.com/faq/#mobile-app">Learn more
                                about our Mobile App Here</a>.

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFourteen">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">

                              Does Keeper offer grief resources and links?

                            </button>

                          </h2>

                          <div id="collapseFourteen" class="accordion-collapse collapse"
                            aria-labelledby="headingFourteen" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <a target="_blank" title="TalkDeath" href="https://www.talkdeath.com">TalkDeath.com</a> is
                              Keeper’s large and active community with extensive resources and grief support articles.
                              From dealing with loss, learning about cremation and green burial, tips for navigating
                              grief and interesting death facts, the TalkDeath Keeper Community has got you covered. We
                              are also on <a target="_blank" title="Keeper Facebook"
                                href="https://www.facebook.com/KeeperMemorials">Facebook</a>, <a target="_blank"
                                title="Keeper Twitter" href="https://twitter.com/keepermemorials">Twitter</a>, <a
                                target="_blank" title="Keeper Instagram"
                                href="https://www.instagram.com/keepermemorials/">Instagram</a> and <a target="_blank"
                                title="Keeper YouTube"
                                href="https://www.youtube.com/channel/UCHAZTY22p28WjcIXyLnUjqQ">YouTube</a>.

                            </div>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>



            <div class=" row pt-4 text-black">

              <div class=" col-md-12 ">

                <div class="p-4 edit-profile-border">

                  <div class="row">

                    <div class="col-md-12 edit-profile-row d-flex justify-content-right align-items-right h-100">

                      <h3 class="pt-3">Creating & Editing a Memorial</h3>

                    </div>

                    <div class="hr-div">

                      <hr>

                    </div>

                    <div class="hr-div">



                      <div class="accordion" id="accordionExample">

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFifteen">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">

                              I have signed up, what’s next?

                            </button>

                          </h2>

                          <div id="collapseFifteen" class="accordion-collapse collapse" aria-labelledby="headingFifteen"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <p>Welcome to the Keeper Community!</p>

                              <p>In order to sign up with Keeper and create a memorial page, you first need to create an
                                account for yourself. When you sign up with us, you will have your own profile, as well
                                as memorial pages for your loved ones. </p>

                              <p>Memorial pages are created by their “Keepers.” Keepers are the memorial page
                                administrators. </p>

                              <p>Once you have completed your registration and are signed into your account, follow
                                these steps to create a memorial page:</p>

                              <ol>

                                <li>

                                  Navigate to the top menu bar, and click on <span
                                    class="glyphicon glyphicon-heart"></span> <strong>Memorials</strong></li>

                                <li>

                                  Click <strong>+ Create Memorial</strong> </li>

                                <li>Input the you loved one’s name, dates and gender</li>

                                <li>Once you have entered this basic information, you can build their full life story
                                  including their biography, life milestones, upload photos, and more</li>

                              </ol>

                              <img alt="I have signed up, what’s next?" src="/image/how-do-i-create-a-memorial-2.gif"
                                class="img-responsive" />

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingSixteen">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseSixteen" aria-expanded="false" aria-controls="collapseSixteen">

                              How do I share a memorial page via Email?

                            </button>

                          </h2>

                          <div id="collapseSixteen" class="accordion-collapse collapse" aria-labelledby="headingSixteen"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <ol>

                                <li>Login to your account</li>

                                <li>Navigate to the Memorial you wish to share</li>

                                <li>

                                  In the header section of the Memorial, there are 3 icons to choose from. Select the
                                  <strong>@</strong> icon to share the memorial page via Email.</li>

                                <li>A pop up window will appear</li>

                                <li>Enter the required information in the text boxes: your name, recipient email
                                  address(es), and an optional personal message</li>

                                <li>

                                  Select the <strong>+</strong> icon to enter more email addresses </li>

                                <li>

                                  Hit the <strong>Send Email</strong> button </li>

                                <li>

                                  A notification that your email has been sent will appear under the <strong>Send Email
                                    button</strong>. Note that once you have successfully shared the memorial page via
                                  email, the pop up window will remain open and all the text boxes will be empty. </li>

                              </ol>

                              <img alt="How do I share a memorial page via Email?"
                                src="/image/how-do-i-share-a-memorial-page-via-email-2.gif" class="img-responsive" />

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingSeventeen">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseSeventeen" aria-expanded="false"
                              aria-controls="collapseSeventeen">

                              How do I share a memorial page to Facebook?

                            </button>

                          </h2>

                          <div id="collapseSeventeen" class="accordion-collapse collapse"
                            aria-labelledby="headingSeventeen" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <ol>

                                <li>Login to your account</li>

                                <li>Navigate to the Memorial you wish to share</li>

                                <li>

                                  In the header section of the Memorial, there are 3 icons to choose from. Select the
                                  <strong>F</strong> icon to share the memorial page to Facebook. </li>

                                <li>A Facebook pop up window will open. If you are not logged into your Facebook
                                  account, you will be prompted to login.</li>

                                <li>The preview of the memorial page will appear in the Facebook window. Enter your
                                  caption text, and select your Facebook sharing options.</li>

                                <li>

                                  Once you select ‘<strong>Share on Facebook,</strong>’ the popup window will close and
                                  a link to your memorial will be posted on Facebook </li>

                              </ol>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingEighteen">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseEighteen" aria-expanded="false" aria-controls="collapseEighteen">

                              How do I share a memorial page on Twitter?

                            </button>

                          </h2>

                          <div id="collapseEighteen" class="accordion-collapse collapse"
                            aria-labelledby="headingEighteen" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <ol>

                                <li>Login to your account</li>

                                <li>Navigate to the Memorial you wish to share</li>

                                <li>

                                  In the header section of the Memorial, there are 3 icons to choose from. Select the
                                  <strong>Twitter</strong> bird icon to share the memorial page to Twitter.</li>

                                <li>A Twitter pop up window will open. If you are not logged into your Twitter account,
                                  you will be prompted to login.</li>

                                <li>Enter the text for your tweet</li>

                                <li>

                                  Once you select ‘<strong>Tweet,</strong>’ the popup window will close and a link to
                                  your memorial will be posted on Twitter </li>

                              </ol>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingNineteen">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseNineteen" aria-expanded="false" aria-controls="collapseNineteen">

                              How do I upload photos to a memorial?

                            </button>

                          </h2>

                          <div id="collapseNineteen" class="accordion-collapse collapse"
                            aria-labelledby="headingNineteen" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <p>

                                If you are a Keeper Admin of a memorial page, follow the instructions below to upload
                                images to a memorial page. If you are a <strong>guest</strong> on our site, <a
                                  title="How do I post a Tribute, Condolence or image on a memorial page?"
                                  href="https://www.mykeeper.com/faq/#how-do-i-send-a-condolence-message">click here for
                                  instructions</a> on sharing an image to a memorial page. </p>

                              <ol>

                                <li>

                                  Navigate to the <strong>Memento</strong> section of the memorial </li>

                                <li>

                                  Click the <strong>+Add & Edit Mementos</strong> link near the bottom </li>

                                <li>

                                  Drag & Drop your files or press <strong>Add Files</strong> to Browse files from your
                                  computer </li>

                                <li>

                                  Click <strong>Upload</strong> </li>

                                <li>Once images have successfully uploaded, you can add captions, crop or rotate images
                                  and change the privacy settings of each image</li>

                              </ol>

                              <p><strong>Image Specifications:</strong></p>

                              <ul>

                                <li>

                                  <strong>Maximum file size</strong> per image is 5MB.
                                </li>

                                <li>

                                  <strong>Maximum image size</strong> is 5000px x 5000px.
                                </li>

                                <li>

                                  We currently support the following <strong>image file types</strong>: .png, .jpg,
                                  .jpeg, .gif (.gifs will not appear animated) </li>

                              </ul>

                              <p><strong>Tips:</strong></p>

                              <ul>

                                <li>You can upload many photos at a time in Mementos, and set different privacy settings
                                  for each</li>

                                <li>You can organize the photos in the Mementos sections by dragging and dropping images
                                  and videos to change the order in which they appear</li>

                                <li>

                                  Read our <a target="_blank" title="Collecting Family Photos and Preserving Memories"
                                    href="https://www.talkdeath.com/collecting-family-photos-preserving-memories/">article</a>
                                  on how to organize and collect family photographs!

                                </li>

                              </ul>

                              <br />

                              <img alt="How do I upload photos to a memorial?"
                                src="/image/how-do-i-upload-photos-to-a-memorial.gif" class="img-responsive" />

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingTwenty">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseTwenty" aria-expanded="false" aria-controls="collapseTwenty">

                              How do I upload a video?

                            </button>

                          </h2>

                          <div id="collapseTwenty" class="accordion-collapse collapse" aria-labelledby="headingTwenty"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <p>

                                Keeper enables you to upload videos to a memorial page using a link from a video-sharing
                                website like YouTube or Video, or directly from a video file stored on a computer <span
                                  style="font-weight:bolder;text-decoration:underline;">or</span> a mobile device.

                              </p>

                              <strong>From a Link:</strong>

                              <ol>

                                <li>Upload the video to YouTube, Vimeo and Copy the video's URL</li>

                                <li>

                                  Navigate to the <strong>Memento</strong> section of the memorial </li>

                                <li>

                                  Click the <strong>+Add & Edit Mementos</strong> link </li>

                                <li>

                                  Click on the <strong>Video</strong> tab, and select <strong>From a Link</strong> </li>

                                <li>Paste the video URL and add any description and video dates</li>

                                <li>A preview of the video will appear</li>

                                <li>

                                  Click <strong>Add</strong>

                                </li>

                              </ol>



                              <strong>From a File (Keeper Plus only)</strong>

                              <ol>

                                <li>

                                  Navigate to the <strong>Memento</strong> section of the memorial </li>

                                <li>

                                  Click the <strong>+Add & Edit Mementos</strong> button </li>

                                <li>

                                  Click on the <strong>Video</strong> tab, and select <strong>From a File</strong> </li>

                                <li>

                                  Click <strong>+Choose File</strong> and then hit <strong>Upload</strong> </li>

                                <li>After the video finishes uploading, we will notify you when it is available for
                                  viewing</li>

                              </ol>

                              <p>Keeper supports the following video file types: <strong>.avi, .mkv, .3gp, .mov, .mp4,
                                  .wmv, .flv, .mpg, .mpeg</strong>. The maximum file size per video is <strong>
                                  2GB</strong>.</p>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingTwentyOne">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseTwentyOne" aria-expanded="false"
                              aria-controls="collapseTwentyOne">

                              How do I create a family tree?

                            </button>

                          </h2>

                          <div id="collapseTwentyOne" class="accordion-collapse collapse"
                            aria-labelledby="headingTwentyOne" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <ol>

                                <li>Log in to your account</li>

                                <li>

                                  Navigate to the <strong>Family</strong> icon on your profile or the memorial profile
                                  you manage </li>

                                <li>Under each family member there is a '+' symbol - this allows you to add a family
                                  member</li>

                                <li>Fill out their information and remember to tick off whether they are deceased or not
                                </li>

                                <li>If you are adding another Keeper user, they must accept your request to add them to
                                  your family tree</li>

                              </ol>

                              Tip: Family members do not need to be current Keeper members to be added to your tree.

                              <img alt="How do I create a family tree?" src="/image/how-do-i-create-a-family-tree.gif"
                                class="img-responsive" />

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingTwentyTwo">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseTwentyTwo" aria-expanded="false"
                              aria-controls="collapseTwentyTwo">

                              How do I edit a member of the family tree?

                            </button>

                          </h2>

                          <div id="collapseTwentyTwo" class="accordion-collapse collapse"
                            aria-labelledby="headingTwentyTwo" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <ol>

                                <li>Log in to your account</li>

                                <li>Navigate to the Memorial you wish to edit</li>

                                <li>

                                  Select the <strong>Family Icon</strong> </li>

                                <li>Locate the family member you wish to edit</li>

                                <li>

                                  Select the <strong>Edit pencil icon</strong> beside their name </li>

                                <li>

                                  This will take you to the <strong>Edit a Family Member</strong> page </li>

                                <li>On this page you can edit their name, dates, gender, and relationship</li>

                                <li>On this page you can also add or edit their image that will appear on the Family
                                  Tree*</li>

                                <li>

                                  Select <strong>Edit Family Member</strong> once you have completed your changes </li>

                              </ol>

                              <p>

                                *Including images on the Family Tree is a <a title="Keeper Plus Features"
                                  href="https://www.mykeeper.com/keeper-plus-features/" target="_blank">Keeper Plus</a>
                                feature.

                              </p>

                              <img alt="How do I edit a member of the family tree?"
                                src="/image/how-do-i-create-a-family-tree-add.gif" class="img-responsive" />

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingTwentyThree">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseTwentyThree" aria-expanded="false"
                              aria-controls="collapseTwentyThree">

                              How do I post a tribute, condolence or image on a memorial page?

                            </button>

                          </h2>

                          <div id="collapseTwentyThree" class="accordion-collapse collapse"
                            aria-labelledby="headingTwentyThree" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              When you visit a memorial page, you can leave a tribute message by simply navigating to
                              the bottom of the profile. You have the option of sending a tribute as a: <br /><br />

                              <ul style="list-style:none;">

                                <li><strong>Guest -</strong>&nbsp;Simply leave your name and email address to send your
                                  message</li>

                                <li><strong>Keeper member -</strong>&nbsp;Sign in to your Keeper account and write your
                                  tribute</li>

                                <li><strong>Facebook -</strong>&nbsp;Click on the Facebook icon to leave a message. It
                                  will not be posted to your Facebook account.</li>

                              </ul>

                              <p>

                                When uploading a photo in the Tribute section, you are able to share one image at a
                                time. If you are the Keeper of the memorial page, you can upload many photos at once via
                                the Mementos section. To learn more, <a title="How do I upload photos to a memorial?"
                                  href="https://www.mykeeper.com/faq/#how-do-i-upload-photos-to-a-memorial">click
                                  here</a>.

                              </p>

                              <p>

                                <strong>Maximum file size</strong> per image is 5MB.
                              </p>

                              <p>

                                <strong>Maximum image size</strong> is 5000px x 5000px.
                              </p>

                              <p>

                                We currently support the following <strong>image file types</strong>: .png, .jpg, .jpeg,
                                .gif (.gifs will not appear animated) </p>

                              <img alt="How do I send a tribute message?"
                                src="/image/how-do-i-send-a-condolence-message.gif" class="img-responsive" />

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingTwentyFour">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseTwentyFour" aria-expanded="false"
                              aria-controls="collapseTwentyFour">

                              How do I send a private message to another Keeper user?

                            </button>

                          </h2>

                          <div id="collapseTwentyFour" class="accordion-collapse collapse"
                            aria-labelledby="headingTwentyFour" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              Keeper users can contact others within the Keeper network privately. <ol>

                                <li>Use the top search bar to find the user you wish to contact</li>

                                <li>

                                  Click on the <strong>Message</strong> icon on their profile </li>

                                <li>Write your message and hit send</li>

                              </ol>

                              Tip: You can easily access your message inbox by clicking on the envelope icon on the top
                              menu bar

                              <div class="container-faq-img-gif">

                                <img alt="How do I send a private message to another Keeper user?"
                                  src="/image/how-do-i-send-a-private-message-to-another-qeepr-user.gif"
                                  class="img-responsive" />



                              </div>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingTwentyFive">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseTwentyFive" aria-expanded="false"
                              aria-controls="collapseTwentyFive">

                              How do I change the theme on a profile or memorial?

                            </button>

                          </h2>

                          <div id="collapseTwentyFive" class="accordion-collapse collapse"
                            aria-labelledby="headingTwentyFive" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              To customize a background header image:

                              <ol>

                                <li>Once signed in, visit your profile or the memorial profile you manage</li>

                                <li>

                                  Click on <strong>Edit Profile</strong> </li>

                                <li>

                                  Navigate to <strong>Theme</strong> </li>

                                <li>Choose one of our Keeper themes or upload your own image</li>

                              </ol>

                              Tip: For best results, use an image with dimensions 1024X768 and higher

                              <img alt="How do I change the theme on a profile or memorial?"
                                src="/image/how-do-i-change-the-theme-on-a-profile.gif" class="img-responsive" />

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingTwentySix">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseTwentySix" aria-expanded="false"
                              aria-controls="collapseTwentySix">

                              How can I add, edit or remove an icon on a memorial page?

                            </button>

                          </h2>

                          <div id="collapseTwentySix" class="accordion-collapse collapse"
                            aria-labelledby="headingTwentySix" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <p>Icons are small graphical images that can be used to personalize a Keeper memorial
                                page, and even your own profile. Icons include religious symbols, floral patterns,
                                images of hobbies, and more.</p>

                              <ol>

                                <li>Once signed in, visit the memorial page you wish to edit</li>

                                <li>

                                  Click on <strong>Edit Profile</strong> </li>

                                <li>

                                  Navigate to <strong>Theme</strong> </li>

                                <li>

                                  Click on the <strong>Icon</strong> tab </li>

                                <li>Select the icon you wish to display </li>

                                <li>

                                  Click <strong>Save Changes</strong> </li>

                              </ol>

                              <p>To remove the icon:</p>

                              <ol>

                                <li>Unselect the icon by clicking on it once. This will remove the checkmark from the
                                  icon image </li>

                                <li>

                                  Click <strong>Save Changes</strong> </li>

                              </ol>

                              <img alt="How can I add, edit or remove an icon on a memorial page?"
                                src="/image/can-i-add-an-icon-to-my-profile.gif" class="img-responsive" />

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingTwentySeven">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseTwentySeven" aria-expanded="false"
                              aria-controls="collapseTwentySeven">

                              Can I add an In Memoriam Donation link?

                            </button>

                          </h2>

                          <div id="collapseTwentySeven" class="accordion-collapse collapse"
                            aria-labelledby="headingTwentySeven" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              Allow family and friends to easily access the memorial fund you would like to donations in
                              honour of your loved one to be sent to.

                              <ol>

                                <li>Navigate to your loved one's memorial</li>

                                <li>

                                  Click on <strong>Edit Profile</strong> and scroll down to the
                                  <strong>Memorial</strong> section </li>

                                <li>

                                  Under the <strong>Memorial</strong> heading, you can add the foundation or charity
                                  name and Copy & Paste the link for visitors to access </li>

                              </ol>

                              <img alt="Can I add an In Memoriam Donation link?"
                                src="/image/can-i-add-an-in-memorium-link.gif" class="img-responsive" />

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingTwentyEight">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseTwentyEight" aria-expanded="false"
                              aria-controls="collapseTwentyEight">

                              How do I upload or change a Profile Picture?

                            </button>

                          </h2>

                          <div id="collapseTwentyEight" class="accordion-collapse collapse"
                            aria-labelledby="headingTwentyEight" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <ol>

                                <li>Click on "Edit Picture" in the profile picture bubble</li>

                                <li>Scroll down and click "Choose a file"</li>

                                <li>Select the desired photo</li>

                                <li>Drag the box around your picture to crop and adjust size</li>

                                <li>Click "Upload"</li>

                              </ol>

                              <img alt="How do I upload or change a Profile Picture?"
                                src="/image/how-upload-or-change-profile-picture-600x300.gif" class="img-responsive" />

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingTwentyNine">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseTwentyNine" aria-expanded="false"
                              aria-controls="collapseTwentyNine">

                              How can I customize or change the memorial page URL/ Link?

                            </button>

                          </h2>

                          <div id="collapseTwentyNine" class="accordion-collapse collapse"
                            aria-labelledby="headingTwentyNine" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <p>Customizing a URL is available to Keeper Plus users.</p>

                              <p>To modify the link associated to your profile, or a memorial page that you manage: </p>

                              <ol>

                                <li>Navigate to the Memorial Page</li>

                                <li>

                                  Click on <strong>Edit Profile</strong></li>

                                <li>

                                  Click on the <strong>Settings</strong> tab</li>

                                <li>

                                  Scroll down to the <strong>URL</strong> settings section</li>

                                <li>

                                  Click <strong>edit URL</strong></li>

                                <li>

                                  Once you are finished editing the URL, click <strong>Save Changes</strong></li>

                              </ol>

                              <p>Please note that at this time, we cannot remove the word "profile" from the URL.
                                (Updates coming in 2021!)</p>

                              <div class="container-faq-img-gif">

                                <img alt="How can I customize or change the memorial page URL/ Link?"
                                  src="/image/how-customize-the-memorial-page-url-link-2.gif.crdownload"
                                  class="img-responsive" />

                              </div>

                            </div>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>



            <div class=" row pt-4 text-black">

              <div class=" col-md-12 ">

                <div class="p-4 edit-profile-border">

                  <div class="row">

                    <div class="col-md-12 edit-profile-row d-flex justify-content-right align-items-right h-100">

                      <h3 class="pt-3">Online Memorial Management</h3>

                    </div>

                    <div class="hr-div">

                      <hr>

                    </div>

                    <div class="hr-div">



                      <div class="accordion" id="accordionExample">

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingThirty">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseThirty" aria-expanded="false" aria-controls="collapseThirty">

                              What is a Keeper?

                            </button>

                          </h2>

                          <div id="collapseThirty" class="accordion-collapse collapse" aria-labelledby="headingThirty"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              A Keeper is the user that is designated to manage an online memorial. They are the
                              “Keeper” of the legacy, responsible to keep the memories of that person alive. By creating
                              a loved one's online memorial, you automatically become their Keeper.

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingThirtyOne">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseThirtyOne" aria-expanded="false"
                              aria-controls="collapseThirtyOne">

                              Why should I assign a Keeper to my own profile?

                            </button>

                          </h2>

                          <div id="collapseThirtyOne" class="accordion-collapse collapse"
                            aria-labelledby="headingThirtyOne" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              Assigning a Keeper to your profile ensures that your loved ones can access your memorial
                              once you pass away. Use your Keeper profile to <a
                                title="How do I upload photos to a memorial?"
                                href="https://www.mykeeper.com/faq/#how-do-i-upload-photos-to-a-memorial">upload
                                photos</a>, write out your biography, milestones and <a
                                title="How do I create a family tree?"
                                href="https://www.mykeeper.com/faq/#how-do-i-create-a-family-tree">build your family
                                tree</a>. When you pass away, your family can publish your life history, post and
                              receive <a title="How do I send a tribute message?"
                                href="https://www.mykeeper.com/faq/#how-do-i-send-a-condolence-message">tributes</a>,
                              set up an <a title="Can I add an In Memoriam Donation link?"
                                href="https://www.mykeeper.com/faq/#Can-I-add-an-In-Memoriam-Donation-link">In Memoriam
                                Donation</a> and manage your legacy.

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingThirtyTwo">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseThirtyTwo" aria-expanded="false"
                              aria-controls="collapseThirtyTwo">

                              How can I become the Keeper Administrator of an existing memorial?

                            </button>

                          </h2>

                          <div id="collapseThirtyTwo" class="accordion-collapse collapse"
                            aria-labelledby="headingThirtyTwo" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <ol>

                                <li>Navigate to the memorial you wish to manage</li>

                                <li>

                                  Click on the <strong>Keeper</strong> icon </li>

                                <li>

                                  Click <strong>Send Keeper Request</strong> button </li>

                                <li>If you already manage another online memorial, Sign in to your account to complete
                                  the request.</li>

                                <li>

                                  <strong>If you do not manage another online memorial with us</strong>, click
                                  <strong>Free Sign Up</strong> and complete the account creation process.
                                </li>

                                <li>The Keeper Administrator of the memorial will need to review your request, and you
                                  will receive an email notification once they have accepted it.</li>

                              </ol>

                              <img alt="How can I become the Keeper of someone's existing memorial?"
                                src="/image/how-can-i-become-the-qeepr-of-someone-s-existing-profile-600x300-flc.gif"
                                class="img-responsive" />

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingThirtyThree">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseThirtyThree" aria-expanded="false"
                              aria-controls="collapseThirtyThree">

                              How do I add another Keeper to my loved one's memorial?

                            </button>

                          </h2>

                          <div id="collapseThirtyThree" class="accordion-collapse collapse"
                            aria-labelledby="headingThirtyThree" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              To add another family member or friend to help manage a memorial page:

                              <ol>

                                <li>Navigate to the memorial</li>

                                <li>

                                  Select the <strong>Keeper</strong> button in their navigation bar </li>

                                <li>

                                  Click the <strong>+ Add Keeper</strong> button </li>

                                <li>

                                  If the person you wish to assign is already a Keeper user, type their name in the
                                  “<strong>Select Keeper</strong>” bar and select their name in the dropdown </li>

                                <li>

                                  If the person is not yet a Keeper user, click <strong>Send Email Invitation</strong>
                                  and fill out the required information </li>

                                <li>

                                  The person you have invited to become a Keeper will receive an email notification with
                                  further instructions </li>

                              </ol>

                              <p>If you wish to add multiple Keepers to a memorial page, you would require our Keeper
                                Plus membership. <a title="Keeper Plus Features"
                                  href="https://www.mykeeper.com/keeper-plus-features/" target="_blank">Click here</a>
                                to learn more about the benefits of Keeper Plus!</p>

                              <img alt="How do I add another Keeper to my loved one's memorial?"
                                src="/image/how-do-i-add-another-qeepr-to-my-loved-one-s-memorial.gif"
                                class="img-responsive" />

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingThirtyFour">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseThirtyFour" aria-expanded="false"
                              aria-controls="collapseThirtyFour">

                              I am the Keeper of someone who passed away. How do I turn their profile into a memorial?

                            </button>

                          </h2>

                          <div id="collapseThirtyFour" class="accordion-collapse collapse"
                            aria-labelledby="headingThirtyFour" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              In order for a Keeper profile to turn into a memorial, the person's status must be changed
                              from Alive to Deceased. <ol>

                                <li>

                                  Navigate to their profile and click <strong>Edit Profile</strong> </li>

                                <li>

                                  Click on the <strong>Memorial</strong> section </li>

                                <li>

                                  Change their <strong>Status</strong> from Alive to Deceased using the dropdown </li>

                                <li>The profile will become a memorial</li>

                              </ol>

                              <img
                                alt="I am the Keeper of someone who passed away. How do I turn their profile into a memorial?"
                                src="/image/how-do-i-turn-their-profile-into-a-memorial.gif" class="img-responsive" />

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingThirtyFive">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseThirtyFive" aria-expanded="false"
                              aria-controls="collapseThirtyFive">

                              How do I change a memorial's Privacy Settings?

                            </button>

                          </h2>

                          <div id="collapseThirtyFive" class="accordion-collapse collapse"
                            aria-labelledby="headingThirtyFive" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <ol>

                                <li>Login to your account & click on <strong>Memorials</strong> in the top menu bar</li>

                                <li>Choose the profile you would like to manage</li>

                                <li>

                                  Click <strong>Edit Profile</strong> </li>

                                <li>

                                  Select the <strong>Settings</strong> Tab </li>

                                <li>

                                  Under 'Who can see this profile' use the dropdown to select the desired privacy
                                  setting. <ul style="list-style:none;">

                                    <li><strong>Public:</strong>&nbsp;Anyone visiting the Keeper site can view the
                                      memorial and send tributes</li>

                                    <li><strong>Family:</strong>&nbsp;

                                      Only Keeper users in your <a title="How do I create a family tree?"
                                        href="https://www.mykeeper.com/faq/#how-do-i-create-a-family-tree">Family
                                        Tree</a> can see the profile when logged in. </li>

                                    <li><strong>Myself:</strong>&nbsp;Only you can see the memorial when you are logged
                                      in.</li>

                                    <li><strong>Password Protected:</strong>&nbsp;Only individuals you have provided the
                                      password to can view and contribute to the page. (Keeper Plus Only)</li>

                                    <li><strong>Private Link:</strong>&nbsp;Only individuals you share the special link
                                      with can view and contribute to the page. Share the profile using the private link
                                      via email, text message or social media. (Keeper Plus Only)</li>

                                  </ul>

                                </li>

                              </ol>

                              <p>

                                <strong>Please note that Google, Bing and other search engines index Keeper’s website
                                  automatically.</strong>

                                <u>Private Keeper memorial pages will still be displayed on search engines.</u> When a
                                guest clicks on a private Keeper memorial page link from a search engine, they will be
                                taken to the Keeper memorial page but will only see the basic public information on the
                                memorial page.

                              </p>

                              <img alt="How do I change a memorial's Privacy settings?"
                                src="/image/how-do-i-change-a-memorial-s-privacy.gif" class="img-responsive" />

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingThirtySix">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseThirtySix" aria-expanded="false"
                              aria-controls="collapseThirtySix">

                              How do I manage my Keeper email notifications?

                            </button>

                          </h2>

                          <div id="collapseThirtySix" class="accordion-collapse collapse"
                            aria-labelledby="headingThirtySix" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <ol>

                                <li>Login to your account</li>

                                <li>

                                  Select <strong>Edit Profile</strong> on your personal profile </li>

                                <li>

                                  Select the <strong>Settings</strong> tab </li>

                                <li>

                                  Under the <strong>Settings</strong> section you have the option turn on or off the
                                  following notifications: <ol style="list-style-type: lower-alpha;">

                                    <li>'Receive emails for each notification’: when selected, you will receive email
                                      notifications when any contributions are made on your profile, or when you have
                                      received a private message. </li>

                                    <li>'Receive updates on Keeper features, and more’: when selected, you will receive
                                      important notifications about new features, community news, and more. </li>

                                  </ol>

                                </li>

                                <li>Check the notifications you wish to turn on. Uncheck the notification you wish to
                                  turn off.</li>

                                <li>

                                  Select <strong>Save Changes</strong> </li>

                              </ol>

                              <p>The steps above should be repeated on the memorial page(s) you are the Keeper of. </p>

                              <img alt="How do I manage my Keeper email notifications?"
                                src="/image/how-do-i-manage-my-keeper-email-notifications.gif" class="img-responsive" />

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingThirtySeven">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseThirtySeven" aria-expanded="false"
                              aria-controls="collapseThirtySeven">

                              How do I remove, delete or deactivate my Keeper account?

                            </button>

                          </h2>

                          <div id="collapseThirtySeven" class="accordion-collapse collapse"
                            aria-labelledby="headingThirtySeven" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <ol>

                                <li>

                                  Before deactivating your account, ensure that you are no longer the Keeper
                                  administrator of any existing memorial(s)* </li>

                                <li>

                                  In order to deactivate your account, navigate to your Keeper profile and click on
                                  <strong>Edit Profile</strong> </li>

                                <li>

                                  Click the <strong>Settings</strong> tab and scroll to the bottom of the page </li>

                                <li>

                                  Click on <strong>Deactivate Your Account</strong> </li>

                              </ol>

                              *Keeper memorials cannot remain online without a Keeper Administrator. Prior to
                              deactivating your own account, you can deactivate the memorials you manage, or assign
                              someone else to be the Keeper of any memorial(s) you have created. <a
                                title="How do I add another Keeper to my loved one's memorial?"
                                href="https://www.mykeeper.com/faq/#how-do-i-add-another-qeepr-to-my-loved-one-memorial">Click
                                here</a> to learn how to assign a new Keeper administrator to a memorial page.

                              <img alt="How do I remove, delete or deactivate my Keeper account?"
                                src="/image/how-do-i-remove-deactivate-account.gif" class="img-responsive" />

                            </div>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>



            <div class=" row pt-4 text-black">

              <div class=" col-md-12 ">

                <div class="p-4 edit-profile-border">

                  <div class="row">

                    <div class="col-md-12 edit-profile-row d-flex justify-content-right align-items-right h-100">

                      <h3 class="pt-3">Keeper Mobile</h3>

                    </div>

                    <div class="hr-div">

                      <hr>

                    </div>

                    <div class="hr-div">



                      <div class="accordion" id="accordionExample">

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingThirtyEight">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseThirtyEight" aria-expanded="false"
                              aria-controls="collapseThirtyEight">

                              What is Keeper Mobile?

                            </button>

                          </h2>

                          <div id="collapseThirtyEight" class="accordion-collapse collapse"
                            aria-labelledby="headingThirtyEight" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              With the <a target="_blank" title="Keeper Mobile App"
                                href="https://play.google.com/store/apps/details?id=com.qeepr.app">Keeper Mobile
                                App</a>, you can view memorials, edit any memorial you manage, view and upload photos,
                              geotag a monument and get accurate GPS directions within a cemetery. Download our free
                              Mobile app on <a target="_blank" title="Keeper Mobile App"
                                href="https://play.google.com/store/apps/details?id=com.qeepr.app">Android</a> or <a
                                target="_blank" title="Keeper Mobile App"
                                href="https://apps.apple.com/ca/app/keeper-memorials/id1068385717">iOS</a>.

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingThirtyNine">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseThirtyNine" aria-expanded="false"
                              aria-controls="collapseThirtyNine">

                              What is a geotag?

                            </button>

                          </h2>

                          <div id="collapseThirtyNine" class="accordion-collapse collapse"
                            aria-labelledby="headingThirtyNine" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              Geotagging is the process of adding geographical identification to a place or object. When
                              you geotag a monument in a cemetery using the Keeper Mobile App, it will save the
                              monuments' exact longitudinal and latitudinal coordinates. This will allow visitors to be
                              walked directly to the monument using Google Maps, which is built into the Mobile App.
                              Download our free Mobile app on <a target="_blank" title="Keeper Mobile App"
                                href="https://play.google.com/store/apps/details?id=com.qeepr.app">Android</a> or <a
                                target="_blank" title="Keeper Mobile App"
                                href="https://apps.apple.com/ca/app/keeper-memorials/id1068385717">iOS</a>.

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingForty">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseForty" aria-expanded="false" aria-controls="collapseForty">

                              How do I geotag or add the location of my loved one monument?

                            </button>

                          </h2>

                          <div id="collapseForty" class="accordion-collapse collapse" aria-labelledby="headingForty"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              When visiting a loved one at a cemetery, you can easily add a location by geotagging their
                              monument with the <a target="_blank" title="Keeper Mobile App"
                                href="https://play.google.com/store/apps/details?id=com.qeepr.app">Keeper Mobile
                                App</a>.

                              <ol>

                                <li>Open the app on your smartphone and search for your loved one's memorial</li>

                                <li>Stand as close to the monument as possible</li>

                                <li>

                                  Click the <strong>Geotag</strong> button and wait for the confirmation message </li>

                                <li>

                                  Allow others to get instant directions every time they visit by clicking
                                  <strong>Directions</strong> </li>

                              </ol>

                              <div>

                                Download our free Mobile app on <a target="_blank" title="Keeper Mobile App"
                                  href="https://play.google.com/store/apps/details?id=com.qeepr.app">Android</a> or <a
                                  target="_blank" title="Keeper Mobile App"
                                  href="https://apps.apple.com/ca/app/keeper-memorials/id1068385717">iOS</a>.

                              </div>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFortyOne">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFortyOne" aria-expanded="false" aria-controls="collapseFortyOne">

                              Can I set a monument location without a smartphone?

                            </button>

                          </h2>

                          <div id="collapseFortyOne" class="accordion-collapse collapse"
                            aria-labelledby="headingFortyOne" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <ol>

                                <li>Access MyKeeper.com on your Desktop</li>

                                <li>Navigate to the memorial you wish to set a location for</li>

                                <li>

                                  Click <strong>Edit Profile</strong> and navigate to the <strong>Memorial</strong>
                                  section </li>

                                <li>

                                  Add the name, location and plot number of the cemetery in the
                                  <strong>Locations</strong> field </li>

                              </ol>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFortyTwo">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFortyTwo" aria-expanded="false" aria-controls="collapseFortyTwo">

                              How do I get directions to a monument in a cemetery?

                            </button>

                          </h2>

                          <div id="collapseFortyTwo" class="accordion-collapse collapse"
                            aria-labelledby="headingFortyTwo" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <a title="How do I geotag or add the location of my loved one's monument?"
                                href="https://www.mykeeper.com/faq/#how-do-i-geotag-or-add-the-location-of-my-loved-one-monument">Once
                                a monument has been geotagged</a>, anyone with the <a target="_blank"
                                title="Keeper Mobile App"
                                href="https://play.google.com/store/apps/details?id=com.qeepr.app">Keeper Mobile App</a>
                              can be directed to the monument.

                              <ol>

                                <li>Search for the memorial on the app</li>

                                <li>Press the Directions button </li>

                                <li>Google Maps will open up and provide exact directions. </li>

                              </ol>

                              <div>

                                Download our free Mobile app on <a target="_blank" title="Keeper Mobile App"
                                  href="https://play.google.com/store/apps/details?id=com.qeepr.app">Android</a> or <a
                                  target="_blank" title="Keeper Mobile App"
                                  href="https://apps.apple.com/ca/app/keeper-memorials/id1068385717">iOS</a>.

                              </div>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFortyThree">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFortyThree" aria-expanded="false"
                              aria-controls="collapseFortyThree">

                              What is the scan feature?

                            </button>

                          </h2>

                          <div id="collapseFortyThree" class="accordion-collapse collapse"
                            aria-labelledby="headingFortyThree" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              The scan feature allows you to quickly see a profile by scanning a Keeper Code. Keeper
                              Codes are QR codes that can be affixed to any monument in a cemetery. To scan, click on
                              the Scan button on Keeper Mobile, and follow the instructions! You will be instantly
                              directed to the memorial linked to the code.

                            </div>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>



            <div class=" row pt-4 text-black">

              <div class=" col-md-12 ">

                <div class="p-4 edit-profile-border">

                  <div class="row">

                    <div class="col-md-12 edit-profile-row d-flex justify-content-right align-items-right h-100">

                      <h3 class="pt-3">Virtual & Hybrid Funeral Services</h3>

                    </div>

                    <div class="hr-div">

                      <hr>

                    </div>

                    <div class="hr-div">



                      <div class="accordion" id="accordionExample">

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFortyFour">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFortyFour" aria-expanded="false"
                              aria-controls="collapseFortyFour">

                              What is a virtual funeral service?

                            </button>

                          </h2>

                          <div id="collapseFortyFour" class="accordion-collapse collapse"
                            aria-labelledby="headingFortyFour" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <p>A virtual funeral or virtual memorial with Keeper is like an in-person one but it’s
                                conducted online with family and friends participating virtually via video conference.
                                Keeper works with families to personalize each service so that their memorial is unique
                                and meaningful.</p>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFortyFive">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFortyFive" aria-expanded="false"
                              aria-controls="collapseFortyFive">

                              What is a hybrid funeral service?

                            </button>

                          </h2>

                          <div id="collapseFortyFive" class="accordion-collapse collapse"
                            aria-labelledby="headingFortyFive" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <p>A hybrid funeral combines a virtual memorial with an in-person gathering so that family
                                and friends who are unable to attend in person can still meaningfully participate in the
                                memorial service. We also offer livestream only funeral services.</p>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFortySix">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFortySix" aria-expanded="false" aria-controls="collapseFortySix">

                              What is a livestreamed funeral service?

                            </button>

                          </h2>

                          <div id="collapseFortySix" class="accordion-collapse collapse"
                            aria-labelledby="headingFortySix" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <p>A livestreamed funeral or memorial service is for families who wish to have their
                                in-person service virtually broadcast live to those unable to attend in person. Unlike a
                                Virtual or Hybrid funeral service, virtual guests attending a livestream do not speak or
                                make presentations during the event.</p>

                              <p>Keeper is happy to assist in the facilitation of a livestream funeral or memorial
                                service. </p>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFortySeven">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFortySeven" aria-expanded="false"
                              aria-controls="collapseFortySeven">

                              What is included with a virtual or hybrid funeral service?

                            </button>

                          </h2>

                          <div id="collapseFortySeven" class="accordion-collapse collapse"
                            aria-labelledby="headingFortySeven" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <p>A Keeper facilitator becomes your concierge who will be there with you every step of
                                the way--from finding the right words to say and hosting the video conference, to online
                                event page creation, sending invitations, guest list management, and much more. Our
                                virtual & hybrid funeral services include eulogies, image slideshows, videos, and
                                recitations of poetry, religious texts, or other passages. The service can also include
                                a hands-on legacy activity such as gardening, cooking, or meditation.</p>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFortyEight">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFortyEight" aria-expanded="false"
                              aria-controls="collapseFortyEight">

                              What is a hands-on legacy activity?

                            </button>

                          </h2>

                          <div id="collapseFortyEight" class="accordion-collapse collapse"
                            aria-labelledby="headingFortyEight" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <p>Your funeral service facilitator will collaborate with you to create a personalized
                                legacy project or activity for you and your participants during the virtual or hybrid
                                funeral service. Legacy activities honor your loved one by participating in an activity
                                that is reflective of them. It can be active, collaborative, quiet, or reflective - you
                                decide! Some examples include gardening, yoga, meditation, cooking, and art.</p>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFortyNine">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFortyNine" aria-expanded="false"
                              aria-controls="collapseFortyNine">

                              Are any of these services included when I sign up and create an online memorial?

                            </button>

                          </h2>

                          <div id="collapseFortyNine" class="accordion-collapse collapse"
                            aria-labelledby="headingFortyNine" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <p>Our funeral service facilitation is for families who would like a virtual or hybrid
                                funeral service to be created, planned, and conducted for them.</p>

                              <p>Families who are holding an in-person event and wish to have the event livestreamed to
                                virtual guests should inquire about our Livestream only service. Families who feel
                                comfortable creating and conducting an online memorial or funeral service themselves may
                                do so using Keeper’s Event Pages and live streaming functionality. <a target="_blank"
                                  href="https://video-mykeeper.s3.us-east-2.amazonaws.com/mykeeper-video/homepage.mp4">Click
                                  here to learn more</a></p>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFifty">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFifty" aria-expanded="false" aria-controls="collapseFifty">

                              What equipment is needed for a virtual or hybrid memorial service?

                            </button>

                          </h2>

                          <div id="collapseFifty" class="accordion-collapse collapse" aria-labelledby="headingFifty"
                            data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <ul>

                                <li>Strong on-site WIFI. We recommend a minimum internet speed of 5 Mbps. Faster speeds
                                  will ensure a smoother, stronger connection. <a target="_blank"
                                    href="https://www.speedtest.net/">Click here to run an internet speed test.</a></li>

                                <li>A fairly recent model smartphone, tablet and/or a computer with a webcam</li>

                                <li>A tripod (if using a smartphone or tablet to stream)</li>

                                <li>Optional, but recommended: A television screen, monitor, or projector for in-person
                                  guests</li>

                                <li>Optional, but recommended: External microphone for hybrid memorial services</li>

                              </ul>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFiftyOne">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFiftyOne" aria-expanded="false" aria-controls="collapseFiftyOne">

                              Does Keeper provide on-site staff for a hybrid funeral service?

                            </button>

                          </h2>

                          <div id="collapseFiftyOne" class="accordion-collapse collapse"
                            aria-labelledby="headingFiftyOne" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <p>Our expert facilitators will remotely assist and coordinate with your on-site contact.
                                Hybrid funeral services require a tech savvy family or friend, or venue employee (DJ,
                                technician, etc.) to be present as the on-site contact.</p>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFiftyTwo">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFiftyTwo" aria-expanded="false" aria-controls="collapseFiftyTwo">

                              Does Keeper rent out equipment for memorial services?

                            </button>

                          </h2>

                          <div id="collapseFiftyTwo" class="accordion-collapse collapse"
                            aria-labelledby="headingFiftyTwo" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <p>While Keeper does provide equipment rental services, rest assured that very little
                                equipment is needed to host a hybrid or virtual memorial service. If you are hosting a
                                hybrid or livestreamed event at a venue, the majority of the equipment may already be
                                provided by the venue (or can be rented through them).</p>

                              <p>Some equipment you may consider purchasing*:</p>

                              <ul>

                                <li>Tripod for phone or tablet - <a target="_blank"
                                    href="https://www.amazon.com/UBeesize-Extendable-Bluetooth-Aluminum-Lightweight/dp/B07NWC3L95/ref=sr_1_4?dchild=1&keywords=tripod+for+phone&qid=1626275937&sr=8-4">$24
                                    on Amazon</a></li>

                                <li>External Microphone - <a target="_blank"
                                    href="https://www.amazon.com/Smartphone-Microphone-YouTube-Windscreen-External/dp/B07Z5RY2CX/ref=sr_1_47?crid=1L72QXGUDWSQ0&dchild=1&keywords=external+mic+for+iphone&qid=1626275992&sprefix=external+mic+%2Caps%2C217&sr=8-47">$43
                                    on Amazon</a></li>

                                <li>Battery pack - <a target="_blank"
                                    href="https://www.amazon.com/Portable-Charger-Anker-PowerCore-20100mAh/dp/B00X5RV14Y/ref=sr_1_19?dchild=1&keywords=iphone+battery+pack&qid=1626276731&sr=8-19">$46
                                    on Amazon</a></li>

                                <li>HDMI Cable - <a target="_blank"
                                    href="https://www.amazon.com/PowerBear-Cable-Braided-Nylon-Connectors/dp/B07X37CG9V/ref=sr_1_3?crid=22BPBVKUQI5X7&dchild=1&keywords=hdmi+cable+10ft&qid=1626276788&sprefix=HDMI+ca%2Caps%2C210&sr=8-3">$11
                                    on Amazon</a></li>

                              </ul>

                              <p>*Keeper does not receive commissions for these purchases</p>

                            </div>

                          </div>

                        </div>

                        <div class="accordion-item">

                          <h2 class="accordion-header" id="headingFiftyThree">

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseFiftyThree" aria-expanded="false"
                              aria-controls="collapseFiftyThree">

                              What are the prices of your various virtual funeral service options?

                            </button>

                          </h2>

                          <div id="collapseFiftyThree" class="accordion-collapse collapse"
                            aria-labelledby="headingFiftyThree" data-bs-parent="#accordionExample">

                            <div class="accordion-body">

                              <p><a target="_blank" href="https://www.mykeeper.com/virtual-funeral-services/">Please
                                  click here to view our service options and pricing</a></p>

                            </div>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>



          </div>

        </div>

      </div>

    </div>

  </section>

    <?php
    
        require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';
    
    ?>

</body>

</html>