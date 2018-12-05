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
    <body>
        <?php 
            require '../winkelwagen/cart.php';
            require '../main/nav.php';
            require '../main/header.php' ;
            require '../search/search.php'; 
        ?>

        <link href="../winkelwagen/cart.css" type="text/css" rel="stylesheet">
        <div class="container" style="margin-top: 70px;">
            <div class="row">
                <div class="col-sm-12 col-md-10 col-md-offset-1" style="margin-top: 70px;">
                    <table class="table">
                    <thead>
                        <tr>
                            <th>Personal Information</th>
                        </tr>
                    </thead>
                    <?php var_dump($_SESSION); ?>
                        <tr>
                            <th>
                                Name:
                            </th>
                            <td>Erik van IJzendoorn</td>
                        </tr>
                        <tr>
                            <th>
                                Email:
                            </th>
                            <td><?=$_SESSION['email'];?></td>
                        </tr>
                        <tr>
                            <th>
                                Adress:
                            </th>
                            <td>Nijenheim 6317</td>
                        </tr>
                        <tr>
                            <th>
                                Zipcode:
                            </th>
                            <td>3704BL</td>
                        </tr>
                        <tr>
                            <th>
                                City:
                            </th>
                            <td>Zeist</td>
                        </tr>
                    </table>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Products</th>
                                <th>Quantity</th>
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
                                            <img class='media-object' src='<?=$productimg . $imgindex?>.jpg' alt='Productimg' style='width: 72px; height: 72px'>
                                            <div class="media-body">
                                            <h4 class="media-heading"> <?=$naam;?></h4>
                                            <h5 class="media-heading"> category: <?=$category?></h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="col-sm-1 col-md-1" style="text-align: center">
                                        <input type="number" min="1" max="<?=$voorraad?>" class="form-control" name="aantal" value="<?=$aantal?>" disabled>
                                        <input type="hidden" name="id" value="<?=$id?>">
                                    </td>
                                    <td class="col-sm-1 col-md-1 text-center"><strong><?php printf('$%.2f', $prijs);?></strong></td>
                                    <td class="col-sm-1 col-md-1">
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
                                    <th class="text-center">Total</th>
                                    <td class="text-center"><strong><?= sprintf('$%.2f', $totaal); ?></strong></td>
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
                        <td></td>
                        <td><a class="btn btn-warning" href="../landing/index.php">Cancel</a></td>
                        <td><a class="btn btn-success" href="../landing/index.php">Confirm</a></td>
                    </tr>
            </tbody>
        </table>
        </div>
        </div>
    </div>
    <?php require '../main/footer.php' ?>
    </body>
</html>