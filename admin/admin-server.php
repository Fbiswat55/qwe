<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';
if ($_SESSION['level'] != 1) {
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
                            <h4 class="mb-sm-0 font-size-18">Change package info</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">List package</a></li>
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
                                    <div class="col-lg-12">
                                        <div class="mt-4 mt-lg-0">
                                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Một số thông tin khi bỏ trống sẽ điền giá trị mặc định</h5>

                                            <form>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-4 col-form-label">Thông báo tổng</label>
                                                    <div class="col-sm-9">
                                                        
                                                        <textarea name="content" id="editor"><?=$settings_noti ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-4 col-form-label">Cấu hình email</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="mailserver" value="<?=$gmailid ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-4 col-form-label">Password</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="passmail" value="<?=$gmailpassword ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="username" class="col-sm-4 col-form-label">Username email</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="usnmail" value="<?=$gmailusername ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="email" class="col-sm-4 col-form-label">Trạng thái server</label>
                                                    <div class="col-sm-9">
                                                        <input type="checkbox" id="switch1" switch="none" <?php if ($settings_status == true) echo 'checked' ?> />
                                                        <label for="switch1" data-on-label="ON" data-off-label="OFF"></label>
                                                    </div>
                                                </div>

                                                <div class="row justify-content-end">
                                                    <div class="col-sm-9">
                                                        <button id="submit" type="button" class="btn btn-primary w-md"><i class="bx bx-save"></i> Update</button>
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
<script src="/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="/assets/js/app.js"></script>
<script>
   
    
    let editor;

ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( newEditor => {
        editor = newEditor;
    } )
    .catch( error => {
        console.error( error );
    } );


document.querySelector( '#submit' ).addEventListener( 'click', () => {
    var package_sw = document.querySelector('#switch1');
        var package_status;
        if (package_sw.checked) {
            package_status = 1;
        }else {
            package_status = 0;
        }
    const editorData = editor.getData();
    Swal.fire({
            title: 'Xác nhận',
            icon: 'warning',
            text: `Xác nhận cập nhật hệ thống ?`,
            showCancelButton: true,
            confirmButtonText: "Xác nhận",

        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-system.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'edit_settings',
                        system_noti: editorData,
                        system_status: package_status
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
    
} );

    
</script>
</body>

</html>