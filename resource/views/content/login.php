<?php
$eloquent = new Eloquent;

## ===*=== [W]HEN USER TRY TO LOG IN ===*=== ##
if (isset($_POST['user_login'])) {
    #== FETCH DATA FROM THE CUSTOMER TABLE AND VALIDATE WITH SUBMITTED DATA
    $columnName = ['*'];
    $tableName = "customers";
    $whereValue = [
        "customer_email" => $_POST['user_email'],
        "customer_password" => sha1($_POST['user_pass']),
    ];
    $userLogin = $eloquent->selectData($columnName, $tableName, $whereValue);

    #== AFTER VALIDATAION CREATE A SESSION FOR USER ENTIRE FRONT END APPLICATION
    if (!empty($userLogin) && $userLogin[0]['customer_status'] == 'Active') {
        $_SESSION['SSCF_login_time'] = date("Y-m-d H:i:s");
        $_SESSION['SSCF_login_id'] = $userLogin[0]['id'];
        $_SESSION['SSCF_login_user_name'] = $userLogin[0]['customer_name'];
        $_SESSION['SSCF_login_user_image'] = $userLogin[0]['customer_image'];
        $_SESSION['SSCF_login_user_email'] = $userLogin[0]['customer_email'];
        $_SESSION['SSCF_login_user_password'] = $_POST['user_pass'];
        $_SESSION['SSCF_login_user_mobile'] = $userLogin[0]['customer_mobile'];
        $_SESSION['SSCF_login_user_address'] = $userLogin[0]['customer_address'];

        //echo '<meta http-equiv="Refresh" content="0; url=index.php" />';
        echo '<script>window.location="index.php"</script>';
    }
}

?>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php" rel="nofollow">Trang chủ</a>
                <span></span> Đăng nhập
            </div>
        </div>
    </div>
    <section class="pt-30 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <?php
                    if (isset($_POST['user_login'])) {
                        if (empty($userLogin)) {
                            echo '<div class="alert alert-danger">⚠ Bạn đã nhập sai tài khoản hoặc mật khẩu. Vui lòng nhập lại!</div>';
                        }
                        if ($userLogin != [] && $userLogin[0]['customer_status'] == 'Inactive') {
                            echo '<div class="alert alert-danger">⚠ Tài khoản của bạn đã bị khóa. Vui lòng liên hệ với quản trị viên để biết thêm chi tiết!</div>';
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Đăng nhập</h3>
                                    </div>
                                    <form action="login.php" method="post">
                                        <div class="form-group">
                                            <input type="text" required name="user_email" placeholder="Your Email" value="<?= isset($_SESSION['email-register']) ? $_SESSION['email-register'] : '' ?>">
                                        </div>
                                        <div class="form-group">
                                            <input required type="password" name="user_pass" placeholder="Password" value="<?= isset($_SESSION['password-register']) ? $_SESSION['password-register'] : '' ?>">
                                        </div>
                                        <div class="login_footer form-group">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                                    <label class="form-check-label" for="exampleCheckbox1"><span>Nhớ mật khẩu</span></label>
                                                </div>
                                            </div>
                                            <a class="text-muted" href="forgot-password.php">Quên mật khẩu?</a>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up" name="user_login">Đăng nhập</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-6">
                            <img src="public/assets/imgs/login.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>