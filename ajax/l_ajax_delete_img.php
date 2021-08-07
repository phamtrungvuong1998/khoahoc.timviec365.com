<?

include '../config/config.php';
$upload_location = "../img/uploads/";
$id = getValue('id', 'int', 'POST', '', '');
if ($id != 0) {
    $del_img = new db_query("SELECT * FROM user_center_img WHERE center_img_id = '$id'");
    $row_img = mysql_fetch_assoc($del_img->result);
    $img = $upload_location . $row_img['center_img'];
    if (is_writable($img)) {
        unlink($img);
    }
    $dele = new db_query("DELETE FROM user_center_img WHERE center_img_id = '$id'");
    $data = [
        'result' => true,
    ];
} else {
    $data = [
        'result' => false,
        'message' => 'Rỗng',
    ];
}
echo json_encode($data);
