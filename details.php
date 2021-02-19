<?php
    session_start();
    require 'app/autoload.php';

    $products = new ProductController();
    $accounts = new AccountController();
    $users    = new UserController();
   
    if(isset($_GET['account']) && !empty($_GET['account'])){
        $accountName = $_GET['account'];
        $accountId = $accounts->getAccountIdByName($_GET['account']);
   }elseif(empty($_GET['account']))
   {
       $accountId = 1;
   }

    if(isset($_GET['id'])){
        $searchedProduct    = $products->getProductById($_GET['id']);
        $productDetails     = $products->getProductDetails($_GET['id']);
        $foodPictures       = $products->getProductsByRelation('packaging', $_GET['id']);


        if($productDetails['height'] != 0 && $productDetails['width'] != 0 && $productDetails['diameter'] != 0 && $productDetails['diameter'] != 0)
        {
            $itemSize = $productDetails['height'] . ' x ' . $productDetails['width'] . ' x ' . $productDetails['diameter'];
        }elseif($productDetails['height'] != 0 && $productDetails['width'] != 0)
        {
            $itemSize = $productDetails['height'] . ' x ' . $productDetails['width'];
        }

        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
    }else{
        header('location:packaging.php');
        exit();
    }

    $siteName = (isset($_GET['id'])) ? $searchedProduct['model'] : 'Emballage';


   # print_r($product);
        require_once 'views/includes/header.php';
    ?>
<!-- CONTENT -->
<div class="container content-main" align="center">
    <div class="row">
        <div class="col-sm-0 col-md-2"></div>
        <div class="col-12 col-sm-12 col-md-4 product-detail-picture">
            <div class="product-picture">
            <img class="modalTrigger" src="<?php echo (!empty($_GET['account']) ?  '../' : ''); ?>../img/products/<?php echo $searchedProduct['image']; ?>">
            <!-- Modal -->
            <div class="modal">
                <!-- Close -->
                <span class="close">&times;</span>
                <!-- Content -->
                <div class="modal-content">
                    <img class="" src="<?php echo (!empty($_GET['account']) ?  '../' : ''); ?>../img/products/<?php echo $searchedProduct['image']; ?>" id="img01">
                    <?php
                    if($searchedProduct['ean'] != 0)
                    {
                        echo '<div class="bigEan">';
                        echo $generator->getBarcode($searchedProduct['ean'], $generator::TYPE_CODE_128, 5, 50);
                ?>
                    <div class="ean-text"><?= $searchedProduct['ean']; ?></div>
                </div>
            <?php } ?>
           
                </div>
                <!-- caption --> 
                <div id="caption"></div>
            </div>

            </div>
            
                <?php
                    if($searchedProduct['ean'] != 0)
                    {
                        echo '<div class="ean">';
                        echo $generator->getBarcode($searchedProduct['ean'], $generator::TYPE_CODE_128);
                ?>
                    <div class="ean-text"><?= $searchedProduct['ean']; ?></div>
                </div>
            <?php } ?>
           
        </div>
        <div class="col-12 col-sm-12 col-md-4 product-detail-info text-left">
            <h2><?= $productDetails['name']; ?></h2>
            <table>
                <tr>
                <?php if(isset($itemSize)){ ?>
                    <td>Størrelse</td>
                    <td><?= $itemSize; ?> cm</td>
                <?php } ?>
                </tr>
                <tr>
                    <td>Varenummer</td>
                    <td><?= $searchedProduct['model']; ?> <?= ($productDetails['reitan'] != 0 ?  '/ ' . $productDetails['reitan'] : ''); ?></td>
                </tr>
                <tr>
                    <td>Antal</td>
                    <td><?= $productDetails['carton']; ?></td>
                </tr>
                <tr>
                <?php if(isset($productDetails['material']) && $productDetails['material'] != ''){?>
                    <td>Materiale</td>
                    <td><?= $productDetails['material']; ?></td>
                <?php } ?>
                </tr>
            </table>
            <div class="spacer"></div>
            <h3>Beskrivelse</h3>
            <p>
                <?= $productDetails['description']; ?>
            </p>
        </div>
    </div>

        <div class="productShowcase">

            <?php    if($foodPictures > 0){ ?>
            <div class="midTitle"><h3>Kan indeholde</h3></div>
           
                <?php
                    $numOfCols = 4;
                    $rowCount = 0;
                    $bootstrapColWidth = 12 / $numOfCols;

                    foreach($foodPictures as $k => $v){
                         if($rowCount % $numOfCols == 0) echo '<div class="row spacer">';
                            echo '<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">';
                            if(isset($_SESSION['userid']) && $_SESSION['userid'] == $accountId){
                                echo '<div class="productAdmin productDelete">';
                                echo '<a class="deleteLink" href="/app/actions/delete.php?product=' . $v["id"] .'"><i class="fa fa-trash"></i></a>';
                                echo '</div>';
                            }
                            
                                echo '<div class="relatedBox">';
                                  echo '<img class="productImg" src="' . (!empty($_GET['account']) ?  '../' : '') . '../img/products/' . $v["image"] . '">';
                                echo '</div>';
                            echo '</div>';
                            
                          $rowCount++;
                if($rowCount % $numOfCols == 0) echo '</div>';
                ?>

            
        <?php }
            } ?>
    </div>
    <?php
if(isset($_SESSION['userid']))
{
?>
<div class="addProduct">
    <a href="/portal.php"><i class="productPlus fas fa-plus"></i></a>
</div>
<?php
}
?>
</div>
    <?php
        require_once 'views/includes/footer.php';
    ?>

</body>
</html>
