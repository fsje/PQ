<?php
session_start();
if(!isset($_SESSION['userid']))
{header('location:login.php');}
    require 'app/autoload.php';
    require_once 'views/includes/header.php';

    $userController = new UserController();
    $user = $userController->getUserByAccountNumber($_SESSION['userid']);

    if(isset($_GET['product'])){
        $productController  = new ProductController();
        $product            = $productController->getProductById($_GET['product']);
        $productDetails     = $productController->getProductDetails($product['id']);
        $getFoods           = $productController->getProductsByType('food', $_SESSION['userid']);
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
                    }
                ?>
            </h2>
            <h3>Vælg nogle billeder, der viser emballagen med fødevarer i.</h3>
            <br />
        </div>
    <div class="col-6 col-sm-12 col-md-6">
        <form action="app/actions/addRelate.php" method="post"> 
            <div class="form-group form1">
                            <label for="inputsm">Produkttype</label>
                            <select name="relativeFood[]">
                                <option value="" selected>Vælg fødevarer</option>
                                <?php
                                    foreach($getFoods as $k => $v)
                                    {
                                        echo '<option value="' . $product['model'] . '-' . $v['model'] . '">' . $v['model'] . '</option>';
                                    }
                                    ?>
                            </select>
                        </div>
            </div>
            <div class="col-6 col-sm-12 col-md-6">
                        <div class="form-group form2">
                            <label for="inputdefault">Billede</label>
                            <input name="image[]" class="form-control" id="inputdefault" type="text">
                        </div>
            </div>
            <div class="col-12 col-lg-12 col-sm-12">
            <div class="btnActions">
                <button class="add_form_field">Tilføj flere</button>
            </div>
                <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">
            </div>
            <div align="center" class="col-12 col-lg-12 col-sm-12">
                <input class="btn btn-warning" style="font-weight:bold;" type="submit" value="Gem">
                <br />
                <a href="#">Fortryd</a>
                <in
            </div>
        </form>
    </div>
</div>

<script>

$(document).ready(function(){
    var max_fields  = 4;
    var wrapper1    = $('.form1');
    var wrapper2    = $('.form2');
    var add_button  = $('.add_form_field') 

    // X er lig 1
    var x = 0;

    $(add_button).click(function(e){
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper1).append('<div><select name="relativeFood[]"><option value="" selected>Vælg fødevarer</option><?php foreach($getFoods as $k => $v){echo '<option value="' . $product['model'] . '-' . $v['model'] . '">' . $v['model'] . '</option>';}?> </select></div>'); //add input box<a href="#" class="delete">Delete</a>
            $(wrapper2).append('<div><input name="image[]" class="form-control" id="inputdefault" type="text"></div>'); //add input box <a href="#" class="delete">Delete</a>
        }else{
            alert("Du kan maks tilføje " + max_fields + " ad gangen!");
        }  

        if(x == 1) {
            $('.btnActions').append('<button class="remove_form_field">Tilføj færre</button>');
        }else if(x > 1){
            $('.remove_form_field').remove();
        }
    });

   $('.remove_form_field').click(function(e){
       e.preventDefault();
       console.log("Add functionality");
   })

    // Delete (W1)
    $(wrapper1).on('click', '.delete', function(e){
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })

});


</script>

<div class="disp">
	<img src="https://premiumquality.dk/img/Baner-cake-pq-dis.png" id="dispImg">
</div>

            <?php
                require_once 'views/includes/footer.php';
            ?>
    </body>
</html>