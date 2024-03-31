<?php
include('app/Controllers/SearchController.php');

$homeController = new HomeController();
$eloquent = new Eloquent();
$searchCtrl = new SearchController;

$price = "";
$color = "";

//check keywords
if (isset($_POST['keywords'])) {
    //list product search
    $keywords = strip_tags($_POST['keywords']);
    $productList = $searchCtrl->searchProduct($keywords, 0, 100);
    $productNameSearch = $keywords;
} else if (isset($_GET['tags'])) {
    //list product search
    $keywords = strip_tags($_GET['tags']);
    $productList = $searchCtrl->searchProduct($keywords, 0, 100);
    $productNameSearch = $keywords;
} else if (isset($_POST['submit-fillter'])) {
    //list product search price and color fillter
    $columnName = ['*'];
    $tableName = 'products';
    if (isset($_POST['checkbox-price']) && !isset($_POST['checkbox-color'])) {
        $price = $_POST['checkbox-price'];
        if ($_POST['checkbox-price'] == "300k-399k") {
            $priceMin = 300000;
            $priceMax = 399000;
        } else if ($_POST['checkbox-price'] == "200k-299k") {
            $priceMin = 200000;
            $priceMax = 299000;
        } else if ($_POST['checkbox-price'] == "<200k") {
            $priceMin = 0;
            $priceMax = 200000;
        } else if ($_POST['checkbox-price'] == ">400k") {
            $priceMin = 400000;
            $priceMax = 100000000;
        }
        $whereValue = [
            'MIN' => $priceMin,
            'MAX' => $priceMax
        ];
        $productList = $eloquent->selectProductPrice($whereValue);
        $productNameSearch = '';
    } else if (isset($_POST['checkbox-color']) && !isset($_POST['checkbox-price'])) {
        $color = $_POST['checkbox-color'];
        $productList = $eloquent->selectProductColor($color);
        $productNameSearch = '';
    } else if (isset($_POST['checkbox-price']) && isset($_POST['checkbox-color'])) {
        $price = $_POST['checkbox-price'];
        $color = $_POST['checkbox-color'];
        if ($_POST['checkbox-price'] == "300k-399k") {
            $priceMin = 300000;
            $priceMax = 399000;
        } else if ($_POST['checkbox-price'] == "200k-299k") {
            $priceMin = 200000;
            $priceMax = 299000;
        } else if ($_POST['checkbox-price'] == "<200k") {
            $priceMin = 0;
            $priceMax = 200000;
        } else if ($_POST['checkbox-price'] == ">400k") {
            $priceMin = 400000;
            $priceMax = 100000000;
        }
        $priceArr = [
            'MIN' => $priceMin,
            'MAX' => $priceMax
        ];
        $productList = $eloquent->selectProductPriceAndColor($priceArr, $color);
        $productNameSearch = '';
    } else if (!isset($_POST['checkbox-price']) && !isset($_POST['checkbox-color'])) {
        $productList = $eloquent->selectData($columnName, $tableName, ['is_delete' => '0', 'product_type' => 'Active']);
        $productNameSearch = '';
    }
} else if (isset($_GET['price']) && !isset($_GET['color'])) {
    $columnName = ['*'];
    $tableName = 'products';
    $price = $_GET['price'];
    if ($_GET['price'] == "300k-399k") {
        $priceMin = 300000;
        $priceMax = 399000;
    } else if ($_GET['price'] == "200k-299k") {
        $priceMin = 200000;
        $priceMax = 299000;
    } else if ($_GET['price'] == "<200k") {
        $priceMin = 0;
        $priceMax = 200000;
    } else if ($_GET['price'] == ">400k") {
        $priceMin = 400000;
        $priceMax = 100000000;
    }
    $whereValue = [
        'MIN' => $priceMin,
        'MAX' => $priceMax
    ];
    $productList = $eloquent->selectProductPrice($whereValue);
    $productNameSearch = '';
} else if (isset($_GET['color']) && !isset($_GET['price'])) {
    $color = $_GET['color'];
    $productList = $eloquent->selectProductColor($color);
    $productNameSearch = '';
} else if (isset($_GET['price']) && isset($_GET['color'])) {
    $price = $_GET['price'];
    $color = $_GET['color'];
    // echo $price;
    // echo $color;
    if ($_GET['price'] == "300k-399k") {
        $priceMin = 300000;
        $priceMax = 399000;
    } else if ($_GET['price'] == "200k-299k") {
        $priceMin = 200000;
        $priceMax = 299000;
    } else if ($_GET['price'] == "<200k") {
        $priceMin = 0;
        $priceMax = 200000;
    } else if ($_GET['price'] == ">400k") {
        $priceMin = 400000;
        $priceMax = 100000000;
    }
    $priceArr = [
        'MIN' => $priceMin,
        'MAX' => $priceMax
    ];
    $productList = $eloquent->selectProductPriceAndColor($priceArr, $color);
    $productNameSearch = '';
} else if (isset($_GET['subCategoryId'])) {
    //tim san pham theo subcategory
    if (is_numeric($_GET['subCategoryId']) == false) {
        echo "<script>window.location.href = 'not-found.php';</script>";
    }
    $columnName = ['*'];
    $tableName = 'products';
    $whereValue = [
        'subcategory_id' => $_GET['subCategoryId'],
        'is_delete' => '0',
        'product_type' => 'Active'
    ];
    $productList = $eloquent->selectData($columnName, $tableName, $whereValue);
    if ($productList == []) {
        $productNameSearch = '';
    } else $productNameSearch = $eloquent->selectData(['*'], 'subcategories', ['id' => $_GET['subCategoryId']])[0]['subcategory_name'];
} else if (isset($_GET['categoryId'])) {
    //tim san pham theo category
    if (is_numeric($_GET['categoryId']) == false) {
        echo "<script>window.location.href = 'not-found.php';</script>";
    }
    $columnName = ['*'];
    $tableName = 'products';
    $whereValue = [
        'category_id' => $_GET['categoryId'],
        'is_delete' => '0',
        'product_type' => 'Active'
    ];
    $productList = $eloquent->selectData($columnName, $tableName, $whereValue);
    if ($productList == []) {
        $productNameSearch = '';
    } else $productNameSearch = $eloquent->selectData(['*'], 'categories', ['id' => $_GET['categoryId']])[0]['category_name'];
} else {
    //ko tim san pham ma click vao trang san pham
    $columnName = ['*'];
    $tableName = 'products';
    $productList = $eloquent->selectData($columnName, $tableName, ['is_delete' => '0', 'product_type' => 'Active']);
    $productNameSearch = '';
}
$countItem = $productList != [] ? count($productList) : 0;

