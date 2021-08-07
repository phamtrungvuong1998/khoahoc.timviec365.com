<?
require_once 'api_info.php';

use Firebase\JWT\JWT;


$center = [];
if (isset($token->user_id) && $token->user_type == 3 && $token->user_type == 2) {
    $id = $token->user_id;
    // khóa học tạo gần đây
    if ($token->user_type == 3) {
        $db_course = new db_query("SELECT courses.course_id,course_name,course_avatar,price_listed,price_promotional,teacher_name,teacher_avatar FROM courses INNER JOIN user_center_teacher ON user_center_teacher.center_teacher_id = courses.center_teacher_id WHERE courses.user_id = '$id' ORDER BY courses.course_id DESC"); 
    }else if ($token->user_type == 2){
        $db_course = new db_query("SELECT courses.course_id,course_name,course_avatar,price_listed,price_promotional,user_name,user_avatar FROM courses INNER JOIN users ON courses.user_id = users.user_id WHERE courses.user_id = '$id' ORDER BY courses.course_id DESC"); 
    }
    $course = [];
    while ($row = mysql_fetch_assoc($db_course->result)) {
        $course[$row['course_id']] = $row;
    }
    $center['new'] = $course;

    //KHoa hoc ban chay
    if ($token->user_type == 3) {
        $db_course_hot = new db_query("SELECT courses.course_id,number_buy,course_name,course_avatar,price_listed,price_promotional,teacher_name,teacher_avatar FROM courses INNER JOIN user_center_teacher ON user_center_teacher.center_teacher_id = courses.center_teacher_id WHERE courses.user_id = '$id' ORDER BY number_buy DESC");
    }else if ($token->user_type == 2){
        $db_course_hot = new db_query("SELECT courses.course_id,number_buy,course_name,course_avatar,price_listed,price_promotional,user_name,user_avatar FROM courses INNER JOIN users ON users.user_id = courses.user_id WHERE courses.user_id = '$id' ORDER BY number_buy DESC");
    }
    $d = 0;
    $number = 0;
    $course_hot = [];
    $total = 0;
    while ($row = mysql_fetch_assoc($db_course_hot->result)) {
        $course_id = $row['course_id'];
        $db_odc = new db_query("SELECT * FROM order_student_common WHERE course_id = '$course_id'");
        if (mysql_num_rows($db_odc->result) == 0) {
            $number = 0;
        } else {
            $odc = mysql_num_rows($db_odc->result);
            $number = $odc;
        }
        $d = $row['number_buy'];
        $total = $d + $number;
        $course_hot[$course_id] = $row;
        $course_hot[$course_id]['total_number_buy'] = $total;
    }
    $center['hot'] = $course_hot;

        //doanh so ban hang
    $db_order = new db_query("SELECT * FROM orders INNER JOIN courses ON courses.course_id = orders.course_id WHERE user_id = '$id'");
    $dem = 0;
    $total = 0;
    while ($row = mysql_fetch_assoc($db_order->result)) {
        $total += $row['total_prices'];
        $dem++;
    }
    $order = [
        'doanh_thu' => $total,
        'don_hang' => $dem,
    ];
    $center['order'] = $order;


        //khóa học đã bán trong 7 ngày:
        // $t2 = date('d-m-Y', strtotime('previous Monday'));   
        $t2 = strtotime('previous Monday');                  //t2
        $t3 = strtotime('previous Monday')+ 86400;          //t3
        $t4 = strtotime('previous Monday')+ 86400 * 2;      //t4
        $t5 = strtotime('previous Monday')+ 86400 * 3;      //t5
        $t6 = strtotime('previous Monday')+ 86400 * 4;      //t6
        $t7 = strtotime('previous Monday')+ 86400 * 5;      //t7
        $cn = strtotime('previous Monday')+ 518400;         //cn
        $arr_date = [$t2,$t3,$t4,$t5,$t6,$t7,$cn];
        $day = [];
        echo $t2;
        for ($i=0; $i < count($arr_date); $i++) { 
            $a = ($i+2);
            $db_day = new db_query("SELECT * FROM orders Where day_buy = '$arr_date[$i]'");
            while($row = mysql_fetch_assoc($db_day->result)){
                $day[$row['order_id']]= $row;
                $day[$row['order_id']]['day'] = $a;
            }
        }
        $center['day'] = $day;

        //hoc vien moi
        $db_student = new db_query("SELECT users.user_id,user_name,user_avatar FROM save_student JOIN users ON save_student.user_student_id = users.user_id WHERE save_student.user_teacher_id = '$id' order by save_id DESC");
        $student = [];
        while ($row = mysql_fetch_assoc($db_student->result)) {
            $student[$row['user_id']] = $row;
        }
        // success('', $student);
        $center['student'] = $student;
        success('',$center);
}else {
    set_error('404','Phải đăng nhập tài khoản của trung tâm hoặc giảng viên');
}
