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
                        echo 'Du er ved at oprette nyt emballage.';
                    }
                ?>
            </h2>
        </div>
        <div class="col-6 col-sm-12 col-md-6">
                <form action="app/actions/<?php echo (isset($_GET['product']) ? 'edit.php' : 'add.php'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="packaging">
                    <div class="form-group">
                        <label for="inputdefault">Varenummer (Plant2Plast)</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $product['model'] : ''); ?>" name="modelP2P" id="inputdefault" type="text" required>
                    </div>
                    <div class="form-group">
                        <label class="packagingOnly" for="inputlg">Varenummer (Kunde)</label>
                        <input class="form-control packagingOnly" value="<?php echo (isset($_GET['product']) ? $productDetails['reitan'] : ''); ?>" name="modelCustomer" id="inputlg" type="text" required>
                    </div>
                    <div class="form-group">
                        <label class="packagingOnly" for="inputsm">EAN Nummer</label>
                        <input class="form-control packagingOnly" value="<?php echo (isset($_GET['product']) ? $product['ean'] : ''); ?>" name="ean" id="inputsm" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="inputsm">Produktnavn</label>
                        <input class="form-control" value="<?php echo (isset($_GET['product']) ? $productDetails['name'] : ''); ?>" name="productName" id="inputsm" type="text" required>
                    </div>
        </div>
        <div class="col-6 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label class="packagingOnly" for="inputdefault">Størrelse</label>
                        <input class="form-control packagingOnly" id="inputdefault" type="text" required>
                    </div>
                    <div class="form-group">
                        <label class="packagingOnly" for="inputlg">Kolistørrelse</label>
                        <input class="form-control packagingOnly" value="<?php echo (isset($_GET['product']) ? $productDetails['carton'] : ''); ?>" name="carton" id="inputlg" type="text" required>
                    </div>
                    <div class="form-group">
                        <label class="packagingOnly" for="inputsm">Materiale</label>
                        <input class="form-control packagingOnly" value="<?php echo (isset($_GET['product']) ? $productDetails['material'] : ''); ?>" name="material" id="inputsm" type="text" required>
                    </div>
                    <?php
                        if(isset($_GET['product'])){
                    ?>
                    <div class="form-group">
                        <label for="inputsm">Nuværende billede</label>
                        <input class="form-control-plaintext" style="color:#fff; font-weight:bold;" readonly value="<?php echo (isset($_GET['product']) ? $product['image'] : ''); ?>" name="image" id="inputsm" type="text" required>
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
        <div class="col-12 col-lg-12 col-sm-12"><textarea class="productTextarea packagingOnly" name="description" placeholder="Beskrivelse"><?php echo (isset($_GET['product']) ? $productDetails['description'] : ''); ?></textarea>
            <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="productDetailsId" value="<?php echo $productDetails['product_id']; ?>">
        </div>
        <div align="center" class="col-12 col-lg-12 col-sm-12">
                <!-- Buttons -->
                <div class="btn-group" role="group" aria-label="Actions">
                    <button href="#" class="btn btn-danger">Fortryd</button>
                    <button type="submit" class="btn btn-success"><b>Opret & Næste</b></button>
                    <?php
                        if(isset($_GET['product'])){
                            echo '<button class="relations btn btn-warning"><b>Relationer</b></button>';
                        }
                    ?>
                </div>
        </div>
        </form>
        <?php if(isset($_GET['product'])){ ?>
        <div class="disp">
	<img src="https://premiumquality.dk/img/products/<?php echo $product['image']; ?>" id="dispImg">
    </div>
    <?php } ?>
        <script>
            $('.relations').click(function(e){
                e.preventDefault();
                window.location.href = 'admAddFood.php?product=<?php echo $product['id']; ?>';
            });
        </script>
    </div>
</div>
            <?php
                require_once 'views/includes/footer.php';
            ?>
    </body>
</html>