<?php
require_once '../config/config.php';
$course_id = getValue('course_id','int','GET','0');
$dbc = new db_query("SELECT * FROM courses JOIN users ON users.user_id = courses.user_id WHERE course_id = $course_id");
$rowc = mysql_fetch_array($dbc->result);

$cookie_id = $_COOKIE['user_id'];

$dbcommon = new db_query("SELECT * FROM order_common WHERE course_id = $course_id");
$rowcommon = mysql_fetch_array($dbcommon->result);
$numrow = mysql_num_rows($dbcommon->result);

$dbcourse = new db_query("SELECT * FROM courses WHERE course_id = $course_id");
$rowcourse = mysql_fetch_array($dbcourse->result);

$dbcommon1 = new db_query("SELECT * FROM order_student_common WHERE course_id = $course_id AND user_student_id = $cookie_id");
$rowcommon1 = mysql_fetch_array($dbcommon1->result);
$today = strtotime("d-m-Y");
if (isset($_POST['btn_buy'])) {
	if ($row['user_money'] < $rowc['price_discount']) {
		echo "<script>alert('Thanh toán thất bại: Vui lòng nạp thêm tiền !!!')</script>";
	} else {
		if(mysql_num_rows($dbcommon->result)>0){
			if(mysql_num_rows($dbcommon1->result)>0){
				header("location:/mua-khoa-hoc-chung/course$course_id.html");
			}else{
				if($rowcommon['numbers'] >= $rowcourse['quantity_std']){
					$data = [
						'numbers'=>1,
						'day_buy'=>$today
					];
				}else{
					$numbers = $rowcommon['numbers'] + 1;
					$data = [
						'numbers'=>$numbers,
						'day_buy'=>$today
					];
				}
				$where = [
					'course_id'=>$course_id,
				];
				update('order_common', $data,$where);
				$data1=[
					'common_id'=>$rowcommon['common_id'],
					'user_student_id'=>$cookie_id,
					'course_id'=>$course_id
				];
				add('order_student_common',$data1);
				header("location:/mua-khoa-hoc-thanh-cong/id$cookie_id-course$course_id.html");
			}
		}else{
			$today = strtotime(date("d-m-Y"));
            $data = [
                'course_id'=>$course_id,
                'course_type'=>$rowcourse['course_type'],
                'numbers'=>1,
                'day_buy'=>$today,
            ];
            add('order_common', $data);

            $last_id = mysql_insert_id();
            $data1=[
                'common_id'=>$last_id,
                'user_student_id'=>$cookie_id,
                'course_id'=>$course_id
            ];
            add('order_student_common', $data1);

			$user_money = $row['user_money'] - $rowc['price_discount'];
            $update1 = [
                'user_money'=> $user_money
            ];
            $where1 = [
                'user_id'=>$cookie_id
            ];
            update('users', $update1, $where1);

            header("location:/mua-khoa-hoc-thanh-cong/id$cookie_id-course$course_id.html");
        }
	}
}

?>