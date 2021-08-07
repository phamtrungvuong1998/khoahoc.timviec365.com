<?php
require_once '../config/config.php';
    if (!isset($_COOKIE['user_id']) || $_COOKIE['user_type'] != 1) {
        header("Location: /");
    }else{
        $user_id = $_COOKIE['user_id'];

        $qrHV = new db_query("SELECT * FROM `users` WHERE `user_id` = '$user_id'");

        $rowHV = mysql_fetch_array($qrHV->result);
        $v_link_avatar = "../img/avatar/" . $rowHV['user_avatar'];
    }
?>