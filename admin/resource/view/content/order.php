<?php
    include("app/Controllers/OrderController.php");
    $orderController = new OrderController;
    $eloquent = new Eloquent;
    $orderList = $eloquent->selectOrder();
?>
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="dashbroad.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="#">Order</a>
                </li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h4 class="card-title col-md-11">Data Table Order</h4>
                        </div>
                        <div class="table-responsive">
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
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $orderController->OrderList($orderList);
                                    ?>
                                </tbody>
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
                                        <th>ACTION</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
    Content body end
***********************************-->