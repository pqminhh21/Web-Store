<?php
session_start();
include '../Models/Eloquent.php';
include '../../config/database.php';
include '../../config/site.php';
$eloquent = new Eloquent();

$orderItems = $eloquent->selectOrderItems($_SESSION['SSCF_login_id'], $_POST['order_id']);

?>
<div class="card-header">
    <h5 class="mb-0">Chi tiết đơn hàng #<?= $_POST['order_id'] ?></h5>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th>Đánh giá</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($orderItems as $eachOrder) {
                    $productImageItem = $GLOBALS['PRODUCT_DIRECTORY'] . $eachOrder['product_master_image'];
                ?>
                    <tr>
                        <td class="image product-thumbnail"><img src="<?= $productImageItem ?>" alt="#"></td>
                        <td>
                            <a href="product-detail.php?id=<?= $eachOrder['idProduct'] ?>"><?= $eachOrder['product_name'] ?></a>
                            <p class="font-xs">Size: <?= $eachOrder['product_size'] ?> | Màu: <?= $eachOrder['product_color'] ?>
                        </td>
                        <td><?= number_format($eachOrder['product_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></td>
                        <td><?= $eachOrder['product_quantity'] ?></td>
                        <td><?= number_format($eachOrder['product_price'] * $eachOrder['product_quantity'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></td>
                        <td>
                            <a data-itemid="<?= $eachOrder['idProductSC'] ?>" class="d-block review-customer">
                                <?php
                                    $reviewItems = $eloquent->selectData(['*'], 'reviews', [
                                        'customer_id' => $_SESSION['SSCF_login_id'],
                                        'product_sc_id' => $eachOrder['idProductSC'],
                                        'order_id' => $_POST['order_id']
                                    ]);
                                    if ($reviewItems == []) echo "Đánh giá";
                                    else echo "Sửa đánh giá";
                                ?>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php

?>
<script>
    $(document).ready(function() {
        let reviews = document.querySelectorAll('.review-customer');
        reviews.forEach(review => {
            review.addEventListener('click', function(e) {
                e.preventDefault();
                let productSC = this.getAttribute('data-itemid');
                sessionStorage.setItem("product_sc_id_review", productSC);
                console.log(productSC);
                $('#popup-main').addClass('popup-main');
                $('#backdrop').addClass('backdrop');
                $('#popup').addClass('open-popup');
                $('#idProductSC').val(productSC);
                $.ajax({
                    url: 'app/Handle/loadReview.php',
                    type: 'POST',
                    data: {
                        product_sc_id: productSC,
                        order_id: <?= $_POST['order_id'] ?>
                    },
                    dataType: 'json',
                    success: function(data) {
                        if(data.rating == "") {
                            $('#5').prop('checked', false);
                            $('#4').prop('checked', false);
                            $('#3').prop('checked', false);
                            $('#2').prop('checked', false);
                            $('#1').prop('checked', false);
                            $('#review-detail').val(data.review_details);
                            $('#idReviewDB').val(data.idReview);
                        } else {
                            $('#' + data.rating).prop('checked', true);
                            $('#review-detail').val(data.review_details);
                            $('#idReviewDB').val(data.idReview);
                        }
                    }
                });
            });
        });
    })
</script>