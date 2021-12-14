$(document).ready(function(){
   var currentRequest;
   var dataTableAjax;
   if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    
    // document.addEventListener('contextmenu', function(e) {
    //   e.preventDefault();
    // });

$(document).on("click",'.sidebar-menu li a,.btn-restaurant,.small-box-footer,.btn-logout,.btn-profile,.add-dish,.btn-category',function(e){
		 e.preventDefault();
		  $('.modal').modal('hide');
		 var page = $(this).data('page');
		 if(page=='logout'){
			 window.location.href = 'logout.php';
			 return;
		 }
		 // alert(page);
		 if(page != "Categorias" && page!= "platos" && page != "restaurants"){
			 $('.sidebar-menu li').removeClass('active');
			$(this).parent().addClass('active');
			ajaxPageContent(page);
		 }
		 if(page=='users' || page=='dashboard' || page=='restaurant'){
			 $('.treeview').removeClass('menu-open');
			 $('.treeview-menu').css("display","none");
		 }
		
		$('body').scrollTop(0);
	});
	
	function ajaxPageContent(page){
		var data={
			'getPageContent':page
		}
		currentRequest = $.ajax({
			url:'cheffunctions.php',
			dataType: 'html',
			data: data,
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
				$('.content-wrapper').html(data);
				switch(page){
					case "category":				
					dataTableAjax = $('#example1').DataTable({
								  'processing': true,
								  'serverSide': true,
								  'serverMethod': 'post',
								  'ajax': {
									  'url':'cheffunctions.php?action=get_categories'
								  },
								"order": [[ 0, "desc" ]],
								"columns": [
									{ "data": "id" },
									{ "data": "cate_name" },
									{ "data": "cate_description" },
									{ "data": "action_del_edit" }
								],
								"columnDefs": [ {
									"targets": [2,3],
									"orderable": false
									}],
								responsive: true
							});
					break;
					case "modal":				
					dataTableAjax = $('#example1').DataTable({
								  'processing': true,
								  'serverSide': true,
								  'serverMethod': 'post',
								  'ajax': {
									  'url':'cheffunctions.php?action=get_modals'
								  },
								"order": [[ 0, "desc" ]],
								"columns": [
									{ "data": "id" },
									{ "data": "modalidad" },
									{ "data": "tipo" },
									{ "data": "action_del_edit" }
								],
								"columnDefs": [ {
									"targets": [2,3],
									"orderable": false
									}],
								responsive: true
							});
					break;
					case "promotions":				
					dataTableAjax = $('#example1').DataTable({
								  'processing': true,
								  'serverSide': true,
								  'serverMethod': 'post',
								  'ajax': {
									  'url':'cheffunctions.php?action=promotions'
								  },
								"order": [[ 0, "desc" ]],
								"columns": [
									{ "data": "id" },
									{ "data": "promotion_image" },
									{ "data": "promotion_name" },
									{ "data": "description" },
									{ "data": "action_del_edit" }
								],
								"columnDefs": [ {
									"targets": [3,4],
									"orderable": false
									}],
								responsive: true
							});
					break;
					case "transactions":				
					dataTableAjax = $('#example1').DataTable({
								  'processing': true,
								  'serverSide': true,
								  'serverMethod': 'post',
								  'ajax': {
									  'url':'cheffunctions.php?action=get_transactions'
								  },
								"order": [[ 0, "desc" ]],
								"columns": [
									{ "data": "id" },
									{ "data": "order_id" },
									{"data" : "std_name"},
									{ "data": "price" },
								//	{ "data": "payment_method" },
								//	{ "data": "payment_status" },
									{ "data": "datetime" },
									{ "data": "action_del_edit" }
								],
								"columnDefs": [ {
									"targets": [3,4],
									"orderable": false
									}],
								responsive: true
							});
					break;
					case "courses":				
					dataTableAjax = $('#example1').DataTable({
								  'processing': true,
								  'serverSide': true,
								  'serverMethod': 'post',
								  'ajax': {
									  'url':'cheffunctions.php?action=get_courses'
								  },
								"order": [[ 0, "desc" ]],
								"columns": [
									{ "data": "id" },
									{ "data": "course_name" },
									{ "data": "etpa" },
									{ "data": "description" },
									{ "data": "action_del_edit" }
								],
								"columnDefs": [ {
									"targets": [2,3,4],
									"orderable": false
									}],
								responsive: true
							});
					break;
					case "brands":				
					dataTableAjax = $('#example1').DataTable({
								  'processing': true,
								  'serverSide': true,
								  'serverMethod': 'post',
								  'ajax': {
									  'url':'cheffunctions.php?action=get_brands'
								  },
								"order": [[ 0, "desc" ]],
								"columns": [
									{ "data": "id" },
									{ "data": "brand_name" },
									{ "data": "description" },
									{ "data": "action_del_edit" }
								],
								"columnDefs": [ {
									"targets": [2,3],
									"orderable": false
									}],
								responsive: true
							});
					break;
					case "users":				
					dataTableAjax = $('#example1').DataTable({
								  'processing': true,
								  'serverSide': true,
								  'serverMethod': 'post',
								  'ajax': {
									  'url':'cheffunctions.php?action=get_users'
								  },
								"order": [[ 0, "desc" ]],
								"columns": [
									{ "data": "id" },
									{ "data": "image" },
									{ "data": "username" },
									{ "data": "email" },
									{ "data": "phone" },
									{ "data": "address" }
								],
								"columnDefs": [ {
									"targets": [2,3,4],
									"orderable": false
									}],
									responsive: true
							});
					break;
					case "books":				
					dataTableAjax = $('#example1').DataTable({
								  'processing': true,
								  'serverSide': true,
								  'serverMethod': 'post',
								  'ajax': {
									  'url':'cheffunctions.php?action=get_books'
								  },
								"columns": [
									{ "data": "id" },
									{ "data": "book_name" },
									{ "data": "course_id" },
									{ "data": "isbn" },
									{ "data": "editorial" },
									{ "data": "preu_final" },
									{ "data": "obligatori" },
									{ "data": "iva" },
									{ "data": "image" },
								    { "data": "modalidad" },
								    { "data": "orden" },
									{ "data": "action_del_edit" }
								],
								"columnDefs": [ {
									"targets": [2,3,4],
									"orderable": false
									}],
									responsive: true
							});
					break;
					case "clients_order":				
					dataTableAjax = $('#example1').DataTable({
								  'processing': true,
								  'serverSide': true,
								  'serverMethod': 'post',
								  'ajax': {
									  'url':'cheffunctions.php?action=get_new_order'
								  },
								"order": [[ 0, "desc" ]],
								"columns": [
									{ "data": "id" },
									{ "data": "total_price" },
									{ "data": "course" },
									{ "data": "book_name" },
									{ "data": "name_std" },
									{ "data": "name_fth" },
									{ "data": "id_card" },
									{ "data": "email" },
								    {'data':'contact_number'},
								    // {'data':'status'},
								    {'data':'payment_method'},
								    { "data": "datetime" },
								// 	{ "data": "action_del_edit" }
								],
								"columnDefs": [ {
									"targets": [2,3,4,5,6,7],
									"orderable": false
									}],
									responsive: true
							});
							
						$('.img').hoverZoom({speedView:600, speedRemove:400, showCaption:true, speedCaption:600, debug:true, hoverIntent: true, loadingIndicatorPos: 'center', useBgImg : true});
					break;
					case "redsys":				
					dataTableAjax = $('#example1').DataTable({
								  'processing': true,
								  'serverSide': true,
								  'serverMethod': 'post',
								  'ajax': {
									  'url':'cheffunctions.php?action=get_new_order&pending=1'
								  },
								"order": [[ 0, "desc" ]],
								"columns": [
									{ "data": "id" },
									{ "data": "total_price" },
									{ "data": "course" },
									{ "data": "book_name" },
									{ "data": "name_std" },
									{ "data": "name_fth" },
									{ "data": "id_card" },
									{ "data": "email" },
								    {'data':'contact_number'},
								    // {'data':'status'},
								    {'data':'payment_method'},
								    { "data": "datetime" },
								// 	{ "data": "action_del_edit" }
								    {
								        data: null,
								        render: function (data, type, full, meta) {
								            return '<a type="button" class="btn btn-primary btn-approve" data-order="'+data.id+'" data-email="'+data.email+'" data-stdname="'+data.name_std+'" data-fthname="'+data.name_fth+'" data-dni="'+data.id_card+'">Process</a>';
							            }
								    },
								],
								"columnDefs": [ {
									"targets": [2,3,4,5,6,7],
									"orderable": false
									}],
									responsive: true,
							});
							
						$('.img').hoverZoom({speedView:600, speedRemove:400, showCaption:true, speedCaption:600, debug:true, hoverIntent: true, loadingIndicatorPos: 'center', useBgImg : true});
					break;
					case "completed_order":				
					dataTableAjax = $('#example1').DataTable({
								  'processing': true,
								  'serverSide': true,
								  'serverMethod': 'post',
								  'ajax': {
									  'url':'cheffunctions.php?action=get_completed'
								  },
								"order": [[ 0, "desc" ]],
								"columns": [
									{ "data": "id" },
									{ "data": "total_price" },
									{ "data": "course" },
									{ "data": "book_name" },
									{ "data": "name_std" },
									{ "data": "name_fth" },
									{ "data": "id_card" },
									{ "data": "email" },
								    {'data':'contact_number'},
								    {'data':'status'},
								    {'data':'payment_method'},
								    { "data": "datetime" },
									{ "data": "action_del_edit" }
								],
								"columnDefs": [ {
									"targets": [2,3,4,5,6,7],
									"orderable": false
									}],
									responsive: true
							});
					break;
					case "editorial":
					search_editorial();
					
					break;
					case "add-promotion":
					add_promotion();
					break;
					case "add_book":
					 
					add_book();
	
            	    get_sizes();
					//$('.sizes').select2();
					//get_sizes();
					break;
					case "add-course":
					add_course();
					break;
					case "confMail":
						conf_mail();
					break;
					case "confMsgOffline":
						conf_mail();
					break;
					case "change-pass":
						change_pass();
					break;
					case "reset-bd":
						reset_bd();
					break;
					case "create_new_order":
					create_order_admin();
					break;
					case "add-modal":
					add_modal();
					break;
					case "add-category":
					add_category();
					var dataa = {
							'getallMainTypes':"getallMainTypes"
						};
					$('#main_type').select2({
							ajax: {
								url: 'cheffunctions.php',
								dataType: 'json',
								data: function (params) {
									dataa.q = params.term;
									return dataa;
								},
								processResults: function (data) {
								  return {
									results: data.results
								  };
								},
								cache: true,
							},
						});
					break;
					case "add-dish":
					add_dish();
				    break;
				    case "missatge":
					add_general_message();
					add_course_message();
					var dataa = {
							'ingredient_for_restaurant':"getallRestaurants"
						};
					$('.ingredient_restaurants').select2({
							ajax: {
								url: 'cheffunctions.php',
								dataType: 'json',
								data: function (params) {
									dataa.q = params.term;
									return dataa;
								},
								processResults: function (data) {
								  return {
									results: data.results
								  };
								},
								cache: true,
							},
							
						});
					$(document).on('change','.ingredient_restaurants',function(){
					    	var cat = {
							'ingredient_for_category':"getallcategory"
						  };
					    var restid = $(this).val();
					    cat.rest = restid;
					    $('.dish_category').select2({
							ajax: {
								url: 'cheffunctions.php',
								dataType: 'json',
								data: function (params) {
									cat.q = params.term;
									return cat;
								},
								processResults: function (data) {
								  return {
									results: data.results
								  };
								},
								cache: true,
							},
							
						});
					});
				    break;
					case "add-extra":
					add_extra();
					var dataa = {
							'ingredient_for_restaurant':"getallRestaurants"
						};
					$('.extra_restaurants').select2({
							ajax: {
								url: 'cheffunctions.php',
								dataType: 'json',
								data: function (params) {
									dataa.q = params.term;
									return dataa;
								},
								processResults: function (data) {
								  return {
									results: data.results
								  };
								},
								cache: true,
							},
							
						});
				    break;
				}
				$.preloader.stop();
				 
			},
			error: function (jqXHR, exception) {
					getErrorMessage(jqXHR, exception);
			}
		});
	}
	
	
	$(document).on('change','.stage',function(){
      var etapa =  $(this).val();
      $('.course').empty().append('<option value="0" selected disabled >Seleccionar Curs</option>');  
       $('.error_label').text('');
        $.ajax({
                url: 'cheffunctions.php',
                dataType: 'json',
                type: 'POST',
                data: {"etapa": etapa,'action':'get_curs'},
                success: function(response) {
                    console.log(response);
                  var array = response.courses;
                  if (array != '')
                  {
                    for (i in array) {                        
                     $(".course").append("<option value="+array[i].id+">"+array[i].course_name+"</option>");
                   }
    
                  }
    
                },
                error: function(x, e) {
    
                }
    
            });
      
  });
  
  
	
	
	$(document).on('click','.btn-edit-status',function(){
	    var id = $(this).data('orderid');
	    $('.btn-update-order-status').attr('data-id',id);
	    $('#modal-change-order-status').modal('show'); 
	});
	
	var i = 2;
	$(document).on('click','.btn-add-more-size',function(){
	   var html = '<div class="col-sm-6"> <div class="form-group"> <label for="size">Seleccionar tamanos</label> <select class="form-control sizes"  name="sizes" style="width: 100%;"> </select> </div></div><div class="col-sm-6 size-number-'+i+'"> <div class="form-group"> <label for="pro_units">Cantidades</label> <input type="text" name="pro_units" class="form-control pro_units" id="price_with_offer" placeholder="Cantidades"> </div></div>' ;
	   i++;
	    $('.sizes_product').prepend(html);
	    get_sizes();
	   
	});
	
	function get_sizes(){
	  //  alert('Hello');
	    var dataa = {
							'getallsizes':"getallsizes"
						};
					$('.sizes').select2({
							ajax: {
								url: 'cheffunctions.php',
								dataType: 'json',
								data: function (params) {
									dataa.q = params.term;
									return dataa;
								},
								processResults: function (data) {
								  return {
									results: data.results
								  };
								},
								cache: true,
							},
							
						});
	}
	
	$(document).on('click','.btn-update-order-status',function(){
	    var id = $(this).attr('data-id');
	    if($('.complete_status').is(':checked')){
	    $.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: {'update_order_status':'yes','order_id':id},
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
								alert('something wrong');
							}else{
							    Swal.fire({
								  icon: 'success',
								  title: 'Order Completed',
								  text: 'Order completed successfully!',
								});
							  $('#modal-change-order-status').modal('hide'); 
							  if(dataTableAjax != undefined)
							   dataTableAjax.ajax.reload();
							}
						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});
	    }else{
	        alert('Please choose the status');
	    }
	});
	$(document).on('click','.download_pdf',function(){
	    
	                 var doc = new jsPDF();
                     var elementHTML = $('.search_result').html();
                     var specialElementHandlers = {
                        '#elementH': function (element, renderer) {
                            return true;
                        }
                    };
                    doc.fromHTML(elementHTML, 15, 15, {
                        'elementHandlers': specialElementHandlers
                    });
                    
                    // Save the PDF
                    doc.save('Editorial-'+$('.editorial').val()+'.pdf');
	    
	})
	//add category
	function add_category(){
		  $("#insertion").validate({
				rules: {
					cate_name: {
						required: true
					}
				},
				messages: {
					cate_name: {
						required: "Please enter a Etpa Name"
					}
				},
				submitHandler: function(form) {
					var fd = new FormData(form);
					fd.append('addCategory','addCategory');
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
	}
	//add modalidad
	function add_modal(){
		  $("#insertion").validate({
				rules: {
					cate_name: {
						required: true
					}
				},
				messages: {
					cate_name: {
						required: "Please enter a Modalidad Name"
					}
				},
				submitHandler: function(form) {
					var fd = new FormData(form);
					fd.append('addModal','addModal');
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
	}
	//add size
	function conf_mail(){
		$("#insertion").validate({
			rules: {
				objetivo: {
					required: true
				}
			},
			messages: {
				objetivo: {
					required: "Ingrese un mensaje"
				}
			},
			submitHandler: function(form) {
			var fd = new FormData(form);
				fd.append('action_edit_update','mailMsg');
				fd.append('page','mailMsg');
				fd.append('catid','mailMsg');
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
	}

	function reset_bd(){
		$("#insertion").validate({
			rules: {
				pass: {
					required: true
				}
			},
			messages: {
				pass: {
					required: "Please enter password"
				}
			},
			submitHandler: function(form) {
			var fd = new FormData(form);
				fd.append('action_edit_update','resetBd');
				fd.append('page','resetBd');
				fd.append('catid','resetBd');
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
}

	function change_pass(){
				$("#insertion").validate({
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
   }

	function add_course(){
		 $("#insertion").validate({
				rules: {
					course_name: {
						required: true
					},
					etpa:"required"
				},
				messages: {
					course_name: {
						required: "Please enter a Course Name"
					},
					etpa:"Please select the Stage"
				},
				submitHandler: function(form) {
				var fd = new FormData(form);
					fd.append('addCourse','addCourse');
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
	}
	
	$(document).on('click','.close_modal',function(){
	    $('#modal_books_details').hide();
	});
	
	$(document).on('click','.get_book_details',function(){
	    var order_id = $(this).data('orderid');
	    $('.add_download_link').attr('href',"invoice_pdf.php/?order_id="+order_id)
	    $.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: {action:'order_books_details',order_id:order_id},
						dataType:'json',
						beforeSend: function(){
						
							$.preloader.start({
								modal: true,
								src : 'dist/img/loader.svg'
							});
						},
						success: function(data){
						    $.preloader.stop();
						    
						    if(data.error){
						        
						    }else{
						        var books_result = data.books;
						        
						        if(books_result.length > 0){
						            var html_tr = "";
						            var total = 0;
						            for(var i = 0 ; i < books_result.length ; i++){
						                var single =  books_result[i];
						                if(single.obligatori == "NO"){
						                    var check = 'checked disabled';
						                }else{
						                    var check = 'checked disabled';
						                }
						                var singlePrice = single.preu_final;
						                singlePrice = singlePrice.replace(',','.');
						                total += Number(singlePrice);
						                
						                html_tr += "<tr><td>"+single.isbn+"</td><td>"+single.book_name+"</td><td>"+single.editorial+"</td><td><input data-bookid='"+single.id+"' data-price='"+single.preu_final+"' type='checkbox' "+check+" class='checkbox_book'></td><td><b>€ </b>"+single.preu_final+"</td></tr>"
						                
						                
						            }
						            html_tr += "<tr><td colspan='4'><span style='font-size:18px;'> <b> Import total de la comanda  </b></span> </td> <td><b>€ </b> <span style='font-size:18px;' id='total_final'>"+total.toFixed(2)+"</span></td></tr>"
						            $('.tr_body').html(html_tr);
						        }
						        
						        
						       
						         $('#modal_books_details').show();
						    }
	                    
						}
	             });
	   
	})
	
		//add size
	function create_order_admin(){
		 $("#insertion").validate({
				rules: {
					etpa: {
						required: true
					},
					course_order_id:"required",
					std_name:"required",
					std_last_name:"required",
					parent:"required",
					dni:"required",
					order_email: {
					    required : true
					},
					order_telephone:"required",
					order_amount:"required"
				},
				messages: {
					
				},
				submitHandler: function(form) {
				    var products_id = [];
				    $('.tr_body tr input[type="checkbox"]').each(function(key,item){
				        
				        if($(item).is(":checked")){
				            var id = $(item).data('bookid');
				            products_id.push(id);
				            
				        }
				        
				    })
				    var books = JSON.stringify(products_id);
				    
				    var fd = new FormData(form);
					fd.append('create_Order_Admin','create_Order_Admin');
					fd.append('books',books)
					fd.append('total_price',$('#total_final').text())
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
								  text: 'Sorry '+ data.error_msg,
								});
							}else{
							        $('.box-books .tr_body').html('');
							        $('.box-books').hide();
									Swal.fire({
									  icon: 'success',
									  title: 'Success!',
									  showConfirmButton: false,
									  text: data.success_msg,
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
	}
	//add brand
	function add_promotion (){
		 $("#insertion").validate({
				rules: {
					promotion_name: {
						required: true
					},
					promotion_image: {
						required: true
					},
				},
				messages: {
					promotion_name: {
						required: "Please enter a Promotion Name"
					},
					promotion_image: {
						required: "Please Choose Image"
					}
				},
				submitHandler: function(form) {
					
				    var fd = new FormData($('#insertion')[0]);
					fd.append('addPromotion','yes');
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
								  text: 'Sorry '+ data.error_msg,
								});
							}else{
									Swal.fire({
									  icon: 'success',
									  title: 'Success!',
									  showConfirmButton: false,
									  text: data.success_msg,
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
	}
	//add category
	function add_book(){
		 $("#insertion").validate({
				rules: {
					bookname: {
						required: true
					},
					course_id :"required",
					editorial :"required",
					pvp :"required",
					pre_final :"required",
					obligatori :"required",
					iva:"required"
				},
				messages: {
					bookname: {
						required: "Please enter a Book Name"
					},
					course_id : "Please select course",
					editorial : "Please enter editorial",
					pvp : "Please enter PVP/PMM",
					pre_final : "Please enter Preu Final"
				},
				submitHandler: function(form) {
				    var i = 1;
				    var size_units = [];
				    $('.sizes').each(function(index,key){
				       var size_unite = $(this).parents('.col-sm-6').siblings('.size-number-'+i).find('.pro_units ').val();
				       var size_id = $(this).val();
				       
				       var obj = {'size_id':size_id, 'size_unit':size_unite};
				       
				       size_units.push(obj);
				       
				       
				       i++;
				       console.log("Product Units" + size_unite);
				       console.log("Product size ID" + size_id); 
				      // console.log();
				        
				    });
				    
				    //console.log(size_units);
				    //return;
				    
				    var fd = new FormData(form);
					fd.append('addproducts','yes');
					fd.append('size_units',JSON.stringify(size_units));
					
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
	}
	//add_garmenttype
	function search_editorial(){
		 $("#insertion").validate({
				rules: {
					editorial: {
						required: true
					}
				},
				messages: {
					editorial: {
						required: "Please enter Editorial"
					}
				},
				submitHandler: function(form) {
					var editorial = $('.editorial').val();
					var data = {
						'search_editor': 'searching',
						'editorial': editorial
					}
					
					  $.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: data,
						dataType:'json',
						beforeSend: function(){
						
							$.preloader.start({
								modal: true,
								src : 'dist/img/loader.svg'
							});
						},
						success: function(data){
							$.preloader.stop();
							if(data.error){
								//alert();
								// Swal.fire({
								//   icon: 'error',
								//   title: 'Oops...',
								//   text: 'Sorry '+ data.error_msg,
								// });
								$('.download_as_pdf').hide();
								$('.search_result').html(" <h3 class='text-center text-red'>No s'han trobat dades</h3>");
							}else{
								var response = data.books;
								if(response.length > 0){
								    var searched_html = "";
								    for(var i = 0; i < response.length; i++){
								        var single_course = response[i];
										console.log(single_course);
								        if(single_course.length > 0){
								        var Course_name = single_course[0].course_name;
								        
								        console.log(Course_name);
								        searched_html +="<h3 class='text-center'>"+Course_name+"</h3>";
								        searched_html +="<table class='table table-bordered search_table'><thead><th>Nº de llibres</th><th>ISBN</th><th>Editorial</th><th>Llibre</th></thead><tbody>";
								        
								        for(j = 0 ; j<single_course.length ; j++){
								            var single_obj = single_course[j];
								            var total_books = single_course[j].total_books;
								            searched_html +="<tr><td>"+total_books+"</td><td>"+single_obj.isbn+"</td><td>"+single_obj.editorial+"</td><td>"+single_obj.book_name+"</td></tr>"
								        }
								        searched_html +="</tbody></table>"
				                        
								    }
								    }
								    $('.download_as_pdf').show();
								    $('.download_as_pdf').attr('href','https://emdnstore.es/admin/editorial-pdf.php/?editorial='+editorial);
								    $('.search_result').html(searched_html);
								}
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
	}
	//add Dish
	function add_dish(){
		 $("#insertion").validate({
				rules: {
					dish_name: {
						required: true
					},
					dish_category:"required",
					price:"required"
				},
				messages: {
					dish_name: {
						required: "Please enter a Dish Name"
					},
					dish_category: {
						required: "Please Select a Dish Category"
					},
					price : "Please Enter Dish Price"
				},
				submitHandler: function(form) {
					var dish_name = $('.dish_name').val();
					var dish_category = $('.dish_category option:selected').val();
					var price = $('.price').val();
					var description = $('.description').val();
					var data_properties  = [];
					var data_properties_row  = [];
					$('.add_property_row input').each(function(){
							var input  = $(this).val();
							var attr  = $(this).attr('id');
							console.log(attr);
							if(attr == 'ingredient'){
								data_properties_row.push(input);
								data_properties.push(data_properties_row);
								data_properties_row = [];
							}else{
								data_properties_row.push(input);
							}
					});
					var json_arr = JSON.stringify(data_properties);
					var fd = new FormData(form);
					var file_img = $('#file').val();
					if(file_img!=''){
						var files = $('#file')[0].files[0]; 
					    fd.append('file',files);
					}
					fd.append('addDish','yes');
					fd.append('dish_properties',json_arr);
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
								  text: 'Sorry '+ data.error_msg,
								});
							}else{
									Swal.fire({
									  icon: 'success',
									  title: 'Success!',
									  showConfirmButton: false,
									  text: data.success_msg,
									  timer: 3000
									});
									$('#insertion')[0].reset();
									if(dataTableAjax != undefined)
									dataTableAjax.ajax.reload();
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
	}
	//add Course Message
	function add_course_message(){
		 $("#insertion_course").validate({
				rules: {
					course_message: {
						required: true
					},
					missatge_course:"required"
				},
				messages: {
					course_message: {
						required: "Please Write Course Message"
					},
					missatge_course : "Please Choose Course"
				},
				submitHandler: function(form) {
					var fd = new FormData(form);
					fd.append('addCourseMessage','yes');
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
	}
	
	//add General Mesaage
	function add_general_message (){
		 $("#insertion_genral").validate({
				rules: {
					general_message:"required"
				},
				messages: {
					general_message : "Please Choose Course"
				},
				submitHandler: function(form) {
					var fd = new FormData(form);
					fd.append('addGeneralMessage','yes');
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
	}
	
	//add ingredient
	function add_extra(){
		 $("#insertion").validate({
				rules: {
					extra_name: {
						required: true
					},
					extra_restaurants:"required",
					extra_price:"required"
				},
				messages: {
					extra_name: {
						required: "Please enter a Extra's Name"
					},
					extra_restaurants: {
						required: "Please Select Restaurants"
					},
					extra_price : "Please Enter Extra's Price"
				},
				submitHandler: function(form) {
					var fd = new FormData(form);
					fd.append('addExtras','yes');
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
	}
	//add Restaurant
	function add_restaurant(){
		 $("#insertion").validate({
				rules: {
					rest_name: {
						required: true
					},
					email:"required",
					manager_name:"required",
					kind_of_food:"required",
					no_of_table:{
						required:true,
						digits: true
					},
					phone:"required",
					city:"required",
					zipcode:"required",
					file:"required",
					password_r:"required",
					status_r:"required",
					address:"required"	
				},
				messages: {
					rest_name:"Please enter a Restaurant Name",
					email : "Please Write Valid Email",
					manager_name : "Please Write Manager Name",
					kind_of_food : "Please Enter Kind of Food",
					no_of_table : "Please Enter No. of Tables",
					password_r : "Please Enter No. of Tables",
					status_r : "Please select Status",
					file : "Please choose image",
					phone : "Please Write Valid Phone No.",
					city : "Please 	Write City",
					zipcode : "Please   Write Zip Code",
					address : "Please   Write Address"
				},
				submitHandler: function(form) {
					var fddata = new FormData(form);
				    var files = $('#file')[0].files[0]; 
					fddata.append('file',files);
					fddata.append('addrestaurant','yes');
					 $.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: fddata,
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
								  text: 'Sorry '+ data.error_msg,
								});
							}else{
									Swal.fire({
									  icon: 'success',
									  title: 'Success!',
									  showConfirmButton: false,
									  text: data.success_msg,
									  timer: 3000
									});
									$('#insertion')[0].reset();
							}	
						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});
				}
		});
	}
		
	// insertion ajax function 
	function ajaxInsertion(fieldData){
		currentRequest = $.ajax({
			url:'cheffunctions.php',
			dataType: 'json',
			type:'post',
			data: fieldData,
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
					  text: 'Sorry '+ data.error_msg,
					});
				}else{
						Swal.fire({
						  icon: 'success',
						  title: 'Success!',
						  showConfirmButton: false,
						  text: data.success_msg,
						  timer: 3000
						});
						$('#insertion')[0].reset();
						if(dataTableAjax != undefined)
						dataTableAjax.ajax.reload();
				}	
			},
			error: function (jqXHR, exception) {
					getErrorMessage(jqXHR, exception);
			}
		});
	}
	// Ajax Response Error
	function getErrorMessage(jqXHR, exception) {
		var msg = '';
		if (jqXHR.status === 0) {
			msg = 'Not connect.\n Verify Network.';
		} else if (jqXHR.status == 404) {
			msg = 'Requested page not found. [404]';
		} else if (jqXHR.status == 500) {
			msg = 'Internal Server Error [500].';
		} else if (exception === 'parsererror') {
			msg = 'Requested JSON parse failed.';
		} else if (exception === 'timeout') {
			msg = 'Time out error.';
		} else if (exception === 'abort') {
			msg = 'Ajax request aborted.';
		} else {
			msg = 'Uncaught Error.\n' + jqXHR.responseText;
		}
		$.preloader.stop();
				Swal.fire({
				  icon: 'error',
				  title: 'Oops...',
				  text: msg
				});
	}
	
	$(document).on("click",'.btn-yes',function(e){
		var catid = $(this).siblings('.cat_id');
		var cat_id_value = catid.data('id');
		var cat_page = $('.page').val();
		//alert(cat_id_value);
		var data = {
			'action': 'deleteCategory',
			'catid': cat_id_value,
			'page': cat_page
		};
		SwalDelete(data);
	});
	
	$(document).on("change",'#course_id',function(e){
	    
	    if($('#course_id option:selected').val() == "17"){
	       
	        var option = "<option value=''>seleccionar Modalitat</option> <option value='Itinerari Científic'>Itinerari Científic</option> <option value='Itinerari Social'>Itinerari Social</option> <option value='Itinerari Humanístic'>Itinerari Humanístic</option>";
	        $('#modality').html(option);
	         $('.modality_box').show();
	    }else if($('#course_id option:selected').val() == "18"){
	        
	        var option = "<option value=''>seleccionar Modalitat</option> <option value='Modalitat: Científic'>Modalitat: Científic</option> <option value='Modalitat: Tecnològic'>Modalitat: Tecnològic</option> <option value='Modalitat: Ciències Socials'>Modalitat: Ciències Socials</option><option value='Modalitat: Humanitats'>Modalitat: Humanitats</option><option value='Modalitat: Artístic'>Modalitat: Artístic</option>";
	        $('#modality').html(option);
	         $('.modality_box').show();
	    }else if($('#course_id option:selected').val() == "19"){
	       
	         var option = "<option value=''>seleccionar Modalitat</option> <option value='Modalitat: Científic'>Modalitat: Científic</option> <option value='Modalitat: Tecnològic'>Modalitat: Tecnològic</option> <option value='Modalitat: Ciències Socials'>Modalitat: Ciències Socials</option><option value='Modalitat: Humanitats'>Modalitat: Humanitats</option><option value='Modalitat: Artístic'>Modalitat: Artístic</option>";
	        $('#modality').html(option);
	         $('.modality_box').show();
	    }else{
	        $('.modality_box').hide();
	    }
	    
	});
	
	
	$(document).on("change",'#course_order_id',function(e){
	    
	    if($('#course_order_id option:selected').val() == "17"){
	       
	        var option = "<option value=''>seleccionar Modalitat</option> <option value='Itinerari Científic'>Itinerari Científic</option> <option value='Itinerari Social'>Itinerari Social</option> <option value='Itinerari Humanístic'>Itinerari Humanístic</option>";
	        $('#modality').html(option);
	         $('.modality_box').show();
	    }else if($('#course_order_id option:selected').val() == "18"){
	        
	        var option = "<option value=''>seleccionar Modalitat</option> <option value='Modalitat: Científic'>Modalitat: Científic</option> <option value='Modalitat: Tecnològic'>Modalitat: Tecnològic</option> <option value='Modalitat: Ciències Socials'>Modalitat: Ciències Socials</option><option value='Modalitat: Humanitats'>Modalitat: Humanitats</option><option value='Modalitat: Artístic'>Modalitat: Artístic</option>";
	        $('#modality').html(option);
	         $('.modality_box').show();
	    }else if($('#course_order_id option:selected').val() == "19"){
	       
	         var option = "<option value=''>seleccionar Modalitat</option> <option value='Modalitat: Científic'>Modalitat: Científic</option> <option value='Modalitat: Tecnològic'>Modalitat: Tecnològic</option> <option value='Modalitat: Ciències Socials'>Modalitat: Ciències Socials</option><option value='Modalitat: Humanitats'>Modalitat: Humanitats</option><option value='Modalitat: Artístic'>Modalitat: Artístic</option>";
	        $('#modality').html(option);
	         $('.modality_box').show();
	    }else{
	        $('.modality_box').hide();
	            var course_id  = $('#course_order_id').val();
	            var etapa  = $('#etpa').val();
	             $.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: {action:'get_books_for_order',etapa_id:etapa,course_id:course_id},
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
						        
						    }else{
						        var books_result = data.books;
						        
						        if(books_result.length > 0){
						            var html_tr = "";
						            var total = 0;
						            for(var i = 0 ; i < books_result.length ; i++){
						                var single =  books_result[i];
						                if(single.obligatori == "NO"){
						                    var check = 'checked';
						                }else{
						                    var check = 'checked disabled';
						                }
						                var singlePrice = single.preu_final;
						                singlePrice = singlePrice.replace(',','.');
						                total += Number(singlePrice);
						                
						                html_tr += "<tr><td>"+single.isbn+"</td><td>"+single.book_name+"</td><td>"+single.editorial+"</td><td><input data-bookid='"+single.id+"' data-price='"+single.preu_final+"' type='checkbox' "+check+" class='checkbox_book'></td><td><b>€ </b>"+single.preu_final+"</td></tr>"
						                
						                
						            }
						            html_tr += "<tr><td colspan='4'><span style='font-size:18px;'> <b> Import total de la comanda  </b></span> </td> <td><b>€ </b> <span style='font-size:18px;' id='total_final'>"+total.toFixed(2)+"</span></td></tr>"
						            $('.tr_body').html(html_tr);
						        }
						        
						        
						        $('.box-books').show();
						        
						    }
	                    
						}
	             });
	    }
	    
	});
	
	$(document).on('change','#modality',function(){
	            var modality = $(this).val();
	            var course_id  = $('#course_order_id').val();
	            var etapa  = $('#etpa').val();
	             $.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: {action:'get_books_for_order',etapa_id:etapa,course_id:course_id,modality:modality},
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
						        
						    }else{
						        var books_result = data.books;
						        
						        if(books_result.length > 0){
						            var html_tr = "";
						            var total = 0;
						            for(var i = 0 ; i < books_result.length ; i++){
						                var single =  books_result[i];
						                if(single.obligatori == "NO"){
						                    var check = 'checked';
						                }else{
						                    var check = 'checked disabled';
						                }
						                var singlePrice = single.preu_final;
						                singlePrice = singlePrice.replace(',','.');
						                total += Number(singlePrice);
						                
						                html_tr += "<tr><td>"+single.isbn+"</td><td>"+single.book_name+"</td><td>"+single.editorial+"</td><td><input data-bookid='"+single.id+"' data-price='"+single.preu_final+"' type='checkbox' "+check+" class='checkbox_book'></td><td><b>€ </b>"+single.preu_final+"</td></tr>"
						                
						                
						            }
						            html_tr += "<tr><td colspan='4'><span style='font-size:18px;'> <b> Import total de la comanda  </b></span> </td> <td><b>€ </b> <span style='font-size:18px;' id='total_final'>"+total.toFixed(2)+"</span></td></tr>"
						            $('.tr_body').html(html_tr);
						        }
						        
						        
						        $('.box-books').show();
						        
						    }
	                    
						}
	             });
	    
	})
	
	
	$(document).on('click','.checkbox_book',function(){
	    var total_final = Number($('#total_final').text());
	    var single_price = $(this).data('price');
	    //single_price = single_price.replace(',',".");
	    if($(this).is(':checked')){
	        total_final = total_final + Number(single_price);
	        
	        $('#total_final').text(total_final.toFixed(2));
	        
	    }else{
	        
	        total_final = total_final - Number(single_price) ;
	        
	        $('#total_final').text(total_final.toFixed(2));
	        
	    }
	});
	
	
	
	$(document).on("click",'.btn-delete_prop_dish',function(e){
		var catid = $(this).data('id');
		var cat_page = $('.property_modal').val();
		//alert(cat_id_value);
		var data = {
			'action': 'deleteCategory',
			'catid': catid,
			'page': cat_page
		};
		console.log(data);
		SwalDelete(data);
	});


    //SweetAlert Delete Function
		function SwalDelete(data){
		    var page = (data.page);
		    var id = (data.catid);
			var warning = "No podrás revertir esto";			
		   swal.fire({
		   title: 'Estas seguro?',
		   text: warning,
		   icon: 'warning',
		   showCancelButton: true,
		   confirmButtonColor: '#3085d6',
		   cancelButtonColor: '#d33',
		   confirmButtonText: 'Sí, bórralo!',
		   showLoaderOnConfirm: true,
		   preConfirm: function() {
			  return new Promise(function(resolve) {
				  $.ajax({
					 url: 'cheffunctions.php' ,
					 type: 'POST',
					 data: data,
					 dataType: 'json'
				  })
				  .done(function(response){
						swal.fire('Deleted!', response.message, 'success');
						if(dataTableAjax != undefined)
							dataTableAjax.ajax.reload();
						})
				  .fail(function(){
					 swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
				  });
			  });
		   },
		   allowOutsideClick: false     
		   }); 
		}

		$(document).on('click','.btn-edit',function(e){  
			var catid = $(this).siblings('.edit_cat_id');
			var cat_id_value = catid.data('catid'); 
			var page =$('.page').val();
			if(page=='ingredients'){
			   var resid = $(this).data('resid');
			   var cat = $(this).data('cat');
			   var resname = $(this).data('resname');
			   $('#res').text(resname.toUpperCase());
			   	var data = {
    			'action_edit': 'getEdit',
    			'page': page,
    			'catid': cat_id_value,
    			'resid':resid
    		    };
			}else{
    			var data = {
    			'action_edit': 'getEdit',
    			'page': page,
    			'catid': cat_id_value
    		    }
			}
          $.ajax({  
                url:'cheffunctions.php', 
                type:"POST",  
                data:data,  
                dataType:"json",
				beforeSend: function(){
					if(currentRequest != null){
						currentRequest.abort();
					}
					$.preloader.start({
							modal: true,
							src : 'dist/img/loader.svg'
						});
				},	
                success:function(data){ 
				$.preloader.stop();
					if(page=='ingredients'){
					var cates;
				    var cats  = data.cats;
				    for(var i =0; i<cats.length;i++){
				        var id = cats[i]['cat_id'];
                        var name = cats[i]['cat_name'];
                        if(name==cat){
                            var selected = 'selected';
                        }else{
                            var selected = 'he';
                        }
                       cates +="<option value='"+id+"' "+selected+">"+name+"</option>";
				    }
				     $("#ingre_category").html(cates);
				}
				var data = data.data;
				
				if(page=='transactions'){
					$('#date_time').val(data.date_time);  
					$('#std_name').val(data.name_std);  
					$('#std_last_name').val(data.last_name_std);  
					$('#parent').val(data.name_fth);  
					$('#dni').val(data.id_card);  
					$('#order_email').val(data.email);  
					$('#order_telephone').val(data.contact_number);  
					$("#payment_status option[value='" + data.payment_status + "']").attr("selected", true);
					$('#cat_id').val(data.id);
				   
					$('#modal-edit').modal('show');
				}else if(page=='courses'){
						 $('#course_name').val(data.course_name);  
						$('#desciption').html(data.description);
						$('#modal').val(data.modalidad);
						$('#etpa').val(data.etpa);
						 $('#cat_id').val(data.id);
						
						 $('#modal-edit').modal('show');
					 }else if(page=='modal'){
						$('#modalidad').val(data.modalidad);  
						$('#cat_id').val(data.id);
					   
						$('#modal-edit').modal('show');
					}else if(page=='promotions'){
						 $('#promotion_name').val(data.promotion_name); 
						 $('#already_uploaded').html("<img src='uploads/promotions/"+data.promtion_img+"' width='100%' class='img thumbnail'>")
						$('#pro_description').html(data.description);
						 $('#cat_id').val(data.id);
						
						 $('#modal-edit').modal('show');
					 }else if(page=='brands'){
						 $('#brand_name').val(data.brand_name);  
						$('#brand_desc').html(data.brand_desc);
						 $('#cat_id').val(data.id);
						
						 $('#modal-edit').modal('show');
					 }else if(page=='category'){
                     $('#cat_name').val(data.cat_name);  
                     $('#cat_description').html(data.cate_description);  
                     if(data.image != ""){
						 $('.already_icon').html('<img src="uploads/'+data.image+'"  width="60px" class="img img-circle img-thumbnail">');
					 }else{
						 $('.already_icon').html('<p> No Icon Uploaded yet! </p>');
					 }
                     $('#cat_id').val(data.id);
                     $('#modal-edit').modal('show');  
					 }else if(page=='product'){
					     
						  $('#bookname').val(data.book_name);  
						  $('#course_id').val(data.course_id);
						  $('#isbn').val(data.isbn);
						  $('#editorial').val(data.editorial);
						  $('#pvp').val(data.pv_pmm);
						  $('#pre_final').val(data.preu_final);
						  $('#orden').val(data.orden);
						  if(data.iva == '4%'){
						      $('#iva4').prop('checked',true);
						  }else if(data.iva == '21%'){
						      $('#iva21').prop('checked',true);
						  }
								var modalcheck = JSON.parse(data.modality);
								if (modalcheck != null) {
								modalcheck.forEach(function(value, index) {
									$('#modal' + value).prop('checked',true);
								});
							}
						  if(data.obligatori == 'SI'){
						      $('#obligatorisi').prop('checked',true);
						  }else if(data.obligatori == 'NO'){
						      $('#obligatorino').prop('checked',true);
						  }
                         
						  $('#cat_id').val(data.id);
						  $('.description').val(data.description);
						 $('#modal-edit').modal('show'); 
					 }else if(page=='ingredients'){
                     $('#ingredient_name').val(data.ingredient_name);  
                     $('#ingredient_price').val(data.price);  
                     $('#cat_id').val(data.id);
                     $('#description').val(data.description);
                     $('#modal-edit').modal('show');  
					 }else if(page=='extras'){
                     $('#extra_name').val(data.extra_name);  
                     $('#extra_price').val(data.price);  
                     $('#cat_id').val(data.id);
                     $('#description').val(data.description);
                     $('#modal-edit').modal('show');  
					 }else if(page=='restaurant_dishes'){
                     $('#dish_name_rest').val(data.dish_name);  
                     $('#price_restaurant_update').val(data.dish_price);  
                     $('#added_description_dish').val(data.dish_description);  
                     $('#cat_id').val(data.id);
                     $('#modal-edit').modal('show');  
					 }
                },
				error: function (jqXHR, exception) {
					getErrorMessage(jqXHR, exception);
				}		
           }); 
      });
	  
	  $(document).on('click','.btn-product-images',function(){
	      var proid = $(this).data('proid');
	      //alert(proid);
	      var data = {
	          'action_images':'yes',
	          'productid':proid
	      }
	      
	      $.ajax({  
                url:'cheffunctions.php', 
                type:"POST",  
                data:data,  
                dataType:"json",
				beforeSend: function(){
					if(currentRequest != null){
						currentRequest.abort();
					}
					$.preloader.start({
							modal: true,
							src : 'dist/img/loader.svg'
						});
				},	
                success:function(data){
                    if(data.error){
                        $('.imagesbody').html('<p>No images uploaded yet!</p>');
                    }else{
                        var images = data.data_img;
                        var img = "<div class='row'>";
                        for(var i=0; i <images.length ; i++){
                            var signleimg = images[i];
                            img += "<div class='col-sm-3' style='position:relative'><i class='fa fa-close btn-yes' style='position:absolute;right:0px;color:red;cursor:pointer'></i> <img src='uploads/"+signleimg.image_name+"' width='100%' class='img img-thumbnail'></div>";
                            
                        }
                    $('.imagesbody').html(img+"</div>");
                    }
	                $.preloader.stop();
	             $('#modal-image').modal('show');
                },
				error: function (jqXHR, exception) {
					getErrorMessage(jqXHR, exception);
				}		
           }); 
	      

	  });
	  
	  
	  // update saved
	  $(document).on("click",".btn-update",function(e){
		var cat_id = $('#cat_id').val();
		var page =$('.page').val();
		if(page=='restaurant'){
			    var data  = new FormData($('#edit')[0]);  
				data.append('action_edit_update','yes');
				data.append('page',page);
				data.append('catid',cat_id);
					 $.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: data,
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
									if(dataTableAjax != undefined)
									dataTableAjax.ajax.reload();
							}	
							$('#modal-edit_rest').modal('hide');
						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});
				
		}else if(page=='category'){
			var data  = new FormData($('#edit')[0]);  
				data.append('action_edit_update','yes');
				data.append('page',page);
				data.append('catid',cat_id);
					 $.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: data,
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
									if(dataTableAjax != undefined)
									dataTableAjax.ajax.reload();
							}	
							$('#modal-edit').modal('hide');
						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});
		}else if(page=='promotions'){
			 var data  = new FormData($('#edit')[0]);  
				data.append('action_edit_update','yes');
				data.append('page',page);
				data.append('catid',cat_id);
					 $.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: data,
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
									if(dataTableAjax != undefined)
									dataTableAjax.ajax.reload();
							}	
							$('#modal-edit').modal('hide');
						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});
		} else if(page=='transactions'){
			var data = {
				'action_edit_update':'yes',
				'page':page,
				'date_time': $('#date_time').val(),
				'std_name': $('#std_name').val(),
				'parent': $('#parent').val(),
				'dni': $('#dni').val(),
				'order_email': $('#order_email').val(),
				'order_telephone': $('#order_telephone').val(),
				'payment_status': $('#payment_status').val(),
				'catid':cat_id
			}
		  editingajaxfunction(data);
		} else if(page=='courses'){
			var size_name = $('.course_name').val();
			var size_desc = $('.desciption').val();
			var etpa = $('#etpa').val();
			var modal = $('#modal').val();
			var data = {
				'action_edit_update':'yes',
				'page':page,
				'course_name':size_name,
				'description':size_desc,
				'catid':cat_id,
				'etpa': etpa,
				'modal': modal
			}
		  editingajaxfunction(data);
		} else if(page=='modal'){
			var modalidad = $('#modalidad').val();
			var tipo = $('#tipo').val();
			var data = {
				'action_edit_update':'yes',
				'page':page,
				'modalidad':modalidad,
				'tipo':tipo,
				'catid':cat_id
			}
		  editingajaxfunction(data);
		} else if(page=='brands'){
			var brand_name = $('.brand_name').val();
			var brand_desc = $('.brand_desc').val();
			var data = {
				'action_edit_update':'yes',
				'page':page,
				'brand_name':brand_name,
				'brand_desc':brand_desc,
				'catid':cat_id
			}
		  editingajaxfunction(data);
		} else if(page=='product'){
			    var data  = new FormData($('#edit')[0]);  
				data.append('action_edit_update','yes');
				data.append('page',page);
				data.append('catid',cat_id);
					 $.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: data,
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
									if(dataTableAjax != undefined)
									dataTableAjax.ajax.reload();
							}	
							$('#modal-edit').modal('hide');
						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});
				
		}else if(page=='extras'){
			    var data  = new FormData($('#edit')[0]);  
				data.append('action_edit_update','yes');
				data.append('page',page);
				data.append('catid',cat_id);
					 $.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: data,
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
									if(dataTableAjax != undefined)
									dataTableAjax.ajax.reload();
							}	
							$('#modal-edit').modal('hide');
						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});
				
		}else if(page=='ingredients'){
			    var data  = new FormData($('#edit')[0]);  
				data.append('action_edit_update','yes');
				data.append('page',page);
				data.append('catid',cat_id);
					 $.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: data,
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
									if(dataTableAjax != undefined)
									dataTableAjax.ajax.reload();
							}	
							$('#modal-edit').modal('hide');
						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});
				
		}else if(page=='restaurant_dishes'){
			    var data  = new FormData($('#edit')[0]);  
				data.append('action_edit_update','yes');
				data.append('page',page);
				data.append('catid',cat_id);
					 $.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: data,
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
									if(dataTableAjax != undefined)
									dataTableAjax.ajax.reload();
							}	
							$('#modal-edit').modal('hide');
						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});
				
		}
		

	  });
	  
	  // editing ajax function 
	function editingajaxfunction(fieldData){
		currentRequest = $.ajax({
			url:'cheffunctions.php',
			dataType: 'json',
			type:'post',
			data: fieldData,
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
				if(data.error){
					Swal.fire({
						  icon: 'error',
						  title: 'Oops...',
						  text: data.message
						});
				}else{
						Swal.fire({
						  icon: 'success',
						  title:data.message,
						  showConfirmButton: false,
						  timer: 3000
						});
						$('#modal-edit').modal('hide');
						if(dataTableAjax != undefined)
							dataTableAjax.ajax.reload();
				}
				$.preloader.stop();
			},
			error: function (jqXHR, exception) {
					getErrorMessage(jqXHR, exception);
			}
			
		});
	}

    $(document).on('click','.btn-edit-settings',function(e){
		e.preventDefault();
		$('.form-editing input').each(function(index, item){
			$(item).prop("disabled",false);
		});
		$('.address,.btn-save-setting').prop("disabled",false);
	});
	
	$(document).on('click','.btn-save-setting',function(){
		var form_profile_data = new FormData($('#profile-form')[0]);
		var adminid = $('.adminid').val();
		form_profile_data.append('action_profile_update','yes');
		form_profile_data.append('adminid',adminid);
		$.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: form_profile_data,
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
							}	
						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});
		
	});
	
	$(document).on('click','.btn-status',function(){
		var res_id = $(this).data('restid');
				$.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: {'status':'yes','rest_id':res_id},
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
								alert('something wrong');
							}else{
							 var data = data.data;
							 if(data.status=="active"){
								 $('#active').prop("checked",true);
							 }else if(data.status=="banned"){
								 $('#banned').prop("checked",true);
							 }else{
								 $('#inactive').prop("checked",true);
							 }
							 $('#res_id').val(data.res_id);
							 $('#modal-status').modal('show');
							}
						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});
		
	});
	
	$(document).on('click','#btn-update-status',function(){
		var res_id = $('#res_id').val();
		if($('#active').is(':checked')){
			var status_val ="active";
		}else if($('#banned').is(':checked')){
			var status_val ="banned";
		}else{
			var status_val ="inactive";
		}
		var status_data ={
			'update_status':'yes',
			'status_res':status_val,
			'res_id':res_id
		}
		
		$.ajax({
			url:'cheffunctions.php',
			dataType: 'json',
			type:'post',
			data: status_data,
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
					//alert(data.error_msg);
					Swal.fire({
						  icon: 'error',
						  title: 'Oops...',
						  text: data.message
						});
				}else{
					//alert(data.success_msg);
						Swal.fire({
						  icon: 'success',
						  title:data.message,
						  showConfirmButton: false,
						  timer: 3000
						});
						if(dataTableAjax != undefined)
							dataTableAjax.ajax.reload();
						$('#modal-status').modal('hide');  
				}
			},
			error: function (jqXHR, exception) {
					getErrorMessage(jqXHR, exception);
			}
		});
		
		
		
		
	});
	
	
	$(document).on('click','.btn-sub-restaurant',function(){
		var res_id = $(this).data('restid');
		$.ajax({
			url:'cheffunctions.php',
			dataType: 'json',
			type:'post',
		data: {'action_get_restaurants':'yes','rest_id':res_id},
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
				console.log(data);
				var datahtml ;
				if(data.length>0){
					for(var i=0;i<data.length;i++){
						var data_rest = data[i];
						datahtml += "<tr><td>"+data_rest.restaurant_name+"</td><td>"+data_rest.email+"</td><td>"+data_rest.phone+"</td><td>"+data_rest.city+"</td><td>"+data_rest.zipcode+"</td><td>"+data_rest.address+"</td></tr>";
					}
				}else{
					datahtml ='<tr colspan="6"><td><p>No Restaurants added yet!</p></td></tr>';
				}
				$('.rest_data').html(datahtml);
				$('#modal-restaurant-sub').modal('show')
			},
			error: function (jqXHR, exception) {
					getErrorMessage(jqXHR, exception);
			}
		});		
	});

	$(document).on('click','.btn-add-dish-restaurant',function(){
		var rest_id = $(this).data('restid');
		$('.selectedrest').val(rest_id);
		var data_row = "<div class='row dish_row' style='margin-bottom:10px'><div class='col-sm-3'><div class='form-group'><input type='text' class='name_dish form-control' style='width:100%'  name='name_dish'></div></div><div class='col-sm-2'><div class='form-group'><input type='text' name='price' class='form-control price'></div></div><div class='col-sm-6'><div class='form-group'><textarea rows='1' class='description form-control'></textarea></div></div><div class='col-sm-12'><button class='btn btn-info add_more'>Add More</button></div></div>";
		//$('.add_dish_row').html(data_row);
						var dataa = {
							'dishes_for_restaurant':"getalldishes"
						};
				$('.category').select2({
							ajax: {
								url: 'cheffunctions.php',
								dataType: 'json',
								data: function (params) {
									dataa.q = params.term;
									return dataa;
								},
								processResults: function (data) {
								  return {
									results: data.results
								  };
								},
								cache: true,
							},
							
						});
		
				// select2_dishes_data(selector,dataa);	
		$('#modal-add-restaurant-dishes').modal('show');
		
	});
	
	// add more product
	$(document).on('click',".add_more",function(e){
	var row="<div class='row dish_row' style='margin-bottom:10px'><div class='col-sm-3'><div class='form-group'><input type='text' class='name_dish form-control' style='width:100%'  name='name_dish'></div></div><div class='col-sm-2'><div class='form-group'><input type='text' name='price' class='form-control price'></div></div><div class='col-sm-6'><div class='form-group'><textarea rows='1' class='description form-control'></textarea></div></div><div class='col-sm-1'><i class='fa fa-close close' style='font-size:17px;cursor:pointer'></i></div></div>";
			//$('.add_dish_row').prepend(row);
			// var selector = ".select2_dishes";
						// var dataa = {
							// 'dishes_for_restaurant':"getalldishes"
						// };
				// select2_dishes_data(selector,dataa);	
	});
	$(document).on('click',".close",function(e){
		 $(this).parents('.dish_row').remove();
	});
	
	function select2_dishes_data(selector,dataa){
		$.ajax({
			url: 'cheffunctions.php',
			dataType: 'json',	
			data:dataa,
			success:function(data){
				var toAppend;
				 for(var i=0;i<data.results.length;i++){
					 var obj=data.results[i];
                toAppend+='<option value="'+obj.id+'" data-dname="'+obj.dname+'" data-price="'+obj.dprice+'" data-catid="'+obj.catid+'" data-des="'+obj.description+'" >'+ obj.text +'</option>>'
				}
				$(selector).append(toAppend)
			}
		});
		$(selector).select2();
	}
	// onchange set Price,name
	$(document).on('change',".category",function(e){
		 var cate_id = $('.category option:selected').val();
				$.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: {'categories_dishes':'yes','cate_id':cate_id},
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
							 if(data.length>0){
								 var title_row = '<div class="col-sm-3"><div class="form-group"><label>Name</label></div></div><div class="col-sm-2"><div class="form-group"><label>Price</label></div></div><div class="col-sm-6"><div class="form-group"><label>Description</label></div></div>';
								 var row="";
								 for(var i=0; i<data.length;i++){
									 var single =  data[i];
									 row+="<div class='row dish_row' style='margin-bottom:10px'><div class='col-sm-3'><div class='form-group'><input type='text' class='name_dish form-control' style='width:100%'  name='name_dish' value='"+single.dish_name+"' data-dishid='"+single.id+"' data-dishimg='"+single.dish_image+"'></div></div><div class='col-sm-2'><div class='form-group'><input type='text' name='price'  value='"+single.dish_price+"' class='form-control price'></div></div><div class='col-sm-6'><div class='form-group'><textarea rows='1' class='description form-control'>"+single.desc+"</textarea></div></div><div class='col-sm-1'><i class='fa fa-close close' style='font-size:17px;cursor:pointer'></i></div></div>";
								 }
							 }else{
								var title_row = "<div class='col-sm-12 text-center'><h4> Por favor inserte el producto en esa categoría</h4><a href='' class='btn btn-primary add-dish' data-page='add-dish'> Add New Dish </a></div>";
								var row = "";
							 }
							 $('.titles').html(title_row);
							 $('.add_dish_row').html(row);

						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});

	});
	
	
	
	
	// onchange set Price,name
	$(document).on('change',".course_sale",function(e){
		 var missatge_course = $('.course_sale option:selected').val();
		 var text_value = $('.course_sale option:selected').text();
				$.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: {'get_courses_sales':'yes','course_id':missatge_course,text_value:text_value},
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
							     
							 }else{
							    var books = data.books_sale;
							    if(books.length > 0){
							        var books_html = "<h2 class='text-center'>"+text_value+"</h2><table class='table table-hover table-bordered'><thead><th>Alumne/a</th><th>Llibres</th><th>Import</th></thead><tbody>";
							           var total = 0;
							           var username = "";
							           var price = 0;
							           var count = 0;
							         
                                        var group = _.groupBy(books, 'company')
                                        
                                        var result = _.map(_.keys(group), function(e) {
                                          return _.reduce(group[e], function(r, o) {
                                            return r.count += +o.price, r
                                          }, {Company: e, count: 0, sum: group[e].length})
                                        })
                                        
                                        console.log(result);
    							    for(var i = 0 ; i < result.length; i++){
    							             var single =  result[i];
    							        
    							             price = single.count;
        							         
        							         total += Number(price);
        							         console.log(total);
    							        
    							        books_html += "<tr><td>"+single.Company+"</td><td>"+single.sum+"</td><td>"+(single.count).toFixed(2)+" €</td></tr>" ;
    							    }
    							    //total.replace(",",".");
    							    books_html += "<tr><td colspan='2' style='text-align:right'><b>Total : </td><td>"+total.toFixed(2)+" €</td></tr></tbody></table>";
    							    
    							    $('.books_sale').html(books_html);
    							    
							    }else{
							        
							        $('.books_sale').html('<h3 class="text-center text-red">Encara no hi ha vendes</h3>');
							    }
							 }

						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});

	});
	
	// onchange set Price,name
	$(document).on('change',".missatge_course",function(e){
		 var missatge_course = $('.missatge_course option:selected').val();
				$.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: {'get_message_course':'yes','missatge_course':missatge_course},
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
							     $('.course_message').val('');
							 }else{
							     $('.course_message').val(nl2br(data.message))
							 }

						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});

	});
	
	
	function nl2br (str, is_xhtml) {   
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
    }
		
		$(document).on('click',".btn_add_product",function(e){
		var restaurant_id = $('.selectedrest').val();
		var dish_cat = $('.category option:selected').val();
		var cat_name = $('.category option:selected').text();
		
		var data=[];
		$('.dish_row').each(function(key,value){
			console.log(value);
			var dname = $(value).find('.name_dish').val();
			var dish_id = $(value).find('.name_dish').data('dishid');
			var dish_image = $(value).find('.name_dish').data('dishimg');
			var price = $(value).find('.price').val();
			var desc = $(value).find('.description').val();
		if (dname == "" || price== "") {
				 Swal.fire({
						  icon: 'error',
						  title:"Please Fill All fields",
						  showConfirmButton: false,
						  timer: 3000
				});
				return;
		       }else{
				var obj ={'product_id':dish_id,'product_name':dname,'price':price,'desc':desc,'dish_category':dish_cat,'image':dish_image};
				data.push(obj);
			   }
		});
			// console.log("data product");
			// console.log(data);
			$.ajax({
			url:'cheffunctions.php',
			dataType:'json',
			type:'post',
			data:{'action_add_to_restaurant_cat_dish':'yes','category_name':cat_name,'restaurante_id':restaurant_id,'data':data},
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
						 Swal.fire({
							  icon: 'error',
							  title:data.message,
							  showConfirmButton: false,
							  timer: 3000
							});
					}else{
						Swal.fire({
							  icon: 'success',
							  title:data.message,
							  showConfirmButton: false,
							  timer: 3000
							});
					    $('#modal-add-restaurant-dishes').modal('hide');
					}
					
				},
				error: function (jqXHR, exception) {
						getErrorMessage(jqXHR, exception);
				}
			});		
		
		});
		
		$(document).on('click',".btn-dishs-restaurant",function(e){
			var res_name = $(this).data('name');
			var res_id = $(this).data('restid');
			
			$.ajax({
			url:'cheffunctions.php',
			dataType:'json',
			type:'post',
			data:{'get_restaurant_cat_dish':'yes','restaurante_id':res_id},
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
						 Swal.fire({
							  icon: 'error',
							  title:data.message,
							  showConfirmButton: false,
							  timer: 3000
							});
					}else{
						var data_html="",ul_data="";
						for(var i = 0;i<data.length;i++){
								var single_cat_data = data[i];
								data_html += '<div class="col-sm-6"> <div class="box box-primary"><div class="box-body box-profile"><h3 class="profile-username text-center">'+single_cat_data.category_name+'</h3><p class="text-muted text-center">'+single_cat_data.category_desc+'</p><ul class="list-group list-group-unbordered"> ';
								var dish_data_res = single_cat_data.dish_data;
								for(var j=0 ;j<dish_data_res.length;j++){
									var single_dish = dish_data_res[j];
									ul_data += '<li class="list-group-item"><b>'+single_dish.dish_name+'</b> <a class="pull-right">'+single_dish.dish_price+'</a></li>';
								}
								if(ul_data==""){
									ul_data = "<li class='list-group-item'> No hay productos agregados todavía </li>";
								}
								data_html += ul_data+"</ul></div> </div></div>";
								ul_data="";
							
						}
						if(data_html==""){
							data_html = "<h2 class='text-center'> No hay productos agregados todavía</h2>";
						}
						$('.restaurant-dishes-data').html(data_html);
						$('#rest_name').text(res_name);
					   $('#modal-restaurants-dishes').modal('show');
					}
					
				},
				error: function (jqXHR, exception) {
						getErrorMessage(jqXHR, exception);
				}
			});		
		
			
			
			
		});
		
		
		
		
		$(document).on('click',".add_property",function(e){
		$(this).html('<i class="fa fa-list-alt"></i> Properties <i class="fa fa-close"></i>');
        if($('.dish_properties').hasClass('active_pro')){
			$(this).html('<i class="fa fa-list-alt"></i> Properties ');
			$('.dish_properties').removeClass('active_pro');
			$('.dish_properties').hide();
			return;
		}else{		
			var main_row = '<div class="row"><div class="col-sm-3"><div class="form-group"><label>Size</label></div></div><div class="col-sm-3"><div class="form-group"><label>Price</label></div></div><div class="col-sm-6"><div class="form-group"><label>Ingredients</label></div></div></div><div class="properties"><div class="row add_property_row" style="margin:12px 0px"><div class="col-sm-3" style="padding-left:0px"><input type="text" class="size form-control" placeholder="Size" id="size" name="size"></div><div class="col-sm-3" style="padding-left:0px"><input type="text" class="price_property form-control" id="price_property" placeholder="Price" name="price_property"></div><div class="col-sm-5" ><input type="text" class="ingredient form-control" id="ingredient" name="ingredient" placeholder="Ingredients"></div><div class="col-sm-1"></div></div></div><div class="col-sm-12" style="padding-left:0px;margin-top:12px;"><button type="button" class="btn btn-info add_property_more"><i class="fa fa-plus"></i> Add More </button></div>';
			$('.dish_properties').addClass('active_pro');
			$('.dish_properties').show();
			$('.dish_properties').html(main_row);
		}
		
		});
		$(document).on('click',".add_property_more",function(e){
		var add_new_row = '<div class="row add_property_row" style="margin:12px 0px"><div class="col-sm-3" style="padding-left:0px"><input type="text" class="size form-control" placeholder="Size" id="size" name="size"></div><div class="col-sm-3" style="padding-left:0px"><input type="text" class="price_property form-control" id="price_property" placeholder="Price" name="price_property"></div><div class="col-sm-5" ><input type="text" class="ingredient form-control" id="ingredient" name="ingredient" placeholder="Ingredients"></div><div class="col-sm-1"><i class="fa fa-close close_property" style="cursor:pointer"></i></div></div>';
		$('.properties').append(add_new_row);
		
		});
		$(document).on('click',".close_property",function(e){
		 $(this).parents('.add_property_row').remove();
	});
	
	$(document).on('click','.btn-add-to-restaurant',function(){
		var id = $(this).data('id');
		var dish_name = $(this).data('dishid');
		var dish_price = $(this).data('price');
		var dish_cat = $(this).data('cid');
		var dish_image = $(this).data('image');
			var dish_description = $(this).data('description');
		  $('.price_restaurant').val(dish_price);
		  $('.dish_id').val(dish_name);
		 $('#dish_cat').val(dish_cat);
		 $('#dish_image').val(dish_image);
		 $('#dish_name_rest').val(dish_name);
		 $('#description_dish').val(dish_description);
		 $('.btn-add-restaurant-dishes').attr('data-id',id);
		  var restaurant = {
				'action_get_restaurant':'yes',
				'dish_name':dish_name
		  };
		  
		  /// select Load  Restaurants
			 $('.select2_restaurants').select2({
						ajax: {
								url: 'cheffunctions.php',
								dataType: 'json',
								data: function (params) {
									 restaurant.q = params.term;
									return restaurant;
								},
								processResults: function (data) {
								  return {
									results: data.results
								  };
								},
								cache: true,
							}
		
			});
		  
		  /// load restaurants data
		$('#modal-add-dish-to-restaurant').modal('show');
	});
	$(document).on('click','.btn-add-restaurant-dishes',function(){
		var restaurants = $('.select2_restaurants').val();
		var dish_price = $('.price_restaurant').val();
		var dishid = $(this).data('id');
		var dish_cat = $('#dish_cat').val();
		var dish_image = $('#dish_image').val();
		var dish_name = $('#dish_name_rest').val();
	    var dish_desc = $('#description_dish').val();
		var data  = {
			'action_save_restaurant_dishes':'yes',
			'restaurants':restaurants,
			'dish_id':dishid,
			'dish_name':dish_name,
			'dish_cat':dish_cat,
			'dish_image':dish_image,
			'dish_price':dish_price,
			'dish_desc':dish_desc
		}
				$.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: data,
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
								$(".select2_restaurants").select2('val', '');
								$('#modal-add-dish-to-restaurant').modal('hide');
									Swal.fire({
									  icon: 'success',
									  title: 'Success!',
									  showConfirmButton: false,
									  text: data.message,
									  timer: 3000
									});
							}	
						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});
		
		
	});
	
	
	
		$(document).on('click','.btn-view-dish-prop',function(){
		    var dish_id = $(this).data('dishid');
		    $.ajax({
			url:'cheffunctions.php',
			dataType: 'json',
			type:'post',
		data: {'action_get_prop_dishes':'yes','dish_id':dish_id},
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
				var datahtml ;
				if(data.length>0){
					for(var i=0;i<data.length;i++){
						var data_rest = data[i];
						datahtml += "<tr><td>"+data_rest.size+"</td><td>"+data_rest.price+"</td><td>"+data_rest.ingredients+"</td><td>"+data_rest.action_edit_del+"</td>";
					}
				}else{
					datahtml ='<tr colspan="6"><td><p>No Properties added yet!</p></td></tr>';
				}
				$('.properties_data').html(datahtml);
				$('#modal-dish-prop').modal('show');
			},
			error: function (jqXHR, exception) {
					getErrorMessage(jqXHR, exception);
			}
		});
		    
		});
	
	
	
	$(document).on('click','.btn-edit-property-modal',function(){
		    var dish_id = $(this).data('id');
		    var page = $('.property_modal').val();
		    $.ajax({
			url:'cheffunctions.php',
			dataType: 'json',
			type:'post',
		data: {'action_edit':'yes','catid':dish_id,'page':page},
			beforeSend: function(){
				if(currentRequest != null){ 
					currentRequest.abort();
				}
				$.preloader.start({
                    modal: true,
                    src : 'dist/img/loader.svg'
                });
			},
			success: function(response){
				$.preloader.stop();
				var data_prop = response.data;
				$('.prop_name').val(data_prop.size);
				$('.price').val(data_prop.price);
					$('#prop_id').val(data_prop.id);
					$('#dish_prop_id').val(data_prop.dish_id);
				$('.ingredients').val(data_prop.ingredients);
				$('#modal-edit-property').modal('show');
			},
			error: function (jqXHR, exception) {
					getErrorMessage(jqXHR, exception);
			}
		});
		    
		});
	
	    // update saved
	  $(document).on("click",".btn-update-dish-prop",function(e){
	            var id = $('#prop_id').val();
			    var data  = new FormData($('#edit-prop')[0]);  
				data.append('action_update_dish_prop','yes');
				data.append('prop_id',id);
					 $.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: data,
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
									if(dataTableAjax != undefined)
									dataTableAjax.ajax.reload();
							}	
							$('#modal-edit-property').modal('hide');
							$('#modal-dish-prop').modal('hide');
						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});
	  });
	
	
	
	$(document).on('click','.btn-ingredient-add-to-restaurant',function(){
		var id = $(this).data('id');
		var ingredient_name = $(this).data('ingredient_name');
		var price = $(this).data('price');
		var ingredient_cat = $(this).data('cid');
		var ingredient_catname = $(this).data('cname');
		var ingredient_description = $(this).data('description');
		 $('.ingredient_price_rest').val(price);
		 $('#ingredient_name_rest').val(ingredient_name);
		 $('#description_rest').val(ingredient_description);
		 $('.btn-add-restaurant-ingredients').attr('data-cid',ingredient_cat);
		 $('#ct').text(ingredient_catname.toUpperCase());
		  var restaurant = {
				'action_get_restaurant_for_ingredients':'yes',
				'cat_name':ingredient_catname,
				'cid':ingredient_cat
		  };
		  
		  /// select Load  Restaurants
			 $('.select2_restaurants').select2({
						ajax: {
								url: 'cheffunctions.php',
								dataType: 'json',
								data: function (params) {
									 restaurant.q = params.term;
									return restaurant;
								},
								processResults: function (data) {
								  return {
									results: data.results
								  };
								},
								cache: true,
							}
		
			});
		  
		  /// load restaurants data
		$('#modal-add-ingredient-to-restaurant').modal('show');
	});
	
	
	
		$(document).on('click','.btn-add-restaurant-ingredients',function(){
		    var id = $(this).data('cid');
			    var data  = new FormData($('#add_ingredients_restaurants')[0]);  
				data.append('action_add_restaurant_ingredients','yes');
				data.append('c_id',id);
					 $.ajax({
						url:'cheffunctions.php',
						method:'POST',
						data: data,
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
									if(dataTableAjax != undefined)
									dataTableAjax.ajax.reload();
							}	
						
							$('#modal-add-ingredient-to-restaurant').modal('hide');
						},
						error: function (jqXHR, exception) {
								getErrorMessage(jqXHR, exception);
						}
					});
		});
	

	
	
	
	
	
	
	
	
});
