<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <?php require '../main/meta.php'; ?>
    <link rel="stylesheet" href="productpage.css">
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
    <script>
        $(function(){
            $('#sort').on('change', function() {
                var sort = $(this).val();
                var params = sort.split(",");
                window.location = "../overzicht/productpage.php?category=" + params[0] + "&productAmount=" + params[1] +
                        "&pageNumber=" + params[2] + "&filter=" + params[3] + "&filterValue=" + params[4] + "&sort=" + params[5];
            });
            
            $('#productAmount').on('change', function() {
                var productAmount = $(this).val();
                var params = productAmount.split(",");
                window.location = "../overzicht/productpage.php?category=" + params[0] + "&pageNumber=" + params[1] +
                        "&sort=" + params[2] + "&filter=" + params[3] + "&filterValue=" + params[4] + "&productAmount=" + params[5];
            });
        });
        function priceSlider(categoryID, pageNumber, sort, numberOfProducts, filter, filterValue) {
            window.location.assign("../overzicht/productpage.php?category=" + categoryID + "&pageNumber=" + pageNumber +
                        "&sort=" + sort + "&productAmount=" + numberOfProducts + "&filter=" + filter + "&filterValue=" + filterValue);
        }
    </script>
</head>
<body>
<?php require '../main/header.php';?>   
<?php require '../main/nav.php'; ?>
<?php require '../search/search.php'; ?>
</body>
</html>