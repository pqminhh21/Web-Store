<?php
class CustomerController extends Controller
{
    public function CustomerList($customerList)
    {
        foreach ($customerList as $eachCustomer) {
            $imageCustomer = $eachCustomer['customer_image'] == 'no-image.png' ? $GLOBALS['NO_IMAGE'] : $GLOBALS['CUSTOMERS_DIRECTORY'] . $eachCustomer['customer_image'];
?>
            <tr>
                <td><?= $eachCustomer['id'] ?></td>
                <td><img style="width: 80px; height: 80px;" class="img-fluid rounded" src="<?= $imageCustomer ?>" alt="#"></td>
                <td><?= $eachCustomer['customer_name'] ?></td>
                <td><?= $eachCustomer['customer_email'] ?></td>
                <td><?= $eachCustomer['customer_mobile'] ?></td>
                <td><?= $eachCustomer['created_at'] ?></td>
                <td>
                    <a class="btn <?= $eachCustomer['customer_status'] == 'Active' ? 'btn-success' : 'btn-danger' ?> mb-1 customerStatus ?>" href="" data-itemid = "<?= $eachCustomer['id'] ?>" data-toggle="tooltip" data-placement="top" title="Change">
                        <?= $eachCustomer['customer_status'] ?>
                    </a>
                </td>
            </tr>
<?php
        }
    }
}
