<?php
require_once '../includes/Admin_insert.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Danh sách khóa học online</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
    #action9 {
        display: block;
    }

    #list_9 {
        background: #18191b;
        border-left: 8px solid #13895F;
    }

    #title_manager {
        width: 100%;
    }

    [id*=admin_edit],
    [id*=remove] {
        cursor: pointer;
        width: 12px;
        height: 12px;
        margin: 0;
        padding: 0;
        border: 0;
        outline: 0;
        font-weight: inherit;
        font-style: inherit;
        vertical-align: baseline;
    }

    #v_info_ad {
        display: block;
    }

    .v_detail_student {
        display: flex;
        padding-bottom: 20px;
    }

    .v_detail_student>div:first-child {
        flex-basis: 20%;
        text-align: left;
    }

    .v_detail_student>div:last-child {
        flex-basis: 60%;
    }

    .v_detail_student>div:last-child>input,
    .v_detail_student>div:last-child>select,
    .v_detail_student>div:last-child>textarea {
        width: 100%;
    }

    #update_student {
        border: none;
        background: orange;
        color: white;
        padding: 2px 10px;
    }

    .city {
        flex-basis: 20% !important;
    }

    .muachung,
    .chungchi {
        width: 30% !important;
    }

    .trinhdo {
        width: 10% !important;
    }

    .levels {
        width: 100%;
    }

    .certification {
        flex-basis: 31% !important;
    }
    </style>
</head>

