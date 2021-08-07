<?php

/**
 * @SWG\Swagger(
 *     basePath="/api",
 *     host="localhost:8892",
 *     schemes={"http"},
 * 
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Khóa học timviec365.com",
 *         description="A sample API that uses a petstore as an example to demonstrate features in the swagger-2.0 specification",
 *         termsOfService="http://swagger.io/terms/",
 *         @SWG\Contact(name="Swagger API Team"),
 *         @SWG\License(name="MIT")
 *     ),
 *     @SWG\Definition(
 *         definition="ErrorModel",
 *         type="object",
 *         required={"code", "message"},
 *         @SWG\Property(
 *             property="code",
 *             type="integer",
 *             format="int32"
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     )
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_login.php",
 *     tags={"Dùng chung"},
 *     summary="Đăng nhập",
 * tags={"Dùng chung"},
 *     description="",
 * 
 *     @SWG\Parameter(
 *      name="email",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="pass",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */


/**
 * @SWG\Post(
 *     path="/api_signup.php",
 *     tags={"Dùng chung"},
 *     summary="Đăng kí",
 * tags={"Dùng chung"},
 *     description="",
 * 
 *     @SWG\Parameter(
 *      name="name",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="email",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="phone",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="pass",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Get(
 *     path="/api_authenticate_account.php",
 *     tags={"Dùng chung"},
 *     summary="Xác thực tài khoản",
 *     description="",
 *      @SWG\Parameter(
 *       name="token",
 *       in="path",
 *       required=true,
 *       type="string",
 *     ),
 *      @SWG\Parameter(
 *       name="otp",
 *       in="path",
 *       required=true,
 *       type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_forgot_pass.php",
 *     tags={"Dùng chung"},
 *     summary="Quên mật khẩu",
 * tags={"Dùng chung"},
 *     description="",
 * 
 *     @SWG\Parameter(
 *      name="email",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Get(
 *     path="/api_authenticate_forgot_pass.php",
 *     tags={"Dùng chung"},
 *     summary="Xác thực otp đổi mật khẩu",
 *     description="",
 *      @SWG\Parameter(
 *       name="token",
 *       in="path",
 *       required=true,
 *       type="string",
 *     ),
 *      @SWG\Parameter(
 *       name="otp",
 *       in="path",
 *       required=true,
 *       type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_forgot_change_pass.php",
 *     tags={"Dùng chung"},
 *     summary="Đổi mật khẩu",
 *     description="",
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="password",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/HV_api_index.php",
 *     tags={"Học viên"},
 *     summary="Trang chủ học viên",
 *     tags={"Học viên"},
 *     description="",
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/HV_info_student.php",
 *     tags={"Học viên"},
 *     summary="Thông tin cá nhân học viên",
 *     operationId="",
 *     description="",
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/HV_api_search_course.php",
 *     tags={"Học viên"},
 *     summary="Thanh search",
 *     operationId="",
 *     description="",
 *     
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 * 
 *     @SWG\Parameter(
 *      name="search",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/HV_api_course_bought.php",
 *     tags={"Học viên"},
 *     summary="Khóa học của tôi (Khóa học đã mua)",
 *     operationId="",
 *     description="",
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/HV_api_course_online_save.php",
 *     tags={"Học viên"},
 *     summary="Khóa học online đã lưu",
 *     operationId="",
 *     description="",
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/HV_api_course_offline_save.php",
 *     tags={"Học viên"},
 *     summary="Khóa học offline đã lưu",
 *     operationId="",
 *     description="",
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/HV_api_course_buy_common.php",
 *     tags={"Học viên"},
 *     summary="Khóa học mua chung",
 *     operationId="",
 *     description="",
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/HV_api_save_center.php",
 *     tags={"Học viên"},
 *     summary="Trung tâm đã lưu",
 *     operationId="",
 *     description="",
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Get(
 *     path="/HV_api_delete_save_center.php",
 *     tags={"Học viên"},
 *     summary="Xóa trung tâm đã lưu",
 *     operationId="",
 *     description="",
 *     @SWG\Parameter(
 *      name="token",
 *      in="path",
 *      required=true,
 *      type="string",
 *     ),
 * 
 *     @SWG\Parameter(
 *      name="center_id",
 *      in="path",
 *      required=true,
 *      type="integer",
 *     ),
 *
 * 
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/HV_api_save_teacher.php",
 *     tags={"Học viên"},
 *     summary="Giảng viên đã lưu",
 *     operationId="",
 *     description="",
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Get(
 *     path="/HV_api_delete_save_teacher.php",
 *     tags={"Học viên"},
 *     summary="Xóa giảng viên đã lưu",
 *     operationId="",
 *     description="",
 *     @SWG\Parameter(
 *      name="token",
 *      in="path",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="teacher_id",
 *      in="path",
 *      required=true,
 *      type="integer",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/HV_api_update_info_student.php",
 *     tags={"Học viên"},
 *     summary="Cập nhật thông tin học viên",
 *     operationId="",
 *     description="",
 *     
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 * 
 *     @SWG\Parameter(
 *      name="user_name",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      
 *     @SWG\Parameter(
 *      name="user_avatar",
 *      in="formData",
 *      required=true,
 *      type="file",
 *     ),
 *
 *	   @SWG\Parameter(
 *      name="user_gender",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *     
 *     @SWG\Parameter(
 *      name="user_birth",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *
 *	   @SWG\Parameter(
 *      name="user_phone",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="cit_id",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="district_id",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="user_address",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *
 * 	   @SWG\Parameter(
 *      name="cate_id",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/HV_api_update_password.php",
 *     tags={"Học viên"},
 *     summary="Đổi mật khẩu",
 *     operationId="",
 *     description="",
 *     
 *      @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="password",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/HV_api_send_alert_withdral.php",
 *     tags={"Học viên"},
 *     summary="Gửi thông báo nạp tiên",
 *     operationId="",
 *     description="",
 *     
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 * 
 *     @SWG\Parameter(
 *      name="bank_id",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *     
 *     @SWG\Parameter(
 *      name="amount",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *     
 *     @SWG\Parameter(
 *      name="recharge_form_id",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *     
 *     @SWG\Parameter(
 *      name="bank_recharge",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *     
 *     @SWG\Parameter(
 *      name="recharge_name",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     
 *     @SWG\Parameter(
 *      name="bank_account",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="time_recharge",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     
 *     @SWG\Parameter(
 *      name="content_recharge",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/HV_api_history_course_buy.php",
 *     tags={"Học viên"},
 *     summary="Lịch sử mua khóa học",
 *     operationId="",
 *     description="",
 *     
 *      @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 * 
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
*/

