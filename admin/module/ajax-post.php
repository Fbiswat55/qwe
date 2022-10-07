<?php
// connect database
require_once("../layouts/session.php");
$username = $_SESSION['username'];
if ($_REQUEST) {
    $return = array(
        'error' => 0
    );
    $type = $_REQUEST['type'];

    if ($type === 'enablegetkey') {
        $id = $_POST['post_id'];
        if (mysqli_query($conn, "UPDATE tblproduct SET allowgetkey = 1 where id='$id'")) {
            $return['msg'] = 'Bạn đã bật get key free thành công.';
            die(json_encode($return));
        } else {
            $return['error'] = 1;
            $return['msg'] = 'Có lỗi xảy ra, vui lòng thử lại sau.';
            die(json_encode($return));
        }
    }

    if ($type === 'disablegetkey') {
        $id = $_POST['post_id'];
        if (mysqli_query($conn, "UPDATE tblproduct SET allowgetkey = 0 where id='$id'")) {
            $return['msg'] = 'Bạn đã tắt get key free thành công.';
            die(json_encode($return));
        } else {
            $return['error'] = 1;
            $return['msg'] = 'Có lỗi xảy ra, vui lòng thử lại sau.';
            die(json_encode($return));
        }
    }

    if ($type === 'status_on') {
        $id = $_POST['post_id'];
        if (mysqli_query($conn, "UPDATE tblproduct SET status = 1 where id='$id'")) {
            $return['msg'] = 'Bài đăng đã hoạt động bình thường.';
            die(json_encode($return));
        } else {
            $return['error'] = 1;
            $return['msg'] = 'Có lỗi xảy ra, vui lòng thử lại sau.';
            die(json_encode($return));
        }
    }

    if ($type === 'status_off') {
        $id = $_POST['post_id'];
        if (mysqli_query($conn, "UPDATE tblproduct SET status = 0 where id='$id'")) {
            $return['msg'] = 'Đã báo bảo trì, user không thể get key cũng như liên hệ. Bạn nên bật trạng thái bảo trì cho gói để chặn người dùng truy cập.';
            die(json_encode($return));
        } else {
            $return['error'] = 1;
            $return['msg'] = 'Có lỗi xảy ra, vui lòng thử lại sau.';
            die(json_encode($return));
        }
    }

    if ($type === 'changetype0') {
        $id = $_POST['post_id'];
        if (mysqli_query($conn, "UPDATE tblproduct SET totaltype = 0 where id='$id'")) {
            $return['msg'] = 'Bạn đã mở free gói. Người dùng có thể nhận 1 key 7 ngày trong 1 ngày.';
            die(json_encode($return));
        } else {
            $return['error'] = 1;
            $return['msg'] = 'Có lỗi xảy ra, vui lòng thử lại sau.';
            die(json_encode($return));
        }
    }

    if ($type === 'changetype1') {
        $id = $_POST['post_id'];
        if (mysqli_query($conn, "UPDATE tblproduct SET totaltype = 1 where id='$id'")) {
            $return['msg'] = 'Đã chuyển sang trạng thái bán.';
            die(json_encode($return));
        } else {
            $return['error'] = 1;
            $return['msg'] = 'Có lỗi xảy ra, vui lòng thử lại sau.';
            die(json_encode($return));
        }
    }

    if ($type === 'delpost') {
        $id = $_POST['post_id'];
        if (mysqli_query($conn, "DELETE FROM tblproduct WHERE id = '$id'")) {
            $return['msg'] = 'Bạn đã xoá post có id ' . $id . ' thành công.';
            die(json_encode($return));
        }
    }


    if ($type === 'add_post') {
        $package_id = $_POST['package_id'];
        $post_title = $_POST['post_title'];
        $post_img = $_POST['post_img'];
        $post_phone = $_POST['post_phone'];
        $post_zalophone = $_POST['post_zalophone'];
        $post_fbuser = $_POST['post_fbuser'];
        $post_detail = $_POST['post_detail'];
        $post_getkey = $_POST['post_getkey'];
        $post_totaltype = $_POST['post_totaltype'];
        $post_daytotal = $_POST['post_daytotal'];
        $post_weektotal = $_POST['post_weektotal'];
        $post_monthtotal = $_POST['post_monthtotal'];
        $post_deblink = $_POST['post_deblink'];
        if ($post_daytotal == "") {
            $post_daytotal = "Không hỗ trợ";
        }
        if ($post_weektotal == "") {
            $post_weektotal = "Không hỗ trợ";
        }
        if ($post_monthtotal == "") {
            $post_monthtotal = "Không hỗ trợ";
        }
        $date = date("d-m-Y h:m:s");
        if (mysqli_query($conn, "INSERT INTO `tblproduct` (`title`, `postuser`, `postimg`, `postdetail`, `totaltype`,`daytotal`,`weektotal`,`monthtotal`, `postdate`, `allowgetkey`, `phoneuser`, `zalouser`, `fbuser`, `debid`, `status`, `deblink`) VALUES 
        ('$post_title', '$username', '$post_img', '$post_detail', '$post_totaltype','$post_daytotal','$post_weektotal','$post_monthtotal', '$date', '$post_getkey', '$post_phone', '$post_zalophone', '$post_fbuser', '$package_id', '1', '$post_deblink')")) {
            $return['msg'] = 'Thêm bài viết thành công !';
            die(json_encode($return));
        }
    }

    if ($type === 'edit_post') { 
        $post_id = $_POST['post_id'];
        $package_id = $_POST['package_id'];
        $post_title = $_POST['post_title'];
        $post_img = $_POST['post_img'];
        $post_phone = $_POST['post_phone'];
        $post_zalophone = $_POST['post_zalophone'];
        $post_fbuser = $_POST['post_fbuser'];
        $post_detail = $_POST['post_detail'];
        $post_getkey = $_POST['post_getkey'];
        $post_totaltype = $_POST['post_totaltype'];
        $post_daytotal = $_POST['post_daytotal'];
        $post_weektotal = $_POST['post_weektotal'];
        $post_monthtotal = $_POST['post_monthtotal'];
        $post_deblink = $_POST['post_deblink'];
        if ($post_daytotal == "") {
            $post_daytotal = "Không hỗ trợ";
        }
        if ($post_weektotal == "") {
            $post_weektotal = "Không hỗ trợ";
        }
        if ($post_monthtotal == "") {
            $post_monthtotal = "Không hỗ trợ";
        }
        $date = date("d-m-Y h:m:s");
        if (mysqli_query($conn, "UPDATE `tblproduct` SET `title` = '$post_title', `postuser` = '$username', `postimg` = '$post_img', `postdetail` = '$post_detail', `totaltype` = '$post_totaltype',`daytotal` = '$post_daytotal',`weektotal` = '$post_weektotal',`monthtotal` = '$post_monthtotal', `postdate` = '$date', `allowgetkey` = '$post_getkey', `phoneuser` = '$post_phone', `zalouser` = '$post_zalophone', `fbuser` = '$post_fbuser', `debid` = '$package_id', `deblink` = '$post_deblink' WHERE id = '$post_id'")) {
            $return['msg'] = 'Cập nhật thông tin thành công !';
            die(json_encode($return));
        }else {
            $return['error'] = 1;
            $return['msg'] = 'Lỗi xử lý thông tin, vui lòng kiểm tra lại !';
            die(json_encode($return));
        }
    }
}
