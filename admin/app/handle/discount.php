<?php
include '../../config/database.php';
include '../Controllers/Toastr.php';
include '../Models/Eloquent.php';
$toastr = new Toastr();
$eloquent = new Eloquent();

$id = $_POST['val-discount-id'];
$code = $_POST['val-discount-code'];
$price = $_POST['val-price-discount-amount'];
$discountCondition = $_POST['val-price-discount-condition'];
$quantity = $_POST['val-discount-quantity'];
$status = $_POST['val-status'];
$datetime = date('Y-m-d H:i:s');

//check condition discount amount > 0
if ($price <= 0) {
    $toastr->error_toast('Discount amount must be greater than 0!', 'Error');
    exit();
}
//check condition quantity > 0
if ($quantity <= 0) {
    $toastr->error_toast('Quantity must be greater than 0!', 'Error');
    exit();
}
//check quantity and discount is number
if (!is_numeric($quantity) || !is_numeric($price)) {
    $toastr->error_toast('Quantity and discount amount must be number!', 'Error');
    exit();
}

if ($id == '') {
    //check if discount code already exists
    $checkDiscountCode = $eloquent->selectData(['*'], 'discounts', ['discount_code' => $code, 'is_delete' => '0']);
    if ($checkDiscountCode != []) {
        $toastr->error_toast('Discount code already exists!', 'Error');
        exit();
    }
    //add new discount
    $data = [
        'discount_code' => $code,
        'price_discount_amount' => $price,
        'discount_condition' => $discountCondition,
        'quantity' => $quantity,
        'discount_status' => $status,
        'created_at' => $datetime,
        'updated_at' => $datetime
    ];
    $insertDiscount = $eloquent->insertData('discounts', $data);
    $toastr->success_toast('Add new discount success!', 'Success');
} else {
    //check if discount code already exists
    $checkDiscountCode = $eloquent->checkExistData('discounts', $id, 'discount_code', $code);
    if ($checkDiscountCode) {
        $toastr->error_toast('Discount code already exists!', 'Error');
        exit();
    }
    //edit discount
    $data = [
        'discount_code' => $code,
        'price_discount_amount' => $price,
        'discount_condition' => $discountCondition,
        'quantity' => $quantity,
        'discount_status' => $status,
        'updated_at' => $datetime
    ];
    $updateDiscount = $eloquent->updateData('discounts', $data, ['id' => $id]);
    $toastr->success_toast('Update discount success!', 'Success');
}
