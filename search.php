<?php
include('app/Controllers/View.php');
$view = new View();
$view->loadContent('include', 'top');
$view->loadContent('content', 'product-detail');
$view->loadContent('include', 'tail');
?>