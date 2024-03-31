<?php
session_start();
include '../Models/Eloquent.php';
include '../../config/database.php';
include '../../config/site.php';
$eloquent = new Eloquent();

if (isset($_SESSION['SSCF_login_id'])) {
    $productListCart = $eloquent->loadCartInfo($_SESSION['SSCF_login_id']);
    $count_product_cart = count($productListCart);
} else {
    $count_product_cart = 0;
    $productListCart = [];
}
$priceTotal = 0;
$_SESSION['LIST_PRODUCT_CART'] = $productListCart;

if ($productListCart != [])
    foreach ($productListCart as $eachProduct) {
        $productImageItem = $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_master_image'];
        $priceTotal += $eachProduct['product_price'] * $eachProduct['quantity'];
?>
    <tr>
        <td class="image product-thumbnail"><img src="<?= $productImageItem ?>" alt="#"></td>
        <td class="product-des product-name">
            <h5 class="product-name"><a href="product-detail.php?id=<?= $eachProduct['id'] ?>"><?= $eachProduct['product_name'] ?></a></h5>
            <p class="font-xs">Size: <?= $eachProduct['product_size'] ?> | Màu: <?= $eachProduct['product_color'] ?>
            </p>
        </td>
        <td class="price" data-title="Price"><span><?= number_format($eachProduct['product_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span></td>
        <td class="text-center" data-title="Stock">
            <div class="detail-qty border radius  m-auto">
                <a data-itemid="<?= $eachProduct['idShopCarts'] ?>" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                <a class="hidden" id="get_price_<?= $eachProduct['idShopCarts'] ?>" data-itemprice="<?= $eachProduct['product_price'] ?>">123</a>
                <span class="qty-val"><?= $eachProduct['quantity'] ?></span>
                <a data-itemid="<?= $eachProduct['idShopCarts'] ?>" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
            </div>
        </td>
        <td class="text-right" data-title="Cart">
            <span id="update_cart_detail<?= $eachProduct['idShopCarts'] ?>">
                <?= number_format($eachProduct['product_price'] * $eachProduct['quantity'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?>
            </span>
        </td>
        <td class="d-none">
            <span id="quantity_remain<?= $eachProduct['idShopCarts'] ?>">
                <?= $eachProduct['product_quantity'] ?>
            </span>
        </td>
        <input type="hidden" name="" id="delete_product_cart_name">
        <input type="hidden" id="product_sc_id<?= $eachProduct['idShopCarts'] ?>" value="<?= $eachProduct['idProductSC'] ?>">
        <input type="hidden" id="product_sc_quantity<?= $eachProduct['idShopCarts'] ?>" value="<?= $eachProduct['quantity'] ?>">
        <td class="action"><a data-itemid="<?= $eachProduct['idShopCarts'] ?>" class="text-muted"><i class="fi-rs-trash"></i></a></td>
    </tr>
<?php

    }

else {
    echo "<h4>" . "Không có sản phẩm nào trong giỏ hàng" . "</h4>";
}

?>

<script>
    // $(document).ready(function() {
    $('.text-muted').click(function(e) {
        e.preventDefault();
        var id = $(this).data('itemid');
        console.log(id);
        var name = $('#delete_product_cart_name' + id).val();
        var product_sc_id = $('#product_sc_id' + id).val();
        var quantity = $('#product_sc_quantity' + id).val();
        $.ajax({
            url: 'app/Handle/deleteToCart.php',
            type: 'POST',
            data: {
                product_id: id,
                product_name: name,
                product_sc_id: product_sc_id,
                quantity: quantity
            },
            success: function(data) {
                $('#load_product_detail').load("app/Handle/loadCartDetail.php");
                $('#load_price_cart').load("app/Handle/loadPriceCart.php");
                $('.cart_product').load("app/Handle/loadCart.php");
                $('#load_coupons').load("app/Handle/loadCoupons.php");
                $('.toastr_notification').html(data);
            }
        });
    });

    $(document).ready(function() {
        let qtyDowns = document.querySelectorAll('.qty-down');
        let qtyUps = document.querySelectorAll('.qty-up');
        qtyUps.forEach(qtyUp => {
            qtyUp.addEventListener('click', () => {
                const id = qtyUp.getAttribute('data-itemid');
                console.log(id);
                const qtyRemain = document.querySelector('#quantity_remain' + id);
                const qtyRemainNum = parseInt(qtyRemain.textContent);
                if (qtyRemainNum > 0) {
                    var product_type = $('#product_sc_id' + id).val();
                    const getPrice = document.querySelector('#get_price_' + id);
                    const price = getPrice.getAttribute('data-itemprice');
                    console.log(price);
                    const qtyVal = qtyUp.parentElement.querySelector('.qty-val');
                    const qtyValNum = parseInt(qtyVal.textContent);
                    qtyVal.textContent = qtyValNum + 1;
                    console.log(qtyVal.textContent);
                    $.ajax({
                        url: 'app/Handle/updateCartDetail.php',
                        type: 'POST',
                        data: {
                            product_sc_id: id,
                            product_type: product_type,
                            product_price: price,
                            product_quantity: qtyVal.textContent,
                            quantity_remain: qtyRemainNum,
                            type: 'up'
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('.cart_product').load("app/Handle/loadCart.php");
                            $('#load_price_cart').load("app/Handle/loadPriceCart.php");
                            $('#load_coupons').load("app/Handle/loadCoupons.php");
                            const sub_price = data.sub_price.toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            });
                            $('#update_cart_detail' + id).html(sub_price);
                            $('#quantity_remain' + id).html(data.quantity_remain);
                        }
                    });
                }
            });
        });
        qtyDowns.forEach(qtyDown => {
            qtyDown.addEventListener('click', () => {
                const id = qtyDown.getAttribute('data-itemid');
                console.log(id);
                const qtyRemain = document.querySelector('#quantity_remain' + id);
                const qtyRemainNum = parseInt(qtyRemain.textContent);
                var product_type = $('#product_sc_id' + id).val();
                const getPrice = document.querySelector('#get_price_' + id);
                const price = getPrice.getAttribute('data-itemprice');
                console.log(price);
                const qtyVal = qtyDown.parentElement.querySelector('.qty-val');
                const qtyValNum = parseInt(qtyVal.textContent);
                if (qtyValNum > 1) {
                    qtyVal.textContent = qtyValNum - 1;
                    console.log(qtyVal.textContent);
                    $.ajax({
                        url: 'app/Handle/updateCartDetail.php',
                        type: 'POST',
                        data: {
                            product_sc_id: id,
                            product_type: product_type,
                            product_price: price,
                            product_quantity: qtyVal.textContent,
                            quantity_remain: qtyRemainNum,
                            type: 'down'
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('.cart_product').load("app/Handle/loadCart.php");
                            $('#load_price_cart').load("app/Handle/loadPriceCart.php");
                            $('#load_coupons').load("app/Handle/loadCoupons.php");
                            const sub_price = data.sub_price.toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            });
                            $('#update_cart_detail' + id).html(sub_price);
                            $('#quantity_remain' + id).html(data.quantity_remain);
                        }
                    });
                }
            });
        });
    });
</script>