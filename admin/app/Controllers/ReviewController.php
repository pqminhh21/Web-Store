<?php
class ReviewController extends Controller
{
    public function ReviewList($reviewList)
    {
        foreach ($reviewList as $eachReview) {
?>
            <tr>
                <td><?= $eachReview['idReview'] ?></td>
                <td><?= $eachReview['idOrderReview'] ?></td>
                <td><?= $eachReview['customer_name'] ?></td>
                <td><?= $eachReview['product_name'] ?></td>
                <td><?= $eachReview['product_color'] ?> | <?= $eachReview['product_size'] ?></td>
                <td><?= $eachReview['review_details'] ?></td>
                <td><?= $eachReview['rating'] ?></td>
                <td><?= $eachReview['review_updated_at'] == '' ? $eachReview['review_created_at'] : $eachReview['review_updated_at'] ?></td>
                <td>
                    <a class="btn <?= $eachReview['review_status'] == 'Active' ? 'btn-success' : 'btn-danger' ?> mb-1 reviewStatus" href="" data-itemid = "<?= $eachReview['idReview'] ?>" data-toggle="tooltip" data-placement="top" title="Change">
                        <?= $eachReview['review_status'] ?>
                    </a>
                </td>
            </tr>
<?php
        }
    }
}
