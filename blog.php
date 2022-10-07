<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/session.php';

$showData = "SELECT tblhistorykey.id, usernameget, gettype, gettime,debid, debname FROM tblhistorykey
inner join tbldebver on tblhistorykey.debid = tbldebver.id order by tblhistorykey.id desc limit 10";
$result = mysqli_query($conn, $showData);
$arrShow = array();
while ($row = mysqli_fetch_array($result)) {
    $arrShow[] = $row;
}

$showPost = "select * from tblproduct order by id desc";
$resultPost = mysqli_query($conn, $showPost);
$arrShowPost = array();
while ($rowPost = mysqli_fetch_array($resultPost)) {
    $arrShowPost[] = $rowPost;
}

?>

<head>

    <title>Blog | Bao Nguyen</title>
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

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Blog</h4>
                                    <p class="card-title-desc">Thủ thuật hay và hướng dẫn sử dụng hệ thống.
                                    </p>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <?php
                                    foreach ($arrShowPost as $arrS) {
                                    ?>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <img class="rounded avatar-md" src="<?php echo $arrS['postimg'] ?>">
                                            </div>
                                            <div class="flex-grow-1">
                                                <a href="post-detail.php?id=<?php echo $arrS['id'] ?>" class="fw-bold fs-5"><?php echo $arrS['title'] ?></a>
                                                <p class="mb-0"> <?php echo substr($arrS['postdetail'], 0,50) ?>....</p>
                                            </div>
                                        </div>

                                        <hr>
                                    <?php
                                    }
                                    ?>

                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div>

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <script src="assets/js/pages/anti-f12.js"></script>

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
        function detail(id) {
            window.location.href = `post-detail.php?id=${id}`
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