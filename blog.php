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
  <link href="assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">

  <!--  Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/stylemoderna.css" rel="stylesheet">


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
              <a class="nav-link js-scroll active" href="blog.php">Blog</a>
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
            <h2 class="intro-title mb-4">Blogs</h2>
            <ol class="breadcrumb d-flex justify-content-center">
              <li class="breadcrumb-item">
                <a href="index.php">Home</a>
              </li>
              <li class="breadcrumb-item active">Blog</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  <main id="main">

     <?php
        $per_page = 2 ;
        if(isset($_GET["page"])){
           $page = $_GET["page"];
        }
        else{
          $page=1;
        }

        $start_from =($page-1) * $per_page;

     ?>

    <!-- ======= Blog Section ======= -->
    <section class="blog" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
      <div class="container">

        <div class="row">

          <div class="col-lg-8 entries">

                <?php
                 $query = "select * from blog order by id desc limit $start_from,$per_page";
                 $post = $db->select($query);
                 if($post){

                  while($result = $post->fetch_assoc()){

                ?>


            <article class="entry">


              <div class="entry-img">
              	<?php echo'
                <img src=data:image;base64,'.$result['image'].' alt="" class="img-fluid">';

                ?>
              </div>

              <h2 class="entry-title">
                <a href="post.php"> <?php echo $result['title']; ?> </a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.php"><?php echo $result['author'];?> </a></li>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.php"><?php echo $fm->formatDate($result['date']) ; ?></a></li>
                
                </ul>
              </div>

              <div class="entry-content">
                <p>
                  <?php echo $fm->textShorten($result['body'],200); ?>
                </p>
                <div class="read-more">
                  <a href="blog-single.php?id= <?php echo $result['id']; ?>">Read More</a>
                </div>
              </div>

            </article><!-- End blog entry -->

            <?php } ?>





             <!-- pagination -->


             <div class="row">
              <div class="col-lg-12">
                  <nav class="blog-pagination justify-content-center d-flex">
                      <ul class="pagination">

                            <?php
                              $query = "select * from blog";
                              $result =  $db->select($query);
                              $total_rows = mysqli_num_rows($result);
                              $total_pages = ceil($total_rows/$per_page); ?>
                          <!-- first page -->

                          <li class="page-item active">
                              <?php
                              echo "
                              <a href='blog.php?page=1' class='page-link' aria-label='First'>
                                  <span aria-hidden='true'>
                                      <span class='fa fa-arrow-left'> First</span>
                                  </span>
                              </a>"; ?>
                          </li>
                          <!-- all  page -->
                          <?php
                          for($i=1; $i < $total_pages;$i++){

                           echo "<li class='page-item'><a href=' blog.php?page=".$i." ' class='page-link' > ".($i+1)."</a></li>";

                          };
                          ?>

                          <!-- last page -->

                          <li class="page-item active">
                           <?php
                           echo"
                              <a href='blog.php?page=$total_pages' class='page-link' aria-label='Last'>".

                                      "<i class='fa fa-arrow-right' aria-hidden='true'> Last</i>".

                              "</a>."; ?>
                          </li>
                      </ul>
                  </nav>
              </div>
            </div>





    <!-- -->

            <!-- side things -->

            <!-- side things end-->

          </div><!-- End blog entries list -->

          <!--side bar sections start-->

          <div class="col-md-4">
            <div class="widget-sidebar sidebar-search">
              <h5 class="sidebar-title">Search</h5>
              <div class="sidebar-content">
                <form>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for..." aria-label="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary btn-search" type="button">
                        <span class="ion-android-search"></span>
                      </button>
                    </span>
                  </div>
                </form>
              </div>
            </div>
            <div class="widget-sidebar">
              <h5 class="sidebar-title">Recent Post</h5>

              <?php
                 
                  $relsql= "select * from blog order by id desc limit 5 ";
                  $relpost = $db->select($relsql);
 
                  if($relpost){

                  while($relresult = $relpost->fetch_assoc()){

              ?> 
              <div class="sidebar-content">
                <ul class="list-sidebar">
                  <li>
                    <a href="blog-single.php?id= <?php echo $relresult['id']; ?>"><?php echo $fm->textShorten($relresult['title'],80); ?></a>
                  </li>
       
                </ul>
              </div>
                 <?php } } else{} ?>
            </div>



            <?php }
            else{
                     header("Location:404.php");
            }
            ?>
            <div class="widget-sidebar">
              <h5 class="sidebar-title">Archives</h5>
              <div class="sidebar-content">
                <ul class="list-sidebar">
                  <li>
                    <a href="#">September, 2020.</a>
                  </li>
                  <li>
                    <a href="#">August, 2020.</a>
                  </li>
                  <li>
                    <a href="#">July, 2020.</a>
                  </li>
                  <li>
                    <a href="#">June, 2020.</a>
                  </li>
                  <li>
                    <a href="#">May, 2020.</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="widget-sidebar widget-tags">
              <h5 class="sidebar-title">Tags</h5>
              <div class="sidebar-content">
                <ul>
                  <li>
                    <a href="#">Respiratory</a>
                  </li>
                  <li>
                    <a href="#">Gastrointestinal</a>
                  </li>
                  <li>
                    <a href="#">Exanthematous</a>
                  </li>
                  <li>
                    <a href="#">Hepatic</a>
                  </li>
                  <li>
                    <a href="#">Neurologic</a>
                  </li>
                  <li>
                    <a href="#">Hemorrhagic</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- side bar sections end -->
        </div><!-- End .row -->

      </div><!-- End .container -->
    </section><!-- End Blog Section -->
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
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
