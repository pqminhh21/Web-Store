<?php
    $eloquent = new Eloquent();
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $category = $eloquent->selectData(['*'], 'categories', ['id' => $id]);
        $category = $category[0];
        $id = $category['id'];
        $category_name = $category['category_name'];
        $category_status_selected = $category['category_status'] == 'Inactive' ? 'selected' : '';
        $nameForm = 'Update Category';
    } else {
        $id = '';
        $category_name = '';
        $category_status_selected = '';
        $nameForm = 'Add Category';
    }
?>
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="category.php">Category</a></li>
                <li class="breadcrumb-item active"><a class="text-info" href="#"><?= $nameForm ?></a></li>
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
                            <form class="form-valide">
                                <input type="hidden" name="" id="val-category-id" value="<?= $id ?>">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-category">Category name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="val-category-name" name="val-category" placeholder="Enter a category.."
                                        value="<?= $category_name ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-status">Status <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="val-category-status" name="val-status">
                                            <option selected value="Active">Active</option>
                                            <option <?= $category_status_selected ?> value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-9 ml-auto">
                                        <button id="submit-category" class="btn btn-primary">Submit</button>
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