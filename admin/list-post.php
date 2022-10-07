<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';
$email = $_SESSION['username'];
$showData = "select tblproduct.id, title,postdate, postuser,totaltype, allowgetkey, status , debname from tblproduct
inner join tbldebver on tbldebver.id = tblproduct.debid where postuser = '$email'
 order by tblproduct.id desc";
$result = mysqli_query($conn, $showData);
$arrShow = array();
while ($row = mysqli_fetch_array($result)) {
    $arrShow[] = $row;
}

$nv = "SELECT count(id) as soluong FROM tblproduct where postuser = '$email'";
$resultNV = mysqli_query($conn, $nv);
$rowNV = mysqli_fetch_array($resultNV);
$tongKey = $rowNV['soluong'];

?>

<head>

    <title>List Post | APIServer Dashboard</title>

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
                            <h4 class="mb-sm-0 font-size-18">Danh sách bài đăng</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                    <li class="breadcrumb-item active">Danh sách bài đăng</li>
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
                                            <button type="button" onclick="add(<?= $row_acc['postlimit'] - $tongKey ?>)" class="btn btn-light waves-effect waves-light"><i class="bx bx-plus me-1"></i> Tạo bài viết</button>
                                            <button type="button" onclick="help()" class="btn btn-light waves-effect waves-light"><i class="bx bx-help-circle me-1"></i> Hướng dẫn</button>
                                        </div>
                                        <p><i class="bx bx-key"></i> Lượng bài viết còn lại có thể đăng: <?= $row_acc['postlimit'] - $tongKey ?></p>
                                    </div>

                                </div>
                                <!-- end row -->

                                <div class="table-responsive">
                                    <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th style="width: 9px" class="text-center">STT</th>
                                                <th style="width: 9px" class="text-center">Tiêu đề</th>
                                                <th class="text-center">Tên gói</th>
                                                <th class="text-center" style="width: 9px">Ngày đăng</th>
                                                <th class="text-center">Loại</th>
                                                <th data-priority="1" class="text-center">Get Key</th>
                                                <th data-priority="1" class="text-center">Bảo trì</th>
                                                <th class="text-center" style="width: 9px">Edit</th>
                                                <th class="text-center" style="width: 9px">Lịch sử get</th>
                                                <th class="text-center" style="width: 9px">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            foreach ($arrShow as $arrS) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $arrS['title']; ?></td>
                                                    <td><?php echo $arrS['debname']; ?></td>

                                                    <td><?php echo $arrS['postdate']; ?></td>
                                                    <td class="text-center">
                                                        <?php if ($arrS['totaltype'] == 1) {
                                                            echo "<button onclick='totaltypechangefree(" . $arrS['id'] . ")' class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-money label-icon'></i>Đang bán</button>";
                                                        } else {
                                                            echo "<button onclick='totaltypechangesell(" . $arrS['id'] . ")' class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-lock-open-alt label-icon'></i> Đang mở Free</button>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($arrS['allowgetkey'] == true) {
                                                            echo "<button onclick='allowgetoff(" . $arrS['id'] . ")' class='btn btn-soft-success btn-sm w-xs waves-effect btn-label waves-light'><i class='fas fa-toggle-on label-icon'></i>ON</button>";
                                                        } else {
                                                            echo "<button onclick='allowgeton(" . $arrS['id'] . ")' class='btn btn-soft-danger btn-sm w-xs waves-effect btn-label waves-light'><i class='fas fa-toggle-off label-icon'></i>OFF</button>";
                                                        }
                                                        ?>

                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($arrS['status'] == false) {
                                                            echo "<button onclick='statuson(" . $arrS['id'] . ")' class='btn btn-soft-danger btn-sm w-xs waves-effect btn-label waves-light'><i class=' bx bx-block label-icon'></i>Đang bật</button>";
                                                        } else {
                                                            echo "<button onclick='statusoff(" . $arrS['id'] . ")' class='btn btn-soft-success btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-broadcast label-icon'></i>Đang tắt</button>";
                                                        }
                                                        ?>

                                                    </td>

                                                    <td class="text-center">
                                                        <?php
                                                        echo "<button onclick='edit(" . $arrS['id'] . ")' class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-edit label-icon'></i> Edit</button>";
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo "<button onclick='datepick(" . $arrS['id'] . ")' class='btn btn-soft-primary btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-calendar-plus label-icon'></i> History</button>";
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo "<button onclick='del(" . $arrS['id'] . ")' class='btn btn-soft-danger btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-trash label-icon'></i> Delete</button>";
                                                        ?>
                                                    </td>
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
<script src="/assets/js/pages/list-key.init.js"></script>

