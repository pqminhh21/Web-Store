<?php
    include("app/Controllers/CategoryController.php");
    $categoryController = new CategoryController;
    $eloquent = new Eloquent;
    $categoryList = $eloquent->selectData(['*'],'categories', ['is_delete' => '0'], [], [], [], ['DESC' => 'id']);
?>
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="dashboard.php">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0)">Category</a>
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
                            <h4 class="card-title col-md-11">Data Table Category</h4>
                            <div class="bootstrap-modal col-md-1">
                                <a class="btn btn-success" href="manage-category.php" data-toggle="tooltip" data-placement="top" title="Add">
                                    <i class="fa fa-plus color-muted"></i>
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>STATUS</th>
                                        <th>PUBLISHED ON</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- show data -->
                                    <?php
                                        $categoryController->CategoryList($categoryList);
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
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