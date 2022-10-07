<?php

// connect database
require_once("../layouts/session.php");

if ($_REQUEST) {
    $return = array(
        'error' => 0
    );
    $type = $_REQUEST['type'];

    if ($type === 'unlockdevice') {
        $id = $_POST['device_id'];
        if (mysqli_query($conn, "UPDATE tbldebkey SET keytype='4' where id='$id'")) {
            $return['msg'] = 'Bạn đã mở khoá thiết bị có id ' . $id . ' thành công.';
            die(json_encode($return));
        }
    }

    if ($type === 'lockdevice') {
        $id = $_POST['device_id'];
        if (mysqli_query($conn, "UPDATE tbldebkey SET keytype='1' where id='$id'")) {
            $return['msg'] = 'Bạn đã khoá thiết bị có id ' . $id . ' thành công.';
            die(json_encode($return));
        }
    }

    if ($type === 'deldevice') {
        $id = $_POST['device_id'];
        if (mysqli_query($conn, "DELETE FROM tbldebkey WHERE id = $id")) {
            $return['msg'] = 'Bạn đã xoá thiết bị có id ' . $id . ' thành công.';
            die(json_encode($return));
        }
    }

    if ($type === 'getudid') {
        $id = $_POST['device_id'];
        $check_udid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT uuid FROM tbldebkey WHERE id = $id"));
        if ($check_udid['uuid'] == "") {
            $return['error'] = 1;
            $return['msg'] = 'Key chưa có thiết bị nào kết nối.';
            die(json_encode($return));
        } else {
            $return['msg'] = '' . $check_udid['uuid'];
            die(json_encode($return));
        }
    }

    if ($type === 'change_info') {
        $id = $_POST['device_id'];
        $username = $_POST['device_username'];
        $keytype = $_POST['device_keytype'];
        $date = $_POST['device_date'];
        // $key = $_POST['device_key'];
        $udid = $_POST['device_udid'];
        $message = $_POST['device_message'];
        if (mysqli_query($conn, " UPDATE tbldebkey SET 
        username = '$username',
        uuid = '$udid',
        date = '$date',
        keytype = '$keytype',
        message = '$message'
        WHERE id = $id")) {
            $return['msg'] = 'Cập nhật thông tin thành công';
            die(json_encode($return));
        }else {
            $return['error'] = 1;
            $return['msg'] = 'Đã xảy ra lỗi, vui lòng nhập lại';
            die(json_encode($return));
        }
    }
    
    if ($type === 'add_device') {
        session_start();
        $email = $_SESSION['email'];
        $username = $_POST['device_username'];
        $keytype = $_POST['device_keytype'];
        $date = $_POST['device_date'];
        $key = basic_keygen($_SESSION['level']);
        $udid = $_POST['device_udid'];
        $message = $_POST['device_message'];
        if(empty($message)) {
            $message = "Không có thông báo mới !";
        }
        if (mysqli_query($conn, " insert into tbldebkey(username,uuid,devicekey,date,keytype,keystatus,email,message) values('$username','$udid','$key','$date','$keytype','0','$email','$message')")) {
            $return['msg'] = 'Thêm thiết bị thành công';
            die(json_encode($return));
        }else {
            $return['error'] = 1;
            $return['msg'] = 'Đã xảy ra lỗi, vui lòng nhập lại';
            die(json_encode($return));
        }
    }

    if ($type === 'changeusr') {
        $id = $_POST['key_id'];
        $username = strtolower(trim($_POST['username']));
        if (mysqli_query($conn, "UPDATE tbldebkey SET username = '$username' WHERE id = '$id'")) {
            $return['msg'] = 'Cập nhật username thành công.';
            die(json_encode($return));
        } else {
            $return['error'] = 1;
            $return['msg'] = 'Cập nhật username thất bại.';
            die(json_encode($return));
        }
    }
}
