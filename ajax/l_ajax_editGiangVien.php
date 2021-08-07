
<?
require_once '../config/config.php';
$upload_location = "../img/avatar/";
$today = strtotime(date("d-m-Y"));
$user_id = getValue('l_id', 'str', 'POST', '', '');
$hoten = getValue('l_hoten', 'str', 'POST', '', '');
$monhoc = getValue('l_monhoc', 'str', 'POST', '', '');
$bangcap = getValue('l_bangcap', 'str', 'POST', '', '');
$date = getValue('l_date', 'str', 'POST', '', '');
if ($user_id != ''  && $hoten != '' && $monhoc != '' && $bangcap != '' && $date != 0) {
    $id = [
        'center_teacher_id' => $user_id
    ];
    $allowed_image_extension = array(
        "jpeg", "JPEG", "png", "PNG", "jpg", "JPG"
    );
    if (isset($_FILES['file'])) {
        if ($_FILES['file']['size'] < 2097152) { 
            $db_teac = new db_query("SELECT teacher_avatar FROM user_center_teacher WHERE center_teacher_id = '$user_id'");
            $unfile = mysql_fetch_assoc($db_teac->result);
            $img = $upload_location . $unfile['teacher_avatar'];
            if (is_writable($img)) {
                unlink($img);
            }
            $avatar = $_FILES['file']['name'];
            $ext_img = strtolower(pathinfo($avatar, PATHINFO_EXTENSION));
            $_FILES['file']['name'] = md5(rand()) . '.' . $ext_img;
            $file_avatar = $_FILES['file']['name'];
            $path_avatar = $upload_location . $file_avatar;
            if (in_array($ext_img, $allowed_image_extension)) {
                move_uploaded_file($_FILES['file']['tmp_name'], $path_avatar);
                $add_teacher = [
                    'cate_id' => $monhoc,
                    'teacher_name' => $hoten,
                    'qualification' => $bangcap,
                    'teacher_avatar' => $file_avatar,
                    'date_join' => strtotime($date),
                    'created_at' => $today,
                    'updated_at' => $today,
                ];
                update('user_center_teacher', $add_teacher, $id);
                $data = [
                    'result' => true,
                    'message' => "cập nhật giảng viên thành công"
                ];
            }
        }
    } else {
        $add_teacher = [
            'cate_id' => $monhoc,
            'teacher_name' => $hoten,
            'qualification' => $bangcap,
            'date_join' => strtotime($date),
            'created_at' => $today,
            'updated_at' => $today,
        ];

        update('user_center_teacher', $add_teacher, $id);
        $data = [
            'result' => true,
            'message' => "cập nhật giảng viên thành công"
        ];
    }
}
else{
    $data = [
        'result' => false,
        'message' => "Rỗng"
    ];
}
echo json_encode($data);
?>