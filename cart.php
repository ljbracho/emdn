<?php 
include('header.php');
include 'admin/connection.php';

if(isset($_GET['etapa']) && isset($_GET['course']) ){
    if(isset($_GET['modality'])){
        $modality = $_GET['modality'];
         $query = "select products.*,courses.course_name from products join courses on courses.id = products.course_id  where course_id = ".$_GET['course']." AND modality = '".$modality."'";
    }else{
        $query = "select products.*,courses.course_name from products join courses on courses.id = products.course_id  where course_id = ".$_GET['course'];
    }
    
    $results = mysqli_query($con,$query);
    
    $etapaname = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `categorias` where id = ".$_GET['etapa']));
    $course_message = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `messages`  where course_id = ".$_GET['course']));
    $course = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `courses` where id = ".$_GET['course']));
    $_SESSION['course_name'] = $course['course_name'];
    // if(mysqli_num_rows($results) > 0){
    //     while($row =  mysqli_fetch_assoc($results)){
    //         $courses[] = $row;
    //     }
    //     $response['error'] =  false;
    //     $response['msg'] = 'Books available';
    //     $response['books'] = $courses;
    // }else{
    //     $response['error'] =  true;
    //     $response['msg'] = 'No Books Exists';
    //     $response['books'] = array();
    // }
    
    // echo json_encode($response);
    // die;
}
?>




