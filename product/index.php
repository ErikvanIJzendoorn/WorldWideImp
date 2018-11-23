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
    <div class="picture">
       <img src="https://via.placeholder.com/397" alt="Productimg">
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