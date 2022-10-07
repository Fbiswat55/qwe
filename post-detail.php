<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/session.php';
$id = $_GET['id'];

$showData = "select tblproduct.id, title, postuser, postimg, postdetail, totaltype, daytotal,tai_khoan.email, weektotal, ngay_tao, monthtotal, postdate, allowgetkey, phoneuser, zalouser, fbuser, debid,debname, deblink, quyen from tblproduct
inner join tai_khoan on tai_khoan.username = tblproduct.postuser inner join tbldebver on tbldebver.id = tblproduct.debid where tblproduct.id = '$id'";
$result = mysqli_query($conn, $showData);
$row_post = mysqli_fetch_array($result);

?>

<head>

    <title>Homepage | Bao Nguyen</title>
    <?php include 'layouts/head.php'; ?>

    <!-- plugin css -->
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

    <?php include 'layouts/head-style.php'; ?>
    <!-- <style>
        .items-img {
            position: relative;
        }
        .items-img>span {
            position: absolute;
        }
    </style> -->
</head>

<body data-topbar="light" data-layout="horizontal">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include 'layouts/horizontal-menu.php'; ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Bài đăng</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Homepage</a></li>
                                            <li class="breadcrumb-item active">Post</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-9 col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm order-2 order-sm-1">
                                                <div class="d-flex align-items-start mt-3 mt-sm-0">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-xl me-3">
                                                            <div class="avatar-title bg-soft-light text-light rounded-circle fs-1">
                                                                <i class="bx bxs-user-circle"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="font-size-16 mb-1"><?php echo $row_post['postuser'] ?></h5>
                                                            <p class="text-muted font-size-13"><?php if ($row_post['quyen'] == 0) {
                                                                                                    echo 'Normal User';
                                                                                                } else if ($row_post['quyen'] == 1) {
                                                                                                    echo 'Administrator';
                                                                                                } else {
                                                                                                    echo 'Vip User';
                                                                                                }
                                                                                                ?></p>

                                                            <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                                                <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Development</div>
                                                                <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i><?php echo $row_post['email'] ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-auto order-1 order-sm-2">
                                                <div class="d-flex align-items-start justify-content-end gap-2">
                                                    <div>
                                                        <a href="<?php echo $row_post['fbuser'] ?>"><button type="button" class="btn btn-soft-light"><i class="me-1"></i> Liên hệ</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link px-3 active" data-bs-toggle="tab" href="#overview" role="tab">Bài viết</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link px-3" data-bs-toggle="tab" href="#about" role="tab">Thông tin</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link px-3" data-bs-toggle="tab" href="#post" role="tab">Liên hệ</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->

                                <div class="tab-content">
                                    <div class="tab-pane active" id="overview" role="tabpanel">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Tiêu đề</h5>
                                            </div>
                                            <div class="card-body">
                                            <?php echo $row_post['postdetail'] ?>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end tab pane -->

                                    <div class="tab-pane" id="about" role="tabpanel">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Thông tin về tập tin trong bài viết</h5>
                                            </div>
                                            <div class="card-body">
                                                <div>
                                                    <div class="pb-3">
                                                        <h5 class="font-size-15">Thông tin chung :</h5>
                                                        <div class="text-muted">
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Tên gói: <?php echo $row_post['debname'] ?></li>
                                                                <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Giá theo ngày: <?php echo $row_post['daytotal'] ?></li>
                                                                <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Giá theo tuần: <?php echo $row_post['weektotal'] ?></li>
                                                                <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Giá theo tháng: <?php echo $row_post['monthtotal'] ?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end tab pane -->

                                    <div class="tab-pane" id="post" role="tabpanel">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Thông tin chủ sở hữu</h5>
                                            </div>
                                            <div class="card-body">
                                                <div>
                                                    <div class="pb-3">
                                                        <div class="text-muted">
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Username: <?php echo $row_post['postuser'] ?></li>
                                                                <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Email: <?php echo $row_post['email'] ?></li>
                                                                <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Thời gian tham gia: <?php echo time_string($row_post['ngay_tao']) ?></li>
                                                                <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Số điện thoại: <?php echo $row_post['phoneuser'] ?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end tab pane -->
                                </div>
                                <!-- end tab content -->
                            </div>
                            <!-- end col -->

                            <div class="col-xl-3 col-lg-4">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Thông tin file</h5>

                                        <div class="list-group list-group-flush">

                                            <div class="d-flex align-items-center mb-3">
                                                <div class="flex-grow-1">
                                                    <div>
                                                        <h5 class="font-size-14 mb-1">Tên tập tin</h5>
                                                        <p class="font-size-13 text-muted mb-0"><?php echo $row_post['debname'] ?></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center mb-3">

                                                <div class="flex-grow-1">
                                                    <div>
                                                        <h5 class="font-size-14 mb-1">Cập nhật</h5>
                                                        <p class="font-size-13 text-muted mb-0"><?php echo time_string($row_post['postdate']) ?></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center mb-3">
                                                <div class="flex-grow-1">
                                                    <div>
                                                        <h5 class="font-size-14 mb-1">Loại</h5>
                                                        <p class="font-size-13 text-muted mb-0"><?php echo $row_post['totaltype'] == 0 ? 'Free, có thể get key tuần' : 'Cần kích hoạt, có thể get key ngày nếu chủ sở hữu bật get key' ?></p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="d-flex align-items-center">
                                            <?php if (isset($_SESSION['username'])) {
                                                include 'layouts/post-assets.php';
                                            } else {
                                                echo "<a href='/admin/auth-login.php'><button type='button' class='btn btn-danger waves-effect btn-label waves-light m-lg-1'><i class='bx bx-log-in label-icon'></i> Vui lòng đăng nhập</button></a>";
                                            }
                                            ?>
                                        </div>

                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                <!-- <script src="assets/js/pages/anti-f12.js"></script> -->

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

        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- Plugins js-->
        <script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
        <!-- dashboard init -->
        <script src="assets/js/pages/dashboard.init.js"></script>

        <script src="assets/js/app2.js"></script>
        <script>
            function getkeyfree1(idpost, buy_id) {
                Swal.fire({
                    title: 'Xác nhận',
                    icon: 'warning',
                    text: `Bạn chỉ được nhận 1 key thời hạn 24 giờ trong 1 ngày, key sẽ tính giờ khi bạn kích hoạt. Đồng ý tiếp tục ?`,
                    showCancelButton: true,
                    confirmButtonText: "Xác nhận",

                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: baseurl + '/admin/module/ajax-key.php',
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                type: 'guestgenkey',
                                datekey: 1,
                                post_id: idpost,
                                post_buy: buy_id
                            },
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Thông báo',
                                    text: 'Please wait...',
                                    icon: 'info',
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading()
                                    }
                                })
                            },
                            success: (data) => {
                                if (data.error) {
                                    Swal.fire("Thông báo", data.msg, "error");
                                } else {
                                    Swal.fire("Thông báo", data.msg, "success");
                                }
                            },
                            error: (data) => {
                                Swal.fire("Thông báo", data.error, "error");
                                console.log(data);
                            }
                        });
                    }
                });
            }
            
            function getkeyfree(idpost, buy_id) {
                Swal.fire({
                    title: 'Xác nhận',
                    icon: 'warning',
                    text: `Bạn chỉ được nhận 1 key trong 1 ngày, key sẽ tính giờ khi bạn kích hoạt. Đồng ý tiếp tục ?`,
                    showCancelButton: true,
                    confirmButtonText: "Xác nhận",

                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: baseurl + '/admin/module/ajax-key.php',
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                type: 'guestgenkey',
                                datekey: 7,
                                post_id: idpost,
                                post_buy: buy_id
                            },
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Thông báo',
                                    text: 'Please wait...',
                                    icon: 'info',
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading()
                                    }
                                })
                            },
                            success: (data) => {
                                if (data.error) {
                                    Swal.fire("Thông báo", data.msg, "error");
                                } else {
                                    Swal.fire("Thông báo", data.msg, "success");
                                }
                            },
                            error: (data) => {
                                Swal.fire("Thông báo", data.error, "error");
                                console.log(data);
                            }
                        });
                    }
                });
            }

            function acti(idbuyer, idpro) {

            }

            function dev() {
                Swal.fire({
                    title: 'Thông báo',
                    text: "Khu vực dành cho thành viên quản lý, không có nhu cầu vui lòng bỏ qua !",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Đi vào bảng điều khiển',
                    cancelButtonText: 'Quay lại',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/admin/index.php"
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {

                    }
                })
            }
        </script>
</body>

</html>