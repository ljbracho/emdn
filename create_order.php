<?php

session_start();
date_default_timezone_set('Europe/Madrid');

include ('admin/connection.php');
include ('admin/dompdf/autoload.inc.php');
include ('redsys/api.php');
require 'admin/PHPMailer-5.2/PHPMailerAutoload.php';

use Dompdf\Dompdf;

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
        generatePdf($con, $orderid)

        ?>
            <h4>Carregant... Si us plau, espereu.</h4>
            <form action='<?php echo $redsys->url; ?>' method='post' id='payment'>
                <input type="hidden" name="Ds_SignatureVersion" value="HMAC_SHA256_V1"/>
                <input type='hidden' name='Ds_MerchantParameters' value='<?php echo $redsys->params; ?>' />
                <input type='hidden' name='Ds_Signature' value='<?php echo $redsys->signature; ?>' />
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

function generatePdf($con, $orderid)
{
    $iva_four = 0;
    $iva_twenty = 0;

    $order_data = mysqli_fetch_assoc(mysqli_query($con, "select * from orders where id = " . $orderid));
    $order_details = mysqli_query($con, "select * from order_details where order_id = " . $orderid);
    
    while ($single_book = mysqli_fetch_assoc($order_details))
    {
        $books = "select * from products where id = " . $single_book['product_id'];
        $book = mysqli_fetch_assoc(mysqli_query($con, $books));
        $single = str_replace(",", ".", $book['preu_final']);

        $total += $single;
        $iva += $book['iva'];
        
        if ($book['iva'] == '4%') {
            $price_without_iva = $single / 1.04;
            $price_without_iva = cutAfterDot($price_without_iva, 2);
            $iva_four += ($single - $price_without_iva);
        } else {
            $price_without_iva = $single / 1.21;
            $price_without_iva = cutAfterDot($price_without_iva, 2);
            $iva_twenty += ($single - $price_without_iva);
        }

        $total_without_iva += $price_without_iva;
        $books_details .= '<tr style="border: 1px solid #dddddd;text-align: left;">
                <td style="padding: 8px;border:1px solid black">' . $book['book_name'] . '</td>
                <td style="padding: 8px;border:1px solid black;font-size:12px">' . $book['isbn'] . '</td>
                <td style="padding: 8px;border:1px solid black">' . $book['editorial'] . '</td>
                <td style="padding: 8px;border:1px solid black"> € ' . number_format($price_without_iva, 2, ".", '') . '</td>
                <td style="padding: 8px;border:1px solid black;text-align:right"> € ' . number_format($single, 2, ".", '') . '</td>
            </tr>';
    }

    $from = 'Emdn@emdn.cat';
    $fromName = 'EMDN';
    $subject = "Comanda llibres EMDN.";
    $htmlContent = '<html lang="en"><head>
        <title>EMDN Comandes</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        </head>
        <body style="background:white;font-size:11px">
        <div style="margin:0 auto;width:100%;background:white;padding:12px">
            <div style="margin-bottom:12px">
                <a href="http://www.emdnstore.es/" >
                    <img src="http://www.emdnstore.es/assets/imgs/logo.jpg" style="width:170px;height:100px;" alt="">
                </a>
            </div>
            <p style="color:black;"><b>LLIBRES DE TEXT I MATERIAL INDIVIDUAL PER AL CURS ' . date("Y") . "-" . date('Y', strtotime('+1 year')) . '</b></p>
            <div style="border:1px solid black;margin-bottom:10px">
                <div style="width:45%;display:inline-block;border-right:1px solid black;margin-top:10px;padding-left:8px">
                
                    <p style="margin:0px"><b>Factura : </b> <span>' . $orderid . "-Comandes" . '</span></p>
                    <p style="margin:0px"><b>Data factura : </b> <span>' . date("d M Y") . '</span></p>
                    <p style="margin:0px"><b>Raó Social : </b> <span> IPEC S.L. </span></p>
                    <p style="margin:0px"><b>CIF : </b> <span> B-58051889 </span></p>
                    
                </div>
                <div style="width:45%;display:inline-block;margin-top:10px;padding-left:8px">
                    <p style="margin:0px"><b> Nom Alumne/a: </b> ' . $order_data['name_std'] . '</p>
                    <p style="margin:0px"><b>Nom Pare/Mare/Tutor: </b> ' . $order_data['name_fth'] . ' </p>
                    <p style="margin:0px"><b>DNI:  </b> ' . $order_data['id_card'] . ' </p>
                    <p style="margin:0px">&nbsp;</p>
                </div>
            </div>
            <table style="border-collapse: collapse;width: 100%;margin-bottom:12px">
            <tr style="border: 1px solid #dddddd;text-align: left;background: #b3aeae;">
                <th style="padding: 8px;border:1px solid black">DESCRIPCIÓ</th>
                <th style="padding: 8px;border:1px solid black">ISBN/CODI</th>
                <th style="padding: 8px;border:1px solid black">EDITORIAL</th>
                <th style="padding: 8px;border:1px solid black">Preu S/IVA</th>
                <th style="padding: 8px;border:1px solid black">Preu+IVA</th>
            </tr>            
            ' . $books_details . '
            </table>
            <br>
                <div style="width:55%;overflow:hidden;display:inline-block;margin-bottom:12px">
                </div>
                <div style="width:45%;overflow:hidden;display:inline-block;margin-bottom:12px;text-align:right;border: 1px solid black;padding:0px;">
                <table style="width:100%;margin:0px">
                    <tr style="text-align: left;">
                                    
                                        <td colspan="3" style="padding: 8px;border:1px solid black;text-align:right">Total</td>
                                        <td style="padding: 8px;border:1px solid black"> € ' . number_format($total_without_iva, 2, ".", '') . '</td>
                                        <td style="padding: 8px;border:1px solid black"> € ' . number_format($total, 2, ".", '') . '</td>
                    </tr>
                    </table>
                </div>            
            <br>
            <div style="width:48%;overflow:hidden;display:inline-block;margin-bottom:12px">
            </div>
            <div style="width:48%;overflow:hidden;display:inline-block;margin-bottom:12px;text-align:right">
                <div >
                    <p> <b>Base  4% : </b> € ' . number_format($iva_four, 2, ".", '') . '</p>
                    <p> <b>Base  21% :  </b> € ' . number_format($iva_twenty, 2, ".", '') . ' </p>
                </div>
            </div>            
            <div style="width:79%;display:inline-block;margin-bottom:12px;text-align:right">
            <p>
            </div>
            <div style="width:20%;display:inline-block;margin-bottom:12px;text-align:right">
                <div>
                    <p style="border:1px solid black"> <b> Total :  </b>   ' . number_format($total, 2, ".", '') . ' € </p>
                </div>
            </div>
        </div>
        </body>
        </html>';
    
    $query = "select * from config_messages where tipo = 1";
    $query_result = mysqli_query($con, $query);

    $msg = mysqli_fetch_assoc($query_result) ? $row["message"] :
        "<p>La vostra comanda s’ha realitzat correctament, us n’adjuntem la factura.</p><br>
        <p>A principis de setembre rebreu per correu electrònic totes les llicències dels llibres i dossiers digitals.</p>
        <p>Els llibres es lliuraran el primer dia de classe</p>
        <p>Moltes gràcies per confiar, una vegada més, en el projecte de l’escola.</b></p>";

    $filename = "admin/pdfs/" . $orderid . "-EMDN-Factura.pdf";


    @$dompdf = new Dompdf();
    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);
    $dompdf->loadHtml($htmlContent);
    $dompdf->setPaper('A4', 'verti');
    $dompdf->render();
    //$dompdf->stream($filename.".pdf");
    $output = $dompdf->output();
    file_put_contents($filename, $output);
    
			$mail = new PHPMailer;
			
			//$mail->SMTPDebug = 3;
            
			$from = 'Emdn@emdn.cat';
			$fromName = 'EMDN';
			$subject = "Comanda llibres EMDN.";
			
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'bracho.leandro.luz@gmail.com';
			$mail->Password = 'hsegvmgdlclcshts';
			$mail->SMTPSecure = 'ssl';
			$mail->Port = 587;
			
			$mail->setFrom($from, $fromName);
			$mail->addAddress($_SESSION['order_email'], $_SESSION['fathername']);
			$mail->addReplyTo($from, $fromName);
			$mail->addStringAttachment($output,$filename);
			$mail->isHTML(true);
			
			$mail->Subject = $subject;
			$mail->Body    = $msg;
			$mail->AltBody = $msg;
			
			if(!$mail->send()) {
				$response['error'] = true;
				$response['error_msg'] = "error in email";
				print_r(error_get_last());
			} else {
				$response['error'] = false;
				$response['success_msg'] = "Insertado con éxito!";
			}
}

function cutAfterDot($number, $afterDot = 2)
{
    $a = $number * pow(10, $afterDot);
    $b = floor($a);
    $c = pow(10, $afterDot);
    return $b / $c;
}