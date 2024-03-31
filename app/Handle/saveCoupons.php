<?php
include '../Controllers/Toastr.php';
include '../../config/server.php';

$toastr = new Toastr();
$eloquent = new Eloquent();
$arr = array();

$customerId = $_SESSION['SSCF_login_id'];
$discountId = $_POST['discountId'];
$quantity = $_POST['quantity'];

if ($quantity == 0) {
    $arr = [
        'type' => 'error',
        'title' => 'Thông báo',
        'message' => 'Mã giảm giá đã hết lượt sử dụng',
    ];
    echo json_encode($arr);
} else {
    //update quantity discount
    $quantity = $quantity - 1;
    $updateQuantityDiscount = $eloquent->updateData('discounts', ['quantity' => $quantity], ['id' => $discountId]);

    //check save coupon
    $checkSaveCoupon = $eloquent->selectData(['id'], 'coupons', ['customer_id' => $customerId, 'discount_id' => $discountId]);
    if (count($checkSaveCoupon) > 0) {
        // ko vao truong hop nay vi da config class name
        echo 'coupon đã được lưu trước đó';
    } else {
        $SaveCoupon = $eloquent->insertData('coupons', [
            'customer_id' => $customerId,
            'discount_id' => $discountId,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    $couponSaved = $eloquent->selectCouponsSave($discountId);
    $persent = ($couponSaved / ($quantity + $couponSaved)) * 100;
    $persent = round($persent, 0);

    $arr = [
        'type' => 'success',
        'title' => 'Thông báo',
        'message' => 'Lưu mã giảm giá thành công',
        'discountId' => $discountId,
        'persent' => $persent,
    ];
    echo json_encode($arr);
}
