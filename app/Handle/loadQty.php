<?php
session_start();
include '../Models/Eloquent.php';
include '../../config/database.php';
include '../../config/site.php';

$eloquent = new Eloquent();
$idProductsSC = "";

$color = $_POST['color'];
$size = $_POST['size'];
$product_id = $_POST['product_id'];

//check
if ($color == ""){
    echo "<p class=\"text-danger\">Bạn chưa chọn màu 🤔</p>";
    exit();
}
if ($size == ""){
    echo "<p class=\"text-danger\">Bạn chưa chọn size 🤔</p>";
    exit();
}

if (isset($_POST['color']) && isset($_POST['size']) && isset($_POST['product_id'])) {
    echo "Màu: " . $_POST['color'] . ", size: " . $_POST['size'];
    echo "<br>";

    $columnName = ['*'];
    $tableName = 'products_sc';
    $whereValue = [
        'product_id' => $_POST['product_id'],
        'product_color' => $_POST['color'],
        'product_size' => $_POST['size'],
        'is_delete' => '0'
    ];
    $productItem = $eloquent->selectData($columnName, $tableName, $whereValue);
    if ($productItem != []) {
        $productQuantity = $productItem[0]['product_quantity'];
        if ($productQuantity > 0) {
            // echo "<p class=\"text-success\">Số lượng sản phẩm trong kho: $productQuantity &#10004;</p>";
            //$idProductsSC = $eloquent->selectData(['id'], 'products_sc', ['product_id' => $_POST['product_id'], 'product_color' => $_POST['color'], 'product_size' => $_POST['size']]);
            $idProductsSC = $productItem[0]['id'];
            echo "<input type=\"hidden\" id=\"idProductsSC\" value=\"$idProductsSC\">";
            exit();
        } else echo "<p class=\"text-danger\">Sản phẩm đã hết hàng 🤔</p>";
    } else echo "<p class=\"text-danger\">Sản phẩm đã hết hàng 🤔</p>";
} else echo "<p class=\"text-danger\">Bạn chưa chọn size hoặc màu 🤔</p>";
echo "<input type=\"hidden\" id=\"idProductsSC\" value=\"$idProductsSC\">";
