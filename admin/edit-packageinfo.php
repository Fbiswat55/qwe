<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';

$id = $_GET['id'];
$showData = "SELECT id, debstatus,debname, debversion, debupdatenoti, newdeblink, debcontact, debhash, email FROM tbldebver where id = $id";
$result = mysqli_query($conn, $showData);
$row = mysqli_fetch_array($result);
if ($_SESSION['email'] != $row['email']) {
    header('location: pages-404.php');
    exit;
}
?>

<head>

    <title>Edit info | APIServer Dashboard</title>
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
                            <h4 class="mb-sm-0 font-size-18">Change package info</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">List package</a></li>
                                    <li class="breadcrumb-item active">Change info</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-14">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="mt-4 mt-lg-0">
                                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Một số thông tin khi bỏ trống sẽ điền giá trị mặc định</h5>

                                            <form>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Tên package</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="<?php echo $row['debname'] ?>" class="form-control" id="packagename">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="email" class="col-sm-3 col-form-label">Phiên bản</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="<?php echo $row['debversion'] ?>" class="form-control" id="packagever">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Email liên kết</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="email" value="<?php echo $_SESSION['email'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Link tải deb mới khi người dùng cập nhật, nên rút gọn tránh lỗi</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="packagenewlink" value="<?php echo $row['newdeblink'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Link profile zalo hoặc facebook của bạn</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="packageprofile" value="<?php echo $row['debcontact'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Mã SHA1 của file dylib</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="packagehash" value="<?php echo $row['debhash'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Thông tin cập nhật, chỉ hiển thị với người chưa cập nhật</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="packageupdatenoti" value="<?php echo $row['debupdatenoti'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row justify-content-end">
                                                    <div class="col-sm-9">
                                                        <button id="submit" type="button" onclick="changeinfo(<?php echo $id ?>)" class="btn btn-primary w-md"><i class="bx bx-save"></i> Update</button>
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
    var baseurl = window.location.protocol + "//" + window.location.host;

    function changeinfo(id) {
        var package_name = $('#packagename').val();
        var package_version = $('#packagever').val();
        var package_sha1 = $('#packagehash').val();
        var package_newlink = $('#packagenewlink').val();
        var package_profile = $('#packageprofile').val();
        var package_changelog = $('#packageupdatenoti').val();

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
            text: `Xác nhận cập nhật gói ?`,
            showCancelButton: true,
            confirmButtonText: "Xác nhận",

        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-package.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'updatepackage',
                        package_name: package_name,
                        package_version: package_version,
                        package_sha1: package_sha1,
                        package_newlink: package_newlink,
                        package_profile: package_profile,
                        package_changelog: package_changelog,
                        package_id: id
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
</body>

</html>