
    <section class="content-header">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Promociones</h3>
              <a href='' class='btn btn-primary pull-right btn-category' data-page='add-promotion'>
Agregar promoción </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>NO#</th>
                  <th>Imagen de promoción</th>
                  <th>Nombre de la promociones</th>
                  <th>Descripcion</th>
                  <th>Action</th>
                </tr>
                </thead>
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
                      <span aria-hidden="true">x</span></span></button>
                    <h4 class="modal-title">Editar Promoción </h4>
                  </div>
                  <div class="modal-body">
                      <form id='edit'>
                         <div class="form-group">
                          <label for="promotion_name">Nombre de la promociones</label>
                          <input type="text" class="form-control promotion_name" id="promotion_name" name='promotion_name' placeholder="Nombre de la marca">
                        </div>
                        <div class="form-group">
                          <label for="promotion_image">Imagen de promoción</label>
                          <input type="file" class="form-control promotion_image" id="promotion_image" name='promotion_image' placeholder="Nombre de la marca">
                        </div>
                        <div class="col-sm-12">
                            <div id="already_uploaded">
                                
                            </div>
                            
                        </div>
                        <div class="form-group">
                          <label for="pro_description">Descripcion de promociones</label>
                          <textarea rows='5' class='form-control pro_description' name='pro_description'></textarea>
                        </div>
                   </div>
                  <div class="modal-footer">
    			  <input type="hidden"  id="cat_id">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerca</button>
                    <button type="button" class="btn btn-primary btn-update">Guardar cambios</button>
                  </div>
                  </form>
               
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
    </div>