<?php
date_default_timezone_set('Europe/Madrid');
include('admin/connection.php');
session_start();
if(isset($_POST['place_order'])){
$stdname = $_POST['stdname'];
$dni = $_POST['dni'];
//$curs = $_POST['curs'];
$fthername = $_POST['nom'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$total_price = $_POST['total_price'];
//$stdname = $_POST['stdname'];
$payment_method  = 'Direct Bank'; //$_POST['stdname'];
$_SESSION['stdname'] = $stdname;
$_SESSION['order_email'] = $email;
$_SESSION['dni'] = $dni;
$_SESSION['fathername'] = $fthername;
$course = $_SESSION['course_name'];
$date = date('Y-m-d h:i:s');
$query_insert = "INSERT INTO `orders` (`total_price`,`date_time`,`name_std`, `name_fth`, `id_card`, `email`, `course`, `contact_number`, `payment_method`) VALUES ('$total_price','$date','$stdname', '$fthername', '$dni', '$email', '$course', '$phone', '$payment_method');";

if(mysqli_query($con,$query_insert)){
    $orderid = mysqli_insert_id($con);
    $_SESSION['order_id'] = $orderid;
    foreach($_SESSION['cart'] as $key => $cart){
        foreach($cart as $item){
            $qty = $item['quantity'];
            $book_id = $item['book_id'];
            $query_detail = "INSERT INTO `order_details` (`product_id`, `order_id`, `count`) VALUES ('$book_id','$orderid', '$qty');";
            mysqli_query($con,$query_detail);
        }
    }
    
    $query_transaction = mysqli_query($con,"INSERT INTO `transection_history` ( `order_id`, `total_price`, `payment_method`, `payment_status`, `token`) VALUES ('$orderid', '$total_price', 'Direct Bank', 'pending','');");
    
    echo "<form action='https://emdn.cat/redsys/form.php' method='post' id='payment' class='mb-3'><input type='hidden' name='monto' value='".$total_price."'><input type='hidden' name='descrip' value='PAGO ONLINE'></form>";
    // $_SESSION['order_success'] = 'yes';
    // unset($_SESSION['cart']);
    // header('location: index.php');
    
}else{
    
    
    $_SESSION['order_success'] = 'no';
    echo "Order Not Placed".mysqli_error($con);
    header('location: index.php');
    
    
}

}else{
   //header('location: index.php');
}


?>

<script type="text/javascript">
    document.getElementById('payment').submit();
</script>