<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';

if (isset($_SESSION['username']) && isset($_SESSION['level']) && $row_acc['trang_thai'] == 1) {
    $email = $_SESSION['email'];
    // dem so luong nhan vien
    if ($_SESSION['level'] == 0 || $_SESSION['level'] == 2) {
        $nv = "SELECT count(id) as soluong FROM tbldebkey where keystatus = 1 AND email = '$email'";
        $resultNV = mysqli_query($conn, $nv);
        $rowNV = mysqli_fetch_array($resultNV);
        $tongNV = $rowNV['soluong'];

        // dem so banned
        $nghiViec = "SELECT count(id) as soluong FROM tbldebkey WHERE keytype = 1 AND email = '$email'";
        $resultNghiViec = mysqli_query($conn, $nghiViec);
        $rowNghiViec = mysqli_fetch_array($resultNghiViec);
        $tongNghiViec = $rowNghiViec['soluong'];

        // dem so acc dang cho
        $tk = "SELECT count(id) as soluong FROM tbldebkey where keystatus = 0 AND email = '$email'";
        $resultTK = mysqli_query($conn, $tk);
        $rowTK = mysqli_fetch_array($resultTK);
        $tongTK = $rowTK['soluong'];

        $tk = "SELECT count(id) as soluong FROM tbldebver where email = '$email'";
        $resultDeb = mysqli_query($conn, $tk);
        $rowDeb = mysqli_fetch_array($resultDeb);
        $tongDeb = $rowDeb['soluong'];
    } else {
        $nv = "SELECT count(id) as soluong FROM tbldebkey where keystatus = 1";
        $resultNV = mysqli_query($conn, $nv);
        $rowNV = mysqli_fetch_array($resultNV);
        $tongNV = $rowNV['soluong'];

        // dem so banned
        $nghiViec = "SELECT count(id) as soluong FROM tbldebkey WHERE keytype = 1";
        $resultNghiViec = mysqli_query($conn, $nghiViec);
        $rowNghiViec = mysqli_fetch_array($resultNghiViec);
        $tongNghiViec = $rowNghiViec['soluong'];

        // dem so acc dang cho
        $tk = "SELECT count(id) as soluong FROM tbldebkey where keystatus = 0";
        $resultTK = mysqli_query($conn, $tk);
        $rowTK = mysqli_fetch_array($resultTK);
        $tongTK = $rowTK['soluong'];

        $tk = "SELECT count(id) as soluong FROM tbldebver";
        $resultDeb = mysqli_query($conn, $tk);
        $rowDeb = mysqli_fetch_array($resultDeb);
        $tongDeb = $rowDeb['soluong'];
    }

    $tk = "SELECT count(id) as soluong FROM tbldebkey where email = '$email'";
    $resultKey = mysqli_query($conn, $tk);
    $rowKey = mysqli_fetch_array($resultKey);
    $tongKey = $rowKey['soluong'];

    $tk = "SELECT count(id) as soluong FROM tbldebkey where keystatus = 1 AND email = '$email'";
    $resultKeyac = mysqli_query($conn, $tk);
    $rowKeyac = mysqli_fetch_array($resultKeyac);
    $tongKeyac = $rowKeyac['soluong'];

    $tk = "SELECT count(id) as soluong FROM tbldebkey where email = '$email'";
    $resultKeyunac = mysqli_query($conn, $tk);
    $rowKeyunac = mysqli_fetch_array($resultKeyunac);
    $tongKeyunac = $rowKeyunac['soluong'];
} else {
    header('Location: logout.php');
}

?>

