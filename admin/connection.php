<?php 
  error_reporting(0);
  if (isset($_POST['server'])) {
        if ($text = fopen('dataConex.php', "w+")) {
          fwrite($text,'<?php'. PHP_EOL);
          fwrite($text,'$server = "'.$_POST['server'].'";'. PHP_EOL);
          fwrite($text,'$user = "'.$_POST['user'].'";'. PHP_EOL);
          fwrite($text,'$clave = "'.$_POST['clave'].'";'. PHP_EOL);
          fclose($text);

          header('location: login.php');
      } else {
        die("<h3>Error Actualizando datos, Contacte al Administrador del sistema</h3>");
      }
  } else {
    include('dataConex.php');
$con = new mysqli($server,$user,$clave,"emdn_store");
  }
// Check connection
if ($con -> connect_errno) {
  ?>
  <h3>Error al Conectar con Base de Datos</h3>
  <p>Validar Datos de Conexion</p>
  <form action="#" method="post">
      <div class="form-group has-feedback"> <b>Servidor: </b>
        <input type="text" class="form-control" required name='server' >
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <br><br>
      <div class="form-group has-feedback"> <b>Usuario</b>
        <input type="text" class="form-control" required name='user' placeholder="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <br><br>
      <div class="form-group has-feedback"> <b>Contrasenya</b>
        <input type="text" class="form-control" name='clave' placeholder="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name='login' class="btn btn-primary" style="background:#e5004b;border: 2px solid white;">Actualizar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  <?php
  die();
}



?>