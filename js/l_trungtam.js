window.onclick = function(event) {
    if (event.target == document.getElementById('id05')) {
        document.getElementById('id05').style.display = "none";
    }
    // if (event.target == $(".l_myModal")) {
    //     document.getElementById("l_myModal").style.display = "none";
    // }
    // if (event.target == document.getElementById('l_menu')) {
    //     document.getElementById('l_menu').style.display = "none";
    // }
    if (event.target == document.getElementById('idsidebar')) {
        $("#idsidebar").animate({
            width: "0"
        }, 200, function() {
            $("#idsidebar").hide();
        });
    }
    if (event.target == document.getElementById('l_id_updatePass')) {
        $('#l_success').html('');
        document.getElementById('l_id_updatePass').style.display = "none";
    }
}
document.getElementById("l_show_menu").onclick = function() {
    if (document.getElementById('l_menu').style.display == "block") {
        $("#l_menu").animate({
            height: "0"
        }, 200, function() {
            $("#l_menu").hide();
        });
    } else {
        $("#l_menu").css({ "height": "0px" });
        $("#l_menu").animate({
            height: "200px"
        }, 200).show();
    }
}
document.getElementById("l_menu_sidebar").onclick = function() {
    // if($("#idsidebar").)
    $("#idsidebar").css({ "width": "0px" });
    $("#idsidebar").animate({
        width: "100%"
    }, 200).show();
};

$(document).ready(function() {
    $(".l_drop_down").click(function() {
        $(this).next(".dropdown-content").slideToggle(250);
    });
});

function l_close(x) {
    var a = "l_append-" + x;
    document.getElementById(a).classList.toggle("none");
}

function l_overflow_item(a, i) {
    // var text = '<div id="l_append' + a;
    $("#l_chudegiangday").before('<div id="l_append-' + a + '" class="l_append"><option vlaue="' + a + '" class="l_append_text">' + i + '</option><div onclick="l_close2(' + a + ')"><img src="../img/l_close-o.svg" alt="" class="l_append_img"></div></div>');
    document.getElementById(a).style.display = 'none';
}

function l_close2(x) {
    var a = "l_append-" + x;
    document.getElementById(a).remove();
    document.getElementById(x).style.display = 'block';
}

function l_click_chude() {
    if (document.getElementById("l_add").style.display === "block") {
        document.getElementById("l_add").style.display = "none";
    } else {
        document.getElementById("l_add").style.display = "block";
    }
}

function l_btnPassword() {

    if (document.getElementById('l_ipnPassword1').type == 'password') {
        document.getElementById('l_ipnPassword1').type = 'text';
    } else {
        document.getElementById('l_ipnPassword1').type = 'password';
    }
}

function l_ipnPasswordnew() {
    if (document.getElementById('l_ipnPasswordnew1').type == 'password') {
        document.getElementById('l_ipnPasswordnew1').type = 'text';
    } else {
        document.getElementById('l_ipnPasswordnew1').type = 'password';
    }
}

function l_retypepass() {
    if (document.getElementById('l_retypepass1').type == 'password') {
        document.getElementById('l_retypepass1').type = 'text';
    } else {
        document.getElementById('l_retypepass1').type = 'password';
    }
}



function l_close(x) {
    var a = "l_append-" + x;
    document.getElementById(a).classList.toggle("none");
}


function l_close_updatepass() {
    document.getElementById("id05").style.display = "none";
}

function l_btndanhgia(a) {
    var b = "l_hienthidanhgia" + a;

    if (document.getElementById(b).style.display == 'block') {
        document.getElementById(b).style.display = 'none';
    } else {
        document.getElementById(b).style.display = 'block';
    }
}

function l_btndanhgia1(a) {
    var b = "l_hienthidanhgia1" + a;

    if (document.getElementById(b).style.display == 'block') {
        document.getElementById(b).style.display = 'none';
    } else {
        document.getElementById(b).style.display = 'block';
    }
}

function l_chinhsua(x) {
    var y = "l_hienthi_chinhsua" + x;
    document.getElementById(y).classList.toggle('l_show');
}

function myDropdown(n) {
    a = "#myDropdown-" + n;
    $(a).slideToggle(200);
}

// Password

function l_validatePass() {
    var flag = false;
    var rePass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    var pass = document.getElementById('l_ipnPassword1').value;
    var passnew = document.getElementById('l_ipnPasswordnew1').value;
    var retypepass = document.getElementById('l_retypepass1').value;
    if (pass == '') {
        document.getElementById('l_ipnPassword1').focus();
        document.getElementById('l_errorPass1').innerHTML = 'Nhập mật khẩu';
        return false;
    } else {
        document.getElementById('l_errorPass1').innerHTML = '';
        flag = true;
    }

    if (passnew == "") {
        document.getElementById("l_errorPass2").innerHTML = "Nhập mật khẩu mới";
        document.getElementById('l_ipnPasswordnew1').focus();
        return false;
    } else if (rePass.test(passnew) == false) {
        document.getElementById("l_errorPass2").innerHTML = "Mật khẩu phải có ít nhất 1 chữ và 1 số";
        document.getElementById('l_ipnPasswordnew1').focus();
    } else if (passnew.length < 8) {
        document.getElementById("l_errorPass2").innerHTML = "Mật khẩu phải có ít nhất 8 ký tự";
        document.getElementById('l_ipnPasswordnew1').focus();
        return false;
    } else {
        document.getElementById("l_errorPass2").innerHTML = '';
        flag = true;
    }

    if (retypepass == "") {
        document.getElementById("l_errorPass3").innerHTML = "Nhập lại mật khẩu mới";
        document.getElementById('l_retypepass1').focus();
        return false;
    } else if (passnew != retypepass) {
        document.getElementById("l_errorPass3").innerHTML = "Nhập lại mật khẩu sai";
        document.getElementById('l_retypepass1').focus();
        return false;
    } else {
        document.getElementById("l_errorPass3").innerHTML = '';
        flag = true;
    }
    return flag;
}

function l_submit() {
    $('#l_success').html('');
    var flag = l_validatePass();
    if (flag == true) {
        var pass = document.getElementById('l_ipnPassword1').value;
        var passnew = document.getElementById('l_ipnPasswordnew1').value;

        var data = new FormData();
        data.append('pass', pass);
        data.append('passnew', passnew);

        $.ajax({
            url: '../ajax/l_ajax_updatePass.php',
            type: 'post',
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.result == 1) {
                    //console.log(response.message);
                    $('#l_success').html('');
                    $('#l_ipnPassword1').val('');
                    $('#l_ipnPasswordnew1').val('');
                    $('#l_retypepass1').val('');
                    $('#l_success').html(response.message);
                    // document.getElementById('l_email').innerHTML = response.message;
                } else if (response.result == 2) {
                    $('#l_errorPass1').html('');
                    $('#l_errorPass1').html(response.message);
                } else {
                    alert(response.message);
                }
            },
        });
    }
}