<?php
require_once '../config/config.php';
$course_basis_id = getValue('course_basis_id','int','GET','');
$qrDel = new db_query("DELETE FROM course_basis WHERE course_basis_id = $course_basis_id");
echo json_encode("jkjk");
// $center_basis = 'center_basis_' . $course_basis_id;
?>