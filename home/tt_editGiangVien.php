<?
include '../includes/v_insert_TT.php';
$get_id_teacher = getValue('gv', 'int', 'get', 0, 0);
$db_teacher = new db_query("SELECT * FROM user_center_teacher WHERE center_teacher_id=" . $get_id_teacher);
$teacher = mysql_fetch_assoc($db_teacher->result);
$db_cat = new db_query("SELECT * FROM categories");

$a = explode(',', $teacher['cate_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <title>Danh sách đánh giá</title>
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
            <div class="l_title">
                <hr class="l_hr">
                <div class="l_title_text">CẬP NHẬT THÔNG TIN GIẢNG VIÊN CỦA TRUNG TÂM</div>
            </div>
            <div id="alert"></div>
            <div class="l_content">
                <form onsubmit="l_validate_submit(); return false;" name="l_form" enctype="multipart/form-data">
                    <div>
                        <div class="l_content_img">
                            <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' id="l_img" src="/img/load.gif" data-src="<?= '../img/avatar/' . $teacher['teacher_avatar'] ?>" alt="loading..." class="lazyload l_img_item">
                            <input type="file" id="l_file" />
                            <label id="l_uploadimg" class="l_file-upload" for="l_file">
                                <img class="lazyload" src="/img/load.gif" data-src="../img/l_up_image.svg" alt="loading...">
                            </label>
                        </div>
                    </div>
                    <div class="l_content_item">
                        <div class="l_hoten">Họ tên</div>
                        <div>
                            <input type="hidden" id="l_id" value="<? echo $get_id_teacher; ?>">
                            <input value="<? echo $teacher['teacher_name']; ?>" type="text" name="l_hoten" id="l_hoten" class="l_input">
                        </div>
                        <p id="l_error1" class="l_text_error"></p>
                    </div>
                    <div class="l_content_item1">
                        <div class="l_hoten">Môn học giảng dạy</div>
                        <div class="l_monhoc">
                            <select name="l_monhoc[]" id="l_monhoc" multiple>
                                <?php
                                while ($row = mysql_fetch_assoc($db_cat->result)) { ?>
                                    <option value="<? echo $row['cate_id'] ?>" <? for ($i = 0; $i < count($a); $i++) {
                                                                                    if ($a[$i] == $row['cate_id']) {
                                                                                        echo "selected";
                                                                                    }
                                                                                } ?>>
                                        <? echo $row['cate_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <p id="l_error2" class="l_text_error"></p>
                        </div>
                    </div>
                    <div class="l_content_item1">
                        <div class="l_hoten">Bằng cấp chứng chỉ</div>
                        <div>
                            <input value="<? echo $teacher['qualification']; ?>" id="l_bangcap" type="text" name="l_bangcap" placeholder="Vd: Kỹ sư công nghệ thông tin" class="l_input">
                        </div>
                        <p id="l_error3" class="l_text_error"></p>
                    </div>
                    <div class="l_content_item1">
                        <div class="l_hoten">Ngày tham gia</div>
                        <div>
                            <input value="<? echo date('Y-m-d', $teacher['date_join']); ?>" type="date" name="l_date" placeholder="" class="l_input">
                        </div>
                        <p id="l_error4" class="l_text_error"></p>
                    </div>
                    <div class="l_content_item2">
                        <button onclick="l_validate_submit(); return false;" type="submit" class="l_btn_add">CẬP
                            NHẬT</button>
                        <button class="l_btn_reset" type="reset">HỦY BỎ</button>
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

    function validate_str(str) {
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
        const choosedFile = this.files[0];
        if (choosedFile) {
            const reader = new FileReader();
            reader.addEventListener('load', function() {
                img.setAttribute('src', reader.result);
            });
            reader.readAsDataURL(choosedFile);
        }
    });

    function l_validation() {
        var flag = false;
        var l_hoten = document.l_form.l_hoten.value;
        var l_monhoc = document.l_form.l_monhoc.value;
        var l_bangcap = document.l_form.l_bangcap.value;
        var l_date = document.l_form.l_date.value;

        if (l_hoten == '') {
            document.getElementById("l_error1").innerHTML = "Bạn chưa nhập tên giảng viên";
            return false;
        } else {
            document.getElementById("l_error1").style.display = "none";
            flag = true;
        }

        if (l_monhoc == '') {
            document.getElementById("l_error2").innerHTML = "Bạn chưa nhập môn học giảng dạy";
            return false;
        } else {
            document.getElementById("l_error2").style.display = "none";
            flag = true;
        }

        if (l_bangcap == '') {
            document.getElementById("l_error3").innerHTML = "Bạn chưa nhập bằng cấp";
            return false;
        } else {
            document.getElementById("l_error3").style.display = "none";
            flag = true;
        }

        if (l_date == '') {
            document.getElementById("l_error4").innerHTML = "Bạn chưa nhập ngày tham gia";
            return false;
        } else {
            document.getElementById("l_error4").style.display = "none";
            flag = true;
        }
        return flag;

    }

    function l_validate_submit() {
        var flag = l_validation();
        if (flag == true) {
            var l_id = document.getElementById('l_id').value;
            var l_hoten = document.l_form.l_hoten.value;
            var l_monhoc = document.l_form.l_monhoc.value;
            var l_bangcap = document.l_form.l_bangcap.value;
            var l_date = document.l_form.l_date.value;


            var data = new FormData();
            data.append('l_id', l_id);
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
                url: '../ajax/l_ajax_editGiangVien.php',
                type: 'post',
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.result == true) {
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                $(".alert-success").remove();
                            });
                        }, 3000);
                    } else {
                        alert(response.message)
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