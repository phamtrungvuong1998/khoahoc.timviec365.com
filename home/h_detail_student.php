<?php
require_once '../code_xu_ly/h_home.php';
$studentId = getValue('user_id', 'int', 'GET', '');
if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_type'])) {
    $user_id = $_COOKIE['user_id'];
    $user_type = $_COOKIE['user_type'];
} else {
    $user_id = 0;
    $user_type = 0;
}
$v_id = getValue('user_id', 'str', 'GET', '');

$qrHV = new db_query("SELECT user_name, user_phone, user_mail,user_avatar,cit_id,cate_id FROM users WHERE user_id = '$v_id'");

$rowHV = mysql_fetch_array($qrHV->result);
$cate_id = $rowHV['cate_id'];
$arr_cate_id2 = explode(",", $cate_id);
//Lấy học viên có cùng tỉnh, thành phố và môn học quan tâm
$v_user_cit_id = $rowHV['cit_id'];
$qrHV_city = new db_query("SELECT * FROM users INNER JOIN city ON city.cit_id = users.cit_id WHERE users.user_avatar != '0' AND users.user_birth != '0000-00-00' AND users.cit_id != '0' AND users.cate_id != '0' AND users.cit_id = '$v_user_cit_id' AND users.user_type = 1 AND users.user_id != $studentId ORDER BY users.user_id DESC LIMIT 0,6");

$qrHV_city_sum = new db_query("SELECT * FROM users INNER JOIN city ON city.cit_id = users.cit_id WHERE users.user_avatar != '0' AND users.user_birth != '0000-00-00' AND users.cit_id != '0' AND users.cate_id != '0' AND users.user_type = 1 AND users.cit_id = '$v_user_cit_id' AND users.user_id != $studentId");
$rowHV_city = mysql_fetch_array($qrHV_city->result);

//Lấy tỉnh, thành phố
$qrCity = new db_query("SELECT `cit_name` FROM `city` WHERE `cit_id` = '$v_user_cit_id'");
$rowCity = mysql_fetch_array($qrCity->result);

//Cắt email theo định dạng vuong*****@email.com
$v_email = $rowHV['user_mail'];

$v_index_email = strpos($v_email, '@');

$v_index_email_3 = substr($v_email, 3, $v_index_email - 3);

$array_email = explode($v_index_email_3, $v_email);

$e = "";

for ($i = 0; $i < strlen($v_index_email_3); $i++) {
    $e = $e . "*";
}

$email = $array_email[0] . $e . $array_email[1];

if (!isset($_COOKIE['user_type'])) {
    $lg = 0;
} else {
    $lg = 1;
}

//Số lượng khóa học đã mua
$qrOder = new db_query("SELECT order_id FROM orders WHERE user_student_id = '$v_id'");
$qrOderCommon = new db_query("SELECT order_student_id FROM order_student_common WHERE user_student_id = '$v_id'");
$rowOrderCount = mysql_num_rows($qrOder->result) + mysql_num_rows($qrOderCommon->result);

// mua từ điểm
$db_point = new db_query("SELECT * FROM history_point INNER JOIN users ON user_id = center_teacher_id Where center_teacher_id = '$user_id' AND user_student_id = '$v_id'");
$db_ps = new db_query("SELECT * FROM points Where user_id = '$user_id'");
$point = mysql_fetch_assoc($db_point->result);
$diem = mysql_fetch_assoc($db_ps->result);

$qrHVAll = new db_query("SELECT cate_id FROM users WHERE user_avatar != '0' AND user_birth != '0000-00-00' AND cit_id != '0' AND cate_id != '0' AND user_type = 1");
while ($rowHVAll = mysql_fetch_array($qrHVAll->result)) {
    $arrayCate = explode(",", $rowHVAll['cate_id']);
    for ($i = 0; $i < count($arrayCate); $i++) {
        $cate_id = $arrayCate[$i];
        if (!isset($v_array_keyword[$cate_id])) {
            $v_array_keyword[$cate_id] = 1;
        } else {
            $v_array_keyword[$cate_id]++;
        }
    }
}

