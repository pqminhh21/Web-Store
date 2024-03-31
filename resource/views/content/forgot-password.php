<?php
$eloquent = new Eloquent;

?>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php" rel="nofollow">Trang chủ</a>
                <span></span> Quên mật khẩu
            </div>
        </div>
    </div>
    <section class="pt-30 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Tìm kiếm tài khoản</h3>
                                    </div>
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <input type="text" required name="user_email" class="user_email" placeholder="Nhập email ..." value="">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-fill-out btn-block hover-up forgot-password" name="user_login">Kiểm tra</button>
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