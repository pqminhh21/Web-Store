<?php
include '../../config/database.php';
include '../Controllers/Toastr.php';
include '../Models/Eloquent.php';
include '../../config/site.php';
$toastr = new Toastr();
$eloquent = new Eloquent();

// check condition
if ($_POST['val-category-id'] == '') {
    $toastr->error_toast("Category is required", "FAILED");
    exit();
} else if ($_POST['val-sub-category-id'] == '') {
    $toastr->error_toast("Subcategory is required", "FAILED");
    exit();
}


$str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$datetime = date('Y-m-d H:i:s');
$arrImage = $_FILES['val-product-images'];
$productId = $_POST['val-product-id'];
$categoryId = $_POST['val-category-id'];
$subcategoryId = $_POST['val-sub-category-id'];
$productName = $_POST['val-product-name'];
$productPrice = $_POST['val-product-price'];
$productPriceVirtual = $_POST['val-product-price-virtual'];
$productTag = $_POST['val-product-tag'];
$productFeatured = $_POST['val-type-featured'];
$productStatus = $_POST['val-type-status'];
$productSummary = $_POST['val-product-summary'];
$productDetail = $_POST['val-product-detail'];
$lenghtFileImage = count($arrImage['name']);

// $imageMaster = "product_master_" . date("Ymd") . substr(str_shuffle($str), 0, 5) . substr($arrImage['name'][0], strrpos($arrImage['name'][0], "."));
// $imageOne = "product_one_" . date("Ymd") . substr(str_shuffle($str), 0, 5) . substr($arrImage['name'][1], strrpos($arrImage['name'][1], "."));
// $imageTwo = "product_two_" . date("Ymd") . substr(str_shuffle($str), 0, 5) . substr($arrImage['name'][2], strrpos($arrImage['name'][2], "."));
// $imageThree = "product_three_" . date("Ymd") . substr(str_shuffle($str), 0, 5) . substr($arrImage['name'][3], strrpos($arrImage['name'][3], "."));

