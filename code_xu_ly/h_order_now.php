<?
require_once '../config/config.php';
if (!isset($_COOKIE['user_id']) || $_COOKIE['user_type'] != 1) {
    header("Location: /");
}else{
    $course_id = getValue('course_id', 'int', 'GET', '0');
    $dbc = new db_query("SELECT * FROM courses JOIN users on users.user_id=courses.user_id WHERE course_id = $course_id");
    $rowc = mysql_fetch_array($dbc->result);
    $center_teacher_id = $rowc['user_id'];
    $moneyTeach = $rowc['user_money'];
    if ($rowc['price_listed'] == -1) {
        header("Location: /");
    }
    if($rowc['course_type'] == 1){
        header("Location: /");
        $course_type = 1;
    }elseif($rowc['course_type'] == 2){
        $course_type = 2;
    }
    if (isset($_SESSION['total_price'])) {
        $total_prices = $_SESSION['total_price'];
    } else {
        if ($rowc['price_promotional'] == -1) {
            $total_prices = $rowc['price_listed'];
        }else{
            $total_prices = $rowc['price_promotional'];
        }
    }
    if (isset($_SESSION['code_id'])) {
        $code_id = $_SESSION['code_id'];
    } else {
        $code_id = 0;
    }
    if(isset($_POST['btn_buy'])){
        if($row['user_money'] < $total_prices){
            echo "<script>alert('Thanh toán thất bại: Vui lòng nạp thêm tiền !!!')</script>";
        }else{
            $today = strtotime(date("d-m-Y"));
            $data1 = [
                'user_student_id'=> $cookie_id,
                'course_id'=> $course_id,
                'code_id'=>$code_id,
                'course_type'=>$course_type,
                'total_prices'=> $total_prices,
                'order_status'=>1,
                'day_buy'=> $today
            ];
            add('orders', $data1);
            
            $user_money = $row['user_money'] - $total_prices;

            $update1 = [
                'user_money'=> $user_money
            ];
            $where1 = [
                'user_id'=>$cookie_id
            ];
            update('users', $update1, $where1);
            
            $number_buy = $rowc['number_buy'] + 1;

            $update3 = [
                'number_buy' => $number_buy
            ];
            $where3 = [
                'course_id' => $course_id
            ];
            update('courses', $update3, $where3);

            $dataTeachId = [
                'user_id'=>$center_teacher_id
            ];

            $dataTeachMoney = [
                'user_money'=>$moneyTeach + $total_prices
            ];

            update('users',$dataTeachMoney,$dataTeachId);
            if (isset($_SESSION['quantity'])) {
                $update2 = [
                'quantity'=>$_SESSION['quantity'],
                'updated_at'=> $today
            ];
                $where2 = [
                'code_id'=>$code_id
            ];
                update('discount_code', $update2, $where2);
            }
            session_destroy();
            header("location:/mua-khoa-hoc-thanh-cong/id$cookie_id-course$course_id.html");
        }
    }
}
?>