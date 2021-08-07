$(document).ready(function(){
    $(".v_del2").click(function() {
        $("#auto-online").css('display', 'none');
        $("#auto-offline").hide();
        $("#auto-city").hide();
        $(".v_search_city").hide();
    });
    $("body").click(function() {
        // if ($("#auto-online").css('display') == 'block' && event.target.id != 'keyword1') {
        //     if (($("#"+event.target.id).parents('#auto-online').length == 0 || $("."+event.target.className).parents('#auto-online').length == 0) && event.target.id != 'auto-online') {
        //         $("#auto-online").hide();
        //     }
        // }
    });
    $('#hoc-offline').on('click', function() {
        $('#search-offline').css("display", "inline-block");
        $('#search-online').css("display", "none");
        $('#hoc-online').removeClass("activeli");
        $('#hoc-offline').addClass("activeli");
        $('#auto-online').css("display", "none");
        $('#auto-offline').css("display", "none");
    });
    $('#hoc-online').on('click', function() {
        $(".v_search_city").hide();
        $('#search-offline').css("display", "none");
        $('#search-online').css("display", "inline-block");
        $('#hoc-online').addClass("activeli");
        $('#hoc-offline').removeClass("activeli");
        $('#auto-city').css("display", "none");
        $('#auto-online').css("display", "none");
        $('#auto-offline').css("display", "none");
    });

    $('#keyword1').keyup(function(event) {
        event.preventDefault();
        $('#auto-online').css("display", "block");
        $('#auto-offline').css("display", "none");
    });
    $('#keyword1').focus(function(event) {
        event.preventDefault();
        $('#auto-online').css("display", "block");
        $('#auto-offline').css("display", "none");
    });
    $('#keyword2').keyup(function(event) {
        event.preventDefault();
        $('#auto-offline').css("display", "block");
        $('#auto-online').css("display", "none");
        $('#auto-city').css("display", "none");
    });
    $('#keyword2').focus(function(event) {
        $(".v_search_city").hide();
        event.preventDefault();
        $('#auto-offline').css("display", "block");
        $('#auto-online').css("display", "none");
        $('#auto-city').css("display", "none");
    });

    if ($('#keyword2') == '') {
        // keyup select-city
        $('#auto-city').keyup(function(event) {
            event.preventDefault();
            $('#auto-city').css("display", "block");
            $('#auto-offline').css("display", "none");
        });
        $('#auto-city').focus(function(event) {
            event.preventDefault();
            $('#auto-city').css("display", "block");
            $('#auto-offline').css("display", "none");
        });
    } else {
        // keyup select
        $('#auto-city').keyup(function(event) {
            event.preventDefault();
            $('#auto-offline').css("display", "block");
            $('#auto-city').css("display", "none");
        });
        $('#auto-city').focus(function(event) {
            event.preventDefault();
            $('#auto-offline').css("display", "block");
            $('#auto-city').css("display", "none");
        });
    }

    $('.autoclick').on('click', function() {
        if ($('#keyword2') == '') {
            $('#auto-offline').css("display", "block");
            $('#auto-city').css("display", "none");
        } else {
            $('#auto-city').css("display", "block");
            $('#auto-offline').css("display", "none");
        }
    });
    $('#keyword3').on('click', function() {
        if ($('#keyword2') == '') {
            $('#auto-offline').css("display", "none");
            $('#auto-city').css("display", "block");
            $('.v_search_city').show();
        } else {
            $('#auto-city').css("display", "block");
            $('.v_search_city').show();
            $('#auto-offline').css("display", "none");
        }
    });
});
function popuplogin() {
    var usermail = $('#usermail').val();
    var userpass = $('#userpass').val();
    if (usermail == '') {
        document.getElementById('error1').innerHTML = 'Hãy nhập Email !';
        return false;
    } else {
        document.getElementById('error1').style.display = "none";
    }
    if (userpass == '') {
        document.getElementById('error2').innerHTML =
        'Hãy nhập Mật khẩu !';
        return false;
    } else {
        document.getElementById('error2').style.display = "none";
    }
    $.ajax({
        url: "../ajax/h_ajax_popup_signin.php",
        type: "POST",
        data: {
            usermail: usermail,
            userpass: userpass,
            type: $("#choose_login_input").val()
        },
        dataType: 'json',
        success: function(data) {
            if (data.result == 0){
                window.location.href = "/xac-thuc-tai-khoan.html";
            }else if(data.result == 2){
                $('#error_ajax1').html(data.msg);
            }else{
                location.reload();
            }
        }
    });
    return false;
}

function popuplogin2() {
    var usermail = $('#usermail').val();
    var userpass = $('#userpass').val();
    if (usermail == '') {
        document.getElementById('error1').innerHTML = 'Hãy nhập Email !';
        return false;
    } else {
        document.getElementById('error1').style.display = "none";
    }
    if (userpass == '') {
        document.getElementById('error2').innerHTML =
        'Hãy nhập Mật khẩu !';
        return false;
    } else {
        document.getElementById('error2').style.display = "none";
    }
    $.ajax({
        url: "../ajax/h_ajax_popup_signin.php",
        type: "POST",
        data: {
            usermail: usermail,
            userpass: userpass,
            type: 1
        },
        dataType: 'json',
        success: function(data) {
            if (data.result == 0){
                window.location.href = "/xac-thuc-tai-khoan.html";
            }else if(data.result == 2){
                $('#error_ajax1').html(data.msg);
            }else{
                location.reload();
            }
        }
    });
    return false;
}


