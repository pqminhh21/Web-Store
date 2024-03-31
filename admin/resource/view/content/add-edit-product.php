<?php
$eloquent = new Eloquent;
if (isset($_GET['id'])) {
    $none = "d-none";
    $typeForm = "Edit";
    $imgDisplay = "";
    $productItems = $eloquent->selectData(['*'], 'products', ['id' => $_GET['id']]);
    $productItem = $productItems[0];
    $productId = $productItem['id'];
    $categoryId = $productItem['category_id'];
    $subcategoryId = $productItem['subcategory_id'];
    $productName = $productItem['product_name'];
    $productPrice = $productItem['product_price'];
    $productPriceVirtual = $productItem['virtual_price'];
    $productTag = $productItem['product_tags'];
    $productSummary = $productItem['product_summary'];
    $productDetails = $productItem['product_details'];
    $productMasterImage = $productItem['product_master_image'];
    $productImageOne = $productItem['product_image_one'];
    $productImageTwo = $productItem['product_image_two'];
    $productImageThree = $productItem['product_image_three'];
    $productFeatured = $productItem['product_featured'] == 'NO' ? 'selected' : '';
    $productStatus = $productItem['product_type'] == 'Inactive' ? 'selected' : '';

    $productMasterImagePath = $GLOBALS['PRODUCT_DIRECTORY'] . $productMasterImage;
    $productImageOnePath = $GLOBALS['PRODUCT_DIRECTORY'] . $productImageOne;
    $productImageTwoPath = $GLOBALS['PRODUCT_DIRECTORY'] . $productImageTwo;
    $productImageThreePath = $GLOBALS['PRODUCT_DIRECTORY'] . $productImageThree;

    $subCategoryList = $eloquent->selectData(['*'], 'subcategories', ['category_id' => $categoryId, 'is_delete' => '0', 'subcategory_status' => 'Active']);
} else {
    $none = "";
    $typeForm = "Add";
    $imgDisplay = "d-none";
    $productId = "";
    $categoryId = "";
    $subcategoryId = "";
    $productName = "";
    $productPrice = "";
    $productPriceVirtual = "";
    $productTag = "";
    $productSummary = "";
    $productDetails = "";
    $productMasterImage = "";
    $productImaageOne = "";
    $productImageTwo = "";
    $productImageThree = "";
    $productFeatured = "";
    $productStatus = "";

    $productMasterImagePath = $GLOBALS['NO_IMAGE'];
    $productImageOnePath = $GLOBALS['NO_IMAGE'];
    $productImageTwoPath = $GLOBALS['NO_IMAGE'];
    $productImageThreePath = $GLOBALS['NO_IMAGE'];
}
$categoryList = $eloquent->selectData(['*'], 'categories', ['is_delete' => 0, 'category_status' => 'Active'], [], [], [], ['DESC' => 'id']);
?>
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="product.php">Product</a></li>
                <li class="breadcrumb-item active"><a class="text-info" href="#"><?= $typeForm ?> Product</a></li>
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
                            <div class="form-group row <?= $imgDisplay ?>">
                                <label class="col-lg-3 col-form-label">Product Image</label>
                                <div class="col-lg-9">
                                    <img style="width: 150px;" class="img-fluid img-thumbnail rounded" src="<?= $productMasterImagePath ?>" alt="#">
                                </div>
                            </div>
                            <form id="FormProduct" class="form-valide">
                                <input type="hidden" name="val-product-id" id="" value="<?= $productId ?>">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-category">Category Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-3">
                                        <select class="form-control" id="val-category" name="val-category-id">
                                            <option class="btn-info" selected value="">Select a Category</option>
                                            <?php
                                            foreach ($categoryList as $eachCategory) {
                                                $selected = $eachCategory['id'] == $categoryId ? 'selected' : '';
                                                echo '<option '.$selected.' value="' . $eachCategory['id'] . '">' . $eachCategory['category_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <label class="col-lg-3 col-form-label" for="val-sub-category">Sub-Category Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-3">
                                        <select class="form-control" id="val-sub-category" name="val-sub-category-id">
                                            <option class="btn-info" selected value="">Select a Sub-Category</option>
                                            <?php
                                            if (isset($_GET['id'])){
                                                foreach($subCategoryList as $eachSubCategory){
                                                    $selected = $eachSubCategory['id'] == $subcategoryId ? 'selected' : '';
                                                    echo '<option '.$selected.' value="'.$eachSubCategory['id'].'">'.$eachSubCategory['subcategory_name'].'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-product-name">Product Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" required class="form-control" id="val-product-name" name="val-product-name" placeholder="Enter a product name.." value="<?= $productName ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-product-price">Product Price <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <input type="text" required class="form-control" id="val-product-price" name="val-product-price" placeholder="Enter a product price.." value="<?= $productPrice ?>">
                                    </div>
                                    <label class="col-lg-3 col-form-label" for="val-product-price-virtual">Product Price Virtual <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <input type="text" required class="form-control" id="val-product-price-virtual" name="val-product-price-virtual" placeholder="Enter a product price virtual.." value="<?= $productPriceVirtual ?>">
                                    </div>
                                </div>
                                <!-- <div class="form-group row <?= $none ?>">
                                    <label class="col-lg-3 col-form-label" for="val-product-quantity">Product Quantity <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="val-product-quantity" name="val-product-quantity" placeholder="Enter a product quantity..">
                                    </div>
                                </div> -->
                                <!-- <div class="form-group row <?= $none ?>">
                                    <label class="col-lg-3 col-form-label" for="val-product-price">Product Size <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <select id="choose-size" class="form-control select2-multi" name="val-product-size" multiple="multiple">
                                            <option value='M'>M</option>
                                            <option value='L'>L</option>
                                            <option value='XL'>XL</option>
                                            <option value='XXL'>XXL</option>
                                        </select>
                                    </div>
                                    <label class="col-lg-3 col-form-label" for="val-product-price-virtual">Product Color <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <select id="choose-color" class="form-control select2-multi" name="val-product-color" multiple="multiple">
                                            <option value='red'>red</option>
                                            <option value='green'>green</option>
                                            <option value='blue'>blue</option>
                                            <option value='yellow'>yellow</option>
                                            <option value='black'>black</option>
                                            <option value='white'>white</option>
                                        </select>
                                    </div>
                                </div> -->
                                <!-- <input type="text" name="val-size-render" id="val-size-render">
                                <input type="text" name="val-color-render" id="val-color-render"> -->
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-product-tag">Product Tags <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="text" required class="form-control" id="val-product-tag" name="val-product-tag" placeholder="Enter a product tags.." value="<?= $productTag ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-product-summary">Product Summary <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" required class="form-control" id="val-product-summary" name="val-product-summary" placeholder="Enter a product summary.." value="<?= $productSummary ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-product-detail">Product Detail <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <textarea class="summernote input-block-level" required id="content" name="val-product-detail" rows="10">
                                            <?= $productDetails ?>
                                        </textarea>
                                    </div>
                                </div>
                                <!--start multiple img -->
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-image">Product Image <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control" id="val-image" name="val-product-images[]" multiple="multiple" accept="image/jpeg, image/png, image/jpg">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label text-center" for="val-show">Show Image (max: 4)</label>
                                </div>
                                <div class="form-group row result">
                                    <div class="col-md-3">
                                        <img style="width: 300px; height: 300px; object-fit: cover;" class="img-fluid img-thumbnail rounded" src="<?= $productMasterImagePath ?>" alt="#">
                                    </div>
                                    <div class="col-md-3">
                                        <img style="width: 300px; height: 300px; object-fit: cover;" class="img-fluid img-thumbnail rounded" src="<?= $productImageOnePath ?>" alt="#">
                                    </div>
                                    <div class="col-md-3">
                                        <img style="width: 300px; height: 300px; object-fit: cover;" class="img-fluid img-thumbnail rounded" src="<?= $productImageTwoPath ?>" alt="#">
                                    </div>
                                    <div class="col-md-3">
                                        <img style="width: 300px; height: 300px; object-fit: cover;" class="img-fluid img-thumbnail rounded" src="<?= $productImageThreePath ?>" alt="#">
                                    </div>
                                </div>
                                <!-- end multiple img -->
                                <!-- old image -->
                                <input type="hidden" name="val-product-master-image-old" value="<?= $productMasterImage ?>">
                                <input type="hidden" name="val-product-image-one-old" value="<?= $productImageOne ?>">
                                <input type="hidden" name="val-product-image-two-old" value="<?= $productImageTwo ?>">
                                <input type="hidden" name="val-product-image-three-old" value="<?= $productImageThree ?>">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-type">Product Featured <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="val-type" name="val-type-featured">
                                            <option selected value="Yes">Yes</option>
                                            <option <?= $productFeatured ?> value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-type">Product Type <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="val-type" name="val-type-status">
                                            <option selected value="Active">Active</option>
                                            <option <?= $productStatus ?> value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-12 ml-auto text-center">
                                        <button class="btn btn-primary">Submit</button>
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