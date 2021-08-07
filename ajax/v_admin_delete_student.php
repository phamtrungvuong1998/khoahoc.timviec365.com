<?php
require_once '../config/config.php';

$user_id = getValue('user_id','int','GET','');

$qr = new db_query("DELETE FROM users WHERE user_id = '$user_id'");
?>