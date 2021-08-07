<?
use Firebase\JWT\JWT;

include_once 'jwt/JWT.php';
    $key = 123123;
    function success ( $message, $data) {
        $is_data = is_array($data);
        $result = [];
        if($is_data){
            $result['result'] = true;
            $result['code'] = 200;
            $result['data'] = $data;
            $result['error'] = null;
            $result['message'] = $message;
        }

        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    function set_error ($code = null, $message = null) {
        $error = array();

        $error['result'] = false;
        $error["code"] = $code;
        $error['data'] = null;
        $error['error'] = [
            'message' => $message
        ];
        echo json_encode($error,JSON_UNESCAPED_UNICODE);
    }
    // $arr_token['name'] = "Luc";
    // $arr_token['id'] = 1;

    // $token = JWT::encode($arr_token,$key);
    // $token_decode = JWT::decode($token,$key,['HS256']);


    // $data = [
    //     'token' => $token,
    //     'listKH' => []
        
    // ];
    // // success('Đăng nhập thành công',$data);
    // set_error('404','Khong tim thay email');
    // var_dump($token_decode);

?>
