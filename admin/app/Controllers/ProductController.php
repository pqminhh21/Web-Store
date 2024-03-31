<?php
class ProductController extends Controller
{
    public function ProductList($productList)
    {
        foreach ($productList as $eachProduct) {
            $imageProduct = $eachProduct['product_master_image'] == '' ? $GLOBALS['NO_IMAGE'] : $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_master_image'];
?>
            <tr>
                <td><?= $eachProduct['id'] ?></td>
                <td><img style="width: 80px;" class="img-fluid rounded mx-auto d-block" src="<?= $imageProduct ?>" alt="#"></td>
                <td><?= $eachProduct['product_name'] ?></td>
                <td><?= number_format($eachProduct['product_price'], 0, ',', '.') . $GLOBALS['CURRENCY']?></td>
                <td><?= $eachProduct['subcategory_name'] ?></td>
                <td>
                    <span class="<?= $eachProduct['product_type'] == 'Active' ? 'text-success' : 'text-warning' ?>">
                        <?= $eachProduct['product_type'] ?>
                    </span>
                </td>
                <td>
                    <span class="<?= $eachProduct['product_type'] == 'YES' ? 'text-success' : 'text-warning' ?>">
                        <?= $eachProduct['product_featured'] ?>
                    </span>
                </td>
                <td><?= $eachProduct['created_at'] ?></td>
                <td>
                    <span>
                        <a class="btn btn-info mb-1" href="product-detail.php?id=<?= $eachProduct['id'] ?>" data-toggle="tooltip" data-placement="top" title="View Detail">
                            <i class="fa fa-eye color-muted"></i>
                        </a>
                        <a class="btn btn-primary mb-1" href="manage-product.php?id=<?= $eachProduct['id'] ?>" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-pencil color-muted"></i>
                        </a>
                        <a class="btn btn-danger mb-1 sweet-confirm-custom sweet-confirm-product" href="#" data-itemid="<?= $eachProduct['id'] ?>" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="fa fa-trash color-danger"></i>
                        </a>
                    </span>
                </td>
            </tr>
<?php
        }
    }
}
?>