<?php

// connect database
require_once("../layouts/session.php");
$email = $_SESSION['email'];
if ($_REQUEST) {
    $return = array(
        'error' => 0
    );
    $type = $_REQUEST['type'];

    if ($type === 'resetkey') {
        $id = $_POST['key_id'];
        if (mysqli_query($conn, "UPDATE tbldebkey SET keystatus='0', uuid='' where id='$id'")) {
            $return['msg'] = 'Bạn đã reset key có id ' . $id . ' thành công.';
            die(json_encode($return));
        }
    }

    if ($type === 'delkey') {
        $id = $_POST['key_id'];
        if (mysqli_query($conn, "DELETE FROM tbldebkey WHERE id = '$id'")) {
            $return['msg'] = 'Bạn đã xoá key có id ' . $id . ' thành công.';
            die(json_encode($return));
        }
    }

    if ($type === 'changedate') {
        $id = $_POST['key_id'];
        $date = $_POST['key_date'];
        if ($date == "NaN-NaN-NaN NaN:NaN") {
            $return['error'] = 1;
            $return['msg']  = 'Đã xảy ra lỗi, vui lòng thao tác lại.';
            die(json_encode($return));
        }
        if (mysqli_query($conn, "UPDATE tbldebkey SET date = '$date' WHERE id = '$id'")) {
            $return['msg'] = 'Bạn đã đổi thời hạn key có id ' . $id . ' đến ' . $date . '.';
            die(json_encode($return));
        }
    }

    if ($type === 'genkey') {
        $date = $_POST['datekey'];
        $soluong = $_POST['quantity'];
        for ($i = 0; $i < $soluong; $i++) {
            if ($date == 1) {
                $key = days_keygen($_SESSION['level']);
            }else if ($date == 7) {
                $key = week_keygen($_SESSION['level']);
            } else if ($date == 30) {
                $key = month_keygen($_SESSION['level']);
            } else {
                $key = year_keygen($_SESSION['level']);
            }
            $query = mysqli_query($conn, "insert into tbldebkey(devicekey,datecount,keytype,keystatus,email) values('$key','$date','4','0','$email')");
        }
        if ($query) {
            $return['msg'] = 'Đã tạo thành công ' . $soluong . ' key !';
            die(json_encode($return));
        } else {
            $return['error'] = 1;
            $return['msg']  = 'Đã xảy ra lỗi, vui lòng thao tác lại.';
            die(json_encode($return));
        }
    }

    if ($type === 'guestgenkey') {
        $datecount = $_POST['datekey'];
        $id = $_POST['post_id'];
        $post_buyer = $_POST['post_buy'];
        $result_sell = mysqli_query($conn, "SELECT postuser,quyen, email, debid,keylimit FROM tblproduct
        inner join tai_khoan on tai_khoan.username = tblproduct.postuser
         WHERE tblproduct.id = '$id'");
        $row_sell = mysqli_fetch_array($result_sell);
        $email_seller = $row_sell['email'];
        $debid_seller = $row_sell['debid'];
        $result_buyer = mysqli_query($conn, "SELECT * FROM tai_khoan where id = '$post_buyer'");
        $row_buyer = mysqli_fetch_array($result_buyer);
        $username_buyer = $row_buyer['username'];
        if ($row_buyer['countkey'] >= $row_buyer['countkeylimit']) {
            $return['error'] = 1;
            $return['msg']  = 'Bạn đã đạt giới hạn nhận key trong ngày. Hãy quay lại vào ngày hôm sau nhé !';
            die(json_encode($return));
        }
        $nv = "SELECT count(id) as soluong FROM tbldebkey where email = '$email_seller'";
        $resultNV = mysqli_query($conn, $nv);
        $rowNV = mysqli_fetch_array($resultNV);
        $tongKey = $rowNV['soluong'];
        if ($row_sell['keylimit'] - $tongKey <= 0) {
            $return['error'] = 1;
            $return['msg']  = 'Chủ sở hữu gói đã hết key free, liên hệ trực tiếp để biết thêm thông tin !';
            die(json_encode($return));
        }
        if ($row_sell['quyen'] == 2) {
            $key = $row_sell["username"] . '-week-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 16);
        } else {
            $key = 'baontq-week-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 16);
        }
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $IP = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $IP = $_SERVER['REMOTE_ADDR'];
        }

        $query = mysqli_query($conn, "insert into tbldebkey(devicekey,datecount,keytype,keystatus,email) values('$key','$datecount','4','0','$email_seller')");
        
        if ($query) {
            mysqli_query($conn, "insert into tblhistorykey(usernameget,gettype,debid,devicekey,getip) values('$username_buyer','0','$debid_seller','$key', '$IP')");
            mysqli_query($conn, "update tai_khoan set countkey = countkey + 1 where id = '$post_buyer'");
            $return['msg'] = 'Đã get thành công 1 key thường. Bạn có thể vào trang cá nhân để xem chi tiết. Key của bạn là: ' . $key . ' ';
            die(json_encode($return));
        } else {
            $return['error'] = 1;
            $return['msg']  = 'Đã xảy ra lỗi, vui lòng thao tác lại.';
            die(json_encode($return));
        }
    }

    if ($type === 'createkey') {
        $date = $_POST['date'];
        $soluong = $_POST['quantity'];
        $keytype = $_POST['keytype'];
        for ($i = 0; $i < $soluong; $i++) {
            $key = basic_keygen($_SESSION['level']);
            $query = mysqli_query($conn, "insert into tbldebkey(devicekey,date,keytype,keystatus,email) values('$key','$date','$keytype','0','$email')");
        }
        if ($query) {
            $return['msg'] = 'Đã tạo thành công ' . $soluong . ' key !';
            die(json_encode($return));
        } else {
            $return['error'] = 1;
            $return['msg']  = 'Đã xảy ra lỗi, vui lòng thao tác lại.';
            die(json_encode($return));
        }
    }

    if ($type === 'createkey2') {
        $date = $_POST['date'];
        $soluong = $_POST['quantity'];
        $keytype = $_POST['keytype'];
        for ($i = 0; $i < $soluong; $i++) {
            $key = basic_keygen($_SESSION['level']);
            $query = mysqli_query($conn, "insert into tbldebkey(devicekey,datecount,keytype,keystatus,email) values('$key','$date','$keytype','0','$email')");
        }
        if ($query) {
            $return['msg'] = 'Đã tạo thành công ' . $soluong . ' key động. Thời hạn sẽ hiển thị khi user kích hoạt !';
            die(json_encode($return));
        } else {
            $return['error'] = 1;
            $return['msg']  = 'Đã xảy ra lỗi, vui lòng thao tác lại.';
            die(json_encode($return));
        }
    }
}
