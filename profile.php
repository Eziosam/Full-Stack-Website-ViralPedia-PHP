<?php
   session_start();
  include("connnect.php");
  include("user.php");
  include 'Database.php';

  $user = new user();
  include("loginhandle.php");

   $db = new Database();


 $userLoggedIn = null;
 if(isset($_SESSION['userLoggedIn'])){
    $userLoggedIn = $_SESSION['userLoggedIn'];
    $mail = $_SESSION['usermail'];
  }

?>





<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Viralpedia</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/profile.css" rel="stylesheet">

  <link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
  <style>
   p {
    font-family: 'Aclonica';
  </style>

</head>

<body id="page-top">


    <!-- ======= Header/ Navbar ======= -->
    <nav class="navbar navbar-b navbar-trans navbar-expand-md fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll" href="#page-top">ViralPedia</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <div class="navbar-collapse collapse justify-content-end" id="navbarDefault">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link js-scroll" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll" href="virus.php">Viruses</a>
            </li>

            <li class="nav-item">
              <a class="nav-link js-scroll" href="blog.php">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll" href="contact.php">Contact</a>
            </li>

          <?php
            if($userLoggedIn!=null){
                    echo '
                    <li class="nav-item">
                      <a class="nav-link js-scroll" href="profile.php">Profile</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link js-scroll" href="blogadd.php">ADD BLogs</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link js-scroll" href="logout.php">Logout</a>
                    </li>
                    ';
            }
            else{
                 echo'
                <li class="nav-item">
                  <a class="nav-link js-scroll" href="login.php">Login</a>
                </li>
               ';
           }
           ?>
          </ul>
        </div>
      </div>
    </nav>
    <div class="intro intro-single route bg-image" style="background-image: url(assets/img/overlay-bg.jpg)">
      <div class="overlay-mf"></div>
      <div class="intro-content display-table">
        <div class="table-cell">
          <div class="container">
            <h2 class="intro-title mb-4">Profile</h2>
            <ol class="breadcrumb d-flex justify-content-center">
              <li class="breadcrumb-item">
                <a href="index.php">Home</a>
              </li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

           <?php

                  $relsql= "select * from users where usermail = '$mail'";
                  $relpost = $db->select($relsql);

                  if($relpost){

                  while($relresult = $relpost->fetch_assoc()){

                  ?>

<div class="center" style="background-image: url(assets/img/cool-background.png)">
  <div class="property-card" >
    <a href="profile.php">
      <div class="property-image" style="background-image: url(upload/profile/<?php  echo $relresult['image'];?>)">
        <div class="property-image-title">
          <!-- Optional <h5>Card Title</h5> If you want it, turn on the CSS also. -->
            <a href="profileedit.php">
           <span aria-hidden='true'>
                         <span class='fa fa-pencil-square-o'> Edit</span>
            </span>
         </a>

        </div>
      </div></a>
    <div class="property-description" >

     
                     <h5>   <?php  echo $relresult['username'];?></h5>
                    <br>
                    <p>Email : <?php  echo $mail;  ?></p>
                    <p>Phone : <?php  echo $relresult['userphone'];?> </p>
                    <p>Address : <?php  echo $relresult['useraddress'];?> </p>
                    <p>Bio:  <?php  echo $relresult['bio'];?> </p>

       <?php } } else{} ?>
    </div>

  </div>
</div>



    <!-- ======= Footer ======= -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="copyright-box">
            <p class="copyright">&copy; Copyright <strong>ViralPedia</strong>. All Rights Reserved</p>
            <div class="credits">

              Designed by Samir & Riyad</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/jquery.counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/typed.js/typed.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/scrollax.min.js"></script>

  <script src="js/main.js"></script>


</body>

</html>
