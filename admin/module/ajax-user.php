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

    if ($type === 'changelimitkey') {
        $id = $_POST['user_id'];
        $keylimit = $_POST['quantity'];
        if (mysqli_query($conn, "UPDATE tai_khoan SET keylimit= '$keylimit' where id='$id'")) {
            $return['msg'] = 'Bạn đã cập nhật giới hạn cho id ' . $id . ' thành công.';
            die(json_encode($return));
        }
    }


}
