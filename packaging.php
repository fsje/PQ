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
        $product = $products->getProductsByRelation('packaging', $_GET['id']);
        $searchedProduct = $products->getProductById($_GET['id']);
    }else{
        $product = $products->getProductsByType('packaging', $accountId);
    }

    $siteName = (isset($_GET['id'])) ? $searchedProduct['model'] : 'Emballage';

   # print_r($product);
        require_once 'views/includes/header.php';
    ?>
<!-- CONTENT -->
<div class="container content-main" align="center">
    <div class="productShowcase">
            <?php
                $numOfCols = 4;
                $rowCount = 0;
                $bootstrapColWidth = 12 / $numOfCols;
                foreach($product as $k => $v){
                  if($rowCount % $numOfCols == 0) echo '<div class="row spacer">';
                echo '<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">';
               
                    echo '<div class="productBox">';
                    if(isset($_SESSION['userid']) && $_SESSION['userid'] == $accountId){
                        echo '<div class="productAdmin productEdit">';
                            echo '<a href="/admEdit.php?product=' . $v["id"] .'"><i class="fa fa-edit"></i></a>';
                        echo '</div>';
                        echo '<div class="productAdmin productDelete">';
                            echo '<a href="/admDelete.php?product=' . $v["id"] .'"><i class="fa fa-trash"></i></a>';
                        echo '</div>';
                    }
                    echo (isset($_GET['id'])) ? '<a href="details.php?id=' . $v["parent_id"] . '">' : '<a href="' . (!empty($accountName) ? '/' . $accountName . '' : '') . '/packaging/' . $v["id"] . '">';
                      echo '<img class="productImg" src="' . (!empty($accountName) ? '../' : '') . 'img/products/' . $v["model"] . '.png">';
                    echo '</div>';
                echo '</a>';
            echo '</div>';
                  $rowCount++;
                if($rowCount % $numOfCols == 0) echo '</div>';
              }
            ?>

    </div>
</div>
    <?php
        require_once 'views/includes/footer.php';
    ?>
</body>
</html>
