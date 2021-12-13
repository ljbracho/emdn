<?php
session_start();
include('connection.php');
$msg="";
if(isset($_POST['login'])){
	$username = $_POST['email'];
	$pass =$_POST['pass'];
	$q = "SELECT * FROM super_admin where admin_email='$username' AND password='$pass'";
	$run = mysqli_query($con,$q);
	$rows = mysqli_num_rows($run);
	if($rows > 0){
		$resturant_data = mysqli_fetch_assoc($run);
		$_SESSION['logged_superadmin'] = "yes";
		$_SESSION['username'] = $resturant_data['username'];
		$_SESSION['userid'] = $resturant_data['id'];
		header('location: main-content.php');
	}else{
		$msg="Invalid User!";
	}
}

?>
<!DOCTYPE html>
<html>
<head><meta charset="gb18030">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin -  EMDN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="dist/css/square/blue.css">
	<style>
	#loginForm .form-control{
		background:white;
		color:black;
	}
	</style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background:url('dist/img/pexels-andrea-piacquadio-3755707.png');margin:2%;background-position: center;background-size: cover;background-repeat: no-repeat;">
    <div class='main_cont' style="border:3px solid white;">
<div class="login-box" style='margin:10% auto;'>
  <div class="login-logo">
    <img src='dist/img/Logo-EMDN-4.png'><br>
    <a href="login.php" style="font-size: 48px;color: #645755;"><b>Administración</b></a><br>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicia sesión para comenzar tu sesión</p>

    <form action="" id='loginForm' method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" required name='email' placeholder="Email">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" required name='pass' placeholder="Contrasena">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
            <p style="color:white"><?php echo $msg ?></p>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name='login' class="btn btn-primary btn-block btn-flat" style="background:#e5004b;border: 2px solid white;">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- /.social-auth-links -->



  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</div>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="dist/js/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
