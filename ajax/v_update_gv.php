<?php
	require_once '../config/config.php';
	$cookie_id = $_COOKIE['user_id'];
	$db = new db_query("SELECT * FROM users JOIN user_teach_cooperation ON user_teach_cooperation.user_id = users.user_id JOIN user_teach_experience ON user_teach_experience.user_id = users.user_id WHERE users.user_id = '$cookie_id'");
	$row = mysql_fetch_array($db->result);
	$today = strtotime(date("d-m-Y"));
	$user_name = getValue('usename', 'str', 'POST', '');
	$user_phone = getValue('usephone', 'str', 'POST', '');
	$user_city = getValue('cit_id', 'str', 'POST', '');
	$user_dis = getValue('district_id', 'str', 'POST', '');
	$user_address = getValue('address', 'str', 'POST', '');
	$user_birth = getValue('birth', 'str', 'POST', '');
	$user_gender = getValue('gender', 'str', 'POST', '');
	$cate_id = getValue('cate_id','arr','POST','');

	$data = [
		'cit_id'=>$user_city,
		'cate_id'=>$cate_id,
		'district_id'=>$user_dis,
		'user_name'=>$user_name,
		'user_phone'=>$user_phone,
		'user_birth'=>$user_birth,
		'user_gender'=>$user_gender,
		'user_address'=>$user_address,
		'updated_at'=>$today
	];

	$where = [
		'user_id'=>$cookie_id
	];
	update('users', $data,$where);

	$user_avatar = '1';
	if (isset($_FILES['user_avatar'])) {
		$user_avatar = $_FILES['user_avatar']['name'];
		$user_avatar_tmp = $_FILES['user_avatar']['tmp_name'];
		$size = $_FILES['user_avatar']['size'];

            $avatar_name = explode('.', $user_avatar);                               //Thay đổi tên ảnh
            $file_ext = strtolower(end($avatar_name));
            $new_avatar_name = substr(md5(time()), 0, 10).'.'.$file_ext;                       //Cập nhật tên ảnh mới

            $target_dir = "../img/avatar/";                            //Thư mục lưu file upload
            $target_file = $target_dir . basename($new_avatar_name);                         //Vị trí file lưu tạm trong serve
            $pathinfo = pathinfo($target_file, PATHINFO_EXTENSION);                         //Lấy phần mở rộng của file (jpg, png, ...)
            $allow_type = array('png','jpg','jpeg','PNG','JPG','JPEG');                                        //Những loại file được phép upload
            $allow_upload = true;

            
            if ($user_avatar == '') {
                $user_avatar == $row['user_avatar'];                                        // Nếu không chọn ảnh mới thì vẫn giữ nguyên ảnh cũ
            } elseif ($size > 205824) {                                                     // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
            	echo "<script>alert('không được upload ảnh lớn hơn 200KB')</script>";
            	$allow_upload = false;
            } elseif (file_exists($target_file)) {                                                // Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
            	echo "<script>alert('Tên file đã tồn tại trên server, không được ghi đè')</script>";
            	$allow_upload = false;
            } elseif (!in_array($pathinfo, $allow_type)) {
            	echo "<script>alert('Chỉ được phép tải ảnh file PNG hoặc JPG,JPEG')</script>";
            	$allow_upload = false;
            } else {
            	move_uploaded_file($user_avatar_tmp, $target_file);
            	$data= [
            		'user_avatar'=>$new_avatar_name
            	];
            	update('users', $data,$where);
                $link="../img/avatar/".$row['user_avatar'];        // Nếu thay ảnh mới thì sẽ xóa ảnh cũ trong file
                unlink($link);
            }

            $user_avatar = $target_file;
    }


    $current_position = getValue('current_position', 'str', 'POST', '');
    $current_company = getValue('current_company', 'str', 'POST', '');
    $exp_work = getValue('exp_work', 'str', 'POST', '');
    $exp_teach = getValue('exp_teach', 'str', 'POST', '');
    $qualification = getValue('qualification', 'str', 'POST', '');

    $data2= [
    	'current_position'=>$current_position,
    	'current_company'=>$current_company,
    	'exp_work'=>$exp_work,
    	'exp_teach'=>$exp_teach,
    	'qualification'=>$qualification,
    ];
    update('user_teach_experience', $data2,$where);

    $link_lecture_online = getValue('link_lecture_online', 'str', 'POST', '');
    $link_student_community = getValue('link_student_community', 'str', 'POST', '');

    $data3= [
    	'link_lecture_online'=>$link_lecture_online,
    	'link_student_community'=>$link_student_community,
    ];
    update('user_teach_cooperation', $data3,$where);

    $data_true = [
    	'type'=>1,
        'user_id'=>$cookie_id,
    	'user_name'=>$user_name,
    	'user_avatar'=>$user_avatar
    ];

    echo json_encode($data_true);
?>