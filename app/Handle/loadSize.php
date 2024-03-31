<?php
session_start();
include '../Models/Eloquent.php';
include '../../config/database.php';
include '../../config/site.php';
$eloquent = new Eloquent();

$productSizeList = $eloquent->selectData(['product_size'], 'products_sc', ['product_id' => $_POST['product_id'], 'product_color' => $_POST['color']]);
foreach ($productSizeList as $eachSize) {
    echo '<li class="mr-5"><a class="choice-size" data-size="' . $eachSize['product_size'] . '">' . $eachSize['product_size'] . '</a></li>';
}
?>
<script>
    let choiceSizes = document.querySelectorAll('.choice-size');
    choiceSizes.forEach(choiceSize => {
        choiceSize.addEventListener('click', function(e) {
            e.preventDefault();
            const size = this.getAttribute('data-size');
            console.log(size);
            const parentElement = choiceSize.parentElement;
            parentElement.classList.add('active');
            console.log(parentElement.className);
            if (parentElement.classList.contains("active") == true) {
                parentElement.classList.remove('active');
                console.log(parentElement.className);
            } else {
                parentElement.classList.add('active');
            }
        });
    });
</script>