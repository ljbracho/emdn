
    <section class="content-header">
    
    </section>

    <!-- Main content -->
    <section class="content">
	<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Afegir etapa</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method='post' id='insertion'>
              <div class="box-body">
                <div class="form-group">
                  <label for="product">Nom de Modalidad</label>
                  <input type="text" class="form-control modalidad" id="modalidad" name='modalidad' placeholder="modalidad">
                </div>
                
                <div class="form-group">
                  <label for="cat_name">Tipo</label>
                  <select name="tipo" id="tipo" class="form-control">
                    <option value="1">Modalidad</option>
                    <option value="2">Itinerario</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name='sub' class="btn btn-primary">Afegir etapa</button>
              </div>
            </form>
          </div>
    </section>