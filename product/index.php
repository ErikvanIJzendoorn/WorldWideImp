<!DOCTYPE html>
<html>
<head>
<title>Productpagina</title>
<!-- Database Connection -->


<!-- Metadata insert -->
<?php require '../meta.html'; ?>

</head>
<body>

<!-- Navbar insert -->
<?php require "../nav.php"; ?>

<?php require "product.php"; ?>
<div class="content">
    <div class="product-name">
        <p>
        <!-- Productnaam -->
        <?=$naam; ?>
        </p>
    </div>
    <div class="picture">
       <img src="https://via.placeholder.com/397" alt="Productimg">
    </div>
    <div class="product-description">
        <p>
        <!-- Productnaam -->
        <?=$naam; ?>
        </p>
        <br>
        <p class="product-price">
        <!-- Productprijs -->
        <?="€" . $prijs; ?>
        </p>
        <div id="bestelamnt">
            <input type="number" name="amount" value="1">
        </div> 
        <p id="available">
        <!-- Product voorraad -->
        <?="De voorraad is: " . $voorraad; ?>
        </p>
        <button id="bestelbtn">
        Bestel
        </button>
    </div>
</div>
<div class="try"></div>

<script src="controller.js"></script>
</body>
</html> 