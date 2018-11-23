<!DOCTYPE html>
<html>
<head>
    <title>Productoverzicht</title>
    <?php require '../main/meta.html'; ?>
    <link rel="stylesheet" href="productpage.css">
    <script>
        $(function(){
            $('#sort').on('change', function () {
                var sort = $(this).val();
                var params = sort.split(",");
                window.location = "../overzicht/productpage.php?category=" + params[0] + "&pageNumber=" + params[1] + "&sort=" + params[2];
            });
        });
    </script>
</head>
<body>
<?php require '../main/header.php';?>   
<?php require '../main/nav.php'; ?>
</body>
</html>