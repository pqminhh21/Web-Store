<?php
class DiscountController extends Controller
{
    public function DiscountList($discountList)
    {
        foreach ($discountList as $eachDiscount) {
            if ($eachDiscount['discount_status'] == 'Active') $typeText = 'text-success';
            else $typeText = 'text-danger';
?>
            <tr>
                <td><?= $eachDiscount['id'] ?></td>
                <td><?= $eachDiscount['discount_code'] ?></td>
                <td><?= number_format($eachDiscount['price_discount_amount'], 0, ',', '.') . $GLOBALS['CURRENCY'] ?></td>
                <td><?= number_format($eachDiscount['discount_condition'], 0, ',', '.') . $GLOBALS['CURRENCY'] ?></td>
                <td><?= $eachDiscount['quantity'] ?></td>
                <td><span class="<?= $typeText ?>"><?= $eachDiscount['discount_status'] ?></span></td>
                <td><?= $eachDiscount['updated_at'] ?></td>
                <td>
                    <span>
                        <a class="btn btn-primary mb-1" href="manage-discount.php?id=<?= $eachDiscount['id'] ?>" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-pencil color-muted"></i>
                        </a>
                        <a class="btn btn-danger mb-1 sweet-confirm-custom sweet-confirm-discount" href="#" data-itemid="<?= $eachDiscount['id'] ?>" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="fa fa-trash color-danger"></i>
                        </a>
                    </span>
                </td>
            </tr>
<?php
        }
    }
}
