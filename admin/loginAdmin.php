<?php
require_once '../config/config.php';
if (isset($_POST['submit'])) {
    $username = getValue('username','str','POST','');
    $password = getValue('password','str','POST','');
    $password = md5($password);

    $qr = new db_query("SELECT adm_id, adm_type, adm_active FROM admin WHERE adm_login_name = '$username' AND adm_password = '$password'");
    if (mysql_num_rows($qr->result) == 1) {
        $row = mysql_fetch_array($qr->result);
        if ($row['adm_active'] == 1) {
            setcookie('adm_id',$row['adm_id'],time() + 3600 * 6, '/');
            setcookie('adm_type',$row['adm_type'],time() + 3600 * 6, '/');
            header("Location: index.php");   
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Đăng nhập vào Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/fontawesome-free-5.10.2-web/css/all.css" rel="stylesheet" type="text/css" />
    <link href="../css/loginAdmin.css" rel="stylesheet" type="text/css" />
    <?php if (isset($row['adm_active'])) {
                if ($row['adm_active'] == 0) {
        ?>
    <script type="text/javascript">
    alert('Tài khoản đã bị khóa hoặc chưa kích hoạt');
    </script>
    <?php          
                }
        } ?>
</head>

<body>
    <main>
        <div class="container">
            <div class="login-form">
                <form method="post">
                    <h1>Đăng nhập vào Admin</h1>
                    <div class="input-box">
                        <i></i>
                        <input type="text" name="username" placeholder="Nhập username">
                    </div>
                    <div class="input-box">
                        <i></i>
                        <input type="password" name="password" placeholder="Nhập mật khẩu">
                    </div>
                    <div class="btn-box">
                        <button type="submit" name="submit">
                            Đăng nhập
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>