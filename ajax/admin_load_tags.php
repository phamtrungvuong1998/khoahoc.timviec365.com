<? 

include "../config/config.php";
$cate_id = getValue('cate_id','int','GET','','');
if ($cate_id != 0) {
    $db_tag = new db_query('SELECT * FROM tags WHERE cate_id ='.$cate_id);
    while ($row = mysql_fetch_assoc($db_tag->result)) {
        echo "<option value=" . $row['tag_id'] . ">". $row['tag_name'] . "</option>";
    }
}else{
    echo "<option value=''>Chọn tỉnh thành trước</option>";
}
?>