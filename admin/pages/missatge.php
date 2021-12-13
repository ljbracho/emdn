<?php 
include('./connection.php');

?>
    <!-- Main content -->
    <section class="content">
	<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Missatge General</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method='post' id='insertion_genral'>
              <div class="box-body">
                
                <div class="form-group">
                  <label for="general_message">Afegeix un missatge general</label>
                  
                  <?php 
                  $get_gmsg = mysqli_fetch_assoc(mysqli_query($con,"select * from messages where course_id = '0'"));
                  
                  ?>
                  <textarea rows='5' class='form-control general_message' id="general_message" name='general_message'><?php echo nl2br($get_gmsg['message_content']);?></textarea>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name='sub' class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>
          
          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Missatge per els cursos</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method='post' id='insertion_course'>
              <div class="box-body">
                  
                <div class="form-group">
                  <label for="missatge_course">Curs</label>
                  <select class="form-control missatge_course" name="missatge_course" id="missatge_course">
                      <option value="" selected>Afegeix un missatge al curs</option>
                      <?php
						  $categeoires = mysqli_query($con,"Select * from courses");
						  while($row  =  mysqli_fetch_assoc($categeoires)){
						  ?>
						  <option value="<?php echo $row['id'];?>"><?php echo $row['course_name'];?></option>
						<?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="course_message">Afegeix un missatge al curs</label>
                  <textarea rows='5' class='form-control course_message' id="course_message" name='course_message'></textarea>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name='sub' class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>
          
    </section>