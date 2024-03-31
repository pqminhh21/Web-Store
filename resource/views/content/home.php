<?php
// include 'app/Controllers/Controller.php';
// include 'app/Controllers/HomeController.php';
//include 'app/Models/Eloquent.php';

$homeController = new HomeController();
$eloquent = new Eloquent();

//fetch all products
$columnName = ['*'];
$tableName = 'products';
$whereValue = ['product_type' => 'Active'];
$inColumn = [];
$inValue = [];
$formatByGroup = [];
$formatByOrder = 0;

$paginate = ['START' => 0, 'END' => 8];

$productList = $eloquent->selectData($columnName, $tableName, $whereValue, $inColumn, $inValue, $formatByGroup, $formatByOrder, $paginate);
// foreach($productList as $eachProduct){
//     echo '<pre>';
//     echo $eachProduct['product_name'];
//     echo '</pre>';
// }

// líst danh muc pho bien
$subCategoryList = $eloquent->selectData(['*'], 'subcategories', [], [], [], [], 0, ['START' => 0, 'END' => 6]);
//print_r($subCategoryList);

//list product pho bien
$productListPopular = $eloquent->selectProductPopular();

//list product moi nhat
$productListNew = $eloquent->selectData(['*'], 'products', ['product_type' => 'Active'], [], [], [], ['DESC' => 'id'], ['START' => 0, 'END' => 8]);

