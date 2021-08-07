<?php
session_start();
require_once '../config/config.php';
$course_id = getValue('course_id','int','GET','');
if(isset($_GET['course_id'])){   
	$cookie_id=$_COOKIE['user_id'];  
	if(empty($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
	array_push($_SESSION['cart'],$course_id);
	$_SESSION['course_id']=$course_id;

	$dbcart = new db_query("SELECT * FROM carts WHERE user_student_id = $cookie_id AND course_id = $course_id");
	if(mysql_num_rows($dbcart->result)>0){
		echo false;
	}else{
        $today = strtotime(date("d-m-Y"));
        $data = [
			'user_student_id'=>$cookie_id,
			'day_buy'=>$today,
			'course_id'=>$course_id
		];
        add('carts', $data);
    }
	header("location:/gio-hang/id$cookie_id.html"); 
}

?>