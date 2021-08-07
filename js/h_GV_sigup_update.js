$(document).ready(function() {
        $('#cit_id').select2({
            data: $('.chontinhthanh').val()
        });
        $('#district_id').select2({
            data: $('.chonquanhuyen').val()
        });
        $('#cate_id').select2({
            multiple: true,
            maximumSelectionLength: 5,
            minimumInputLength: 0,
        });
        $('#cit_id').change(function() {
            tinh = $(this).val();
            $.ajax({
                type: "POST",
                url: "/../ajax/h_ajax_load_city.php",
                data: {
                    tinh: tinh
                },
                success: function(result) {
                    $("#district_id").html(result);
                }
            });
        });
        $('#usephone').on('keyup', function() {
            var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
            var tele = $(this).val();
            if (tele !== '') {
                if (vnf_regex.test(tele) == false) {
                    document.getElementById('error3').innerHTML = 'số điện thoại không hợp lệ !';
                } else {
                    document.getElementById('error3').innerHTML = '';
                }
            }
        });
        $('.camera-img').click(function() {
            $('#img').click();
        });
    });
    function changeImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#avatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function validation() {
        var usename = $('#usename').val();
        var usemail = $('#usemail').val();
        var usephone = $('#usephone').val();
        var pass1 = $('#pass1').val();
        var pass2 = $('#pass2').val();
        var current_position = $('#current_position').val();
        var address = $('#address').val();
        var district_id = $('#district_id').val();
        var cit_id = $('#cit_id').val();
        var current_company = $('#current_company').val();
        var exp_work = $('#exp_work').val();
        var exp_teach = $('#exp_teach').val();
        var qualification = $('#qualification').val();
        var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        flag = true;

        if (pass1 != pass2) {
            document.getElementById('error6').innerHTML = 'Mật khẩu nhập lại không chính xác';
            $('#pass2').focus();
            flag = false;
        } else {
            document.getElementById('error6').innerHTML = '';
        }
        
        
        if (district_id == 0 || district_id == '') {
            document.getElementById('error8').innerHTML = 'Vui lòng chọn quận huyện';
            $('#district_id').focus();
            flag = false;
        } else {
            document.getElementById('error8').innerHTML = '';
        }
        if (current_position == '') {
            document.getElementById('error10').innerHTML = 'Hãy điền chức vụ';
            $('#current_position').focus();
            flag = false;
        } else {
            document.getElementById('error10').innerHTML = '';
        }
        if (current_company == '') {
            document.getElementById('error11').innerHTML = 'Hãy điền công ty';
            $('#current_company').focus();
            flag = false;
        } else {
            document.getElementById('error11').innerHTML = '';
        }
        if (exp_work == '') {
            document.getElementById('error12').innerHTML = 'Hãy điền kinh nghiệm làm việc';
            $('#exp_work').focus();
            flag = false;
        } else {
            document.getElementById('error12').innerHTML = '';
        }
        if (exp_teach == '') {
            document.getElementById('error13').innerHTML = 'Hãy điền kinh nghiệm dạy';
            $('#exp_teach').focus();
            flag = false;
        } else {
            document.getElementById('error13').innerHTML = '';
        }
        if (qualification == '') {
            document.getElementById('error14').innerHTML = 'Hãy nêu bằng cấp';
            $('#qualification').focus();
            flag = false;
        } else {
            document.getElementById('error14').innerHTML = '';
        }
        if (cit_id == 0) {
            document.getElementById('error7').innerHTML = 'Vui chọn tỉnh thành';
            $('#cit_id').focus();
            flag = false;
        } else {
            document.getElementById('error7').innerHTML = '';
        }
        if (address == '') {
            document.getElementById('error9').innerHTML = 'Vui lòng nhập địa chỉ';
            $('#address').focus();
            flag = false;
        } else {
            document.getElementById('error9').innerHTML = '';
        }
        if (pass2 == '') {
            document.getElementById('error5').innerHTML = 'Vui lòng nhập mật khẩu';
            $('#pass2').focus();
            flag = false;
        } else {
            document.getElementById('error5').innerHTML = '';
        }
        if (pass1 == '') {
            document.getElementById('error4').innerHTML = 'Vui lòng nhập mật khẩu';
            $('#pass1').focus();
            flag = false;
        } else if (pass1.length < 8) {
            document.getElementById('error4').innerHTML = 'Mật khẩu phải lớn hơn 8 ký tự';
            $('#pass1').focus();
            flag = false;
        } else {
            document.getElementById('error4').innerHTML = '';
        }
        if (usephone == '') {
            document.getElementById('error3').innerHTML = 'Vui lòng nhập số điện thoại';
            $('#usephone').focus();
            flag = false;
        } else if (vnf_regex.test(usephone) == false) {
            document.getElementById('error3').innerHTML = 'Số điện thoại không hợp lệ !';
            $('#usephone').focus();
            flag = false;
        } else {
            document.getElementById('error3').innerHTML = '';
        }

        if (usemail == '') {
            document.getElementById('error2').innerHTML = 'Vui lòng nhập Email';
            $('#usemail').focus();
            flag = false;
        } else {
            document.getElementById('error2').innerHTML = '';
        }

        if (usename == '') {
            document.getElementById('error1').innerHTML = 'Vui lòng nhập tên';
            $('#usename').focus();
            flag = false;
        } else {
            document.getElementById('error1').innerHTML = '';
        }

        var method_coop = document.getElementsByName("method_coop");
        for (var i = 0; i < method_coop.length; i++) {
            if (method_coop[i].checked == true) {
                document.getElementById('error15').innerHTML = '';
                flag = true;
                break;
            }
        }
        if (i == method_coop.length) {
            document.getElementById('error15').innerHTML = 'Hãy chọn hình thức';
            flag = false;
        }

        var teach_online_id = document.getElementsByName("teach_online_id");
        for (var i = 0; i < teach_online_id.length; i++) {
            if (teach_online_id[i].checked == true) {
                document.getElementById('error16').innerHTML = '';
                flag = true;
                break;
            }
        }
        if (i == teach_online_id.length) {
            document.getElementById('error16').innerHTML = 'Anh/Chị đã từng giảng dạy online chưa !';
            flag = false;
        }

        var cate_id = document.getElementsByName("cate_id");
        for (var i = 0; i < cate_id.length; i++) {
            if (cate_id[i].checked == true) {
                document.getElementById('error17').innerHTML = '';
                flag = true;
                break;
            }
        }
        if (i == cate_id.length) {
            document.getElementById('error17').innerHTML = 'Vui lòng chọn Chủ đề giảng dạy !';
            flag = false;
        }

        var benefit_id = document.getElementsByName("benefit_id");
        for (var i = 0; i < benefit_id.length; i++) {
            if (benefit_id[i].checked == true) {
                document.getElementById('error18').innerHTML = '';
                flag = true;
                break;
            }
        }
        if (i == benefit_id.length) {
            document.getElementById('error18').innerHTML = 'Vui lòng chọn điều anh/chị quan tâm nhất !';
            flag = false;
        }
        return flag;
    }

    function validation2(user_id){
        var usename = $('#usename').val();
        var usephone = $('#usephone').val();
        var birth = $('#birth').val();
        var address = $('#address').val();
        var district_id = $('#district_id').val();
        var cit_id = $('#cit_id').val();
        var exp_teach = $('#exp_teach').val();
        var exp_work = $('#exp_work').val();
        var qualification = $('#qualification').val();
        var current_position = $('#current_position').val();
        var current_company = $('#current_company').val();
        var link_student_community = $("#link_student_community").val();
        var link_lecture_online = $("#link_lecture_online").val();
        var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;

        form_data = new FormData();
        form_data.append('link_student_community',link_student_community);
        form_data.append('link_lecture_online',link_lecture_online);
        if ($('#img').prop('files')[0] != undefined) {
            var match = ["image/jpeg", "image/JPEG", "image/png", "image/PNG", "image/jpg", "image/JPG"];
            var j = 0;
            for (var i = 0; i < match.length; i++) {
                if ($('#img').prop('files')[0].type != match[i]) {
                    j++;
                }
            }

            if (j == 6) {
                alert("Vui lòng chọn đúng định dạng ảnh");
                $('#img').show();
                $('#img').focus();
                $('#img').hide();
                return false;
            } else if ($('#img').prop('files')[0].size > 205824) {
                alert("Vui lòng chọn dung lượng ảnh dưới 200KB");
                $('#img').show();
                $('#img').focus();
                $('#img').hide();
                return false;
            } else {
                var form_data = new FormData();
                form_data.append('user_avatar', $('#img').prop('files')[0]);
            }
        }

        if (usename == '') {
            document.getElementById('error1').innerHTML = 'Vui lòng nhập tên';
            $('#usename').focus();
            return false;
        } else {
            form_data.append('usename',usename);
            document.getElementById('error1').innerHTML = '';
        }

        if (usephone == '') {
            document.getElementById('error3').innerHTML = 'Vui lòng nhập số điện thoại';
            $('#usephone').focus();
            return false;
        } else if (vnf_regex.test(usephone) == false) {
            document.getElementById('error3').innerHTML = 'số điện thoại không hợp lệ !';
            $('#usephone').focus();
            return false;
        } else {
            form_data.append('usephone',usephone);
            document.getElementById('error3').innerHTML = '';
        }

        if (document.v_gv_name.gender.value != 1 && document.v_gv_name.gender.value != 2) {
            alert("Vui lòng chọn giới tính");
            $('#gender').focus();
            return false;
        } else {
            form_data.append('gender',document.v_gv_name.gender.value);
        }

        if (birth == '') {
            alert("Vui lòng nhập ngày sinh");
            $('#birth').focus();
            return false;
        } else {
            form_data.append('birth',birth);
        }

        if (address == '') {
            document.getElementById('error9').innerHTML = 'Vui lòng nhập địa chỉ';
            $('#address').focus();
            return false;
        } else {
            form_data.append('address',address);
            document.getElementById('error9').innerHTML = '';
        }
        if (cit_id == 0) {
            document.getElementById('error7').innerHTML = 'Vui chọn tỉnh thành';
            $('#cit_id').focus();
            return false;
        } else {
            form_data.append('cit_id',cit_id);
            document.getElementById('error7').innerHTML = '';
        }
        if (district_id == 0 || district_id == '') {
            document.getElementById('error8').innerHTML = 'Vui lòng chọn quận huyện';
            $('#district_id').focus();
            return false;
        } else {
            form_data.append('district_id',district_id);
            document.getElementById('error8').innerHTML = '';
        }
        if (current_position == '') {
            document.getElementById('error10').innerHTML = 'Hãy điền chức vụ';
            $('#current_position').focus();
            return false;
        } else {
            form_data.append('current_position',current_position);
            document.getElementById('error10').innerHTML = '';
        }
        if (current_company == '') {
            document.getElementById('error11').innerHTML = 'Hãy điền công ty';
            $('#current_company').focus();
            return false;
        } else {
            form_data.append('current_company',current_company);
            document.getElementById('error11').innerHTML = '';
        }
        if (exp_work == '') {
            document.getElementById('error12').innerHTML = 'Hãy điền kinh nghiệm làm việc';
            $('#exp_work').focus();
            return false;
        } else {
            form_data.append('exp_work',exp_work);
            document.getElementById('error12').innerHTML = '';
        }
        if (exp_teach == '') {
            document.getElementById('error13').innerHTML = 'Hãy điền kinh nghiệm dạy';
            $('#exp_teach').focus();
            return false;
        } else {
            form_data.append('exp_teach',exp_teach);
            document.getElementById('error13').innerHTML = '';
        }
        if (qualification == '') {
            document.getElementById('error14').innerHTML = 'Hãy nêu bằng cấp';
            $('#qualification').focus();
            return false;
        } else {
            form_data.append('qualification',qualification);
            document.getElementById('error14').innerHTML = '';
        }

        if ($("#cate_id").val() == null) {
            alert("Vui lòng nhập chủ đề giảng dạy");
            return false;
        }else{
            form_data.append('cate_id',$("#cate_id").val());
        }


        $.ajax({
            url: '../ajax/v_update_gv.php',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: form_data,
            success: function (data) {
                alert("Cập nhật thành công");
                $("#v_tenhocvien").text(data.user_name);
                $("#v_content-title-name").text(data.user_name);
                $("#v_name_gv").text(data.user_name);
                $("#v_header-avatar-dropdown-name").text(data.user_name);
                if (data.user_avatar != '1') {
                    $("#v_avatar").attr('src', data.user_avatar);
                    $("#v_header_avatar2").attr('src', data.user_avatar);
                    $("#v_header-avatar-img2").attr('src', data.user_avatar);
                    $("#v_quanlihocvien-avatar2").attr('src', data.user_avatar);
                }
                window.location.href = "quan-li-chung-giang-vien/id"+data.user_id+".html";
            },
            error: function () {
                alert("Có lỗi xảy ra. Vui lòng thử lại");
            }
        });

        return false;
    }