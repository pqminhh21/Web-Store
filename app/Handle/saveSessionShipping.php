<?php
include '../Controllers/Toastr.php';
$toastr = new Toastr();

if($_POST['lfname'] == "" || $_POST['email'] == "" || $_POST['phone'] == "" || $_POST['address'] == "" || $_POST['address_city'] == "" || $_POST['zipcode'] == "") {
    $toastr = new Toastr();
    $toastr->error_toast("Vui lòng nhập đầy đủ thông tin người nhận!", "Thông báo", "2000");
    exit();
}

$_SESSION['lfname-session'] = $_POST['lfname'];
$_SESSION['email-session'] = $_POST['email'];
$_SESSION['phone-session'] = $_POST['phone'];
$_SESSION['address-session'] = $_POST['address'];
$_SESSION['address-city-session'] = $_POST['address_city'];
$_SESSION['zipcode-session'] = $_POST['zipcode'];
$_SESSION['note-session'] = $_POST['note'];

echo '<script>window.location="app/Handle/VnPay/vnpay_create_payment.php"</script>';
?>