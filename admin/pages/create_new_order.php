<?php
include('./connection.php');

?>
<section class="content-header">



</section>

<!-- Main content -->

<section class="content">

    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">Crea una comanda nova</h3>
        </div>

        <!-- /.box-header -->

        <!-- form start -->

        <form role="form" method='post' action='' id='insertion' enctype='multipart/form-data'>

            <div class="box-body">

                <div class='col-sm-3'>

                    <div class="form-group">
                        <label for="etpa">Seleccionar etapa</label>
                        <select name="etpa" class="form-control stage" id='etpa'>
                            <option value=""> Seleccionar etapa</option>
                            <?php
              $categories =  mysqli_query($con, "SELECT * FROM `categorias`");
              while ($cat =  mysqli_fetch_assoc($categories)) {
              ?>
                            <option value="<?php echo $cat['id']; ?>"> <?php echo $cat['cat_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class='col-sm-3'>

                    <div class="form-group">

                        <label for="course_order_id">Cursos</label>
                        <select class="form-control  course" id="course_order_id" name="course_order_id">
                            <option value="">seleccionar curso</option>

                        </select>
                    </div>

                </div>

                <div class='col-sm-3 modality_box' id="modality_box"  style='display:none'>

                    <div class="form-group">

                        <label for="modality">Modalitat</label>
                        <select class="form-control  modality" id="modality" name="modality">

                        </select>
                    </div>

                </div>

                <div class='col-sm-3'>

                    <div class="form-group">

                        <label for="order_amount">Estat de pagament de la comanda</label>
                        <select class="form-control order_amount" id="order_amount" name='order_amount'>
                            <option value="pending"> Import pendent </option>
                            <option value="paid"> Quantitat pagada </option>
                            <option value="" selected>Estat de pagament</option>
                        </select>
                    </div>

                </div>
                <div class='col-sm-12 box-books' style='display:none'>

                    <table class="table text-center table-bordered">
                        <thead class="thead-dark">
                            <tr class='text-center'>
                                <th scope="col">ISBN</th>
                                <th scope="col">Nom del llibre </th>
                                <th scope="col">Editorial</th>
                                <th scope="col">Comprar</th>
                                <th scope="col">Total €</th>
                            </tr>
                        </thead>
                        <tbody class='tr_body'>



                        </tbody>
                    </table>



                </div>




                <div class='col-sm-4'>
                    <div class="form-group">
                        <label for="std_name">Noms de l'alumne/a</label>
                        <input type="text" name='std_name' class="form-control std_name" id="std_name">
                    </div>

                </div>
                <div class='col-sm-4'>
                    <div class="form-group">
                        <label for="std_name">cognoms de l'alumne/a</label>
                        <input type="text" name='std_last_name' class="form-control std_last_name" id="std_last_name">
                    </div>

                </div>
                <div class='col-sm-4'>

                    <div class="form-group">

                        <label for="parent">Nom del pare o mare</label>

                        <input type="text" name='parent' class="form-control parent" id="parent">

                    </div>

                </div>

                <div class='col-sm-4'>

                    <div class="form-group">

                        <label for="dni">DNI pare o mare</label>

                        <input type="text" name='dni' class="form-control dni" id="dni">

                    </div>

                </div>
                <div class='col-sm-4'>

                    <div class="form-group">

                        <label for="pre_final">Correu electrònic</label>

                        <input type="text" name='order_email' class="form-control order_email" id="order_email">

                    </div>

                </div>

                <div class='col-sm-4'>

                    <div class="form-group">

                        <label for="order_telephone">Telèfon de contacte</label>
                        <input type="text" name='order_telephone' class="form-control order_telephone"
                            id="order_telephone">
                    </div>

                </div>


            </div>

            <!-- /.box-body -->



            <div class="box-footer">

                <div class='col-sm-12'>

                    <button type="submit" name='sub' class="btn btn-primary">Afegir comanda</button>

                </div>

            </div>

        </form>

    </div>

</section>