<?php
session_start();
require_once '../config/config.php';
$cookie_id = $_COOKIE['user_id'];
$course_id=$_GET['course_id'];
if (!empty($_SESSION["cart"])) {
    foreach ($_SESSION["cart"] as $key => $val) {
        if($val== $course_id)
        {
            unset($_SESSION["cart"][$key]);
        }
    }
}
$dbcart = new db_query("DELETE FROM carts WHERE user_student_id = $cookie_id AND course_id = $course_id");
header("location:/gio-hang/id$cookie_id.html"); 
?>