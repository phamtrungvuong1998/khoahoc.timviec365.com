<?php

session_start();
// session_destroy();
$total_price = 0;
$output = '';

$output = '
<table class="table table-bordered">
<thead>
    <tr id="prd-tr">
        <th scope="col"><b> Mã</b></th>
        <th scope="col"><b>Tên Khóa Học</b></th>
        <th scope="col"><b>Giá </b></th>
    </tr>
</thead>
<tbody id="filtercourse1">
';
if(!empty($_SESSION["cart"]))
{
	foreach($_SESSION["cart"] as $keys => $values)
	{
		$output .= '
         <input type="hidden" value="'.$values["course_id"].'" name="course_id[]" />
         <input type="hidden" value="'.$values["course_type"].'" name="course_type[]" />
		<tr>
            <td>'.$values["course_id"].'</td>
            <td>'.$values["course_name"].'</td>
            <td>'.number_format($values["prices"]).' đ</td>
            <td>
                <input type="button" id="'.$values["course_id"].'" value="Xóa" class="delcart" onclick="delcart(this)" />
            </td>
        </tr>
		';
		$total_price = $total_price +  $values["prices"];
	}
    // print_r($_SESSION["cart"]);
}
$output .='
     </tbody>
                    </table>
';
$data = [
	'cart_details'=>$output,
	'total_price'=>number_format($total_price).' đ',
    'dbtotalprice'=>$total_price
];	

echo json_encode($data);


?>