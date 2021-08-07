<?
include '../includes/v_insert_TT.php';
$db_cat = new db_query("SELECT * FROM categories");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <title>Thêm giảng viên</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <?php
    include '../includes/l_inc_head.php';
    ?>
    <link rel="stylesheet" href="../css/tt_themgiangvien.css">
    <link rel="stylesheet" href="../css/select2.min.css">

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

            <!-- content -->
            <div id="alert"></div>
            <div class="l_title">
                <hr class="l_hr">
                <div class="l_title_text">THÊM GIẢNG VIÊN CỦA TRUNG TÂM</div>
            </div>
            <div class="l_content">
                <form onsubmit="l_validate_submit(); return false;" name="l_form" enctype="multipart/form-data">
                    <div>
                        <div class="l_content_img">
                            <img id="l_img" src="/img/load.gif" data-src="../img/image/avatar_nen - Copy.jpg" alt="loading..." class="l_img_item lazyload">
                            <input type="file" id="l_file" />
                            <label id="l_uploadimg" class="l_file-upload" for="l_file">
                                <img src="/img/load.gif" data-src="../img/l_up_image.svg" alt="loading..." class="lazyload">
                            </label>
                            <!-- 
                            <input type="file" id="l_file" />
                            <label id="l_uploadimg" class="l_custom-file-upload" for="l_file">
                                <img src="../img/l_update_img.svg" alt="loading...">
                            </label> -->
                        </div>
                        <p id="l_error_img" class="l_text_error l_img_error"></p>
                        <!-- <p id="l_error1" class="l_text_error"></p> -->
                    </div>
                    <div class="l_content_item">
                        <div class="l_hoten">Họ tên</div>
                        <div>
                            <input type="text" name="l_hoten" id="l_hoten" placeholder="Nguyễn Xuân Hòa" class="l_input">
                        </div>
                        <p id="l_error1" class="l_text_error"></p>
                    </div>
                    <div class="l_content_item1">
                        <div class="l_hoten">Môn học giảng dạy</div>
                        <div class="l_monhoc">
                            <div>
                                <select name="l_monhoc[]" id="l_monhoc" multiple>
                                    <?php
                                    while ($row = mysql_fetch_assoc($db_cat->result)) { ?>
                                        <option value="<? echo $row['cate_id'] ?>"><? echo $row['cate_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <p id="l_error2" class="l_text_error"></p>
                    </div>
                    <div class="l_content_item1">
                        <div class="l_hoten">Bằng cấp chứng chỉ</div>
                        <div>
                            <input id="l_bangcap" type="text" name="l_bangcap" placeholder="Vd: Kỹ sư công nghệ thông tin" class="l_input">
                        </div>
                        <p id="l_error3" class="l_text_error"></p>
                    </div>
                    <div class="l_content_item1">
                        <div class="l_hoten">Ngày tham gia</div>
                        <div>
                            <input id="l_date" type="date" name="l_date" placeholder="" class="l_input">
                            <!-- data-date-format="DD MMMM YYYY"
                        <input type="date" id="datepicker" class="l_input" placeholder="" data-date-format="DD MMMM YYYY"> -->
                        </div>
                        <p id="l_error4" class="l_text_error"></p>
                    </div>
                    <div class="l_content_item2">
                        <button onclick="l_validate_submit(); return false;" type="submit" class="l_btn_add">THÊM MỚI</button>
                        <!-- <button class="l_btn_reset" type="reset">HỦY BỎ</button> -->
                    </div>
                </form>
            </div>
            <!-- end content -->
        </div>
    </div>
    <!-- FOOTER -->
    <?php
    include '../includes/h_inc_footer.php';
    ?>
    <!-- END: FOOTER -->

</body>
<script src="../js/l_trungtam.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#l_monhoc').select2({
            width: '100%'
        });
    });
    function validate_str(str){
        str = str.replace(/[^0-9a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ\s]/gi, '');
        str = str.replace(/\s+/g, ' ');
        str = str.trim();
        return str;
    }
    window.onload = function() {
        var textBx = document.getElementById("l_hoten");
        var l_bangcap = document.getElementById("l_bangcap");
        textBx.onblur = function() {
            this.value = validate_str(this.value);
        };
        l_bangcap.onblur = function() {
            this.value = validate_str(this.value);
        };
    };
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

    function l_validation() {
        var flag = false;
        var l_hoten = document.l_form.l_hoten.value;
        var l_monhoc = document.l_form.l_monhoc.value;
        var l_bangcap = document.l_form.l_bangcap.value;
        var l_date = document.l_form.l_date.value;

        if (l_hoten == '') {
            document.getElementById("l_error1").innerHTML = "Bạn chưa nhập tên Giảng viên";
            document.getElementById("l_hoten").focus();
            return false;
        } else {
            document.getElementById("l_error1").innerHTML = "";
            flag = true;
        }

        if (l_monhoc == '') {
            document.getElementById("l_error2").innerHTML = "Bạn chưa nhập môn học giảng dạy";
            document.getElementById("l_monhoc").focus();
            return false;
        } else {
            document.getElementById("l_error2").innerHTML = "";
            flag = true;
        }

        if (l_bangcap == '') {
            document.getElementById("l_error3").innerHTML = "Bạn chưa nhập bằng cấp";
            document.getElementById("l_bangcap").focus();
            return false;
        } else {
            document.getElementById("l_error3").innerHTML = "";
            flag = true;
        }

        if (l_date == '') {
            document.getElementById("l_error4").innerHTML = "Bạn chưa nhập ngày tham gia";
            document.getElementById("l_date").focus();
            return false;
        } else {
            document.getElementById("l_error4").innerHTML = "";
            flag = true;
        }
        // if ($('#l_file').prop('files')[0] != undefined) {
        //     var arr_img = ["image/jpeg", "image/JPEG", "image/png", "image/PNG", "image/jpg", "image/JPG"];
        //     var j = 0;
        //     for (var i = 0; i < arr_img.length; i++) {
        //         if ($('#l_file').prop('files')[0].type != arr_img[i]) {
        //             j++;
        //         }
        //     }
        //     if (j == 6) {
        //         $('#l_error_img').html('Vui lòng chọn đúng định dạng ảnh!');
        //         $('#l_file').show();
        //         $('#l_file').focus();
        //         $('#l_file').hide();
        //         return false;
        //     } else {
        //         $('#l_error_img').html('');
        //         flag = true;
        //     }
        // }
        return flag;

    }

    function l_validate_submit() {
        var flag = l_validation();
        if (flag == true) {
            var l_hoten = document.l_form.l_hoten.value;
            var l_monhoc = document.l_form.l_monhoc.value;
            var l_bangcap = document.l_form.l_bangcap.value;
            var l_date = document.l_form.l_date.value;

            var data = new FormData();

            var avatar = $('#l_file')[0].files[0];
            data.append('file', avatar);

            data.append('l_hoten', l_hoten);

            var l_monhoc = [];
            $('#l_monhoc :selected').each(function() {
                l_monhoc.push($(this).val());
            });
            data.append('l_monhoc', l_monhoc);

            data.append('l_bangcap', l_bangcap);
            data.append('l_date', l_date);

            $.ajax({
                url: '../ajax/l_ajax_themgiangvien.php',
                type: 'post',
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.result == 1) {
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                $(".alert-success").remove();
                                // window.location.href = "/trung-tam-them-giang-vien/id</? echo $user_id; ?>.html";
                            });
                        }, 3000);
                        $('#l_hoten').val('');
                        $('#l_monhoc').val('');
                        $('.select2-selection__choice').remove();
                        $('#l_bangcap').val('');
                        $('#l_date').val('');
                        $("#l_img").attr('src', '../img/image/avatar_nen - Copy.jpg');
                    } else if (response.result == 2) {
                        $("#alert").append('<div class="alert-success_error">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success_error").fadeOut(1000, function() {
                                $(".alert-success_error").remove();
                                // window.location.href = "/trung-tam-them-giang-vien/id</? echo $user_id; ?>.html";
                            });
                        }, 3000);
                        $('#l_file').show();
                        $('#l_file').focus();
                        $('#l_file').hide();
                    } else {
                        $("#alert").append('<div class="alert-success_error">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success_error").fadeOut(1000, function() {
                                $(".alert-success_error").remove();
                                // window.location.href = "/trung-tam-them-giang-vien/id</? echo $user_id; ?>.html";
                            });
                        }, 3000);
                    }
                },
                // error: function(xhr) {
                //     // console.log(xhr);
                //     // alert('Error');
                // }
            });
        }
    }
</script>

</html>