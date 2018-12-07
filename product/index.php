<!DOCTYPE html>
<html>
<head>
<title>Productpage</title>
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
                $productimg = "../img/products/Novelty";
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
            <a href="https://www.youtube.com/embed/l6gz1oQVBkw?rel=o&autoplay=1" target="_blank">
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

    <div class="product-description">
            <div class="info row">
                <p><h3><?=$naam?></h3></p>
                <table>
                    
                
                <p><a href="../overzicht/productpage.php?category=<?=$categoryID?>&pageNumber=0&sort=0&productAmount=30&filter=0&filterValue=0"><?="Category: " . $categorie?></a>
                    <?php 
                    if($tags[0] != "") {
                        foreach ($tags as $key) {
                            echo "<br><span><i> $key</i></span>";
                        }
                    } else {
                        echo "<br>";
                    }
                    ?>
                </p>
                <?php if($comments != "") {
                    ?>
                        <tr>
                            <td><?="Comments: </td>" . "<td>" . $comments . "</td>"?>
                        </tr>
                    <?php
                } else {
                    echo "<br>";
                }?>
                    <tr>
                        <td><?="Made in:</td> " . "<td>" . $herkomst[2] . "</td>"?>
                    </tr>
                    <tr>
                        <td><?="Weight: </td>" . "<td>" . $weight . " kg" . "</td>"?>
                    </tr>
                <?php if (isset($color)) {
                    ?>
                        <tr>
                            <td><?="Color: </td>" . "<td>" . $kleur . "</td>"?>
                        </tr>
                    <?php
                } else {
                    echo "<br>";
                }?>
                <tr>
                    <td><?="Packaged: </td>" . "<td>" . $verpakking . "</td>"?>
                </tr>
                <tr id="td-price">
                    <td><?="Price: </td>" . "<td>$" . $prijs . "</td>"?>
                </tr>
                </table>
            </div>
            <form action="../winkelwagen/cart.php?func=add" method="get" id="order-form">
            <div id="bestelamnt row">
                <div>
                    <span id="bestelamnt-span">Order now:</span> <input type="number" id="inputnbr" name="aantal" value="1" min="1" max="<?=$voorraad;?>">

                    <?php if($voorraad >= 100) {
                        ?>
                            <p id="available" style="background-color: green; color: white;">
                            <?="There is enough supply available"?>

                        <?php
                    } else if ($voorraad < 100 && $voorraad > 10) {
                        ?>
                           <p id="available" style="background-color: orange; color: white;">
                           <?="There is limited supply available"?>
                        <?php
                    } else {
                        ?>
                           <p id="available" style="background-color: red; color: white;">
                           <?="There are currently $voorraad items available"?>
                        <?php 
                    } ?> 
                    <!-- Product voorraad -->
                    </p>
                </div>
            </div> 

            <input type="hidden" name="func" value="add">
            <?php echo '<input type="hidden" name="id" value="' . $ItemID . '">'; ?>
            <?php echo '<input type="hidden" name="page" value="' . $ItemID . '">'; ?>
            <?php echo '<input type="hidden" name="cat" value="' . $categoryID . '">'; ?>
            <button style="margin-top: 50px;" id="bestelbtn" type="submit">
            Add to cart
            </button>
        </form>
    </div>
</div>

    <div>
        <div style="margin-top: 200px">        
            <h2>Perhaps you are also interested in these items
                <b>&#8595;</b>
            </h2>
        </div>
        <div class="recommended">
            <?php 
            $i=0;
            $recommended = [];
            $imgindex = 1;
            $stmt = getProductsByCategory($categoryID);
            while($row = $stmt->fetch()) {
                $recommend = array('id' => $row['id'], 'naam' => $row['naam'], 'prijs' => $row['prijs']);
                array_push($recommended, $recommend);
                $i++;
            }
            shuffle($recommended);

            for ($i=0; $i < 3; $i++) { 
                $imgindex = rand(1,3);
                ?>
                <div class="recommend-div">
                    <a href="../product/index.php?product=<?=$recommended[$i]['id'];?>&category=<?=$categoryID;?>">
                        <img src='<?php echo $productimg . $imgindex;?>.jpg' alt='Productimg' heigt='200px' width='200px'>
                        <p><?=$recommended[$i]['naam'];?></p>
                        <p>$<?=$recommended[$i]['prijs'];?></p>
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