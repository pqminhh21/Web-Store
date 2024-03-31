<?php
include '../../config/database.php';
include '../Controllers/Toastr.php';
include '../Models/Eloquent.php';
include '../../config/site.php';
$toastr = new Toastr();
$eloquent = new Eloquent();

$fromDate = $_POST['fromDate'];
$toDate = $_POST['toDate'];

$revenueList = $eloquent->selectReVenue($fromDate, $toDate);
$totalGrand = 0;
$totalOrder = 0;
$pending = 0;
$processing = 0;
$completed = 0;
$cancelled = 0;
foreach ($revenueList as $eachRevenue) {
    $totalGrand += $eachRevenue['grand_total'];
    $totalOrder++;
    if ($eachRevenue['order_item_status'] == 'Pending') $pending++;
    if ($eachRevenue['order_item_status'] == 'Processing') $processing++;
    if ($eachRevenue['order_item_status'] == 'Completed') $completed++;
    if ($eachRevenue['order_item_status'] == 'Cancelled') $cancelled++;
}

echo '<div class="table-responsive">
<div class="ml-1 mr-1 row">
<span class="col-md-2 label label-light">Grand Total: ' . number_format($totalGrand, 0, ',', '.') . $GLOBALS['CURRENCY'] . '</span>
<span class="col-md-2 label label-success">Order Total: ' . $totalOrder . '</span>
<span class="col-md-2 label label-warning">Pending: ' . $pending . '</span>
<span class="col-md-2 label label-info">Processing: ' . $processing . '</span>
<span class="col-md-2 label label-success">Completed: ' . $completed . '</span>
<span class="col-md-2 label label-danger">Cancelled: ' . $cancelled . '</span>
</div>
<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>ID</th>
            <th>CUSTOMER</th>
            <th>ORDER DATE</th>
            <th>SUB TOTAL</th>
            <th>DELIVERY CHARGE</th>
            <th>DISCOUNT AMOUNT</th>
            <th>GRAND TOTAL</th>
            <th>PAYMENT METHOD</th>
            <th>TRANSACTION STATUS</th>
            <th>ORDER STATUS</th>
        </tr>
    </thead>
    <tbody>';
if ($revenueList == false) {
    echo '<tr><td colspan="11">No data found!</td></tr>';
} else
    foreach ($revenueList as $key => $value) {
        if ($value['order_item_status'] == 'Pending') $typeText = 'text-muted';
        else if ($value['order_item_status'] == 'Processing') $typeText = 'text-info';
        else if ($value['order_item_status'] == 'Completed') $typeText = 'text-success';
        else $typeText = 'text-danger';
?>
    <tr>
        <td>
            <a href="edit-order.php?id=<?= $value['orderId'] ?>">
                <?= $value['orderId'] ?>
            </a>
        </td>
        <td><?= $value['customer_name'] ?></td>
        <td><?= $value['order_date'] ?></td>
        <td><?= number_format($value['sub_total'], 0, ',', '.') . $GLOBALS['CURRENCY'] ?></td>
        <td><?= number_format($value['delivery_charge'], 0, ',', '.') . $GLOBALS['CURRENCY'] ?></td>
        <td><?= number_format($value['discount_amount'], 0, ',', '.') . $GLOBALS['CURRENCY'] ?></td>
        <td><?= number_format($value['grand_total'], 0, ',', '.') . $GLOBALS['CURRENCY'] ?></td>
        <td>
            <span class="text-info"><?= $value['payment_method'] ?></span>
        </td>
        <td>
            <span class="<?= $value['transaction_status'] == 'Paid' ? 'text-success' : 'text-warning' ?>">
                <?= $value['transaction_status'] ?>
            </span>
        </td>
        <td>
            <span class="<?= $typeText ?>"><?= $value['order_item_status'] ?></span>
        </td>
        <!-- <td>
            <a class="btn btn-primary" href="edit-order.php?id=<?= $value['orderId'] ?>" data-toggle="tooltip" data-placement="top" title="Edit">
                <i class="fa fa-pencil color-muted"></i>
            </a>
        </td> -->
    </tr>
<?php
    }
echo '</tbody>
<tfoot>
    <tr>
        <th>ID</th>
        <th>CUSTOMER</th>
        <th>ORDER DATE</th>
        <th>SUB TOTAL</th>
        <th>DELIVERY CHARGE</th>
        <th>DISCOUNT AMOUNT</th>
        <th>GRAND TOTAL</th>
        <th>PAYMENT METHOD</th>
        <th>TRANSACTION STATUS</th>
        <th>ORDER STATUS</th>
    </tr>
</tfoot>
</table>
</div>';
