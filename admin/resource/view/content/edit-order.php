<?php
$eloquent = new Eloquent;
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = $_GET['id'];
    $orderDetailArr = $eloquent->getOrderDetail($id);
    if ($orderDetailArr == []){
        echo "<script>window.location.href = 'page404.php';</script>";
    }
    $orderDetail = $orderDetailArr[0];
    $customerName = $orderDetail['customer_name'];
    $orderDate = $orderDetail['order_date'];
    $subTotal = number_format($orderDetail['sub_total'], 0, ',', '.') . $GLOBALS['CURRENCY'];
    $deliveryCharge = number_format($orderDetail['delivery_charge'], 0, ',', '.') . $GLOBALS['CURRENCY'];
    $discountAmount = number_format($orderDetail['discount_amount'], 0, ',', '.') . $GLOBALS['CURRENCY'];
    $grandTotal = number_format($orderDetail['grand_total'], 0, ',', '.') . $GLOBALS['CURRENCY'];
    $paymentMethod = $orderDetail['payment_method'];
    $transactionStatus = $orderDetail['transaction_status'];
    $orderStatus = $orderDetail['order_item_status'];

    $disabled = $paymentMethod == 'Cash On Delivery' ? '' : 'disabled';
} else {
    // header('Location: order.php');
    echo "<script>window.location.href = 'order.php';</script>";
}
$transactionStatusArr = ['Paid', 'Unpaid'];
$orderStatusArr = ['Pending', 'Processing', 'Completed', 'Cancelled'];
?>
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="order.php">Order</a></li>
                <li class="breadcrumb-item active"><a href="#">Order Detail </a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide">
                                <div class="form-group row">
                                    <div class="col-lg-12 ml-auto text-center">
                                        <h4>ORDER ID: <?= $id ?></h4>
                                        <input type="hidden" name="" id="val-order-id" value="<?= $id ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="col-lg-12 col-form-label">Customer Name: </label>
                                        <div class="col-lg-12">
                                            <input readonly type="text" class="form-control" value="<?= $customerName ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="col-lg-12 col-form-label">Order Date: </label>
                                        <div class="col-lg-12">
                                            <input readonly type="text" class="form-control" value="<?= $orderDate ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="label label-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>image</th>
                                                    <th>Product Name</th>
                                                    <th>Type</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($orderDetailArr as $eachOrder) {
                                                    $imageProduct = $GLOBALS['PRODUCT_DIRECTORY'] . $eachOrder['product_master_image'];
                                                ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><img style="width: 30px;" class="img-fluid rounded" src="<?= $imageProduct ?>" alt="#"></td>
                                                        <td><?= $eachOrder['product_name'] ?></td>
                                                        <td><?= $eachOrder['product_color'] . " | " . $eachOrder['product_size'] ?></td>
                                                        <td class="color-primary"><?= number_format($eachOrder['product_price'], 0, ',', '.') . $GLOBALS['CURRENCY'] ?></td>
                                                        <td><?= $eachOrder['quantity_order'] ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label class="col-lg-12 col-form-label">Sub Total: </label>
                                        <div class="col-lg-12">
                                            <input readonly type="text" class="form-control" value="<?= $subTotal ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="col-lg-12 col-form-label">Delivery Charge: </label>
                                        <div class="col-lg-12">
                                            <input readonly type="text" class="form-control" value="<?= $deliveryCharge ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="col-lg-12 col-form-label">Discount Amount: </label>
                                        <div class="col-lg-12">
                                            <input readonly type="text" class="form-control" value="<?= $discountAmount ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="col-lg-12 col-form-label">Grand Total: </label>
                                        <div class="col-lg-12">
                                            <input readonly type="text" class="form-control" value="<?= $grandTotal ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label class="col-lg-12 col-form-label">Payment Method: </label>
                                        <div class="col-lg-12">
                                            <input readonly type="text" class="form-control" value="<?= $paymentMethod ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="col-lg-12 col-form-label" for="val-status">Transaction Status <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-12">
                                            <select <?= $disabled ?> class="form-control" id="val-transaction" name="val-status">
                                                <?php
                                                foreach ($transactionStatusArr as $value) {
                                                    if ($value == $transactionStatus) {
                                                        echo "<option selected value='$value'>$value</option>";
                                                    } else {
                                                        echo "<option value='$value'>$value</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="col-lg-12 col-form-label" for="val-status">Order Status <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-12">
                                            <select class="form-control" id="val-order" name="val-status">
                                                <?php
                                                foreach ($orderStatusArr as $value) {
                                                    if ($value == $orderStatus) {
                                                        echo "<option selected value='$value'>$value</option>";
                                                    } else {
                                                        echo "<option value='$value'>$value</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 ml-auto text-center">
                                        <button id="submit-order-detail" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>