<!DOCTYPE html>
<html>
<head>
<title>Productpagina</title>

<!-- Metadata insert -->
<?php require '../main/meta.html'; ?>

</head>
<body>

<!-- Navbar insert -->
<?php require "../main/header.php"; ?>
<?php require "../main/nav.php"; ?>

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
        <form action="cart.php" method="get">
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
            <button id="bestelbtn" type="submit">
            Bestel
            </button>

            <?php 
            session_start();
                $item = array(
                    'id' => $ItemID,
                    'naam' => $naam, 
                    'prijs' => $prijs
                );

                $_SESSION['item'] = $item;
            ?>
        </form>
    </div>
</div>
<div class="try"></div>

<script src="controller.js"></script>
</body>
</html> 