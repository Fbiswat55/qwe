<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';
$email = $_SESSION['email'];
$showData = "SELECT id, username, uuid, date, keytype, devicekey, keystatus, devicemodel, debversion, datecount, email FROM tbldebkey ORDER BY id ASC";
$result = mysqli_query($conn, $showData);
$arrShow = array();
while ($row = mysqli_fetch_array($result)) {
    $arrShow[] = $row;
}
$nv = "SELECT count(id) as soluong FROM tbldebkey where email = '$email'";
$resultNV = mysqli_query($conn, $nv);
$rowNV = mysqli_fetch_array($resultNV);
$tongKey = $rowNV['soluong'];

$key_av =$row_acc['keylimit'] - $tongKey;
?>

<head>

    <title>List Device | APIServer Dashboard</title>

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
                                            <button type="button" onclick="add(<?=$key_av ?>)" class="btn btn-light waves-effect waves-light"><i class="bx bx-plus me-1"></i> Th??m thi???t b???</button>
                                            <button type="button" onclick="help()" class="btn btn-light waves-effect waves-light"><i class="bx bx-help-circle me-1"></i> H?????ng d???n</button>
                                        </div>
                                    </div>

                                </div>
                                <!-- end row -->

                                <div class="table-responsive">
                                    <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th style="width: 10px;">ID</th>
                                                <th>Username</th>
                                                <th>Key type</th>
                                                <th>Key</th>
                                                <th>Expiration date</th>
                                                <th>Deb version</th>
                                                <!-- <th>UDID</th> -->
                                                <th>Device model</th>
                                                <th>Status</th>
                                                <th style="width: 100px;">Lock/Unlock</th>
                                                <th style="width: 90px;">Action</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            foreach ($arrShow as $arrS) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $arrS['id']; ?></td>
                                                    <td><?php echo $arrS['username']; ?></td>
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
                                                    <td><?php
                                                        if ($arrS['datecount'] == 0) {
                                                            echo date("d/m/Y H:i", strtotime($arrS['date'])); 
                                                        } else {
                                                            echo $arrS['datecount'] . " day";
                                                        }
                                                        ?></td>
                                                    <td><?php echo $arrS['debversion']; ?></td>
                                                    <!-- <td><?php echo $arrS['uuid']; ?></td> -->
                                                    <td><?php echo $arrS['devicemodel']; ?></td>
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
                                                        if ($arrS['keytype'] == 1) {

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
                                                                <li><a class='dropdown-item' href='edit-deviceinfo.php?id=<?php echo $arrS['id'] ?>'>Edit</a></li>
                                                                <li><button class='dropdown-item' onclick="showudid(<?php echo $arrS['id'] ?>)">UDID</button></li>
                                                                <li><button class='dropdown-item' onclick="del(<?php echo $arrS['id'] ?>)">Delete</button></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $arrS['email']; ?></td>
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
<script src="/assets/js/pages/invoices-list.init.js"></script>

<script src="/assets/js/app.js"></script>
</body>
<script>
    var baseurl = window.location.protocol + "//" + window.location.host;

    function help() {
        Swal.fire({
            title: 'H?????ng d???n s??? d???ng',
            text: 'V?? ????y l?? server th??? nghi???m n??n c??n h???n ch???, m???i ng?????i n??n ????ng k?? 1 deb ????? server v???n h??nh m?????t nh???t ?????n c??c m??y, ai request qu?? nhi???u trong th???i gian ng???n s??? b??? kho?? IP. ??? ph??a deb b???t bu???c ph???i ??i???n set email tr??ng v???i email ????ng k?? web',
            icon: 'info',
            heightAuto: 'true',
            width: '500px'
        });
    }
    
     function add(soluong) {
         if(soluong == 0) {
        Swal.fire({
            title: 'Th??ng b??o',
            text: "B???n ???? h???t dung l?????ng d??? li???u, vui l??ng xo?? b???t key ho???c n??ng c???p b??? nh???",
            icon: 'info',
            heightAuto: 'true',
            width: '500px'
        });
        
         }else {
             location.href = "create-device.php";
         }
    }

    function showudid(id) {
        Swal.fire({
            title: 'X??c nh???n',
            icon: 'warning',
            text: `B???n ch???c ch???n mu???n l???y udid thi???t b??? c?? id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "X??c nh???n",
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

                            Swal.fire({
                                title: "K???t qu??? tr??? v???",
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

    function unlock(id) {
        Swal.fire({
            title: 'X??c nh???n',
            icon: 'warning',
            text: `B???n ch???c ch???n mu???n m??? kho?? thi???t b??? c?? id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "X??c nh???n",
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-device.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'unlockdevice',
                        device_id: id
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
            text: `B???n ch???c ch???n mu???n kho?? thi???t b??? c?? id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "X??c nh???n",

        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-device.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'lockdevice',
                        device_id: id
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

    function del(id) {
        Swal.fire({
            title: 'X??c nh???n',
            icon: 'warning',
            text: `B???n ch???c ch???n mu???n xo?? thi???t b??? c?? id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "X??c nh???n",
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-device.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'deldevice',
                        device_id: id
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
</script>

</html>