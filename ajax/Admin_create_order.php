<?
session_start();
require_once '../config/config.php';
//FIlter user
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    $db = new db_query("SELECT * FROM users JOIN city ON city.cit_id = users.cit_id WHERE user_id = $user_id");
    $row=mysql_fetch_array($db->result);

    $district_id = $row['district_id'];
    $db1 = new db_query("SELECT cit_name FROm city WHERE cit_id = $district_id");
    $row1=mysql_fetch_array($db1->result);

    if($row['user_gender']==1){
        $gender = 'Nam';
    }elseif($row['user_gender']==2){
        $gender = 'Nữ';
    }

    echo '
        <div class="v_detail_student">
                            <div>Tên học viên:</div>
                            <div><input type="text" value="'.$row['user_name'].'" readonly></div>
                        </div>
                        <div class="v_detail_student">
                            <div>Email:</div>
                            <div><input type="email" value="'.$row['user_mail'].'" readonly></div>
                        </div>

                        <div class="v_detail_student">
                            <div>Số điện thoại:</div>
                            <div><input type="text"  value="'.$row['user_phone'].'" readonly></div>
                        </div>
                        <div class="v_detail_student">
                            <div>Tỉnh, thành phố:</div>
                            <div class="city">
                                <input type="text" value="'.$row['cit_name'].'" readonly>
                                </div>
                        </div>
                        <div class="v_detail_student">
                            <div>Quận huyện:</div>
                            <div class="city">
                                <input type="text" value="'.$row1['cit_name'].'" readonly>
                                </div>
                        </div>

                        <div class="v_detail_student">
                            <div>Địa chỉ:</div>
                            <div><input type="text" value="'.$row['user_address'].'" readonly></div>
                        </div>

                        <div class="v_detail_student">
                            <div>Giới tính:</div>
                            <div>
                                <input type="text" value="'.$gender.'" readonly>
                            </div>
                        </div>

                        <div class="v_detail_student">
                            <div>Ngày sinh:</div>
                            <div><input type="text" value="'.$row['user_birth'].'" readonly ></div>
                        </div>
    ';
}


// CART
if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")
	{
		if(isset($_SESSION["cart"]))
		{
			$is_available = 0;
			if($is_available == 0)
			{
				$item_array = array(
					'course_id'               =>     $_POST["course_id"],  
					'course_name'             =>     $_POST["course_name"],  
                    'course_type'       =>     $_POST["course_type"],
					'prices'            =>     $_POST["prices"],  

				);
				$_SESSION["cart"][] = $item_array;
			}
		}
		else
		{
			$item_array = array(
				'course_id'               =>     $_POST["course_id"],  
				'course_name'             =>     $_POST["course_name"],  
                'course_type'       =>     $_POST["course_type"],
				'prices'            =>     $_POST["prices"],  
			);
			$_SESSION["cart"][] = $item_array;
		}
	}

	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["cart"] as $keys => $values)
		{
			if($values["course_id"] == $_POST["course_id"])
			{
				unset($_SESSION["cart"][$keys]);
			}
		}
	}
}


//Search chọn khoa hoc
if(isset($_POST["key"])){
    $arr=explode(' ', $_POST["key"]);
    $keyword='%'.implode('%', $arr).'%';
    $qrCo = new db_query("SELECT * FROM courses  WHERE course_name LIKE '$keyword' ");
    while ($rowCit = mysql_fetch_array($qrCo->result)) {
        $in_session = "0";
        if (isset($_SESSION["cart"])) {
            $array_column = array_column($_SESSION["cart"], 'course_id');
            if (array_search($rowCit['course_id'], $array_column) !== false) {
                $in_session = "1";
            }
        }
        if ($in_session != "0") {
            $none1 = 'style="display:none"';
        }else{
            $none1 = '';
        }
        if($in_session != "1"){
            $none2 = 'style="display:none"';
        }else{
            $none2 = '';
        }
        echo '
    <input type="hidden" value="'.$rowCit['course_name'].'" id="name'.$rowCit['course_id'].'">
                        <input type="hidden" value="'.$rowCit['price_promotional'].'"
                            id="price'.$rowCit['course_id'].'">
                        <input type="hidden" value="'.$rowCit['course_type'].'" id="type'.$rowCit['course_id'].'">
                        <tr>
                            <td>'.$rowCit['course_id'].'</td>
                            <td>'.$rowCit['course_name'].'</td>
                            <td class="gach">'.number_format($rowCit['price_listed']) .' đ</td>
                            <td>'.number_format($rowCit['price_promotional']).' đ</td>
                            <td>
                                <input type="button" id="'.$rowCit['course_id'].'" value="Thêm" '.$none1.' onclick="addcart(this)" class="add_to_cart" />
                                <input type="button" value="Đã Thêm" class="added" '.$none2.' id="del'.$rowCit['course_id'].'" />
                            </td>
                        </tr>
    ';
    }
}
?>