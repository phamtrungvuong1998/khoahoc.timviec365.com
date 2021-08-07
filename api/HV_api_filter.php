<?php
require_once 'api_info.php';
require_once 'HV_api_cart.php';

$course_type = getValue('course_type','int','POST','');
if ($course_type != 1) {
    $qr_type = " AND courses.course_type = 1";
}else if ($course_type == 2) {
    $qr_type = " AND courses.course_type = 2"; 
}else{
    $qr_type = "";
}
$cate_id = getValue('cate_id','int','POST','');
if ($cate_id != 0) {
    $qr_cate = " AND courses.cate_id = " . $cate_id;
}else {
    $qr_cate = ""; 
}
$teacher_center_id = getValue('teacher_center_id','int','POST','');
if ($teacher_center_id != 0) {
    $qr_teacher_center = " AND courses.user_id = " . $teacher_center_id;
}else {
    $qr_teacher_center = ""; 
}
$prices = getValue('prices','int','POST','');
if ($prices == 0) {
    $qr_prices = " ORDER BY courses.course_id DESC";
}else if ($prices == 1) {
    $qr_prices = " ORDER BY courses.price_listed ASC";
}else if ($prices == 2) {
    $qr_prices = " ORDER BY courses.price_listed DESC";
}

$cit_id = getValue('cit_id','int','POST','');
$arr_qr_cit =[];
if ($cit_id != 0) {
    $qr_cit = " AND courses.user_id = " . $teacher_center_id;
    $arr_qr_cit['course_basis'] = " INNER JOIN course_basis ON courses.course_id = course_basis.course_id";
    $arr_qr_cit['cit'] = " AND course_basis.cit_id = " . $cit_id;
}else {
    $arr_qr_cit['course_basis'] = ""; 
    $arr_qr_cit['cit'] = "";
}
$district_id = getValue('district','int','POST','');
if ($district_id != 0) {
    $arr_qr_district['district'] = " AND course_basis.district_id = " . $district_id;
}else {
    $arr_qr_district['district'] = ""; 
}


$qr = new db_query("SELECT * FROM courses INNER JOIN users ON courses.user_id = users.user_id" . $arr_qr_cit['course_basis'] . " WHERE 1 = 1" . $qr_type . $qr_cate . $qr_teacher_center . $arr_qr_cit['cit'] . $arr_qr_cit['district'] . $qr_prices);

$data['filter'] = [];
while ($row = mysql_fetch_array($qr->result)) {
    $data['filter'][$row['course_id']]['course_name'] = $row['course_name'];
    $data['filter'][$row['course_id']]['user_name'] = $row['user_name'];
    $data['filter'][$row['course_id']]['price_promotional'] = $row['price_promotional'];
}

success('',$data);
?>