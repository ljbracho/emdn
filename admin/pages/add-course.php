
    <section class="content-header">
    
    </section>

    <!-- Main content -->
    <section class="content">
	<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Afegir curs</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method='post' id='insertion'>
              <div class="box-body">
                <div class="form-group">
                  <label for="course_name">Nom del curs</label>
                  <input type="text" class="form-control course_name" id="course_name" name='course_name' placeholder="nombre de la Curso">
                </div>
                <div class="form-group">
                  <label for="etpa">Seleccionar etapa</label>
                  <select name="etpa" class="form-control etpa" id='etpa'>
                       <option value=""> Seleccionar etapa</option>
                      <?php 
                      $categories =  mysqli_query($con,"SELECT * FROM `categorias`");
                      while($cat =  mysqli_fetch_assoc($categories)){
                      ?>
                      <option value="<?php echo $cat['id'];?>"> <?php echo $cat['cat_name'] ?></option>
                      <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="code">Descripció del curs</label>
                  <textarea rows='5' class='form-control description' name='description'></textarea>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name='sub' class="btn btn-primary">Afegir curs</button>
              </div>
            </form>
          </div>
    </section>