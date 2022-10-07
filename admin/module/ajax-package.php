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

    if ($type === 'delpackage') {
        $id = $_POST['package_id'];
        if (mysqli_query($conn, "DELETE FROM tbldebver WHERE id = '$id'")) {
            $return['msg'] = 'Bạn đã xoá package có id ' . $id . ' thành công.';
            die(json_encode($return));
        }
    }

    if ($type === 'lockpackage') {
        $id = $_POST['package_id'];
        if (mysqli_query($conn, "UPDATE tbldebver SET debstatus='2' WHERE id = '$id'")) {
            $return['msg'] = 'Package đã đang trong trạng thái bảo trì !';
            die(json_encode($return));
        }
    }

    if ($type === 'unlockpackage') {
        $id = $_POST['package_id'];
        if (mysqli_query($conn, "UPDATE tbldebver SET debstatus='1' WHERE id = '$id'")) {
            $return['msg'] = 'Package đã hoạt động trở lại !';
            die(json_encode($return));
        }
    }

    if ($type === 'offcheck') {
        $id = $_POST['package_id'];
        if (mysqli_query($conn, "UPDATE tbldebver SET hashcheck ='0' WHERE id = '$id'")) {
            $return['msg'] = 'Đã tắt kiểm tra tài nguyên !';
            die(json_encode($return));
        }
    }

    if ($type === 'oncheck') {
        $id = $_POST['package_id'];
        if (mysqli_query($conn, "UPDATE tbldebver SET hashcheck ='1' WHERE id = '$id'")) {
            $return['msg'] = 'Đã bật kiểm tra tài nguyên !';
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

    if ($type === 'creatpackage') {
        $deb_name = $_POST['package_name'];
        $deb_ver = $_POST['package_version'];
        $deb_hash = strtolower(trim($_POST['package_sha1']));
        $deb_new = $_POST['package_newlink'];
        $deb_profile = $_POST['package_profile'];
        $deb_changelog = $_POST['package_changelog'];
        $deb_status = $_POST['package_status'];

        if (mysqli_query($conn, "insert into tbldebver(debname,debversion,email,debstatus,debupdatenoti,newdeblink,debcontact,debhash) values
        ('$deb_name','$deb_ver','$email','$deb_status','$deb_changelog','$deb_new','$deb_profile','$deb_hash')")) {
            $return['msg'] = 'Khởi tạo thành công.';
            die(json_encode($return));
        } else {
            $return['error'] = 1;
            $return['msg'] = 'Đã xảy ra lỗi khi khởi tạo, vui lòng thử lại sau.';
            die(json_encode($return));
        }
    }


    if ($type === 'updatepackage') {
        $deb_name = $_POST['package_name'];
        $deb_ver = $_POST['package_version'];
        $deb_hash = strtolower(trim($_POST['package_sha1']));
        $deb_new = $_POST['package_newlink'];
        $deb_profile = $_POST['package_profile'];
        $deb_changelog = $_POST['package_changelog'];

        $id = $_POST['package_id'];
        if (mysqli_query($conn, "UPDATE tbldebver SET 
        debname = '$deb_name',
        debversion = '$deb_ver',
        debupdatenoti = '$deb_changelog',
        newdeblink = '$deb_new',
        debcontact = '$deb_profile',
        debhash = '$deb_hash'
        WHERE id = $id")) {
            $return['msg'] = 'Cập nhật thành công.';
            die(json_encode($return));
        } else {
            $return['error'] = 1;
            $return['msg'] = 'Đã xảy ra lỗi khi cập nhật, vui lòng thử lại sau.';
            die(json_encode($return));
        }
    }
}
