<?php
$showDataNoti = "SELECT * FROM tblnotification ORDER BY noti_read asc ,id desc";
$resultNoti = mysqli_query($conn, $showDataNoti);
$arrShowNoti = array();
while ($rowNoti = mysqli_fetch_array($resultNoti)) {
    $arrShowNoti[] = $rowNoti;
}
$nv = "SELECT count(id) as soluong FROM tblnotification where noti_read = '0'";
$result = mysqli_query($conn, $nv);
$rowNV = mysqli_fetch_array($result);
$tongNoti = $rowNV['soluong'];

?>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="/assets/images/logo-sm.svg" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="/assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">APIServer</span>
                    </span>
                </a>

                <a href="index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="/assets/images/logo-sm.svg" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="/assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">APIServer</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search">
                    <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                </div>
            </form>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="search" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" aria-label="Search Result">

                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" id="mode-setting-btn">
                    <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                    <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                </button>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="grid" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <div class="p-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="/assets/images/brands/github.png" alt="Github">
                                    <span>GitHub</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="/assets/images/brands/bitbucket.png" alt="bitbucket">
                                    <span>Bitbucket</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="/assets/images/brands/dribbble.png" alt="dribbble">
                                    <span>Dribbble</span>
                                </a>
                            </div>
                        </div>

                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="/assets/images/brands/dropbox.png" alt="dropbox">
                                    <span>Dropbox</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="/assets/images/brands/mail_chimp.png" alt="mail_chimp">
                                    <span>Mail Chimp</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="/assets/images/brands/slack.png" alt="slack">
                                    <span>Slack</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell" class="icon-lg"></i>
                    <span class="badge bg-danger rounded-pill"><?php echo $tongNoti == 0 ? '' : $tongNoti ?></span>
                </button>
                <div style="max-width: 300px;" class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0">Thông báo</h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small text-reset text-decoration-underline">Đã xem tất cả</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;" class="px-3">
                        <?php
                        $count = 1;
                        foreach ($arrShowNoti as $arrS) {
                        ?>
                            <a onclick="readnoti(<?php echo $arrS['id'] ?>)" href="#!" class="text-reset notification-item">
                                <div class="row">
                                    <div class="d-flex px-0 <?php echo $arrS['noti_read'] == 0 ? 'col-11' : '' ?>">
                                        <div class="flex-shrink-0 avatar-sm me-3">
                                            <span class="avatar-title bg-<?php if ($arrS['noti_level'] == 0) {
                                                                                echo 'primary';
                                                                            } else if (($arrS['noti_level'] == 1)) {
                                                                                echo 'success';
                                                                            } else {
                                                                                echo 'danger';
                                                                            }
                                                                            ?> rounded-circle font-size-16">
                                                <i class="bx bx-<?php if ($arrS['noti_level'] == 0) {
                                                                    echo 'info-circle';
                                                                } else if (($arrS['noti_level'] == 1)) {
                                                                    echo 'wrench';
                                                                } else {
                                                                    echo 'error';
                                                                }
                                                                ?>"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1"><?php echo $arrS['noti_user'] ?></h6>
                                            <div class="font-size-13 text-muted">
                                                <p class="mb-1"><?php echo $arrS['noti_detail'] ?></p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span><?php echo time_string($arrS['noti_time']) ?></span></p>

                                            </div>
                                        </div>
                                    </div>
                                    <?php echo $arrS['noti_read'] == 0 ? "<div class='col-1 m-auto px-0'><span class='badge bg-primary rounded-circle'>N</span></div>" : "" ?>
                                </div>

                            </a>
                        <?php
                            $count++;
                        }
                        ?>

                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i><span>View More</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item right-bar-toggle me-2">
                    <i data-feather="settings" class="icon-lg"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bxs-user-circle"></i>
                    <span class="d-none d-xl-inline-block ms-1 fw-medium"><?php echo $_SESSION["username"]; ?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <button class="dropdown-item"><i class="mdi mdi-face-profile font-size-16 align-middle me-1" disabled></i> <?php if ($_SESSION['level'] == 0) {
                                                                                                                                    echo 'Normal User';
                                                                                                                                } else if ($_SESSION['level'] == 1) {
                                                                                                                                    echo 'Administrator';
                                                                                                                                } else {
                                                                                                                                    echo 'Vip User';
                                                                                                                                }

                                                                                                                                ?></button>
                    <a class="dropdown-item" href="auth-change-password.php"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Change password </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i>Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>

<!-- ========== Left Sidebar Start ========== -->
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="index.php">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/index.php">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Trang chủ</span>
                    </a>
                </li>

                <li>
                    <a href="list-device.php">
                        <i data-feather="smartphone"></i>
                        <span data-key="t-horizontal">Danh sách thiết bị</span>
                    </a>
                </li>
                <li>
                    <a href="list-key.php">
                        <i data-feather="key"></i>
                        <span data-key="t-horizontal">Danh sách key</span>
                    </a>
                </li>
                <li>
                    <a href="list-deb.php">
                        <i data-feather="package"></i>
                        <span data-key="t-horizontal">Danh sách package</span>
                    </a>
                </li>
                <li>
                    <a href="list-post.php">
                        <i data-feather="file-text"></i>
                        <span data-key="t-horizontal">Danh sách bài đăng</span>
                    </a>
                </li>
                <li>
                    <a href="get-history.php">
                        <i data-feather="clock"></i>
                        <span data-key="t-horizontal">Lịch sử get key</span>
                    </a>
                </li>
                <?php if ($_SESSION['level'] == 1) include 'sidebar-admin.php'; ?>
            </ul>

            <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                <div class="card-body">
                    <img src="/assets/images/giftbox.png" alt="">
                    <div class="mt-4">
                        <h5 class="alertcard-title font-size-16">Paid membership</h5>
                        <p class="font-size-13">Nâng cấp lên bản trả phí để phá giới hạn và nhiều quyền lợi khác.</p>
                        <a href="pages-pricing.php" class="btn btn-primary mt-2">Upgrade Now</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->