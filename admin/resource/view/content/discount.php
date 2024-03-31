<?php
    include("app/Controllers/DiscountController.php");
    $discountController = new DiscountController;
    $eloquent = new Eloquent;
    $discountList = $eloquent->selectData(['*'], 'discounts', ['is_delete' => '0']);
?>
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="Dashboard.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <a class="text-info" href="#">Discount</a>
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
                            <h4 class="card-title col-md-11">Data Table Discount</h4>
                            <div class="bootstrap-modal col-md-1">
                                <a class="btn btn-success" href="manage-discount.php" data-toggle="tooltip" data-placement="top" title="Add">
                                    <i class="fa fa-plus color-muted"></i>
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>DISCOUNT CODE</th>
                                        <th>PRICE DISCOUNT AMOUNT</th>
                                        <th>DISCOUNT CONDITION</th>
                                        <th>QUANTITY</th>
                                        <th>STATUS</th>
                                        <th>PUBLISHED ON</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- show data -->
                                    <?php
                                        $discountController->DiscountList($discountList);
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>DISCOUNT CODE</th>
                                        <th>PRICE DISCOUNT AMOUNT</th>
                                        <th>DISCOUNT CONDITION</th>
                                        <th>QUANTITY</th>
                                        <th>STATUS</th>
                                        <th>PUBLISHED ON</th>
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