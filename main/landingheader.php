<div>
	<div class="image-header">
			<img src="../img/banner.jpg" id="banner-img">
			<div style="height: 100px; width: 100%; text-align: center;">
				<img src="../img/logo.png" id="logo-img-landing">
			</div>
			<h6 id="slogan">
				<i>"Why go world wide when you can go Wide World?"</i>
			</h6>
	</div>
	<?php require '../search/search.php' ?>
	<a href="../winkelwagen/index.php">
    <div class="fas fa-shopping-cart cart-landing">
    </div>
  </a>  

  <?php 
	if(isset($_SESSION['login'])) {
		?>
			<a href="../registratie/login.php?func=logout" class="log-in">
				<div class="fas fa-user cart-landing">
					<h5>Logout</h5>
		    	</div>
			</a>
		<?php
	} else {
		?>
			<a href="../registratie/login.php" class="log-in">
				<div class="fas fa-user cart-landing">
					<h5>Login	</h5>
		    	</div>
			</a>
		<?php
	}

	?>

</div>
