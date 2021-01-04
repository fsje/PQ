<!doctype html>
<html>
    <head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-156587847-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-156587847-1');
	</script>


        <?php
            if($_SERVER['REQUEST_URI'] == '/packaging'){
                echo '<title>Emballage - PremiumQuality.dk - Make your food more premium!</title>';
            }elseif($_SERVER['REQUEST_URI'] == '/food'){
                 echo '<title>Mad - PremiumQuality.dk - Make your food more premium!</title>';
            }else{
                echo '<title>Premium Quality - Make your food more premium!</title>';
            }
        ?>
		
		<!-- favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="/views/includes/favicon/faviconB.ico">

		 <link rel="icon" sizes="430x430" type="image/png" href="/img/speeddial.png">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <!-- Core CSS -->
        <link rel="stylesheet" href="/css/core.css?v=<?= filemtime('css/core.css') ?>" type="text/css">

        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        
        <!-- jQuery UI -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" type="text/css">
        <!-- CookieBot (Autoblock)-->
		<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="00000000-0000-0000-0000-000000000000" type="text/javascript" data-blockingmode="auto"></script>
		<!-- CookieBot 
        <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="8179b469-6d31-4a84-9445-5dc32121bcaa" type="text/javascript" async></script>-->

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-98497748-2"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-98497748-2');
        </script>   

    </head>
<body>
    <header>
        <!-- HEADER / SIDEBAR BUTTON -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-4 col-sm-4 col-ms-4">
                    <a onclick="goBack()"><i data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom" class="goBack fa fa-2x fa-arrow-left"></i></a>
                </div>
				<div class="col-4 col-sm-4 col-ms-4" align="center">
					<div class="button-group-container">
						<div class="button-group">

						  <a href="http://www.premiumquality.dk/download/Premium_Quality_full_catalog.pdf"> <img class="download-icon" src="/img/icon_download.svg"/> <p>produktliste</p></a>
						  <!-- <button>Katalog</button> -->
						</div>	
					</div>
				</div>
                <div class="col-4 col-sm-4 col-ms-4" align="right">
                <a href="/login.php"><img class="loginIcon" src="/img/icon_login.svg"></a>
                <button type="button" id="sidebarCollapse" class="navbar-btn active">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
		</div>
            <!-- SIDEBAR -->
            <nav id="sidebar" class="active">
                <ul class="list-unstyled components">
                    <li>
                        <a href="<?php echo (!empty($_GET['account']) ?  $_GET['account']: ''); ?>/packaging"><img class="sidebar-icon" src="/img/Icon_emballage.svg"/></a>
                    </li>
                    <li>
                        <a href="<?php echo (!empty($_GET['account']) ?  $_GET['account']: ''); ?>/food"><img class="sidebar-icon" src="/img/Icon_food.svg"/></a>
                    </li>
                </ul>
            </nav>
    </header>
    <div class="container-fluid">
        <div class="row breadCrumbs">
             <div class="col-0 col-md-12 breadCrumbsItem">
                <?php
                    if(isset($_GET['id'])) {
                        echo breadCrumbs($products->getProductById($_GET['id']));
                    }else{
                        echo breadCrumbs();
                    }
                ?>
            </div>
        </div>
        <div class="row search">
                <div class="col-12 col-sm-12 col-md-12" align="center">
                    <div class="container-4">
                        <form action="https://premiumquality.dk/search.php" method="get">
                            <input type="search" name="q" class="searchField" id="search" placeholder="Søg..." autocomplete="off" />
                            <button class="icon"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
        <img src="https://premiumquality.dk/img/pq-logo.png" id="logo">

