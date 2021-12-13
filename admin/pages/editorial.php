<?php
		$query = "SELECT DISTINCT editorial FROM products";
        $results = mysqli_query($con,$query);
	   
?>
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
              <h3 class="box-title">Buscar editorial</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method='post' id='insertion'>
              <div class="box-body">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="editorial">Nom de l’editorial</label>
                      <select class="form-control editorial" id="editorial" name='editorial'>
                        <?php
                        while($row  = mysqli_fetch_assoc($results)){
                        ?>
                          <option value="<?= $row["editorial"] ?>"><?= $row["editorial"] ?> </option>
                          <?php }
                          ?>
                      </select>
                    </div>
                   </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  <div class="col-sm-6">
                <button type="submit" name='sub' class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                </div>
              </div>
            </form>
          </div>
          
          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title pull-left">Resultats de la búsqueda</h3>
              <a href='https://emdnstore.es/admin/editorial-pdf.php' class="btn btn-primary pull-right download_as_pdf" style='display:none'> <i class="fa fa-download"></i> Descarregar Llistat</a>
            </div>
             <div class="box-body search_result container">
                  <h3 class="text-center text-red">No s'han trobat dades</h3>
              </div>
              <div id="elementH"></div>
          </div>
</section>