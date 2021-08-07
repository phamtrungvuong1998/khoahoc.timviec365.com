<div id="v_sidebar">
    <div id="v_sidebar-content">
        <div id="v_sidebar_content_div">
            <center><a href="/"><img id="v_logo" class="lazyload" src="/img/load.gif" data-src="../../img/logoo2.svg"
                        alt="ảnh lỗi"></a></center>
        </div>
        <hr>
        <div style="padding-top: 24px;">
            <center><img onerror="this.onerror=null;this.src='../img/avatar/error.png';" id="v_avatar" class="lazyload"
                    src="/img/load.gif" data-src="../img/avatar/<?php echo $rowHV['user_avatar']; ?>" alt="ảnh lỗi">
            </center>
        </div>
        <div id="v_name">
            <center id="v_name_HV"><?php echo $rowHV['user_name']; ?></center>
        </div>
        <div class="flex" style="flex-direction: column; align-items: center;">
            <div class="flex v_sidebar-menu">
                <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif" data-src="../../img/setting.svg"
                        alt="ảnh lỗi"></div>
                <div class="v_sidebar-list"><a href="/quan-li-chung-hoc-vien/id<?php echo $_COOKIE['user_id']; ?>.html"
                        id="v_QL-chung">Quản lý chung</a></div>
                <div class="v_ion-caret" style="color: white;"></div>
            </div>
            <div class="flex v_sidebar-menu v_drop_down">
                <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif" data-src="../../img/play-btn.svg"
                        alt="ảnh lỗi"></div>
                <div class="v_sidebar-list"><button id="v_QL-khoa-hoc">Quản lý khóa học</button></div>
                <div class="v_ion-caret"><img class="lazyload" src="/img/load.gif"
                        data-src="../../img/ion_caret-down.svg" alt="ảnh lỗi"></div>
            </div>
            <ul id="v_sidebar-1" style="list-style-type: none;">
                <li><a class="v_sidebar-li" id="v_kh-online"
                        href="/hoc-vien-khoa-hoc-online-da-mua/id<?php echo $_COOKIE['user_id']; ?>.html">Khóa học
                        online đã mua</a></li>
                <li><a class="v_sidebar-li" id="v_kh-offline"
                        href="/hoc-vien-khoa-hoc-offline-da-dat-cho/id<?php echo $_COOKIE['user_id']; ?>.html">Khóa học
                        offline đã đặt chỗ</a></li>
                <li><a class="v_sidebar-li" id="v_kh-luu-online"
                        href="/hoc-vien-khoa-hoc-online-da-luu/id<?php echo $_COOKIE['user_id']; ?>.html">Khóa học
                        online đã lưu</a></li>
                <li><a class="v_sidebar-li" id="v_kh-luu-offline"
                        href="/hoc-vien-khoa-hoc-offline-da-luu/id<?php echo $_COOKIE['user_id']; ?>.html">Khóa học
                        offline đã lưu</a></li>
                <li><a class="v_sidebar-li" id="v_kh-mua-chung"
                        href="/hoc-vien-khoa-hoc-mua-chung/id<?php echo $_COOKIE['user_id']; ?>.html">Khóa học mua
                        chung</a></li>
                <li><a class="v_sidebar-li" id="v_gv-da-luu"
                        href="/hoc-vien-giang-vien-da-luu/id<?php echo $_COOKIE['user_id']; ?>.html">Giảng viên đã
                        lưu</a></li>
                <li><a class="v_sidebar-li" id="v_tt-da-luu"
                        href="/hoc-vien-trung-tam-da-luu/id<?php echo $_COOKIE['user_id']; ?>.html">Trung tâm đã lưu</a>
                </li>
            </ul>
            <div class="flex v_sidebar-menu v_drop_down">
                <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif"
                        data-src="../../img/vi-khoa-hoc.svg" alt="ảnh lỗi"></div>
                <div class="v_sidebar-list"><button id="v_vi-kh">Ví Khóa Học 365</button></div>
                <div class="v_ion-caret"><img class="lazyload" src="/img/load.gif"
                        data-src="../../img/ion_caret-down.svg" alt="ảnh lỗi"></div>
            </div>
            <ul id="v_sidebar-2" style="list-style-type: none;">
                <li><a class="v_sidebar-li" id="v_nap-tien"
                        href="/nap-tien/id<?php echo $_COOKIE['user_id']; ?>.html">Nạp tiền</a>
                </li>
                <li><a class="v_sidebar-li" id="v_ls-mua-kh"
                        href="/hoc-vien-lich-su-mua-khoa-hoc/id<?php echo $_COOKIE['user_id']; ?>.html">Lịch sử mua khóa
                        học</a></li>
                <li><a class="v_sidebar-li" id="v_ls-nap-tien"
                        href="/lich-su-nap-tien/id<?php echo $_COOKIE['user_id']; ?>.html">Lịch sử nạp tiền</a>
                </li>
            </ul>
            <div class="flex v_sidebar-menu v_drop_down">
                <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif" data-src="../../img/user.svg"
                        alt="ảnh lỗi"></div>
                <div class="v_sidebar-list"><button id="v_thong-tin-tk-1">Thông tin tài khoản</button></div>
                <div class="v_ion-caret"><img class="lazyload" src="/img/load.gif"
                        data-src="../../img/ion_caret-down.svg" alt="ảnh lỗi"></div>
            </div>
            <ul id="v_sidebar-3" style="list-style-type: none;">
                <li><a class="v_sidebar-li" id="v_cap-nhat-tk"
                        href="/thong-tin-hoc-vien/id<?php echo $_COOKIE['user_id']; ?>.html">Cập nhập thông tin</a></li>
            </ul>
            <div class="flex v_sidebar-menu">
                <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif" data-src="../../img/logout.svg"
                        alt="ảnh lỗi"></div>
                <div class="v_sidebar-list"><a onclick="v_logout2()">Đăng xuất</a></div>
                <div class="v_ion-caret" style="color: white;"></div>
            </div>
        </div>
        </div>
</div>
 
