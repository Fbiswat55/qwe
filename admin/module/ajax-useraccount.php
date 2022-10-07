<?php
include_once "../layouts/config.php";
if ($_REQUEST) {
    $return = array(
        'error' => 0
    );
    $type = $_REQUEST['type'];
    if ($type === 'login') {
        $user_username             = htmlspecialchars(addslashes($_POST['user_username']));
        $user_password             = htmlspecialchars(addslashes($_POST['user_password']));
        $user_password             = md5($user_password);
        if (!filter_var($user_username, FILTER_VALIDATE_EMAIL)) {
            $check_username            = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, username, email, mat_khau, quyen, truy_cap, trang_thai FROM tai_khoan WHERE username = '$user_username'"));
            if ($check_username == 0) {
                $return['error'] = 1;
                $return['msg']   = 'Tên đăng nhập không tồn tại';
                die(json_encode($return));
            } else if ($check_username['mat_khau'] != $user_password) {
                $return['error'] = 1;
                $return['msg'] = 'Sai mật khẩu !';
                die(json_encode($return));
            } else if ($check_username['trang_thai'] == 0) {
                $return['error'] = 1;
                $return['msg'] = 'Tài khoản của bạn chưa được kích hoạt hoặc đã bị khoá !';
                die(json_encode($return));
            } else {
                $level = $check_username['quyen'];
                $email = $check_username['email'];
                session_start();
                // create var session username
                $_SESSION["loggedin"] = true;
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $user_username;
                // create var session level
                $_SESSION['level'] = $level;

                // set access
                $access = $check_username['truy_cap'] + 1;
                $update = "UPDATE tai_khoan SET truy_cap = $access WHERE email = '$email'";
                mysqli_query($conn, $update);
                $return['msg'] = 'Đăng nhập thành công';
                die(json_encode($return));
            }
        } else {
            $check_email  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, username, email, mat_khau, quyen, truy_cap, trang_thai FROM tai_khoan WHERE email = '$user_username'"));
            if ($check_email == 0) {
                $return['error'] = 1;
                $return['msg']   = 'Email không tồn tại';
                die(json_encode($return));
            } else if ($check_email['mat_khau'] != $user_password) {
                $return['error'] = 1;
                $return['msg'] = 'Sai mật khẩu !';
                die(json_encode($return));
            } else if ($check_email['trang_thai'] == 0) {
                $return['error'] = 1;
                $return['msg'] = 'Tài khoản của bạn chưa được kích hoạt hoặc đã bị khoá !';
                die(json_encode($return));
            } else {
                $level = $check_email['quyen'];
                $email = $check_email['email'];
                $usr = $check_email['username'];
                session_start();
                // create var session username
                $_SESSION["loggedin"] = true;
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $usr;
                // create var session level
                $_SESSION['level'] = $level;

                // set access
                $access = $check_email['truy_cap'] + 1;
                $update = "UPDATE tai_khoan SET truy_cap = $access WHERE email = '$email'";
                mysqli_query($conn, $update);
                $return['msg'] = 'Đăng nhập thành công';
                die(json_encode($return));
            }
        }
    }

    if ($type === 'register') {
        $api_url     = 'https://www.google.com/recaptcha/api/siteverify';
         $site_key    = '6Ld7pXIfAAAAAOiyNCkheogLzPqSFiQJMPHajYOW';
        $secret_key  = '6Ld7pXIfAAAAAB3YaPFaojvbak-3JK8i5wVploS2';
        $site_key_post = $_POST['recapcha'];
        //tạo link kết nối
        $api_url = $api_url.'?secret='.$secret_key.'&response='.$site_key_post.'&remoteip='.$remoteip;
    //lấy kết quả trả về từ google
        $response = file_get_contents($api_url);
    //dữ liệu trả về dạng json
        $response = json_decode($response);
        if(!isset($response->success))
        {
             $return['error'] = 1;
            $return['msg']   = 'Captcha không đúng.';
            die(json_encode($return));
        }
        if($response->success != true)
        {
            $return['error'] = 1;
            $return['msg']   = 'Captcha lỗi.';
            die(json_encode($return));
        }
        $user_username = htmlspecialchars(addslashes($_POST['user_username']));
        $user_email    = htmlspecialchars(addslashes($_POST['user_email']));
        $user_password = htmlspecialchars(addslashes($_POST['user_password']));
        $user_password = md5($user_password);
        $access = 0;
        $param_token = bin2hex(random_bytes(50));
        $date_create = date("Y-m-d H:i:s");
        $check_username_available = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tai_khoan WHERE username = '$user_username'"));
        $check_email_available    = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tai_khoan WHERE email = '$user_email'"));
        if (strlen($user_username) > 32 || strlen($user_username) < 5) {
            $return['error'] = 1;
            $return['msg']   = 'Tên đăng nhập phải bé hơn 32 kí tự và lớn hơn 5 kí tự.';
            die(json_encode($return));
        } else if (!preg_match("/^[a-zA-Z0-9]*$/", $user_username)) {
            $return['error'] = 1;
            $return['msg']   = 'Tên đăng nhập không bao gồm các kí tự đặc biệt và có dấu.';
            die(json_encode($return));
        } else if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $return['error'] = 1;
            $return['msg']   = 'Email không đúng định dạng';
            die(json_encode($return));
        } else if ($check_username_available > 0) {
            $return['error'] = 1;
            $return['msg']   = 'Tên đăng nhập đã tồn tại trên hệ thống.';
            die(json_encode($return));
        } else if ($check_email_available > 0) {
            $return['error'] = 1;
            $return['msg']   = 'Địa chỉ email đã tồn tại trên hệ thống.';
            die(json_encode($return));
        } else {
            if (mysqli_query($conn, "INSERT INTO tai_khoan(username,email, mat_khau, quyen, trang_thai, truy_cap, ngay_tao, token) VALUES('$user_username','$user_email', '$user_password', 0, 1, '$access', '$date_create', '$param_token')")) {
                $return['msg'] = 'Đăng ký tài khoản thành công.';
                die(json_encode($return));
            } else {
                $return['error'] = 1;
                $return['msg'] = 'Đã xảy ra lỗi, vui lòng thử lại sau !.';
                die(json_encode($return));
            }
        }
    }



    if ($type === 'change_password') {
        $user_password             = htmlspecialchars(addslashes($_POST['user_password']));
        $user_new_password         = htmlspecialchars(addslashes($_POST['user_new_password']));
        $user_username             = htmlspecialchars(addslashes($_POST['user_usn']));
        $user_email                = htmlspecialchars(addslashes($_POST['user_email']));
        $result = mysqli_query($conn, "SELECT username FROM tai_khoan WHERE username = '$user_username'");
        $check_username_available = mysqli_fetch_assoc($result);
        $check_username_length = mysqli_num_rows($result);
        session_start();
        if ($check_username_length > 0 && $_SESSION['username'] != $check_username_available['username']) {
            $return['error'] = 1;
            $return['msg'] = 'Tên đăng nhập đã tồn tại trên hệ thống.';
            die(json_encode($return));
        }else if (!preg_match("/^[a-zA-Z0-9]*$/", $user_username)) {
            $return['error'] = 1;
            $return['msg']   = 'Username không bao gồm các kí tự đặc biệt và có dấu.';
            die(json_encode($return));
        } else if (strlen($user_username) > 32 || strlen($user_username) < 5) {
            $return['error'] = 1;
            $return['msg']   = 'Tên đăng nhập phải bé hơn 32 kí tự và lớn hơn 5 kí tự.';
            die(json_encode($return));
        }
        if (strlen($user_new_password) < 6) {
            $return['error'] = 1;
            $return['msg']   = 'Mật khẩu phải lớn hơn 5 kí tự.';
            die(json_encode($return));
        }
        $user_new_password         = md5($user_new_password);
        $param_token = bin2hex(random_bytes(50));
        $check_username            = mysqli_fetch_assoc(mysqli_query($conn, "SELECT mat_khau FROM tai_khoan WHERE email = '$user_email'"));
        if ($check_username['mat_khau'] != md5($user_password)) {
            $return['error'] = 1;
            $return['msg'] = 'Mật khẩu cũ không chính xác.';
            die(json_encode($return));
        } else {
            if (mysqli_query($conn, "UPDATE tai_khoan SET mat_khau = '$user_new_password', token = '$param_token', username = '$user_username' WHERE email = '$user_email'")) {
                $return['msg'] = 'Đổi thông tin tài khoản thành công, nên đăng nhập lại để làm mới phiên.';
                die(json_encode($return));
            } else {
                $return['error'] = 1;
                $return['msg']   = 'Đã xảy ra lỗi, vui lòng báo lại cho admin';
                die(json_encode($return));
            }
        }
    }

    if ($type === 'changeusername') {
        $user_id = $_POST['user_id'];
        $user_username = $_POST['user_username'];
        $result = mysqli_query($conn, "SELECT username FROM tai_khoan WHERE id = '$user_id'");
        $check_username_available = mysqli_fetch_assoc($result);
        $check_username_length = mysqli_num_rows($result);
        session_start();
        if ($check_username_length > 0 && $_SESSION['username'] != $check_username_available['username']) {
            $return['error'] = 1;
            $return['msg'] = 'Tên đăng nhập đã tồn tại trên hệ thống.';
            die(json_encode($return));
        }else if (!preg_match("/^[a-zA-Z0-9]*$/", $user_username)) {
            $return['error'] = 1;
            $return['msg']   = 'Username không bao gồm các kí tự đặc biệt và có dấu.';
            die(json_encode($return));
        } else if (strlen($user_username) > 32 || strlen($user_username) < 5) {
            $return['error'] = 1;
            $return['msg']   = 'Tên đăng nhập phải bé hơn 32 kí tự và lớn hơn 5 kí tự.';
            die(json_encode($return));
        } else {
            if (mysqli_query($conn, "UPDATE tai_khoan SET username = '$user_username' WHERE id = '$user_id'")) {
                $return['msg'] = 'Đổi thông tin tài khoản thành công, nên đăng nhập lại để làm mới phiên.';
                die(json_encode($return));
            } else {
                $return['error'] = 1;
                $return['msg']   = 'Đã xảy ra lỗi, vui lòng báo lại cho admin';
                die(json_encode($return));
            }
        }
    }
}
