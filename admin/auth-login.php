<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to index page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Login | APIServer Dashboard</title>
    <?php include 'layouts/head.php'; ?>

    <?php include 'layouts/head-style.php'; ?>
</head>

<?php include 'layouts/body.php';?>
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
                                    <h5 class="mb-0">Welcome Back !</h5>
                                    <p class="text-muted mt-2">Sign in to continue to APIServer.</p>
                                </div>
                                <form class="custom-form mt-4 pt-2" method="post">
                                    <div class="mb-3">
                                        <label class="form-label" for="username">Username or email</label>
                                        <input type="text" class="form-control" id="username" placeholder="Enter username">

                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <label class="form-label" for="password">Password</label>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="">
                                                    <a href="auth-recoverpw.php" class="text-muted">Forgot password?</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" aria-label="Password" aria-describedby="password-addon">

                                            <button class="btn btn-light ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember-check">
                                                <label class="form-check-label" for="remember-check">
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" id="submit" type="button" onclick="login()">Log In</button>
                                    </div>
                                </form>

                                <div class="mt-4 pt-2 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign in with -</h5>
                                    </div>

                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-primary text-white border-primary">
                                                <i class="mdi mdi-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-info text-white border-info">
                                                <i class="mdi mdi-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-danger text-white border-danger">
                                                <i class="mdi mdi-google"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="mt-5 text-center">
                                    <p class="text-muted mb-0">Don't have an account ? <a href="auth-register.php" class="text-primary fw-semibold"> Signup now </a> </p>
                                </div>
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

<script>
    var baseurl = window.location.protocol + "//" + window.location.host;

    function login() {
        var user_username = $('#username').val();
        var user_password = $('#password').val();
        if (!user_username) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa nhập username',
                'info'
            )
            return;
        }
        if (!user_password) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa nhập mật khẩu',
                'info'
            )
            return;
        }
        $.ajax({
            url: baseurl + '/admin/module/ajax-useraccount.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                type: 'login',
                user_username: user_username,
                user_password: user_password
            },
            beforeSend: function() {
                wait('#submit', false);
            },
            complete: function() {
                wait('#submit', true, 'Login');
            },
            success: (data) => {
                if (data.error) {
                    Swal.fire(
                        'Thông báo',
                        data.msg,
                        'error'
                    )
                } else {
                    Swal.fire(
                        'Thông báo',
                        'Đăng nhập thành công',
                        'success'
                    )
                    setTimeout(function() {
                        window.location.href = '/index.php';
                    }, 1000);
                }
            }
        })

    }
</script>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>
<!-- password addon init -->
<script src="/assets/js/pages/pass-addon.init.js"></script>

</body>

</html>