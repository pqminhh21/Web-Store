<?php
    include("app/Controllers/ReviewController.php");
    $reviewController = new ReviewController;
    $eloquent = new Eloquent;
    $reviewList = $eloquent->selectReview();
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
                    <a href="#">Review</a>
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
                            <h4 class="card-title col-md-11">Data Table Review</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ORDER ID</th>
                                        <th>CUSTOMER</th>
                                        <th>PRODUCT NAME</th>
                                        <th>TYPE</th>
                                        <th>REVIEW DETAIL</th>
                                        <th>RATING</th>
                                        <th>PUBLISHED ON</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $reviewController->ReviewList($reviewList);
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>ORDER ID</th>
                                        <th>CUSTOMER</th>
                                        <th>PRODUCT NAME</th>
                                        <th>TYPE</th>
                                        <th>REVIEW DETAIL</th>
                                        <th>RATING</th>
                                        <th>PUBLISHED ON</th>
                                        <th>STATUS</th>
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