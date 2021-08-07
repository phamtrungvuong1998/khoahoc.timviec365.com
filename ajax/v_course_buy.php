<?php
require '../config/config.php';

$number = getValue('number','int','GET','');

$type = getValue('type','int','GET','');

$start = ($number - 1) * 10;

$user_id = $_COOKIE['user_id'];

$qr = new db_query("SELECT * FROM orders INNER JOIN courses ON orders.course_id = courses.course_id INNER JOIN users ON courses.user_id = users.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.course_type = '$type' AND orders.user_student_id = '$user_id' ORDER BY order_id DESC LIMIT $start,10");

$start = $start + 1;

$html = '';
while ($row = mysql_fetch_array($qr->result)) {
  if ($row['user_type'] == 2) {
    $linkT = urlDetail_teacher($row['user_id'],$row['user_slug']);
  }else{
    $linkT = urlDetail_center($row['user_id'],$row['user_slug']);
  }

  if ($row['course_type'] == 1) {
    $linkCourse = urlDetail_courseOffline($row['course_id'],$row['course_slug']);
    $order_status = 'Đã đặt chỗ';
    $a = "XEM THÊM";
    $b = "Xem thêm";
  }else if ($row['course_type'] == 2){
    $linkCourse = urlDetail_courseOnline($row['course_id'],$row['course_slug']);
    if ($row['order_status'] == 0) {
      $order_status = 'Chưa học';
    }else if($row['order_status'] == 1){
      $order_status = 'Đang học';
    }else if($row['order_status'] == 1){
      $order_status = 'Kết thúc';
    }
    $a = "XEM BÀI GIẢNG";
    $b = "Xem bài giảng";
  }

  if ($row['price_promotional'] == -1) {
    $price = $row['price_listed'];
  }else{
    $price = $row['price_promotional'];
  }
  $html = $html . '<div class="v_noidungkh">
  <div class="v_table-cell v_stt">'. $start .'</div>
  <div class="v_table-cell v_content-list v_monhoc"><a href="'.$linkCourse.'">'.$row['course_name'].'</a></div>
  <div class="v_table-cell v_content-list">'. $row['cate_name'] .'</div>
  <div class="v_table-cell v_content-list v_teacher_center"><a href="'.$linkT.'">'.$row['user_name'].'</a></div>
  <div class="v_table-cell v_content-list">'. number_format($price) . ' đ' .'</div>
  <div class="v_table-cell v_content-list v_ngaydk">'.date("d-m-Y", $row['created_at']).'</div>
  <div class="v_table-cell v_content-list">'.$order_status.'</div>
  <div class="v_table-cell v_content-list v_bacham">
  <button class="v_btn-bacham" onclick="v_popup(this)"><img
  src="../img/More.svg" alt="Ảnh lỗi"></button>
  <div class="v_popup" id="v_popup-'.$row['order_id'].'">
  <center><a href="'.$linkCourse.'"><button class="v_btn-del">'.$a.'</button></a></center>
  </div>
  </div>
  </div>';
  $html = $html . '<div class="v_content-mb">
  <div class="flex v_content-mb-div">
  <p class="v_content-mb-stt">'.$start . '.' .'</p>
  <a class="v_content-mb-title" href="'.$linkCourse.'">
  '.$row['course_name'].'
  </a>
  </div>
  <a class="v_tengiangvien" href="'.$linkT.'">'.$row['user_name'].'</a>

  <div class="flex v_info-all v_content-mb-div">
  <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Ngày đăng kí
  :</span>'.date("d-m-Y", $row['created_at']).'</div>
  <div class="v_content-mb-thongtin"><span class="v_content-mb-span">học phí :</span> '.number_format($price) . ' đ'.'
  </div>
  <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Môn học :</span> '. $row['cate_name'] .'
  </div>
  </div>

  <div class="flex v_mb-ghichu-all v_content-mb-div">
  <div class="v_ghichu-mb v_xemthem"><i><a href="'.$linkCourse.'">'.$b.'</a></i></div>
  </div>
  </div>';

  $start++;
}
$data = [
  'html'=>$html
];

echo json_encode($data);
?>