/**
 * @SWG\Post(
 *     path="/HV_api_detail_history_course_buy.php",
 *     tags={"Học viên"},
 *     summary="Chi tiết lịch sử mua",
 *     operationId="",
 *     description="",
 *     
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      
 *     @SWG\Parameter(
 *      name="course_id",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 * 
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
*/

/**
 * @SWG\Post(
 *     path="/HV_history_withdral.php",
 *     tags={"Học viên"},
 *     summary="Lịch sử nạp tiền",
 *     operationId="",
 *     description="",
 *     
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 * 
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
*/

/**
 * @SWG\Post(
 *     path="/HV_detail_history_withdral.php",
 *     tags={"Học viên"},
 *     summary="Chi tiết lịch sử nạp tiền",
 *     operationId="",
 *     description="",
 *     
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 * 
 *     @SWG\Parameter(
 *      name="recharge_id",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 * 
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
*/

/**
 * @SWG\Post(
 *     path="/HV_api_detail_order.php",
 *     tags={"Học viên"},
 *     summary="Chi tiết đơn hàng",
 *     operationId="",
 *     description="",
 *     
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 * 
 *     @SWG\Parameter(
 *      name="order_id",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *      
 *     @SWG\Parameter(
 *      name="code",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 * 
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
*/

/**
 * @SWG\Post(
 *     path="/HV_api_payment.php",
 *     tags={"Học viên"},
 *     summary="Thanh toán đơn hàng",
 *     operationId="",
 *     description="",
 *     
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 * 
 *     @SWG\Parameter(
 *      name="course_id",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *      
 *     @SWG\Parameter(
 *      name="code_id",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 * 
 *      @SWG\Parameter(
 *      name="course_type",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 * 
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
*/

