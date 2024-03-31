<?php
class HomeController extends Controller
{
    public function productLister($productList, $col = 3, $typeCard = ['' => ''])
    {
        foreach ($productList as $eachProduct) {
            if (empty($eachProduct['product_master_image']))
                $productImage = $GLOBALS['PRODUCT_DIRECTORY'] . "Image_not_available.png";
            else
                $productImage = $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_master_image'];
            echo '<div class="col-lg-' . $col . ' col-md-4 col-sm-6 col-xs-6 col-6">
                <div class="product-cart-wrap mb-30">
                    <div class="product-img-action-wrap">
                        <div class="product-img product-img-zoom">
                            <a href="product-detail.php?id=' . $eachProduct['id'] . '">
                                <img class="default-img" src="' . $productImage . '" alt="">
                            </a>
                        </div>
                        
                        <div class="product-badges product-badges-position product-badges-mrg">
                            <span class="' . key($typeCard) . '">' . ucwords($typeCard[key($typeCard)]) . '</span>
                        </div>
                    </div>
                    <div class="product-content-wrap">
                        <h2><a href="product-detail.php?id=' . $eachProduct['id'] . '">' . $eachProduct['product_name'] . '</a></h2>
                        <div class="product-price">
                            <span>' . number_format($eachProduct['product_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] . '</span>
                            <span class="old-price">' . number_format($eachProduct['virtual_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] . '</span>
                        </div>
                        <form class="product-action-1 show">
                            <input type="hidden" id="cart_product_name_' . $eachProduct['id'] . '" value="' . $eachProduct['product_name'] . '"/>
                            <input type="hidden" id="qty_' . $eachProduct['id'] . '" value="1"/>
                            <a href="product-detail.php?id=' . $eachProduct['id'] . '" aria-label="Mua ngay" class="action-btn hover-up">
                                <i class="fi-rs-shopping-bag-add"></i>
                            </a>
                        </form>
                    </div>
                </div>
            </div>';
        }
    }
}

// <button data-itemid="'.$eachProduct['id'].'" aria-label="Thêm giỏ hàng" class="action-btn hover-up add_to_cart">
//                                 <i class="fi-rs-shopping-bag-add"></i>
//                             </button>
// <button data-itemid="' . $eachProduct['id'] . '" aria-label="Yêu thích" class="action-btn hover-up add_to_favourite">
//                                 <i class="fi-rs-heart"></i>
//                             </button>
