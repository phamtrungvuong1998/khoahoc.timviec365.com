<?php
require_once '../includes/Admin_insert.php';
$today = strtotime(date("d-m-Y"));
if(isset($_POST['teacher'])){
    $course_name = getValue('course_name', 'str', 'POST', '');
    $course_describe = getValue('course_describe', 'str', 'POST', '');
    $course_address = getValue('course_address', 'str', 'POST', '');
    $course_learn = getValue('course_learn', 'str', 'POST', '');
    $course_object = getValue('course_object', 'str', 'POST', '');
    $time_learn = getValue('time_learn', 'int', 'POST', '0');
    $course_slide = getValue('course_slide', 'int', 'POST', '0');
    $district_id = getValue('district_id', 'int', 'POST', '0');
    $user_id = getValue('user_id', 'int', 'POST', '0');
    $cit_id = getValue('cit_id', 'int', 'POST', '0');
    $level_id = getValue('level_id', 'str', 'POST', '0');
    $cate_id = getValue('cate_id', 'int', 'POST', '0');
    $tag_id = getValue('tag_id', 'int', 'POST', '0');
    $price_promotional = getValue('price_promotional', 'int', 'POST', '0');
    $price_listed = getValue('price_listed', 'int', 'POST', '0');
    $price_discount = getValue('price_discount', 'int', 'POST', '0');
    $quantity_std = getValue('quantity_std', 'int', 'POST', '0');
    $month_study = getValue('month_study', 'str', 'POST', '0');

        $data= [
                'user_id'=>$user_id,
                'cate_id'=>$cate_id,
                'course_name'=>$course_name,
                'tag_id'=>$tag_id,
                'course_describe'=>$course_describe,
                'course_learn'=>$course_learn,
                'course_object'=>$course_object,
                'course_slug'=> ChangeToSlug($course_name),
                'course_slide'=>$course_slide,
                'price_listed'=>$price_listed,
                'price_promotional'=>$price_promotional,
                'price_discount'=>$price_discount,
                'quantity_std'=>$quantity_std,
                'level_id'=>$level_id,
                'time_learn'=>$time_learn,
                'month_study'=>$month_study,
                'course_type'=>1,
                'teacher_center'=>2,
                'created_at'=>$today,
                'updated_at'=>$today
            ];
            add('courses', $data);
            $id = mysql_insert_id();
            $data1= [
                'course_id'=>$id,
                'cit_id'=>$cit_id,
                'course_address'=>$course_address,
                'district_id'=>$district_id,
            ];
            add('course_basis', $data1);
            header("location:/Admin/admin_list_offline.php");
}
if(isset($_POST['center'])){
    $course_name = getValue('course_name', 'str', 'POST', '');
    $course_describe = getValue('course_describe', 'str', 'POST', '');
    $course_address = getValue('course_address', 'str', 'POST', '');
    $course_learn = getValue('course_learn', 'str', 'POST', '');
    $course_object = getValue('course_object', 'str', 'POST', '');
    $time_learn = getValue('time_learn', 'int', 'POST', '0');
    $course_slide = getValue('course_slide', 'int', 'POST', '0');
    $district_id = getValue('district_id', 'int', 'POST', '0');
    $user_id = getValue('user_id', 'int', 'POST', '0');
    $cit_id = getValue('cit_id', 'int', 'POST', '0');
    $level_id = getValue('level_id', 'str', 'POST', '0');
    $cate_id = getValue('cate_id', 'int', 'POST', '0');
    $tag_id = getValue('tag_id', 'int', 'POST', '0');
    $center_teacher_id = getValue('center_teacher_id', 'int', 'POST', '0');
    $price_promotional = getValue('price_promotional', 'int', 'POST', '0');
    $price_listed = getValue('price_listed', 'int', 'POST', '0');
    $price_discount = getValue('price_discount', 'int', 'POST', '0');
    $quantity_std = getValue('quantity_std', 'int', 'POST', '0');
    $month_study = getValue('month_study', 'str', 'POST', '0');
    $qualification = getValue('qualification','int','POST','0');

        $data= [
                'user_id'=>$user_id,
                'center_teacher_id'=>$center_teacher_id,
                'cate_id'=>$cate_id,
                'course_name'=>$course_name,
                'tag_id'=>$tag_id,
                'course_describe'=>$course_describe,
                'course_learn'=>$course_learn,
                'course_object'=>$course_object,
                'course_slug'=> ChangeToSlug($course_name),
                'course_slide'=>$course_slide,
                'price_listed'=>$price_listed,
                'price_promotional'=>$price_promotional,
                'price_discount'=>$price_discount,
                'quantity_std'=>$quantity_std,
                'level_id'=>$level_id,
                'time_learn'=>$time_learn,
                'month_study'=>$month_study,
                'certification'=>$qualification,
                'course_type'=>1,
                'teacher_center'=>3,
                'created_at'=>$today,
                'updated_at'=>$today
            ];
            add('courses', $data);
            $id = mysql_insert_id();
            $data1= [
                'course_id'=>$id,
                'cit_id'=>$cit_id,
                'course_address'=>$course_address,
                'district_id'=>$district_id,
            ];
            add('course_basis', $data1);
            header("location:/Admin/admin_list_offline.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tạo khóa học offline</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
    #create_8 {
        background: #18191b;
        border-left: 8px solid #13895F;
    }

    #action8 {
        display: block;
    }

    #title_manager {
        width: 100%;
    }

    [id*=admin_edit] {
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

    .create_btn {
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
            <div id="choose">
                <button id="center" class="showform">Trung Tâm</button>
                <button id="teacher">Giảng Viên</button>
            </div>

            <center id="v_info_ad">
                <form method="POST" enctype="multipart/form-data">
                    <div class="v_detail_student">
                        <div>Trung tâm:</div>
                        <div>
                            <select name="user_id" id="user_id" class="v_select2">
                                <?php $qr_cate6 = new db_query("SELECT user_id, user_name,user_phone FROM users where user_type = 3"); ?>
                                <option value="0">Chọn Trung tâm</option>
                                <?php while($row_cate = mysql_fetch_array($qr_cate6->result)){ ?>
                                <option value="<?php echo $row_cate['user_id']; ?>">
                                    <?php echo $row_cate['user_phone'].' - '.$row_cate['user_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Tên khóa học:</div>
                        <div><input type="text" id="course_name" name="course_name" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Môn học:</div>
                        <div>
                            <select name="cate_id" id="cate_id" class="cate_id v_select2">
                                <?php $qr_cate = new db_query("SELECT cate_id, cate_name FROM categories"); ?>
                                <option value="0">Chọn môn học</option>
                                <?php while($row_cate = mysql_fetch_array($qr_cate->result)){ ?>
                                <option value="<?php echo $row_cate['cate_id']; ?>">
                                    <?php echo $row_cate['cate_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Môn học chi tiết:</div>
                        <div>
                            <select name="tag_id" id="tag_id" class="tag_id v_select2">
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Mô tả khóa học:</div>
                        <div><textarea name="course_describe" id="course_describe" cols="30" rows="10"></textarea></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Bạn sẽ học những gì:</div>
                        <div><textarea name="course_learn" id="course_learn" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Đối tượng học viên:</div>
                        <div><textarea name="course_object" id="course_object" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Giảng viên giảng dạy:</div>
                        <div>
                            <select name="center_teacher_id" id="center_teacher_id" class="v_select2">
                                <option>Chọn giảng viên</option>
                                <?php
                            $qr = new db_query("SELECT `center_teacher_id`,`teacher_name` FROM `user_center_teacher`");
                            while ($row = mysql_fetch_array($qr->result)) {
                                ?>
                                <option value="<?php echo $row['center_teacher_id']; ?>">
                                    <?php echo $row['teacher_name']; ?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Thời gian học:</div>
                        <div><input type="number" id="time_learn" name="time_learn" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Tài liệu học:</div>
                        <div><input type="number" id="course_slide" name="course_slide" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Giá gốc:</div>
                        <div><input type="number" id="price_listed" name="price_listed" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Giá khuyến mại:</div>
                        <div><input type="number" id="price_promotional" name="price_promotional" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Mua chung:</div>
                        <div>
                            <span>Số lượng học viên</span><input class="muachung" name="quantity_std" type="number"
                                id="quantity_std" required>
                            <span>Khoảng giá</span><input class="muachung" type="number" id="price_discount"
                                name="price_discount" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Chứng chỉ:</div>
                        <div class="certification">
                            <input class="chungchi" name="qualification" type="radio" value="1">Có
                            <input class="chungchi" name="qualification" type="radio" value="2">Không
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Trình độ:</div>
                        <div class="levels">
                            <?php $qr_level = new db_query("SELECT * FROM levels");
                            while($row_lv = mysql_fetch_array($qr_level->result)){
                            ?>
                            <input class="trinhdo" value="<?php echo $row_lv['level_id'] ?>" name="level_id"
                                type="radio"><?php echo $row_lv['level_name']; ?>
                            <?php }?>
                        </div>
                    </div>

                    <div class="v_detail_student">
                        <div>Thời gian học:</div>
                        <div><input type="text" placeholder="VD: 6 tháng" name="month_study" id="month_study" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Tỉnh, thành phố:</div>
                        <div>
                            <select name="cit_id" id="cit_id" class="v_select2">
                                <?php $qr_cate3 = new db_query("SELECT cit_id, cit_name FROM city where cit_parent = 0"); ?>
                                <option value="0">Chọn Thành phố</option>
                                <?php while($row_cate = mysql_fetch_array($qr_cate3->result)){ ?>
                                <option value="<?php echo $row_cate['cit_id']; ?>">
                                    <?php echo $row_cate['cit_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Quận, huyện:</div>
                        <div>
                            <select name="district_id" id="district_id" class="v_select2">
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Địa chỉ:</div>
                        <div><input type="text" name="month_study" id="month_study" required></div>
                    </div>
                    <div><button type="submit" name="center" class="create_btn">Thêm mới</button></div>
                </form>
            </center>
        </div>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".v_select2").select2();

    $('.cate_id').change(function() {
        cate_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "/../ajax/h_ajax_cate_tag.php",
            dataType: 'json',
            data: {
                cate_id: cate_id
            },
            success: function(data) {
                $(".tag_id").html(data.html);
            }
        });
    });
    $('.cit_id').change(function() {
        tinh = $(this).val();
        $.ajax({
            type: "POST",
            url: "/../ajax/h_ajax_load_city.php",
            data: {
                tinh: tinh
            },
            success: function(result) {
                $(".district_id").html(result);
            }
        });
    });
    $('#center').click(function() {
        html = `
            <form method="POST" enctype="multipart/form-data">
                    <div class="v_detail_student">
                        <div>Trung tâm:</div>
                        <div>
                            <select name="user_id" id="user_id" class="v_select2">
                                <?php $qr_cate6 = new db_query("SELECT user_id, user_name,user_phone FROM users where user_type = 3"); ?>
                                <option value="0">Chọn Trung tâm</option>
                                <?php while($row_cate = mysql_fetch_array($qr_cate6->result)){ ?>
                                <option value="<?php echo $row_cate['user_id']; ?>">
                                    <?php echo $row_cate['user_phone'].' - '.$row_cate['user_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Tên khóa học:</div>
                        <div><input type="text" id="course_name" name="course_name" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Môn học:</div>
                        <div>
                            <select name="cate_id" id="cate_id" class="cate_id v_select2">
                                <?php $qr_cate = new db_query("SELECT cate_id, cate_name FROM categories"); ?>
                                <option value="0">Chọn môn học</option>
                                <?php while($row_cate = mysql_fetch_array($qr_cate->result)){ ?>
                                <option value="<?php echo $row_cate['cate_id']; ?>">
                                    <?php echo $row_cate['cate_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Môn học chi tiết:</div>
                        <div>
                            <select name="tag_id" id="tag_id" class="tag_id v_select2">
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Mô tả khóa học:</div>
                        <div><textarea name="course_describe" id="course_describe" cols="30" rows="10"></textarea></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Bạn sẽ học những gì:</div>
                        <div><textarea name="course_learn" id="course_learn" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Đối tượng học viên:</div>
                        <div><textarea name="course_object" id="course_object" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Giảng viên giảng dạy:</div>
                        <div>
                            <select name="center_teacher_id" id="center_teacher_id" class="v_select2">
                            <option>Chọn giảng viên</option>
                                     <?php
                            $qr = new db_query("SELECT `center_teacher_id`,`teacher_name` FROM `user_center_teacher`");
                            while ($row = mysql_fetch_array($qr->result)) {
                                ?>
                                        <option value="<?php echo $row['center_teacher_id']; ?>">
                                            <?php echo $row['teacher_name']; ?></option>
                                        <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Thời gian học:</div>
                        <div><input type="number" id="time_learn" name="time_learn" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Tài liệu học:</div>
                        <div><input type="number" id="course_slide" name="course_slide" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Giá gốc:</div>
                        <div><input type="number" id="price_listed" name="price_listed" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Giá khuyến mại:</div>
                        <div><input type="number" id="price_promotional" name="price_promotional" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Mua chung:</div>
                        <div>
                            <span>Số lượng học viên</span><input class="muachung" name="quantity_std" type="number"
                                id="quantity_std" required>
                            <span>Khoảng giá</span><input class="muachung" type="number" id="price_discount"
                                name="price_discount" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Chứng chỉ:</div>
                        <div class="certification">
                            <input class="chungchi" name="certification" type="radio" value="1">Có
                            <input class="chungchi" name="certification" type="radio" value="2">Không
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Trình độ:</div>
                        <div class="levels">
                            <?php $qr_level = new db_query("SELECT * FROM levels");
                            while($row_lv = mysql_fetch_array($qr_level->result)){
                            ?>
                            <input class="trinhdo" value="<?php echo $row_lv['level_id'] ?>" name="level_id"
                                type="radio"><?php echo $row_lv['level_name']; ?>
                            <?php }?>
                        </div>
                    </div>

                    <div class="v_detail_student">
                        <div>Thời gian học:</div>
                        <div><input type="text" placeholder="VD: 6 tháng" name="month_study" id="month_study" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Tỉnh, thành phố:</div>
                        <div>
                            <select name="cit_id" id="cit_id" class="cit_id v_select2">
                                <?php $qr_cate3 = new db_query("SELECT cit_id, cit_name FROM city where cit_parent = 0"); ?>
                                <option value="0">Chọn Thành phố</option>
                                <?php while($row_cate = mysql_fetch_array($qr_cate3->result)){ ?>
                                <option value="<?php echo $row_cate['cit_id']; ?>">
                                    <?php echo $row_cate['cit_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Quận, huyện:</div>
                        <div>
                            <select name="district_id" id="district_id" class="district_id v_select2">
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Địa chỉ:</div>
                        <div><input type="text" name="month_study" id="month_study" required></div>
                    </div>
                    <div><button type="submit" name="center" class="create_btn">Thêm mới</button></div>
                </form>
        `;
        $("#v_info_ad").html(html);
        $("#center").addClass("showform");
        $("#teacher").removeClass("showform");
    });

    $('#teacher').click(function() {
        html = `
            <form method="POST" enctype="multipart/form-data">
                    <div class="v_detail_student">
                        <div>Giảng viên:</div>
                        <div>
                            <select name="user_id" id="user_id" class="v_select2">
                                <?php $qr_cate6 = new db_query("SELECT user_id, user_name,user_phone FROM users where user_type = 2"); ?>
                                <option value="0">Chọn Giảng viên</option>
                                <?php while($row_cate = mysql_fetch_array($qr_cate6->result)){ ?>
                                <option value="<?php echo $row_cate['user_id']; ?>">
                                    <?php echo $row_cate['user_phone'].' - '.$row_cate['user_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Tên khóa học:</div>
                        <div><input type="text" id="course_name" name="course_name" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Môn học:</div>
                        <div>
                            <select name="cate_id" id="cate_id" class="cate_id v_select2">
                                <?php $qr_cate = new db_query("SELECT cate_id, cate_name FROM categories"); ?>
                                <option value="0">Chọn môn học</option>
                                <?php while($row_cate = mysql_fetch_array($qr_cate->result)){ ?>
                                <option value="<?php echo $row_cate['cate_id']; ?>">
                                    <?php echo $row_cate['cate_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Môn học chi tiết:</div>
                        <div>
                            <select name="tag_id" id="tag_id" class="tag_id v_select2">
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Mô tả khóa học:</div>
                        <div><textarea name="course_describe" id="course_describe" cols="30" rows="10"></textarea></div>
                    </div>

                    <div class="v_detail_student">
                        <div>Bạn sẽ học những gì:</div>
                        <div><textarea name="course_learn" id="course_learn" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Đối tượng học viên:</div>
                        <div><textarea name="course_object" id="course_object" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Thời gian học:</div>
                        <div><input type="number" id="time_learn" name="time_learn" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Tài liệu học:</div>
                        <div><input type="number" id="course_slide" name="course_slide" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Giá gốc:</div>
                        <div><input type="number" id="price_listed" name="price_listed" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Giá khuyến mại:</div>
                        <div><input type="number" id="price_promotional" name="price_promotional" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Mua chung:</div>
                        <div>
                            <span>Số lượng học viên</span><input class="muachung" name="quantity_std" type="number"
                                id="quantity_std" required>
                            <span>Khoảng giá</span><input class="muachung" type="number" id="price_discount"
                                name="price_discount" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Trình độ:</div>
                        <div class="levels">
                            <?php $qr_level = new db_query("SELECT * FROM levels");
                            while($row_lv = mysql_fetch_array($qr_level->result)){
                            ?>
                            <input class="trinhdo" value="<?php echo $row_lv['level_id'] ?>" name="level_id"
                                type="radio"><?php echo $row_lv['level_name']; ?>
                            <?php }?>
                        </div>
                    </div>

                    <div class="v_detail_student">
                        <div>Thời gian học:</div>
                        <div><input type="text" placeholder="VD: 6 tháng" name="month_study" id="month_study" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Tỉnh, thành phố:</div>
                        <div>
                            <select name="cit_id" id="cit_id" class="cit_id v_select2">
                                <?php $qr_cate3 = new db_query("SELECT cit_id, cit_name FROM city where cit_parent = 0"); ?>
                                <option value="0">Chọn Thành phố</option>
                                <?php while($row_cate = mysql_fetch_array($qr_cate3->result)){ ?>
                                <option value="<?php echo $row_cate['cit_id']; ?>">
                                    <?php echo $row_cate['cit_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Quận, huyện:</div>
                        <div>
                            <select name="district_id" id="district_id" class="district_id v_select2">
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Địa chỉ:</div>
                        <div><input type="text" name="month_study" id="month_study" required></div>
                    </div>
                    <div><button type="submit" name="teacher" class="create_btn">Thêm mới</button></div>
                </form>
        `;
        $("#v_info_ad").html(html);
        $("#teacher").addClass("showform");
        $("#center").removeClass("showform");
    });
});
</script>

</html>