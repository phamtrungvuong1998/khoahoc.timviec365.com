$(document).ready(function() {
    $("#xemthem1").on('click', function() {
        $(".content1").css('display', 'block');
        $("#xemthem1").css('display', 'none');
    });
    $("#xemchitiet").on('click', function() {
        $("#bottomcourse").css('display', 'block');
        $("#xemchitiet").css('visibility', 'hidden');
    });
    $("#donglai").on('click', function() {
        $("#bottomcourse").css('display', 'none');
        $("#xemchitiet").css('visibility', 'inherit');
    });


    //teacher
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

    //Tư vấn xếp lớp
    var place_class1 = document.getElementById("place_class1");
    var place_class2 = document.getElementById("place_class2");
    var place_class3 = document.getElementById("place_class3");
    var place_class4 = document.getElementById("place_class4");
    var place_class5 = document.getElementById("place_class5");
    $('.place_class1').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.place_class2').removeClass('orange');
            $('.place_class3').removeClass('orange');
            $('.place_class4').removeClass('orange');
            $('.place_class5').removeClass('orange');
            e.removeClass('orange');
            place_class1.value = 0;
            place_class2.value = 0;
            place_class3.value = 0;
            place_class4.value = 0;
            place_class5.value = 0;
        } else {
            e.addClass('orange');
            place_class1.value = 1;
        }
    });
    $('.place_class2').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.place_class1').removeClass('orange');
            $('.place_class5').removeClass('orange');
            $('.place_class3').removeClass('orange');
            $('.place_class4').removeClass('orange');
            e.removeClass('orange');
            place_class1.value = 0;
            place_class2.value = 0;
            place_class3.value = 0;
            place_class4.value = 0;
            place_class5.value = 0;
        } else {
            $('.place_class1').addClass('orange');
            e.addClass('orange');
            place_class1.value = 1;
            place_class2.value = 1;
        }
    });
    $('.place_class3').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.place_class2').removeClass('orange');
            $('.place_class1').removeClass('orange');
            $('.place_class5').removeClass('orange');
            $('.place_class4').removeClass('orange');
            e.removeClass('orange');
            place_class1.value = 0;
            place_class2.value = 0;
            place_class3.value = 0;
            place_class4.value = 0;
            place_class5.value = 0;
        } else {
            $('.place_class1').addClass('orange');
            $('.place_class2').addClass('orange');
            e.addClass('orange');
            place_class1.value = 1;
            place_class2.value = 1;
            place_class3.value = 1;
        }
    });
    $('.place_class4').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.place_class1').removeClass('orange');
            $('.place_class2').removeClass('orange');
            $('.place_class3').removeClass('orange');
            $('.place_class5').removeClass('orange');
            e.removeClass('orange');
            place_class1.value = 0;
            place_class2.value = 0;
            place_class3.value = 0;
            place_class4.value = 0;
            place_class5.value = 0;
        } else {
            $('.place_class1').addClass('orange');
            $('.place_class2').addClass('orange');
            $('.place_class3').addClass('orange');
            e.addClass('orange');
            place_class1.value = 1;
            place_class2.value = 1;
            place_class3.value = 1;
            place_class4.value = 1;
        }
    });
    $('.place_class5').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.place_class1').removeClass('orange');
            $('.place_class2').removeClass('orange');
            $('.place_class3').removeClass('orange');
            $('.place_class4').removeClass('orange');
            e.removeClass('orange');
            place_class1.value = 0;
            place_class2.value = 0;
            place_class3.value = 0;
            place_class4.value = 0;
            place_class5.value = 0;
        } else {
            $('.place_class1').addClass('orange');
            $('.place_class2').addClass('orange');
            $('.place_class3').addClass('orange');
            $('.place_class4').addClass('orange');
            e.addClass('orange');
            place_class1.value = 1;
            place_class2.value = 1;
            place_class3.value = 1;
            place_class4.value = 1;
            place_class5.value = 1;
        }
    });

    //Cơ sở vật chất
    var infrastructure1 = document.getElementById("infrastructure1");
    var infrastructure2 = document.getElementById("infrastructure2");
    var infrastructure3 = document.getElementById("infrastructure3");
    var infrastructure4 = document.getElementById("infrastructure4");
    var infrastructure5 = document.getElementById("infrastructure5");
    $('.infrastructure1').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.infrastructure2').removeClass('orange');
            $('.infrastructure3').removeClass('orange');
            $('.infrastructure4').removeClass('orange');
            $('.infrastructure5').removeClass('orange');
            e.removeClass('orange');
            infrastructure1.value = 0;
            infrastructure2.value = 0;
            infrastructure3.value = 0;
            infrastructure4.value = 0;
            infrastructure5.value = 0;
        } else {
            e.addClass('orange');
            infrastructure1.value = 1;
        }
    });
    $('.infrastructure2').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.infrastructure1').removeClass('orange');
            $('.infrastructure5').removeClass('orange');
            $('.infrastructure3').removeClass('orange');
            $('.infrastructure4').removeClass('orange');
            e.removeClass('orange');
            infrastructure1.value = 0;
            infrastructure2.value = 0;
            infrastructure3.value = 0;
            infrastructure4.value = 0;
            infrastructure5.value = 0;
        } else {
            $('.infrastructure1').addClass('orange');
            e.addClass('orange');
            infrastructure1.value = 1;
            infrastructure2.value = 1;
        }
    });
    $('.infrastructure3').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.infrastructure2').removeClass('orange');
            $('.infrastructure1').removeClass('orange');
            $('.infrastructure5').removeClass('orange');
            $('.infrastructure4').removeClass('orange');
            e.removeClass('orange');
            infrastructure1.value = 0;
            infrastructure2.value = 0;
            infrastructure3.value = 0;
            infrastructure4.value = 0;
            infrastructure5.value = 0;
        } else {
            $('.infrastructure1').addClass('orange');
            $('.infrastructure2').addClass('orange');
            e.addClass('orange');
            infrastructure1.value = 1;
            infrastructure2.value = 1;
            infrastructure3.value = 1;
        }
    });
    $('.infrastructure4').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.infrastructure1').removeClass('orange');
            $('.infrastructure2').removeClass('orange');
            $('.infrastructure3').removeClass('orange');
            $('.infrastructure5').removeClass('orange');
            e.removeClass('orange');
            infrastructure1.value = 0;
            infrastructure2.value = 0;
            infrastructure3.value = 0;
            infrastructure4.value = 0;
            infrastructure5.value = 0;
        } else {
            $('.infrastructure1').addClass('orange');
            $('.infrastructure2').addClass('orange');
            $('.infrastructure3').addClass('orange');
            e.addClass('orange');
            infrastructure1.value = 1;
            infrastructure2.value = 1;
            infrastructure3.value = 1;
            infrastructure4.value = 1;
        }
    });
    $('.infrastructure5').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.infrastructure1').removeClass('orange');
            $('.infrastructure2').removeClass('orange');
            $('.infrastructure3').removeClass('orange');
            $('.infrastructure4').removeClass('orange');
            e.removeClass('orange');
            infrastructure1.value = 0;
            infrastructure2.value = 0;
            infrastructure3.value = 0;
            infrastructure4.value = 0;
            infrastructure5.value = 0;
        } else {
            $('.infrastructure1').addClass('orange');
            $('.infrastructure2').addClass('orange');
            $('.infrastructure3').addClass('orange');
            $('.infrastructure4').addClass('orange');
            e.addClass('orange');
            infrastructure1.value = 1;
            infrastructure2.value = 1;
            infrastructure3.value = 1;
            infrastructure4.value = 1;
            infrastructure5.value = 1;
        }
    });

    //Số lượng học viên
    var student_number1 = document.getElementById("student_number1");
    var student_number2 = document.getElementById("student_number2");
    var student_number3 = document.getElementById("student_number3");
    var student_number4 = document.getElementById("student_number4");
    var student_number5 = document.getElementById("student_number5");
    $('.student_number1').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.student_number2').removeClass('orange');
            $('.student_number3').removeClass('orange');
            $('.student_number4').removeClass('orange');
            $('.student_number5').removeClass('orange');
            e.removeClass('orange');
            student_number1.value = 0;
            student_number2.value = 0;
            student_number3.value = 0;
            student_number4.value = 0;
            student_number5.value = 0;
        } else {
            e.addClass('orange');
            student_number1.value = 1;
        }
    });
    $('.student_number2').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.student_number1').removeClass('orange');
            $('.student_number5').removeClass('orange');
            $('.student_number3').removeClass('orange');
            $('.student_number4').removeClass('orange');
            e.removeClass('orange');
            student_number1.value = 0;
            student_number2.value = 0;
            student_number3.value = 0;
            student_number4.value = 0;
            student_number5.value = 0;
        } else {
            $('.student_number1').addClass('orange');
            e.addClass('orange');
            student_number1.value = 1;
            student_number2.value = 1;
        }
    });
    $('.student_number3').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.student_number2').removeClass('orange');
            $('.student_number1').removeClass('orange');
            $('.student_number5').removeClass('orange');
            $('.student_number4').removeClass('orange');
            e.removeClass('orange');
            student_number1.value = 0;
            student_number2.value = 0;
            student_number3.value = 0;
            student_number4.value = 0;
            student_number5.value = 0;
        } else {
            $('.student_number1').addClass('orange');
            $('.student_number2').addClass('orange');
            e.addClass('orange');
            student_number1.value = 1;
            student_number2.value = 1;
            student_number3.value = 1;
        }
    });
    $('.student_number4').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.student_number1').removeClass('orange');
            $('.student_number2').removeClass('orange');
            $('.student_number3').removeClass('orange');
            $('.student_number5').removeClass('orange');
            e.removeClass('orange');
            student_number1.value = 0;
            student_number2.value = 0;
            student_number3.value = 0;
            student_number4.value = 0;
            student_number5.value = 0;
        } else {
            $('.student_number1').addClass('orange');
            $('.student_number2').addClass('orange');
            $('.student_number3').addClass('orange');
            e.addClass('orange');
            student_number1.value = 1;
            student_number2.value = 1;
            student_number3.value = 1;
            student_number4.value = 1;
        }
    });
    $('.student_number5').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.student_number1').removeClass('orange');
            $('.student_number2').removeClass('orange');
            $('.student_number3').removeClass('orange');
            $('.student_number4').removeClass('orange');
            e.removeClass('orange');
            student_number1.value = 0;
            student_number2.value = 0;
            student_number3.value = 0;
            student_number4.value = 0;
            student_number5.value = 0;
        } else {
            $('.student_number1').addClass('orange');
            $('.student_number2').addClass('orange');
            $('.student_number3').addClass('orange');
            $('.student_number4').addClass('orange');
            e.addClass('orange');
            student_number1.value = 1;
            student_number2.value = 1;
            student_number3.value = 1;
            student_number4.value = 1;
            student_number5.value = 1;
        }
    });

    //Môi trường HT
    var enviroment1 = document.getElementById("enviroment1");
    var enviroment2 = document.getElementById("enviroment2");
    var enviroment3 = document.getElementById("enviroment3");
    var enviroment4 = document.getElementById("enviroment4");
    var enviroment5 = document.getElementById("enviroment5");
    $('.enviroment1').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.enviroment2').removeClass('orange');
            $('.enviroment3').removeClass('orange');
            $('.enviroment4').removeClass('orange');
            $('.enviroment5').removeClass('orange');
            e.removeClass('orange');
            enviroment1.value = 0;
            enviroment2.value = 0;
            enviroment3.value = 0;
            enviroment4.value = 0;
            enviroment5.value = 0;
        } else {
            e.addClass('orange');
            enviroment1.value = 1;
        }
    });
    $('.enviroment2').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.enviroment1').removeClass('orange');
            $('.enviroment5').removeClass('orange');
            $('.enviroment3').removeClass('orange');
            $('.enviroment4').removeClass('orange');
            e.removeClass('orange');
            enviroment1.value = 0;
            enviroment2.value = 0;
            enviroment3.value = 0;
            enviroment4.value = 0;
            enviroment5.value = 0;
        } else {
            $('.enviroment1').addClass('orange');
            e.addClass('orange');
            enviroment1.value = 1;
            enviroment2.value = 1;
        }
    });
    $('.enviroment3').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.enviroment2').removeClass('orange');
            $('.enviroment1').removeClass('orange');
            $('.enviroment5').removeClass('orange');
            $('.enviroment4').removeClass('orange');
            e.removeClass('orange');
            enviroment1.value = 0;
            enviroment2.value = 0;
            enviroment3.value = 0;
            enviroment4.value = 0;
            enviroment5.value = 0;
        } else {
            $('.enviroment1').addClass('orange');
            $('.enviroment2').addClass('orange');
            e.addClass('orange');
            enviroment1.value = 1;
            enviroment2.value = 1;
            enviroment3.value = 1;
        }
    });
    $('.enviroment4').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.enviroment1').removeClass('orange');
            $('.enviroment2').removeClass('orange');
            $('.enviroment3').removeClass('orange');
            $('.enviroment5').removeClass('orange');
            e.removeClass('orange');
            enviroment1.value = 0;
            enviroment2.value = 0;
            enviroment3.value = 0;
            enviroment4.value = 0;
            enviroment5.value = 0;
        } else {
            $('.enviroment1').addClass('orange');
            $('.enviroment2').addClass('orange');
            $('.enviroment3').addClass('orange');
            e.addClass('orange');
            enviroment1.value = 1;
            enviroment2.value = 1;
            enviroment3.value = 1;
            enviroment4.value = 1;
        }
    });
    $('.enviroment5').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.enviroment1').removeClass('orange');
            $('.enviroment2').removeClass('orange');
            $('.enviroment3').removeClass('orange');
            $('.enviroment4').removeClass('orange');
            e.removeClass('orange');
            enviroment1.value = 0;
            enviroment2.value = 0;
            enviroment3.value = 0;
            enviroment4.value = 0;
            enviroment5.value = 0;
        } else {
            $('.enviroment1').addClass('orange');
            $('.enviroment2').addClass('orange');
            $('.enviroment3').addClass('orange');
            $('.enviroment4').addClass('orange');
            e.addClass('orange');
            enviroment1.value = 1;
            enviroment2.value = 1;
            enviroment3.value = 1;
            enviroment4.value = 1;
            enviroment5.value = 1;
        }
    });

    //Quan tâm học viên
    var student_care1 = document.getElementById("student_care1");
    var student_care2 = document.getElementById("student_care2");
    var student_care3 = document.getElementById("student_care3");
    var student_care4 = document.getElementById("student_care4");
    var student_care5 = document.getElementById("student_care5");
    $('.student_care1').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.student_care2').removeClass('orange');
            $('.student_care3').removeClass('orange');
            $('.student_care4').removeClass('orange');
            $('.student_care5').removeClass('orange');
            e.removeClass('orange');
            student_care1.value = 0;
            student_care2.value = 0;
            student_care3.value = 0;
            student_care4.value = 0;
            student_care5.value = 0;
        } else {
            e.addClass('orange');
            student_care1.value = 1;
        }
    });
    $('.student_care2').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.student_care1').removeClass('orange');
            $('.student_care5').removeClass('orange');
            $('.student_care3').removeClass('orange');
            $('.student_care4').removeClass('orange');
            e.removeClass('orange');
            student_care1.value = 0;
            student_care2.value = 0;
            student_care3.value = 0;
            student_care4.value = 0;
            student_care5.value = 0;
        } else {
            $('.student_care1').addClass('orange');
            e.addClass('orange');
            student_care1.value = 1;
            student_care2.value = 1;
        }
    });
    $('.student_care3').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.student_care2').removeClass('orange');
            $('.student_care1').removeClass('orange');
            $('.student_care5').removeClass('orange');
            $('.student_care4').removeClass('orange');
            e.removeClass('orange');
            student_care1.value = 0;
            student_care2.value = 0;
            student_care3.value = 0;
            student_care4.value = 0;
            student_care5.value = 0;
        } else {
            $('.student_care1').addClass('orange');
            $('.student_care2').addClass('orange');
            e.addClass('orange');
            student_care1.value = 1;
            student_care2.value = 1;
            student_care3.value = 1;
        }
    });
    $('.student_care4').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.student_care1').removeClass('orange');
            $('.student_care2').removeClass('orange');
            $('.student_care3').removeClass('orange');
            $('.student_care5').removeClass('orange');
            e.removeClass('orange');
            student_care1.value = 0;
            student_care2.value = 0;
            student_care3.value = 0;
            student_care4.value = 0;
            student_care5.value = 0;
        } else {
            $('.student_care1').addClass('orange');
            $('.student_care2').addClass('orange');
            $('.student_care3').addClass('orange');
            e.addClass('orange');
            student_care1.value = 1;
            student_care2.value = 1;
            student_care3.value = 1;
            student_care4.value = 1;
        }
    });
    $('.student_care5').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.student_care1').removeClass('orange');
            $('.student_care2').removeClass('orange');
            $('.student_care3').removeClass('orange');
            $('.student_care4').removeClass('orange');
            e.removeClass('orange');
            student_care1.value = 0;
            student_care2.value = 0;
            student_care3.value = 0;
            student_care4.value = 0;
            student_care5.value = 0;
        } else {
            $('.student_care1').addClass('orange');
            $('.student_care2').addClass('orange');
            $('.student_care3').addClass('orange');
            $('.student_care4').addClass('orange');
            e.addClass('orange');
            student_care1.value = 1;
            student_care2.value = 1;
            student_care3.value = 1;
            student_care4.value = 1;
            student_care5.value = 1;
        }
    });

    //Thực hành 
    var practice1 = document.getElementById("practice1");
    var practice2 = document.getElementById("practice2");
    var practice3 = document.getElementById("practice3");
    var practice4 = document.getElementById("practice4");
    var practice5 = document.getElementById("practice5");
    $('.practice1').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.practice2').removeClass('orange');
            $('.practice3').removeClass('orange');
            $('.practice4').removeClass('orange');
            $('.practice5').removeClass('orange');
            e.removeClass('orange');
            practice1.value = 0;
            practice2.value = 0;
            practice3.value = 0;
            practice4.value = 0;
            practice5.value = 0;
        } else {
            e.addClass('orange');
            practice1.value = 1;
        }
    });
    $('.practice2').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.practice1').removeClass('orange');
            $('.practice5').removeClass('orange');
            $('.practice3').removeClass('orange');
            $('.practice4').removeClass('orange');
            e.removeClass('orange');
            practice1.value = 0;
            practice2.value = 0;
            practice3.value = 0;
            practice4.value = 0;
            practice5.value = 0;
        } else {
            $('.practice1').addClass('orange');
            e.addClass('orange');
            practice1.value = 1;
            practice2.value = 1;
        }
    });
    $('.practice3').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.practice2').removeClass('orange');
            $('.practice1').removeClass('orange');
            $('.practice5').removeClass('orange');
            $('.practice4').removeClass('orange');
            e.removeClass('orange');
            practice1.value = 0;
            practice2.value = 0;
            practice3.value = 0;
            practice4.value = 0;
            practice5.value = 0;
        } else {
            $('.practice1').addClass('orange');
            $('.practice2').addClass('orange');
            e.addClass('orange');
            practice1.value = 1;
            practice2.value = 1;
            practice3.value = 1;
        }
    });
    $('.practice4').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.practice1').removeClass('orange');
            $('.practice2').removeClass('orange');
            $('.practice3').removeClass('orange');
            $('.practice5').removeClass('orange');
            e.removeClass('orange');
            practice1.value = 0;
            practice2.value = 0;
            practice3.value = 0;
            practice4.value = 0;
            practice5.value = 0;
        } else {
            $('.practice1').addClass('orange');
            $('.practice2').addClass('orange');
            $('.practice3').addClass('orange');
            e.addClass('orange');
            practice1.value = 1;
            practice2.value = 1;
            practice3.value = 1;
            practice4.value = 1;
        }
    });
    $('.practice5').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.practice1').removeClass('orange');
            $('.practice2').removeClass('orange');
            $('.practice3').removeClass('orange');
            $('.practice4').removeClass('orange');
            e.removeClass('orange');
            practice1.value = 0;
            practice2.value = 0;
            practice3.value = 0;
            practice4.value = 0;
            practice5.value = 0;
        } else {
            $('.practice1').addClass('orange');
            $('.practice2').addClass('orange');
            $('.practice3').addClass('orange');
            $('.practice4').addClass('orange');
            e.addClass('orange');
            practice1.value = 1;
            practice2.value = 1;
            practice3.value = 1;
            practice4.value = 1;
            practice5.value = 1;
        }
    });

    //Hài lòng về học phí
    var pround_price1 = document.getElementById("pround_price1");
    var pround_price2 = document.getElementById("pround_price2");
    var pround_price3 = document.getElementById("pround_price3");
    var pround_price4 = document.getElementById("pround_price4");
    var pround_price5 = document.getElementById("pround_price5");
    $('.pround_price1').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.pround_price2').removeClass('orange');
            $('.pround_price3').removeClass('orange');
            $('.pround_price4').removeClass('orange');
            $('.pround_price5').removeClass('orange');
            e.removeClass('orange');
            pround_price1.value = 0;
            pround_price2.value = 0;
            pround_price3.value = 0;
            pround_price4.value = 0;
            pround_price5.value = 0;
        } else {
            e.addClass('orange');
            pround_price1.value = 1;
        }
    });
    $('.pround_price2').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.pround_price1').removeClass('orange');
            $('.pround_price5').removeClass('orange');
            $('.pround_price3').removeClass('orange');
            $('.pround_price4').removeClass('orange');
            e.removeClass('orange');
            pround_price1.value = 0;
            pround_price2.value = 0;
            pround_price3.value = 0;
            pround_price4.value = 0;
            pround_price5.value = 0;
        } else {
            $('.pround_price1').addClass('orange');
            e.addClass('orange');
            pround_price1.value = 1;
            pround_price2.value = 1;
        }
    });
    $('.pround_price3').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.pround_price2').removeClass('orange');
            $('.pround_price1').removeClass('orange');
            $('.pround_price5').removeClass('orange');
            $('.pround_price4').removeClass('orange');
            e.removeClass('orange');
            pround_price1.value = 0;
            pround_price2.value = 0;
            pround_price3.value = 0;
            pround_price4.value = 0;
            pround_price5.value = 0;
        } else {
            $('.pround_price1').addClass('orange');
            $('.pround_price2').addClass('orange');
            e.addClass('orange');
            pround_price1.value = 1;
            pround_price2.value = 1;
            pround_price3.value = 1;
        }
    });
    $('.pround_price4').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.pround_price1').removeClass('orange');
            $('.pround_price2').removeClass('orange');
            $('.pround_price3').removeClass('orange');
            $('.pround_price5').removeClass('orange');
            e.removeClass('orange');
            pround_price1.value = 0;
            pround_price2.value = 0;
            pround_price3.value = 0;
            pround_price4.value = 0;
            pround_price5.value = 0;
        } else {
            $('.pround_price1').addClass('orange');
            $('.pround_price2').addClass('orange');
            $('.pround_price3').addClass('orange');
            e.addClass('orange');
            pround_price1.value = 1;
            pround_price2.value = 1;
            pround_price3.value = 1;
            pround_price4.value = 1;
        }
    });
    $('.pround_price5').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.pround_price1').removeClass('orange');
            $('.pround_price2').removeClass('orange');
            $('.pround_price3').removeClass('orange');
            $('.pround_price4').removeClass('orange');
            e.removeClass('orange');
            pround_price1.value = 0;
            pround_price2.value = 0;
            pround_price3.value = 0;
            pround_price4.value = 0;
            pround_price5.value = 0;
        } else {
            $('.pround_price1').addClass('orange');
            $('.pround_price2').addClass('orange');
            $('.pround_price3').addClass('orange');
            $('.pround_price4').addClass('orange');
            e.addClass('orange');
            pround_price1.value = 1;
            pround_price2.value = 1;
            pround_price3.value = 1;
            pround_price4.value = 1;
            pround_price5.value = 1;
        }
    });

    //Tiến bộ bản thân
    var self_improvement1 = document.getElementById("self_improvement1");
    var self_improvement2 = document.getElementById("self_improvement2");
    var self_improvement3 = document.getElementById("self_improvement3");
    var self_improvement4 = document.getElementById("self_improvement4");
    var self_improvement5 = document.getElementById("self_improvement5");
    $('.self_improvement1').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.self_improvement2').removeClass('orange');
            $('.self_improvement3').removeClass('orange');
            $('.self_improvement4').removeClass('orange');
            $('.self_improvement5').removeClass('orange');
            e.removeClass('orange');
            self_improvement1.value = 0;
            self_improvement2.value = 0;
            self_improvement3.value = 0;
            self_improvement4.value = 0;
            self_improvement5.value = 0;
        } else {
            e.addClass('orange');
            self_improvement1.value = 1;
        }
    });
    $('.self_improvement2').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.self_improvement1').removeClass('orange');
            $('.self_improvement5').removeClass('orange');
            $('.self_improvement3').removeClass('orange');
            $('.self_improvement4').removeClass('orange');
            e.removeClass('orange');
            self_improvement1.value = 0;
            self_improvement2.value = 0;
            self_improvement3.value = 0;
            self_improvement4.value = 0;
            self_improvement5.value = 0;
        } else {
            $('.self_improvement1').addClass('orange');
            e.addClass('orange');
            self_improvement1.value = 1;
            self_improvement2.value = 1;
        }
    });
    $('.self_improvement3').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.self_improvement2').removeClass('orange');
            $('.self_improvement1').removeClass('orange');
            $('.self_improvement5').removeClass('orange');
            $('.self_improvement4').removeClass('orange');
            e.removeClass('orange');
            self_improvement1.value = 0;
            self_improvement2.value = 0;
            self_improvement3.value = 0;
            self_improvement4.value = 0;
            self_improvement5.value = 0;
        } else {
            $('.self_improvement1').addClass('orange');
            $('.self_improvement2').addClass('orange');
            e.addClass('orange');
            self_improvement1.value = 1;
            self_improvement2.value = 1;
            self_improvement3.value = 1;
        }
    });
    $('.self_improvement4').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.self_improvement1').removeClass('orange');
            $('.self_improvement2').removeClass('orange');
            $('.self_improvement3').removeClass('orange');
            $('.self_improvement5').removeClass('orange');
            e.removeClass('orange');
            self_improvement1.value = 0;
            self_improvement2.value = 0;
            self_improvement3.value = 0;
            self_improvement4.value = 0;
            self_improvement5.value = 0;
        } else {
            $('.self_improvement1').addClass('orange');
            $('.self_improvement2').addClass('orange');
            $('.self_improvement3').addClass('orange');
            e.addClass('orange');
            self_improvement1.value = 1;
            self_improvement2.value = 1;
            self_improvement3.value = 1;
            self_improvement4.value = 1;
        }
    });
    $('.self_improvement5').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.self_improvement1').removeClass('orange');
            $('.self_improvement2').removeClass('orange');
            $('.self_improvement3').removeClass('orange');
            $('.self_improvement4').removeClass('orange');
            e.removeClass('orange');
            self_improvement1.value = 0;
            self_improvement2.value = 0;
            self_improvement3.value = 0;
            self_improvement4.value = 0;
            self_improvement5.value = 0;
        } else {
            $('.self_improvement1').addClass('orange');
            $('.self_improvement2').addClass('orange');
            $('.self_improvement3').addClass('orange');
            $('.self_improvement4').addClass('orange');
            e.addClass('orange');
            self_improvement1.value = 1;
            self_improvement2.value = 1;
            self_improvement3.value = 1;
            self_improvement4.value = 1;
            self_improvement5.value = 1;
        }
    });

    //Sẵn sàng giới thiệu
    var ready_introduct1 = document.getElementById("ready_introduct1");
    var ready_introduct2 = document.getElementById("ready_introduct2");
    var ready_introduct3 = document.getElementById("ready_introduct3");
    var ready_introduct4 = document.getElementById("ready_introduct4");
    var ready_introduct5 = document.getElementById("ready_introduct5");
    $('.ready_introduct1').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.ready_introduct2').removeClass('orange');
            $('.ready_introduct3').removeClass('orange');
            $('.ready_introduct4').removeClass('orange');
            $('.ready_introduct5').removeClass('orange');
            e.removeClass('orange');
            ready_introduct1.value = 0;
            ready_introduct2.value = 0;
            ready_introduct3.value = 0;
            ready_introduct4.value = 0;
            ready_introduct5.value = 0;
        } else {
            e.addClass('orange');
            ready_introduct1.value = 1;
        }
    });
    $('.ready_introduct2').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.ready_introduct1').removeClass('orange');
            $('.ready_introduct5').removeClass('orange');
            $('.ready_introduct3').removeClass('orange');
            $('.ready_introduct4').removeClass('orange');
            e.removeClass('orange');
            ready_introduct1.value = 0;
            ready_introduct2.value = 0;
            ready_introduct3.value = 0;
            ready_introduct4.value = 0;
            ready_introduct5.value = 0;
        } else {
            $('.ready_introduct1').addClass('orange');
            e.addClass('orange');
            ready_introduct1.value = 1;
            ready_introduct2.value = 1;
        }
    });
    $('.ready_introduct3').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.ready_introduct2').removeClass('orange');
            $('.ready_introduct1').removeClass('orange');
            $('.ready_introduct5').removeClass('orange');
            $('.ready_introduct4').removeClass('orange');
            e.removeClass('orange');
            ready_introduct1.value = 0;
            ready_introduct2.value = 0;
            ready_introduct3.value = 0;
            ready_introduct4.value = 0;
            ready_introduct5.value = 0;
        } else {
            $('.ready_introduct1').addClass('orange');
            $('.ready_introduct2').addClass('orange');
            e.addClass('orange');
            ready_introduct1.value = 1;
            ready_introduct2.value = 1;
            ready_introduct3.value = 1;
        }
    });
    $('.ready_introduct4').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.ready_introduct1').removeClass('orange');
            $('.ready_introduct2').removeClass('orange');
            $('.ready_introduct3').removeClass('orange');
            $('.ready_introduct5').removeClass('orange');
            e.removeClass('orange');
            ready_introduct1.value = 0;
            ready_introduct2.value = 0;
            ready_introduct3.value = 0;
            ready_introduct4.value = 0;
            ready_introduct5.value = 0;
        } else {
            $('.ready_introduct1').addClass('orange');
            $('.ready_introduct2').addClass('orange');
            $('.ready_introduct3').addClass('orange');
            e.addClass('orange');
            ready_introduct1.value = 1;
            ready_introduct2.value = 1;
            ready_introduct3.value = 1;
            ready_introduct4.value = 1;
        }
    });
    $('.ready_introduct5').click(function() {
        e = $(this);
        if (e.hasClass('orange')) {
            $('.ready_introduct1').removeClass('orange');
            $('.ready_introduct2').removeClass('orange');
            $('.ready_introduct3').removeClass('orange');
            $('.ready_introduct4').removeClass('orange');
            e.removeClass('orange');
            ready_introduct1.value = 0;
            ready_introduct2.value = 0;
            ready_introduct3.value = 0;
            ready_introduct4.value = 0;
            ready_introduct5.value = 0;
        } else {
            $('.ready_introduct1').addClass('orange');
            $('.ready_introduct2').addClass('orange');
            $('.ready_introduct3').addClass('orange');
            $('.ready_introduct4').addClass('orange');
            e.addClass('orange');
            ready_introduct1.value = 1;
            ready_introduct2.value = 1;
            ready_introduct3.value = 1;
            ready_introduct4.value = 1;
            ready_introduct5.value = 1;
        }
    });
});

