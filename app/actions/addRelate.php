<?php
session_start();

if(!isset($_SESSION['userid']))
{
    header('location:login.php');
}

require_once '../autoload.php';

$productData = array();

// Image processing
$currentDirectory       = getcwd();     // current dir.
$uploadDirectory        = '/img/products/'; // preferede upload

$errors                 = []; // Error array.

$fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 
echo '<pre>';
foreach($_FILES['relativeFood'] as $key => $v){
    print_r($v);
}


print_r($_FILES);
print_r($_POST);
/*
$files = array_filter($_FILES['relativeFood[1][image]']['name']); //Use something similar before processing files.
// Count the number of uploaded files in array
$total_count = count($_FILES['relativeFood[1][image]']['name']);
// Loop through every file
for( $i=0 ; $i < $total_count ; $i++ ) {
   //The temp file path is obtained
   $tmpFilePath = $_FILES['relativeFood[1][image]']['tmp_name'][$i];
   //A file path needs to be present
   if ($tmpFilePath != ""){
      //Setup our new file path
      $newFilePath = $_SERVER['DOCUMENT_ROOT'] . $uploadDirectory . $_FILES['relativeFood[1][image]']['name'][$i];
      //File is uploaded to temp dir
      if(move_uploaded_file($tmpFilePath, $newFilePath)) {
         echo 'yay';
      }
   }
}*/


  
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

print_r($productData);

// Initalize product controller
$productController  = new ProductController();

$getFoodIds = $productController->getProductsByModel($foods);
foreach($getFoodIds as $k => $v)
{
    $foodIds[] =  $v['id'];
}

/*
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
