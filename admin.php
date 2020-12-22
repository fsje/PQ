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
        <div class="row" align="center">
            <div id="accountArea" class="col-6 col-sm-12 col-md-6">
                <div class="avatar">
                <?php
                foreach($user as $k => $v){
                   echo '<img class="avatarPicture" src="/assets/avatars/' . $v['avatar'] . '">';
                }
                ?>
                </div>
                <div class="accountInfo">
                    <ul>
                        <?php
                            foreach($user as $k => $v){
                                $company = $v['companyName'];
                                echo '<li><b>Firma:</b> ' . $v['companyName'] . '</li>';
                                echo '<li><b>Kontonummer:</b> ' . $v['id'] . '</li>';
                                echo '<li><b>URL:</b><a class="url" href="https://premiumquality.dk/' . $v['companyName'] . '">https://premiumquality.dk/' . $v['companyName'] . '</a></li>';
                                echo '<li><b>E-mail:</b> ' . $v['mail'] . '</li>';
                            }
                        ?>
                </div>
            </div>
           <div id="adminArea" class="col-6 col-sm-12 col-md-6">
                <h6>Menu</h6>

                <ul>
                    <li><a href="<?php echo '/' . $company . '/packaging'; ?>">Oversigt: Emballage</a></li>
                    <li><a href="<?php echo '/' . $company . '/food'; ?>">Oversigt: Mad</a></li>
                    <li class="spacing"></li>
                    <li><a href="/admPack.php">Tilføj ny</a></li>
                    <li class="logOutBtn"><a href="/app/logout.php">Log ud</a></li>
                </ul>
                
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