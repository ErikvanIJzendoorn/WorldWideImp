<!DOCTYPE html>
<html>
<head>
	<title>World Wide Importers</title>
	<link rel="stylesheet" href="landing.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

		<!--header&navbar-->
	<?php require "../main/header.php"; ?>
	<!-- meta -->
	<?php require"../main/meta.html"; ?>
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
                                
			?>
				<div class="col-md-3 offset-1 cat_item">
					<a href="../overzicht/productpage.php?category=<?php echo $id;?>&pageNumber=0&sort=0" style="color: black; text-decoration: none;">
						<img src="https://via.placeholder.com/150" alt="test"><br>
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