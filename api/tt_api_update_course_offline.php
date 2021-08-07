<?php
require_once "api_info.php";
$course_name = getValue('course_name', 'str', 'POST', '');
$course_id = getValue('course_id', 'int', 'POST', '');
$course_name_slug = ChangeToSlug($course_name);
$qr_course_slug = new db_query("SELECT course_slug FROM courses WHERE course_slug = '$course_name_slug' AND user_id = $user_id AND course_id != $course_id");
if (mysql_num_rows($qr_course_slug->result) > 0) {
    set_error('404', 'Tên khóa học đã tồn tại');
} else {
    $dataId = [
        'course_id' => $course_id
    ];
    if (isset($_FILES['file'])) {
        $duoi = explode('/', $_FILES['file']['type']);
        $duoi = $duoi[(count($duoi) - 1)];
        $_FILES['file']['name'] = md5(rand()) . "." . $duoi;
        move_uploaded_file($_FILES['file']['tmp_name'], '../img/course/' . $_FILES['file']['name']);
        $dataPic = [
            'course_avatar' => $_FILES['file']['name']
        ];
        update('courses', $dataPic, $dataId);
    }
    $course_basis = getValue('course_basis', 'arr', 'POST', '');
    $course_basis = explode(",", $course_basis);
    if ($course_basis[0] == '') {
        $course_basis_count = 0;
    } else {
        $course_basis_count = count($course_basis);
    }
    $cate_id = getValue('cate_id', 'int', 'POST', '');
    $tag_id = getValue('tag_id', 'int', 'POST', '');
    $description = getValue('description', 'str', 'POST', '');
    $course_learn = getValue('course_learn', 'str', 'POST', '');
    $object = getValue('object', 'str', 'POST', '');
    $teach = getValue('teach', 'int', 'POST', '');
    $time_learn = getValue('time_learn', 'int', 'POST', '');
    $slide = getValue('slide', 'int', 'POST', '');
    $prices_listed = getValue('prices_listed', 'int', 'POST', '');
    $price_promotional = getValue('price_promotional', 'int', 'POST', '');
    $quantity_std = getValue('quantity_std', 'int', 'POST', '');
    $price_discount = getValue('price_discount', 'int', 'POST', '');
    $qualification = getValue('qualification', 'int', 'POST', '');
    $level = getValue('level', 'int', 'POST', '');
    $month_study = getValue('month_study', 'str', 'POST', '');

    if ($arr_adventags == "") {
        $arr_adventags = 0;
    }
    $addtienich = getValue('addtienich', 'str', 'POST', '');

    $data1 = [
        'user_id' => $user_id,
        'course_name' => $course_name,
        'cate_id' => $cate_id,
        'tag_id' => $tag_id,
        'level_id' => $level,
        'center_teacher_id' => $teach,
        'course_describe' => $description,
        'course_learn' => $course_learn,
        'course_object' => $object,
        'time_learn' => $time_learn,
        'course_slide' => $slide,
        'price_listed' => $prices_listed,
        'price_promotional' => $price_promotional,
        'quantity_std' => $quantity_std,
        'price_discount' => $price_discount,
        'certification' => $qualification,
        'month_study' => $month_study,
        'course_slug' => $course_name_slug,
        'advantages_id' => $arr_adventags,
        'updated_at' => strtotime(date("d-m-Y"))
    ];

    update('courses', $data1, $dataId);

    //Cập nhật cơ sở đã có
    for ($i = 0; $i < $course_basis_count; $i++) {
        $dataId = [
            'course_basis_id' => $course_basis[$i]
        ];
        $data2 = [
            'cit_id' => $arr_city[$i],
            'district_id' => $arr_district[$i],
            'course_address' => $arr_basis[$i],
            'address_name' => $arr_address[$i]
        ];
        update('course_basis', $data2, $dataId);
    }

    //Thêm các cơ sở mới
    for ($j = $course_basis_count; $j < count($arr_city); $j++) {
        $data2 = [
            'course_id' => $course_id,
            'cit_id' => $arr_city[$j],
            'district_id' => $arr_district[$j],
            'course_address' => $arr_basis[$j],
            'address_name' => $arr_address[$j]
        ];
        add('course_basis', $data2);
    }
    $data = [
        'type' => 1,
        'user_id' => $user_id
    ];

    $qrTeacher = new db_query("SELECT * FROM user_center_teacher WHERE center_teacher_id = $teach");
    $row1 = mysql_fetch_array($qrTeacher->result);
    if ($row1['course_id'] == 0) {
        $data3 = [
            'course_id' => $course_id
        ];
        $where = [
            'center_teacher_id' => $teach
        ];
    } else {
        $arr_teacher = explode(',', $row1['course_id']);
        $arr_teacher[] = $teach;
        $center_teacher_course_id = implode(",", $arr_teacher);
        $data3 = [
            'course_id' => $center_teacher_course_id
        ];
        $where = [
            'center_teacher_id' => $teach
        ];
    }
    update('user_center_teacher', $data3, $where);

    $data2 = [
        'result' => 1
    ];
    success('Cập nhật khóa học offline thành công', $data2);
}
