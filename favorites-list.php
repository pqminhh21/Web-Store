<?php
include('app/Controllers/View.php');
$view = new View();
$view->loadContent('include', 'top');
$view->loadContent('content', 'coming-soon');
$view->loadContent('include', 'tail');