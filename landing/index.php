<!DOCTYPE html>
<html>
<head>
	<title>Wide World Importers</title>
	<link rel="stylesheet" href="landing.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>

		<!--header&navbar-->
	<?php require"../main/meta.php"; ?>
	<!-- meta -->
	<?php require "../main/landingheader.php"; ?>
	<!-- database -->
	<?php require "../db/connect.php" ?>
</head>
<body>
    <div class="container">
    	<div class="row">
			<?php 
				$allCat = [];
				$stmt = getCategory();
				while($row = $stmt->fetch()) {
					$id = $row['id'];
					$naam = $row['naam'];
					$cat = array($id, $naam);
                                        
                                        switch ($id) {
                                            case 1:
                                                $productimg = "../img/products/Novelty3.jpg";
                                                break;
                                            case 2:
                                                $productimg = "../img/products/Hoodie1.jpg";
                                                break;
                                            case 3:
                                                $productimg = "../img/products/Mug1.jpg";
                                                break;
                                            case 4:
                                                $productimg = "../img/products/T-shirt1.jpg";
                                                break;
                                            case 6:
                                                $productimg = "../img/products/Novelty1.jpg";
                                                break;
                                            case 7:
                                                $productimg = "../img/products/Usb2.jpg";
                                                break;
                                            case 8:
                                                $productimg = "../img/products/Slippers2.jpg";
                                                break;
                                            case 9:
                                                $productimg = "../img/products/Toy3.jpg";
                                                break;
                                            case 10:
                                                $productimg = "../img/products/Materials1.jpg";
                                                break;
                                        }
                                
			?>
				<div class="col-md-3 offset-1 cat_item">
					<a href="../overzicht/productpage.php?category=<?php echo $id;?>&pageNumber=0&sort=0&productAmount=30&filter=0&filterValue=10" style="color: black; text-decoration: none;">
						<img src="<?=$productimg;?>" height="150" widt="150" alt="test"><br>
						<div style="text-align: center; max-width: 150px;">
							<span><?php print($cat[1]); ?></span>
						</div>
					</a>
				</div>
			<?php
				}
			?>
		</div>
    </div>
    <?php require "../main/footer.php"; ?>
  </body>
</html>