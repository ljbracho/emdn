<?php
session_start();
$base_url = "http://www.emdnstore.es/";
?>
<!DOCTYPE html>
<html>
<head>
<title>EMDN</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
</style>
<link href="/assets/css/custom.css" rel='stylesheet'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>
<div class='left_ring d-none d-sm-block'>
    <img src='/assets/imgs/Group 1.png' width='100%'>
</div>
<div class='right_ring d-none d-sm-block'>
    <img src='/assets/imgs/Group 2.png' width='100%'>
</div>
<!-- Navigation -->
<div class="fixed-topp">
  <header class="topbar">
      <div class="container">
        <div class="row">
          <!-- social icon-->
          <div class="col-sm-12 p-0">
             <ul class="left_menu">
              <li><i class='fa fa-map-marker'></i> Escola : Mallorca 598 <br>
                  <i class='fa fa-phone  '></i> Tel. 932 456 629 - 608 378 364
              </li>
              <li><i class='fa fa-map-marker'></i> Parvulari : Vidiella, 15-17 <br>
                  <i class='fa fa-phone  '></i> Tel. 932 456 629 - 608 378 364</li>
              <li><i class='fa fa-envelope'></i> emdn@emdn.cat </li>
            </ul>
            <ul class="social-network">
              <li><a class="waves-effect waves-dark" href="https://mobile.twitter.com/Escola_Emdn"><i class="fa fa-twitter"></i></a></li>
              <li><a class="waves-effect waves-dark" href="https://m.facebook.com/EMDNs/"><i class="fa fa-facebook"></i></a></li>
              <li><a class="waves-effect waves-dark" href="https://m.youtube.com/user/videosemdn"><i class="fa fa-youtube"></i></a></li>
              <li><a class="waves-effect waves-dark" href="https://instagram.com/escola_emdn?igshid=e0ax7ssw8vf7"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>

        </div>
      </div>
  </header>
  <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
    <div class="container">
      <a class="navbar-brand" rel="nofollow" href="index.php" style="text-transform: uppercase;color:black"> EMDN</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">

        <ul class="navbar-nav ml-auto">

          <li class="nav-item">
            <a class="nav-link" href="<?php echo $base_url.'index.php';?>"><i class='fa fa-home'></i> Inici
              <span class="sr-only">(current)</span>
            </a>
          </li>

          <!--<li class="nav-item ">-->
          <!--  <a class="nav-link" href="<?php echo $base_url.'aboutus.php';?>"> <i class='fa fa-info-circle'></i> Sobre nosaltres</a>-->
          <!--</li>-->

          <!--<li class="nav-item">-->
          <!--  <a class="nav-link" href="<?php echo $base_url.'contactus.php';?>"> <i class='fa fa-phone'></i> Contacte</a>-->
          <!--</li>-->
          <?php
          
          if(isset($_SESSION['cart'])){
              $item_in_cart = 0;
                 foreach($_SESSION['cart'] as $key=>$arr){
                     $item_in_cart+=count($arr);
                 }
              
          }else{
             $item_in_cart  = 0 ;   
          }
          
          ?>
          <!--<li class="nav-item">-->
          <!--  <a class="nav-link" href="<?php echo $base_url.'checkout.php';?>"><i class='fa fa-shopping-cart'> </i> <span class='item_count'> <?php echo $item_in_cart;?> </span> Llibres </a>-->
          <!--</li>-->
        </ul>
      </div>
    </div>
  </nav>
</div>