<head>
    <title>APIServer Dashboard</title>

    <?php include 'layouts/head.php'; ?>

    <link href="/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

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
                            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">APIServer</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Thiết bị kết nối</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="<?php echo $tongNV; ?>">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success">Status</span>
                                    <a href="#" class="ms-1 text-muted font-size-13">Danh sách thiết bị</a>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text-truncate lh-sm">Key đang chờ</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="<?php echo $tongTK; ?>">0</span>
                                        </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-danger text-danger">Status</span>
                                    <a href="#" class="ms-1 text-muted font-size-13">Danh sách key</a>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col-->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Thiết bị bị chặn</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="<?php echo $tongNghiViec; ?>">0</span>
                                        </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success">Status</span>
                                    <a href="" class="ms-1 text-muted font-size-13">Danh sách thiết bị</a>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Debian</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="<?php echo $tongDeb; ?>">0</span>
                                        </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success">Status</span>
                                    <a href="#" class="ms-1 text-muted font-size-13">Danh sách debian</a>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row-->

                <div class="row">
                    <!-- chart1 -->

                    <div class="col-xl-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <div class="card-header">
                                        <h4 class="card-title">Dung lượng</h4>
                                        <p class="card-title-desc">Phiên bản trải nghiệm sẽ được tạo tối đa 15 key</p>
                                    </div>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center mb-4">
                                    <h5 class="card-title me-2">Lượng key khả dụng</h5>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-sm">
                                        <div id="invested-overview" data-colors='["#5156be", "#34c38f"]' class="apex-charts"></div>
                                    </div>
                                    <div class="col-sm align-self-center">
                                        <div class="mt-4 mt-sm-0">
                                            <p class="mb-1">Tổng dung lượng</p>
                                            <h4><?php echo $row_acc['keylimit'] ?> Key</h4>
                                            <div class="row g-0">
                                                <div class="col-6">
                                                    <div>
                                                        <p class="mb-2 text-muted text-uppercase font-size-11">Đã sử dụng</p>
                                                        <h5 class="fw-medium"><?php echo $tongKey ?> key</h5>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div>
                                                        <p class="mb-2 text-muted text-uppercase font-size-11">Còn lại</p>
                                                        <h5 class="fw-medium"><?php echo $row_acc['keylimit'] - $tongKey ?> key</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-2">
                                                <a href="pages-pricing.php" class="btn btn-primary btn-sm">View more <i class="mdi mdi-arrow-right ms-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Hướng dẫn sử dụng</h4>
                                        <p class="card-title-desc">Cách sử dụng Panel, cách tích hợp vào package</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <!-- 16:9 aspect ratio -->
                                        <div class="ratio ratio-16x9">
                                            <iframe src="https://www.youtube.com/embed/BNMgdwZNJcU" title="YouTube video" allowfullscreen=""></iframe>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div>
                </div> <!-- end row-->

            </div>
            <!-- container-fluid -->
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

<!-- apexcharts -->
<script src="/assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Plugins js-->
<script src="/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

<!-- dashboard init -->
<script src="/assets/js/pages/dashboard.init.js"></script>
<script>
    const usr = `<?php echo $_SESSION['username'] ?>`;

    function updateusr() {
        const id = `<?php echo $row_acc['id'] ?>`;
        if (usr == "") {
            Swal.fire({
                title: 'Cập nhật thông tin',
                text: 'Phiên bản mới thay thế họ tên bằng username, vui lòng cập nhật lại dưới đây. Nhập username phải bé hơn 32 kí tự và lớn hơn 5 kí tự không chứa ký tự đặc biệt có dấu',
                icon: 'info',
                input: 'text',
                showCancelButton: false,
                allowOutsideClick: false,
                confirmButtonText: "Xác nhận",
                preConfirm: (result) => {
                    if (!result) {
                        Swal.showValidationMessage(`Không được bỏ trống trường này`);
                    } else {
                        $.ajax({
                            url: baseurl + '/admin/module/ajax-useraccount.php',
                            type: 'POST',
                            dataType: 'JSON',

                            data: {
                                type: 'changeusername',
                                user_id: id,
                                user_username: result
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
                                    location.reload();
                                } else {
                                    Swal.fire("Thông báo", data.msg, "success");
                                    setTimeout(function() {
                                        window.location.href = '/admin/logout.php';
                                    }, 1500);
                                }
                            }
                        });
                    }
                }
            })

        }
    }
    const html5 = `<?php echo $settings_noti  ?>`;
    Swal.fire({
        title: 'Thông báo',
        icon: 'info',
        html: `${html5}`,
        showCloseButton: false,
        focusConfirm: false,
        allowOutsideClick: false,
        confirmButtonText: '<i class="fa fa-thumbs-up"></i> Đã đọc!'
    }).then((result) => {
        if (result.isConfirmed) {
            updateusr();
        }
    })

    var tile1 = <?php echo round($tongKey * 100 / $row_acc['keylimit']) ?>;
    var radialchartColors = getChartColorsArray("#invested-overview");
    var options = {
        chart: {
            height: 270,
            type: 'radialBar',
            offsetY: -10
        },
        plotOptions: {
            radialBar: {
                startAngle: -130,
                endAngle: 130,
                dataLabels: {
                    name: {
                        show: false
                    },
                    value: {
                        offsetY: 10,
                        fontSize: '18px',
                        color: undefined,
                        formatter: function(val) {
                            return val + "%";
                        }
                    }
                }
            }
        },
        colors: [radialchartColors[0]],
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: 'horizontal',
                gradientToColors: [radialchartColors[1]],
                shadeIntensity: 0.15,
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [20, 60]
            },
        },
        stroke: {
            dashArray: 4,
        },
        legend: {
            show: false
        },
        series: [tile1],
        labels: ['Series A'],
    }

    var chart = new ApexCharts(
        document.querySelector("#invested-overview"),
        options
    );

    chart.render();
</script>
<!-- App js -->
<script src="/assets/js/app.js"></script>

</body>

</html>