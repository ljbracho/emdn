
    <section class="content-header">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Etapa</h3>
              <a href='' class='btn btn-primary pull-right btn-category' data-page='add-category'> Afegir nova etapa</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No#</th>
                  <th>Nom de l’etapa </th>
                  <th>Descripció </th>
                  <th>Acció </th>
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
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header bg-pink">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Editar etapa</h4>
              </div>
              <div class="modal-body">
                  <div class='row'>
                       <form method="post" action=""  id='edit'>
                <div class='col-sm-12'>
                <div class="form-group">
                  <label for="cat_name">Nom de l’etapa</label>
                  <input type="text" required  name='cat_name'  class="form-control cat_name" id="cat_name" placeholder="Enter Cateory name">
                </div>
                </div>
				<div class='col-sm-12' style='margin-top:12px'>
                <div class="form-group">
                  <label for="cat_description">Descripció </label>
                  <textarea rows='5' required name='cat_description' class='form-control cat_description' id='cat_description'></textarea>
                </div>
                </div>
              </div>
              </div>
              <div class="modal-footer">
			  <input type="hidden"  id="cat_id">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerca</button>
                <button type="button" class="btn btn-primary btn-update">Guardar cambis</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>