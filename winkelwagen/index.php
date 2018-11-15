<!DOCTYPE html>
<html>
<head>
	<title>Winkelwagen</title>
	<!--Metadata-->
	<?php require '../main/meta.html'; ?>
</head>
<body>
	<?php 
		session_start(); 
		$cart = $_SESSION['cart'];
	?>
	<!--header&navbar-->
	<?php require "../main/header.php"; ?>
	<?php require "../main/nav.php"; ?>
	<!--cart-->
	<?php //require "../product/cart.php"; ?>

	<div class="content">
		<div class="name">
			Winkelwagen
		</div>
		<table>
			<thead>
				<tr>
					<th>Productnaam</th>
					<th>Aantal</th>
					<th>Prijs</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($cart['items'] as $key => $value) {
						print("<tr><td>" . $value['naam'] . "</td><td>" . $value['aantal'] . "</td><td>" . $value['prijs'] . "</td><tr>");
					}	
				?>
			</tbody>
			<tfoot>
				<!--totaalbedrag-->
				<tr>
					<td>verzendkosten: <?=$cart['vkosten'];?></td>
				</tr>		
				<tr>
					<td>btw: <?=$cart['btw'];?></td>
				</tr>		
				<tr>
					<td>totaal: <?=$cart['tprijs'];?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>