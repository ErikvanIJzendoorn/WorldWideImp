<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
        <!-- <link rel="icon" type="image/png" href="../img/favicon-16x16.png" sizes="16x16" /> -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- CSS style sheet -->
        <link rel="stylesheet" type="text/css" href="../main/style.css">
        <!-- ROBOTO font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <!-- FONT AWESOME -->   
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous"> 
<!--         <script type="text/javascript" src="../main/stickyController.js"></script> -->

        <title> Cart </title>
    </head>
    <body>
        <?php 
            require 'cart.php';
            require '../main/nav.php';
            require '../main/header.php' ;
            require '../search/search.php'; 
        ?>

        <link href="../winkelwagen/cart.css" type="text/css" rel="stylesheet">
        <div class="container" style="margin-top: 70px;">
            <div class="row">
                <div class="col-sm-12 col-md-10 col-md-offset-1" style="margin-top: 70px;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th class="text-center">Unit Price</th>
                                <th class="text-center">Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody> 
                        <?php
                        if($_SESSION['cart'] != null) {
                            $cart = $_SESSION['cart'];
                        } else {
                            $_SESSION['cart'] = null;
                        }
                        $totaal = 0;
                        $Subtotal = 0;
                        $totaalBtw = 0;
                        $prijs = 0;
                        $btw = 0;
                        $i = 0;
                        if ($_SESSION['cart'] != null) {
                            foreach ($_SESSION['cart'] as $key => $value) {
                                $stmt = getProduct($value['id'], $value['category']);
                                if ($row = $stmt->fetch()) {
                                    $id = $value['id'];
                                    $naam = $row['naam'];
                                    $unit = $row['prijs'];
                                    $aantal = $value['aantal'];
                                    $voorraad = $row['voorraad'];
                                    if(isset($_GET['aantal']) && $_GET['id'] == $value['id'] && $_GET['aantal'] != "") {
                                        $aantal = $_GET['aantal'];
                                        $value['aantal'] = $aantal;
                                        $_SESSION['cart'][$i]['aantal'] = $aantal;
                                    } else {
                                        $aantal = $value['aantal'];
                                    }
                                    $category = $row['categorie'];
                                    $totaal = ($totaal + $prijs);
                                    $vkosten = 0;
                                    $i++;
                                    $prijs = ($unit * $aantal); 
                                    $prijs = round($prijs, 3);
                                ?>      

                                <tr>
                                <form action="index.php" method="get">
                                        <td class="col-sm-8 col-md-6">
                                            <div class="media">
                                                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
                                                <div class="media-body">
                                                <h4 class="media-heading"> <a href="../product/index.php?product=<?=$id?>"><?=$naam;?></a></h4>
                                                <h5 class="media-heading"> category: <a href="../overzicht/productpage.php?category=<?=$id?>&pageNumber=0"><?=$category?></a></h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-sm-1 col-md-1" style="text-align: center">
                                            <input type="number" min="1" max="<?=$voorraad?>" class="form-control" name="aantal" value="<?=$aantal?>">
                                            <input type="hidden" name="id" value="<?=$id?>">
                                        </td>
                                        <td class="col-sm-1 col-md-1 text-center"><strong><?php printf('$%.2f', $unit);?></strong></td>
                                        <td class="col-sm-1 col-md-1 text-center"><strong><?php printf('$%.2f', $prijs);?></strong></td>
                                        <td class="col-sm-1 col-md-1">
                                        <td><a href="cart.php?func=del&id=<?php echo $key; ?>">Remove</a></td>
                                </form>
                                </tr>
                            <?php }
                            $btwPrijs = ($prijs * 21) / 121;
                            $btwPrijs = round($btwPrijs, 2);
                            $totaalBtw = $totaalBtw + $btwPrijs;
                            $Subtotal = $Subtotal + ($prijs - $btwPrijs);
                            $totaal = $Subtotal + $totaalBtw;
                            $totaal = round($totaal, 2);
                            }
                            ?>
                                <tr>
                                    <td>   </td>
                                    <td>   </td>
                                    <td>   </td>
                                    <td>   </td>
                                    <td><h5>Subtotal</h5></td>
                                    <td class="text-right"><h5><strong><?php echo "$" . $Subtotal; ?></strong></h5></td>
                                </tr>
                                <tr>
                                    <td>   </td>
                                    <td>   </td>
                                    <td>   </td>
                                    <td>   </td>
                                    <td><h5>Shipping costs</h5></td>
                                    <td class="text-right"><h5><strong><?php echo "$" . $vkosten; ?></strong></h5></td>
                                </tr>
                                <tr>
                                    <td>   </td>
                                    <td>   </td>
                                    <td>   </td>
                                    <td>   </td>
                                    <td><h5>BTW</h5></td>
                                    <td class="text-right"><h5><strong> $<?=$totaalBtw;?></strong></h5></td>
                                </tr>
                                <tr>
                                    <td>   </td>
                                    <td>   </td>
                                    <td>   </td>
                                    <td>   </td>
                                    <td><h3>Total</h3></td>
                                    <td class="text-right"><h3><strong> <?= sprintf('$%.2f', $totaal); ?></strong></h3></td>
                                </tr>
                            <?php
                        }
                        else {
                            ?>
                                <tr>
                                    <td>Your shoppingcart is empty</td>
                                </tr> 
                <?php
                    } ?>
                <tr>
                    <td><a href="cart.php?func=empty" class="btn btn-warning">Empty</a></td>
                    <td></td>
                    <td></td>
                    <td><a class="btn btn-info" href="../registratie/login.php">Payment</a></td>
                    <td><a class="btn btn-success" href="../landing/index.php">Continue shopping</a></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        </div>
        </div>
    </div>
    <?php require '../main/footer.php' ?>
    </body>
</html>