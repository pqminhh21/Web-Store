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
                    <a href="javascript:void(0)">Admin Account</a>
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
                            <h4 class="card-title col-md-11">Data Table Admin Account</h4>
                            <div class="bootstrap-modal col-md-1">
                                <a class="btn btn-success" href="manage-admin.php" data-toggle="tooltip" data-placement="top" title="Add">
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
                                    <tr>
                                        <td>123</td>
                                        <!-- <td><img style="width: 80px;" class="img-fluid rounded" src="public/images/member/1.jpg" alt="#"></td> -->
                                        <td>Hieu Tran</td>
                                        <td>
                                            <span class="text-success">
                                                Active
                                            </span>
                                        </td>
                                        <td>2023/01/15</td>
                                        <td>
                                            <span>
                                                <a class="btn btn-primary" href="manage-admin.php" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-pencil color-muted"></i>
                                                </a>
                                                <a class="btn btn-danger" href="#" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa fa-trash color-danger"></i>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
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