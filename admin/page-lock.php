<?php
include("app/Controllers/View.php");
$view = new View;
if(!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}
$view->loadContent("content", "page-lock");
?>