function v_save_course(e) {
    if (document.cookie.indexOf('user_id') == -1) {
        $("#modal-login").modal("show");
    }else{
        var a = $(e).children('img');
        var course_id = $(e).val();
        $.ajax({
            url: '../ajax/v_student_save_center.php',
            type: 'GET',
            dataType: 'json',
            data: {
                course_id: course_id,
            },
            success: function (data) {
                if (data.type == 1) {
                    $(".v_save"+course_id).attr('src','../img/heart-yellow2.svg');
                }else if (data.type == 0) {
                    $(".v_save"+course_id).attr('src','../img/image/wpf_like (3).svg');
                }
            },
            error: function () {
                alert("Có lỗi xảy ra. Vui lòng thử lại");
            }
        });
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
    text = text.replace(/( )/g, '-');
    text = text.toLowerCase();
    return text;
}


function searchSubmitOFF() {
    if ($("#keyword3").val() == "" && $("#keyword2").val() == "") {
        alert("Vui lòng nhập thông tin cần tìm kiếm");
        return false;
    }else{
        if ($("#keyword3").val() != "") {
            var li = $("#ul-city").children();
            var city = 0;
            for (var i = 0; i < li.length; i++) {
                if ($("#keyword3").val() != li[i].textContent) {
                    city++;
                }
            }

            if (city ==  li.length) {
                alert("Vui lòng điển đúng tên tỉnh, thành phố");
                return false;
            }
        }
    }
}

function searchSubmitON() {
    if ($("#keyword1").val() == "") {
        alert("Vui lòng nhập thông tin cần tìm kiếm");
        return false;
    }
}

function v_search(n,m){
    var filter = changeSlug($("#keyword"+n).val());
    var li = $("#ul-"+m).children();
    for (var i = 0; i < li.length; i++) {
        var txtValue = li[i].textContent;
        txtValue = changeSlug(txtValue);
        if (txtValue.indexOf(filter) > -1) {
            li[i].style.display = "";
        }else{
            li[i].style.display = "none";
        }
    }

    var liRight = $(".ul-autoright").children();
    for (var i = 0; i < liRight.length; i++) {
        var txtValue = liRight[i].textContent;
        txtValue = changeSlug(txtValue);
        if (txtValue.indexOf(filter) > -1) {
            liRight[i].style.display = "";
        }else{
            liRight[i].style.display = "none";
        }
    }
}

function v_onkeyup() {
    var li = $("#ul-city").children();
    var city = [];
    var filter_city = $(".v_search_city_input").val();
    for (var i = 0; i < li.length; i++) {
        var text = li[i].textContent.trim();
        text = changeSlug(text);
        city.push(text);
    }
    for (var i = 0; i < city.length; i++) {
        var txtValue = city[i];
        if (txtValue.indexOf(changeSlug(filter_city)) > -1) {
            li[i].style.display = "";
        }else{
            li[i].style.display = "none";
        }
    }
}

function v_cate(n,m){
    if (m == 2) {
      var li = $("#ul-online").children();
      $("#keyword1").val(li[n-1].textContent.trim());
  }else if (m == 1) {
      var li = $("#ul-offline").children();
      $("#keyword2").val(li[n-1].textContent.trim());
      $("#auto-offline").css('display', 'none');
      if ($("#keyword3").val() == '') {
        $(".v_search_city").show();
        $("#auto-city").css('display', 'block');
        $("#keyword3").focus();
      }
  }
}

function v_autoright1(n){
    var lioff = $("#ul-autoright-off").children();

    var lion = $("#ul-autoright-on").children();

    $("#keyword1").val(lion[n-1].textContent.trim());

    $("#keyword2").val(lioff[n-1].textContent.trim());
    $("#auto-offline").css('display', 'none');
    if ($("#keyword3").val() == '') {
        $("#keyword3").focus();
    }
}
function v_autoright2(n){
    var lioff = $("#ul-autoright-off").children();

    var lion = $("#ul-autoright-on").children();

    $("#keyword1").val(lion[n-1].textContent.trim());

    $("#keyword2").val(lioff[n-1].textContent.trim());
    $("#auto-offline").css('display', 'none');
    if ($("#keyword3").val() == '') {
        $(".v_search_city").show();
        $("#auto-city").css('display', 'block');
        $("#keyword3").focus();
    }
}
function v_search_city(n){
    $(".v_search_city").hide();
    $("#auto-city").css('display', 'none');
    $("#v_search_city_input").hide();
    if ($("#keyword2").val() == '') {
        $("#auto-offline").css('display', 'block');
        $("#keyword2").focus();
    }
    var li = $("#ul-city").children();
    $("#keyword3").val(li[n-1].textContent);
    $("#keyword2").val(lioff[n-1].textContent);
}

