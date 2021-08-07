<div class="l_sidebar">
    <div class="l_logo">
        <a href="/">
            <img class="lazyload" src="/img/load.gif" data-src="../img/logoo2.svg" alt="logo">
        </a>
    </div>
    <div class="l_sidebar_item1">
        <div class="l_avatar">
            <img  class="lazyload l_image_avatar" src="/img/load.gif" data-src="<? echo $l_link_avatar; ?>" alt="avatar">
        </div>
        <div class="l_tentrungtam">
            <? echo $row ['user_name']; ?>
        </div>

        <?
            if(isset($_COOKIE['timeout'])){
            ?>
        <div class="l_taokhoahoc">
            <a onclick="alert('Bạn vừa đăng tin. Hãy đợi sau 20 phút')">
                <button class="l_button">
                    <img class="lazyload" src="/img/load.gif" data-src="../img/tao-khoa-hoc.svg" alt="icon">
                    <p class="l_text_button">TẠO KHÓA HỌC ONLINE</p>
                </button>
            </a>
        </div>
        <div class="l_taokhoahoc">
            <a onclick="alert('Bạn vừa đăng tin. Hãy đợi sau 20 phút')">
                <button class="l_button">
                    <img class="lazyload" src="/img/load.gif" data-src="../img/tao-khoa-hoc.svg" alt="icon">
                    <p class="l_text_button">TẠO KHÓA HỌC OFFLINE</p>
                </button>
            </a>
        </div>
        <?
            }elseif($row['24_course'] == 24){
            ?>
        <div class="l_taokhoahoc">
            <a onclick="alert('Bạn hết hạn đăng tin hôm nay')">
                <button class="l_button">
                    <img class="lazyload" src="/img/load.gif" data-src="../img/tao-khoa-hoc.svg" alt="icon">
                    <p class="l_text_button">TẠO KHÓA HỌC ONLINE</p>
                </button>
            </a>
        </div>
        <div class="l_taokhoahoc">
            <a onclick="alert('Bạn hết hạn đăng tin hôm nay')">
                <button class="l_button">
                    <img class="lazyload" src="/img/load.gif" data-src="../img/tao-khoa-hoc.svg" alt="icon">
                    <p class="l_text_button">TẠO KHÓA HỌC OFFLINE</p>
                </button>
            </a>
        </div>
        <?
            }else{
            ?>
        <div class="l_taokhoahoc">
            <a href="/tao-khoa-hoc-online-trung-tam/id<? echo $user_id; ?>.html">
                <button class="l_button">
                    <img class="lazyload" src="/img/load.gif" data-src="../img/tao-khoa-hoc.svg" alt="icon">
                    <p class="l_text_button">TẠO KHÓA HỌC ONLINE</p>
                </button>
            </a>
        </div>
        <div class="l_taokhoahoc">
            <a href="/tao-khoa-hoc-offline-trung-tam/id<? echo $user_id; ?>.html">
                <button class="l_button">
                    <img class="lazyload" src="/img/load.gif" data-src="../img/tao-khoa-hoc.svg" alt="icon">
                    <p class="l_text_button">TẠO KHÓA HỌC OFFLINE</p>
                </button>
            </a>
        </div>
        <?
            }
            ?>
    </div>
    <div class="l_sidebar_item2">
        <div class="l_drop">
            <div class="dropdown">
                <a href="/quan-li-chung-trung-tam/id<? echo $user_id; ?>.html">
                    <button class="l_btn l_drop_down">
                        <div class="l_icon">
                            <img class="lazyload" src="/img/load.gif" data-src="../img/setting.svg" alt="icon">
                        </div>
                        <div class="l_text l_trangchu">
                            Quản lý chung
                        </div>
                    </button>
                </a>
            </div>
        </div>
        <div class="l_drop">
            <div class="dropdown">
                <button href="" class="l_btn l_drop_down" id="myBtn">
                    <div class="l_icon">
                        <img class="lazyload" src="/img/load.gif" data-src="../img/quan-li-hoc-vien.svg" alt="icon">
                    </div>
                    <div class="l_text l_quanlyhocvien">
                        Quản lý học viên
                    </div>
                </button>
                <div id="myDropdown" class="dropdown-content1 dropdown-content">
                    <a class="l_dropdown-content1_a"
                        href="/trung-tam-hoc-vien-da-luu/id<? echo $user_id; ?>&page1.html">
                        <div class="l_text1 l_hvdaluu">
                            Danh sách học viên đã lưu
                        </div>

                    </a>
                    <a class="l_dropdown-content1_a"
                        href="/trung-tam-hoc-vien-mua-tu-diem/id<? echo $user_id; ?>&page1.html">
                        <div class="l_text1 l_muatudien">
                            Danh sách học viên mua từ điểm
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="l_drop">
            <div class="dropdown">
                <button class="l_btn l_drop_down" id="myBtn1">
                    <div class="l_icon">
                        <img class="lazyload" src="/img/load.gif" data-src="../img/play-btn.svg" alt="icon">
                    </div>
                    <div class="l_text l_khoahocgiangday">
                        Khóa học giảng dạy
                    </div>
                </button>
                <div id="myDropdown1" class="dropdown-content l_giangday">
                    <a class="dropdown-content_a"
                        href="/trung-tam-khoa-hoc-online-giang-day/id<? echo $user_id; ?>&page1.html">
                        <div class="l_text1 l_onGD">
                            Khóa online giảng dạy
                        </div>
                    </a>
                    <a class="dropdown-content_a"
                        href="/trung-tam-khoa-hoc-offline-giang-day/id<? echo $user_id; ?>&page1.html">
                        <div class="l_text1 l_offGD">
                            Khóa offline giảng dạy
                        </div>
                    </a>
                    <a class="dropdown-content_a"
                        href="/trung-tam-khoa-hoc-online-da-ban/id<? echo $user_id; ?>&page1.html">
                        <div class="l_text1  l_onDB">
                            Khóa online đã bán
                        </div>
                    </a>
                    <a class="dropdown-content_a"
                        href="/trung-tam-khoa-hoc-offline-da-dat-cho/id<? echo $user_id; ?>&page1.html">
                        <div class="l_text1 l_offDB">
                            Khóa offline đã đặt chỗ
                        </div>
                    </a>
                    <a class="dropdown-content_a"
                        href="/trung-tam-danh-sach-danh-gia/id<? echo $user_id; ?>&page1.html">
                        <div class="l_text1 l_danhsachdanhgia">
                            Danh sách đánh giá
                        </div>
                    </a>
                    <a class="dropdown-content_a"
                        href="/trung-tam-khoa-hoc-mua-chung/id<? echo $user_id; ?>&page1.html">
                        <div class="l_text1 l_muachung">
                            Khóa học mua chung chờ
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="l_drop">
            <div class="dropdown">
                <a href="/trung-tam-danh-sach-giang-vien/id<? echo $user_id; ?>&page1.html">
                    <button class="l_btn">
                        <div class="l_icon">
                            <img class="lazyload" src="/img/load.gif" data-src="../img/GV-ds-giang-vien.svg" alt="icon">
                        </div>
                        <div class="l_text l_giangvien">
                            Danh sách giảng viên
                        </div>
                    </button>
                </a>
            </div>
        </div>
        <div class="l_drop">
            <div class="dropdown">
                <button class="l_btn l_drop_down" id="myBtn2">
                    <div class="l_icon">
                        <img class="lazyload" src="/img/load.gif" data-src="../img/vi-khoa-hoc.svg" alt="icon">
                    </div>
                    <div class="l_text l_vikhoahoc365">
                        Ví khóa học 365
                    </div>
                </button>
                <div id="myDropdown2" class="dropdown-content l_vikhoahoc">
                    <a class="dropdown-content_a" href="/nap-tien/id<? echo $user_id; ?>.html">
                        <div id="tt_nap_tien" class="l_text1 l_lichsugiaodich">
                            Nạp tiền
                        </div>
                    </a>
                    <a class="dropdown-content_a" href="/lich-su-nap-tien/id<?php echo $user_id; ?>.html">
                        <div class="l_text1 l_lichsugiaodich">
                            Lịch sử rút tiền
                        </div>
                    </a>
                    <a class="dropdown-content_a" href="/trung-tam-lich-su-rut-tien/id<? echo $user_id; ?>&page1.html">
                        <div class="l_text1 l_lichsugiaodich">
                            Lịch sử nạp tiền
                        </div>
                    </a>
                    <a class="dropdown-content_a" href="/trung-tam-rut-tien/id<? echo $user_id; ?>.html">
                        <div class="l_text1 l_ruttien">
                            Rút tiền
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="l_drop">
            <div class="dropdown">
                <button class="l_btn l_drop_down" id="myBtn3">
                    <div class="l_icon">
                        <img class="lazyload" src="/img/load.gif" data-src="../img/ma-giam-gia.svg" alt="icon">
                    </div>
                    <div class="l_text l_magiangia">
                        Mã giảm giá
                    </div>
                </button>
                <div id="myDropdown3" class="dropdown-content l_dropmagiamgia">
                    <a class="dropdown-content_a" href="/trung-tam-tao-ma-giam-gia/id<? echo $user_id; ?>.html">
                        <div class="l_text1 l_taomagiamgia">
                            Tạo mã giảm giá
                        </div>
                    </a>
                    <a class="dropdown-content_a"
                        href="/trung-tam-quan-li-ma-giam-gia/id<? echo $user_id; ?>&page1.html">
                        <div class="l_text1 l_qlmagiamgia">
                            Quản lý mã giảm giá
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="l_drop">
            <div class="dropdown">
                <button class="l_btn l_drop_down" id="myBtn4">
                    <div class="l_icon">
                        <img class="lazyload" src="/img/load.gif" data-src="../img/user.svg" alt="icon">
                    </div>
                    <div class="l_text l_thongtintaikhoan">
                        Thông tin tài khoản
                    </div>
                </button>
                <div id="myDropdown4" class="dropdown-content l_droptaikhoan">
                    <a class="dropdown-content_a" href="/trung-tam-cap-nhat-thong-tin/id<? echo $user_id; ?>.html">
                        <div class="l_text1 l_capnhat">
                            Cập nhật thông tin
                        </div>
                    </a>

                    <div class="dropdown-content_a" class="l_text1 l_text_pass l_pass"
                        onclick="document.getElementById('l_id_updatePass').style.display='block'">
                        Đổi mật khẩu
                    </div>

                </div>
            </div>
        </div>
        <div class="l_drop">
            <div class="dropdown">
                <a onclick="v_logout2()">
                    <button class="l_btn">
                        <div class="l_icon">
                            <img class="lazyload" src="/img/load.gif" data-src="../img/logout.svg" alt="icon">
                        </div>
                        <div class="l_text">
                            Đăng xuất
                        </div>
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>

<?
include "../includes/l_popup_retypass.php";
?>

<script type="text/javascript">
    function v_logout2() {
        var n = confirm("Bạn có muốn đăng xuất không ?");
        if (n == true) {
            window.location.href = "../code_xu_ly/v_logout.php";
        }
    }
</script>