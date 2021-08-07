<?php
require_once '../config/config.php';

$p = getValue('p','int','GET','');

$course_type = getValue('course_type','int','GET','');

if (!isset($_COOKIE['user_id'])) {
    $user_id = 0;
}else{
    $user_id = $_COOKIE['user_id'];
}

$html = '';
$qrOff = new db_query("SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN users ON users.user_id = courses.user_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.course_type = 2 AND courses.price_listed != 'false' AND courses.hide_course = 1 AND courses.accept = 1 ORDER BY courses.course_id DESC LIMIT $p,6");
while ($rowOff = mysql_fetch_array($qrOff->result)) {
    $course_id = $rowOff['course_id'];

    if ($rowOff['user_type'] == 2) {
        $linkct = urlDetail_teacher($rowOff['user_id'], $rowOff['user_slug']);
    }else if ($rowOff['user_type'] == 3) {
        $linkct = urlDetail_center($rowOff['user_id'], $rowOff['user_slug']);
    }


    if ($rowOff['certification'] == 1) {
        $cer = "Cấp chứng chỉ";
    }else{
       $cer = "Không cấp chứng chỉ";
   }

   $qrSave = new db_query("SELECT save_id FROM save_course WHERE user_student_id = $user_id AND course_id = " . $rowOff['course_id']);
   $rowSave = mysql_num_rows($qrSave->result);
   if ($rowSave == 0) {
    $srcS = '../img/image/wpf_like (3).svg';
}else{
    $srcS = '../img/heart-yellow2.svg';
}

$qrrate = new db_query("SELECT Count(*) as total FROM rate_course WHERE course_id = $course_id");
$rowcount=mysql_fetch_array($qrrate->result);
$numrate = $rowcount['total'];
if ($numrate >0) {
    if ($rowOff['course_type']==1) {
        $qrsum = new db_query("SELECT (sum(lesson)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
        $rowsum = mysql_fetch_array($qrsum->result);
        $sumall = $rowsum['(sum(lesson)+sum(teacher))']/2;
        $total_rate = $sumall/$numrate;
    } elseif ($rowOff['course_type']==2) {
        $qrsum = new db_query("SELECT (sum(lesson)+sum(video)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
        $rowsum = mysql_fetch_array($qrsum->result);
        $sumall = $rowsum['(sum(lesson)+sum(video)+sum(teacher))']/3;
        $total_rate = $sumall/$numrate;
    }
}else{
    $total_rate = 0;
}

$star = '';
for ($i = 1; $i <= $total_rate; $i++) {
    $star = $star + '<img src="../img/bi_star-fill.png" alt="Ảnh lỗi">';
}

$num5 = new db_query("SELECT course_id FROM rate_course WHERE course_id = $course_id");
$num2 = new db_query("SELECT course_id FROM order_student_common WHERE course_id = $course_id");
$num3 = new db_query("SELECT course_id FROM orders WHERE course_id = $course_id");

if(isset($_COOKIE['user_type'])){
    if(isset($user_id) && $_COOKIE['user_type']==1){
        $db_order = new db_query("SELECT course_id,user_student_id FROM orders WHERE user_student_id = $user_id AND course_id=$course_id");
        if (mysql_num_rows($db_order->result)>0) {
            if ($course_type == 1) {
                $buy = '<div class="buy-now2">
                <a>ĐÃ ĐẶT CHỖ</a>
                </div>';
            }else{
                $buy = '<div class="buy-now2">
                <a>ĐÃ MUA</a>
                </div>';
            }
        }else{
            if ($course_type == 2) {
                $buy = '<a class="buy-now" href="'.urlOrders($user_id, $course_id).'">
                <span>MUA NGAY</span>
                </a>';
            }else{
                $buy = '<div class="buy-now buy_now'.$rowOff['course_id'].'" onclick="v_datcho('.$rowOff['course_id'].')">
                <a>ĐĂT CHỖ</a>
                </div>';
            }
        }
    }else{
        $buy = '<div class="buy-now" data-toggle="modal" data-target="#modal-login">
        <a>MUA NGAY</a>
        </div>';
    }
}else{
$buy = '<div class="buy-now" data-toggle="modal" data-target="#modal-login">
    <a>MUA NGAY</a>
</div>';
}

$html = $html . '<div class="product-item">
    <div class="product-img">
        <img onerror=\'this.onerror=null;this.src="../img/avatar/error.png" ;\' class="img-main"
            src="../img/course/'.$rowOff['course_avatar'].'" alt="">
        <div class="detail">
            <div class="detai-img">

                <img onerror=\'this.onerror=null;this.src="../img/avatar/error.png" ;\'
                    src="../img/avatar/'.$rowOff['user_avatar'].'" alt="">
            </div>
            <div class="detai-item">
                <a href="'.$linkct.'">
                    <p class="detai-item1">'.$rowOff['user_name'].'</p>
                </a>
                <p class="detai-item2">'.$rowOff['cate_name'].'</p>
            </div>
        </div>
        <div class="like">
            <img class="like-product v_save'.$rowOff['course_id'].'" onclick="v_save_course('.$rowOff['course_id'].')"
                src="'.$srcS.'">
        </div>
    </div>
    <div class="product-info">
        <div class="prd-name">
            <a href="'.urlDetail_courseOffline($rowOff['course_id'],$rowOff['course_slug']).'">
                <p>'.$rowOff['course_name'].'</p>
            </a>
        </div>
        <div class="star-rate">'
            .$star.'
            <span>'.round($total_rate, 1).' ('.mysql_num_rows($num5->result).')
            </span>
        </div>
        <div class="prd-status">
            <p>'. (mysql_num_rows($num2->result) + mysql_num_rows($num3->result)).' học viên đã mua</p>
        </div>
        <div class="prd-item">
            <div class="item">
                <img src="../img/nguoi-moi.svg"><span>'.$rowOff['level_name'].'</span>
            </div>
            <div class="item">
                <img src="../img/chung-chi.svg"><span>'.$cer.'</span>
            </div>
            <div class="item">
                <img class=" lazyloaded" src="../img/image/clock.svg" width="16px" height="16px" data-src="../img/image/clock.svg"><span>'.$rowOff['month_study'].' tháng</span>
            </div>
            <div class="item">
                <img src="../img/categories/'.$rowOff['cate_icon'].'"><span>'.$rowOff['cate_name'].'</span>
            </div>
        </div>
        <hr>
        <div class="prd-buy">
            <div class="prices">';
                if ($rowOff['price_promotional'] != 'false') {
                    $html = $html . '<p>'.number_format($rowOff['price_promotional']) . ' đ'.'</p>
                <span style="height: 17.78px;">'.number_format($rowOff['price_listed']). ' đ'.'</span>';
                }else{
                    $html = $html . '<p>'.number_format($rowOff['price_listed']) . ' đ'.'</p>';
                }
            $html = $html . '</div>'.$buy.'

        </div>
    </div>
</div>';
}

$more = '<a id="xemthem-online" onclick="xemthem_offline('. ($p + 6) . ',' . $course_type .')"> XEM THÊM</a>';
$arr = [
'html'=>$html,
'more'=>$more
];
echo json_encode($arr);
