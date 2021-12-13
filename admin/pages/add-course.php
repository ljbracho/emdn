
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
                </div><div class="form-group">
                  <label for="etpa">Seleccionar Modalidad / Itinerario</label>
                  
                  <select name="tipo" id="tipo" class="form-control">
                  <option value="0" selected disabled >-- Seleccionar --</option>
                    <option value="1">Modalidad</option>
                    <option value="2">Itinerario</option>
                  </select>
                  <div id="modales">


                  </div>
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

    
<script type="text/javascript">
$(function() {
    $("#tipo").change(function() {
        let modal = $(this).val();
        $.ajax({
            url: 'cheffunctions.php',
            method: 'POST',
            data: {
                action: 'get_modals_tipo',
                tipo: modal
            },
            dataType: 'json',
            success: function(data) {
                if (data.error) {

                } else {
                $('#modales').empty();
                  for (i=0; i < data.modals.length; i++) {
                    $('#modales').append("<br><input type='checkbox' name='modalidad[]' value='"+ data.modals[i].id +"' id='modal"+ data.modals[i].id +"'> <label for='modal"+ data.modals[i].id +"'> " + data.modals[i].modalidad +"</label>");
                }
                }

            }
        });
    });

});
</script>