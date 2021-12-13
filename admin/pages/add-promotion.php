 <section class="content-header">
    
    </section>

    <!-- Main content -->
    <section class="content">
	<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar promociones</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method='post' id='insertion'>
              <div class="box-body">
                <div class="form-group">
                  <label for="promotion_name">Nombre de la promociones</label>
                  <input type="text" class="form-control promotion_name" id="promotion_name" name='promotion_name' placeholder="Nombre de la marca">
                </div>
                <div class="form-group">
                  <label for="promotion_image">Imagen de promoción</label>
                  <input type="file" class="form-control promotion_image" id="promotion_image" name='promotion_image' placeholder="Nombre de la marca">
                </div>
                <div class="form-group">
                  <label for="pro_description">Descripcion de promociones</label>
                  <textarea rows='5' class='form-control pro_description' name='pro_description'></textarea>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name='sub' class="btn btn-primary">Agregar promociones</button>
              </div>
            </form>
          </div>
    </section>