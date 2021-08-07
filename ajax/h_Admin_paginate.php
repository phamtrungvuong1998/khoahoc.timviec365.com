<?
require_once '../config/config.php';
$record_per_page = 20;
$page = '';
$output = '';
if (isset($_POST["page"])) {
    $page = $_POST["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1)*$record_per_page;
$i = 1;

$adm_id = $_POST['adm_id'];
//Điểm
if (isset($_POST['point'])) {
    $module = 6;    
    $query = new db_query("SELECT * FROM points JOIN users ON users.user_id = points.user_id ORDER BY point_id DESC LIMIT $start_from, $record_per_page");
    $output .='
        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Điểm khuyến mãi</th>
                                <th scope="col">Điểm cộng thêm</th>
                                <th scope="col">Sửa</th>
                            </tr>
                        </thead>
                        <tbody id="filter">
    ';
    while ($rowHV = mysql_fetch_array($query->result)) {
        if ($rowHV['user_type'] == 2) {
            $link = urlDetail_teacher($rowHV['user_id'], $rowHV['user_slug']);
        } elseif ($rowHV['user_type'] == 3) {
            $link = urlDetail_center($rowHV['user_id'], $rowHV['user_slug']);
        }
        if ($_COOKIE['adm_type'] == 0) {
            $check = new db_query("SELECT * FROM admin_permission WHERE adm_id = $adm_id AND module_id = $module AND permis_update = 1");
            if (mysql_num_rows($check->result) > 0) {
                $edit = '<img id="admin_edit'.$rowHV['point_id'] .'" src="../img/vv_edi.svg" onclick="v_teacher_edit('.$rowHV['point_id'] .')"
                        alt="Ảnh lỗi">';
            }
        }else{
            $edit = '<img id="admin_edit'.$rowHV['point_id'] .'" src="../img/vv_edi.svg" onclick="v_teacher_edit('.$rowHV['point_id'] .')"
                        alt="Ảnh lỗi">';
        }
        $output .= '
            <tr>
                <td>'.$i .'</td>
                <td><a href="'.$link.'">'.$rowHV['user_name'].'</a></td>
                <td>'.$rowHV['user_mail'] .'</td>
                <td>'.$rowHV['point'] .'</td>
                <td>'.$rowHV['point_add_total'] .'</td>
                <td>'.$edit.'</td>
            </tr>
        ';
        $i++;
    }

    $page_query = new db_query("SELECT * FROM points JOIN users ON users.user_id = points.user_id ORDER BY point_id DESC");
    
}

//Đơn Hàng
if (isset($_POST['order'])) {
    $query = new db_query("SELECT * FROM orders JOIN courses ON courses.course_id = orders.course_id JOIN users ON users.user_id = orders.user_student_id  ORDER BY order_status ASC LIMIT $start_from, $record_per_page");
    $output .='
        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Mã đơn</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Khóa học</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Ngày mua</th>
                            </tr>
                        </thead>
                        <tbody id="filter">
    ';
    while ($rowHV = mysql_fetch_array($query->result)) {
        if ($rowHV['order_status'] == 1) {
            $order_status = "<span style='color:green'>Thành công</span>";
        }else{
            $order_status = "<span style='color:red'>Chưa thanh toán</span>";
        }
        $output .= '
            <tr>
                <td>'.$i++ .'</td>
                <td>'. $rowHV['order_id'] .'</td>
                <td><a
                        href="'.urlDetail_student($rowHV['user_id'],$rowHV['user_slug']).'">'. $rowHV['user_name'].'</a>
                </td>
                <td>'. $rowHV['user_mail'].'</td>
                <td>'. $rowHV['user_phone'].'</td>
                <td>'. $rowHV['user_address'].'</td>
                <td>'. $rowHV['course_name'].'</td>
                <td>'. number_format($rowHV['total_prices']).' đ</td>
                <td>'. date("d-m-Y", $rowHV['day_buy']) .'</td>
            </tr>
        ';
        $i++;
    }
    $page_query = new db_query("SELECT * FROM orders JOIN courses ON courses.course_id = orders.course_id JOIN users ON users.user_id = orders.user_student_id  ORDER BY order_status ASC");
}

//Ví
if (isset($_POST['trans'])) {
    $query = new db_query("SELECT * FROM user_transaction JOIN users ON users.user_id = user_transaction.user_id JOIN bank ON bank.bank_id = user_transaction.bank_id WHERE user_type = 1  ORDER BY transaction_id DESC LIMIT $start_from, $record_per_page");
    $output .='
        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tên học viên</th>
                                <th scope="col">Tên người chuyển</th>
                                <th scope="col">Số tiền</th>
                                <th scope="col">Ngân hàng chuyển</th>
                                <th scope="col">Ngân hàng nạp</th>
                                <th scope="col">Số tài khoản</th>
                                <th scope="col">Thời gian chuyển</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody id="filter">
    ';
    while ($rowHV = mysql_fetch_array($query->result)) {
        if ($rowHV['status'] == 1) {
            $status = '<span style="color:green">Thành công</span>';
        }elseif($rowHV['user_type'] == 2){
            $status = '<span style="color:red">Thất bại</span>';
        }else{
            $status = '<span style="color:black">Đang chờ</span>';
        }
        $output .= '
            <tr>
                    <td>'.$i.'</td>
                    <td><a
                            href="'.urlDetail_student($rowHV['user_id'],$rowHV['user_slug']).'">'.$rowHV['user_name'].'</a>
                    </td>
                    <td>'.$rowHV['transaction_name'].'</td>
                    <td>'.number_format($rowHV['total_money']).'</td>
                    <td>'.$rowHV['bank_name'].'</td>
                    <td>'.$rowHV['bank_name'].'</td>
                    <td>'.$rowHV['acc_number'].'</td>
                    <td>'.$rowHV['transaction_date'].'</td>
                    <td class="transaction_content">'.$rowHV['transaction_content'].'</td>
                    <td>'.$status .'</td>
                </tr>
        ';
        $i++;
    }
    $page_query = new db_query("SELECT * FROM user_transaction JOIN users ON users.user_id = user_transaction.user_id JOIN bank ON bank.bank_id = user_transaction.bank_id WHERE user_type = 1  ORDER BY transaction_id DESC");
}

//Khóa học offline
if (isset($_POST['offline'])) {
    $query = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE course_type = 1  ORDER BY course_id DESC LIMIT $start_from, $record_per_page");
    $output .='
        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Mã KH</th>
                                <th scope="col">Khóa học</th>
                                <th scope="col">Môn học</th>
                                <th scope="col">Số buổi học</th>
                                <th scope="col">Tài liệu</th>
                                <th scope="col">Học phí</th>
                                <th scope="col">Ngày đăng</th>
                                <th scope="col">Sửa</th>
                            </tr>
                        </thead>
                        <tbody id="filter">
    ';
    while ($rowHV = mysql_fetch_array($query->result)) {
        $output .= '
            <tr>
                    <td>'.$rowHV['course_id'].'</td>
                    <td>'.$rowHV['course_name'].'</td>
                    <td>'.$rowHV['cate_name'].'</td>
                    <td>'.$rowHV['time_learn'].'</td>
                    <td>'.$rowHV['course_slide'].'</td>
                    <td>'.number_format($rowHV['price_promotional']).'</td>
                    <td>'.date("d-m-Y", $rowHV['created_at']) .'</td>
                    <td><img id="admin_edit'.$rowHV['course_id'].'"src="../img/vv_edi.svg" onclick="v_offline_edit('.$rowHV['course_id'].')"alt="Ảnh lỗi"></td>
                </tr>
        ';
        $i++;
    }
    $page_query = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE course_type = 1  ORDER BY course_id DESC");
}


//Khóa học online
if (isset($_POST['online'])) {
    $query = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE course_type = 2  ORDER BY course_id DESC LIMIT $start_from, $record_per_page");
    $output .='
        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Mã KH</th>
                                <th scope="col">Khóa học</th>
                                <th scope="col">Môn học</th>
                                <th scope="col">Số buổi học</th>
                                <th scope="col">Tài liệu</th>
                                <th scope="col">Học phí</th>
                                <th scope="col">Ngày đăng</th>
                                <th scope="col">Sửa</th>
                            </tr>
                        </thead>
                        <tbody id="filter">
    ';
    while ($rowHV = mysql_fetch_array($query->result)) {
        $output .= '
            <tr>
                    <td>'.$rowHV['course_id'].'</td>
                    <td>'.$rowHV['course_name'].'</td>
                    <td>'.$rowHV['cate_name'].'</td>
                    <td>'.$rowHV['time_learn'].'</td>
                    <td>'.$rowHV['course_slide'].'</td>
                    <td>'.number_format($rowHV['price_promotional']).'</td>
                    <td>'.date("d-m-Y", $rowHV['created_at']) .'</td>
                    <td><img id="admin_edit'.$rowHV['course_id'].'"src="../img/vv_edi.svg" onclick="v_online_edit('.$rowHV['course_id'].')"alt="Ảnh lỗi"></td>
                </tr>
        ';
        $i++;
    }
    $page_query = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE course_type = 1  ORDER BY course_id DESC");
}


//Chọn khóa học
if (isset($_POST['courses'])) {
    session_start();
    $query = new db_query("SELECT * FROM courses  LIMIT $start_from, $record_per_page");
    $output .='
        <table class="table table-bordered">
                        <thead>
                            <tr id="prd-tr">
                                <th scope="col"><b> Mã</b></th>
                                <th scope="col"><b>Tên Khóa Học</b></th>
                                <th scope="col"><b>Giá gốc</b></th>
                                <th scope="col"><b>Giá khuyến mãi</b></th>
                                <th scope="col"><b>Action</b></th>
                            </tr>
                        </thead>
                        <tbody id="filtercourse">
    ';
    while ($rowHV = mysql_fetch_array($query->result)) {
        $in_session = "0";
        if(isset($_SESSION["cart"])) {
            $array_column = array_column($_SESSION["cart"], 'course_id');
            if(array_search($rowHV['course_id'], $array_column) !== FALSE) {
                $in_session = "1";
            }
        }
        if($in_session != "0") { $none1 = 'style="display:none"'; }else{ $none1 = '';}
        if($in_session != "1") { $none2 = 'style="display:none"'; }else{ $none2 = '';}
        $output .= '
            <input type="hidden" value="'.$rowHV['course_name'].'" id="name'.$rowHV['course_id'].'">
                        <input type="hidden" value="'.$rowHV['price_promotional'].'"
                            id="price'.$rowHV['course_id'].'">
                        <input type="hidden" value="'.$rowHV['course_type'].'" id="type'.$rowHV['course_id'].'">
                        <tr>
                            <td>'.$rowHV['course_id'].'</td>
                            <td>'.$rowHV['course_name'].'</td>
                            <td class="gach">'.number_format($rowHV['price_listed']) .' đ</td>
                            <td>'.number_format($rowHV['price_promotional']).' đ</td>
                            <td>
                                <input type="button" id="'.$rowHV['course_id'].'" value="Thêm" '.$none1.' onclick="addcart(this)" class="add_to_cart" />
                                <input type="button" value="Đã Thêm" class="added" '.$none2.' id="del'.$rowHV['course_id'].'" />
                            </td>
                        </tr>
        ';
    }
    $page_query = new db_query("SELECT * FROM courses ");
}


$output .= '
    </tbody>
</table> 
<nav aria-label="Page navigation example" style="text-align:center">
                    <ul class="pagination">';
$total_records = mysql_num_rows($page_query->result);
$total_pages = ceil($total_records/$record_per_page);
for ($i=1; $i<=$total_pages; $i++) {
    $output .= '<li class="page-item"><a class="page-link" id="'.$i.'">'.$i.'</a></li>';
}
$output .=' </ul>
        </nav>';
echo $output;
?>