<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';

$nv = "SELECT count(id) as soluong FROM tbldebkey where email = '$email'";
$resultNV = mysqli_query($conn, $nv);
$rowNV = mysqli_fetch_array($resultNV);
$tongKey = $rowNV['soluong'];

if($row_acc['keylimit'] <= $tongKey) {
    header("location: pages-404.php");
    exit;
}
?>

<head>

    <title>Add device | APIServer Dashboard</title>
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
                            <h4 class="mb-sm-0 font-size-18">Thêm mới thiết bị</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">List device</a></li>
                                    <li class="breadcrumb-item active">Add device</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-lg-0">
                                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Không khuyến khích kích hoạt bằng cách này, nên get key nhập</h5>

                                            <form>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="username">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Loại key</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="keytype">
                                                               <option value='0'>Admin</option>
                                                               <option value='4' selected>Normal</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Thời hạn</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" id="date">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">UDID</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="uuid">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Thông báo</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="message">
                                                    </div>
                                                </div>
                                                <div class="row justify-content-end">
                                                    <div class="col-sm-9">
                                                        <button id="submit" type="button" onclick="addinfo()" class="btn btn-primary w-md"><i class="bx bx-save"></i> Save</button>
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

    function addinfo() {
        var device_username = $('#username').val();
        var device_keytype = $('#keytype').val();
        var device_date = $('#date').val();
        var device_udid = $('#uuid').val();
        var user_message = $('#message').val();
        var user_email = "<?php echo $_SESSION['email'] ?>";
        if (!device_username) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa nhập username',
                'info'
            )
            return;
        }
        if (!device_keytype) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa chọn loại key',
                'info'
            )
            return;
        }
        if (!device_date) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa chọn ngày',
                'error'
            )
            return;
        }
        var today2 = new Date();
            const yyyy = today2.getFullYear();
            let mm = today2.getMonth() + 1; // Months start at 0!
            let dd = today2.getDate();
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;
            var today2 = yyyy + '-' + mm + '-' + dd;
            if (new Date(device_date) <= new Date(today2)) {
                Swal.fire("Thông báo", `Thời hạn phải lớn hơn 1 ngày !`, "error");
                return;
            }
        if (!device_udid) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa nhập UDID',
                'error'
            )
            return;
        }
        $.ajax({
            url: baseurl + '/admin/module/ajax-device.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                type: 'add_device',
                device_username: device_username,
                device_keytype: device_keytype,
                device_date: device_date,
                device_udid: device_udid,
                device_message: user_message,
                user_email: user_email
            },
            beforeSend: function() {
                wait('#submit', false);
            },
            complete: function() {
                wait('#submit', true, 'Saved');
            },
            success: (data) => {
                if (data.error) {
                    Swal.fire(
                        'Thông báo',
                        data.msg,
                        'error'
                    )
                } else {
                    Swal.fire(
                        'Thông báo',
                        data.msg,
                        'success'
                    )
                    setTimeout(function() {
                        window.location.href = `/admin/list-device.php`;
                    }, 1000);
                }
            }
        })
    }
</script>
</body>

</html>