<script src="/assets/js/app.js"></script>
</body>
<script>
    function edit(id) {
        location.href = `edit-post.php?id=${id}`
    }

    function add(soluong) {
        if (soluong == 0) {
            Swal.fire({
                title: 'Thông báo',
                text: 'Bài viết đã đầy, vui lòng xoá hoặc nâng cấp thêm dung lượng !',
                icon: 'error'
            });
        } else {
            location.href = `create-post.php`
        }
    }

    function help() {
        Swal.fire({
            title: 'Hướng dẫn sử dụng',
            text: 'Bài đăng phải đầy đủ các thông tin cá nhân để admin kiểm soát, trường hợp scam trên hệ thống sẽ bị khoá API và tất các các dịch vụ liên quan. Phương thức thanh toán nếu bạn không mua APIMomo riêng thì phải tự liên hệ user để trao đổi buôn bán, sau đó xác nhận lại tại bảng dịch vụ',
            icon: 'info',
            heightAuto: 'true',
            width: '500px'
        });
    }

    function showudid(id) {
        Swal.fire({
            title: 'Xác nhận',
            icon: 'warning',
            text: `Bạn chắc chắn muốn lấy udid thiết bị có id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "Xác nhận",
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-device.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'getudid',
                        device_id: id
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

                            Swal.fire({
                                title: "Kết quả trả về",
                                text: `${data.msg}`,
                                icon: "success",
                                showCancelButton: true,
                                confirmButtonText: "Copy",
                                cancelButtonText: "Close"
                            }).then(function(result) {
                                if (result.value) {
                                    copyToClipboard(data.msg);
                                }
                            });

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
            text: `Bạn chắc chắn muốn xoá bài đăng có id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "Xác nhận",
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-post.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'delpost',
                        post_id: id
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

    function statusoff(id) {


        $.ajax({
            url: baseurl + '/admin/module/ajax-post.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                type: 'status_off',
                post_id: id
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
                    }, 2500);
                }
            },
            error: (data) => {
                Swal.fire("Thông báo", data.msg, "error");
            }
        });
    }

    function statuson(id) {
        $.ajax({
            url: baseurl + '/admin/module/ajax-post.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                type: 'status_on',
                post_id: id
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
                    }, 2500);
                }
            },
            error: (data) => {
                console.log(data);
            }
        });
    }



    function totaltypechangesell(id) {

        $.ajax({
            url: baseurl + '/admin/module/ajax-post.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                type: 'changetype1',
                post_id: id
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
            },
            error: (data) => {
                Swal.fire("Thông báo", data.msg, "error");
            }
        });
    }


    function totaltypechangefree(id) {
        $.ajax({
            url: baseurl + '/admin/module/ajax-post.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                type: 'changetype0',
                post_id: id
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
            },
            error: (data, error) => {
                console.log(data);
            }
        });
    }


    function allowgeton(id) {


        $.ajax({
            url: baseurl + '/admin/module/ajax-post.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                type: 'enablegetkey',
                post_id: id
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
            },
            error: (data) => {
                Swal.fire("Thông báo", data.msg, "error");
            }
        });
    }

    function allowgetoff(id) {
        $.ajax({
            url: baseurl + '/admin/module/ajax-post.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                type: 'disablegetkey',
                post_id: id
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
            },
            error: (data, error) => {
                console.log(data);
            }
        });
    }
</script>

</html>