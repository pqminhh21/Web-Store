<?php
class ProductSoldController extends Controller
{
    public function ProductList($productList)
    {
        $i = 0;
        foreach ($productList as $eachProduct) {
            $imageProduct = $eachProduct['product_master_image'] == '' ? $GLOBALS['NO_IMAGE'] : $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_master_image'];
            $productSold = $eachProduct['quantity_sold'] == '' ? 0 : $eachProduct['quantity_sold'];
?>
            <tr>
                <td><?= ++$i ?></td>
                <td><img style="width: 80px;" class="img-fluid rounded mx-auto d-block" src="<?= $imageProduct ?>" alt="#"></td>
                <td><a href="product-detail.php?id=<?= $eachProduct['productId'] ?>">
                        <?= $eachProduct['product_name'] ?>
                    </a></td>
                <td><?= $eachProduct['subcategory_name'] ?></td>
                <td><?= number_format($eachProduct['productPrice'], 0, ',', '.') . $GLOBALS['CURRENCY'] ?></td>
                <td>
                    <span class="text-success">
                        <?= $productSold ?>
                    </span>
                </td>
            </tr>
<?php
        }
    }
}
?>