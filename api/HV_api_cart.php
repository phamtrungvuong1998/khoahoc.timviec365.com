<?php
//Giỏ hàng
$qrCart = new db_query("SELECT *,courses.course_id FROM courses INNER JOIN carts ON courses.course_id = carts.course_id INNER JOIN users ON users.user_id = courses.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE carts.user_student_id = $user_id ORDER BY courses.course_id DESC");

$dataCart = [];
while ($row = mysql_fetch_array($qrCart->result)) {
     $dataCart[$row['cate_name']][$row['course_id']]['course_name'] = $row['course_name'];
     $dataCart[$row['cate_name']][$row['course_id']]['user_name'] = $row['user_name'];
     $dataCart[$row['cate_name']][$row['course_id']]['price_promotional'] = $row['price_promotional'];
     $dataCart[$row['cate_name']][$row['course_id']]['course_avatar'] = $row['course_avatar'];
}

$data['cart'] = $dataCart;


?>