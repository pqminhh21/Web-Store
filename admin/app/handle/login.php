<?php
session_start();
include '../../config/database.php';
include '../Controllers/Toastr.php';
include '../Models/Eloquent.php';
$toastr = new Toastr();
$eloquent = new Eloquent();

$email = $_POST['email'];
$password = $_POST['password'];

if ($email == '' || $password == '') {
    $toastr->warning_toast('Email or password is empty!', 'Warning');
    exit();
}

$checkAccount = $eloquent->selectData(['*'], 'admins', ['admin_email' => $email, 'admin_password' => $password]);
if ($checkAccount == []) {
    $toastr->error_toast('Email or password is incorrect!', 'Error');
    exit();
} else{
    $_SESSION['admin_id'] = $checkAccount[0]['id']; 
    $_SESSION['admin_name'] = $checkAccount[0]['admin_name'];
    $_SESSION['admin_email'] = $checkAccount[0]['admin_email'];
    $_SESSION['admin_password'] = $checkAccount[0]['admin_password'];
    echo 'dashboard.php';
}