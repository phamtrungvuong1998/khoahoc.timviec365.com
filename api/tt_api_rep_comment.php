<? 
include_once '../config/config.php';
require_once 'api_info.php';
if ($user_type != 2 || $user_type != 3) {
    set_error('404','Bạn phải đăng nhập tài khoản trung tâm hoặc giảng viên');
    die();
}

$rate_id = getValue('rate_id','str','POST','','');
$course = getValue('course','str','POST','','');
$comment = getValue('comment','str','POST','','');
if($rate_id != ''&&$student!=''&& $course!=''&& $comment!=''){
    $data = [
        'user_student_id'=> $user_id,
        'course_id'=> $course,
        'rate_id'=> $rate_id,
        'comment_rep'=>$comment
    ];
    add('rep_rate_course',$data);
    $result = [
        'result'=>true,
    ];
    success('Đã trả lời',$result);
}
else{
    set_error('404','Lỗi');
}

// echo json_encode($message);