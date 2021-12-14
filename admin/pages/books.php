
    <section class="content-header">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Llibres</h3>
              <a href='' class='btn bg-maroon pull-right btn-category' data-page='add_book'> Afegir nou llibre </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No#</th>
                  <th>Nom del Llibres</th>
                  <th>Nom del curs</th>
                  <th>Crear ISBN</th>
                  <th>Editorial</th>
                  <th>Preu Final</th>
                  <th>Obligatori</th>
                  <th>IVA</th>
                  <th>Imatge</th>
                  <th>Modalidad</th>
                  <th>Orden</th>
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
          <div class="modal-dialog modal-lg ">
            <div class="modal-content">
              <div class="modal-header bg-pink">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Editar Llibres</h4>
              </div>
              <div class="modal-body">
            <form role="form" method='post' action='' id='edit' enctype='multipart/form-data'>

              <div class="box-body">

			   <div class='col-sm-4'>

                <div class="form-group">

                  <label for="bookname">Nom del Llibres</label>

                  <input type="text"  class="form-control bookname" name='bookname' id="bookname" placeholder="Titulo del Llibres">

                </div></div>
				<div class='col-sm-4'>

                <div class="form-group">

                  <label for="course_id">Cursos</label>
					<select class="form-control  course_id" id="course_id" name="course_id">
						 <option value="">seleccionar curso</option>
						  <?php
						  $categeoires = mysqli_query($con,"Select * from courses");
						  while($row  =  mysqli_fetch_assoc($categeoires)){
						  ?>
						  <option value="<?php echo $row['id'];?>"><?php echo $row['course_name'];?></option>
						<?php } ?>
						</select>
                </div>

                </div>
			
				<div class='col-sm-4'>

                <div class="form-group">

                  <label for="isbn">Crear ISBN</label>

                  <input type="text"   name='isbn'  class="form-control isbn" id="isbn" >

                </div>

                </div>
				
				
				<div class='col-sm-4'>

                <div class="form-group">

                  <label for="editorial">Editorial</label>

                  <input type="text"   name='editorial'  class="form-control editorial" id="editorial" >

                </div>

                </div>
                
                
                 <div class='col-sm-4'>

                <div class="form-group">

                  <label for="pre_final">Preu Final</label>

                  <input type="text"   name='pre_final'  class="form-control pre_final" id="pre_final" >

                </div>

                </div>
                <div class='col-sm-4'>

                <div class="form-group">

                  <label for="bookimage">Imatge del Llibres 

                  <input type="file"  name='bookimage'  class="form-control bookimage" id="bookimage">

                </div>

                </div>
                
                <div class='col-sm-4'>

<div class="form-group">

  <label for="pre_final">Modalidad</label>
  <?php 
                      $categories =  mysqli_query($con,"SELECT * FROM `modalidad`");
                      while($cat =  mysqli_fetch_assoc($categories)){
                      ?><br>
                      <input type="checkbox" name="modalidad[]" value="<?= $cat['id']  ?>" id="modal<?= $cat['id']  ?>"> <label for="modal<?= $cat['id']  ?>"><?= $cat['modalidad']  ?></label>
                      <?php } ?>

</div>

</div>
                 <div class='col-sm-4'>

                <div class="form-group">

                  <label for="obligatori">Obligatori</label><br>

                 <label class="radio-inline">
                      <input type="radio" id='obligatorisi' name="obligatori" value='SI'>SI
                    </label>
                    <label class="radio-inline">
                      <input type="radio" id='obligatorino' name="obligatori" value='NO'>NO
                    </label>

                </div>

                </div>
                
                <div class='col-sm-4'>

                <div class="form-group">

                  <label for="iva">IVA</label><br>

                    <label class="radio-inline">
                      <input type="radio" name="iva" id='iva4' value='4%'>4%
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="iva" id='iva21' value='21%'>21%
                    </label>
                </div>

                </div>

				<div class="col-sm-4">

        </div>
        <div class="col-sm-4">
        <label for="pre_final">Orden</label>

<input type="text"   name='orden'  class="form-control pre_final" id="orden" >

        </div>

				<div class='col-sm-12'>

                <div class="form-group">

                  <label for="description">Descripcio de Llibres</label>

                  <textarea rows='5'  name='description' class='form-control description' id='description'></textarea>

                </div>

              </div>
              
              </div>
              <div class="modal-footer">
			  <input type="hidden"  id="cat_id">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerca</button>
                <button type="button" class="btn btn-primary btn-update">Guardar cambios</button>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>



