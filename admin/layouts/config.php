<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'bao1213');
define('DB_NAME', 'trieubao_deb');
date_default_timezone_set('Asia/Ho_Chi_Minh');
/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$server_settings         = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM websetting WHERE id = '1'"));
$settings_status         = $server_settings['status'];
$settings_noti         = $server_settings['noti'];
$gmailid = $server_settings['mail'];
$gmailpassword = $server_settings['passmail'];
$gmailusername = $server_settings['usermail'];

?>
