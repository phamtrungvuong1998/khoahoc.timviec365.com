    <div class="modal fade" id="addteacher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div id="v_alert_teacher"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <div class="modal-header"></div>
                <form onsubmit="return v_teacher();" enctype="multipart/form-data" method="POST"
                    name="v_create_teacher">
                    <div class="teachimg">
                        <div class="teachimg1">
                            <img width="140px" height="140px" id="avatar1" src="../img/image/Group 2728.png">
                            <img width="40px" height="40px" class="camera-img1" src="../img/image/uploadimg.svg">
                        </div>
                        <input type="file" class="hidden" id="img1" name="avatar" onchange="changeImg1(this)">
                    </div>
                    <div class="teachbody">
                        <div class="form-group">
                            <label>Họ tên</label>
                            <input type="text" id="v_teacher_name" name="teacher_name">
                            <p id="v_teacher-1"></p>
                        </div>
                        <div class="form-group">
                            <label>Môn học giảng dạy</label>
                            <select name="cate_id" onchange="v_cate(this)" id="cate_multip" multiple>
                                <?
                                $db_cat = new db_query("SELECT * FROM `categories`");
                                while ($row = mysql_fetch_array($db_cat->result)) {
                                    ?>
                                <option value="<?php echo $row['cate_id']?>"><?php echo $row['cate_name']?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <p id="v_teacher-2"></p>
                        </div>
                        <div class="form-group">
                            <label>Bằng cấp chứng chỉ</label>
                            <input type="text" id="v_quafilication" name="qualification"
                                placeholder="Vd: Kỹ sư công nghệ thông tin">
                            <p id="v_teacher-3"></p>
                        </div>
                        <div class="form-group">
                            <label>Ngày tham gia</label>
                            <input type="date" id="v_date_join" name="date_join" placeholder="23/11/2021">
                            <p id="v_teacher-4"></p>
                        </div>
                        <input type="hidden" name="v_teacher_hidden">
                        <div class="form-group addbtn">
                            <button type="submit" id="addteach" name="submit_center_teacher" value="THÊM MỚI">THÊM
                                MỚI</button>
                            <button data-dismiss="modal" type="button" id="quitteach" name="button">HỦY BỎ</button>
                        </div>
                    </div>
                </form>
                <input type="hidden" name="v_teacher_hidden" id="v_teacher_hidden">
            </div>
        </div>
    </div>
    <script type="text/javascript">
function v_teacher() {
    form_data = new FormData();
    if ($("#img1").prop('files')[0] == undefined || $("#avatar1").attr("src") == "../img/image/Group 2728.png") {
        $("#v_alert_teacher").append('<div class="alert" id="alert_img">Vui lòng chọn ảnh</div>');
        $("#img1").show();
        $("#img1").focus();
        $("#img1").hide();
        setTimeout(function() {
            $("#alert_img").fadeOut(1000, function() {
                $("#alert_img").remove();
            })
        }, 2000);
        return false;
    } else if ($("#img1").prop('files')[0] != undefined) {
        var match = ["image/jpeg", "image/JPEG", "image/png", "image/PNG", "image/jpg", "image/JPG"];
        var j = 0;
        for (var i = 0; i < match.length; i++) {
            if ($('#img1').prop('files')[0].type != match[i]) {
                j++;
            }
        }
        if (j == 6) {
            $("#v_alert_teacher").append('<div class="alert" id="alert_img">Vui lòng chọn đúng định dạng ảnh</div>');
            setTimeout(function() {
                $("#alert_img").fadeOut(1000, function() {
                    $("#alert_img").remove();
                });
            }, 2000);
            $('#img1').show();
            $('#img1').focus();
            $('#img1').hide();
            return false;
        } else {
            form_data.append('file', $('#img1').prop('files')[0]);
        }
    }

    if ($("#v_teacher_name").val() == "") {
        $("#v_alert_teacher").append(
            '<div class="alert" id="alert_teacher_name">Tên giảng viên không được để trống</div>');
        $("#v_teacher_name").focus();
        setTimeout(function() {
            $("#alert_teacher_name").fadeOut(1000, function() {
                $("#alert_teacher_name").remove();
            })
        }, 2000);
        return false;
    } else {
        form_data.append('teacher_name', $("#v_teacher_name").val());
    }

    if ($("#cate_multip").val() == null) {
        $("#v_alert_teacher").append('<div class="alert" id="cate_multip">Vui lòng chọn môn học giảng dạy</div>');
        $("#cate_multip").focus();
        setTimeout(function() {
            $("#cate_multip").fadeOut(1000, function() {
                $("#cate_multip").remove();
            })
        }, 2000);
        return false;
    } else {
        form_data.append('cate_id', $("#cate_multip").val());
    }

    if ($("#v_quafilication").val() == '') {
        $("#v_alert_teacher").append(
            '<div class="alert" id="quafilication">Bằng cấp chứng chỉ không được để trống</div>');
        $("#v_quafilication").focus();
        setTimeout(function() {
            $("#quafilication").fadeOut(1000, function() {
                $("#quafilication").remove();
            })
        }, 2000);
        return false;
    } else {
        form_data.append('quafilication', $("#v_quafilication").val());
    }

    if ($("#v_date_join").val() == '') {
        $("#v_alert_teacher").append('<div class="alert" id="date_join">Bằng cấp chứng chỉ không được để trống</div>');
        $("#v_date_join").focus();
        setTimeout(function() {
            $("#date_join").fadeOut(1000, function() {
                $("#date_join").remove();
            })
        }, 2000);
        return false;
    } else {
        form_data.append('date_join', $("#v_date_join").val());
    }

    $.ajax({
        url: '../code_xu_ly/V_create_center_teacher.php',
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        data: form_data,
        success: function(data) {
            if (data.type == 1) {
                $("#avatar1").attr('src', '../img/image/Group 2728.png');
                $("#v_teacher_name").val("");
                $("#cate_multip").val("");
                $("#v_quafilication").val("");
                $("#v_date_join").val("");
                $("#addteacher").modal("hide");
                $("#v_alert").append(
                    '<div class="success" id="teacher_success">Thêm giảng viên thành công</div>');
                setTimeout(function() {
                    $("#teacher_success").fadeOut(1000, function() {
                        $("#teacher_success").remove();
                    })
                }, 2500);
            }
            var html = `
                <option class="teach2db" value="` + data.id + `">` + data.teacher_name + `</option>
            `;
            $("#teach2").html(html);
            document.getElementById('first4').style.display = "none";
        }
    });

    return false;
}
    </script>