<?php
require_once '../config/config.php';
$arr = getValue('arr', 'arr', 'GET', '');

if (isset($_COOKIE['user_id'])) {
    $id = $_COOKIE['user_id'];
}else{
    $id = 0;
}
$type = getValue('type', 'int', 'GET', '');

$p = getValue('p', 'int', 'GET', '');

$cate_id = getValue('cate_id', 'int', 'GET', '');

$tag_id = getValue('tag_id', 'int', 'GET', '');

$teacher_id = getValue('teacher_id', 'int', 'GET', '');

$prices = getValue('prices', 'int', 'GET', '');

$address = getValue('address', 'int', 'GET', '');


if ($prices == 0) {
    $qrPrices = ' ORDER BY courses.course_id DESC ';
}else if ($prices == 1) {
    $qrPrices = " ORDER BY courses.price_listed DESC ";
}else if ($prices == 2) {
    $qrPrices = " ORDER BY courses.price_listed ASC ";
}

if ($address == 0) {
    $qrCit = [
        'condition'=>'',
        'query'=>''
    ];
}else{
    $qrCit = [
        'condition'=>' AND course_basis.cit_id = ' . $address,
        'query'=>' INNER JOIN course_basis ON courses.course_id = course_basis.course_id '
    ];
}

$number_p = 6;