<div class="section">
    <div class="container mt-5 mb-3">
        <div class="col-sm-12 text-center mb-3">
                    <img src="assets/imgs/Logo-EMDN.png" class='logo_web'>
                    
                </div>
    
    <div class="text-slides mb-3">
        <div class="slideshow-container">
            
              <div class="mySlides" style="display: block;">
              <?php echo $course_message['message_content'];?>
                </div>
                
            </div>
    </div>
    </div>
    <div class='about-usbar mb-3'>
        <?php
        //if(!isset($_SESSION['cart']) && count($_SESSION['cart']) == 0){
            
        ?>
        <!--<p> <i class='fa fa-shopping-cart'></i>  La vostra cistella encara està buida! <a href='index.php'> Anar a casa </a></p>-->
        
        <?php //}else{
        
        
        ?>
        <div class="row mb-3 bg-red-total text-white">
            <?php
            
            ?>
            
            <div class="col-sm-6 pt-1 text-left">
                <p class='m-0'><b><?php echo $etapaname['cat_name']." ".$course['course_name']." ".$_GET['modality'];?></b></p>
            </div>
            <div class="col-sm-6">
                <span class="float-right text-dark m-0 bg-price"><b><span class='total_price'>0</span> € </b></span>
            </div>
        </div>
        <table class="table text-center" style='border: 1px solid #8e8282;color: #6b6b6b;'>
              <thead class="thead-dark">
                <tr class='text-center'>
                  <th scope="col">ISBN</th>
                  <th scope="col">Nom del llibre </th>
                  <th scope="col">Editorial</th>
                  <th scope="col">Comprar</th>
                  
                  <!--<th scope="col">obligatory</th>-->
                 
                  <!--<th scope="col">IVA %</th>-->
                  <th scope="col">Total €</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                //   foreach($_SESSION['cart'] as $key => $cart){
                //       $books = "select * from products where id = ".$key;
                //       $book = mysqli_fetch_assoc(mysqli_query($con,$books));
                
                    $results = mysqli_query($con,$query);
                     if(mysqli_num_rows($results) > 0){
                         $total_cart_price = 0;$pricetotal = 0;$ivaprice = 0;
                  while($book = mysqli_fetch_assoc($results)){
                        
                        $percentTotal = (($book['preu_final']/100)*$book['iva']) + $book['preu_final'] ;
                        //  unset($_SESSION['cart']);
                        //  die;
                         
                            $preu_final = str_replace(",",".",$book['preu_final']);
                            $pricetotal += $preu_final;
                            $ivaprice += ($preu_final/100)*$book['iva'];
                            $total_cart_price +=$percentTotal;
                            if(!isset($_SESSION['cart'])){
                                $_SESSION['cart'] = array();
                            }
                             $book_id = $book['id'];
                             $course_id = $book['course_id'];
                             $qty = 1;
                            // add new item on array
                            $cart_item=array(
                                'book_id'=>$book_id,
                                'quantity'=>$qty
                            );
                            
                            if(array_key_exists($course_id, $_SESSION['cart'])){
                                    if(array_search($book_id, array_column($_SESSION['cart'][$course_id], 'book_id')) !== FALSE){
                                        /// leave
                                    }else{
                                      $_SESSION['cart'][$course_id][]=$cart_item;
                                    }
                                    
                            }else{
                                $_SESSION['cart'][$course_id][]=$cart_item;
                            }
                        
                       $carrrt = "fa-check-circle";
                       if($book['obligatori'] == 'SI'){
                            
                            $addcart="";
                            $disable = "disabled";
                        }else{
                            //$carrrt = "fa-shopping-cart";
                            $addcart="btn-cart-icon";
                            $disable = "";
                        } 
                  
                  ?>
                <tr>
                  <th scope="row"><?php echo $book['isbn'];?></th>
                  <td><?php echo $book['book_name'];?></td>
                   <td><?php echo $book['editorial'];?></td>
                  <td>
                    <button type='button' data-price='<?php echo str_replace(",",".",$book['preu_final']);?>' data-iva='<?php echo str_replace("%","",$book['iva']);?>' data-bookid='<?php echo $book['id'];?>' data-courseid='<?php echo $_GET['course'];?>' data-qty='0' class='btn btn-pink-cart <?php echo $addcart;?>' <?php echo $disable;?>><i class='fa <?php echo $carrrt;?>'></i></button>
                   </td>
                  <!--<td><?php  echo $book['pv_pmm'];?> €</td>-->
                  <!--<td><?php  echo $book['preu_final'];?> €</td>-->
                 
                  <!--<td><?php  echo $book['iva'];?></td>-->
                  <!--<td><?php echo $book['obligatori'];?></td>-->
                   <td><?php
                        
                        echo $book['preu_final']; //$percentTotal;
                  
                  ?> €</td>
                  
                </tr>
               <?php } }else{ ?>
               
               <tr><td colspan='7'> No books Uploaded Yet!</td></tr>
               <?php } ?>
              </tbody>
        </table>
        
        <?php //} ?>
        
     </div>
     <div class='about-usbar mb-3'>
         <div class='row'>
             <div class='col-sm-10 text-dark text-right'>
                 <!--<p class='m-0'><b>Preu  </b></p>-->
                 <!--<small>iva %</small>-->
                 <p><b> TOTAL </b></p>
             </div>
             <div class='col-sm-2 text-dark'>
                 <!--<p class='m-0' id='final_price'> <?php echo number_format($pricetotal,2,".","");?> </p>-->
                 <!--<small><span id='iva'><?php echo $ivaprice;?></span> </small>-->
                 <p><b><span class='total_price' id='tot'><?php echo number_format($pricetotal,2,".","");?></span> €</b></p>
             </div>
         </div>
         
        </div>
     <div class="wrapper_trans mb-5">
         <a href='checkout.php' class='btn btn-pink float-right'>PAGAR</a>
         <!--<a href='index.php' class='btn btn-gray float-right mr-3'>SEGUIR COMPRANT</a>-->
     </div>
</div>


<?php  include('footer.php');?>

<script>
    $(document).ready(function(){
       $('.total_price').text($('#tot').text()); 
    });
</script>
<?php

function cutAfterDot($number, $afterDot = 2){
$a = $number * pow(10, $afterDot);
$b = floor($a);
$c = pow(10, $afterDot);
//echo "a $a, b $b, c $c<br/>";
return $b/$c ;
}


?>