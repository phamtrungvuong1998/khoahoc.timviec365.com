<div id="v_header-main">
    <div id="v_header-1" class="flex">
        <div class="menu-list font font-all-400"><a href="/">Trang Chủ</a></div>
        <div class="menu-list font font-all-400"><a href="/khoa-hoc-online.html">Khóa Online</a></div>
        <div class="menu-list font font-all-400"><a href="/khoa-hoc-offline.html">Khóa Offline</a></div>
        <div class="menu-list font font-all-400"><a href="/danh-sach-hoc-vien.html">Học viên</a></div>
        <div class="menu-list font font-all-400" id="menu-list-last"><a href="#">Blog</a></div>
        <div id="v_header-avatar">
            <button class="v_header_avatar"><img src="/img/load.gif" data-src="../img/avatar/<?php echo $rowHV['user_avatar']; ?>" class="v_header-avatar-img lazyload" id="v_header-avatar-img1"
            onerror='this.onerror=null;this.src="../img/avatar/error.png";' alt="ảnh lỗi"></button>
            <div id="v_header-dropdown">
                <center><img class="v_header-avatar-img lazyload" id="v_header-avatar-img2" src="/img/load.gif" data-src="../img/avatar/<?php echo $rowHV['user_avatar']; ?>" alt="Ảnh lỗi" onerror='this.onerror=null;this.src="../img/avatar/error.png";'></center>
                <div id="v_header-avatar-dropdown-name"><?php echo $rowHV['user_name']; ?></div>
                <div id="v_header-avatar-dropdown-tk">Số dư : &nbsp;<span><?php echo number_format($rowHV['user_money']); ?> đ</span>
                </div>
                <div class="v_header-dropdown-menu">
                    <img class="lazyload" src="/img/load.gif" data-src="../../img/setting.svg" alt="Ảnh lỗi">
                    <button><a href="/quan-li-chung-hoc-vien/id<?php echo $_COOKIE['user_id']; ?>.html">Quản lý
                    chung</a></button>
                </div>
                <hr class="v_header-dropdown-hr">
                <div class="v_header-dropdown-menu">
                    <img class="lazyload" src="/img/load.gif" data-src="../../img/play-btn.svg" alt="Ảnh lỗi">
                    <button><a href="/hoc-vien-khoa-hoc-online-da-mua/id<?php echo $_COOKIE['user_id'];?>.html">Khóa học của tôi</a></button>
                </div>
                <hr class="v_header-dropdown-hr">
                <div class="v_header-dropdown-menu">
                    <img class="lazyload" src="/img/load.gif" data-src="../../img/vi-khoa-hoc.svg" alt="Ảnh lỗi">
                    <button><a href="/hoc-vien-nap-tien/id<?php echo $_COOKIE['user_id'];?>.html">Ví Khóa Học 365</a></button>
                </div>
                <hr class="v_header-dropdown-hr">
                <div class="v_header-dropdown-menu">
                    <img class="lazyload" src="/img/load.gif" data-src="../../img/gio-hang.svg" alt="Ảnh lỗi">
                    <button><a href="/gio-hang/id<?php echo $_COOKIE['user_id']; ?>.html">Giỏ hàng</a></button>
                </div>
                <hr class="v_header-dropdown-hr">
                <div class="v_header-dropdown-menu">
                    <img class="lazyload" src="/img/load.gif" data-src="../../img/logout.svg" alt="Ảnh lỗi">
                    <button><a href="../code_xu_ly/v_logout.php">Đăng xuất</a></button>
                </div>
            </div>
        </div>
        <div style="padding-top: 24px;"><button class="v_header_avatar" id="v_ion-caret"><img class="lazyload" src="/img/load.gif" data-src="../../img/ion_caret-down.svg" alt="ảnh lỗi"></button></div>
        </div>

        <div id="v_header-mb">
            <center>
                <div id="v_logo1"><a href="/"><img class="lazyload" src="/img/load.gif" data-src="../../img/logoo2.svg" alt="ảnh lỗi"></a></div>
            </center>
            <div id="v_menu" onclick="quanlihocvien()"><img class="lazyload" src="/img/load.gif" data-src="../../img/List.svg" id="v_list" alt="ảnh lỗi"></div>
            <div id="quanlihocvien">
                <div id="quanlihocvien_div">
                <center>
                    <a id="v_logo-chung" href="/"><img class="lazyload" src="/img/load.gif" data-src="../../img/logoo2.svg" alt="ảnh lỗi"></a>
                </center>
                <div id="v_quanlihocvien-hr">
                    <hr>
                </div>
                <div id="v_quanlihocvien-menu">
                    <div><a href="/">Trang Chủ</a></div>
                    <div><a href="/khoa-hoc-online.html">Khóa Online</a></div>
                    <div><a href="/khoa-hoc-offline.html">Khóa Offline</a></div>
                    <div><a href="/danh-sach-hoc-vien.html">Học viên</a></div>
                    <div><a href="#">Blog</a></div>
                </div>
                <div>
                    <hr>
                </div>
                <div id="v_quanlihocvien-avatar">
                    <center><img class="lazyload" src="/img/load.gif" onerror='this.onerror=null;this.src="../img/avatar/error.png";' id="v_header-avatar-img" data-src="../img/avatar/<?php echo $rowHV['user_avatar']; ?>" id="v_quanlihocvien-avatar-img" alt="ảnh lỗi"></center>
                </div>
                <div id="v_tenhocvien"><?php echo $rowHV['user_name']; ?></div>
                <div class="v_sodu_hv">Số dư : <span><?php echo number_format($rowHV['user_money']); ?> đ</span></div>
                <div id="v_quanlihocvien-detail" class="flex">
                    <div class="flex v_sidebar-menu">
                        <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif" data-src="../../img/setting.svg" alt="ảnh lỗi"></div>
                        <div class="v_sidebar-list"><a
                            href="/quan-li-chung-hoc-vien/id<?php echo $_COOKIE['user_id']; ?>.html">Quản lý chung</a>
                        </div>
                        <div class="v_ion-caret" style="color: white;">p</div>
                    </div>

                    <div class="flex v_sidebar-menu">
                        <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif" data-src="../../img/gio-hang.svg" alt="Ảnh lỗi"></div>
                        <div class="v_sidebar-list"><a href="/gio-hang/id<?php echo $_COOKIE['user_id']; ?>.html">Giỏ hàng</a>
                        </div>
                        <div class="v_ion-caret" style="color: white;">p</div>
                    </div>

                    <div class="flex v_sidebar-menu" onclick="v_sidebar_tb(2)">
                        <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif" data-src="../../img/play-btn.svg" alt="ảnh lỗi"></div>
                        <div class="v_sidebar-list"><button>Quản lý khóa học</button></div>
                        <div class="v_ion-caret"><img class="lazyload" src="/img/load.gif" data-src="../../img/ion_caret-down.svg" alt="ảnh lỗi"></div>
                    </div>
                    <ul id="v_sidebar-tb-2" style="list-style-type: none;">
                        <li class="font-all-400"><a
                            href="/hoc-vien-khoa-hoc-online-da-mua/id<?php echo $_COOKIE['user_id']; ?>.html">Khóa học
                        online đã mua</a></li>
                        <li class="font-all-400"><a
                            href="/hoc-vien-khoa-hoc-offline-da-dat-cho/id<?php echo $_COOKIE['user_id']; ?>.html">Khóa học
                        offline đã đặt chỗ</a></li>
                        <li class="font-all-400"><a
                            href="/hoc-vien-khoa-hoc-online-da-luu/id<?php echo $_COOKIE['user_id']; ?>.html">Khóa học
                        online đã lưu</a></li>
                        <li class="font-all-400"><a
                            href="/hoc-vien-khoa-hoc-offline-da-luu/id<?php echo $_COOKIE['user_id']; ?>.html">Khóa học
                        offline đã lưu</a></li>
                        <li class="font-all-400"><a
                            href="/hoc-vien-khoa-hoc-mua-chung/id<?php echo $_COOKIE['user_id']; ?>.html">Khóa học mua
                        chung</a></li>
                        <li class="font-all-400"><a
                            href="/hoc-vien-giang-vien-da-luu/id<?php echo $_COOKIE['user_id']; ?>.html">Giảng viên đã
                        lưu</a></li>
                        <li class="font-all-400"><a
                            href="/hoc-vien-trung-tam-da-luu/id<?php echo $_COOKIE['user_id']; ?>.html">Trung tâm đã
                        lưu</a></li>
                    </ul>
                    <div class="flex v_sidebar-menu" onclick="v_sidebar_tb(3)">
                        <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif" data-src="../../img/vi-khoa-hoc.svg" alt="ảnh lỗi"></div>
                        <div class="v_sidebar-list"><button>Ví Khóa Học 365</button></div>
                        <div class="v_ion-caret"><img class="lazyload" src="/img/load.gif" data-src="../../img/ion_caret-down.svg" alt="ảnh lỗi"></div>
                    </div>
                    <ul id="v_sidebar-tb-3" style="list-style-type: none;">
                        <li class="font-all-400"><a href="/nap-tien/id<?php echo $_COOKIE['user_id']; ?>.html">Nạp
                        tiền</a></li>
                        <li class="font-all-400"><a
                            href="/hoc-vien-lich-su-mua-khoa-hoc/id<?php echo $_COOKIE['user_id']; ?>.html">Lịch sử mua
                        khóa học</a></li>
                        <li class="font-all-400"><a
                            href="/lich-su-nap-tien/id<?php echo $_COOKIE['user_id']; ?>.html">Lịch sử nạp
                        tiền</a></li>
                    </ul>

                    <div class="flex v_sidebar-menu" onclick="v_sidebar_tb(5)">
                        <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif" data-src="../../img/user.svg" alt="ảnh lỗi"></div>
                        <div class="v_sidebar-list"><button class="v_sidebar-list_info">Thông tin tài khoản</button></div>
                        <div class="v_ion-caret"><img class="lazyload" src="/img/load.gif" data-src="../../img/ion_caret-down.svg" alt="ảnh lỗi"></div>
                    </div>
                    <ul id="v_sidebar-tb-5" style="list-style-type: none;">
                        <li class="font-all-400"><a href="/thong-tin-hoc-vien/id<?php echo $_COOKIE['user_id']; ?>.html">Cập
                        nhập thông tin</a></li>
                    </ul>
                    <div class="flex v_sidebar-menu">
                        <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif" data-src="../../img/logout.svg" alt="ảnh lỗi"></div>
                        <div class="v_sidebar-list"><a href="../code_xu_ly/v_logout.php">Đăng xuất</a></div>
                        <div class="v_ion-caret" style="color: white;">p</div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>