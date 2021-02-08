<?php
session_start();
if(!isset($_SESSION['userid']))
{header('location:login.php');}
    require 'app/autoload.php';
    require_once 'views/includes/header.php';

    $userController = new UserController();
    $productController = new ProductController();
    $user = $userController->getUserByAccountNumber($_SESSION['userid']);

    if(isset($_GET['product'])){
        $product = $productController->getProductById($_GET['product']);
        $productDetails = $productController->getProductDetails($product['id']);
    }

    $getPackaging = $productController->getProductsByType('relative', $_SESSION['userid']);

?>

<!-- CONTENT -->
<div class="container">
    <div class="row" id="contentArea">
        <div class="col-12">
            <h2>
                <?php
                    if(isset($_GET['product'])){
                        echo 'Du er ved at redigere ' . $product['model'] . ' (' . $product['id'] . ')';
                    }else{
                        echo 'Du er ved at oprette en ny fødevare';
                    }
                ?>
            </h2>
        </div>
        <div class="col-6 col-sm-12 col-md-6">
                <form action="app/actions/<?php echo (isset($_GET['product']) ? 'editFood.php' : 'addFood.php'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputdefault">Fødevarens navn</label>
                        <input class="form-control" name="productName" value="<?php echo (isset($_GET['product']) ? $product['model'] : ''); ?>" id="inputdefault" type="text">
                    </div> 
        </div>
        <div class="col-6 col-sm-12 col-md-6">
                    <?php
                        if(isset($_GET['product'])){
                    ?>
                    <div class="form-group">
                        <label for="inputsm">Nuværende billedesti</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $product['image'] : ''); ?>" name="image" id="inputsm" type="text" readonly>
                    </div>
                    <?php 
                        }
                    ?>
                    <div class="form-group">
                        <label for="image"><?php echo (isset($_GET['product']) ? 'Upload et nyt billede' : 'Upload billede'); ?></label>
                        <input type="file" name="foodImage" class="form-control-file" id="image">
                    </div>
        </div>
    </div>
    <div id="contentArea" style="margin-right:-15px; margin-left:-15px;">
        <h2>Vælg emballage der passer til ... </h2>
         <?php
        //Columns must be a factor of 12 (1,2,3,4,6,12)
        if(isset($getPackaging)){
            $countedPackaging = count($getPackaging);
            if($countedPackaging <= 6) {
                $numOfCols = 1;
            }elseif($countedPackaging > 6 && $countedPackaging < 12)
            {
                $numOfCols = 2;
            }elseif($countedPackaging > 12 && $countedPackaging < 18)
            {
                $numOfCols = 3;
            }elseif($countedPackaging > 18)
            {
                $numOfCols = 4;
            }

        $rowCount = 0;
        $bootstrapColWidth = 12 / $numOfCols;
        foreach ($getPackaging as $k => $v){
        if($rowCount % $numOfCols == 0) { ?> <div class="row"> <?php } 
            $rowCount++; ?>  
                <div class="col-md-<?php echo $bootstrapColWidth; ?>">
                    <div class="form-check">
                    <input name="fittingPackaging[]" class="form-check-input" type="checkbox" value="<?php echo $v['id']; ?>" id="<?php echo $v['model']; ?>">
                    <label class="form-check-label" for="<?php echo $v['model']; ?>"><?php echo $v['model']; ?></label>
                    </div>
                </div>
        <?php
            if($rowCount % $numOfCols == 0) { ?> </div> <?php } }}else{echo 'OBS: Der er ingen emballage';} ?>
            <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">

        </div>
        <hr />

        <div class="row">
        <div align="center" class="col-12 col-lg-12 col-sm-12">
                <!-- Buttons -->
                <div class="btn-group" role="group" aria-label="Actions">
                    <button href="#" class="btn btn-secondary">Fortryd</button>
                    <button type="submit" class="btn btn-warning"><b>Videre</b></button>
                </div>
        </div>
        </form>
    </div>
</div>



<div class="disp">
	<img src="https://premiumquality.dk/img/Baner-cake-pq-dis.png" id="dispImg">
</div>

            <?php
                require_once 'views/includes/footer.php';
            ?>
    </body>
</html>