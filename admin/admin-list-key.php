<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';
$email = $_SESSION['email'];
$showData = "SELECT id, uuid, date, keytype, devicekey, keystatus, datecount, email FROM tbldebkey ORDER BY id ASC";
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

    <title>List Key | APIServer Dashboard</title>

    <?php include 'layouts/head.php'; ?>

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
        <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <span style="font-size: 18px;">Tạo key tĩnh</span>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Số lượng:</label>
                                <input type="number" min="1" max="<?php echo $row_acc['keylimit'] - $tongKey ?>" class="form-control" id="soluong">
                            </div>
                            <div class="form-group">
                                <label>Loại key: </label>
                                <select class="form-control" id="keytype">
                                    <option value="0">Admin</option>
                                    <option value="4" selected>Normal</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Thời hạn: </label>
                                <input type="date" class="form-control" placeholder="Thời gian sử dụng" id="date">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy bỏ</button>
                            <button type="button" class="btn btn-primary" onclick="createkey(<?php echo $tongKey ?>)">Tạo key</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalkey" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <span style="font-size: 18px;">Tạo key động</span>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Số lượng:</label>
                                <input type="number" min="1" max="<?php echo $row_acc['keylimit'] - $tongKey ?>" class="form-control" id="soluong2">
                            </div>
                            <div class="form-group">
                                <label>Loại key: </label>
                                <select class="form-control" id="keytype2">
                                    <option value="0">Admin</option>
                                    <option value="4" selected>Normal</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Số ngày: </label>
                                <input type="number" min="1" class="form-control" id="datecount">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy bỏ</button>
                            <button type="button" class="btn btn-primary" onclick="createkey2(<?php echo $tongKey ?>)">Tạo key</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                                            <button type="button" data-bs-toggle='modal' data-bs-target='#exampleModal' class="btn btn-light waves-effect waves-light"><i class="bx bx-plus me-1"></i> Tạo key tĩnh</button>
                                            <div class="btn-group">
                                                <button type="button" data-bs-toggle='modal' data-bs-target='#modalkey' class="btn btn-primary"><i class="bx bx-plus me-1"></i> Tạo key động</button>
                                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" onclick="genkeyday(<?php echo $tongKey ?>)" href="#">Key ngày</a>
                                                    <a class="dropdown-item" onclick="genkeyweek(<?php echo $tongKey ?>)" href="#">Key tuần</a>
                                                    <a class="dropdown-item" onclick="genkeymonth(<?php echo $tongKey ?>)" href="#">Key tháng</a>
                                                    <a class="dropdown-item" onclick="genkeyyear(<?php echo $tongKey ?>)" href="#">Key năm</a>
                                                    <div class="dropdown-divider"></div>
                                                    <button class="dropdown-item" data-bs-toggle='modal' data-bs-target='#modalkey'>Tuỳ chọn</button>
                                                </div>
                                            </div><!-- /btn-group -->
                                        </div>
                                        <p><i class="bx bx-key"></i> Lượng key còn lại: <?=$row_acc['keylimit'] - $tongKey ?></p>
                                    </div>

                                </div>
                                <!-- end row -->

                                <div class="table-responsive">
                                    <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th style="width: 9px" class="text-center">STT</th>
                                                <th style="width: 9px" class="text-center">ID</th>
                                                <th>Email</th>
                                                <th data-priority="1" class="text-center">Key type</th>
                                                <th data-priority="1" class="text-center">Key</th>
                                                <th data-priority="1" class="text-center">Expiration date</th>
                                                <th data-priority="1" class="text-center">Status</th>
                                                <th data-priority="1" class="text-center" style="width: 9px">Reset</th>
                                                <th data-priority="1" class="text-center" style="width: 9px">Edit</th>
                                                <th data-priority="1" class="text-center" style="width: 9px">Date</th>
                                                <th data-priority="1" class="text-center" style="width: 9px">Del</th>      
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            foreach ($arrShow as $arrS) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $arrS['id']; ?></td>
                                                    <td><?php echo $arrS['email']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($arrS['keytype'] == 0) {
                                                            echo "Admin Key";
                                                        }
                                                        if ($arrS['keytype'] == 1) {
                                                            echo "Refund Key";
                                                        }
                                                        if ($arrS['keytype'] == 4) {
                                                            echo "Normal Key";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $arrS['devicekey']; ?></td>
                                                    <td class="text-center"><?php
                                                                            if ($arrS['datecount'] == 0) {
                                                                                echo date("d/m/Y H:i", strtotime($arrS['date'])); 
                                                                            } else {
                                                                                echo $arrS['datecount'] . " day";
                                                                            }
                                                                            ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $today = date("Y-m-d");
                                                        if ($arrS['keytype'] != 1 && $arrS['keystatus'] == 1 && strtotime($today) < strtotime($arrS['date'])) {
                                                            echo '<span class="badge rounded-pill bg-success"> Approved </span>';
                                                        } else if ($arrS['keytype'] == 1) {
                                                            echo '<span class="badge rounded-pill bg-danger"> Denied </span>';
                                                        } else if (strtotime($today) >= strtotime($arrS['date']) && $arrS['datecount'] == 0) {
                                                            echo '<span class="badge rounded-pill bg-danger"> Expires </span>';
                                                        } else {
                                                            echo '<span class="badge rounded-pill bg-warning"> Pending </span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        echo "<button onclick='lock(" . $arrS['id'] . ")' class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-reset label-icon'></i> Reset</button>";
                                                        ?>

                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        echo "<button onclick='edit(" . $arrS['id'] . ")' class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-edit label-icon'></i> Edit</button>";
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo "<button onclick='datepick(" . $arrS['id'] . ")' class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-calendar-plus label-icon'></i> Update date</button>";
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo "<button onclick='del(" . $arrS['id'] . ")' class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-trash label-icon'></i> Delete</button>";
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

    const keylimit = <?php echo $row_acc['keylimit'] ?>;

    function edit(id) {
        location.href=`edit-deviceinfo.php?id=${id}`
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
            text: `Bạn chắc chắn muốn xoá key có id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "Xác nhận",
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-key.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'delkey',
                        key_id: id
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

    function createkey(soluong) {
        var quantity = $('#soluong').val();
        var keytype = $('#keytype').val();
        var dateexp = $('#date').val();

        if (soluong < keylimit) {
            if (quantity > keylimit - soluong) {
                Swal.fire("Thông báo", `Số lượng key bạn vừa nhập đã chạm tới giới hạn !`, "error");
                return;
            }
            if (!dateexp) {
                Swal.fire("Thông báo", `Vui lòng chọn thời hạn !`, "error");
                return;
            }
            var today2 = new Date();
            const yyyy = today2.getFullYear();
            let mm = today2.getMonth() + 1; // Months start at 0!
            let dd = today2.getDate();
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;
            var today2 = yyyy + '-' + mm + '-' + dd;
            if (new Date(dateexp) <= new Date(today2)) {
                Swal.fire("Thông báo", `Thời hạn phải lớn hơn 1 ngày !`, "error");
                return;
            }
            $.ajax({
                url: baseurl + '/admin/module/ajax-key.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    type: 'createkey',
                    quantity: quantity,
                    keytype: keytype,
                    date: dateexp
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
                        }, 1000);
                    }
                }
            })


        } else {
            $('#exampleModal').modal('hide');
            Swal.fire("Thông báo", `Số lượng key hiện tại của bạn đã đến giới hạn !`, "error");
        }
    }

    function createkey2(soluong) {
        var quantity = $('#soluong2').val();
        var keytype = $('#keytype2').val();
        var dateexp = $('#datecount').val();

        if (soluong < keylimit) {
            if (quantity > keylimit - soluong) {
                Swal.fire("Thông báo", `Số lượng key bạn vừa nhập đã chạm tới giới hạn !`, "error");
                return;
            }
            if (!dateexp) {
                Swal.fire("Thông báo", `Vui lòng chọn thời hạn !`, "error");
                return;
            }
            $.ajax({
                url: baseurl + '/admin/module/ajax-key.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    type: 'createkey2',
                    quantity: quantity,
                    keytype: keytype,
                    date: dateexp
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
                        }, 2000);
                    }
                }
            })


        } else {
            $('#modalkey').modal('hide');
            Swal.fire("Thông báo", `Số lượng key hiện tại của bạn đã đến giới hạn, vui lòng nâng cấp hoặc !`, "error");
        }
    }


    function lock(id) {
        Swal.fire({
            title: 'Xác nhận',
            icon: 'warning',
            text: `Bạn chắc chắn muốn reset key có id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "Xác nhận",

        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-key.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'resetkey',
                        key_id: id
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

    function datepick(id) {
        let flatpickrInstance

        Swal.fire({
            title: 'Cập nhật thời hạn',
            icon: 'info',
            html: '<input class="swal2-input" id="expiry-date">',
            stopKeydownPropagation: false,
            preConfirm: () => {
                if (flatpickrInstance.selectedDates[0] <= new Date()) {
                    Swal.showValidationMessage(`Thời gian bạn chọn đã trôi qua`);
                } else {
                    $.ajax({
                        url: baseurl + '/admin/module/ajax-key.php',
                        type: 'POST',
                        dataType: 'JSON',

                        data: {
                            type: 'changedate',
                            key_id: id,
                            key_date: formatDate(flatpickrInstance.selectedDates[0])
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
            },
            willOpen: () => {
                flatpickrInstance = flatpickr(
                    Swal.getPopup().querySelector('#expiry-date'),{
                        enableTime: true,
                        time_24hr: true,
                        minDate: "today"
                    });
            }
        })
    }



    function genkeyday(soluong) {
        if (soluong < keylimit) {
            Swal.fire({
                title: 'Tạo key ngày',
                icon: 'question',
                input: 'range',
                showCancelButton: true,
                confirmButtonText: "Xác nhận",
                inputLabel: 'Chọn số lượng key ngày bạn muốn tạo',
                inputAttributes: {
                    min: 1,
                    max: keylimit - soluong,
                    step: 1
                },
                inputValue: 1
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: baseurl + '/admin/module/ajax-key.php',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            type: 'genkey',
                            datekey: 1,
                            quantity: result.value
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
        } else {
            Swal.fire("Thông báo", `Số lượng key hiện tại của bạn đã đến giới hạn !`, "error");
        }
    }

    function genkeyweek(soluong) {
        if (soluong < keylimit) {
            Swal.fire({
                title: 'Tạo key tuần',
                icon: 'question',
                input: 'range',
                showCancelButton: true,
                confirmButtonText: "Xác nhận",
                inputLabel: 'Chọn số lượng key tuần bạn muốn tạo',
                inputAttributes: {
                    min: 1,
                    max: keylimit - soluong,
                    step: 1
                },
                inputValue: 1
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: baseurl + '/admin/module/ajax-key.php',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            type: 'genkey',
                            datekey: 7,
                            quantity: result.value
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
        } else {
            Swal.fire("Thông báo", `Số lượng key hiện tại của bạn đã đến giới hạn !`, "error");
        }
    }

    function genkeymonth(soluong) {
        if (soluong < keylimit) {
            Swal.fire({
                title: 'Tạo key tháng',
                icon: 'question',
                input: 'range',
                showCancelButton: true,
                confirmButtonText: "Xác nhận",
                inputLabel: 'Chọn số lượng key tháng bạn muốn tạo',
                inputAttributes: {
                    min: 1,
                    max: keylimit - soluong,
                    step: 1
                },
                inputValue: 1
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: baseurl + '/admin/module/ajax-key.php',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            type: 'genkey',
                            datekey: 30,
                            quantity: result.value
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
        } else {
            Swal.fire("Thông báo", `Số lượng key hiện tại của bạn đã đến giới hạn !`, "error");
        }
    }

    function genkeyyear(soluong) {
        if (soluong < keylimit) {
            Swal.fire({
                title: 'Tạo key năm',
                icon: 'question',
                input: 'range',
                showCancelButton: true,
                confirmButtonText: "Xác nhận",
                inputLabel: 'Chọn số lượng key năm bạn muốn tạo',
                inputAttributes: {
                    min: 1,
                    max: keylimit - soluong,
                    step: 1
                },
                inputValue: 1
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: baseurl + '/admin/module/ajax-key.php',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            type: 'genkey',
                            datekey: 365,
                            quantity: result.value
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
        } else {
            Swal.fire("Thông báo", `Số lượng key hiện tại của bạn đã đến giới hạn !`, "error");
        }
    }
</script>

</html>