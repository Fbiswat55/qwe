<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';
if ($_SESSION['level'] != 1) {
    header('location: pages-404.php');
    exit;
}
$id = $_GET['id'];
$showRecord = "SELECT * FROM tai_khoan WHERE id = $id";
$rs_showRecord = mysqli_query($conn, $showRecord);
$row = mysqli_fetch_array($rs_showRecord);
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
                            <h4 class="mb-sm-0 font-size-18">Change member info</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">List member</a></li>
                                    <li class="breadcrumb-item active">Change info</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-14">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="mt-4 mt-lg-0">
                                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Một số thông tin khi bỏ trống sẽ điền giá trị mặc định</h5>

                                            <form>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="<?php echo $row['username'] ?>" class="form-control" id="memberusername">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="<?php echo $row['email'] ?>" class="form-control" id="memberemail">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Token</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="membertoken" value="<?php echo $row['token'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-3 col-form-label">Lượng key giới hạn</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="memberlimit" value="<?php echo $row['keylimit'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-sm-3 col-form-label">Quyền</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" id="role">
                                                            <option value="2">Vip member</option>
                                                            <option value="0">Normal member</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-end">
                                                    <div class="col-sm-9">
                                                        <button id="submit" type="button" onclick="changeinfo(<?php echo $id ?>)" class="btn btn-primary w-md"><i class="bx bx-save"></i> Update</button>
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

    function changeinfo(id) {
        var member_username = $('#memberusername').val();
        var member_email = $('#memberemail').val();
        var member_token = $('#membertoken').val();
        var member_limit = $('#memberlimit').val();
        var member_role = document.querySelector('#role').value;

        if (!member_username) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa nhập username',
                'info'
            )
            return;
        }

        if (!member_email) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa nhập email',
                'info'
            )
            return;
        }

        if (!member_token) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa nhập token',
                'info'
            )
            return;
        }

        if (!member_limit) {
            Swal.fire(
                'Thông báo',
                'Bạn chưa nhập giới hạn',
                'info'
            )
            return;
        }     

        Swal.fire({
            title: 'Xác nhận',
            icon: 'warning',
            text: `Xác nhận cập nhật member ?`,
            showCancelButton: true,
            confirmButtonText: "Xác nhận",

        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-member.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'updatemember',
                        member_username: member_username,
                        member_email: member_email,
                        member_token: member_token,
                        member_limit: member_limit,
                        member_role: member_role,
                        member_id: id
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
</body>

</html>