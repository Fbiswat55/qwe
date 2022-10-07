<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Register | APIServer Dashboard</title>
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
                                    <h5 class="mb-0">Register Account</h5>
                                    <p class="text-muted mt-2">Get your free APIServer account now.</p>
                                </div>
                                <form class="needs-validation custom-form mt-4 pt-2" method="post">
                                    <div class="mb-3">
                                        <label for="useremail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="useremail" placeholder="Enter email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" placeholder="Enter username" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="userpassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="userpassword" placeholder="Enter password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm_password" placeholder="Enter confirm password" required>
                                    </div>
                                        <div class="mb-3 justify-content-center">
                                        <div class="g-recaptcha" data-sitekey="6Ld7pXIfAAAAAOiyNCkheogLzPqSFiQJMPHajYOW"></div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" id="submit" onclick="reg()" type="button">Register</button>
                                    </div>
                                </form>

                                <div class="mt-4 pt-2 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign up using -</h5>
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
                                    <p class="text-muted mb-0">Already have an account ? <a href="auth-login.php" class="text-primary fw-semibold"> Login </a> </p>
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
<script src="https://www.google.com/recaptcha/api.js?hl=vi"></script>
<script>
    var baseurl = window.location.protocol + "//" + window.location.host;
    
    function reg() {
        var user_username = $('#username').val();
        var user_password = $('#userpassword').val();
        var user_email = $('#useremail').val();
        var co_password = $('#confirm_password').val();
        if (!user_email) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa nhập email',
                'info'
            )
            return;
        }
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
        if (user_password != co_password) {
            Swal.fire(
                'Thông báo',
                'Xác nhận lại mật khẩu',
                'info'
            )
            return;
        }
        
        if (!grecaptcha.getResponse()) {
            Swal.fire(
                'Thông báo',
                'Vui lòng xác thực captcha',
                'info'
            )
            return;
        }
        
        $.ajax({
            url: baseurl + '/admin/module/ajax-useraccount.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                type: 'register',
                user_username: user_username,
                user_password: user_password,
                user_email: user_email,
                recapcha: grecaptcha.getResponse()
            },
            beforeSend: function() {
                wait('#submit', false);
            },
            complete: function() {
                wait('#submit', true, 'Register');
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
                        data.msg,
                        'success'
                    )
                    setTimeout(function() {
                        window.location.href = '/admin/auth-login.php';
                    }, 1000);
                }
            }
        })

    }
</script>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<!-- validation init -->
<script src="/assets/js/pages/validation.init.js"></script>

</body>

</html>