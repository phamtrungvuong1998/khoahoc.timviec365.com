<?php
include_once '../config/config.php';
//manager giang vien
    //PC
    if(isset($_POST['type'])){
        $search = $_POST['search'];
        $cookie_id = $_POST['cookie_id'];
        $arr=explode(' ', $search);
        $keyword='%'.implode('%', $arr).'%';
        $output = "";
        if($_POST['type'] == 'offline'){
            $db = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE user_id = $cookie_id AND course_type = 1 AND (course_name LIKE '$keyword' OR cate_name LIKE '$keyword') AND hide_course = 1 ORDER BY courses.course_id DESC");
            if (mysql_num_rows($db->result) > 0) {
                while ($rowc = mysql_fetch_array($db->result)) {
                    if ($rowc['price_listed'] == -1) {
                        $price_listed = "Chưa cập nhật";
                    }else {
                        $price_listed = number_format($rowc['price_listed']) . " đ";
                    }

                    if ($rowc['price_promotional'] == -1) {
                        $price_promotional = "Chưa cập nhật";
                    }else{
                        $price_promotional = number_format($rowc['price_promotional']) . " đ";
                    }
                    $output .= '
                        <div class="v_noidungkh" id="v_noidungkh-'.$rowc['course_id'].'">
                            <div class="v_content-list v_monhoc"><p>'.$rowc['course_name'].'</p></div>
                            <div class="v_content-list">'.$rowc['cate_name'].'</div>
                            <div class="v_content-list v_trungtam">'.$rowc['time_learn'].'</div>
                            <div class="v_content-list">'.$rowc['course_slide'].'</div>
                            <div class="v_content-list">'.$price_listed.' đ</div>
                            <div class="v_content-list">'.$price_promotional.'</div>
                            <div class="v_content-list">'.date("d-m-Y", $rowc['created_at']) .'</div>
                            <div class="v_content-list v_bacham">
                                <button class="v_btn-bacham" onclick="v_bacham('.$rowc['course_id'].')"><img
                                        src="../img/More.svg" alt="Ảnh lỗi"></button>
                                <div class="v_popup" id="v_popup-'.$rowc['course_id'].'">
                                    <center><a
                                            href="/cap-nhat-khoa-hoc-offline-giang-vien/id'.$cookie_id.'-courseOf'.$rowc['course_id'].'.html"
                                            class="v_btn-buy"><img src="../img/chinh-sua.svg" alt="Ảnh l">CHỈNH
                                            SỬA</a></center>
                                </div>
                            </div>
                        </div>
                    ';
                }
                echo $output;
            }else{
                echo "Không tìm thấy bản ghi";
            }
        }elseif($_POST['type'] == 'online'){
            $db = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE user_id = $cookie_id AND course_type = 2 AND (course_name LIKE '$keyword' OR cate_name LIKE '$keyword') AND hide_course = 1 ORDER BY courses.course_id DESC");
            if (mysql_num_rows($db->result)) {
                while ($rowc = mysql_fetch_array($db->result)) {
                    if ($rowc['price_listed'] == -1) {
                        $price_listed = "Chưa cập nhật";
                    }else {
                        $price_listed = number_format($rowc['price_listed']) . " đ";
                    }

                    if ($rowc['price_promotional'] == -1) {
                        $price_promotional = "Chưa cập nhật";
                    }else{
                        $price_promotional = number_format($rowc['price_promotional']) . " đ";
                    }
                    $output .= '
                        <div class="v_noidungkh" id="v_noidungkh-'.$rowc['course_id'].'">
                            <div class="v_content-list v_monhoc"><p>'.$rowc['course_name'].'</p></div>
                            <div class="v_content-list">'.$rowc['cate_name'].'</div>
                            <div class="v_content-list v_trungtam">'.$rowc['time_learn'].'</div>
                            <div class="v_content-list">'.$rowc['course_slide'].'</div>
                            <div class="v_content-list">'.$price_listed.'</div>
                            <div class="v_content-list">'.$price_promotional.'</div>
                            <div class="v_content-list">'.date("d-m-Y", $rowc['created_at']) .'</div>
                            <div class="v_content-list v_bacham">
                                <button class="v_btn-bacham" onclick="v_bacham('.$rowc['course_id'].')"><img
                                        src="../img/More.svg" alt="Ảnh lỗi"></button>
                                <div class="v_popup" id="v_popup-'.$rowc['course_id'].'">
                                    <center><a
                                            href="/cap-nhat-khoa-hoc-online-giang-vien/id'.$cookie_id.'-courseOf'.$rowc['course_id'].'.html"
                                            class="v_btn-buy"><img src="../img/chinh-sua.svg" alt="Ảnh l">CHỈNH
                                            SỬA</a></center>
                                </div>
                            </div>
                        </div>
                    ';
                }
                echo $output;
            }else{
                echo "Không tìm thấy bản ghi";
            }
        }elseif($_POST['type'] == 'khdaban'){
            $course_type = getValue('course_type','int','POST','');
            $db = new db_query("SELECT * FROM  orders JOIN users ON users.user_id = orders.user_student_id JOIN courses ON courses.course_id = orders.course_id 
                JOIN categories ON categories.cate_id = courses.cate_id WHERE courses.user_id = $cookie_id AND orders.course_type = $course_type AND (orders.order_id LIKE '$keyword' OR courses.course_name LIKE '$keyword' OR users.user_name LIKE '$keyword')");
                                            
            if (mysql_num_rows($db->result)) {
                while ($rowc = mysql_fetch_array($db->result)) {
                    if($rowc['course_status'] == 1){
                        $status = 'Đang dạy';
                    }elseif($rowc['course_status'] == 2){
                        $status = 'Kết thúc';
                    }else{
                        $status = 'Đang chờ dạy';
                    }
                    if ($rowc['price_listed'] == -1) {
                        $price_listed = "Chưa cập nhật";
                    }else {
                        $price_listed = number_format($rowc['price_listed']) . " đ";
                    }

                    if ($rowc['price_promotional'] == -1) {
                        $price_promotional = "Chưa cập nhật";
                    }else{
                        $price_promotional = number_format($rowc['price_promotional']) . " đ";
                    }
                    if ($course_type == 1) {
                        $linkC = urlDetail_courseOffline($rowc['course_id'],$rowc['course_slug']);
                    }else if ($course_type == 2) {
                        $linkC = urlDetail_courseOnline($rowc['course_id'],$rowc['course_slug']);
                    }
                    $output .= '
                        <div class="v_noidungkh" id="v_noidungkh-">
                            <div class="v_content-list">'.$rowc['order_id'].'</div>
                            <div class="v_content-list v_kh1"><a href="'.$linkC.'" class="v_kh">'.$rowc['course_name'].'</a></div>
                            <div class="v_content-list v_trungtam">
                                <p class="v_name-hv">'.$rowc['user_name'].'</p>
                                <p class="v_contact-hv">'.$rowc['user_mail'].'</p>
                                <p class="v_contact-hv">'.$rowc['user_phone'].'</p>
                            </div>
                            <div class="v_content-list">'.date("d-m-Y", $rowc['day_buy']).'</div>
                            <div class="v_content-list">'.$price_listed.'</div>
                            <div class="v_content-list">'.$price_promotional.'</div>
                        </div>
                    ';
                }
                echo $output;
            }else{
                echo "Không tìm thấy bản ghi";
            }
        }elseif($_POST['type'] == 'qldanhgia'){
            $db = new db_query("SELECT * FROM rate_course JOIN courses ON courses.course_id = rate_course.course_id JOIN users on users.user_id = rate_course.user_student_id WHERE courses.user_id = $cookie_id AND (rate_course.rate_id LIKE '$keyword' OR courses.course_name LIKE '$keyword')");
                                            
            if (mysql_num_rows($db->result)) {
                while ($row1 = mysql_fetch_array($db->result)) {
                    $rate_id = $row1['rate_id'];
                    if($row1['course_type'] == 2){
                        $total_rate = ($row1['lesson'] + $row1['video'] + $row1['teacher'])/3;
                    }elseif($row1['course_type'] == 1){
                        $total_rate = ($row1['lesson'] + $row1['teacher'])/2;
                    }
                    $output .= '
                        <div class="v_noidungkh" id="v_noidungkh-'.$rate_id.'">
                            <div class="v_content-list v_monhoc">'.$rate_id.'</div>
                            <div class="v_content-list">'.$row1['course_name'].'</div>
                            <div class="v_content-list v_trungtam">
                                <p class="v_name-hv">'.$row1['comment_rate'].'</p>
                                <div style="display: flex;">';
                                    for ($i=0; $i < $total_rate; $i++) { 
                                    $output .= '<p><img src="../img/star.svg" alt="Ảnh lỗi"></p>';
                                    }
                    $output .= '</div>
                            </div>
                            <div class="v_content-list">
                                <div class="v_reply-div">
                                    <p><img src="../img/tra-loi-danh-gia.svg" alt="Ảnh lỗi"></p>
                                    <p><button onclick="v_reply('.$rate_id.')" class="v_reply">Trả lời đánh giá</button></p>
                                    <form class="v_reply-detail" id="v_reply-'.$rate_id.'">
                                        <center><textarea name="comment_rep" id="comment_rep"></textarea></center>
                                        <button><a class="v_reply-detail-a" href="">GỬI</a></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                }
                echo $output;
            }else{
                echo "Không tìm thấy bản ghi";
            }
        }elseif($_POST['type'] == 'qlmagiamgia'){
            $db = new db_query("SELECT * FROM discount_code WHERE user_id = $cookie_id AND (code_id LIKE '$keyword' OR code_name LIKE '$keyword' )");
                                            
            if (mysql_num_rows($db->result)) {
                while ($rowc = mysql_fetch_array($db->result)) {
                    if($rowc['code_status']==0){
                        $status =  'Còn Hạn';
                    }else{
                        $status = 'Hết Hạn';
                    }
                    $output .= '
                        <div class="v_noidungkh" id="v_noidungkh">
                                <div class="v_content-list v_monhoc v_trungtam">'.$rowc['code_name'].'</div>
                                <div class="v_content-list">'.$rowc['quantity'].'</div>
                                <div class="v_content-list">'.number_format($rowc['discount_money']).' đ</div>
                                <div class="v_content-list">'.$rowc['date_start'].' - '.$rowc['date_end'].'</div>
                                <div class="v_content-list v_status">'.$status.'</div>
                                <div class="v_content-list v_bacham">
                                    <button class="v_btn-bacham" onclick="v_bacham('.$rowc['code_id'].')"><img
                                            src="../img/More.svg" alt="Ảnh lỗi"></button>
                                    <div class="v_popup" id="v_popup-'.$rowc['code_id'].'">
                                        <center><a
                                                href="/giang-vien-cap-nhat-ma-giam-gia/id'.$cookie_id.'-code'.$rowc['code_id'].'.html"
                                                class="v_btn-buy"><img src="../img/chinh-sua.svg" alt="Ảnh l">CHỈNH
                                                SỬA</a></center>
                                    </div>
                                </div>
                            </div>
                    ';
                }
                echo $output;
            }else{
                echo "Không tìm thấy bản ghi";
            }
        }elseif($_POST['type'] == 'khmuachung'){
            $db = new db_query("SELECT * FROM order_common JOIN courses ON courses.course_id = order_common.course_id WHERE courses.user_id = $cookie_id AND (courses.course_name LIKE '$keyword' OR order_common.common_id LIKE '$keyword')");
                                            
            if (mysql_num_rows($db->result)) {
                while ($rowc = mysql_fetch_array($db->result)) {
                    $common_id = $rowc['common_id'];
                    if ($rowc['price_promotional'] == -1) {
                        $price = $rowc['price_listed'];
                    }else{
                        $price = $rowc['price_promotional'];
                    }
                    $output .= '
                        <div class="v_noidungkh" id="v_noidungkh-'.$common_id.'">
                            <div class="v_content-list v_monhoc">'.$common_id.'</div>
                            <div class="v_content-list"><a href="'.urlDetail_courseOnline($rowc['course_id'],$rowc['course_slug']).'">'.$rowc['course_name'].'</a></div>
                            <div class="v_content-list">'.number_format($rowc['price_discount']).' đ</div>
                            <div class="v_content-list">'.number_format($price).' đ</div>
                            <div class="v_content-list v_trungtam">
                                '.$rowc['numbers'] .'/'.$rowc['quantity_std'] .'
                                <ul class="v_none v_hv-dk">';
                                $qr2 = new db_query("SELECT * FROM order_student_common INNER JOIN users ON order_student_common.user_student_id = users.user_id WHERE common_id = $common_id");
                                while ($row2 = mysql_fetch_array($qr2->result)) {
                                    $output .= '
                                    <li>
                                        <a href="'.urlDetail_student($row2['user_id'],$row2['user_slug']).'" class="v_name">'.$row2['user_name'].'</a>
                                    </li>
                                    ';
                                }
                    $output .= ' 
                                </ul>
                            </div>
                        </div>';
                }
                echo $output;
            }else{
                echo "Không tìm thấy bản ghi";
            }
        }elseif($_POST['type'] == 'lsgiaodich'){
            $db = new db_query("SELECT * FROM user_transaction WHERE user_id = $cookie_id AND created_at = '$search'"); 
            if(mysql_num_rows($db->result)>0){                               
                while($rowt = mysql_fetch_array($dbt->result)){
                    if($rowt['plus_minus'] == 0){
                        $plus = "-";
                    }else{
                        $plus = "+";
                    }
                        $output .= '
                            <div class="v_noidungkh" id="v_noidungkh-'.$rowt['transaction_id'] .'">
                                <div class="v_content-list">'.$rowt['transaction_id'] .' </div>
                                <div class="v_content-list">'.$rowt['transaction_content'] .'</div>
                                <div class="v_content-list">'.date("d-m-Y", $rowt['created_at']).'</div>
                                <div class="v_content-list v_trungtam">'.$plus.''.number_format($rowt['withdrawal_amount']) .'</div>
                                <div class="v_content-list">'.number_format($rowt['total_money']) .'</div>
                            </div>
                            ';
                    }
                echo $output;
            }else{
                echo "Không tìm thấy bản ghi";
            }
        }
    }

    //Mobile
    if (isset($_POST['type2'])) {
        $search = $_POST['search'];
        $cookie_id = $_POST['cookie_id'];
        $arr=explode(' ', $search);
        $keyword='%'.implode('%', $arr).'%';
        $output = "";
        if ($_POST['type2'] == 'offline') {
            $db = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE user_id = $cookie_id AND course_type = 1 AND (course_name LIKE '$keyword' OR cate_name LIKE '$keyword') AND hide_course = 1 ORDER BY course_id DESC");
            if (mysql_num_rows($db->result)) {
                while ($rowc = mysql_fetch_array($db->result)) {
                    if ($rowc['price_listed'] == 'false') {
                        $price_listed = "Chưa cập nhật";
                    }else {
                        $price_listed = number_format($rowc['price_listed']) . " đ";
                    }

                    if ($rowc['price_promotional'] == 'false') {
                        $price_promotional = "Chưa cập nhật";
                    }else{
                        $price_promotional = number_format($rowc['price_promotional']) . " đ";
                    }
                    $output .= '
                        <div class="v_content-mb">
                            <div class="flex v_content-mb-div">
                                <p class="v_content-mb-title">'.$rowc['course_name'].'</p>
                            </div>

                            <div class="flex v_info-all v_content-mb-div">
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Môn học :</span>
                                    '.$rowc['cate_name'].'</div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Giá gốc:
                                    </span>'.$price_listed.'
                                </div>
                                div class="v_content-mb-thongtin"><span class="v_content-mb-span">Giá Khuyến mại:
                                    </span>'.$price_promotional.'
                                </div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số lượng bải giảng
                                        :</span>'.$rowc['course_slide'].' video</div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tài liệu :</span>
                                    '.$rowc['course_slide'].' file
                                </div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Ngày đăng :</span>
                                    '.date("d-m-Y", $rowc['created_at']) .'</div>
                            </div>

                            <div class="flex v_mb-ghichu-all v_content-mb-div">
                                <div class="v_mb-edit-div"><a
                                        href="/cap-nhat-khoa-hoc-offline-giang-vien/id'.$cookie_id.'-courseOf'.$rowc['course_id'].'.html"
                                        class="v_mb-edit"><img src="../img/chinh-sua.svg" alt="Ảnh lỗi">Chỉnh sửa</a></div>
                            </div>
                        </div>
                    ';
                }
                echo $output;
            }
        }elseif ($_POST['type2'] == 'online') {
            $db = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id  WHERE user_id = $cookie_id AND course_type = 2 AND (course_name LIKE '$keyword' OR cate_name LIKE '$keyword') AND hide_course = 1 ORDER BY course_id DESC");
            if (mysql_num_rows($db->result) != 0) {
                while ($rowc = mysql_fetch_array($db->result)) {
                    if ($rowc['price_listed'] == -1) {
                        $price_listed = "Chưa cập nhật";
                    }else {
                        $price_listed = number_format($rowc['price_listed']) . " đ";
                    }

                    if ($rowc['price_promotional'] == -1) {
                        $price_promotional = "Chưa cập nhật";
                    }else{
                        $price_promotional = number_format($rowc['price_promotional']) . " đ";
                    }
                    $output .= '
                        <div class="v_content-mb">
                            <div class="flex v_content-mb-div">
                                <p class="v_content-mb-title">'.$rowc['course_name'].'</p>
                            </div>

                            <div class="flex v_info-all v_content-mb-div">
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Môn học :</span>
                                    '.$rowc['cate_name'].'</div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Giá gốc:
                                    </span>'.$price_listed.'
                                </div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Giá khuyến mại:
                                    </span>'.$price_promotional.'
                                </div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số lượng bải giảng
                                        :</span>'.$rowc['course_slide'].' video</div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tài liệu :</span>
                                    '.$rowc['course_slide'].' file
                                </div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Ngày đăng :</span>
                                    '.date("d-m-Y", $rowc['created_at']) .'</div>
                            </div>

                            <div class="flex v_mb-ghichu-all v_content-mb-div">
                                <div class="v_mb-edit-div"><a
                                        href="/cap-nhat-khoa-hoc-offline-giang-vien/id'.$cookie_id.'-courseOf'.$rowc['course_id'].'.html"
                                        class="v_mb-edit"><img src="../img/chinh-sua.svg" alt="Ảnh lỗi">Chỉnh sửa</a></div>
                            </div>
                        </div>
                    ';
                }
                echo $output;
            }
        }elseif($_POST['type2'] == 'qldanhgia'){
            $db = new db_query("SELECT * FROM rate_course JOIN courses ON courses.course_id = rate_course.course_id JOIN users on users.user_id = rate_course.user_student_id WHERE courses.user_id = $cookie_id AND (rate_course.rate_id LIKE '$keyword' OR courses.course_name LIKE '$keyword')");
                                            
            if (mysql_num_rows($db->result)) {
                while ($row1 = mysql_fetch_array($db->result)) {
                    $rate_id = $row1['rate_id'];
                    if($row1['course_type'] == 2){
                        $total_rate = ($row1['lesson'] + $row1['video'] + $row1['teacher'])/3;
                    }elseif($row1['course_type'] == 1){
                        $total_rate = ($row1['lesson'] + $row1['teacher'])/2;
                    }
                    $output .= '
                        <div class="v_content-mb">
                            <div class="flex v_content-mb-div">
                                <!-- <p class="v_content-mb-stt">1.</p> -->
                                <p class="v_content-mb-title">'.$row1['course_name'].'</p>
                            </div>

                            <p class="v_tengiangvien">'.$row1['user_name'].'</p>

                            <div class="v_info-all v_content-mb-div">
                                <div class="v_content-mb-thongtin"><span class="v_info-all-span">Học viên :</span>
                                    '.$row1['user_name'].'</div>
                                <div class="v_content-mb-thongtin"><span class="v_info-all-span">Mã đánh giá:</span>
                                    '.$rate_id.'
                                </div>
                            </div>

                            <center class="v_danh-gia-center">
                                <div class="v_danh-gia">
                                    <p class="v_danh-gia-title">Đánh giá:</p>
                                    <p class="v_danh-gia-content">'.$row1['comment_rate'].'</p>';

                                for ($i=0; $i < $total_rate; $i++) { 
                                    $output .= '<p><img class="v_danh-gia-star" src="../img/star.svg" alt="Ảnh lỗi"></p> ';
                                    }
                        $output .= '
                                </div>
                            </center>
                        </div>
                    ';
                }
                echo $output;
            }
        }elseif($_POST['type2'] == 'qlmagiamgia'){
            $db = new db_query("SELECT * FROM discount_code WHERE user_id = $cookie_id AND (code_id LIKE '$keyword' OR code_name LIKE '$keyword' )");
                                            
            if (mysql_num_rows($db->result)) {
                while ($rowc = mysql_fetch_array($db->result)) {
                    if($rowc['code_status']==0){
                        $status =  'Còn Hạn';
                    }else{
                        $status = 'Hết Hạn';
                    }
                    $output .= '
                        <div class="v_content-mb">
                            <div class="flex v_content-mb-div">
                                <p class="v_content-mb-title">'.$rowc['code_name'].'</p>
                            </div>

                            <div class="flex v_info-all v_content-mb-div">
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã giảm giá :</span>
                                    '.$rowc['code_id'].'</div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số lượng
                                    </span>'.$rowc['quantity'].'</div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Số tiền giảm giá :</span>
                                    '.number_format($rowc['discount_money']).' đ</div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Thời gian sử dụng
                                        :</span>
                                    '.$rowc['date_start'].' - '.$rowc['date_end'].'</div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Trạng thái :</span>
                                    '.$status.'
                                </div>
                            </div>
                        </div>
                    ';
                }
                echo $output;
            }
        }elseif($_POST['type2'] == 'khmuachung'){
            $db = new db_query("SELECT * FROM order_common JOIN courses ON courses.course_id = order_common.course_id WHERE courses.user_id = $cookie_id AND (courses.course_name LIKE '$keyword' OR order_common.common_id LIKE '$keyword' )");
                                            
            if (mysql_num_rows($db->result)) {
                while ($rowc = mysql_fetch_array($db->result)) {
                    $common_id = $rowc['common_id'];
                    if ($rowc['price_promotional'] == -1) {
                        $price = $rowc['price_listed'];
                    }else{
                        $price = $rowc['price_promotional'];
                    }
                    $output .= '
                        <div class="v_content-mb">
                        <div class="flex v_content-mb-div">
                            <p class="v_content-mb-title">'.$rowc['course_name'] .'</p>
                        </div>

                        <div class="flex v_info-all v_content-mb-div">
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã đơn hàng
                                    :</span>'.$rowc['common_id'] .'</div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Học phí:
                                </span>'.number_format($rowc['price_discount']) .' đ
                            </div>
                            <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tổng tiền
                                    :</span>'.number_format($price) .' đ
                            </div>
                            <div class="v_content-mb-thongtin v_hv_common" onclick="v_hv_common1(this)">
                                <span class="v_content-mb-span">Học viên chờ :</span>';
                            for ($i = 0; $i < $rowc['numbers']; $i++) {
                                $output .= '<img src="../../img/hoc-vien-cho.svg" alt="Ảnh lỗi">';
                            }
                            $output .= '<div class="v_info_hv">';
                            $qr2 = new db_query("SELECT * FROM order_student_common INNER JOIN users ON order_student_common.user_student_id = users.user_id WHERE common_id = $common_id");
                            while($row2 = mysql_fetch_array($qr2->result)){ 
                            $output .= '<a href="'.urlDetail_student($row2['user_id'],$row2['user_slug']).'">'.$row2['user_name'].'</a>';
                            }

                            $output .= '    </div>
                                   </div>
                            </div>
                        </div>';
                }
                echo $output;
            }
        }elseif($_POST['type2'] == 'khdaban'){
            $course_type = getValue('course_type','int','POST','');
            $db = new db_query("SELECT * FROM  orders JOIN users ON users.user_id = orders.user_student_id JOIN courses ON courses.course_id = orders.course_id 
                JOIN categories ON categories.cate_id = courses.cate_id WHERE courses.user_id = $cookie_id AND orders.course_type = $course_type AND (orders.order_id LIKE '$keyword' OR courses.course_name LIKE '$keyword' OR users.user_name LIKE '$keyword')");
                                            
            if (mysql_num_rows($db->result)) {
                while ($rowc = mysql_fetch_array($db->result)) {
                    if($rowc['course_status'] == 1){
                        $status = 'Đang dạy';
                    }elseif($rowc['course_status'] == 2){
                        $status = 'Kết thúc';
                    }else{
                        $status = 'Đang chờ dạy';
                    }

                    if ($rowc['price_listed'] == 'false') {
                        $price_listed = "Chưa cập nhật";
                    }else {
                        $price_listed = number_format($rowc['price_listed']) . " đ";
                    }

                    if ($rowc['price_promotional'] == 'false') {
                        $price_promotional = "Chưa cập nhật";
                    }else{
                        $price_promotional = number_format($rowc['price_promotional']) . " đ";
                    }

                    if ($rowc['course_type'] == 2) {
                        $a = "Ngày giao dịch";
                    }else if ($rowc['course_type'] == 1){
                        $a = "Ngày đặt chỗ";
                    }
                    $output .= '
                        <div class="v_content-mb">
                            <div class="flex v_content-mb-div">
                                <p class="v_content-mb-title">'.$rowc['course_name'].'
                                </p>
                            </div>

                            <div class="flex v_info-all v_content-mb-div">
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Mã đơn hàng :</span>
                                    '.$rowc['order_id'].'
                                </div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Môn học :</span>
                                    '.$rowc['cate_name'].'</div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Tên học viên :</span>
                                    '.$rowc['user_name'].'</div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">'.$a.'
                                    </span>'.date("d-m-Y", $rowc['day_buy']).'</div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Giá gốc :</span>
                                    '.$price_listed.'
                                </div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Giá gốc :</span>
                                    '.$price_promotional.'
                                </div>
                                <div class="v_content-mb-thongtin"><span class="v_content-mb-span">Trạng thái :</span>
                                    '.$status.'
                                </div>
                            </div>
                        </div>
                    ';
                }
                echo $output;
            }
        }
    }




//Admin
    //QUản lý Điểm
    if(isset($_POST['point'])){
        $user_id = $_POST['user_id'];
        if($_POST['point']=="center_teacher"){
            $qr = new db_query("SELECT * FROM points JOIN users ON users.user_id = points.user_id WHERE users.user_type = $user_id ");
        }elseif($_POST['point']=="pointnamemail"){
            $qr = new db_query("SELECT * FROM points JOIN users ON users.user_id = points.user_id WHERE users.user_id = $user_id ");
        }
        $i = 1;
        while ($rowHV = mysql_fetch_array($qr->result)) {
                if ($rowHV['user_type'] == 2) {
                    $link = urlDetail_teacher($rowHV['user_id'],$rowHV['user_slug']);
                }elseif($rowHV['user_type'] == 3){
                    $link = urlDetail_center($rowHV['user_id'],$rowHV['user_slug']);
                }
                echo '
                    <tr>
                        <td>'.$i++ .'</td>
                        <td><a href="'.$link.'">'.$rowHV['user_name'].'</a></td>
                        <td>'.$rowHV['user_mail'] .'</td>
                        <td>'.$rowHV['point'] .'</td>
                        <td>'.$rowHV['point_add_total'] .'</td>
                        <td><img id="admin_edit'.$rowHV['point_id'] .'"
                                src="../img/vv_edi.svg" onclick="v_teacher_edit('.$rowHV['point_id'] .')"
                                alt="Ảnh lỗi"></td>
                    </tr>
                ';
                $i++;
            }
    }

    //QUản lý Đơn hàng
    if(isset($_POST['order'])){
        if($_POST['order']=="ordertnamemail"){
            $user_id = $_POST['user_id'];
            $qr = new db_query("SELECT * FROM orders JOIN courses ON courses.course_id = orders.course_id JOIN users ON users.user_id = orders.user_student_id WHERE orders.user_student_id = $user_id ");
        }if($_POST['order']=="order_id"){
            $user_id = $_POST['user_id'];
            $qr = new db_query("SELECT * FROM orders JOIN courses ON courses.course_id = orders.course_id JOIN users ON users.user_id = orders.user_student_id WHERE order_id = $user_id ");
        }elseif($_POST['order']=="orderstatus"){
            $user_id = $_POST['user_id'];
            $qr = new db_query("SELECT * FROM orders JOIN courses ON courses.course_id = orders.course_id JOIN users ON users.user_id = orders.user_student_id WHERE orders.order_status = $user_id");
        }elseif($_POST['order']=="orderbuy"){
                $fromdate = strtotime(date($_POST['fromdate']));
            if(isset($_POST['actived']) && $_POST['actived']==1){
                $qr = new db_query("SELECT * FROM orders JOIN courses ON courses.course_id = orders.course_id JOIN users ON users.user_id = orders.user_student_id WHERE orders.day_buy = '$fromdate' "); 
            }else{
                $todate = strtotime(date($_POST['todate']));
                $qr = new db_query("SELECT * FROM orders JOIN courses ON courses.course_id = orders.course_id JOIN users ON users.user_id = orders.user_student_id WHERE orders.day_buy >= '$fromdate' AND orders.day_buy <= '$todate'"); 
            }
        }
        $i = 1;
        while ($rowHV = mysql_fetch_array($qr->result)) {
            if ($rowHV['order_status'] == 1) {
                $order_status = "<span style='color:green'>Thành công</span>";
            }else{
                $order_status = "<span style='color:red'>Chưa thanh toán</span>";
            }
            echo '
                <tr>
                    <td>'.$i++ .'</td>
                    <td>'. $rowHV['order_id'].'</td>
                    <td><a
                            href="'.urlDetail_student($rowHV['user_id'],$rowHV['user_slug']).'">'. $rowHV['user_name'].'</a>
                    </td>
                    <td>'. $rowHV['user_mail'].'</td>
                    <td>'. $rowHV['user_phone'].'</td>
                    <td>'. $rowHV['user_address'].'</td>
                    <td>'. $rowHV['course_name'].'</td>
                    <td>'. number_format($rowHV['total_prices']).' đ</td>
                    <td>'. date("d-m-Y", $rowHV['day_buy']) .'</td>
                </tr>
            ';
            $i++;
        }
    }

    //Danh sách nạp tiền
    if(isset($_POST['trans'])){
        if($_POST['trans']=="transtatus"){
            $user_id = $_POST['user_id'];
            $qr = new db_query("SELECT * FROM user_transaction JOIN users ON users.user_id = user_transaction.user_id JOIN bank ON bank.bank_id = user_transaction.bank_id WHERE user_type = 1 AND status = $user_id ORDER BY transaction_id");
        }elseif($_POST['trans']=="transname"){
            $user_id = $_POST['user_id'];
            $qr = new db_query("SELECT * FROM user_transaction JOIN users ON users.user_id = user_transaction.user_id JOIN bank ON bank.bank_id = user_transaction.bank_id WHERE users.user_id = $user_id ORDER BY transaction_id");
        }elseif($_POST['trans']=="fromdate"){
            $fromdate = strtotime(date($_POST['fromdate']));
            $qr = new db_query("SELECT * FROM user_transaction JOIN users ON users.user_id = user_transaction.user_id JOIN bank ON bank.bank_id = user_transaction.bank_id WHERE user_transaction.created_at = '$fromdate' ORDER BY transaction_id");
        }elseif($_POST['trans']=="betweenday"){
            $fromdate = strtotime(date($_POST['fromdate']));
            $todate = strtotime(date($_POST['todate']));
            $qr = new db_query("SELECT * FROM user_transaction JOIN users ON users.user_id = user_transaction.user_id JOIN bank ON bank.bank_id = user_transaction.bank_id WHERE user_transaction.created_at >= '$fromdate' AND user_transaction.created_at <= '$todate' ORDER BY transaction_id");
        }
        $i = 1;
        while ($rowHV = mysql_fetch_array($qr->result)) {
                if ($rowHV['status'] == 1) {
                    $status = '<span style="color:green">Thành công</span>';
                }elseif($rowHV['user_type'] == 2){
                    $status = '<span style="color:red">Thất bại</span>';
                }else{
                    $status = '<span style="color:black">Đang chờ</span>';
                }
                echo '
                    <tr>
                        <td>'.$i.'</td>
                        <td><a
                                href="'.urlDetail_student($rowHV['user_id'],$rowHV['user_slug']).'">'.$rowHV['user_name'].'</a>
                        </td>
                        <td>'.$rowHV['transaction_name'].'</td>
                        <td>'.number_format($rowHV['total_money']).'</td>
                        <td>'.$rowHV['bank_name'].'</td>
                        <td>'.$rowHV['bank_name'].'</td>
                        <td>'.$rowHV['acc_number'].'</td>
                        <td>'.$rowHV['transaction_date'].'</td>
                        <td class="transaction_content">'.$rowHV['transaction_content'].'</td>
                        <td>'.$status .'</td>
                    </tr>
                ';
                $i++;
            }
    }


    //Khóa học offline
    if(isset($_POST['offline'])){
        $course_type = 1;
        if($_POST['offline']=="course_name"){
            $user_id = $_POST['user_id'];
            $qr = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id WHERE  course_type = $course_type AND courses.course_id = $user_id ORDER BY course_id DESC");
        }elseif($_POST['offline']=="category"){
            $user_id = $_POST['user_id'];
            $qr = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id WHERE  course_type = $course_type AND courses.cate_id = $user_id ORDER BY course_id DESC");
        }elseif($_POST['offline']=="fromdate"){
            $fromdate = strtotime(date($_POST['fromdate']));
            $qr = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id WHERE courses.created_at = '$fromdate' AND course_type = $course_type ORDER BY course_id DESC");
        }elseif($_POST['offline']=="betweenday"){
            $fromdate = strtotime(date($_POST['fromdate']));
            $todate = strtotime(date($_POST['todate']));
            $qr = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id WHERE courses.created_at >= '$fromdate' AND courses.created_at <= '$todate'  AND course_type = $course_type ORDER BY course_id DESC");
        }
        $i = 1;
        while ($rowHV = mysql_fetch_array($qr->result)) {
                echo '
                    <tr>
                        <td>'.$rowHV['course_id'].'</td>
                        <td>'.$rowHV['course_name'].'</td>
                        <td>'.$rowHV['cate_name'].'</td>
                        <td>'.$rowHV['time_learn'].'</td>
                        <td>'.$rowHV['course_slide'].'</td>
                        <td>'.number_format($rowHV['price_promotional']).'</td>
                        <td>'.date("d-m-Y", $rowHV['created_at']) .'</td>
                    </tr>
                ';
                $i++;
            }
    }

    //Khóa học online
    if(isset($_POST['online'])){
        $course_type = 2;
        if($_POST['online']=="course_name"){
            $user_id = $_POST['user_id'];
            $qr = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id WHERE  course_type = $course_type AND courses.course_id = $user_id ORDER BY course_id DESC");
        }elseif($_POST['online']=="category"){
            $user_id = $_POST['user_id'];
            $qr = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id WHERE  course_type = $course_type AND courses.cate_id = $user_id ORDER BY course_id DESC");
        }elseif($_POST['online']=="fromdate"){
            $fromdate = strtotime(date($_POST['fromdate']));
            $qr = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id WHERE courses.created_at = '$fromdate' AND course_type = $course_type ORDER BY course_id DESC");
        }elseif($_POST['online']=="betweenday"){
            $fromdate = strtotime(date($_POST['fromdate']));
            $todate = strtotime(date($_POST['todate']));
            $qr = new db_query("SELECT * FROM courses JOIN categories ON categories.cate_id = courses.cate_id WHERE courses.created_at >= '$fromdate' AND courses.created_at <= '$todate'  AND course_type = $course_type ORDER BY course_id DESC");
        }
        $i = 1;
        while ($rowHV = mysql_fetch_array($qr->result)) {
                echo '
                    <tr>
                        <td>'.$rowHV['course_id'].'</td>
                        <td>'.$rowHV['course_name'].'</td>
                        <td>'.$rowHV['cate_name'].'</td>
                        <td>'.$rowHV['time_learn'].'</td>
                        <td>'.$rowHV['course_slide'].'</td>
                        <td>'.number_format($rowHV['price_promotional']).'</td>
                        <td>'.date("d-m-Y", $rowHV['created_at']) .'</td>
                    </tr>
                ';
                $i++;
            }
    }
?>