function comment_rate() {
    var arrteacher = [];
    var teacher = 0;
    for (var i = 1; i <= 5; i++) {
        arrteacher.push($("#teacher" + i).val());
        teacher = teacher + Number(arrteacher[i - 1]);
    }

    var arrplace = [];
    var place_class = 0;
    for (var i = 1; i <= 5; i++) {
        arrplace.push($("#place_class" + i).val());
        place_class = place_class + Number(arrplace[i - 1]);
    }

    var arrinfrastructure = [];
    var infrastructure = 0;
    for (var i = 1; i <= 5; i++) {
        arrinfrastructure.push($("#infrastructure" + i).val());
        infrastructure = infrastructure + Number(arrinfrastructure[i - 1]);
    }

    var arrstudent = [];
    var student_number = 0;
    for (var i = 1; i <= 5; i++) {
        arrstudent.push($("#student_number" + i).val());
        student_number = student_number + Number(arrstudent[i - 1]);
    }

    var arrenviroment = [];
    var enviroment = 0;
    for (var i = 1; i <= 5; i++) {
        arrenviroment.push($("#enviroment" + i).val());
        enviroment = enviroment + Number(arrenviroment[i - 1]);
    }

    var arrcare = [];
    var student_care = 0;
    for (var i = 1; i <= 5; i++) {
        arrcare.push($("#student_care" + i).val());
        student_care = student_care + Number(arrcare[i - 1]);
    }

    var arrpractice = [];
    var practice = 0;
    for (var i = 1; i <= 5; i++) {
        arrpractice.push($("#practice" + i).val());
        practice = practice + Number(arrpractice[i - 1]);
    }

    var arrprice = [];
    var pround_price = 0;
    for (var i = 1; i <= 5; i++) {
        arrprice.push($("#pround_price" + i).val());
        pround_price = pround_price + Number(arrprice[i - 1]);
    }

    var arrself = [];
    var self_improvement = 0;
    for (var i = 1; i <= 5; i++) {
        arrself.push($("#self_improvement" + i).val());
        self_improvement = self_improvement + Number(arrself[i - 1]);
    }

    var arrready = [];
    var ready_introduct = 0;
    for (var i = 1; i <= 5; i++) {
        arrready.push($("#ready_introduct" + i).val());
        ready_introduct = ready_introduct + Number(arrready[i - 1]);
    }

    var user_center_id = $('#addcomment').data('center_id');
    var user_student_id = $('#addcomment').data('student_id');
    var course_learn = $('#course_learn').val();
    var title_rate = $('#title_rate').val();
    var advantages = $('#advantages').val();
    var weakness = $('#weakness').val();
    var comment_experiment = $('#comment_experiment').val();

    if (title_rate == "") {
        alert("Vui lòng nhập tiêu đề");
        return false;
    }
    if (advantages == "") {
        alert("Vui lòng nhập ưu điểm");
        return false;
    }
    if (weakness == "") {
        alert("Vui lòng nhập khuyết điểm");
        return false;
    }
    if (comment_experiment == "") {
        alert("Vui lòng nhập bình luận");
        return false;
    }

    $.ajax({
        type: "POST",
        url: "../ajax/h_ajax_ratecenter.php",
        dataType: "json",
        data: {
            user_center_id: user_center_id,
            user_student_id: user_student_id,
            course_learn: course_learn,
            teacher: teacher,
            place_class: place_class,
            infrastructure: infrastructure,
            student_number: student_number,
            enviroment: enviroment,
            student_care: student_care,
            practice: practice,
            pround_price: pround_price,
            self_improvement: self_improvement,
            ready_introduct: ready_introduct,
            title_rate: title_rate,
            advantages: advantages,
            weakness: weakness,
            comment_experiment: comment_experiment,
        },
        success: function(data) {
            $("#v_write_comment").hide();
            var avatar = $('#addcomment').data('avatar');
            var username = $('#addcomment').data('user_name');
            var html = `
                <div id="cmt-student` + data.rate_id + `" class="cmt-student">
                    <div class="std-img">
                        <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' src="../img/avatar/` + avatar + `">
                    </div>
                    <div class="std-content">
                        <h4>` + username + `</h4>
                        <div class="stdstar">
                            <img src="../img/image/star.svg">
                            <img src="../img/image/star.svg">
                            <img src="../img/image/star.svg">
                            <img src="../img/image/star.svg">
                            <img src="../img/image/star.svg">
                            <span>Vừa xong</span>
                        </div>
                        <p>` + data.comment_experiment + `</p>
                        <div class="answer">
                            <button id="clickrep" onclick="clickrep(` + data.rate_id + `)">Phản hồi</button>
                            <button id="delcmt" data-rate_id="` + data.rate_id + `"
                                onclick="del_comt(this)">Xóa</button>
                        </div>
                    </div>
                    <div class="reply-content" id="reply-content` + data.rate_id + `"></div>
                    <div class="reply-comment" id="repling` + data.rate_id + `">
                            <textarea name="comment_rep" id="comment_rep` + data.rate_id + `"></textarea>
                            <div class="divreply">
                                <button data-center_id="` + user_center_id + `" data-student_id="` + user_student_id + `"
                                data-rate_id="` + data.rate_id + `" data-avatar="` + avatar + `"
                                data-user_name="` + username + `" onclick="rep_comment(this)">GỬI</button>
                            </div>
                    </div>
                </div>
            `;
            $('.modal').removeClass('in');
            $('.modal').attr("aria-hidden", "true");
            $('.modal').css("display", "none");
            $('.modal-open').css("overflow", "auto");
            $('.modal-backdrop').remove();
            $('.list-comment').append(html);
            $('.no-cmt').css('display','none');
        }
    });

    return true;
}

