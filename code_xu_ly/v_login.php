<?php
require_once '../config/config.php';
$user_type_login = getValue('user_type_login','int','POST','');
$email = getValue('email','str','POST','');
$password = getValue('password','str','POST','');
$password = md5($password);
$qr = new db_query("SELECT * FROM users WHERE user_mail = '$email' AND user_pass = '$password' AND user_type = $user_type_login");
if (mysql_num_rows($qr->result) == 0) {
	$data = [
		'type'=>0
	];
}else{
	$row = mysql_fetch_array($qr->result);
	if ($row['user_active'] == 0) {
		$db_token = new db_query("SELECT token FROM tokens WHERE user_id = " . $row['user_id']);
		$token = mysql_fetch_array($db_token->result);
		$data = [
			'type'=>1,
			'user_id'=>$row['user_id'],
			'token'=>$token['token'],
			'time'=>time()
		];
		if ($row['user_type'] == 1) {
			$title = 'Xác thực tài khoản học viên';
	    	$user_type = "học viên";
	    	$user_search = "tìm kiếm trung tâm";
            //	    	------TVT thêm 08/07/2021-----
            $check_ntd = 2;
            //	    	-----------
		}else{
            if ($row['user_type'] == 2) {
                $title = 'Xác thực tài khoản giảng viên';
                $user_type = "giảng viên";
                $user_search = "tìm kiếm học viên";
                //	    	------TVT thêm 08/07/2021-----
                $check_ntd = 3;
                //	    	-----------
            }else if($row['user_type'] == 3){
                $title = 'Xác thực tài khoản trung tâm';
                $user_type = "trung tâm";
                $user_search = "đăng tin miễn phí và tìm hồ sơ ứng viên";
                //	    	------TVT thêm 08/07/2021-----
                $check_ntd = 1;
                //	    	-----------
            }

        }

	    $link = $domain.'/xac-thuc-thanh-cong/id' . $row['user_id'] . '-' . time() . '-' . $token['token'] . '.html';
	    $body = file_get_contents('../EmailTemplate/01_EmailXacThucTaiKhoanTrungTam.htm');
	    $body = str_replace('<%name_company%>', $row['user_name'], $body);
	    $body = str_replace('<%user_type%>', $user_type, $body);
	    $body = str_replace('<%user_search%>', $user_search, $body);
	    $body = str_replace('<%link%>', $link, $body);
	    SendMailAmazon($title, $row['user_name'], $email, $body);
	    setcookie('user_id', $row['user_id'], time() + 3600 * 6, '/');
	    setcookie('user_type', $user_type_login, time() + 3600 * 6, '/');

	}else if ($row['user_active'] == 1) {
		setcookie('user_id', $row['user_id'], time() + 3600 * 6, '/');
		setcookie('user_type', $user_type_login, time() + 3600 * 6, '/');
        //	    	------TVT thêm 08/07/2021-----
        $check_ntd = 2;
        //	    	-----------
		if ($row['user_type'] == 3 || $row['user_type'] == 2) {
			$today = strtotime(date("d-m-Y"));
			$id = $row['user_id'];
			$db_point = new db_query("SELECT * FROM points Where user_id = '$id'");
			$point = mysql_fetch_assoc($db_point->result);
			$reset = $point['reset_day'];
			if ($point > 0) {
				if ($reset < $today) {
					$cook_id = [
						'user_id' => $row['user_id']
					];
					$point = [
						'point' => 1,
						'reset_day' => $today
					];
					update('points', $point, $cook_id);

					$course24 = [
						'24_course'=>0
					];
					update('users', $course24, $cook_id);
				}
			} else {
				$point2 = [
					'user_id'=> $id,
					'point'=> 1,
					'reset_day' => $today
				];
				add('points',$point2);
			}
            //	    	------TVT thêm 08/07/2021-----
            if($row['user_type'] == 3){
                $check_ntd = 1;
            }else if($row['user_type'] == 2){
                $check_ntd = 3;
            }

            //	    	-----------
		}

		if ($row['user_type'] == 3) {
			$link = '/quan-li-chung-trung-tam/id' . $row['user_id'] . '.html';
		} else if ($row['user_type'] == 2) {
			$link = '/quan-li-chung-giang-vien/id' . $row['user_id'] . '.html';
		} else if ($row['user_type'] == 1) {
			$link = '/quan-li-chung-hoc-vien/id' . $row['user_id'] . '.html'; 
		}

		$data = [
			'type'=>2,
			'link'=>$link
		];
	}
    //     --------set cookie UV chung---------
    if($row['user_avatar'] != 0 && $row['user_avatar'] != ''){
        $avt = "https://khoahoc.timviec365.com/img/avatar/".$row['user_avatar'];
    }else{
        $avt = '';
    }
    $arr_cookie['page_login'] = 5;
    $arr_cookie['check_ntd'] = $check_ntd;
    $arr_cookie['from'] = 'khoahoc.timviec365.com';
    $arr_cookie['email'] = $row['user_mail'];
    $arr_cookie['phone'] = $row['user_phone'];
    $arr_cookie['name'] = $row['user_name'];
    $arr_cookie['cit_id'] = $row['cit_id'];
    $arr_cookie['district_id'] = $row['district_id'];
    $arr_cookie['address'] = $row['user_address'];
    $arr_cookie['pw'] = $row['user_pass'];
    $arr_cookie['avatar'] = $avt;
    $arr_cookie['active'] = $row['user_active'];
    $token_cookie = json_encode($arr_cookie);
    setcookie('general_login', $token_cookie, time() + 7*6000,'/','.timviec365.com');
//     --------------------
}

echo json_encode($data);
?>