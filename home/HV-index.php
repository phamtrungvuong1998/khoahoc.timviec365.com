<?php
require_once '../includes/v_inc_insert_HV.php';
// Khóa học đã lưu
$qrSaveCourse = new db_query("SELECT save_id FROM save_course WHERE user_student_id = '$user_id'");

//Khóa học online đã mua
$qrBuyOn = new db_query("SELECT order_id FROM orders WHERE user_student_id = '$user_id' AND course_type = 2");

//Khóa học offline đã mua
$qrBuyOff = new db_query("SELECT order_id FROM orders WHERE user_student_id = '$user_id' AND course_type = 1");

//Giảng viên đã lưu
$qrSaveTeach = new db_query("SELECT save_id FROM save_teacher WHERE user_student_id = '$user_id'");

//Lấy cate_id của học viên về dạng (1,2,3,4,...,n)
$cate_fit = "";
if ($rowHV['cate_id'] != 0) {
    $user_cate_id = explode(",", $rowHV['cate_id']);
    if (count($user_cate_id) == 1) {
        $cate_fit = $cate_fit . "(" . $user_cate_id[0] . ")";
    }else{
        for ($i = 0; $i < count($user_cate_id); $i++) {
            if ($i == 0) {
                $cate_fit = '(' . $user_cate_id[$i] . ',';
            }else if ($i < count($user_cate_id) - 1 && $i > 0){
                $cate_fit = $cate_fit . $user_cate_id[$i] . ',';
            }else if ($i == count($user_cate_id) - 1) {
                $cate_fit = $cate_fit . $user_cate_id[$i] . ')';
            }
        }
    }
}else{
    $cate_fit = "(0)";
}
$qrFitAll = new db_query("SELECT course_id FROM courses WHERE cate_id IN ". $cate_fit);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <?php require_once '../includes/v_inc_HV_css.php'; ?>
    <link rel="stylesheet" href="../css/v_index.css?v=<?=$version?>">
    <style type="text/css">
    #v_QL-chung {
        color: #1B6AAB;
    }

    .v_course_fit_slick {
        display: flex;
    }
    .v_sidebar-menu:nth-child(1) a{
        color: #1B6AAB;
    }
    </style>
    <title>Quản lí chung</title>
</head>

