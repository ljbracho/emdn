<?php
date_default_timezone_set('Europe/Madrid');
require_once 'admin/dompdf/autoload.inc.php';
// Reference the Dompdf namespace
use Dompdf\Dompdf;
session_start();
/// Handle Cancel
include ('admin/connection.php');
// Include autoloader
require_once 'admin/dompdf/autoload.inc.php';

$order_id = $_SESSION['order_id'];

if (isset($_POST['maunal_approve']) && intval($_POST['maunal_approve']) == 1)
{
    $books_details = "";
    $total_without_iva = 0;

    $total = 0;

    $iva_four = 0;
    $iva_twenty = 0;

    $order_id = $_POST['order_id'];
    $to = $_POST['order_email'];

    $from = 'Emdn@emdn.cat';
    $fromName = 'EMDN';
    $rand = $order_id . "EMDN-Comanda";
    $subject = "Comanda llibres EMDN.";
    
    $bookList = $_POST['books'];

    for ($i=0; $i < count($bookList); $i++)
    {
        $single = str_replace(",", ".", $bookList[$i]['preu_final']);
        $total += $single;
        
        if ($bookList[$i]['iva'] == '4%')
        {
            $price_without_iva = $single / 1.04;
            $price_without_iva = cutAfterDot($price_without_iva, 2);
            $iva_four += ($single - $price_without_iva);
        }
        else
        {
            $price_without_iva = $single / 1.21;
            $price_without_iva = cutAfterDot($price_without_iva, 2);
            $iva_twenty += ($single - $price_without_iva);
        }

        $total_without_iva += $price_without_iva;
        $books_details .= '<tr style="border: 1px solid #dddddd;text-align: left;">
                            <td style="padding: 8px;border:1px solid black">' . $bookList[$i]['book_name'] . '</td>
                            <td style="padding: 8px;border:1px solid black;font-size:12px">' . $bookList[$i]['isbn'] . '</td>
                            <td style="padding: 8px;border:1px solid black">' . $bookList[$i]['editorial'] . '</td>
                            <td style="padding: 8px;border:1px solid black"> € ' . number_format($price_without_iva, 2, ".", '') . '</td>
                            <td style="padding: 8px;border:1px solid black;text-align:right"> € ' . number_format($single, 2, ".", '') . '</td>
                            </tr>';

    }

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
                
                    <p style="margin:0px"><b>Factura : </b> <span>' . $order_id . "-Comandes" . '</span></p>
                    <p style="margin:0px"><b>Data factura : </b> <span>' . date("d M Y") . '</span></p>
                    <p style="margin:0px"><b>Raó Social : </b> <span> IPEC S.L. </span></p>
                    <p style="margin:0px"><b>CIF : </b> <span> B-58051889 </span></p>
                    
                </div>
                <div style="width:45%;display:inline-block;margin-top:10px;padding-left:8px">
                    <p style="margin:0px"><b> Nom Alumne/a: </b> ' . $_POST['stdname'] . '</p>
                    <p style="margin:0px"><b>Nom Pare/Mare/Tutor: </b> ' . $_POST['fathername'] . ' </p>
                    <p style="margin:0px"><b>DNI:  </b> ' . $_POST['dni'] . ' </p>
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
            
            </div>
            <div style="width:20%;display:inline-block;margin-bottom:12px;text-align:right">
                <div>
                     <p style="border:1px solid black"> <b> Total :  </b>   ' . number_format($total, 2, ".", '') . ' € </p>
                </div>
             </div>
        
        </div>
        
        </body>
        </html>';

    $mess = '<html lang="en"><head>
          <title>EMDN Comandes</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        </head>
        <body style="background:#F5F5F5;padding:8px;">
        
        
           <p>La vostra comanda s’ha realitzat correctament, us n’adjuntem la factura.</p>
           <p>A principis de setembre rebreu per correu electrònic totes les llicències dels llibres i dossiers digitals.</p>
           <p>Els llibres es lliuraran el primer dia de classe.</p>
           <p>Moltes gràcies per confiar, una vegada més, en el projecte de l’escola.</p>
            
        
        
        </body>
        </html>';

    $filename = $order_id . "-EMDN-Factura";
    $myfile = fopen("invoice_pdfs/" . $filename . ".pdf", "w");

    $dompdf = new Dompdf();
    $options = $dompdf->getOptions();
    $options->set(array(
        'isRemoteEnabled' => true
    ));
    $dompdf->setOptions($options);
    $dompdf->loadHtml($htmlContent);
    $dompdf->setPaper('A4', 'verti');
    $dompdf->render();
    //$dompdf->stream($filename.".pdf");
    $output = $dompdf->output();
    file_put_contents(dirname(__FILE__) . "/invoice_pdfs/" . $filename . '.pdf', $output);

    $file = "invoice_pdfs/" . $filename . '.pdf';

    // Set content-type header for sending HTML email
    // $headers = "MIME-Version: 1.0" . "\r\n";
    $headers = "From: $fromName" . " <" . $from . ">";

    // (B) MAIL HEADERS
    $boundary = md5(time()); // Random boundary
    $mailHead = implode("\r\n", ["MIME-Version: 1.0", "From: $fromName" . " <" . $from . ">", 'Content-Type: multipart/mixed; boundary="' . $boundary . '"']);

    // (C) MAIL MESSAGE
    $mailBody = implode("\r\n", [
    // (C1) THE MESSAGE
    "--$boundary", "Content-type: text/html; charset=utf-8", "", $mess,

    // (C2) ATTACHMENT
    "--$boundary", 'Content-Type: application/octet-stream; name="' . basename($filename . ".pdf") . '"', "Content-Transfer-Encoding: base64", "Content-Disposition: attachment", "", chunk_split(base64_encode(file_get_contents($file))) , "--$boundary--"]);
    $date = date('Y-m-d H:i:s');
    $query = "update orders set date_time='$date', payment_status = 'paid' where id = " . $order_id;
    mysqli_query($con, $query);

    $query = "update transection_history set payment_status = 'paid', pdf_invoice='$file',date_time='$date' where order_id = " . $order_id;
    mysqli_query($con, $query);

    //if(mail($to, $subject, $mailBody, $mailHead)){
    @mail($to, $subject, $mailBody, $mailHead);

    header('Content-type: application/json');
    echo json_encode(["approved" => true]);

    die();
    exit;
}

