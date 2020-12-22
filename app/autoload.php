<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/';

require $path . 'app/config.php';
require $path . 'app/breadcrumbs.php';
require $path . 'app/libraries/MysqliDb.php';
require $path . 'app/libraries/barcode-generator/BarcodeGenerator.php';
require $path . 'app/libraries/barcode-generator/BarcodeGeneratorHTML.php';
require $path . 'app/libraries/barcode-generator/BarcodeGeneratorSVG.php';
require $path . 'app/libraries/barcode-generator/BarcodeGeneratorPNG.php';

require $path . 'controllers/Controller.php';
require $path . 'model/model.php';


function __autoload($class_name)
{
    $path = $_SERVER['DOCUMENT_ROOT'] . '/controllers/' . $class_name . '.php';
    $modelPath = $_SERVER['DOCUMENT_ROOT'] . '/model/' . $class_name . '.php';

    if(file_exists($path)) {
        require_once $path;
    }else if(file_exists($modelPath)){
        require_once $modelPath;
    }
}

$MysqliDb = new MysqliDb();




