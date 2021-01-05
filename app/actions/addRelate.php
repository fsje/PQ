<?php
session_start();

if(!isset($_SESSION['userid']))
{
    header('location:login.php');
}

require_once '../autoload.php';

$productData = array();

foreach($_POST['relativeFood'] as $key => $value)
{
    $productData[] = $value;
}


// Initalize product controller
$productController  = new ProductController();

// Add multiple products (all packaging-food items)
$returnedIds          = $productController->addMultipleProducts($productData, 'pq_products');

// Add relatives to product -> food.
$relationData = array();

$x = 0;

while($x <= count($returnedIds)-1){
    $relationData[$x]['product_id'] = $_POST['productId'];
    $relationData[$x]['related_id'] = $returnedIds[$x];
    $x++;
}

if($relatedProduct          = $productController->addMultipleProducts($relationData, 'pq_products_related'))
{
    $_SESSION['msg'] = 'Varen er blevet opdateret!';
    header('location:/admin.php');
}