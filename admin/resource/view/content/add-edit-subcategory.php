<?php
$eloquent = new Eloquent();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $subcategory = $eloquent->selectData(['*'], 'subcategories', ['id' => $id]);
    $subcategory = $subcategory[0];
    $id = $subcategory['id'];
    $sub_category_name = $subcategory['subcategory_name'];
    $category_id = $subcategory['category_id'];
    $sub_category_status_selected = $subcategory['subcategory_status'] == 'Inactive' ? 'selected' : '';
    $imagePath =$GLOBALS['BANNER_DIRECTORY'] . $subcategory['subcategory_banner'];
    $old_image_name = $subcategory['subcategory_banner'];
    $nameForm = 'Update SubCategory';
} else {
    $id = '';
    $sub_category_name = '';
    $category_id = '';
    $sub_category_status_selected = '';
    $imagePath = $GLOBALS['NO_IMAGE'];
    $old_image_name = '';
    $nameForm = 'Add SubCategory';
}
// get list category
$categoryList = $eloquent->selectData(['*'], 'categories', ['category_status' => 'Active', 'is_delete' => '0']);
?>
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="sub-category.php">Sub-Category</a></li>
                <li class="breadcrumb-item active"><a href="#" class="text-info"><?= $nameForm ?></a></li>
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
                            <form class="form-valide" id="FormSubcategory">
                                <input type="hidden" name="id-subcategory" id="" value="<?= $id ?>">
                                <input type="hidden" name="old-image" id="" value="<?= $old_image_name ?>">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-category">Sub-Category Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="val-subcategory-name" name="val-subcategory-name" placeholder="Enter a sub-category.." value="<?= $sub_category_name ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-category">Category Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="val-category" name="val-category-id">
                                            <?php
                                            foreach ($categoryList as $eachCategory) {
                                                $selected = $eachCategory['id'] == $category_id ? 'selected' : '';
                                            ?>
                                                <option <?= $selected ?> value="<?= $eachCategory['id'] ?>"><?= $eachCategory['category_name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-status">Status <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="val-status" name="val-status">
                                            <option selected value="Active">Active</option>
                                            <option <?= $sub_category_status_selected ?> value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-image">Image <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control" accept=".jpg, .png, .jpeg" id="val-image" name="val-image">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label text-center" for="val-show">Show Image</label>
                                </div>
                                <div class="form-group row result">
                                    <!-- show image here -->
                                    <div class="col-md-12 text-center">
                                        <img style="width: 50%; height: 250px; object-fit: cover;" class="img-fluid img-thumbnail rounded" src="<?= $imagePath ?>" alt="#">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 text-center">
                                        <button id="submit-subcategory" class="btn btn-primary">Submit</button>
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