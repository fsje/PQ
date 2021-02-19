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
                if(isset($product)){
                foreach($product as $k => $v){
                  if($rowCount % $numOfCols == 0) echo '<div class="row spacer">';
                echo '<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">';
               
                    echo '<div class="productBox">';
                    if(isset($_SESSION['userid']) && $_SESSION['userid'] == $accountId){
                        echo '<div class="productAdmin productEdit">';
                            echo '<a href="/admEdit.php?product=' . $v["id"] .'"><i class="fa fa-edit"></i></a>';
                        echo '</div>';
                        echo '<div class="productAdmin productDelete">';
                            echo '<a class="deleteLink" href="/app/actions/delete.php?product=' . $v["id"] .'"><i class="fa fa-trash"></i></a>';
                        echo '</div>';
                    }
                    echo (isset($_GET['id'])) ? '<a href="details.php?id=' . $v["parent_id"] . '">' : '<a href="' . (!empty($accountName) ? '/' . $accountName . '' : '') . '/packaging/' . $v["id"] . '">';
                      echo '<img class="productImg" src="' . (!empty($accountName) ? '../' : '') . 'img/products/' . $v["image"] . '">';
                    echo '</div>';
                echo '</a>';
            echo '</div>';
                  $rowCount++;
                if($rowCount % $numOfCols == 0) echo '</div>';
              }
            }else{
                echo '<div class="row justify-content-center">';
                echo ' <div id="aboutUs" class="col-12 col-sm-12 col-md-6">';
                echo '<p><b>Ingen varer!</b></p><p>Det ser ud til at der ikke er nogle varer. <br /><a href="https://plant2plast.com"><u>Kontakt os</u></a> såfremt at du mener, at der er tale om en fejl.</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>

    </div>
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

<script>
$(".deleteLink").on("click", function(e) {
    var link = this;

    e.preventDefault();

    $("<div>Du er ved at slette en vare! Er du sikker?</div>").dialog({
        buttons: {
            "Ja": function() {
                window.location = link.href;
            },
            "Nej, fortryd": function() {
                $(this).dialog("close");
            }
        }
    });
});
</script>
    <?php
        require_once 'views/includes/footer.php';
    ?>
</body>
</html>
