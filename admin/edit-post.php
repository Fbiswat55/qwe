<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';

$email = $_SESSION['email'];
$username = $_SESSION['username'];
$id = $_GET['id'];
$showData = "SELECT * FROM tblproduct where id = $id";
$result = mysqli_query($conn, $showData);
$row_post = mysqli_fetch_array($result);
if ($username != $row_post['postuser']) {
    header('location: pages-404.php');
    exit;
}

$showData = "select * from tbldebver where email = '$email'";
$result = mysqli_query($conn, $showData);
$arrShow = array();
while ($row = mysqli_fetch_array($result)) {
    $arrShow[] = $row;
}

?>

<head>

    <title>Edit Post | APIServer Dashboard</title>
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
                            <h4 class="mb-sm-0 font-size-18">Thêm bài đăng</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                    <li class="breadcrumb-item active">List product</li>
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
                                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Phải điền đầy đủ để admin xác nhận các thông tin này</h5>
                                            <div class="row mb-4">
                                                <label for="username" class="col-sm-4 col-form-label">Tiêu đề</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="title" value="<?php echo $row_post['title'] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-sm-9 col-form-label">Free hay bán (Chọn free vẫn có thể điền giá vì có thể thi thoảng bạn mở free sau đó lại bán chẳng hạn)</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select" id="post_totaltype">
                                                        <?php
                                                        if ($row_post['totaltype'] == 0) {
                                                            echo "<option value='0' selected>Free</option>
                                                            <option value='1'>Bán</option>";
                                                        }else {
                                                            echo "<option value='0'>Free</option>
                                                            <option value='1' selected>Bán</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="username" class="col-sm-9 col-form-label">Giá ngày (Ví dụ: 15000 VND hoặc 30K, ghi làm sao đừng làm mù mắt người đọc. Khi tắt đi sẽ ngầm định là không hỗ trợ)</label>
                                                <div class="col-sm-9">
                                                <input type="checkbox" id="switch2" switch="success" <?php echo $row_post['daytotal'] == "Không hỗ trợ" ? '' : 'checked' ?>/>
                                                    <label for="switch2" data-on-label="ON" data-off-label="OFF"></label>
                                                    <input type="text" class="form-control" id="post_daytotal" value="<?php echo $row_post['daytotal'] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="username" class="col-sm-9 col-form-label">Giá tuần (Khi tắt đi sẽ ngầm định là không hỗ trợ bán theo tuần)</label>
                                                <div class="col-sm-9">
                                                <input type="checkbox" id="switch3" switch="success" <?php echo $row_post['weektotal'] == "Không hỗ trợ" ? '' : 'checked' ?>/>
                                                    <label for="switch3" data-on-label="ON" data-off-label="OFF"></label>
                                                    <input type="text" class="form-control" id="post_weektotal" value="<?php echo $row_post['weektotal'] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="username" class="col-sm-9 col-form-label">Giá tháng (Khi tắt đi sẽ ngầm định là không hỗ trợ bán theo tháng)</label>
                                                <div class="col-sm-9">
                                                <input type="checkbox" id="switch4" switch="success" <?php echo $row_post['monthtotal'] == "Không hỗ trợ" ? '' : 'checked' ?>/>
                                                    <label for="switch4" data-on-label="ON" data-off-label="OFF"></label>
                                                    <input type="text" class="form-control" id="post_monthtotal" value="<?php echo $row_post['monthtotal'] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-sm-4 col-form-label">Chọn package, key sẽ được get ra với package tương ứng</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select" id="packageid">
                                                        <?php
                                                        foreach ($arrShow as $arrS) {
                                                        ?>
                                                            <option value="<?php echo $arrS['id'] ?>" <?php echo $arrS['id'] == $row_post['debid'] ? 'selected' : '' ?>><?php echo 'ID: ' . $arrS['id'] . ' - ' . $arrS['debname'] ?></option>
                                                        <?php

                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="username" class="col-sm-9 col-form-label">Link ảnh bài viết, lên google chọn cái ảnh tuỳ thích sau đó click chuột phải chọn "Sao chép liên kết hình ảnh"</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="postimg" value="<?php echo $row_post['postimg'] ?>">
                                                </div>
                                            </div>


                                            <div class="row mb-4">
                                                <label for="username" class="col-sm-9 col-form-label">Nội dung (Server không hỗ trợ upload ảnh)</label>
                                                <div class="col-sm-9">

                                                    <textarea name="content" id="editor"><?php echo $row_post['postdetail'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="username" class="col-sm-4 col-form-label">Link tải tweak của bạn</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="postdeblink" value="<?php echo $row_post['deblink'] ?>">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="username" class="col-sm-4 col-form-label">Số điện thoại</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="phone" value="<?php echo $row_post['phoneuser'] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="username" class="col-sm-4 col-form-label">Số điện thoại Zalo</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="zalophone"value="<?php echo $row_post['zalouser'] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="username" class="col-sm-4 col-form-label">Link Facebook cá nhân hoặc page của bạn</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="fbuser" value="<?php echo $row_post['fbuser'] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="email" class="col-sm-4 col-form-label">Hệ thống Get Key Test 1 ngày</label>
                                                <div class="col-sm-9">
                                                    <input type="checkbox" id="switch1" switch="none" <?php echo $row_post['allowgetkey'] == "0" ? '' : 'checked' ?> />
                                                    <label for="switch1" data-on-label="ON" data-off-label="OFF"></label>
                                                </div>
                                            </div>

                                            <div class="row justify-content-end">
                                                <div class="col-sm-9">
                                                    <button id="submit" onclick="edit(<?php echo $row_post['id'] ?>)" type="button" class="btn btn-primary w-md"><i class="bx bx-save"></i> Post</button>
                                                </div>
                                            </div>
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
        .create(document.querySelector('#editor'))
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => {
            console.error(error);
        });


    const edit = (id) =>   {
        var package_id = $('#packageid').val();
        var post_title = $('#title').val();
        var post_img = $('#postimg').val();
        var post_phone = $('#phone').val();
        var post_zalophone = $('#zalophone').val();
        var post_fbuser = $('#fbuser').val();
        var post_totaltype = $('#post_totaltype').val();
        var post_daytotal = $('#post_daytotal').val();
        var post_weektotal = $('#post_weektotal').val();
        var post_monthtotal = $('#post_monthtotal').val();
        var post_deblink = $('#postdeblink').val();
        if (!package_id || !post_title || !post_img || !post_phone || !post_zalophone || !post_fbuser || !post_deblink) {
            Swal.fire("Thông báo", "Vui lòng bổ sung các ô nhập bị thiếu", "error");
            return;
        }

        var package_sw = document.querySelector('#switch1').checked;
        var getkey;
        if (package_sw) {
            getkey = 1;
        } else {
            getkey = 0;
        }
        const editorData = editor.getData();
        Swal.fire({
            title: 'Xác nhận',
            icon: 'warning',
            text: `Mọi thông tin bạn nhập sẽ được admin kiểm chứng để phòng ngừa scammer, thông tin không rõ ràng, bài viết sẽ bị xoá. Xác nhận tiếp tục ?`,
            showCancelButton: true,
            confirmButtonText: "Xác nhận",

        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseurl + '/admin/module/ajax-post.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        type: 'edit_post',
                        post_id: id,
                        package_id: package_id,
                        post_title: post_title,
                        post_img: post_img,
                        post_phone: post_phone,
                        post_zalophone: post_zalophone,
                        post_fbuser: post_fbuser,
                        post_detail: editorData,
                        post_daytotal: post_daytotal,
                        post_weektotal: post_weektotal,
                        post_monthtotal : post_monthtotal,
                        post_totaltype: post_totaltype,
                        post_deblink: post_deblink,
                        post_getkey: getkey
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

    };

    $('#switch2').change(function () {
    if ($(this).is(':checked')) {
        $("#post_daytotal").show();
        $("#post_daytotal").val("");
    } else {
        $("#post_daytotal").hide();
        $("#post_daytotal").val("Không hỗ trợ");
    }
});
$('#switch3').change(function () {
    if ($(this).is(':checked')) {
        $("#post_weektotal").show();
        $("#post_weektotal").val("");
    } else {
        $("#post_weektotal").hide();
        $("#post_weektotal").val("Không hỗ trợ");
    }
});
$('#switch4').change(function () {
    if ($(this).is(':checked')) {
        $("#post_monthtotal").show();
        $("#post_monthtotal").val("");
    } else {
        $("#post_monthtotal").hide();
        $("#post_monthtotal").val("Không hỗ trợ");
    }
});
</script>
</body>

</html>