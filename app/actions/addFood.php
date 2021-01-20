<?php
session_start();

if(!isset($_SESSION['userid']))
{
    header('location:login.php');
    exit();
}

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
$fileExtension = strtolower(end(explode('.',$fileName)));

$uploadPath = $_SERVER['DOCUMENT_ROOT'] . $uploadDirectory . basename($fileName); 

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



    // Check product information
    $productId          =   $_POST['productId'];

    $productData = array(
        'model'         => $_POST['productName'],
        'image'         => basename($fileName),
        'type'          => 'food',
        'accountNumber' => $_SESSION['userid'],
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
        'name'          =>      $_POST['productName'],
    );

if($addDetails            = $productController->addProductWithArray($productDetailsData, 'pq_products_details')){
    if($_POST['type'] == 'food')
    {
        $_SESSION['msg'] = 'Fødevaren er blevet opdateret!';
        #header('location:/admin.php');
    }else{
        #header('location:/admAddFood.php?product=' . $idFromProduct);
    }
}
