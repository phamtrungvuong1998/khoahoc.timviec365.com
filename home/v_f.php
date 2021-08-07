<?php
require_once '../config/config.php';

$qr = new db_query("SELECT * FROM tags");

$i = 0;
while ($row = mysql_fetch_array($qr->result)) {
	$key = ChangeToSlug($row['tag_name']);
    if (strpos($key, "khoa-hoc-") !== false) {
    	$key_slug = substr($key,9);
    	$data = [
    		'tag_slug'=>$key_slug,
    	];

    	$dataId = [
    		'tag_id'=>$row['tag_id']
    	];

    	update('tags',$data,$dataId);
    }
}

?>