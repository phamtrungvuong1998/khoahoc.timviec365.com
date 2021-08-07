<?php

include '../includes/v_insert_TT.php';
$db_cat = new db_query("SELECT * FROM categories");
$db_ad = new db_query("SELECT * FROM advantages_center");
$db_center = new db_query("SELECT * FROM user_center Where user_id = " . $user_id);
$db_img = new db_query("SELECT * FROM user_center_img Where user_id = $user_id");
$db_user = new db_query("SELECT user_id,user_name,cate_id,cit_id, district_id,user_address, user_mail, user_phone, user_birth, user_avatar FROM users Where user_id = $user_id");
$a = [];
$user = mysql_fetch_assoc($db_user->result);
$user_center = mysql_fetch_assoc($db_center->result);
$cit_id = $user['cit_id'];
$dis_id = $user['district_id'];
// while ($city = mysql_fetch_assoc($db_city->result)) {
//     $a[] = $city;
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin tài khoản</title>
    <?php
    include '../includes/l_inc_head.php';
    ?>
    <link rel="stylesheet" href="../css/select2.min.css?v=<?=$version?>">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <link rel="stylesheet" href="../css/tt_capnhatthongtin.css?v=<?=$version?>">
</head>

<body>
    <div class="l_container">
        <!-- sidebar -->
        <?php
        include '../includes/l_inc_sidebar.php';
        ?>
        <!-- end: sidebar -->
        <div class="l_right">
            <!-- header -->
            <?php
            include '../includes/l_inc_header.php';
            ?>
            <!-- end header -->
            <!-- pass -->
            <?
            include "../includes/l_popup_retypass.php";
            ?>
            <!-- end:pass -->
            <!-- content -->
            <div id="alert"></div>
            <div class="l_content">

                <form onsubmit="l_validate_submit(); return false;" name="l_form" enctype="multipart/form-data">
                    <div class="l_content_item1">
                        <div>
                            <div class="l_item1_img">
                                <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' src="/img/load.gif" id="l_img" class="lazyload" data-src="../img/avatar/<? echo $user['user_avatar'] ?>" alt="loading..." class="l_img">
                                <input type="file" id="l_file" />
                                <label id="l_uploadimg" class="l_custom-file-upload" for="l_file">
                                    <img class="lazyload" src="/img/load.gif" data-src="../img/l_update_img.svg" alt="loading...">
                                </label>
                            </div>
                            <div id="l_error_img" class="l_text_color"></div>
                        </div>
                        <div class="l_item1_title">
                            <div class="l_teaser_item1">
                                <? echo $user['user_name'] ?>
                            </div>
                            <div class="l_title_item2">
                                <div class="l_info">
                                    Mã trung tâm:
                                    <span class="l_info_item"><? echo $user['user_id'] ?></span>
                                </div>
                                <div class="l_info">
                                    Ngày tham gia:
                                    <span class="l_info_item">
                                        <?
                                        $date = date_create($user['user_birth']);
                                        echo date_format($date, "d/m/Y");
                                        // echo date('d/m/Y',$user['user_birth']);
                                        // $date = date_create();
                                        // $a = $user['user_birth'];
                                        // date_timestamp_set($date, $a);
                                        // echo date_format($date, "Y-m-d")
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <button type="button" onclick="document.getElementById('l_id_updatePass').style.display='block'" class="l_btn_pass">
                                ĐỔI MẬT KHẨU
                            </button>
                        </div>
                    </div>
                    <div class="l_content_item2">
                        <div class="l_form_item">
                            <div class="l_item2_name">
                                Tên trung tâm
                            </div>
                            <input value="<? echo $user['user_name']; ?>" type="text" id="l_name" name="l_name" placeholder="Trung tâm anh ngu Saigon" class="l_item2_input l_name">
                            <p id="l_error1" class="l_text_color"></p>
                        </div>
                        <div class="l_form_item">
                            <div class="l_item2_name">
                                Số điện thoại
                            </div>
                            <input value="<? echo $user['user_phone']; ?>" type="text" id="l_phone" name="l_phone" placeholder="0987654321" class="l_item2_input">
                            <p id="l_error2" class="l_text_color"></p>
                        </div>
                    </div>
                    <div class="l_content_item2">
                        <div class="l_form_item">
                            <div class="l_item2_name">
                                Email đăng ký
                            </div>
                            <input value="<? echo $user['user_mail']; ?>" type="text" id="l_email_dk" name="l_email_dk" readonly placeholder="abc@gmail.com" class="l_item2_input">
                            <p id="l_error3" class="l_text_color"></p>
                        </div>
                        <div class="l_form_item">
                            <div class="l_item2_name">
                                Email liên hệ
                            </div>
                            <input value="<? echo $user['user_mail']; ?>" type="text" id="l_email_lh" name="l_email_lh" readonly class="l_item2_input">
                            <p id="l_error4" class="l_text_color"></p>
                        </div>
                    </div>
                    <div class="l_content_item2">
                        <div class="l_form_item">
                            <div class="l_item2_name">
                                Ngày hoạt động
                            </div>
                            <input value="<?php echo date($user['user_birth']); ?>" type="date" id="l_time" name="l_time" class="l_item2_input">
                            <p id="l_error5" class="l_text_color"></p>
                        </div>
                        <div class="l_form_item">
                            <div class="l_item2_name">
                                Mã số thuế
                            </div>
                            <input value="<? echo $user_center['tax_code'] ?>" type="text" id="l_thue" name="l_thue" class="l_item2_input">
                            <p id="l_error6" class="l_text_color"></p>
                        </div>
                    </div>
                    <?
                    $load_city = new db_query("SELECT * FROM user_center_basis WHERE user_id = '$user_id'");
                    while ($row_city = mysql_fetch_assoc($load_city->result)) {
                    ?>
                        <div class="l_content_item2" id="thongbao"></div>
                        <div id="l_delete_city<? echo $row_city['center_basis_id'] ?>" class="l_delete_city"><img onclick="l_delete_city(<? echo $row_city['center_basis_id'] ?>);" class="lazyload l_img_delete " src="/img/load.gif" data-src="../img/l_delete.jpg" title="Xóa địa chỉ" alt="Xóa địa chỉ"></div>
                        <!-- <div>&Chi;</div> -->
                        <div id="demo<? echo $row_city['center_basis_id'] ?>" class="l_content_item2">
                            <div class="l_form_city" id="l_form_city<? echo $row_city['center_basis_id'] ?>">
                                <div class="l_form_city_item">
                                    <div class="l_item2_name">
                                        Tỉnh, thành phố
                                    </div>
                                    <!-- onchange="l_city()" -->
                                    <div>
                                        <select onchange="l_city(<? echo $row_city['center_basis_id'] ?>);" class="l_city" id="l_city<? echo $row_city['center_basis_id'] ?>" name="l_city[]" data-live-search="true" title="Chọn tỉnh thành">
                                            <option value="" selected>Chọn tỉnh thành</option>
                                            <? $i = 0;
                                            $db_city = new db_query("SELECT * FROM city Where cit_parent=0");
                                            while ($value = mysql_fetch_assoc($db_city->result)) {
                                                $a[] = $value;
                                            ?>
                                                <option value="<? echo $value['cit_id']; ?>" <?
                                                                                                if ($row_city['cit_id'] == $value['cit_id']) {
                                                                                                    echo "selected";
                                                                                                }
                                                                                                ?>><? echo $value['cit_name'] ?></option>
                                            <?
                                            } ?>
                                        </select>
                                    </div>
                                    <p class="l_error7 l_text_color"></p>
                                </div>
                                <div class="l_form_city_item">
                                    <div class="l_item2_name">
                                        Quận, huyện
                                    </div>
                                    <div>
                                        <select class="l_district" id="l_district<? echo $row_city['center_basis_id'] ?>" name="l_district[]" data-live-search="true" title="Chọn quận huyện ">
                                            <?
                                            $tinh = $row_city['cit_id'];
                                            if ($tinh == 0) {
                                            ?>
                                                <option value="">--Chọn quận huyện--</option>
                                                <?
                                            } else {
                                                $dis = new db_query("SELECT * FROM city Where cit_parent='$tinh'");
                                                while ($row = mysql_fetch_assoc($dis->result)) {
                                                ?>
                                                    <option <?
                                                            if ($row_city['district_id'] == $row['cit_id']) {
                                                                echo "selected";
                                                            }
                                                            ?> value="<? echo $row['cit_id'] ?>"><? echo $row['cit_name'] ?></option>
                                            <?
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <p class="l_error8 l_text_color"></p>
                                </div>
                            </div>
                            <div class="l_form_item" id="l_form_item<? echo $row_city['center_basis_id'] ?>">
                                <div class="l_item2_name">
                                    Địa chỉ
                                </div>
                                <input type="text" value="<? echo $row_city['center_basis_address'] ?>" id="l_address" name="l_address[]" class="l_address l_item2_input">
                                <p class="l_error9 l_text_color"></p>
                            </div>
                        </div>
                    <?
                    }
                    ?>
                    <div id="demo1" class="l_content_item2"></div>
                    <div class="l_themcoso">
                        <div id="btn1" class="l_themcoso_btn">
                            <img src="/img/load.gif" data-src="../img/l_them-co-so.svg" class="lazyload l_img_themcoso" alt="loading...">
                            <div class="l_text11">Thêm cơ sở</div>
                        </div>
                    </div>
                    <div class="l_hr"></div>
                    <div class="l_des">
                        <div class="l_item2_name">
                            Giới thiệu trung tâm
                        </div>
                        <div class="l_textarea">
                            <textarea name="l_introduce" id="l_introduce"><? echo $user_center['center_intro'] ?></textarea>
                            <p id="l_error10" class="l_text_color"></p>
                        </div>
                    </div>
                    <div class="l_des">
                        <div class="l_item2_name">
                            Link cộng đồng học viên ( Nếu có )
                        </div>
                        <div>
                            <input id="l_link" value="<? echo $user_center['link_student_community'] ?>" type="text" class="l_input_text" name="l_link" placeholder="Link Facebook cá nhân/ Facebook fanpage/ Youtube/ Website cá nhân...">
                            <p id="l_error11" class="l_text_color"></p>
                        </div>
                    </div>
                    <div class="l_des">
                        <div class="l_item2_name">
                            Chủ đề giảng dạy
                        </div>
                        <div id="l_chudegiangday" class="l_chudegiangday">
                            <div>
                                <select name="l_chude[]" id="l_chude" multiple>
                                    <?php
                                    $cat = $user['cate_id'];
                                    $cat_ex = explode(',', $cat);
                                    while ($row = mysql_fetch_assoc($db_cat->result)) { ?>
                                        <option value="<? echo $row['cate_id']; ?>" <?
                                                                                    for ($i = 0; $i < count($cat_ex); $i++) {
                                                                                        if ($row['cate_id'] == $cat_ex[$i]) {
                                                                                            echo "selected";
                                                                                        }
                                                                                    }

                                                                                    ?>>
                                            <? echo $row['cate_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <p id="l_error12" class="l_text_color"></p>
                    </div>
                    <div class="l_hinhanh">
                        <div class="l_hr_2"></div>
                        Hình ảnh trung tâm
                        <div class="l_hinhanh_item" id="l_hinhanh_item">
                            <div id="l_open_image">
                                <div class="l_hinhanh_item1">
                                    <input type="file" id="pro_image" name="pro_image[]" style="display: none;" class="form-control" multiple>
                                    <a onclick="$('#pro_image').click()">
                                        <label for="l_file_2" class="">
                                            <img id="l_file_2" src="/img/load.gif" data-src="../img/l_fluent_image-add-24-regular.svg" alt="loading..." class="lazyload l_hinhanh_1 l_cursor">
                                        </label>
                                    </a>
                                </div>
                            </div>
                            <div id="l_index_image">
                                <?
                                $arr_img = [];
                                $i = 0;
                                while ($row_img = mysql_fetch_assoc($db_img->result)) {
                                    $arr_img[] = $row_img;
                                ?>
                                    <div class="l_hinhanh_item1" id="l_delete_img<? echo $i; ?>">
                                        <p onclick="l_delete_img(<? echo $row_img['center_img_id']; ?>,<? echo $i; ?>);" title="Xóa hình ảnh" class="image-cancel" data-no=""><img class="lazyload l_img_delete_TT" src="/img/load.gif" data-src="../img/l_delete.jpg" alt=""></p>
                                        <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' src="/img/load.gif" id="" class="lazyload l_hinhanh_2" data-src="../img/uploads/<? echo $row_img['center_img'] ?>" alt="loading..." id="l_img_2">
                                    </div>
                                <?
                                    $i++;
                                }
                                ?>
                            </div>
                            <!-- <div class="load_img" id="load_img">
                            </div> -->
                        </div>

                    </div>
                    <div class="l_des">
                        <p id="l_error13" class="l_text_color"></p>
                    </div>
                    <div class="l_hinhanh">
                        <div class="l_hr_2"></div>
                        Ưu điểm trung tâm
                        <div class="l_checkbox_item">
                            <?
                            $chude = $user_center['advantages_id'];
                            $chude_ex = explode(',', $chude);
                            $dem = 1;
                            while ($ad = mysql_fetch_assoc($db_ad->result)) {
                            ?>
                                <div class="l_checkbox">
                                    <input <?
                                            for ($i = 0; $i < count($chude_ex); $i++) {
                                                if ($ad['advantages_id'] == $chude_ex[$i]) {
                                                    echo "checked";
                                                }
                                            }
                                            ?> type="checkbox" class="l_img_checkbox l_check" id="<? echo $ad['advantages_id'] ?>" name="check1[]" value="<? echo $ad['advantages_id'] ?>">
                                    <label for="<? echo $ad['advantages_id'] ?>" class="l_text_checkbox"><? echo $ad['advantages_name'] ?></label>
                                </div>
                            <?
                                //$dem++;
                            }
                            ?>
                        </div>
                        <div class="l_khac">
                            <input value="<? echo $user_center['central_advant'] ?>" type="text" id="l_tienich" name="l_tienich" class="l_input_text" placeholder="Nhập thêm tiện ích khác">
                        </div>

                    </div>
                    <div class="l_des">
                        <p id="l_error14" class="l_text_color"></p>
                    </div>
                    <div class="l_add">
                        <button onclick="l_validate_submit(); return false;" type="submit" class="l_btn_add">
                            CẬP NHẬT
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end content -->
    </div>

    <!-- test -->
    <!-- end:test -->
    <!-- FOOTER -->
    <?php
    include '../includes/h_inc_footer.php';
    ?>
    <!-- END: FOOTER -->

</body>
<script src="../js/jquery.js?v=<?=$version?>"></script>
<script src="../js/select2.min.js?v=<?=$version?>"></script>


<script>
    function validate_str(str) {
        str = str.replace(/[^0-9a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ\s]/gi, '');
        str = str.replace(/\s+/g, ' ');
        str = str.trim();
        return str;
    }

    function validate_number(str) {
        str = str.replace(/[^0-9\s]/gi, '');
        str = str.replace(/\s+/g, '');
        str = str.trim();
        return str;
    }
    window.onload = function() {
        var l_name = document.getElementById('l_name');
        var l_phone = document.getElementById('l_phone');
        var l_thue = document.getElementById('l_thue');
        var l_introduce = document.getElementById('l_introduce');
        var l_link = document.getElementById('l_link');

        l_name.onblur = function() {
            this.value = this.value.toUpperCase();
            this.value = validate_str(this.value);
        };

        l_phone.onblur = function() {
            this.value = validate_number(this.value);
        };
        l_thue.onblur = function() {
            this.value = validate_str(this.value);
        };
        l_introduce.onblur = function() {
            this.value = validate_str(this.value);
        };
        l_link.onblur = function() {
            this.value = validate_str(this.value);
        };
    };
    //$(".l_city").select2();
    $(document).ready(function() {
        $('.l_city,.l_district,#l_chude').select2({
            width: '100%'
        });
    });

    const img = document.querySelector('#l_img');
    const file = document.querySelector('#l_file');
    file.addEventListener('change', function() {
        if ($('#l_file').prop('files')[0] != undefined) {
            var arr_img = ["image/jpeg", "image/JPEG", "image/png", "image/PNG", "image/jpg", "image/JPG"];
            var j = 0;
            for (var i = 0; i < arr_img.length; i++) {
                if ($('#l_file').prop('files')[0].type != arr_img[i]) {
                    j++;
                }
            }
            if (j == 6) {
                const choosedFile = this.files[0];
                if (choosedFile) {
                    const reader = new FileReader();
                    reader.addEventListener('load', function() {
                        img.setAttribute('src', reader.result);
                    });
                    reader.readAsDataURL(choosedFile);
                }
                $('#l_error_img').html('Vui lòng chọn đúng định dạng ảnh!');
                $('#l_file').show();
                $('#l_file').focus();
                $('#l_file').hide();
                return false;
            } else {
                $('#l_error_img').html('');
                const choosedFile = this.files[0];
                if (choosedFile) {
                    const reader = new FileReader();
                    reader.addEventListener('load', function() {
                        img.setAttribute('src', reader.result);
                    });
                    reader.readAsDataURL(choosedFile);
                }
            }
        }
    });

    function l_city(b) {
        var a = $("#l_city" + b).val();
        //return false;
        $.get('../ajax/l_ajax_load_city.php', {
            l_district: a
        }, function(data) {
            $("#l_district" + b).html(data);
        });
    }

    function l_delete_city(a) {
        var data = new FormData();
        data.append('id', a);

        $.ajax({
            url: '../ajax/l_ajax_delete_city.php',
            type: 'post',
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.result == true) {
                    $('#demo' + a).remove();
                    $('#l_delete_city' + a).remove();
                    $('#thongbao').html('');
                    $('#thongbao').html(response.message);
                } else {
                    alert(response.message);
                }
            },
        });
    }

    $(document).ready(function() {
        var i = 1;
        $(document).on("click", "#btn1", function() {
            i++;
            $("#demo1").append(
                '<div id="l_remove_city' + i + '" onclick="l_remove_city(' + i + ');" class="l_delete_city l_remove"><img class="lazyload l_img_delete" src="/img/load.gif" data-src="../img/l_delete.jpg" alt="Xóa địa chỉ"></div>' +
                '<div class="l_form_city" id="l_form_city' + i + '">' +
                '<div class="l_form_city_item">' +
                '<div class="l_item2_name">' +
                'Tỉnh, thành phố' +
                '</div>' +
                '<select onchange="l_abc(' + i + ')" class="l_city" id="l_city' + i + '" name="l_city[]" data-live-search="true" title="Chọn tỉnh thành">' +
                '<option value="" selected hidden>Chọn tỉnh thành</option>' +
                '<? foreach ($a as $value) { ?>' +
                '<option value="<? echo $value["cit_id"] ?>"><? echo $value["cit_name"] ?></option>' +
                '<? } ?>' +
                '</select>' +
                '<p class="l_error7 l_text_color"></p>' +
                ' </div>' +
                '<div class="l_form_city_item">' +
                '<div class="l_item2_name">' +
                ' Quận, huyện' +
                ' </div>' +
                '<select class="l_district" id="l_district' + i + '" name="l_district[]" data-live-search="true" title="Chọn quận huyện ">' +
                '<option value="" selected hidden>Chọn Quận Huyện</option>' +
                '</select>' +
                '<p class="l_error8 l_text_color"></p>' +
                '</div>' +
                '</div>' +
                '<div class="l_form_item" id="l_form_item' + i + '">' +
                '<div class="l_item2_name">' +
                'Địa chỉ' +
                '</div>' +
                '<input type="text" value="" name="l_address[]" class="l_address l_item2_input">' +
                '<p class="l_error9 l_text_color"></p>' +
                ' </div>'
            );
            $('#l_city' + i).select2({
                width: '100%'
            });
            $('#l_district' + i).select2({
                width: '100%'
            });
        });
    });

    function l_abc(a) {
        var city = "#l_city" + a;
        var district = "#l_district" + a;
        var cityID = $(city).val();
        $.get('../ajax/l_ajax_load_city.php', {
            l_district: cityID
        }, function(data) {
            $(district).html(data);
        });
    }

    function l_remove_city(a) {
        $('#l_remove_city' + a).remove();
        $('#l_form_city' + a).remove();
        $('#l_form_item' + a).remove();
    }

    var flag = false;
    var arr = [];
    var numArr = [];
    var files = 0;
    var list_img = 0;
    var num = 0;
    var i = 0;
    var n = 0;
    var bien = 0;
    <?
    $i = 0;
    foreach ($arr_img as $value) {
    ?>
        arr.push('<? echo $value['center_img'] ?>');
    <?
    }

    ?>
    n = arr.length;

    function l_delete_img(i, j) {
        var data = new FormData();
        data.append('id', i);
        $.ajax({
            url: '../ajax/l_ajax_delete_img.php',
            type: 'post',
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.result == true) {
                    $('#l_delete_img' + j).remove();
                } else {
                    alert(response.message);
                }
            },
        });
    }
    if (window.File && window.FileList && window.FileReader) {
        $('#pro_image').on('change', function(event) {
            var files = event.target.files;
            var output = $("#l_index_image");
            //var n = arr.length;
            var x = files.length;
            if (files.length == 0) {
                return false;
            }
            if (files.length <= 6) {
                //var nodesArray = Array.prototype.slice.call(files);

                if (arr.length <= 5) {
                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        if (!file.type.match('image')) continue;
                        var x = arr.length;
                        if (x < 6) {
                            arr.push(files[i]);
                        }
                    }
                } else {
                    if (x <= n) {
                        n = n - x;
                    } else {
                        n = 0;
                    }
                    for (var i = 0; i < x; i++) {
                        var file = files[i];
                        if (!file.type.match('image')) continue;
                        $('#l_delete_img' + bien).remove();
                        arr.shift();
                        arr.push(files[i]);
                        bien++;
                    }
                }
                $(document).ready(function() {
                    for (var i = 0; i < arr.length; i++) {
                        var file = arr[i];
                        var size = arr[i].size;
                        j = n;
                        if (size < 2097152) {
                            if (!file.type.match('image')) continue;
                            var picReader = new FileReader();
                            picReader.addEventListener('load', function(event) {
                                var picFile = event.target;
                                var html = '<div class="l_hinhanh_item1" id = "idappend-' + num + '">' +
                                    '<a title="Xóa hình ảnh" onclick = "l_closeimg(' + num + ',' + j + ')" class="image-cancel" data-no="' + num + '"><img class="lazyload l_img_delete_TT" src="/img/load.gif" data-src="../img/l_delete.jpg" alt=""></a>' +
                                    '<img id="pro-img-' + num + '" data-src="' + picFile.result + '" alt="loading..." class="lazyload l_hinhanh_2" id="l_img_2">' +
                                    '</div>';
                                j++;
                                output.append(html);
                                num++;
                                numArr.push(num);
                            });
                            picReader.readAsDataURL(file);
                        }
                    }
                    var maxnum = Math.max.apply(Math, numArr);
                    for (i = 0; i < maxnum; i++) {
                        $('#idappend-' + i).remove();
                    }
                });
            } else {
                $("#alert").append('<div class="alert-success_img">Chỉ tải tối đa 6 ảnh</div>');
                setTimeout(function() {
                    $(".alert-success_img").fadeOut(1000, function() {
                        $(".alert-success_img").remove();
                    });
                }, 3000);
                return false;
            }
        });
    } else {
        $("#alert").append('<div class="alert-success_img">Lỗi</div>');
        setTimeout(function() {
            $(".alert-success_img").fadeOut(1000, function() {
                $(".alert-success_img").remove();
            });
        }, 3000);
    }

    function l_closeimg(x, y) {
        if (window.File && window.FileList && window.FileReader) {
            var files = event.target.files;
            var output = $("#l_index_image");
            $('#idappend-' + x).remove();
            arr.splice(y, 1);
            for (var i = 0; i < arr.length; i++) {
                var file = arr[i];
                var size = arr[i].size;
                j = n;
                if (size < 2097152) {
                    if (!file.type.match('image')) continue;
                    var picReader = new FileReader();
                    picReader.addEventListener('load', function(event) {
                        var picFile = event.target;
                        var html = '<div class="l_hinhanh_item1" id = "idappend-' + num + '">' +
                            '<a onclick = "l_closeimg(' + num + ',' + j + ')" class="image-cancel" data-no="' + num + '"><img class="lazyload l_img_delete_TT" src="/img/load.gif" data-src="../img/l_delete.jpg" alt=""></a>' +
                            '<img id="pro-img-' + num + '" data-src="' + picFile.result + '" alt="loading..." class="lazyload l_hinhanh_2" id="l_img_2">' +
                            '</div>';
                        j++;
                        output.append(html);
                        num++;
                        numArr.push(num);
                    });
                    picReader.readAsDataURL(file);
                }
            }
            var maxnum = Math.max.apply(Math, numArr);
            for (i = 0; i < maxnum; i++) {
                $('#idappend-' + i).remove();
            }
        }
    }

    function istrim(evt) {
        var num = String.fromCharCode(evt.which);
        if (num == " ") {
            evt.preventDefault();
        }
    }

    function l_validation() {
        var flag = false;
        var l_name = document.getElementById('l_name').value;
        var l_phone = document.getElementById('l_phone').value;
        var l_thue = document.getElementById('l_thue').value;
        var l_time = document.getElementById('l_time').value;
        var l_introduce = document.getElementById('l_introduce').value;
        var l_link = document.getElementById('l_link').value;
        var l_chude = document.getElementById('l_chude').value;

        if (l_name == "") {
            document.getElementById("l_error1").innerHTML = "Bạn chưa nhập tên trung tâm";
            document.getElementById("l_name").focus();
            return false;
        } else {
            document.getElementById("l_error1").innerHTML = "";
            flag = true;
        }
        var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        var check = /[^0-9]/g;
        if (l_phone == '') {
            document.getElementById("l_error2").innerHTML = "Bạn chưa nhập số điện thoại";
            document.getElementById("l_phone").focus();
            return false;
        } else if (vnf_regex.test(l_phone) == false) {
            document.getElementById("l_error2").innerHTML = "Số điện thoại bạn nhập không hợp lệ";
            document.getElementById("l_phone").focus();
            return false;
        } else if (check.test(l_phone) == true) {
            document.getElementById("l_error2").innerHTML = "Không được nhập ký tự";
            document.getElementById("l_phone").focus();
            return false;
        } else {
            document.getElementById("l_error2").innerHTML = "";
            flag = true;
        }

        if (l_time == "") {
            document.getElementById("l_error5").innerHTML = "Bạn chưa nhập thời gian";
            document.getElementById("l_time").focus();
            return false;
        } else {
            document.getElementById("l_error5").innerHTML = "";
            flag = true;
        }
        if (l_thue == 0) {
            document.getElementById("l_error6").innerHTML = "Bạn chưa nhập mã số thuế";
            document.getElementById("l_thue").focus();
            return false;
        } else {
            document.getElementById("l_error6").innerHTML = "";
            flag = true;
        }
        for (var index = 0; index < document.getElementsByClassName('l_city').length; index++) {
            if (document.getElementsByClassName('l_city')[index].value == '') {
                document.getElementsByClassName('l_error7')[index].innerText = "Không được để trống";
                document.getElementsByClassName('l_city')[index].focus();
                return false;
            } else {
                document.getElementsByClassName('l_error7')[index].innerText = "";
                flag = true;
            }
        }
        for (var index = 0; index < document.getElementsByClassName('l_district').length; index++) {
            if (document.getElementsByClassName('l_district')[index].value == '') {
                document.getElementsByClassName('l_error8')[index].innerText = "Không được để trống";
                document.getElementsByClassName('l_district')[index].focus();
                return false;
            } else {
                document.getElementsByClassName('l_error8')[index].innerText = "";
                flag = true;
            }
        }
        for (var index = 0; index < document.getElementsByClassName('l_address').length; index++) {
            if (document.getElementsByClassName('l_address')[index].value == '') {
                document.getElementsByClassName('l_error9')[index].innerText = "Không được để trống";
                document.getElementsByClassName('l_address')[index].focus();
                return false;
            } else {
                document.getElementsByClassName('l_error9')[index].innerText = "";
                flag = true;
            }
        }
        // return false;

        if (l_introduce == "") {
            document.getElementById("l_error10").innerHTML = "Bạn chưa nhập giới thiệu trung tâm";
            document.getElementById("l_introduce").focus();
            return false;
        } else {
            document.getElementById("l_error10").innerHTML = "";
            flag = true;
        }
        // if (l_link == 0) {
        //     document.getElementById("l_error11").innerHTML = "Bạn chưa nhập link cộng đồng";
        //     document.getElementById("l_link").focus();
        //     return false;
        // } else {
        //     document.getElementById("l_error11").innerHTML = "";
        //     flag = true;
        // }
        if (l_chude == "") {
            document.getElementById("l_error12").innerHTML = "Bạn chưa nhập chủ đề giảng dạy";
            document.getElementById("l_chude").focus();
            return false;
        } else {
            document.getElementById("l_error12").innerHTML = "";
            flag = true;
        }
        if (arr.length == 0) {
            document.getElementById("l_error13").innerHTML = "Bạn chưa nhập ảnh trung tâm";

            return false;
        } else {
            document.getElementById("l_error13").innerHTML = "";
            flag = true;
        }
        if (($("input[name*='check1']:checked").length) == 0) {
            document.getElementById("l_error14").innerHTML = "Bạn chưa chọn ưu điểm trung tâm";
            return false;
        } else {
            document.getElementById("l_error14").innerHTML = "";
            flag = true;
        }

        if ($('#l_file').prop('files')[0] != undefined) {
            var arr_img = ["image/jpeg", "image/JPEG", "image/png", "image/PNG", "image/jpg", "image/JPG"];
            var j = 0;
            for (var i = 0; i < arr_img.length; i++) {
                if ($('#l_file').prop('files')[0].type != arr_img[i]) {
                    j++;
                }
            }
            if (j == 6) {
                const choosedFile = this.files[0];
                if (choosedFile) {
                    const reader = new FileReader();
                    reader.addEventListener('load', function() {
                        img.setAttribute('src', reader.result);
                    });
                    reader.readAsDataURL(choosedFile);
                }
                $('#l_error_img').html('Vui lòng chọn đúng định dạng ảnh!');
                $('#l_file').show();
                $('#l_file').focus();
                $('#l_file').hide();
                return false;
            } else {
                $('#l_error_img').html('');
                const choosedFile = this.files[0];
                if (choosedFile) {
                    const reader = new FileReader();
                    reader.addEventListener('load', function() {
                        img.setAttribute('src', reader.result);
                    });
                    reader.readAsDataURL(choosedFile);
                }
                flag == true;
            }
        }
        return flag;
    }

    function l_validate_submit() {
        var flag = l_validation();
        //var flag = false;
        if (flag == true) {
            var l_name = document.getElementById('l_name').value;
            var l_phone = document.getElementById('l_phone').value;
            var l_thue = document.getElementById('l_thue').value;
            var l_time = document.getElementById('l_time').value;
            var l_introduce = document.getElementById('l_introduce').value;
            var l_link = document.getElementById('l_link').value;
            var l_chude = document.getElementById('l_chude').value;
            var l_tienich = document.getElementById('l_tienich').value;

            var form_data = new FormData();

            var avatar = $('#l_file')[0].files[0];
            form_data.append('file', avatar);

            form_data.append('l_name', l_name);
            form_data.append('l_phone', l_phone);
            form_data.append('l_time', l_time);
            form_data.append('l_thue', l_thue);

            var l_city = [];
            $('.l_city :selected').each(function() {
                l_city.push($(this).val());
            });
            form_data.append('l_city', l_city);

            var l_district = [];
            $('.l_district :selected').each(function() {
                l_district.push($(this).val());
            });
            form_data.append('l_district', l_district);

            var l_address = $('input[name="l_address[]"]').map(function() {
                return this.value;
            }).get();
            form_data.append('l_address', l_address);

            form_data.append('l_introduce', l_introduce);
            form_data.append('l_link', l_link);
            var l_chude = [];
            $('#l_chude :selected').each(function() {
                l_chude.push($(this).val());
            });
            form_data.append('l_chude', l_chude);


            var l_check = [];
            $(".l_check").each(function() {
                if ($(this).is(":checked")) {
                    l_check.push($(this).val());
                }
            });
            form_data.append('l_check', l_check);
            form_data.append('l_tienich', l_tienich);

            for (var index = 0; index < arr.length; index++) {
                form_data.append("files[]", arr[index]);
            }

            $.ajax({
                url: '../ajax/l_ajax_capnhattrungtam.php',
                type: 'post',
                data: form_data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.result == 1) {
                        $("#l_error1").html('');
                        $("#l_error1").html(response.message);
                        $("#l_name").focus();
                    } else if (response.result == 2) {
                        $("#alert").append('<div class="alert-success_img">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success_img").fadeOut(1000, function() {
                                $(".alert-success_img").remove();
                            });
                        }, 3000);
                        $('#l_file').show();
                        $('#l_file').focus();
                        $('#l_file').hide();
                    } else if (response.result == 3) {
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                $(".alert-success").remove();
                            });
                        }, 3000);
                        $('.l_avatar').html('');
                        $('.l_avatar').append('<img class="lazyload l_image_avatar" src="/img/load.gif" data-src="../img/avatar/'+response.fileavatar+'" alt="avatar">');
                        $('.l_header_avatar').html('');
                        $('.l_header_avatar').append('<img src="/img/load.gif" data-src="../img/avatar/'+response.fileavatar+'" alt="avatar" class="l_menu_img lazyload">');
                    } else {
                        alert(response.message);
                    }
                },
            });
        }
    }
</script>
<script src="../js/l_trungtam.js?v=<?=$version?>"></script>



</html>