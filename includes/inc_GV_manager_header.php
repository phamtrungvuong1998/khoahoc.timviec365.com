<div id="v_header-main">
    <div id="v_header-1">
        <div class="menu-list"><a href="/">Trang Chủ</a></div>
        <div class="menu-list"><a href="/khoa-hoc-online.html">Khóa Online</a></div>
        <div class="menu-list"><a href="/khoa-hoc-offline.html">Khóa Offline</a></div>
        <div class="menu-list"><a href="/danh-sach-hoc-vien.html">Học viên</a></div>
        <div class="menu-list" id="menu-list-last"><a href="https://timviec365.com/blog" target="_blank">Blog</a></div>
        <div id="v_header-avatar">
            <button class="v_header_avatar"><img style="border-radius: 100px;" id="v_header_avatar2" width="40px" height="40px" class="lazyload" src="/img/load.gif" data-src="../img/avatar/<?=$row['user_avatar']?>" alt="Ảnh lỗi" onerror='this.onerror=null;this.src="../img/avatar/error.png";'></button>
            <div id="v_header-dropdown">
                <center><img class="v_header-avatar-img lazyload" id="v_header-avatar-img2" width="100px" height="100px" src="/img/load.gif"
                        data-src="../img/avatar/<?=$row['user_avatar']?>" alt="Ảnh lỗi"
                        onerror='this.onerror=null;this.src="../img/avatar/error.png";'></center>
                <div id="v_header-avatar-dropdown-name"><?=$row['user_name']?></div>
                <div id="v_header-avatar-dropdown-tk">Số dư : &nbsp;<span><?=number_format($row['user_money'])?>
                        đ</span></div>
                <div class="v_header-dropdown-menu">
                    <img class="lazyload" src="/img/load.gif" data-src="../../img/setting.svg" alt="Ảnh lỗi">
                    <button><a href="/quan-li-chung-giang-vien/id<?=$row['user_id']?>.html">Quản lý chung</a></button>
                </div>
                <hr class="v_header-dropdown-hr">
                <div class="v_header-dropdown-menu">
                    <img class="lazyload" src="/img/load.gif" data-src="../../img/play-btn.svg" alt="Ảnh lỗi">
                    <button><a href="/giang-vien-khoa-hoc-online/id<?=$cookie_id?>-p1.html">Khóa học của
                            tôi</a></button>
                </div>
                <hr class="v_header-dropdown-hr">
                <div class="v_header-dropdown-menu">
                    <img class="lazyload" src="/img/load.gif" data-src="../../img/vi-khoa-hoc.svg" alt="Ảnh lỗi">
                    <button><a href="/giang-vien-lich-su-giao-dich/id<?=$row['user_id']?>-p1.html">Ví Khóa Học
                            365</a></button>
                </div>
                <hr class="v_header-dropdown-hr">
                <div class="v_header-dropdown-menu">
                    <img class="lazyload" src="/img/load.gif" data-src="../../img/logout.svg" alt="Ảnh lỗi">
                    <button><a href="/dang-xuat.html">Đăng xuất</a></button>
                </div>
            </div>
        </div>
        <div style="padding-top: 24px;"><button onclick="v_header_avatar()" id="v_ion-caret"><img
                    src="../../img/ion_caret-down.svg" alt="ảnh lỗi"></button></div>
    </div>

    <div id="v_header-mb">
        <center>
            <div id="v_logo1"><a href="/"><img class="lazyload" src="/img/load.gif" data-src="../../img/logoo2.svg"
                        alt="ảnh lỗi"></a>
            </div>
        </center>
        <div id="v_menu" onclick="quanlihocvien()"><img class="lazyload" src="/img/load.gif"
                data-src="../../img/List.svg" alt="ảnh lỗi"></div>
        <div id="quanlihocvien">
            <div id="quanlihocvien_div">
                <center>
                    <div id="v_logo-chung">
                        <a href="/">
                            <img class="lazyload" src="/img/load.gif" data-src="../../img/logoo2.svg" alt="ảnh lỗi">
                        </a>
                    </div>
                </center>
                <div id="v_quanlihocvien-hr">
                    <hr>
                </div>
                <div id="v_quanlihocvien-menu">
                    <div><a href="/">Trang Chủ</a></div>
                    <div><a href="/khoa-hoc-online.html">Khóa Online</a></div>
                    <div><a href="/khoa-hoc-offline.html">Khóa Offline</a></div>
                    <div><a href="/danh-sach-hoc-vien.html">Học viên</a></div>
                    <div><a href="https://timviec365.com/blog" target="_blank">Blog</a></div>
                </div>
                <div>
                    <hr>
                </div>
                <div id="v_quanlihocvien-avatar">
                    <center><img id="v_quanlihocvien-avatar2" style="border-radius: 100px;" width="100px" height="100px" class="lazyload"
                            src="/img/load.gif" data-src="../img/avatar/<?=$row['user_avatar']?>" alt="Ảnh lỗi"
                            onerror='this.onerror=null;this.src="../img/avatar/error.png";'></center>
                </div>
                <div id="v_tenhocvien"><?=$row['user_name']?></div>
                <div class="v_sodu_hv">Số dư : <span><?php echo number_format($row['user_money'])?> đ</span></div>
                <?
            if($row['24_course'] == 24){
            ?>
                <center id="v_siderbar-btn">
                    <a onclick="alert('Bạn hết hạn đăng tin hôm nay')">
                        <img class="lazyload" src="/img/load.gif" data-src="../img/tao-khoa-hoc.svg" alt="Ảnh lỗi">
                        <span id="v_siderbar-btn-span">TẠO KHÓA HỌC ONLINE </span>
                    </a>
                </center>
                <center id="v_siderbar-btn">
                    <a onclick="alert('Bạn hết hạn đăng tin hôm nay')">
                        <img class="lazyload" src="/img/load.gif" data-src="../img/tao-khoa-hoc.svg" alt="Ảnh lỗi">
                        <span id="v_siderbar-btn-span">TẠO KHÓA HỌC OFFLINE </span>
                    </a>
                </center>
                <?
            }else{
            ?>
                <center id="v_siderbar-btn">
                    <a href="/tao-khoa-hoc-online-giang-vien/id<?=$row['user_id']?>.html">
                        <img class="lazyload" src="/img/load.gif" data-src="../img/tao-khoa-hoc.svg" alt="Ảnh lỗi">
                        <span id="v_siderbar-btn-span">TẠO KHÓA HỌC ONLINE </span>
                    </a>
                </center>
                <center id="v_siderbar-btn">
                    <a href="/tao-khoa-hoc-offline-giang-vien/id<?=$row['user_id']?>.html">
                        <img class="lazyload" src="/img/load.gif" data-src="../img/tao-khoa-hoc.svg" alt="Ảnh lỗi">
                        <span id="v_siderbar-btn-span">TẠO KHÓA HỌC OFFLINE </span>
                    </a>
                </center>
                <?
            }
            ?>
                <div id="v_quanlihocvien-detail">
                    <div class="v_sidebar-menu">
                        <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif"
                                data-src="../../img/setting.svg" alt="ảnh lỗi"></div>
                        <div class="v_sidebar-list"><a href="/quan-li-chung-giang-vien/id<?=$row['user_id']?>.html">Quản
                                lý
                                chung</a></div>
                        <div class="v_ion-caret" style="color: white;">p</div>
                    </div>

                    <div class="v_sidebar-menu" onclick="v_sidebar_tb1(1)">
                        <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif"
                                data-src="../../img/GV-quan-li-hv.svg" alt="ảnh lỗi"></div>
                        <div class="v_sidebar-list"><button>Quản lý học viên</button></div>
                        <div class="v_ion-caret"><img class="lazyload" src="/img/load.gif"
                                data-src="../../img/ion_caret-down.svg" alt="ảnh lỗi"></div>
                    </div>
                    <ul id="v_sidebar_tb-1" style="list-style-type: none;">
                        <li class="font-all-400"><a href="/danh-sach-hoc-vien-da-luu/id<?=$row['user_id']?>-p1.html">Danh
                                sách
                                học viên đã lưu</a></li>
                        <li class="font-all-400"><a
                                href="/danh-sach-hoc-vien-mua-tu-diem/id<?=$row['user_id']?>-p1.html">Danh
                                sách học viên mua từ điểm</a></li>
                    </ul>
                    <div class="v_sidebar-menu" onclick="v_sidebar_tb1(2)">
                        <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif"
                                data-src="../../img/play-btn.svg" alt="ảnh lỗi"></div>
                        <div class="v_sidebar-list"><button>Quản lý khóa học</button></div>
                        <div class="v_ion-caret"><img class="lazyload" src="/img/load.gif"
                                data-src="../../img/ion_caret-down.svg" alt="ảnh lỗi"></div>
                    </div>
                    <ul id="v_sidebar_tb-2" style="list-style-type: none;">
                        <li class="font-all-400"><a
                                href="/giang-vien-khoa-hoc-online/id<?=$row['user_id']?>-p1.html">Khóa học online</a>
                        </li>
                        <li class="font-all-400"><a
                                href="/giang-vien-khoa-hoc-offline/id<?=$row['user_id']?>-p1.html">Khóa học offline</a>
                        </li>
                        <li class="font-all-400"><a href="/giang-vien-khoa-hoc-online-da-ban/id<?=$row['user_id']?>-p1.html">Khóa học online đã
                                bán</a>
                        </li>
                        <li class="font-all-400"><a href="/giang-vien-khoa-hoc-offline-da-dat-cho/id<?=$row['user_id']?>-p1.html">Khóa học offline đã đặt chô</a>
                        </li>
                        <li class="font-all-400"><a
                                href="/quan-li-danh-gia-cua-hoc-vien/id<?=$row['user_id']?>-p1.html">Danh
                                sách đánh giá</a></li>
                        <li class="font-all-400"><a
                                href="/danh-sach-hoc-vien-dang-cho-mua-chung/id<?=$row['user_id']?>-p1.html">Khóa học mua
                                chung
                                chờ</a></li>
                    </ul>
                    <div class="v_sidebar-menu" onclick="v_sidebar_tb1(3)">
                    <div class="v_sidebar-icon"><img src="../../img/vi-khoa-hoc.svg" alt="ảnh lỗi"></div>
                    <div class="v_sidebar-list"><button id="v_gv_vikh_tb">Ví Khóa Học 365</button></div>
                    <div class="v_ion-caret"><img src="../../img/ion_caret-down.svg" alt="ảnh lỗi"></div>
                </div>
                <ul id="v_sidebar_tb-3" style="list-style-type: none;">
                    <li class="font-all-400"><a href="/nap-tien/id<?=$row['user_id']?>.html" id="v_naptien_gv_tb">Nạp tiền</a></li>
                    <li class="font-all-400"><a href="/giang-vien-lich-su-giao-dich/id<?=$row['user_id']?>-p1.html">Lịch sử
                            giao dịch</a></li>
                    <li class="font-all-400"><a href="/lich-su-nap-tien/id<?=$row['user_id']?>.html">Lịch sử nạp tiền</a></li>
                    <li class="font-all-400"><a href="/giang-vien-rut-tien/id<?=$row['user_id']?>.html">Rút tiền</a>
                    </li>
                </ul>

                    <div class="v_sidebar-menu" id="v_gv_magiamgia3" onclick="v_sidebar_tb1(4)">
                        <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif"
                                data-src="../../img/GV-ma-gg.svg" alt="ảnh lỗi"></div>
                        <div class="v_sidebar-list"><button>Mã giảm giá</button></div>
                        <div class="v_ion-caret"><img class="lazyload" src="/img/load.gif"
                                data-src="../../img/ion_caret-down.svg" alt="ảnh lỗi"></div>
                    </div>
                    <ul id="v_sidebar_tb-4" style="list-style-type: none;">
                        <li class="font-all-400"><a href="/giang-vien-tao-ma-giam-gia/id<?=$row['user_id']?>.html">Tạo
                                mã
                                giảm giá</a></li>
                        <li class="font-all-400"><a
                                href="/giang-vien-quan-li-ma-giam-gia/id<?=$row['user_id']?>-p1.html">Quản
                                lý mã giảm giá</a></li>
                    </ul>

                    <div class="v_sidebar-menu" id="v_thongtingv3" onclick="v_sidebar_tb1(5)">
                        <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif"
                                data-src="../../img/user.svg" alt="ảnh lỗi"></div>
                        <div class="v_sidebar-list"><button>Thông tin tài khoản</button></div>
                        <div class="v_ion-caret"><img class="lazyload" src="/img/load.gif"
                                data-src="../../img/ion_caret-down.svg" alt="ảnh lỗi"></div>
                    </div>
                    <ul id="v_sidebar_tb-6" style="list-style-type: none;">
                        <li class="font-all-400"><a href="/cap-nhat-giang-vien/id<?=$row['user_id']?>.html">Cập nhập thông tin</a></li>
                    </ul>
                    <div class="v_sidebar-menu">
                        <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif"
                                data-src="../../img/logout.svg" alt="ảnh lỗi"></div>
                        <div class="v_sidebar-list"><a href="../code_xu_ly/v_logout.php">Đăng xuất</a></div>
                        <div class="v_ion-caret" style="color: white;">p</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>