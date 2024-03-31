<?php
class CategoryController extends Controller
{
    public function CategoryList($categoryList)
    {
        foreach ($categoryList as $eachCategory) {
?>
            <tr>
                <td><?= $eachCategory['id'] ?></td>
                <td><?= $eachCategory['category_name'] ?></td>
                <td>
                    <span class="<?= $eachCategory['category_status'] == 'Active' ? "text-success" : "text-warning" ?>">
                        <?= $eachCategory['category_status'] ?>
                    </span>
                </td>
                <td><?= $eachCategory['created_at'] ?></td>
                <td>
                    <span>
                        <a class="btn btn-primary" href="manage-category.php?id=<?= $eachCategory['id'] ?>" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-pencil color-muted"></i>
                        </a>
                        <a class="btn btn-danger sweet-confirm-custom sweet-confirm-category" href="#" data-itemid="<?= $eachCategory['id'] ?>" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="fa fa-trash color-danger"></i>
                        </a>
                    </span>
                </td>
            </tr>
<?php
        }
    }
}
