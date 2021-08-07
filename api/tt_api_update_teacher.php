
<?
require_once '../config/config.php';
include 'functions.php';
$upload_location = "../img/avatar/";
$today = strtotime(date("d-m-Y"));
$id = getValue('id', 'str', 'POST', '', '');
$hoten = getValue('hoten', 'str', 'POST', '', '');
$monhoc = getValue('monhoc', 'str', 'POST', '', '');
$bangcap = getValue('bangcap', 'str', 'POST', '', '');
$date = getValue('date', 'str', 'POST', '', '');
// echo strtotime($date);
if ($id != ''  && $hoten != '' && $monhoc != '' && $bangcap != '' && $date != 0) {
    // var_dump($hoten);
    $id = [
        'center_teacher_id' => $id
    ];
    $allowed_image_extension = array(
        "jpeg", "JPEG", "png", "PNG", "jpg", "JPG"
    );
    if (isset($_FILES['file'])) {
        if ($_FILES['file']['size'] < 2097152) {
            $db_teac = new db_query('SELECT teacher_avatar FROM user_center_teacher WHERE center_teacher_id =' . $id);
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
                ];
                success('Cập nhật giảng viên thành công',$data);
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
        ];
        success('Cập nhật giảng viên thành công',$data);
    }
}
else{
    set_error('404','Bạn phải điền đầy đủ thông tin!');
}
// echo json_encode($data);
?>