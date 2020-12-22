<?php
session_start();

if(!isset($_SESSION['userid']))
{
    header('location:login.php');
}

require_once '../autoload.php';

    // Check product information
    $productId          =   $_POST['productId'];

    $productData = array(
        'model'         => $_POST['modelP2P'],
        'image'         => $_POST['image'],
        'ean'           => $_POST['ean'],
        'type'          => $_POST['type'],
    );

// Initalize product controller
$productController  = new ProductController();

$idFromProduct          = $productController->addProductWithArray($productData, 'pq_products');
echo 'A product was added to the database, with the id of ' . $idFromProduct; 
echo '<br />';
    // Check product details

    $productDetailsId   =   $_POST['productDetailsId'];
    $productDetailsData = array(
        'product_id'    =>      $idFromProduct,
        'reitan'        =>      $_POST['modelCustomer'],
        'carton'        =>      $_POST['carton'],
        'name'          =>      $_POST['productName'],
        'material'      =>      $_POST['material'],
        'description'   =>      $_POST['description'],
    );

$addDetails            = $productController->addProductWithArray($productDetailsData, 'pq_products_details');
