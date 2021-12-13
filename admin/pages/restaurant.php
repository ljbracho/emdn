<style>
.btn-label {position: relative;left: -12px;display: inline-block;padding: 6px 12px;background: rgba(0,0,0,0.15);border-radius: 3px 0 0 3px;}
.btn-labeled {padding-top: 0;padding-bottom: 0;}
.btn { margin-bottom:10px; }
.custom-control-label {
    display: inline-block;
    max-width: 100%;
    /* margin-bottom: 5px; */
    margin-bottom: -4px;
    font-weight: 700;
    margin-left: 5px;
}
</style>
    <section class="content-header">
    
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Restaurantes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO#</th>
				  <th>Imagen del restaurante</th>
                  <th>Nombre del restaurante</th>
                  <th>Nombre del gerente</th>
                  <th>E-mail</th>
                  <th>Teléfono</th>
                  <th>Ciudad</th>
                  <th>Código postal</th>
                  <th>Habla a</th>
                  <th>Tipo de comida</th>
                  <th>Mesas</th>
                  <th> Estado </th>
                  <th> Acción</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
    <!-- /.content -->
<div class="modal fade" id="modal-edit_rest">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header" style="background:#204d74">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" style="color:white">Editar restaurante </h4>
              </div>
              <div class="modal-body">
			   <form method='post' action="" enctype='multipart/form-data' id='edit'>
                <div class='row'>
			    <div class='col-sm-6'>

                <div class="form-group">

                  <label for="restaurant_name">Nombre del restaurante</label>

                  <input type="text"  class="form-control restaurant_name" name='restaurant_name' id="restaurant_name" placeholder="Nombre del restaurante">

                </div></div>
				<div class='col-sm-6'>

                <div class="form-group">

                  <label for="manager_name_rest">Nombre del gerente</label>

                  <input type="text"  class="form-control manager_name_rest" name='manager_name_rest' id="manager_name_rest" placeholder="Nombre del gerente">

                </div>
				</div>
				<div class='col-sm-6'>

                <div class="form-group">

                  <label for="email_rest">Email del restaurante</label>

                  <input type="email"  class="form-control email_rest" name='email_rest' id="email_rest" placeholder="Email del restaurante">

                </div>

                </div>
				<div class='col-sm-6'>

                <div class="form-group">

                  <label for="phone_res">Teléfono del restaurante</label>

                  <input type="text"  name='phone_res'  class="form-control phone_res" id="phone_res" placeholder="Teléfono del restaurante">

                </div>

                </div>

				<div class='col-sm-6'>

                <div class="form-group">

                  <label for="kind_of_food_rest">Tipo de comida</label>

                  <input type="text"   name='kind_of_food_rest'  class="form-control kind_of_food_rest" id="kind_of_food_rest" placeholder="Escribe el tipo de comida de tu restaurante">

                </div>

                </div>
				
				<div class='col-sm-6'>

                <div class="form-group">

                  <label for="no_of_table_rest">Numero de tablas</label>

                  <input type="text"   name='no_of_table_rest'  class="form-control no_of_table_rest" id="no_of_table_rest" placeholder="Numero de tablas">

                </div>

                </div>
				
				<div class='col-sm-6'>

                <div class="form-group">

                  <label for="no_of_table">Estado</label>
					<select class="form-control select2 status_r" id="status_r" name="status_r" style="width: 100%;">
						  <option selected="selected" disabled="">Estado</option>
						  <option value="inactive">En activo</option>
						  <option value="active">Activo</option>
						  <option value="banned">Prohibido</option>
						</select>
                </div>

                </div>
				
				<div class='col-sm-6'>

                <div class="form-group">

                  <label for="file">Foto del restaurante</label>

                  <input type="file"   name='file'  class="form-control file" id="file">

                </div>

                </div>
				<div class='col-sm-12'>
					<img src='' alt='Restaurant image' width='100%' class='dish-old'>
				</div>
				<div class='col-sm-6'>

                <div class="form-group">

                  <label for="city">Ciudad</label>

                  <input type="text"   name='city'  class="form-control city" id="city" placeholder="Ciudad">

                </div>

                </div>

				<div class='col-sm-6'>

                <div class="form-group">

                  <label for="zipcode">Código postal</label>

                  <input type="text"   name='zipcode'  class="form-control zipcode" id="zipcode" placeholder="Código postal">

                </div>

                </div>
				

				<div class='col-sm-6'>

                <div class="form-group">

                  <label for="address">Dirección del restaurante</label>

                  <textarea rows='5'  name='address' class='form-control address' id='address'></textarea>

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


<div class="modal fade" id="modal-status">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background:#204d74">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" style="color:white"><i class="fa fa-cutlery"></i>
Cambiar estado del restaurante</h4>
              </div>
              <div class="modal-body">
				  <div class="row">
					<div class="col-sm-12">
					  <div class="custom-control custom-radio">
						<input type="radio" id="active" name="customRadio" class="custom-control-input">
						<label class="custom-control-label" for="active">Activo</label>
					  </div>
					  <div class="custom-control custom-radio">
						<input type="radio" id="banned" name="customRadio" class="custom-control-input">
						<label class="custom-control-label" for="banned">Prohibido</label>
					  </div>
					  <div class="custom-control custom-radio">
						<input type="radio" id="inactive" name="customRadio" class="custom-control-input">
						<label class="custom-control-label" for="inactive">En Activo</label>
					  </div>
					</div>
					 <input type="hidden" name="res_id" id="res_id">
				  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerca</button>
                <button type="button" class="btn btn-primary" id="btn-update-status">Guardar cambios</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
		<div class="modal fade" id="modal-restaurant-sub">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header" style="background:#204d74">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" style="color:white">Lista de restaurantes secundarios</h4>
              </div>
              <div class="modal-body restaurant-dishs">
               <div class='row' style='margin-bottom:10px'>
				<div class='col-sm-12'>
					<table class='table table-striped'>
						<thead>
							<th>Nombre del restaurante</th>
							<th>E-mail</th>
							<th>Teléfono</th>
							<th>Ciudad</th>
							<th>Código postal</th>
							<th>
Dirección del restaurante</th>
						</thead>
						<tbody class='rest_data'>
						
						
						</tbody>
					</table>
			   </div>
              </div>
              <div class="modal-footer">
			    <input type="hidden"  id="cat_id">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cerca</button>
              
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>
</div>

<div class="modal fade" id="modal-add-restaurant-dishes" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header" style="background:#204d74">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" style="color:white">Agregar productos al restaurante</h4>
              </div>
              <div class="modal-body restaurant-dishs">
			       <div class="row">
				   <input type='hidden' class='selectedrest'>
					<div class='col-sm-12'>
					     <div class="form-group">
						 <label>Elegir la categoría</label>
						 <select class='form-control category' style='width:100% !important'  name='category'>
						 <option selected value='' disabled>Selecciona una categoría </option>
						 </select>
						 
						 </div>
					</div>
				   </div>
				   <div class="row titles">
				   </div>
					<div class="add_dish_row">
                   </div>
              </div>
              <div class="modal-footer">
				<button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Cerca</button>
				<button type="button" class="btn btn-info btn_add_product">Agregar productos</button>
			  </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-restaurants-dishes">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header" style="background:#204d74">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" style="color:white">Platos del restaurante <span id='rest_name'></span></h4>
              </div>
              <div class="modal-body">
			       <div class="row restaurant-dishes-data">
			       
                   </div>
              </div>
              <div class="modal-footer">
				<button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Cerca</button>
				
			  </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>


