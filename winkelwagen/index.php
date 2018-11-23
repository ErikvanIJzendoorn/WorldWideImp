<!DOCTYPE html>
<html>
    <head>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <title> Cart </title>
        <?php require '../main/meta.html'; ?>
    </head>
    <body>
        <?php //require '../main/header.php' ?>
        <?php //require '../main/nav.php'
        session_start(); 
        $cart = $_SESSION['cart']; ?>
        <link href="../winkelwagen/cart.css" type="text/css" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Aantal</th>
                                <th class="text-center">Prijs</th>
                                <th class="text-center">Totaal individueel product</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php foreach ($cart['items'] as $key => $value) {
                                if ($value['aantal'] <> "") { 
                                    $totalproduct = $value['prijs'] * $value['aantal']; ?>
                                    <tr>
                                        <td class="col-sm-8 col-md-6">
                                            <div class="media">
                                                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
                                                <div class="media-body">
                                                <h4 class="media-heading"><a href="#"><?=$value['naam'];?></a></h4>
                                                <h5 class="media-heading"> category: <a href="#">category</a></h5>
                                        <!--<span>Status: </span><span class="text-success"><strong>voorraad</strong></span>-->
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-sm-1 col-md-1" style="text-align: center">
                                            <input type="email" class="form-control" id="exampleInputEmail1" value="<?=$cart['aantal'];?>">
                                        </td>
                                        <td class="col-sm-1 col-md-1 text-center"><strong><?=$value['prijs'];?></strong></td>
                                        <td class="col-sm-1 col-md-1 text-center"><strong><?=$totalproduct;?></strong></td>
                                        <td class="col-sm-1 col-md-1">
                                        <button type="button" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-remove"></span> Remove
                                        </button></td>
                                    </tr>
                                <?php }
                            } ?>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td><h5>Subtotal</h5></td>
                                <td class="text-right"><h5><strong><?php /* subtotaal */ ?></strong></h5></td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td><h5>Shipping costs</h5></td>
                                <td class="text-right"><h5><strong><?=$cart['vkosten']?></strong></h5></td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td><h3>total</h3></td>
                                <td class="text-right"><h3><strong> <?=$cart['tprijs'];?></strong></h3></td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td>
                                    <button type="button" class="btn btn-default">
                                        <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                                    </button></td>
                                <td>
                                    <button type="button" class="btn btn-success">
                                    Checkout <span class="glyphicon glyphicon-play"></span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php require '../main/footer.php' ?>
    </body>
</html>