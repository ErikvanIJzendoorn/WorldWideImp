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
        <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
        <title> Cart </title>
    </head>
    <body onLoad="window.scroll(0, 250)">
        <?php 
            require 'cart.php';
            require '../main/nav.php';
            require '../main/header.php' ;
            require '../search/search.php'; 
        ?>

        <link href="../winkelwagen/cart.css" type="text/css" rel="stylesheet">
        <div class="container" style="margin-top: 70px;">
            <div class="row name-header">
                <h1>Cart</h1>
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
                        if(isset($_SESSION['cart_item']) && $_SESSION['cart_item'] == "added") {
                            ?>
                                <script type="text/javascript">
                                    window.onload = function() {
                                       swal("Item sucessfully added to your cart!", {
                                          buttons: false,
                                          timer: 1500,
                                        });
                                    }
                                </script>
                            <?php
                            $_SESSION['cart_item'] = null;
                        }

                        if(isset($_SESSION['cart_item']) && $_SESSION['cart_item'] == "remove") {
                            ?>
                                <script type="text/javascript">
                                    window.onload = function() {
                                       swal("Item sucessfully removed from your cart!", {
                                          buttons: false,
                                          timer: 1500,
                                        });
                                    }
                                </script>
                            <?php
                            $_SESSION['cart_item'] = null;
                        }
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
                                $stmt = getProduct($value['id']);
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
                                    $categoryID = $value['category'];
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
                                                <?php switch ($categoryID) {
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
                                                        break; }
                                                        $imgindex = rand(1,3);
                                                        ?>
                                                <a class="thumbnail pull-left" href="../product/index.php?product=<?=$id?>&category=<?=$categoryID?>"> <?php echo("<img class='media-object' src='$productimg$imgindex.jpg' alt='Productimg' style='width: 72px; height: 72px;'>")?></a>
                                                <div class="media-body">
                                                <h4 class="media-heading" style="margin-left: 10px;" > <a href="../product/index.php?product=<?=$id?>&category=<?=$categoryID?>"><?=$naam;?></a></h4>
                                                <h5 style="margin-left: 10px;" class="media-heading"> category: <a href="../overzicht/productpage.php?category=<?=$categoryID?>&pageNumber=0&sort=0&productAmount=30&filter=0&filterValue=0"><?=$category?></a></h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-sm-1 col-md-1" style="text-align: center">
                                            <input type="number" min="1" max="<?=$voorraad?>" class="form-control" id="form" name="aantal" value="<?=$aantal?>" onblur="inputBlurred(event, <?=$aantal?>, <?=$id?>)">
                                            <input type="hidden" name="id" value="<?=$id?>">
                                        </td>
                                        <td class="col-sm-1 col-md-1 text-center"><strong><?php printf('$%.2f', $unit);?></strong></td>
                                        <td class="col-sm-1 col-md-1 text-center"><strong><?php printf('$%.2f', $prijs);?></strong></td>
                                        <td class="col-sm-1 col-md-1">
                                        <td><a class="btn btn-warning" style="background-color: #ec971f !important; border-color: #985f0d !important;" href="cart.php?func=del&id=<?php echo $key; ?>"><i class="fas fa-trash-alt"></i></a></td>
                                </form>
                                </tr>

                                <script language="javascript">
                                    function inputBlurred(event, oldValue, id) {
                                        console.log(event, oldValue, id)
                                        let newValue = event.target.value;
                                        if(!newValue) { newValue = 0; }
                                        console.log(newValue);
                                        url = window.location.href;
                                        let startOfParams = url.indexOf('?');
                                        let route = url.substring(0, startOfParams);
                                        let idParam = 'id=' + id;
                                        let amountParam = 'aantal=' + newValue;
                                        let newParams = '?' + amountParam + '&' + idParam;
                                        let newUrl = route + newParams;
                                        window.location.replace(newUrl);
                                    }

                                </script>
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
                    <?php if($_SESSION['cart'] != null) {
                        ?>
                            <td><button class="btn btn-danger" id="empty" onclick="empty();">Empty</button></td>
                        <?php
                    } else {
                        ?>
                            <td></td>
                        <?php
                    } ?>
                    <td></td>
                    <td></td>
                    <td><a class="btn btn-success" href="../landing/index.php">Continue shopping</a></td>
                    <?php if($_SESSION['cart'] != null) {
                        ?>
                            <td><a class="btn btn-info" href="../registratie/login.php">Payment</a></td>
                        <?php
                    } else {
                        ?>
                            <td></td>
                        <?php
                    } ?>
                    
                    <td></td>
                </tr>
            </tbody>
        </table>
        </div>
        </div>
    </div>
    <?php require '../main/footer.php' ?>
    <script>
        document.getElementById("empty").onclick = function() {empty()};

        function empty() {
            swal("Are you sure you want to do this?", {
                  buttons: {
                    cancel: "Cancel",
                    catch: {
                      text: "Confirm",
                      value: "catch",
                    }
                  },
                })
                .then((value) => {
                  switch (value) {
                 
                    case "catch":
                      window.location.replace("cart.php?func=empty");
                      break;
                 
                    default:
                  }
                });
        };
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>
</html>