/**
 * @SWG\Post(
 *     path="/tt_gv_api_create_class.php",
 *     tags={"Trung tâm và Giảng viên"},
 *     summary="Tạo khóa học offline",
 *     operationId="",
 *     description="",
 *     
 *     @SWG\Parameter(
 *      name="course_type",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 * 
 *     @SWG\Parameter(
 *      name="course_name",
 *      description="Tên khóa học",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      
 *     @SWG\Parameter(
 *      name="cate_id",
 *      description="Môn học",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 * 
 *      @SWG\Parameter(
 *      name="tag_id",
 *      description="Môn học chi tiết",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 * 
 *      @SWG\Parameter(
 *      name="course_avatar",
 *      description="Ảnh khóa học",
 *      in="formData",
 *      required=true,
 *      type="file",
 *     ),
 *      
 *      @SWG\Parameter(
 *      name="course_describe",
 *      description="Môn tả khóa học",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      
 *      @SWG\Parameter(
 *      name="course_learn",
 *      description="Bạn sẽ học những gì",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      
 *      @SWG\Parameter(
 *      name="center_teacher_id",
 *      in="formData",
 *      description="Giảng viên giảng dạy",
 *      required=true,
 *      type="integer",
 *     ),
 *     
 *      @SWG\Parameter(
 *      name="time_learn",
 *      description="Số buổi học",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *  
 *      @SWG\Parameter(
 *      name="course_slide",
 *      description="Số tài liệu",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *  
 *      @SWG\Parameter(
 *      name="price_listed",
 *      description="Giá gốc",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 * 
 *      @SWG\Parameter(
 *      name="price_promotional",
 *      description="Giá khuyến mại",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 * 
 *      @SWG\Parameter(
 *      name="quantity_std",
 *      description="Số học viên mua chung",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 * 
 *      @SWG\Parameter(
 *      name="price_discount",
 *      description="Khoảng giá mua chung",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *      
 *      @SWG\Parameter(
 *      name="certification",
 *      description="Chứng chỉ",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *      
 *      @SWG\Parameter(
 *      name="level",
 *      description="Trình độ",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *      
 *      @SWG\Parameter(
 *      name="course_address",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *      
 *      @SWG\Parameter(
 *      name="advantages_id",
 *      description="Ưu điểm trung tâm",
 *      in="formData",
 *      required=true,
 *      type="array",
 *      @SWG\Items(type="integer",
 *        enum={1,2,3,4,5} ),
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
*/

/**
 * @SWG\Get(
 *     path="/api_load_city.php",
 *     summary="danh sách tỉnh thành",
 *     operationId="",
 *     tags={"Dùng chung"},
 *     @SWG\Response(
 *         response=200,
 *         description="successful operation",
 *     ),
 *     @SWG\Response(
 *         response="400",
 *         description="Invalid ID supplied"
 *     ),
 *     @SWG\Response(
 *         response="404",
 *         description="Pet not found"
 *     )
 *     
 * )
 */

/**
 * @SWG\Get(
 *     path="/api_load_district.php",
 *     summary="load quận huyện",
 *     operationId="",
 *     tags={"Dùng chung"},
 *     @SWG\Response(
 *         response=200,
 *         description="successful operation",
 *     ),
 *     @SWG\Response(
 *         response="400",
 *         description="Invalid ID supplied"
 *     ),
 *     @SWG\Response(
 *         response="404",
 *         description="Pet not found"
 *     )
 *     
 * )
 */

/**
 * @SWG\Post(
 *     path="/tt_api_signup.php",
 *     tags={"Trung tâm"},
 *     summary="Đăng Ký trung tâm",
 *     description="",
 * 
 *     @SWG\Parameter(
 *      name="name",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="email",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="cate_id",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="pass",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="city",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="district",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="address",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="avatar",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/gv_api_signup.php",
 *     tags={"Giảng viên"},
 *     summary="Đăng Ký giảng viên",
 *     description="",
 * 
 *     @SWG\Parameter(
 *      name="name",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="email",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="phone",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="city",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="district",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="address",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="pass",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="student_community",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="lecture_online",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="expect_coop",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="cate_id",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="current_position",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="current_company",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="exp_work",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="location",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="area",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="year",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="qualification",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="profile_cv",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */


/**
 * @SWG\Post(
 *     path="/tt_gv_api_index.php",
 *     tags={"Trung tâm và Giảng viên"},
 *     summary="Trang chủ trung tâm, giảng viên",
 *     description="",
 * 
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Get(
 *     path="/api_load_bank.php",
 *     summary="Danh sách ngân hàng",
 *     operationId="",
 *     tags={"Dùng chung"},
 *     @SWG\Response(
 *         response=200,
 *         description="successful operation",
 *     ),
 *     @SWG\Response(
 *         response="400",
 *         description="Invalid ID supplied"
 *     ),
 *     @SWG\Response(
 *         response="404",
 *         description="Pet not found"
 *     )
 *     
 * )
 */

