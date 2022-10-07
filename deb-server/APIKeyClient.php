<?php
$username = "root";
$password = "bao1213";
$server   = "localhost";
$dbname   = "trieubao_deb";
date_default_timezone_set('Asia/Ho_Chi_Minh');
$conn = mysqli_connect($server, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$email = $_GET['email'];
$user = $_GET['api'];
$debid = $_GET['deb'];
$key = $_GET['key'];
if ($user) {

    function subscriptionManager($setDate, $setBlacklisted, $userName, $statusKey)
    {
        $blacklisted = "$setBlacklisted";

        $finishedString = "$setDate,$blacklisted,$userName,$statusKey";
        return $finishedString;
    }

    function subscriptionManager2($setDate, $setBlacklisted, $userName, $statusKey)
    {
        $timenow = date("Y-m-d");
        $date = new DateTime("$timenow 00:00:00");
        $date->modify("+$setDate day");

        $datenum = $date->format("Y-m-d H:i:s");

        $blacklisted = "$setBlacklisted";
        $finishedString = "$datenum,$blacklisted,$userName,$statusKey";
        return $finishedString;
    }

    $errorCheck = TRUE;
    $errorCheckeq = TRUE;
    //0 = Activate | 1 = Ban | 2 = Update | 3 = Outdate
    $sqlcheck = "SELECT keytype, devicekey, username, uuid, date, keystatus, message, datecount FROM tbldebkey where devicekey = '$key' AND email = '$email'";
    $result = mysqli_query($conn, $sqlcheck);

    while ($row = mysqli_fetch_assoc($result)) {
        if (mysqli_num_rows($result) > 0) {
            if ($row['datecount'] == 0) {
                if ($row['keystatus'] == 0) {
                    echo subscriptionManager($row["date"], $row["keytype"], $row["username"], $row['keystatus']);
                    $errorCheck = FALSE;
                    $errorCheckeq = FALSE;
                    mysqli_query($conn, "Update tbldebkey set uuid='$user' where devicekey = '$key'");
                    mysqli_query($conn, "update tbldebkey set keystatus = '1', username = 'No username' where devicekey = '$key'");
                }
            } else {
                if ($row['keystatus'] == 0) {
                    echo subscriptionManager2($row["datecount"], $row["keytype"], $row["username"], $row['keystatus']);
                    $errorCheck = FALSE;
                    $errorCheckeq = FALSE;
                    $timenow = date("Y-m-d");
                    $setDate = $row['datecount'];
                    $timenew = strtotime(date("Y-m-d", strtotime($timenow)) . " +$setDate day");
                    $timenew = date("Y-m-d", $timenew);
                    //mysqli_query($conn, "Update tbldebkey set uuid='$user' where devicekey = '$key'");
                    mysqli_query($conn, "update tbldebkey set uuid='$user', keystatus = '1', username = 'No username', date = '$timenew', datecount = '0' where devicekey = '$key'");
                }
            }
        }
    }

    if ($errorCheckeq) {
        echo subscriptionManager("", "", "No Name", 1);
        $errorCheck = FALSE;
    }


    if ($errorCheck) {
        http_response_code(404);
        echo subscriptionManager("", "", "", "1");
    }
}
mysqli_close($conn);
