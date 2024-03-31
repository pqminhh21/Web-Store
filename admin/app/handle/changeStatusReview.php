<?php
include '../../config/database.php';
include '../Controllers/Toastr.php';
include '../Models/Eloquent.php';

$toastr = new Toastr();
$eloquent = new Eloquent();
$id = $_POST['id'];
$status = $_POST['status'];
$changeStatus = $eloquent->updateData('reviews', ['review_status' => $status], ['id' => $id]);
if ($changeStatus > 0)
    echo $toastr->success_toast("change status successfully", "SUCCESS");
else
    echo $toastr->error_toast("change status failed", "FAILED");
