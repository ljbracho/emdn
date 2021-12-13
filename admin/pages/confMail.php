<?php

$query = "select * from config_messages where tipo = 1";
$query_result = mysqli_query($con, $query);
if ($row =  mysqli_fetch_assoc($query_result)) {
    $msg = $row["message"];
    $id = $row["id"];
} else {
    $msg = "";
    $id= 0;
}

?>

<section class="content-header">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Correo</h3>
        </div>
        <!-- /.box-header -->
        <form action="#" method="post" name="formMsg" id='insertion'>
        <div class="box-body">

            <div class="form-group">
                <div class="col-md-12">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <input type="hidden" name="tipo" value="1">
                    <input type="hidden" name="estatus" value="1">
                    <label for="message">Escriviu o modifiqueu el missatge que s'envia per correu </label>
                    <textarea class="form-control" rows="5" cols="80" name="message" id="message"><?= $msg; ?></textarea>
                </div>
            </div>
            <div class='col-sm-12 form-group'>

            <br><br>
            <button type="submit" name='sub' class="btn btn-primary">Guardar</button>

            </div>
        </div>
        </form>
        <!-- /.box-body -->
    </div>
</section>

<script src="bower_components/ckeditor/ckeditor5.js"></script>

<script type="text/javascript">
    ClassicEditor
        .create(document.querySelector('#message'), {

            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'outdent',
                    'indent',
                    '|',
                    'imageUpload',
                    'blockQuote',
                    'insertTable',
                    'mediaEmbed',
                    'undo',
                    'redo',
                    'alignment',
                    'fontBackgroundColor',
                    'fontColor',
                    'fontSize'
                ]
            },
            language: 'es',
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'imageStyle:full',
                    'imageStyle:side'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells', 'tableProperties', 'tableCellProperties'
                ]
            },
            licenseKey: '',
        })
        .then(editor => {
            window.message = editor;
        })
        .catch(error => {
            console.error('Oops, something went wrong!');
            console.warn('Build id: p2xt4ajiinhw-fv9dvfh0os5b');
            console.error(error);
        });

        $("#formMsg").validate({
					rules: {
						pass: {
							required: true
						},
						new_pass:"required"
					},
					messages: {
						pass: {
							required: "Please enter password"
						},
						new_pass:"Please enter the new password"
					},
					submitHandler: function(form) {
					var fd = new FormData(form);
						fd.append('action_edit_update','changePass');
						fd.append('page','changePass');
						fd.append('catid','changePass');
							$.ajax({
							url:'cheffunctions.php',
							method:'POST',
							data: fd,
							contentType: false,
							processData: false,
							dataType:'json',
							beforeSend: function(){
								if(currentRequest != null){
									currentRequest.abort();
								}
								$.preloader.start({
									modal: true,
									src : 'dist/img/loader.svg'
								});
							},
							success: function(data){
								$.preloader.stop();
								if(data.error){
									//alert();
									Swal.fire({
										icon: 'error',
										title: 'Oops...',
										text: 'Sorry '+ data.message,
									});
								}else{
										Swal.fire({
											icon: 'success',
											title: 'Success!',
											showConfirmButton: false,
											text: data.message,
											timer: 3000
										});
										$('#insertion')[0].reset();
								}	
							},
							error: function (jqXHR, exception) {
									getErrorMessage(jqXHR, exception);
							}
						});
					},
					error: function (jqXHR, exception) {
						getErrorMessage(jqXHR, exception);
					}
			});
</script>