<?php
include("app/Controllers/View.php");
$view = new View;
if(!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}
$view->loadContent("include", "top");
$view->loadContent("include", "sidebar");
$view->loadContent("content", "add-edit-admin");
$view->loadContent("include", "tail");
?>