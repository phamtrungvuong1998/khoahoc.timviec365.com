<?
require_once '../config/config.php';
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";
$course_id = getValue('course_id', 'str', 'POST', '', '');
$course_name = getValue('course_name', 'str', 'POST', '', '');
$course_describe = getValue('course_describe', 'str', 'POST', '', '');
$tag2 = getValue('tag2', 'str', 'POST', '', '');
$teach2 = getValue('teach2', 'str', 'POST', '', '');
$course_benefit = getValue('course_benefit', 'str', 'POST', '', '');
$course_match = getValue('course_match', 'str', 'POST', '', '');
$course_request = getValue('course_request', 'str', 'POST', '', '');
$general_describe = getValue('general_describe', 'str', 'POST', '', '');
$radio = getValue('radio', 'str', 'POST', '', '');
$level_id = getValue('level_id', 'str', 'POST', '', '');
$cate_id = getValue('cate_id', 'str', 'POST', '', '');
$l_check = getValue('l_check', 'str', 'POST', '', '');
$addtienich = getValue('addtienich', 'str', 'POST', '', '');
// $cook_id = $cook_id['user_id'];
$link_img = '../img/course/';
// echo $course_match;
if ($course_id != '' && $course_name != '' && $course_describe != '' && $teach2 != '' && $course_benefit != '' && $course_match != '' && $course_request != '' && $general_describe != '' && $radio != '' && $level_id != '' && $cate_id != '' && $l_check != '') {
    // echo 12341231;
    if (isset($_FILES['avatar'])) {
        $del_img = new db_query("SELECT course_avatar FROM courses WHERE course_id = '$course_id' ");
        $row_img = mysql_fetch_assoc($del_img->result);
        $img = $link_img . $row_img['course_avatar'];
        if (is_writable($img)) {
            unlink($img);
        }
        $avatar = $_FILES['avatar']['name'];
        $ext_img = strtolower(pathinfo($avatar, PATHINFO_EXTENSION));
        $_FILES['avatar']['name'] = md5(rand()) . '.' . $ext_img;
        $file_avatar = $_FILES['avatar']['name'];
        $path_avatar = $link_img . $file_avatar;
        move_uploaded_file($_FILES['avatar']['tmp_name'], $path_avatar);
        $update1 = [
            'course_name' => $course_name,
            'course_describe' => $course_describe,
            'center_teacher_id' => $teach2,
            'course_avatar' => $file_avatar,
            'course_benefit' => $course_benefit,
            'course_match' => $course_match,
            'course_request' => $course_request,
            'general_describe' => $general_describe,
            'certification' => $radio,
            'level_id' => $level_id,
            'cate_id' => $cate_id,
            'advantages_id' => $l_check
        ];
        $id = [
            'course_id' => $course_id,
        ];
        // echo $course_id;
        update('courses', $update1, $id);
        $result = [
            'result' => true,
            'message' => 'cập nhật khóa học thành công'
        ];
    }
    else{
        $update1 = [
            'course_name' => $course_name,
            'course_describe' => $course_describe,
            'center_teacher_id' => $teach2,
            'course_benefit' => $course_benefit,
            'course_match' => $course_match,
            'course_request' => $course_request,
            'general_describe' => $general_describe,
            'certification' => $radio,
            'level_id' => $level_id,
            'cate_id' => $cate_id,
            'advantages_id' => $l_check
        ];
        $id = [
            'course_id' => $course_id,
        ];
        // echo $course_id;
        update('courses', $update1, $id);
        $result = [
            'result' => true,
            'message' => 'cập nhật khóa học thành công'
        ];
    }
}

echo json_encode($result);
