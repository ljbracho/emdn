 <?php
	session_start();
	if (!isset($_SESSION['logged_superadmin'])) {
		header('location: login.php');
	}
	include 'connection.php';
	$response = array();
	if (isset($_GET['getPageContent'])) {
		$page = $_GET['getPageContent'];
		include("pages/$page.php");
		die;
	}



	if (isset($_POST['action']) && $_POST['action'] == 'get_curs') {

		$query = "select * from courses where etpa = " . $_POST['etapa'];
		$results = mysqli_query($con, $query);
		if (mysqli_num_rows($results) > 0) {
			while ($row =  mysqli_fetch_assoc($results)) {
				$courses[] = $row;
			}
			$response['error'] =  false;
			$response['msg'] = 'course available';
			$response['courses'] = $courses;
		} else {
			$response['error'] =  true;
			$response['msg'] = 'No Course Exists';
		}

		echo json_encode($response);
		die;
	}


	if (isset($_POST['action']) && $_POST['action'] == 'get_students_books') {

		$query = "SELECT a.*, c.course_name, sum(b.count) as libros FROM orders a INNER join order_details b on b.order_id=a.id INNER JOIN courses c on a.course=c.id where a.course =" . $_POST['course'];
		$results = mysqli_query($con, $query);
		if (mysqli_num_rows($results) > 0) {
			while ($row =  mysqli_fetch_assoc($results)) {
				$courses[] = $row;
			}
			$response['error'] =  false;
			$response['msg'] = 'course available';
			$response['students'] = $courses;
		} else {
			$response['error'] =  true;
			$response['msg'] = 'No Course Exists';
		}

		echo json_encode($response);
		die;
	}


	if (isset($_POST['action']) && $_POST['action'] == 'get_curs_by_etapa') {

		$query = "select id, course_name from courses where etpa = " . $_POST['etapa_id'];
		$results = mysqli_query($con, $query);
		if (mysqli_num_rows($results) > 0) {
			while ($row =  mysqli_fetch_assoc($results)) {
				$courses[] = $row;
			}
			$response['error'] =  false;
			$response['msg'] = 'course available';
			$response['courses'] = $courses;
		} else {
			$response['error'] =  true;
			$response['msg'] = 'No Course Exists';
		}

		echo json_encode($response);
		die;
	}
	
	if (isset($_POST['action']) && $_POST['action'] == 'get_modals_tipo') {

		$query = "select * from modalidad where tipo = " . $_POST['tipo'];
		$results = mysqli_query($con, $query);
		if (mysqli_num_rows($results) > 0) {
			while ($row =  mysqli_fetch_assoc($results)) {
				$modals[] = $row;
			}
			$response['error'] =  false;
			$response['msg'] = 'course available';
			$response['modals'] = $modals;
		} else {
			$response['error'] =  true;
			$response['msg'] = 'No Course Exists';
		}

		echo json_encode($response);
		die;
	}

	if (isset($_POST['action']) && $_POST['action'] == 'get_modals') {

		$query = "select * from modalidad";
		$results = mysqli_query($con, $query);
		if (mysqli_num_rows($results) > 0) {
			while ($row =  mysqli_fetch_assoc($results)) {
				$modals[] = $row;
			}
			$response['error'] =  false;
			$response['msg'] = 'Modals available';
			$response['modals'] = $modals;
		} else {
			$response['error'] =  true;
			$response['msg'] = 'No modalidad Exists';
		}

		echo json_encode($response);
		die;
	}

	if (isset($_POST['action']) && $_POST['action'] == 'get_books_for_order') {

		if (isset($_POST['modality'])) {
			$modality = $_POST['modality'];
         $query = "select * from products where modality like '%".$modality."%' union ";
		}
		$query .= "select * from products where course_id = ".$_POST['course_id']." order by orden asc";
		

		$results = mysqli_query($con, $query);

		if (mysqli_num_rows($results) > 0) {

			$book = array();
			while ($row  = mysqli_fetch_assoc($results)) {

				$book[]  = $row;
			}

			$response['error'] =  false;
			$response['msg'] = 'course available';
			$response['books'] = $book;
		} else {

			$response['error'] =  true;
			$response['msg'] = 'Books not available';
			$response['books'] = array();
		}

		echo json_encode($response);
		die;
	}


	if (isset($_POST['action']) && $_POST['action'] == 'order_books_details') {

		$orderID = $_POST['order_id'];
		$query = "SELECT products.* FROM `order_details` JOIN products on products.id = order_details.product_id where order_details.order_id = $orderID";
		$results = mysqli_query($con, $query);

		if (mysqli_num_rows($results) > 0) {

			$book = array();
			while ($row  = mysqli_fetch_assoc($results)) {

				$book[]  = $row;
			}

			$response['error'] =  false;
			$response['msg'] = 'Order Books available';
			$response['books'] = $book;
		} else {

			$response['error'] =  false;
			$response['msg'] = 'Books not available';
			$response['books'] = array();
		}

		echo json_encode($response);
		die;
	}


	
