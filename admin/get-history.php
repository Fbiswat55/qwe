<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';
$email = $_SESSION['email'];
$showData = "select tbldebkey.id,keytype,date,username,usernameget,tbldebkey.email, datecount,keystatus, debname, gettype, gettime, debid,getip, tbldebkey.devicekey from tblhistorykey
inner join tbldebkey on tblhistorykey.devicekey = tbldebkey.devicekey
inner join tbldebver on tblhistorykey.debid = tbldebver.id where tbldebkey.email = '$email' ORDER BY id ASC";
$result = mysqli_query($conn, $showData);
$arrShow = array();
while ($row = mysqli_fetch_array($result)) {
    $arrShow[] = $row;
}

?>

<head>

    <title>List Key | APIServer Dashboard</title>

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
                            <h4 class="mb-sm-0 font-size-18">Lịch sử user get key của bạn</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                    <li class="breadcrumb-item active">Danh sách key</li>
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
                                            <button type="button" onclick="help()" class="btn btn-light waves-effect waves-light"><i class="bx bx-help-circle me-1"></i> Hướng dẫn</button>
                                        </div>
                                    </div>

                                </div>
                                <!-- end row -->

                                <div class="table-responsive">
                                    <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th style="width: 9px" class="text-center">STT</th>
                                                <th style="width: 9px" class="text-center">ID</th>
                                                <th style="width: 9px" class="text-center">Tên gói</th>
                                                <th class="text-center">Loại key</th>
                                                <th class="text-center">Người nhận key</th>
                                                <th class="text-center">Địa chỉ IP</th>
                                                <th class="text-center">Hình thức</th>
                                                <th class="text-center">Ngày mua</th>
                                                <th data-priority="1" class="text-center">Ngày hết hạn</th>
                                                <th data-priority="1" class="text-center">Trạng thái</th>
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
                                                    <td><?php echo $arrS['debname']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($arrS['keytype'] == 0) {
                                                            echo "Key vip";
                                                        }
                                                        if ($arrS['keytype'] == 1) {
                                                            echo "Thu hồi";
                                                        }
                                                        if ($arrS['keytype'] == 4) {
                                                            echo "Key thường";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $arrS['usernameget']; ?></td>
                                                    <td><?php echo $arrS['getip']; ?></td>
                                                    <td class="text-center"><?php echo $arrS['gettype'] == 0 ? 'Free' : 'Mua';?></td>
                                                    <td class="text-center"><?php echo date("d/m/Y H:i", strtotime($arrS['gettime']));  ?></td>
                                                    <td class="text-center"><?php
                                                                            if ($arrS['datecount'] == 0) {
                                                                                echo date("d/m/Y H:i", strtotime($arrS['date'])); 
                                                                            } else {
                                                                                echo $arrS['datecount'] . " day";
                                                                            }
                                                                            ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        $today = date("Y-m-d");
                                                        if ($arrS['keytype'] != 1 && $arrS['keystatus'] == 1 && strtotime($today) < strtotime($arrS['date'])) {
                                                            echo '<span class="badge rounded-pill bg-success"> Đang sử dụng </span>';
                                                        } else if ($arrS['keytype'] == 1) {
                                                            echo '<span class="badge rounded-pill bg-danger"> Bị khoá </span>';
                                                        } else if (strtotime($today) >= strtotime($arrS['date']) && $arrS['datecount'] == 0) {
                                                            echo '<span class="badge rounded-pill bg-danger"> Hết hạn </span>';
                                                        } else {
                                                            echo '<span class="badge rounded-pill bg-warning"> Đang chờ </span>';
                                                        }
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
        location.href=`edit-deviceinfo.php?id=${id}`
    }
    function help() {
        Swal.fire({
            title: 'Hướng dẫn sử dụng',
            text: 'Key tĩnh là thời hạn sẽ tính ngay khi bạn tạo ra key, key động thời hạn sẽ bắt đầu tính khi người dùng sử dụng để kích hoạt. Nếu có nhu cầu nhiều key hơn, vui lòng liên hệ admin để nâng cấp. \nZalo: 0395250686',
            icon: 'info',
            heightAuto: 'true',
            width: '500px'
        });
    }


</script>

</html>