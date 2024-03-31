<?php
include("app/Controllers/ProductRemainController.php");
$productRemainController = new ProductRemainController;
$eloquent = new Eloquent;
$productRemainList = $eloquent->selectProductRemain();
?>
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="dashboard.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="#" class="text-info">Product Remain</a>
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
                            <h4 class="card-title col-md-12">Data Table Product Remain</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>PRODUCT NAME</th>
                                        <th>SUB-CATEGORY</th>
                                        <th>PRICE</th>
                                        <th>REMAIN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $productRemainController->ProductList($productRemainList);
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>PRODUCT NAME</th>
                                        <th>SUB-CATEGORY</th>
                                        <th>PRICE</th>
                                        <th>REMAIN</th>
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