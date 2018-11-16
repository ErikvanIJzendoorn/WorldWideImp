<!DOCTYPE html>
<html>
<head>
	<title>Winkelwagen</title>
	<!--Metadata-->
	<?php require '../main/meta.html'; ?>
	<link href="../winkelwagen/cart.css" type="text/css" rel="stylesheet">
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
					<th>Prijs (per stuk)</th>
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
				<tr>
					<td>Verzendkosten: <?=$cart['vkosten'];?></td>
					<td>BTW: <?=$cart['btw'];?></td>
					<td>Totaal (exclusief BTW): <?=$cart['tprijs'];?></td>
				</tr>
			</tfoot>
		</table>
		<button id="winkelbtn" type="submit">
			Verder winkelen
		</button>
		<button id="betaalbtn" type="submit">
			Afrekenen
		</button>
	</div>
</body>
</html>