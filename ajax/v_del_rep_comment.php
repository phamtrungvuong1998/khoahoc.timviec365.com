<?php
require_once '../config/config.php';

$rep_id = getValue('rep_id','int','POST','');

$qrDelRep = new db_query("DELETE FROM rep_rate_course WHERE rep_id = $rep_id");

$data = [
	'type'=>1
];

echo json_encode($data);

?>