<?php
$eloquent = new Eloquent;
if (isset($_GET['id'])) {
    $typpForm = 'Edit Discount';
    $discountItem = $eloquent->selectData(['*'], 'discounts', ['id' => $_GET['id'], 'is_delete' => '0']);
    $discountItem = $discountItem[0];
    $discountId = $discountItem['id'];
    $discountCode = $discountItem['discount_code'];
    $priceDiscountAmount = $discountItem['price_discount_amount'];
    $discountCondition = $discountItem['discount_condition'];
    $quantity = $discountItem['quantity'];
    $discountStatus = $discountItem['discount_status'];
} else {
    $typpForm = 'Add Discount';
    $discountId = '';
    $discountCode = '';
    $priceDiscountAmount = '';
    $discountCondition = '';
    $quantity = '';
    $discountStatus = '';
}
$arrStatus = ['Active', 'Inactive'];
?>
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="discount.php">Discount</a></li>
                <li class="breadcrumb-item active"><a href="#"><?= $typpForm ?></a></li>
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
                            <form id="FormDiscount" class="form-valide">
                                <input type="hidden" name="val-discount-id" id="discountId" value="<?= $discountId ?>">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-discount-code">Discount Code <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input required type="text" class="form-control" id="val-discount-code" name="val-discount-code" placeholder="Enter a discount code.."
                                        value="<?= $discountCode ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-price-discount-amount">Price Discount Amount <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input required type="text" class="form-control" id="val-price-discount-amount" name="val-price-discount-amount" placeholder="Enter a price discount amount.."
                                        value="<?= $priceDiscountAmount ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-price-discount-condition">Price Discount Condition <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input required type="text" class="form-control" id="val-price-discount-condition" name="val-price-discount-condition" placeholder="Enter a price discount condition.."
                                        value="<?= $discountCondition ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-discount-quantity">Discount Quantity <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input required type="text" class="form-control" id="val-discount-quantity" name="val-discount-quantity" placeholder="Enter a discount quantity.."
                                        value="<?= $quantity ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-status">Status <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="val-status" name="val-status">
                                            <?php
                                            foreach ($arrStatus as $eachStatus) {
                                                if ($eachStatus == $discountStatus) {
                                                    echo '<option value="' . $eachStatus . '" selected>' . $eachStatus . '</option>';
                                                } else {
                                                    echo '<option value="' . $eachStatus . '">' . $eachStatus . '</option>';
                                                }
                                            }
                                            ?>
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