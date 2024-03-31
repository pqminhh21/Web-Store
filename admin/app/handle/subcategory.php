<?php
include '../../config/database.php';
include '../Controllers/Toastr.php';
include '../Models/Eloquent.php';
include '../../config/site.php';
$toastr = new Toastr();
$eloquent = new Eloquent();

$id = $_POST['id-subcategory'];
$name = $_POST['val-subcategory-name'];
$category_id = $_POST['val-category-id'];
$status = $_POST['val-status'];
$datetime = date('Y-m-d H:i:s');
$typefile = explode('.', $_FILES['val-image']['name']);
$filename = "subcategory_banner_" . date("YmdHis") . "." . end($typefile);

if ($name == '') {
    $toastr->error_toast("Subcategory name is required", "FAILED");
    exit();
}

if ($id == '') {
    // add subcategory
    if ($_FILES['val-image']['name'] == '') {
        $toastr->error_toast("Subcategory banner is required", "FAILED");
        exit();
    }
    $checkSubcategory = $eloquent->selectData(['*'], 'subcategories', ['subcategory_name' => $name, 'is_delete' => '0']);
    if (count($checkSubcategory) > 0) {
        $toastr->error_toast("Subcategory name already exists", "FAILED");
        exit();
    }
    $addSubcategory = $eloquent->insertData('subcategories', [
        'category_id' => $category_id,
        'subcategory_name' => $name,
        'subcategory_status' => $status,
        'subcategory_banner' => $filename,
        'created_at' => $datetime,
        'updated_at' => $datetime
    ]);
    if ($addSubcategory > 0) {
        move_uploaded_file($_FILES['val-image']['tmp_name'], '../../'.$GLOBALS['BANNER_DIRECTORY'] . $filename);
        $toastr->success_toast("Add subcategory successfully", "SUCCESS");
    } else {
        $toastr->error_toast("Add subcategory failed", "FAILED");
    }
} else {
    // update subcategory
    $checkSubcategory = $eloquent->checkExistData('subcategories', $id, 'subcategory_name', $name);
    if ($checkSubcategory) {
        $toastr->error_toast("Subcategory name already exists", "FAILED");
        exit();
    }
    if ($_FILES['val-image']['name'] == ''){
        // not update banner
        $updateSubcategory = $eloquent->updateData('subcategories', ['category_id' => $category_id, 'subcategory_name' => $name, 'subcategory_status' => $status, 'updated_at' => $datetime], ['id' => $id]);
        if ($updateSubcategory > 0) {
            $toastr->success_toast("Update subcategory successfully", "SUCCESS");
        } else {
            $toastr->error_toast("Update subcategory failed", "FAILED");
        }
    } else {
        // update banner
        $updateSubcategory = $eloquent->updateData('subcategories', ['category_id' => $category_id, 'subcategory_name' => $name, 'subcategory_status' => $status, 'subcategory_banner' => $filename, 'updated_at' => $datetime], ['id' => $id]);
        if ($updateSubcategory > 0) {
            unlink('../../'.$GLOBALS['BANNER_DIRECTORY'] . $_POST['old-image']);
            move_uploaded_file($_FILES['val-image']['tmp_name'], '../../'.$GLOBALS['BANNER_DIRECTORY'] . $filename);
            $toastr->success_toast("Update subcategory successfully", "SUCCESS");
        } else {
            $toastr->error_toast("Update subcategory failed", "FAILED");
        }
    }
}
