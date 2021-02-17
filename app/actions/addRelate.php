<?php
session_start();

if(!isset($_SESSION['userid']))
{
    header('location:login.php');
}

require_once '../autoload.php';

$productData = array();

// Image processing


// Configure upload directory and allowed file types 
$currentDirectory       = getcwd();     // current dir.
$upload_dir = '/img/products/'; // preferede upload
$allowed_types = array('jpg', 'png', 'jpeg', 'gif'); 
  
// Define maxsize for files i.e 2MB 
$maxsize = 2 * 1024 * 1024;  

// Checks if user sent an empty form  
if(!empty(array_filter($_FILES['files']['name']))) { 

    // Loop through each file in files[] array 
    foreach ($_FILES['files']['tmp_name'] as $key => $value) { 
          
        $file_tmpname = $_FILES['files']['tmp_name'][$key]; 
        $file_name = $_FILES['files']['name'][$key]; 
        $file_size = $_FILES['files']['size'][$key]; 
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION); 

        // Set upload file path 
        $filepath = $_SERVER['DOCUMENT_ROOT'] . $upload_dir.$file_name; 

        // Check file type is allowed or not 
        if(in_array(strtolower($file_ext), $allowed_types)) { 

            // Verify file size - 2MB max  
            if ($file_size > $maxsize)          
                echo "Error: File size is larger than the allowed limit.";  

            // If file with name already exist then append time in 
            // front of name of the file to avoid overwriting of file 
            if(file_exists($filepath)) { 
                $filepath = $_SERVER['DOCUMENT_ROOT'] . $upload_dir . time() .'-'. basename($file_name); 
               
                  
                if( move_uploaded_file($file_tmpname, $filepath)) { 
                    echo "{$file_name} successfully uploaded <br />"; 
                }  
                else {                      
                    echo "Error uploading {$file_name} <br />";  
                } 
            } 
            else { 
              
                if( move_uploaded_file($file_tmpname, $filepath)) { 
                    echo "{$file_name} successfully uploaded <br />"; 
                } 
                else {                      
                    echo "Error uploading {$file_name} <br />";  
                } 
            } 
        } 
        else { 
              
            // If file extention not valid 
            echo "Error uploading {$file_name} ";  
            echo "({$file_ext} file type is not allowed)<br / >"; 
        }  
    } 
}  
else { 
      
    // If no files selected 
    echo "No files selected."; 
} 


  
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
    }elseif(count($explode) > 2){
        $foods[] = $explode[2];
    }
}

#print_r($_FILES['files']['name']);
$amountOfImages = 0;
while($amountOfImages <= count($_FILES['files']['name'])-1)
{
    $productData[$amountOfImages]['image'] = $_FILES['files']['name'][$amountOfImages];
    $amountOfImages++;
}


// Initalize product controller
$productController  = new ProductController();

$getFoodIds = $productController->getProductsByModel($foods, $_SESSION['userid']);
foreach($getFoodIds as $k => $v)
{
    $foodIds[] =  $v['id'];
}

#print_r($productData);
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
