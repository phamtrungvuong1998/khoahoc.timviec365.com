<?php
require_once '../includes/Admin_insert.php';
$today = strtotime(date("d-m-Y"));
if(isset($_POST['teacher'])){
    $course_name = getValue('course_name', 'str', 'POST', '');
    $course_describe = getValue('course_describe', 'str', 'POST', '');
    $course_benefit = getValue('course_benefit', 'str', 'POST', '');
    $course_match = getValue('course_match', 'str', 'POST', '');
    $course_request = getValue('course_request', 'str', 'POST', '');
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
    $general_describe = getValue('general_describe','str','POST','');

        $data= [
                'user_id'=>$user_id,
                'cate_id'=>$cate_id,
                'course_name'=>$course_name,
                'tag_id'=>$tag_id,
                'general_describe'=>$general_describe,
                'course_benefit'=>$course_benefit,
                'course_describe'=>$course_describe,
                'course_match'=>$course_match,
                'course_request'=>$course_request,
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
            header("location:/Admin/admin_list_online.php");
}
if(isset($_POST['center'])){
    $course_name = getValue('course_name', 'str', 'POST', '');
    $course_describe = getValue('course_describe', 'str', 'POST', '');
    $course_match = getValue('course_match', 'str', 'POST', '');
    $course_request = getValue('course_request', 'str', 'POST', '');
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
    $general_describe = getValue('general_describe','str','POST','');

        $data= [
                'user_id'=>$user_id,
                'center_teacher_id'=>$center_teacher_id,
                'cate_id'=>$cate_id,
                'course_name'=>$course_name,
                'tag_id'=>$tag_id,
                'course_describe'=>$course_describe,
                'course_benefit'=>$course_benefit,
                'course_match'=>$course_match,
                'course_request'=>$course_request,
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
                'general_describe'=>$general_describe,
                'course_type'=>1,
                'teacher_center'=>3,
                'created_at'=>$today,
                'updated_at'=>$today
            ];
            add('courses', $data);
            header("location:/Admin/admin_list_online.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>T???o kh??a h???c online</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <?php require_once '../includes/Admin_css.php'; ?>
    <link rel="stylesheet" href="../css/select2.min.css" />
    <style>
    #create_9 {
        background: #18191b;
        border-left: 8px solid #13895F;
    }

    #action9 {
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
                <button id="center" class="showform">Trung T??m</button>
                <button id="teacher">Gi???ng Vi??n</button>
            </div>

            <center id="v_info_ad">
                <form method="POST" enctype="multipart/form-data">
                    <div class="v_detail_student">
                        <div>Trung t??m:</div>
                        <div>
                            <select name="user_id" id="user_id" class="v_select2">
                                <?php $qr_cate6 = new db_query("SELECT user_id, user_name,user_phone FROM users where user_type = 3"); ?>
                                <option value="0">Ch???n Trung t??m</option>
                                <?php while($row_cate = mysql_fetch_array($qr_cate6->result)){ ?>
                                <option value="<?php echo $row_cate['user_id']; ?>">
                                    <?php echo $row_cate['user_phone'].' - '.$row_cate['user_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>T??n kh??a h???c:</div>
                        <div><input type="text" id="course_name" name="course_name" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>M??n h???c:</div>
                        <div>
                            <select name="cate_id" id="cate_id" class="v_select2 cate_id">
                                <?php $qr_cate = new db_query("SELECT cate_id, cate_name FROM categories"); ?>
                                <option value="0">Ch???n m??n h???c</option>
                                <?php while($row_cate = mysql_fetch_array($qr_cate->result)){ ?>
                                <option value="<?php echo $row_cate['cate_id']; ?>">
                                    <?php echo $row_cate['cate_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>M??n h???c chi ti???t:</div>
                        <div>
                            <select name="tag_id" id="tag_id" class="v_select2 tag_id">
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>M?? t??? kh??a h???c:</div>
                        <div><input name="course_describe" id="course_describe"></div>
                    </div>
                    <div class="v_detail_student">
                        <div>L???i ??ch kh??a h???c:</div>
                        <div><textarea name="course_benefit" id="course_benefit" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Ph?? h???p v???i ai:</div>
                        <div><textarea name="course_match" id="course_match" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Y??u c???u kh??a h???c:</div>
                        <div><textarea name="course_request" id="course_request" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>M?? t??? t???ng qu??t:</div>
                        <div><textarea name="general_describe" id="general_describe" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Gi???ng vi??n gi???ng d???y:</div>
                        <div>
                            <select name="center_teacher_id" id="center_teacher_id" class="v_select2">
                                <option>Ch???n gi???ng vi??n</option>
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
                        <div>Th???i gian h???c:</div>
                        <div><input type="number" id="time_learn" name="time_learn" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>T??i li???u h???c:</div>
                        <div><input type="number" id="course_slide" name="course_slide" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Gi?? g???c:</div>
                        <div><input type="number" id="price_listed" name="price_listed" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Gi?? khuy???n m???i:</div>
                        <div><input type="number" id="price_promotional" name="price_promotional" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Mua chung:</div>
                        <div>
                            <span>S??? l?????ng h???c vi??n</span><input class="muachung" name="quantity_std" type="number"
                                id="quantity_std" required>
                            <span>Kho???ng gi??</span><input class="muachung" type="number" id="price_discount"
                                name="price_discount" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Ch???ng ch???:</div>
                        <div class="certification">
                            <input class="chungchi" name="qualification" type="radio" value="1">C??
                            <input class="chungchi" name="qualification" type="radio" value="2">Kh??ng
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Tr??nh ?????:</div>
                        <div class="levels">
                            <?php $qr_level = new db_query("SELECT * FROM levels");
                            while($row_lv = mysql_fetch_array($qr_level->result)){
                            ?>
                            <input class="trinhdo" value="<?php echo $row_lv['level_id'] ?>" name="level_id"
                                type="radio"><?php echo $row_lv['level_name']; ?>
                            <?php }?>
                        </div>
                    </div>
                    <div><button type="submit" name="center" class="create_btn">Th??m m???i</button></div>
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

    $('#cate_id').change(function() {
        cate_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "/../ajax/h_ajax_cate_tag.php",
            dataType: 'json',
            data: {
                cate_id: cate_id
            },
            success: function(data) {
                $("#tag_id").html(data.html);
            }
        });
    });
    $('#cate_id2').change(function() {
        cate_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "/../ajax/h_ajax_cate_tag.php",
            dataType: 'json',
            data: {
                cate_id: cate_id
            },
            success: function(data) {
                $("#tag_id2").html(data.html);
            }
        });
    });
    $('#cate_id3').change(function() {
        cate_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "/../ajax/h_ajax_cate_tag.php",
            dataType: 'json',
            data: {
                cate_id: cate_id
            },
            success: function(data) {
                $("#tag_id3").html(data.html);
            }
        });
    });
    $('#center').click(function() {
        html = `
            <form method="POST" enctype="multipart/form-data">
                    <div class="v_detail_student">
                        <div>Trung t??m:</div>
                        <div>
                            <select name="user_id" id="user_id" class="v_select2">
                                <?php $qr_cate6 = new db_query("SELECT user_id, user_name,user_phone FROM users where user_type = 3"); ?>
                                <option value="0">Ch???n Trung t??m</option>
                                <?php while($row_cate = mysql_fetch_array($qr_cate6->result)){ ?>
                                <option value="<?php echo $row_cate['user_id']; ?>">
                                    <?php echo $row_cate['user_phone'].' - '.$row_cate['user_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>T??n kh??a h???c:</div>
                        <div><input type="text" id="course_name" name="course_name" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>M??n h???c:</div>
                        <div>
                            <select name="cate_id" id="cate_id2" class="v_select2 cate_id">
                                <?php $qr_cate = new db_query("SELECT cate_id, cate_name FROM categories"); ?>
                                <option value="0">Ch???n m??n h???c</option>
                                <?php while($row_cate = mysql_fetch_array($qr_cate->result)){ ?>
                                <option value="<?php echo $row_cate['cate_id']; ?>">
                                    <?php echo $row_cate['cate_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>M??n h???c chi ti???t:</div>
                        <div>
                            <select name="tag_id" id="tag_id2" class="v_select2 tag_id">
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>M?? t??? kh??a h???c:</div>
                        <div><input name="course_describe" id="course_describe" ></div>
                    </div>
                    <div class="v_detail_student">
                        <div>L???i ??ch kh??a h???c:</div>
                        <div><textarea name="course_benefit" id="course_benefit" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Ph?? h???p v???i ai:</div>
                        <div><textarea name="course_match" id="course_match" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Y??u c???u kh??a h???c:</div>
                        <div><textarea name="course_request" id="course_request" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>M?? t??? t???ng qu??t:</div>
                        <div><textarea name="general_describe" id="general_describe" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Gi???ng vi??n gi???ng d???y:</div>
                        <div>
                            <select name="center_teacher_id" id="center_teacher_id" class="v_select2">
                            <option>Ch???n gi???ng vi??n</option>
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
                        <div>Th???i gian h???c:</div>
                        <div><input type="number" id="time_learn" name="time_learn" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>T??i li???u h???c:</div>
                        <div><input type="number" id="course_slide" name="course_slide" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Gi?? g???c:</div>
                        <div><input type="number" id="price_listed" name="price_listed" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Gi?? khuy???n m???i:</div>
                        <div><input type="number" id="price_promotional" name="price_promotional" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Mua chung:</div>
                        <div>
                            <span>S??? l?????ng h???c vi??n</span><input class="muachung" name="quantity_std" type="number"
                                id="quantity_std" required>
                            <span>Kho???ng gi??</span><input class="muachung" type="number" id="price_discount"
                                name="price_discount" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Ch???ng ch???:</div>
                        <div class="certification">
                            <input class="chungchi" name="certification" type="radio" value="1">C??
                            <input class="chungchi" name="certification" type="radio" value="2">Kh??ng
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Tr??nh ?????:</div>
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
                        <div>Th???i gian h???c:</div>
                        <div><input type="text" placeholder="VD: 6 th??ng" name="month_study" id="month_study" required>
                        </div>
                    </div>
                    <div><button type="submit" name="center" class="create_btn">Th??m m???i</button></div>
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
                        <div>Gi???ng vi??n:</div>
                        <div>
                            <select name="user_id" id="user_id" class="v_select2">
                                <?php $qr_cate6 = new db_query("SELECT user_id, user_name,user_phone FROM users where user_type = 2"); ?>
                                <option value="0">Ch???n Gi???ng vi??n</option>
                                <?php while($row_cate = mysql_fetch_array($qr_cate6->result)){ ?>
                                <option value="<?php echo $row_cate['user_id']; ?>">
                                    <?php echo $row_cate['user_phone'].' - '.$row_cate['user_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>T??n kh??a h???c:</div>
                        <div><input type="text" id="course_name" name="course_name" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>M??n h???c:</div>
                        <div>
                            <select name="cate_id" id="cate_id3" class="v_select2 cate_id">
                                <?php $qr_cate = new db_query("SELECT cate_id, cate_name FROM categories"); ?>
                                <option value="0">Ch???n m??n h???c</option>
                                <?php while($row_cate = mysql_fetch_array($qr_cate->result)){ ?>
                                <option value="<?php echo $row_cate['cate_id']; ?>">
                                    <?php echo $row_cate['cate_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>M??n h???c chi ti???t:</div>
                        <div>
                            <select name="tag_id" id="tag_id3" class="v_select2 tag_id">
                            </select>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>M?? t??? kh??a h???c:</div>
                        <div><input name="course_describe" id="course_describe" ></div>
                    </div>
                    <div class="v_detail_student">
                        <div>L???i ??ch kh??a h???c:</div>
                        <div><textarea name="course_benefit" id="course_benefit" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Ph?? h???p v???i ai:</div>
                        <div><textarea name="course_match" id="course_match" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Y??u c???u kh??a h???c:</div>
                        <div><textarea name="course_request" id="course_request" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>M?? t??? t???ng qu??t:</div>
                        <div><textarea name="general_describe" id="general_describe" cols="30" rows="10"></textarea></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Th???i gian h???c:</div>
                        <div><input type="number" id="time_learn" name="time_learn" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>T??i li???u h???c:</div>
                        <div><input type="number" id="course_slide" name="course_slide" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Gi?? g???c:</div>
                        <div><input type="number" id="price_listed" name="price_listed" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Gi?? khuy???n m???i:</div>
                        <div><input type="number" id="price_promotional" name="price_promotional" required></div>
                    </div>
                    <div class="v_detail_student">
                        <div>Mua chung:</div>
                        <div>
                            <span>S??? l?????ng h???c vi??n</span><input class="muachung" name="quantity_std" type="number"
                                id="quantity_std" required>
                            <span>Kho???ng gi??</span><input class="muachung" type="number" id="price_discount"
                                name="price_discount" required>
                        </div>
                    </div>
                    <div class="v_detail_student">
                        <div>Tr??nh ?????:</div>
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
                        <div>Th???i gian h???c:</div>
                        <div><input type="text" placeholder="VD: 6 th??ng" name="month_study" id="month_study" required>
                        </div>
                    </div>
                    <div><button type="submit" name="teacher" class="create_btn">Th??m m???i</button></div>
                </form>
        `;
        $("#v_info_ad").html(html);
        $("#teacher").addClass("showform");
        $("#center").removeClass("showform");
    });
});
</script>

</html>