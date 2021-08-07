<?php
require_once '../config/config.php';
$arr = getValue('arr','arr','GET','');
if (isset($_COOKIE['user_id'])) {
  $id = $_COOKIE['user_id'];
}else{
  $id = 0;
}

$type = getValue('type', 'int', 'GET', '');

$p = getValue('p', 'int', 'GET', '');

$cate_id = getValue('cate_id', 'int', 'GET', '');

$tag_id = getValue('course_id', 'int', 'GET', '');

$teacher_id = getValue('teacher_id', 'int', 'GET', '');

$prices = getValue('prices', 'int', 'GET', '');

if ($prices == 0) {
  $qrPrices = 'ORDER BY courses.course_id DESC';
}else if ($prices == 1) {
  $qrPrices = "ORDER BY courses.price_promotional DESC";
}else if ($prices == 2) {
  $qrPrices = "ORDER BY courses.price_promotional ASC";
}

$number_p = 6;

if ($p == 1 || $p == 0) {
 $start = 0;
 $end = 6;
}else{
 $start = $number_p * ($p - 1 );
 $end = 6;
}

if ($type == 0) {
  if ($arr != "") {
    if (isset($arr['tag_id'])) {
      $tag_id = $arr['tag_id'];
      $qrCourse = new db_query("SELECT * FROM courses JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON users.user_id = courses.user_id WHERE courses.course_type = 2 AND courses.tag_id = '$tag_id' ORDER BY courses.course_id DESC LIMIT $start, $end");
      $qrCount = new db_query("SELECT course_id FROM courses WHERE course_type = 2 AND tag_id = '$tag_id'");
    }else if (isset($arr['keyword'])) {
      $key = $arr['keyword'];
      $qrCourse = new db_query("SELECT * FROM courses JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON users.user_id = courses.user_id WHERE courses.course_type = 2 AND courses.course_name LIKE '%$key%' ORDER BY courses.course_id DESC LIMIT $start, $end");
      $qrCount = new db_query("SELECT course_id FROM courses WHERE course_type = 2 AND course_name LIKE '%$key%'");
    }else if (isset($arr['cate_id'])) {
      $cate_id = $arr['cate_id'];
      $qrCourse = new db_query("SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE courses.course_type = 2 AND courses.cate_id = $cate_id ORDER BY courses.course_id DESC LIMIT $start, $end");
      $qrCount = new db_query("SELECT course_id FROM courses WHERE course_type = 2 AND cate_id = $cate_id");
    }
  }else{
    $qr = "SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE courses.course_type = 2 ". $qrPrices. " LIMIT $start,$end";
    $qrCourse = new db_query($qr);
    $qrCount = new db_query("SELECT * FROM courses WHERE course_type = 2");
  }
}else if ($type == 1){
  $qr ="SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE courses.course_type = 2 AND courses.cate_id = '$cate_id' ". $qrPrices. " LIMIT $start,$end";
  $qrCourse = new db_query($qr);
  $qrCount = new db_query("SELECT course_id FROM courses WHERE course_type = 2 AND cate_id = '$cate_id'");
}else if ($type == 2) {
  $qr = "SELECT * FROM courses INNER JOIN tags ON courses.tag_id = tags.tag_id INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE course_type = 2 AND courses.tag_id = '$tag_id' " . $qrPrices . " LIMIT $start,$end";
  $qrCourse = new db_query($qr);
  $qrCount = new db_query("SELECT course_id FROM courses INNER JOIN tags ON courses.tag_id = tags.tag_id WHERE course_type = 2 AND courses.tag_id = '$tag_id'");
}else if ($type == 3) {
  $qr = "SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE courses.course_type = 2 AND courses.user_id = $teacher_id AND courses.cate_id = $cate_id ". $qrPrices ." LIMIT $start,$end";
  $qrCourse = new db_query($qr);
  $qrCount = new db_query("SELECT course_id FROM courses WHERE course_type = 2 AND user_id = '$teacher_id' AND cate_id = '$cate_id'");
}else if ($type == 4) {
 $qr = "SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id INNER JOIN tags ON courses.tag_id = tags.tag_id WHERE courses.course_type = 2 AND courses.user_id = $teacher_id AND courses.cate_id = $cate_id AND courses.tag_id = '$tag_id'". $qrPrices ." LIMIT $start,$end";
 $qrCourse = new db_query($qr);

 $qrCount = new db_query("SELECT course_id FROM courses INNER JOIN tags ON courses.tag_id = tags.tag_id WHERE course_type = 2 AND courses.user_id = '$teacher_id' AND courses.cate_id = '$cate_id' AND courses.tag_id = '$tag_id'");
}else if ($type == 5) {
  $qr = "SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE courses.course_type = 2 AND courses.user_id = $teacher_id ". $qrPrices ." LIMIT $start,$end";
  $qrCourse = new db_query($qr);
  $qrCount = new db_query("SELECT course_id FROM courses WHERE course_type = 2 AND user_id = $teacher_id");
}

