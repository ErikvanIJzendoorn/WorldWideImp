<!DOCTYPE html>
<html>
<head>
	<title>Winkelwagen</title>
	<!--Metadata-->
	<?php require '../main/meta.html'; ?>
</head>
<body>

	<!--header&navbar-->
	<?php require "../main/header.php"; ?>
	<?php require "../main/nav.php"; ?>
	<!--cart-->
	<?php require "../product/cart.php"; ?>

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
					foreach ($item as $key => $value) {
						print("<tr><td>" . $item['naam'] . "</td><td>" . $item['aantal'] . "</td><td>" . $item['prijs'] . "</td><tr>");
					}	
				?>
			</tbody>
			<tfoot>
				<!--totaalbedrag-->
				<tr>
					<td></td>
					<td></td>
					<td>totaal: <?php ?></td>
				</tr>				
			</tfoot>
		</table>
	</div>
</body>
</html>