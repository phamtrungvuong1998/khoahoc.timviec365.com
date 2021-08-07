
<?
include '../config/config.php';
include 'functions.php';

use Firebase\JWT\JWT;

$token = getValue('token', 'str', 'POST', '', '');
$upload_location = "../img/avatar/";
$today = strtotime(date("d-m-Y"));
$hoten = getValue('hoten', 'str', 'POST', '', '');
$monhoc = getValue('monhoc', 'str', 'POST', '', '');
$bangcap = getValue('bangcap', 'str', 'POST', '', '');
$date = getValue('date', 'str', 'POST', '', '');

if ($token != '') {
    $token = JWT::decode($token, $key, ['HS256']);
    if ($hoten != '' && $monhoc != '' && $bangcap != '' && $date != '') {
        $id = [
            'user_id' => $token->user_id
        ];
        $allowed_image_extension = array(
            "jpeg", "JPEG", "png", "PNG", "jpg", "JPG"
        );
        $token_id = $token->user_id;
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
                        'user_id' => $token_id,
                        'cate_id' => $monhoc,
                        'teacher_name' => $hoten,
                        'qualification' => $bangcap,
                        'teacher_avatar' => $file_avatar,
                        'date_join' => strtotime($date),
                        'created_at' => $today,
                        'updated_at' => $today,
                    ];
                    add('user_center_teacher', $add_teacher);
                    $data = [
                        'result' => true,
                    ];
                    success('Thêm giảng viên thành công', $data);
                } else {
                    set_error('404', 'Vui lòng để đúng định dạng ảnh!');
                }
            }
        } else {
            // echo $date;
            // die();
            $add_teacher = [
                'user_id' => $token_id,
                'cate_id' => $monhoc,
                'teacher_name' => $hoten,
                'qualification' => $bangcap,
                'date_join' => strtotime($date),
                'created_at' => $today,
                'updated_at' => $today,
            ];

            add('user_center_teacher', $add_teacher);
            $data = [
                'result' => true,
            ];
            success('Thêm giảng viên thành công', $data);
        }
    } else {
        set_error('404', 'Bạn phải điền đầy đủ thông tin!');
    }
} else {
    set_error('404', 'Bạn phải đăng nhập trước');
}
// echo json_encode($data);
?>