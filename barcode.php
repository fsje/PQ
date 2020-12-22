<?php

require 'app/autoload.php';
$products = new ProductController();
$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
$product = $products->getProductsByType('packaging');

foreach($product as $k => $v){
	echo $v['model'] . ' - ' . $v['seo_alias']; 
	echo '<br />';
	echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($v['ean'], $generator::TYPE_CODE_128)) . '">';
	echo '<br /><hr />';
}
#echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('081231723897', $generator::TYPE_CODE_128)) . '">';
