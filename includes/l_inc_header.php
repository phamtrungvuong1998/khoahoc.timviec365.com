<?

$qr = new db_query("SELECT * FROM `users` WHERE `user_id` = '$user_id'");

$row = mysql_fetch_array($qr->result);

if ($row['user_avatar'] == 0) {
    $l_link_avatar = "../img/v_avatar_default.png";
} else {
    $l_link_avatar = "../img/avatar/" . $row['user_avatar'];
}
?>
<div class=" l_header">
    <div class="l_header_1">
        <div class="l_menu_item"><a class="l_menu_item_a" href="/">Trang Chủ</a></div>
        <div class="l_menu_item"><a class="l_menu_item_a" href="/khoa-hoc-online.html">Khóa Online</a></div>
        <div class="l_menu_item"><a class="l_menu_item_a" href="/khoa-hoc-offline.html">Khóa Offline</a></div>
        <div class="l_menu_item"><a class="l_menu_item_a" href="/danh-sach-hoc-vien.html">Học viên</a></div>
        <div class="l_menu_item " id="menu-list-last"><a class="l_menu_item_a" href="#">Blog</a></div>
        <div id="l_show_menu" >
        <div class="l_header_avatar"><img  onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../<? echo $l_link_avatar ?>" alt="avatar"></div>
        <div class="l_menu_item1">
            <img  onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="lazyload" src="/img/load.gif" data-src="../img/ion_caret-down.svg" alt="icon">
        </div>
        </div>
        <div id="l_menu" class="l_modal_menu">
            <form action="l_menu" class="l_menu-content">
                <div class="l_form_menu_title">
                    <img  onerror='this.onerror=null;this.src="../img/avatar/error.png";' src="/img/load.gif" data-src="../<? echo $l_link_avatar ?>" alt="icon" class="l_menu_img lazyload">
                </div>
                <div class="l_form_menu_name">
                    <? echo $row['user_name']; ?>
                </div>
                <div class="l_form_menu_many">
                    <div class="l_menu_many_text">
                        Số dư:
                    </div>
                    <div class="l_menu_many">
                        <? echo ' ' . format_number($row['user_money']) . ' đ'; ?>
                    </div>
                </div>
                <div class="l_form_menu_item">
                    <a href="/quan-li-chung-trung-tam/id<? echo $_COOKIE['user_id'] ?>.html">
                        <div class="l_menu_icon">
                            <img class="lazyload" src="/img/load.gif" data-src="../img/image/quanlychung1.svg" alt="">
                        </div>
                        <div class="l_menu_text">
                            Quản lý chung
                        </div>
                    </a>
                </div>

                <div class="l_form_menu_item">
                    <a href="/dang-xuat.html">
                        <div class="l_menu_icon">
                            <img class="lazyload" src="/img/load.gif" data-src="../img/image/dangxuat.svg" alt="">
                        </div>
                        <div class="l_menu_text">
                            Đăng xuất
                        </div>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <div class="l_none_sidebar">
        <div class="l_header_2">
            <div class="l_menu_sidebar" id="l_menu_sidebar">
                <img  onerror='this.onerror=null;this.src="../img/avatar/error.png";' src="/img/load.gif" data-src="../img/image/menu.svg" alt="" class="l_dinhdang lazyload">
            </div>
            <div class="l_header_logo">
                <img class="lazyload" src="/img/load.gif" data-src="../img/image/logo_table.png" alt="">
            </div>
        </div>
        <div id="idsidebar" class="l_sidebar_menu">
            <div class="l_sidebar_menu_item">
                <div class="l_logo">
                    <a href="/">
                        <img class="lazyload" src="/img/load.gif" data-src="../img/logoo2.svg" alt="logo">
                    </a>
                </div>
                <div class="l_menu-item">
                    <a href="/">
                        <div class="l_item_text">Trang chủ</div>
                    </a>
                    <a href="/khoa-hoc-online.html">
                        <div class="l_item_text">Khóa online</div>
                    </a>
                    <a href="/khoa-hoc-offline.html">
                        <div class="l_item_text">Khóa offline</div>
                    </a>
                    <a href="/danh-sach-hoc-vien.html">
                        <div class="l_item_text">Học viên</div>
                    </a>
                    <a href="">
                        <div class="l_item_text">Blog</div>
                    </a>
                </div>
                <div class="l_sidebar_item1">
                    <div class="l_avatar">
                        <img  onerror='this.onerror=null;this.src="../img/avatar/error.png";' class="l_image_avatar lazyload" src="/img/load.gif" data-src="<? echo $l_link_avatar ?>" alt="avatar">
                    </div>
                    <div class="l_tentrungtam">
                        <?php echo $row['user_name']; ?>
                    </div>
                    <div class="l_tentrungtam">
                        Số dư: <?php echo number_format($row['user_money']) . " đ"; ?>
                    </div>
                    <div class="l_taokhoahoc">
                        <a href="/tao-khoa-hoc-online-trung-tam/id<? echo $row['user_id'] ?>.html">
                            <button class="l_button">
                                <img class="lazyload" src="/img/load.gif" data-src="../img/tao-khoa-hoc.svg" alt="icon">
                                <p class="l_text_button">TẠO KHÓA HỌC ONLINE</p>
                            </button>
                        </a>
                    </div>
                    <div class="l_taokhoahoc">
                        <a href="/tao-khoa-hoc-offline-trung-tam/id<? echo $row['user_id'] ?>.html">
                            <button class="l_button">
                                <img class="lazyload" src="/img/load.gif" data-src="../img/tao-khoa-hoc.svg" alt="icon">
                                <p class="l_text_button">TẠO KHÓA HỌC OFFLINE</p>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="l_sidebar_item2">
                    <div class="l_drop">
                        <div class="dropdown">
                            <a href="/quan-li-chung-trung-tam/id<? echo $row['user_id']; ?>.html">
                                <button class="l_btn">
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
                            <button class="l_btn" onclick="myDropdown(1)">
                                <div class="l_icon">
                                    <img class="lazyload" src="/img/load.gif" data-src="../img/quan-li-hoc-vien.svg" alt="icon">
                                </div>
                                <div class="l_text l_quanlyhocvien">
                                    Quản lý học viên
                                </div>
                            </button>
                            <div id="myDropdown-1" class="dropdown-content l_ql_hocvien">
                                <a class="dropdown-content_a" href="/trung-tam-hoc-vien-da-luu/id<? echo $row['user_id']; ?>&page1.html">
                                    <div class="l_text1 l_hvdaluu">
                                        Danh sách học viên đã lưu
                                    </div>
                                </a>
                                <a class="dropdown-content_a" href="/trung-tam-hoc-vien-mua-tu-diem/id<? echo $row['user_id']; ?>&page1.html">
                                    <div class="l_text1 l_muatudien">
                                        Danh sách học viên mua từ điểm
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="l_drop">
                        <div class="dropdown">
                            <button class="l_btn" id="myBtn1" onclick="myDropdown(2)">
                                <div class="l_icon">
                                    <img class="lazyload" src="/img/load.gif" data-src="../img/play-btn.svg" alt="icon">
                                </div>
                                <div class="l_text l_khoahocgiangday">
                                    Khóa học giảng dạy
                                </div>
                            </button>
                            <div id="myDropdown-2" class="dropdown-content l_giangday">
                                <a class="dropdown-content_a" href="/trung-tam-khoa-hoc-online-giang-day/id<? echo $row['user_id']; ?>&page1.html">
                                    <div class="l_text1 l_onGD">
                                        Khóa online giảng dạy
                                    </div>
                                </a>
                                <a class="dropdown-content_a" href="/trung-tam-khoa-hoc-offline-giang-day/id<? echo $row['user_id']; ?>&page1.html">
                                    <div class="l_text1 l_offGD">
                                        Khóa offline giảng dạy
                                    </div>
                                </a>
                                <a class="dropdown-content_a" href="/trung-tam-khoa-hoc-online-da-ban/id<? echo $row['user_id']; ?>&page1.html">
                                    <div class="l_text1 l_onDB">
                                        Khóa online đã bán
                                    </div>
                                </a>
                                <a class="dropdown-content_a" href="/trung-tam-khoa-hoc-offline-da-dat-cho/id<? echo $row['user_id']; ?>&page1.html">
                                    <div class="l_text1 l_offDB">
                                        Khóa offline đã đặt chỗ
                                    </div>
                                </a>
                                <a class="dropdown-content_a" href="/trung-tam-danh-sach-danh-gia/id<? echo $row['user_id']; ?>&page1.html">
                                    <div class="l_text1 l_danhsachdanhgia">
                                        Danh sách đánh giá
                                    </div>
                                </a>
                                <a class="dropdown-content_a" href="/trung-tam-khoa-hoc-mua-chung/id<? echo $row['user_id']; ?>&page1.html">
                                    <div class="l_text1 l_muachung">
                                        Khóa học mua chung chờ
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="l_drop">
                        <div class="dropdown">
                            <a href="/trung-tam-danh-sach-giang-vien/id<? echo $row['user_id']; ?>&page1.html">
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
                            <button class="l_btn" id="myBtn2" onclick="myDropdown(3)">
                                <div class="l_icon">
                                    <img class="lazyload" src="/img/load.gif" data-src="../img/vi-khoa-hoc.svg" alt="icon">
                                </div>
                                <div class="l_text l_vikhoahoc365">
                                    Ví khóa học 365
                                </div>
                            </button>
                            <div id="myDropdown-3" class="dropdown-content l_vikhoahoc">
                                <a class="dropdown-content_a" href="/trung-tam-lich-su-giao-dich/id<? echo $row['user_id']; ?>&page1.html">
                                    <div class="l_text1 l_lichsugiaodich" id="tt_naptien_tb">
                                        Nạp tiền
                                    </div>
                                </a>
                                <a class="dropdown-content_a" href="/trung-tam-lich-su-rut-tien/id<? echo $row['user_id']; ?>&page1.html">
                                    <div class="l_text1 l_lichsugiaodich">
                                        Lịch sử rút tiền
                                    </div>
                                </a>
                                <a class="dropdown-content_a" href="/lich-su-nap-tien/id<? echo $row['user_id']; ?>.html">
                                    <div class="l_text1 l_lichsugiaodich">
                                        Lịch sử nạp tiền
                                    </div>
                                </a>
                                <a class="dropdown-content_a" href="/trung-tam-rut-tien/id<? echo $row['user_id']; ?>.html">
                                    <div class="l_text1 l_ruttien">
                                        Rút tiền
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="l_drop">
                        <div class="dropdown">
                            <button class="l_btn" id="myBtn3" onclick="myDropdown(4)">
                                <div class="l_icon">
                                    <img class="lazyload" src="/img/load.gif" data-src="../img/ma-giam-gia.svg" alt="icon">
                                </div>
                                <div class="l_text l_magiangia">
                                    Mã giảm giá
                                </div>
                            </button>
                            <div id="myDropdown-4" class="dropdown-content l_dropmagiamgia">
                                <a class="dropdown-content_a" href="/trung-tam-tao-ma-giam-gia/id<? echo $row['user_id']; ?>.html">
                                    <div class="l_text1 l_taomagiamgia">
                                        Tạo mã giảm giá
                                    </div>
                                </a>
                                <a class="dropdown-content_a" href="/trung-tam-quan-li-ma-giam-gia/id<? echo $row['user_id']; ?>&page1.html">
                                    <div class="l_text1 l_qlmagiamgia">
                                        Quản lý mã giảm giá
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="l_drop">
                        <div class="dropdown">
                            <button class="l_btn" id="myBtn4" onclick="myDropdown(5)">
                                <div class="l_icon">
                                    <img class="lazyload" src="/img/load.gif" data-src="../img/user.svg" alt="icon">
                                </div>
                                <div class="l_text l_thongtintaikhoan">
                                    Thông tin tài khoản
                                </div>
                            </button>
                            <div id="myDropdown-5" class="dropdown-content l_droptaikhoan">
                                <a class="dropdown-content_a" href="/trung-tam-cap-nhat-thong-tin/id<? echo $row['user_id']; ?>.html">
                                    <div class="l_text1 l_capnhat">
                                        Cập nhật thông tin
                                    </div>
                                </a>

                                <div class="l_text1 l_text_pass" onclick="document.getElementById('l_id_updatePass').style.display='block'">
                                    Đổi mật khẩu
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="l_drop l_padding">
                        <div class="dropdown">
                            <a href="/dang-xuat.html">
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
        </div>
    </div>

</div>