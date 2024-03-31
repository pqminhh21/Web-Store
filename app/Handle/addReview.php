<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
include '../Controllers/Toastr.php';
include '../../config/site.php';
$toastr = new Toastr();
$eloquent = new Eloquent();

$toastr = new Toastr();
$cusotmer_id = $_SESSION['SSCF_login_id'];
$product_sc_id = $_POST['product_sc_id'];
$order_id = $_POST['order_id'];
$review_detail = $_POST['review_detail'];
$rating = $_POST['rating'];
$id_reivew_check = $_POST['id_reivew_check'];
$datetime = date("Y-m-d H:i:s");

if ($rating == 0) {
    $toastr->error_toast("Bạn chưa vote sao cho shop :((", "THẤT BẠI", "2000");
    exit();
}
else if ($review_detail == "") {
    $toastr->error_toast("Bạn chưa nhập đánh giá :((", "THẤT BẠI", "2000");
    exit();
}

if ($id_reivew_check == "") {
    $tableName = "reviews";
    $columnValue = [
        "customer_id" => $cusotmer_id,
        "product_sc_id" => $product_sc_id,
        "order_id" => $order_id,
        "review_details" => $review_detail,
        "rating" => $rating,
        "created_at" => $datetime,
        "updated_at" => $datetime
    ];
    $review = $eloquent->insertData($tableName, $columnValue);
    if ($review > 0) {
        $toastr->success_toast("Cảm ơn bạn đã đánh giá sản phẩm của shop :)", "THÀNH CÔNG", "2000");
        exit();
    } else {
        $toastr->error_toast("Đánh giá thất bại :((", "THẤT BẠI", "2000");
        exit();
    }
} else {
    $columnValueUpdate = [
        "review_details" => $review_detail,
        "rating" => $rating,
        "updated_at" => $datetime
    ];
    $whereValue = [
        "id" => $id_reivew_check
    ];
    $reviewUpdate = $eloquent->updateData("reviews", $columnValueUpdate, $whereValue);
    $toastr->success_toast("Bạn đã cập nhật đánh giá :)", "THÀNH CÔNG", "2000");
}
