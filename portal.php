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
<div class="container justify-content-center text-center">
    <div class="row" id="contentArea">
        <div class="col-12">
            <h1>Tilføj</h1>
            <b>Her kan du vælge at tilføje enten emballage eller fødevarer.</b>
        </div>
        <div class="col-12"><hr /></div>
        <div class="col-12">
        <form method="post" action="admEdit.php">
            <input type="submit" class="btn btn-warning btn-lg btn-block" value="Emballage">
        </form>
        <br />
        <form method="post" action="admFood.php">
            <input type="submit" class="btn btn-warning btn-lg btn-block" value="Fødevarer"> 
        </form>
        <br />
        <?php
            if($_SESSION['userid'] == 1){
                echo '<h1>Administration</h1>';
        ?>
        <form method="post" action="account.php">
            <input type="submit" class="btn btn-danger btn-lg btn-block" value="Virksomhed (TBD)" disabled> 
        </form>
        <br />
        <form method="post" action="account.php">
            <input type="submit" class="btn btn-danger btn-lg btn-block" value="Bruger (TBD)" disabled> 
        </form>
        <?php
            }
        ?>
        </div>
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