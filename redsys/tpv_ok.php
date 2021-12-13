<?php

error_reporting(0);
date_default_timezone_set('Europe/Madrid');

include ('./api.php');
include('../header.php');

session_start();
unset($_SESSION['cart']);

$redsys = new Redsys;
$message = "ERROR AL PROCESAR DATOS, POR FAVOR INTENTE MAS TARDE";

$orderId = isset($_POST["oid"]) ? $_POST["oid"] : $_GET["oid"];
$version = isset($_POST["Ds_SignatureVersion"]) ? $_POST["Ds_SignatureVersion"] : $_GET["Ds_SignatureVersion"];
$params = isset($_POST["Ds_MerchantParameters"]) ? $_POST["Ds_MerchantParameters"] : $_GET["Ds_MerchantParameters"];
$receivedSignature = isset($_POST["Ds_Signature"]) ? $_POST["Ds_Signature"] : $_GET["Ds_Signature"];

$decodec = json_decode($redsys->decodeMerchantParameters($params));

$claveModuloAdmin = $redsysParams['commerce_pass'];
$originalSignature = $redsys->createMerchantSignatureNotif($claveModuloAdmin, $params);

if ($originalSignature === $receivedSignature && $decodec->Ds_Order === $orderId)
{
    include ('../admin/connection.php');
    
    $order = mysqli_query($con, "SELECT `id`, `order_id` FROM `orders_redsys` WHERE `redsys_order` = '$orderId' LIMIT 1");

    if(mysqli_num_rows($order) > 0)
    {
        $order = mysqli_fetch_assoc($order);
        mysqli_query($con, "UPDATE `orders_redsys` SET `approved` = 1 WHERE `id` = " . $order['id']);
        mysqli_query($con, "UPDATE `orders` SET `payment_status` = 'paid' WHERE `id` = " . $order['order_id']);
        $message = "SU PAGO HA SIDO PROCESADO, PEDIDO NRO.: $orderId";
    } else {
        $message = "NO PUDIMOS PROCESAR SU PAGO, POR FAVOR INTENTE MAS TARDE";
    }
} ?>

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
              <b><?php echo $message; ?></b>
            </span>
          </div>
        </div>
      </div>
      <div class="search_result text-center text-white mb-3"></div>
    </div>
  </div>
</div>
<?php  include('../footer.php');?>

