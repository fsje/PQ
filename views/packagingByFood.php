<!doctype html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>{{siteName}} - {{siteTitle}}</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css?v=1.3" type="text/css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="../views/css/core.css?v=1.3" type="text/css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>
<body>
<div class="container-fluid top-bar">
    <div class="row">
        <div class="col-md-12">

            <div class="trapizium">{{siteName}}</div>
        </div>
    </div>
</div>
<header>
    <!-- HEADER / SIDEBAR BUTTON -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <button type="button" id="sidebarCollapse" class="navbar-btn active">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
            <div class="col-md-6 search" align="right">
                <i class="fa fa-3x fa-search"></i>
            </div>
        </div>
    </div>
    <!-- SIDEBAR -->
    <nav id="sidebar" class="active">

        <ul class="list-unstyled components">
            <li>
                <a href="#"><img class="sidebar-icon" src="../views/img/Icon_emballage.svg"/></a>
            </li>
            <li>
                <a href="../food/"><img class="sidebar-icon" src="../views/img/Icon_food.svg"/></a>
            </li>
            <li>
                <a style="color:#000 !important;" href="../"><i class="fa fa-3x fa-undo"></i></a>
            </li>
        </ul>
    </nav>
</header>
<!-- CONTENT -->
<div class="container content-main" align="center">
    <!-- <div class="row">
         <div class="col-md-12">
             <div class="header-text">
                 <h1>{{siteName}}</h1>
             </div>
         </div>
     </div>-->
    <div class="productShowcase">
        <div class="row spacer">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <a href="PCB16">
                    <div class="productBox">
                        <img class="productImg" src="../views/img/products/KBH22-PQ.png">
                    </div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="productBox">
                    <img class="productImg" src="../views/img/products/Bag12-PQ.png">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="productBox">
                    <img class="productImg" src="../views/img/products/PBSBL1-PQ.png">
                </div>
            </div>
        </div>

    </div>
</div>
</div> <!-- End wrapper -->

<footer class="container-fluid">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 copyright" align="center">
            <p>Copyright &copy; 2018</p>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 credits" align="center">
            <p>Et produkt af <a target="_blank" href="https://plant2plast.com">Plant2Plast - Miljøvenligt emballage</a></p>
        </div>
    </div>
</footer>


<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
    });


</script>

</body>
</html>