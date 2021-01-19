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
                        echo 'Du er ved at oprette en vare';
                    }
                ?>
            </h2>
        </div>
        <div class="col-6 col-sm-12 col-md-6">
                <form action="app/actions/<?php echo (isset($_GET['product']) ? 'edit.php' : 'add.php'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputdefault">Varenummer (Plant2Plast)</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $product['model'] : ''); ?>" name="modelP2P" id="inputdefault" type="text">
                    </div>
                    <div class="form-group">
                        <label for="inputlg">Varenummer (Kunde)</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $productDetails['reitan'] : ''); ?>" name="modelCustomer" id="inputlg" type="text">
                    </div>
                    <div class="form-group">
                        <label for="inputsm">EAN Nummer</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $product['ean'] : ''); ?>" name="ean" id="inputsm" type="text">
                    </div>
                    <div class="form-group">
                        <label for="inputsm">Produktnavn</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $productDetails['name'] : ''); ?>" name="productName" id="inputsm" type="text">
                    </div>
                    <div class="form-group">
                        <label for="inputsm">Produkttype</label>
                        <select name="type" <?php echo (isset($_GET['product']) ? '' : ''); ?>>
                            <option value="packaging" <?php echo (isset($product['type']) && $product['type'] == 'packaging' ? 'selected' : ' '); ?>>Emballage</option>
                            <option value="food" <?php echo (isset($product['type']) && $product['type'] == 'food' ? 'selected' : ' '); ?>>Mad</option>
                        </select>
                    </div>
        </div>
        <div class="col-6 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="inputdefault">Størrelse</label>
                        <input class="form-control" id="inputdefault" type="text">
                    </div>
                    <div class="form-group">
                        <label for="inputlg">Kolistørrelse</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $productDetails['carton'] : ''); ?>" name="carton" id="inputlg" type="text">
                    </div>
                    <div class="form-group">
                        <label for="inputsm">Materiale</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $productDetails['material'] : ''); ?>" name="material" id="inputsm" type="text">
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
        </div>
    </div>
    <div id="contentArea" class="row">
        <div class="col-12 col-lg-12 col-sm-12">
            <textarea class="productTextarea" name="description" placeholder="Beskrivelse">
                <?php echo (isset($_GET['product']) ? $productDetails['description'] : ''); ?>
            </textarea>
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