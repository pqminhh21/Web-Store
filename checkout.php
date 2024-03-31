<?php
include('app/Controllers/View.php');
$view = new View();
$view->loadContent("include", "session");
$view->loadContent('include', 'top');
$view->loadContent('content', 'checkout');
$view->loadContent('include', 'tail');
?>
<script>
    $('#payment-cod').click(function(e) {
        e.preventDefault();
        $('.choice-payment-cod').html("<span class=\"text-success\">&#10004;Thanh toán khi nhận hàng!</span>");
    });
    $('#payment-vnpay').click(function(e) {
        e.preventDefault();
        $('.choice-payment-cod').html("<span class=\"text-success\">&#10004;Thanh toán bằng VnPay!</span>");
        $.ajax({
            url: 'app/Handle/saveSessionShipping.php',
            type: 'POST',
            data: {
                lfname : $('.lfname-session').val(),
                email : $('.email-session').val(),
                phone : $('.phone-session').val(),
                address : $('.address-session').val(),
                address_city : $('.address-city-session').val(),
                zipcode : $('.zipcode-session').val(),
                note : $('.note-session').val(),
            },
            success: function(data) {
                $('.toastr_notification').html(data);
            }
        });
    });
</script>