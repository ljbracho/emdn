    <section class="content-header">
    
    </section>

    <!-- Main content -->
    <section class="content">
	<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar tamaño</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method='post' id='insertion'>
              <div class="box-body">
                <div class="form-group">
                  <label for="size_name">Nombre del tamaño</label>
                  <input type="text" class="form-control size_name" id="size_name" name='size_name' placeholder="Nombre del tamano">
                </div>
                 <div class="form-group">

                  <label for="price">Precio</label>

                  <input type="text"   name='size_price'  class="form-control size_price" id="size_price" placeholder="Precio">

                </div>
                <div class="form-group">
                  <label for="size_name">Tamaño de la imagen</label>
                  <input type="file" class="form-control size_img" id="size_img" name='size_img' >
                </div>
                
                <div class="form-group">
                  <label for="size_desc">Descripcion de tamaño</label>
                  <textarea rows='5' class='form-control size_desc' name='size_desc'></textarea>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name='sub' class="btn btn-primary">Agregar tamaño</button>
              </div>
            </form>
          </div>
    </section>