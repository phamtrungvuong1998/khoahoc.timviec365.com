<?
include_once '../config/config.php';
include_once 'functions.php';
$cate_id = getValue('cate_id', 'int', 'GET', '');
echo $cate_id;
if ($cate_id != 0) {
    $db_cat = new db_query('SELECT * FROM tags WHERE cate_id ='.$cate_id);
    $arr = [];
    while ($row = mysql_fetch_assoc($db_cat->result)) {
        $arr [] = $row;
    }
    success('',$arr);
}else{
   set_error('404',' Không có mục tương ứng ');
}

?>