/**
 * @SWG\Get(
 *     path="/api_load_cate.php",
 *     summary="Môn học",
 *     operationId="",
 *     tags={"Dùng chung"},
 *     @SWG\Response(
 *         response=200,
 *         description="successful operation",
 *     ),
 *     @SWG\Response(
 *         response="400",
 *         description="Invalid ID supplied"
 *     ),
 *     @SWG\Response(
 *         response="404",
 *         description="Pet not found"
 *     )
 *     
 * )
 */

/**
 * @SWG\Get(
 *     path="/api_load_tag.php",
 *     summary="Môn học chi tiết",
 *     operationId="",
 *     tags={"Dùng chung"},
 *     @SWG\Response(
 *         response=200,
 *         description="successful operation",
 *     ),
 *     @SWG\Response(
 *         response="400",
 *         description="Invalid ID supplied"
 *     ),
 *     @SWG\Response(
 *         response="404",
 *         description="Pet not found"
 *     )
 *     
 * )
 */

/**
 * @SWG\Post(
 *     path="/tt_api_detail_student_center.php",
 *     tags={"Trung tâm và Giảng viên"},
 *     summary="Chi tiết học viên đã lưu của trung tâm hoặc giảng viên đã lưu",
 *     description="",
 * 
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="student_id",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *     
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/tt_api_center_student.php",
 *     tags={"Trung tâm và Giảng viên"},
 *     summary="Danh sách học viên của trung tâm hoặc giảng viên",
 *     description="",
 * 
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */


/**
 * @SWG\Get(
 *     path="/tt_api_center_teacher.php",
 *     summary="Danh sách giảng viên của trung tâm",
 *     operationId="",
 *     tags={"Trung tâm"},
 *     @SWG\Response(
 *         response=200,
 *         description="successful operation",
 *     ),
 *     @SWG\Response(
 *         response="400",
 *         description="Invalid ID supplied"
 *     ),
 *     @SWG\Response(
 *         response="404",
 *         description="Pet not found"
 *     )
 *     
 * )
 */

/**
 * @SWG\Get(
 *     path="/tt_api_detail_teacher_center.php",
 *     summary="Chi tiết giảng viên của trung tâm",
 *     operationId="",
 *     tags={"Trung tâm"},
 *     @SWG\Response(
 *         response=200,
 *         description="successful operation",
 *     ),
 *     @SWG\Response(
 *         response="400",
 *         description="Invalid ID supplied"
 *     ),
 *     @SWG\Response(
 *         response="404",
 *         description="Pet not found"
 *     )
 *     
 * )
 */

/**
 * @SWG\Get(
 *     path="/tt_api_load_advantage.php",
 *     summary="Ưu điểm của trung tâm",
 *     operationId="",
 *     tags={"Trung tâm"},
 *     @SWG\Response(
 *         response=200,
 *         description="successful operation",
 *     ),
 *     @SWG\Response(
 *         response="400",
 *         description="Invalid ID supplied"
 *     ),
 *     @SWG\Response(
 *         response="404",
 *         description="Pet not found"
 *     )
 *     
 * )
 */

/**
 * @SWG\Get(
 *     path="/api_load_level.php",
 *     summary="Cấp độ",
 *     operationId="",
 *     tags={"Dùng chung"},
 *     @SWG\Response(
 *         response=200,
 *         description="successful operation",
 *     ),
 *     @SWG\Response(
 *         response="400",
 *         description="Invalid ID supplied"
 *     ),
 *     @SWG\Response(
 *         response="404",
 *         description="Pet not found"
 *     )
 *     
 * )
 */

/**
 * @SWG\Post(
 *     path="/tt_api_create_teacher.php",
 *     tags={"Trung tâm"},
 *     summary="Đăng Ký giảng viên của trung tâm",
 *     description="",
 * 
 *     @SWG\Parameter(
 *      name="hoten",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="monhoc",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="bangcap",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="date",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/tt_api_update_teacher.php",
 *     tags={"Trung tâm"},
 *     summary="Cập nhật giảng viên của trung tâm",
 *     description="",
 *      @SWG\Parameter(
 *      name="id",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="hoten",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="monhoc",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="bangcap",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="date",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */


