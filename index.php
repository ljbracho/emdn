<?php 
error_reporting(0);
date_default_timezone_set('Europe/Madrid');
header('Content-Type: text/html; charset=utf8mb4');

session_start();
unset($_SESSION['cart']);
include('header.php');
include('admin/connection.php');
$sql = "select * from config_messages where tipo=2";
$results = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($results);
if ($data['estatus'] == 1) {
    $msg = $data["message"];
    ?>
<center><img src="https://emdn.cat/wp-content/uploads/2019/12/Logo-EMDN.png"></center>
<div style="opacity: 0.7; background: white">
    <table border=3 bordercolor="orange" cellpadding=14 CELLSPACING=10 align="center"> 
    <tr>
    <td>
    <center>
        <?= utf8_decode($msg) ?>

    </center>
    </td>
    </tr>
    </table>
</div>
    <?php
} else {

$course_message = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `messages`  where course_id = '0' "));

?>
<div class="section">
    <div class="container mt-5 mb-3">
        <div class="col-sm-12 text-center mb-3">
            <img src="assets/imgs/Logo-EMDN.png" class='logo_web'>
            
        </div>
        <!--<div class='text-slides mb-3'>
            <div class="slideshow-container">

            <div class="mySlides">
              <?php echo $course_message['message_content'];?>
            </div>
            
            <!--<div class="mySlides">-->
            <!--  <q>L’educació és l’arma més poderosa per canviar el món. .</q>-->
            <!--  <p class="author">- Nelson Mandela</p>-->
            <!--</div>-->
            
            <!--<div class="mySlides">-->
            <!--  <q>Si li dónes peix a un home famolenc , el nodreixes durant una jornada. Si li ensenyes a pescar, el nodriràs per tota la vida.</q>-->
            <!--  <p class="author">- Lao-Tsé</p>-->
            <!--</div>--
        
            </div>
            
            <div class="dot-container">
              <span class="dot" onclick="currentSlide(1)"></span> 
              <!--<span class="dot" onclick="currentSlide(2)"></span> -->
              <!--<span class="dot" onclick="currentSlide(3)"></span> --
            </div>
        </div>-->
        
        <div class='col-sm-12 mb-3'>
            <div class='search_box text-center'>
                <div class='row'>
                <div class='col-sm-2 pt-2'>    
                <span><b>BUSCA PER</b>  </span>
                </div>
                <div class='col-sm-4' id='etapa_box'> 
                <form action='cart.php' id='form_book' method='get'>
                <select class='etapa form-control' name='etapa' >
                    <option value="0" selected disabled>Etapa</option>
                    <?php 
                      $categories =  mysqli_query($con,"SELECT * FROM `categorias` order by id asc");
                      while($cat =  mysqli_fetch_assoc($categories)){
                      ?>
                      <option value="<?php echo $cat['id'];?>"> <?php echo $cat['cat_name'] ?></option>
                      <?php } ?>
                </select>
                </div>
                <div class='col-sm-4' id='courses_box'> 
                <select class='course form-control' id='course_id' name='course'>
                    <option value="0" selected disabled >Curs</option>
                </select>
                </div>
                <div class='col-sm-3' id='modality_box' style='display:none'> 
                <select class="form-control  modality" id="modality" name="modality">
						
					</select>
                </div>
                <div class='col-sm-1'> 
                <span>
                    <img src='assets/imgs/search.png' class='search_book' width='40px' style='cursor:pointer'>
                </span>
                </div>
                </div>
                <p class='error_label' style='display:none;margin:0px'></p>
                </form>
            </div>
            <div class="search_result text-center text-white mb-3">
                
            </div>
        </div>
        
        
        
    </div>
    
    
    
</div>
<?php

 }
if(isset($_SESSION['order_success'])){
    if($_SESSION['order_success'] == 'yes'){
?>
<script>
   swal.fire({
  title: "Gràcies",
  text: "La comanda s´ha tramès amb èxit!",
  icon: "success",
  button: "Aww yiss!",
});
</script>
<?php } unset($_SESSION['order_success']); } ?>
<?php  include('footer.php');?>

