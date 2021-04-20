<?php require_once("header.php"); 
?>

<body> 
 
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="#intro" class="scrollto"><span>HEMAS BOOKSHOP</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.php" class="logo mr-auto"><img src="images/1.png" alt="" class="img-fluid"></a>-->

      <nav class="main-nav d-none d-lg-block">
        <ul>
          <li class="active"><a href="#intro">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#footer">Contact Us</a>
            
             
          </li>

          <ul id="nav" class="nav nav-pills clearfix right" role="tablist">
              <?php
                if(!isset($_SESSION['session_cus'])){
              ?>
              <li class="dropdown"><a href="#why-us" data-toggle="dropdown">Account</a></li>
              <?php
                }else{
              ?>

              <li class="dropdown"><a href="#why-us" data-toggle="dropdown"><?php echo $_SESSION['session_cus']['cus_name']; ?></a>

                
                  <ul id="products-menu" class="dropdown-menu clearfix" role="menu">
                      <li><a href="cus_profile.php">Profile</a></li>
                      <li><a href="lib/logout.php" id="logout_btn">Logout</a></li>
                      
                  </ul>
              </li>

              <?php
                }
              ?>
            </ul>
          
        </ul>
      </nav><!-- .main-nav-->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="intro" class="clearfix">
      <div class="row justify-content-center align-self-center" >
        <div class="col-md-20 intro-img order-md-last order-first" data-aos="zoom-out" data-aos-delay="200">
          <img src="images/np4.jpg" alt="" class="img-fluid">
      <!--     <div style="padding-left: 40px;">
              <a href="#why-us" class="btn-get-started scrollto" >LOGIN</a>
            </div>
        -->
      </div>
    </div>
  </section>
  <!-- End Hero -->
  <main id="main">

  <!-- ======= AboutUs Section ======= -->
 
  <!-- End AboutUs -->

  <!-- ======= Services Section ======= -->
    <?php
      require("services.php");
    ?>
    <!-- End Services Section -->

    <!-- ======= Why Us Section ======= -->
    <?php 
   if(!isset($_SESSION['session_cus'])){
    require("login.php");}
    ?>
    <!-- End Why Us Section -->

 <?php
   require ("aboutus.php");
   ?>  
    


     <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container" data-aos="zoom-in">

        <header class="section-header">
          <h3>Our Publication Companies</h3> 
        </header>


        <div class="row justify-content-center">
          <div class="col-lg-8">

            <div class="owl-carousel testimonials-carousel">
    
              <div class="testimonial-item">
                <img src="images/np3.jpg" class="testimonial-img" alt="">
                <h3>Lakehouse</h3>
                <p align="justify">
                We are maintaining our business relationship since 10 years ago.Always felt happy to negotaiate with you Hemas Bookshop.Good Luck!
                </p>
              </div>
    
    
              <div class="testimonial-item">
                <img src="images/np7.jpg" class="testimonial-img" alt="">
                <h3>Wijeya Newspapers</h3>
                <p align="justify">
                We are maintaining our business relationship since 10 years ago.Always felt happy to negotaiate with you Hemas Bookshop.Good Luck!
                </p>
              </div>

               <div class="testimonial-item">
                <img src="images/np5.jpg" class="testimonial-img" alt="">
                <h3>Lankadeepa Publications</h3>
                <p align="justify">
                We are maintaining our business relationship since 10 years ago.Always felt happy to negotaiate with you Hemas Bookshop.Good Luck!
                </p>
              </div>
    
             

            </div>

          </div>
        </div>
      </div>
    </section><!-- End Clients Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h3>Our Team</h3>
          <p>To give you a better service..</p>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <img src="images/team-1.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Hemal Fernando</h4>
                  
                 
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="member">
              <img src="images/team-2.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Aseka Hettiarachi</h4>
                  
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              <img src="images/team-3.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>William De Silva</h4>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="member">
              <img src="images/team-4.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Kavindya jayasooriya</h4>>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Team Section -->

  

   
    <!-- ======= F.A.Q Section ======= -->
    <?php require("faq.php");
    ?>
    <!-- End F.A.Q Section -->

  

    <!-- Footer  -->
    <?php require("footer.php");
    ?>

  </main><!-- End #main -->

<!-- corner icon go to the top of the page  --> 
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

 <?php require_once("footerdetails.php");
 ?>
