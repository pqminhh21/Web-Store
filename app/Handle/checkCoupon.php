<?php
include '../Controllers/Toastr.php';
include '../../config/site.php';
$toastr = new Toastr();
$eloquent = new Eloquent();
$_SESSION['PRICE_DISCOUNT_AMOUNT'] = 0;
$customerId = $_SESSION['SSCF_login_id'];
if ($_POST['coupon_code'] == "") {
    $toastr->error_toast("Mã giảm giá không hợp lệ", 'THẤT BẠI');
    exit();
}
$couponItem = $eloquent->selectData(['*'], 'discounts', ['discount_code' => $_POST['coupon_code'], 'discount_status' => 'Active', 'is_delete' => '0']);

//get price cart
$productListCart = $eloquent->loadCartInfo($customerId);
$priceTotal = 0;
foreach ($productListCart as $eachProduct) {
    $priceTotal += $eachProduct['product_price'] * $eachProduct['quantity'];
}


if ($couponItem != []) {
    $discountId = $couponItem[0]['id'];
    $discountCondition = $couponItem[0]['discount_condition'];
    // check customer save coupon
    $checkCustomerCoupon = $eloquent->selectData(['*'], 'coupons', ['customer_id' => $customerId, 'discount_id' => $discountId]);
    if ($checkCustomerCoupon == []) {
        $toastr->info_toast("Bạn chưa sở hữu mã giảm giá này!", 'THÔNG BÁO');
        exit();
    } else {
        $_SESSION['DISCOUNT_ID'] = $discountId;
        if ($checkCustomerCoupon[0]['is_use'] == 1) {
            $toastr->info_toast("Bạn đã sử dụng mã giảm giá này!", 'THÔNG BÁO');
            exit();
        } else {
            if ($discountCondition > $priceTotal) {
                $toastr->error_toast("Đơn hàng không đủ điều kiện để áp dụng mã", 'THẤT BẠI');
                exit();
            }
            $_SESSION['PRICE_DISCOUNT_AMOUNT'] = $couponItem[0]['price_discount_amount'];
            $_SESSION['SELECTED_COUPON'] = $discountId;
            $toastr->success_toast("Mã giảm giá đã được áp dụng", 'THÀNH CÔNG');
        }
    }
} else {
    $_SESSION['PRICE_DISCOUNT_AMOUNT'] = 0;
    $toastr->error_toast("Mã giảm giá không hợp lệ", 'THẤT BẠI');
}
