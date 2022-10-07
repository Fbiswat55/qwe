<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Change password | APIServer Dashboard</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Change password</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Account</a></li>
                                    <li class="breadcrumb-item active">Change password</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-lg-0">
                                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Thay đổi mật khẩu để tăng cường bảo mật</h5>

                                            <form>
                                                <div class="row mb-4">
                                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="<?php echo $_SESSION['email'] ?>" class="form-control" id="email" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="oldpassword" class="col-sm-3 col-form-label">Username</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="username" value="<?php echo $_SESSION['username'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="oldpassword" class="col-sm-3 col-form-label">Old Password</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" class="form-control" id="oldpassword">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="password" class="col-sm-3 col-form-label">New Password</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" class="form-control" id="newpassword">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="repassword" class="col-sm-3 col-form-label">Confirm Password</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" class="form-control" id="repassword">
                                                    </div>
                                                </div>
                                                <div class="row justify-content-end">
                                                    <div class="col-sm-9">
                                                        <button id="submit" type="button" onclick="changepw()" class="btn btn-primary w-md">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="/assets/js/app.js"></script>
<script>
    
    function changepw() {
        var user_password = $('#oldpassword').val();
        var user_usn = $('#username').val();
        var user_new_password = $('#newpassword').val();
        var re_password = $('#repassword').val();
        var user_email = "<?php echo $_SESSION['email'] ?>";
        if (!user_usn) {
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
                'Bạn chưa nhập mật khẩu cũ',
                'info'
            )
            return;
        }
        if (!user_new_password) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa nhập mật khẩu mới',
                'info'
            )
            return;
        }
        if (user_new_password != re_password) {
            Swal.fire(
                'Thông báo',
                'Mật khẩu xác nhận không trùng khớp',
                'error'
            )
            return;
        }
        $.ajax({
            url: baseurl + '/admin/module/ajax-useraccount.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                type: 'change_password',
                user_password: user_password,
                user_new_password: user_new_password,
                user_email: user_email,
                user_usn: user_usn
            },
            beforeSend: function() {
                wait('#submit', false);
            },
            complete: function() {
                wait('#submit', true, 'Submit');
            },
            success: (data) => {
                if (data.error) {
                    Swal.fire(
                        'Thông báo',
                        data.msg,
                        'error'
                    )
                } else {
                    Swal.fire({
                        title: 'Thông báo',
                        text: data.msg,
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Đăng nhập lại',
                        cancelButtonText: 'Trang chủ',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/admin/logout.php';
                        } else if (

                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            window.location.href = '/admin/index.php';
                        }
                    })
                }
            }
        })
    }
</script>
</body>

</html>