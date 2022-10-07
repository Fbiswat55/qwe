<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Package Wizard | APIServer Dashboard</title>
    <?php include 'layouts/head.php'; ?>

    <!-- twitter-bootstrap-wizard css -->
    <link rel="stylesheet" href="/assets/libs/twitter-bootstrap-wizard/prettify.css">

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
                            <h4 class="mb-sm-0 font-size-18">Package Wizard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Package</a></li>
                                    <li class="breadcrumb-item active">Package wizard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Trình tạo package</h4>
                            </div>
                            <div class="card-body">

                                <div id="progrss-wizard" class="twitter-bs-wizard">
                                    <ul class="twitter-bs-wizard-nav nav nav-pills nav-justified">
                                        <li class="nav-item">
                                            <a href="#progress-seller-details" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Basic info">
                                                    <i class="bx bx-list-ul"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#progress-company-document" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Validate info">
                                                    <i class="bx bx-fingerprint"></i>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="#progress-bank-detail" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Finish">
                                                    <i class="bx bx-info-circle"></i>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- wizard-nav -->

                                    <div id="bar" class="progress mt-4">
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"></div>
                                    </div>
                                    <div class="tab-content twitter-bs-wizard-tab-content">
                                        <div class="tab-pane" id="progress-seller-details">
                                            <div class="text-center mb-4">
                                                <h5>Thông tin về gói</h5>
                                                <p class="card-title-desc">Thông tin cơ bản</p>
                                            </div>
                                            <form>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="progresspill-firstname-input">Tên package</label>
                                                            <input type="text" class="form-control" id="packagename">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Next <i class="bx bx-chevron-right ms-1"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="progress-company-document">
                                            <div>
                                                <div class="text-center mb-4">
                                                    <h5>Thông tin chi tiết</h5>
                                                    <p class="card-title-desc">Điền chính xác để gói hoạt động</p>
                                                </div>
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-pancard-input" class="form-label">Phiên bản</label>
                                                                <input type="text" class="form-control" id="packagever">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-vatno-input" class="form-label">Mã SHA1 của file dylib</label>
                                                                <input type="text" class="form-control" id="packagehash">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-cstno-input" class="form-label">Link tải deb mới khi người dùng cập nhật, nên rút gọn tránh lỗi</label>
                                                                <input type="text" class="form-control" id="packagenewlink">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-servicetax-input" class="form-label">Link profile của bạn cho user</label>
                                                                <input type="text" class="form-control" id="packageprofile">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                                    <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Next <i class="bx bx-chevron-right ms-1"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="progress-bank-detail">
                                            <div>
                                                <div class="text-center mb-4">
                                                    <h5>Chuẩn bị hoàn tất</h5>
                                                    <p class="card-title-desc">Kiểm tra lại thông tin trước khi khởi tạo</p>
                                                </div>
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label for="progresspill-cardno-input" class="form-label">Thông tin cập nhật, chỉ hiển thị với người chưa cập nhật, có thể bỏ trống</label>
                                                                <input type="text" class="form-control" id="packageupdatenoti">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <p class="form-label">Kích hoạt package ngay sau khi tạo</p>
                                                                <input type="checkbox" id="switch1" switch="none" checked />
                                                                <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>
                                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                                    <li class="float-end"><a href="javascript: void(0);" class="btn btn-primary" onclick="start()">Save
                                                            Changes</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
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
        <!-- end modal -->
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

<!-- twitter-bootstrap-wizard js -->
<script src="/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="/assets/libs/twitter-bootstrap-wizard/prettify.js"></script>

<!-- form wizard init -->
<script src="/assets/js/pages/form-wizard.init.js"></script>

<script src="/assets/js/app.js"></script>

</body>
<script>

    function start() {
        var package_name = $('#packagename').val();
        var package_version = $('#packagever').val();
        var package_sha1 = $('#packagehash').val();
        var package_newlink = $('#packagenewlink').val();
        var package_profile = $('#packageprofile').val();
        var package_changelog = $('#packageupdatenoti').val();
        var package_sw = document.querySelector('#switch1');
        var package_status;
        if (package_sw.checked) {
            package_status = 1;
        }else {
            package_status = 2;
        }
        if (!package_name) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa nhập tên gói',
                'info'
            )
            return;
        }

        if (!package_version) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa nhập phiên bản',
                'info'
            )
            return;
        }

        if (!package_sha1) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa nhập sha1 của dylib',
                'info'
            )
            return;
        }

        if (!package_profile) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa nhập link profile',
                'info'
            )
            return;
        }
        if (!package_newlink) {
            package_newlink.value = "https://www.google.com/"
        }
        if (!package_changelog) {
            package_changelog.value = "Không có thay đổi mới !"
        }

        Swal.fire({
            title: 'Xác nhận',
            icon: 'warning',
            text: `Xác nhận khởi tạo gói ?`,
            showCancelButton: true,
            confirmButtonText: "Xác nhận",

        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-package.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'creatpackage',
                        package_name: package_name,
                        package_version: package_version,
                        package_sha1: package_sha1,
                        package_newlink: package_newlink,
                        package_profile: package_profile,
                        package_changelog: package_changelog,
                        package_status: package_status

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
                            setTimeout(function() {
                                window.location.href = `/admin/list-deb.php`;
                            }, 1500);
                        }
                    }
                });
            }
        });



    }
</script>

</html>