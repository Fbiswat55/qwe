<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';
if ($_SESSION['level'] != 1) {
    header('location: pages-404.php');
    exit;
}
$showData = "SELECT * FROM tai_khoan WHERE id <> 1 ORDER BY ngay_tao DESC";
$result = mysqli_query($conn, $showData);
$arrShow = array();
while ($row = mysqli_fetch_array($result)) {
    $arrShow[] = $row;
}
$nv = "SELECT count(id) as soluong FROM tbldebkey where email = '$email'";
$resultNV = mysqli_query($conn, $nv);
$rowNV = mysqli_fetch_array($resultNV);
$tongKey = $rowNV['soluong'];
?>

<head>

    <title>List Member | APIServer Dashboard</title>

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
                            <h4 class="mb-sm-0 font-size-18">Member List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                    <li class="breadcrumb-item active">Danh sách người dùng</li>
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
                                            <button type="button" class="btn btn-light waves-effect waves-light"><i class="bx bx-plus me-1"></i> Thêm người dùng</button>
                                        </div>
                                    </div>

                                </div>
                                <!-- end row -->

                                <div class="table-responsive">
                                    <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th style="width: 9px" class="text-center">STT</th>
      
                                    
                                                <th class="text-center">Username</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center"><i class="bx bx-world"></i></th>
                                                <th class="text-center"><i class="bx bx-key"></i></th>
                                                <th class="text-center"><i class="bx bxs-key"></i></th>
                                                <th class="text-center">Permission</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Limit</th>
                                                <th class="text-center">Block</th>
                                                <th class="text-center">Sửa</th>
                                                <th class="text-center">Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            foreach ($arrShow as $arrS) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $arrS['username']; ?></td>
                                                    <td><?php echo $arrS['email']; ?></td>
                                                    <td class="text-center"><?php echo number_format($arrS['truy_cap']); ?></td>
                                                    <td><?php echo $arrS['keylimit']; ?></td>
                                                    <td><?php
                                                        $emailu = $arrS['email'];
                                                        $nv = "SELECT count(id) as soluong FROM tbldebkey where email = '$emailu'";
                                                        $resultNV = mysqli_query($conn, $nv);
                                                        $rowNV = mysqli_fetch_array($resultNV);
                                                        echo $rowNV['soluong']; ?></td>
                                                    
                                                    <th class="text-center">
                                                        <?php
                                                        if ($arrS['quyen'] == 1) {
                                                            echo '<span class="badge rounded-pill bg-danger"> Administrator </span>';
                                                        } else if ($arrS['quyen'] == 2) {
                                                            echo '<span class="badge rounded-pill bg-warning"> Vip member </span>';
                                                        } else {
                                                            echo '<span class="badge rounded-pill bg-primary"> Normal member </span>';
                                                        }
                                                        ?>
                                                    </th>
                                                    <th class="text-center">
                                                        <?php
                                                        if ($arrS['trang_thai'] == 1) {
                                                            echo '<span class="badge rounded-pill bg-success"> Verified </span>';
                                                        } else {
                                                            echo '<span class="badge rounded-pill bg-danger"> Denied </span>';
                                                        }
                                                        ?>
                                                    </th>
                                                    <th class="text-center">
                                                    <button onclick="changelimit(<?php echo $arrS['id'] ?>)" class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-key label-icon'></i> Change</button>                                                 
                                                    </th>
                                                    <th class="text-center">
                                                        <?php
                                                        if ($row_acc['quyen'] == 1) {
                                                            if ($arrS['trang_thai'] == 0) {
                                                                echo "<button onclick='unlock(" . $arrS['id'] . ")' class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-lock-open label-icon'></i> Unlock</button>";
                                                            } else {
                                                                echo "<button onclick='lock(" . $arrS['id'] . ")' class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-lock label-icon'></i> Lock</button>";
                                                            }
                                                        } else {
                                                            echo "<button type='button' class='btn bg-maroon btn-flat' disabled><i class='fa fa-lock'></i></button>";
                                                        }
                                                        ?>
                                                    </th>
                                                    <th class="text-center">
                                                        <?php
                                                        if ($row_acc['quyen'] == 1) {
                                                            echo "<button onclick='edit(" . $arrS['id'] . ")' class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-edit label-icon'></i> Edit</button>";
                                                        } else {
                                                            echo "<button type='button' class='btn bg-orange btn-flat' disabled><i class='fa fa-edit'></i></button>";
                                                        }
                                                        ?>

                                                    </th>
                                                    <th class="text-center">
                                                        <?php
                                                        if ($row_acc['quyen'] == 1) {
                                                            echo "<button onclick='del(" . $arrS['id'] . ")' class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-trash label-icon'></i> Delete</button>";
                                                        } else {
                                                            echo "<button type='button' class='btn bg-maroon btn-flat' disabled><i class='fa fa-trash'></i></button>";
                                                        }
                                                        ?>
                                                    </th>
                                                </tr>
                                            <?php
                                                $count++;
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
<script src="/assets/js/pages/invoices-list.init.js"></script>

<script src="/assets/js/app.js"></script>
</body>
<script>

    function edit(id) {
        location.href=`edit-memberinfo.php?id=${id}`
    }
    function changelimit(id) {
        
        Swal.fire({
            title: 'Cập nhật giới hạn',
            text: 'Nhập giới hạn key của member ?',
            icon: 'info',
            input: 'text',
            showCancelButton: true,
            confirmButtonText: "Xác nhận",
            preConfirm: (result) => {
                if (!result) {
                    Swal.showValidationMessage(`Không được bỏ trống trường này`);
                } else {
                    $.ajax({
                        url: baseurl + '/admin/module/ajax-member.php',
                        type: 'POST',
                        dataType: 'JSON',

                        data: {
                            type: 'changelimitkey',
                            user_id: id,
                            quantity: result
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

    function unlock(id) {
        Swal.fire({
            title: 'Xác nhận',
            icon: 'warning',
            text: `Bạn chắc chắn muốn mở khoá member có id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "Xác nhận",
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-member.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'unlockuser',
                        user_id: id
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
            text: `Bạn chắc chắn muốn khoá memebr có id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "Xác nhận",

        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-member.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'lockuser',
                        user_id: id
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

    function del(id) {
        Swal.fire({
            title: 'Xác nhận',
            icon: 'warning',
            text: `Bạn chắc chắn muốn xoá member có id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "Xác nhận",
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-member.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'deluser',
                        user_id: id
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
</script>

</html>