arsort($v_array_keyword);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="google-site-verification" content="EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU" />
    <title><?php echo $rowHV['user_name']; ?></title>
    <link rel="preload" href="/css/h_student.css?v=<?=$version?>" as="style">
    <?require_once '../includes/h_inc_css.php';?>
    <link rel="stylesheet" href="../css/h_student.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/v_popup_choose_login.css?v=<?=$version?>">
    <style>
        .all-student{
            display: flex;
            flex-wrap: wrap;
            margin-left: 0;
            margin-right: 0;
        }
    </style>
</head>

<body style="position: relative;">
    <div id="popup_choose_login" style="display: none;">
        <center id="popup_choose_login_detail">
            <div id="v_choose_login">LỰA CHỌN ĐĂNG NHẬP</div>
            <div><button class="v_login_gv_tt" data-type="2">GIẢNG VIÊN</button></div>
            <div><button class="v_login_gv_tt" data-type="3">TRUNG TÂM</button></div>
        </center>
    </div>
    <!-- HEADER -->
    <?php
    include '../includes/h_inc_header.php';
    ?>
    <!-- END: HEADER -->

    <!--SEARCH-->
    <?php
    include '../includes/h_inc_search.php';
    ?>
    <!--END: SEARCH-->

    <!-- MAIN -->
    <main>
        <div id="breadcrumb">
            <div class="container">
                <ol>
                    <li><a href="/">Trang chủ</a></li>
                    <li style="font-size: 18px;">></li>
                    <li>Danh sách học viên</li>
                    <li style="font-size: 18px;">></li>
                    <li><?php echo $rowHV['user_name']; ?></li>
                </ol>
            </div>
        </div>
        <!--Detail Main-->
        <div class="container">
            <div id="detail-student">
                <div class="detail-student1">
                    <div class="detail1">
                        <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload"
                            src="/img/load.gif" data-src="../img/avatar/<?php echo $rowHV['user_avatar']; ?>">
                    </div>
                    <ul class="detail2">
                        <li>
                            <h3><?php echo $rowHV['user_name']; ?></h3>
                        </li>
                        <?
                        if ($point > 0 && $point['user_type'] > 1) {
                        ?>
                        <li><img class="lazyload" src="/img/load.gif"
                                data-src="../img/image/phoneblue.svg"><?php echo $rowHV['user_phone']; ?></li>
                        <li><img class="lazyload" src="/img/load.gif"
                                data-src="../img/image/mailblue.svg"><?php echo $rowHV['user_mail']; ?></li>
                        <?
                        } elseif(!isset($_COOKIE['user_id']) || $cookie_type == 1) {
                        ?>
                        <li>
                            <div class="myBtn" id="l_phone" onclick="l_phone_email()">
                                <img class="lazyload" src="/img/load.gif"
                                    data-src="../img/image/phoneblue.svg"><?php echo '09*****' ?>
                            </div>
                        </li>
                        <li>
                            <div class="myBtn" id="l_mail" onclick="l_phone_email()">
                                <img src="../img/image/mailblue.svg"><?php echo $email; ?>
                            </div>
                        </li>
                        <?
                    } else {
                    ?>
                        <li>
                            <div class="myBtn" id="l_phone" onclick="l_index_popup(<?php echo $user_id; ?>)">
                                <img src="../img/image/phoneblue.svg"><?php echo '09*****' ?>
                            </div>
                        </li>
                        <li>
                            <div class="myBtn" id="l_mail" onclick="l_index_popup(<?php echo $user_id; ?>)">
                                <img src="../img/image/mailblue.svg"><?php echo $email; ?>
                            </div>
                        </li>
                        <?
                    }
                    ?>
                    </ul>
                </div>
                <!-- <button id="myBtn">Open Modal</button> -->

                <!-- The Modal -->
                <div id="l_myModal" class="l_modal">
                    <!-- Modal content -->
                    <div class="l_modal-content">
                        <div class="l_modal-header">
                            <span onclick="l_close_popup();" class="l_close">&times;</span>
                            <h2>Thông báo</h2>
                        </div>
                        <div class="l_modal-body">
                            <?php 
                            if ($diem['point'] == 1) {
                                echo '<p>Bạn đang có 1 lượt xem miễn phí bạn có muốn xem
                                thông tin của học viên không ?
                            </p>';
                            }else if ($diem['point'] == 0){
                                echo '<p>Bạn sẽ mất '.number_format(10000).' đ để xem thông tin học viên. Bạn có muốn xem thông tin của học viên không ?</p>';
                            }
                            ?>
                        </div>
                        <div class="l_modal-footer">
                            <div class="l_text">
                                <button onclick="l_confirm(<? echo $diem['point']; ?>,<? echo $v_id; ?>)"
                                    class="l_btn">Đồng ý</button>
                                <button onclick="l_close_popup();" id="l_cancel" class="l_btn l_color">Quay lại</button>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="detail-student2">
                    <div class="detail3">
                        <img src="../img/image/chungchihoanthanh.svg">
                        <p>Môn học quan tâm</p>
                        <span><?php 
                        $cateHV = explode(",", $rowHV['cate_id']);
                        $j = "";
                        for ($i = 0; $i < count($cateHV); $i++) {
                            $qrCateHV = new db_query("SELECT cate_name FROM categories WHERE cate_id = " . $cateHV[$i]);
                            $rowCateHV = mysql_fetch_array($qrCateHV->result);
                            if ($i == count($cateHV) - 1) {
                                echo $j . $rowCateHV['cate_name'];
                            }else{
                                echo $j . $rowCateHV['cate_name'] . ", ";
                            }
                        }
                        ?></span>
                    </div>
                    <div class="detail4">
                        <img src="../img/image/khoahocdamua.svg">
                        <p><?php echo $rowOrderCount; ?></p>
                        <span>Khóa học đã mua</span>
                    </div>
                </div>
            </div>
            <div id="category-student">
                <hr>
                <h2>Học viên liên quan</h2>
                <div class="all-student">
                    <?php 
                    $care_user_id = [];
                    // print_r($arr_cate_id2);
                    while ($rowHV_city = mysql_fetch_array($qrHV_city->result)) {
                        $care_cate = explode(",", $rowHV_city['cate_id']);
                        $v_student_id = $rowHV_city['user_id'];
                        $v_qrSave = new db_query("SELECT `save_id` FROM `save_student` WHERE `user_student_id` = '$v_student_id' AND `user_teacher_id` = '$user_id'");
                        $v_rowSave = mysql_fetch_array($v_qrSave->result);
                        for ($i = 0; $i < count($arr_cate_id2); $i++) {
                            $v = $i;
                            for ($j = 0; $j < count($care_cate); $j++) {
                                if ($arr_cate_id2[$v] == $care_cate[$j]) {
                                    if (!in_array($rowHV_city['user_id'], $care_user_id)) {
                    ?>
                    <div class="student-item">
                        <div class="item">
                            <img src="/img/load.gif" data-src="<?php
                                            if (!isset($v_rowSave['save_id'])) {
                                                echo '../img/image/paperyellow1.svg';
                                            } else {
                                                echo '../img/paperyellow.svg';
                                            }

                                            ?>" class="lazyload item-img"
                                id="item-img-<?php echo $rowHV_city['user_id']; ?>"
                                onclick="item_img(<?php echo $rowHV_city['user_id']; ?>, <?php echo $lg; ?>)"
                                style="cursor: pointer;" alt="Ảnh lỗi">
                        </div>
                        <div class="item1">
                            <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload"
                                src="/img/load.gif" data-src="../img/avatar/<?php echo $rowHV_city['user_avatar']; ?>">
                            <a href="<?php echo urlDetail_student($rowHV_city['user_id'], $rowHV_city['user_slug']) ?>">
                                <h3><?php echo $rowHV_city['user_name']; ?></h3>
                            </a>
                        </div>
                        <div class="item2">
                            <ul>
                                <?php
                                    $arrayCate = explode(",", $rowHV_city['cate_id']);
                                    $cate_name = '';
                                    for ($i = 0; $i < count($arrayCate); $i++) {
                                        $cate_id = $arrayCate[$i];
                                        $qrCate = new db_query("SELECT `cate_name` FROM `categories` WHERE `cate_id` = '$cate_id'");
                                        $rowCate = mysql_fetch_array($qrCate->result);
                                        if ($i == count($arrayCate) - 1) {
                                            $cate_name = $cate_name . $rowCate['cate_name'];
                                        } else {
                                            $cate_name = $cate_name . $rowCate['cate_name'] . ",";
                                        }
                                    }
                                    ?>
                                <li>
                                    <div><img src="../img/image/video1.svg"></div>
                                    <span class="v_cate_name">
                                        Môn học quan tâm : <?php echo $cate_name; ?>
                                    </span>
                                </li>
                                <li>
                                    <div style="margin-left: 3px;"><img src="../img/image/dailydate.svg"></div>
                                    <?php echo $rowHV_city['user_birth']; ?>
                                </li>
                                <li>
                                    <div><img class="lazyload" src="/img/load.gif"
                                            data-src="../img/image/markerblue.svg"></div>
                                    <?php echo $rowHV_city['cit_name']; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                        <?php
                                        $cate_user_id[] = $rowHV_city['user_id'];     
                                    } 
                                }
                            }
                        }
                    }
                        ?>
                    <button id="xemthem" onclick="more_student(16,<?php echo $v_user_cit_id; ?>)"><a>XEM
                            THÊM</a></button>
                </div>
            </div>
            <div id="keyword">
                <hr>
                <h2>Từ khóa phổ biến</h2>
                <?php
                $k = 1;
                foreach ($v_array_keyword as $key => $value) {
                    $qrKeyword = new db_query("SELECT * FROM `categories` WHERE `cate_id` = '$key'");
                    $rowKeyword = mysql_fetch_array($qrKeyword->result);
                    if ($k <= 3) {
                        $value_old = $value;
                ?>
                <div class="all-keyword">
                    <a
                        href="<?= urlOnline_cate($rowKeyword['cate_id'], $rowKeyword['cate_slug']); ?>"><?php echo $rowKeyword['cate_name'] . ' ' . '(' . $value . ')'; ?></a>
                </div>
                <?php
                    } else if ($value_old == $value) {
                        $k--;
                    ?>
                <div class="all-keyword">
                    <a
                        href="<?= urlOnline_cate($rowKeyword['cate_id'], $rowKeyword['cate_slug']); ?>"><?php echo $rowKeyword['cate_name'] . ' ' . '(' . $value . ')'; ?></a>
                </div>
                <?php
                    } else {
                        break;
                    }
                    $k++;
                }
                ?>
            </div>
        </div>

    </main>
    <!--END: MAIN-->


    <!-- FOOTER -->
    <?php
    include '../includes/h_inc_footer.php';
    require_once '../includes/h_popup_dangnhap.php';
    ?>
    <!-- END: FOOTER -->
    <script src="../js/v_search.js?v=<?=$version?>"></script>
    <script src="../js/select2.min.js?v=<?=$version?>"></script>
    <script type="text/javascript">
    var user_type = <?php echo $user_type; ?>;
    if (user_type == 1) {
        $(".item-img").remove();
    }

    var sum = <?php echo mysql_num_rows($qrHV_city_sum->result); ?>;
    if (sum <= 8) {
        $("#xemthem").remove();
    }

    $(".v_login_gv_tt").click(function() {
        $("#choose_login_input").val($(this)[0].dataset.type);
        $("#popup_choose_login").fadeOut('fast',function () {
            $("#modal-login").modal("show");
        });
    });

    $("body").click(function() {
        if (event.target.id == "popup_choose_login") {
            $("#popup_choose_login").fadeOut('fast');
        }
    });

    function popuplogin() {
        var usermail = $('#usermail').val();
        var userpass = $('#userpass').val();
        if (usermail == '') {
            document.getElementById('error1').innerHTML = 'Hãy nhập Email !';
            return false;
        } else {
            document.getElementById('error1').style.display = "none";
        }
        if (userpass == '') {
            document.getElementById('error2').innerHTML =
                'Hãy nhập Mật khẩu !';
            return false;
        } else {
            document.getElementById('error2').style.display = "none";
        }
        $.ajax({
            url: "../ajax/h_ajax_popup_signin.php",
            type: "POST",
            data: {
                usermail: usermail,
                userpass: userpass,
                type: $("#choose_login_input").val()
            },
            dataType: 'json',
            success: function(data) {
                if (data.result == false) $('#error_ajax1').html(data.msg);
                else location.reload();
            }
        });
        return false;
    }

    function l_phone_email() {
        $("#popup_choose_login").fadeIn('fast');
    }

    function item_img(n, lg) {
        if (lg == 0) {
            // $("#modal-login").modal("show");
            $("#popup_choose_login").fadeIn('fast');
        } else if (lg == 1) {
            var id_item = "#item-img-" + n;
            if ($(id_item).attr("src") == "../img/image/paperyellow1.svg") {
                $(id_item).attr({
                    "src": "../img/paperyellow.svg"
                });
                $.get("../ajax/v_save_student.php", {
                    studentId: n,
                    status_save: 0
                }, function(data) {

                });
            } else {
                $(id_item).attr({
                    "src": "../img/image/paperyellow1.svg"
                });
                $.get("../ajax/v_save_student.php", {
                    studentId: n,
                    status_save: 1
                }, function(data) {

                });
            }
        }
    }

    function l_confirm(a, b) {
        var total = a;
        $.ajax({
            url: '../ajax/l_ajax_hienthiHvMuadiem.php',
            type: 'GET',
            dataType: 'json',
            data: {
                point: total,
                id: b
            },
            success: function (data) {
                if (data.result == false) {
                    alert("Bạn không đủ tiền. Vui lòng nạp thêm tiền");
                }else if (data.result == true) {
                    document.getElementById("l_myModal").style.display = "none";
                    $('#l_mail').html('');
                    $('#l_phone').html('');
                    $('#l_phone').append('<div id="l_phone" ><img src="../img/image/phoneblue.svg">' + data.phone +
                        '</div>');
                    $('#l_mail').append('<div id="l_mail"><img src="../img/image/mailblue.svg">' + data.email +
                        '</div>');
                    if (data.money != -1) {
                        $("#moneys").html('Số dư : <span>'+data.money+' đ</span>');
                    }
                }
            },
            error: function () {
                alert("Có lỗi xảy ra");
            }
        });
        
        // $.get("../ajax/l_ajax_hienthiHvMuadiem.php", {
        //     point: total,
        //     id: b,
        // }, function(data) {
        //     var arr = data.split("nhanh");
        //     if (arr.length > 1) {
        //         document.getElementById("l_myModal").style.display = "none";
        //         $('#l_mail').html('');
        //         $('#l_phone').html('');
        //         $('#l_phone').append('<div id="l_phone" ><img src="../img/image/phoneblue.svg">' + arr[1] +
        //             '</div>');
        //         $('#l_mail').append('<div id="l_mail"><img src="../img/image/mailblue.svg">' + arr[0] +
        //             '</div>');

        //     } else {
        //         alert(arr[0]);
        //     }
        // });
    }
    // }

    function more_student(n, cit_id) {
        $.ajax({
            url: '../ajax/v_more_student.php',
            type: 'GET',
            dataType: 'json',
            data: {
                n: n,
                cit_id: cit_id
            },
            success: function(data) {
                $("#xemthem").remove();
                $(".all-student").append(data.html);
                $(".all-student").append(data.more);
                if ($(".all-student").children('.student-item').length ==
                    <?php echo mysql_num_rows($qrHV_city_sum->result) ?>) {
                    $("#xemthem").remove();
                }
            }
        });

    }
    // var l_modal = document.getElementById("l_myModal");

    // var l_btn = document.getElementById("l_phone");
    // var l_mail = document.getElementById("l_mail");
    // var l_cancel = document.getElementById("l_cancel");
    // var l_span = document.getElementsByClassName("close")[0];
    function l_index_popup(user_id) {

        document.getElementById("l_myModal").style.display = "block";

    }

    function l_close_popup() {
        document.getElementById("l_myModal").style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == document.getElementById("l_myModal")) {
            document.getElementById("l_myModal").style.display = "none";
        }
    }
    // l_btn.onclick = function() {
    //     l_modal.style.display = "block";
    // }

    // When the user clicks on <span> (x), close the modal
    // l_cancel.onclick = function() {
    //     l_modal.style.display = "none";
    // }
    // l_span.onclick = function() {
    //     l_modal.style.display = "none";
    // }

    // When the user clicks anywhere outside of the modal, close it
    </script>
</body>

</html>