if ($p == 1) {
    $start = 0;
    $end = 6;
}else{
    $start = $number_p * ($p - 1 );
    $end = 6;
}
$whereprice = " AND courses.price_listed != 0";
if ($type == 0) {
    if ($arr != "") {
        if (isset($arr['cate_id'])) {
            $cate_id = $arr['cate_id'];
            if (!isset($arr['cit_id'])) {
                $qrCourse = new db_query("SELECT * FROM courses JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE courses.cate_id = '$cate_id' AND courses.course_type = 1 AND hide_course = 1 AND accept = 1 ORDER BY courses.course_id DESC LIMIT $start,6");
                $qrCount = new db_query("SELECT course_id FROM courses WHERE cate_id = '$cate_id' AND course_type = 1 AND hide_course = 1 AND accept = 1");
            }else{
                $cit_id = $arr['cit_id'];
                $qrCourse = new db_query("SELECT * FROM courses JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id JOIN course_basis ON courses.course_id = course_basis.course_id WHERE courses.cate_id = $cate_id AND hide_course = 1 AND accept = 1 AND courses.course_type = 1 AND course_basis.cit_id = $cit_id ORDER BY courses.course_id DESC LIMIT 0,6");
                $qrCount = new db_query("SELECT courses.course_id FROM courses INNER JOIN course_basis ON courses.course_id = course_basis.course_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.course_type = 1 AND hide_course = 1 AND accept = 1");
            }
        }else if (isset($arr['tag_id'])) {
            $tag_id = $arr['tag_id'];
            if (!isset($arr['cit_id'])) {
                $qrCourse = new db_query("SELECT * FROM courses JOIN levels ON courses.level_id = levels.level_id JOIN tags ON courses.tag_id = tags.tag_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE courses.tag_id = '$tag_id' AND courses.course_type = 1 AND hide_course = 1 AND accept = 1 ORDER BY courses.course_id DESC LIMIT 0,6");
                $qrCount = new db_query("SELECT course_id FROM courses JOIN tags ON courses.tag_id = tags.tag_id WHERE courses.tag_id = '$tag_id' AND courses.course_type = 1 AND hide_course = 1 AND accept = 1");
            }else{
                $cit_id = $arr['cit_id'];
                $qrCourse = new db_query("SELECT * FROM courses JOIN levels ON courses.level_id = levels.level_id JOIN tags ON courses.tag_id = tags.tag_id JOIN course_basis ON courses.course_id = course_basis.course_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE courses.tag_id = '$tag_id' AND course_basis.cit_id = '$cit_id' AND courses.course_type = 1 AND hide_course = 1 AND accept = 1 ORDER BY courses.course_id DESC LIMIT 0,6");
                $qrCount = new db_query("SELECT courses.course_id FROM courses JOIN tags ON courses.tag_id = tags.tag_id JOIN course_basis ON courses.course_id = course_basis.course_id WHERE courses.tag_id = '$tag_id' AND course_basis.cit_id = '$cit_id' AND courses.course_type = 1 AND hide_course = 1 AND accept = 1");
            }
        }else if(isset($arr['keyword'])){
            $key = $arr['keyword'];
            if (!isset($arr['cit_id'])) {
                $qrCourse = new db_query("SELECT * FROM courses JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE course_name LIKE '%$key%' AND courses.course_type = 1 AND hide_course = 1 AND accept = 1 ORDER BY courses.course_id DESC LIMIT 0,6");
                $qrCount = new db_query("SELECT course_id FROM courses WHERE course_name LIKE '%$key%' AND courses.course_type = 1 AND hide_course = 1 AND accept = 1");
            }else{
                $cit_id = $arr['cit_id'];
                $qrCourse = new db_query("SELECT * FROM courses JOIN levels ON courses.level_id = levels.level_id JOIN course_basis ON courses.course_id = course_basis.course_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE courses.course_name LIKE '%$key%' AND course_basis.cit_id = '$cit_id' AND courses.course_type = 1 AND hide_course = 1 AND accept = 1 ORDER BY courses.course_id DESC LIMIT 0,6");
                $qrCount = new db_query("SELECT * FROM courses JOIN course_basis ON courses.course_id = course_basis.course_id WHERE courses.course_name LIKE '%$key%' AND course_basis.cit_id = '$cit_id' AND courses.course_type = 1 AND hide_course = 1 AND accept = 1");
            }
        }else if (isset($arr['cit_id'])) {
            $cit_id = $arr['cit_id'];
            $qrCourse = new db_query("SELECT * FROM courses JOIN levels ON courses.level_id = levels.level_id JOIN course_basis ON courses.course_id = course_basis.course_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON courses.user_id = users.user_id WHERE course_basis.cit_id = '$cit_id' AND courses.course_type = 1 AND hide_course = 1 AND accept = 1 ORDER BY courses.course_id DESC LIMIT 0,6");
            $qrCount = new db_query("SELECT * FROM courses JOIN course_basis ON courses.course_id = course_basis.course_id WHERE course_basis.cit_id = '$cit_id' AND courses.course_type = 1 AND hide_course = 1 AND accept = 1");
        }
    }else{
        $qr = "SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON users.user_id = courses.user_id" . $qrCit['query'] . " WHERE courses.course_type = 1 AND hide_course = 1 AND accept = 1 " . $qrCit['condition'] . $qrPrices . "LIMIT $start,$end";
        $qrCourse = new db_query($qr);
        $qrC = "SELECT * FROM courses". $qrCit['query'] ." WHERE courses.course_type = 1 AND hide_course = 1 AND accept = 1 " . $qrCit['condition'];
        $qrCount = new db_query($qrC);
    }
}else if ($type == 1){
    $qr ="SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON users.user_id = courses.user_id" . $qrCit['query'] . " WHERE courses.course_type = 1 AND hide_course = 1 AND accept = 1 AND courses.cate_id = ". $cate_id . $qrCit['condition'] . $qrPrices . "LIMIT $start,$end";
    $qrCourse = new db_query($qr);

    $qrC = "SELECT * FROM courses" . $qrCit['query'] . " WHERE course_type = 1 AND hide_course = 1 AND accept = 1 AND cate_id = '$cate_id'". $qrCit['condition'];
    $qrCount = new db_query($qrC);
}else if ($type == 2) {
    $qr = "SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON users.user_id = courses.user_id INNER JOIN tags ON courses.tag_id = tags.tag_id" . $qrCit['query'] . " WHERE courses.course_type = 1 AND hide_course = 1 AND accept = 1 AND courses.tag_id = ". $tag_id . $qrCit['condition'] . $qrPrices . "LIMIT $start,$end";
    $qrCourse = new db_query($qr);

    $qrC = "SELECT * FROM courses INNER JOIN tags ON courses.tag_id = tags.tag_id" . $qrCit['query'] . " WHERE course_type = 1 AND hide_course = 1 AND accept = 1 AND courses.tag_id = '$tag_id'" . $qrCit['condition'];
    $qrCount = new db_query($qrC);
}else if ($type == 3) {
    $qr = "SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON users.user_id = courses.user_id" . $qrCit['query'] . " WHERE courses.course_type = 1  AND hide_course = 1 AND accept = 1 AND courses.cate_id = ". $cate_id . " AND courses.user_id = " . $teacher_id . $qrCit['condition'] . $qrPrices . "LIMIT $start,$end";
    $qrCourse = new db_query($qr);
    $qrC = "SELECT * FROM courses" . $qrCit['query'] . " WHERE course_type = 1 AND hide_course = 1 AND accept = 1 AND courses.cate_id = '$cate_id' AND courses.user_id = " . $teacher_id . $qrCit['condition'];
    $qrCount = new db_query($qrC);
}else if ($type == 4) {
   $qr = "SELECT * FROM courses INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON users.user_id = courses.user_id" . $qrCit['query'] . " WHERE courses.course_type = 1 AND hide_course = 1 AND accept = 1 AND courses.tag_id = ". $tag_id . " AND courses.user_id = " . $teacher_id . $qrCit['condition'] . $qrPrices . "LIMIT $start,$end";
   $qrCourse = new db_query($qr);

   $qrC = "SELECT * FROM courses" . $qrCit['query'] . " WHERE course_type = 1 AND hide_course = 1 AND accept = 1 AND courses.tag_id = '$tag_id' AND courses.user_id = " . $teacher_id . $qrCit['condition'];

   $qrCount = new db_query($qrC);
}

