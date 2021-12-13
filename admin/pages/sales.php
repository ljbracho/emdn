<style>
    
    .search_table thead{
            background: #7c8282;
            color: white;
    }
</style>
<section class="content-header">
    
    </section>

    <!-- Main content -->
    <section class="content">
	    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Venda de curs</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method='post' id='insertion'>
              <div class="box-body">
                 <div class="form-group">
                  <label for="missatge_course">Curs</label>
                  <select class="form-control course_sale" name="course_sale" id="course_sale">
                      <option value="" selected>Selecciona el curs</option>
                      <?php
						  $categeoires = mysqli_query($con,"Select * from courses");
						  while($row  =  mysqli_fetch_assoc($categeoires)){
						  ?>
						  <option value="<?php echo $row['id'];?>"><?php echo $row['course_name'];?></option>
						<?php } ?>
                  </select>
                </div>
              </div>
             
            </form>
          </div>
          
          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title text-center">VENDA DE LLIBRES PER CURS</h3>
              </div>
             <div class="box-body books_sale  container">
                  <h3 class="text-center text-red">Encara no hi ha vendes</h3>
              </div>
              <div id="elementH"></div>
          </div>
</section>