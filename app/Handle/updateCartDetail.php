<?php
include '../Controllers/Toastr.php';
include '../../config/site.php';
$toastr = new Toastr();
$eloquent = new Eloquent();
$arr = array();

//reset session discount
$_SESSION['PRICE_DISCOUNT_AMOUNT'] = 0;
unset($_SESSION['SELECTED_COUPON']);

//update quantity remain
$type = $_POST['type'];
$quantityRemain = $type == 'up' ? $_POST['quantity_remain'] - 1 : $_POST['quantity_remain'] + 1;
if ($quantityRemain ==0 ){
    $data = [
        'product_quantity' => $quantityRemain,
        'product_status' => 'Out of Stock'
    ];
} else {
    $data = [
        'product_quantity' => $quantityRemain,
        'product_status' => 'In Stock'
    ];
}
$updateQtyRemainProductSC = $eloquent->updateData('products_sc', $data, ['id' => $_POST['product_type']]);

//get quantity remain
$qtyRemainProductSC = $eloquent->selectData(['product_quantity'], 'products_sc', ['id' => $_POST['product_type']]);
$qtyRemainProductSC = $qtyRemainProductSC[0]['product_quantity'];

//update quantity
$productItem = $eloquent->updateData('shopcarts', ['quantity' => $_POST['product_quantity']], ['id' => $_POST['product_sc_id']]);

//get quantity
$productItemQty = $eloquent->selectData(['quantity'], 'shopcarts', ['id' => $_POST['product_sc_id']]);

if (isset($_SESSION['SSCF_login_id'])) {
    $productListCart = $eloquent->loadCartInfo($_SESSION['SSCF_login_id']);
    $count_product_cart = count($productListCart);
} else {
    $count_product_cart = 0;
    $productListCart = [];
}
$priceTotal = 0;
if ($productListCart != [])
    foreach ($productListCart as $eachProduct) {
        $productImageItem = $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_master_image'];
        $priceTotal += $eachProduct['product_price'] * $eachProduct['quantity'];
    }

if ($priceTotal > 200000) $priceShip = 0;
else $priceShip = 30000;

$arr = array(
    'sub_price' => $productItemQty[0]['quantity'] * $_POST['product_price'],
    'total_price' => $priceTotal,
    'ship_price' => $priceShip,
    'quantity_remain' => $qtyRemainProductSC,
);

echo json_encode($arr);
