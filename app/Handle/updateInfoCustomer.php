<?php
include '../Controllers/Toastr.php';
include '../../config/site.php';
$eloquent = new Eloquent();
$arr = array();

$name = $_POST['dname'];
$phone = $_POST['dphone'];
$address = $_POST['address'];
$typefile = explode('.', $_FILES['customer_image']['name']);
$filename = "customer_" . date("YmdHis") . "." . end($typefile);
// echo $_FILES['customer_image']['tmp_name'];
// echo "<br>";
// echo  $_SERVER['DOCUMENT_ROOT'] . '/' . $GLOBALS['CUSTOMER_DIRECTORY'] . $filename;
// die();
if ($_FILES['customer_image']['name'] == "") {
    // echo "ko insert ảnh";
    $data = [
        'customer_name' => $name,
        'customer_mobile' => $phone,
        'customer_address' => $address,
        'updated_at' => date("Y-m-d H:i:s")
    ];
} else {
    // echo "thuc hien insert";
    $data = [
        'customer_name' => $name,
        'customer_mobile' => $phone,
        'customer_address' => $address,
        'customer_image' => $filename,
        'updated_at' => date("Y-m-d H:i:s")
    ];
}
$tableName = "customers";
// $data = [
//     'customer_name' => $name,
//     'customer_mobile' => $phone,
//     'customer_address' => $address,
//     'customer_image' => $filename,
//     'updated_at' => date("Y-m-d H:i:s")
// ];
$whereValue = [
    'id' => $_SESSION['SSCF_login_id']
];
$updateCustomer = $eloquent->updateData($tableName, $data, $whereValue);
if ($updateCustomer > 0) {
    // if ($_FILES['customer_image']['name'] != "" || $_SESSION['SSCF_login_user_image'] != "no-image.png") {
    //     unlink("../../" . $GLOBALS['CUSTOMER_DIRECTORY'] . $_SESSION['SSCF_login_user_image']);
    // }
    if ($_FILES['customer_image']['name'] != "") {
        if ($_SESSION['SSCF_login_user_image'] != "no-image.png")
            unlink("../../" . $GLOBALS['CUSTOMER_DIRECTORY'] . $_SESSION['SSCF_login_user_image']);
        $_SESSION['SSCF_login_user_image'] = $filename;
    }
    $_SESSION['SSCF_login_user_name'] = $name;
    $_SESSION['SSCF_login_user_mobile'] = $phone;
    $_SESSION['SSCF_login_user_address'] = $address;
    move_uploaded_file($_FILES['customer_image']['tmp_name'], "../../" . $GLOBALS['CUSTOMER_DIRECTORY'] . $filename);
    $arr = [
        'type' => 'success',
        'title' => 'THÀNH CÔNG',
        'message' => 'Cập nhật thông tin thành công!',
        'name' => $name,
        'image' => $filename,
        'image_path' => $GLOBALS['CUSTOMER_DIRECTORY'] . $filename,
    ];
    echo json_encode($arr);
} else {
    $arr = [
        'type' => 'error',
        'title' => 'CẢNH BÁO',
        'message' => 'Cập nhật thông tin thất bại!'
    ];
    echo json_encode($arr);
}
