<?php
    include("app/Controllers/ProductController.php");
    $productController = new ProductController;
    $eloquent = new Eloquent;
    $productList = $eloquent->selectProduct();
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
                    <a href="#" class="text-info">Product</a>
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
                            <h4 class="card-title col-md-11">Data Table Product</h4>
                            <div class="bootstrap-modal col-md-1">
                                <a class="btn btn-success" href="manage-product.php" data-toggle="tooltip" data-placement="top" title="Add">
                                    <i class="fa fa-plus color-muted"></i>
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>PRODUCT NAME</th>
                                        <th>PRICE</th>
                                        <th>SUB CATEGORY</th>
                                        <th>STATUS</th>
                                        <th>FEATURED</th>
                                        <th>PUBLISHED ON</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- show data -->
                                    <?php
                                        $productController->ProductList($productList);
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>PRODUCT NAME</th>
                                        <th>PRICE</th>
                                        <th>SUB CATEGORY</th>
                                        <th>STATUS</th>
                                        <th>FEATURED</th>
                                        <th>PUBLISHED ON</th>
                                        <th>Action</th>
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