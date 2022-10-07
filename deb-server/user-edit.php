<?php
$username = "root"; // Khai báo username
$password = "bao1213";      // Khai báo password
$server   = "localhost";   // Khai báo server
$dbname   = "trieubao_deb";      // Khai báo database


$connect = mysqli_connect($server, $username, $password, $dbname);


if (!$connect) {
    die("Không kết nối :" . mysqli_connect_error());
    exit();
}

$username = "";
$uuid = "";
$message= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["username"])) { $username = $_POST['username']; }
    if(isset($_POST["uuid"])) { $uuid = $_POST['uuid']; }
    if(isset($_POST["message"])) { $message = $_POST['message']; }
    
    //insert table
    $sqlcheck = "SELECT uuid FROM tbldebkey where uuid='$uuid'";
    $result = mysqli_query($connect, $sqlcheck);

if (mysqli_num_rows($result) > 0) {
    $sqlupdate = "Update tbldebkey set username='$username',uuid='$uuid' where uuid='$uuid'";
    
    if (mysqli_query($connect, $sqlupdate)) {
        echo "Cập nhật dữ liệu thành công, vui lòng khời động lại game !";
    }else {
        echo "Error: " . $sqlupdate . "<br>" . mysqli_error($connect);
    }
} else {
    $sql = "INSERT INTO tbldebkey (username, uuid, message) VALUES ('$username', '$uuid', '$message')";
    
    if (mysqli_query($connect, $sql)) {
        echo "Thêm dữ liệu thành công";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
}

    
    
    
}



mysqli_close($connect);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>Registration Form</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registration UUID</h2>
                    <a>Nhập đúng UUID, sau khi cập nhật cần khởi động lại game</a>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Name (Sẽ hiển thị trên deb dạng username)"  name="username" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Message (Sẽ hiển thị trên deb dạng text khi vào deb)" name="message" required>
                        </div>
                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="UUID" name="uuid" required>
                                </div>
                        <div class="p-t-20">
                            <button onclick="return confirm('Xác nhận đúng thông tin ?')" class="btn btn--radius btn--green" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
<!-- end document-->
