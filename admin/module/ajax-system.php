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

    if ($type === 'edit_settings') {

        $settings_noti          = $_POST['system_noti'];
        $system_status          = $_POST['system_status'];
        if ($_SESSION['level'] != 1) {
            $return['error'] = 1;
            $return['msg']   = 'Bạn không phải là quản trị viên.';
            die(json_encode($return));
        } else {
            if (mysqli_query($conn, "UPDATE websetting SET status = '$system_status', noti = '$settings_noti' WHERE id = '1'")) {
                $return['msg'] = 'Chỉnh sử thông tin website thành công.';
                die(json_encode($return));
            } else {
                $return['error'] = 1;
                $return['msg']   = 'Bạn không có quyền truy cập';
                die(json_encode($return));
            }
        }
    }
    if ($type === 'delnoti') {
        $noti_id = $_POST['noti_id'];
        if (mysqli_query($conn, "DELETE FROM tblnotification WHERE id = '$noti_id'")) {
            $return['msg'] = 'Thông báo đã được gỡ.';
            die(json_encode($return));
        } else {
            $return['error'] = 1;
            $return['msg']   = 'Bạn không có quyền truy cập';
            die(json_encode($return));
        }
    }

    if ($type === 'add_noti') {
        $noti_user = $_POST['noti_user'];
        $noti_type = $_POST['noti_type'];
        $noti_detail = $_POST['noti_detail'];
        if (mysqli_query($conn, "INSERT INTO `tblnotification` (`noti_user`, `noti_detail`, `noti_level`) VALUES 
        ('$noti_user', '$noti_detail', '$noti_type')")) {
            $return['msg'] = 'Thêm thông báo thành công !';
            die(json_encode($return));
        }
    }
    if ($type === 'edit_noti') {
        $id = $_POST['noti_id'];
        $noti_user = $_POST['noti_user'];
        $noti_type = $_POST['noti_type'];
        $noti_detail = $_POST['noti_detail'];
        if (mysqli_query($conn, "UPDATE `tblnotification` SET noti_user = '$noti_user', noti_detail = '$noti_detail', noti_level = '$noti_type' WHERE id = '$id'")) {
            $return['msg'] = 'Sửa thông báo thành công !';
            die(json_encode($return));
        }
    }

    if ($type === 'readnoti') {
        $id = $_POST['noti_id'];
        if (mysqli_query($conn, "UPDATE tblnotification SET noti_read = 1 WHERE id = '$id'")) {
            $check_noti = mysqli_fetch_assoc(mysqli_query($conn, "SELECT noti_detail FROM tblnotification WHERE id = $id"));
            $return['msg'] = $check_noti['noti_detail'];
            die(json_encode($return));
        }
    }
}
