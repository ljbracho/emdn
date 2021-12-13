<?php
// new mailer Emdn@emdnstore.es  is this your mail sender?


$fullname = "test mail";
$email = "Emdn@emdnstore.es";
$subject = " test title";
$message = "test message ";
$to = "aounmuhammad135@gmail.com";

$header = 'From:{$email}\r\nContent-Type:txt/html;';
$report = mailer($to,$subject,$message,$header);
if($report){
    echo 'Email has sent successfully.'; 
}else{ 
   echo 'Email sending failed.'; 
}
//please run this php file and send me this result
// go to your domain/testmail.phpv


?>

