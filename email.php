<?php



$htmlContent = '<html lang="en">
<head><meta charset="gb18030">
  <title>Diamond Prize</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background:#F5F5F5;padding:8px;">
<div style="margin:0 auto;width:100%;border:1px solid #ccc;background:white;padding:12px;">
    <div style="margin-bottom:12px">
        <a href="http://www.emdnstore.es/" >
            <img src="http://www.emdnstore.es/assets/imgs/Logo-EMDN.png" style="width:170px;height:100px;" alt="">
        </a>
    </div>
    
    <p style="color:black;"><b>LLIBRES DE TEXT I MATERIAL INDIVIDUAL PER AL CURS 2020/2021</b></p>
    
    <div style="width:100%;overflow:hidden;border:1px solid black;margin-bottom:12px">
        <div style="width:45%;border-right:1px solid black;float:left;padding-left:8px">
            <p><b>Factura : </b> <span></span></p>
            <p><b>Data factura : </b> <span></span></p>
            <p><b>Raó Social : </b> <span> IPEC S.L. </span></p>
            <p><b>CIF : </b> <span> B-58051889 </span></p>
        </div>
        <div style="width:45%;float:left; padding-left:8px">
            <p><b> Nom Alumne/a: </b></p>
            <p><b>Nom Pare/Mare/Tutor: </b></p>
            <p><b>DNI:  </b></p>
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
      <?php for($i=1;$i <=10;$i++){ ?>
      <tr style="border: 1px solid #dddddd;text-align: left;">
        <td style="padding: 8px;border:1px solid black">Alfreds Futterkiste</td>
        <td style="padding: 8px;border:1px solid black">Maria Anders</td>
        <td style="padding: 8px;border:1px solid black">Germany</td>
        <td style="padding: 8px;border:1px solid black">Germany</td>
        <td style="padding: 8px;border:1px solid black">Germany</td>
      </tr>
      <?php } ?>
    </table>
    
    
    <p style="color:black;">
        Thanks,<br>
        The EMDN Team.
    </p>
        
</div>

<div id="footer_div" style=" margin:0 auto;width:500px;background: black;margin-top: 21px;padding:15px">
    <div style="text-align: center;">
         <a href="https://www.facebook.com/Diamondprizeseurope/"><img style="width:9%;text-align:center;" src="<?php echo SURL; ?>assets/images/facebook-01.png" alt=""></a>
         <a href="https://twitter.com/DiamondPrizes"><img style="width:9%;text-align:center;" src="<?php echo SURL; ?>assets/images/twitter2.png" alt=""></a>
         <a href="https://www.instagram.com/diamondprizes/"><img style="width:9%;text-align:center;" src="<?php echo SURL; ?>assets/images/insta-new.png" alt=""></a>
     </div>
    <p style="margin-top:19px; color: white;text-align:center">All Copyrights © 2021 are Reserved by EMDN</p>
</div>

</body>
</html>';

$headers .= "From:<info@emdn.es> \r\n";
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Send email 
if(mail("aounmuhammad135@gmail.com", "EMDN Order", $htmlContent, $headers)){ 
    echo 'Email has sent successfully.'; 
}else{ 
   echo 'Email sending failed.'; 
}










?>