<body>
    <div id="v_wrapper" class="flex">
        <!-- Begin: sidebar -->
        <?php require_once("../includes/inc_sidebar.php"); ?>
        <!-- End: sidebar -->
        <div id="main">
            <!-- Begin: header -->
            <?php require_once '../includes/inc_manager_header.php'; ?>
            <!-- End: header -->

            <!-- Begin: content -->
            <div id="v_content">
                <!-- Begin: content-1 -->
                <div id="v_content-1" class="flex">
                    <div>
                        <div class="v_content-1-img"><img class="lazyload" src="/img/load.gif"
                                data-src="../img/GroupAnhIndex.svg" alt="Ảnh lỗi"></div>
                        <div class="v_content-text">
                            <?php  echo mysql_num_rows($qrBuyOn->result); ?></div>
                        <div class="v_content-text">KHÓA HỌC ĐÃ MUA</div>
                    </div>
                    <div>
                        <div class="v_content-1-img">
                            <img src="/img/load.gif" data-src="../img/backgroud_hv_index.png" class="lazyload" alt="Ảnh lỗi">
                            <img src="/img/load.gif" data-src="../img/v_course_saving.svg" class="v_img_hv_index lazyload" alt="Ảnh lỗi">
                        </div>
                        <div class="v_content-text"><?php echo mysql_num_rows($qrSaveCourse->result); ?></div>
                        <div class="v_content-text">KHÓA HỌC ĐÃ LƯU</div>
                    </div>
                    <div>
                        <div class="v_content-1-img v_khoa_hoc_phu_hop">
                            <img src="/img/load.gif" data-src="../img/backgroud_hv_index.png" class="lazyload" alt="Ảnh lỗi">
                            <img src="/img/load.gif" data-src="../img/v_course_buying.svg" class="v_img_hv_index lazyload" alt="Ảnh lỗi">
                        </div>
                        <div class="v_content-text"><?php echo mysql_num_rows($qrFitAll->result); ?></div>
                        <div class="v_content-text">KHÓA HỌC PHÙ HỢP</div>
                    </div>
                    <div>
                        <div class="v_content-1-img">
                            <img src="/img/load.gif" data-src="../img/backgroud_hv_index.png" class="lazyload" alt="Ảnh lỗi">
                            <img src="/img/load.gif" data-src="../img/v_save_teacher.svg" class="v_img_hv_index lazyload" alt="Ảnh lỗi">
                        </div>
                        <div class="v_content-text"><?php echo mysql_num_rows($qrSaveTeach->result); ?></div>
                        <div class="v_content-text">THEO DÕI GIẢNG VIÊN</div>
                    </div>
                </div>

                <div id="v_content-1-tb">
                    <div>
                        <div class="v_content-1-img">
                            <center><img class="lazyload" src="/img/load.gif" data-src="../img/course_bought_student.svg" alt="Ảnh lỗi"></center>
                        </div>
                        <div class="v_content-text">
                            <?php echo mysql_num_rows($qrBuyOn->result); ?></div>
                        <div class="v_content-text-2">KHÓA HỌC ĐÃ MUA</div>
                    </div>
                    <div>
                        <div class="v_content-1-img">
                            <center><img class="lazyload" src="/img/load.gif" data-src="../img/course_save.svg" alt="Ảnh lỗi"></center>
                        </div>
                        <div class="v_content-text"><?php echo mysql_num_rows($qrSaveCourse->result); ?></div>
                        <div class="v_content-text-2">KHÓA HỌC ĐÃ LƯU</div>
                    </div>
                    <div>
                        <div class="v_content-1-img v_khoa_hoc_phu_hop">
                            <center><img class="lazyload" src="/img/load.gif" data-src="../img/course_fit_student.svg" alt="Ảnh lỗi"></center>
                        </div>
                        <div class="v_content-text"><?php echo mysql_num_rows($qrFitAll->result); ?></div>
                        <div class="v_content-text-2">KHÓA HỌC PHÙ HỢP</div>
                    </div>
                    <div>
                        <div class="v_content-1-img">
                            <center><img class="lazyload" src="/img/load.gif" data-src="../img/course_save_student.svg" alt="Ảnh lỗi"></center>
                        </div>
                        <div class="v_content-text"><?php echo mysql_num_rows($qrSaveTeach->result); ?></div>
                        <div class="v_content-text-2">THEO DÕI GIẢNG VIÊN</div>
                    </div>
                </div>
                <!-- End: content-1 -->
                <hr class="v_content-hr">

                <!-- Begin: content-2 -->
                <div class="v_tieude">
                    <div class="v_cap"><img class="lazyload" src="/img/load.gif" data-src="../img/BriefcaseFill(1).png" alt="Ảnh lỗi"></div>
                    <div class="v_content-2-title">KHÓA ONLINE ĐÃ MUA</div>
                </div>
            </div>
            <div id="v_content-2">
                <div class="v_khoaonline-1" id="online_buy">
                    <?php
                            //Khóa học online đã mua
                            $qrBuyOn = new db_query("SELECT *,courses.course_id FROM orders INNER JOIN courses ON orders.course_id = courses.course_id INNER JOIN users ON courses.user_id = users.user_id INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON categories.cate_id = courses.cate_id WHERE orders.user_student_id = '$user_id' AND orders.course_type = 2 ORDER BY orders.order_id DESC LIMIT 0,3");
                            if(mysql_num_rows($qrBuyOn->result)==0){
                                echo '<div class="emptys">Bạn chưa mua khóa học nào, <a href="/khoa-hoc-online.html">mua ngay</a></div>';
                            }else{
                                while ($rowBuyOn = mysql_fetch_array($qrBuyOn->result)) {
                                    ?>
                    <div class="v_khoaonline">
                        <?php
                                    $course_id = $rowBuyOn['course_id'];
                                    $qrRate = new db_query("SELECT (sum(lesson)+sum(teacher)+sum(video)),COUNT(rate_id) FROM rate_course WHERE course_id = '$course_id'");
                                    $rowR = mysql_fetch_array($qrRate->result);
                                    if ($rowR['COUNT(rate_id)'] == 0) {
                                        $rate = $rowR['(sum(lesson)+sum(teacher)+sum(video))'];
                                    } else {
                                        $rate = $rowR['(sum(lesson)+sum(teacher)+sum(video))']/(3*$rowR['COUNT(rate_id)']);
                                    } ?>
                        <div class="v_pos">
                            <div class="v_gv">
                                <div class="v_gv-div v_gv-img"><img
                                        onerror="this.onerror=null;this.src='../img/avatar/error.png';" class="lazyload"
                                        src="/img/load.gif"
                                        data-src="../img/avatar/<?php echo $rowBuyOn['user_avatar']; ?>" alt="Ảnh lỗi">
                                </div>
                                <?php if ($rowBuyOn['user_type'] == 2) {
                                        $link_teach = urlDetail_teacher($rowBuyOn['user_id'], $rowBuyOn['user_slug']);
                                    } elseif ($rowBuyOn['user_type'] == 3) {
                                        $link_teach = urlDetail_center($rowBuyOn['user_id'], $rowBuyOn['user_slug']);
                                    } ?>
                                <div class=" v_gv-div v_gv-text">
                                    <a href="<?php echo $link_teach; ?>">
                                        <p class="v_gv-div-p"><?php echo $rowBuyOn['user_name']; ?></p>
                                    </a>
                                    <?php
                                                $arr_cate_id = explode(",", $rowBuyOn['cate_id']);
                                    $cate_name = "";
                                    for ($i = 0; $i < count($arr_cate_id); $i++) {
                                        $cate_id = $arr_cate_id[$i];
                                        $qrCate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cate_id'");
                                        $rowCate = mysql_fetch_array($qrCate->result);
                                        if ($i == count($arr_cate_id) - 1) {
                                            $cate_name = $cate_name . $rowCate['cate_name'];
                                        } else {
                                            $cate_name = $cate_name . $rowCate['cate_name'] . ",";
                                        }
                                    } ?>
                                    <p class="v_gv-div-p">
                                        <?php echo $cate_name; ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                                        if ($rowBuyOn['user_avatar'] == 0) {
                                            $teacher_avatar = '../img/v_avatar_default.png';
                                        } else {
                                            $teacher_avatar = '../img/avatar/' . $rowBuyOn['user_avatar'];
                                        } ?>
                            <img class="v_khoaonline-background lazyload"
                                onerror="this.onerror=null;this.src='../img/avatar/error.png';" src="/img/load.gif"
                                data-src="../img/course/<?php echo $rowBuyOn['course_avatar']; ?>" alt="Ảnh lỗi">
                        </div>
                        <a
                            href="<?php echo urlDetail_courseOnline($rowBuyOn['course_id'], $rowBuyOn['course_slug']); ?>">
                            <div class="v_khoaonline-title"><?php echo $rowBuyOn['course_name']; ?></div>
                        </a>
                        <div id="v_star" class="flex">
                            <?php
                                      for ($i = 1; $i <= $rate; $i++) {
                                          ?>
                            <div class="v_star"><img class="lazyload" src="/img/load.gif"
                                    data-src="../img/bi_star-fill.svg" alt="Ảnh lỗi"></div>
                            <?php
                                      } ?>
                        </div>
                        <?php
                                $qrOrder = new db_query("SELECT order_id FROM orders WHERE course_id = " . $rowBuyOn['course_id']);
                                    $qrOrderCommon = new db_query("SELECT order_student_id FROM order_student_common WHERE course_id = " . $rowBuyOn['course_id']); ?>
                        <div class="v_songuoidk">
                            <?php echo mysql_num_rows($qrOrder->result) + mysql_num_rows($qrOrderCommon->result); ?> học
                            viên đã đăng kí khóa học</div>
                        <div class="flex v_info">
                            <div class="v_info-detail flex">
                                <?php
                                        if ($rowBuyOn['certification'] == 1) {
                                            $certification = 'Cấp chứng chỉ';
                                        } else{
                                            $certification = 'Không cấp chứng chỉ';
                                        } ?>
                                <div><img class="lazyload" src="/img/load.gif" data-src="../img/chung-chi.svg"
                                        alt="Ảnh lỗi"></div>
                                <div><?php echo $certification; ?></div>
                            </div>
                            <div class="v_info-detail flex">
                                <div><img class="lazyload" src="/img/load.gif" data-src="../img/nguoi-moi.svg"
                                        alt="Ảnh lỗi"></div>
                                <div><?php echo $rowBuyOn['level_name']; ?></div>
                            </div>
                            <div class="v_info-detail flex">
                                <div><img class="lazyload" src="/img/load.gif"
                                        data-src="../img/categories/<?php echo $rowBuyOn['cate_icon'] ?>" alt="Ảnh lỗi">
                                </div>
                                <div><?php echo $rowBuyOn['cate_name']; ?></div>
                            </div>
                        </div>
                        <center>
                            <hr class="v_content-2-hr">
                        </center>
                        <div class="v_batdauhoc"><a href="<?php echo urlBaihoc($rowBuyOn['course_id']); ?>"><button>BẮT ĐẦU HỌC</button></a></div>
                    </div>
                    <?php
                                }
                            }?>
                </div>
                <button id="v_buy_online"><a href="/hoc-vien-khoa-hoc-online-da-mua/id<?php echo $user_id; ?>.html">XEM
                        THÊM</a></button>
            </div>
            <!-- End: content-2 -->

            <hr class="v_content-hr">
            <!-- Begin: content-3 -->
            <div id="v_content-3">
                <div class="flex v_tieude" id="offline_buy">
                    <div class="v_cap"><img class="lazyload" src="/img/load.gif" data-src="../img/BriefcaseFill(1).png"
                            alt="Ảnh lỗi"></div>
                    <div class="v_content-2-title">KHÓA OFFLINE ĐÃ ĐẶT CHỖ</div>
                </div>
                <div class="flex v_khoaonline-1">
                    <?php
                        $qrBuyOff = new db_query("SELECT * FROM orders INNER JOIN courses ON orders.course_id = courses.course_id INNER JOIN users ON courses.user_id = users.user_id INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON categories.cate_id = courses.cate_id WHERE orders.user_student_id = '$user_id' AND orders.course_type = 1 ORDER BY order_id DESC LIMIT 0,3");
                        if(mysql_num_rows($qrBuyOff->result)==0){
                                echo '<div class="emptys">Bạn chưa mua khóa học nào, <a href="/khoa-hoc-offline.html">mua ngay</a></div>';
                            }else{
                                while ($rowBuyOff = mysql_fetch_array($qrBuyOff->result)) {
                                    $course_id = $rowBuyOff['course_id'];
                                    $qrRate = new db_query("SELECT lesson, teacher FROM rate_course WHERE course_id = '$course_id'");
                                    $rate = 0;
                                    while ($rowR = mysql_fetch_array($qrRate->result)) {
                                        $rate = $rate + ($rowR['lesson'] + $rowR['teacher'])/2;
                                    }
                                    if ($rate == 0) {
                                        $rate_count = 1;
                                    } else {
                                        $rate_count = mysql_num_rows($qrRate->result);
                                    }
                                    $rate = $rate/$rate_count; ?>
                    <div class="v_khoaonline">
                        <div class="v_pos">
                            <div class="v_gv">
                                <div class="v_gv-div v_gv-img"><img
                                        onerror="this.onerror=null;this.src='../img/avatar/error.png';" class="lazyload"
                                        src="/img/load.gif"
                                        data-src="../img/avatar/<?php echo $rowBuyOff['user_avatar']; ?>" alt="Ảnh lỗi">
                                </div>
                                <?php if ($rowBuyOff['user_type'] == 2) {
                                        $link_teach = urlDetail_teacher($rowBuyOff['user_id'], $rowBuyOff['user_slug']);
                                    } elseif ($rowBuyOff['user_type'] == 3) {
                                        $link_teach = urlDetail_center($rowBuyOff['user_id'], $rowBuyOff['user_slug']);
                                    } ?>
                                <div class=" v_gv-div v_gv-text">
                                    <a href="<?php echo $link_teach; ?>">
                                        <p class="v_gv-div-p"><?php echo $rowBuyOff['user_name']; ?></p>
                                    </a>
                                    <?php
                                        $arr_cate_id = explode(",", $rowBuyOff['cate_id']);
                                    $cate_name = "";
                                    for ($i = 0; $i < count($arr_cate_id); $i++) {
                                        $cate_id = $arr_cate_id[$i];
                                        $qrCate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cate_id'");
                                        $rowCate = mysql_fetch_array($qrCate->result);
                                        if ($i == count($arr_cate_id) - 1) {
                                            $cate_name = $cate_name . $rowCate['cate_name'];
                                        } else {
                                            $cate_name = $cate_name . $rowCate['cate_name'] . ",";
                                        }
                                    } ?>
                                    <p class="v_gv-div-p">
                                        <?php echo $cate_name; ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                                if ($rowBuyOff['user_avatar'] == 0) {
                                    $teacher_avatar = '../img/v_avatar_default.png';
                                } else {
                                    $teacher_avatar = '../img/avatar/' . $rowBuyOff['user_avatar'];
                                } ?>
                            <img class="v_khoaonline-background lazyload"
                                onerror="this.onerror=null;this.src='../img/avatar/error.png';" src="/img/load.gif"
                                data-src="../img/course/<?php echo $rowBuyOff['course_avatar'] ?>" alt="Ảnh lỗi">
                        </div>
                        <a
                            href="<?php echo urlDetail_courseOffline($rowBuyOff['course_id'], $rowBuyOff['course_slug']); ?>">
                            <div class="v_khoaonline-title"><?php echo $rowBuyOff['course_name']; ?></div>
                        </a>
                        <div id="v_star" class="flex">
                            <?php
                            for ($i = 1; $i <= $rate; $i++) {
                                ?>
                            <div class="v_star"><img class="lazyload" src="/img/load.gif"
                                    data-src="../img/bi_star-fill.svg" alt="Ảnh lỗi"></div>
                            <?php
                            } ?>
                            <?php
                            $qrOrder = new db_query("SELECT order_id FROM orders WHERE course_id = " . $rowBuyOff['course_id']);
                                    $qrOrderCommon = new db_query("SELECT order_student_id FROM order_student_common WHERE course_id = " . $rowBuyOff['course_id']); ?>
                        </div>
                        <div class="v_songuoidk">
                            <?php echo mysql_num_rows($qrOrder->result) + mysql_num_rows($qrOrderCommon->result); ?> học
                            viên đã đăng kí khóa học</div>
                        <div class="flex v_info">
                            <div class="v_info-detail flex">
                                <?php
                                if ($rowBuyOff['certification'] == 1) {
                                    $certification = 'Cấp chứng chỉ';
                                } else {
                                    $certification = 'Không cấp chứng chỉ';
                                } ?>
                                <div><img class="lazyload" src="/img/load.gif" data-src="../img/chung-chi.svg"
                                        alt="Ảnh lỗi"></div>
                                <div><?php echo $certification; ?></div>
                            </div>
                            <div class="v_info-detail flex">
                                <div><img class="lazyload" src="/img/load.gif" data-src="../img/nguoi-moi.svg"
                                        alt="Ảnh lỗi"></div>
                                <div><?php echo $rowBuyOff['level_name']; ?></div>
                            </div>
                            <div class="v_info-detail flex">
                                <div><img class="lazyload" src="/img/load.gif"
                                        data-src="../img/categories/<?php echo $rowBuyOff['cate_icon']; ?>"
                                        alt="Ảnh lỗi"></div>
                                <div><?php echo $rowBuyOff['cate_name']; ?></div>
                            </div>
                        </div>
                        <center>
                            <hr class="v_content-2-hr">
                        </center>
                        <div class="v_batdauhoc v_da_dat_cho"><button>ĐÃ ĐẶT CHỖ</button></div>
                    </div>
                    <?php
                                }
                            }?>
                    <button id="v_buy_offline"><a
                            href="/hoc-vien-khoa-hoc-offline-da-dat-cho/id<?php echo $user_id; ?>.html">XEM
                            THÊM</a></button>
                </div>
            </div>
            <!-- End: content-3 -->

            <hr class="v_content-hr">
            <!-- Begin: content-4 -->
            <div id="v_content-4">
                <div class="flex v_tieude">
                    <div class="v_cap"><img class="lazyload" src="/img/load.gif" data-src="../img/BookmarksFill.png"
                            alt="Ảnh lỗi"></div>
                    <div class="v_content-2-title">KHÓA HỌC ĐÃ LƯU</div>
                </div>
                <div class="flex v_khoaonline-1" id="v_course_save">
                    <?php
                            // Khóa học đã lưu
                $qrSaveCourse = new db_query("SELECT * FROM save_course INNER JOIN courses
                    ON courses.course_id = save_course.course_id INNER JOIN users ON courses.user_id = users.user_id INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON categories.cate_id = courses.cate_id WHERE save_course.user_student_id = '$user_id' ORDER BY save_id DESC LIMIT 0,6");
                if(mysql_num_rows($qrSaveCourse->result)==0){
                                echo '<div class="emptys">Chưa có dữ liệu</div>';
                            }else{
                                while ($rowSaveCourse = mysql_fetch_array($qrSaveCourse->result)) {
                                    if ($rowSaveCourse['course_type'] == 1) {
                                        $rate = 0;
                                        $qrRate = new db_query("SELECT lesson, teacher FROM rate_course WHERE course_id = " . $rowSaveCourse['course_id']);
                                        while ($rowR = mysql_fetch_array($qrRate->result)) {
                                            $rate = $rate + ($rowR['lesson'] + $rowR['teacher'])/2;
                                        }
                                    } elseif ($rowSaveCourse['course_type'] == 2) {
                                        $qrRate = new db_query("SELECT lesson, teacher, video FROM rate_course WHERE course_id = " . $rowSaveCourse['course_id']);
                                        $rate = 0;
                                        while ($rowR = mysql_fetch_array($qrRate->result)) {
                                            $rate = $rate + ($rowR['lesson'] + $rowR['teacher'] + $rowR['video'])/3;
                                        }
                                    }
                                    if ($rate == 0) {
                                        $rate_count = 1;
                                    } else {
                                        $rate_count = mysql_num_rows($qrRate->result);
                                    }
                                    $rate = $rate/$rate_count; ?>
                    <div class="v_khoaonline" id="v_Save_Course-<?php echo $rowSaveCourse['course_id']; ?>">
                        <div class="v_pos">
                            <div class="v_gv">
                                <div class="v_gv-div v_gv-img"><img
                                        onerror="this.onerror=null;this.src='../img/avatar/error.png';" class="lazyload"
                                        src="/img/load.gif"
                                        data-src="../img/avatar/<?php echo $rowSaveCourse['user_avatar']; ?>"
                                        alt="Ảnh lỗi">
                                </div>
                                <?php if ($rowSaveCourse['user_type'] == 2) {
                                        $link_teach = urlDetail_teacher($rowSaveCourse['user_id'], $rowSaveCourse['user_slug']);
                                    } elseif ($rowSaveCourse['user_type'] == 3) {
                                        $link_teach = urlDetail_center($rowSaveCourse['user_id'], $rowSaveCourse['user_slug']);
                                    } ?>
                                <div class=" v_gv-div v_gv-text">
                                    <a href="<?php echo $link_teach; ?>">
                                        <p class="v_gv-div-p"><?php echo $rowSaveCourse['user_name']; ?></p>
                                    </a>
                                    <?php
                                $arr_cate_id = explode(",", $rowSaveCourse['cate_id']);
                                    $cate_name = "";
                                    for ($i = 0; $i < count($arr_cate_id); $i++) {
                                        $cate_id = $arr_cate_id[$i];
                                        $qrCate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cate_id'");
                                        $rowCate = mysql_fetch_array($qrCate->result);
                                        if ($i == count($arr_cate_id) - 1) {
                                            $cate_name = $cate_name . $rowCate['cate_name'];
                                        } else {
                                            $cate_name = $cate_name . $rowCate['cate_name'] . ",";
                                        }
                                    } ?>
                                    <p class="v_gv-div-p">
                                        <?php echo $cate_name; ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                        if ($rowSaveCourse['user_avatar'] == 0) {
                            $teacher_avatar = '../img/v_avatar_default.png';
                        } else {
                            $teacher_avatar = '../img/avatar/' . $rowSaveCourse['user_avatar'];
                        } ?>
                            <img class="v_khoaonline-background lazyload"
                                onerror="this.onerror=null;this.src='../img/avatar/error.png';" src="/img/load.gif"
                                data-src="../img/course/<?php echo $rowSaveCourse['course_avatar']; ?>" alt="Ảnh lỗi">
                        </div>
                        <?php if ($rowSaveCourse['course_type'] == 1) {
                            $linkCourse = urlDetail_courseOffline($rowSaveCourse['course_id'], $rowSaveCourse['course_slug']);
                        } elseif ($rowSaveCourse['course_type'] == 2) {
                            $linkCourse = urlDetail_courseOnline($rowSaveCourse['course_id'], $rowSaveCourse['course_slug']);
                        } ?>
                        <a href="<?php echo $linkCourse; ?>">
                            <div class="v_khoaonline-title"><?php echo $rowSaveCourse['course_name']; ?></div>
                        </a>
                        <div id="v_star" class="flex">
                            <?php
                      for ($i = 1; $i <= $rate; $i++) {
                          ?>
                            <div class="v_star"><img class="lazyload" src="/img/load.gif" data- class="lazyload"
                                    src="/img/load.gif" data-src="../img/bi_star-fill.svg" alt="Ảnh lỗi"></div>
                            <?php
                      } ?>
                        </div>
                        <?php
                    $qrOrder = new db_query("SELECT order_id FROM orders WHERE course_id = " . $rowSaveCourse['course_id']);
                                    $qrOrderCommon = new db_query("SELECT order_student_id FROM order_student_common WHERE course_id = " . $rowSaveCourse['course_id']); 
                                    ?>
                        <div class="v_songuoidk">
                            <?php echo mysql_num_rows($qrOrder->result) + mysql_num_rows($qrOrderCommon->result); ?> học
                            viên đã đăng kí khóa học</div>
                        <div class="flex v_info">
                            <div class="v_info-detail flex">
                                <?php
                            if ($rowSaveCourse['certification'] == 1) {
                                $certification = 'Cấp chứng chỉ';
                            } else {
                                $certification = 'Không cấp chứng chỉ';
                            } ?>
                                <div><img class="lazyload" src="/img/load.gif" data-src="../img/chung-chi.svg"
                                        alt="Ảnh lỗi"></div>
                                <div><?php echo $certification; ?></div>
                            </div>
                            <div class="v_info-detail flex">
                                <div><img class="lazyload" src="/img/load.gif" data-src="../img/nguoi-moi.svg"
                                        alt="Ảnh lỗi"></div>
                                <div><?php echo $rowSaveCourse['level_name']; ?></div>
                            </div>
                            <div class="v_info-detail flex">
                                <div><img class="lazyload" src="/img/load.gif"
                                        data-src="../img/categories/<?php echo $rowSaveCourse['cate_icon']; ?>"
                                        alt="Ảnh lỗi"></div>
                                <div><?php echo $rowSaveCourse['cate_name']; ?></div>
                            </div>
                        </div>
                        <center>
                            <hr class="v_content-2-hr">
                        </center>
                        <div class="v_batdauhoc">
                            <?php 
                            $user_id = $_COOKIE['user_id'];
                            $qrOrder = new db_query("SELECT * FROM orders INNER JOIN courses ON orders.course_id = courses.course_id WHERE user_student_id = $user_id AND orders.course_id = " . $rowSaveCourse['course_id']);
                            $qrOrder2 = new db_query("SELECT * FROM order_student_common WHERE user_student_id = $user_id AND course_id = " . $rowSaveCourse['course_id']);
                            $rowOrder = mysql_fetch_array($qrOrder->result);
                            if (mysql_num_rows($qrOrder->result) > 0 || mysql_num_rows($qrOrder2->result) > 0) {
                                if ($rowSaveCourse['course_type'] == 2) {
                                    echo '<a><button class="v_damua2">ĐÃ MUA</button></a>';
                                }else if ($rowSaveCourse['course_type'] == 1){
                                    echo '<a><button class="v_damua2">ĐÃ ĐẶT CHỖ</button></a>';
                                }
                            }else{
                                if ($rowSaveCourse['course_type'] == 2) {
                                    echo '<a href="/mua-khoa-hoc-ngay/id'.$_COOKIE['user_id'].'-course'.$rowSaveCourse['course_id'].'.html"><button>MUA
                                    NGAY</button></a>';
                                }else if ($rowSaveCourse['course_type'] == 1){
                                    echo '<a data-course="'.$rowSaveCourse['course_id'].'" onclick="v_dadat_cho(this)"><button>ĐẶT CHỖ</button></a>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                                }
                            }?>
                </div>
            </div>
            <!-- End: content-4 -->

            <hr class="v_content-hr">
            <!-- Begin: content-5 -->
            <div id="v_content-5">
                <div class="flex v_tieude">
                    <div class="v_cap"><img class="lazyload" src="/img/load.gif" data-src="../img/solution 1.png"
                            alt="Ảnh lỗi"></div>
                    <div class="v_content-2-title" id="v_kh_da_luu2">KHÓA HỌC PHÙ HỢP</div>
                </div>
                <div id="v_course_fit" class="v_khoaonline-1">
                    <?php
        //Lấy khóa học phù hợp
            $qrFit = new db_query("SELECT * FROM courses INNER JOIN users ON courses.user_id = users.user_id INNER JOIN levels ON courses.level_id = levels.level_id INNER JOIN categories ON courses.cate_id = categories.cate_id WHERE courses.cate_id IN ". $cate_fit ." AND courses.price_listed != -1 AND courses.hide_course = 1 AND courses.accept = 1 ORDER BY courses.course_id DESC LIMIT 0,3");
            if(mysql_num_rows($qrFit->result)==0){
                                echo '<div class="emptys">Chưa có dữ liệu</div>';
                            }else{
                                while ($rowFit = mysql_fetch_array($qrFit->result)) {
                                    if ($rowFit['course_type'] == 1) {
                                        $rate = 0;
                                        $qrRate = new db_query("SELECT lesson, teacher FROM rate_course WHERE course_id = " . $rowFit['course_id']);
                                        while ($rowR = mysql_fetch_array($qrRate->result)) {
                                            $rate = $rate + ($rowR['lesson'] + $rowR['teacher'])/2;
                                        }
                                    } elseif ($rowFit['course_type'] == 2) {
                                        $qrRate = new db_query("SELECT lesson, teacher, video FROM rate_course WHERE course_id = " . $rowFit['course_id']);
                                        $rate = 0;
                                        while ($rowR = mysql_fetch_array($qrRate->result)) {
                                            $rate = $rate + ($rowR['lesson'] + $rowR['teacher'] + $rowR['video'])/3;
                                        }
                                    }
                                    if ($rate == 0) {
                                        $rate_count = 1;
                                    } else {
                                        $rate_count = mysql_num_rows($qrRate->result);
                                    }
                                    $rate = $rate/$rate_count; ?>
                    <div class="v_course_fit v_khoaonline">
                        <?php
                $qrSave = new db_query("SELECT save_id FROM save_course WHERE user_student_id = '$user_id' AND course_id = " . $rowFit['course_id']);
                                    if (mysql_num_rows($qrSave->result) > 0) {
                                        $srcHeart = '../img/heart-yellow2.svg';
                                    } else {
                                        $srcHeart = '../img/wpf_like(3).svg';
                                    } ?>
                        <button value="<?php echo $rowFit['course_id']; ?>" class="v_trai-tim"><img
                                class="lazyload v_save_fit2" onclick="v_Save_Course(this)" src="/img/load.gif"
                                data-src="<?php echo $srcHeart; ?>" alt="Ảnh lỗi"></button>
                        <div class="v_pos">
                            <div class="v_gv v_gv_img">
                                <div><img class="v_fit_img lazyload"
                                        onerror="this.onerror=null;this.src='../img/avatar/error.png';"
                                        src="/img/load.gif"
                                        data-src="../img/avatar/<?php echo $rowFit['user_avatar']; ?>" alt="Ảnh lỗi">
                                </div>
                                <div>
                                    <?php if ($rowFit['user_type'] == 2) {
                                        $link_teach = urlDetail_teacher($rowFit['user_id'], $rowFit['user_slug']);
                                    } elseif ($rowFit['user_type'] == 3) {
                                        $link_teach = urlDetail_center($rowFit['user_id'], $rowFit['user_slug']);
                                    } ?>
                                    <a href="<?php echo $link_teach; ?>">
                                        <p><?php echo $rowFit['user_name']; ?></p>
                                    </a>
                                    <?php
                            $arr_cate_id = explode(",", $rowFit['cate_id']);
                                    $cate_name = "";
                                    for ($i = 0; $i < count($arr_cate_id); $i++) {
                                        $cate_id = $arr_cate_id[$i];
                                        $qrCate = new db_query("SELECT cate_name FROM categories WHERE cate_id = '$cate_id'");
                                        $rowCate = mysql_fetch_array($qrCate->result);
                                        if ($i == count($arr_cate_id) - 1) {
                                            $cate_name = $cate_name . $rowCate['cate_name'];
                                        } else {
                                            $cate_name = $cate_name . $rowCate['cate_name'] . ",";
                                        }
                                    } ?>
                                    <p class="v_gv-div-p">
                                        <?php echo $cate_name; ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                    if ($rowFit['user_avatar'] == 0) {
                        $teacher_avatar = '../img/v_avatar_default.png';
                    } else {
                        $teacher_avatar = '../img/avatar/' . $rowFit['user_avatar'];
                    }

                                    if ($rowFit['user_type'] == 2) {
                                        $link_teach = urlDetail_teacher($rowFit['user_id'], $rowFit['user_slug']);
                                    } elseif ($rowFit['user_type'] == 3) {
                                        $link_teach = urlDetail_center($rowFit['user_id'], $rowFit['user_slug']);
                                    } ?>
                            <img class="v_khoaonline-background lazyload"
                                onerror="this.onerror=null;this.src='../img/avatar/error.png';" src="/img/load.gif"
                                data-src="../img/course/<?php echo $rowFit['course_avatar'] ?>" alt="Ảnh lỗi">
                        </div>
                        <a href="<?php echo urlDetail_courseOnline($rowFit['course_id'], $rowFit['course_slug']); ?>">
                            <div class="v_khoaonline-title"><?php echo $rowFit['course_name']; ?></div>
                        </a>
                        <div id="v_star" class="flex">
                            <?php
                  for ($i = 1; $i <= $rate; $i++) {
                      ?>
                            <div class="v_star"><img class="lazyload" src="/img/load.gif"
                                    data-src="../img/bi_star-fill.svg" alt="Ảnh lỗi"></div>
                            <?php
                  } ?>
                        </div>
                        <?php
            $qrOrder = new db_query("SELECT order_id FROM orders WHERE course_id = " . $rowFit['course_id']);
                                    $qrOrderCommon = new db_query("SELECT order_student_id FROM order_student_common WHERE course_id = " . $rowFit['course_id']); ?>
                        <div class="v_songuoidk">
                            <?php echo mysql_num_rows($qrOrder->result) + mysql_num_rows($qrOrderCommon->result); ?> học
                            viên đã đăng kí khóa học</div>
                        <div class="flex v_info">
                            <div class="v_info-detail flex">
                                <div><img class="lazyload" src="/img/load.gif" data-src="../img/chung-chi.svg"
                                        alt="Ảnh lỗi"></div>
                                <?php
                    if ($rowFit['certification'] == 1) {
                        $certification = 'Cấp chứng chỉ';
                    } else {
                        $certification = 'Không cấp chứng chỉ';
                    } ?>
                                <div><?php echo $certification; ?></div>
                            </div>
                            <div class="v_info-detail flex">
                                <div><img class="lazyload" src="/img/load.gif" data-src="../img/nguoi-moi.svg"
                                        alt="Ảnh lỗi"></div>
                                <div><?php echo $rowFit['level_name']; ?></div>
                            </div>
                            <div class="v_info-detail flex">
                                <div><img class="lazyload" src="/img/load.gif"
                                        data-src="../img/categories/<?php echo $rowFit['cate_icon']; ?>" alt="Ảnh lỗi">
                                </div>
                                <div><?php echo $rowFit['cate_name']; ?></div>
                            </div>
                        </div>
                        <center>
                            <hr class="v_content-2-hr">
                        </center>
                        <div class="flex v_giakhoahoc">
                            <div>
                                <?php
                                $price = $rowFit['price_promotional'];
                                if ($price == -1) {
                                    echo '<div class="v_gia">'.number_format($rowFit['price_listed']) . ' đ'.'</div>';
                                }else{
                                    echo '<div class="v_gia">'.number_format($rowFit['price_promotional']) . ' đ</div>
                                <div class="v_giamgia">'.number_format($rowFit['price_listed']) . ' đ</div>';
                                }
                                ?>
                            </div>
                            <?php 
                            $user_id = $_COOKIE['user_id'];
                            $qrOrder = new db_query("SELECT * FROM orders WHERE user_student_id = $user_id AND course_id = " . $rowFit['course_id']);
                            $qrOrder2 = new db_query("SELECT * FROM order_student_common WHERE user_student_id = $user_id AND course_id = " . $rowFit['course_id']);
                            if (mysql_num_rows($qrOrder->result) > 0 || mysql_num_rows($qrOrder2->result) > 0) {
                                if ($rowFit['course_type'] == 2) {
                                    echo '<div class="v_muangay"><a><button class="v_damua2">ĐÃ MUA</button></a></div>';
                                }else{
                                    echo '<div class="v_muangay"><a><button class="v_damua2">ĐÃ ĐẶT CHỖ</button></a></div>';
                                }
                            }else{
                                if ($rowFit['course_type'] == 2) {
                                    echo '<div class="v_muangay"><a
                                    href="/mua-khoa-hoc-ngay/id'.$_COOKIE['user_id'].'-course'.$rowFit['course_id'].'.html"><button>MUA
                                        NGAY</button></a></div>';
                                }else{
                                    echo '<div class="v_muangay"><a href="'.urlDetail_courseOffline($rowFit['course_id'],$rowFit['course_slug']).'"><button>CHI TIẾT</button></a></div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                                }
                            }
    ?>
                    <button id="v_fit" onclick="more_fit(3)"><a>XEM THÊM</a></button>
                </div>

            </div>
            <!-- End: content-5 -->
        </div>

        <!-- End: content -->
    </div>
    </div>
    </div>
    <!-- Begin: foooter -->
    <?php require_once("../includes/h_inc_footer.php"); ?>
    <!-- End: footer -->
</body>
<script src="../js/v-main.js?v=<?=$version?>"></script>
<script type="text/javascript">
if ($("#online_buy").children('.v_khoaonline').length < 3) {
    $("#v_buy_online").remove();
}

if ($("#offline_buy").children('.v_khoaonline').length < 3) {
    $("#v_buy_offline").remove();
}

if ($("#v_course_fit").children('.v_khoaonline').length < 3) {
    $("#v_fit").remove();
}

function v_dadat_cho(e) {
    var course_id = $(e)[0].dataset.course;
    $.ajax({
        url: '../ajax/v_ajax_dat_cho.php',
        type: 'GET',
        dataType: 'json',
        data: {
            course_id: course_id
        },
        success: function () {
            alert("Đặt chỗ thành công");
            $(e).find('button').css('background', 'green');
            $(e).find('button').text('ĐÃ ĐẶT CHỖ');
        },
        error: function () {
            alert("Có lỗi xảy ra. Vui lòng thử lại");
        }
    });
    
}

function v_Save_Course(e) {
    console.log($(e).parent(".v_trai-tim").val());
    if ($(e).attr('src') == '../img/wpf_like(3).svg') {
        $(e).attr('src', '../img/heart-yellow2.svg');
    } else {
        $(e).attr('src', '../img/wpf_like(3).svg');
    }

    $.ajax({
        url: '../ajax/v_ajax_save_course_hv_index.php',
        type: 'GET',
        dataType: 'json',
        data: {
            course_id: $(e).parent(".v_trai-tim").val()
        },
    });
};

function more_fit(page) {
    $.ajax({
        url: '../ajax/v_more_fit.php',
        type: 'GET',
        dataType: 'json',
        data: {
            page: page
        },
        success: function(data) {
            $("#v_course_fit").append(data.html);
            $("#v_fit").remove();
            $("#v_course_fit").append(data.more);
            if ($("#v_course_fit").children('.v_course_fit').length ==
                <?php echo mysql_num_rows($qrFitAll->result); ?>) {
                $("#v_fit").remove();
            }
        },
        error: function() {
            alert("Có lỗi xảy ra. Vui lòng thử lại");
        }
    });

}
</script>

</html>