if (isset($_GET['response']) && is_numeric($_GET['response']) && $_GET['response'] == 0)
{

    $query = "Delete From  transection_history where order_id = " . $order_id;
    mysqli_query($con, $query);
    $query = "Delete From  orders where id = " . $order_id;
    mysqli_query($con, $query);
    $query = "Delete From  order_details where order_id = " . $order_id;
    mysqli_query($con, $query);
    unset($_SESSION['cart']);
    unset($_SESSION['order_id']);
    unset($_SESSION['order_email']);

    $_SESSION['order_success'] = 'no';
    header('location:http://www.emdnstore.es');

}
else if (isset($_GET['response']) && is_numeric($_GET['response']) && $_GET['response'] == 1)
{

    $books_details = "";
    $total_without_iva = 0;

    $total = 0;

    $iva_four = 0;
    $iva_twenty = 0;

    $to = $_SESSION['order_email'];

    $from = 'Emdn@emdn.cat';
    $fromName = 'EMDN';
    $rand = $order_id . "EMDN-Comanda";
    $subject = "Comanda llibres EMDN.";

    foreach ($_SESSION['cart'] as $key => $cartCourses)
    {

        foreach ($cartCourses as $single_book)
        {
            $books = "select * from products where id = " . $single_book['book_id'];
            $book = mysqli_fetch_assoc(mysqli_query($con, $books));
            //while($book = mysqli_fetch_assoc($results)){
            $single = str_replace(",", ".", $book['preu_final']);
            // echo $single;
            $total += $single;
            // $iva += $book['iva'];
            // $ivaprice = ($book['preu_final']/100)*$book['iva'];
            if ($book['iva'] == '4%')
            {
                $price_without_iva = $single / 1.04;
                $price_without_iva = cutAfterDot($price_without_iva, 2);
                $iva_four += ($single - $price_without_iva);
            }
            else
            {
                $price_without_iva = $single / 1.21;
                $price_without_iva = cutAfterDot($price_without_iva, 2);
                $iva_twenty += ($single - $price_without_iva);
            }

            $total_without_iva += $price_without_iva;
            // $total += $single*1 + ($book['preu_final']/100)*$book['iva'];
            $books_details .= '<tr style="border: 1px solid #dddddd;text-align: left;">
                                <td style="padding: 8px;border:1px solid black">' . $book['book_name'] . '</td>
                                <td style="padding: 8px;border:1px solid black;font-size:12px">' . $book['isbn'] . '</td>
                                <td style="padding: 8px;border:1px solid black">' . $book['editorial'] . '</td>
                                <td style="padding: 8px;border:1px solid black"> € ' . number_format($price_without_iva, 2, ".", '') . '</td>
                                <td style="padding: 8px;border:1px solid black;text-align:right"> € ' . number_format($single, 2, ".", '') . '</td>
                                </tr>';

        }
    }

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
                
                    <p style="margin:0px"><b>Factura : </b> <span>' . $order_id . "-Comandes" . '</span></p>
                    <p style="margin:0px"><b>Data factura : </b> <span>' . date("d M Y") . '</span></p>
                    <p style="margin:0px"><b>Raó Social : </b> <span> IPEC S.L. </span></p>
                    <p style="margin:0px"><b>CIF : </b> <span> B-58051889 </span></p>
                    
                </div>
                <div style="width:45%;display:inline-block;margin-top:10px;padding-left:8px">
                    <p style="margin:0px"><b> Nom Alumne/a: </b> ' . $_SESSION['stdname'] . '</p>
                    <p style="margin:0px"><b>Nom Pare/Mare/Tutor: </b> ' . $_SESSION['fathername'] . ' </p>
                    <p style="margin:0px"><b>DNI:  </b> ' . $_SESSION['dni'] . ' </p>
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
            
            </div>
            <div style="width:20%;display:inline-block;margin-bottom:12px;text-align:right">
                <div>
                     <p style="border:1px solid black"> <b> Total :  </b>   ' . number_format($total, 2, ".", '') . ' € </p>
                </div>
             </div>
        
        </div>
        
        </body>
        </html>';

    $mess = '<html lang="en"><head>
          <title>EMDN Comandes</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        </head>
        <body style="background:#F5F5F5;padding:8px;">
        
        
           <p>La vostra comanda s’ha realitzat correctament, us n’adjuntem la factura.</p>
           <p>A principis de setembre rebreu per correu electrònic totes les llicències dels llibres i dossiers digitals.</p>
           <p>Els llibres es lliuraran el primer dia de classe.</p>
           <p>Moltes gràcies per confiar, una vegada més, en el projecte de l’escola.</p>
            
        
        
        </body>
        </html>';

    $filename = $order_id . "-EMDN-Factura";
    $myfile = fopen("invoice_pdfs/" . $filename . ".pdf", "w");

    $dompdf = new Dompdf();
    $options = $dompdf->getOptions();
    $options->set(array(
        'isRemoteEnabled' => true
    ));
    $dompdf->setOptions($options);
    $dompdf->loadHtml($htmlContent);
    $dompdf->setPaper('A4', 'verti');
    $dompdf->render();
    //$dompdf->stream($filename.".pdf");
    $output = $dompdf->output();
    file_put_contents(dirname(__FILE__) . "/invoice_pdfs/" . $filename . '.pdf', $output);

    $file = "invoice_pdfs/" . $filename . '.pdf';

    // Set content-type header for sending HTML email
    // $headers = "MIME-Version: 1.0" . "\r\n";
    $headers = "From: $fromName" . " <" . $from . ">";

    // (B) MAIL HEADERS
    $boundary = md5(time()); // Random boundary
    $mailHead = implode("\r\n", ["MIME-Version: 1.0", "From: $fromName" . " <" . $from . ">", 'Content-Type: multipart/mixed; boundary="' . $boundary . '"']);

    // (C) MAIL MESSAGE
    $mailBody = implode("\r\n", [
    // (C1) THE MESSAGE
    "--$boundary", "Content-type: text/html; charset=utf-8", "", $mess,

    // (C2) ATTACHMENT
    "--$boundary", 'Content-Type: application/octet-stream; name="' . basename($filename . ".pdf") . '"', "Content-Transfer-Encoding: base64", "Content-Disposition: attachment", "", chunk_split(base64_encode(file_get_contents($file))) , "--$boundary--"]);
    $date = date('Y-m-d H:i:s');
    $query = "update orders set date_time='$date', payment_status = 'paid' where id = " . $order_id;
    mysqli_query($con, $query);

    $query = "update transection_history set payment_status = 'paid', pdf_invoice='$file',date_time='$date' where order_id = " . $order_id;
    mysqli_query($con, $query);

    //if(mail($to, $subject, $mailBody, $mailHead)){
    @mail($to, $subject, $mailBody, $mailHead);

    $_SESSION['order_success'] = 'yes';
    unset($_SESSION['cart']);
    unset($_SESSION['order_id']);
    unset($_SESSION['order_email']);
    header('location: http://www.emdnstore.es');

    /*}else{
            print_r(error_get_last());
    }*/
}
else
{
    header('location:http://www.emdnstore.es');
}

function generateRandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0;$i < $length;$i++)
    {
        $randomString .= $characters[rand(0, $charactersLength - 1) ];
    }
    return $randomString;
}

function cutAfterDot($number, $afterDot = 2)
{
    $a = $number * pow(10, $afterDot);
    $b = floor($a);
    $c = pow(10, $afterDot);
    //echo "a $a, b $b, c $c<br/>";
    return $b / $c;
}

?>
