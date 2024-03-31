<?php
include('app/Controllers/View.php'); // start session in View.php
$view = new View();
$view->loadContent("include", "session");
$view->loadContent('include', 'top');
$view->loadContent('content', 'product-detail');
$view->loadContent('include', 'tail');

?>
<!-- check even click choice color-->
<script>
    // $(document).ready(function() {
    //     $('.load-status-quantity').load("app/Handle/loadQty.php");
    // });
    const choiceColors = document.querySelectorAll('.choice-color');
    choiceColors.forEach(choiceColor => {
        choiceColor.addEventListener('click', function(e) {
            e.preventDefault();
            const color = this.getAttribute('data-color');
            $('#val-color').val(color);
            $.ajax({
                url: 'app/Handle/loadQty.php',
                type: 'POST',
                data: {
                    color: $('#val-color').val(),
                    size: $('#val-size').val(),
                    product_id: $('#productId').val(),
                },
                success: function(data) {
                    $('.load-status-quantity').html(data);
                }
            });
        });
    });

    const choiceSizes = document.querySelectorAll('.choice-size');
    choiceSizes.forEach(choiceSize => {
        choiceSize.addEventListener('click', function(e) {
            e.preventDefault();
            const size = this.getAttribute('data-size');
            $('#val-size').val(size);
            $.ajax({
                url: 'app/Handle/loadQty.php',
                type: 'POST',
                data: {
                    color: $('#val-color').val(),
                    size: $('#val-size').val(),
                    product_id: $('#productId').val(),
                },
                success: function(data) {
                    $('.load-status-quantity').html(data);
                }
            });
        });
    });
</script>