//phan trang
if (!empty($productList)) {
    // nod = Number of Data
    $nod = $countItem;
    // rpp = Result Per Page
    if ($nod > 12) {
        $rpp = 12;
    } else {
        $rpp = $nod;
    }
    // nop = Number of Page
    $nop = ceil($nod / $rpp);
    // defaul page no 1
    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    // cp = Current Page
    $cp = ($page - 1) * $rpp;

    $text = 0;
    if ($text >= $nod) {
        $text = $nod;
    } else if ($text <= $nod) {
        $text = $rpp * $page;
    }

    $url = "";
    if (isset($_POST['keywords'])) {
        //list product search
        $keywords = strip_tags($_POST['keywords']);
        $url = 'tags=' . $keywords . '&';
        $productList = $searchCtrl->searchProduct($keywords, $cp, $rpp);
        $productNameSearch = $keywords;
    } else if (isset($_GET['tags'])) {
        //list product search
        $keywords = strip_tags($_GET['tags']);
        $url = 'tags=' . $keywords . '&';
        $productList = $searchCtrl->searchProduct($keywords, $cp, $rpp);
        $productNameSearch = $keywords;
    } else if (isset($_POST['submit-fillter'])) {
        //list product search price and color fillter
        $columnName = ['*'];
        $tableName = 'products';
        if (isset($_POST['checkbox-price'])) {
            $url = 'price=' . $_POST['checkbox-price'] . '&';
            $price = $_POST['checkbox-price'];
            $price = $_POST['checkbox-price'];
            if ($_POST['checkbox-price'] == "300k-399k") {
                $priceMin = 300000;
                $priceMax = 399000;
            } else if ($_POST['checkbox-price'] == "200k-299k") {
                $priceMin = 200000;
                $priceMax = 299000;
            } else if ($_POST['checkbox-price'] == "<200k") {
                $priceMin = 0;
                $priceMax = 200000;
            } else if ($_POST['checkbox-price'] == ">400k") {
                $priceMin = 400000;
                $priceMax = 100000000;
            }
            $whereValue = [
                'MIN' => $priceMin,
                'MAX' => $priceMax
            ];
            $productList = $eloquent->selectProductPrice($whereValue, ['START' => $cp, 'END' => $rpp]);
            $productNameSearch = '';
        } else if (isset($_POST['checkbox-color'])) {
            $url = 'color=' . $_POST['checkbox-color'] . '&';
            $color = $_POST['checkbox-color'];
            $productList = $eloquent->selectProductColor($color, ['START' => $cp, 'END' => $rpp]);
            $productNameSearch = '';
        }
        if (isset($_POST['checkbox-price']) && isset($_POST['checkbox-color'])) {
            $url = 'price=' . $_POST['checkbox-price'] . '&color=' . $_POST['checkbox-color'] . '&';
            $price = $_POST['checkbox-price'];
            $color = $_POST['checkbox-color'];
            if ($_POST['checkbox-price'] == "300k-399k") {
                $priceMin = 300000;
                $priceMax = 399000;
            } else if ($_POST['checkbox-price'] == "200k-299k") {
                $priceMin = 200000;
                $priceMax = 299000;
            } else if ($_POST['checkbox-price'] == "<200k") {
                $priceMin = 0;
                $priceMax = 200000;
            } else if ($_POST['checkbox-price'] == ">400k") {
                $priceMin = 400000;
                $priceMax = 100000000;
            }
            $priceArr = [
                'MIN' => $priceMin,
                'MAX' => $priceMax
            ];
            $productList = $eloquent->selectProductPriceAndColor($priceArr, $color, ['START' => $cp, 'END' => $rpp]);
            $productNameSearch = '';
        } else if (!isset($_POST['checkbox-price']) && !isset($_POST['checkbox-color'])) {
            $productList = $eloquent->selectData($columnName, $tableName, ['is_delete' => '0', 'product_type' => 'Active'], [], [], [], ['ASC' => 'id'], ['START' => $cp, 'END' => $rpp]);
            $productNameSearch = '';
        }
    } else if (isset($_GET['price'])) {
        $url = 'price=' . $_GET['price'] . '&';
        $price = $_GET['price'];
        if ($_GET['price'] == "300k-399k") {
            $priceMin = 300000;
            $priceMax = 399000;
        } else if ($_GET['price'] == "200k-299k") {
            $priceMin = 200000;
            $priceMax = 299000;
        } else if ($_GET['price'] == "<200k") {
            $priceMin = 0;
            $priceMax = 200000;
        } else if ($_GET['price'] == ">400k") {
            $priceMin = 400000;
            $priceMax = 100000000;
        }
        $whereValue = [
            'MIN' => $priceMin,
            'MAX' => $priceMax
        ];
        $productList = $eloquent->selectProductPrice($whereValue, ['START' => $cp, 'END' => $rpp]);
        $productNameSearch = '';
    } else if (isset($_GET['color'])) {
        $url = 'color=' . $_GET['color'] . '&';
        $color = $_GET['color'];
        $productList = $eloquent->selectProductColor($color, ['START' => $cp, 'END' => $rpp]);
        $productNameSearch = '';
    } else if (isset($_GET['price']) && isset($_GET['color'])) {
        $url = 'price=' . $_GET['price'] . '&color=' . $_GET['color'] . '&';
        $price = $_GET['price'];
        $color = $_GET['color'];
        if ($_GET['price'] == "300k-399k") {
            $priceMin = 300000;
            $priceMax = 399000;
        } else if ($_GET['price'] == "200k-299k") {
            $priceMin = 200000;
            $priceMax = 299000;
        } else if ($_GET['price'] == "<200k") {
            $priceMin = 0;
            $priceMax = 200000;
        } else if ($_GET['price'] == ">400k") {
            $priceMin = 400000;
            $priceMax = 100000000;
        }
        $priceArr = [
            'MIN' => $priceMin,
            'MAX' => $priceMax
        ];
        $productList = $eloquent->selectProductPriceAndColor($priceArr, $color, ['START' => $cp, 'END' => $rpp]);
        $productNameSearch = '';
    } else if (isset($_GET['subCategoryId'])) {
        //tim san pham theo subcategory
        $url = 'subCategoryId=' . $_GET['subCategoryId'] . '&';
        $columnName = ['*'];
        $tableName = 'products';
        $whereValue = ['subcategory_id' => $_GET['subCategoryId']];
        $productList = $eloquent->selectData($columnName, $tableName, $whereValue, [], [], [], ['DESC' => 'id'], ['START' => $cp, 'END' => $rpp]);
        $productNameSearch = $eloquent->selectData(['*'], 'subcategories', ['id' => $_GET['subCategoryId']])[0]['subcategory_name'];
    } else if (isset($_GET['categoryId'])) {
        //tim san pham theo category
        $url = 'categoryId=' . $_GET['categoryId'] . '&';
        $columnName = ['*'];
        $tableName = 'products';
        $whereValue = ['category_id' => $_GET['categoryId']];
        $productList = $eloquent->selectData($columnName, $tableName, $whereValue, [], [], [], ['DESC' => 'id'], ['START' => $cp, 'END' => $rpp]);
        $productNameSearch = $eloquent->selectData(['*'], 'categories', ['id' => $_GET['categoryId']])[0]['category_name'];
    } else {
        //ko tim san pham ma click vao trang san pham
        $columnName = ['*'];
        $tableName = 'products';
        $productList = $eloquent->selectData($columnName, $tableName, ['is_delete' => '0', 'product_type' => 'Active'], [], [], [], ['ASC' => 'id'], ['START' => $cp, 'END' => $rpp]);
        $productNameSearch = '';
    }

    $previous = $page - 1;
    $next = $page + 1;

    $pageNumber = '';
    for ($i = 1; $i <= $nop; $i++) {
        if ($i == $page) $type = 'active';
        else $type = '';
        $pageNumber .= '<li class="page-item ' . $type . '"><a class="page-link" href="product-category.php?' . $url . 'page=' . $i . '">' . $i . '</a></li>';
    }
}
?>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Trang chủ</a>
                <span></span> Sản phẩm
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>Chúng tôi tìm thấy <strong class="text-brand"><?= $countItem ?></strong> sản phẩm
                                <strong class="text-brand"><?php echo $productNameSearch ?></strong>
                            </p>
                            <p>
                                <?php
                                if (!empty($productList)) {
                                    if ($text >= $countItem)
                                        $text = $countItem;
                                    echo '<label>📋Kết quả: ' . ($cp + 1) . '&rarr;' . $text . '</label>';
                                }
                                ?>
                            </p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span>💸 <?= $price ?> | 🌈 <?= $color ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid-3">
                        <?php
                        if ($productList != null)
                            $homeController->productLister($productList, $col = 4, ['hot' => 'hot']);
                        ?>
                    </div>
                    <!--pagination-->
                    <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item"><a class="page-link" href="product-category.php?<?= $url ?>page=<?= $previous < 1 ? 1 : $previous ?>"><i class="fi-rs-angle-double-small-left"></i></a></li>
                                <?php
                                if (!empty($productList))
                                    echo $pageNumber;
                                ?>
                                <li class="page-item"><a class="page-link" href="product-category.php?<?= $url ?>page=<?= $next > $nop ? $nop : $next ?>"><i class="fi-rs-angle-double-small-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <?php include("./resource/views/include/site-bar.php") ?>
            </div>
        </div>
    </section>
</main>