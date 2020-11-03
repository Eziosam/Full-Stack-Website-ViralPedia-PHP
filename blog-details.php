<?php include 'Database.php'; ?>
<?php include 'fomat.php'; ?>

<?php
  $db = new Database();
  $fm = new Format();
 session_start();
 $userLoggedIn = null;
 if(isset($_SESSION['userLoggedIn'])){
    $userLoggedIn = $_SESSION['userLoggedIn'];
  }
?>


<?php
  if(!isset($_GET['id']) || $_GET['id']==NULL){
    header("Location: blog.php");

  }
  else{
    $id = $_GET['id'];
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Viralpedia :Virus Details</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href='https://fonts.googleapis.com/css?family=Orienta' rel='stylesheet'>
  <style>
   body {
    font-family: 'Orienta';font-size: 22px;
   }
  </style>

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
  p {
    font-family: 'Orienta';font-size: 22px;
  }
  </style>



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
              <a class="nav-link js-scroll active" href="virus.php">Viruses</a>
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
          <h2 class="intro-title mb-4">Virus Details</h2>
          <ol class="breadcrumb d-flex justify-content-center">
            <li class="breadcrumb-item">
              <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="virus.php">Viruses</a>
            </li>
            <li class="breadcrumb-item active">Virus Details</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <main id="main">

    <!-- ======= Virus Details Section ======= -->
    <section class="portfolio-details">
      <div class="container">

           <?php
               $sql= "select * from virus where id= $id";
               $post = $db->select($sql);

               if($post){

                while($result = $post->fetch_assoc()){

                ?>  

        <div class="portfolio-details-container">

          <div class="owl-carousel portfolio-details-carousel">
            <img src="upload/virus/<?php echo $result['image'];?>" class="img-fluid" alt="">
            <img src="assets/img/blog-details-1.jpg" class="img-fluid" alt="">
            <img src="assets/img/blog-details-2.jpg" class="img-fluid" alt="">
          </div>

          <div class="portfolio-info">
            <h3><?php echo $result['name'];?> </h3>
            <ul>
              <li><strong>Category</strong>: <?php echo $result['category'];?></li>
              <li><strong>Family</strong>: <?php echo $result['family'];?></li>
              <li><strong>Vaccine status</strong>: <?php echo $result['vaccine'];?></li>
            </ul>
          </div>

        </div>

        <div class="portfolio-description">
          <h2><?php echo $result['name'];?></h2>
          <p>
            <?php echo $result['body'];?>
          </p>
        </div>

               <?php } } ?>
      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

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

</body>

</html>
