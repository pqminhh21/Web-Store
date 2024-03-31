<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Page Lock Hello Store - Admin</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="public/images/favicon-admin.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="public/plugins/toastr/css/toastr.min.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">

</head>
<?php
$email = $_SESSION['admin_email'];
$name = $_SESSION['admin_name'];
?>

<body class="h-100">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->





    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="#">
                                    <h4><?= $name ?></h4>
                                </a>
                                <form class="mt-5 mb-3 login-input">
                                    <input type="hidden" id="val-email" class="form-control pl-2" placeholder="Email" value="<?= $email ?>">
                                    <div class="form-group">
                                        <input type="password" id="val-password" class="form-control" placeholder="Password">
                                    </div>
                                    <button class="btn login-form__btn submit w-100">Unlock</button>
                                </form>
                                <div class="notification"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>




    <!--**********************************
        Scripts
    ***********************************-->
    <script src="public/plugins/common/common.min.js"></script>
    <script src="public/js/custom.min.js"></script>
    <script src="public/js/settings.js"></script>
    <!-- Toastr -->
    <script src="public/plugins/toastr/js/toastr.min.js"></script>
    <script src="public/plugins/toastr/js/toastr.init.js"></script>

    <script src="public/js/main.js"></script>
</body>

</html>