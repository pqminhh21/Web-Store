<?php
include '../../config/database.php';
include '../Controllers/Toastr.php';
include '../Models/Eloquent.php';
$toastr = new Toastr();
$eloquent = new Eloquent();

$idProduct = $_POST['val-product-id'];
$idProductSC = $_POST['val-productsc-id'];
$quantity = $_POST['val-product-quantity'];
$productStatus = $_POST['val-status'];
//render size
$strSize = $_POST['val-size-render'];
$arrSize = explode(',', $strSize);
//render color
$strColor = $_POST['val-color-render'];
$arrColor = explode(',', $strColor);

$datetime = date('Y-m-d H:i:s');

//check quantity
if ($quantity == '') {
    $toastr->error_toast('Quantity is required!', 'Error');
    exit();
} else if (!is_numeric($quantity)) {
    $toastr->error_toast('Quantity must be a number!', 'Error');
    exit();
} else if ($quantity < 0) {
    $toastr->error_toast('Quantity must be a positive number!', 'Error');
    exit();
} else if ($quantity == 0) {
    $productStatus = 'Out of Stock';
}


$arrColorSize = [];

foreach ($arrSize as $eachSize) {
    foreach ($arrColor as $eachColor) {
        $colorsizeItem['size'] = $eachSize;
        $colorsizeItem['color'] = $eachColor;
        array_push($arrColorSize, $colorsizeItem);
    }
}
//get color size from db
$colorSizeList = $eloquent->selectData(['product_size', 'product_color'], 'products_sc', ['product_id' => $idProduct, 'is_delete' => '0']);

if ($idProductSC == '') {
    //check size
    if ($strSize == '') {
        $toastr->error_toast('Size is required!', 'Error');
        exit();
    }
    //check color
    if ($strColor == '') {
        $toastr->error_toast('Color is required!', 'Error');
        exit();
    }
    //check if color size exist in db
    $check = false;
    foreach ($arrColorSize as $eachColorSize) {
        $check = false;
        foreach ($colorSizeList as $eachColorSizeList) {
            if ($eachColorSize['size'] == $eachColorSizeList['product_size'] && $eachColorSize['color'] == $eachColorSizeList['product_color']) {
                $check = true;
                break;
            }
        }
        if ($check == false) {
            $data = [
                'product_id' => $idProduct,
                'product_size' => $eachColorSize['size'],
                'product_color' => $eachColorSize['color'],
                'product_quantity' => $quantity,
                'product_status' => 'In Stock',
                'created_at' => $datetime,
                'updated_at' => $datetime
            ];
            $insert = $eloquent->insertData('products_sc', $data);
            if ($insert > 0) {
                $toastr->success_toast('Add product detail successfully!', 'Success');
            } else {
                $toastr->error_toast('Add product detail failed!', 'Error');
            }
        }
    }
    if ($check == true) $toastr->warning_toast('Product detail style already exist!', 'Warning');
}
//update product detail
else {
    $data = [
        'product_quantity' => $quantity,
        'product_status' => $productStatus,
        'updated_at' => $datetime
    ];
    $update = $eloquent->updateData('products_sc', $data, ['id' => $idProductSC]);
    if ($update > 0) {
        $toastr->success_toast('Update product detail successfully!', 'Success');
    } else {
        $toastr->error_toast('Update product detail failed!', 'Error');
    }
}
