<?php
session_start();

if(!isset($_SESSION['userid']))
{
    header('location:login.php');
}


require_once '../autoload.php';

$type = $_POST['type'];
// Image processing
$currentDirectory       = getcwd();     // current dir.
$uploadDirectory        = '/img/products/'; // preferede upload

$errors                 = []; // Error array.

$fileExtensionsAllowed = ['jpeg','jpg','png', 'JPG']; // These will be the only file extensions allowed 

$fileName = $_FILES['packagingImage']['name'];
$fileSize = $_FILES['packagingImage']['size'];
$fileTmpName  = $_FILES['packagingImage']['tmp_name'];
$fileType = $_FILES['packagingImage']['type'];
$fileExtension = strtolower(end(explode('.',$fileName)));

$uploadPath = $_SERVER['DOCUMENT_ROOT'] . $uploadDirectory; 
$newName = time() . '-' . basename($fileName);
$didUpload = '';
if (! in_array($fileExtension,$fileExtensionsAllowed)) {
    $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    exit();
  }

  if ($fileSize > 4000000) {
    $errors[] = "File exceeds maximum size (4MB)";
    exit();
  }

  if (empty($errors)) {
    $didUpload = move_uploaded_file($fileTmpName, $uploadPath . $newName);

    if ($didUpload) {
      echo "The file " . basename($fileName) . " has been uploaded";
    } else {
      echo "An error occurred. Please contact the administrator.";
      exit();
    }
  } else {
    foreach ($errors as $error) {
      echo $error . "These are the errors" . "\n";
      exit();
    }
  }

  if(!$didUpload){
      $image = $_POST['image'];
  }else{
      $image = $newName;
  }

  $productId          =   $_POST['productId'];
if(isset($_POST['productId']) && isset($_POST['productDetailsId']))
{

    // Check product information
   
    if($type == 'packaging') {
    $productData = array(
        'model'         => $_POST['modelP2P'],
        'image'         => $image,
        'ean'           => $_POST['ean'],
        'type'          => $_POST['type'],
    );
  }
    // Check product details

    $productDetailsId   =   $_POST['productDetailsId'];
    $productDetailsData = array(
        'reitan'        =>      $_POST['modelCustomer'],
        'carton'        =>      $_POST['carton'],
        'name'          =>      $_POST['productName'],
        'material'      =>      $_POST['material'],
        'description'   =>      $_POST['description'],
        'height'        =>      $_POST['height'],
        'width'         =>      $_POST['width'],
        'diameter'      =>      $_POST['diameter']    
    );
}

if($type == 'food'){
  $productData = array(
    'model'         => $_POST['modelP2P'],
    'image'         => $image,
    'type'          => $_POST['type'],
    'accountNumber' => $_SESSION['userid'],
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

    if($type == 'packaging') {
    $updatedDetails =   $productController->updateProductByID($productDetailsId, $productDetailsData, 'pq_products_details', 'product_id');
    }
    if($_POST['type'] == 'food')
    {
        $_SESSION['msg'] = 'Fødevaren er blevet opdateret!';
       header('location:/admin.php');
    }else{
       header('location:/admAddFood.php?product=' . $productId);
    }
}

   
