 <div class="feature-product">
     <div class="all-product" id="all-product">
         <?php
       if ($v_row_count == 0) {
           echo "<div class='no-cmt'>Không có danh sách</div>";
       }else{
        while ($row = mysql_fetch_array($qr->result)) {
            $course_id = $row['course_id'];
            if ($row['certification'] == 1) {
                $cer = "Cấp chứng chỉ";
            }else{
                $cer = "Không cấp chứng chỉ";
            }
            if ($row['tag_id'] != 0) {
                $tag_id = $row['tag_id'];
                $qrTag = new db_query("SELECT tag_name, cate_icon FROM tags JOIN categories ON tags.cate_id=categories.cate_id WHERE tag_id = '$tag_id'");
                $rowTag = mysql_fetch_array($qrTag->result);
                $cate_id = $row['cate_id'];

                $tag_name = '<div class="item">
                        <img width="16px" height="16px" src="/img/load.gif" data-src="../img/categories/'. $row['cate_icon'] .'" class="lazyload v_cate_icon"><span>'.$rowTag['tag_name'].'</span>
                    </div>';
            }else{
                $tag_name = "";
            }
            ?>
         <div class="product-item">
             <div class="product-img">
                 <?php 
                   if ($row['user_type'] == 2) {
                    $srcTeach = urlDetail_teacher($row['user_id'], $row['user_slug']);
                }else if($row['user_type'] == 3){
                    $srcTeach = urlDetail_center($row['user_id'], $row['user_slug']);
                }
               if ($row['course_type'] == 1) {
                   $course_link = urlDetail_courseOffline($row['course_id'],$row['course_slug']);
               }else if ($row['course_type'] == 2) {
                   $course_link = urlDetail_courseOnline($row['course_id'],$row['course_slug']);
               }
                ?>
                 <a href="<?php echo $course_link; ?>"><img class="img-main" onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                     src="../img/course/<?php echo $row['course_avatar']; ?>"></a>
                 <div class="detail">
                     <div class="detai-img">
                         <img onerror='this.onerror=null;this.src="../img/avatar/error.png";'
                             src="../img/avatar/<?php echo $row['user_avatar']; ?>" alt="Ảnh lỗi">
                     </div>
                     <div class="detai-item">
                         <a href="<?php echo $srcTeach; ?>">
                             <p class="detai-item1"><?php echo $row['user_name']; ?></p>
                         </a>
                         <?php
                         if ($row['course_type'] == 2) {
                            $link_cate = urlOnline_cate($row['cate_id'],$row['cate_slug']);
                         }else if ($row['course_type'] == 1){
                            $link_cate = urlOffline_cate($row['cate_id'],$row['cate_slug']);
                         }
                         ?>
                         <a href="<?php echo $link_cate; ?>" class="detai-item2"><?php echo $row['cate_name']; ?></a>
                     </div>
                 </div>
                 <div class="like">
                     <?php

                 $qrS = new db_query("SELECT save_id FROM save_course WHERE user_student_id = '$id' AND course_id = " . $row['course_id']);
                 if (mysql_num_rows($qrS->result) == 0) {
                    $srcS = '../img/image/wpf_like (3).svg';
                }else{
                    $srcS = '../img/heart-yellow2.svg';
                }
                ?>

                     <button class="like-product" value="<?php echo $row['course_id']; ?>"
                         onclick="v_save_course(this)"><img class="lazyload v_save<?php echo $row['course_id']; ?>" src="/img/load.gif"
                             data-src="<?php echo $srcS; ?>"></button>

                 </div>
             </div>
             <div class="product-info">
                 <div class="prd-name">
                     <a href="<?php echo $course_link;?>">
                         <p class="prd-name-p"><?php echo $row['course_name']; ?></p>
                     </a>
                 </div>
                 <?php
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
        ?>
                 <div class="star-rate">
                     <?php 
           if ($total_rate == 5) {
            echo '
            <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
            <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
            <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
            <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
            <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
            ';
        } elseif ($total_rate < 5 && $total_rate >= 4) {
            echo '
            <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
            <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
            <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
            <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
            ';
        } elseif ($total_rate < 4 && $total_rate >= 3) {
            echo '
            <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
            <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
            <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
            ';
        } elseif ($total_rate < 3 && $total_rate >= 2) {
            echo '
            <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
            <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
            ';
            } elseif ($total_rate < 2 && $total_rate >= 1) {echo '
            <img class="lazyload" src="/img/load.gif" data-src="../img/bi_star-fill.png" alt="Ảnh lỗi">
            ';
        } else {
            echo 'Chưa có đánh giá';
        }

        ?>
                     <span><?=round($total_rate, 1); ?> (

                         <?
           $num5 = new db_query("SELECT course_id FROM rate_course WHERE course_id = $course_id");
           echo mysql_num_rows($num5->result);
           ?>)
                     </span>
                 </div>
                 <div class="prd-status">
                     <p>
                         <?
           $num2 = new db_query("SELECT course_id FROM order_student_common WHERE course_id = $course_id");
           $num3 = new db_query("SELECT course_id FROM orders WHERE course_id = $course_id");
           echo mysql_num_rows($num2->result) + mysql_num_rows($num3->result);
           ?>
                         học viên mua
                     </p>
                 </div>
                 <div class="prd-item">
                     <div class="item">
                         <img class="lazyload" src="/img/load.gif" width="16px" height="16px"
                             data-src="../img/nguoi-moi.svg"><span><?php echo $row['level_name'] ?></span>
                     </div>
                     <div class="item">
                         <img class="lazyload" src="/img/load.gif" width="16px" height="16px"
                             data-src="../img/chung-chi.svg"><span><?php echo $cer; ?></span>
                     </div>
                     <div class="item">
                         <img class="lazyload" src="/img/load.gif" width="16px" height="16px"
                             data-src="../img/image/clock.svg"><span><?php echo $row['month_study'] ?> tháng</span>
                     </div>
                     <?=$tag_name;?>

                 </div>
                 <hr>
                 <div class="prd-buy" id="prd-buy<?php echo $course_id; ?>">
                     <div class="prices">
                        <?php
                        if ($row['price_promotional'] == -1) {
                            echo '<p>'.number_format($row['price_listed']) . ' đ'.'</p>';
                        }else{
                            echo '<p>'.number_format($row['price_promotional']) . ' đ'.'</p>
                            <span>'.number_format($row['price_listed']). ' đ'.'</span>';
                        }
                        ?>
                     </div>
                     <?
                        if(isset($_COOKIE['user_id']) && $cookie_type == 1){
                            $course_id = $row['course_id'];
                            $db_order = new db_query("SELECT course_id,user_student_id FROM orders WHERE user_student_id = $cookie_id AND course_id=$course_id");
                            $db_order2 = new db_query("SELECT course_id,user_student_id FROM order_student_common WHERE user_student_id = $cookie_id AND course_id=$course_id");
                            if (mysql_num_rows($db_order->result)>0 || mysql_num_rows($db_order2->result)>0) {
                                if ($row['course_type'] == 1) {
                                    echo '<div class="buy-now2">
                                        <a>ĐÃ ĐẶT CHỖ</a>
                                    </div>';
                                }else{
                                    echo '<div class="buy-now2">
                                        <a>ĐÃ MUA</a>
                                    </div>';
                                }
                            }else{
                                if ($row['course_type'] == 1) {
                                   echo '<div class="buy-now" onclick="v_datcho('.$course_id.')" id="v_course'.$course_id.'">
                                    <a>ĐẶT CHỖ</a>
                                    </div>';
                                }else{
                                    echo '<div class="buy-now">
                                    <a href="'.urlOrders($cookie_id, $course_id).'">MUA NGAY</a>
                                    </div>';
                                }
                            }
                        }else{
                            if ($row['course_type'] == 1) {
                                   echo '<div class="buy-now" data-toggle="modal" data-target="#modal-login">
                                <a>ĐẶT CHỖ</a>
                            </div>';
                                }else{
                                    echo '<div class="buy-now" data-toggle="modal" data-target="#modal-login">
                                    <a>MUA NGAY</a>
                                    </div>';
                                }
                        }
                    ?>
                 </div>
             </div>
         </div>
         <?php
        }
    }
    ?>
     </div>

     <!--paginate-->
     <div class="paginate-product">
         <nav aria-label="Page navigation example" class="paginate-product-detail">
             <ul class="pagination">
                <?php
                $url2 = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                if(strpos($_SERVER['REQUEST_URI'],"page=" . $page) != false){
                    if($ca != 0 || $ta != 0 || $te != 0 || $p != 0 || $keyword != ""){
                        $url = str_replace('&page='.$page,'',$_SERVER['REQUEST_URI']);
                    }else{
                        $url = str_replace('?page='.$page,'',$_SERVER['REQUEST_URI']);
                    }
                }else{
                    $url = $_SERVER['REQUEST_URI'];
                }
                if($ca != 0 || $ta != 0 || $te != 0 || $p != 0 || $ci != 0 || $keyword != ""){
                    $getPage = "&page=";
                }else{
                    $getPage = "?page=";
                }

                if(isset($arr['cate_id']) || isset($arr['tag_id']) || isset($arr['cit_id']) || $keyword != ""){
                    if($v_actived_type == 'offline'){
                        $url2 = 'khoa-hoc-offline.html';
                    }else if($v_actived_type == 'online'){
                        $url2 = 'khoa-hoc-online.html';
                    }
                }

                if($page != 0 && $page != 1){
                ?>
                 <li>
                    <a class="page-item page-link" href="<?php echo $url . $getPage . ($page-1);?>">&laquo;</a>
                 </li>
                <?php 
                }
                if ($page == 0) {
                   $page = 1;
                }

                for ($i = 1; $i <= ceil($v_sum); $i++) {
                    if ($page == $i) {
                        $v_paging = "v_paging";
                    }else{
                        $v_paging = "";
                    }
                ?>
                 <li><a href="<?php echo $url . $getPage . $i;?>" class="page-item <?=$v_paging?> page-link"><?php echo $i;?></a></li>
                <?php
                }
                if ($page < $i - 1) {
                ?>
                 <li>
                     <a href="<?php echo $url . $getPage . ($page+1);?>" class="page-item page-link">&raquo;</a>
                 </li>
                <?php
                }
                ?>
             </ul>
         </nav>
     </div>
 </div>