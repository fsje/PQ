<?php

require 'autoload.php';
// Get details.
$product_id = $_POST['product_id'];
$width      = $_POST['width'] . 'px';
$height     = $_POST['height'] . 'px';

$products   = new ProductController();
$result     = $products->getProductById($product_id);

echo 'https://premiumquality.dk/img/products/' . $result['model'] . '.png';