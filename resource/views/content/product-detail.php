<?php
$control = new Controller;
$eloquent = new Eloquent;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if(is_numeric($id) == false) {
        echo "<script>window.location.href = 'not-found.php';</script>";
    }
}

//fetch all products
$columnName = ['*'];
$tableName = 'products';
$whereValue = [
    'id' => $id,
    'is_delete' => '0',
    'product_type' => 'Active'
];
$productList = $eloquent->selectData($columnName, $tableName, $whereValue);
if ($productList != []) {
    $imageMaster = $GLOBALS['PRODUCT_DIRECTORY'] . $productList[0]['product_master_image'];
    $imageOne = $GLOBALS['PRODUCT_DIRECTORY'] . $productList[0]['product_image_one'];
    $imageTwo = $GLOBALS['PRODUCT_DIRECTORY'] . $productList[0]['product_image_two'];
    $imageThree = $GLOBALS['PRODUCT_DIRECTORY'] . $productList[0]['product_image_three'];

    $percentDiscountPrice = ($productList[0]['virtual_price'] - $productList[0]['product_price']) / $productList[0]['virtual_price'];
} else {
    echo "<script>window.location.href = 'not-found.php';</script>";
}

//san pham co lien quan
$getCategoryID = $eloquent->selectData(['category_id'], 'products', ['id' => $id]);
$whereValue = ['category_id' => $getCategoryID[0]['category_id']];
$relateProductList = $eloquent->selectData(['*'], 'products', $whereValue, [], [], [], 0, ['START' => 0, 'END' => 8]);
//print_r($relateProductList);

//fetch all color for product id
$colorProductList = $eloquent->selectData(['product_color'], 'products_sc', ['product_id' => $id, 'is_delete' => '0'], [], [], ['product_color' => 'product_color']);
//print_r($colorProductList);

//fetch all size for product id
$productSizeList = $eloquent->selectData(['product_size'], 'products_sc', ['product_id' => $id, 'is_delete' => '0'], [], [], ['product_size' => 'product_size']);
//print_r($productSizeList);

