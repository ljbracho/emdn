
    <section class="content-header">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Vestidos</h3>
              <a href='' class='btn btn-primary pull-right btn-category' data-page='add-type'> Agregar nueva </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No#</th>
                  <th>Tipo de prenda Nombre</th>
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

    <!-- Main content -->
    <section class="content">
	
    </section>
    <!-- /.content -->
<div class="modal fade in" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Editar categoria</h4>
              </div>
              <div class="modal-body">
                  <div class='row'>
                <div class='col-sm-12'>
                <div class="form-group">
                  <label for="type_name">nombre de la categoría</label>
                  <input type="text" required  name='type_name'  class="form-control type_name" id="type_name" placeholder="Enter Cateory name">
                </div>
                </div>
				<div class='col-sm-12'>
                <div class="form-group">
                  <label for="type_description">Descripción</label>
                  <textarea rows='5' required name='type_description' class='form-control type_description' id='type_description'></textarea>
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