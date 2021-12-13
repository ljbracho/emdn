<?php 
include('header.php');
include 'admin/connection.php';
?>
<div class="section">
    <div class="container mt-5 mb-3">
        <div class="col-sm-12 text-center mb-3">
                    <img src="assets/imgs/Logo-EMDN.png" class='logo_web'>
                    
                </div>
    </div>
    <div class='wrapper_trans mb-3'>
        <?php if(!isset($_SESSION['cart'])){ ?>
        <p> <i class='fa fa-shopping-cart'></i>  La vostra cistella encara està buida! <a href='index.php'> Anar a casa </a></p>
        <?php }else{
        if(count($_SESSION['cart']) == 0){
        ?>
        <div class="mb-3 p-3" style='background: #ffffffc2;'>
        <p class='text-center text-danger m-0 '><b> <i class='fa fa-shopping-cart'></i>  La vostra cistella encara està buida! <a href='index.php'> Anar a casa </a></b></p>
        </div>
        <?php }else{ ?>
        <div class="mb-3 p-2" style='background: #ffffffc2;'>
            <?php
                  $total = 0 ;$price_without_iva=0;$iva=0;
                  foreach($_SESSION['cart'] as  $key => $cartCourses){
                      $coursname = mysqli_fetch_assoc(mysqli_query($con,"select courses.*,categorias.cat_name from courses join categorias on categorias.id = courses.etpa where courses.id =  ".$key));
                  ?>
                <div class='row'>
                    <div class='col-sm-8'>
                         <h3><?php echo $coursname['course_name']." - ".$coursname['cat_name'];?> </h3>
                    </div>
                    <div class='col-sm-4'>
                        <button type='button' data-course='<?php echo $coursname['id'];?>' class='btn btn-remove float-right'> Eliminar comanda <i class='fa fa-close'></i></button>
                    </div>
                </div>
        <table class="table text-center" style='border: 1px solid #8e8282;color: #6b6b6b;'>
              <thead class="thead-dark">
                <tr class='text-center'>
                  <th scope="col">ISBN</th>
                  <th scope="col">Nom del llibre </th>
                  <th scope="col">Editorial</th>
                  <th scope="col">Comprar</th>
                  <!--<th scope="col">Preu</th>-->
                  <!--<th scope="col">IVA %</th>-->
                  <th scope="col">Total €</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  
                  foreach($cartCourses as $single_book){
                      $books = "select * from products where id = ".$single_book['book_id'];
                      $book = mysqli_fetch_assoc(mysqli_query($con,$books));
                  //while($book = mysqli_fetch_assoc($results)){
                   $single = str_replace(",",".",$book['preu_final']);
                   $price_without_iva += $single;
                   $iva += $book['iva'];
                   $ivaprice += ($single/100)*$book['iva'];
                   $total += $single*1 + ($single/100)*$book['iva'];
                    
                   if($book['obligatori'] == 'SI'){ 
                            $addcart="";
                            $disable = "disabled";
                        }else{
                            
                            $addcart="btn-cart-icon";
                            $disable = "";
                        } 
                  
                  ?>
                <tr>
                  <th scope="row"><?php echo $book['isbn'];?></th>
                  <td><?php echo $book['book_name'];?></td>
                   <td><?php echo $book['editorial'];?></td>
                  <td>
                      <!--<div class="input-group" style='width:165px;margin:auto'>-->
                      <!--              <span class="input-group-btn">-->
                      <!--                  <button type="button" class="quantity-left-minus btn btn-default btn-number">-->
                      <!--                    <i class='fa fa-minus'></i>-->
                      <!--                  </button>-->
                      <!--              </span>-->
                      <!--              <input type="text"  name="quantity" class="form-control quantity input-number" value="<?php echo $single_book['quantity'];?>" >-->
                      <!--              <span class="input-group-btn">-->
                      <!--                  <button type="button" class="quantity-right-plus btn btn-default btn-number" data-type="plus" data-field="">-->
                      <!--                      <i class="fa fa-plus"></i>-->
                      <!--                  </button>-->
                      <!--              </span></div>-->
                                    <button type='button' data-price='<?php echo str_replace(",",".",($single + $ivaprice));?>' data-iva='<?php echo str_replace("%","",$book['iva']);?>' data-bookid='<?php echo $book['id'];?>' data-courseid='<?php echo $book['course_id'];?>' data-qty='0' class='btn btn-pink-cart <?php echo $addcart;?>' <?php echo $disable;?>><i class='fa fa-check-circle'></i></button>
                                </td>
                
                  <!--<td><?php  echo $book['preu_final'];?> €</td>-->
                  <!--<td><?php  echo $book['iva'];?> </td>-->
                   <td><?php
                        //$percentTotal = (($book['preu_final']/100)*$book['iva']) + $book['preu_final'] ;
                        echo $single + $ivaprice;
                  
                  ?> € </td>
                </tr>
               <?php } ?>
              </tbody>
        </table>
        <?php } ?>
        </div>
        <?php } } ?>
        <form action="create_order.php" method='post' class='mb-3'>
        <div class='row'>
            <div class="col-sm-5">
                 <div class="form-group">
                    <input type="text" class="form-control checkout-input-box" required name='stdname' id="username" aria-describedby="emailHelp" placeholder="Nom de l'alumne/a">
                  </div>
                 
                 <div class="form-group">
                    <input type="text" class="form-control checkout-input-box" id="dni" required name='dni' aria-describedby="emailHelp" placeholder="DNI pare o mare">
                  </div>
                  
                  <!--<div class="form-group">-->
                  <!--  <input type="text" class="form-control checkout-input-box" id="curs" required name='curs' aria-describedby="emailHelp" placeholder="CURS">-->
                  <!--</div>-->
                  <div class="form-group">
                    <input type="text" class="form-control checkout-input-box" id="exampleInputEmail1" required name='phone' aria-describedby="emailHelp" placeholder="Telèfon de contacte">
                  </div>
                
            </div>
            <div class="col-sm-7">
                
                <div class="form-group">
                    <input type="text" class="form-control checkout-input-box" id="exampleInputEmail1" required name='nom' aria-describedby="emailHelp" placeholder="Nom del pare o mare">
                  </div>
                  
                  <div class="form-group">
                    <input type="email" class="form-control checkout-input-box" id="exampleInputEmail1" required name='email' aria-describedby="emailHelp" placeholder="Correu electrònic">
                  </div>
                  
                 
            </div>
        </div>
       
       <!--<div class='row'>
           <div class='col-sm-3'>
               <label class="radio-inline mr-3">
                 <img src='assets/imgs/Group 21.png' width='60px'> <input type="radio" value='visa' name="payment" checked> 
                </label>
                <label class="radio-inline mr-3">
                  <img src='assets/imgs/Group 22.png' width='60px'> <input type="radio" value='master' name="payment">
                </label>
           </div>
           
           <div class='col-sm-4'>
                <div class="form-group">
                    <input type="number" class="form-control checkout-input-box" id="card_number" required name='card_number' aria-describedby="emailHelp" placeholder="Numero de targeta">
                 </div>
           </div>
           <div class='col-sm-3'>
                <div class="form-group">
                    <input type="text" class="form-control checkout-input-box" id="exampleInputEmail1" required name='year' aria-describedby="emailHelp" placeholder=" MM / AA">
                 </div>
           </div>
           <div class='col-sm-2'>
                <div class="form-group">
                    <input type="number" class="form-control checkout-input-box" id="exampleInputEmail1" requird name='cvv' aria-describedby="emailHelp" placeholder="CVV">
                 </div>
           </div>
           
       </div>-->
       
     </div>
     <div class='about-usbar mb-3'>
             <div class='row'>
                 <div class='col-sm-10 text-dark text-right'>
                     <!--<p class='m-0'><b>Preu</b></p>-->
                     <!--<small>iva %</small>-->
                     <p><b> TOTAL </b></p>
                 </div>
                 <div class='col-sm-2 text-dark'>
                     <!--<p class='m-0'><span id='final_price'> <?php echo $price_without_iva;?></span> €</p>-->
                     <!--<small><span id='iva'><?php echo $ivaprice;?></span></small>-->
                     <input type='hidden' name='total_price' class='total' value='<?php echo number_format($price_without_iva,2,".","") ;?>'>
                     <input type='hidden' name='monto' class='total' value='<?php echo number_format($price_without_iva,2,".","") ;?>'>
                     <input type='hidden' name='descrip' value='PAGO ONLINE'>
                     <p><b><span class='total_price' id='tot'><?php echo number_format($total,2,".","") ;?></span> €</b></p>
                 </div>
             </div>
       </div>
       
       <div class="wrapper_trans mb-5">
         <input type='submit' class='btn btn-pink float-right' name='place_order' value='PAGAR'>
         <!--<a href='index.php' class='btn btn-gray float-right mr-3'>SEGUIR COMPRANT</a>-->
        </div>
        </form>
</div>


<?php  include('footer.php');?>