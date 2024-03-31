<?php
class SubCategoryController extends Controller
{
    public function SubCategoryList($subCategoryList)
    {
        foreach ($subCategoryList as $eachSubCategory) {
            $imageBanner = $eachSubCategory['subcategory_banner'] == '' ? $GLOBALS['NO_IMAGE'] : $GLOBALS['BANNER_DIRECTORY'] . $eachSubCategory['subcategory_banner'];
?>
            <tr>
                <td><?= $eachSubCategory['id'] ?></td>
                <td><img style="width: 80px; height: 40px; object-fit: cover;" class="img-fluid rounded" src="<?= $imageBanner ?>" alt="#"></td>
                <td><?= $eachSubCategory['subcategory_name'] ?></td>
                <td><?= $eachSubCategory['category_name'] ?></td>
                <td>
                    <span class="<?= $eachSubCategory['subcategory_status'] == 'Active' ? 'text-success' : 'text-warning' ?>">
                        <?= $eachSubCategory['subcategory_status'] ?>
                    </span>
                </td>
                <td><?= $eachSubCategory['created_at'] ?></td>
                <td>
                    <span>
                        <a class="btn btn-primary" href="manage-subcategory.php?id=<?= $eachSubCategory['id'] ?>" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-pencil color-muted"></i>
                        </a>
                        <a class="btn btn-danger sweet-confirm-custom sweet-confirm-subcategory" href="#" data-itemid="<?= $eachSubCategory['id'] ?>" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="fa fa-trash color-danger"></i>
                        </a>
                    </span>
                </td>
            </tr>
<?php
        }
    }
}
