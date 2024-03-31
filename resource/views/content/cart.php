<?php
$eloquent = new Eloquent();
if (isset($_SESSION['SSCF_login_id'])) {
    $productListCart = $eloquent->loadCartInfo($_SESSION['SSCF_login_id']);
} else {
    $productListCart = [];
    echo '<script>
            window.location.href = "login.php";
        </script>';
}


$priceSub = 0;
if ($productListCart != [])
    foreach ($productListCart as $eachProduct) {
        $productImageItem = $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_master_image'];
        $priceSub += $eachProduct['product_price'] * $eachProduct['quantity'];
    }
?>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php" rel="nofollow">Trang chủ</a>
                <span></span> <a href="product-category.php" rel="nofollow">Sản phẩm</a>
                <span></span> Giỏ hàng
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table shopping-summery text-center clean">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Tổng</th>
                                    <th class="d-none" scope="col">quantity remain</th>
                                    <th scope="col">Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="load_product_detail">
                                <!-- load data from load cart detail -->
                            </tbody>
                            <tfoot>
                                <!-- <tr>
                                    <td colspan="6" class="text-end">
                                        <a href="#" class="text-muted"> <i class="fi-rs-cross-small"></i> Xóa giỏ hàng</a>
                                    </td>
                                </tr> -->
                            </tfoot>
                        </table>
                    </div>
                    <div class="cart-action text-end">
                        <!-- <a class="btn  mr-10 mb-sm-15"><i class="fi-rs-shuffle mr-10"></i>Cập nhật giỏ hàng</a> -->
                        <a class="btn " href="product-category.php"><i class="fi-rs-shopping-bag mr-10"></i>Tiếp tục mua sắm</a>
                    </div>
                    <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                    <div class="row mb-50">
                        <div class="col-lg-6 col-md-12">
                            <div class="mt-0">
                                <div class="heading_s1 mb-3">
                                    <h4>Danh sách Voucher</h4>
                                </div>
                                <div id="load_coupons" class="card example-1 scrollbar-ripe-malinka p-10">
                                    <!-- load data from load coupons -->
                                </div>
                            </div>
                            <!-- <div class="mb-30 mt-0 d-none">
                                <div class="heading_s1 mb-3">
                                    <h4>Voucher của bạn</h4>
                                </div>
                                <div class="total-amount">
                                    <div class="left">
                                        <div class="coupon">
                                            <form action="#" target="_blank">
                                                <div class="form-row row justify-content-center">
                                                    <div class="form-group col-lg-6">
                                                        <input class="font-medium" id="coupon_code" name="Coupon" placeholder="Nhập mã giảm giá" value="">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <button class="btn btn-sm check_coupon"><i class="fi-rs-label mr-10"></i>Kiểm tra</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="border p-md-4 p-30 border-radius cart-totals" id="load_price_cart">
                                <!-- load price cart -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>