  <!-- Left side column. contains the logo and sidebar -->
  <?php 
        include './connection.php';
        $query ="select * from `products`";
    	$query_result = mysqli_query($con,$query);
    	$count_products = mysqli_num_rows($query_result);
	
	   $query ="select * from orders where order_status = 'pending' AND payment_status = 'paid'";
	   $query_result = mysqli_query($con,$query);
	   $count_pending_order = mysqli_num_rows($query_result);
	   
	   $query ="select sum(total_price) as total_bill from transection_history where payment_status = 'paid'";
	   $query_result = mysqli_query($con,$query);
	   $count_com_order = mysqli_fetch_assoc($query_result);
	   
	   
    
    $query ="select * from courses";
	$query_result = mysqli_query($con,$query);
	$courses = mysqli_num_rows($query_result);
	
?>
<section class="content">
	<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Llibres</span>
              <span class="info-box-number"><?php echo $count_products;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-tag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Cursos</span>
              <span class="info-box-number"><?php echo $courses;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-cart-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Comandes</span>
              <span class="info-box-number"><?php echo $count_pending_order;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Factures</span>
              <span class="info-box-number"><?php echo "<b> € </b>".round($count_com_order['total_bill'],2);?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
	  
	 <!-- <div class='row'>
		<div class="col-md-12">
          <div class="box box-solid" style='background:#E2D8D1'>
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>

              <h3 class="box-title">Block Quote</h3>
            </div>
            <!-- /.box-header --
            <div class="box-body">
              <blockquote>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
              </blockquote>
            </div>
            <!-- /.box-body --
          </div>
          <!-- /.box --
        </div>
	  
	  </div>-->
</section>