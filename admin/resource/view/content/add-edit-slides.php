<?php
if (isset($_GET['id'])) {
    $none = "d-none";
    $typeForm = "Edit";
} else {
    $none = "";
    $typeForm = "Add";
}
?>
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="slides.php">Slides</a></li>
                <li class="breadcrumb-item active"><a href="#"><?= $typeForm ?> Slides</a></li>
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
                                    <label class="col-lg-3 col-form-label" for="val-slides">Slides Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="val-slides" name="val-slides" placeholder="Enter a slides..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-slides-sequence">Slides Sequence <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="val-slides-sequence" name="val-slides-sequence">
                                            <option selected value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-status">Status <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="val-status" name="val-status">
                                            <option selected value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-image">Image <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-3">
                                        <input type="file" class="form-control" id="val-image" name="val-image">
                                    </div>
                                    <div class="col-lg-6 result">
                                        <!-- show -->
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