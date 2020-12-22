<?php
    require 'app/autoload.php';
    require_once 'views/includes/header.php';
    ?>
        <!-- CONTENT -->
        <div class="container-fluid">
            <div class="row category-icons">
                <div class="col-0 col-md-2 col-lg-4"></div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-2 category-buttons" align="center">
                    <a href="<?php echo (!empty($_GET['account']) ?  $_GET['account'] . '/' : ''); ?>food">
                        <div class="category-icon-wrap-m">
                            <img class="category-icon-m" src="<?php echo (!empty($_GET['account']) ?  '../' : ''); ?>img/Icon_food.svg"/>
                        </div>
                        <div class="category-box-m">
                            <h3 class="category-text">Mad</h3>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-2 category-buttons" align="center">
                    <a href="<?php echo (!empty($_GET['account']) ?  $_GET['account'] . '/' : ''); ?>packaging">
                        <div class="category-icon-wrap-e">
                            <img class="category-icon-e" src="<?php echo (!empty($_GET['account']) ?  '../' : ''); ?>img/Icon_emballage.svg"/>
                        </div>
                        <div class="category-box-e">
                            <h3 class="category-text">Emballage</h3>
                        </div>
                    </a>
                </div>
                <div class="ol-md-2 col-lg-4"></div>
            </div>
            </div>
            <div class="container">
        <div class="row" align="center">
            <div class="col-md-3"></div>
           <div id="aboutUs" class="col-12 col-sm-12 col-md-6">
                    <p id="peep">
  
                        Premium Quality™ er en serie special udviklet
                        takeaway emballage af Plant2Plast i sammarbejde
                        med Danmarks førende Retail kæder.
                        Emballagen er udviklet med tanken på unikt design,
                        miljøhensyn, kvalitet og som samtidigt er prisdygtig.
                        Denne portal gør det nemmere for vores kunder at
                        søge og finde den rette emballage til deres specifikke
                        menu.
					</p>

					<script> document.getElementById("peep").innerHTML = Dan; </script>

					<div id=langBtn>
					  <button class="btn2" onclick="myFunction(Dan)">Danish</button>
					  <button class="btn2" onclick="myFunction(Eng)">English</button>
					</div>
					<script>
					var Dan = 							`Premium Quality™ er en serie special udviklet
											takeaway emballage af Plant2Plast i sammarbejde
											med Danmarks førende Retail kæder.
											Emballagen er udviklet med tanken på unikt design,
											miljøhensyn, kvalitet og som samtidigt er prisdygtig.
											Denne portal gør det nemmere for vores kunder at
											søge og finde den rette emballage til deres specifikke
											  menu.`
											
					var Eng = 							`Premium Quality ™ is a series of uniqe developed 
																	takeaway packaging by Plant2Plast in collaboration with Denmark's leading Retail chains. 
											The packaging is developed with the idea of unique design, environmental considerations, quality and affordable. 
											This portal makes it easier for our customers to search and find the best packaging for their specific menu.`
					function myFunction(name)
					{
					document.getElementById("peep").innerHTML =  name;
					}
					</script>
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