if ($type == 1 || isset($arr['cate_id'])) {
    if (isset($arr['cate_id'])) {
        $cate_id = $arr['cate_id'];
    }
    $qrCate = new db_query("SELECT * FROM tags WHERE cate_id = '$cate_id'");

    $cate_detail = '<option value="0">MÔN HỌC CHI TIẾT</option>';
    while ($rowCate = mysql_fetch_array($qrCate->result)) {
        $cate_detail = $cate_detail . '<option value="'. $rowCate['tag_id'] .'">'. $rowCate['tag_name'] .'</option>';
    }

    $qrGV = new db_query("SELECT user_id, user_name, cate_id FROM users WHERE user_type = 2 OR user_type = 3");
    $arr_teacher2 = [];
    $teacher = '<option value="0">GIẢNG VIÊN</option>';
    while ($rowGV = mysql_fetch_array($qrGV->result)) {
      $cate = explode(",", $rowGV['cate_id']);
      for ($i = 0; $i < count($cate); $i++) {
        if ($cate[$i] == $cate_id) {
          $arr_teacher2[$rowGV['user_id']]['user_id'] = $rowGV['user_id'];
          $arr_teacher2[$rowGV['user_id']]['user_name'] = $rowGV['user_name'];
        }
      }
    }

  foreach ($arr_teacher2 as $key => $value) {
    $teacher = $teacher . '<option value="'.$value['user_id'].'">'.$value['user_name'].'</option>';
  }

}else if ($type == 0) {
    $cate_detail = '<option value="0">MÔN HỌC CHI TIẾT</option>';
    $teacher = '<option value="0">GIẢNG VIÊN</option>';
}else{
    $cate_detail = '';
    $teacher = '';
}

