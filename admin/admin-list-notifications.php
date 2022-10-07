<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';
$email = $_SESSION['email'];
if ($_SESSION['level'] != 1) {
    header('location: pages-404.php');
    exit;
}
$showData = "SELECT * FROM tblnotification ORDER BY id desc";
$result = mysqli_query($conn, $showData);
$arrShow = array();
while ($row = mysqli_fetch_array($result)) {
    $arrShow[] = $row;
}

?>

<head>

    <title>List Notification | APIServer Dashboard</title>

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
                            <h4 class="mb-sm-0 font-size-18">System Notification</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">List notification</li>
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
                                            <a href="create-notification.php"><button type="button" class="btn btn-light waves-effect waves-light"><i class="bx bx-plus me-1"></i> Thêm thông báo</button></a>
                                        </div>
                                    </div>

                                </div>
                                <!-- end row -->

                                <div class="table-responsive">
                                    <table class="table dtr-inline datatable dt-responsive" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th style="width: 10px;">ID</th>
                                                <th>User</th>
                                                <th>Time</th>
                                                <th>Detail</th>
                                                <th data-priority="1">Type</th>
                                                <th data-priority="1">Edit</th>
                                                <th data-priority="1">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            foreach ($arrShow as $arrS) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $arrS['id']; ?></td>
                                                    <td><?php echo $arrS['noti_user']; ?></td>
                                                    <td><?php echo $arrS['noti_time']; ?></td>
                                                    <td><?php echo $arrS['noti_detail']; ?></td>
                                                    <td>
                                                        <?php
                                                        
                                                        if ($arrS['noti_level'] == 0 ) {

                                                            echo '<span class="badge rounded-pill bg-primary"> Info </span>';
                                                        } else if ($arrS['noti_level'] == 1) {

                                                            echo '<span class="badge rounded-pill bg-secondary"> System </span>';
                                                       } else {

                                                            echo '<span class="badge rounded-pill bg-danger"> Caution </span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                            echo "<a href='edit-notification.php?id=".$arrS['id']."'<button class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-edit label-icon'></i> Edit</button></a>";
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                            echo "<button onclick='del(" . $arrS['id'] . ")' class='btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light'><i class='bx bx-lock label-icon'></i> Delete</button>";
                                                        ?>
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
<script src="/assets/js/pages/list-notification.js"></script>

<script src="/assets/js/app.js"></script>
</body>
<script>

    function del(id) {
        Swal.fire({
            title: 'Xác nhận',
            icon: 'warning',
            text: `Bạn chắc chắn muốn xoá thông báo có id ${id} ?`,
            showCancelButton: true,
            confirmButtonText: "Xác nhận",
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-system.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'delnoti',
                        noti_id: id
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