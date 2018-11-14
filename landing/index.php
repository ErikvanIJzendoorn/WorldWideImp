<!DOCTYPE html>
<html>
<head>
	<title>World Wide Importers</title>
	<link rel="stylesheet" href="landing.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<?php require"../main/meta.html"; ?>
	<?php require "../db/connect.php" ?>
	<?php require "../main/header.php"; ?>
</head>
<body>
<!-- <nav class="navbar navbar-expand navbar-dark bg-dark sticky-top">
  <div class="navbar-collapse">
    <ul class="navbar-nav mr-auto">
		<li class="nav-item active">
			<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
		</li>
    </ul>
    <ul class="navbar-nav mr-auto">
    	<li class="nav-item active">
			<a class="navbar-brand" href="#">WorldWideImporters</a>
		</li>
    </ul>

    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav> -->
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
					<a href="../product/index.php" style="color: black; text-decoration: none;">
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