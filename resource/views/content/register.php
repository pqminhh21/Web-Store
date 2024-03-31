<?php
$eloquent = new Eloquent;
$customerList = $eloquent->selectData(['*'], 'customers');
if (isset($_POST['userRegistration'])) {
    $tableName = "customers";
    $registerData = [
        'customer_name' => trim($_POST['last-name'] . ' ' . $_POST['first-name']),
        'customer_email' => $_POST['email'],
        'customer_password' => sha1($_POST['password']),
        'customer_mobile' => trim($_POST['phone']),
        'customer_address' => trim($_POST['address']),
        'created_at' => date('Y-m-d H:i:s'),
        'customer_image' => 'no-image.png'
    ];
    if ($_POST['password'] != $_POST['password-confirm']) {
        $_SESSION['confirm-password'] = '<div class="alert alert-danger">⚠ Mật khẩu không khớp. Vui lòng nhập lại!</div>';
    }

    foreach ($customerList as $customer) {
        if ($customer['customer_email'] == $_POST['email']) {
            $_SESSION['check-email'] = '<div class="alert alert-danger">⚠ Email đã tồn tại. Vui lòng nhập lại!</div>';
            break;
        }
    }
    if (isset($_SESSION['confirm-password']) || isset($_SESSION['check-email'])) $registerUser = 0;
    else $registerUser = $eloquent->insertData($tableName, $registerData);
    // print_r($registerUser);
    if ($registerUser > 0) {
        $_SESSION['email-register'] = $_POST['email'];
        $_SESSION['password-register'] = $_POST['password'];
        $_SESSION['success-register'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Chúc mừng bạn đã đăng kí thành công.
                                        <a href="login.php"> Đăng nhập ngay!</a>
                                        </div>';
    }
}
?>

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Trang chủ</a>
                <span></span> Đăng kí
            </div>
        </div>
    </div>
    <section class="pt-30 pb-150">
        <div class="container">
            <div class="row">

                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <?php
                        if (isset($_SESSION['confirm-password'])) {
                            echo $_SESSION['confirm-password'];
                            unset($_SESSION['confirm-password']);
                        }
                        if (isset($_SESSION['check-email'])) {
                            echo $_SESSION['check-email'];
                            unset($_SESSION['check-email']);
                        }
                        if (isset($_SESSION['success-register'])) {
                            echo $_SESSION['success-register'];
                            unset($_SESSION['success-register']);
                        }
                        ?>
                        <div class="col-lg-6">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Tạo tài khoản</h3>
                                    </div>
                                    <form action="register.php" method="post">
                                        <div class="form-group">
                                            <input type="text" required name="last-name" placeholder="Họ" value="<?= isset($_POST['last-name']) ? $_POST['last-name'] : '' ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" required name="first-name" placeholder="Tên" value="<?= isset($_POST['first-name']) ? $_POST['first-name'] : '' ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" required name="email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input required type="password" name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <input required type="password" name="password-confirm" placeholder="Confirm password">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" required name="phone" placeholder="Số điện thoại" value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" required name="address" placeholder="Địa chỉ" value="<?= isset($_POST['address']) ? $_POST['address'] : '' ?>">
                                        </div>
                                        <div class="login_footer form-group">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="">
                                                    <label class="form-check-label" for="exampleCheckbox12"><span>Tôi đồng ý với các điều khoản.</span></label>
                                                </div>
                                            </div>
                                            <a href="privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>Xem thêm</a>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up" name="userRegistration">Đăng kí</button>
                                        </div>
                                    </form>
                                    <div class="text-muted text-center">Bạn đã có sẵn tài khoản? <a href="login.php">Đăng nhập ngay</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <img src="public/assets/imgs/login.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>