$html = '';
if (mysql_num_rows($qrCount->result) == 0) {
    $html = "<div class='no-cmt'>Không có danh sách</div>";
    $v_paging = '';
}else{
    while ($row = mysql_fetch_array($qrCourse->result)) {
        $qrTag = new db_query("SELECT tag_name FROM tags WHERE tag_id = " . $row['tag_id']);
        if (mysql_num_rows($qrTag->result) > 0) {
            $rowTag = mysql_fetch_array($qrTag->result);
            $tag_name = '<div class="item">
            <img src="../img/categories/'.$row['cate_icon'].'"><span>'.$rowTag['tag_name'].'</span>
            </div>';
        }else{
            $tag_name = '';
        }

        if ($row['user_type'] == 2) {
            $srcTeach = urlDetail_teacher($row['user_id'], $row['user_slug']);
        }else if($row['user_type'] == 3){
            $srcTeach = urlDetail_center($row['user_id'], $row['user_slug']);
        }
        $cate_id = $row['cate_id'];

        $qrS = new db_query("SELECT save_id FROM save_course WHERE user_student_id = '$id' AND course_id = " . $row['course_id']);
        if (mysql_num_rows($qrS->result) == 0) {
            $srcS = '../img/image/wpf_like (3).svg';
        }else{
            $srcS = '../img/heart-yellow2.svg';
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

        if ($row['certification'] == 1) {
            $cer = "Cấp chứng chỉ";
        }else{
            $cer = "Không cấp chứng chỉ";
        }

        $num2 = new db_query("SELECT course_id FROM order_student_common WHERE course_id = $course_id");
        $num3 = new db_query("SELECT course_id FROM orders WHERE course_id = $course_id");

        $num5 = new db_query("SELECT course_id FROM rate_course WHERE course_id = $course_id");

        if(isset($_COOKIE['user_id'])){
            $course_id = $row['course_id'];
            $cookie_id = $_COOKIE['user_id'];
            $db_order = new db_query("SELECT course_id,user_student_id FROM orders WHERE user_student_id = $cookie_id AND course_id=$course_id");
            if (mysql_num_rows($db_order->result)>0) {
                $v_buy = '<div class="buy-now2">
                <a>ĐÃ ĐẶT CHỖ</a>
                </div>';
            }else{
                $pri = "";
                $v_buy = '<div class="buy-now" onclick="v_datcho('.$course_id.')" id="v_course'.$course_id.'">
                <a>ĐẶT CHỖ</a>
                '.$pri.'
                </div>';
            }
        }else{
            $v_buy = '<div class="buy-now">
            <a data-toggle="modal" data-target="#modal-login">ĐẶT CHỖ</a>
            </div>';
        }

        $html = $html . '<div class="product-item">
        <div class="product-img">
        <a href="'.urlDetail_courseOffline($row['course_id'],$row['course_slug']).'"><img class="img-main" onerror=\'this.onerror=null;this.src="../img/avatar/error.png";\'
        src="../img/course/'.$row['course_avatar'].'"></a>
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
        
        $html = $html .'<span>'.round($total_rate, 1).'('. mysql_num_rows($num5->result) .')</span>
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
        <img src="../img/image/clock.svg" width="16px" height="16px"><span>'.$row['month_study'].' tháng</span>
        </div>';

        $html = $html . $tag_name .'</div>
        <hr>
        <div class="prd-buy" id="prd-buy'.$course_id.'">
        <div class="prices">';

        if ($row['price_promotional'] == -1) {
            $html = $html . '<p>'.number_format($row['price_listed']) . ' đ'.'</p>';
        }else{
            $html = $html . '<p>'.number_format($row['price_promotional']) . ' đ'.'</p>
            <span style="height: 17.78px;">'.number_format($row['price_listed']). ' đ'.'</span>';
        }

        $html = $html .'</div>'. $v_buy .'
        </div>
        </div>
        </div>';
    }

    $v_paging =  '<nav aria-label="Page navigation example" class="paginate-product-detail">
    <ul class="pagination">
    <li class="page-item page-link" onclick="v_pag_offline(\'preview\',' . $type . ')">
    &laquo;
    </li>
    <li class="page-item v_paging page-link" id="v_paging-1" onclick="v_pag_offline(1,'. $type .')">1</li>';

    for ($i = 2; $i < (mysql_num_rows($qrCount->result)/6 + 1); $i++) {
        $v_paging = $v_paging . '<li class="page-item v_paging page-link" id="v_paging-'. $i .'" onclick="v_pag_offline('. $i .','. $type .')">'.$i.'</li>';
    }

    $v_paging = $v_paging . '<li class="page-item page-link" onclick="v_pag_offline(\'next\',' . $type . ')">
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