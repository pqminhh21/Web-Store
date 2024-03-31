<?php
include '../Controllers/Toastr.php';
$eloquent = new Eloquent();
$arr = array();

$current_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

if ($current_password == "") {
    $arr = [
        'type' => "error",
        'title' => "CẢNH BÁO",
        'message' => "Vui lòng nhập mật khẩu hiện tại"
    ];
    echo json_encode($arr);
    exit();
} else if ($current_password != $_SESSION['SSCF_login_user_password']){
    $arr = [
        'type' => "error",
        'title' => "CẢNH BÁO",
        'message' => "Mật khẩu hiện tại không đúng"
    ];
    echo json_encode($arr);
    exit();
} else if ($new_password == "") {
    $arr = [
        'type' => "error",
        'title' => "CẢNH BÁO",
        'message' => "Vui lòng nhập mật khẩu mới"
    ];
    echo json_encode($arr);
    exit();
} else if ($confirm_password == "") {
    $arr = [
        'type' => "error",
        'title' => "CẢNH BÁO",
        'message' => "Vui lòng nhập lại mật khẩu mới"
    ];
    echo json_encode($arr);
    exit();
} else if ($new_password != $confirm_password) {
    $arr = [
        'type' => "error",
        'title' => "CẢNH BÁO",
        'message' => "Mật khẩu mới không khớp"
    ];
    echo json_encode($arr);
    exit();
} else {
    $tableName = "customers";
    $columnValue = [
        'customer_password' => sha1($new_password)
    ];
    $whereValue = [
        'id' => $_SESSION['SSCF_login_id']
    ];
    $updatePassword = $eloquent->updateData($tableName, $columnValue, $whereValue);
    if ($updatePassword > 0) {
        $_SESSION['SSCF_login_user_password'] = $new_password;
        $arr = [
            'type' => "success",
            'title' => "THÀNH CÔNG",
            'message' => "Đổi mật khẩu thành công",
            'password' => $new_password
        ];
        echo json_encode($arr);
        exit();
    }
}