<body>
    <!-- Left column -->
    <div class="templatemo-flex-row">
        <?php require_once '../includes/Admin_sidebar.php'; ?>
        <!-- Main content -->
        <div class="templatemo-content col-1 light-gray-bg">
            <?php require_once '../includes/Admin_nav.php'; ?>
            <?php
            $qrId = new db_query("SELECT course_id FROM courses WHERE course_type = 2 ORDER BY course_id DESC");
            $qrCate = new db_query("SELECT cate_name,cate_id FROM categories");
            $qrCit = new db_query("SELECT cit_id, cit_name FROM city WHERE cit_parent = 0");
            ?>
            <div id="v_filter">
                <div class="v_filter">
                    <span>ID Khóa học:</span>
                    <select name="" id="v_select_id" class="v_filter_select" onchange="v_filter_student()">
                        <option value="0">ID Khóa học</option>
                        <?php while($row_id = mysql_fetch_array($qrId->result)){ ?>
                        <option value="<?=$row_id['course_id']?>">
                            <?echo $row_id['course_id'];?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="v_filter">
                    <span>Môn học:</span>
                    <select name="" id="v_cate" class="v_filter_select" onchange="v_filter_student()">
                        <option value="0">Môn học</option>
                        <?php while($row_name = mysql_fetch_array($qrCate->result)){ ?>
                        <option value="<?=$row_name['cate_id']?>">
                            <?echo $row_name['cate_name'];?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="v_filter">
                    <span>Môn học chi tiết:</span>
                    <select name="" id="v_tag" class="v_filter_select" onchange="v_filter_student()">
                        <option value="0">Môn học chi tiết</option>
                    </select>
                </div>
                <div class="v_filter">
                    <span>Giảng viên:</span>
                    <select name="" id="v_teacher" class="v_filter_select" onchange="v_filter_student()">
                        <option value="0">Giảng viên</option>
                    </select>
                </div>
                <div class="v_filter">
                    <span>Giá khóa học:</span>
                    <select name="" id="v_prices" class="v_filter_select" onchange="v_filter_student()">
                        <option value="0">Giá khóa học</option>
                        <option value="1">Từ thấp đển cao</option>
                        <option value="2">từ cao đến thấp</option>
                    </select>
                </div>
            </div>
            <div class="v_filter">
                <a href="../code_xu_ly/v_admin_offline_xls.php?type=1" id="v_href_exel"><button id="v_xls">XUẤT
                        EXCEL</button></a>
            </div>
            <center id="v_info_ad">
                <div class="title_input" id="title_manager">
                    <div id="manager">
                        <div class="v_title_student">No</div>
                        <div class="v_title_student">ID khóa học</div>
                        <div class="v_title_student">Tên khóa học</div>
                        <div class="v_title_student">Môn học</div>
                        <div class="v_title_student">Trung tâm/Giảng viên</div>
                        <div class="v_title_student">Giá khóa học</div>
                        <div class="v_title_student">Ngày tạo</div>
                        <div class="v_title_student">Ngày cập nhật</div>
                        <div class="v_title_student">index</div>
                        <div class="v_title_student">Sửa</div>
                    </div>
                    <?php 
                    $i = 1;
                    $qr = new db_query("SELECT * FROM courses INNER JOIN categories ON courses.cate_id = categories.cate_id INNER JOIN users ON users.user_id = courses.user_id WHERE courses.course_type = 2 ORDER BY courses.course_id DESC LIMIT 0, 30");
                    $count = new db_query("SELECT course_id FROM courses WHERE course_type = 1");
                    $page = ceil(mysql_num_rows($count->result)/30);

                    while ($rowHV = mysql_fetch_array($qr->result)) {
                      if ($rowHV['user_active'] == 1) {
                        $user_active = "checked";
                    }else{
                        $user_active = "";
                    }

                    if ($rowHV['user_index'] == 1) {
                        $user_index = "checked";
                    }else{
                        $user_index = "";
                    }
                    ?>
                    <div class="manager" id="manager<?php echo $rowHV['course_id'];?>">
                        <div class="v_title_student"><?php echo $i; ?></div>
                        <div class="v_title_student"><?php echo $rowHV['course_id']; ?></div>
                        <div class="v_title_student"><?php echo $rowHV['course_name']; ?>
                        </div>
                        <div class="v_title_student"><?php echo $rowHV['cate_name']; ?></div>
                        <?php
                        if ($rowHV['user_type'] == 3) {
                            $link = urlDetail_center($rowHV['user_id'], $rowHV['user_slug']);
                        }else if ($rowHV['user_type'] == 2) {
                            $link = urlDetail_teacher($rowHV['user_id'], $rowHV['user_slug']);
                        }
                        ?>
                        <div class="v_title_student"><a
                                href="<?php echo $link; ?>"><?php echo $rowHV['user_name']; ?></a></div>
                        <div class="v_title_student"><?php echo number_format($rowHV['price_promotional']) . " đ"; ?>
                        </div>
                        <div class="v_title_student"><?php echo date("d-m-Y",$rowHV['created_at']); ?></div>
                        <div class="v_title_student"><?php echo date("d-m-Y",$rowHV['updated_at']); ?></div>
                        <div class="v_title_student"><input type="checkbox" class="v_index"
                                id="v_index<?php echo $rowHV['user_id']; ?>" name="student_index"
                                onclick="active(<?php echo $rowHV['user_id']; ?>)" <?php echo $user_index; ?>></div>
                        <div class="v_title_student"><img id="admin_edit<?php echo $rowHV['course_id']; ?>"
                                src="../img/vv_edi.svg"
                                onclick="v_student_edit(<?php echo $rowHV['course_id']; ?>,<?php echo $rowHV['teacher_center']; ?>)"
                                alt="Ảnh lỗi"></div>
                    </div>

                    <?php
                            $i++;
                        }
                        ?>
                </div>
                <div id="v_paginition">
                    <ul id="v_ul_paginition">
                        <li id="v_previous" onclick="v_paging('previous')">
                        </li>
                        <?php for ($i = 1; $i <= $page; $i++) { ?>
                        <li id="v_pa<?=$i?>" class="v_pa" onclick="v_paging(<?=$i?>)"><?=$i?></li>
                        <?php } ?>
                        <li id="v_next" onclick="v_paging('next')">></li>
                    </ul>
                </div>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript">
$("#v_name").select2();
$("#v_select_id").select2();
$("#v_phone").select2();
$("#v_email").select2();
$("#v_pa1").css({
    background: '#1B6AAB',
    color: 'white'
});

$(".v_filter_select").select2();

$("#v_previous").hide();
if ($(".manager").length == <?php echo mysql_num_rows($count->result); ?>) {
    $("#v_next").hide();
}

function v_filter_student() {
    var course_id = $("#v_select_id").val();
    if (course_id == 0) {
        var get_id = '';
    } else {
        var get_id = '&course_id=' + course_id;
    }
    var cate = $("#v_cate").val();
    if (cate == 0) {
        var get_cate = '';
    } else {
        var get_cate = '&cate_id=' + cate;
    }
    var tag = $("#v_tag").val();
    if (tag == 0) {
        var get_tag = '';
    } else {
        var get_tag = '&tag_id=' + tag;
    }
    var teacher = $("#v_teacher").val();
    if (teacher == 0) {
        var get_teacher = '';
    } else {
        var get_teacher = '&teacher_id=' + teacher;
    }
    var prices = $("#v_prices").val();
    if (prices == 0) {
        var get_prices = '';
    } else {
        var get_prices = '&prices=' + prices;
    }

    $("#v_href_exel").attr({
        'href': '../code_xu_ly/v_admin_online_xls.php?type=1&' + get_id + get_cate + get_tag + get_teacher +
            get_prices
    });
    $.ajax({
        url: '../ajax/v_admin_list_online.php',
        type: 'POST',
        dataType: 'json',
        data: {
            course_id: course_id,
            cate_id: cate,
            tag_id: tag,
            teacher_id: teacher,
            prices: prices,
            page: 1
        },
        success: function(data) {
            if (cate != 0) {
                $("#v_tag").html(data.tag);
            }
            $('.manager').remove();
            if (data.html == "") {
                $("#manager").hide();
                $("#v_paginition").remove();
                $('#title_manager').append('<div id="no-list">Không có danh sách</div>');
            } else {
                $("#no-list").remove();
                $("#manager").show();
                $('#title_manager').append(data.html);
                $('#v_paginition').html(data.v_paging);
                $("#v_pa1").css({
                    background: '#1B6AAB',
                    color: 'white'
                });
                $("#v_previous").hide();
                if ($(".v_pa").length == 1) {
                    $("#v_previous").remove();
                    $("#v_next").remove();
                    $(".v_pa").remove();
                }
            }
        }
    });

}

function v_paging(page) {
    var course_id = $("#v_select_id").val();
    var cate = $("#v_cate").val();
    var tag = $("#v_tag").val();
    var teacher = $("#v_teacher").val();
    var prices = $("#v_prices").val();
    var address = $("#v_address").val();
    if (page == 'next') {
        for (var i = 0; i < $('.v_pa').length; i++) {
            if ($(".v_pa")[i].style.background == "rgb(27, 106, 171)") {
                page = i + 2;
            }
        }
    } else if (page == 'previous') {
        for (var i = 0; i < $('.v_pa').length; i++) {
            if ($(".v_pa")[i].style.background == "rgb(27, 106, 171)") {
                page = i;
            }
        }
    }

    // $("#v_href_exel").attr({'href': '../code_xu_ly/v_admin_xls.php?type=1&page='+page+get_id+get_name+get_phone+get_email+get_startTime+get_endTime});

    $.ajax({
        url: '../ajax/v_admin_list_online.php',
        type: 'POST',
        dataType: 'json',
        data: {
            course_id: course_id,
            cate_id: cate,
            tag_id: tag,
            teacher_id: teacher,
            prices: prices,
            address: address,
            page: page
        },
        success: function(data) {
            $('.manager').remove();
            $('#title_manager').append(data.html);
            for (var i = 0; i < $('.v_pa').length; i++) {
                if (i != page - 1) {
                    $('.v_pa')[i].style.background = "none";
                    $('.v_pa')[i].style.color = "black";
                } else {
                    $('.v_pa')[i].style.background = "#1B6AAB";
                    $('.v_pa')[i].style.color = "white";
                    if (i == 0) {
                        $("#v_previous").hide();
                        $("#v_next").show();
                        $("#v_previous").hide();
                        if ($(".manager").length == <?php echo mysql_num_rows($count->result); ?>) {
                            $("#v_next").hide();
                        }
                    } else if (i == $('.v_pa').length - 1) {
                        $("#v_next").hide();
                        $("#v_previous").show();
                    } else {
                        $("#v_previous").show();
                        $("#v_next").show();
                    }
                }
            }
        }
    });

}

function v_student_edit(course_id, teacher_center) {
    var adm_edit = <?php
            if ($row['adm_type'] == 1) {
              echo $row['adm_type'];
          }else{
              echo $row['student_edit'];
          } 
          ?>;
    if (adm_edit == 0) {
        alert("Bạn không có quyền sửa");
    } else if (adm_edit == 1) {
        if (teacher_center == 3) {
            var urls = '../ajax/Admin_update_online.php';
        } else if (teacher_center == 2) {
            var urls = '../ajax/Admin_update_online2.php';
        }
        $.ajax({
            url: urls,
            type: 'GET',
            dataType: 'json',
            data: {
                course_id: course_id
            },
            success: function(data) {
                $("#v_info_ad").html(data.html);
                $('#categories').select2({
                    multiple: true,
                    maximumSelectionLength: 5,
                    minimumInputLength: 0,
                });
            }
        });
    }
}


var adm_student_type = <?php 
    if ($row['adm_type'] == 1) {
        echo $row['adm_type'];
    }else{
        echo $row['student_edit'];
    }
    ?>;

if (adm_student_type == 0) {
    for (var i = 0; i < $(".v_active").length; i++) {
        $(".v_active")[i].disabled = true;
        $(".v_index")[i].disabled = true;
    }
}

function active(user_id) {
    if ($("#v_active" + user_id)[0].checked === true) {
        var active = 1;
    } else if ($("#v_active" + user_id)[0].checked === false) {
        var active = 0;
    }

    if ($("#v_index" + user_id)[0].checked === true) {
        var index = 1;
    } else if ($("#v_index" + user_id)[0].checked === false) {
        var index = 0;
    }

    $.get('../ajax/v_user_active.php', {
        active: active,
        index: index,
        user_id: user_id
    }, function(data) {});
}
</script>

</html>