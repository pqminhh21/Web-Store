<?php
    include("app/Controllers/CustomerController.php");
    $customerController = new CustomerController;
    $eloquent = new Eloquent;
    $customerList = $eloquent->selectData(['*'],'customers');
?>
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0)">Customer Account</a>
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
                            <h4 class="card-title col-md-12">Data Table Customer Account</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>NAME</th>
                                        <th>EMAIL</th>
                                        <th>MOBILE</th>
                                        <th>PUBLISHED ON</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $customerController->CustomerList($customerList);
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>NAME</th>
                                        <th>EMAIL</th>
                                        <th>MOBILE</th>
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