<?php

session_start();
date_default_timezone_set('Europe/Madrid');

include ('admin/connection.php');
include ('redsys/api.php');

if (isset($_POST['place_order']))
{
    $stdname = $_POST['stdname'];
    $dni = $_POST['dni'];
    //$curs = $_POST['curs'];
    $fthername = $_POST['nom'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $total_price = $_POST['total_price'];
    //$stdname = $_POST['stdname'];
    $payment_method = 'Direct Bank'; //$_POST['stdname'];
    
    $_SESSION['stdname'] = $stdname;
    $_SESSION['order_email'] = $email;
    $_SESSION['dni'] = $dni;
    $_SESSION['fathername'] = $fthername;

    $course = $_SESSION['course_name'];
    $date = date('Y-m-d h:i:s');

    $query_insert = "INSERT INTO `orders` (`total_price`,`date_time`,`name_std`, `name_fth`, `id_card`, `email`, `course`, `contact_number`, `payment_method`) VALUES ('$total_price','$date','$stdname', '$fthername', '$dni', '$email', '$course', '$phone', '$payment_method');";

    if (mysqli_query($con, $query_insert))
    {
        $orderid = mysqli_insert_id($con);
        $_SESSION['order_id'] = $orderid;

        foreach ($_SESSION['cart'] as $key => $cart)
        {
            foreach ($cart as $item)
            {
                $qty = $item['quantity'];
                $book_id = $item['book_id'];
                $query_detail = "INSERT INTO `order_details` (`product_id`, `order_id`, `count`) VALUES ('$book_id','$orderid', '$qty');";
                mysqli_query($con, $query_detail);
            }
        }

        $query_transaction = mysqli_query($con, "INSERT INTO `transection_history` ( `order_id`, `total_price`, `payment_method`, `payment_status`, `token`) VALUES ('$orderid', '$total_price', 'Direct Bank', 'pending','');");

        $redsys = preparePOS($total_price, $redsysParams);

        $query_transaction = mysqli_query($con, "INSERT INTO `orders_redsys` (`redsys_order`, `order_id`, `approved`) VALUES ('$redsys->order', '$orderid', 0);");

        ?>
            <form action='<?php echo $redsys->url; ?>' method='post' id='payment'>
                <input type="hidden" name="Ds_SignatureVersion" value="HMAC_SHA256_V1"/>
                <input type='text' name='Ds_MerchantParameters' value='<?php echo $redsys->params; ?>' />
                <input type='text' name='Ds_Signature' value='<?php echo $redsys->signature; ?>' />
                <button type="submit" >DALE</button>
            </form>
            <script type="text/javascript">
                document.getElementById('payment').submit();
            </script>
        <?php
    }
    else
    {
        $_SESSION['order_success'] = 'no';
        echo "Order Not Placed" . mysqli_error($con);
        header('location: index.php');

    }
}
else
{
    header('location: index.php');
}

function preparePOS($price, $params)
{
    $order = date('ymdis').str_pad (substr(rand(1, 99), 0, 2), 2, '0', STR_PAD_LEFT);
    $url_params = 'oid='.$order;

    //$url_pos = 'https://sis.redsys.es/sis/realizarPago'; // PROD
    $url_pos = 'https://sis-t.redsys.es:25443/sis/realizarPago'; // TEST
    $url_ok = 'https://botiga.emdn.cat/redsys/tpv_ok.php?'.$url_params;
    $url_ko = 'https://botiga.emdn.cat/redsys/tpv_ko.php?'.$url_params;
    $url_noti = 'https://botiga.emdn.cat/redsys/tpv_noti.php?'.$url_params;
    
    $payment_description = "Compra EMDN";
    $amount = floatval($price) * 100;
    
    $pos = new Redsys;
    
    $pos->setParameter("DS_MERCHANT_AMOUNT", str_replace(",", ".", $amount));
    $pos->setParameter("DS_MERCHANT_ORDER", $order);
    $pos->setParameter("DS_MERCHANT_MERCHANTCODE", $params['commerce_code']);
    $pos->setParameter("DS_MERCHANT_CURRENCY", $params['currency']);
    $pos->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $params['transaction_type']);
    $pos->setParameter("DS_MERCHANT_TERMINAL", $params['terminal']);
    $pos->setParameter("DS_MERCHANT_MERCHANTURL", $url_noti);
    $pos->setParameter("DS_MERCHANT_URLOK", $url_ok);
    $pos->setParameter("DS_MERCHANT_URLKO", $url_ko);
    $pos->setParameter("DS_MERCHANT_PRODUCTDESCRIPTION", $payment_description);
    $pos->setParameter("DS_MERCHANT_TITULAR", $params['commerce_name']);

    $redsys = new stdClass();

    $redsys->url = $url_pos;
    $redsys->order = $order;
    $redsys->params = $pos->createMerchantParameters();
    $redsys->signature = $pos->createMerchantSignature($params['commerce_pass']);

    return $redsys;
}