<?php
session_start();
// connect database
$email = $_SESSION['email'];
require_once("../layouts/config.php");
if ($_REQUEST) {
    $return = array(
        'error' => 0
    );
    $type = $_REQUEST['type'];

    if ($type === 'deluser') {
        $id = $_POST['user_id'];
        if (mysqli_query($conn, "DELETE FROM tai_khoan WHERE id = '$id'")) {
            $return['msg'] = 'Bạn đã xoá member có id ' . $id . ' thành công.';
            die(json_encode($return));
        }
    }

    if ($type === 'lockuser') {
        $id = $_POST['user_id'];
        if (mysqli_query($conn, "UPDATE tai_khoan SET trang_thai='0' WHERE id = '$id'")) {
            $return['msg'] = 'Đã khoá member !';
            die(json_encode($return));
        }
    }

    if ($type === 'unlockuser') {
        $id = $_POST['user_id'];
        if (mysqli_query($conn, "UPDATE tai_khoan SET trang_thai='1' WHERE id = '$id'")) {
            $return['msg'] = 'Đã mở khoá member !';
            die(json_encode($return));
        }
    }

    if ($type === 'changesha1') {
        $id = $_POST['package_id'];
        $package_sha1 = strtolower(trim($_POST['package_sha1']));
        if (mysqli_query($conn, "UPDATE tbldebver SET debhash = '$package_sha1' WHERE id = '$id'")) {
            $return['msg'] = 'Cập nhật SHA1 thành công.';
            die(json_encode($return));
        } else {
            $return['error'] = 1;
            $return['msg'] = 'Cập nhật SHA1 thất bại.';
            die(json_encode($return));
        }
    }

    if ($type === 'updatemember') {
        $member_uname = $_POST['member_username'];
        $member_email = $_POST['member_email'];
        $member_token = $_POST['member_token'];
        $member_limit = $_POST['member_limit'];
        $member_role = $_POST['member_role'];
        $id = $_POST['member_id'];

        if (mysqli_query($conn, "UPDATE tai_khoan SET
        quyen = '$member_role',
        username = '$member_uname',
        token = '$member_token',
        keylimit = '$member_limit'
        WHERE id = $id")) {
            $return['msg'] = 'Cập nhật thành công.';
            die(json_encode($return));
        } else {
            $return['error'] = 1;
            $return['msg'] = 'Đã xảy ra lỗi khi cập nhật, vui lòng thử lại sau.';
            die(json_encode($return));
        }
    }


    if ($type === 'changelimitkey') {
        $id = $_POST['user_id'];
        $keylimit = $_POST['quantity'];
        if (mysqli_query($conn, "UPDATE tai_khoan SET keylimit= '$keylimit' where id='$id'")) {
            $return['msg'] = 'Bạn đã cập nhật giới hạn cho id ' . $id . ' thành công.';
            die(json_encode($return));
        }
    }
}