function rep_comment(e) {
    var user_center_id = $(e).data('center_id');
    var user_student_id = $(e).data('student_id');
    var rate_id = $(e).data('rate_id');
    var comment_rep = $('#comment_rep' + rate_id).val();
    var avatar = $(e).data('avatar');
    var username = $(e).data('user_name');
    $.ajax({
        type: "POST",
        url: "../ajax/h_ajax_repcenter.php",
        dataType: "json",
        data: {
            user_center_id: user_center_id,
            user_student_id: user_student_id,
            rate_id: rate_id,
            comment_rep: comment_rep,
        },
        success: function(data) {
            var html = `
                <div class="studentrep" id="studentrep` + data.rep_id + `">
                    <div class="std-img">
                        <img onerror='this.onerror=null;this.src="../img/avatar/error.png";' src="../img/avatar/` + avatar + `">
                    </div>
                    <div class="std-content">
                        <h4>` + username + ` <span>Vừa xong </span> </h4>
                        <p>` + data.comment_rep + `</p>
                        <div class="answer">
                            <button id="delcmt" data-rep_id="` + data.rep_id + `"
                            onclick="del_repcomt(this)">Xóa</button>
                        </div>
                    </div>
                </div>
            `;
            $('#reply-content' + rate_id).append(html);
            $("#repling" + rate_id).css('display', 'none');
        }
    });
}

