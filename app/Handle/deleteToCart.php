<?php
include '../Controllers/Toastr.php';
$toastr = new Toastr();
$eloquent = new Eloquent();

//reset session discount
$_SESSION['PRICE_DISCOUNT_AMOUNT'] = 0;
unset($_SESSION['SELECTED_COUPON']);

$deleteProductCart = $eloquent->deleteData('shopcarts', ['id' => $_POST['product_id']]);
$toastr->success_toast($_POST['product_name'] . "đã được xóa khỏi giỏ hàng", 'THÀNH CÔNG');


$product_sc_id = $_POST['product_sc_id'];
$quantity = $_POST['quantity'];
$quantityNow = $eloquent->selectData(['product_quantity'], 'products_sc', ['id' => $product_sc_id]);
$quantityNow = $quantityNow[0]['product_quantity'];

$data = [
    'product_quantity' => $quantity + $quantityNow,
    'product_status' => 'In Stock'
];
$updateProductSC = $eloquent->updateData('products_sc', $data, ['id' => $product_sc_id]);

?>