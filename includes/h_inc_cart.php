                   <div id="cart">
                        <div class="cart-list" id="cart-list1">
                            <img id="cart-list1-img" width="360px" height="186px"
                                onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload"
                                src="/img/load.gif" data-src="../img/course/<?php echo $rowc['course_avatar']; ?>">

                            <div class="buy-now">
                                <div class="prices">
                                    <?php
                                    if ($rowc['price_promotional'] == -1) {
                                        echo '<span class="prices1">'.number_format($rowc['price_listed']) . ' đ'.'</span>';
                                    }else{
                                        echo '<span class="prices1">'.number_format($rowc['price_promotional']) . ' đ'.'</span>
                                        <span class="prices2">'.number_format($rowc['price_listed']). ' đ'.'</span>';
                                    }
                                    ?>
                                </div>
                                <ul class="listbuy">

                                <?php
                                    if(isset($cookie_id) && $cookie_type == 1){
                                        $db_order = new db_query("SELECT course_id,user_student_id FROM orders WHERE user_student_id = $cookie_id AND course_id=$course_id");
                                        $db_common = new db_query("SELECT * FROM order_student_common WHERE user_student_id = $cookie_id AND course_id = $course_id");
                                        if (mysql_num_rows($db_order->result)>0) {
                                            if ($rowc['course_type'] == 1) {
                                                echo '<a>
                                                <li class="listbuy5"><img class="lazyload" src="/img/load.gif"
                                                data-src="../img/image/muangay.svg">ĐÃ ĐẶT CHỖ
                                                </li>
                                                </a>';
                                            }else{
                                                echo '<a>
                                                <li class="listbuy5"><img class="lazyload" src="/img/load.gif"
                                                data-src="../img/image/muangay.svg">ĐÃ MUA
                                                </li>
                                                </a>';
                                            }
                                        }else if (mysql_num_rows($db_common->result) > 0) {
                                                echo '<a>
                                                <li class="listbuy5"><img class="lazyload" src="/img/load.gif"
                                                data-src="../img/image/muangay.svg">ĐÃ MUA
                                                </li>
                                                </a>';
                                        }else{
                                            if ($rowc['course_type'] == 1) {
                                                echo '<a onclick="v_datcho()" id="v_datcho">
                                                <li class="listbuy1"><img class="lazyload" src="/img/load.gif"
                                                data-src="../img/image/muangay.svg">
                                                ĐẶT CHỖ
                                                </li>
                                                </a>';
                                            }else{
                                                echo '<a href="'.urlOrders($cookie_id, $course_id).'">
                                                <li class="listbuy1"><img class="lazyload" src="/img/load.gif"
                                                data-src="../img/image/muangay.svg">
                                                MUA NGAY
                                                </li>
                                                </a>';
                                                if ($rowc['quantity_std'] != 0) {
                                                    echo '<a href="'.urlOrderCommon($course_id).'">
                                                <li class="listbuy2"><img class="lazyload" src="/img/load.gif"
                                                data-src="../img/image/muachung.svg">MUA CHUNG
                                                </li>
                                                </a>';
                                                }else{
                                                    echo '<a onclick="alert(\'Khóa học không hỗ trợ mua chung\')">
                                                <li class="listbuy2"><img class="lazyload" src="/img/load.gif"
                                                data-src="../img/image/muachung.svg">MUA CHUNG
                                                </li>
                                                </a>';
                                                }
                                                $db_cart = new db_query("SELECT * FROM carts WHERE user_student_id = $cookie_id AND course_id = $course_id");
                                                if (mysql_num_rows($db_cart->result) == 0) {
                                                    echo '<a class="create_cart">
                                                    <li class="listbuy3"><img class="lazyload" src="/img/load.gif"
                                                    data-src="../img/image/giohang.svg">
                                                    THÊM VÀO GIỎ HÀNG
                                                    </li>
                                                    </a>';
                                                }else{
                                                    echo '<a class="create_cart2">
                                                    <li class="listbuy3"><img class="lazyload" src="/img/load.gif"
                                                    data-src="../img/image/giohang.svg">
                                                    ĐÃ THÊM VÀO GIỎ HÀNG
                                                    </li>
                                                    </a>';
                                                }
                                            }
                                        }
                                    }else{
                                        if ($rowc['course_type'] == 1) {
                                            echo '<a data-toggle="modal" data-target="#modal-login">
                                            <li class="listbuy1"><img class="lazyload" src="/img/load.gif"
                                            data-src="../img/image/muangay.svg">
                                            ĐẶT CHỖ
                                            </li>
                                            </a>';
                                        }else{
                                            echo '<a data-toggle="modal" data-target="#modal-login">
                                            <li class="listbuy1"><img class="lazyload" src="/img/load.gif"
                                            data-src="../img/image/muangay.svg">
                                            MUA NGAY
                                            </li>
                                            </a>
                                            <a data-toggle="modal" data-target="#modal-login">
                                            <li class="listbuy2"><img class="lazyload" src="/img/load.gif"
                                            data-src="../img/image/muachung.svg">MUA CHUNG
                                            </li>
                                            </a>
                                            <a data-toggle="modal" data-target="#modal-login">
                                            <li class="listbuy3"><img class="lazyload" src="/img/load.gif"
                                            data-src="../img/image/giohang.svg">
                                            THÊM VÀO GIỎ HÀNG
                                            </li>
                                            </a>';
                                        }
                                    }
                                ?>
                                </ul>
                            </div>

                        </div>
                        <div class="cart-list" id="cart-list2">
                            <div class="title">
                                <h3>THÔNG TIN KHÓA HỌC</h3>
                            </div>
                            <ul class="course-info">
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/image/numstudent.svg">
                                    <?php
                                    $num2 = new db_query("SELECT course_id FROM order_student_common WHERE course_id = $course_id");
                                    $num3 = new db_query("SELECT course_id FROM orders WHERE course_id = $course_id");
                                    echo '<span class="v_count_hv">'.(mysql_num_rows($num2->result) + mysql_num_rows($num3->result)).'</span>';
                                ?>
                                    học viên</li>
                                <li><img class="lazyload" src="/img/load.gif"
                                        data-src="../img/image/clock.svg"><?php echo $rowc['time_learn']; ?> buổi</li>
                                <li><img class="lazyload" src="/img/load.gif"
                                        data-src="../img/image/lession.svg"><?php echo $rowc['course_slide']; ?> bài
                                </li>
                                <?php 
                                $cate_id = $rowc['cate_id'];
                                $qrCate = new db_query("SELECT `cate_name` FROM `categories` WHERE `cate_id` = '$cate_id'");
                                $rowCate = mysql_fetch_array($qrCate->result);
                                ?>
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/image/video1.svg">Môn học
                                    : <?php echo $rowCate['cate_name']; ?>
                                </li>
                                <?php 
                                $tag_id = $rowc['tag_id'];
                                $qrTag = new db_query("SELECT `tag_name` FROM `tags` WHERE `tag_id` = '$tag_id'");
                                $rowTag = mysql_fetch_array($qrTag->result);
                                if ($rowTag == "") {
                                    $v_style_tag = "display: none;";
                                }else{
                                    $v_style_tag = "";
                                }
                                ?>
                                <li style="<?php echo $v_style_tag; ?>"><img class="lazyload" src="/img/load.gif"
                                        data-src="../img/image/book.svg">Môn học chi
                                    tiết : <?php echo $rowTag['tag_name']; ?></li>
                                <li><img class="lazyload" src="/img/load.gif"
                                        data-src="../img/image/tailieu.svg"><?php echo $rowc['course_slide']; ?> tài
                                    liệu
                                </li>
                                <li><img class="lazyload" src="/img/load.gif"
                                        data-src="../img/image/dailydate.svg"><?php echo date("d-m-Y", $rowc['created_at']) ?>
                                </li>
                            </ul>
                        </div>
                        <div class="cart-list" id="cart-list3">
                            <div class="title2">
                                <h3>TỪ KHÓA PHỔ BIẾN</h3>
                            </div>
                            <div class="cart-keyword">
                                <?
                                    $qrt1 = new db_query("SELECT cate_id FROM courses WHERE course_id = $course_id");
                                    $rowc1 = mysql_fetch_array($qrt1->result);
                                    $qrt = new db_query("SELECT * FROM tags WHERE cate_id = ".$rowc1['cate_id']);
                                    while ($rowtg = mysql_fetch_array($qrt->result)) {
                                        if($rowc['course_type']==1){
                                            $link = urlOffline_tag($rowtg['tag_id'], $rowtg['tag_slug']);
                                        }elseif($rowc['course_type']==2){
                                            $link = urlOnline_tag($rowtg['tag_id'], $rowtg['tag_slug']);
                                        }
                                ?>
                                <div class="a-keyword"><a href="<?=$link ?>"><?=$rowtg['tag_name']?></a>
                                </div>
                                <?php
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>