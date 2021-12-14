<?php 
include('./connection.php');

?>
    <section class="content-header">

    

    </section>

    <!-- Main content -->

    <section class="content">

	<div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title">Afegir Llibres</h3>
            </div>

            <!-- /.box-header -->

            <!-- form start -->

            <form role="form" method='post' action='' id='insertion' enctype='multipart/form-data'>

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
                
                <div class='col-sm-4 modality_box' style='display:none'>

                <div class="form-group">

                  <label for="modality">Modalitat</label>
					<select class="form-control  modality" id="modality" name="modality">
						
					</select>
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

                  <label for="isbn">Crear ISBN</label>

                  <input type="text"   name='isbn'  class="form-control isbn" id="isbn" >

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
                      <input type="radio" id='obligatori' name="obligatori" value='SI'>SI
                    </label>
                    <label class="radio-inline">
                      <input type="radio" id='obligatori' name="obligatori" value='NO'>NO
                    </label>

                </div>

                </div>
                
                <div class='col-sm-4'>

                <div class="form-group">

                  <label for="iva">IVA</label><br>

                    <label class="radio-inline">
                      <input type="radio" name="iva" value='4%'>4%
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="iva" value='21%'>21%
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

                  <label for="description">Descripción de Llibres</label>

                  <textarea rows='5'  name='description' class='form-control description' id='description'></textarea>

                </div>

              </div>

              </div>

              <!-- /.box-body -->

			

              <div class="box-footer">

			   <div class='col-sm-12'>

                <button type="submit" name='sub' class="btn btn-primary">Afegir Llibres</button>

              </div>

              </div>

            </form>

          </div>

    </section>