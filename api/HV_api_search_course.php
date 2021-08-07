<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';


$search = getValue('search','str','POST','');
$qr = new db_query("SELECT course_id,course_name, user_name,price_promotional FROM courses INNER JOIN users ON courses.user_id = users.user_id WHERE courses.course_name LIKE '%$search%' ORDER BY courses.course_id DESC");

$dataSearch = [];
while ($row = mysql_fetch_array($qr->result)) {
    $dataSearch[$row['course_id']]['course_name'] = $row['course_name'];
    $dataSearch[$row['course_id']]['user_name'] = $row['user_name'];
    $dataSearch[$row['course_id']]['price_promotional'] = $row['price_promotional'];
}

$data['search'] = $dataSearch;
success('',$data);
?>
