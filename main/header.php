<div class="jumbotron wrapper banner-image">
	<a href="../landing/index.php">
		<img src="../img/logo.png" id="logo-img">
	</a>
	<a href="../winkelwagen/index.php">
    <div class="fas fa-shopping-cart cart">
        <h5>Cart</h5>
    </div>
  </a> 
  <?php 
	if(isset($_SESSION['login'])) {
		?>
			<a href="../registratie/login.php?func=logout" class="log-in">
				<div class="fas fa-user cart">
					<h5>Logout</h5>
		    	</div>
			</a>
		<?php
	} else {
		?>
			<a href="../registratie/login.php" class="log-in">
				<div class="fas fa-user cart">
					<h5>Login	</h5>
		    	</div>
			</a>
		<?php
	}

	?>
</div>

