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

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- card -->
                                    <div class="card bg-primary text-white shadow-primary card-h-100">
                                        <!-- card body -->
                                        <div class="card-body p-0">
                                            <div id="carouselExampleCaptions" class="carousel slide text-center widget-carousel" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <div class="text-center p-4">
                                                            <i class="mdi mdi-bitcoin widget-box-1-icon"></i>
                                                            <div class="avatar-md m-auto">
                                                                <span class="avatar-title rounded-circle bg-soft-light text-white font-size-24">
                                                                    <i class="mdi mdi-currency-btc"></i>
                                                                </span>
                                                            </div>
                                                            <h4 class="mt-3 lh-base fw-normal text-white"><b>API</b> Server</h4>
                                                            <p class="text-white-50 font-size-13"> Cung c???p gi???i ph??p qu???n l?? c??c g??i cho ?????i l?? </p>
                                                            <a href="admin/index.php"><button type="button" class="btn btn-light btn-sm"> Dashboard <i class="mdi mdi-arrow-right ms-1"></i></button></a>
                                                        </div>
                                                    </div>
                                                    <!-- end carousel-item -->
                                                    <div class="carousel-item">
                                                        <div class="text-center p-4">
                                                            <i class="mdi mdi-ethereum widget-box-1-icon"></i>
                                                            <div class="avatar-md m-auto">
                                                                <span class="avatar-title rounded-circle bg-soft-light text-white font-size-24">
                                                                    <i class="mdi mdi-ethereum"></i>
                                                                </span>
                                                            </div>
                                                            <h4 class="mt-3 lh-base fw-normal text-white"><b></b> Uy t??n - B???o m???t</h4>
                                                            <p class="text-white-50 font-size-13"> Kh??ng c???n giao m?? ngu???n, b???n c?? th??? t??? t??ch h???p v??o g??i theo ?? mu???n. C?? h??? tr??? n???u ????ng k?? s??? d???ng d???ch v??? b???n tr??? ph?? c???a t??i. </p>
                                                            <button type="button" class="btn btn-light btn-sm">View details <i class="mdi mdi-arrow-right ms-1"></i></button>
                                                        </div>
                                                    </div>
                                                    <!-- end carousel-item -->
                                                    <div class="carousel-item">
                                                        <div class="text-center p-4">
                                                            <i class="mdi mdi-litecoin widget-box-1-icon"></i>
                                                            <div class="avatar-md m-auto">
                                                                <span class="avatar-title rounded-circle bg-soft-light text-white font-size-24">
                                                                    <i class="mdi mdi-litecoin"></i>
                                                                </span>
                                                            </div>
                                                            <h4 class="mt-3 lh-base fw-normal text-white"><b>Hack</b> Free</h4>
                                                            <p class="text-white-50 font-size-13"> Cung c???p m???t s??? b???n hack free</p>
                                                            <button type="button" class="btn btn-light btn-sm">Let's Go ! <i class="mdi mdi-arrow-right ms-1"></i></button>
                                                        </div>
                                                    </div>
                                                    <!-- end carousel-item -->
                                                </div>
                                                <!-- end carousel-inner -->

                                                <div class="carousel-indicators carousel-indicators-rounded">
                                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                </div>
                                                <!-- end carousel-indicators -->
                                            </div>
                                            <!-- end carousel -->
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end col -->
                    </div> <!-- end row-->

                    <div class="row">


                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">L?????t get key c??ng khai</h4>
                                    <div class="flex-shrink-0">
                                        <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#transactions-all-tab" role="tab">
                                                    All
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#transactions-buy-tab" role="tab">
                                                    Buy
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#transactions-sell-tab" role="tab">
                                                    Free
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- end nav tabs -->
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body px-0">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                                            <div class="table-responsive px-3" data-simplebar style="max-height: 352px;">
                                                <table class="table align-middle table-nowrap table-borderless">
                                                    <tbody>
                                                        <?php
                                                        foreach ($arrShow as $arrS) {
                                                        ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                    <div class="font-size-22 text-success">
                                                                        <i class="bx bx-down-arrow-circle d-block"></i>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1"><?php echo $arrS['usernameget']; ?></h5>
                                                                        <p class="text-muted mb-0 font-size-12">User</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0"><?php echo $arrS['debname']; ?></h5>
                                                                        <p class="text-muted mb-0 font-size-12">T??n g??i</p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 text-muted mb-0"><?php echo $arrS['gettype'] == 0 ? '<span class="badge rounded-pill bg-danger">Free</span>' : '<span class="badge rounded-pill bg-success">Paid</span>'; ?></h5>
                                                                        <p class="text-muted mb-0 font-size-12">Lo???i</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php

                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->
                                        <div class="tab-pane" id="transactions-buy-tab" role="tabpanel">
                                            <div class="table-responsive px-3" data-simplebar style="max-height: 352px;">
                                                <table class="table align-middle table-nowrap table-borderless">
                                                    <tbody>
                                                        <?php
                                                        foreach ($arrShow as $arrS) {
                                                            if ($arrS['gettype'] == 1) {


                                                        ?>
                                                                <tr>
                                                                    <td style="width: 50px;">
                                                                        <div class="font-size-22 text-success">
                                                                            <i class="bx bx-down-arrow-circle d-block"></i>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div>
                                                                            <h5 class="font-size-14 mb-1"><?php echo $arrS['usernameget']; ?></h5>
                                                                            <p class="text-muted mb-0 font-size-12">User</p>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="text-end">
                                                                            <h5 class="font-size-14 mb-0"><?php echo $arrS['debname']; ?></h5>
                                                                            <p class="text-muted mb-0 font-size-12">T??n g??i</p>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="text-end">
                                                                            <h5 class="font-size-14 text-muted mb-0"><?php echo $arrS['gettype'] == 0 ? '<span class="badge rounded-pill bg-danger">Free</span>' : '<span class="badge rounded-pill bg-success">Paid</span>'; ?></h5>
                                                                            <p class="text-muted mb-0 font-size-12">Lo???i</p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->
                                        <div class="tab-pane" id="transactions-sell-tab" role="tabpanel">
                                            <div class="table-responsive px-3" data-simplebar style="max-height: 352px;">
                                                <table class="table align-middle table-nowrap table-borderless">
                                                    <tbody>
                                                        <?php
                                                        foreach ($arrShow as $arrS) {
                                                            if ($arrS['gettype'] == 0) {


                                                        ?>
                                                                <tr>
                                                                    <td style="width: 50px;">
                                                                        <div class="font-size-22 text-success">
                                                                            <i class="bx bx-down-arrow-circle d-block"></i>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div>
                                                                            <h5 class="font-size-14 mb-1"><?php echo $arrS['usernameget']; ?></h5>
                                                                            <p class="text-muted mb-0 font-size-12">User</p>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="text-end">
                                                                            <h5 class="font-size-14 mb-0"><?php echo $arrS['debname']; ?></h5>
                                                                            <p class="text-muted mb-0 font-size-12">T??n g??i</p>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="text-end">
                                                                            <h5 class="font-size-14 text-muted mb-0"><?php echo $arrS['gettype'] == 0 ? '<span class="badge rounded-pill bg-danger">Free</span>' : '<span class="badge rounded-pill bg-success">Paid</span>'; ?></h5>
                                                                            <p class="text-muted mb-0 font-size-12">Lo???i</p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->
                                    </div>
                                    <!-- end tab content -->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                        <?php
                        $count = 1;
                        foreach ($arrShowPost as $arrS) {
                        ?>
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1"><?php echo $arrS['title']; ?></h4>
                                        <div class="flex-shrink-0">
                                            <ul class="nav nav-tabs-custom card-header-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#buy-tab<?php echo $count ?>" role="tab">Mua</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#sell-tab<?php echo $count ?>" role="tab" <?php echo $arrS['status'] == 0 || $arrS['allowgetkey'] == 0 ? 'disabled' : ''; ?>>Get key free</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- end card header -->
                                    <div class="position-relative">
                                        <span class="text-white position-absolute <?php echo $arrS['status'] == 1 ? 'bg-success' : 'bg-danger'; ?> px-2 py-1 rounded-end "><?php echo $arrS['status'] == 1 ? '???? c???p nh???t' : 'B???o tr??'; ?></span>
                                        <span style="right: 0px;" class="float-right text-white position-absolute <?php echo $arrS['allowgetkey'] == 1 ? 'bg-success' : 'bg-danger'; ?> px-2 py-1 rounded-start "><?php echo $arrS['allowgetkey'] == 1 ? 'C?? key test' : 'Kh??ng h??? tr??? test'; ?></span>
                                        <img class="card-img-top img-fluid" src="<?php echo $arrS['postimg']; ?>">
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="buy-tab<?php echo $count ?>" role="tabpanel">
                                                <div class="float-end ms-2">
                                                    <h5 class="font-size-14"><i class="bx bx-wallet text-primary font-size-16 align-middle me-1"></i> <a href="#!" class="text-reset text-decoration-underline"><?php echo $arrS['totaltype'] == 0 ? 'Free' : 'Paid'; ?></a></h5>
                                                </div>
                                                <h5 class="font-size-14 mb-4"><i class="bx bx-user text-primary font-size-16 align-middle me-1"></i><?php echo $arrS['postuser']; ?></h5>
                                                <div>
                                                    <div class="form-group mb-1 text-center">
                                                        <label class="text-center"><?php echo $arrS['totaltype'] == 0 ? 'Hi???n ??ang mi???n ph??, c?? th??? get key d??i h???n' : 'B???ng gi??'; ?></label>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <div class="float-end ms-2">
                                                            <h5 class="font-size-14"><i class="bx bx-wallet text-primary font-size-16 align-middle me-1"></i> <a href="#!" class="text-reset text-decoration-underline"><?php echo $arrS['daytotal']; ?></a></h5>
                                                        </div>
                                                        <h5 class="font-size-14 mb-4"><i class="bx bx-time-five text-primary font-size-16 align-middle me-1"></i>Ng??y</h5>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <div class="float-end ms-2">
                                                            <h5 class="font-size-14"><i class="bx bx-wallet text-primary font-size-16 align-middle me-1"></i> <a href="#!" class="text-reset text-decoration-underline"><?php echo $arrS['weektotal']; ?></a></h5>
                                                        </div>
                                                        <h5 class="font-size-14 mb-4"><i class="bx bx-time-five text-primary font-size-16 align-middle me-1"></i>Tu???n</h5>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <div class="float-end ms-2">
                                                            <h5 class="font-size-14"><i class="bx bx-wallet text-primary font-size-16 align-middle me-1"></i> <a href="#!" class="text-reset text-decoration-underline"><?php echo $arrS['monthtotal']; ?></a></h5>
                                                        </div>
                                                        <h5 class="font-size-14 mb-4"><i class="bx bx-time-five text-primary font-size-16 align-middle me-1"></i>Th??ng</h5>
                                                    </div>
                                                    <div class="text-center">
                                                        <a href="<?php echo $arrS['status'] == 0 ? '#' : $arrS['deblink']; ?>" target="#"><button type="button" class="btn btn-success w-md" <?php echo $arrS['status'] == 0 ? 'disabled' : ''; ?>>T???i xu???ng</button></a>
                                                        <button type="button" onclick="detail(<?php echo $arrS['id']?>)" class="btn btn-primary w-md" <?php echo $arrS['status'] == 0 ? 'disabled' : ''; ?>>Xem chi ti???t</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                            <div class="tab-pane" id="sell-tab<?php echo $count ?>" role="tabpanel">
                                                <div class="float-end ms-2">
                                                    <h5 class="font-size-14"><i class="bx bx-time-five text-primary font-size-16 align-middle me-1"></i> <a href="#!" class="text-reset"><?php echo $arrS['totaltype'] == 0 ? '7 ng??y' : '1 ng??y'; ?></a></h5>
                                                </div>
                                                <h5 class="font-size-14 mb-4">Th???i h???n</h5>

                                                <div>
                                                    <div class="text-center">
                                                        <a href="<?php echo isset($_SESSION['username']) ? '#' : 'admin/auth-login.php'; ?>"><button onclick="<?php echo $arrS['totaltype'] == 0 ? 'getkeyfree(' . $arrS['id'] . ',' . $row_acc['id'] . ')' : 'getkeyfree1(' . $arrS['id'] . ',' . $row_acc['id'] . ')' ?>" type="button" class="btn btn-danger w-md" <?php echo $arrS['status'] == 0 ? 'disabled' : ''; ?>><?php echo isset($_SESSION['username']) ? 'Nh???n Key' : 'Vui l??ng ????ng nh???p'; ?></button></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                        </div>
                                        <!-- end tab content -->
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                        <?php
                            $count++;
                        }
                        ?>
                        <!-- end col -->
                    </div><!-- end row -->

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

function getkeyfree1(idpost, buy_id) {
                Swal.fire({
                    title: 'X??c nh???n',
                    icon: 'warning',
                    text: `B???n ch??? ???????c nh???n 1 key th???i h???n 24 gi??? trong 1 ng??y, key s??? t??nh gi??? khi b???n k??ch ho???t. ?????ng ?? ti???p t???c ?`,
                    showCancelButton: true,
                    confirmButtonText: "X??c nh???n",

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
                                    title: 'Th??ng b??o',
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
                                    Swal.fire("Th??ng b??o", data.msg, "error");
                                } else {
                                    Swal.fire("Th??ng b??o", data.msg, "success");
                                }
                            },
                            error: (data) => {
                                Swal.fire("Th??ng b??o", data.error, "error");
                                console.log(data);
                            }
                        });
                    }
                });
            }

        function getkeyfree(idpost, buy_id) {
                Swal.fire({
                    title: 'X??c nh???n',
                    icon: 'warning',
                    text: `B???n ch??? ???????c nh???n 1 key trong 1 ng??y, key s??? t??nh gi??? khi b???n k??ch ho???t. ?????ng ?? ti???p t???c ?`,
                    showCancelButton: true,
                    confirmButtonText: "X??c nh???n",

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
                                    title: 'Th??ng b??o',
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
                                    Swal.fire("Th??ng b??o", data.msg, "error");
                                } else {
                                    Swal.fire("Th??ng b??o", data.msg, "success");
                                }
                            },
                            error: (data) => {
                                Swal.fire("Th??ng b??o", data.error, "error");
                                console.log(data);
                            }
                        });
                    }
                });
            }
        function detail(id) {
            window.location.href = `post-detail.php?id=${id}`
        }
        function dev() {
            Swal.fire({
                title: 'Th??ng b??o',
                text: "Khu v???c d??nh cho th??nh vi??n qu???n l??, kh??ng c?? nhu c???u vui l??ng b??? qua !",
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: '??i v??o b???ng ??i???u khi???n',
                cancelButtonText: 'Quay l???i',
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