<?php
include("app/Controllers/ProductSoldController.php");
$productSoldController = new ProductSoldController;
$eloquent = new Eloquent;
$productSoldList = $eloquent->selectProductSold();
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
                    <a href="#" class="text-info">Product Sold</a>
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
                            <h4 class="card-title col-md-12">Data Table Product Sold</h4>
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
                                        <th>SOLD</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $productSoldController->ProductList($productSoldList);
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>PRODUCT NAME</th>
                                        <th>SUB-CATEGORY</th>
                                        <th>PRICE</th>
                                        <th>SOLD</th>
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