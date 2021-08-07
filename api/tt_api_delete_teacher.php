<?
include "../config/config.php";
include_once 'functions.php';
$id = getValue("id", "int", "GET", '', '');
$upload_location = "../img/avatar/";
if ($id != '') {
    $db_select = new db_query("SELECT teacher_avatar FROM user_center_teacher WHERE center_teacher_id =" . $id);
    $row = mysql_fetch_assoc($db_select->result);
    $img = $upload_location . $row['teacher_avatar'];
    if (is_writable($img)) {
        unlink($img);
    }
    $db_del = new db_query("DELETE FROM user_center_teacher WHERE center_teacher_id =" . $id);
    $data = [
        "result" => true
    ];
    success('Xóa giảng viên thành công', $data);
} else {
    set_error('404', 'Xóa giảng viên thất bại');
}
