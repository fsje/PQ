<?php
session_start();

if(!isset($_SESSION['userid']))
{
    header('location:login.php');
}

require_once '../autoload.php';

echo '<pre>';
print_r($_POST);

/*

    // Add "relation" product
    $productId          =   $_POST['productId'];

    $productData = array(
        'model'         => $_POST['relativeFood'],
        'type'          => 'relative',
        'image'         => $_POST['image'],
    );

// Initalize product controller
$productController  = new ProductController();

$idFromProduct          = $productController->addProductWithArray($productData, 'pq_products');

// Add Relation
echo 'A product was added to the database, with the id of ' . $idFromProduct; 
echo '<br />';

$relationData = array(
    'product_id' => $_POST['productId'],
    'related_id' => $idFromProduct,
);

$relatedProduct          = $productController->addProductWithArray($relationData, 'pq_products_related');
echo 'A relation was added to the database, with the id of ' . $relatedProduct; 
echo '<br />';*/