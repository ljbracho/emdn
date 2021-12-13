<?php
		$query = "SELECT * from categorias";
        $results = mysqli_query($con,$query);
	   
?>
<style>
.search_table thead {
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
            <h3 class="box-title">llistat per curs </h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method='post' id='insertion'>
            <div class="box-body">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="editorial">Seleccionar Etapa </label>
                        <select class="form-control editorial" id="Etapa" name='Etapa'>
                            <option value="#">-- Seleccione --</option>
                            <?php
                        while($row  = mysqli_fetch_assoc($results)){
                        ?>
                            <option value="<?= $row["id"] ?>"><?= $row["cat_name"] ?> </option>
                            <?php }
                          ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="editorial">Seleccionar Curs </label>
                        <select class="form-control editorial" id="course" name='course'>
                            <option value="#">-- Seleccione --</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <div class="col-sm-6">
                    <button type="button" name='sub' class="btn btn-primary" id="btn-busca"><i class="fa fa-search"></i>
                        Buscar</button>
                </div>
            </div>
        </form>
    </div>


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title pull-left">Resultats de la búsqueda</h3>
            <a href='https://emdnstore.es/admin/editorial-pdf.php' class="btn btn-primary pull-right download_as_pdf"
                style='display:none'> <i class="fa fa-download"></i> Descarregar Llistat</a>
        </div>
        <div class="box-body search_result container">
            <h3 class="text-center text-red">No s'han trobat dades</h3>
        </div>
        <div id="elementH"></div>
    </div>
</section>

<script type="text/javascript">
$(function() {
    $("#Etapa").change(function() {
        let etapa = $(this).val();
        $.ajax({
            url: 'cheffunctions.php',
            method: 'POST',
            data: {
                action: 'get_curs_by_etapa',
                etapa_id: etapa
            },
            dataType: 'json',
            success: function(data) {
                if (data.error) {

                } else {
                $('#course').empty();
                  for (i=0; i < data.courses.length; i++) {
                    $('#course').append("<option value='" +  data.courses[i].id + "'>" +  data.courses[i].course_name  + "</option>");
                }
                }

            }
        });
    });


    $("#btn-busca").click(function(){
      let course = $('#course').val();
      var searched_html = "";
        $.ajax({
            url: 'cheffunctions.php',
            method: 'POST',
            data: {
                action: 'get_students_books',
                course: course
            },
            dataType: 'json',
            success: function(data) {
                if (data.error) {

                } else {
                  
								        if(data.students.length > 0){
                  searched_html +="<h3 class='text-center'>"+data.students[0].course_name+"</h3>";
								        searched_html +="<table class='table table-bordered search_table'><thead><th>Noms de l'alumne/a</th><th>Nº de llibres</th><th>Total</th></thead><tbody>";
                        
								        for(j = 0 ; j<data.students.length ; j++){
								            searched_html +="<tr><td>"+data.students[j].last_name_std + " " + data.students[j].name_std +"</td><td>"+ data.students[j].libros +"</td><td> € "+ data.students[j].total_price +"</td></tr>"
								        }
                        searched_html +="</tbody></table>";
                        $('.search_result').html(searched_html);
                      } else {
                        $('.search_result').html(" <h3 class='text-center text-red'>No s'han trobat dades</h3>");
                      }
                }

            }
        });
    });
});
</script>