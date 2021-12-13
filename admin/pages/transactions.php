 <section class="content">
     <div class="box">
         <div class="box-header">
             <h3 class="box-title">Transaccions i factures</h3>

         </div>
         <!-- /.box-header -->
         <div class="box-body">
             <table id="example1" class="table table-bordered table-striped">
                 <thead>
                     <tr>
                         <th>No#</th>
                         <th>Order ID</th>
                         <th>Nom de l'estudiant</th>
                         <th>Price</th>
                         <!--<th>Payment Method</th>-->
                         <!--<th>Payment Status</th>-->
                         <th>Descripción</th>
                         <th>Acción</th>
                     </tr>
                 </thead>
                 <tbody>
                 </tbody>
             </table>
         </div>
         <!-- /.box-body -->
     </div>
 </section>
 B1tig@MaredDeudNuria
 <div class="modal fade in" id="modal_books_details" tabindex="-1" role="dialog"
     aria-labelledby="modal_books_detailsLabel" aria-hidden="true" style="overflow:scroll">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header bg-primary">
                 <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">x</span></button>
                 <h4 class="modal-title">Factura de comanda</h4>
             </div>
             <div class="modal-body">

                 <table class="table text-center table-bordered">
                     <thead class="thead-dark">
                         <tr class='text-center'>
                             <th scope="col">ISBN</th>
                             <th scope="col">Nom del llibre </th>
                             <th scope="col">Editorial</th>
                             <th scope="col">Comprar</th>
                             <th scope="col">Total </th>
                         </tr>
                     </thead>
                     <tbody class='tr_body'>



                     </tbody>
                 </table>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn close_modal btn-default pull-left"
                     data-dismiss="modal">Tancar</button>
                 <a href='' class='btn btn-primary pull-right add_download_link'> Descarregar factura</a>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>


 <div class="modal fade in" id="modal-edit">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-pink">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">x</span></span></button>
                 <h4 class="modal-title">Editar Factura </h4>
             </div>
             <div class="modal-body">
                 <div class='row'>
                     <div class='col-sm-12'>
                         <div class="form-group">
                             <label for="date_time">Fecha</label>
                             <input type="text" class="form-control " id="date_time" name='date_time'
                                 placeholder="Fecha de Factura">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-sm-12">
                         <div class="form-group">
                             <label for="order_amount">Estat de pagament de la comanda</label>
                             <select class="form-control payment_status" id="payment_status" name='payment_status'>
                                 <option value="pending"> Import pendent </option>
                                 <option value="paid"> Quantitat pagada </option>
                                 <option value="">Estat de pagament</option>
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-sm-12">
                         <div class="form-group">
                             <label for="std_name">Noms de l'alumne/a</label>
                             <input type="text" name='std_name' class="form-control std_name" id="std_name">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-sm-12">
                         <div class="form-group">
                             <label for="std_name">Cognoms de l'alumne/a</label>
                             <input type="text" name='std_last_name' class="form-control std_name" id="std_last_name">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-sm-12">
                         <div class="form-group">
                             <label for="parent">Nom del pare o mare</label>
                             <input type="text" name='parent' class="form-control parent" id="parent">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-sm-12">
                         <div class="form-group">
                             <label for="dni">DNI pare o mare</label>
                             <input type="text" name='dni' class="form-control dni" id="dni">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-sm-12">
                         <div class="form-group">
                             <label for="pre_final">Correu electrònic</label>
                             <input type="text" name='order_email' class="form-control order_email" id="order_email">
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-sm-12">
                         <div class="form-group">
                             <label for="order_telephone">Telèfon de contacte</label>
                             <input type="text" name='order_telephone' class="form-control order_telephone"
                                 id="order_telephone">
                         </div>
                     </div>
                 </div>

             </div>
             <div class="modal-footer">
                 <input type="hidden" id="cat_id">
                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerca</button>
                 <button type="button" class="btn btn-primary btn-update">Guardar cambios</button>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>