$cate_detail = "";
$teacher = "";
if ($type == 1) {
  $qrCate = new db_query("SELECT * FROM tags WHERE cate_id = '$cate_id'");

  $cate_detail = $cate_detail . '<option value="0">MÔN HỌC CHI TIẾT</option>';
  while ($rowCate = mysql_fetch_array($qrCate->result)) {
    $cate_detail = $cate_detail . '<option value="'. $rowCate['tag_id'] .'">'. $rowCate['tag_name'] .'</option>';
  }

  $cate = $cate_id . ",";

  $qrGV = new db_query("SELECT user_id, user_name FROM users WHERE cate_id LIKE '%$cate%' AND (user_type = 2 OR user_type = 3)");
  $teacher = $teacher . '<option value="0">GIẢNG VIÊN</option>';
  while ($rowGV = mysql_fetch_array($qrGV->result)) {
    $teacher = $teacher . '<option value="'. $rowGV['user_id'] .'">'. $rowGV['user_name'] .'</option>';
  }

}else if ($type == 0) {
  $cate_detail = '<option value="0">MÔN HỌC CHI TIẾT</option>';
  $teacher = '<option value="0">GIẢNG VIÊN</option>';
}

$html = "";

if (mysql_num_rows($qrCount->result) == 0) {
  $html = "<div class='no-cmt'>Không có danh sách</div>";
  $v_paging = '';
}else{
  while ($row = mysql_fetch_array($qrCourse->result)) {
    if ($row['user_type'] == 2) {
     $srcTeach = urlDetail_teacher($row['user_id'], $row['user_slug']);
   }else if($row['user_type'] == 3){
     $srcTeach = urlDetail_center($row['user_id'], $row['user_slug']);
   }

   if (!isset($_COOKIE['user_id'])) {
    $src = '../img/image/wpf_like (3).svg';
    $status = 0;
  }else{
   $course_offline_id = $row['course_id'];
   if (isset($_COOKIE['user_id'])) {
    $cookie_id = $_COOKIE['user_id'];
  }
}
$status = 1;

$qrS = new db_query("SELECT save_id FROM save_course WHERE user_student_id = '$id' AND course_id = " . $row['course_id']);
if (mysql_num_rows($qrS->result) == 0) {
  $srcS = '../img/image/wpf_like (3).svg';
}else{
  $srcS = '../img/heart-yellow2.svg';
}

$price = $row['price_listed'] - $row['price_promotional'];
if ($price == $row['price_listed']) {
 $v_style = 'display: none;';
}else{
 $v_style = '';
}

if ($row['certification'] == 1) {
  $cer = "Cấp chứng chỉ";
}else{
  $cer = "Không cấp chứng chỉ";
}

if(isset($_COOKIE['user_id'])){
 $course_id = $row['course_id'];
 $cookie_id = $_COOKIE['user_id'];
 $db_order = new db_query("SELECT course_id,user_student_id FROM orders WHERE user_student_id = $cookie_id AND course_id=$course_id");
 if (mysql_num_rows($db_order->result)>0) {
  $v_buy = '<div class="buy-now2">
  <a>ĐÃ MUA</a>
  </div>';
}else{
 $pri = "";
 $v_buy = '<div class="buy-now">
 <a href="'.urlOrders($cookie_id, $course_id).'">MUA NGAY</a>
 '.$pri.'
 </div>';
}
}else{
 $v_buy = '<div class="buy-now">
 <a data-toggle="modal" data-target="#modal-login">MUA NGAY</a>
 </div>';
}

$course_id = $row['course_id'];
$qrrate = new db_query("SELECT Count(*) as total FROM rate_course WHERE course_id = $course_id");
$rowcount=mysql_fetch_array($qrrate->result);
$numrate = $rowcount['total'];
if ($numrate >0) {
  if ($row['course_type']==1) {
    $qrsum = new db_query("SELECT (sum(lesson)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
    $rowsum = mysql_fetch_array($qrsum->result);
    $sumall = $rowsum['(sum(lesson)+sum(teacher))']/2;
    $total_rate = $sumall/$numrate;
  } elseif ($row['course_type']==2) {
    $qrsum = new db_query("SELECT (sum(lesson)+sum(video)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
    $rowsum = mysql_fetch_array($qrsum->result);
    $sumall = $rowsum['(sum(lesson)+sum(video)+sum(teacher))']/3;
    $total_rate = $sumall/$numrate;
  }
}else{
  $total_rate = 0;
}

$num2 = new db_query("SELECT course_id FROM order_student_common WHERE course_id = $course_id");
$num3 = new db_query("SELECT course_id FROM orders WHERE course_id = $course_id");

$num5 = new db_query("SELECT course_id FROM rate_course WHERE course_id = $course_id");
$html = $html . '<div class="product-item">
<div class="product-img">
<img class="img-main" onerror=\'this.onerror=null;this.src="../img/avatar/error.png";\'
src="../img/course/'.$row['course_avatar'].'">
<div class="detail">
<div class="detai-img">
<img onerror=\'this.onerror=null;this.src="../img/avatar/error.png";\' src="../img/avatar/'.$row['user_avatar'].'" alt="Ảnh lỗi">

</div>
<div class="detai-item">
<a href="#">
<a href="'.$srcTeach.'"><p class="detai-item1">'.$row['user_name'].'</p></a>
<p class="detai-item2">'.$row['cate_name'].'</p>
</a>

</div>
</div>
<div class="like">
<button class="like-product" onclick="v_save_course(this)" value="'.$row['course_id'].'">
<img src="'.$srcS.'">
</button>
</div>
</div>
<div class="product-info">
<div class="prd-name">
<a
href="'.urlDetail_courseOffline($row['course_id'],$row['course_slug']).'">
<p class="prd-name-p">'.$row['course_name'].'</p>
</a>
</div>
<div class="star-rate">';

  if ($total_rate > 0) {
      for ($i = 1; $i <= $total_rate; $i++) {
          $html = $html . '<img src="../img/image/star.svg" alt="Ảnh lỗi">';
      }
  }else{
      $html .= 'Chưa có đánh giá';
  }

$html = $html . '
<span>'.round($total_rate,1). '(' . mysql_num_rows($num5->result) .')</span>
</div>
<div class="prd-status">
<p>'.(mysql_num_rows($num2->result) + mysql_num_rows($num3->result)).' học viên mua</p>
</div>
<div class="prd-item">
<div class="item">
<img src="../img/nguoi-moi.svg"><span>'.$row['level_name'].'</span>
</div>
<div class="item">
<img src="../img/chung-chi.svg"><span>'.$cer.'</span>
</div>
<div class="item">
<img src="../img/categories/'.$row['cate_icon'].'"><span>'.$row['cate_name'].'</span>
</div>
</div>
<hr>
<div class="prd-buy">
<div class="prices">
<p>'. number_format($row['price_promotional']) . ' đ'. '</p>
<span
style="height: 17.78px;">'.number_format($row['price_listed']). ' đ'.'</span>
</div>'. $v_buy .'
</div>
</div>
</div>';
}
$v_paging =  '<nav aria-label="Page navigation example">
<ul class="pagination">
<li class="page-item page-link" onclick="v_pag_online(\'preview\',' . $type . ')">
&laquo;
</li>
<li class="page-item v_paging page-link" id="v_paging-1" onclick="v_pag_online(1,'. $type .')">1</li>';

for ($i = 2; $i < (mysql_num_rows($qrCount->result)/6 + 1); $i++) {
  $v_paging = $v_paging . '<li class="page-item v_paging page-link" id="v_paging-'. $i .'" onclick="v_pag_online('. $i .','. $type .')">'.$i.'</li>';
}

$v_paging = $v_paging . '<li class="page-item page-link" onclick="v_pag_online(\'next\',' . $type . ')">
&raquo;
</li>
</ul>
</nav>';
}

$arr = [
  'html'=>$html,
  'v_paging'=>$v_paging,
  'cate_detail'=>$cate_detail,
  'teacher'=>$teacher
];

echo json_encode($arr);
?>