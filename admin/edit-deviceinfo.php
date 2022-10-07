<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';

$id = $_GET['id'];
$showData = "Select id,username,uuid,date_format(date, '%Y-%m-%d') as date,keytype,devicekey,message,email from tbldebkey where id = $id";
$result = mysqli_query($conn, $showData);
$row = mysqli_fetch_array($result);
if ($_SESSION['email'] != $row['email'] && $_SESSION['level'] != 1) {
    header('location: pages-404.php');
    exit;
}
?>

<head>

    <title>Edit info | APIServer Dashboard</title>
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
                            <h4 class="mb-sm-0 font-size-18">Change device info</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">List key</a></li>
                                    <li class="breadcrumb-item active">Change info</li>
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
                                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Một số thông tin khi bỏ trống sẽ điền giá trị mặc định</h5>

                                            <form>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="<?php echo $row['username'] ?>" class="form-control" id="username">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Loại key</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="keytype">
                                                            <?php
                                                            if ($row['keytype'] == 0) {
                                                                echo "<option value='0' selected>Admin</option>";
                                                                echo "<option value='1'>Block</option>";
                                                                echo "<option value='4'>Normal</option>";
                                                            } else if ($row['keytype'] == 1) {
                                                                echo "<option value='0'>Admin</option>";
                                                                echo "<option value='1' selected>Block</option>";
                                                                echo "<option value='4'>Normal</option>";
                                                            } else {
                                                                echo "<option value='0'>Admin</option>";
                                                                echo "<option value='1'>Block</option>";
                                                                echo "<option value='4' selected>Normal</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Thời hạn</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" id="date" value="<?php echo $row['date'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="email" class="col-sm-3 col-form-label">Key</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="<?php echo $row['devicekey'] ?>" class="form-control" id="key" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">UDID</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="uuid" value="<?php echo $row['uuid'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Thông báo</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="message" value="<?php echo $row['message'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row justify-content-end">
                                                    <div class="col-sm-9">
                                                        <button id="submit" type="button" onclick="changeinfo(<?php echo $id ?>)" class="btn btn-primary w-md"><i class="bx bx-save"></i> Save</button>
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

<!-- flatpickr js -->
<script src="/assets/libs/flatpickr/flatpickr.min.js"></script>

<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="/assets/js/app.js"></script>
<script>
    let flatpickrInstance2 = flatpickr(
        $('#date'), {
            enableTime: true,
            time_24hr: true,
            minDate: "today"
        });

    function changeinfo(id) {
        var device_id = id;
        var device_username = $('#username').val();
        var device_keytype = $('#keytype').val();
        var device_date = formatDate(flatpickrInstance2.selectedDates[0]);
        var device_key = $('#key').val();
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
        if (!device_udid) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa nhập UDID',
                'error'
            )
            return;
        }
        if (!user_message) {
            user_message.value = "Không có thông báo mới !"
        }
        $.ajax({
            url: baseurl + '/admin/module/ajax-device.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                type: 'change_info',
                device_id: device_id,
                device_username: device_username,
                device_keytype: device_keytype,
                device_date: device_date,
                device_key: device_key,
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
                        window.location.href = `/admin/edit-deviceinfo.php?id=${id}`;
                    }, 1000);
                }
            }
        })
    }
</script>
</body>

</html>