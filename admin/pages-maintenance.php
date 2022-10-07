<?php include 'layouts/head-main.php'; ?>

    <head>
        
        <title>Maintenance | APIServer Dashboard</title>
        <?php include 'layouts/head.php'; ?>
        
<?php include 'layouts/head-style.php'; ?>

    </head>

<?php include 'layouts/body.php'; ?>

        <div class="bg-soft-light min-vh-100 py-5">
            <div class="py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <div class="mb-5">
                                    <a href="index.php">
                                        <img src="/assets/images/logo-sm.svg" alt="" height="30" class="me-1"><span class="logo-txt text-dark font-size-22">APIServer</span>
                                    </a>
                                </div>
    
                                <div class="maintenance-cog-icon text-primary pt-4">
                                    <i class="mdi mdi-cog spin-right display-3"></i>
                                    <i class="mdi mdi-cog spin-left display-4 cog-icon"></i>
                                </div>
                                <h3 class="mt-4">Website đang bảo trì</h3>
                                <p>Vui lòng quay lại sau.</p>
    
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mt-4 maintenance-box">
                                                <div class="p-4">
                                                    <div class="avatar-md mx-auto">
                                                        <span class="avatar-title bg-soft-primary rounded-circle">
                                                            <i class="mdi mdi-access-point-network font-size-24 text-primary"></i>
                                                        </span>
                                                    </div>
                                                    
                                                    <h5 class="font-size-15 text-uppercase mt-4">Tại sao lại xảy ra?</h5>
                                                    <p class="text-muted mb-0">Việc bảo trì là để nâng cấp, sửa chữa lỗi nhằm tăng cường trải nghiệm cho người dùng. Trong thời gian này, tạm thời không thể truy cập hệ thống</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-4 maintenance-box">
                                                <div class="p-4">
                                                    <div class="avatar-md mx-auto">
                                                        <span class="avatar-title bg-soft-primary rounded-circle">
                                                            <i class="mdi mdi-clock-outline font-size-24 text-primary"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-15 text-uppercase mt-4">
                                                        Thời gian bảo trì?</h5>
                                                    <p class="text-muted mb-0">Thời gian bảo trì thường kéo dài từ 1 đến 2 giờ đồng hồ và có thể gia tăng nếu phát sinh vấn đề.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-4 maintenance-box">
                                                <div class="p-4">
                                                    <div class="avatar-md mx-auto">
                                                        <span class="avatar-title bg-soft-primary rounded-circle">
                                                            <i class="mdi mdi-email-outline font-size-24 text-primary"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-15 text-uppercase mt-4">
                                                        Bạn cần sự hỗ trợ?</h5>
                                                    <p class="text-muted mb-0">Hãy yên tâm rằng mọi dữ liệu và việc kết nối với Client vẫn sẽ hoạt động bình thường ngay cả khi bảo trì. Nếu cần sự giúp đỡ, hãy liên hệ qua email <a
                                                                href="mailto:baooshacker@gmail.com"
                                                                class="text-decoration-underline">admin@baontq.com</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
        </div>
        <!-- end  -->
        
        <!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

    </body>
</html>
