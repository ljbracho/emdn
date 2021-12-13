<?php
include('admin/connection.php');
session_start();
/// Action For Get Curses

if(isset($_POST['action']) && $_POST['action'] == 'get_curs' ){
    
    $query = "select * from courses where etpa = ".$_POST['etapa'];
    $results = mysqli_query($con,$query);
    if(mysqli_num_rows($results) > 0){
        while($row =  mysqli_fetch_assoc($results)){
            $courses[] = $row;
        }
        $response['error'] =  false;
        $response['msg'] = 'course available';
        $response['courses'] = $courses;
    }else{
        $response['error'] =  true;
        $response['msg'] = 'No Course Exists';
        
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

if(isset($_POST['action']) && $_POST['action'] == 'get_books' ){
    
    $query = "select products.*,courses.course_name from products join courses on courses.id = products.course_id  where course_id = ".$_POST['course'];
    $results = mysqli_query($con,$query);
    if(mysqli_num_rows($results) > 0){
        while($row =  mysqli_fetch_assoc($results)){
            $courses[] = $row;
        }
        $response['error'] =  false;
        $response['msg'] = 'Books available';
        $response['books'] = $courses;
    }else{
        $response['error'] =  true;
        $response['msg'] = 'No Books Exists';
        $response['books'] = array();
    }
    
    echo json_encode($response);
    die;

}


if(isset($_POST['action']) && $_POST['action'] == 'add_to_cart' ){
   //unset($_SESSION['cart']);
   
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
     $book_id = $_POST['bookid'];
     $course_id = $_POST['courseid'];
     $qty = $_POST['qty'];
    // add new item on array
    $cart_item=array(
        'book_id'=>$book_id,
        'quantity'=>$qty
    );
    
    if(array_key_exists($course_id, $_SESSION['cart'])){
        if($qty > 0){
            
            $_SESSION['cart'][$course_id][]=$cart_item;
           
        }else{
            //unset($_SESSION['cart'][$course_id][$book_id]);
            foreach($_SESSION['cart'][$course_id] as $key=>$arr){
                if($arr['book_id'] == $book_id){
                    //echo "yes";
                    // print_r($arr);
                    unset($_SESSION['cart'][$course_id][$key]);
                    break;
                }    
            }
            if(count($_SESSION['cart'][$course_id]) == 0){
                unset($_SESSION['cart'][$course_id]);
            }
        }
    }else{
        $_SESSION['cart'][$course_id][]=$cart_item;
    }
     $books_cart_count = 0;
     foreach($_SESSION['cart'] as $key=>$arr){
         $books_cart_count+=count($arr);
     }
   $response['error'] =  false;
   if($qty == 1){
    $response['msg'] = "Added successfully";
   }else{
       $response['msg'] = "Removed successfully";
   }
   $response['total_items']   = $books_cart_count;
    
    echo json_encode($response);
    die;

}


if(isset($_POST['action']) && $_POST['action'] == 'remove_course' ){

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    $course = $_POST['course'];
    
    if(array_key_exists($course, $_SESSION['cart'])){
            unset($_SESSION['cart'][$course]);
    }
    
   $response['error'] =  false;
   $response['msg'] = "Removed successfully";
   $response['total_items']   = count($_SESSION['cart']);
    
    echo json_encode($response);
    die;

}








?>