<?php
include '../../config/database.php';
include '../Models/Eloquent.php';
$eloquent = new Eloquent();
$categoryId = $_POST['id'];
$subCategoryList = $eloquent->selectData(['*'], 'subcategories', ['category_id' => $categoryId, 'is_delete' => '0'], [], [], [], ['DESC' => 'id']);
if (count($subCategoryList) != 0) {
    echo '<option class="btn-info" value="">Select a Sub-Category</option>';
    foreach ($subCategoryList as $eachSubCategory) {
        echo '<option value="' . $eachSubCategory['id'] . '">' . $eachSubCategory['subcategory_name'] . '</option>';
    }
} else {
    echo '<option value="">No Sub-Category Found</option>';
}
