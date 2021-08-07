
<?
require_once '../config/config.php';
$upload_location = "../img/avatar/";
$today = strtotime(date("d-m-Y"));
$l_hoten = getValue('l_hoten', 'str', 'POST', '', '');
$l_monhoc = getValue('l_monhoc', 'str', 'POST', '', '');
$l_bangcap = getValue('l_bangcap', 'str', 'POST', '', '');
$l_date = getValue('l_date', 'str', 'POST', '', '');
// echo strtotime($l_date);
if ($l_hoten != '' && $l_monhoc != '' && $l_bangcap != '' && $l_date != '') {
    $id = [
        'user_id' => $_COOKIE['user_id']
    ];
    $allowed_image_extension = array(
        "jpeg", "JPEG", "png", "PNG", "jpg", "JPG"
    );
    $cook_id = $_COOKIE['user_id'];
    if (isset($_FILES['file'])) {
        if ($_FILES['file']['size'] < 2097152) {
            $avatar = $_FILES['file']['name'];
            $ext_img = strtolower(pathinfo($avatar, PATHINFO_EXTENSION));
            // echo $ext_img;
            $_FILES['file']['name'] = md5(rand()) . '.' . $ext_img;
            $file_avatar = $_FILES['file']['name'];
            $path_avatar = $upload_location . $file_avatar;
            // echo in_array($ext_img, $allowed_image_extension);
            if (in_array($ext_img, $allowed_image_extension)) {
                move_uploaded_file($_FILES['file']['tmp_name'], $path_avatar);
                $add_teacher = [
                    'user_id' => $cook_id,
                    'cate_id' => $l_monhoc,
                    'teacher_name' => $l_hoten,
                    'qualification' => $l_bangcap,
                    'teacher_avatar' => $file_avatar,
                    'date_join' => strtotime($l_date),
                    'created_at' => $today,
                    'updated_at' => $today,
                ];
                add('user_center_teacher', $add_teacher);
                $data = [
                    'result' => 1,
                    'message' => "thêm giảng viên thành công"
                ];
            }else{
                $data = [
                    'result' => 2,
                    'message' => "Vui lòng chọn đúng định dạng ảnh"
                ];
            }
        }
    } else {
        $add_teacher = [
            'user_id' => $cook_id,
            'cate_id' => $l_monhoc,
            'teacher_name' => $l_hoten,
            'qualification' => $l_bangcap,
            'date_join' => strtotime($l_date),
            'created_at' => $today,
            'updated_at' => $today,
        ];

        add('user_center_teacher', $add_teacher);
        $data = [
            'result' => 1,
            'message' => "thêm giảng viên thành công"
        ];
    }
}else{
    $data = [
        'result' => 3,
        'message' => "thêm giảng viên thất bại"
    ];
}

echo json_encode($data);
?>