/**
 * @SWG\Delete(
 *     path="/tt_api_delete_teacher.php",
 *     summary="Deletes a pet",
 *     description="",
 *     operationId="",
 *     produces={"application/xml", "application/json"},
 *     tags={"Trung tâm"},
 *     @SWG\Parameter(
 *         description="Pet id to delete",
 *         in="path",
 *         name="token",
 *         required=true,
 *         type="string",
 *     ),
 *     @SWG\Parameter(
 *         name="id",
 *         in="header",
 *         required=false,
 *         type="string"
 *     ),
 *     @SWG\Response(
 *         response=400,
 *         description="Invalid ID supplied"
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Pet not found"
 *     ),
 *     security={{"petstore_auth":{"write:pets", "read:pets"}}}
 * )
 */

/**
 * @SWG\Post(
 *     path="/tt_api_online_teaching.php",
 *     tags={"Trung tâm và Giảng viên"},
 *     summary="Khóa học online giảng dạy",
 *     description="",
 *      @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */


/**
 * @SWG\Post(
 *     path="/tt_api_offline_teaching.php",
 *     tags={"Trung tâm và Giảng viên"},
 *     summary="Khóa học offline giảng dạy",
 *     description="",
 *      @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/tt_api_detail_teaching.php",
 *     tags={"Trung tâm và Giảng viên"},
 *     summary="Chi tiết khóa học giảng dạy",
 *     description="",
 *      @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     
 *     @SWG\Parameter(
 *      name="course_id",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/HV_detail_course.php",
 *     tags={"Trung tâm và Giảng viên"},
 *     summary="Chi tiết khóa học",
 *
 * 		@SWG\Parameter(
 *      name="course_id",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/tt_api_online_sold.php",
 *     tags={"Trung tâm và Giảng viên"},
 *     summary="Danh sách khóa học online đã bán",
 *     description="",
 *      @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/tt_api_offline_sold.php",
 *     tags={"Trung tâm và Giảng viên"},
 *     summary="Danh sách khóa học offline đã bán",
 *     description="",
 *      @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/tt_api_detail_sold.php",
 *     tags={"Trung tâm và Giảng viên"},
 *     summary="Chi tiết khóa học đã bán",
 *     description="",
 *      @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="order_id",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */


/**
 * @SWG\Post(
 *     path="/tt_api_list_evaluate.php",
 *     tags={"Trung tâm và Giảng viên"},
 *     summary="Danh sách đánh giá khóa học",
 *     description="",
 *      @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */


 /**
 * @SWG\Post(
 *     path="/tt_api_detail_evaluate.php",
 *     tags={"Trung tâm và Giảng viên"},
 *     summary="Chi tiết đánh giá khóa học",
 *     description="",
 *      @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="rate_id",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

 /**
 * @SWG\Post(
 *     path="/tt_api_rep_comment.php",
 *     summary="trả lời đánh giá",
 *      tags={"Dùng chung"},
 *     description="",
 * 
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="rate_id",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="course",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="comment",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/tt_api_list_buy_together.php",
 *     tags={"Trung tâm và Giảng viên"},
 *     summary="Danh sách khóa học mua chung",
 *     description="",
 *      @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */


 
/**
 * @SWG\Post(
 *     path="/tt_api_detail_buy_together.php",
 *     tags={"Trung tâm và Giảng viên"},
 *     summary="Chi tiết khóa học",
 *     description="",
 *      @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="common_id",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/gv_api_info_teacher.php",
 *     tags={"Giảng viên"},
 *     summary="Thông tin giảng viên",
 *     description="",
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/gv_api_update_info_teacher.php",
 *     tags={"Giảng viên"},
 *     summary="Cập nhật thông tin giảng viên",
 *     description="",
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *
 *		@SWG\Parameter(
 *      name="user_name",
 *      description="Tên giảng viên",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     
 *     @SWG\Parameter(
 *      name="user_gender",
 *      in="formData",
 *      required=true,
 *      type="array",
 *      @SWG\Items(type="integer",
 *        enum={1,2} ),
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="user_birth",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="user_phone",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="user_mail",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="cit_id",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="district_id",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="user_address",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="cate_id",
 *      in="formData",
 *      required=true,
 *      type="integer",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="exp_teach",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="exp_work",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="qualification",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *
 *		@SWG\Parameter(
 *      name="current_position",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="current_company",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="link_student_community",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="link_lecture_online",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/gv_api_update_pass.php",
 *     tags={"Giảng viên"},
 *     summary="Cập nhật mật khẩu giảng viên",
 *     description="",
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *
 * 		@SWG\Parameter(
 *      name="password",
 *      in="formData",
 *      required=true,
 *      type="string",
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */
 

