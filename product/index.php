<!DOCTYPE html>
<html>
<head>
<title>Productpagina</title>
    <!--header&navbar-->
    <?php require "../main/header.php"; ?>
    <?php require "../main/nav.php"; ?>
    <!-- meta -->
    <?php require"../main/meta.html"; ?>

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
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="https://picsum.photos/400/400
" alt="Los Angeles" style="width:100%;">
      </div>

      <div class="item">
        <img src="https://picsum.photos/400/400" alt="Chicago" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="https://picsum.photos/400/400" alt="New york" style="width:100%;">
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
                <input type="number" name="aantal" value="1">
            </div> 
            <p id="available">
            <!-- Product voorraad -->
            <?="De voorraad is: " . $voorraad; ?>
            </p>

            <input type="hidden" name="func" value="add">
            <?php echo '<input type="hidden" name="id" value="' . $ItemID . '">'; ?>
            <?php echo '<input type="hidden" name="page" value="' . $ItemID . '">'; ?>
            <?php echo '<input type="hidden" name="cat" value="' . $ItemID . '">'; ?>
            <button id="bestelbtn" type="submit">
            Bestel
            </button>
        </form>
    </div>
</div>
<div class="try"></div>

<script src="controller.js"></script>

    <?php require "../main/footer.php"; ?>

</body>
</html> 