<?php
session_start();

if(!isset($_SESSION['userid']))
{
    header('location:login.php');
}

require_once '../autoload.php';


if(isset($_POST['productId']) && isset($_POST['productDetailsId']))
{

    // Check product information
    $productId          =   $_POST['productId'];

    $productData = array(
        'model'         => $_POST['modelP2P'],
        'image'         => $_POST['image'],
        'ean'           => $_POST['ean'],
        'type'          => $_POST['type'],
    );

    // Check product details

    $productDetailsId   =   $_POST['productDetailsId'];
    $productDetailsData = array(
        'reitan'        =>      $_POST['modelCustomer'],
        'carton'        =>      $_POST['carton'],
        'name'          =>      $_POST['productName'],
        'material'      =>      $_POST['material'],
        'description'   =>      $_POST['description'],
        
    );
}

// Initalize product controller
$productController  = new ProductController();

// Get Product By ID
$product            = $productController->getProductById($productId);

// If product returns an array of items, update the product.
if(count($product) > 0 && !empty($productId))
{
    $updatedProduct =   $productController->updateProductByID($productId, $productData, 'pq_products', 'id');
    $updatedDetails =   $productController->updateProductByID($productDetailsId, $productDetailsData, 'pq_products_details', 'product_id');
    header('location:../../admin.php');
    exit();
}

   
