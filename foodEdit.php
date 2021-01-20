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

    $getPackaging = $productController->getProductsByType('packaging', $_SESSION['userid']);

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
                        <input class="form-control" readonly value="<?php echo (isset($_GET['product']) ? $product['image'] : ''); ?>" name="image" id="inputsm" type="text">
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
    <div id="contentArea" class="row">
        <div class="col-12 col-lg-12 col-sm-12">
                <?php
                    foreach($getPackaging as $k => $v){
                    echo '<div class="form-check">';
                    echo '<input name="fittingPackaging[]" class="form-check-input" type="checkbox" value="' . $v['model'] . '" id="' . $v['model'] . '">';
                    echo '<label class="form-check-label" for="' . $v['model'] . '">' . $v['model'] . '</label>';
                    echo '</div>';
                    }
                ?>

            <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="productDetailsId" value="<?php echo $productDetails['product_id']; ?>">
        </div>
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