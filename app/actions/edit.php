<?php
session_start();

if(!isset($_SESSION['userid']))
{
    header('location:login.php');
}


require_once '../autoload.php';

// Image processing
$currentDirectory       = getcwd();     // current dir.
$uploadDirectory        = '/img/products/'; // preferede upload

$errors                 = []; // Error array.

$fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

$fileName = $_FILES['packagingImage']['name'];
$fileSize = $_FILES['packagingImage']['size'];
$fileTmpName  = $_FILES['packagingImage']['tmp_name'];
$fileType = $_FILES['packagingImage']['type'];
$fileExtension = strtolower(end(explode('.',$fileName)));

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

if(isset($_POST['productId']) && isset($_POST['productDetailsId']))
{

    // Check product information
    $productId          =   $_POST['productId'];

    $productData = array(
        'model'         => $_POST['modelP2P'],
        'image'         => $image,
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
    if($_POST['type'] == 'food')
    {
        $_SESSION['msg'] = 'Fødevaren er blevet opdateret!';
        header('location:/admin.php');
    }else{
        header('location:/admAddFood.php?product=' . $productId);
    }
}

   
