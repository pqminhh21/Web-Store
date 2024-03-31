<?php
if (isset($_GET['id']) && $_GET['id'] != '') {
    $eloquent = new Eloquent;
    $status = "disabled";
    $typeForm = "Edit";
    $_SESSION['productsc_id'] = $_GET['id'];
    $productDetailList = $eloquent->selectData(['*'], 'products_sc', ['id' => $_SESSION['productsc_id'], 'is_delete' => '0']);
    $productSCItem = $productDetailList[0];
    $quantity = $productSCItem['product_quantity'];
    $productStatus = $productSCItem['product_status'];
    $productColor = $productSCItem['product_color'];
    $productSize = $productSCItem['product_size'];
} else {
    $status = "";
    $typeForm = "Add";
    $_SESSION['productsc_id'] = "";
    $quantity = "";
    $productStatus = "";
    $productColor = "";
    $productSize = "";
}
$arrSize = ['S', 'M', 'L', 'XL', 'XXL', 'XXXL', 'one size'];
// $arrColor = ['red', 'beige', 'white', 'orange', 'cyan', 'green', 'purple', 'black', 'brown', 'blue', 'yellow', 'pink', 'gray', 'maroon', 'olive', 'navy', 'lime', 'teal', 'aqua', 'silver'];
$arrColor = ['aqua', 'beige', 'black', 'blue', 'brown', 'cyan', 'gray', 'green', 'lime', 'maroon', 'navy', 'olive', 'orange', 'pink', 'purple', 'red', 'silver', 'teal', 'white', 'yellow'];
?>
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="product.php">Product</a></li>
                <li class="breadcrumb-item"><a href="product-detail.php?id=<?= $_SESSION['product_id'] ?>"><?= $_SESSION['product_name'] ?></a></li>
                <li class="breadcrumb-item active"><a class="text-info" href="#"><?= $typeForm ?> Product Style</a></li>
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
                            <form id="FormProductDetail" class="form-valide">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Product Image</label>
                                    <div class="col-lg-3">
                                        <img style="width: 150px;" class="img-fluid img-thumbnail rounded" src="<?= $GLOBALS['PRODUCT_DIRECTORY'] . $_SESSION['product_image'] ?>" alt="#">
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label mb-3" for="val-product-price">Product Size <span class="text-danger">*</span></label>
                                            <div class="col-lg-8 mb-3">
                                                <select <?= $status ?> id="choose-size" class="form-control select2-multi" name="val-size-render" multiple="multiple">
                                                    <?php
                                                    foreach ($arrSize as $eachSize) {
                                                        $selected = $eachSize == $productSize ? "selected" : "";
                                                    ?>
                                                        <option <?= $selected ?> value='<?= $eachSize ?>'><?= $eachSize ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <label class="col-lg-4 col-form-label" for="val-product-price-virtual">Product Color <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <select <?= $status ?> id="choose-color" class="form-control select2-multi" name="val-color-render" multiple="multiple">
                                                    <?php
                                                    foreach ($arrColor as $eachColor) {
                                                        $selected = $eachColor == $productColor ? "selected" : "";
                                                    ?>
                                                        <option <?= $selected ?> value='<?= $eachColor ?>'>
                                                            <?= $eachColor ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <label class="col-lg-4 col-form-label" for="val-product-price-virtual"></label>
                                            <div class="col-lg-8">
                                                <div id="color-render" class="d-flex flex-wrap">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="val-product-id" id="" value="<?= $_SESSION['product_id'] ?>">
                                <input type="hidden" name="val-productsc-id" id="" value="<?= $_SESSION['productsc_id'] ?>">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-product-quantity">Product Quantity <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="val-product-quantity" name="val-product-quantity" placeholder="Enter a product quantity.." value="<?= $quantity ?>">
                                    </div>
                                </div>
                                <input type="hidden" name="val-size-render" id="val-size-render">
                                <input type="hidden" name="val-color-render" id="val-color-render">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-status">Product Status <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="val-status" name="val-status">
                                            <option selected value="In Stock">In Stock</option>
                                            <option value="Out of Stock<">Out of Stock</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-9 ml-auto">
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