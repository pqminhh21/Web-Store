<?php

include '../Controllers/Toastr.php';
//da goi sesstion_start(), globals database, eloquent trong class Toastr
include '../../config/site.php';
$toastr = new Toastr();
$eloquent = new Eloquent();


$id = $_POST['product_sc_id'];
$name = $_POST['product_name'];
$qty = $_POST['product_qty'];

if ($id == 0) {
    $toastr->error_toast('Bạn chưa chọn size hoặc màu', 'THẤT BẠI');
    exit();
}

$productSC = $eloquent->selectData(['*'], 'products_sc', ['id' => $id]);
$productQty = $productSC[0]['product_quantity'];
$productSize = $productSC[0]['product_size'];
$productColor = $productSC[0]['product_color'];
if ($productQty == 0) {
    $toastr->error_toast('Sản phầm ' . $name . ' đã hết hàng', 'THẤT BẠI');
    exit();
}
if ($productQty < $qty) {
    $toastr->warning_toast($name . '(size: ' . $productSize . ' ,màu: ' . $productColor . ') chỉ còn ' . $productQty . ' sản phẩm', 'CẢNH BÁO');
    exit();
}

if (isset($_SESSION['SSCF_login_id'])) {
    //update quantity in productsc
    $quantityRemain = $productQty - $qty;
    if ($quantityRemain == 0) {
        $data = [
            'product_quantity' => $quantityRemain,
            'product_status' => 'Out of Stock'
        ];
    } else {
        $data = [
            'product_quantity' => $quantityRemain,
        ];
    }
    $updateQuantity = $eloquent->updateData('products_sc', $data, ['id' => $id]);
    //check1: kiem tra xem san pham da co trong gio hang chua?
    $columnName = ['*'];
    $tableName = "shopcarts";
    $whereValue = [
        'product_sc_id' => $id,
        'customer_id' => $_SESSION['SSCF_login_id']
    ];
    $availabilityInCart = $eloquent->selectData($columnName, $tableName, @$whereValue);

    //neu co san pham do trong gio hang
    if (!empty($availabilityInCart)) {
        // update so luong san pham trong gio hang
        $tableName = "shopcarts";
        $columnValue["quantity"] = $qty + $availabilityInCart[0]['quantity'];
        $whereValue = [
            'customer_id' => $_SESSION['SSCF_login_id'],
            'product_sc_id' => $id
        ];
        $updateCartResult = $eloquent->updateData($tableName, $columnValue, $whereValue);
        // $productListCart = $eloquent->selectData(['*'], $tableName, ['customer_id' => $_SESSION['SSCF_login_id']]);
        // $count_product_cart = count($productListCart);
        $_SESSION['ADD_TO_CART_RESULT'] = $updateCartResult;
        //$SESSION['LIST_PRODUCT_CART'] = $productListCart;
    } else {
        #== INSERT ITEMS INTO THE ADD TO CART
        $columnValue = $tableName = null;
        $tableName = "shopcarts";
        $columnValue = [
            'customer_id' => $_SESSION['SSCF_login_id'],
            'product_sc_id' => $id,
            'quantity' => $_POST['product_qty'],
            'created_at' => date("Y-m-d H:i:s")
        ];
        $addToCartResult = $eloquent->insertData($tableName, $columnValue);
        // $productListCart = $eloquent->selectData(['*'], $tableName, ['customer_id' => $_SESSION['SSCF_login_id']]);
        // $count_product_cart = count($productListCart);
        $_SESSION['ADD_TO_CART_RESULT'] = $addToCartResult;
        //$SESSION['LIST_PRODUCT_CART'] = $productListCart;
    }
    $toastr->success_toast($name . " đã thêm vào giỏ hàng ", 'Thành công');
} else {
    $_SESSION['ADD_TO_CART_RESULT'] = 0;
    $toastr->error_toast('Vui lòng đăng nhập để thêm vào giỏ hàng ', 'Thất bại');
}

//include 'loadCart.php';
