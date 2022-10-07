<?php
$username = "root";
$password = "bao1213";    
$server   = "localhost";  
$dbname   = "trieubao_deb";     

$conn = mysqli_connect($server, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$iddeb = $_GET['iddeb'];
$email = $_GET['email'];
$user = $_GET['api'];
$debid = $_GET['deb'];//debversion
$usermodel = $_GET['model'];
$sha1file = strtolower($_GET['hash']);
$key = 'baontq-'.substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 16);
if($user){
    
    function subscriptionManager($setDate, $setBlacklisted, $userName, $message, $deviceKey) {
    	// $date = new DateTime("$setDate 00:00:00");
    	// $date->modify("-1 day");

    	// $datenum=strtotime($date->format("Y-m-d H:i:s"));
    	// $diff=$datenum-time();
   		// $days=floor($diff/(60*60*24)+2);//seconds/minute*minutes/hour*hours/day)

  		 $blacklisted="$setBlacklisted";

    	$finishedString = "$setDate,$blacklisted,$userName,$message,$deviceKey";
        return $finishedString;
    }
    $sqlver = "SELECT id, debversion, email, debstatus, debupdatenoti, newdeblink, debhash, hashcheck FROM tbldebver where email = '$email' AND id = '$iddeb'";
    $resultver = mysqli_query($conn, $sqlver);
    $checkExtst = TRUE;
    $checkHash = TRUE;
    while($row = mysqli_fetch_assoc($resultver)) {
        if($sha1file == $row['debhash'] || $row['hashcheck'] == 0) {
            $checkHash = FALSE;
        }
        if($row['debstatus'] == 2) {
            echo subscriptionManager("", 98, "", "Thông báo","Nokey");
            die;
        }
        if($row['debstatus'] == 1 && $debid != $row['debversion']) {
            echo subscriptionManager("", 99, $row['newdeblink'], $row['debupdatenoti'],"$usermodel","Nokey");
            die;
        }
        $checkExtst = FALSE;
    }
    
            if($checkExtst || $checkHash) {
            echo subscriptionManager("", 97, "", "Thông báo","Nokey");
            die;
        }
    //0 = Activate | 1 = Ban | 2 = Update | 3 = Outdate
    
    $sql = "SELECT username, uuid, date, keytype, message, devicekey, keystatus, email FROM tbldebkey where email = '$email' and debversion = '$debid'";
    $result = mysqli_query($conn, $sql);
    $errorCheck = TRUE;
    
     while($row = mysqli_fetch_assoc($result)) {
         if($user == $row["uuid"] && $row["keytype"] != 1){
         echo subscriptionManager($row["date"], $row["keytype"], $row["username"], $row["message"], $row["devicekey"]);
         $errorCheck = FALSE;
         $query=mysqli_query($conn,"Update tbldebkey set keystatus='1', debversion = '$debid' where uuid='$user'");
     }
     if($user == $row["uuid"] && $row["keytype"] == 1){
         echo subscriptionManager($row["date"], 1, $row["username"], $row["message"], $row["devicekey"]);//banned
         $errorCheck = FALSE;
     }

     }
     
     if($errorCheck) {
         $sqlver = "SELECT id, debcontact FROM tbldebver where email = '$email'";
    $resultver = mysqli_query($conn, $sqlver);

    while($row = mysqli_fetch_assoc($resultver)) {
        if($iddeb == $row['id']) {
            echo subscriptionManager("", "", "", $row['debcontact'],"Nokey");
        }
        
    }
        http_response_code(404);
        die;
     }
     $query=mysqli_query($conn,"Update tbldebkey set devicemodel='$usermodel' where uuid='$user'");
    //echo subscriptionManager("2023-03-08", "1", "iosnab","nomessage");
}
mysqli_close($conn);
?>