<?php
session_start();
if(isset($_SESSION['userid']))
{header('location:admin.php');}
    require 'app/autoload.php';
    require_once 'views/includes/header.php';
?>
        <!-- CONTENT -->
  <div class="container">
        <div class="row" align="center">
            <div class="col-md-3"></div>
           <div id="aboutUs" class="col-12 col-sm-12 col-md-6">
           <?php
                if(isset($_SESSION['error']))
                {
                    echo '<b>Der opstod en fejl med dit brugernavn/adgangskode!</b><br />
                    Hvis du har glemt dine oplysninger, kontakt <a href="https://plant2plast.com"><u>Plant2Plast</u></a>.<hr />';
                    unset($_SESSION['error']);
                }
           ?>
            <form action="app/login.php" method="post">
                <div class="form-group login-group">
                    <label for="accountNumber">Kontonummer</label>
                    <input name="accountNumber" type="text" class="form-control" id="accountNumber" aria-describedby="emailHelp" placeholder="Kontonummer">
                    <small id="emailHelp" class="form-text text-muted">Du kan få at kontonummer hos <a href="https://plant2plast.com"><u>Plant2Plast</u></a></small>
                </div>
                <div class="form-group login-group">
                    <label for="password">Adgangskode</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Adgangskode">
                </div>
                <button type="submit" class="btn btn-light">Login</button>
            </form>
            </div>
				
            <div class="col-md-3"></div>
        </div>
</div>
<div class="disp">
	<img src="https://premiumquality.dk/img/Baner-cake-pq-dis.png" id="dispImg">
</div>

            <?php
                require_once 'views/includes/footer.php';
            ?>
            <script>
         
            </script>
    </body>
</html>