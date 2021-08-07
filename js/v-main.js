function v_logout2() {
    var n = confirm("Bạn có muốn đăng xuất không ?");
    if (n == true) {
        window.location.href = "../code_xu_ly/v_logout.php";
    }
}
$(document).ready(function() {
    $("body").click(function() {
        if (event.target.id != 'v_list') {
            if (event.target.id == 'quanlihocvien') {
                $("#quanlihocvien").fadeOut();
            }
        }
        
        if (event.target.parentNode.className != 'v_btn-bacham') {
            for (var i = 0; i < $(".v_btn-bacham").length; i++) {
                if ($(".v_btn-bacham")[i].nextElementSibling.style.display == "block") {
                    $(".v_btn-bacham")[i].nextElementSibling.style.display = "none";
                }
            }
        }

        if (event.target.parentNode.className != 'v_header_avatar') {
            if ($("#v_header-dropdown").css('display') == 'block') {
                $("#v_header-dropdown").slideToggle();
            }
        }

        if (event.target.id == "v_alert-rechange") {
            $("#v_alert-rechange").fadeToggle();
            $("#v_alert-content").slideToggle();
        }
    });

    $(".v_drop_down").click(function() {
        $(this).next().slideToggle("fast");
    });

    $(".v_header_avatar").click(function() {
        $("#v_header-dropdown").slideToggle();
    });

    $(".v_content-contact-1:eq(0),.v_alert-btn").click(function() {
     $("#v_alert-rechange").fadeToggle();
     $("#v_alert-content").slideToggle();
    });
});

function v_logout() {
    window.location.reload();
}

function v_popup(e) {
    $(e).next(".v_popup").toggle();  
    for (var i = 0; i < $(".v_btn-bacham").length; i++) {
        if (i != $(e).index(".v_btn-bacham")) {
            $(".v_btn-bacham").eq(i).next(".v_popup").hide();
        }
    }
}
function changeSlug(text) {
    text = text.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    text = text.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    text = text.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    text = text.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    text = text.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    text = text.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    text = text.replace(/(đ)/g, 'd');
    text = text.replace(/( )/g, '');
    text = text.toLowerCase();
    return text;
}

function v_stt(x){
    document.getElementById("v_noidungkh-23").style.order = "1";
}

function v_reply(n){
    a = "v_reply-" + n;
    if (document.getElementById(a).style.display == "block") {
        document.getElementById(a).style.display = "none";
    }else{
        document.getElementById(a).style.display = "block";
    }
}

function v_sidebar_tb(n){
    a = "#v_sidebar-tb-" + n;
    $(a).slideToggle("fast");
}
function v_sidebar_tb1(n){
    a = "#v_sidebar_tb-" + n;
    $(a).slideToggle("fast");
}

function quanlihocvien() {
    if ($("#v_wrapper").outerWidth() < 767) {
        $("#quanlihocvien").fadeIn();
    }else{
        $("#quanlihocvien").fadeIn();
    }
}


function v_stt(x){
    document.getElementById("v_noidungkh-23").style.order = "1";
}

function v_doi(n) {
    if (n == 1) {
        $("#v_doi-password").fadeOut(300,function () {
            $("#v_chi-tiet-tk").fadeIn(300);
        });
        $("#v_info1").css('borderBottom', '1px solid #1B6AAB');
        $("#v_info2").css('borderBottom', 'none');
    }else if (n == 2) {
        $("#v_chi-tiet-tk").fadeOut(300,function () {
            $("#v_doi-password").fadeIn(300);
        });
        $("#v_info1").css('borderBottom', 'none');
        $("#v_info2").css('borderBottom', '1px solid #1B6AAB');
    }
}    


function v_header_tb() {
    document.getElementById("v_header-tb").style.display = "block";
}

 function v_bacham(n) {
        a = "#v_popup-" + n;
        $(a).slideToggle("fast");
    }

// Begin: Giảng viên

// End: Giảng viên

function v_btn() {
    var x = document.activeElement.id;
    var y = document.getElementById(x);
    y.classList.toggle('v_off-menu-btn-2');
    y.classList.toggle('v_off-menu-btn-1');
    // document.getElementById(x).style.background = "rgba(248, 153, 35, 1)";
    // document.getElementById(x).style.fontWeight = "500";
}

function them() {
    var x = document.activeElement.id;
    a = x.split("_");
    b = "s-" + a[1];
    if (document.getElementById(b).style.display == "block") {
        document.getElementById(b).style.display = "none";
    }else{
        document.getElementById(b).style.display = "block";
    }
}

function them() {
    var x = document.activeElement.id;
    a = x.split("_");
    b = "s-" + a[1];
    if (document.getElementById(b).style.display == "block") {
        document.getElementById(b).style.display = "none";
    }else{
        document.getElementById(b).style.display = "block";
    }
}

function v_none(x) {
    b = "v_ul-" + x;
    y = document.getElementById(b);
    y.style.display = "block";
}

function v_add(x) {
    b = "v_ul-" + x;
    c = "v_ul-tb-" + x;
    if (document.getElementById(b).style.display == "block") {
        document.getElementById(b).style.display = "none";
    }else{
        document.getElementById(b).style.display = "block";
    }

    if (document.getElementById(c).style.display == "block") {
        document.getElementById(c).style.display = "none";
    }else{
        document.getElementById(c).style.display = "block";
    }
}

function btn_ul() {
    if (document.getElementById("v-ul").style.display == "block") {
        document.getElementById("v-ul").style.display = "none";
    }else{
        document.getElementById("v-ul").style.display = "block";
    }
}

function v_li(x) {
    a = "v_li-" + x;
    console.log(a);
    y = document.getElementById(a).value;
    z = document.getElementById("demo").innerHTML;
    b = z + y;
    document.getElementById("demo").innerHTML = b;
}

function v_edit_pass(){
    document.getElementById("v_content-btn-detail").style.display = "block";
}

function v_dong_edit_pass(){
    document.getElementById("v_content-btn-detail").style.display = "none";
}

function v_them_chu_de(){
    if (document.getElementById("v_them-theme").style.display == "none") {
        document.getElementById("v_them-theme").style.display = "block";
    }else{
        document.getElementById("v_them-theme").style.display = "none";
    }
}

function v_xem_pass(x){
    a = "v_xem-pass-" + x;
    if (document.getElementById(a).type == "text") {
        document.getElementById(a).type = "password";
    }else{
        document.getElementById(a).type = "text";
    }
}

function v_them_theme(x){
    a = "v_p-" + x;
    b = document.getElementById(a).innerHTML + '<img onclick="v_close_theme(' + x + ')" src="../img/close-theme.svg" alt="Ảnh lỗi">';
    y = "v_theme-detail-" + x;
    document.getElementById(y).style.display = "block";
    document.getElementById("v_theme").style.display = "flex";
    document.getElementById(y).style.background = "#F2F2F2";
    document.getElementById(y).innerHTML = b;
}

function v_close_theme(y){
    x = "v_theme-detail-" + y;
    document.getElementById(x).style.display = "none";
}
