<?php
require_once '../code_xu_ly/h_manager_GV.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,noindex,nofollow" />
    <link rel="stylesheet" href="../css/select2.min.css?v=<?=$version?>" />
    <?php require_once '../includes/v_inc_GV_css.php'; ?>
    <link rel="stylesheet" href="../css/GV-cap-nhat-thong-tin.css?v=<?=$version?>">
    <style>
        #v_thong-tin-tk {
            color: #1B6AAB;
        }

        #v_sidebar-tb-5 {
            display: block;
        }
        #v_thongtingv3 button{
            color: #1B6AAB;
        }
        #v_sidebar_tb-6{
            display: block;
        }
        #v_sidebar_tb-6 a{
             color: #1B6AAB;
        }
        .v_form label {
            width: 100%;
        }

        .sperrol {
            color: red;
            float: right;
        }

        #v_cap-nhat-tt {
            color: #1B6AAB;
        }
    </style>
    <title>Cập nhật thông tin</title>
</head>

<body>
    <div id="v_wrapper" class="flex">
        <!-- Begin: sidebar -->
        <?php require_once '../includes/inc_GV_sidebar.php'; ?>
        <!-- End: sidebar -->

        <!-- Begin: main -->
        <div id="main">
            <!-- Begin: header -->
            <?php require_once '../includes/inc_GV_manager_header.php'; ?>
            <!-- End: header -->

            <!-- Begin: content -->
            <div id="v_content-box">
                <div id="v_content">
                    <form method="POST" name="v_gv_name" onsubmit="return validation2(<?php echo $row['user_id']; ?>)" enctype="multipart/form-data">
                        <div id="v_content-title">
                            <div id="v_content-title-img">
                                <img width="140px" height="140px" style="border-radius:100px" class="lazyload"
                                src="/img/load.gif" data-src="../img/avatar/<?=$row['user_avatar']?>" id="avatar"
                                alt="Ảnh lỗi" onerror='this.onerror=null;this.src="../img/avatar/error.png";'>
                                <img width="40px" height="40px" class="camera-img lazyload" src="/img/load.gif"
                                data-src="../img/image/uploadimg.svg">
                                <input name="user_avatar" id="img" type="file" class="hidden" onchange="changeImg(this)"
                                accept=".png, .jpg, .jpeg">
                            </div>
                            <div id="v_content-title-detail">
                                <h1 id="v_content-title-name"><?=$row['user_name']?></h1>
                                <div id="v_content-title-info">
                                    <p>Mã giảng viên : <span><?=$cookie_id?></span></p>
                                    <p>Ngày tham gia : <span><?=date("d-m-Y", $row['updated_at']) ?></span></p>
                                </div>
                                <div id="v_content-btn-div">
                                    <a id="v_content-btn"
                                    href="/giang-vien-doi-mat-khau/id<?=$row['user_id']?>.html">ĐỔI MẬT KHẨU</a>
                                    <!--<div id="v_content-btn-detail">
                                        <span id="v_create_pass-title">Thay đổi mật khẩu</span>
                                        <a class="v_create_pass-img" onclick="v_dong_edit_pass()"><img
                                                src="../../img/dong-thay-doi-mk.svg" alt="Ảnh lỗi"></a>
                                        <hr width="100%" style="margin: 0; margin-bottom: 41px;">
                                         <form method="POST">
                                        <div class="v_form-input-6">
                                            <label>Mật khẩu hiện tại</label>
                                            <div class="v_form-ip">
                                                <input id="v_xem-pass-1" class="v_create-pass-input" type="password">
                                                <img class="v_create-pass-btn" onclick="v_xem_pass(1)"
                                                    src="../../img/xem-pass.svg" alt="Ảnh lỗi">
                                            </div>
                                        </div>
                                        <div class="v_form-input-6">
                                            <label>Mật khẩu mới</label>
                                            <div class="v_form-ip">
                                                <input id="v_xem-pass-2" class="v_create-pass-input" type="password">
                                                <img class="v_create-pass-btn" onclick="v_xem_pass(2)"
                                                    src="../../img/xem-pass.svg" alt="Ảnh lỗi">
                                            </div>
                                        </div>
                                        <div class="v_form-input-6">
                                            <label>Nhập lại mật khẩu mới</label>
                                            <div class="v_form-ip">
                                                <input id="v_xem-pass-3" class="v_create-pass-input" type="password">
                                                <img class="v_create-pass-btn" onclick="v_xem_pass(3)"
                                                    src="../../img/xem-pass.svg" alt="Ảnh lỗi">
                                            </div>
                                        </div>
                                        <hr width="100%" style="margin: 0; margin-top: 41px; margin-bottom: 24px;">
                                        <div id="v_input-6-btn">
                                            <button id="v_doi-mk">ĐỔI MẬT KHẨU</button>
                                            <button id="v_huy-bo">HỦY BỎ</button>
                                        </div>
                                    </form> 
                                </div>-->
                            </div>

                        </div>
                    </div>
                    <div class="v_form">
                        <div class="v_form-input-1">
                            <label>Họ tên <span id="error1" class="sperrol"></span></label>
                            <div><input type="text" name="usename" id="usename" value="<?=$row['user_name']?>">
                            </div>
                        </div>
                        <div class="v_form-input-1">
                            <label>Số điện thoại <span id="error3" class="sperrol"></span></label>
                            <div><input type="text" onkeypress="isnumber(event)" name="usephone" id="usephone" value="<?=$row['user_phone']?>">
                            </div>
                        </div>
                        <div class="v_form-input-1">
                            <label>Email đăng kí </label>
                            <div><input readonly type="email" value="<?=$row['user_mail']?>"></div>
                        </div>
                        <div class="v_form-input-1">
                            <label>Email liên hệ</label>
                            <div><input readonly type="email" value="<?=$row['user_mail']?>"></div>
                        </div>
                        <div class="v_form-input-1">
                            <label>Ngày sinh </label>
                            <div><input type="date" id="birth" name="birth" value="<?=$row['user_birth']?>"></div>
                        </div>
                        <div class="v_form-input-2">
                            <label>Giới tính</label>
                            <div>
                                <input type="radio" name="gender" value="1" id="gender"
                                <?php if($row['user_gender'] == 1) echo 'checked' ?>><span
                                class="v_gender-text">Nam</span>
                                <input type="radio" name="gender" value="2"
                                <?php if($row['user_gender'] == 2) echo 'checked' ?>><span
                                class="v_gender-text">Nữ</span>
                            </div>
                        </div>
                        <div class="v_form-input-3">
                            <div class="v_form-input-tp-1">
                                <label>Tỉnh, thành phố <span id="error7" class="sperrol"></span></label>
                                <div>
                                    <select id="cit_id" name="cit_id">
                                        <?
                                        $db_cit = new db_query("SELECT `cit_id`,`cit_name` FROM `city` WHERE `cit_parent` = 0");
                                        while ($rowCit = mysql_fetch_array($db_cit->result)) {
                                            ?>
                                            <option <?php if($rowCit['cit_id'] == $row['cit_id']) echo 'selected' ?>
                                            class="chontinhthanh" value="<?=$rowCit['cit_id']?>">
                                            <?=$rowCit['cit_name']?>
                                        </option>
                                        <?
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="v_form-input-tp-2">
                            <label>Quận, huyện <span id="error8" class="sperrol"></span></label>
                            <div>
                                <select name="district_id" id="district_id">
                                    <?
                                    $db_dis = new db_query("SELECT `cit_id`,`cit_name` FROM `city`");
                                    while ($rowdis = mysql_fetch_array($db_dis->result)) {
                                        ?>
                                        <option
                                        <?php if($rowdis['cit_id'] == $row['district_id']) echo 'selected' ?>
                                        class="chonquanhuyen" value="<?=$rowdis['cit_id']?>">
                                        <?=$rowdis['cit_name']?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="v_form-input-add">
                    <label>Địa chỉ <span id="error9" class="sperrol"></span></label>
                    <div><input type="text" name="address" id="address" value="<?=$row['user_address']?>">
                    </div>
                </div>
                <div class="v_form-input-4">
                    <label>Kinh nghiệm giảng dạy <span id="error13" class="sperrol"></span></label>
                    <div><textarea name="exp_teach" id="exp_teach"><?=$row['exp_teach']?></textarea></div>
                </div>
                <div class="v_form-input-4">
                    <label>Kinh nghiệm làm việc <span id="error12" class="sperrol"></span></label>
                    <div><textarea name="exp_work" id="exp_work"><?=$row['exp_work']?></textarea></div>
                </div>
                <div class="v_form-input-4">
                    <label>Bằng cấp - Chứng chỉ <span id="error14" class="sperrol"></span></label>
                    <div><textarea name="qualification" id="qualification"><?=$row['exp_teach']?></textarea>
                    </div>
                </div>
                <div class="v_form-input-1">
                    <label>Chức vụ hiện tại <span id="error10" class="sperrol"></span></label>
                    <div><input type="text" name="current_position" id="current_position"
                        value="<?=$row['current_position']?>"></div>
                    </div>
                    <div class="v_form-input-1">
                        <label>Công ty hiện tại <span id="error11" class="sperrol"></span></label>
                        <div><input type="text" name="current_company" id="current_company"
                            value="<?=$row['current_company']?>"></div>
                        </div>
                        <div class="v_form-input-5">
                            <label>Link cộng đồng học viên ( Nếu có ) </label>
                            <div><input type="text" id="link_student_community"
                                value="<?=$row['link_student_community']?>"
                                placeholder="Link Facebook cá nhân/ Facebook fanpage/ Youtube/ Website cá nhân...">
                            </div>
                        </div>
                        <div class="v_form-input-5">
                            <label>Link bài giảng online ( Nếu có ) </label>
                            <div><input type="text" id="link_lecture_online"
                                value="<?=$row['link_lecture_online']?>"
                                placeholder="Link Video demo trên Google Driver, Link Youtube, Link trên Website...">
                            </div>
                        </div>
                        <div class="v_form-input-5">
                            <label>Chủ đề giảng dạy </label>
                            <div id="v_chu-de">
                                    <!-- <div id="v_chu-de-div">
                                        <img src="../../img/them-chu-de.svg" alt="Ảnh lỗi">
                                        <span id="v_chu-de-span">Thêm chủ đề</span>
                                    </div> -->
                                    <select name="cate_id[]" id="cate_id" multiple>

                                        <? 
                                        $cate_id = explode(",",$row['cate_id']);
                                        $db_cate = new db_query("SELECT * from categories");
                                        while ($rowCat = mysql_fetch_array($db_cate->result)) {
                                            ?>
                                            <option
                                            <?php if(isset($cate_id[0])&&$cate_id[0] == $rowCat['cate_id'] || isset($cate_id[1])&&$cate_id[1] == $rowCat['cate_id'] || isset($cate_id[2])&&$cate_id[2] == $rowCat['cate_id'] || isset($cate_id[3])&&$cate_id[3] == $rowCat['cate_id'] || isset($cate_id[4])&&$cate_id[4] == $rowCat['cate_id'])echo 'selected' ?>
                                            value="<?= $rowCat['cate_id'] ?>"> <?= $rowCat['cate_name'] ?></option>
                                            <?
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <center class="v_form-btn"><button name="btn">CẬP NHẬP</button></center>
                    </form>
                </div>
            </div>
            <!-- End: content -->

        </div>
        <!-- End: main -->
    </div>
</div>

<!-- Begin: foooter -->
<?php require_once '../includes/h_inc_footer.php'; ?>
<!-- End: footer -->
<script src="../js/select2.min.js?v=<?=$version?>"></script>
<script src="../js/h_GV_sigup_update.js?v=<?=$version?>"></script>
<script src="../js/v-main.js?v=<?=$version?>"></script>
<script type="text/javascript">
    function isnumber(evt) {
        var num = String.fromCharCode(evt.which);
        if (!(/[0-9]/.test(num))) {
            evt.preventDefault();
        }
    }
</script>
</body>

</html>