<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';
$email = $_SESSION['email'];
if ($_SESSION['level'] != 1) {
    header('location: pages-404.php');
    exit;
}
$showData = "SELECT id, debstatus,debname, debversion, newdeblink, debupdatenoti, debcontact, debhash, email FROM tbldebver ORDER BY id ASC";
$result = mysqli_query($conn, $showData);
$arrShow = array();
while ($row = mysqli_fetch_array($result)) {
    $arrShow[] = $row;
}

$nv = "SELECT count(id) as soluong FROM tbldebver where email = '$email'";
$resultNV = mysqli_query($conn, $nv);
$rowNV = mysqli_fetch_array($resultNV);
$tongDeb = $rowNV['soluong'];

?>

<head>

    <title>List Package | APIServer Dashboard</title>

    <?php include 'layouts/head.php'; ?>

    <!-- flatpickr css -->
    <link href="/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables -->
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
                            <h4 class="mb-sm-0 font-size-18">Device List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                    <li class="breadcrumb-item active">Danh sách thiết bị</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="mb-4">
                                            <a href="create-package.php"><button type="button" class="btn btn-light waves-effect waves-light"><i class="bx bx-plus me-1"></i> Trình tạo package</button></a>
                                            <a href="https://github.com/baontq23/Logos-API-Authentication" target="_blank"><button type="button" class="btn btn-light waves-effect waves-light"><i class="bx bxl-github me-1"></i> Cập nhật API</button></a>
                                            <button type="button" onclick="help()" class="btn btn-light waves-effect waves-light"><i class="bx bx-help-circle me-1"></i> Hướng dẫn</button>
                                            <a href="https://youtu.be/BNMgdwZNJcU" target="_blank"><button type="button" class="btn btn-light waves-effect waves-light"><i class="bx bxl-youtube me-1"></i> Hướng dẫn bằng video</button></a>
                                        </div>
                                        <p>Phiên bản hiện tại: 1.0</p>
                                    </div>

                                </div>
                                <!-- end row -->

                                <div class="table-responsive">
                                    <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th style="width: 9px" class="text-center">ID</th>
                                                <th data-priority="1" class="text-center" style="width: 10px">Package name</th>
                                                <th class="text-center">Package version</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Mã SHA1 của dylib</th>
                                                <th class="text-center">Link package</th>
                                                <th data-priority="1" class="text-center" style="width: 9px">Status</th>
                                                <th data-priority="1" class="text-center" style="width: 9px">Bảo trì</th>
                                                <th data-priority="1" class="text-center" style="width: 9px">More</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($arrShow as $arrS) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $arrS['id']; ?></td>
                                                    <td><?php echo $arrS['debname']; ?></td>
                                                    <td class="text-center"><?php echo $arrS['debversion']; ?></td>
                                                    <td class="text-center"><?php echo $arrS['email']; ?></td>
                                                    <td class="text-center"><?php echo $arrS['debhash']; ?></td>
                                                    <td style="width: 20px"><?php echo $arrS['newdeblink']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($arrS['debstatus'] == 1) {
                                                            echo '<span class="badge rounded-pill bg-success"> Activity </span>';
                                                        } else if ($arrS['debstatus'] == 2) {

                                                            echo '<span class="badge rounded-pill bg-warning"> Maintenance </span>';
                                                        } else {

                                                            echo '<span class="badge rounded-pill bg-danger"> Maintenance Request </span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($arrS['debstatus'] == 2) {
                                                            echo "<button onclick='unlock(" . $arrS['id'] . ")' class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-lock-open label-icon'></i> Unlock</button>";
                                                        } else {
                                                            echo "<button onclick='lock(" . $arrS['id'] . ")' class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-lock label-icon'></i> Lock</button>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <div class='dropdown'>
                                                            <button class='btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                                <i class='bx bx-dots-horizontal-rounded'></i>
                                                            </button>
                                                            <ul class='dropdown-menu dropdown-menu-end'>
                                                                <li><a class='dropdown-item' href='edit-packageinfo.php?id=<?php echo $arrS['id'] ?>'>Edit</a></li>
                                                                <li><button class='dropdown-item' onclick="changesha1(<?php echo $arrS['id'] ?>)">Change SHA1</button></li>
                                                                <li><button class='dropdown-item' onclick="del(<?php echo $arrS['id'] ?>)">Delete</button></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php

                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table responsive -->
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

<!-- flatpickr js -->
<script src="/assets/libs/flatpickr/flatpickr.min.js"></script>

<!-- Required datatable js -->
<script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- init js -->
<script src="/assets/js/pages/list-deb.init.js"></script>

<script src="/assets/js/app.js"></script>
</body>
<script>

    function help() {
        Swal.fire({
            title: 'Hướng dẫn sử dụng',
            text: 'Tại mục này, thông tin như id và debversion phải trùng ở phía deb khi bạn make. Link contact là đường link khi user chưa kích hoạt bấm vào, link deb update là khi user họ dùng deb cũ thì sẽ hiển thị nút bấm chứa link bạn set. Lưu ý là khi ở trạng thái bảo trì thì user bấm vào sẽ văng game và không chứa link gì cả. Mã SHA1 phải chuẩn để chống crack, nhập sai sẽ báo deb không tồn tại',
            icon: 'info',
            heightAuto: 'true',
            width: '500px'
        });
    }

    function del(id) {
        Swal.fire({
            title: 'Xác nhận',
            icon: 'warning',
            text: `Bạn chắc chắn muốn xoá package có id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "Xác nhận",
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-package.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'delpackage',
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
                                location.reload();
                            }, 1500);
                        }
                    }
                });
            }
        });
    }

    function lock(id) {
        Swal.fire({
            title: 'Xác nhận',
            icon: 'warning',
            text: `Xác nhận vào trạng thái bảo trì cho package có id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "Xác nhận",

        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-package.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'lockpackage',
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
                                location.reload();
                            }, 1500);
                        }
                    }
                });
            }
        });
    }

    function unlock(id) {
        Swal.fire({
            title: 'Xác nhận',
            icon: 'warning',
            text: `Xác nhận vào trạng thái hoạt động cho package có id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "Xác nhận",

        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-package.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'unlockpackage',
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
                                location.reload();
                            }, 1500);
                        }
                    }
                });
            }
        });
    }

    function changesha1(id) {
        
        Swal.fire({
            title: 'Cập nhật SHA1',
            text: 'Điền đúng mã để tránh không kết nối được với server',
            icon: 'info',
            input: 'text',
            showCancelButton: true,
            confirmButtonText: "Xác nhận",
            preConfirm: (result) => {
                if (!result) {
                    Swal.showValidationMessage(`Không được bỏ trống trường này`);
                } else {
                    $.ajax({
                        url: baseurl + '/admin/module/ajax-package.php',
                        type: 'POST',
                        dataType: 'JSON',

                        data: {
                            type: 'changesha1',
                            package_id: id,
                            package_sha1: result
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
                                    location.reload();
                                }, 1500);
                            }
                        }
                    });
                }
            }
        })
    }

</script>

</html>