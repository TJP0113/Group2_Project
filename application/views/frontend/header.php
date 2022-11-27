
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Group 2 Restaurant</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  

  <!-- Favicons -->
  <link href="<?= base_url('assets/img/favicon.png" rel="icon') ?>">
  <link href="<?= base_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=base_url('assets/vendor/animate.css/animate.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/vendor/aos/aos.css" rel="stylesheet')?>">
  <link href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/vendor/boxicons/css/boxicons.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/vendor/glightbox/css/glightbox.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/vendor/swiper/swiper-bundle.min.css')?>" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/css/style.css" rel="stylesheet') ?>">

  <!-- =======================================================
  * Template Name: Restaurantly - v3.8.0
  * Template URL: https://bootstrapmade.com/restaurantly-restaurant-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-center justify-content-md-between">

      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-phone d-flex align-items-center"><span>+6012-345 6789</span></i>
        <i class="bi bi-clock d-flex align-items-center ms-4"><span> Mon-Sat: 11AM - 23PM</span></i>
      </div>

      <div class="languages d-none d-md-flex align-items-center">
        <?php
        if(!empty($_SESSION['member_id'])){
        ?>
        <span class="badge rounded-pill bg-light text-dark">Hi , <?=$_SESSION['member_name']?></span>
        <?php
          }
        ?>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-cente">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="index.html">Group 2 Restaurant</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="<?=base_url('index')?>">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#menu">Menu</a></li>
          <li><a class="nav-link scrollto" href="#specials">Specials</a></li>
          <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
          <li><a class="nav-link scrollto" href="#chefs">Chefs</a></li>
          
          <li class="dropdown"><a href="#"><span>More Action</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <?php
                if(empty($_SESSION['member_id'])){
              ?>
              <li><a href="<?=base_url('login')?>">Login</a></li>
              <li><a href="<?=base_url('signup')?>">Sign Up</a></li>

              <?php
                }else{
              ?>
              <li><a href="<?=base_url('logout')?>">Logout</a></li>
              
              <li><a href="<?=base_url('member_portal')?>">Member Details </a></li>

              <?php
                }
              ?>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <a class="book-a-table-btn scrollto d-none d-lg-flex dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" >Cart</a>
      <div class="dropdown-menu p-4 text-muted" style="max-width: 300px;" aria-labelledby="dropdownMenuButton">
        <ol class="list-group list-group-numbered">
          <?php
          if(!empty($cart)){
            foreach($cart as $k => $c){

          
          ?>
          <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
              <div class="fw-bold"><?=$c['menu_title']?></div>
              <?=$c['menu_price']?> x <?=$c['quantity']?>
            </div>
            
          </li>
          
          <?php
          }
          ?>
          <div>
            <table class="table table-border">
              <tr>
                <th>Total Amount:</th>
                <th>$<?=$final_amount?></th>
              </tr>
            </table>
          </div>
          <div class="row">
            <div class="col"><a href="checkout" class="btn btn-success">Check Out</a></div>
            
          </div>
          <?php
            }else{
          ?>
          <li class="list-group-item d-flex justify-content-between align-items-start">
            NOTHING IN YOUR CART
          </li>
          <?php
          }
          ?>
        </ol>
      </div>

    </div>
  </header><!-- End Header -->

  