if ($productId == '') {
    //add product
    $checkProduct = $eloquent->selectData(['*'], 'products', ['product_name' => $productName, 'is_delete' => '0']);
    if (count($checkProduct) > 0) {
        $toastr->error_toast("Product name already exists", "FAILED");
        exit();
    }
    //check quantity image
    if (count($_FILES['val-product-images']['name']) < 4) {
        $toastr->error_toast("You must select more than 4 image files", "FAILED");
        exit();
    }

    //chekc exist product name
    $checkProduct = $eloquent->selectData(['*'], 'products', ['product_name' => $productName]);
    if (count($checkProduct) > 0) {
        $toastr->error_toast("Product name already exists", "FAILED");
        exit();
    }
    
    $image0 = "product_master_" . date("Ymd") . substr(str_shuffle($str), 0, 5) . substr($arrImage['name'][0], strrpos($arrImage['name'][0], "."));
    $image1 = "product_one_" . date("Ymd") . substr(str_shuffle($str), 0, 5) . substr($arrImage['name'][1], strrpos($arrImage['name'][1], "."));
    $image2 = "product_two_" . date("Ymd") . substr(str_shuffle($str), 0, 5) . substr($arrImage['name'][2], strrpos($arrImage['name'][2], "."));
    $image3 = "product_three_" . date("Ymd") . substr(str_shuffle($str), 0, 5) . substr($arrImage['name'][3], strrpos($arrImage['name'][3], "."));
    $data = [
        'category_id' => $categoryId,
        'subcategory_id' => $subcategoryId,
        'product_name' => $productName,
        'product_summary' => $productSummary,
        'product_details' => $productDetail,
        'product_master_image' => $image0,
        'product_image_one' => $image1,
        'product_image_two' => $image2,
        'product_image_three' => $image3,
        'product_price' => $productPrice,
        'virtual_price' => $productPriceVirtual,
        'product_tags' => $productTag,
        'product_featured' => $productFeatured,
        'product_type' => $productStatus,
        'created_at' => $datetime,
        'updated_at' => $datetime
    ];
    $addProduct = $eloquent->insertData('products', $data);
    if ($addProduct > 0){
        for ($i=0; $i < 4; $i++) { 
            move_uploaded_file($arrImage['tmp_name'][$i], '../../' . $GLOBALS['PRODUCT_DIRECTORY'] . ${'image' . $i});
        }
        $toastr->success_toast("Product added successfully", "SUCCESS");
        exit();
    } else {
        $toastr->error_toast("Failed to add product", "FAILED");
        exit();
    }
} else {
    //edit product
    $checkProduct = $eloquent->checkExistData('products', $productId, 'product_name', $productName);
    if ($checkProduct) {
        $toastr->error_toast("Product name already exists", "FAILED");
        exit();
    }

    //chekc exist product name
    $checkProduct = $eloquent->checkExistData('products', $productId, 'product_name', $productName);
    if ($checkProduct) {
        $toastr->error_toast("Product name already exists", "FAILED");
        exit();
    }

    if ($_FILES['val-product-images']['name'][0] == ''){
        //update product without image
        $data = [
            'category_id' => $categoryId,
            'subcategory_id' => $subcategoryId,
            'product_name' => $productName,
            'product_summary' => $productSummary,
            'product_details' => $productDetail,
            'product_price' => $productPrice,
            'virtual_price' => $productPriceVirtual,
            'product_tags' => $productTag,
            'product_featured' => $productFeatured,
            'product_type' => $productStatus,
            'updated_at' => $datetime
        ];
        $condition = [
            'id' => $productId
        ];
        $updateProduct = $eloquent->updateData('products', $data, $condition);
        if ($updateProduct > 0){
            $toastr->success_toast("Product updated successfully", "SUCCESS");
            exit();
        } else {
            $toastr->error_toast("Failed to update product", "FAILED");
            exit();
        }
    } else{
        //update product with image
        if (count($_FILES['val-product-images']['name']) < 4) {
            $toastr->error_toast("You must select more than 4 image files", "FAILED");
            exit();
        }
        $image0 = "product_master_" . date("Ymd") . substr(str_shuffle($str), 0, 5) . substr($arrImage['name'][0], strrpos($arrImage['name'][0], "."));
        $image1 = "product_one_" . date("Ymd") . substr(str_shuffle($str), 0, 5) . substr($arrImage['name'][1], strrpos($arrImage['name'][1], "."));
        $image2 = "product_two_" . date("Ymd") . substr(str_shuffle($str), 0, 5) . substr($arrImage['name'][2], strrpos($arrImage['name'][2], "."));
        $image3 = "product_three_" . date("Ymd") . substr(str_shuffle($str), 0, 5) . substr($arrImage['name'][3], strrpos($arrImage['name'][3], "."));

        $imageOld0 = $_POST['val-product-master-image-old'];
        $imageOld1 = $_POST['val-product-image-one-old'];
        $imageOld2 = $_POST['val-product-image-two-old'];
        $imageOld3 = $_POST['val-product-image-three-old'];
        $data = [
            'category_id' => $categoryId,
            'subcategory_id' => $subcategoryId,
            'product_name' => $productName,
            'product_summary' => $productSummary,
            'product_details' => $productDetail,
            'product_master_image' => $image0,
            'product_image_one' => $image1,
            'product_image_two' => $image2,
            'product_image_three' => $image3,
            'product_price' => $productPrice,
            'virtual_price' => $productPriceVirtual,
            'product_tags' => $productTag,
            'product_featured' => $productFeatured,
            'product_type' => $productStatus,
            'updated_at' => $datetime
        ];
        $condition = [
            'id' => $productId
        ];
        $updateProduct = $eloquent->updateData('products', $data, $condition);
        if ($updateProduct > 0){
            for ($i=0; $i < 4; $i++) { 
                unlink('../../' . $GLOBALS['PRODUCT_DIRECTORY'] . ${'imageOld' . $i});
                move_uploaded_file($arrImage['tmp_name'][$i], '../../' . $GLOBALS['PRODUCT_DIRECTORY'] . ${'image' . $i});
            }
            $toastr->success_toast("Product updated successfully", "SUCCESS");
            exit();
        } else {
            $toastr->error_toast("Failed to update product", "FAILED");
            exit();
        }
    }
}
