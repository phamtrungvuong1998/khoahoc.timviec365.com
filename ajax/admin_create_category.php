<?
include_once '../config/config.php';
$name = getValue('cate_name', 'str', 'POST', '', '');
$upload_avatar = '../img/categories/';
if ($name != "") {
    $alug = ChangeToSlug($name);
    $db_cate = new db_query("SELECT * FROM categories WHERE cate_slug = '$alug'");
    if (mysql_num_rows($db_cate->result) > 0) {
        $data = [
            'result' => 1,
            'message' => 'Tên lĩnh vực đã tồn tại',
        ];
    } else {
        if (isset($_FILES['file'])) {
            $avatar = $_FILES['file']['name'];
            $ext_img = strtolower(pathinfo($avatar, PATHINFO_EXTENSION));
            $_FILES['file']['name'] = md5(rand()) . '.' . $ext_img;
            $file_avatar = $_FILES['file']['name'];
            $path_avatar = $upload_avatar . $file_avatar;
            move_uploaded_file($_FILES['file']['tmp_name'], $path_avatar);
            $cate = [
                'cate_name' => $name,
                'cate_slug' => ChangeToSlug($name),
                'cate_icon' => $file_avatar,
            ];
            add('categories', $cate);
            $data = [
                'result' => 2,
                'message' => 'Thêm thành công',
            ];
        } else {
            $cate = [
                'cate_name' => $name,
                'cate_slug' => ChangeToSlug($name),
            ];
            add('categories', $cate);
            $data = [
                'result' => 2,
                'message' => 'Thêm thành công',
            ];
        }
    }
}else {
    $data = [
        'result' => 3,
        'message' => 'Thêm thất bại',
    ];
}
echo json_encode($data);
