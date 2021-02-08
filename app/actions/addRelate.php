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


$foods = array();

foreach($productData as $k => $v)
{
    $explode = explode('-', $v['model']);
   
    if(count($explode) == 2){
        $foods[] = $explode[1];
    }elseif(count($explode > 2)){
        $foods[] = $explode[2];
    }
}

print_r($foods);

// Initalize product controller
$productController  = new ProductController();

$getFoodIds = $productController->getProductsByModel($foods);
foreach($getFoodIds as $k => $v)
{
    $foodIds[] =  $v['id'];
}


// Add multiple products (all packaging-food items)
$returnedIds          = $productController->addMultipleProducts($productData, 'pq_products');

// Add relatives to product -> relative.
$relationData = array();

$x = 0;

while($x <= count($returnedIds)-1){
    $relationData[$x]['product_id'] = $_POST['productId'];
    $relationData[$x]['related_id'] = $returnedIds[$x];
    $x++;
}

$relatedProduct         = $productController->addMultipleProducts($relationData, 'pq_products_related');

// Add relatives to food -> relative
$foodRelations = array();

$y = 0;

while($y <= count($foodIds)-1){
    $foodRelations[$y]['product_id'] = $foodIds[$y];
    $foodRelations[$y]['related_id'] = $returnedIds[$y];
    $y++;
}

print_r($foodRelations);


if($relatedProduct          = $productController->addMultipleProducts($foodRelations, 'pq_products_related'))
{
    $_SESSION['msg'] = 'Varen er blevet opdateret!';
    header('location:/admin.php');
}
