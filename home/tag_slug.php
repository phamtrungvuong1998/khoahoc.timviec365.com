<?php
require_once '../config/config.php';

$qr = new db_query("SELECT * FROM tags");
while ($row = mysql_fetch_array($qr->result)) {
    $dataId = [
    	'tag_id' => $row['tag_id']
    ];

    $data = [
    	'tag_slug' => ChangeToSlug($row['tag_name'])
    ];

    update('tags',$data,$dataId);
}
?>