<?php 
    error_reporting(0);
    date_default_timezone_set('Europe/Madrid');
    header('Content-Type: text/html; charset=utf8mb4');
    session_start();
    unset($_SESSION['cart']);
    include('../header.php');
?>
<div class="section">
  <div class="container mt-5 mb-3">
    <div class="col-sm-12 text-center mb-3">
      <img src="/assets/imgs/Logo-EMDN.png" class='logo_web'>
    </div>
    <div class='col-sm-12 mb-3'>
      <div class='search_box text-center'>
        <div class='row'>
          <div class='col pt-2 pb-2'>
            <span>
              <b>SU PAGO HA SIDO RECHAZADO, POR FAVOR INTENTE NUEVAMENTE</b>
            </span>
          </div>
        </div>
      </div>
      <div class="search_result text-center text-white mb-3"></div>
    </div>
  </div>
</div>
<?php  include('../footer.php');?>

