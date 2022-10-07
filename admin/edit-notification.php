<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';

if ($_SESSION['level'] != 1) {
    header('location: pages-404.php');
    exit;
}
$id = $_GET['id'];
$showData = "Select noti_user, noti_detail, noti_level from tblnotification where id = $id";
$result = mysqli_query($conn, $showData);
$rowEditNoti = mysqli_fetch_array($result);
?>

<head>

    <title>Edit notification | APIServer Dashboard</title>
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
                            <h4 class="mb-sm-0 font-size-18">Edit notification</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">List notification</a></li>
                                    <li class="breadcrumb-item active">Edit notification</li>
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
                                                        <input type="text" class="form-control" id="username" value="<?php echo $rowEditNoti['noti_user'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Type</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="notitype">
                                                               <option value='0'>Info</option>
                                                               <option value='1' selected>System</option>
                                                               <option value='2'>Caution</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Detail</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="notidetail" value="<?php echo $rowEditNoti['noti_detail'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row justify-content-end">
                                                    <div class="col-sm-9">
                                                        <button id="submit" type="button" onclick="editnoti(<?php echo $id ?>)" class="btn btn-primary w-md"><i class="bx bx-save"></i> Save</button>
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

    function editnoti(id) {
        var noti_user = $('#username').val();
        var noti_type = $('#notitype').val();
        var noti_detail = $('#notidetail').val();
        
        $.ajax({
            url: baseurl + '/admin/module/ajax-system.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                type: 'edit_noti',
                noti_id : id,
                noti_user: noti_user,
                noti_type: noti_type,
                noti_detail: noti_detail,
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
                        window.location.href = `/admin/admin-list-notifications.php`;
                    }, 1000);
                }
            }
        })
    }
</script>
</body>

</html>