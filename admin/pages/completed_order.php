
    <section class="content-header">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Comandes completades</h3>
              
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
                         <th>Estat</th>
                         <th>mètode de pagament</th>
                         <th>Data</th>
                         <th>Acciò</th>
                      </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>

    <!-- Main content -->
    <section class="content">
	
    </section>
    <!-- /.content -->
<div class="modal fade in" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">脳</span></button>
                <h4 class="modal-title">Editar categoria</h4>
              </div>
              <div class="modal-body">
                  <div class='row'>
                <div class='col-sm-12'>
                <div class="form-group">
                  <label for="cat_name">nombre de la categor铆a</label>
                  <input type="text" required  name='cat_name'  class="form-control cat_name" id="cat_name" placeholder="Enter Cateory name">
                </div>
                </div>
				<div class='col-sm-12'>
                <div class="form-group">
                  <label for="cat_description">Descripci贸n</label>
                  <textarea rows='5' required name='cat_description' class='form-control cat_description' id='cat_description'></textarea>
                </div>
                </div>
              </div>
              </div>
              <div class="modal-footer">
			  <input type="hidden"  id="cat_id">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerca</button>
                <button type="button" class="btn btn-primary btn-update">Guardar cambios</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>