if(isset($_POST['action']) && $_POST['action'] == 'get_modal' ){
    
    $query = "select * from courses where id = ".$_POST['curso'];
    $results = mysqli_query($con,$query);
    $curso = mysqli_fetch_assoc($results);
    $ids = json_decode($curso['modalidad']);
    $query = "select * from modalidad where id in (". implode(',',$ids) . ")";
    $results = mysqli_query($con,$query);
    if(mysqli_num_rows($results) > 0){
        while($row =  mysqli_fetch_assoc($results)){
            $modals[] = $row;
        }
        $response['error'] =  false;
        $response['msg'] = 'course available';
        $response['modals'] = $modals;
    }else{
        $response['error'] =  true;
        $response['msg'] = 'No Course Exists';
        
    }
    
    echo json_encode($response);
    die;

}

	// add category

	if (isset($_POST['addCategory'])) {
		$category_name = htmlspecialchars($_POST['cat_name'], ENT_QUOTES);
		$category_des = $_POST['cate_description'];
		$img_name = $_FILES['icon_cat']['name'];
		if ($img_name != "") {
			/* Location */
			$location = "uploads/" . $img_name;
			move_uploaded_file($_FILES['icon_cat']['tmp_name'], $location);
		}
		$query = "INSERT INTO categorias(cat_name,cate_description,image) VALUES('$category_name','$category_des','$img_name')";
		$res = mysqli_query($con, $query);
		if ($res) {
			$response['error'] = false;
			$response['success_msg'] = "Insertado con éxito!";
		} else {
			$response['error'] = true;
			$response['error_msg'] = "Algo salió mal";
		}
		echo json_encode($response);

		die;
	}
	if (isset($_POST['addModal'])) {
		$modalidad = htmlspecialchars($_POST['modalidad'], ENT_QUOTES);
		$tipo = $_POST['tipo'];
		$query = "INSERT INTO modalidad(modalidad,tipo) VALUES('$modalidad','$tipo')";
		$res = mysqli_query($con, $query);
		if ($res) {
			$response['error'] = false;
			$response['success_msg'] = "Insertado con éxito!";
		} else {
			$response['error'] = true;
			$response['error_msg'] = "Algo salió mal";
		}
		echo json_encode($response);

		die;
	}
	date_default_timezone_set('Europe/Madrid');
	require_once 'dompdf/autoload.inc.php';
	require 'PHPMailer-5.2/PHPMailerAutoload.php';
	// Reference the Dompdf namespace 
	use Dompdf\Dompdf;

	if (isset($_POST['create_Order_Admin'])) {

		$etpa = $_POST['etpa'];
		$course_id = $_POST['course_order_id'];
		$std_name = $_POST['std_name'];
		$std_last_name = $_POST['std_last_name'];
		$parent = $_POST['parent'];
		$dni = $_POST['dni'];
		$total_price = $_POST['total_price'];
		$order_email = $_POST['order_email'];
		$order_telephone = $_POST['order_telephone'];
		$order_amount = $_POST['order_amount'];
		$books = json_decode($_POST['books']);

		$date = date('Y-m-d H:i:s');
		$query_insert = "INSERT INTO `orders` (`total_price`,`date_time`,`name_std`, `last_name_std`,`name_fth`, `id_card`, `email`, `course`, `contact_number`, `payment_method`,`payment_status`) VALUES ('$total_price','$date', '$std_name','$std_last_name', '$parent', '$dni', '$order_email', '$course_id', '$order_telephone', 'Order Admin','paid');";

		$res = mysqli_query($con, $query_insert);

		if ($res) {
			$orderid = mysqli_insert_id($con);
			$rand = generateRandomString(10) . "EMDN-Comanda" . $orderid;
			foreach ($books as $book) {
				$book_id = $book;
				$query_detail = "INSERT INTO `order_details` (`product_id`, `order_id`, `count`) VALUES ('$book_id','$orderid', '1');";
				mysqli_query($con, $query_detail);
			}

			$query_transaction = mysqli_query($con, "INSERT INTO `transection_history` ( `order_id`, `total_price`, `payment_method`, `payment_status`,`date_time`,`token`) VALUES ('$orderid', '$total_price', 'Direct Bank', 'paid','$date','');");

			$order_data = mysqli_fetch_assoc(mysqli_query($con, "select * from orders where id = " . $orderid));
			$iva_four = 0;
			$iva_twenty = 0;
			$order_details = mysqli_query($con, "select * from order_details where order_id = " . $orderid);
			while ($single_book = mysqli_fetch_assoc($order_details)) {

				$books = "select * from products where id = " . $single_book['product_id'];
				$book = mysqli_fetch_assoc(mysqli_query($con, $books));
				//while($book = mysqli_fetch_assoc($results)){
				$single = str_replace(",", ".", $book['preu_final']);
				$total += $single;
				$iva += $book['iva'];
				//$ivaprice = ($book['preu_final']/100)*$book['iva'];
				if ($book['iva'] == '4%') {
					$price_without_iva = $single / 1.04;
					$price_without_iva = cutAfterDot($price_without_iva, 2);
					$iva_four += ($single - $price_without_iva);
				} else {
					$price_without_iva = $single / 1.21;
					$price_without_iva = cutAfterDot($price_without_iva, 2);
					$iva_twenty += ($single - $price_without_iva);
				}
				$total_without_iva += $price_without_iva;
				// $total += $single*1 + ($book['preu_final']/100)*$book['iva'];

				$books_details .= '<tr style="border: 1px solid #dddddd;text-align: left;">
                                        <td style="padding: 8px;border:1px solid black">' . $book['book_name'] . '</td>
                                        <td style="padding: 8px;border:1px solid black;font-size:12px">' . $book['isbn'] . '</td>
                                        <td style="padding: 8px;border:1px solid black">' . $book['editorial'] . '</td>
                                        <td style="padding: 8px;border:1px solid black"> € ' . number_format($price_without_iva, 2, ".", '') . '</td>
                                         <td style="padding: 8px;border:1px solid black;text-align:right"> € ' . number_format($single, 2, ".", '') . '</td>        
                                        
                                        </tr>';
			}
			$from = 'Emdn@emdn.cat';
			$fromName = 'EMDN';
			$subject = "Comanda llibres EMDN.";
			$htmlContent = '<html lang="en"><head>
          <title>EMDN Comandes</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        </head>
        <body style="background:white;font-size:11px">
        <div style="margin:0 auto;width:100%;background:white;padding:12px">
            <div style="margin-bottom:12px">
                <a href="http://www.emdnstore.es/" >
                    <img src="http://www.emdnstore.es/assets/imgs/logo.jpg" style="width:170px;height:100px;" alt="">
                </a>
            </div>
            <p style="color:black;"><b>LLIBRES DE TEXT I MATERIAL INDIVIDUAL PER AL CURS ' . date("Y") . "-" . date('Y', strtotime('+1 year')) . '</b></p>
            <div style="border:1px solid black;margin-bottom:10px">
                <div style="width:45%;display:inline-block;border-right:1px solid black;margin-top:10px;padding-left:8px">
                
                    <p style="margin:0px"><b>Factura : </b> <span>' . $orderid . "-Comandes" . '</span></p>
                    <p style="margin:0px"><b>Data factura : </b> <span>' . date("d M Y") . '</span></p>
                    <p style="margin:0px"><b>Raó Social : </b> <span> IPEC S.L. </span></p>
                    <p style="margin:0px"><b>CIF : </b> <span> B-58051889 </span></p>
                    
                </div>
                <div style="width:45%;display:inline-block;margin-top:10px;padding-left:8px">
                    <p style="margin:0px"><b> Nom Alumne/a: </b> ' . $order_data['name_std'] . '</p>
                    <p style="margin:0px"><b>Nom Pare/Mare/Tutor: </b> ' . $order_data['name_fth'] . ' </p>
                    <p style="margin:0px"><b>DNI:  </b> ' . $order_data['id_card'] . ' </p>
                    <p style="margin:0px">&nbsp;</p>
                </div>
            </div>
            <table style="border-collapse: collapse;width: 100%;margin-bottom:12px">
              <tr style="border: 1px solid #dddddd;text-align: left;background: #b3aeae;">
                <th style="padding: 8px;border:1px solid black">DESCRIPCIÓ</th>
                <th style="padding: 8px;border:1px solid black">ISBN/CODI</th>
                <th style="padding: 8px;border:1px solid black">EDITORIAL</th>
                <th style="padding: 8px;border:1px solid black">Preu S/IVA</th>
                <th style="padding: 8px;border:1px solid black">Preu+IVA</th>
              </tr>
              
              ' . $books_details . '
              </table>
              <br>
                <div style="width:55%;overflow:hidden;display:inline-block;margin-bottom:12px">
                </div>
                 <div style="width:45%;overflow:hidden;display:inline-block;margin-bottom:12px;text-align:right;border: 1px solid black;padding:0px;">
                  <table style="width:100%;margin:0px">
                     <tr style="text-align: left;">
                                       
                                        <td colspan="3" style="padding: 8px;border:1px solid black;text-align:right">Total</td>
                                         <td style="padding: 8px;border:1px solid black"> € ' . number_format($total_without_iva, 2, ".", '') . '</td>
                                        <td style="padding: 8px;border:1px solid black"> € ' . number_format($total, 2, ".", '') . '</td>
                    </tr>
                    </table>
                </div>
               
              <br>
             <div style="width:48%;overflow:hidden;display:inline-block;margin-bottom:12px">
            </div>
            <div style="width:48%;overflow:hidden;display:inline-block;margin-bottom:12px;text-align:right">
                <div >
                      <p> <b>Base  4% : </b> € ' . number_format($iva_four, 2, ".", '') . '</p>
                      <p> <b>Base  21% :  </b> € ' . number_format($iva_twenty, 2, ".", '') . ' </p>
                </div>
             </div>
             
             <div style="width:79%;display:inline-block;margin-bottom:12px;text-align:right">
             <p>
            </div>
            <div style="width:20%;display:inline-block;margin-bottom:12px;text-align:right">
                <div>
                     <p style="border:1px solid black"> <b> Total :  </b>   ' . number_format($total, 2, ".", '') . ' € </p>
                </div>
             </div>
        
        </div>
        
        </body>
        </html>';
			
			$query = "select * from config_messages where tipo = 1";
			$query_result = mysqli_query($con, $query);
			if ($row =  mysqli_fetch_assoc($query_result)) {
				$msg = $row["message"];
			} else {
				$msg = "<p>La vostra comanda s’ha realitzat correctament, us n’adjuntem la factura.</p><br>
				<p>A principis de setembre rebreu per correu electrònic totes les llicències dels llibres i dossiers digitals.</p>
				<p>Els llibres es lliuraran el primer dia de classe</p>
				<p>Moltes gràcies per confiar, una vegada més, en el projecte de l’escola.</b></p>";
			}

			$filename = "pdfs/" . $orderid . "-EMDN-Factura.pdf";


			@$dompdf = new Dompdf();
			$options = $dompdf->getOptions();
			$options->set(array('isRemoteEnabled' => true));
			$dompdf->setOptions($options);
			$dompdf->loadHtml($htmlContent);
			$dompdf->setPaper('A4', 'verti');
			$dompdf->render();
			//$dompdf->stream($filename.".pdf");
			$output = $dompdf->output();
			file_put_contents($filename, $output);
			

			$mail = new PHPMailer;
			
			//$mail->SMTPDebug = 3;
			
			$mail->isSMTP();
			$mail->Host = 'mail.emdn.cat';
			$mail->SMTPAuth = true;
			$mail->Username = 'emdn_contacto@emdn.cat';
			$mail->Password = ')CpcPPEg@yvi';
			$mail->SMTPSecure = 'ssl';
			$mail->Port = 465;
			
			$mail->setFrom($from, $fromName);
			$mail->addAddress($order_email, $parent);
			$mail->addReplyTo($from, $fromName);
			$mail->addStringAttachment($output,$filename);
			$mail->isHTML(true);
			
			$mail->Subject = $subject;
			$mail->Body    = $msg;
			$mail->AltBody = $msg;
			
			if(!$mail->send()) {
				$response['error'] = true;
				$response['error_msg'] = "error in email";
				print_r(error_get_last());
			} else {
				$response['error'] = false;
				$response['success_msg'] = "Insertado con éxito!";
			}

		} else {
			$response['error'] = true;
			$response['error_msg'] = "Algo salió mal";
		}
		echo json_encode($response);

		die;
	}

	if (isset($_POST['addCourse'])) {
		$course_name = htmlspecialchars($_POST['course_name'], ENT_QUOTES);
		$etpa = $_POST['etpa'];
		$modal = json_encode($_POST['modalidad']);
		$description = $_POST['description'];
		$query = "INSERT INTO courses(course_name,etpa,description,modalidad) VALUES('$course_name','$etpa','$description','$modal')";
		$res = mysqli_query($con, $query);
		if ($res) {
			$response['error'] = false;
			$response['success_msg'] = "Insertado con éxito!";
		} else {
			$response['error'] = true;
			$response['error_msg'] = "Algo salió mal" . mysqli_error($con);
		}
		echo json_encode($response);

		die;
	}



	function generateRandomString($length)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}





	function cutAfterDot($number, $afterDot = 2)
	{
		$a = $number * pow(10, $afterDot);
		$b = floor($a);
		$c = pow(10, $afterDot);
		//echo "a $a, b $b, c $c<br/>";
		return $b / $c;
	}


	if (isset($_POST['addGeneralMessage'])) {
		$general_message = nl2br(htmlspecialchars($_POST['general_message'], ENT_QUOTES));
		if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM `messages`  where course_id = '0'")) == 0) {
			$query = "INSERT INTO `messages` (`message_content`, `course_id`) VALUES ('$general_message', '0');";
			$message = "Inserted Successfully!";
		} else {

			$query = "Update `messages` Set `message_content`='$general_message' Where course_id = 0";
			$message = "Updated Successfully!";
		}
		$res = mysqli_query($con, $query);
		if ($res) {
			$response['error'] = false;
			$response['success_msg'] = $message;
		} else {
			$response['error'] = true;
			$response['error_msg'] = "Algo salió mal" . mysqli_error($con);
		}
		echo json_encode($response);

		die;
	}


	if (isset($_POST['addCourseMessage'])) {
		$course_message = nl2br(htmlspecialchars($_POST['course_message'], ENT_QUOTES));
		$course_id = $_POST['missatge_course'];
		if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM `messages`  where course_id = '$course_id'")) == 0) {
			$query = "INSERT INTO `messages` (`message_content`, `course_id`) VALUES ('$course_message', '$course_id');";
			$message = "Inserted Successfully!";
		} else {

			$query = "Update `messages` Set `message_content`='$course_message' Where course_id = '$course_id'";
			$message = "Updated Successfully!";
		}
		$res = mysqli_query($con, $query);
		if ($res) {
			$response['error'] = false;
			$response['success_msg'] = $message;
		} else {
			$response['error'] = true;
			$response['error_msg'] = "Algo salió mal" . mysqli_error($con);
		}
		echo json_encode($response);

		die;
	}

	if (isset($_POST['get_message_course'])) {
		$course_id = $_POST['missatge_course'];
		$check_msg = mysqli_query($con, "SELECT * FROM `messages`  where course_id = '$course_id'");
		if (mysqli_num_rows($check_msg) > 0) {
			$get_msg = mysqli_fetch_assoc($check_msg);
			$response['message'] = $get_msg['message_content'];
			$response['error'] = false;
			$response['success_msg'] = $message;
		} else {
			$response['error'] = true;
			$response['error_msg'] = "No Message of this Course";
		}

		echo json_encode($response);

		die;
	}


	if (isset($_POST['get_modalidad'])) {
		$course_id = $_POST['missatge_course'];
		$check_msg = mysqli_query($con, "SELECT * FROM `messages`  where course_id = '$course_id'");
		if (mysqli_num_rows($check_msg) > 0) {
			$get_msg = mysqli_fetch_assoc($check_msg);
			$response['message'] = $get_msg['message_content'];
			$response['error'] = false;
			$response['success_msg'] = $message;
		} else {
			$response['error'] = true;
			$response['error_msg'] = "No Message of this Course";
		}

		echo json_encode($response);

		die;
	}


	if (isset($_POST['get_courses_sales'])) {
		$course_id = $_POST['course_id'];
		$course = $_POST['text_value'];
		$all_products = mysqli_query($con, "SELECT Distinct * FROM `order_details` JOIN products on products.id = order_details.product_id");
		if (mysqli_num_rows($all_products) > 0) {
			$books_sale = array();
			while ($get_single_product = mysqli_fetch_assoc($all_products)) {
				if ($get_single_product['course_id'] != $course_id) {
					continue;
				} else {
					//echo "SELECT * FROM `orders` where id = '".$get_single_product['order_id']."' AND payment_status = 'paid'";
					$get_user = mysqli_query($con, "SELECT * FROM `orders` where id = '" . $get_single_product['order_id'] . "' AND payment_status = 'paid'");
					if (mysqli_num_rows($get_user) > 0) {
						$get_user = mysqli_fetch_assoc($get_user);
						$get_single_product['price'] =  str_replace(",", '.', $get_single_product['preu_final']);
						$get_single_product['student'] = $get_user['name_std'];


						$data['cat'] = $course;
						$data['company'] = $get_user['name_std'];
						$data['price'] = $get_single_product['price'];

						$books_sale[]  = $data;
					}
				}
			}
			$response['books_sale'] = $books_sale;
			$response['error'] = false;
			$response['success_msg'] = $message;
		} else {
			$response['error'] = true;
			$response['error_msg'] = "No Sales of This Course Yet!";
		}

		echo json_encode($response);

		die;
	}

	if (isset($_POST['search_editor'])) {
		$editorial = $_POST['editorial'];
		$query = "SELECT Distinct products.course_id,courses.course_name FROM `products` JOIN courses on courses.id = products.course_id WHERE editorial = '$editorial'";
		$courses = mysqli_query($con, $query);
		if (mysqli_num_rows($courses) > 0) {
			$books = array();
			while ($course = mysqli_fetch_assoc($courses)) {
				$course_books = array();

				$book_results = mysqli_query($con, "select * from products where course_id  = " . $course['course_id'] . " AND editorial = '$editorial'");
				$total_books = mysqli_num_rows($book_results);
				while ($book_detail =  mysqli_fetch_assoc($book_results)) {
					$count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `order_details` where product_id = " . $book_detail['id']));
					if ($count > 0) {
						$book_detail['course_name'] = $course['course_name'];
						$book_detail['total_books'] = $count;
						$course_books[] = $book_detail;
					} else {
						continue;
					}
				}
				$books[]   = $course_books;
			}

			$response['error'] = false;
			$response['books'] = $books;
			$response['success_msg'] = "Record Found";
		} else {
			$response['error'] = true;
			$response['error_msg'] = "No s'ha trobat cap registre";
		}
		echo json_encode($response);

		die;
	}


	if (isset($_POST['addPromotion'])) {
		$brand_name = $_POST['promotion_name'];
		$brand_desc = $_POST['pro_description'];
		$pro_img = $_FILES['promotion_image']['name'];
		$pro_img_tmp = $_FILES['promotion_image']['tmp_name'];
		$folder = "uploads/promotions/" . $pro_img;
		if (move_uploaded_file($pro_img_tmp, $folder)) {
			$query = "INSERT INTO promotions(promotion_name,promtion_img,description) VALUES('$brand_name','$pro_img','$brand_desc')";
			$res = mysqli_query($con, $query);
			if ($res) {
				$response['error'] = false;
				$response['success_msg'] = "Insertado con éxito!";
			} else {
				$response['error'] = true;
				$response['error_msg'] = "Algo salió mal";
			}
		} else {

			$response['error'] = true;
			$response['error_msg'] = "Algo salió mal";
		}
		echo json_encode($response);

		die;
	}


	if (isset($_POST['addType'])) {
		$category_name = $_POST['typename'];
		$category_des = $_POST['type_description'];
		$query = "INSERT INTO garment_type(type_name,type_description) VALUES('$category_name','$category_des')";
		$res = mysqli_query($con, $query);
		if ($res) {
			$response['error'] = false;
			$response['success_msg'] = "Insertado con éxito!";
		} else {
			$response['error'] = true;
			$response['error_msg'] = "Algo salió mal";
		}
		echo json_encode($response);

		die;
	}
	// add Dish

	if (isset($_POST['addproducts'])) {
		$bookname = htmlspecialchars($_POST['bookname'], ENT_QUOTES);
		$course_id = $_POST['course_id'];
		$isbn = $_POST['isbn'];
		$description = $_POST['description'];
		$editorial = $_POST['editorial'];
		$pre_final = $_POST['pre_final'];
		$obligatori =  $_POST['obligatori'];
		$modality =  json_encode($_POST['modalidad']);
		$iva =  $_POST['iva'];
		$orden = $_POST['orden'];
		$pro_img = $_FILES['bookimage']['name'];
		$pro_img_tmp = $_FILES['bookimage']['tmp_name'];
		$folder = "uploads/" . $pro_img;
		if ($pro_img != "") {
			if (move_uploaded_file($pro_img_tmp, $folder)) {
				$query = "INSERT INTO `products` (`book_name`, `course_id`, `obligatori`,`modality`,`iva`, `preu_final`, `isbn`, `editorial`, `image_name`, `description`,`orden`) VALUES ('$bookname',$course_id, '$obligatori','$modality' ,'$iva', '$pre_final', '$isbn', '$editorial', '$pro_img', '$description','$orden');";
			}
		} else {
			$query = "INSERT INTO `products` (`book_name`, `course_id`, `obligatori`,`modality`,`iva`, `preu_final`, `isbn`, `editorial`, `image_name`, `description`,`orden`) VALUES ('$bookname',$course_id, '$obligatori','$modality','$iva', '$pre_final', '$isbn', '$editorial', '', '$description','$orden');";
		}
		$res = mysqli_query($con, $query);

		if ($res) {
			$response['error'] = false;
			$response['success_msg'] = "Insertado con éxito!";
		} else {
			$response['error'] = true;
			$response['error_msg'] = "Something went wrong!" . mysqli_error($con);
		}
		echo json_encode($response);


		die;
	}
	// GET DATA
	if (isset($_GET['action'])) {
		$action =  $_GET['action'];
		switch ($action) {
			case "get_transactions":
				$draw = $_POST['draw'];
				$row = $_POST['start'];
				$rowperpage = $_POST['length']; // Rows display per page
				$columnIndex = $_POST['order'][0]['column']; // Column index
				$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
				$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
				$searchValue = $_POST['search']['value']; // Search value

				## Search 
				$searchQuery = " ";
				if ($searchValue != '') {
					$searchQuery = " and (total_price like '%" . $searchValue . "%' or name_std like '%". $searchValue. "%' or last_name_std like '%".$searchValue."%' or email like '%".$searchValue."%')  ";
				}

				## Total number of records without filtering
				$sel = mysqli_query($con, "select count(*) as allcount from transection_history where payment_status = 'paid'");
				$records = mysqli_fetch_assoc($sel);
				$totalRecords = $records['allcount'];

				## Total number of record with filtering
				$sel = mysqli_query($con, "select count(*) as allcount from transection_history WHERE  payment_status = 'paid' " . $searchQuery);
				$records = mysqli_fetch_assoc($sel);
				$totalRecordwithFilter = $records['allcount'];

				## Fetch records
				$empQuery = "select * from orders WHERE payment_status = 'paid' " . $searchQuery . "   order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
				$empRecords = mysqli_query($con, $empQuery);
				$data = array();

				while ($row = mysqli_fetch_assoc($empRecords)) {
					if ($row['payment_status'] == 'pending') {
						$payment_status = "<span class='label label-warning'>Amount Pending</span>";
						$style = "color:green;font-size: 16px;";
					} else {
						$payment_status = "<span class='label label-success'>Amount Paid</span>";
						$style = "font-weight: bolder;color:green;font-size: 18px;";
					}
					$data[] = array(
						"id" => "#TRANS-" . $row['id'],
						"order_id" => "<span class='label label-default'>#ORD-" . $row['id'] . "</span>",
						"std_name" => $row['name_std'] . " " . $row['last_name_std'],
						"price" => "<b><span style='" . $style . "'> € " . number_format(cutAfterDot($row['total_price'], 2), 2) . "</span></b>",
						"payment_method" => $row['payment_method'],
						"payment_status" => $payment_status,
						"datetime" => date("d M Y h:i A", strtotime($row['date_time'])),
						"action_del_edit" => "<div data-cat_id='" . $row['id'] . "'><button type='button' class='btn btn-primary get_book_details' data-orderid='" . $row['id'] . "' title='Factura'><i class='fa fa-files-o'></i></button>
				<input type='hidden' class='edit_cat_id' data-catid='" . $row['id'] . "'>
				<button type='button' class='btn btn-primary btn-edit'><i class='fa fa-edit'></i></button>
			<button class='btn btn-danger btn-yes' type='button'><i class='fa fa-trash'></i></button> 
				<input type='hidden' class='cat_id' data-id='" . $row['id'] . "'>
				<input type='hidden' class='page' value='transactions'>
				</div>"
					);
				}
				## Response
				$response = array(
					"draw" => intval($draw),
					"iTotalRecords" => $totalRecords,
					"iTotalDisplayRecords" => $totalRecordwithFilter,
					"aaData" => $data
				);
				echo json_encode($response);
				die;
				break;
			case "get_categories":
				$draw = $_POST['draw'];
				$row = $_POST['start'];
				$rowperpage = $_POST['length']; // Rows display per page
				$columnIndex = $_POST['order'][0]['column']; // Column index
				$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
				$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
				$searchValue = $_POST['search']['value']; // Search value

				## Search 
				$searchQuery = " ";
				if ($searchValue != '') {
					$searchQuery = " and (cat_name like '%" . $searchValue . "%' ) ";
				}

				## Total number of records without filtering
				$sel = mysqli_query($con, "select count(*) as allcount from categorias");
				$records = mysqli_fetch_assoc($sel);
				$totalRecords = $records['allcount'];

				## Total number of record with filtering
				$sel = mysqli_query($con, "select count(*) as allcount from categorias WHERE 1 " . $searchQuery);
				$records = mysqli_fetch_assoc($sel);
				$totalRecordwithFilter = $records['allcount'];

				## Fetch records
				$empQuery = "select * from categorias WHERE 1 " . $searchQuery . "   order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
				$empRecords = mysqli_query($con, $empQuery);
				$data = array();

				while ($row = mysqli_fetch_assoc($empRecords)) {
					$data[] = array(
						"id" => "#ETPA" . $row['id'],
						"cate_name" => $row['cat_name'],
						"cate_description" => $row['cate_description'],
						"action_del_edit" => "<div data-cat_id='" . $row['id'] . "'><button type='button' class='btn btn-primary btn-edit'><i class='fa fa-edit'></i></button>
				<input type='hidden' class='edit_cat_id' data-catid='" . $row['id'] . "'>
				<button class='btn btn-danger btn-yes' type='button'><i class='fa fa-trash'></i></button> 
				<input type='hidden' class='cat_id' data-id='" . $row['id'] . "'>
				<input type='hidden' class='page' value='category'>
				</div>"
					);
				}
				## Response
				$response = array(
					"draw" => intval($draw),
					"iTotalRecords" => $totalRecords,
					"iTotalDisplayRecords" => $totalRecordwithFilter,
					"aaData" => $data
				);
				echo json_encode($response);
				die;
				break;
				case "get_modals":
					$draw = $_POST['draw'];
					$row = $_POST['start'];
					$rowperpage = $_POST['length']; // Rows display per page
					$columnIndex = $_POST['order'][0]['column']; // Column index
					$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
					$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
					$searchValue = $_POST['search']['value']; // Search value
	
					## Search 
					$searchQuery = " ";
					if ($searchValue != '') {
						$searchQuery = " and (modalidad like '%" . $searchValue . "%' ) ";
					}
	
					## Total number of records without filtering
					$sel = mysqli_query($con, "select count(*) as allcount from modalidad");
					$records = mysqli_fetch_assoc($sel);
					$totalRecords = $records['allcount'];
	
					## Total number of record with filtering
					$sel = mysqli_query($con, "select count(*) as allcount from modalidad WHERE 1 " . $searchQuery);
					$records = mysqli_fetch_assoc($sel);
					$totalRecordwithFilter = $records['allcount'];
	
					## Fetch records
					$empQuery = "select * from modalidad WHERE 1 " . $searchQuery . "   order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
					$empRecords = mysqli_query($con, $empQuery);
					$data = array();
	
					while ($row = mysqli_fetch_assoc($empRecords)) {
						$data[] = array(
							"id" => "#ETPA" . $row['id'],
							"modalidad" => $row['modalidad'],
							"tipo" => ($row['tipo'] == 1) ? 'Modalidad' : 'Itinerario',
							"action_del_edit" => "<div data-cat_id='" . $row['id'] . "'><button type='button' class='btn btn-primary btn-edit'><i class='fa fa-edit'></i></button>
					<input type='hidden' class='edit_cat_id' data-catid='" . $row['id'] . "'>
					<button class='btn btn-danger btn-yes' type='button'><i class='fa fa-trash'></i></button> 
					<input type='hidden' class='cat_id' data-id='" . $row['id'] . "'>
					<input type='hidden' class='page' value='modal'>
					</div>"
						);
					}
					## Response
					$response = array(
						"draw" => intval($draw),
						"iTotalRecords" => $totalRecords,
						"iTotalDisplayRecords" => $totalRecordwithFilter,
						"aaData" => $data
					);
					echo json_encode($response);
					die;
					break;
			case "promotions":
				$draw = $_POST['draw'];
				$row = $_POST['start'];
				$rowperpage = $_POST['length']; // Rows display per page
				$columnIndex = $_POST['order'][0]['column']; // Column index
				$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
				$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
				$searchValue = $_POST['search']['value']; // Search value

				## Search 
				$searchQuery = " ";
				if ($searchValue != '') {
					$searchQuery = " and (promotion_name like '%" . $searchValue . "%') ";
				}

				## Total number of records without filtering
				$sel = mysqli_query($con, "select count(*) as allcount from promotions");
				$records = mysqli_fetch_assoc($sel);
				$totalRecords = $records['allcount'];

				## Total number of record with filtering
				$sel = mysqli_query($con, "select count(*) as allcount from promotions WHERE 1 " . $searchQuery);
				$records = mysqli_fetch_assoc($sel);
				$totalRecordwithFilter = $records['allcount'];

				## Fetch records
				$empQuery = "select * from promotions  WHERE 1 " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
				$empRecords = mysqli_query($con, $empQuery);
				$data = array();

				while ($row = mysqli_fetch_assoc($empRecords)) {
					$data[] = array(
						"id" => "#Promotion-" . $row['id'],
						"promotion_name" => $row['promotion_name'],
						"promotion_image" => "<img src='uploads/promotions/" . $row['promtion_img'] . "' class='img thumbnail' width='80px' />",
						"description" => $row['description'],
						"action_del_edit" => "<div class='actionclass' data-cat_id='" . $row['id'] . "'><button type='button' class='btn btn-primary btn-edit'><i class='fa fa-edit'></i></button>
				<input type='hidden' class='edit_cat_id' data-catid='" . $row['id'] . "'>
				<button class='btn btn-danger btn-yes' type='button'><i class='fa fa-trash'></i></button> 
				<input type='hidden' class='cat_id' data-id='" . $row['id'] . "'>
				<input type='hidden' class='page' value='promotions'>
				</div>"
					);
				}
				## Response
				$response = array(
					"draw" => intval($draw),
					"iTotalRecords" => $totalRecords,
					"iTotalDisplayRecords" => $totalRecordwithFilter,
					"aaData" => $data
				);

				echo json_encode($response);
				break;
			case "get_courses":
				$draw = $_POST['draw'];
				$row = $_POST['start'];
				$rowperpage = $_POST['length']; // Rows display per page
				$columnIndex = $_POST['order'][0]['column']; // Column index
				$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
				$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
				$searchValue = $_POST['search']['value']; // Search value

				## Search 
				$searchQuery = " ";
				if ($searchValue != '') {
					$searchQuery = " and (course_name like '%" . $searchValue . "%') ";
				}

				## Total number of records without filtering
				$sel = mysqli_query($con, "select count(*) as allcount from courses");
				$records = mysqli_fetch_assoc($sel);
				$totalRecords = $records['allcount'];

				## Total number of record with filtering
				$sel = mysqli_query($con, "select count(*) as allcount from courses WHERE 1 " . $searchQuery);
				$records = mysqli_fetch_assoc($sel);
				$totalRecordwithFilter = $records['allcount'];

				## Fetch records
				$empQuery = "select courses.*,categorias.cat_name from courses join categorias on categorias.id = courses.etpa  WHERE 1 " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
				$empRecords = mysqli_query($con, $empQuery);
				$data = array();

				while ($row = mysqli_fetch_assoc($empRecords)) {
					$data[] = array(
						"id" => "#COURSE-" . $row['id'],
						"course_name" => $row['course_name'],
						"etpa" => "<span class='label label-success'>" . $row['cat_name'] . "</span>",
						"description" => $row['description'],
						"action_del_edit" => "<div data-cat_id='" . $row['id'] . "'><button type='button' class='btn btn-primary btn-edit'><i class='fa fa-edit'></i></button>
				<input type='hidden' class='edit_cat_id' data-catid='" . $row['id'] . "'>
				<button class='btn btn-danger btn-yes' type='button'><i class='fa fa-trash'></i></button> 
				<input type='hidden' class='cat_id' data-id='" . $row['id'] . "'>
				<input type='hidden' class='page' value='courses'>
				</div>"
					);
				}
				## Response
				$response = array(
					"draw" => intval($draw),
					"iTotalRecords" => $totalRecords,
					"iTotalDisplayRecords" => $totalRecordwithFilter,
					"aaData" => $data
				);

				echo json_encode($response);
				break;
			case "get_brands":
				$draw = $_POST['draw'];
				$row = $_POST['start'];
				$rowperpage = $_POST['length']; // Rows display per page
				$columnIndex = $_POST['order'][0]['column']; // Column index
				$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
				$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
				$searchValue = $_POST['search']['value']; // Search value

				## Search 
				$searchQuery = " ";
				if ($searchValue != '') {
					$searchQuery = " and (brand_name like '%" . $searchValue . "%') ";
				}

				## Total number of records without filtering
				$sel = mysqli_query($con, "select count(*) as allcount from brands");
				$records = mysqli_fetch_assoc($sel);
				$totalRecords = $records['allcount'];

				## Total number of record with filtering
				$sel = mysqli_query($con, "select count(*) as allcount from brands WHERE 1 " . $searchQuery);
				$records = mysqli_fetch_assoc($sel);
				$totalRecordwithFilter = $records['allcount'];

				## Fetch records
				$empQuery = "select * from brands  WHERE 1 " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
				$empRecords = mysqli_query($con, $empQuery);
				$data = array();

				while ($row = mysqli_fetch_assoc($empRecords)) {
					$data[] = array(
						"id" => "#Brand-" . $row['id'],
						"brand_name" => $row['brand_name'],
						"description" => $row['brand_desc'],
						"action_del_edit" => "<div class='actionclass' data-cat_id='" . $row['id'] . "'><button type='button' class='btn btn-primary btn-edit'><i class='fa fa-edit'></i></button>
				<input type='hidden' class='edit_cat_id' data-catid='" . $row['id'] . "'>
				<button class='btn btn-danger btn-yes' type='button'><i class='fa fa-trash'></i></button> 
				<input type='hidden' class='cat_id' data-id='" . $row['id'] . "'>
				<input type='hidden' class='page' value='brands'>
				</div>"
					);
				}
				## Response
				$response = array(
					"draw" => intval($draw),
					"iTotalRecords" => $totalRecords,
					"iTotalDisplayRecords" => $totalRecordwithFilter,
					"aaData" => $data
				);

				echo json_encode($response);
				break;
			case "get_books":
				$draw = $_POST['draw'];
				$row = $_POST['start'];
				$rowperpage = $_POST['length']; // Rows display per page
				$columnIndex = $_POST['order'][0]['column']; // Column index
				$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
				$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
				$searchValue = $_POST['search']['value']; // Search value

				## Search 
				$searchQuery = " ";
				if ($searchValue != '') {
					$searchQuery = " WHERE (products.book_name like '%" . $searchValue . "%' ) ";
				}

				## Total number of records without filtering
				$sel = mysqli_query($con, "select count(*) as allcount from products");
				$records = mysqli_fetch_assoc($sel);
				$totalRecords = $records['allcount'];

				## Total number of record with filtering
				$sel = mysqli_query($con, "select count(*) as allcount from products " . $searchQuery);
				$records = mysqli_fetch_assoc($sel);
				$totalRecordwithFilter = $records['allcount'];

				## Fetch records
				$empQuery = "SELECT products.*,courses.course_name FROM `products` join courses on courses.id = products.course_id " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
				$empRecords = mysqli_query($con, $empQuery);
				$data = array();

				while ($row = mysqli_fetch_assoc($empRecords)) {
					if ($row['image_name']) {
						$img = "<img class='img img-thumbnail' src='uploads/" . $row['image_name'] . "' width='50px' height='50px' >";
					} else {
						$img = "No image Yet!";
					}
					
    $ids = json_decode($row['modality']);
    $query = "select * from modalidad where id in (". implode(',',$ids) . ")";
	$results = mysqli_query($con,$query);
    if(mysqli_num_rows($results) > 0){
		$modalidad = "<ul style='font-size: 11px;' align:right;>";
        while($modal =  mysqli_fetch_assoc($results)){
			$modalidad .= "<li>".$modal['modalidad']."</li>";
		}
		$modalidad .= "</ul>";
	} else {
		$modalidad = "---";
	}
					$data[] = array(
						"id" => "#Lilbres" . $row['id'],
						"book_name" => $row['book_name'],
						"course_id" => $row['course_name'],
						"isbn" => $row['isbn'],
						"editorial" => $row['editorial'],
						"preu_final" => $row['preu_final'],
						"obligatori" => $row['obligatori'],
						"iva" => $row['iva'],
						"image" => $img,
						"modalidad" => $modalidad,
						"orden" => $row['orden'],
						"action_del_edit" => "<div class='actionclass' data-cat_id='" . $row['id'] . "'><button type='button'  class='btn bg-purple btn-edit'><i class='fa fa-edit'></i></button>
        				<input type='hidden' class='edit_cat_id' data-catid='" . $row['id'] . "'>
        				<button class='btn btn-danger btn-yes' type='button'><i class='fa fa-trash'></i></button> 
        				<input type='hidden' class='cat_id' data-id='" . $row['id'] . "'>
        				<input type='hidden' class='page' value='product'>
        				</div>"
					);
				}
				## Response
				$response = array(
					"draw" => intval($draw),
					"iTotalRecords" => $totalRecords,
					"iTotalDisplayRecords" => $totalRecordwithFilter,
					"aaData" => $data
				);

				echo json_encode($response);
				break;
			case "get_new_order":
				$draw = $_POST['draw'];
				$row = $_POST['start'];
				$rowperpage = $_POST['length']; // Rows display per page
				$columnIndex = $_POST['order'][0]['column']; // Column index
				$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
				$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
				$searchValue = $_POST['search']['value']; // Search value

				## Search 
				$searchQuery = " ";
				if ($searchValue != '') {
					$searchQuery = " and (totalPrice like '%" . $searchValue . "%' ) ";
				}

				$where_status = intval($_GET['pending']) == 1 ? 'pending' : 'paid';

				## Total number of records without filtering
				$sel = mysqli_query($con, "select count(*) as allcount from orders where payment_status = '$where_status'");
				$records = mysqli_fetch_assoc($sel);
				$totalRecords = $records['allcount'];

				## Total number of record with filtering
				$sel = mysqli_query($con, "select count(*) as allcount from orders WHERE 1 " . $searchQuery . " AND payment_status = '$where_status'");
				$records = mysqli_fetch_assoc($sel);
				$totalRecordwithFilter = $records['allcount'];

				## Fetch records
				$empQuery = "SELECT * from orders   WHERE 1 " . $searchQuery . " AND  payment_status = '$where_status' order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
				$empRecords = mysqli_query($con, $empQuery);
				$data = array();

				while ($row = mysqli_fetch_assoc($empRecords)) {
					$data_detail = "SELECT order_details.*,products.book_name FROM `order_details` JOIN products on products.id =  order_details.product_id WHERE order_id = " . $row['id'];
					$details = mysqli_query($con, $data_detail);
					$books = "";
					while ($book = mysqli_fetch_assoc($details)) {

						$books .= "<span class='label label-warning' style='margin-right:4px'> <i class='fa fa-book'></i>   " . $book['book_name'] . " </span><br>";
					}

					if ($row['payment_method'] == 'cash_on_delivery' || $row['payment_method'] == 'Direct Bank') {
						$method = "<i class='fa fa-credit-card ' style='font-size:28px'></i>";
					} else if ($row['payment_method'] == 'paypal') {
						$method = "<i class='fa fa-cc-paypal' style='font-size:28px'></i>";
					} else {
						$method = "<i class='fa fa-user-plus ' style='font-size:28px'></i>";
					}


					if ($row['order_status'] == 'pending') {
						$stat = "<span class='label label-warning'>Pending</span>";
					} else {
						$stat = "<span class='label label-success'>Completed</span>";
					}

					$data[] = array(
						"id" => "#ORD_" . $row['id'],
						"total_price" => number_format(cutAfterDot($row['total_price'], 2), 2) . " €",
						"name_std" => "<span style='color:#3ca13c;font-weight:600'>" . $row['name_std'] . "</span>",
						"name_fth" => "<span style='color:#3ca13c;font-weight:600'>" . $row['name_fth'] . "</span>",
						"id_card" => $row['id_card'],
						"email" => $row['email'],
						"course" => $row['course'],
						"book_name" => "<button type='button' class='btn btn-success get_book_details' data-orderid='" . $row['id'] . "'> <i class='fa fa-book'></i>  llibres </button>",
						"contact_number" => $row['contact_number'],

						"payment_method" => $method,
						"datetime" => "<span class='label label-default'>" . date('d M Y h:i A', strtotime($row['date_time'])) . "</label>",

					);
				}
				## Response
				$response = array(
					"draw" => intval($draw),
					"iTotalRecords" => $totalRecords,
					"iTotalDisplayRecords" => $totalRecordwithFilter,
					"aaData" => $data
				);

				echo json_encode($response);
				die;
				break;
			case "get_completed":
				$draw = $_POST['draw'];
				$row = $_POST['start'];
				$rowperpage = $_POST['length']; // Rows display per page
				$columnIndex = $_POST['order'][0]['column']; // Column index
				$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
				$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
				$searchValue = $_POST['search']['value']; // Search value

				## Search 
				$searchQuery = " ";
				if ($searchValue != '') {
					$searchQuery = " and (totalPrice like '%" . $searchValue . "%' ) ";
				}

				## Total number of records without filtering
				$sel = mysqli_query($con, "select count(*) as allcount from orders where (order_status = 'completed' OR order_status = 'cancelled')");
				$records = mysqli_fetch_assoc($sel);
				$totalRecords = $records['allcount'];

				## Total number of record with filtering
				$sel = mysqli_query($con, "select count(*) as allcount from orders WHERE 1 " . $searchQuery . " AND (order_status = 'completed' OR order_status = 'cancelled')");
				$records = mysqli_fetch_assoc($sel);
				$totalRecordwithFilter = $records['allcount'];

				## Fetch records
				$empQuery = "SELECT * from orders   WHERE 1 " . $searchQuery . " AND  (order_status = 'completed' OR order_status = 'cancelled') order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
				$empRecords = mysqli_query($con, $empQuery);
				$data = array();

				while ($row = mysqli_fetch_assoc($empRecords)) {
					$data_detail = "SELECT order_details.*,products.book_name FROM `order_details` JOIN products on products.id =  order_details.product_id WHERE order_id = " . $row['id'];
					$details = mysqli_query($con, $data_detail);
					$books = "";
					while ($book = mysqli_fetch_assoc($details)) {

						$books .= "<span class='label label-warning' style='margin-right:4px'> <i class='fa fa-book'></i>   " . $book['book_name'] . " </span>";
					}

					if ($row['payment_method'] == 'cash_on_delivery' || $row['payment_method'] == 'cash') {
						$method = "<i class='fa fa-money' style='font-size:34px'></i>";
					} else if ($row['payment_method'] == 'paypal') {
						$method = "<i class='fa fa-cc-paypal' style='font-size:34px'></i>";
					} else {
						$method = "<i class='fa fa-credit-card ' style='font-size:34px'></i>";
					}


					if ($row['order_status'] == 'pending') {
						$stat = "<span class='label label-warning'>Pending</span>";
					} else {
						$stat = "<span class='label label-success'>Completed</span>";
					}

					$data[] = array(
						"id" => "#ORD_" . $row['id'],
						"total_price" => $row['total_price'] . " €",
						"name_std" => "<span style='color:#3ca13c;font-weight:600'>" . $row['name_std'] . "</span>",
						"name_fth" => "<span style='color:#3ca13c;font-weight:600'>" . $row['name_fth'] . "</span>",
						"id_card" => $row['id_card'],
						"email" => $row['email'],
						"course" => $row['course'],
						"book_name" => $books,
						"contact_number" => $row['contact_number'],
						"status" => $stat,
						"payment_method" => $method,
						"datetime" => "<span class='label label-default'>" . date('d M Y h:i A', strtotime($row['date_time'])) . "</label>",

						//"image"=>"<img class='img img-thumbnail' src='uploads/".$im."' width='150px' height='150px' >".$total,
					);
				}
				## Response
				$response = array(
					"draw" => intval($draw),
					"iTotalRecords" => $totalRecords,
					"iTotalDisplayRecords" => $totalRecordwithFilter,
					"aaData" => $data
				);

				echo json_encode($response);
				break;
			case "get_users":
				$draw = $_POST['draw'];
				$row = $_POST['start'];
				$rowperpage = $_POST['length']; // Rows display per page
				$columnIndex = $_POST['order'][0]['column']; // Column index
				$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
				$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
				$searchValue = $_POST['search']['value']; // Search value

				## Search 
				$searchQuery = " ";
				if ($searchValue != '') {
					$searchQuery = " and (Username like '%" . $searchValue . "%' ) ";
				}

				## Total number of records without filtering
				$sel = mysqli_query($con, "select count(*) as allcount from los_usuarios");
				$records = mysqli_fetch_assoc($sel);
				$totalRecords = $records['allcount'];

				## Total number of record with filtering
				$sel = mysqli_query($con, "select count(*) as allcount from los_usuarios WHERE 1 " . $searchQuery);
				$records = mysqli_fetch_assoc($sel);
				$totalRecordwithFilter = $records['allcount'];

				## Fetch records
				$empQuery = "select * from los_usuarios  WHERE 1 " . $searchQuery . "  order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
				$empRecords = mysqli_query($con, $empQuery);
				$data = array();

				while ($row = mysqli_fetch_assoc($empRecords)) {
					$data[] = array(
						"id" => "#REST_" . $row['id'],
						"image" => $row['image'],
						"username" => $row['Username'],
						"email" => $row['email'],
						"phone" => $row['phone'],
						"address" => $row['address']
					);
				}
				## Response
				$response = array(
					"draw" => intval($draw),
					"iTotalRecords" => $totalRecords,
					"iTotalDisplayRecords" => $totalRecordwithFilter,
					"aaData" => $data
				);

				echo json_encode($response);
				break;
		}
	}


	// Get Images 
	if (isset($_POST['action_images'])) {
		$productid = $_POST['productid'];

		$q = "SELECT * FROM products_images where product_id = $productid";
		$results = mysqli_query($con, $q);
		$response = array();
		if (mysqli_num_rows($results) > 0) {
			$response['error'] = false;
			while ($row = mysqli_fetch_assoc($results)) {
				$data['id'] = $row['id'];
				$data['product_id'] = $row['product_id'];
				$data['image_name'] = $row['image_name'];
				$resultdata[]  = $data;
			}
			$response['data_img'] = $resultdata;
		} else {
			$response['error'] = true;
			$response['data'] = $response;
		}

		echo json_encode($response);
		die;
	}



	// Delete 
	if (isset($_POST['action'])) {
		$response = array();
		$page = $_POST['page'];
		$id = $_POST['catid'];
		switch ($page) {
			case "category":
				$querydelete = "Delete from categorias where id=$id";
				break;
			case "promotions":
				$querydelete = "Delete from promotions where id=$id";
				break;
			case "courses":
				$querydelete = "Delete from courses where id=$id";
				break;
			case "modal":
				$querydelete = "Delete from modalidad where id=$id";
				break;
			case "brands":
				$querydelete = "Delete from brands where id=$id";
				break;
			case "product":
				$querydelete = "Delete from products where id=$id";
				break;
			case "restaurant_dishes":
				$querydelete = "Delete from platos where id=$id";
				break;
			case "property_modal":
				$querydelete = "Delete from dish_properties_admin where id=$id";
				break;
			case "transactions":
				$querydelete = "Delete from orders where id = $id;";
				$res =  mysqli_query($con, $querydelete);
				$querydelete = "Delete from order_details WHERE order_id = $id;";
				$res =  mysqli_query($con, $querydelete);
				$querydelete = "Delete from transection_history where id=$id;";
				break;
		}
		$res =  mysqli_query($con, $querydelete);
		if ($res) {
			$response['error'] = false;
			$response['message'] = "Successfully!";
		} else {
			$response['error'] = true;
			$response['message'] = "Something went wrong!";
		}
		echo json_encode($response);
		die();
	}

	// get edit data 
	if (isset($_POST['action_edit'])) {
		$response = array();
		$page = $_POST['page'];
		$id =   $_POST['catid'];
		switch ($page) {
			case "category":
				$queryedit = "Select * from categorias where id=$id";
				break;
			case "modal":
				$queryedit = "Select * from modalidad where id=$id";
				break;
			case "promotions":
				$queryedit = "Select * from promotions where id=$id";
				break;
			case "courses":
				$queryedit = "Select * from courses where id=$id";
				break;
			case "brands":
				$queryedit = "Select * from brands where id=$id";
				break;
			case "ingredients":
				$queryedit = "Select * from ingredients where id=$id";
				break;
			case "product":
				$queryedit = "Select * from products where id=$id";
				break;
			case "transactions":
				$queryedit = "Select b.id,b.name_std,b.last_name_std,b.name_fth,b.id_card,b.email,b.contact_number, a.date_time, a.payment_status from transection_history a inner join orders b on (a.order_id = b.id) where b.id=$id";
				break;
			case "property_modal":
				$queryedit = "Select * from dish_properties_admin where id=$id";
				break;
		}
		$res =  mysqli_query($con, $queryedit);
		$res_data = mysqli_fetch_assoc($res);
		if ($page == 'ingredients') {
			$resid = $_POST['resid'];
			$catdata  =  mysqli_query($con, "Select cat_id , cat_name from restaurantes_categorias  where restaurant_id = $resid");
			//$cats = array();
			while ($catd = mysqli_fetch_assoc($catdata)) {
				$cats[] = array(
					"cat_id" => $catd['cat_id'],
					"cat_name" => $catd['cat_name']
				);
			}
			$response['cats']  = $cats;
		}
		if ($res) {
			$response['error'] = false;
			$response['data'] = $res_data;
		} else {
			$response['error'] = true;
			$response['message'] = "Something went wrong!";
		}
		echo json_encode($response);
	}
	// update editing data 
	if (isset($_POST['action_edit_update'])) {
		$response = array();
		$page = $_POST['page'];
		$id =   $_POST['catid'];
		switch ($page) {
			case "category":
				$cat_name = htmlspecialchars($_POST['cat_name'], ENT_QUOTES);
				$cat_desc = $_POST['cat_description'];
				$img_name = $_FILES['cat_icon']['name'];
				if ($img_name == "") {
					$queryupdate = "Update categorias Set cat_name ='$cat_name',cate_description='$cat_desc'  where id=$id";
				} else {
					$location = "uploads/" . $img_name;
					if (move_uploaded_file($_FILES['cat_icon']['tmp_name'], $location)) {
						$queryupdate = "Update categorias Set cat_name ='$cat_name',cate_description='$cat_desc',image='$img_name'  where id=$id";
					}
				}
				break;
			case "promotions":
				$brand_name = $_POST['promotion_name'];
				$brand_desc = $_POST['pro_description'];
				$pro_img = $_FILES['promotion_image']['name'];
				$pro_img_tmp = $_FILES['promotion_image']['tmp_name'];

				if ($pro_img == "") {
					$queryupdate = "Update promotions Set promotion_name ='$brand_name',description='$brand_desc' where id=$id";
				} else {
					$folder = "uploads/promotions/" . $pro_img;
					if (move_uploaded_file($pro_img_tmp, $folder)) {
						$queryupdate = "Update promotions Set promotion_name ='$brand_name',promtion_img='$pro_img',description='$brand_desc' where id=$id";
					}
				}
				break;
			case "courses":
				$course_name = htmlspecialchars($_POST['course_name'], ENT_QUOTES);
				$course_description = $_POST['description'];
				$etpa = $_POST['etpa'];
				$modal = $_POST['modal'];
				$queryupdate = "Update courses Set course_name ='$course_name',description='$course_description',etpa='$etpa',modalidad='$modal'  where id=$id";
				break;
			case "modal":
				$modalidad = htmlspecialchars($_POST['modalidad'], ENT_QUOTES);
				$tipo = $_POST['tipo'];
				$queryupdate = "Update modalidad Set modalidad ='$modalidad', tipo='$tipo' where id=$id";
				break;
			case "transactions":
				$fecha =  $_POST['date_time'];
				$std_name = $_POST['std_name'];
				$std_last_name = $_POST['std_last_name'];
				$parent = $_POST['parent'];
				$dni = $_POST['dni'];
				$order_email = $_POST['order_email'];
				$order_telephone = $_POST['order_telephone'];
				$order_amount = $_POST['payment_status'];
				$queryupdate = "Update transection_history Set date_time ='$fecha',payment_status='$order_amount'  where order_id=$id";
				$res =  mysqli_query($con, $queryupdate);
				$queryupdate = "Update orders Set name_std='$std_name',last_name_std='$std_last_name',name_fth='$parent',id_card='$dni',email='$order_email',contact_number='$order_telephone',payment_status='$order_amount' where id=$id";
				break;
			case "brands":
				$brand_name = $_POST['brand_name'];
				$brand_desc = $_POST['brand_desc'];
				$queryupdate = "Update brands Set brand_name ='$brand_name',brand_desc='$brand_desc' where id=$id";
				break;
			case "extras":
				$ingredient_name = $_POST['extra_name'];
				$ingredient_price = $_POST['extra_price'];
				$description = $_POST['description'];
				$queryupdate = "Update extras Set extra_name ='$ingredient_name',price=$ingredient_price,description='$description'  where id=$id";
				break;
			case "restaurant_dishes":
				$dish_name_rest = $_POST['dish_name_rest'];
				$price_restaurant_update = $_POST['price_restaurant_update'];
				$added_description_dish = $_POST['added_description_dish'];
				$queryupdate = "Update platos Set dish_name ='$dish_name_rest',dish_price=$price_restaurant_update,dish_description='$added_description_dish'  where id=$id";
				break;
			case "product":
				$bookname = htmlspecialchars($_POST['bookname'], ENT_QUOTES);
				$course_id = $_POST['course_id'];
				$isbn = $_POST['isbn'];
				$description = $_POST['description'];
				$editorial = $_POST['editorial'];
				$pre_final = $_POST['pre_final'];
				$modality = json_encode($_POST["modalidad"]);
				$obligatori =  $_POST['obligatori'];
				$orden =  $_POST['orden'];
				$iva =  $_POST['iva'];

				$pro_img = $_FILES['bookimage']['name'];
				$pro_img_tmp = $_FILES['bookimage']['tmp_name'];
				$folder = "uploads/" . $pro_img;
				if ($pro_img != "") {
					if (move_uploaded_file($pro_img_tmp, $folder)) {
						$queryupdate = "Update `products` Set `modality` = '$modality', `book_name` = '$bookname', `course_id` = $course_id, `obligatori`='$obligatori', `iva` = '$iva', `preu_final` = '$pre_final', `isbn` = '$isbn', `editorial` = '$editorial', `image_name` = '$pro_img',`orden`='$orden', `description`='$description' where id=$id";
					}
				} else {
					$queryupdate = "Update `products` Set `modality` = '$modality', `book_name` = '$bookname', `course_id` = $course_id, `obligatori`='$obligatori', `iva` = '$iva', `preu_final` = '$pre_final', `isbn` = '$isbn', `editorial` = '$editorial',`orden`='$orden',`description`='$description' where id=$id";
				}
				break;
			case "restaurant":
				$rest_name = $_POST['restaurant_name'];
				$manager_name = $_POST['manager_name_rest'];
				$email = $_POST['email_rest'];
				$phone = $_POST['phone_res'];
				$city = $_POST['city'];
				$kind_of_food = $_POST['kind_of_food_rest'];
				$no_of_table = $_POST['no_of_table_rest'];
				$status = $_POST['status_r'];
				$zipcode = $_POST['zipcode'];
				$address = $_POST['address'];
				$img_name = $_FILES['file']['name'];
				if ($img_name == "") {
					$queryupdate = "Update `restaurantes`  set `res_name`='$rest_name',`address`='$address',`city`='$city',`zipcode`='$zipcode',`email`='$email',`phone`='$phone',`status`='$status',`kind_of_food`='$kind_of_food',`manager_name`='$manager_name',`no_of_tables`='$no_of_table'  where res_id=$id";
				} else {
					$location = "uploads/" . $img_name;
					if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
						$queryupdate = "Update `restaurantes`  set `res_name`='$rest_name',`address`='$address',`city`='$city',`zipcode`='$zipcode',`email`='$email',`phone`='$phone',`picture`='$img_name',`status`='$status',`kind_of_food`='$kind_of_food',`manager_name`='$manager_name',`no_of_tables`='$no_of_table'  where res_id=$id";
					}
				}
				break;
			case "changePass":
				$newpass = $_POST['new_pass'];
				$pass = $_POST['pass'];
				$queryedit = "select * from super_admin where id =" . $_SESSION['userid'];
				$res =  mysqli_query($con, $queryedit);
				$res_data = mysqli_fetch_assoc($res);
				if ($pass != $res_data['password']) {
					$response['error'] = true;
					$response['message'] = "contrasenya incorrecta!";
					echo json_encode($response);
					die();
				} else {
					$queryupdate = "update super_admin set password='$newpass' where id=" . $_SESSION['userid'];
				}
				break;
			case "resetBd":
				$pass = $_POST['pass'];
				$queryedit = "select * from super_admin where id =" . $_SESSION['userid'];
				$res =  mysqli_query($con, $queryedit);
				$res_data = mysqli_fetch_assoc($res);
				if ($pass != $res_data['password']) {
					$response['error'] = true;
					$response['message'] = "contrasenya incorrecta!";
					echo json_encode($response);
					die();
				} else {
					$queryupdate = "truncate table orders";
					$res =  mysqli_query($con, $queryupdate);
					$queryupdate = "truncate table orders";
					$res =  mysqli_query($con, $queryupdate);
					$queryupdate = "truncate table order_details";
					$res =  mysqli_query($con, $queryupdate);
					$queryupdate = "truncate table transection_history";

				}
				break;
			case "mailMsg":
				$msj = $_POST['message'];
				$id = $_POST['id'];
				$tipo = $_POST["tipo"];
				$status = $_POST["estatus"];
				if ($id != 0) {
					$query = "update config_messages set message='$msj', estatus='$status' where id =" . $id;
				} else {
					$query = "insert into config_messages values(null,'$msj','$tipo',0)";
				}
				$res = mysqli_query($con, $query);
				if ($res) {
					$response['error'] = false;
					$response['success_msg'] = "Registrado con éxito!";
				} else {
					$response['error'] = true;
					$response['error_msg'] = "Something went wrong!" . mysqli_error($con);
				}
				echo json_encode($response);
				die();
				break;
		}
		$res =  mysqli_query($con, $queryupdate);
		if ($res) {
			$response['error'] = false;
			$response['message'] = 'Actualizado con éxito';
		} else {
			$response['error'] = true;
			$response['message'] = "Something went wrong!";
		}
		echo json_encode($response);
	}



	if (isset($_POST['action_profile_update'])) {
		$adminid = $_POST['adminid'];
		$email = $_POST['email'];
		$pass =  $_POST['pass'];
		$queryupdate = "Update superadmin Set email ='$email',password='$pass' where id=$adminid";
		$res =  mysqli_query($con, $queryupdate);
		if ($res) {
			$response['error'] = false;
			$response['message'] = 'Actualizado con éxito';
		} else {
			$response['error'] = true;
			$response['message'] = "Something went wrong!";
		}
		echo json_encode($response);
	}


	if (isset($_POST['status'])) {
		$rest_id = $_POST['rest_id'];
		$query = "Select res_id,status from restaurantes where res_id = $rest_id";
		$res = mysqli_query($con, $query);
		$res_data = mysqli_fetch_assoc($res);
		if ($res) {
			$response['error'] = false;
			$response['data'] = $res_data;
		} else {
			$response['error'] = true;
			$response['message'] = "Something went wrong!";
		}
		echo json_encode($response);
		die;
	}

	if (isset($_POST['update_order_status'])) {
		$orderid = $_POST['order_id'];
		$query = "Update tbl_order set order_status ='completed' where id = $orderid";
		$res = mysqli_query($con, $query);
		if ($res) {
			$response['error'] = false;
			$response['message'] = "Status Updated";
		} else {
			$response['error'] = true;
			$response['message'] = "Something went wrong!";
		}
		echo json_encode($response);
		die;
	}


	if (isset($_POST['action_get_restaurants'])) {
		$restid = $_POST['rest_id'];
		$query  = "select * from restaurantes_branches where main_restaurant_id=$restid";
		$res =  mysqli_query($con, $query);
		if (mysqli_num_rows($res)) {
			while ($row = mysqli_fetch_assoc($res)) {

				$restaurant_name = $row['restaurant_name'];
				$email = $row['email'];
				$phone = $row['phone'];
				$address = $row['address'];
				$city = $row['city'];
				$zipcode = $row['zipcode'];
				$return_arr[] = array(
					"restaurant_name" => $restaurant_name,
					"email" => $email,
					"phone" => $phone,
					"address" => $address,
					"city" => $city,
					"zipcode" => $zipcode,

				);
			}
		} else {
			$return_arr = array();
		}
		echo json_encode($return_arr);
	}

	if (isset($_POST['action_get_prop_dishes'])) {
		$dish_id = $_POST['dish_id'];
		$query  = "select * from dish_properties_admin where dish_id=$dish_id";
		$res =  mysqli_query($con, $query);
		if (mysqli_num_rows($res)) {
			while ($row = mysqli_fetch_assoc($res)) {

				$restaurant_name = $row['size'];
				$email = $row['price'];
				$phone = $row['ingredients'];
				$action = "<div class='actionclass' data-cat_id='" . $row['id'] . "'><button type='button' class='btn btn-primary btn-edit-property-modal' data-id='" . $row['id'] . "'><i class='fa fa-edit'></i></button>
				<button class='btn btn-danger btn-delete_prop_dish' data-id='" . $row['id'] . "' type='button'><i class='fa fa-trash'></i></button> 
				<input type='hidden' class='property_modal' value='property_modal'>
				</div>";
				$return_arr[] = array(
					"size" => $restaurant_name,
					"price" => $email,
					"ingredients" => $phone,
					"action_edit_del" => $action
				);
			}
		} else {
			$return_arr = array();
		}
		echo json_encode($return_arr);
	}

	if (isset($_GET['dishes_for_restaurant'])) {
		$response = array();
		if (isset($_GET['q'])) {
			$q = $_GET['q'];
			$results = "SELECT * FROM `categorias` Where cate_name LIKE '%$q%'";
		} else {
			$results = "SELECT * FROM `categorias`";
		}

		$data = mysqli_query($con, $results);
		if (mysqli_num_rows($data) > 0) {
			$arrayCat = array();
			while ($row = mysqli_fetch_assoc($data)) {
				$arrayCat[] = array(
					"id" => $row['id'],
					"text" => $row['cate_name']
				);
			}
			//$response['error'] = false;
			$response['results'] = $arrayCat;
		} else {
			$response['error'] = true;
			$response['error_msg'] = "something went wrong!";
		}
		echo json_encode($response);

		die;
	}


	if (isset($_POST['categories_dishes'])) {

		$cateid = $_POST['cate_id'];
		$query  = "select * from dishes where dish_cat=$cateid";
		$res =  mysqli_query($con, $query);
		if (mysqli_num_rows($res)) {
			while ($row = mysqli_fetch_assoc($res)) {

				$dish_name = $row['dish_name'];
				$dish_price = $row['dish_price'];
				$desc = $row['dish_description'];
				$dish_image = $row['dish_image'];
				$id = $row['id'];
				$return_arr[] = array(
					"dish_name" => $dish_name,
					"dish_price" => $dish_price,
					"desc" => $desc,
					"dish_image" => $dish_image,
					"id" => $id
				);
			}
		} else {
			$return_arr = array();
		}
		echo json_encode($return_arr);
	}


	if (isset($_POST['action_add_to_restaurant_cat_dish'])) {
		$execute = false;
		$response = array();
		$category_name = $_POST['category_name'];
		$restaurant_id = $_POST['restaurante_id'];
		$query = "Select * from restaurantes_categorias where cat_name = '$category_name' AND restaurant_id=$restaurant_id";
		$category  =  mysqli_query($con, $query);
		if (mysqli_num_rows($category) > 0) {
			$catedata = mysqli_fetch_assoc($category);
			$dish_cat = $catedata['cat_id'];
		} else {
			$insertcat = "Insert into restaurantes_categorias(`cat_name`,`cate_description`,`restaurant_id`) values('$category_name','',$restaurant_id)";
			$inserted = mysqli_query($con, $insertcat);
			$dish_cat = mysqli_insert_id($con);
		}
		$dish_data = $_POST['data'];
		$query_dishes = "INSERT into platos(`dish_name`,`dish_price`,`dish_image`,`dish_description`,`cat_id`,`resturant_id`) values";
		foreach ($dish_data as $dish_single) {
			foreach ($dish_single as $key => $dish) {
				if ($key == "product_id") {
					$product_id = $dish;
				} else if ($key == "product_name") {
					$dish_name = $dish;
				} else if ($key == "price") {
					$dish_price  = $dish;
				} else if ($key == "desc") {
					$desc = $dish;
				} else if ($key == "image") {
					$dish_image = $dish;
					copy('uploads/' . $dish_image, $_SERVER['DOCUMENT_ROOT'] . '/chef-tables/radmin/uploads/' . $dish_image);
				}
			}
			$query_dishes .= "('$dish_name','$dish_price','$dish_image','$desc',$dish_cat,$restaurant_id)";
			if (mysqli_query($con, $query_dishes)) {
				$dish_last_inserted_id = mysqli_insert_id($con);
				$dish_properties = mysqli_query($con, "Select * from dish_properties_admin where dish_id = $product_id");
				if ((mysqli_num_rows($dish_properties)) > 0) {
					while ($r = mysqli_fetch_assoc($dish_properties)) {
						$size = $r['size'];
						$price = $r['price'];
						$ingredient = $r['ingredients'];
						$property = "Insert into dish_properties(`size`,`price`,`ingredients`,`dish_id`,`restaurant_id`) values('$size',$price,'$ingredient',$dish_last_inserted_id,$restaurant_id)";
						if (mysqli_query($con, $property)) {
							$execute =  true;
						}
					}
				} else {
					$execute = true;
				}
			}
		}
		// $query_dishes = trim($query_dishes,",");
		if ($execute) {
			$response['error'] = false;
			$response['message'] = "Products Added to Restaurant Successfully";
		} else {
			$response['error'] = true;
			$response['message'] = "Something went Wrong!";
		}
		echo json_encode($response);
		die;
	}

	if (isset($_POST['get_restaurant_cat_dish'])) {
		$response = array();
		$restaurant_id = $_POST['restaurante_id'];
		$query = "SELECT * FROM restaurantes_categorias where restaurant_id=$restaurant_id";
		$result_query = mysqli_query($con, $query);
		if (mysqli_num_rows($result_query) > 0) {
			$data = array();
			while ($row = mysqli_fetch_assoc($result_query)) {
				$cat_id  = $row['cat_id'];
				$query_dish = "Select * from platos where cat_id = $cat_id";
				$result_dish = mysqli_query($con, $query_dish);
				$category_name = $row['cat_name'];
				$cate_description = $row['cate_description'];
				if (mysqli_num_rows($result_dish) > 0) {
					while ($row  = mysqli_fetch_assoc($result_dish)) {

						$dish_name = $row['dish_name'];
						$dish_price = $row['dish_price'];
						$desc = $row['dish_description'];
						$dish_image = $row['dish_image'];
						$id = $row['id'];
						$return_arr[] = array(
							"dish_name" => $dish_name,
							"dish_price" => $dish_price,
							"desc" => $desc,
							"dish_image" => $dish_image,
							"id" => $id
						);
					}
				} else {
					$return_arr = array();
				}
				$return_data[] = array(
					"category_name" => $category_name,
					"category_desc" => $cate_description,
					"dish_data" => $return_arr
				);
				$return_arr = array();
			}
		} else {
			$return_data = array();
		}
		echo json_encode($return_data);

		die;
	}

	/* if(isset($_GET['dishes_for_restaurant'])){
		    $response = array();
			if(isset($_GET['q'])){
			$q = $_GET['q'];
			$results = "SELECT * FROM `categorias` Where dish_name LIKE '%$q%'";
			}else{
				$results = "SELECT * FROM `categorias`";
			}
		
		 $data = mysqli_query($con,$results);
		if(mysqli_num_rows($data)>0){
			$arrayCat = array();
			While($row = mysqli_fetch_assoc($data)){
				$arrayCat[] = array(
					"id"=>$row['id'],
					"text"=>$row['cate_name']
				);
			}
			//$response['error'] = false;
			$response['results'] = $arrayCat;
		}else{
			$response['error'] = true;
			$response['error_msg'] = "something went wrong!";
		}
		echo json_encode($response);
		
		die;

	 }*/
	/// ingredients for Restaurant
	if (isset($_GET['ingredient_for_restaurant'])) {
		$response = array();
		if (isset($_GET['q'])) {
			$q = $_GET['q'];
			$results = "SELECT * FROM `restaurantes` Where res_name LIKE '%$q%'";
		} else {
			$results = "SELECT * FROM `restaurantes`";
		}

		$data = mysqli_query($con, $results);
		if (mysqli_num_rows($data) > 0) {
			$arrayCat = array();
			while ($row = mysqli_fetch_assoc($data)) {
				$arrayCat[] = array(
					"id" => $row['res_id'],
					"text" => $row['res_name']
				);
			}
			//$response['error'] = false;
			$response['results'] = $arrayCat;
		} else {
			$response['error'] = true;
			$response['error_msg'] = "something went wrong!";
		}
		echo json_encode($response);

		die;
	}
	/// ingredients for Restaurant
	if (isset($_GET['getallsizes'])) {
		$response = array();
		if (isset($_GET['q'])) {
			$q = $_GET['q'];
			$results = "Select * from sizes Where type_name LIKE '%$q%'";
		} else {
			$results = "Select * from sizes";
		}

		$data = mysqli_query($con, $results);
		if (mysqli_num_rows($data) > 0) {
			$arrayCat = array();
			while ($row = mysqli_fetch_assoc($data)) {
				$arrayCat[] = array(
					"id" => $row['id'],
					"text" => $row['size_name']
				);
			}
			//$response['error'] = false;
			$response['results'] = $arrayCat;
		} else {
			$response['error'] = true;
			$response['error_msg'] = "something went wrong!";
		}
		echo json_encode($response);

		die;
	}
	/// ingredients for Restaurant
	if (isset($_GET['ingredient_for_category'])) {
		$response = array();
		$rest = $_GET['rest'];
		if (isset($_GET['q'])) {
			$q = $_GET['q'];
			$results = "SELECT * FROM `restaurantes_categorias` Where restaurant_id=$rest AND cat_name LIKE '%$q%'";
		} else {
			$results = "SELECT * FROM `restaurantes_categorias` Where restaurant_id=$rest";
		}

		$data = mysqli_query($con, $results);
		if (mysqli_num_rows($data) > 0) {
			$arrayCat = array();
			while ($row = mysqli_fetch_assoc($data)) {
				$arrayCat[] = array(
					"id" => $row['cat_id'],
					"text" => $row['cat_name']
				);
			}
			//$response['error'] = false;
			$response['results'] = $arrayCat;
		} else {
			$response['error'] = true;
			$response['error_msg'] = "something went wrong!";
		}
		echo json_encode($response);

		die;
	}
	if (isset($_POST['addingredient'])) {
		$ingredient_name = $_POST['ingredient_name'];
		$ingredient_price = $_POST['ingredient_price'];
		$dish_category = $_POST['dish_category'];
		$description = $_POST['description'];
		$restaurants = $_POST['ingredient_restaurants'];
		/*$query_dishes = "INSERT into ingredients(`ingredient_name`,`price`,`description`,type,restaurent_id) values";
					 foreach($restaurants as $rest){
						   $query_dishes .="('$ingredient_name',$ingredient_price,'$description','added_by_admin',$rest),";
					 }
					 $query_dishes = trim($query_dishes,",");*/
		$query_ingredients = "INSERT into ingredients(`ingredient_name`,`cat_id`,`price`,`description`,type,restaurent_id) values('$ingredient_name',$dish_category,$ingredient_price,'$description','added_by_admin',$restaurants)";
		if (mysqli_query($con, $query_ingredients)) {
			$response['error'] = false;
			$response['message'] = "Ingredientes agregados al restaurante con éxito";
		} else {
			$response['error'] = true;
			$response['message'] = "Algo salió mal";
		}
		echo json_encode($response);
	}

	if (isset($_POST['addExtras'])) {
		$extra_name = $_POST['extra_name'];
		$extra_price = $_POST['extra_price'];
		$description = $_POST['description'];
		$restaurants = $_POST['extra_restaurants'];
		$query_dishes = "INSERT into extras(`extra_name`,`price`,`description`,type,restaurent_id) values";
		foreach ($restaurants as $rest) {
			$query_dishes .= "('$extra_name',$extra_price,'$description','added_by_admin',$rest),";
		}
		$query_dishes = trim($query_dishes, ",");
		if (mysqli_query($con, $query_dishes)) {
			$response['error'] = false;
			$response['message'] = "Extras agregados al restaurante con éxito";
		} else {
			$response['error'] = true;
			$response['message'] = "Algo salió mal";
		}
		echo json_encode($response);
	}

	if (isset($_GET['action_get_restaurant'])) {
		$response = array();
		$dish_name = $_GET['dish_name'];
		if (isset($_GET['q'])) {
			$q = $_GET['q'];
			$results = "SELECT res_id,res_name FROM `restaurantes` Where (res_id,'$dish_name') Not IN(select resturant_id , dish_name from platos) AND res_name LIKE '%$q%'";
		} else {
			$results = "SELECT res_id,res_name FROM `restaurantes` where  (res_id,'$dish_name') Not IN(select resturant_id , dish_name from platos)";
		}

		$data = mysqli_query($con, $results);
		if (mysqli_num_rows($data) > 0) {
			$arrayCat = array();
			while ($row = mysqli_fetch_assoc($data)) {
				$arrayCat[] = array(
					"id" => $row['res_id'],
					"text" => $row['res_name']
				);
			}
			//$response['error'] = false;
			$response['results'] = $arrayCat;
		} else {
			$response['error'] = true;
			$response['error_msg'] = "something went wrong!";
		}
		echo json_encode($response);

		die;
	}

	if (isset($_GET['action_get_restaurant_for_ingredients'])) {
		$response = array();
		$cat_name = $_GET['cat_name'];
		$cid = $_GET['cid'];
		if (isset($_GET['q'])) {
			$q = $_GET['q'];
			$results = "SELECT res_id,res_name FROM `restaurantes` where  (res_id,'$cat_name') IN(select restaurant_id , cat_name from restaurantes_categorias) AND ($cid , res_id) NOT IN(Select cat_id,restaurent_id from ingredients ) AND res_name LIKE '%$q%'";
		} else {
			$results = "SELECT res_id,res_name FROM `restaurantes` where  (res_id,'$cat_name') IN(select restaurant_id , cat_name from restaurantes_categorias) AND ($cid , res_id) NOT IN(Select cat_id,restaurent_id from ingredients )";
		}

		$data = mysqli_query($con, $results);
		if (mysqli_num_rows($data) > 0) {
			$arrayCat = array();
			while ($row = mysqli_fetch_assoc($data)) {
				$arrayCat[] = array(
					"id" => $row['res_id'],
					"text" => $row['res_name']
				);
			}
			//$response['error'] = false;
			$response['results'] = $arrayCat;
		} else {
			$response['error'] = true;
			$response['error_msg'] = "something went wrong!";
		}
		echo json_encode($response);

		die;
	}

	if (isset($_POST['action_save_restaurant_dishes'])) {
		$excute = false;
		$restaurants = $_POST['restaurants'];
		$dish_id = $_POST['dish_id'];
		$dish_name = $_POST['dish_name'];
		$dish_price = $_POST['dish_price'];
		$dish_cat = $_POST['dish_cat'];
		$dish_desc = $_POST['dish_desc'];
		$dish_image = $_POST['dish_image'];
		$data_cat  =  mysqli_query($con, "Select * from categorias where id = $dish_cat ");
		$caterow = mysqli_fetch_assoc($data_cat);
		$cate_name = $caterow['cate_name'];

		if ($dish_name != "") {
			copy('uploads/' . $dish_image, $_SERVER['DOCUMENT_ROOT'] . '/chef-tables/radmin/uploads/' . $dish_image);
		}

		foreach ($restaurants as $rest) {
			$query = "Select * from restaurantes_categorias where cat_name = '$cate_name' AND restaurant_id=$rest";
			$category  =  mysqli_query($con, $query);
			if (mysqli_num_rows($category) > 0) {
				$catedata = mysqli_fetch_assoc($category);
				$dish_cat = $catedata['cat_id'];
			} else {
				$insertcat = "Insert into restaurantes_categorias(`cat_name`,`cate_description`,`restaurant_id`) values('$cate_name','',$rest)";
				$inserted = mysqli_query($con, $insertcat);
				$dish_cat = mysqli_insert_id($con);
			}

			$query_dishes = "INSERT into platos(`dish_name`,`dish_price`,`dish_image`,`cat_id`,`dish_description`,`resturant_id`) values('$dish_name',$dish_price,'$dish_image',$dish_cat,'$dish_desc',$rest)";
			if (mysqli_query($con, $query_dishes)) {
				$dish_last_inserted_id = mysqli_insert_id($con);
				$dish_properties = mysqli_query($con, "Select * from dish_properties_admin where dish_id = $dish_id");
				if ((mysqli_num_rows($dish_properties)) > 0) {
					while ($r = mysqli_fetch_assoc($dish_properties)) {
						$size = $r['size'];
						$price = $r['price'];
						$ingredient = $r['ingredients'];
						$property = "Insert into dish_properties(`size`,`price`,`ingredients`,`dish_id`,`restaurant_id`) values('$size',$price,'$ingredient',$dish_last_inserted_id,$rest)";
						if (mysqli_query($con, $property)) {
							$excute =  true;
						}
					}
				} else {
					$excute = true;
				}
			}
		}
		//$query_dishes = trim($query_dishes,",");
		//echo $query_dishes;die;
		if ($excute) {
			$response['error'] = false;
			$response['message'] = 'Added Successfully';
		} else {
			$response['error'] = true;
			$response['message'] = "Something went wrong!";
		}
		echo json_encode($response);
	}

	if (isset($_POST['action_update_dish_prop'])) {
		$size = $_POST['prop_name'];
		$price = $_POST['price'];
		$ingredients = $_POST['ingredients'];
		$id = $_POST['prop_id'];
		$queryupdate = "Update dish_properties_admin set size='$size', price=$price,ingredients='$ingredients' where id = $id";
		$res =  mysqli_query($con, $queryupdate);
		if ($res) {
			$response['error'] = false;
			$response['message'] = 'Actualizado con éxito';
		} else {
			$response['error'] = true;
			$response['message'] = "Something went wrong!";
		}
		echo json_encode($response);
	}

	if (isset($_POST['action_add_restaurant_ingredients'])) {
		$restaurants = $_POST['restaurants'];
		$ingredient_name_rest = $_POST['ingredient_name_rest'];
		$ingredient_price_rest = $_POST['ingredient_price_rest'];
		$description_rest = $_POST['description_rest'];
		$c_id = $_POST['c_id'];
		$query_restaurant = "INSERT into ingredients(`ingredient_name`,`cat_id`,`price`,`description`,type,restaurent_id) values";
		foreach ($restaurants as $rest) {
			$query_restaurant .= "('$ingredient_name_rest',$c_id,$ingredient_price_rest,'$description_rest','added_by_admin',$rest),";
		}
		$query_restaurant = trim($query_restaurant, ",");
		if (mysqli_query($con, $query_restaurant)) {
			$response['error'] = false;
			$response['message'] = 'Added Successfully';
		} else {
			$response['error'] = true;
			$response['message'] = "Something went wrong!";
		}
		echo json_encode($response);
	}
