<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VNPAY RESPONSE</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="assets/jquery-1.11.3.min.js"></script>
</head>

<body>
    <?php
    require_once("./config.php");
    $eloquent = new Eloquent();
    $vnp_SecureHash = $_GET['vnp_SecureHash'];
    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }

    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
    }

    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

    //INSERT orders
    $tableName = "orders";
    $dataOrders = [
        'customer_id' => $_SESSION['SSCF_login_id'],
        'order_date' => date('Y-m-d H:i:s'),
        'sub_total' => $_SESSION['priceSub'],
        'delivery_charge' => $_SESSION['priceShip'],
        'discount_amount' => $_SESSION['priceDiscount'],
        'grand_total' => $_SESSION['priceTotal'],
        'payment_method' => 'VNPAY',
        'transaction_id' => $_GET['vnp_TransactionNo'],
        'transaction_status' => 'Paid',
        'order_item_status' => 'Pending',
    ];
    ?>
    <!--Begin display -->
    <div class="container">
        <div class="header clearfix">
            <h3 class="text-muted">VNPAY RESPONSE</h3>
        </div>
        <div class="table-responsive">
            <div class="form-group">
                <label>Mã đơn hàng:</label>

                <label><?php echo $_GET['vnp_TxnRef'] ?></label>
            </div>
            <div class="form-group">

                <label>Số tiền:</label>
                <label><?php echo number_format($_GET['vnp_Amount'] / 100, 0, ",", ".") . "&#8363;" ?></label>
            </div>
            <div class="form-group">
                <label>Nội dung thanh toán:</label>
                <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã phản hồi (vnp_ResponseCode):</label>
                <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã GD Tại VNPAY:</label>
                <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã Ngân hàng:</label>
                <label><?php echo $_GET['vnp_BankCode'] ?></label>
            </div>
            <div class="form-group">
                <label>Thời gian thanh toán:</label>
                <label><?php echo $_GET['vnp_PayDate'] ?></label>
            </div>
            <div class="form-group">
                <label>Kết quả:</label>
                <label>
                    <?php
                    $order_id = $_GET['vnp_TxnRef'];
                    $transaction_id = $_GET['vnp_TransactionNo'];
                    if ($secureHash == $vnp_SecureHash) {
                        if ($_GET['vnp_ResponseCode'] == '00') {
                            echo "<span style='color:blue'>GD Thanh cong</span>";
                            echo "<a class='btn' style='border: 10px; background: #7ced71; color: #fff; margin-left: 20px;' href='../../../status.php'>&#10148;Về trang thông báo</a>";
                            if ($_SESSION['LIST_PRODUCT_CART'] != []) {
                                //INSERT 1 row into orders
                                $lastInsertOrderId = $eloquent->insertData($tableName, $dataOrders);
                                if ($lastInsertOrderId > 0) {
                                    //INSERT order_items
                                    $dataOrderItems = $_SESSION['LIST_PRODUCT_CART'];
                                    // print_r($dataOrderItems);
                                    $tableName = "order_items";
                                    foreach ($dataOrderItems as $orderItem) {
                                        $dataOrderItem = [
                                            'customer_id' => $_SESSION['SSCF_login_id'],
                                            'product_sc_id' => $orderItem['idProductSC'],
                                            'order_id' => $lastInsertOrderId,
                                            'product_price' => $orderItem['product_price'],
                                            'product_quantity' => $orderItem['quantity'],
                                        ];
                                        $eloquent->insertData($tableName, $dataOrderItem);
                                    }

                                    //INSERT shippings
                                    $tableName = "shippings";
                                    $dataShippings = [
                                        'order_id' => $lastInsertOrderId,
                                        'customer_id' => $_SESSION['SSCF_login_id'],
                                        'shipping_name' => $_SESSION['lfname-session'],
                                        'shipping_email' => $_SESSION['email-session'],
                                        'shipping_phone' => $_SESSION['phone-session'],
                                        'shipping_address' => $_SESSION['address-session'],
                                        'shipping_city' => $_SESSION['address-city-session'],
                                        'shipping_zipcode' => $_SESSION['zipcode-session'],
                                        // 'shipping_country' => $_POST['shipping_country'],
                                        'shipping_note' => $_SESSION['note-session'],
                                    ];
                                    $eloquent->insertData($tableName, $dataShippings);

                                    //INSERT invoices
                                    $tableName = "invoices";
                                    $dataInvoices = [
                                        'invoice_id' => $_GET['vnp_TxnRef'],
                                        'customer_id' => $_SESSION['SSCF_login_id'],
                                        'order_id' => $lastInsertOrderId,
                                        'transaction_amount' => $_SESSION['priceTotal'],
                                        'created_at' => date('Y-m-d H:i:s'),
                                    ];
                                    $eloquent->insertData($tableName, $dataInvoices);

                                    //update coupon
                                    if ($_SESSION['PRICE_DISCOUNT_AMOUNT'] > 0) {
                                        $tableName = "coupons";
                                        $dataCoupons = [
                                            'is_use' => '1',
                                            'updated_at' => date('Y-m-d H:i:s'),
                                        ];
                                        $condition = [
                                            'customer_id' => $_SESSION['SSCF_login_id'],
                                            'discount_id' => $_SESSION['DISCOUNT_ID'],
                                        ];
                                        $eloquent->updateData($tableName, $dataCoupons, $condition);
                                    }
                                    // echo '<script>window.location="status.php"</script>';
                                }
                            }
                        } else {
                            echo "<span style='color:red'>GD Khong thanh cong</span>";
                            echo "<a class='btn' style='border: 10px; background: #ea2626; color: #fff; margin-left: 20px;' href='../../../checkout.php'>&#10148;Về trang thanh toán </a>";
                        }
                    } else {
                        echo "<span style='color:red'>Chu ky khong hop le</span>";
                    }
                    ?>

                </label>
            </div>
        </div>
        <p>
            &nbsp;
        </p>
        <footer class="footer">
            <p>&copy; VNPAY <?php echo date('Y') ?></p>
        </footer>
    </div>
</body>

</html>