<?php
session_start();

if(!isset($_SESSION['userid']))
{
    header('location:login.php');
}

require_once '../autoload.php';

echo '<pre>';
print_r($_POST);

$productData = array();

foreach($_POST['relativeFood'] as $key => $value)
{
    $productData[] = $value;
}

    // Add "relation" product
    #$productId          =   $_POST['productId'];

echo '<hr />';
print_r($productData);

// Initalize product controller
$productController  = new ProductController();

$returnedIds          = $productController->addMultipleProducts($productData, 'pq_products');
print_r($returnedIds);

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