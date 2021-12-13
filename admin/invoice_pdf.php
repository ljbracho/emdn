<?php


 // Include autoloader 
    require_once 'dompdf/autoload.inc.php'; 
     
    // Reference the Dompdf namespace 
    use Dompdf\Dompdf; 
    

if(isset($_GET['order_id']) && is_numeric($_GET['order_id'])){
    error_reporting(0);
    $total = $iva = 0;
        $iva_four = 0 ;
        $iva_twenty = 0 ;
    $dompdf = new Dompdf();
    
    $options = $dompdf->getOptions(); 
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);
    
    include('connection.php');
    $order_data = mysqli_fetch_assoc(mysqli_query($con,"select * from orders where id = ".$_GET['order_id'])); 
    
    $order_details = mysqli_query($con,"select * from order_details where order_id = ".$_GET['order_id']);
     while($single_book = mysqli_fetch_assoc($order_details)){
             
                    $books = "select * from products where id = ".$single_book['product_id'];
                    $book = mysqli_fetch_assoc(mysqli_query($con,$books));
                  //while($book = mysqli_fetch_assoc($results)){
                   $single = str_replace(",",".",$book['preu_final']);
                   $total += $single;
                   $iva += $book['iva'];
                  // $ivaprice = ($book['preu_final']/100)*$book['iva'];
                   if($book['iva'] == '4%'){
                       $price_without_iva = $single / 1.04 ;
                       $price_without_iva = cutAfterDot($price_without_iva,2);
                       $iva_four += ($single - $price_without_iva);
                   }else{
                       $price_without_iva = $single / 1.21;
                       $price_without_iva = cutAfterDot($price_without_iva,2);
                       $iva_twenty += ($single - $price_without_iva);
                   }
                   
                   $total_without_iva += $price_without_iva; 
                  // $total += $single*1 + ($book['preu_final']/100)*$book['iva'];
             
             $books_details .= '<tr style="border: 1px solid #dddddd;text-align: left;">
                                <td style="padding: 8px;border:1px solid black">'.$book['book_name'].'</td>
                                <td style="padding: 8px;border:1px solid black;font-size:12px">'.$book['isbn'].'</td>
                                <td style="padding: 8px;border:1px solid black">'.$book['editorial'].'</td>
                                <td style="padding: 8px;border:1px solid black"> € '.number_format($price_without_iva,2,".",'').'</td>
                                <td style="padding: 8px;border:1px solid black;text-align:right"> € '.number_format($single,2,".",'').'</td>
                                
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
            
            <p style="color:black;"><b>LLIBRES DE TEXT I MATERIAL INDIVIDUAL PER AL CURS '.date("Y")."-".date('Y', strtotime('+1 year')).'</b></p>
            
            <div style="border:1px solid black;margin-bottom:10px">
                <div style="width:45%;display:inline-block;border-right:1px solid black;margin-top:10px;padding-left:8px">
                
                    <p style="margin:0px"><b>Factura : </b> <span>'.$_GET['order_id']."-Comandes".'</span></p>
                    <p style="margin:0px"><b>Data factura : </b> <span>'.date("d M Y").'</span></p>
                    <p style="margin:0px"><b>Raó Social : </b> <span> IPEC S.L. </span></p>
                    <p style="margin:0px"><b>CIF : </b> <span> B-58051889 </span></p>
                    
                </div>
                <div style="width:45%;display:inline-block;margin-top:10px;padding-left:8px">
                    <p style="margin:0px"><b> Nom Alumne/a: </b> '.$order_data['name_std'].'</p>
                    <p style="margin:0px"><b>Nom Pare/Mare/Tutor: </b> '.$order_data['name_fth'].' </p>
                    <p style="margin:0px"><b>DNI:  </b> '.$order_data['id_card'].' </p>
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
              
              '.$books_details.'
              </table>
              <br>
                <div style="width:55%;overflow:hidden;display:inline-block;margin-bottom:12px">
                </div>
                 <div style="width:45%;overflow:hidden;display:inline-block;margin-bottom:12px;text-align:right;border: 1px solid black;padding:0px;">
                  <table style="width:100%;margin:0px">
                     <tr style="text-align: left;">
                                       
                                        <td colspan="3" style="padding: 8px;border:1px solid black;text-align:right">Total</td>
                                        <td style="padding: 8px;border:1px solid black"> € '.number_format($total_without_iva,2,".",'').'</td>
                                        <td style="padding: 8px;border:1px solid black"> € '.number_format($total,2,".",'').'</td>
                    </tr>
                    </table>
                </div>
               
            <br>
            <div style="width:48%;overflow:hidden;display:inline-block;margin-bottom:12px">
            </div>
            <div style="width:48%;overflow:hidden;display:inline-block;margin-bottom:12px;text-align:right">
                <div >
                     <p> <b>Base  4% : </b> € '.number_format($iva_four,2,".",'').'</p>
                     <p> <b>Base  21% :  </b> € '.number_format($iva_twenty,2,".",'').' </p>
                </div>
             </div>
             
             <div style="width:79%;display:inline-block;margin-bottom:12px;text-align:right">
             <p>
            </div>
            <div style="width:20%;display:inline-block;margin-bottom:12px;text-align:right">
                <div>
                     <p style="border:1px solid black"> <b> Total :  </b>   '.number_format($total,2,".",'').' € </p>
                </div>
             </div>
        
        </div>
        
        
        </body>
        </html>';
    // Load HTML content 
    $dompdf->loadHtml($htmlContent); 
     
    // (Optional) Setup the paper size and orientation 
    $dompdf->setPaper('A4', 'vertical'); 
     
    // Render the HTML as PDF 
    $dompdf->render(); 
     
    // Output the generated PDF to Browser 
    $dompdf->stream("EMDN Order Invoice", array("Attachment" => 1));
}




function cutAfterDot($number, $afterDot = 2){
$a = $number * pow(10, $afterDot);
$b = floor($a);
$c = pow(10, $afterDot);
//echo "a $a, b $b, c $c<br/>";
return $b/$c ;
}











?>