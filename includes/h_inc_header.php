<header>
    <div class="container container_detail">
        <!--Mobile-->
        <div class="header-mb">
            <a data-toggle="modal" href='#modal-id'><img height="48px" width="48px" class="logomb lazyload" src="/img/load.gif" data-src="../img/menu.png"></a>
        </div>
        <div class="modal fade" id="modal-id">
            <div class="modal-dialog modal-dialog2">
                <div class="modal-content modal-content-menu">
                    <div class="modal-header modal-logo">
                        <a href="/"><img height="63px" width="176px" class="lazyload" src="/img/load.gif"
                                data-src="../img/logoo1.png"></a>
                    </div>
                    <div class="modal-body">
                        <ul class="header-menu-mb">
                            <li><a href="/">Trang Chủ</a></li>
                            <li><a href="/khoa-hoc-online.html">Khóa Online</a></li>
                            <li><a href="/khoa-hoc-offline.html">Khóa Offline</a></li>
                            <li><a href="/danh-sach-hoc-vien.html">Học viên</a></li>
                            <li><a href="https://timviec365.com/blog">Blog</a></li>
                        </ul>

                        <?php
                            if ($cookie_id != 0) {
                                ?>
                        <div class="header-mb-user">
                            <div class="img-name">
                                <img class="lazyload" src="/img/load.gif"
                                    data-src="../img/avatar/<?=$row['user_avatar']?>"
                                    onerror='this.onerror=null;this.src="../img/avatar/error.png";'>
                                <h3><?=$row['user_name']?></h3>
                            </div>
                            <ul>
                                <?php
                                    if ($cookie_type==1) {
                                ?>
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/settings-24px 1.png"><a
                                        href="/quan-li-chung-hoc-vien/id<?=$cookie_id?>.html">Quản lý chung</a></li>
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/bi_play-btn(1).png"><a
                                        onclick="nav_toggle(1)">Quản lý khóa học</a><img class="lazyload v_caret"
                                        src="/img/load.gif" data-src="../img/ion_caret-back(1).png">
                                    <ul class="togglett" id="child-1">
                                        <li><a href="/hoc-vien-khoa-hoc-offline-da-mua/id<?=$row['user_id']?>.html">Khóa
                                                học offline đã mua</a></li>
                                        <li><a href="/hoc-vien-khoa-hoc-online-da-mua/id<?=$row['user_id']?>.html">Khóa
                                                học online đã mua</a></li>
                                        <li><a href="/hoc-vien-khoa-hoc-mua-chung/id<?=$row['user_id']?>.html">Khóa
                                                học mua chung</a></li>
                                    </ul>
                                </li>
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/uitransaction.png"><a
                                        onclick="nav_toggle(2)">Ví Khóa Học 365</a><img class="lazyload v_caret"
                                        src="/img/load.gif" data-src="../img/ion_caret-back(1).png">
                                    <ul class="togglett" id="child-2">
                                        <li><a href="/hoc-vien-nap-tien/id<?=$row['user_id']?>.html">Nạp tiền</a></li>
                                        <li><a href="/hoc-vien-lich-su-mua-khoa-hoc/id<?=$row['user_id']?>-p1.html">Lịch
                                                sử mua khóa học</a></li>
                                        <li><a href="/hoc-vien-lich-su-nap-tien/id<?=$row['user_id']?>.html">Lịch sử nạp
                                                tiền</a></li>
                                    </ul>
                                </li>
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/bx_bx-user.png"><a
                                        onclick="nav_toggle(3)">Thông
                                        tin tài khoản</a><img class="lazyload v_caret" src="/img/load.gif"
                                        data-src="../img/ion_caret-back(1).png">
                                    <ul class="togglett" id="child-3">
                                        <li><a href="/thong-tin-hoc-vien/id<?=$row['user_id']?>.html">Cập nhật thông
                                                tin</a></li>
                                    </ul>
                                </li>
                                <?php
                                    }elseif ($cookie_type==2) {
                                ?>
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/settings-24px 1.png"><a
                                        href="/quan-li-chung-giang-vien/id<?=$cookie_id?>.html">Quản lý chung</a></li>
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/bi_play-btn(1).png"><a
                                        onclick="nav_toggle(1)">Quản lý khóa học</a><img class="lazyload v_caret"
                                        src="/img/load.gif" data-src="../img/ion_caret-back(1).png">
                                    <ul class="togglett" id="child-1">
                                        <li><a href="/giang-vien-khoa-hoc-offline/id<?=$row['user_id']?>-p1.html">Khóa
                                                học offline</a></li>
                                        <li><a href="/giang-vien-khoa-hoc-online/id<?=$row['user_id']?>-p1.html">Khóa
                                                học online</a></li>
                                        <li><a href="/giang-vien-khoa-hoc-da-ban/id<?=$row['user_id']?>-p1.html">Khóa
                                                học đã bán</a></li>
                                        <li><a href="/quan-li-danh-gia-cua-hoc-vien/id<?=$row['user_id']?>-p1.html">Danh
                                                sách đánh giá</a></li>
                                        <li><a
                                                href="/danh-sach-hoc-vien-dang-cho-mua-chung/id<?=$row['user_id']?>-p1.html">Khóa
                                                học mua chung chờ</a></li>
                                    </ul>
                                </li>
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/uitransaction.png"><a
                                        onclick="nav_toggle(2)">Ví Khóa Học 365</a><img class="lazyload v_caret"
                                        src="/img/load.gif" data-src="../img/ion_caret-back(1).png">
                                    <ul class="togglett" id="child-2">
                                        <li><a href="/giang-vien-lich-su-giao-dich/id<?=$row['user_id']?>-p1.html">Lịch
                                                sử giao dịch</a></li>
                                        <li><a href="/giang-vien-rut-tien/id<?=$row['user_id']?>.html">Rút tiền</a></li>
                                    </ul>
                                </li>
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/bx_bx-user.png"><a
                                        onclick="nav_toggle(3)">Thông
                                        tin tài khoản</a><img class="lazyload v_caret" src="/img/load.gif"
                                        data-src="../img/ion_caret-back(1).png">
                                    <ul class="togglett" id="child-3">
                                        <li><a href="/cap-nhat-giang-vien/id<?=$row['user_id']?>.html">Cập nhật thông
                                                tin</a></li>
                                    </ul>
                                </li>
                                <?php
                                    }elseif ($cookie_type==3) {
                                ?>
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/settings-24px 1.png"><a
                                        href="/quan-li-chung-trung-tam/id<?=$cookie_id?>.html">Quản lý chung</a></li>
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/bi_play-btn(1).png"><a
                                        onclick="nav_toggle(1)">Quản lý khóa học</a><img class="lazyload v_caret"
                                        src="/img/load.gif" data-src="../img/ion_caret-back(1).png">
                                    <ul class="togglett" id="child-1">
                                        <li><a
                                                href="/trung-tam-khoa-hoc-online-giang-day/id<?=$row['user_id']?>&page1.html">Khóa
                                                học offline</a></li>
                                        <li><a
                                                href="/trung-tam-khoa-hoc-offline-giang-day/id<?=$row['user_id']?>&page1.html">Khóa
                                                học online</a></li>
                                        <li><a
                                                href="/trung-tam-khoa-hoc-online-da-ban/id<?=$row['user_id']?>&page1.html">Khóa
                                                học đã bán</a></li>
                                        <li><a href="/trung-tam-danh-sach-danh-gia/id<?=$row['user_id']?>&page1.html">Danh
                                                sách đánh giá</a></li>
                                        <li><a href="/trung-tam-khoa-hoc-mua-chung/id<?=$row['user_id']?>&page1.html">Khóa
                                                học mua chung chờ</a></li>
                                    </ul>
                                </li>
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/uitransaction.png"><a
                                        onclick="nav_toggle(2)">Ví Khóa Học 365</a><img class="lazyload v_caret"
                                        src="/img/load.gif" data-src="../img/ion_caret-back(1).png">
                                    <ul class="togglett" id="child-2">
                                        <li><a href="/trung-tam-lich-su-giao-dich/id<?=$row['user_id']?>&page1.html">Lịch
                                                sử giao dịch</a></li>
                                        <li><a href="/trung-tam-rut-tien/id<?=$row['user_id']?>.html">Rút tiền</a></li>
                                    </ul>
                                </li>
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/bx_bx-user.png"><a
                                        onclick="nav_toggle(3)">Thông tin tài khoản</a><img class="lazyload v_caret"
                                        src="/img/load.gif" data-src="../img/ion_caret-back(1).png">
                                    <ul class="togglett" id="child-3">
                                        <li><a href="/trung-tam-cap-nhat-thong-tin/id<?=$row['user_id']?>.html">Cập nhật
                                                thông tin</a></li>
                                    </ul>
                                </li>
                                <?php
                                    }
                                ?>
                                <li><img class="lazyload" src="/img/load.gif" data-src="../img/logout-24px 1.png"><a href="/dang-xuat.html">Đăng xuất</a></li>
                            </ul>
                        </div>
                        <?php
                            }else{
                                ?>
                        <div class="header-signin-signup-mb">
                            <div class="signin-signup">
                                <a href="/dang-ki-hoc-vien.html">ĐĂNG KÝ</a>
                                <a href="/lua-chon-dang-nhap.html">ĐĂNG NHẬP</a>
                            </div>
                            <div class="become-teacher">
                                <a href="/hop-tac-giang-day.html">TRỞ THÀNH GIẢNG VIÊN</a>
                            </div>
                        </div>
                        <?php
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>
        <!--End Mobile-->

        <div class="logo1">
            <a href="/"><img height="63px" width="176px" class="lazyload" src="/img/load.gif"
                    data-src="../img/logoo1.png"></a>
        </div>
        <div class="header-menu">
            <ul class="header-menu-pc">
                <li><a id="home" href="/">Trang Chủ</a></li>
                <li><a id="online" href="/khoa-hoc-online.html">Khóa Online</a></li>
                <li><a id="offline" href="/khoa-hoc-offline.html">Khóa Offline</a></li>
                <li><a id="student" href="/danh-sach-hoc-vien.html">Học viên</a></li>
                <li><a href="https://timviec365.com/blog">Blog</a></li>
            </ul>
            <?
                if (isset($_COOKIE['user_id'])) {
                    $qrU = new db_query("SELECT * FROM users WHERE user_id = " . $_COOKIE['user_id']);
                    $row1 = mysql_fetch_array($qrU->result);
                    ?>
            <div class="header-user-avatar" id="header-user-avatar1">
                <img width="40px" height="40px" style="border-radius: 100px;" class="lazyload" src="/img/load.gif"
                    data-src="../img/avatar/<?=$row1['user_avatar']?>"
                    onerror='this.onerror=null;this.src="../img/avatar/error.png";'>
                <img class="lazyload" src="/img/load.gif" data-src="../img/ion_caret-back(1).png">
            </div>
            <div id="header-user-avatar2">
                <div class="user-avatar2">
                    <img width="40px" height="40px" style="border-radius: 100px;" class="lazyload" src="/img/load.gif"
                        data-src="../img/avatar/<?=$row1['user_avatar']?>"
                        onerror='this.onerror=null;this.src="../img/avatar/error.png";'>
                    <h4><?php echo $row1['user_name']?></h4>
                </div>
                <ul>
                    <li id="moneys">Số dư : <span><?php echo number_format($row1['user_money']);?> đ</span></li>
                    <?php
                        if ($_COOKIE['user_type']==1) { 
                    ?>
                    <li><img class="lazyload" src="/img/load.gif" data-src="../img/image/useseting.svg"><a
                            href="/quan-li-chung-hoc-vien/id<?=$cookie_id?>.html">Quản lý chung</a></li>
                    <li><img class="lazyload" src="/img/load.gif" data-src="../img/image/uservideo.svg"><a
                            href="/hoc-vien-khoa-hoc-online-da-mua/id<?=$cookie_id?>.html">Khóa
                            học của tôi</a></li>
                    <li><img class="lazyload" src="/img/load.gif" data-src="../img/image/usewallet.svg"><a
                            href="/hoc-vien-nap-tien/id<?=$cookie_id?>.html">Ví
                            Khóa Học 365</a></li>
                    <li><img class="lazyload" src="/img/load.gif" data-src="../img/image/usecart.svg"><a
                            href="/gio-hang/id<?=$cookie_id?>.html">Giỏ hàng</a></li>
                    <?php
                        }elseif ($_COOKIE['user_type']==2) {
                    ?>
                    <li><img class="lazyload" src="/img/load.gif" data-src="../img/image/useseting.svg"><a
                            href="/quan-li-chung-giang-vien/id<?=$cookie_id?>.html">Quản
                            lý chung</a></li>
                    <li><img class="lazyload" src="/img/load.gif" data-src="../img/image/uservideo.svg"><a
                            href="/giang-vien-khoa-hoc-online/id<?=$cookie_id?>-p1.html">Khóa học của tôi</a></li>
                    <li><img class="lazyload" src="/img/load.gif" data-src="../img/image/usewallet.svg"><a
                            href="/giang-vien-lich-su-giao-dich/id<?=$cookie_id?>-p1.html">Ví Khóa Học 365</a></li>
                    <?php
                        }elseif ($_COOKIE['user_type']==3) {
                    ?>
                    <li><img class="lazyload" src="/img/load.gif" data-src="../img/image/useseting.svg"><a
                            href="/quan-li-chung-trung-tam/id<?=$cookie_id?>.html">Quản lý chung</a></li>
                    <?php
                    }
                    ?>
                    <li><img class="lazyload" src="/img/load.gif" data-src="../img/image/uselogout.svg"><a onclick="v_logout()">Đăng xuất</a></li>
                </ul>
            </div>
            <?
                }else{
                    ?>
            <div class="header-signin-signup">
                <div class="signin-signup">
                    <a href="/dang-ki-hoc-vien.html">ĐĂNG KÝ</a>
                    <a href="/lua-chon-dang-nhap.html">ĐĂNG NHẬP</a>
                </div>
                <div class="become-teacher">
                    <a href="/hop-tac-giang-day.html">TRỞ THÀNH GIẢNG VIÊN</a>
                </div>
            </div>
            <?php
                }
                ?>
        </div>
    </div>
</header>
<script type="text/javascript">
    function v_logout() {
        var n = confirm("Bạn có muốn đăng xuất không ?");
        if (n == true) {
            // document.cookie = "user_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
            // document.cookie = "user_type=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
            // document.cookie = "general_login=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
            // window.location.reload();
            $.ajax({
                url: '../code_xu_ly/v_logout.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    type: 1
                },
                success: function (data) {
                    window.location.reload();
                }
            });
            
        }
    }
</script>