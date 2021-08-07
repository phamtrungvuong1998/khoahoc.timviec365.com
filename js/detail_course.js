
$(document).ready(function() {
    $("#what-learn").on('click',function(){
        console.log($(".obj-course"));
        $('html, body').animate({ scrollTop: $(".obj-course").eq(0)[0].clientWidth }, 500)
    });
    $("#student-obj").on('click',function(){
        $('html, body').animate({ scrollTop: $(".obj-course").eq(1)[0].clientWidth }, 500)
    });
    $("#introduction").on('click',function(){
        $('html, body').animate({ scrollTop: 1500 }, 500)
    });
    $("#teach-info").on('click',function(){
        $('html, body').animate({ scrollTop: 1700 }, 500)
    });
    $("#content-learn").on('click',function(){
        $('html, body').animate({ scrollTop: 2150 }, 500)
    });


    $("#address-study").on('click',function(){
        $('html, body').animate({ scrollTop: 1700 }, 500)
    });
    $("#highlight").on('click',function(){
        $('html, body').animate({ scrollTop: 2150 }, 500)
    });


    $("#rating").on('click',function(){
        $('html, body').animate({ scrollTop: 2300 }, 500)
    });

    $("#xemthem1").on('click',function(){
        $("#content1").css('display','block');
        $("#xemthem1").css('display','none');
    });

    $("#xemthem2").on('click',function(){
        $("#content2").css('display','block');
        $("#xemthem2").css('display','none');
    });

    $("#xemthem3").on('click',function(){
        $("#xemthem3").css('display','none');
        $("#content3").css('display','block')
    });

    //Rate bai giang
    var lesson1 = document.getElementById("lesson1");
    var lesson2 = document.getElementById("lesson2");
    var lesson3 = document.getElementById("lesson3");
    var lesson4 = document.getElementById("lesson4");
    var lesson5 = document.getElementById("lesson5");
    $('.lesson1').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.lesson2').removeClass('orange');
            $('.lesson3').removeClass('orange');
            $('.lesson3').removeClass('orange');
            $('.lesson4').removeClass('orange');
            e.removeClass('orange');
            lesson1.value = 0;
            lesson2.value = 0;
            lesson3.value = 0;
            lesson4.value = 0;
            lesson5.value = 0;
        } else {
            e.addClass('orange');
            lesson1.value = 1;
        }
    });
    $('.lesson2').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.lesson1').removeClass('orange');
            $('.lesson5').removeClass('orange');
            $('.lesson3').removeClass('orange');
            $('.lesson4').removeClass('orange');
            e.removeClass('orange');
            lesson1.value = 0;
            lesson2.value = 0;
            lesson3.value = 0;
            lesson4.value = 0;
            lesson5.value = 0;
        } else {
            $('.lesson1').addClass('orange');
            e.addClass('orange');
            lesson1.value = 1;
            lesson2.value = 1;
        }
    });
    $('.lesson3').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.lesson2').removeClass('orange');
            $('.lesson1').removeClass('orange');
            $('.lesson5').removeClass('orange');
            $('.lesson4').removeClass('orange');
            e.removeClass('orange');
            lesson1.value = 0;
            lesson2.value = 0;
            lesson3.value = 0;
            lesson4.value = 0;
            lesson5.value = 0;
        } else {
            $('.lesson1').addClass('orange');
            $('.lesson2').addClass('orange');
            e.addClass('orange');
            lesson1.value = 1;
            lesson2.value = 1;
            lesson3.value = 1;
        }
    });
    $('.lesson4').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.lesson1').removeClass('orange');
            $('.lesson2').removeClass('orange');
            $('.lesson3').removeClass('orange');
            $('.lesson5').removeClass('orange');
            e.removeClass('orange');
            lesson1.value = 0;
            lesson2.value = 0;
            lesson3.value = 0;
            lesson4.value = 0;
            lesson5.value = 0;
        } else {
            $('.lesson1').addClass('orange');
            $('.lesson2').addClass('orange');
            $('.lesson3').addClass('orange');
            e.addClass('orange');
            lesson1.value = 1;
            lesson2.value = 1;
            lesson3.value = 1;
            lesson4.value = 1;
        }
    });
    $('.lesson5').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.lesson1').removeClass('orange');
            $('.lesson2').removeClass('orange');
            $('.lesson3').removeClass('orange');
            $('.lesson4').removeClass('orange');
            e.removeClass('orange');
            lesson1.value = 0;
            lesson2.value = 0;
            lesson3.value = 0;
            lesson4.value = 0;
            lesson5.value = 0;
        } else {
            $('.lesson1').addClass('orange');
            $('.lesson2').addClass('orange');
            $('.lesson3').addClass('orange');
            $('.lesson4').addClass('orange');
            e.addClass('orange');
            lesson1.value = 1;
            lesson2.value = 1;
            lesson3.value = 1;
            lesson4.value = 1;
            lesson5.value = 1;
        }
    });


    //Rate video
    var video1 = document.getElementById("video1");
    var video2 = document.getElementById("video2");
    var video3 = document.getElementById("video3");
    var video4 = document.getElementById("video4");
    var video5 = document.getElementById("video5");
    $('.video1').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.video2').removeClass('orange');
            $('.video3').removeClass('orange');
            $('.video4').removeClass('orange');
            $('.video5').removeClass('orange');
            e.removeClass('orange');
            video1.value = 0;
            video2.value = 0;
            video3.value = 0;
            video4.value = 0;
            video5.value = 0;
        } else {
            e.addClass('orange');
            video1.value = 1;
        }
    });
    $('.video2').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.video1').removeClass('orange');
            $('.video5').removeClass('orange');
            $('.video3').removeClass('orange');
            $('.video4').removeClass('orange');
            e.removeClass('orange');
            video1.value = 0;
            video2.value = 0;
            video3.value = 0;
            video4.value = 0;
            video5.value = 0;
        } else {
            $('.video1').addClass('orange');
            e.addClass('orange');
            video1.value = 1;
            video2.value = 1;
        }
    });
    $('.video3').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.video2').removeClass('orange');
            $('.video1').removeClass('orange');
            $('.video5').removeClass('orange');
            $('.video4').removeClass('orange');
            e.removeClass('orange');
            video1.value = 0;
            video2.value = 0;
            video3.value = 0;
            video4.value = 0;
            video5.value = 0;
        } else {
            $('.video1').addClass('orange');
            $('.video2').addClass('orange');
            e.addClass('orange');
            video1.value = 1;
            video2.value = 1;
            video3.value = 1;
        }
    });
    $('.video4').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.video1').removeClass('orange');
            $('.video2').removeClass('orange');
            $('.video3').removeClass('orange');
            $('.video5').removeClass('orange');
            e.removeClass('orange');
            video1.value = 0;
            video2.value = 0;
            video3.value = 0;
            video4.value = 0;
            video5.value = 0;
        } else {
            $('.video1').addClass('orange');
            $('.video2').addClass('orange');
            $('.video3').addClass('orange');
            e.addClass('orange');
            video1.value = 1;
            video2.value = 1;
            video3.value = 1;
            video4.value = 1;
        }
    });
    $('.video5').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.video1').removeClass('orange');
            $('.video2').removeClass('orange');
            $('.video3').removeClass('orange');
            $('.video4').removeClass('orange');
            e.removeClass('orange');
            video1.value = 0;
            video2.value = 0;
            video3.value = 0;
            video4.value = 0;
            video5.value = 0;
        } else {
            $('.video1').addClass('orange');
            $('.video2').addClass('orange');
            $('.video3').addClass('orange');
            $('.video4').addClass('orange');
            e.addClass('orange');
            video1.value = 1;
            video2.value = 1;
            video3.value = 1;
            video4.value = 1;
            video5.value = 1;
        }
    });

    //Rate teacher
    var teacher1 = document.getElementById("teacher1");
    var teacher2 = document.getElementById("teacher2");
    var teacher3 = document.getElementById("teacher3");
    var teacher4 = document.getElementById("teacher4");
    var teacher5 = document.getElementById("teacher5");
    $('.teacher1').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.teacher2').removeClass('orange');
            $('.teacher3').removeClass('orange');
            $('.teacher4').removeClass('orange');
            $('.teacher5').removeClass('orange');
            e.removeClass('orange');
            teacher1.value = 0;
            teacher2.value = 0;
            teacher3.value = 0;
            teacher4.value = 0;
            teacher5.value = 0;
        } else {
            e.addClass('orange');
            teacher1.value = 1;
        }
    });
    $('.teacher2').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.teacher1').removeClass('orange');
            $('.teacher5').removeClass('orange');
            $('.teacher3').removeClass('orange');
            $('.teacher4').removeClass('orange');
            e.removeClass('orange');
            teacher1.value = 0;
            teacher2.value = 0;
            teacher3.value = 0;
            teacher4.value = 0;
            teacher5.value = 0;
        } else {
            $('.teacher1').addClass('orange');
            e.addClass('orange');
            teacher1.value = 1;
            teacher2.value = 1;
        }
    });
    $('.teacher3').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.teacher2').removeClass('orange');
            $('.teacher1').removeClass('orange');
            $('.teacher5').removeClass('orange');
            $('.teacher4').removeClass('orange');
            e.removeClass('orange');
            teacher1.value = 0;
            teacher2.value = 0;
            teacher3.value = 0;
            teacher4.value = 0;
            teacher5.value = 0;
        } else {
            $('.teacher1').addClass('orange');
            $('.teacher2').addClass('orange');
            e.addClass('orange');
            teacher1.value = 1;
            teacher2.value = 1;
            teacher3.value = 1;
        }
    });
    $('.teacher4').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.teacher1').removeClass('orange');
            $('.teacher2').removeClass('orange');
            $('.teacher3').removeClass('orange');
            $('.teacher5').removeClass('orange');
            e.removeClass('orange');
            teacher1.value = 0;
            teacher2.value = 0;
            teacher3.value = 0;
            teacher4.value = 0;
            teacher5.value = 0;
        } else {
            $('.teacher1').addClass('orange');
            $('.teacher2').addClass('orange');
            $('.teacher3').addClass('orange');
            e.addClass('orange');
            teacher1.value = 1;
            teacher2.value = 1;
            teacher3.value = 1;
            teacher4.value = 1;
        }
    });
    $('.teacher5').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.teacher1').removeClass('orange');
            $('.teacher2').removeClass('orange');
            $('.teacher3').removeClass('orange');
            $('.teacher4').removeClass('orange');
            e.removeClass('orange');
            teacher1.value = 0;
            teacher2.value = 0;
            teacher3.value = 0;
            teacher4.value = 0;
            teacher5.value = 0;
        } else {
            $('.teacher1').addClass('orange');
            $('.teacher2').addClass('orange');
            $('.teacher3').addClass('orange');
            $('.teacher4').addClass('orange');
            e.addClass('orange');
            teacher1.value = 1;
            teacher2.value = 1;
            teacher3.value = 1;
            teacher4.value = 1;
            teacher5.value = 1;
        }
    });
});

  function v_like(n, m, l) {
        if (l == 0) {
            alert("Bạn phải đăng nhập mới sử dụng được chức năng này");
        } else {
            var like_id = "#like-product-" + n;
            if ($(like_id).attr("src") == '../img/image/wpf_like (3).svg') {
                $(like_id).attr({
                    "src": '../img/heart-yellow2.svg'
                });
                $.get('../ajax/v_student_save_center.php', {
                    course_offline_id: n,
                    user_student_id: m,
                    save_status: 0
                }, function(data) {});
            } else {
                $(like_id).attr({
                    "src": '../img/image/wpf_like (3).svg'
                });
                $.get('../ajax/v_student_save_center.php', {
                    course_offline_id: n,
                    user_student_id: m,
                    save_status: 1
                }, function(data) {});
            }
        }
    }

        function v_delComment(rate_id, course_id) {
        $.get("../ajax/v_del_comment.php", {
            rate_id: rate_id,
            course_id: course_id
        }, function(data) {
            var arr = data.split('v_comment_online');
            $("#list-comment").html(arr[0]);
            $("#count_comment").html(arr[1]);
            $("#v_title").append(arr[2]);
            $('.the-rate').html(arr[3]);
        });
    }

    function delrep(rep_id) {
        $.get('../ajax/v_del_rep_comment.php', {
            rep_id: rep_id,
        }, function(data) {
            $("#reply-content-" + rep_id).remove();
        });
    }