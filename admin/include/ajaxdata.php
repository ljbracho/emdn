 <?php
       if(isset($_GET['action'])){
       $con = mysqli_connect("localhost","root","","chef-tables");
		$response = array();		
		if(isset($_GET['q'])){
			$q = $_GET['q'];
			$results = "SELECT * FROM restaurantes_categorias where cat_name LIKE '%$q%'";
		}else{
			$results = "SELECT * FROM restaurantes_categorias";
		}
		
		$data = mysqli_query($con,$results);
		if(mysqli_num_rows($data)>0){
			$arrayCat = array();
			While($row = mysqli_fetch_assoc($data)){
				$arrayCat[] = array(
					"id"=>$row['cat_id'],
					"text"=>$row['cat_name']
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
	}
	
	 if(isset($_GET['getdish'])){
       $con = mysqli_connect("localhost","root","","chef-tables");
		$response = array();		
		$ids = $_GET['ids'];
		$ides  = "(";
		foreach($ids as $id){
			$ides .= "$id,";
		}
		$ides = trim($ides,",");
		$ides .=")";
		if(isset($_GET['q'])){
			$q = $_GET['q'];
			$results = "SELECT * FROM platos where cat_id in $ides AND dish_name LIKE '%$q%'";
		}else{
			$results = "SELECT * FROM platos where cat_id in $ides";
		}
		
		$data = mysqli_query($con,$results);
		if(mysqli_num_rows($data)>0){
			$arrayCat = array();
			While($row = mysqli_fetch_assoc($data)){
				$arrayCat[] = array(
					"id"=>$row['id'],
					"text"=>$row['dish_name']
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
	}
 
 