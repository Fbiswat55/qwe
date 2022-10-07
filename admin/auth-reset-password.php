<?php
// Include config file
require_once "layouts/config.php";
$reset_token = $_GET['token'];
if (empty($reset_token)) {
    header("location: pages-404.php");
    exit();
}
$checkToken = "SELECT email FROM tai_khoan WHERE token = '$reset_token'";
$rs_checkToken = mysqli_query($conn, $checkToken);
if (mysqli_num_rows($rs_checkToken) == 0) {
    header("location: pages-404.php");
    exit();
}
$row = mysqli_fetch_array($rs_checkToken);
// Define variables and initialize with empty values
$password = $confirm_password = "";
$error = "";

$date_create = date("Y-m-d H:i:s");
// Processing form data when form is submitted
if (isset($_POST['resetpass'])) {
    $email = $row['email'];
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $error = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $error = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $error = "Please enter a confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($error) && ($password != $confirm_password)) {
            $error = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($error)) {
        $password = md5($_POST["password"]);
        $param_token = bin2hex(random_bytes(50));
        $insert = "update tai_khoan set mat_khau = '$password', token = '$param_token' where email = '$email'";
        $result = mysqli_query($conn, $insert);
        if ($result) {
            $success = 'Cập nhật mật khẩu thành công.';
        }
        header("location: index.php");
    }

    // Close connection
    mysqli_close($conn);
}
?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Reset Password | APIServer Dashboard</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>

<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0 justify-content-center">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="index.php" class="d-block auth-logo">
                                    <img src="/assets/images/logo-sm.svg" alt="" height="28"> <span class="logo-txt">APIServer</span>
                                </a>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-0">Reset Password</h5>
                                    <p class="text-muted mt-2">Reset password APIServer account.</p>
                                </div>
                                <form class="needs-validation custom-form mt-4 pt-2" method="POST">
                                <div class="mb-3">
                                    <label for="useremail" class="form-label">Email</label>
                                    <input type="email" class="form-control" value="<?php echo $row['email'] ?>" readonly>
                                </div>
                                    <div class="mb-3">
                                        <label for="userpassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="userpassword" placeholder="Enter password" required name="password">
                                        <span class="text-danger"><?php echo $error; ?></span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm_password" placeholder="Enter confirm password" name="confirm_password">
                                        <span class="text-danger"><?php echo $error; ?></span>
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" name="resetpass" type="submit">Update</button>
                                    </div>
                                </form>

                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>
                                        document.write(new Date().getFullYear())
                                    </script> APIServer . Develop by Bao Nguyen</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>


<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<!-- validation init -->
<script src="/assets/js/pages/validation.init.js"></script>

</body>

</html>