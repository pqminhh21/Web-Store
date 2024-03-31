<?php
$eloquent = new Eloquent();

//get shipping last info
$lastShippings = $eloquent->selectData(['*'], 'shippings', ['customer_id' => $_SESSION['SSCF_login_id']], [], [], [], ['DESC' => 'id'], ['START' => 0, 'END' => 1]);
if ($lastShippings != []) $lastShipping = $lastShippings[0];
else $lastShipping = [];

if (isset($_POST['submit'])) {
    //INSERT orders
    $tableName = "orders";
    $dataOrders = [
        'customer_id' => $_SESSION['SSCF_login_id'],
        'order_date' => date('Y-m-d H:i:s'),
        'sub_total' => $_SESSION['priceSub'],
        'delivery_charge' => $_SESSION['priceShip'],
        'discount_amount' => $_SESSION['priceDiscount'],
        'grand_total' => $_SESSION['priceTotal'],
        // 'payment_method' => 'COD',
        'transaction_id' => 'COD' . date('YmdHis'),
        'transaction_status' => 'Unpaid',
        'order_item_status' => 'Pending',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
    $lastInsertOrderId = $eloquent->insertData($tableName, $dataOrders);
    if ($lastInsertOrderId > 0) {
        //INSERT order_items
        $dataOrderItems = $_SESSION['LIST_PRODUCT_CART'];
        // print_r($dataOrderItems);
        $tableName = "order_items";
        if ($dataOrderItems != [])
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
            'shipping_name' => $_POST['lfname'],
            'shipping_email' => $_POST['email'],
            'shipping_phone' => $_POST['phone'],
            'shipping_address' => $_POST['address'],
            'shipping_city' => $_POST['address-city'],
            'shipping_zipcode' => $_POST['zipcode'],
            // 'shipping_country' => $_POST['shipping_country'],
            'shipping_note' => $_POST['note'],
        ];
        $eloquent->insertData($tableName, $dataShippings);

        //INSERT invoices
        $tableName = "invoices";
        $dataInvoices = [
            'invoice_id' => date('YmdHis'),
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

        echo '<script>window.location="status.php"</script>';
    }
}

if (isset($_POST['vppay'])) {
    // echo '<script>window.location="app/Handle/VnPay/vnpay_pay.php"</script>';
    // header('Location: app/Handle/VnPay/vnpay_pay.php');
    echo "hihi";
}
?>

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php" rel="nofollow">Trang chủ</a>
                <a href="product-category.php"><span></span>Sản phẩm</a>
                <a href="cart.php"><span></span>Giỏ hàng</a>
                <span></span> Thanh toán
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <form action="" method="POST" class="row">
                <div class="col-md-6 order_review">
                    <div class="mb-25">
                        <h4>Thông tin người nhận</h4>
                    </div>
                    <div>
                        <div class="form-group">
                            <input type="text" required="" class="lfname-session" name="lfname" placeholder="Họ & Tên *" value="<?= $_SESSION['SSCF_login_user_name'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="email" required="" class="email-session" name="email" placeholder="Email *" value="<?= $_SESSION['SSCF_login_user_email'] ?>">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" class="phone-session" name="phone" placeholder="Số điện thoại *" value="<?= $_SESSION['SSCF_login_user_mobile'] ?>">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" class="address-session" name="address" placeholder="Địa chỉ *" value="<?= $lastShipping != [] ? $lastShipping['shipping_address'] : "" ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="address-city-session" name="address-city" required="" placeholder="Thành Phố *" value="<?= $lastShipping != [] ? $lastShipping['shipping_city'] : "" ?>">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" class="zipcode-session" name="zipcode" placeholder="Mã bưu chính(ZIP) *" value="<?= $lastShipping != [] ? $lastShipping['shipping_zipcode'] : "" ?>">
                        </div>
                        <div class="mb-20">
                            <h5>Ghi chú</h5>
                        </div>
                        <div class="form-group mb-30">
                            <textarea name="note" rows="5" class="note-session" placeholder="Nhập điều gì đó ..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="order_review">
                        <div class="mb-20">
                            <h4>Đơn hàng của bạn</h4>
                        </div>
                        <div class="table-responsive order_table text-center">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Sản phẩm</th>
                                        <th>Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $productListCart = $_SESSION['LIST_PRODUCT_CART'];
                                    if ($productListCart != [])
                                        foreach ($productListCart as $eachProduct) {
                                            $productImageItem = $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_master_image'];
                                    ?>
                                        <tr>
                                            <td class="image product-thumbnail"><img src="<?= $productImageItem ?>" alt="#"></td>
                                            <td>
                                                <h5>
                                                    <a href="product-details.php?id=<?= $eachProduct['id'] ?>">
                                                        <?= $eachProduct['product_name'] ?>
                                                    </a>
                                                </h5>
                                                <h5>
                                                    Size: <?= $eachProduct['product_size'] ?> | Màu: <?= $eachProduct['product_color'] ?>
                                                </h5>
                                                <span class="product-qty">x <?= $eachProduct['quantity'] ?></span>
                                            </td>
                                            <td><?= number_format($eachProduct['product_price'] * $eachProduct['quantity'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></td>
                                        </tr>
                                    <?php
                                        }
                                    else {
                                        echo '<tr><td colspan="3" class="text-brand">Không có sản phẩm nào trong giỏ hàng</td></tr>';
                                    }
                                    ?>

                                    <tr>
                                        <th>Tổng tiền hàng</th>
                                        <td class="product-subtotal" colspan="2">
                                            <?= number_format($_SESSION['priceSub'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Phí vận chuyển</th>
                                        <td colspan="2">
                                            <?= number_format($_SESSION['priceShip'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Giảm giá</th>
                                        <td colspan="2">
                                            <?= number_format($_SESSION['priceDiscount'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tổng thanh toán</th>
                                        <td colspan="2" class="product-subtotal">
                                            <span class="font-xl text-brand fw-900">
                                                <?= number_format($_SESSION['priceTotal'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                        <div class="payment_method">
                            <div class="mb-25">
                                <h4>Thanh toán</h4>
                            </div>
                            <div class="payment_option">
                                <table>
                                    <tr>
                                        <td>Cod</td>
                                        <td id="payment-cod"><button style="border: 0;"><img style="width:50px;" src="public/assets/imgs/payment_cod.png" alt=""></button></td>
                                    </tr>
                                    <tr>
                                        <td>VNPAY</td>
                                        <!-- <td><a href="app/Handle/VnPay/vnpay_pay.php"><img src="https://pay.vnpay.vn/images/brands/logo-en.svg" alt=""></a></td> -->
                                        <td id="payment-vnpay">
                                            <button style="border: 0;" name="vppay"><img src="https://pay.vnpay.vn/images/brands/logo-en.svg" alt=""></button>
                                        </td>
                                    </tr>
                                </table>
                                <div class="text-brand choice-payment-cod">Vui lòng chọn phương thức thanh toán</div>
                            </div>
                        </div>
                        <button name="submit" class="btn btn-fill-out btn-block mt-30 book_now <?= $_SESSION['priceSub'] == 0 ? "d-none" : "" ?>">Đặt ngay!</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>