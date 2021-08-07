<?
include "../config/config.php";
$id = getValue("id", "int", "POST", '', '');
$nums = getValue("nums", "int", "POST", '', '');
$limit = getValue("limit", "int", "POST", '', '');
$page = getValue("page", "int", "POST", '', '');
// echo $id;
// var_dump($_POST);
if ($id != 0) {
    //echo $page;
    $a = $nums - 1;
    $new = 0;
    $delete = new db_query("DELETE FROM save_student WHERE save_id =" . $id);
    if ($a % $limit == 0) {
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
