<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Pricing | APIServer Dashboard</title>
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
                            <h4 class="mb-sm-0 font-size-18">Pricing</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                    <li class="breadcrumb-item active">Pricing</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Nâng cấp tài khoản</h4>
                                <p class="card-title-desc">Sử dụng bản trả phí là 1 cách ủng hộ tôi cũng như nâng cấp quyền lợi của các bạn.
                                </p>
                            </div>
                            <!-- end card header -->

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-3">
                                        <div class="nav flex-column nav-pills pricing-tab-box" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link mb-3 active" id="v-pills-tab-one" data-bs-toggle="pill" href="#v-price-one" role="tab" aria-controls="v-price-one" aria-selected="true">
                                                <div class="d-flex align-items-center">
                                                    <i class="bx bx-check-circle h3 mb-0 me-4"></i>
                                                    <div class="flex-1">
                                                        <h2 class="fw-medium">$0 <span class="text-muted font-size-15">/ Free</span></h2>
                                                        <p class="fw-normal mb-0 text-muted">Trải nghiệm cơ bản</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="nav-link mb-3" id="v-pills-tab-two" data-bs-toggle="pill" href="#v-price-two" role="tab" aria-controls="v-price-two" aria-selected="false">
                                                <div class="d-flex align-items-center">
                                                    <i class="bx bx-check-circle h3 mb-0 me-4"></i>
                                                    <div class="flex-1">
                                                        <h2 class="fw-medium">$5 <span class="text-muted font-size-15">/ Hàng tháng</span></h2>
                                                        <p class="fw-normal mb-0 text-muted">Mở khoá giới hạn và nhận được hỗ trợ cách sử dụng</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-xl-9">
                                        <div class="tab-content text-muted mt-4 mt-xl-0" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="v-price-one" role="tabpanel" aria-labelledby="v-pills-tab-one">
                                                <div class="table-responsive text-center">
                                                    <table class="table table-bordered mb-0 table-centered">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="py-3">
                                                                        <h5 class="font-size-16 mb-0">Custom key</h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="py-3">
                                                                        <h5 class="font-size-16 mb-0">Unlimited key</h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="py-3">
                                                                        <h5 class="font-size-16 mb-0">Unlimited post</h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="py-3">
                                                                        <h5 class="font-size-16 mb-0">Unlimited package</h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="py-3">
                                                                        <h5 class="font-size-16 mb-0">Support</h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="py-3">
                                                                        <h5 class="font-size-16 mb-0">Make package</h5>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                            <td><i class="mdi mdi-close-circle text-danger font-size-20"></i> baontq-xxxxxx</td>
                                                                <td><i class="mdi mdi-close-circle text-danger font-size-20"></i> 15 Key</td>
                                                                <td><i class="mdi mdi-close-circle text-danger font-size-20"></i> 2 Post</td>
                                                                <td><i class="mdi mdi-check-circle text-success font-size-20"></i></td>
                                                                <td><i class="mdi mdi-close-circle text-danger font-size-20"></i></td>
                                                                <td><i class="mdi mdi-close-circle text-danger font-size-20"></i></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="v-price-two" role="tabpanel" aria-labelledby="v-pills-tab-two">
                                                <div class="table-responsive text-center">
                                                    <table class="table table-bordered mb-0 table-centered">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="py-3">
                                                                        <h5 class="font-size-16 mb-0">Custom key</h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="py-3">
                                                                        <h5 class="font-size-16 mb-0">Unlimited key</h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="py-3">
                                                                        <h5 class="font-size-16 mb-0">Unlimited post</h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="py-3">
                                                                        <h5 class="font-size-16 mb-0">Unlimited package</h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="py-3">
                                                                        <h5 class="font-size-16 mb-0">Support</h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="py-3">
                                                                        <h5 class="font-size-16 mb-0">Make package</h5>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                            <td><i class="mdi mdi-check-circle text-success font-size-20"></i> username-xxxxxx</td>
                                                                <td><i class="mdi mdi-check-circle text-success font-size-20"></i></td>
                                                                <td><i class="mdi mdi-check-circle text-success font-size-20"></i></td>
                                                                <td><i class="mdi mdi-check-circle text-success font-size-20"></i></td>
                                                                <td><i class="mdi mdi-check-circle text-success font-size-20"></i></td>
                                                                <td><i class="mdi mdi-check-circle text-success font-size-20"></i></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button onclick="contact()" type="button" class="btn btn-primary btn-lg waves-effect waves-light"><i class="bx bx-cart"></i> Liên hệ</button>
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

</body>
<script>
    function contact() {
        const swalWithBootstrapButtons = Swal.mixin({

        })

        swalWithBootstrapButtons.fire({
            title: 'Contact info',
            text: "Bạn có thể liên hệ 1 trong 2 nền tảng này",
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Facebook',
            cancelButtonText: 'Zalo',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "https://www.facebook.com/trieubaoIT"
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                location.href = "https://zalo.me/0395250686";
            }
        })
    }
</script>

</html>