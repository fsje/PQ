<?php

// Initialize a session
session_start();

// Is the user logged in? If not reject.
if(!isset($_SESSION['userid']))
{header('location:login.php');}

// We'd like to require our autoload.
require_once '../autoload.php';

// Image processing
$currentDirectory       = getcwd();     // current dir.
$uploadDirectory        = '/img/products/'; // preferede upload

$errors                 = []; // Error array.

$fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

$fileName = $_FILES['foodImage']['name'];
$fileSize = $_FILES['foodImage']['size'];
$fileTmpName  = $_FILES['foodImage']['tmp_name'];
$fileType = $_FILES['foodImage']['type'];
$tmp = explode('.',$fileName);
$fileExtension = strtolower(end($tmp));

$uploadPath = $_SERVER['DOCUMENT_ROOT'] . $uploadDirectory . basename($fileName); 

$didUpload = '';
if (! in_array($fileExtension,$fileExtensionsAllowed)) {
    $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
  }

  if ($fileSize > 4000000) {
    $errors[] = "File exceeds maximum size (4MB)";
  }

  if (empty($errors)) {
    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

    if ($didUpload) {
      echo "The file " . basename($fileName) . " has been uploaded";
    } else {
      echo "An error occurred. Please contact the administrator.";
    }
  } else {
    foreach ($errors as $error) {
      echo $error . "These are the errors" . "\n";
    }
  }

  if(!$didUpload){
      $image = $_POST['image'];
  }else{
      $image = basename($fileName);
  }


// Product Informations sent from formular.
$foodId          =   $_POST['productId'];

$productData = array(
  'model'         => $_POST['productName'],
  'image'         => $image,
);

// Initalize product controller
$productController  = new ProductController();

// Get Product By ID
$product            = $productController->getProductById($foodId);

// Preform an update of the product.
if(count($product) > 0 && !empty($foodId))
{
    $updatedProduct =   $productController->updateProductByID($foodId, $productData, 'pq_products', 'id');
}

/**
 * 
 * RELATIONS BELOW
 * 
 */

 // Fetch picked relations
 $relations = $_POST['fittingPackaging'];

// Add relation
 foreach($relations as $k => $v){
  $relationsData[$k]['product_id'] = $foodId;
  $relationsData[$k]['related_id'] = $v;
}

$relatedProduct          = $productController->addMultipleProducts($relationsData, 'pq_products_related');