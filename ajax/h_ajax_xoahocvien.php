<?
include "../config/config.php";
$id = getValue("id", "int", "POST", '', '');
$delete = new db_query("DELETE FROM save_student WHERE save_id =" . $id);