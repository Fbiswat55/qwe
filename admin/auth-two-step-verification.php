<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

    <head>

        
        <title>Verification | APIServer Dashboard</title>
        <?php include 'layouts/head.php'; ?>
<?php include 'layouts/head-style.php'; ?>

    </head>

<?php include 'layouts/body.php'; ?>
        <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0 justify-content-center">
                    <div class="col-xxl-3 col-lg-4 col-md-5">
                        <div class="auth-full-page-content d-flex p-sm-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5 text-center">
                                        <a href="index.php" class="d-block auth-logo">
                                            <img src="/assets/images/logo-sm.svg" alt="" height="28"> <span class="logo-txt">APIServer</span>
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">

                                            <div class="avatar-lg mx-auto">
                                                <div class="avatar-title rounded-circle bg-light">
                                                    <i class="bx bxs-envelope h2 mb-0 text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="p-2 mt-4">
                    
                                                <h4>Verify your email</h4>
                                                <p class="mb-5">Please enter the 4 digit code sent to <span class="fw-bold">example@abc.com</span></p>
                    
                                                <form>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <div class="mb-3">
                                                                <label for="digit1-input" class="visually-hidden">Dight 1</label>
                                                                <input type="text" class="form-control form-control-lg text-center" onkeyup="moveToNext(this, 2)" maxlength="1" id="digit1-input">
                                                            </div>
                                                        </div>
                    
                                                        <div class="col-3">
                                                            <div class="mb-3">
                                                                <label for="digit2-input" class="visually-hidden">Dight 2</label>
                                                                <input type="text" class="form-control form-control-lg text-center" onkeyup="moveToNext(this, 3)" maxlength="1" id="digit2-input">
                                                            </div>
                                                        </div>
                    
                                                        <div class="col-3">
                                                            <div class="mb-3">
                                                                <label for="digit3-input" class="visually-hidden">Dight 3</label>
                                                                <input type="text" class="form-control form-control-lg text-center" onkeyup="moveToNext(this, 4)" maxlength="1" id="digit3-input">
                                                            </div>
                                                        </div>
                    
                                                        <div class="col-3">
                                                            <div class="mb-3">
                                                                <label for="digit4-input" class="visually-hidden">Dight 4</label>
                                                                <input type="text" class="form-control form-control-lg text-center" onkeyup="moveToNext(this, 4)" maxlength="1" id="digit4-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                    
                                                <div class="mt-4">
                                                    <a href="index.php" class="btn btn-primary w-100">Confirm</a>
                                                </div>
                                            </div>
                    
                                        </div>

                                        <div class="mt-5 text-center">
                                            <p class="text-muted mb-0">Nếu không nhận được mã, vui lòng kiểm tra trong mục spam hoặc <a href="#"
                                                class="text-primary fw-semibold"> Gửi lại </a> </p>
                                        </div>
                                    </div>
                                    <div class="mt-4 mt-md-5 text-center">
                                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> APIServer   . Develop by Bao Nguyen</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>


        <!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

        <!-- two-step-verification js -->
        <script src="/assets/js/pages/two-step-verification.init.js"></script>

    </body>

</html>