function clickrep(e) {
    $("#repling" + e).toggle('shower');
}

function del_comt(e) {
    var rate_id = $(e)[0].dataset.rate_id;
    if (confirm("Bạn muốn xóa bình luận này không ?")) {
        $.ajax({
            url: "../ajax/h_ajax_delcmt_center.php",
            type: "POST",
            data: {
                'rate_id': rate_id,
            },
            success: function() {
                $('#cmt-student' + rate_id).hide();
                $("#v_write_comment").show();
            }
        });
    }
}

function del_repcomt(e) {
    var rep_id = $(e).data('rep_id');
    if (confirm("Bạn muốn xóa bình luận này không ?")) {
        $.ajax({
            url: "../ajax/h_ajax_delcmt_center.php",
            type: "POST",
            data: {
                'rep_id': rep_id,
            },
            success: function() {
                $('#studentrep' + rep_id).hide();
            }
        });
    }
}
function v_save_center(center_id, user_student_id, active) {
    var user_type = 3;
    if (active == 1) {
        if ($('#v_save_center').val() == 'THEO DÕI') {
            $.get('../ajax/v_save_center.php', {
                type_save: 0,
                center_id: center_id,
                user_student_id: user_student_id,
                user_type: user_type
            }, function(data) {
                $('#v_save_center').val(data);
                $('#v_save_center').html(data);
            });
        } else if ($('#v_save_center').val() == 'HỦY THEO DÕI') {
            $.get('../ajax/v_save_center.php', {
                type_save: 1,
                center_id: center_id,
                user_student_id: user_student_id
            }, function(data) {
                $('#v_save_center').val(data);
                $('#v_save_center').html(data);
            });
        }
    }
}
if ("undefined" == typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery");
! function(t) {
    "use strict";
    var e = jQuery.fn.jquery.split(" ")[0].split(".");
    if (e[0] < 2 && e[1] < 9 || 1 == e[0] && 9 == e[1] && e[2] < 1) throw new Error(
        "Bootstrap's JavaScript requires jQuery version 1.9.1 or higher")
}(),
function(t) {
    "use strict";

    function e(e) {
        var i, o = e.attr("data-target") || (i = e.attr("href")) && i.replace(/.*(?=#[^\s]+$)/, "");
        return t(o)
    }

    function i(e) {
        return this.each(function() {
            var i = t(this),
                n = i.data("bs.collapse"),
                s = t.extend({}, o.DEFAULTS, i.data(), "object" == typeof e && e);
            !n && s.toggle && /show|hide/.test(e) && (s.toggle = !1), n || i.data("bs.collapse", n = new o(
                this, s)), "string" == typeof e && n[e]()
        })
    }
    var o = function(e, i) {
        this.$element = t(e), this.options = t.extend({}, o.DEFAULTS, i), this.$trigger = t(
                '[data-toggle="collapse"][href="#' + e.id + '"],[data-toggle="collapse"][data-target="#' + e
                .id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() :
            this.addAriaAndCollapsedClass(this.$element, this.$trigger), this.options.toggle && this.toggle()
    };
    o.VERSION = "3.3.4", o.TRANSITION_DURATION = 350, o.DEFAULTS = {
        toggle: !0
    }, o.prototype.dimension = function() {
        return this.$element.hasClass("width") ? "width" : "height"
    }, o.prototype.show = function() {
        if (!this.transitioning && !this.$element.hasClass("in")) {
            var e, n = this.$parent && this.$parent.children(".panel").children(".in, .collapsing");
            if (!(n && n.length && (e = n.data("bs.collapse"), e && e.transitioning))) {
                var s = t.Event("show.bs.collapse");
                if (this.$element.trigger(s), !s.isDefaultPrevented()) {
                    n && n.length && (i.call(n, "hide"), e || n.data("bs.collapse", null));
                    var a = this.dimension();
                    this.$element.removeClass("collapse").addClass("collapsing")[a](0).attr("aria-expanded", !
                            0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this
                        .transitioning = 1;
                    var r = function() {
                        this.$element.removeClass("collapsing").addClass("collapse in")[a](""), this
                            .transitioning = 0, this.$element.trigger("shown.bs.collapse")
                    };
                    if (!t.support.transition) return r.call(this);
                    var l = t.camelCase(["scroll", a].join("-"));
                    this.$element.one("bsTransitionEnd", t.proxy(r, this)).emulateTransitionEnd(o
                        .TRANSITION_DURATION)[a](this.$element[0][l])
                }
            }
        }
    }, o.prototype.hide = function() {
        if (!this.transitioning && this.$element.hasClass("in")) {
            var e = t.Event("hide.bs.collapse");
            if (this.$element.trigger(e), !e.isDefaultPrevented()) {
                var i = this.dimension();
                this.$element[i](this.$element[i]())[0].offsetHeight, this.$element.addClass("collapsing")
                    .removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed")
                    .attr("aria-expanded", !1), this.transitioning = 1;
                var n = function() {
                    this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse")
                        .trigger("hidden.bs.collapse")
                };
                return t.support.transition ? void this.$element[i](0).one("bsTransitionEnd", t.proxy(n, this))
                    .emulateTransitionEnd(o.TRANSITION_DURATION) : n.call(this)
            }
        }
    }, o.prototype.toggle = function() {
        this[this.$element.hasClass("in") ? "hide" : "show"]()
    }, o.prototype.getParent = function() {
        return t(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent +
            '"]').each(t.proxy(function(i, o) {
            var n = t(o);
            this.addAriaAndCollapsedClass(e(n), n)
        }, this)).end()
    }, o.prototype.addAriaAndCollapsedClass = function(t, e) {
        var i = t.hasClass("in");
        t.attr("aria-expanded", i), e.toggleClass("collapsed", !i).attr("aria-expanded", i)
    };
    var n = t.fn.collapse;
    t.fn.collapse = i, t.fn.collapse.Constructor = o, t.fn.collapse.noConflict = function() {
        return t.fn.collapse = n, this
    }, t(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function(o) {
        var n = t(this);
        n.attr("data-target") || o.preventDefault();
        var s = e(n),
            a = s.data("bs.collapse") ? "toggle" : n.data();
        i.call(s, a)
    })
}(jQuery)
// Initialize and add the map


function initMap() {
    // The location of Uluru
    const uluru = { lat: -25.344, lng: 131.036 };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 4,
        center: uluru,
    });
    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
        position: uluru,
        map: map,
    });
}