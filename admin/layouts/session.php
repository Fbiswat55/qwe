<?php
// Initialize the session
session_start();
require_once('config.php');
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: auth-login.php");
    exit;
}

if (!$settings_status && $_SESSION['level'] != 1) {
    header("location: pages-maintenance.php");
    exit;
}

$email = $_SESSION['email'];
$acc = "SELECT * FROM tai_khoan WHERE email = '$email'";
$result_acc = mysqli_query($conn, $acc);
$row_acc = mysqli_fetch_array($result_acc);

function time_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'năm',
        'm' => 'tháng',
        'w' => 'tuần',
        'd' => 'ngày',
        'h' => 'giờ',
        'i' => 'phút',
        's' => 'giây',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v;
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' trước' : 'Vừa xong';
}

function basic_keygen ($level) {
    if($level == 2) {
      $keygen_basic = $_SESSION["username"] . '-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 16);
      return $keygen_basic;
    }else {
        $keygen_basic = 'baontq-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 16);
        return $keygen_basic;
    }
}

function days_keygen ($level) {
    if($level == 2) {
      $keygen_basic = $_SESSION["username"] . '-day-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 16);
      return $keygen_basic;
    }else {
        $keygen_basic = 'baontq-day-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 16);
        return $keygen_basic;
    }
}

function week_keygen ($level) {
    if($level == 2) {
      $keygen_basic = $_SESSION["username"] . '-week-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 16);
      return $keygen_basic;
    }else {
        $keygen_basic = 'baontq-week-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 16);
        return $keygen_basic;
    }
}

function month_keygen ($level) {
    if($level == 2) {
      $keygen_basic = $_SESSION["username"] . '-month-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 16);
      return $keygen_basic;
    }else {
        $keygen_basic = 'baontq-month-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 16);
        return $keygen_basic;
    }
}

function year_keygen ($level) {
    if($level == 2) {
      $keygen_basic = $_SESSION["username"] . '-year-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 16);
      return $keygen_basic;
    }else {
        $keygen_basic = 'baontq-year-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 16);
        return $keygen_basic;
    }
}
