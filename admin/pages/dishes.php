
    <section class="content-header">
     <h3 class="">Búsqueda por: Nombre del plato , Categoría de plato ,Precio</h3>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Platos</h3>
              <a href='' class='btn btn-primary pull-right add-dish' data-page='add-dish'> Agregar nuevo plato </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No#</th>
                  <th>Nombre del plato</th>
                  <th>Precio del plato</th>
                  <th>Categoría de plato</th>
                  <th>Imagen de plato</th>
                  <th>Properties</th>
                  <th>Descripción</th>
                  <th>Acción</th>
                </tr>
                </thead>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
	
	<div class="modal fade in" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Editar plato </h4>
              </div>
              <div class="modal-body">
			  <form method='post' action="" enctype='multipart/form-data' id='edit'>
			  <div class='row'>
                <div class='col-sm-6'>
                <div class="form-group">
                  <label for="dish_name">Nombre del plato</label>
                  <input type="text"  class="form-control dish_name" name='dish_name' id="dish_name" placeholder="Nombre del plato">
                </div></div>
				 <div class='col-sm-6'>
                <div class="form-group">
                  <label for="dish_category">selecciona una categoríay</label>
                  <select  name='dish_category' id='dish_category' class='form-control dish_category'>
                  <option selected disabled>  selecciona una categoría </option>
                  <?php
                  $cate = "select * from categorias";
                $data = mysqli_query($con,$cate);
                while($row=mysqli_fetch_assoc($data)){
                  ?>
                    <option value='<?php echo $row['id'];?>'> <?php echo $row['cate_name'];?></option> 
                <?php  } ?>
                  </select>
                </div>
                </div>
				 <div class='col-sm-6'>
                <div class="form-group">
                  <label for="price">Precio del plato</label>
                  <input type="text"   name='price'  class="form-control price" id="price" placeholder="Precio del plato">
                </div>
                </div>
				<div class='col-sm-6'>
					<div class="form-group">
					  <label for="code">Imagen de plato</label>
					  <input type="file"  name='file' class="form-control file" id="file">
				   </div>
                </div>
				<div class='col-sm-12 dish_image_edit'>
					
				</div>
				<div class='col-sm-12'>
                <div class="form-group">
                  <label for="description">Descripción</label>
                  <textarea rows='5'  name='description' class='form-control description' id='description'></textarea>
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
<div class="modal fade in" id="modal-add-dish-to-restaurant">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Agregar plato a los restaurantes principales</h4>
              </div>
              <div class="modal-body">
			  <div class='row'>
               <div class='col-sm-12'>
                <div class="form-group">
                  <label for="select2_restaurants" style='width:100%'>Seleccionar Restaurante <small class='pull-right'> Puede seleccionar varios restaurantes</small> </label>
                  <select class='select2_restaurants form-control' style='width:100%' name="dishes[]" multiple="multiple" id="select2_restaurants">
				  
				  </select>
                </div>
			   </div>
			   <div class='col-sm-12'>
                <div class="form-group">
                  <label for="dish_name_rest">Nombre del plato</label>
                  <input type="text"   name='dish_name_rest'  class="form-control dish_name_rest" id="dish_name_rest" placeholder="Precio del plato">
                </div>
			   </div>
			   <div class='col-sm-12'>
                <div class="form-group">
                  <label for="price_restaurant">Precio del plato</label>
                  <input type="text"   name='price_restaurant'  class="form-control price_restaurant" id="price_restaurant" placeholder="Precio del plato">
                </div>
			   </div>
			   <div class='col-sm-12'>
                <div class="form-group">
                  <label for="description_dish">Descripción del plato</label>
                 <textarea rows='5' id='description_dish' class='description_dish form-control' name='description_dish'></textarea>
                  <input type="hidden"   name='dish_id'  class="dish_id" id="dish_id" >
                </div>
			   </div>
			  </div>
			  </div>
              <div class="modal-footer">
			   <input type="hidden"  id="dish_cat">
			   <input type="hidden"  id="dish_image">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerca</button>
                <button type="button" class="btn btn-primary btn-add-restaurant-dishes">Añadir</button>
              </div>
            </div>
			
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>
<div class="modal fade in" id="modal-dish-prop">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header" style="background:#204d74">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" style="color:white">Propiedades del plato</h4>
              </div>
              <div class="modal-body">
			  <div class='row' style='margin-bottom:10px'>
				<div class='col-sm-12'>
					<table class='table table-striped'>
						<thead>
							<th>Talla</th>
							<th>Precio</th>
							<th>Ingredientes</th>
							<th>Acción</th>
						</thead>
						<tbody class='properties_data'>
						
						
						</tbody>
					</table>
			   </div>
              </div>
			  </div>
              <div class="modal-footer">
			   <input type="hidden"  id="dish_cat">
			   <input type="hidden"  id="dish_image">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cerca</button>
              </div>
            </div>
			
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>

<div class="modal fade in" id="modal-edit-property">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Editar plato </h4>
              </div>
              <div class="modal-body">
			  <form method='post' action="" enctype='multipart/form-data' id='edit-prop'>
			  <div class='row'>
                <div class='col-sm-6'>
                <div class="form-group">
                  <label for="prop_name">Talla</label>
                  <input type="text"  class="form-control prop_name" name='prop_name' id="prop_name" placeholder="talla">
                </div></div>
				 <div class='col-sm-6'>
                <div class="form-group">
                  <label for="price">Precio</label>
                  <input type="text"   name='price'  class="form-control price" id="price" placeholder="Precio">
                </div>
                </div>
				<div class='col-sm-12'>
                <div class="form-group">
                  <label for="ingredients">Ingredients</label>
                  <textarea rows='5'  name='ingredients' class='form-control ingredients' id='ingredients'></textarea>
                </div>
              </div>
              </div>
              </div>
              <div class="modal-footer">
			    <input type="hidden"  id="prop_id" name="prop_id">
			    <input type="hidden"  id="dish_prop_id" name="dish_prop_id">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerca</button>
                <button type="button" class="btn btn-primary btn-update-dish-prop">Guardar cambios</button>
              </div>
            </div>
			</form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>