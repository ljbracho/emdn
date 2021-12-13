
    <section class="content-header">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title pull-left">Platos principales del restaurante</h3>
              <p class="box-title pull-right"><b>Búsqueda por: </b> Nombre del restaurante , Nombre del plato , Categoría de plato ,Precio</p>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO#</th>
                  <th>Nombre del restaurante</th>
                  <th>Plato</th>
                  <th>Categoría de plato</th>
                  <th>Precio</th>
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
                <h4 class="modal-title">Editar detalle de plato para restaurante </h4>
              </div>
              <div class="modal-body">
			  <div class='row'>
			   <form method='post' action="" enctype='multipart/form-data' id='edit'>
				<div class='col-sm-12'>
                <div class="form-group">
                  <label for="dish_name_rest">Nombre del plato</label>
                  <input type="text"   name='dish_name_rest'  class="form-control dish_name_rest" id="dish_name_rest" placeholder="Dish Name">
                </div>
                </div>
                <div class='col-sm-12'>
                <div class="form-group">
                  <label for="price_restaurant_update">Precio del plato</label>
                  <input type="text"   name='price_restaurant_update'  class="form-control price_restaurant_update" id="price_restaurant_update" placeholder="Dish Price">
                </div>
                </div>
                <div class='col-sm-12'>
                <div class="form-group">
                  <label for="added_description_dish">Descripción del plato</label>
                 <textarea rows='5' id='added_description_dish' class='added_description_dish form-control' name='added_description_dish'></textarea>
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
			</form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>