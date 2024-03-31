<?php
session_start();
include '../Models/Eloquent.php';
include '../../config/database.php';
include '../../config/site.php';
$eloquent = new Eloquent();

$customerId = $_SESSION['SSCF_login_id'];
$couponList = $eloquent->selectCoupons();
if ($couponList != []) {
    foreach ($couponList as $eachCoupon) {
        //check save coupon
        $checkSaveCoupon = $eloquent->checkSaveCoupons($customerId, $eachCoupon['id']);
        if ($checkSaveCoupon != []) {
            if ($checkSaveCoupon['is_use'] == '1') {
                $typeSave = 'saved-coupon btn-info';
                $nameSave = 'Đã dùng';
                $isUsed = 'is-used';
            } else {
                $typeSave = 'saved-coupon btn-success check_coupon';
                $nameSave = 'Sử dụng';
                $isUsed = '';
            }
        } else {
            $typeSave = 'save-coupon btn-brand';
            $nameSave = 'Lưu';
            $isUsed = '';
        }
        $bg_coupon = 'coupon-bg';
        if (isset($_SESSION['SELECTED_COUPON'])) {
            if ($eachCoupon['id'] == $_SESSION['SELECTED_COUPON']) {
                $typeSave = 'saved-coupon btn-success check_coupon';
                $bg_coupon = 'coupon-bg-selected';
                $nameSave = '&#10004;';
                $isUsed = '';
            }
        }


        //handle persent for progress bar
        $couponSaved = $eloquent->selectCouponsSave($eachCoupon['id']);
        $persent = ($couponSaved / ($eachCoupon['quantity'] + $couponSaved)) * 100;
        $persent = round($persent, 0);
?>
        <div class="mb-15 <?= $isUsed ?>">
            <div class="coupon p-2 <?= $bg_coupon ?>">
                <div class="row">
                    <div class="col-md-4">
                        <img style="width: 75px;" src="./public/assets/imgs/logo/logoshop2023.png">
                        <div id="coupon-<?= $eachCoupon['id'] ?>">
                            <input type="hidden" name="" id="quantity-discount-<?= $eachCoupon['id'] ?>" value="<?= $eachCoupon['quantity'] ?>">
                            <a data-itemid="<?= $eachCoupon['id'] ?>" class="d-flex flex-row justify-content-center mt-1 btn border border-success rounded code <?= $typeSave ?>" style="padding: 5px;"><?= $nameSave ?></a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div>
                            <div class="row">
                                <div class="col-md-5 d-flex flex-row justify-content-center off">
                                    <h3 class="font-xl text-brand fw-900"><?= number_format($eachCoupon['price_discount_amount'], 0, ',', '.') . $GLOBALS['CURRENCY'] ?></h3>
                                </div>
                                <div class="col-md-7 d-flex flex-row justify-content-center off">
                                    <span class="text-brand">Mã giảm giá: <?= $eachCoupon['discount_code'] ?></span>
                                    <input type="hidden" class="font-medium" id="coupon_code_<?= $eachCoupon['id'] ?>" name="Coupon" placeholder="Nhập mã giảm giá" value="<?= $eachCoupon['discount_code'] ?>">
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-center off">
                                <span class="text-brand">(Áp dụng với đơn hàng từ <?= number_format($eachCoupon['discount_condition'], 0, ',', '.') . $GLOBALS['CURRENCY'] ?>)</span>
                            </div>
                            <div>
                                <div class="progress" id="progress-<?= $eachCoupon['id'] ?>">
                                    <div class="progress-bar" role="progressbar" style="width: <?= $persent ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="10000"><?= $persent . '%' ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "<div class='text-center'>
    <img src='public/assets/imgs/page/no-review.png' alt='' class='img-fluid'>
    <h4 class='mb-30 text-brand'>Chưa có mã giảm giá nào!</h4>
    </div>";
}
?>

<script>
    //save coupon
    $('.save-coupon').click(function(e) {
        e.preventDefault();
        let discountId = $(this).data('itemid');
        let quantity = $('#quantity-discount-' + discountId).val();
        $.ajax({
            type: 'POST',
            url: 'app/Handle/saveCoupons.php',
            data: {
                discountId: discountId,
                quantity: quantity,
            },
            dataType: 'json',
            success: function(data) {
                if (data.type == "error") {
                    warning_toast(data.message, data.title);
                } else {
                    success_toast(data.message, data.title);
                    // $('#coupon-' + discountId).html('<a data-itemid="' + data.discountId + '" class="d-flex flex-row justify-content-center mt-1 btn border border-success rounded code saved-coupon btn-success check_coupon" style="padding: 5px;">Sử dụng</a>');
                    // $('#progress-' + discountId).html('<div class="progress-bar" role="progressbar" style="width: ' + data.persent + '%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="10000">' + data.persent + '%</div>');
                    $('#load_coupons').load("app/Handle/loadCoupons.php");
                }
            }
        })
    });

    $('.check_coupon').click(function(e) {
        e.preventDefault();
        let discountId = $(this).data('itemid');
        let couponCode = $('#coupon_code_' + discountId).val();
        console.log("couponCode: " + couponCode);
        $.ajax({
            url: 'app/Handle/checkCoupon.php',
            type: 'POST',
            data: {
                coupon_code: couponCode,
            },
            success: function(data) {
                $('#load_price_cart').load("app/Handle/loadPriceCart.php");
                $('#load_coupons').load("app/Handle/loadCoupons.php");
                $('.toastr_notification').html(data);
            }
        });
    });
</script>