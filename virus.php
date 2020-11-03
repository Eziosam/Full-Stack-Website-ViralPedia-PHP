<?php include 'Database.php'; ?>
<?php include 'fomat.php'; ?>
<?php
 session_start();
 $userLoggedIn = null;
 if(isset($_SESSION['userLoggedIn'])){
    $userLoggedIn = $_SESSION['userLoggedIn'];
    $mail = $_SESSION['usermail'];
  }
  $db = new Database();
  $fm = new Format();

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

    <!-- Google Fonts maxim -->

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


  <!-- Google Fonts  medilab-->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Google Fonts devfolio-->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
   <link href="assets/vendor/aos/aos.css" rel="stylesheet">
     <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">


  <!-- Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


</head>

<body id=page-top>

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
              <a class="nav-link js-scroll " href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll active" href="virus.php">Viruses</a>
            </li>

            <?php

                   if(!strcmp($mail,"admin@gmail.com")){
                          echo '
                    <li class="nav-item">
                      <a class="nav-link js-scroll" href="virusadd.php">Add Virus</a>
                    </li>
                    ';
                 }


            ?>

         
            <li class="nav-item">
              <a class="nav-link js-scroll" href="contact.php">Contact</a>
            </li>

            <li class="nav-item">
              <a class="nav-link js-scroll" href="blog.php">Blog</a>
            </li>

          <?php
            if($userLoggedIn!=null){
                    echo '

                    <li class="nav-item">
                      <a class="nav-link js-scroll" href="blogadd.php">ADD BLogs</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link js-scroll" href="profile.php">Profile</a>
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
            <h2 class="intro-title mb-4">Viruses</h2>
            <ol class="breadcrumb d-flex justify-content-center">
              <li class="breadcrumb-item">
                <a href="index.php">Home</a>
              </li>
              <li class="breadcrumb-item active">Viruses</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  <main id="main">
      <?php
        $per_page = 4 ;
        if(isset($_GET["page"])){
           $page = $_GET["page"];
        }
        else{
          $page=1;
        }

        $start_from =($page-1) * $per_page;

     ?>



    <!-- ======= Virus Details Section ======= -->
    <section class="service-details">
      <div class="container">

        <div class="row">

          <?php
                 $query = "select * from virus order by id desc limit $start_from,$per_page";
                 $post = $db->select($query);
                 if($post){

                  while($result = $post->fetch_assoc()){

          ?>
          <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
            <div class="card">
              <div class="card-img">
                <img src="upload/virus/<?php echo $result['image']; ?>" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title"><a href="#"><?php echo $result['name']; ?></a></h5>
                <p class="card-text"><?php echo $fm->textShorten($result['body'],200); ?></p>
                <div class="read-more"><a href="blog-details.php?id= <?php echo $result['id'];?>"><i class="icofont-arrow-right"></i> Read More</a></div>
              </div>
            </div>
          </div>
             <?php } ?>

        </div>
   
      </div>

    </section><!-- End Service Details Section -->
    



   
             <!-- pagination -->


             <div class="row">
              <div class="col-lg-12">
                  <nav class="blog-pagination justify-content-center d-flex">
                      <ul class="pagination">

                            <?php
                              $query = "select * from virus";
                              $result =  $db->select($query);
                              $total_rows = mysqli_num_rows($result);
                              $total_pages = ceil($total_rows/$per_page); ?>
                          <!-- first page -->

                          <li class="page-item active">
                              <?php
                              echo "
                              <a href='virus.php?page=1' class='page-link' aria-label='First'>
                                  <span aria-hidden='true'>
                                      <span class='fa fa-arrow-left'> First</span>
                                  </span>
                              </a>"; ?>
                          </li>
                          <!-- all  page -->
                          <?php
                          for($i=1; $i < $total_pages;$i++){

                           echo "<li class='page-item'><a href=' virus.php?page=".$i." ' class='page-link' > ".($i+1)."</a></li>";

                          };
                          ?>

                          <!-- last page -->

                          <li class="page-item active">
                           <?php
                           echo"
                              <a href='virus.php?page=$total_pages' class='page-link' aria-label='Last'>".

                                      "<i class='fa fa-arrow-right' aria-hidden='true'> Last</i>".

                              "</a>."; ?>
                          </li>
                      </ul>
                  </nav>
              </div>
            </div>
                     <?php } ?>
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
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
