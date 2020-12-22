<?php
    error_reporting(0); // tmp fix.
    require 'app/autoload.php';
    $searchTerm = $_GET['q'];
    $products = new ProductController();
    if(isset($searchTerm))
    {
        $product = $products->searchProduct($searchTerm, 'packaging');
    }
    $siteName = (isset($_GET['id'])) ? $searchedProduct['model'] : 'Emballage';

    require_once 'views/includes/header.php';
    ?>
    <!-- CONTENT -->
    <div class="container content-main" align="center">
        <div class="productShowcase">
                <?php
                    if(is_array($product))
                    {
                        $numOfCols = 4;
                        $rowCount = 0;
                        $bootstrapColWidth = 12 / $numOfCols;
                        foreach($product['details'] as $k => $v)
                        {
                            $picture = $products->getProductById($v['id']);
                            if($rowCount % $numOfCols == 0) echo '<div class="row spacer">';
                                echo '<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">';
                                    echo ($v['carton'] > 0) ? '<a href="packaging/' . $v["product_id"] . '">' : '<a href="food/' . $v["product_id"] . '">';
                                        echo '<div class="productBox">';
                                            echo '<img class="productImg" src="img/products/' . $picture["model"] . '.png">';
                                        echo '</div>';
                                    echo '</a>';
                                echo '</div>';
                            $rowCount++;
                            if($rowCount % $numOfCols == 0) echo '</div>';
                        }
                    }else{
                        echo '<div class="row" align="center">
                        <div class="col-md-3"></div>
                        <div id="aboutUs" class="col-12 col-sm-12 col-md-6">
                                <p>
                                    Der blev ikke fundet nogle resultater!<br />
                                    <a href="/"><u>Gå tilbage</u></a> eller søg igen.
                                </p>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    </div>';
                    }
                ?>
        </div>
    </div>
    <?php
        require_once 'views/includes/footer.php';
    ?>
</body>
</html>
