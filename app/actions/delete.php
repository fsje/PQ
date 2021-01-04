<?php
session_start();

if(!isset($_SESSION['userid']))
{
    header('location:login.php');
    exit();
}

require_once '../autoload.php';

$productController = new ProductController();

if(isset($_GET['product'])){
    if($productController->deleteProduct($_GET['product'])){
        header('location:/packaging.php');
    }
}