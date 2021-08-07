<?php
require_once '../config/config.php';
$cate_id = getValue('cate_id','int','GET','');
$qr = new db_query("SELECT tag_id,tag_name FROM tags WHERE cate_id = '$cate_id'");
$html = '<option value="0">Chọn môn học chi tiết</option>';
while ($row = mysql_fetch_array($qr->result)) {
	$html = $html . '<option value="'. $row['tag_id']. '">'. $row['tag_name']. '</option>';
}

$qrTeach = new db_query("SELECT center_teacher_id,cate_id,teacher_name FROM user_center_teacher WHERE user_id = " . $_COOKIE['user_id']);
$teacher = '<option value="0">Lựa chọn giảng viên dạy</option>';
while($rowT = mysql_fetch_array($qrTeach->result)){
	$cate_teacher = explode(",", $rowT['cate_id']);
	if (array_search($cate_id, $cate_teacher) !== false) {
		$teacher = $teacher . '<option value="'. $rowT['center_teacher_id']. '">'. $rowT['teacher_name']. '</option>';
	}
}
$data = [
	'html'=>$html,
	'teacher'=>$teacher
];

echo json_encode($data);

?>