<!DOCTYPE html>
<html>
<head>
    <title>Productoverzicht</title>
    <?php require '../main/meta.html'; ?>
    <link rel="stylesheet" href="productpage.css">
    <script>
        $(function(){
            $('#sort').on('change', function() {
                var sort = $(this).val();
                var params = sort.split(",");
                window.location = "../overzicht/productpage.php?category=" + params[0] + "&productAmount=" + params[1] +
                        "&pageNumber=" + params[2] + "&sort=" + params[3];
            });
            
            $('#productAmount').on('change', function() {
                var productAmount = $(this).val();
                var params = productAmount.split(",");
                window.location = "../overzicht/productpage.php?category=" + params[0] + "&pageNumber=" + params[1] +
                        "&sort=" + params[2] + "&productAmount=" + params[3];
            })
        });
    </script>
</head>
<body>
<?php require '../main/header.php';?>   
<?php require '../main/nav.php'; ?>
</body>
</html>