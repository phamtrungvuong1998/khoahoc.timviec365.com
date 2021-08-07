<?
if(isset($_COOKIE['user_id'])){
    header("location:/");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU" />
    <title>HỢP TÁC GIẢNG DẠY</title>
    <link rel="stylesheet" href="../css/reset.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/slick-theme.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/slick.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/custom-bootstrap.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_footer.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/l_danh-cho-nguoi-ban.css?v=<?=$version?>">
    <link rel="stylesheet" href="../css/h_header-home.css?v=<?=$version?>">
</head>

<body id="l_body">
    <!-- header -->
    <?php
    include '../includes/h_inc_header.php';
    ?>
    <!-- end: header -->

    <!-- content -->
    <div class="l_content">
        <div class="l_hoptacgiangday">
            <div class="l_hoptacgiangday_item1">
                <div class="l_item1">HỢP TÁC GIẢNG DẠY CÙNG</div>
                <div class="l_flex">
                    <div class="l_item2">KHÓA HỌC</div>
                    <div class="l_item3">365</div>
                </div>
                <div class="l_item4">
                    Đồng hành cùng Khóa học - Timviec365.com trên hành trình nâng tâm nguồn nhân lực Việt
                </div>
            </div>
            <div class="l_hoptacgiangday_item2">
                <img class="lazyload l_hoptac_img" src="/img/load.gif" data-src="../img/l_htgd.png" alt="loading...">
            </div>
            <div class="l_btn2">
                <a href="/dang-ki-giang-vien.html" target="_blank">
                    <div class="l_dkcn">ĐĂNG KÝ CÁ NHÂN</div>
                </a>
                <a href="/dang-ki-trung-tam.html" target="_blank">
                    <div class="l_dktt">ĐĂNG KÝ TRUNG TÂM</div>
                </a>
            </div>
        </div>
        <div class="l_qc">
            <div class="l_qc_item1">
                <img class="lazyload l_qc_img" src="/img/load.gif" data-src="../img/l_nangcao.png" alt="loading...">
                <div class="l_nagcao">Nâng cao kỹ năng giảng dậy</div>
                <div class="l_item1_des">Trải nghiệm hình thức đào tạo mới và phát triển kinh nghiệm giảng dạy</div>
            </div>
            <div class="l_qc_item1">
                <img class="lazyload l_qc_img" src="/img/load.gif" data-src="../img/l_donghanh.png" alt="loading...">
                <div class="l_nagcao">Nâng cao kỹ năng giảng dậy</div>
                <div class="l_item1_des">Trải nghiệm hình thức đào tạo mới và phát triển kinh nghiệm giảng dạy</div>
            </div>
            <div class="l_qc_item1">
                <img class="lazyload l_qc_img" src="/img/load.gif" data-src="../img/l_thunhap.png" alt="loading...">
                <div class="l_nagcao">Nâng cao kỹ năng giảng dậy</div>
                <div class="l_item1_des">Trải nghiệm hình thức đào tạo mới và phát triển kinh nghiệm giảng dạy</div>
            </div>
        </div>
        <div class="l_loiich">
            <div class="l_loiich_left">
                <img class="lazyload l_loiich_img" src="/img/load.gif" data-src="../img/l_loiich.png" alt="loading...">
            </div>
            <div class="l_loiich_right">
                <div class="l_hr"></div>
                <div class="l_loiich_tieude">LỢI ÍCH KHI THAM GIA</div>
                <div class="l_loiich_mota">
                    Với <span class="l_loiich_mota l_color">Khóa học 365</span> - giảng viên và trung tâm là đối tác
                    chiến lược
                </div>
                <div class="l_loiich_mota l_top">Chính sách hợp tác minh bạch, tỷ lệ chia sẻ doanh thu hấp dẫn và đội
                    ngũ hỗ trợ luôn đồng hành cùng giảng viên </div>
                <div class="l_loiich_btn">
                    <a href="/dang-ki-giang-vien.html" target="_blank" class="l_dkcn l_reset">ĐĂNG KÍ CÁ NHÂN</a>
                    <a href="/dang-ki-trung-tam.html" target="_blank" class="l_dktt l_reset">ĐĂNG KÍ TRUNG TÂM</a>
                </div>
            </div>
        </div>
        <div class="l_thongtin">
            <div class="l_thongtin_item1">
                <div class="l_thongtin_img">
                    <img class="lazyload l_thongtin_img_item" src="/img/load.gif" data-src="../img/l_namtienphong.svg"
                        alt="">
                </div>
                <div class="l_thongtin_solieu">7</div>
                <div class="l_thongtin_mota">Năm tiên phong đào tạo trực tuyến</div>
            </div>
            <div class="l_thongtin_item1">
                <div class="l_thongtin_img">
                    <img class="lazyload l_thongtin_img_item" src="/img/load.gif" data-src="../img/l_diacau.svg" alt="">
                </div>
                <div class="l_thongtin_solieu">700 +</div>
                <div class="l_thongtin_mota">Khóa học online thuộc nhiều lĩnh vực</div>
            </div>
            <div class="l_thongtin_item1">
                <div class="l_thongtin_img">
                    <img class="lazyload l_thongtin_img_item" src="/img/load.gif" data-src="../img/l_sinhvien.svg"
                        alt="">
                </div>
                <div class="l_thongtin_solieu">800.000</div>
                <div class="l_thongtin_mota">Học viên tham gia</div>
            </div>
            <div class="l_thongtin_item1">
                <div class="l_thongtin_img">
                    <img class="lazyload l_thongtin_img_item" src="/img/load.gif" data-src="../img/l_ketnoi.svg" alt="">
                </div>
                <div class="l_thongtin_solieu">2000 +</div>
                <div class="l_thongtin_mota">Đại lý - đối tác trên toàn quốc</div>
            </div>
        </div>
        <div class="l_hoptac">
            <div class="l_hoptac_tieude">
                <div class="l_hoptac_center">
                    <div class="l_hr1"></div>
                    <div class="l_hoptac_tieude_item1">QUY TRÌNH HỢP TÁC</div>
                </div>
                <div class="l_hoptac_tieude_item2">Hình thức hợp tác linh hoạt, giảng viên có thể lựa chọn đăng tải khóa
                    học có sẵn hoặc phối hợp sản xuất độc quyền cùng đội ngũ của <span
                        class="l_hoptac_tieude_item2 l_color">KHÓA HỌC 365</span></div>
            </div>
            <div class="l_form-box">
                <div class="l_button-box">
                    <!-- <div id="l_btn"></div> -->
                    <button type="button" class="l_toggle-btn l_active_btn" onclick="l_phanphoi()" id="l_color1">Hợp tác phân phối
                        khóa học</button>
                    <button type="button" class="l_toggle-btn" onclick="l_sanxuat()" id="l_color2">Hợp tác sản xuất khóa
                        học</button>
                </div>
                <div id="l_phanphoi" class="l_group1 l_animate">
                    <div class="l_group1_item1">
                        <div class="l_group1_relative">
                            <img class="lazyload l_group1_img" src="/img/load.gif" data-src="../img/l_img_hoptac.png"
                                alt="">
                            <div class="l_group1_number">
                                1
                            </div>
                        </div>
                        <div class="l_group1_title">
                            Gửi outline và video demo khóa học
                        </div>
                    </div>
                    <div class="l_group1_item1">
                        <div class="l_group1_relative">
                            <img class="lazyload l_group1_img" src="/img/load.gif" data-src="../img/v_chokiemduyet.png"
                                alt="">
                            <div class="l_group1_number">
                                2
                            </div>
                        </div>
                        <div class="l_group1_title">
                            Chờ kiểm tra chất lượng khóa học
                        </div>
                    </div>
                    <div class="l_group1_item1">
                        <div class="l_group1_relative">
                            <img class="lazyload l_group1_img" src="/img/load.gif" data-src="../img/v_kihopdong.png"
                                alt="">
                            <div class="l_group1_number">
                                3
                            </div>
                        </div>
                        <div class="l_group1_title">
                            Ký hợp đồng hợp tác
                        </div>
                    </div>
                    <div class="l_group1_item1">
                        <div class="l_group1_relative">
                            <img class="lazyload l_group1_img" src="/img/load.gif" data-src="../img/v_ramatkhoahoc.png"
                                alt="">
                            <div class="l_group1_number">
                                4
                            </div>
                        </div>
                        <div class="l_group1_title">
                            Ra mắt khóa học
                        </div>
                    </div>
                    <div class="l_group1_item1">
                        <div class="l_group1_relative">
                            <img class="lazyload l_group1_img" src="/img/load.gif" data-src="../img/v_hotrodoanhthu.png"
                                alt="">
                            <div class="l_group1_number">
                                5
                            </div>
                        </div>
                        <div class="l_group1_title">
                            Hỗ trợ học viên và chia sẻ doanh thu
                        </div>
                    </div>
                    <div class="l_hoptac_btn">
                        <a href="/dang-ki-giang-vien.html">
                            <div class="l_dkcn">ĐĂNG KÍ CÁ NHÂN</div>
                        </a>
                        <a href="/dang-ki-trung-tam.html">
                            <div class="l_dktt">ĐĂNG KÍ TRUNG TÂM</div>
                        </a>
                    </div>
                </div>
                <div id="l_sanxuat" class="l_group2 l_animate">
                    <div class="l_group1_item1">
                        <div class="l_group1_relative">
                            <img class="lazyload l_group1_img" src="/img/load.gif" data-src="../img/l_img_hoptac.png"
                                alt="">
                            <div class="l_group1_number">
                                1
                            </div>
                        </div>
                        <div class="l_group1_title">
                            Trao đổi thông tin thống nhất
                        </div>
                    </div>
                    <div class="l_group1_item1">
                        <div class="l_group1_relative">
                            <img class="lazyload l_group1_img" src="/img/load.gif" data-src="../img/v_kihopdong.png"
                                alt="">
                            <div class="l_group1_number">
                                2
                            </div>
                        </div>
                        <div class="l_group1_title">
                            Ký hợp đồng hợp tác
                        </div>
                    </div>
                    <div class="l_group1_item1">
                        <div class="l_group1_relative">
                            <img class="lazyload l_group1_img" src="/img/load.gif" data-src="../img/v_xaydungnoidungbaigiang.png"
                                alt="">
                            <div class="l_group1_number">
                                3
                            </div>
                        </div>
                        <div class="l_group1_title">
                            Xây dựng nội dung bài giảng
                        </div>
                    </div>
                    <div class="l_group1_item1">
                        <div class="l_group1_relative">
                            <img class="lazyload l_group1_img" src="/img/load.gif" data-src="../img/v_quaybientapkhoahoc.png"
                                alt="">
                            <div class="l_group1_number">
                                4
                            </div>
                        </div>
                        <div class="l_group1_title">
                            Quay và biên tập khóa học
                        </div>
                    </div>
                    <div class="l_group1_item1">
                        <div class="l_group1_relative">
                            <img class="lazyload l_group1_img" src="/img/load.gif" data-src="../img/v_ramatkhoahoc.png"
                                alt="">
                            <div class="l_group1_number">
                                5
                            </div>
                        </div>
                        <div class="l_group1_title">
                            Ra mắt khóa học
                        </div>
                    </div>
                    <div class="l_group1_item1">
                        <div class="l_group1_relative">
                            <img class="lazyload l_group1_img" src="/img/load.gif" data-src="../img/v_hotrodoanhthu2.png"
                                alt="">
                            <div class="l_group1_number">
                                6
                            </div>
                        </div>
                        <div class="l_group1_title">
                            Hỗ trợ học viên và chia sẻ doanh thu
                        </div>
                    </div>
                    <div class="l_hoptac_btn">
                        <a href="/dang-ki-giang-vien.html" target="_blank" class="l_dkcn">ĐĂNG KÍ CÁ NHÂN</a>
                        <a href="/dang-ki-trung-tam.html" target="_blank" class="l_dktt">ĐĂNG KÍ TRUNG TÂM</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="l_hotro">
            <div class="l_hoptac_tieude">
                <div class="l_hoptac_center">
                    <div class="l_hr1"></div>
                    <div class="l_hoptac_tieude_item1">ĐỘI NGŨ HỖ TRỢ</div>
                </div>
                <div class="l_hoptac_tieude_item2 l_center">Luôn đồng hành cùng giảng viên trong suốt quá trình hợp tác.
                </div>
            </div>
            <div class="l_hoptac_flex">
                <div class="l_hoptac_item">
                    <div class="l_hoptac_item1">
                        <img class="lazyload l_hoptac_img" src="/img/load.gif" data-src="../img/l_img_nd.png"
                            alt="loading...">
                    </div>
                    <div class="l_hoptac_item2">
                        Hỗ trợ nội dung
                    </div>
                    <div class="l_hoptac_item3">
                        Cùng xây dựng nội dung, kịch bản khóa học và chuẩn bị học liệu.
                    </div>
                </div>
                <div class="l_hoptac_item">
                    <div class="l_hoptac_item1">
                        <img class="lazyload l_hoptac_img" src="/img/load.gif" data-src="../img/l_img_nd.png"
                            alt="loading...">
                    </div>
                    <div class="l_hoptac_item2">
                        Hỗ trợ nội dung
                    </div>
                    <div class="l_hoptac_item3">
                        Cùng xây dựng nội dung, kịch bản khóa học và chuẩn bị học liệu.
                    </div>
                </div>
            </div>
        </div>
        <div class="l_hotro l_hinhanh_padding">
            <div class="l_hinhanh_center">
                <div class="l_hr1"></div>
                <div class="l_hoptac_tieude_item1">THƯ VIÊN HÌNH ẢNH</div>
            </div>
            <div class="l_hinhanh">
                <div class="l_hinhanh_left">
                    <iframe class="l_hoptac_img" width="1264" height="270" src="https://www.youtube.com/embed/mDF9bmkPT-Q" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="l_hinhanh_right">
                    <img class="lazyload l_hinhanh_item" src="/img/load.gif" data-src="../img/l_Rectangle.png" alt="">
                    <img class="lazyload l_hinhanh_item" src="/img/load.gif" data-src="../img/l_Rectangle.png" alt="">
                    <img class="lazyload l_hinhanh_item" src="/img/load.gif" data-src="../img/l_Rectangle.png" alt="">
                    <img class="lazyload l_hinhanh_item" src="/img/load.gif" data-src="../img/l_Rectangle.png" alt="">
                </div>
            </div>
        </div>
        <div class="l_hotro l_giangvien">
            <div class="l_giangvien_center">
                <div class="l_hr1"></div>
                <div class="l_hoptac_tieude_item1">GIẢNG VIÊN NÓI VỀ CHÚNG TÔI</div>
            </div>
            <div class="l_kn_item">
                Kinh nghiệm và kiến thức của giảng viên chính là nguồn cảm hứng cho <span class="l_kn_item l_color">Khoá
                    Học 365</span>
            </div>
            <div class="l_giangvien_item">
                <div class="l_giangvien_item1">
                    <img class="lazyload l_el_img" src="/img/load.gif" data-src="../img/l_el_quotes.svg" alt="icon">
                    <div class="l_giangvien_text">Mình theo học khóa dạy phát âm tiếng Anh căn bản giọng Mỹ của cô Lan
                        Bercu. Đây là một khóa học vô cùng bổ ích, mình cảm thấy tiến bộ rất nhiều sau khi luyện tập với
                        phương pháp của cô. Cảm ơn cô rất nhiều ạ.</div>
                    <img class="lazyload l_giangvien_avatar" src="/img/load.gif" data-src="../img/l_avartar_gt.png"
                        alt="">
                    <div class="l_giangvien_name">Nguyễn Thu Huyền</div>
                    <div class="l_giangvien_school">Sinh viên Đại Học Hà Nội</div>
                </div>
                <div class="l_giangvien_item1">
                    <img class="lazyload l_el_img" src="/img/load.gif" data-src="../img/l_el_quotes.svg" alt="icon">
                    <div class="l_giangvien_text">Mình theo học khóa dạy phát âm tiếng Anh căn bản giọng Mỹ của cô Lan
                        Bercu. Đây là một khóa học vô cùng bổ ích, mình cảm thấy tiến bộ rất nhiều sau khi luyện tập với
                        phương pháp của cô. Cảm ơn cô rất nhiều ạ.</div>
                    <img class="lazyload l_giangvien_avatar" src="/img/load.gif" data-src="../img/l_avartar_gt.png"
                        alt="">
                    <div class="l_giangvien_name">Nguyễn Thu Huyền</div>
                    <div class="l_giangvien_school">Sinh viên Đại Học Hà Nội</div>
                </div>
                <div class="l_giangvien_item1">
                    <img class="lazyload l_el_img" src="/img/load.gif" data-src="../img/l_el_quotes.svg" alt="icon">
                    <div class="l_giangvien_text">Mình theo học khóa dạy phát âm tiếng Anh căn bản giọng Mỹ của cô Lan
                        Bercu. Đây là một khóa học vô cùng bổ ích, mình cảm thấy tiến bộ rất nhiều sau khi luyện tập với
                        phương pháp của cô. Cảm ơn cô rất nhiều ạ.</div>
                    <img class="lazyload l_giangvien_avatar" src="/img/load.gif" data-src="../img/l_avartar_gt.png"
                        alt="">
                    <div class="l_giangvien_name">Nguyễn Thu Huyền</div>
                    <div class="l_giangvien_school">Sinh viên Đại Học Hà Nội</div>
                </div>
                <div class="l_giangvien_item1">
                    <img class="lazyload l_el_img" src="/img/load.gif" data-src="../img/l_el_quotes.svg" alt="icon">
                    <div class="l_giangvien_text">Mình theo học khóa dạy phát âm tiếng Anh căn bản giọng Mỹ của cô Lan
                        Bercu. Đây là một khóa học vô cùng bổ ích, mình cảm thấy tiến bộ rất nhiều sau khi luyện tập với
                        phương pháp của cô. Cảm ơn cô rất nhiều ạ.</div>
                    <img class="lazyload l_giangvien_avatar" src="/img/load.gif" data-src="../img/l_avartar_gt.png"
                        alt="">
                    <div class="l_giangvien_name">Nguyễn Thu Huyền</div>
                    <div class="l_giangvien_school">Sinh viên Đại Học Hà Nội</div>
                </div>
                <div class="l_giangvien_item1">
                    <img class="lazyload l_el_img" src="/img/load.gif" data-src="../img/l_el_quotes.svg" alt="icon">
                    <div class="l_giangvien_text">Mình theo học khóa dạy phát âm tiếng Anh căn bản giọng Mỹ của cô Lan
                        Bercu. Đây là một khóa học vô cùng bổ ích, mình cảm thấy tiến bộ rất nhiều sau khi luyện tập với
                        phương pháp của cô. Cảm ơn cô rất nhiều ạ.</div>
                    <img class="lazyload l_giangvien_avatar" src="/img/load.gif" data-src="../img/l_avartar_gt.png"
                        alt="">
                    <div class="l_giangvien_name">Nguyễn Thu Huyền</div>
                    <div class="l_giangvien_school">Sinh viên Đại Học Hà Nội</div>
                </div>
            </div>
        </div>
        <div class="l_hotro l_dangkyngay">
            <div class="l_dangkyngay_center">
                <div class="l_hr1"></div>
                <div class="l_hoptac_tieude_item1">ĐĂNG KÝ NGAY</div>
            </div>
            <div class="l_dk_item">
                Để trở thành giảng viên cùng <span class="l_dk_item l_color">Khoá Học 365</span>
            </div>
            <div class="l_dangkyngay_item1">
                <div class="l_dangkyngay_img">
                    <img class="lazyload " src="/img/load.gif" data-src="../img/l_Rectangle 573.png" alt="loading...">
                </div>
                <div class="l_dangkyngay_item2">
                    <div class="l_dangkyngay_text">
                        Quy trình đăng ký đơn giản. Sau khi giảng viên điền biểu mẫu đăng ký, đội ngũ <span
                            class="l_dangkyngay_text l_color">KHÓA HỌC 365</span> sẽ liên hệ lại trong vòng 05 ngày làm
                        việc.
                    </div>
                    <div class="l_dangkyngay_btn">
                        <a href="/dang-ki-giang-vien.html" class="l_bmcn">ĐIỀN BIỂU MẪU CÁ NHÂN</a>
                        <a href="/dang-ki-trung-tam.html" class="l_bmtt">ĐIỀN BIỂU MẪU TRUNG TÂM</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- end:content -->
    <!-- footer -->
    <?
    include "../includes/h_inc_footer.php";
    ?>
    <!-- end:footer -->
</body>
<script src="../js/jquery.js?v=<?=$version?>"></script>
<script src="../js/slick.min.js?v=<?=$version?>"></script>
<script>
console.log($("#l_body").css("width"));
var arr = $("#l_body").css("width").split('px');
console.log(arr[0]);
if (arr[0] < 1365) {
    i = 2;
} else {
    i = 3;
}
$('.l_giangvien_item').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    dots: true,
    focusOnSelect: true,

    pauseOnHover: true,

    responsive: [{
            breakpoint: 1365,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
    ]
});
// $('a[data-slide]').click(function(e) {
//     e.preventDefault();
//     var slideno = $(this).data('slide');
//     $('.l_giangvien_item').slick('slickGoTo', slideno - 1);
// });
var x = document.getElementById("l_phanphoi");
var y = document.getElementById("l_sanxuat");
var z = document.getElementById("l_btn");

function l_phanphoi() {
    x.style.display = "block";
    y.style.display = "none";
    document.getElementById('l_color1').style.color = "white";
    document.getElementById('l_color2').style.color = "#000";
    document.getElementById('l_color1').style.background = "#1b6aab";
    document.getElementById('l_color2').style.background = "#f2f2f2";
    // z.style.left //= "0";
}

function l_sanxuat() {
    x.style.display = "none";
    y.style.display = "block";
    document.getElementById('l_color2').style.color = "white";
    document.getElementById('l_color1').style.color = "#000";
    document.getElementById('l_color1').style.background = "#f2f2f2";
    document.getElementById('l_color2').style.background = "#1b6aab";
    // z.style.left = "50%";
}
</script>
<script src="../js/bootstrap.min.js?v=<?=$version?>"></script>
<script src="../js//jquery.js?v=<?=$version?>"></script>
<script src="../js//slick.min.js?v=<?=$version?>"></script>

</html>