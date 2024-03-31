<?php
include('app/Controllers/View.php');
$view = new View();
$view->loadContent("include", "session");
$view->loadContent('include', 'top');
$view->loadContent('content', 'cart');
$view->loadContent('include', 'tail');

?>

<script>
    $(document).ready(function() {
        $('#load_product_detail').load("app/Handle/loadCartDetail.php");
        $('#load_price_cart').load("app/Handle/loadPriceCart.php");
        $('#load_coupons').load("app/Handle/loadCoupons.php");
    });

    // $('.check_coupon').click(function(e) {
    //     e.preventDefault();
    //     let discountId = $(this).data('itemid');
    //     let couponCode = $('#coupon_code_' + discountId).val();
    //     console.log("couponCode: " + couponCode);
    //     $.ajax({
    //         url: 'app/Handle/checkCoupon.php',
    //         type: 'POST',
    //         data: {
    //             coupon_code: couponCode,
    //         },
    //         success: function(data) {
    //             $('#load_price_cart').load("app/Handle/loadPriceCart.php");
    //             $('.toastr_notification').html(data);
    //         }
    //     });
    // });
</script>