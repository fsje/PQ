<?php
session_start();
if(!isset($_SESSION['userid']))
{header('location:login.php');}
    require 'app/autoload.php';
    require_once 'views/includes/header.php';

    $userController = new UserController();
    $user = $userController->getUserByAccountNumber($_SESSION['userid']);

    if(isset($_GET['product'])){
        $productController = new ProductController();
        $product = $productController->getProductById($_GET['product']);
        $productDetails = $productController->getProductDetails($product['id']);
    }
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
                        echo 'Du er ved at oprette en ny fødevarer.';
                    }
                ?>
            </h2>
        </div>
        <div class="col-12 col-sm-12 col-md-12">
                <form action="app/actions/<?php echo (isset($_GET['product']) ? 'edit.php' : 'add.php'); ?>" method="post" enctype="multipart/form-data">
                <!--<div class="form-group">
                        <label for="inputsm">Produkttype</label>
                        <select name="type" id="productType" <?php #echo (isset($_GET['product']) ? '' : ''); ?>>
                            <option value="">Vælg venligst type</option>
                            <option value="packaging" <?php #echo (isset($product['type']) && $product['type'] == 'packaging' ? 'selected' : ' '); ?>>Emballage</option>
                            <option value="food" <?php #echo (isset($product['type']) && $product['type'] == 'food' ? 'selected' : ' '); ?>>Mad</option>
                        </select>
                    </div>-->
                    <input type="hidden" name="type" value="food">
                    <div class="form-group">
                        <label for="inputsm">Navn på fødevarer</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $productDetails['name'] : ''); ?>" name="productName" id="inputsm" type="text">
                    </div>
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
                        <input type="file" name="packagingImage" class="form-control-file" id="image">
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
</div>
            <?php
                require_once 'views/includes/footer.php';
            ?>
    </body>
</html>