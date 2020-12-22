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
                <form action="app/actions/edit.php" method="post">
                    <div class="form-group">
                        <label for="inputdefault">Varenummer (Plant2Plast)</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $product['model'] : ''); ?>" name="modelP2P" id="inputdefault" type="text">
                    </div>
                    <div class="form-group">
                        <label for="inputlg">Varenummer (Kunde)</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $product['reitan'] : ''); ?>" name="modelCustomer" id="inputlg" type="text">
                    </div>
                    <div class="form-group">
                        <label for="inputsm">EAN Nummer</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $product['ean'] : ''); ?>" name="ean" id="inputsm" type="text">
                    </div>
                    <div class="form-group">
                        <label for="inputsm">Produktnavn</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $product['name'] : ''); ?>" name="productName" id="inputsm" type="text">
                    </div>
        </div>
        <div class="col-6 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="inputdefault">Størrelse</label>
                        <input class="form-control" id="inputdefault" type="text">
                    </div>
                    <div class="form-group">
                        <label for="inputlg">Kolistørrelse</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $product['carton'] : ''); ?>" name="carton" id="inputlg" type="text">
                    </div>
                    <div class="form-group">
                        <label for="inputsm">Materiale</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $product['material'] : ''); ?>" name="material" id="inputsm" type="text">
                    </div>
                    <div class="form-group">
                        <label for="inputsm">Billede</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $product['image'] : ''); ?>" name="image" id="inputsm" type="text">
                    </div>
        </div>
    </div>
    <div id="contentArea" class="row">
        <div class="col-12 col-lg-12 col-sm-12">
            <textarea class="productTextarea" name="description" placeholder="Beskrivelse">
                <?php echo (isset($_GET['product']) ? $product['description'] : ''); ?>
            </textarea>
            <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="productDetailsId" value="<?php echo $productDetails['product_id']; ?>">
        </div>
        <div align="center" class="col-12 col-lg-12 col-sm-12">
            <input class="btn btn-warning" style="font-weight:bold;" type="submit" value="Gem & Videre">
            <br />
            <a href="#">Fortryd</a>
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