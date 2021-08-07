<div id="v_sidebar">
    <div id="v_sidebar-content">
        <div>
            <center><a href="/"><img id="v_logo" class="lazyload" src="/img/load.gif" data-src="../img/logoo2.svg"
                        alt="ảnh lỗi"></a></center>
        </div>
        <hr>
        <div style="padding-top: 24px;">
            <center><img id="v_avatar" style="border-radius:100px" class="lazyload" src="/img/load.gif"
                    data-src="../img/avatar/<?=$row['user_avatar']?>" alt="Ảnh lỗi"
                    onerror='this.onerror=null;this.src="../img/avatar/error.png";'></center>
        </div>
        <div id="v_name">
            <center id="v_name_gv"><?=$row['user_name']?></center>
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
                <a href="/tao-khoa-hoc-online-giang-vien/id<?php echo $cookie_id; ?>.html">
                    <img class="lazyload" src="/img/load.gif" data-src="../img/tao-khoa-hoc.svg" alt="Ảnh lỗi">
                    <span id="v_siderbar-btn-span">TẠO KHÓA HỌC ONLINE </span>
                </a>
            </center>
            <center id="v_siderbar-btn">
                <a href="/tao-khoa-hoc-offline-giang-vien/id<?php echo $cookie_id; ?>.html">
                    <img class="lazyload" src="/img/load.gif" data-src="../img/tao-khoa-hoc.svg" alt="Ảnh lỗi">
                    <span id="v_siderbar-btn-span">TẠO KHÓA HỌC OFFLINE </span>
                </a>
            </center>
            <?
            }
            ?>
        </div>
        <div
            style="display: flex; flex-direction: column; align-items: flex-start; padding-left: 5%;padding-bottom: 50px;">
            <div class="v_sidebar-menu">
                <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif" data-src="../img/setting.svg"
                        alt="ảnh lỗi"></div>
                <div class="v_sidebar-list"><a href="/quan-li-chung-giang-vien/id<?php echo $cookie_id; ?>.html"
                        id="v_QL-chung">Quản lý chung</a></div>
                <div class="v_ion-caret" style="color: white;"></div>
            </div>
            <div class="v_sidebar-menu v_drop_down">
                <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif"
                        data-src="../img/GV-quan-li-hv.svg" alt="ảnh lỗi"></div>
                <div class="v_sidebar-list"><button id="v_QL-hv">Quản lý học viên</button></div>
                <div class="v_ion-caret"><img class="lazyload" src="/img/load.gif" data-src="../img/ion_caret-down.svg"
                        alt="ảnh lỗi"></div>
            </div>
            <ul id="v_sidebar-tb-1">
                <li><a href="/danh-sach-hoc-vien-da-luu/id<?php echo $cookie_id; ?>-p1.html" id="v_hv-da-luu"
                        class="v_sidebar-li">Danh sách học viên đã lưu</a></li>
                <li><a href="/danh-sach-hoc-vien-mua-tu-diem/id<?php echo $cookie_id; ?>-p1.html" id="v_hv-mua-tu-diem"
                    class="v_sidebar-li">Danh sách học viên mua từ điểm</a></li>
            </ul>
            <div class="v_sidebar-menu v_drop_down">
                <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif" data-src="../img/play-btn.svg"
                        alt="ảnh lỗi"></div>
                <div class="v_sidebar-list"><button id="v_ql-kh">Quản lý khóa học</button></div>
                <div class="v_ion-caret"><img class="lazyload" src="/img/load.gif" data-src="../img/ion_caret-down.svg"
                        alt="ảnh lỗi"></div>
            </div>
            <ul id="v_sidebar-tb-2">
                <li><a href="/giang-vien-khoa-hoc-offline/id<?php echo $cookie_id; ?>-p1.html" id="v_kh-offline"
                        class="v_sidebar-li">Khóa học offline</a>
                </li>
                <li><a href="/giang-vien-khoa-hoc-online/id<?php echo $cookie_id; ?>-p1.html" id="v_kh-online"
                        class="v_sidebar-li">Khóa học online</a>
                </li>
                <li><a href="/giang-vien-khoa-hoc-online-da-ban/id<?php echo $cookie_id; ?>-p1.html" id="v_kh-da-ban"
                        class="v_sidebar-li">Khóa
                        học online đã bán</a></li>
                <li><a href="/giang-vien-khoa-hoc-offline-da-dat-cho/id<?php echo $cookie_id; ?>-p1.html" id="v_kh-offline-da-dat-cho" class="v_sidebar-li">Khóa học offline đã đặt chỗ</a></li>
                <li><a href="/quan-li-danh-gia-cua-hoc-vien/id<?php echo $cookie_id; ?>-p1.html" id="v_hv-danh-gia"
                        class="v_sidebar-li">Danh sách đánh giá</a></li>
                <li><a href="/danh-sach-hoc-vien-dang-cho-mua-chung/id<?php echo $cookie_id; ?>-p1.html"
                        id="v_hv-cho-mua-chung" class="v_sidebar-li">Khóa học mua chung chờ</a></li>
            </ul>
            <div class="v_sidebar-menu v_drop_down">
                <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif" data-src="../img/vi-khoa-hoc.svg"
                        alt="ảnh lỗi"></div>
                <div class="v_sidebar-list"><button id="v_vi-kh">Ví Khóa Học 365</button></div>
                <div class="v_ion-caret"><img class="lazyload" src="/img/load.gif" data-src="../img/ion_caret-down.svg"
                        alt="ảnh lỗi"></div>
            </div>
            <ul id="v_sidebar-tb-3">
                <li><a href="/nap-tien/id<?php echo $cookie_id; ?>.html" id="v_napten_gv">Nạp tiền</a></li>
                <li><a href="/giang-vien-lich-su-giao-dich/id<?php echo $cookie_id; ?>-p1.html" id="v_ls-giao-dich">Lịch sử rút tiền</a></li>
                <li><a href="/lich-su-nap-tien/id<?php echo $cookie_id; ?>.html" id="v_ls-giao-dich">Lịch sử nạp tiền</a></li>
                <li><a href="/giang-vien-rut-tien/id<?php echo $cookie_id; ?>.html" id="v_rut-tien">Rút tiền</a></li>
            </ul>

            <div class="v_sidebar-menu v_drop_down">
                <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif" data-src="../img/GV-ma-gg.svg"
                        alt="ảnh lỗi"></div>
                <div class="v_sidebar-list"><button id="v_ma-giam-gia">Mã giảm giá</button></div>
                <div class="v_ion-caret"><img class="lazyload" src="/img/load.gif" data-src="../img/ion_caret-down.svg"
                        alt="ảnh lỗi"></div>
            </div>
            <ul id="v_sidebar-tb-4">
                <li><a class="v_sidebar-li" id="v_tao-ma-gg"
                        href="/giang-vien-tao-ma-giam-gia/id<?php echo $cookie_id; ?>.html">Tạo mã giảm giá</a></li>
                <li><a class="v_sidebar-li" id="v_ql-ma-gg"
                        href="/giang-vien-quan-li-ma-giam-gia/id<?php echo $cookie_id; ?>-p1.html">Quản lý mã giảm
                        giá</a></li>
            </ul>
            <div class="v_sidebar-menu v_drop_down">
                <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif" data-src="../img/user.svg"
                        alt="ảnh lỗi"></div>
                <div class="v_sidebar-list"><button id="v_thong-tin-tk">Thông tin tài khoản</button></div>
                <div class="v_ion-caret"><img class="lazyload" src="/img/load.gif" data-src="../img/ion_caret-down.svg"
                        alt="ảnh lỗi"></div>
            </div>
            <ul id="v_sidebar-tb-5">
                <li><a class="v_sidebar-li" id="v_cap-nhat-tt"
                        href="/cap-nhat-giang-vien/id<?php echo $cookie_id; ?>.html">Cập nhập thông tin</a></li>
            </ul>
            <div class="v_sidebar-menu v_drop_down">
                <div class="v_sidebar-icon"><img class="lazyload" src="/img/load.gif" data-src="../img/logout.svg"
                        alt="ảnh lỗi"></div>
                <div class="v_sidebar-list"><button type="button" onclick="v_logout2()">Đăng xuất</button></div>
                <div class="v_ion-caret" style="color: white;"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function v_logout2() {
        var n = confirm("Bạn có muốn đăng xuất không ?");
        if (n == true) {
            window.location.href = "../code_xu_ly/v_logout.php";
        }
    }
</script>