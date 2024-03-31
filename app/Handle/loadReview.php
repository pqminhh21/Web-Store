<?php
session_start();
include '../Models/Eloquent.php';
include '../../config/database.php';
include '../../config/site.php';
$arr = array();
$eloquent = new Eloquent();

$reviewItems = $eloquent->selectData(['*'], 'reviews', [
    'customer_id' => $_SESSION['SSCF_login_id'],
    'product_sc_id' => $_POST['product_sc_id'],
    'order_id' => $_POST['order_id']
]);

if ($reviewItems != []){
    $arr['idReview'] = $reviewItems[0]['id'];
    $arr['review_details'] = $reviewItems[0]['review_details'];
    $arr['rating'] = $reviewItems[0]['rating'];
    echo json_encode($arr);
}
else {
    $arr['idReview'] = "";
    $arr['review_details'] = "";
    $arr['rating'] = "";
    echo json_encode($arr);
}
