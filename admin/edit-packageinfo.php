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
                                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> M???t s??? th??ng tin khi b??? tr???ng s??? ??i???n gi?? tr??? m???c ?????nh</h5>

                                            <form>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">T??n package</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="<?php echo $row['debname'] ?>" class="form-control" id="packagename">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="email" class="col-sm-3 col-form-label">Phi??n b???n</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="<?php echo $row['debversion'] ?>" class="form-control" id="packagever">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Email li??n k???t</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="email" value="<?php echo $_SESSION['email'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Link t???i deb m???i khi ng?????i d??ng c???p nh???t, n??n r??t g???n tr??nh l???i</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="packagenewlink" value="<?php echo $row['newdeblink'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Link profile zalo ho???c facebook c???a b???n</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="packageprofile" value="<?php echo $row['debcontact'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">M?? SHA1 c???a file dylib</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="packagehash" value="<?php echo $row['debhash'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Th??ng tin c???p nh???t, ch??? hi???n th??? v???i ng?????i ch??a c???p nh???t</label>
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
                'Th??ng b??o',
                'B???n ch??a nh???p t??n g??i',
                'info'
            )
            return;
        }

        if (!package_version) {
            Swal.fire(
                'Th??ng b??o',
                'B???n ch??a nh???p phi??n b???n',
                'info'
            )
            return;
        }

        if (!package_sha1) {
            Swal.fire(
                'Th??ng b??o',
                'B???n ch??a nh???p sha1 c???a dylib',
                'info'
            )
            return;
        }

        if (!package_profile) {
            Swal.fire(
                'Th??ng b??o',
                'B???n ch??a nh???p link profile',
                'info'
            )
            return;
        }
        if (!package_newlink) {
            package_newlink.value = "https://www.google.com/"
        }
        if (!package_changelog) {
            package_changelog.value = "Kh??ng c?? thay ?????i m???i !"
        }

        Swal.fire({
            title: 'X??c nh???n',
            icon: 'warning',
            text: `X??c nh???n c???p nh???t g??i ?`,
            showCancelButton: true,
            confirmButtonText: "X??c nh???n",

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