<?
include "../config/config.php";
$id = getValue("id", "int", "POST", '', '');
$nums = getValue("nums", "int", "POST", '', '');
$limit = getValue("limit", "int", "POST", '', '');
$page = getValue("page", "int", "POST", '', '');
$upload_location = "../img/avatar/";
if ($id != '') {
    $a = $nums - 1;
    $new = 0;
    // echo $page;
    $db_select = new db_query("SELECT teacher_avatar FROM user_center_teacher WHERE center_teacher_id =" . $id);
    $row = mysql_fetch_assoc($db_select->result);
    $img = $upload_location . $row['teacher_avatar'];
    if (is_writable($img)) {
        unlink($img);
    }
    $db_del = new db_query("DELETE FROM user_center_teacher WHERE center_teacher_id =" . $id);
    // echo $page;
    if ($page == 1) {
        $new = 1;
        $data = [
            "message" => "Xóa thành công",
            "pagenew" => $new,
            "result" => true
        ];
    } else if ($a % $limit == 0) {
        $new = $page - 1;
        $data = [
            "message" => "Xóa thành công",
            "pagenew" => $new,
            "result" => true
        ];
    } else
        $data = [
            "message" => "Xóa thành công",
            "pagenew" => $page,
            "result" => true
        ];
} else {
    $data = [
        "message" => "Không nhận được giá trị",
        "result" => false
    ];
}
echo json_encode($data);
