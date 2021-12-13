
    <section class="content-header">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Curs</h3>
              <a href='' class='btn btn-primary pull-right btn-category' data-page='add-course'>  Afegir curs </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO#</th>
                  <th>Nombre del Curs</th>
                  <th>Etapa</th>
                  <th>Descripcio</th>
                  <th>Accio</th>
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
              <div class="modal-header bg-pink">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">x</span></span></button>
                <h4 class="modal-title">Editar Curso </h4>
              </div>
              <div class="modal-body">
                <div class='row'>
                <div class='col-sm-12'>
                <div class="form-group">
                  <label for="course_name">Nombre del Curso</label>
                  <input type="text" class="form-control course_name" id="course_name" name='course_name' placeholder="Nombre del tamano">
                <div class="form-group">
                  <label for="desciption">Descripcion de Curso</label>
                  <textarea rows='5' class='form-control desciption' id="desciption" name='desciption'></textarea>
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