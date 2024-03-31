<?php
session_start();
include '../../config/database.php';
include '../../config/site.php';
include '../Models/Eloquent.php';
include '../Controllers/Controller.php';
include '../Controllers/CategoryController.php';
include '../Controllers/SubCategoryController.php';
include '../Controllers/productController.php';
include '../Controllers/ProductDetailController.php';
include '../Controllers/DiscountController.php';



$eloquent = new Eloquent();

//get list
// $categoryList = $eloquent->selectData(['*'], 'categories');
// $subCategoryList = $eloquent->selectData(['*'], 'subcategories');
// $productList = $eloquent->selectData(['*'], 'products');



$id = $_POST['id'];
$tableName = $_POST['tableName'];

if ($tableName == 'categories') {
    $check = $eloquent->checkUpdateIsDeleteCategory($id);
    if ($check == true) {
        echo "categories";
        exit();
    } else {
        $deleteData = $eloquent->updateData($tableName, ['is_delete' => 1], ['id' => $id]);
        $categoryList = $eloquent->selectData(['*'], 'categories', ['is_delete' => '0', 'category_status' => 'active']);
        $categoryShow = new CategoryController();
        $categoryShow->CategoryList($categoryList);
    }
} else if ($tableName == 'subcategories') {
    // $item = $eloquent->selectData(['*'], 'subcategories', ['id' => $id]);
    // $oldImage = $item[0]['subcategory_banner'];
    // unlink('../../'.$GLOBALS['BANNER_DIRECTORY'].$oldImage);
    $check = $eloquent->checkUpdateIsDeleteSubCategory($id);
    if ($check == true) {
        echo "subcategories";
        exit();
    } else {
        $deleteData = $eloquent->updateData($tableName, ['is_delete' => '1'], ['id' => $id]);
        $subCategoryList = $eloquent->selectSubCategory();
        $subcategoryShow = new SubCategoryController();
        $subcategoryShow->SubCategoryList($subCategoryList);    
    }
} else if ($tableName == 'products') {
    $check = $eloquent->checkUpdateIsDeleteProduct($id);
    if ($check == true) {
        echo "products";
        exit();
    } else {
        $deleteData = $eloquent->updateData($tableName, ['is_delete' => 1], ['id' => $id]);
        $productList = $eloquent->selectProduct();
        $productShow = new ProductController();
        $productShow->ProductList($productList);    
    }
} else if ($tableName == 'products_sc') {
    $deleteData = $eloquent->updateData($tableName, ['is_delete' => 1], ['id' => $id]);
    $productSCList = $eloquent->selectData(['*'], 'products_sc', ['product_id' => $_SESSION['product_id'], 'is_delete' => '0']);
    $productSCShow = new ProductDetailController();
    $productSCShow->ProductDetailList($productSCList);
} else if ($tableName == 'discounts') {
    $deleteData = $eloquent->updateData($tableName, ['is_delete' => 1], ['id' => $id]);
    $discountList = $eloquent->selectData(['*'], 'discounts', ['is_delete' => 0]);
    $discountShow = new DiscountController();
    $discountShow->DiscountList($discountList);
}

?>

<script src="public/js/main.js"></script>