<?php
session_start();
if(!isset($_SESSION['userid']))
{header('location:login.php');}
    require 'app/autoload.php';
    require_once 'views/includes/header.php';

    $userController = new UserController();
    $user = $userController->getUserByAccountNumber($_SESSION['userid']);
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
                        echo 'Du er ved at oprette en ny virksomhed.';
                    }
                ?>
            </h2>
        </div>
        <div class="col-12 col-sm-12 col-md-12">
                <form action="app/actions/<?php echo (isset($_GET['product']) ? 'editUser.php' : 'adduser.php'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="food">
                    <div class="form-group">
                        <label for="inputsm">Virksomhedsnavn</label>
                        <input class="form-control" placeholder="Eksempelvis Plant2Plast" name="companyName" id="inputsm" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="inputsm">Kodeord</label>
                        <input class="form-control" placeholder="Adgangskode" name="password" id="inputsm" type="password" required>
                    </div>
                    <div class="form-group">
                        <label for="inputsm">E-mail på kontaktperson</label>
                        <input class="form-control" placeholder="E-mail på kontaktperson hos virksomheden" name="mail" id="inputsm" type="mail" required>
                    </div>
                    <div class="form-group">
                        <label for="image"><?php echo (isset($_GET['product']) ? 'Upload et nyt billede' : 'Upload billede'); ?></label>
                        <input type="file" name="avatar" class="form-control-file" id="image">
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
</div>
            <?php
                require_once 'views/includes/footer.php';
            ?>
    </body>
</html>