<?php
include '../../config/database.php';
include '../Controllers/Toastr.php';
include '../Models/Eloquent.php';
$toastr = new Toastr();
$eloquent = new Eloquent();
$orderId = $_POST['id'];
$transaction = $_POST['transaction'];
$status = $_POST['status'];

//update order
$data = [
    'transaction_status' => $transaction,
    'order_item_status' => $status,
    'updated_at' => date('Y-m-d H:i:s')
];
$updateOrder = $eloquent->updateData('orders', $data, ['id' => $orderId]);
$toastr->success_toast('Update order success!', 'Success');