?>
<main class="main">
    <section class="home-slider position-_status">
        <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
            <div class="single-hero-slider single-animation-wrap">
                <div class="container">
                    <div class="row align-items-center slider-animated-1">
                        <div class="col-lg-5 col-md-3">
                            <div class="hero-slider-content-2">
                                <h2 class="animated fw-500">Siêu nhiều Voucher</h2>
                                <h1 class="animated fw-500 text-brand">Dành cho tất cả sản phẩm</h1>
                                <p class="animated">Giảm giá sản phẩm lên đến 50%</p>
                                <a class="animated btn btn-brush btn-brush-3" href="product-category.php"> Mua Ngay </a>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-9">
                            <div class="single-slider-img single-slider-img-1">
                                <img class="animated slider-1-1" src="public/uploads/slides/slides2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-hero-slider single-animation-wrap">
                <div class="container">
                    <div class="row align-items-center slider-animated-1">
                        <div class="col-lg-5 col-md-3">
                            <div class="hero-slider-content-2">
                                <h2 class="animated fw-500">Xu hướng thời trang</h2>
                                <h1 class="animated fw-500 text-7">Bộ sưu tập đặc biệt</h1>
                                <p class="animated">Chương trình khuyến mãi 4 mùa</p>
                                <a class="animated btn btn-brush btn-brush-3" href="product-category.php"> Mua Ngay </a>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-9">
                            <div class="single-slider-img single-slider-img-1">
                                <img class="animated slider-1-1" src="public/uploads/slides/slides3.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="single-hero-slider single-animation-wrap">
                <div class="container">
                    <div class="row align-items-center slider-animated-1">
                        <div class="col-lg-5 col-md-3">
                            <div class="hero-slider-content-2">
                                <h2 class="animated fw-500">Xu hướng thời trang</h2>
                                <h1 class="animated fw-500 text-brand">Bộ sưu tập đặc biệt</h1>
                                <p class="animated">Chương trình khuyến mãi 4 mùa</p>
                                <a class="animated btn btn-brush btn-brush-2" href="product-category.php"> Khám Phá Ngay </a>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-9">
                            <div class="single-slider-img single-slider-img-1">
                                <img class="animated slider-1-2" style="width: 100%; height: 370px;" src="public/uploads/slides/slides3.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="slider-arrow hero-slider-1-arrow"></div>
    </section>
    <section class="featured section-padding position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="public/assets/imgs/theme/icons/feature-1.png" alt="">
                        <h4 class="bg-1">Free Shipping</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="public/assets/imgs/theme/icons/feature-2.png" alt="">
                        <h4 class="bg-3">Online Order</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="public/assets/imgs/theme/icons/feature-3.png" alt="">
                        <h4 class="bg-2">Save Money</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="public/assets/imgs/theme/icons/feature-4.png" alt="">
                        <h4 class="bg-4">Promotions</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="public/assets/imgs/theme/icons/feature-5.png" alt="">
                        <h4 class="bg-5">Happy Sell</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="public/assets/imgs/theme/icons/feature-6.png" alt="">
                        <h4 class="bg-6">24/7 Support</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-tabs section-padding position-relative wow fadeIn animated">
        <div class="bg-square"></div>
        <div class="container">
            <div class="tab-header">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Đặc sắc</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two" type="button" role="tab" aria-controls="tab-two" aria-selected="false">Phổ biến</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three" type="button" role="tab" aria-controls="tab-three" aria-selected="false">Mới</button>
                    </li>
                </ul>
                <a href="product-category.php" class="view-more d-none d-md-flex">Xem thêm<i class="fi-rs-angle-double-small-right"></i></a>
            </div>
            <!--End nav-tabs-->
            <div class="tab-content wow fadeIn animated" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">
                        <?php
                        $homeController->productLister($productList, $col = 3, ['hot' => 'hot']);
                        ?>
                    </div>
                    <!--End product-grid-4-->
                </div>
                <!--En tab one (Featured)-->
                <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="tab-two">
                    <div class="row product-grid-4">
                        <?php
                        $homeController->productLister($productListPopular, $col = 3, ['best' => 'best sell']);
                        ?>
                    </div>
                    <!--End product-grid-4-->
                </div>
                <!--En tab two (Popular)-->
                <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="tab-three">
                    <div class="row product-grid-4">
                        <?php
                        $homeController->productLister($productListNew, $col = 3, ['new' => 'new']);
                        ?>
                    </div>
                    <!--End product-grid-4-->
                </div>
                <!--En tab three (New added)-->
            </div>
            <!--End tab-content-->
        </div>
    </section>
    <section class="popular-categories section-padding mt-15 mb-25">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20"><span>Danh Mục</span> Phổ Biến</h3>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows"></div>
                <div class="carausel-6-columns" id="carausel-6-columns">
                    <?php
                    foreach ($subCategoryList as $eachSubCategory) {
                        $imageSubCategory = $GLOBALS['BANNER_DIRECTORY'] . $eachSubCategory['subcategory_banner'];
                    ?>
                        <div class="card-1">
                            <figure class="img-hover-scale overflow-hidden">
                                <a style="width: 100%; height: 100px;" href="product-category.php?subCategoryId=<?= $eachSubCategory['id'] ?>"><img class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;" src="<?= $imageSubCategory ?>" alt=""></a>
                            </figure>
                            <h5><a href="product-category.php?subCategoryId=<?= $eachSubCategory['id'] ?>"><?= $eachSubCategory['subcategory_name'] ?></a></h5>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="banners mb-15">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="banner-img wow fadeIn animated">
                        <img src="public/assets/imgs/banner/banner-1.png" alt="">
                        <div class="banner-text">
                            <span>Smart Offer</span>
                            <h4>Save 20% on <br>Woman Bag</h4>
                            <a href="shop.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="banner-img wow fadeIn animated">
                        <img src="public/assets/imgs/banner/banner-2.png" alt="">
                        <div class="banner-text">
                            <span>Sale off</span>
                            <h4>Great Summer <br>Collection</h4>
                            <a href="shop.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-md-none d-lg-flex">
                    <div class="banner-img wow fadeIn animated  mb-sm-0">
                        <img src="public/assets/imgs/banner/banner-3.png" alt="">
                        <div class="banner-text">
                            <span>New Arrivals</span>
                            <h4>Shop Today’s <br>Deals & Offers</h4>
                            <a href="shop.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <section class="section-padding">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20"><span>Sản Phẩm</span> Nổi Bật</h3>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows"></div>
                <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                    <?php
                    foreach ($productListPopular as $eachProduct) {
                        $imageProductDefault = $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_master_image'];
                        $imageProductHover = $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_image_one'];
                    ?>
                        <div class="product-cart-wrap small hover-up">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="product-detail.php?id=<?= $eachProduct['id'] ?>">
                                        <img class="default-img" src="<?= $imageProductDefault ?>" alt="">
                                        <img class="hover-img w-100 h-100" src="<?= $imageProductHover ?>" alt="">
                                    </a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">Hot</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <h2><a href="product-detail.php?id=<?= $eachProduct['id'] ?>"><?= $eachProduct['product_name'] ?></a></h2>
                                <div class="product-price mt-5">
                                    <span><?= number_format($eachProduct['product_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span>
                                    <span class="old-price"><?= number_format($eachProduct['product_price'] *= 1.1, 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>