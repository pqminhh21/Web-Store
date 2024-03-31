<?php
include '../../config/database.php';
include '../Controllers/Toastr.php';
include '../Models/Eloquent.php';
$toastr = new Toastr();
$eloquent = new Eloquent();

$id = $_POST['id'];
$name = $_POST['name'];
$status = $_POST['status'];
$datetime = date('Y-m-d H:i:s');
if ($name == ''){
    $toastr->error_toast("Category name is required", "FAILED");
    exit();
}

if ($id == ''){
    // add category
    $checkCategory = $eloquent->selectData(['*'], 'categories', ['category_name' => $name, 'is_delete' => '0']);
    if (count($checkCategory) > 0){
        $toastr->error_toast("Category name already exists", "FAILED");
        exit();
    }
    $addCategory = $eloquent->insertData('categories', ['category_name' => $name, 'category_status' => $status, 'created_at' => $datetime, 'updated_at' => $datetime]);
    if ($addCategory > 0)
        $toastr->success_toast("Add category successfully", "SUCCESS");
    else
        $toastr->error_toast("Add category failed", "FAILED");
} else {
    // update category
    $checkCategory = $eloquent->checkExistData('categories', $id, 'category_name', $name);
    if ($checkCategory){
        $toastr->error_toast("Category name already exists", "FAILED");
        exit();
    }
    $updateCategory = $eloquent->updateData('categories', ['category_name' => $name, 'category_status' => $status, 'updated_at' => $datetime], ['id' => $id]);
    if ($updateCategory > 0)
        $toastr->success_toast("Update category successfully", "SUCCESS");
    else
        $toastr->error_toast("Update category failed", "FAILED");
}

