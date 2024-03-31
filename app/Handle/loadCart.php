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
$SESSION['LIST_PRODUCT_CART'] = $productListCart;
//load cart
?>
<a class="mini-cart-icon" href="cart.php">
    <img alt="" src="public/assets/imgs/theme/icons/icon-cart.svg">
    <span class="pro-count blue"><?= $count_product_cart; ?></span>
</a>
<div class="cart-dropdown-wrap cart-dropdown-hm2">
    <ul>
        <?php
        $priceTotal = 0;
        if ($productListCart != [])
            foreach ($productListCart as $key => $product) {
                $productImageItem = $GLOBALS['PRODUCT_DIRECTORY'] . $product['product_master_image'];
                $priceTotal += $product['product_price'] * $product['quantity'];
        ?>
            <li>
                <div class="shopping-cart-img">
                    <a href="product-detail.php?id=<?= $product['id'] ?>"><img alt="" src="<?= $productImageItem ?>"></a>
                </div>
                <div class="shopping-cart-title">
                    <h4><a style="font-weight: bold;" href="product-detail.php?id=<?= $product['id'] ?>"><?= $product['product_name'] ?></a></h4>
                    <h5><span><?= $product['quantity'] ?> × </span><?php echo number_format($product['product_price']) . $GLOBALS['CURRENCY'] ?></h5>
                    <h5><span>Màu: <?= $product['product_color'] ?> , Size: <?= $product['product_size'] ?></span></h5>
                </div>
                <form class="shopping-cart-delete">
                    <input type="hidden" id="delete_product_cart_name<?= $product['idShopCarts'] ?>" value="<?= $product['product_name'] ?>">
                    <input type="hidden" id="product_sc_id<?= $product['idShopCarts'] ?>" value="<?= $product['idProductSC'] ?>">
                    <input type="hidden" id="product_sc_quantity<?= $product['idShopCarts'] ?>" value="<?= $product['quantity'] ?>">
                    <a class="delete_product_cart" data-itemid="<?= $product['idShopCarts'] ?>"><i class="fi-rs-cross-small"></i></a>
                </form>
            </li>
        <?php
            }
        else {
        ?>
            <li>
                <div class="shopping-cart-title">
                    <h4>Không có sản phẩm nào trong giỏ hàng</h4>
                </div>
            </li>
        <?php
        }
        ?>
    </ul>
    <div class="shopping-cart-footer">
        <div class="shopping-cart-total">
            <h4>Tổng: <span><?php echo number_format($priceTotal) . $GLOBALS['CURRENCY'] ?></span></h4>
        </div>
        <div class="shopping-cart-button">
            <a href="cart.php" class="outline">Giỏ hàng</a>
            <a href="<?= isset($_SESSION['LIST_PRODUCT_CART']) ? "checkout.php" : "cart.php" ?>">Thanh toán</a>
        </div>
    </div>
</div>
<?php

?>

<script>
    $('.delete_product_cart').click(function(e) {
        e.preventDefault();
        var id = $(this).data('itemid');
        console.log(id);
        var name = $('#delete_product_cart_name' + id).val();
        var product_sc_id = $('#product_sc_id' + id).val();
        var quantity = $('#product_sc_quantity' + id).val();
        console.log(name);
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
                $('.cart_product').load("app/Handle/loadCart.php");
                $('#load_product_detail').load("app/Handle/loadCartDetail.php");
                $('#load_price_cart').load("app/Handle/loadPriceCart.php");
                $('#load_coupons').load("app/Handle/loadCoupons.php");
                $('.toastr_notification').html(data);
            }
        });
    });
</script>