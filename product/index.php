<!DOCTYPE html>
<html>
<head>
<title>Productpagina</title>
<link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
<!--header&navbar-->
    <?php require "../main/meta.php"; ?>
    <?php require "../main/header.php"; ?>
    <?php require "../main/nav.php"; ?>
    <?php require '../search/search.php'; ?>
    <!-- meta -->

</head>
<body>

<?php require "product.php"; ?>
<div class="content">
    <div class="product-name">
        <p>
        <!-- Productnaam -->
        <?=$naam; ?>
        </p>

</div>
    
<div class="outer-slide-container">
  <div id="myCarousel" class="carousel slide slider-container" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>

    </ol>

    <?php 
    switch ($categoryID) {
        case 1:
            $productimg = "../img/products/Novelty";
            break;
        case 2:
            $productimg = "../img/products/Hoodie";
            break;
        case 3:
            $productimg = "../img/products/Mug";
            break;
        case 4:
            $productimg = "../img/products/T-shirt";
            break;
        case 6:
            $productimg = "../img/products/Mug";
            break;
        case 7:
            $productimg = "../img/products/Usb";
            break;
        case 8:
            $productimg = "../img/products/Slippers";
            break;
        case 9:
            $productimg = "../img/products/Toy";
            break;
        case 10:
            $productimg = "../img/products/Materials";
            break;
    }
    ?>
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="<?=$productimg;?>1.jpg" height="400" width="400">
      </div>

      <div class="item">
          <img src="<?=$productimg;?>2.jpg" height="400" width="400">
      </div>
    
      <div class="item">
        <img src="<?=$productimg;?>3.jpg" height="400" width="400">
      </div>

      <div class="item">
        <a href="https://www.youtube.com/watch?v=l6gz1oQVBkw">
            <img src="../img/play.jpg" height="400" width="400">
        </a>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
    </div>
    <div class="product-description">
        <form action="../winkelwagen/cart.php?func=add" method="get">
            <p>
            <!-- Productnaam -->
            <?=$naam; ?>
            </p>
            <br>
            <p class="product-price" name="prijs">
            <!-- Productprijs -->
            <?="€" . $prijs; ?>
            </p>
            <div id="bestelamnt">
                <input type="number" name="aantal" value="1" min="1" max="<?=$voorraad;?>">
            </div> 
            <?php if($voorraad >= 100) {
                ?>
                    <p id="available" style="background-color: green; color: white;">
                    <?="There is enough supply availlable"?>

                <?php
            } else if ($voorraad < 100 && $voorraad > 10) {
                ?>
                   <p id="available" style="background-color: orange; color: white;">
                   <?="There is enough supply availlable"?>
                <?php
            } else {
                ?>
                   <p id="available" style="background-color: red; color: white;">
                   <?="There are currently $voorraad items availlable"?>
                <?php 
            } ?> 
            <!-- Product voorraad -->
            </p>

            <input type="hidden" name="func" value="add">
            <?php echo '<input type="hidden" name="id" value="' . $ItemID . '">'; ?>
            <?php echo '<input type="hidden" name="page" value="' . $ItemID . '">'; ?>
            <?php echo '<input type="hidden" name="cat" value="' . $categorieID . '">'; ?>
            <button id="bestelbtn" type="submit">
            Bestel
            </button>
        </form>
    </div>

    <div class="row">
        <div class="recommended col-md-12" style="margin-top: -150px; margin-left: 100px;">
        <h1>Maybe you want this instead?</h1>
                <?php 
            $i=0;
            $recommended = [];
            $imgindex = 1;
            $stmt = getProductsByCategory($categorieID);
            while($row = $stmt->fetch()) {
                $recommend = array('id' => $row['id'], 'naam' => $row['naam'], 'prijs' => $row['prijs']);
                array_push($recommended, $recommend);
                $i++;
            }
            shuffle($recommended);

            for ($i=0; $i < 3; $i++) { 
                $imgindex = rand(1,3);
                ?>
                <div class="col-md-4">
                    <a href="../product/index.php?product=<?=$ItemID;?>&category=<?=$categorieID;?>">
                        <img src='<?php echo $productimg . $imgindex;?>.jpg' alt='Productimg' heigt='200px' width='200px'>
                        <p><?=$recommended[$i]['naam'];?></p>
                        <p><?=$recommended[$i]['prijs'];?></p>
                    </a>
                </div>
                <?php
            }
        ?>
        </div>
    </div>
    <?php require "../main/footer.php"; ?>
</body>
</html> 