<meta charset="UTF-8">
<?
include_once '../config/config.php';

if (isset($_POST['btn'])) {
    $cookie_id = $_POST['cookie_id'];
    $output = '';

    //Danh sách khóa học Offine
    if($_POST['actions'] == 'offline'){
        $output .='
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>KHÓA HỌC</th>
                    <th>MÔN HỌC</th>
                    <th>SỐ BUỔI HỌC</th>
                    <th>TÀI LIỆU</th>
                    <th>GÍA GỐC</th>
                    <th>GIÁ KHUYẾN MẠI</th>
                    <th>NGÀY ĐĂNG</th>
                </tr>
                </thead>
            <tbody>    
        ';
        $dbon = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE user_id = $cookie_id AND course_type = 1 ");
        while ($rowc = mysql_fetch_array($dbon->result)) {
            if ($rowc['price_promotional'] == -1) {
                $price_promotional = "chưa cập nhật";
            }else{
                $price_promotional = number_format($rowc['price_promotional']) . " đ";
            }
            $output .='
                <tr>
                    <th>'.$rowc['course_name'].'</th>
                    <th>'.$rowc['cate_name'].'</th>
                    <th>'.$rowc['time_learn'].'</th>
                    <th>'.$rowc['course_slide'].'</th>
                    <th>'.$rowc['price_listed'].'</th>
                    <th>'.$price_promotional.' đ</th>
                    <th>'.date("d-m-Y", $rowc['created_at']) .'</th>
                </tr>    
            ';
        }
        $output .= '
            </tbody>
        </table>';
    }
    
    //Danh sách khóa học Online
    elseif($_POST['actions'] == 'online'){
        if ($rowc['price_listed'] == -1) {
            $price_listed = "chưa cập nhật";
        }else{
            $price_listed = number_format($rowc['price_listed']) . " đ";
        }

        if ($rowc['price_promotional'] == -1) {
            $price_promotional = "chưa cập nhật";
        }else{
            $price_promotional = number_format($rowc['price_promotional']) . " đ";
        }
        $output .='
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>KHÓA HỌC</th>
                    <th>MÔN HỌC</th>
                    <th>SỐ BUỔI HỌC</th>
                    <th>TÀI LIỆU</th>
                    <th>GÍA GỐC</th>
                    <th>GIÁ KHUYẾN MẠI</th>
                    <th>NGÀY ĐĂNG</th>
                </tr>
                </thead>
            <tbody>  
        ';
        $dbon = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE user_id = $cookie_id AND course_type = 2 ");
        while ($rowc = mysql_fetch_array($dbon->result)) {
            $output .='
                <tr>
                    <th>'.$rowc['course_name'].'</th>
                    <th>'.$rowc['cate_name'].'</th>
                    <th>'.$rowc['time_learn'].'</th>
                    <th>'.$rowc['course_slide'].'</th>
                    <th>'.$price_listed.'</th>
                    <th>'.$price_promotional.'</th>
                    <th>'.date("d-m-Y", $rowc['created_at']) .'</th>
                </tr>    
            ';
        }
        $output .= '
            </tbody>
        </table>';
    }
    
    //Danh sách khóa học đã bán
    elseif($_POST['actions'] == 'khdaban'){
        $output .='
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>MÃ ĐƠN HÀNG</th>
                    <th>KHÓA HỌC</th>
                    <th>TÊN HỌC VIÊN</th>
                    <th>NGÀY GIAO DỊCH</th>
                    <th>HỌC PHÍ</th>
                    <th>TRẠNG THÁI</th>
                </tr>
                </thead>
            <tbody>  
        ';
        $dbon = new db_query("SELECT * FROM orders JOIN users ON users.user_id = orders.user_student_id JOIN courses ON courses.course_id = orders.course_id WHERE courses.user_id  = $cookie_id");
        while ($rowc = mysql_fetch_array($dbon->result)) {
            if($rowc['course_status'] == 1){
                $status =  'Đang dạy';
            }elseif($rowc['course_status'] == 2){
                $status =   'Kết thúc';
            }else{
                $status =   'Đang chờ dạy';
            }
            $output .='
                <tr>
                    <th>'.$rowc['order_id'].'</th>
                    <th>'.$rowc['course_name'].'</th>
                    <th>'.$rowc['user_name'].'</th>
                    <th>'.date("d-m-Y", $rowc['day_buy']) .'</th>
                    <th>'.number_format($rowc['price_promotional']).' đ</th>
                    <th>'.$status.'</th>
                </tr>    
            ';
        }
        $output .= '
            </tbody>
        </table>';
    }

    //Danh sách đánh giá
    elseif($_POST['actions'] == 'danhgia'){
         $output .='
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>MÃ ĐÁNH GIÁ</th>
                    <th>KHÓA HỌC</th>
                    <th>ĐÁNH GIÁ</th>
                </tr>
                </thead>
            <tbody>  
        ';
        $dbon = new db_query("SELECT * FROM rate_course JOIN courses ON courses.course_id = rate_course.course_id JOIN users on users.user_id = rate_course.user_student_id WHERE courses.user_id  = $cookie_id");
        while ($rowc = mysql_fetch_array($dbon->result)) {
            $output .='
                <tr>
                    <th>'.$rowc['rate_id'].'</th>
                    <th>'.$rowc['course_name'].'</th>
                    <th>'.$rowc['comment_rate'].'</th>
                </tr>    
            ';
        }
        $output .= '
            </tbody>
        </table>';
    }elseif($_POST['actions'] == 'muatudiem'){
        $db_point = new db_query("SELECT * FROM history_point INNER JOIN users ON user_student_id=users.user_id INNER JOIN city ON users.cit_id=city.cit_id Where center_teacher_id = '$cookie_id' ORDER BY history_point_id DESC LIMIT 0,10");
        $output .='
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>TÊN HỌC VIÊN</th>
                    <th>EMAIL</th>
                    <th>SỐ ĐIỆN THOẠI</th>
                    <th>MÔN HỌC QUAN TÂM</th>
                    <th>ĐỊA CHỈ</th>
                </tr>
                </thead>
            <tbody>  
        ';
        while ($rowc = mysql_fetch_array($db_point->result)) {
            $cat = explode(',', $row['cate_id']);
            $j = '';
            $i = 0;
            $db_city = new db_query("SELECT cit_name FROM city where cit_id =" . $row['district_id']);
            $city = mysql_fetch_assoc($db_city->result);
            $c = $city['cit_name'];
            $c = $c . ' - ' . $row['cit_name'];
            foreach ($cat as $value) {
                $db_cate = new db_query("SELECT cate_name FROM categories WHERE cate_id =" . $value);
                $a = mysql_fetch_assoc($db_cate->result);
                                    //echo $a['cate_name'];
                if ($i == count($cat) - 1) {
                    echo $j . $a['cate_name'];
                } else {
                    echo $j . $a['cate_name'] . ', ';
                }
                $i++;
            }
            $output .='
                <tr>
                    <th>'.$rowc['user_name'].'</th>
                    <th>'.$rowc['user_mail'].'</th>
                    <th>'.$rowc['user_phone'].'</th>
                    <th>'.$j.'</th>
                    <th>'.$c.'</th>
                </tr>    
            ';
        }
        $output .= '
            </tbody>
        </table>';
    }


    //Danh sách mua chung chờ
    elseif($_POST['actions'] == 'muachungcho'){
        $output .='
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>MÃ ĐƠN HÀNG</th>
                    <th>KHÓA HỌC</th>
                    <th>HỌC PHÍ</th>
                    <th>TỔNG TIỀN</th>
                    <th>HỌC VIÊN ĐĂNG KÍ</th>
                    <th>NGÀY MUA</th>
                </tr>
                </thead>
            <tbody>  
        ';
        $dbon = new db_query("SELECT * FROM order_common JOIN courses ON courses.course_id = order_common.course_id  WHERE courses.user_id = $cookie_id");
        while ($rowc = mysql_fetch_array($dbon->result)) {
            $output .='
                <tr>
                    <th>'.$rowc['common_id'].'</th>
                    <th>'.$rowc['course_name'].'</th>
                    <th>'.number_format($rowc['price_discount']).' đ</th>
                    <th>'.number_format($rowc['price_promotional']).' đ</th>
                    <th>'.$rowc['numbers'] .'/'.$rowc['quantity_std'].'</th>
                    <th>'.date("d-m-Y", $rowc['day_buy']).'</th>
                </tr>    
            ';
        }
        $output .= '
            </tbody>
        </table>';
    }

    elseif($_POST['actions'] == 'magiamgia'){
        $output .='
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>MÃ GIẢM GIÁ</th>
                    <th>SỐ LƯỢNG</th>
                    <th>SỐ TIỀN GIẢM GIÁ</th>
                    <th>THỜI GIAN SỬ DỤNG</th>
                    <th>TRẠNG THÁI</th>
                </tr>
                </thead>
            <tbody>  
        ';
        $dbon = new db_query("SELECT * FROM discount_code WHERE user_id = $cookie_id");
        while ($rowc = mysql_fetch_array($dbon->result)) {
            if($rowc['code_status']==0){
                $status = 'Còn Hạn';
            }else{
                $status = 'Hết Hạn';
            }
            $output .='
                <tr>
                    <th>'.$rowc['code_name'].'</th>
                    <th>'.$rowc['quantity'].'</th>
                    <th>'.number_format($rowc['discount_money']).' đ</th>
                    <th>'.$rowc['date_start'] .' - '.$rowc['date_end'].'</th>
                    <th>'.$status.'</th>
                </tr>    
            ';
        }
        $output .= '
            </tbody>
        </table>';
    }
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=download.xls');
    echo $output;
}
?>