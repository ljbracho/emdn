
// document.addEventListener('contextmenu', function(e) {
//       e.preventDefault();
//     });

$(document).ready(function(){
  $(document).on('change','.etapa',function(){
      var etapa =  $(this).val();
      $('.course').empty().append('<option value="0" selected disabled >Seleccionar Curs</option>');  
       $('.error_label').text('');
        $.ajax({
                url: 'All_Functions.php',
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
  
   $(document).on('click','.search_book',function(){
       console.log($('.etapa').val());
       if($('.etapa').val() == null || $('.course').val() == null ){
           $('.error_label').text('Siusplau, seleccioni una etapa i un curs').show();
       }else{
           $('.error_label').hide();
           $('#form_book').submit();
        //   var etapa = $('.etapa').val();
        //   var course = $('.course').val();
        //   $.ajax({
        //         url: 'All_Functions.php',
        //         dataType: 'json',
        //         type: 'POST',
        //         data: {"etapa": etapa,'course':course,'action':'get_books'},
        //         beforeSend:function(){
        //             $('.search_result').html('Loading... <i class="fa fa-spin fa-spinner"></i>');
        //         },
        //         success: function(response) {
                    
        //                 var books =  response.books;
        //                 var html_book = '<table class="table table-responsive text-dark"><thead> <tr><th scope="col">ISBN</th><th scope="col">ETAPA - CURS</th><th scope="col">ACCIONS A REALITZAR</th></tr></thead> <tbody class="books_results">';
        //                 if(books.length > 0){
        //                     for(var i = 0; i < books.length ; i ++){
        //                         var single =  books[i];
        //                         html_book += "<tr><td>"+single.isbn+"</td><td>"+single.course_name+"</td><td><button type='button' class='btn btn-cart' data-bookid='"+single.id+"'> Afegir a la citella</button></td></tr>";
        //                     }
        //                 }else{
                            
        //                     html_book += "<tr><td colspan='3'> No s’ha trobat ningún llibre </td></tr>";
        //                 }
        //                 html_book += "</tbody></table>";
        //                 $('.search_result').html(html_book);
                        
                   
        //         },
        //         error: function(x, e) {
    
        //         }
        //     });
           
       }
       
   })
   
   
   $(document).on("change",'#course_id',function(e){
	    
	    if($('#course_id option:selected').val() == "17"){
	       
	        var option = "<option value=''>Itinerari</option> <option value='Itinerari Científic'>Itinerari Científic</option> <option value='Itinerari Social'>Itinerari Social</option> <option value='Itinerari Humanístic'>Itinerari Humanístic</option>";
	         $('#modality').html(option);
	         $('#etapa_box').removeClass('col-sm-4');
	         $('#etapa_box').addClass('col-sm-3');
	         $('#courses_box').removeClass('col-sm-4');
	         $('#courses_box').addClass('col-sm-3');
	         $('#modality_box').show();
	    }else if($('#course_id option:selected').val() == "18"){
	        
	        var option = "<option value=''> Modalitat</option> <option value='Modalitat: Científic'>Modalitat: Científic</option> <option value='Modalitat: Tecnològic'>Modalitat: Tecnològic</option> <option value='Modalitat: Ciències Socials'>Modalitat: Ciències Socials</option><option value='Modalitat: Humanitats'>Modalitat: Humanitats</option><option value='Modalitat: Artístic'>Modalitat: Artístic</option>";
	         $('#modality').html(option);
	         $('#etapa_box').removeClass('col-sm-4');
	         $('#etapa_box').addClass('col-sm-3');
	         $('#courses_box').removeClass('col-sm-4');
	         $('#courses_box').addClass('col-sm-3');
	         $('#modality_box').show();
	    }else if($('#course_id option:selected').val() == "19"){
	         var option = "<option value=''> Modalitat</option> <option value='Modalitat: Científic'>Modalitat: Científic</option> <option value='Modalitat: Tecnològic'>Modalitat: Tecnològic</option> <option value='Modalitat: Ciències Socials'>Modalitat: Ciències Socials</option><option value='Modalitat: Humanitats'>Modalitat: Humanitats</option><option value='Modalitat: Artístic'>Modalitat: Artístic</option>";
	         $('#modality').html(option);
	         $('#etapa_box').removeClass('col-sm-4');
	         $('#etapa_box').addClass('col-sm-3');
	         $('#courses_box').removeClass('col-sm-4');
	         $('#courses_box').addClass('col-sm-3');
	         $('#modality_box').show();
	    }else{
	        $('#etapa_box').removeClass('col-sm-3');
	         $('#etapa_box').addClass('col-sm-4');
	         $('#courses_box').removeClass('col-sm-3');
	         $('#courses_box').addClass('col-sm-4');
	        $('#modality_box').hide();
	    }
	    
	});
   
   
   $(document).on('click','.btn-cart-icon',function(){
       var ele = $(this);
        ele.prop('disabled',true);
       var qty = $(this).attr('data-qty') //Number($(this).siblings('input').val//());
       var bookid = $(this).attr('data-bookid');
        var courseid = $(this).attr('data-courseid');
       var price = Number($(this).attr('data-price'));
        var iva = Number($(this).attr('data-iva'));
       var bookprice = price;
       console.log("bookprice " + bookprice);
       var ivapercentage = (price/100)*iva;
       //console.log(bookprice);
       var total = Number($('#tot').text());
       console.log("Total " + total);
       //console.log(total + bookprice + ivapercentage);
       if(qty == 1){
            // $('#final_price').text( Number($('#final_price').text())+bookprice);
            // $('#iva').text( (Number($('#iva').text())+ivapercentage).toFixed(2));
            $('.total_price').html((total + bookprice).toFixed(2));
            $('.total').val((total + bookprice).toFixed(2));
            // var total_cart_price = (total - (price + ivapercentage)).toFixed(2);
            // $('.total_price').html(total_cart_price.replace('.',","));
       }else{
            // $('#final_price').text( Number($('#final_price').text())-price);
            // $('#iva').text( (Number($('#iva').text())-ivapercentage).toFixed(2));
            // var total_cart_price = (total - (price + ivapercentage)).toFixed(2);
            // $('.total_price').html(total_cart_price.replace('.',","));
            $('.total_price').html((total - bookprice).toFixed(2));
            $('.total').val((total - bookprice).toFixed(2));
       }
       
       
       $.ajax({
                url: 'All_Functions.php',
                dataType: 'json',
                type: 'POST',
                data: {"bookid": bookid,'action':'add_to_cart',qty:qty,courseid:courseid},
                beforeSend:function(){
                    ele.html('<i class="fa fa-spin fa-spinner"></i>');
                },
                success: function(response) {
                    // ele.removeClass('btn-cart-icon');
                    // ele.addClass('btn-added-icon');
                    if(qty == 1){
                        ele.html('<i class="fa fa-check-circle"></i>');
                        ele.attr('data-qty',0);
                    }else{
                        ele.html('<i class="fa fa-shopping-cart"></i>');
                        ele.attr('data-qty',1);
                    }
                    
                   $('.item_count').text(response.total_items);
                   ele.prop('disabled',false);
                },
                error: function(x, e) {
    
                }
            });
   })
    
    var activeurl = window.location;
    $('a[href="'+activeurl+'"]').parent('li').addClass('active');  
    
    var quantitiy=0;
   $('.quantity-right-plus').click(function(e){
        
        $(this).parents('.input-group-btn').siblings('button').addClass('btn-cart-icon');
        $(this).parents('.input-group-btn').siblings('button').removeClass('btn-added-icon');
        $(this).parents('.input-group-btn').siblings('button').html('<i class="fa fa-shopping-cart"></i>');
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($(this).parents('.input-group-btn').siblings('input').val());
        
        // If is not undefined
            
            $(this).parents('.input-group-btn').siblings('input').val(quantity + 1);

          
            // Increment
        
    });

     $('.quantity-left-minus').click(function(e){
         $(this).parents('.input-group-btn').siblings('button').addClass('btn-cart-icon');
         $(this).parents('.input-group-btn').siblings('button').removeClass('btn-added-icon');
         $(this).parents('.input-group-btn').siblings('button').html('<i class="fa fa-shopping-cart"></i>');
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = Number($(this).parents('.input-group-btn').siblings('input').val());
        console.log(quantity);
        // If is not undefined
      
            // Increment
            if(quantity>0){
                $(this).parents('.input-group-btn').siblings('input').val(quantity - 1);
            }
    });
    
    $(document).on('click','.btn-pink',function(){
        //alert('Checkout page is under working you will see today !');
    })
    
    
    
    //SweetAlert Delete Function
	$(document).on('click','.btn-remove',function(){
		    var course = $(this).attr('data-course');
			var warning = "No podràs revertir això";			
		   swal.fire({
		   title: 'Estàs segur?',
		   text: warning,
		   icon: 'warning',
		   showCancelButton: true,
		   confirmButtonColor: '#3085d6',
		   cancelButtonColor: '#d33',
		   confirmButtonText: 'si, esborra-ho',
		   preConfirm: function() {
			  return new Promise(function(resolve) {
				  $.ajax({
					 url: 'All_Functions.php' ,
					 type: 'POST',
					 data: {course:course,'action':'remove_course'},
					 dataType: 'json'
				  })
				  .done(function(response){
						//swal.fire('Removed!', response.msg, 'success');
						location.reload(true); 
						})
				  .fail(function(){
					 swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
				  });
			  });
		   },
		   allowOutsideClick: false     
		   }); 
    });
    
    $(document).on('click','.swal2-confirm',function(){
        
       location.reload(true); 
    });
    
}); 