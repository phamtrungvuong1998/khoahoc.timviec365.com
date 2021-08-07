<?
require_once '../config/config.php';
if(isset($_POST['tinh'])){
    $tinh = getValue('tinh','int','POST','');
?>
<option value="0">Chọn quận huyện</option>
<?php
	if ($tinh != 0) {
    $db_cit = new db_query("SELECT `cit_id`,`cit_name` FROM `city` WHERE `cit_parent` = $tinh");
    while ($row = mysql_fetch_array($db_cit->result)) {
?>
<option class="chonquanhuyen" value="<?=$row['cit_id']?>"><?=$row['cit_name']?>
</option>
<?php
        }
    }
}
?>