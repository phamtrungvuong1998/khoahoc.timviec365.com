<?php
require_once '../config/config.php';

$number = getValue('number', 'int', 'GET', '');

$start = ($number - 1) * 10;

$user_id = $_COOKIE['user_id'];

$qr = new db_query("SELECT * FROM orders INNER JOIN courses ON orders.course_id = courses.course_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE orders.user_student_id = '$user_id' AND courses.course_type = 2 ORDER BY order_id DESC LIMIT $start,10");
// echo $qr->query;
$start = $start + 1;
$html = '';
while ($row = mysql_fetch_array($qr->result)) {
	$srcCourse = urlDetail_courseOnline($row['course_id'], $row['course_slug']);
    
    if ($row['price_promotional'] == -1) {
        $price = number_format($row['price_listed']);
    }else{
        $price = number_format($row['price_promotional']);
    } 
    $html = $html . '<div class="v_noidungkh">
    <div class="v_table-cell v_stt">'.$start.'</div>
    <div class="v_table-cell v_content-list v_monhoc"><p>'.$row['course_name'].'</p></div>
    <div class="v_table-cell v_content-list">'.$row['cate_name'].'</div>
    <div class="v_table-cell v_content-list">'.$row['order_id'].'</div>
    <div class="v_table-cell v_content-list">'.$price.' đ</div>
    <div class="v_table-cell v_content-list">'.date("d/m/Y", $row['day_buy']).'</div>
    <div class="v_table-cell v_content-list v_bacham">
    <button class="v_btn-bacham" onclick="v_popup(this)"><img src="../img/More.svg" alt="Ảnh lỗi"></button>

    <div class="v_popup" id="v_popup-'.$row['order_id'].'">
    <center><a href="'.$srcCourse.'"><button class="v_btn-del">XEM THÊM</button></a></center>
    </div>
    </div>
    </div>
    <div class="v_content-mb">
    <div class="flex v_content-mb-div">
    <p class="v_content-mb-stt">'.$start . ".".'</p>
    <p class="v_content-mb-title">'.$row['course_name'].'
    </p>
    </div>
    <div class="flex v_info-all v_content-mb-div">

    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã đơn hàng :</span> '.$row['order_id'].'
    </div>

    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Học phí :</span> '. $price . " đ".'
    </div>
    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Môn học
    :</span>'.$row['cate_name'].'</div>
    <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Thời gian
    :</span>'.date("d/m/Y", $row['day_buy']).'</div>

    <div class="flex v_mb-ghichu-all v_content-mb-div">
    <div class="v_ghichu-mb v_xemthem"><span><a href="'.$srcCourse.'">Xem thêm</a></span></div>
    </div>
    </div>
    </div>';
    $start++;
}
$data = [
    'html'=>$html
];

echo json_encode($data);
?>