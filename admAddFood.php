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
<div id="loading">
  <img id="loading-image" src="/img/ajax-loader-large.gif" alt="Loading..." />
</div>

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


            <form action="app/actions/addRelate.php" method="post"> 
                <div class="form-row">
                <!-- Select food(s) -->
                    <div class="form-group col-md-6 form1">
                    <label for="relativefood">Passende fødevarer</label>
                    <select name="relativeFood[]">
                        <option id="relativefood" value="" selected>Vælg fødevarer</option>
                            <?php
                                foreach($getFoods as $k => $v)
                                {
                                    echo '<option value="' . $product['model'] . '-' . $v['model'] . '">' . $v['seo_alias'] . '</option>';
                                }
                            ?>
                    </select>
                    </div>

                    <!-- File part -->
                    <div class="form-group col-md-6 form2">
                        <label for="inputPassword4">Billede</label>
                        <input type="text" name="images[]" class="form-control" id="inputPassword4" placeholder="Billede">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="btn-group" role="group" aria-label="Actions">
                    <button type="submit" class="btn btn-secondary add-fields">Tilføj flere</button>
                    <button href="#" class="btn btn-warning">Fortryd</button>
                    <button type="submit" class="btn btn-success">Gem</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        // remove loader when ready
        $('#loading').hide();

        var max_fields  = 4;
        var wrapper1    = $('.form1');
        var wrapper2    = $('.form2');
        var add_button  = $('.add-fields') 

        // X er lig 1
        var x = 0;

        $(add_button).click(function(e){
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper1).append('<div><select name="relativeFood[]"><option value="" selected>Vælg fødevarer</option><?php foreach($getFoods as $k => $v){echo '<option value="' . $product['model'] . '-' . $v['model'] . '">' . $v['model'] . '</option>';}?> </select></div>'); //add input box<a href="#" class="delete">Delete</a>
                $(wrapper2).append('<div><input name="images[]" class="form-control" id="inputdefault" type="text"></div>'); //add input box <a href="#" class="delete">Delete</a>
            }else{
                alert("Du kan maks tilføje " + max_fields + " ad gangen!");
            }  

            if(x == 1) {
                $('.btnActions').append('<button class="remove_form_field">Fjern felter</button>');
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
 <?php require_once 'views/includes/footer.php'; ?>
    </body>
</html>