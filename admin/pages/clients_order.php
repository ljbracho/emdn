
    <!-- Main content -->
    <section class="content">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Noves comandes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                      <tr>
                        <th>Order No</th>
                        <th>Preu total</th>
                        <th>Curs</th>
                        <th>Llibre</th>
                        <th>Nom de l'estudiant</th>
                         <th>Nom del pare de l'estudiant  </th>
                         <th>DNI</th>
                         <th>Correu electrònic</th>
                         <th>Telèfon no</th>
                         <!--<th>Estat</th>-->
                         <th>mètode de pagament</th>
                         <th>Data</th>
                         <!--<th>Acciò</th>-->
                      </tr>
                   
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>

   <div class="modal fade in" id="modal_books_details" tabindex="-1" role="dialog" aria-labelledby="modal_books_detailsLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">x</span></button>
                <h4 class="modal-title">Detalls de llibres de comanda</h4>
              </div>
              <div class="modal-body">
                  
                   <table class="table text-center table-bordered">
                      <thead class="thead-dark">
                        <tr class='text-center'>
                          <th scope="col">ISBN</th>
                          <th scope="col">Nom del llibre </th>
                          <th scope="col">Editorial</th>
                          <th scope="col">Comprar</th>
                          <th scope="col">Total €</th>
                        </tr>
                      </thead>
                      <tbody class='tr_body'>
                          
                          
                          
                      </tbody>
                     </table>
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn close_modal btn-default pull-right" data-dismiss="modal">Tancar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
     </div>