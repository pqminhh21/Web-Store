<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="customer-account.php">Customer Account</a></li>
                <li class="breadcrumb-item active"><a href="manage-admin.php">Add Customer</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="#" method="post">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-username">Image <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <img style="width: 100px;" class="img-fluid img-thumbnail rounded" src="public/images/member/1.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-username">Username <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input disabled type="text" class="form-control" id="val-username" name="val-username" placeholder="Enter a username..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-email">Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input disabled type="email" class="form-control" id="val-email" name="val-email" placeholder="Your valid email..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-mobile">Mobile <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input disabled type="text" class="form-control" id="val-mobile" name="val-mobile" placeholder="Enter a username..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-address">Address <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input disabled type="text" class="form-control" id="val-address" name="val-address" placeholder="Enter a username..">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-skill">Status <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="val-skill" name="val-skill">
                                            <option selected value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-9 ml-auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>