<?php
// Include autoloader 
    require_once 'dompdf/autoload.inc.php'; 
     
    // Reference the Dompdf namespace 
    use Dompdf\Dompdf; 
    include('connection.php');

    $editorial = $_GET['editorial'];
    $query = "SELECT Distinct products.course_id,courses.course_name FROM `products` JOIN courses on courses.id = products.course_id WHERE editorial = '$editorial'";
	   $courses = mysqli_query($con,$query);
	   if(mysqli_num_rows($courses) > 0){
	       $books = array();
	        while($course = mysqli_fetch_assoc($courses)){
	                 $course_books = array();

    	            $book_results = mysqli_query($con,"select * from products where course_id  = ".$course['course_id']." AND editorial = '$editorial'");
    	            $total_books = mysqli_num_rows($book_results);
    	            while($book_detail =  mysqli_fetch_assoc($book_results)){
    	                $count = mysqli_num_rows(mysqli_query($con,"SELECT * FROM `order_details` where product_id = ".$book_detail['id']));
    	                if( $count > 0){
            	            $book_detail['course_name'] = $course['course_name'];
            	            $book_detail['total_books'] = $count;
            	            $course_books[] =$book_detail;
    	                }else{
        	                continue;
        	            }
    	            }
    	            $books[]   = $course_books;
	            
	   }
	       
  
	if(count($books) > 0){
	    
		    $searched_html = "<html><head><title>".$editorial."</title><meta charset='utf-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1'>
          <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css'>
          <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
          <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js'></script></head><body>";
    	    foreach($books as $book){
    	        
    	      
    	         if(count($book) > 0){
        	         $course_name = $book[0]['course_name'];
        	         
        	        $searched_html .="<div style='width:100%'><h3 style='text-align:center'>".$course_name."</h3>";
        	        $searched_html .="<table width='100%' style='border-collapse: collapse;width: 100%;margin-bottom:12px'> <tr style='background: #7c8282;color: white;width:100%'><th style='border: 1px solid #ddd;'>Nº de llibres</th><th style='border: 1px solid #ddd;'>ISBN</th><th style='border: 1px solid #ddd;'>Editorial</th><th style='border: 1px solid #ddd;'>Llibre</th></tr><tbody>";
        	        
        	        foreach($book as $bk){
        	            $searched_html .="<tr> <td style='border: 1px solid #ddd;'>".$bk['total_books']."</td> <td style='border: 1px solid #ddd;'>".$bk['isbn']."</td>  <td style='border: 1px solid #ddd;'>".$bk['editorial']."</td> <td style='border: 1px solid #ddd;'>".$bk['book_name']."</td> </tr>";
        	        }
        	        $searched_html .="</div></tbody></table>";
    	         }
                
    	    }
    	    $searched_html .="</body></html>";
	    }
	   // echo $searched_html;
	   // die;
	$dompdf = new Dompdf();
    
    // $options = $dompdf->getOptions(); 
    // $options->set(array('isRemoteEnabled' => true));
    // $dompdf->setOptions($options);
	    // Load HTML content 
    $dompdf->loadHtml($searched_html); 
     
    // (Optional) Setup the paper size and orientation 
    $dompdf->setPaper('A4', 'vertical'); 
     $dompdf->set_option('isHtml5ParserEnabled', TRUE);
    // Render the HTML as PDF 
    $dompdf->render(); 
     
    // Output the generated PDF to Browser 
    $dompdf->stream("Editorial", array("Attachment" => 0));
	}