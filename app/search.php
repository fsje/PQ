<?php
session_start();
error_reporting(0);
header("content-type:application/json");
require 'autoload.php';
$products = new ProductController();

$result     = $products->searchProduct($_POST['term'], 'packaging', $_SESSION['userid']);

if(isset($result) && is_array($result) || is_object($result))
{
    foreach((array) $result['details'] as $k => $v)
    {
        // Product Information
        $results['packaging'][$v['product_id']]['id']               = $v['product_id'];
        $results['packaging'][$v['product_id']]['label']            = $v['name'];
        $results['packaging'][$v['product_id']]['value']            = $v['name'];
        $results['packaging'][$v['product_id']]['description']      = $v['description'];
        $results['packaging'][$v['product_id']]['riItem']           = $v['reitan'];
        $results['packaging'][$v['product_id']]['url']              = ($v['carton'] > 0 ? 'https://premiumquality.dk/packaging/' . $v['product_id'] : 'https://premiumquality.dk/food/' . $v['product_id']);
    }

    echo json_encode($results);
}