//customer review
$reviewProductList = $eloquent->selectReviewProduct($id);
if ($reviewProductList != []) {
    $countReview = count($reviewProductList);
    $totalStar = 0;
    $oneStar = 0;
    $twoStar = 0;
    $threeStar = 0;
    $fourStar = 0;
    $fiveStar = 0;
    foreach ($reviewProductList as $eachReview) {
        if ($eachReview['rating'] == 1) {
            $oneStar++;
        } else if ($eachReview['rating'] == 2) {
            $twoStar++;
        } else if ($eachReview['rating'] == 3) {
            $threeStar++;
        } else if ($eachReview['rating'] == 4) {
            $fourStar++;
        } else if ($eachReview['rating'] == 5) {
            $fiveStar++;
        }
        $totalStar += $eachReview['rating'];
    }
    $avgStar = round($totalStar / $countReview, 1);
    $percentAvgStar = ($avgStar / 5) * 100;
    $percentAvgOneStar = round(($oneStar / $countReview) * 100, 0);
    $percentAvgTwoStar = round(($twoStar / $countReview) * 100, 0);
    $percentAvgThreeStar = round(($threeStar / $countReview) * 100, 0);
    $percentAvgFourStar = round(($fourStar / $countReview) * 100, 0);
    $percentAvgFiveStar = round(($fiveStar / $countReview) * 100, 0);
} else {
    $avgStar = 0;
    $percentAvgStar = 0;
    $percentAvgOneStar = 0;
    $percentAvgTwoStar = 0;
    $percentAvgThreeStar = 0;
    $percentAvgFourStar = 0;
    $percentAvgFiveStar = 0;
    $countReview = 0;
}
?>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php" rel="nofollow">Trang chủ</a>
                <a href="product-category.php"><span></span>Sản phẩm</a>
                <span></span><?= $productList[0]['product_name'] ?>
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        <figure class="border-radius-10">
                                            <img src="<?= $imageMaster ?>" alt="product image">
                                        </figure>
                                        <figure class="border-radius-10">
                                            <img src="<?= $imageOne ?>" alt="product image" class="w-100 h-100">
                                        </figure>
                                        <figure class="border-radius-10">
                                            <img src="<?= $imageTwo ?>" alt="product image" class="w-100 h-100">
                                        </figure>
                                        <figure class="border-radius-10">
                                            <img src="<?= $imageThree ?>" alt="product image" class="w-100 h-100">
                                        </figure>
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails pl-15 pr-10">
                                        <div><img src="<?= $imageMaster ?>" alt="product image"></div>
                                        <div><img src="<?= $imageOne ?>" alt="product image"></div>
                                        <div><img src="<?= $imageTwo ?>" alt="product image"></div>
                                        <div><img src="<?= $imageThree ?>" alt="product image"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <form class="detail-info">
                                    <h2 class="title-detail"><?= $productList[0]['product_name'] ?></h2>
                                    <input type="hidden" name="" id="productId" value="<?= $id ?>">
                                    <div class="product-detail-rating">
                                        <div class="pro-details-brand">
                                            <span> Brands: <a href="product.php">HTH</a></span>
                                        </div>
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:<?= $percentAvgStar ?>%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted">(<?= $countReview ?> đánh giá)</span>
                                        </div>
                                    </div>
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            <ins><span class="text-brand"><?= number_format($productList[0]['product_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span></ins>
                                            <ins><span class="old-price font-md ml-15"><?= number_format($productList[0]['virtual_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span></ins>
                                            <span class="save-price font-md color3 ml-15 text-success">
                                                (giảm giá <?= round($percentDiscountPrice * 100, 0) ?>%)
                                            </span>
                                        </div>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="short-desc mb-30">
                                        <p><?= $productList[0]['product_summary'] ?></p>
                                    </div>
                                    <div class="product_sort_info font-xs mb-30">
                                        <ul>
                                            <li class="mb-10"><i class="fi-rs-crown mr-5"></i>Bảo hành sản phẩm 1 năm</li>
                                            <!-- <li class="mb-10"><i class="fi-rs-refresh mr-5"></i> 30 Day Return Policy</li> -->
                                            <li><i class="fi-rs-credit-card mr-5"></i>Thanh toán VnPay hoặc Cod</li>
                                        </ul>
                                    </div>
                                    <div class="attr-detail attr-color mb-15">
                                        <strong class="mr-10">Màu</strong>
                                        <ul class="list-filter color-filter">
                                            <?php
                                            foreach ($colorProductList as $eachColor) {
                                                echo '<li class=""><a class="choice-color" data-color="' . $eachColor['product_color'] . '"><span class="product-color-' . $eachColor['product_color'] . '"></span></a></li>';
                                            }
                                            ?>
                                        </ul>
                                        <input type="hidden" name="val-color" id="val-color">
                                    </div>
                                    <div class="attr-detail attr-size">
                                        <strong class="mr-10">Size</strong>
                                        <ul class="list-filter size-filter font-small load-size">
                                            <?php
                                            foreach ($productSizeList as $eachSize) {
                                                echo '<li class="mr-5"><a class="choice-size" data-size="' . $eachSize['product_size'] . '">' . $eachSize['product_size'] . '</a></li>';
                                            }
                                            ?>
                                        </ul>
                                        <input type="hidden" name="val-size" id="val-size">
                                    </div>
                                    <div class="attr-detail mt-10">
                                        <span class="in-stock text-success load-status-quantity">
                                            <input type="hidden" id="idProductsSC" value="0">
                                            <p class="text-danger">Bạn chưa chọn size hoặc màu 🤔</p>
                                        </span>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                    <div class="detail-extralink">
                                        <div class="detail-qty border radius">
                                            <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                            <span class="qty-val">1</span>
                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                        <div class="product-extra-link2">
                                            <button type="submit" class="button button-add-to-cart add_to_cart">Thêm vào giỏ hàng</button>
                                            <!-- <a aria-label="Add To Wishlist" class="action-btn hover-up" href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a> -->
                                        </div>
                                    </div>
                                    <ul class="product-meta font-xs color-grey mt-50">
                                        <!-- <li class="mb-5">SKU: <a href="#">FWM15VKT</a></li> -->
                                        <li class="mb-5">Tags: <a href="#" rel="tag"><?= $productList[0]['product_tags'] ?></a></li>
                                        <!-- <li>Availability:<span class="in-stock text-success ml-5">8 Items In Stock</span></li> -->
                                    </ul>
                                </form>
                                <!-- Detail Info -->
                            </div>
                        </div>
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">MÔ TẢ</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Đánh giá (<?= $countReview ?>)</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        <p><?= $productList[0]['product_details'] ?></p>
                                        <h4 class="mt-30">Hướng dẫn chọn size</h4>
                                        <hr class="wp-block-separator is-style-wide">
                                        <p>Size M: 50-57kg / Cao 1m53 – 1m68</p>
                                        <p>Size L: 58-64kg / Cao 1m160 – 1m70</p>
                                        <p>Size XL: 65-70kg / Cao 1m70 – 1m78</p>
                                        <p>Size XXL: 71-85kg / Cao 1m78 – 1m85</p>
                                        <p>Tùy mỗi người thích body hoặc vừa người thì tăng hoặc giảm 1 size, chỉ số trên là tương đối mặc</p>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane fade" id="Additional-info">
                                    <table class="font-md">
                                        <tbody>
                                            <tr class="stand-up">
                                                <th>Stand Up</th>
                                                <td>
                                                    <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                                </td>
                                            </tr>
                                            <tr class="folded-wo-wheels">
                                                <th>Folded (w/o wheels)</th>
                                                <td>
                                                    <p>32.5″L x 18.5″W x 16.5″H</p>
                                                </td>
                                            </tr>
                                            <tr class="folded-w-wheels">
                                                <th>Folded (w/ wheels)</th>
                                                <td>
                                                    <p>32.5″L x 24″W x 18.5″H</p>
                                                </td>
                                            </tr>
                                            <tr class="door-pass-through">
                                                <th>Door Pass Through</th>
                                                <td>
                                                    <p>24</p>
                                                </td>
                                            </tr>
                                            <tr class="frame">
                                                <th>Frame</th>
                                                <td>
                                                    <p>Aluminum</p>
                                                </td>
                                            </tr>
                                            <tr class="weight-wo-wheels">
                                                <th>Weight (w/o wheels)</th>
                                                <td>
                                                    <p>20 LBS</p>
                                                </td>
                                            </tr>
                                            <tr class="weight-capacity">
                                                <th>Weight Capacity</th>
                                                <td>
                                                    <p>60 LBS</p>
                                                </td>
                                            </tr>
                                            <tr class="width">
                                                <th>Width</th>
                                                <td>
                                                    <p>24″</p>
                                                </td>
                                            </tr>
                                            <tr class="handle-height-ground-to-handle">
                                                <th>Handle height (ground to handle)</th>
                                                <td>
                                                    <p>37-45″</p>
                                                </td>
                                            </tr>
                                            <tr class="wheels">
                                                <th>Wheels</th>
                                                <td>
                                                    <p>12″ air / wide track slick tread</p>
                                                </td>
                                            </tr>
                                            <tr class="seat-back-height">
                                                <th>Seat back height</th>
                                                <td>
                                                    <p>21.5″</p>
                                                </td>
                                            </tr>
                                            <tr class="head-room-inside-canopy">
                                                <th>Head room (inside canopy)</th>
                                                <td>
                                                    <p>25″</p>
                                                </td>
                                            </tr>
                                            <tr class="pa_color">
                                                <th>Color</th>
                                                <td>
                                                    <p>Black, Blue, Red, White</p>
                                                </td>
                                            </tr>
                                            <tr class="pa_size">
                                                <th>Size</th>
                                                <td>
                                                    <p>M, S</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> -->
                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                    <div class="comments-area">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <!-- <h4 class="mb-30">Customer questions & answers</h4> -->
                                                <div class="comment-list">
                                                    <?php
                                                    if ($reviewProductList != []) {
                                                        foreach ($reviewProductList as $eachReview) {
                                                            if ($eachReview['rating'] == 1) {
                                                                $percentRating = 20;
                                                            } else if ($eachReview['rating'] == 2) {
                                                                $percentRating = 40;
                                                            } else if ($eachReview['rating'] == 3) {
                                                                $percentRating = 60;
                                                            } else if ($eachReview['rating'] == 4) {
                                                                $percentRating = 80;
                                                            } else if ($eachReview['rating'] == 5) {
                                                                $percentRating = 100;
                                                            }
                                                    ?>
                                                            <div class="single-comment justify-content-between d-flex">
                                                                <div class="user justify-content-between d-flex col-lg-12">
                                                                    <div class="thumb text-center col-md-3">
                                                                        <img src="<?= $eachReview['customer_image'] == "no-image.png" ? $GLOBALS['NO_IMAGE'] : $GLOBALS['CUSTOMER_DIRECTORY'] . $eachReview['customer_image'] ?>" alt="">
                                                                        <h5><a href="#" class="text-brand"><?= $eachReview['customer_name'] ?></a></h5>
                                                                        <!-- <p class="font-xxs"><?= $eachReview['customer_name'] ?></p> -->
                                                                    </div>
                                                                    <div class="desc col-md-9">
                                                                        <div class="product-rate d-inline-block">
                                                                            <div class="product-rating" style="width: <?= $percentRating ?>%">
                                                                            </div>
                                                                        </div>
                                                                        <p><?= $eachReview['review_details'] ?></p>
                                                                        <div class="d-flex justify-content-between">
                                                                            <div class="d-flex align-items-center">
                                                                                <p class="font-xs mr-30"><?= $eachReview['updated_at'] != null ? $eachReview['updated_at'] : $eachReview['created_at'] ?></p>
                                                                                <!-- <a href="#" class="text-brand btn-reply">Reply <i class="fi-rs-arrow-right"></i> </a> -->
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
                                                        <h4 class='mb-30 text-brand'>Chưa có đánh giá nào</h4>
                                                        </div>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <!-- <h4 class="mb-30">Customer reviews</h4> -->
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width:<?= $percentAvgStar ?>%">
                                                        </div>
                                                    </div>
                                                    <h6><?= $avgStar ?>⭐ / 5⭐</h6>
                                                </div>
                                                <div class="progress">
                                                    <span>5 ⭐</span>
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $percentAvgFiveStar ?>%;" aria-valuemin="0" aria-valuemax="100"><?= $percentAvgFiveStar ?>%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>4 ⭐</span>
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $percentAvgFourStar ?>%;" aria-valuemin="0" aria-valuemax="100"><?= $percentAvgFourStar ?>%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>3 ⭐</span>
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $percentAvgThreeStar ?>%;" aria-valuemin="0" aria-valuemax="100"><?= $percentAvgThreeStar ?>%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>2 ⭐</span>
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $percentAvgTwoStar ?>%;" aria-valuemin="0" aria-valuemax="100"><?= $percentAvgTwoStar ?>%</div>
                                                </div>
                                                <div class="progress mb-30">
                                                    <span>1 ⭐</span>
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $percentAvgOneStar ?>%;" aria-valuemin="0" aria-valuemax="100"><?= $percentAvgOneStar ?>%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-60">
                            <div class="col-12">
                                <h3 class="section-title style-1 mb-30">Sản phẩm liên quan</h3>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">
                                    <?php
                                    if ($relateProductList != [])
                                        foreach ($relateProductList as $eachRelateProduct) {
                                            $imageDefault = $GLOBALS['PRODUCT_DIRECTORY'] . $eachRelateProduct['product_master_image'];
                                            $iamgeHover = $GLOBALS['PRODUCT_DIRECTORY'] . $eachRelateProduct['product_image_one'];
                                    ?>
                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                            <div class="product-cart-wrap small hover-up">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="product-detail.php?id=<?= $eachRelateProduct['id'] ?>" tabindex="0">
                                                            <img class="default-img" src="<?= $imageDefault ?>" alt="">
                                                            <img class="hover-img" src="<?= $iamgeHover ?>" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        <!-- <span class="hot">Hot</span> -->
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h2><a href="product-detail.php?id=<?= $eachRelateProduct['id'] ?>" tabindex="0"><?= $eachRelateProduct['product_name'] ?></a></h2>
                                                    <!-- <div class="rating-result" title="90%">
                                                        <span>
                                                        </span>
                                                    </div> -->
                                                    <div class="product-price mt-5">
                                                        <span><?= number_format($eachRelateProduct['product_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span>
                                                        <span class="old-price"><?= number_format($eachRelateProduct['virtual_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                    else {
                                        echo '<h3>Không có sản phẩm liên quan</h3>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- add sitebar -->
                <?php include("./resource/views/include/site-bar.php") ?>
            </div>
        </div>
    </section>
</main>