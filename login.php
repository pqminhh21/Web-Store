<?php
include('app/Controllers/View.php');
$view = new View();
$view->loadContent('include', 'top');
$view->loadContent('content', 'login');
$view->loadContent('include', 'tail');
