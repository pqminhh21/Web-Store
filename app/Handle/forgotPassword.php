<?php
include '../Controllers/Toastr.php';
include '../../config/server.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../../vendor/PHPMailer/src/Exception.php';
require '../../vendor/PHPMailer/src/PHPMailer.php';
require '../../vendor/PHPMailer/src/SMTP.php';


$toastr = new Toastr();
$eloquent = new Eloquent();

$email = $_POST['user_email'];

//check form email
if ($email == "") {
    $toastr->warning_toast("Vui lòng nhập email!", "Thông báo", "2000");
    exit();
}
if (strpos($email, '@') == false) {
    $toastr->error_toast("Email không hợp lệ!", "Thông báo", "2000");
    exit();
}

$checkEmail = $eloquent->selectData(['id', 'customer_name', 'customer_email'], 'customers', ['customer_email' => $email]);
if ($checkEmail == []) {
    $toastr->error_toast("Email không tồn tại!", "Thông báo", "2000");
    exit();
} else {
    $idCustomer = $checkEmail[0]['id'];
    $nameCustomer = $checkEmail[0]['customer_name'];
    $emailCustomer = $checkEmail[0]['customer_email'];

    $newPassword = rand(100000, 999999);
    $token = sha1($newPassword);
    $data = [
        'customer_password' => $token,
    ];
    // $updatePassword = $eloquent->updateData('customers', $data, ['id' => $idCustomer]);
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $GLOBALS['SMTPHOST'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $GLOBALS['SMTPUSER'];                     //SMTP username
        $mail->Password   = $GLOBALS['SMTPPASS'];                               //SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->SMTPSecure = $GLOBALS['SMTPSECURE'];            //Enable implicit TLS encryption
        $mail->Port       = $GLOBALS['SMTPPORT'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('laptrinhvlog3863@gmail.com', 'ThoiTrang Store');
        $mail->addAddress($emailCustomer, $nameCustomer);     //Add a recipient
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Hello Store - Password Reset';
        $mail->Body    = 'Mật khẩu mới của bạn là: ' . $newPassword . '<br> Vui lòng đăng nhập và đổi mật khẩu mới!';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if ($mail->send()) {
            $updatePassword = $eloquent->updateData('customers', $data, ['id' => $idCustomer]);
            $toastr->success_toast("Vui lòng kiểm tra email để lấy lại mật khẩu!", "Thông báo", "2000");
        }
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $toastr->error_toast("Gửi mail thất bại!", "Thông báo", "2000");
    }
}
