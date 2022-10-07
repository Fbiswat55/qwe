<?php
// Include config file
require_once "layouts/config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';
$useremail_err = $msg = "";
// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/$uri_segments[1]";
if (isset($_POST['submit'])) {
    $api_url     = 'https://www.google.com/recaptcha/api/siteverify';
    $site_key    = '6Ld7pXIfAAAAAOiyNCkheogLzPqSFiQJMPHajYOW';
    $secret_key  = '6Ld7pXIfAAAAAB3YaPFaojvbak-3JK8i5wVploS2';
    $useremail = $_POST['useremail'];
    $site_key_post = $_POST['g-recaptcha-response'];
    //tạo link kết nối
    $api_url = $api_url . '?secret=' . $secret_key . '&response=' . $site_key_post . '&remoteip=' . $remoteip;
    //lấy kết quả trả về từ google
    $response = file_get_contents($api_url);
    //dữ liệu trả về dạng json
    $response = json_decode($response);
    if (!isset($response->success)) {
        $useremail_err = 'Captcha không đúng';
        exit();
    }
    if ($response->success != true) {
        $useremail_err = 'Captcha lỗi';
    } else {
        $sql = "SELECT * FROM tai_khoan WHERE email = '$useremail'";
        $query = mysqli_query($conn, $sql);
        $emailcount = mysqli_num_rows($query);

        if ($emailcount) {
            $userdata = mysqli_fetch_array($query);
            $username = $userdata['username'];
            $token = $userdata['token'];

            $subject = "APIServer Password Reset";
            $body = $actual_link . "/auth-reset-password.php?token=$token";
            $sender_email = "From: $gmailid";

            try {
                // Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->isHTML(true);
                $mail->Username = $gmailid;
                $mail->Password = $gmailpassword;

                // Sender and recipient settings
                $mail->setFrom($gmailid, $gmailusername);
                $mail->addAddress($useremail, $username);
                $mail->addReplyTo($gmailid, $gmailusername); // to set the reply to

                // Setting the email content
                $mail->IsHTML(true);
                $mail->Subject = $subject;
                $html = file_get_contents('mail.html');
                $html = str_replace("{{TOKEN}}", $body, $html);
                $mail->Body = $html;

                $mail->send();
                $msg = "Chúng tôi đã gửi đường link đặt lại mật khẩu đến email của bạn!";
                // header("location:auth-login.php");
            } catch (Exception $e) {
                $useremail_err =  "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $useremail_err = "No Email Found";
        }
    }
}
?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Recover Password | APIServer Dashboard</title>
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
                                    <h5 class="mb-0">Reset Password</h5>
                                    <p class="text-muted mt-2">Reset Password APIServer account.</p>
                                </div>
                                <?php if ($msg) { ?>
                                    <div class="alert alert-success text-center mb-4 mt-4 pt-2" role="alert">
                                        <?php echo $msg; ?>
                                    </div>
                                <?php } ?>

                                <form class="custom-form mt-4" action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="mb-3 <?php echo (!empty($useremail_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" id="useremail" name="useremail" placeholder="Enter email">
                                        <span class="text-danger"><?php echo $useremail_err; ?></span>
                                    </div>
                                    <div class="mb-3">
                                        <div class="g-recaptcha" data-sitekey="6Ld7pXIfAAAAAOiyNCkheogLzPqSFiQJMPHajYOW"></div>
                                    </div>
                                    <div class="mb-3 mt-4">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type='submit' name='submit' value='Submit'>Reset</button>
                                    </div>
                                </form>

                                <div class="mt-5 text-center">
                                    <p class="text-muted mb-0">Remember It ? <a href="auth-login.php" class="text-primary fw-semibold"> Sign In </a> </p>
                                </div>
                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>
                                        document.write(new Date().getFullYear())
                                    </script> APIServer. Develop by Bao Nguyen</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>


<!-- JAVASCRIPT -->
<script src="https://www.google.com/recaptcha/api.js?hl=vi"></script>
<?php include 'layouts/vendor-scripts.php'; ?>

</body>

</html>