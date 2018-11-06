<!DOCTYPE html>
<html>
<head>
	<title>World Wide Importers</title>
	<link rel="stylesheet" href="landing.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<?php require "../db/connect.php" ?>
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-dark sticky-top">
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
</nav>
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
					<img src="https://via.placeholder.com/150" alt="test"><br>
					<div style="text-align: center; max-width: 150px;">
						<span><?php print($cat[1]); ?></span>
					</div>
				</div>
			<?php
				}
			?>
		</div>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
  </body>
</html>