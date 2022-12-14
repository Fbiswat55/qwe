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
                                    <li class="breadcrumb-item active">Danh s??ch thi???t b???</li>
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
                                            <a href="create-package.php"><button type="button" class="btn btn-light waves-effect waves-light"><i class="bx bx-plus me-1"></i> Tr??nh t???o package</button></a>
                                            <a href="https://github.com/baontq23/Logos-API-Authentication" target="_blank"><button type="button" class="btn btn-light waves-effect waves-light"><i class="bx bxl-github me-1"></i> C???p nh???t API</button></a>
                                            <button type="button" onclick="help()" class="btn btn-light waves-effect waves-light"><i class="bx bx-help-circle me-1"></i> H?????ng d???n</button>
                                            <a href="https://youtu.be/BNMgdwZNJcU" target="_blank"><button type="button" class="btn btn-light waves-effect waves-light"><i class="bx bxl-youtube me-1"></i> H?????ng d???n b???ng video</button></a>
                                        </div>
                                        <p>Phi??n b???n hi???n t???i: 1.0</p>
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
                                                <th class="text-center">M?? SHA1 c???a dylib</th>
                                                <th class="text-center">Link package</th>
                                                <th data-priority="1" class="text-center" style="width: 9px">Status</th>
                                                <th data-priority="1" class="text-center" style="width: 9px">B???o tr??</th>
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
            title: 'H?????ng d???n s??? d???ng',
            text: 'T???i m???c n??y, th??ng tin nh?? id v?? debversion ph???i tr??ng ??? ph??a deb khi b???n make. Link contact l?? ???????ng link khi user ch??a k??ch ho???t b???m v??o, link deb update l?? khi user h??? d??ng deb c?? th?? s??? hi???n th??? n??t b???m ch???a link b???n set. L??u ?? l?? khi ??? tr???ng th??i b???o tr?? th?? user b???m v??o s??? v??ng game v?? kh??ng ch???a link g?? c???. M?? SHA1 ph???i chu???n ????? ch???ng crack, nh???p sai s??? b??o deb kh??ng t???n t???i',
            icon: 'info',
            heightAuto: 'true',
            width: '500px'
        });
    }

    function del(id) {
        Swal.fire({
            title: 'X??c nh???n',
            icon: 'warning',
            text: `B???n ch???c ch???n mu???n xo?? package c?? id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "X??c nh???n",
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
            title: 'X??c nh???n',
            icon: 'warning',
            text: `X??c nh???n v??o tr???ng th??i b???o tr?? cho package c?? id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "X??c nh???n",

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
            title: 'X??c nh???n',
            icon: 'warning',
            text: `X??c nh???n v??o tr???ng th??i ho???t ?????ng cho package c?? id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "X??c nh???n",

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
            title: 'C???p nh???t SHA1',
            text: '??i???n ????ng m?? ????? tr??nh kh??ng k???t n???i ???????c v???i server',
            icon: 'info',
            input: 'text',
            showCancelButton: true,
            confirmButtonText: "X??c nh???n",
            preConfirm: (result) => {
                if (!result) {
                    Swal.showValidationMessage(`Kh??ng ???????c b??? tr???ng tr?????ng n??y`);
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