<?
require_once '../config/config.php';
if(!isset($_COOKIE['user_id']) ||$_COOKIE['user_type'] != 3){
    header('location:/');
}
elseif(isset($_COOKIE['timeout']) || $row['24_course'] == 24){
    header("location: /trung-tam-khoa-hoc-online-giang-day/id$cookie_id&page1.html");
}else{
    $post24 = $row['24_course'];
    $whereus = [
        'user_id'=>$cookie_id
    ];
    //Online
    if (isset($_POST['btn_online'])) {
        $course_avatar = $_FILES['course_avatar']['name'];
        $course_avatar_tmp = $_FILES['course_avatar']['tmp_name'];
        $size = $_FILES['course_avatar']['size'];

        $avatar_name = explode('.', $course_avatar);                               //Thay đổi tên ảnh
        $file_ext = strtolower(end($avatar_name));
        $new_avatar_name = substr(md5(time()), 0, 10).'.'.$file_ext;                       //Cập nhật tên ảnh mới

        $target_dir = "../img/course/";                            //Thư mục lưu file upload
        $target_file = $target_dir . basename($new_avatar_name);                         //Vị trí file lưu tạm trong serve
        $pathinfo = pathinfo($target_file, PATHINFO_EXTENSION);                         //Lấy phần mở rộng của file (jpg, png, ...)
        $allow_upload = true;

        if ($size > 205824) {                                                     // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
            echo "<script>alert('không được upload ảnh lớn hơn 200KB ')</script>";
            $allow_upload = false;
        } elseif (file_exists($target_file)) {                                                // Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
            echo "<script>alert('Tên file đã tồn tại trên server, không được ghi đè')</script>";
            $allow_upload = false;
        } else {
            move_uploaded_file($course_avatar_tmp, $target_file);
            $today = strtotime(date("d-m-Y"));
            $course_name = getValue('course_name', 'str', 'POST', '');
            $course_describe = getValue('course_describe', 'str', 'POST', '');
            $course_benefit = getValue('course_benefit', 'str', 'POST', '');
            $course_match = getValue('course_match', 'str', 'POST', '');
            $course_request = getValue('course_request', 'str', 'POST', '');
            $general_describe = getValue('general_describe', 'str', 'POST', '');
            $certification = getValue('certification', 'int', 'POST', '0');
            $center_teacher_id = getValue('center_teacher', 'int', 'POST', '0');
            $level_id = getValue('level_id', 'str', 'POST', '0');
            $cate_id = getValue('cate_id', 'int', 'POST', '0');
            $tag_id = getValue('tag_id', 'int', 'POST', '0');
            $advantages_id = implode(',', $_POST['advantages_id']);
            $course_slug = ChangeToSlug($course_name);
            $check = new db_query("SELECT course_slug FROM courses WHERE course_slug = '$course_slug' AND user_id = $cookie_id");

            if (mysql_num_rows($check->result)>0) {
                echo "<script>alert('Bạn đã có khóa học này rồi')</script>";
            } else {
                $data= [
                    'user_id'=>$cookie_id,
                    'cate_id'=>$cate_id,
                    'course_describe'=>$course_describe,
                    'course_name'=>$course_name,
                    'tag_id'=>$tag_id,
                    'certification'=>$certification,
                    'advantages_id'=>$advantages_id,
                    'course_benefit'=>$course_benefit,
                    'course_match'=>$course_match,
                    'general_describe'=>$general_describe,
                    'course_request'=>$course_request,
                    'level_id'=>$level_id,
                    'course_slug'=> $course_slug,
                    'course_type'=>2,
                    'teacher_center'=>3,
                    'course_avatar'=>$new_avatar_name,
                    'created_at'=>$today,
                    'updated_at'=>$today
                ];
            
                add('courses', $data);
                $course_id = mysql_insert_id();
                $data2=[
                    'course_id'=>$course_id
                ];
                $where = [
                    'center_teacher_id'=>$center_teacher_id
                ];
                update('user_center_teacher', $data2, $where);
                if ($post24 == 0) {
                    $update1 = [
                        '24_course'=>1
                    ];
                    update('users', $update1, $whereus);
                } else {
                    $post24add = $post24+1;
                    $update1 = [
                        '24_course'=>$post24add
                    ];
                    update('users', $update1, $whereus);
                }
                setcookie('timeout', 'timeout', time()+1200, '/');
                header("location:/trung-tam-khoa-hoc-online-giang-day/id$cookie_id&page1.html");
            }
        }
    }
    if (isset($_POST['btn_next'])) {
        $course_avatar = $_FILES['course_avatar']['name'];
        $course_avatar_tmp = $_FILES['course_avatar']['tmp_name'];
        $size = $_FILES['course_avatar']['size'];

        $avatar_name = explode('.', $course_avatar);                               //Thay đổi tên ảnh
        $file_ext = strtolower(end($avatar_name));
        $new_avatar_name = substr(md5(time()), 0, 10).'.'.$file_ext;                       //Cập nhật tên ảnh mới

        $target_dir = "../img/course/";                            //Thư mục lưu file upload
        $target_file = $target_dir . basename($new_avatar_name);                         //Vị trí file lưu tạm trong serve
        $pathinfo = pathinfo($target_file, PATHINFO_EXTENSION);                                                            //Những loại file được phép upload
        $allow_upload = true;

        if ($size > 205824) {                                                     // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
            echo "<script>alert('không được upload ảnh lớn hơn 200KB ')</script>";
            $allow_upload = false;
        } elseif (file_exists($target_file)) {                                                // Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
            echo "<script>alert('Tên file đã tồn tại trên server, không được ghi đè')</script>";
            $allow_upload = false;
        }  else {
            move_uploaded_file($course_avatar_tmp, $target_file);
            $course_name = getValue('course_name', 'str', 'POST', '');
            $course_describe = getValue('course_describe', 'str', 'POST', '');
            $course_benefit = getValue('course_benefit', 'str', 'POST', '');
            $course_match = getValue('course_match', 'str', 'POST', '');
            $course_request = getValue('course_request', 'str', 'POST', '');
            $general_describe = getValue('general_describe', 'str', 'POST', '');
            $certification = getValue('certification', 'int', 'POST', '0');
            $center_teacher_id = getValue('center_teacher', 'int', 'POST', '0');
            $level_id = getValue('level_id', 'str', 'POST', '0');
            $cate_id = getValue('cate_id', 'int', 'POST', '0');
            $tag_id = getValue('tag_id', 'int', 'POST', '0');
            $advantages_id = implode(',', $_POST['advantages_id']);

            setcookie('level_id',$level_id,time() + 900, "/");
            setcookie('course_describe', $course_describe, time() + 900, '/');
            setcookie('course_name', $course_name, time() + 900, '/');
            setcookie('course_match', $course_match, time() + 900, '/');
            setcookie('course_benefit', $course_benefit, time() + 900, '/');
            setcookie('general_describe', $general_describe, time() + 900, '/');
            setcookie('course_request', $course_request, time() + 900, '/');
            setcookie('cate_id', $cate_id, time() + 900, '/');
            setcookie('tag_id', $tag_id, time() + 900, '/');
            setcookie('new_avatar_name', $new_avatar_name, time() + 900, '/');
            setcookie('type', 3, time() + 900, '/');
            setcookie('advantages_id', $advantages_id, time() + 900, '/');
            setcookie('certification', $certification, time() + 900, '/');
            setcookie('center_teacher_id', $center_teacher_id, time() + 900, '/');
            header("Location: /tao-khoa-hoc-online-next/id$cookie_id.html");
        }
    }
    //Offline
    if (isset($_POST['btn_offline'])) {
        $course_avatar = $_FILES['course_avatar']['name'];
        $course_avatar_tmp = $_FILES['course_avatar']['tmp_name'];
        $size = $_FILES['course_avatar']['size'];

        $avatar_name = explode('.', $course_avatar);                               //Thay đổi tên ảnh
        $file_ext = strtolower(end($avatar_name));
        $new_avatar_name = substr(md5(time()), 0, 10).'.'.$file_ext;                       //Cập nhật tên ảnh mới

        $target_dir = "../img/course/";                            //Thư mục lưu file upload
        $target_file = $target_dir . basename($new_avatar_name);                         //Vị trí file lưu tạm trong serve
        $pathinfo = pathinfo($target_file, PATHINFO_EXTENSION);                         //Lấy phần mở rộng của file (jpg, png, ...)
        $allow_upload = true;

        if ($size > 205824) {                                                     // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
            echo "<script>alert('không được upload ảnh lớn hơn 200KB ')</script>";
            $allow_upload = false;
        } elseif (file_exists($target_file)) {                                                // Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
            echo "<script>alert('Tên file đã tồn tại trên server, không được ghi đè')</script>";
            $allow_upload = false;
        } else {
            move_uploaded_file($course_avatar_tmp, $target_file);
            $today = strtotime(date("d-m-Y"));
            $course_name = getValue('course_name', 'str', 'POST', '');
            $course_describe = getValue('course_describe', 'str', 'POST', '');
            $course_learn = getValue('course_learn', 'str', 'POST', '');
            $course_object = getValue('course_object', 'str', 'POST', '');
            $time_learn = getValue('time_learn', 'int', 'POST', '0');
            $course_slide = getValue('course_slide', 'int', 'POST', '0');
            $certification = getValue('qualification', 'int', 'POST', '0');
            $center_teacher_id = getValue('center_teacher_id', 'int', 'POST', '0');
            $level_id = getValue('v_level', 'str', 'POST', '0');
            $cate_id = getValue('cate_id', 'int', 'POST', '0');
            $tag_id = getValue('tag_id', 'int', 'POST', '0');
            $price_promotional = getValue('price_promotional', 'str', 'POST', '0');
            $price_listed = getValue('price_listed', 'str', 'POST', '0');
            $price_discount = getValue('price_discount', 'str', 'POST', '0');
            $quantity_std = getValue('quantity_std', 'str', 'POST', '0');
            $month_study = getValue('month_study', 'str', 'POST', '0');

            $advantages_id = implode(',', $_POST['advantages_id']);

            $check = new db_query("SELECT course_slug FROM courses WHERE course_slug = '$course_slug' AND user_id = $cookie_id");
            if (mysql_num_rows($check->result)>0) {
                echo "<script>alert('Bạn đã có khóa học này rồi')</script>";
            } else {
                $data= [
                'user_id'=>$cookie_id,
                'cate_id'=>$cate_id,
                'course_name'=>$course_name,
                'tag_id'=>$tag_id,
                'certification'=>$certification,
                'course_describe'=>$course_describe,
                'advantages_id'=>$advantages_id,
                'course_learn'=>$course_learn,
                'course_object'=>$course_object,
                'course_slug'=> ChangeToSlug($course_name),
                'course_slide'=>$course_slide,
                'price_listed'=>$price_listed,
                'price_promotional'=>$price_promotional,
                'price_discount'=>$price_discount,
                'quantity_std'=>$quantity_std,
                'level_id'=>$level_id,
                'time_learn'=>$time_learn,
                'month_study'=>$month_study,
                'course_type'=>1,
                'teacher_center'=>3,
                'course_avatar'=>$new_avatar_name,
                'center_teacher_id'=>$center_teacher_id,
                'created_at'=>$today,
                'updated_at'=>$today
            ];
                add('courses', $data);
                $course_id = mysql_insert_id();
                $data1= [
                'course_id'=>$id,
                'cit_id'=>$cit_id,
                'course_address'=>$course_address,
                'district_id'=>$district_id,
            ];
                add('course_basis', $data1);

                for ($i = 0; $i < count($_POST['v_basis']); $i++) {
                    $data2 = [
                        'course_id'=>$course_id,
                        'cit_id'=>$_POST['v_city'][$i],
                        'district_id'=>$_POST['v_district'][$i],
                        'address_name'=>$_POST['v_basis'][$i],
                        'course_address'=>$_POST['address'][$i],
                    ];
                    add('course_basis', $data2);
                }

                $data2=[
                    'course_id'=>$course_id
                ];
                $where = [
                    'center_teacher_id'=>$center_teacher_id
                ];
                update('user_center_teacher', $data2, $where);

                if ($post24 == 0) {
                    $update1 = [
                    '24_course'=>1
                ];
                    update('users', $update1, $whereus);
                } else {
                    $post24add = $post24+1;
                    $update1 = [
                '24_course'=>$post24add
            ];
                    update('users', $update1, $whereus);
                }
                setcookie('timeout', 'timeout', time()+1200, '/');
                header("location:/trung-tam-khoa-hoc-offline-giang-day/id$cookie_id&page1.html");
            }
        }
    }
}
?>