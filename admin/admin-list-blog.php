<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';
if ($_SESSION['level'] != 1) {
    header('location: pages-404.php');
    exit;
}
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

    <title>List Blog | APIServer Dashboard</title>

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
                            <h4 class="mb-sm-0 font-size-18">Danh s??ch b??i ????ng</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                    <li class="breadcrumb-item active">Danh s??ch b??i ????ng</li>
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
                                            <button type="button" onclick="add(<?= $row_acc['postlimit'] - $tongKey ?>)" class="btn btn-light waves-effect waves-light"><i class="bx bx-plus me-1"></i> T???o b??i vi???t</button>
                                            <button type="button" onclick="help()" class="btn btn-light waves-effect waves-light"><i class="bx bx-help-circle me-1"></i> H?????ng d???n</button>
                                        </div>
                                        <p><i class="bx bx-key"></i> L?????ng b??i vi???t c??n l???i c?? th??? ????ng: <?= $row_acc['postlimit'] - $tongKey ?></p>
                                    </div>

                                </div>
                                <!-- end row -->

                                <div class="table-responsive">
                                    <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th style="width: 9px" class="text-center">STT</th>
                                                <th style="width: 9px" class="text-center">Ti??u ?????</th>
                                                <th class="text-center">T??n g??i</th>
                                                <th class="text-center" style="width: 9px">Ng??y ????ng</th>
                                                <th class="text-center">Lo???i</th>
                                                <th data-priority="1" class="text-center">Get Key</th>
                                                <th data-priority="1" class="text-center">B???o tr??</th>
                                                <th class="text-center" style="width: 9px">Edit</th>
                                                <th class="text-center" style="width: 9px">L???ch s??? get</th>
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
                                                            echo "<button onclick='totaltypechangefree(" . $arrS['id'] . ")' class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-money label-icon'></i>??ang b??n</button>";
                                                        } else {
                                                            echo "<button onclick='totaltypechangesell(" . $arrS['id'] . ")' class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-lock-open-alt label-icon'></i> ??ang m??? Free</button>";
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
                                                            echo "<button onclick='statuson(" . $arrS['id'] . ")' class='btn btn-soft-danger btn-sm w-xs waves-effect btn-label waves-light'><i class=' bx bx-block label-icon'></i>??ang b???t</button>";
                                                        } else {
                                                            echo "<button onclick='statusoff(" . $arrS['id'] . ")' class='btn btn-soft-success btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-broadcast label-icon'></i>??ang t???t</button>";
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
                title: 'Th??ng b??o',
                text: 'B??i vi???t ???? ?????y, vui l??ng xo?? ho???c n??ng c???p th??m dung l?????ng !',
                icon: 'error'
            });
        } else {
            location.href = `create-post.php`
        }
    }

    function help() {
        Swal.fire({
            title: 'H?????ng d???n s??? d???ng',
            text: 'B??i ????ng ph???i ?????y ????? c??c th??ng tin c?? nh??n ????? admin ki???m so??t, tr?????ng h???p scam tr??n h??? th???ng s??? b??? kho?? API v?? t???t c??c c??c d???ch v??? li??n quan. Ph????ng th???c thanh to??n n???u b???n kh??ng mua APIMomo ri??ng th?? ph???i t??? li??n h??? user ????? trao ?????i bu??n b??n, sau ???? x??c nh???n l???i t???i b???ng d???ch v???',
            icon: 'info',
            heightAuto: 'true',
            width: '500px'
        });
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

    function del(id) {
        Swal.fire({
            title: 'X??c nh???n',
            icon: 'warning',
            text: `B???n ch???c ch???n mu???n xo?? b??i ????ng c?? id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "X??c nh???n",
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
                    }, 2500);
                }
            },
            error: (data) => {
                Swal.fire("Th??ng b??o", data.msg, "error");
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
            },
            error: (data) => {
                Swal.fire("Th??ng b??o", data.msg, "error");
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
            },
            error: (data) => {
                Swal.fire("Th??ng b??o", data.msg, "error");
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
            },
            error: (data, error) => {
                console.log(data);
            }
        });
    }
</script>

</html>