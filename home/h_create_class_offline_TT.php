    <?php
    require_once '../code_xu_ly/h_home.php';
    // require_once '../code_xu_ly/h_create_class_center.php';
    $id = getValue('id', 'int', 'GET', '');

    if ($_COOKIE['user_type'] != 3 && !isset($_COOKIE['user_id'])) {
        header("Location: /");
    } else if ($id != $_COOKIE['user_id']) {
        header("Location: /");
    }

    $db_cit = new db_query("SELECT cit_id,cit_name FROM city WHERE cit_parent = 0");

    while ($rowCit = mysql_fetch_array($db_cit->result)) {
        $a[$rowCit['cit_name']]['cit_id'] = $rowCit['cit_id'];
        $a[$rowCit['cit_name']]['cit_name'] = $rowCit['cit_name'];
    }


    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex,nofollow">
        <meta name="google-site-verification" content="EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU" />
        <title>Tạo khóa học offline</title>
        <link rel="stylesheet" href="../css/custom-bootstrap.css?v=<?=$version?>">
        <link rel="stylesheet" href="../css/h_footer.css?v=<?=$version?>">
        <link rel="stylesheet" href="../css/h_header-home.css?v=<?=$version?>">
        <link rel="stylesheet" href="../css/h_nav_search.css?v=<?=$version?>">
        <link rel="stylesheet" href="../css/select2.min.css?v=<?=$version?>" />
        <link rel="stylesheet" href="../css/h_postclass.css?v=<?=$version?>">
        <style>
        .container {
            position: relative;
        }

        [id*=v_course-] {
            color: red;
        }

        [id*=v_teacher-] {
            color: red;
        }

        .delele_basis {
            width: 15px;
            height: 15px;
            top: 0;
            right: 0;
            cursor: pointer;
            float: right;
        }
        </style>
    </head>

    <body>
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
                        <li>Tạo bài giảng</li>
                    </ol>
                </div>
            </div>

            <div class="container">
                <div id="v_alert"></div>
                <div id="main-post">
                    <form onsubmit="return v_course();" name="v_create_center" enctype="multipart/form-data">
                        <div class="first">
                            <hr>
                            <h3>Thông tin cơ bản</h3>
                            <div class="container">
                                <div class="form-group">
                                    <label id="v_label_1">Tên khóa học</label>
                                    <div class="first1">
                                        <input id="course_name" name="course_name" onkeyup="count_course_name()"
                                            type="text"
                                            value="<?php if (isset($_POST['time_learn'])) echo $_POST['time_learn'] ?>">
                                        <div class="first2 count_kitu" id="first2">0/120</div>
                                        <a href="" id="v_link_validation"></a>
                                    </div>
                                </div>
                                <p id="v_course-1"></p>
                                <div class="first3">
                                    <div class="form-group cate_tag_id">
                                        <label id="v_label_2">Môn học</label>
                                        <select class="cate2" id="cate_id" name="cate_id">
                                            <option value="0">Chọn Môn học</option>
                                            <?
                                            $db_cate = new db_query("SELECT * FROM categories");
                                            while ($rowCate = mysql_fetch_array($db_cate->result)) {
                                            ?>
                                            <option
                                                <?php if (isset($_POST['cate_id']) && $_POST['cate_id'] == $row['cate_id']) echo 'selected' ?>
                                                class="catet2db" value="<?= $rowCate['cate_id'] ?>">
                                                <?= $rowCate['cate_name'] ?>
                                            </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <p id="v_course-2"></p>
                                    </div>

                                    <div class="form-group cate_tag_id">
                                        <label>Môn học chi tiết</label>
                                        <select class="tag2" name="tag_id" id="tag_id">
                                            <option value="0">Chọn môn học chi tiết</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="post12" id="ava-off">
                                    <img id="avatar" src="../img/image/white.svg">
                                    <button type="button" class="postimg camera-img"><img
                                            src=" ../img/image/addimg.svg">Ảnh khóa học</button>
                                    <input type="file" class="hidden" id="img" onchange="changeImg(this)"
                                        name="course_avatar">
                                </div>
                                <div class="form-group">
                                    <label id="v_label_3">Mô tả khóa học</label>
                                    <textarea id="description"
                                        name="course_describe"><?php if (isset($_POST['course_describe'])) echo $_POST['course_describe'] ?></textarea>
                                </div>
                                <p id="v_course-3"></p>
                                <div class="form-group">
                                    <label id="v_label_4">Bạn sẽ học những gì</label>
                                    <textarea id="get_what"
                                        name="course_learn"><?php if (isset($_POST['course_learn'])) echo $_POST['course_learn'] ?></textarea>
                                </div>
                                <p id="v_course-4"></p>
                                <div class="form-group">
                                    <label id="v_label_5">Đối tượng học viên</label>
                                    <textarea id="object"
                                        name="course_object"><?php if (isset($_POST['course_object'])) echo $_POST['course_object'] ?></textarea>
                                </div>
                                <p id="v_course-5"></p>
                                <div class="form-group">
                                    <label id="v_label_6">Giảng viên giảng dạy</label>
                                    <select class="teach2" name="center_teacher_id" onchange="v_teach3()" id="teach2">
                                        <option value="0">Lựa chọn giảng viên dạy</option>
                                        <?php
                                        $qr = new db_query("SELECT `center_teacher_id`,`teacher_name` FROM `user_center_teacher` WHERE user_id = $cookie_id");
                                        while ($row = mysql_fetch_array($qr->result)) {
                                        ?>
                                        <option value="<?php echo $row['center_teacher_id']; ?>">
                                            <?php echo $row['teacher_name']; ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                    <p id="v_course-6"></p>
                                    <div class="first4" id="first4">
                                        <span>( Nếu chưa có giảng viên, ấn vào đây để thêm )</span>
                                        <a data-toggle="modal" data-target="#addteacher"><img
                                                src="../img/image/add1.svg">Thêm giảng viên</a>
                                    </div>

                                </div>
                                <div class="first3">
                                    <div class="form-group time_learn_slide">
                                        <label id="v_label_7">Số buổi học</label>
                                        <div class="first1">
                                            <input id="time_learn" name="time_learn" type="text" onkeypress="isnumber(event)" value="<?php if (isset($_POST['time_learn'])) echo $_POST['time_learn'] ?>">
                                            <div class="first2">Buổi</div>
                                        </div>
                                        <p id="v_course-7"></p>
                                    </div>
                                    <div class="form-group time_learn_slide">
                                        <label>Tài liệu học</label>
                                        <div class="first1">
                                            <input id="slide" name="course_slide" type="text" onkeypress="isnumber(event)"
                                                value="<?php if (isset($_POST['course_slide'])) echo $_POST['course_slide'] ?>">
                                            <div class="first2">Slide</div>
                                        </div>
                                        <p id="v_course-13"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post6">
                            <hr>
                            <h3>Thông tin bán hàng</h3>
                            <div class="post61">
                                <div class="form-group">
                                    <label id="v_label_8">Giá gốc</label>
                                    <div class="priceinput">
                                        <input type="text" id="v_gia_goc" name="price_listed" placeholder="Nhập vào"
                                            onkeypress="isnumber(event)"
                                            value="<?php if (isset($_POST['price_listed'])) echo $_POST['price_listed'] ?>">
                                        <div class="priced">đ</div>
                                    </div>
                                    <p id="v_course-8"></p>
                                </div>
                                <div class="form-group">
                                    <label id="v_label_9">Giá khuyến mại</label>
                                    <div class="priceinput">
                                        <input type="text" id="v_gia_km" name="price_promotional"
                                            onkeypress="isnumber(event)"
                                            value="<?php if (isset($_POST['price_promotional'])) echo $_POST['price_promotional'] ?>"
                                            placeholder="Nhập vào">
                                        <div class="priced">đ</div>
                                    </div>
                                    <p id="v_course-9"></p>
                                </div>
                                <!-- <div class="form-group" id="clearaddprice">
                                    <label id="v_label_9">Mua nhiều giảm giá</label>
                                    <div class="priceinput">
                                        <div class="postright31 addprices" id="addprices">
                                            <p><img src="../img/image/add2.svg">Thêm khoảng giá</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group addnewprices" id="addnewprice">
                                    <label id="v_label_9">Mua nhiều giảm giá</label>
                                    <div class="newprices">
                                        <div class="stdnumber">
                                            <div class="stdnumber1">
                                                <label id="v_label_12">Số lượng ( học viên)</label>
                                                <input type="text" id="v_quantity_std" onkeypress="v_isnumber(event)" value="0" name="quantity_std"
                                                    onkeypress="isnumber(event)"
                                                    value="<?php if (isset($_POST['quantity_std'])) echo $_POST['quantity_std'] ?>"
                                                    placeholder="3">
                                                <p id="v_course-12"></p>
                                            </div>
                                            <div class="stdnumber2">
                                                <label>Giá</label>
                                                <input type="text" name="price_discount" id="price_discount"
                                                    onkeypress="isnumber(event)"
                                                    value="<?php if (isset($_POST['price_discount'])) echo $_POST['price_discount'] ?>">
                                            </div>
                                            <p id="v_course-14"></p>
                                            <img class="trash" src="../img/image/trash.svg">
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="first">
                            <hr>
                            <h3>Chứng chỉ</h3>
                            <div class="second">
                                <div class="form-group">
                                    <input
                                        <?php if (isset($_POST['qualification']) && $_POST['qualification'] == 1) echo 'checked' ?>
                                        type="radio" id="v_yes" value="1" name="qualification">
                                    <label id="v_label_10">Có</label>
                                </div>
                                <div class="form-group">
                                    <input
                                        <?php if (isset($_POST['qualification']) && $_POST['qualification'] == 2) echo 'checked' ?>
                                        type="radio" value="2" name="qualification">
                                    <label>Không</label>
                                </div>
                            </div>
                            <p id="v_course-10"></p>
                        </div>
                        <div class="first">
                            <hr>
                            <h3 id="v_label_11">Trình độ</h3>
                            <div class="second2">
                                <?
                                $db_lv = new db_query("SELECT * FROM `levels`");
                                while ($row = mysql_fetch_array($db_lv->result)) {
                                ?>
                                <div class="form-group">
                                    <input
                                        <?php if (isset($_POST['level_id']) && $_POST['level_id'] == $row['level_id']) echo 'checked' ?>
                                        type="radio" id="level<?php echo $row['level_id']; ?>" name="v_level"
                                        value="<?= $row['level_id'] ?>">
                                    <label><?= $row['level_name'] ?></label>
                                </div>
                                <?
                                }
                                ?>
                            </div>
                            <p id="v_course-11"></p>
                        </div>
                        <div class="first">
                            <hr>
                            <h3>Thời gian học</h3>
                            <div class="second">
                                <div class="form-group month_study1">
                                    <input type="text" name="month_study" id="month_study" placeholder="VD: 6 tháng"
                                        onkeypress="isnumber(event)"
                                        value="<?php if (isset($_POST['month_study'])) echo $_POST['month_study'] ?>">
                                    <div class="first2">Tháng</div>
                                </div>
                            </div>
                            <p id="v_course-16"></p>
                        </div>
                        <div class="first">
                            <hr>
                            <h3>Địa điểm học</h3>
                            <div class="second3">
                                <div class="form-group" id="allcoso">
                                    <div class="v_course_basis" id="v_course_basis1">
                                        <input type="text" id="v_basis-1" name="v_basis[]" placeholder="Cơ sở :"
                                            class="coso">
                                        <select id="v_city-1" class="city2" onchange="v_city2(1)" name="v_city[]">
                                            <option value="0">Tỉnh, thành phố</option>
                                            <?php
                                            foreach ($a as $key => $value) {
                                            ?>
                                            <option class="chontinhthanh" value="<?php echo $value['cit_id'] ?>">
                                                <?php echo $value['cit_name'] ?>
                                            </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <select name="v_district[]" id="v_district-1" class="district2">
                                        <option value="0">Quận, huyện</option>
                                        </select>
                                        <input type="text" id="v_address-1" name="address[]"
                                            placeholder="số nhà, ngõ, ngách, đường, phố" class="address">
                                        <img class="delele_basis" id="v_delete_basis1" onclick="v_delete_basis(1)"
                                            src="../img/v_delete.png" alt="Ảnh lỗi">
                                    </div>
                                </div>
                                <div class="postright31 addcoso" id="addcoso" onclick="addcoso()">
                                    <img src="../img/image/add2.svg">
                                    <p>Thêm Cơ sở</p>
                                </div>
                            </div>
                        </div>
                        <div class="first">
                            <hr>
                            <h3>Ưu điểm trung tâm</h3>
                            <div class="second4">
                                <?
                                $db_adv = new db_query("SELECT * FROM advantages_center");
                                while ($row = mysql_fetch_array($db_adv->result)) {
                                ?>
                                <div class="form-group">
                                    <input type="checkbox"
                                        <?php if (isset($_POST['advantages_id']) && $_POST['advantages_id'] == $row['advantages_id']) echo 'checked' ?>
                                        class="advantages_id" name="advantages_id[]"
                                        value="<?= $row['advantages_id'] ?>">
                                    <label><?= $row['advantages_name'] ?></label>
                                </div>
                                <?php
                                }
                                ?>
                                <!-- <div class="form-group">
                                    <input id="addtienich" name="addtienich" type="text"
                                        placeholder="Nhập thêm tiện ích khác">
                                    </div> -->
                            </div>
                        </div>
                        <div class="btnsave">
                            <button name="btn_offline" id="btnnext"><img src="../img/Spinner-1s-200px.gif"
                                    id="btnnext_img" alt=""><span id="btnnext_span">LƯU VÀ HIỂN THỊ</span></button>
                        </div>

                    </form>
                </div>
        </main>
        <!--END: MAIN-->


        <!-- FOOTER -->
        <?php
        include '../includes/h_popup_create_class.php';
        include '../includes/h_inc_footer.php';
        ?>
        <!-- END: FOOTER -->
        <script src="../js/select2.min.js?v=<?=$version?>"></script>
        <script src="../js/h_courses.js?v=<?=$version?>"></script>
        <script src="../js/v_search.js?v=<?=$version?>"></script>
        <script>
        function v_delete_basis(basis_id) {
            $("#v_course_basis" + basis_id).remove();
        }

        $(document).ready(function() {
            $("#v_city-1").select2();
            $("#v_district-1").select2();
            var k = 1;
            $('.addcoso').on('click', function() {
                k++;
                var html = `<div class="v_course_basis" id="v_course_basis` + k + `">
                            <input type="text" id="v_basis-` + k + `" name="v_basis[]" placeholder="Cơ sở :" class="coso">
                            <select class="city2" onchange="v_city2(` + k + `)" name="v_city[]" id='v_city-` + k + `'>
                            <option>Tỉnh, thành phố</option>` +
                    `<?php foreach ($a as $key => $value) { ?>` +
                    `<option class="city2db" value="` + `<?php echo $value['cit_id']; ?>` + `">` +
                    `<?php echo $value['cit_name']; ?>` + `</option>
                            <?php } ?>
                            </select>
                            <select class="district2" name="v_district[]" id='v_district-` + k + `'>
                            <option>Quận, huyện</option>
                            <option class="district2db"></option>
                            </select>
                            <input type="text" id="v_address-` + k + `" name="address[]" placeholder="số nhà, ngõ, ngách, đường, phố" class="address">
                            <img class="delele_basis" onclick="v_delete_basis(` + k + `)" id="v_delete_basis` + k + `" src="../img/v_delete.png" alt="Ảnh lỗi">
                            </div>
                            `;
                $('#allcoso').append(html);
                var v_city = "#v_city-" + k;
                var v_district = '#v_district-' + k;
                $(v_city).select2();
                $(v_district).select2();

            });
        });

        function v_city2(n) {
            var city = '#v_city-' + n;
            var district = '#v_district-' + n;
            var cityVal = $(city).val();
            $.get('../ajax/v_district.php', {
                v_district: cityVal
            }, function(data) {
                $(district).html(data);
            });
        }

        function v_teach3() {
            if (document.getElementById("teach2").value != '0') {
                document.getElementById("first4").style.display = 'none';
            } else {
                document.getElementById("first4").style.display = 'block';
            }
        }

        function count_course_name() {
            var course_name = document.getElementById('course_name').value;

            var i = course_name.length;
            document.getElementById('first2').innerHTML = i + "/120";

            if (i > 120) {
                document.getElementById('first2').style.color = "red";
                document.getElementById("v_course-1").innerHTML = "Bạn nhập quá số kí tự cho phép";
            }
        }

        function changeSlug(text) {
            text = text.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
            text = text.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
            text = text.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
            text = text.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
            text = text.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
            text = text.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
            text = text.replace(/(đ)/g, 'd');
            text = text.replace(/( )/g, '');
            text = text.toLowerCase();
            return text;
        }

        function v_course() {
            var reName = /^[a-zA-Z0-9]{1,}$/;
            var form_data = new FormData();
            if ($("#course_name").val() == "") {
                $("#v_alert").append(
                    '<div class="alert" id="alert_course_name">Tên khóa học không được để trống</div>');
                $("#course_name").focus();
                setTimeout(function() {
                    $("#alert_course_name").fadeOut(1000, function() {
                        $("#alert_course_name").remove();
                    })
                }, 2000);
                return false;
            } else if ($("#course_name").val().length > 120) {
                $("#v_alert").append(
                    '<div class="alert" id="alert_course_name">Tên khóa học không được hơn 120 kí tự</div>');
                $("#course_name").focus();
                setTimeout(function() {
                    $("#alert_course_name").fadeOut(1000, function() {
                        $("#alert_course_name").remove();
                    })
                }, 2000);
                return false;
            } else if (reName.test(changeSlug($("#course_name").val())) == false) {
                $("#v_alert").append(
                    '<div class="alert" id="alert_course_name">Tên khóa học không được chứa kí tự đặc biệt</div>');
                $("#course_name").focus();
                setTimeout(function() {
                    $("#alert_course_name").fadeOut(1000, function() {
                        $("#alert_course_name").remove();
                    })
                }, 2000);
                return false;
            } else {
                form_data.append('course_name', $("#course_name").val());
            }

            if ($("#cate_id").val() == 0) {
                $("#v_alert").append('<div class="alert" id="alert_cate">Vui lòng chọn môn học</div>');
                $("#cate_id").focus();
                setTimeout(function() {
                    $("#alert_cate").fadeOut(1000, function() {
                        $("#alert_cate").remove();
                    })
                }, 2000);
                return false;
            } else {
                form_data.append('cate_id', $("#cate_id").val());
            }

            if ($("#img").prop('files')[0] == undefined) {
                $("#v_alert").append('<div class="alert" id="alert_img">Vui lòng chọn ảnh</div>');
                $("#img").show();
                $("#img").focus();
                $("#img").hide();
                setTimeout(function() {
                    $("#alert_img").fadeOut(1000, function() {
                        $("#alert_img").remove();
                    })
                }, 2000);
                return false;
            } else if ($("#img").prop('files')[0] != undefined) {
                if ($("#img").prop('files')[0].size > 204800) {
                    $("#v_alert").append(
                        '<div class="alert" id="alert_img">Vui lòng chọn kích thước ảnh dưới 200KB</div>');
                    setTimeout(function() {
                        $("#alert_img").fadeOut(1000, function() {
                            $("#alert_img").remove();
                        });
                    }, 2000);
                    return false;
                }
                var match = ["image/jpeg", "image/JPEG", "image/png", "image/PNG", "image/jpg", "image/JPG"];
                var j = 0;
                for (var i = 0; i < match.length; i++) {
                    if ($('#img').prop('files')[0].type != match[i]) {
                        j++;
                    }
                }
                if (j == 6) {
                    $("#v_alert").append('<div class="alert" id="alert_img">Vui lòng chọn đúng định dạng ảnh</div>');
                    setTimeout(function() {
                        $("#alert_img").fadeOut(1000, function() {
                            $("#alert_img").remove();
                        });
                    }, 2000);
                    $('#img').show();
                    $('#img').focus();
                    $('#img').hide();
                    return false;
                } else {
                    form_data.append('file', $('#img').prop('files')[0]);
                }
            }

            if ($("#description").val() == "") {
                $("#v_alert").append(
                    '<div class="alert" id="alert_description">Mô tả khóa học không được để trống</div>');
                setTimeout(function() {
                    $("#alert_description").fadeOut(1000, function() {
                        $("#alert_description").remove();
                    });
                }, 2000);
                $('#alert_description').focus();
                return false;
            } else {
                form_data.append('description', $("#description").val());
            }

            if ($("#get_what").val() == "") {
                $("#v_alert").append(
                    '<div class="alert" id="alert_get_what">Bạn sẽ học những gì không được để trống</div>');
                setTimeout(function() {
                    $("#alert_get_what").fadeOut(1000, function() {
                        $("#alert_get_what").remove();
                    });
                }, 2000);
                $('#get_what').focus();
                return false;
            } else {
                form_data.append('get_what', $("#get_what").val());
            }

            if ($("#object").val() == "") {
                $("#v_alert").append(
                    '<div class="alert" id="alert_object">Đối tượng học viên không đươc để trống</div>');
                setTimeout(function() {
                    $("#alert_object").fadeOut(1000, function() {
                        $("#alert_object").remove();
                    });
                }, 2000);
                $('#object').focus();
                return false;
            } else {
                form_data.append('object', $("#object").val());
            }

            if ($("#teach2").val() == 0) {
                $("#v_alert").append('<div class="alert" id="alert_teach2">Vui lòng chọn giảng viên giảng dạy</div>');
                setTimeout(function() {
                    $("#alert_teach2").fadeOut(1000, function() {
                        $("#alert_teach2").remove();
                    });
                }, 2000);
                $('#teach2').focus();
                return false;
            } else {
                form_data.append('teach', $("#teach2").val());
            }

            if ($("#time_learn").val() == "") {
                $("#v_alert").append(
                    '<div class="alert" id="alert_time_learn">Số buổi học không được để trống</div>');
                setTimeout(function() {
                    $("#alert_teach2").fadeOut(1000, function() {
                        $("#alert_teach2").remove();
                    });
                }, 2000);
                $('#teach2').focus();
                return false;
            } else if (Number($("#time_learn").val()) == 0) {
                $("#v_alert").append('<div class="alert" id="alert_time_learn">Số buổi học phải lớn hơn 0</div>');
                setTimeout(function() {
                    $("#alert_teach2").fadeOut(1000, function() {
                        $("#alert_teach2").remove();
                    });
                }, 2000);
                $('#teach2').focus();
                return false;
            } else {
                form_data.append('time_learn', Number($("#time_learn").val()));
            }

            if ($("#slide").val() == "") {
                $("#v_alert").append('<div class="alert" id="alert_slide">Tài liệu học không được để trống</div>');
                setTimeout(function() {
                    $("#alert_slide").fadeOut(1000, function() {
                        $("#alert_slide").remove();
                    });
                }, 2000);
                $('#slide').focus();
                return false;
            } else if (Number($("#slide").val()) == 0) {
                $("#v_alert").append('<div class="alert" id="alert_slide">Tài liệu học phải lớn hơn 0</div>');
                setTimeout(function() {
                    $("#alert_slide").fadeOut(1000, function() {
                        $("#alert_slide").remove();
                    });
                }, 2000);
                $('#slide').focus();
                return false;
            } else {
                form_data.append('slide', Number($("#slide").val()));
            }

            if  ($("#v_gia_goc").val() == "") {
               $("#v_alert").append('<div class="alert" id="alert_prices_listed">Giá gốc không được để trống</div>');
                setTimeout(function() {
                    $("#alert_prices_listed").fadeOut(1000, function() {
                        $("#alert_prices_listed").remove();
                    });
                }, 2000);
                $('#v_gia_goc').focus();
                return false;
            }else if (Number($("#v_gia_goc").val()) == 0) {
                $("#v_alert").append('<div class="alert" id="alert_prices_listed">Giá gốc phải lớn hơn 0</div>');
                setTimeout(function() {
                    $("#alert_prices_listed").fadeOut(1000, function() {
                        $("#alert_prices_listed").remove();
                    });
                }, 2000);
                $('#v_gia_goc').focus();
                return false;
            } else {
                var gia_goc = Number($("#v_gia_goc").val());
                form_data.append('prices_listed', gia_goc);
            }

            if($("#v_gia_km").val() != ""){
                var gia_km = Number($("#v_gia_km").val());
                if (gia_km >= gia_goc) {
                    $("#v_alert").append(
                        '<div class="alert" id="alert_price_promotional">Giá khuyển mại không được lớn hơn hoặc bằng giá gốc</div>'
                    );
                    setTimeout(function() {
                        $("#alert_price_promotional").fadeOut(1000, function() {
                            $("#alert_price_promotional").remove();
                        });
                    }, 2000);
                    $('#v_gia_km').focus();
                    return false;
                } else {
                    form_data.append('price_promotional', gia_km);
                }
            }

            if (document.v_create_center.qualification.value == "") {
                $("#v_alert").append('<div class="alert" id="alert_qualification">Vui lòng chọn chứng chỉ</div>');
                setTimeout(function() {
                    $("#alert_qualification").fadeOut(1000, function() {
                        $("#alert_qualification").remove();
                    });
                }, 2000);
                $('#v_yes').focus();
                return false;
            } else {
                form_data.append('qualification', document.v_create_center.qualification.value);
            }

            if (document.v_create_center.v_level.value == "") {
                $("#v_alert").append('<div class="alert" id="alert_level">Vui lòng chọn trình độ</div>');
                setTimeout(function() {
                    $("#alert_level").fadeOut(1000, function() {
                        $("#alert_level").remove();
                    });
                }, 2000);
                $('#level1').focus();
                return false;
            } else {
                form_data.append('level', document.v_create_center.v_level.value);
            }


            if ($("#month_study").val() == "") {
                $("#v_alert").append('<div class="alert" id="alert_month_study">Vui lòng điền thời gian học</div>');
                setTimeout(function() {
                    $("#alert_month_study").fadeOut(1000, function() {
                        $("#alert_month_study").remove();
                    });
                }, 2000);
                $('#month_study').focus();
                return false;
            }else if (Number($("#month_study").val()) == 0) {
                $("#v_alert").append('<div class="alert" id="alert_month_study">Thời gian học tối thiểu là 1 tháng</div>');
                setTimeout(function() {
                    $("#alert_month_study").fadeOut(1000, function() {
                        $("#alert_month_study").remove();
                    });
                }, 2000);
                $('#month_study').focus();
                return false;
            } else {
                form_data.append('month_study', Number($("#month_study").val()));
            }

            if ($(".v_course_basis").length == 0) {
                $("#v_alert").append('<div class="alert" id="alert_course_basis">Vui lòng thêm cơ sở</div>');
                setTimeout(function() {
                    $("#alert_course_basis").fadeOut(1000, function() {
                        $("#alert_course_basis").remove();
                    });
                }, 2000);
                return false;
            } else {
                var arr_city = [];
                var arr_district = [];
                var arr_address = [];
                var arr_basis = [];
                for (var i = 1; i <= $(".v_course_basis").length; i++) {
                    if ($("#v_city-" + i).val() == '0' || $("#v_district-" + i).val() == '0' || $(
                            "#v_address-" + i).val() == '' || $("#v_basis-" + i).val() == '') {
                        $("#v_alert").append(
                            '<div class="alert" id="alert_course_basis">Cơ sở không được để trống</div>');
                        setTimeout(function() {
                            $("#alert_course_basis").fadeOut(1000, function() {
                                $("#alert_course_basis").remove();
                            });
                        }, 2000);
                        document.getElementById("v_basis-1").focus();
                        return false;
                    } else {
                        arr_city.push($("#v_city-" + i).val());
                        arr_district.push($("#v_district-" + i).val());
                        arr_address.push($("#v_address-" + i).val());
                        arr_basis.push($("#v_basis-" + i).val());
                    }
                }
            }
            form_data.append('city', arr_city);
            form_data.append('district', arr_district);
            form_data.append('address', arr_address);
            form_data.append('basis', arr_basis);
            var arr_adventags = [];
            for (var i = 0; i < 5; i++) {
                if ($(".advantages_id")[i].checked == true) {
                    arr_adventags.push($(".advantages_id")[i].value);
                }
            }
            form_data.append('tag_id', $("#tag_id").val());
            form_data.append('advantages_id', arr_adventags);
            form_data.append('addtienich', $("#addtienich").val());
            form_data.append('submit', 1);
            $("#btnnext_span").css("display", "none");
            $("#btnnext_img").css("display", "block");
            $("#btnnext")[0].type = 'button';
            $.ajax({
                url: '../code_xu_ly/v_create_course.php',
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: form_data,
                success: function(data) {
                    if (data.type == 0) {
                        $("#v_alert").append(
                            '<div class="alert" id="alert_course_name">Tên khóa học đã tồn tại</div>'
                        );
                        $("#course_name").focus();
                        setTimeout(function() {
                            $("#alert_course_name").fadeOut(1000, function() {
                                $("#alert_course_name").remove();
                            });
                        }, 2000);
                    } else if (data.type == 1) {
                        $("#v_alert").append(
                            '<div class="success" id="success">Tạo khóa học thành công</div>');
                        setTimeout(function() {
                            $("#success").fadeOut(1000, function() {
                                $("#success").remove();
                            });
                        }, 2000);
                        window.location.href = '/trung-tam-khoa-hoc-offline-giang-day/id' + data
                            .user_id + '&page1.html';
                    } else if (data.type == -1) {
                        $("#v_alert").append(
                            '<div class="alert" id="success">Vui lòng tạo thêm khóa học sau 20 phút nữa</div>'
                        );
                        setTimeout(function() {
                            $("#success").fadeOut(1000, function() {
                                $("#success").remove();
                            });
                        }, 2000);
                    } else if (data.type == -2) {
                        $("#v_alert").append(
                            '<div class="alert" id="success">Bạn chỉ được tạo tối đa 24 khóa học trong 1 ngày</div>'
                        );
                        setTimeout(function() {
                            $("#success").fadeOut(1000, function() {
                                $("#success").remove();
                            });
                        }, 2000);
                    }
                    $("#btnnext_span").css("display", "block");
                    $("#btnnext_img").css("display", "none");
                    $("#btnnext")[0].type = 'submit';
                },
                error: function() {
                    alert("Có lỗi xảy ra. Vui lòng thử lại");
                    $("#btnnext_span").css("display", "block");
                    $("#btnnext_img").css("display", "none");
                    $("#btnnext")[0].type = 'submit';
                }
            });

            return false;
        }
        </script>
    </body>

    </html>