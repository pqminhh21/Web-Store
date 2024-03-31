<!DOCTYPE html>
<html class="no-js" lang="en">
<!-- no-js -->

<head>
    <meta charset="utf-8">
    <title>Hello Store</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" type="image/x-icon" href="public/assets/imgs/theme/favicon16.ico">
    <link rel="stylesheet" href="public/assets/css/main.css">
    <link rel="stylesheet" href="public/assets/css/custom.css">
    <link rel="stylesheet" href="public/assets/css/toastr.css">
    <link rel="stylesheet" href="public/assets/css/invoice.css">
    <link rel="stylesheet" href="public/assets/css/popup-review.css">
    <link rel="stylesheet" href="public/assets/css/scroll.css">
    <style>
        .load-customer {
            width: 100%;
            height: 100%;
            background: #fff;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 999999;
            display: block;
            overflow: hidden;
        }

        .load-customer img {
            position: absolute;
            width: 70px;
            height: 70px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
        }
    </style>
</head>
<body class="preloading">
    <div class="load-customer">
        <img src="public/assets/imgs/loading/load70px.gif" alt="">
    </div>
    <?php
    include 'app/Controllers/Controller.php';
    include 'app/Controllers/HomeController.php';
    include 'app/Models/Eloquent.php';
    $eloquent = new Eloquent();

    //fetch all products
    $columnName = ['*'];
    $tableName = 'categories';
    $whereValue = ['category_status' => 'Active', 'is_delete' => '0'];
    $categoryList = $eloquent->selectData($columnName, $tableName, $whereValue);

    ?>
    <header class="header-area header-style-1 header-height-2">
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                <ul style="line-height: 1.1;">
                                    <!-- <li>Giữa tháng giảm giá đến 50% cho toàn bộ sản phẩm <a href="product-detail.php">Chi tiết</a></li> -->
                                    <li>Free Ship - Đơn hàng trên 200k</li>
                                    <li>Áo thun basic giảm giá lên đến 35% <a href="product-category.php">Mua ngay!</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                <li>
                                    <?php
                                    if (isset($_SESSION['SSCF_login_id'])) {
                                        echo '<i class="fi-rs-user"></i><a href="my-account.php" class="customer_name_top">' . $_SESSION['SSCF_login_user_name'] . '</a>';
                                        echo '<span>/</span>';
                                        echo '<a href="?exit=yes">Đăng xuất</a>';
                                    } else {
                                        echo '<i class="fi-rs-key"></i><a href="login.php">Đăng nhập</a>';
                                        echo '<span>/</span>';
                                        echo '<a href="register.php">Đăng ký</a>';
                                    }
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="index.php"><img src="public/assets/imgs/logo/logoshop2023.png" alt="logo"></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-1">
                            <form action="product-category.php" method="POST">
                                <input type="text" name="keywords" placeholder="Tìm kiếm sản phẩm..." required>
                            </form>
                        </div>
                        <div class="header-action-right">
                            <p><span>Xin Chào</span>
                                <span class="customer_name_top">
                                    <?php
                                    if (@$_SESSION['SSCF_login_id'] > 0) {
                                        echo '<b>' . @$_SESSION['SSCF_login_user_name'] . '</b>';
                                    } else {
                                        echo '<b> khách hàng </b>';
                                    }
                                    ?>
                                </span>
                                <span>&#9829;</span>
                            </p>
                            <!-- <div class="header-action-2">
                                <div class="header-action-icon-2">
                                    <a href="favorites-list.php">
                                        <img class="svgInject" alt="Surfside Media" src="public/assets/imgs/theme/icons/icon-heart.svg">
                                        <span class="pro-count blue">...</span>
                                    </a>
                                </div>
                                <div class="header-action-icon-2 cart_product">
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="index.php"><img src="public/assets/imgs/logo/logoshop2023.png" alt="logo"></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li><a class="active" href="index.php">Trang chủ </a></li>
                                    <!-- <li><a href="about.html">About</a></li> -->
                                    <li><a id="main_product_id" href="product-category.php">Sản phẩm </a></li>
                                    <li class="position-static"><a href="#">Danh mục <i class="fi-rs-angle-down"></i></a>
                                        <ul class="mega-menu row" style="margin-left: 1px;">
                                            <?php
                                            foreach ($categoryList as $eachCategory) {
                                            ?>
                                                <li class="sub-mega-menu sub-mega-menu-width-25 col-md-3 mt-3">
                                                    <a class="menu-title" href="product-category.php?categoryId=<?= $eachCategory['id'] ?>">
                                                        <?= $eachCategory['category_name'] ?>
                                                    </a>
                                                    <?php
                                                    $columnName = ['*'];
                                                    $tableName = 'subcategories';
                                                    $whereValue = [
                                                        'subcategory_status' => 'Active',
                                                        'category_id' => $eachCategory['id'],
                                                        'is_delete' => '0'
                                                    ];
                                                    // $inColumn = ['category_id', 'subcategory_status'];
                                                    // $inValue = [$eachCategory['id'], 1];
                                                    $subCategoryList = $eloquent->selectData($columnName, $tableName, $whereValue);
                                                    ?>
                                                    <ul>
                                                        <?php
                                                        foreach ($subCategoryList as $eachSubCategory) {
                                                        ?>
                                                            <li><a href="product-category.php?subCategoryId=<?= $eachSubCategory['id'] ?>"><?= $eachSubCategory['subcategory_name'] ?></a></li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                            <li class="sub-mega-menu sub-mega-menu-width-30 col-md-3">
                                                <div class="menu-banner-wrap">
                                                    <a href="product-detail.php"><img class="img-fluid" src="public/assets/imgs/banner/menclothing.jpg" alt=""></a>
                                                    <!-- <div class="menu-banner-content">
                                                        <h4>Hot deals</h4>
                                                        <h3>Don't miss<br> Trending</h3>
                                                        <div class="menu-banner-price">
                                                            <span class="new-price text-success">Save to 50%</span>
                                                        </div>
                                                        <div class="menu-banner-btn">
                                                            <a href="product-details.html">Shop now</a>
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="menu-banner-discount">
                                                        <h3>
                                                            <span>35%</span>
                                                            off
                                                        </h3>
                                                    </div> -->
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- <li><a href="blog.html">Blog </a></li>
                                    <li><a href="contact.html">Liên hệ </a></li> -->
                                    <li class="<?= @$_SESSION['SSCF_login_id'] > 0 ? '' : 'd-none' ?>"><a href="my-account.php">Tài khoản<i class="fi-rs-angle-downsss"></i></a>
                                        <!-- <ul class="sub-menu">
                                            <li><a href="#">Thông tin</a></li>
                                            <li><a href="#">Đơn hàng</a></li>
                                            <li><a href="#">Sản phẩm yêu thích</a></li>
                                            <li><a href="#">Đánh giá</a></li>
                                            <?php echo '<li><a href="?exit=yes">Đăng xuất</a></li>'; ?>
                                        </ul> -->
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-block">
                        <!-- <p>🤗<span>Xin Chào</span>
                            <?php
                            if (@$_SESSION['SSCF_login_id'] > 0) {
                                echo '<b>' . @$_SESSION['SSCF_login_user_name'] . '</b>';
                            } else {
                                echo '<b> khách hàng </b>';
                            }
                            ?>
                        </p> -->

                        <!-- cart and wishlish -->
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <!-- comming favorites -->
                                <!-- <div class="header-action-icon-2">
                                    <a href="favorites-list.php">
                                        <img class="svgInject" alt="Surfside Media" src="public/assets/imgs/theme/icons/icon-heart.svg">
                                        <span class="pro-count blue">...</span>
                                    </a>
                                </div> -->
                                <div class="header-action-icon-2 cart_product">
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="mobile-promotion">Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to 40%</p>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <!-- comming soon favorites -->
                            <!-- <div class="header-action-icon-2">
                                <a href="favorites-list.php">
                                    <img alt="Surfside Media" src="public/assets/imgs/theme/icons/icon-heart.svg">
                                    <span class="pro-count white">4</span>
                                </a>
                            </div> -->
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="cart.php">
                                    <img alt="Surfside Media" src="public/assets/imgs/theme/icons/icon-cart.svg">
                                    <span class="pro-count white">2</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="product-details.html"><img alt="Surfside Media" src="public/assets/imgs/shop/thumbnail-3.jpg"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="product-details.html">Plain Striola Shirts</a></h4>
                                                <h3><span>1 × </span>$800.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="product-details.html"><img alt="Surfside Media" src="public/assets/imgs/shop/thumbnail-4.jpg"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="product-details.html">Macbook Pro 2022</a></h4>
                                                <h3><span>1 × </span>$3500.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$383.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="cart.php">View cart</a>
                                            <a href="shop-checkout.php">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="index.php"><img src="public/assets/imgs/logo/logoshop2023.png" alt="logo"></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" placeholder="Search for items…">
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <div class="main-categori-wrap mobile-header-border">
                        <a class="categori-button-active-2" href="#">
                            <span class="fi-rs-apps"></span> Browse Categories
                        </a>
                        <div class="categori-dropdown-wrap categori-dropdown-active-small">
                            <ul>
                                <li><a href="shop.html"><i class="surfsidemedia-font-dress"></i>Women's Clothing</a></li>
                                <li><a href="shop.html"><i class="surfsidemedia-font-tshirt"></i>Men's Clothing</a></li>
                                <li><a href="shop.html"><i class="surfsidemedia-font-smartphone"></i> Cellphones</a></li>
                                <li><a href="shop.html"><i class="surfsidemedia-font-desktop"></i>Computer & Office</a></li>
                                <li><a href="shop.html"><i class="surfsidemedia-font-cpu"></i>Consumer Electronics</a></li>
                                <li><a href="shop.html"><i class="surfsidemedia-font-home"></i>Home & Garden</a></li>
                                <li><a href="shop.html"><i class="surfsidemedia-font-high-heels"></i>Shoes</a></li>
                                <li><a href="shop.html"><i class="surfsidemedia-font-teddy-bear"></i>Mother & Kids</a></li>
                                <li><a href="shop.html"><i class="surfsidemedia-font-kite"></i>Outdoor fun</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="index.html">Home</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="shop.html">Sản phẩm</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Danh mục</a>
                                <ul class="dropdown">
                                    <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Women's Fashion</a>
                                        <ul class="dropdown">
                                            <li><a href="product-details.html">Dresses</a></li>
                                            <li><a href="product-details.html">Blouses & Shirts</a></li>
                                            <li><a href="product-details.html">Hoodies & Sweatshirts</a></li>
                                            <li><a href="product-details.html">Women's Sets</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Men's Fashion</a>
                                        <ul class="dropdown">
                                            <li><a href="product-details.html">Jackets</a></li>
                                            <li><a href="product-details.html">Casual Faux Leather</a></li>
                                            <li><a href="product-details.html">Genuine Leather</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Technology</a>
                                        <ul class="dropdown">
                                            <li><a href="product-details.html">Gaming Laptops</a></li>
                                            <li><a href="product-details.html">Ultraslim Laptops</a></li>
                                            <li><a href="product-details.html">Tablets</a></li>
                                            <li><a href="product-details.html">Laptop Accessories</a></li>
                                            <li><a href="product-details.html">Tablet Accessories</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="blog.html">Blog</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Language</a>
                                <ul class="dropdown">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">German</a></li>
                                    <li><a href="#">Spanish</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap mobile-header-border">
                    <div class="single-mobile-header-info mt-30">
                        <a href="contact.html"> Our location </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="login.html">Log In </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="register.html">Sign Up</a>
                    </div>
                    <div class="single-mobile-header-info">
                        <!-- <a href="#">Xin chào HieuDev </a> -->
                        <?php
                        if (@$_SESSION['SSCF_login_id'] > 0) {
                            echo '<b>' . @$_SESSION['SSCF_login_user_name'] . '</b>';
                        } else {
                            echo '<b> khách hàng </b>';
                        }
                        ?>
                    </div>
                </div>
                <div class="mobile-social-icon">
                    <h5 class="mb-15 text-grey-4">Follow Us</h5>
                    <a href="#"><img src="public/assets/imgs/theme/icons/icon-facebook.svg" alt=""></a>
                    <a href="#"><img src="public/assets/imgs/theme/icons/icon-twitter.svg" alt=""></a>
                    <a href="#"><img src="public/assets/imgs/theme/icons/icon-instagram.svg" alt=""></a>
                    <a href="#"><img src="public/assets/imgs/theme/icons/icon-pinterest.svg" alt=""></a>
                    <a href="#"><img src="public/assets/imgs/theme/icons/icon-youtube.svg" alt=""></a>
                </div>
            </div>
        </div>
    </div>