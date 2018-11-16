<?php 
session_start();
$item = $_SESSION['item'];
$aantal = $_GET['aantal'];
$item['aantal'] = $_GET['aantal'];
$verzendkosten = 0;
$sub = 0;
$items = [];
array_push($items, $item);
// calculate sub, btw, totaal
foreach ($items as $key => $value) {
	$items[0]['prijs'] = $items[0]['prijs'] / 1.12;
	$items[0]['prijs'] = round($items[0]['prijs'], 2);
	for ($i=0; $i < $items[0]['aantal']; $i++) { 
		

		$sub = $sub + $items[0]['prijs'];
		$sub = round($sub, 2);
	}
}

$btw = ($sub / 121) * 21;
$btw = round($btw, 2);

$tprijs = $sub;

// Create cart array

$cart = array(
	'items' => $items,
	'tprijs' => $tprijs,
	'btw' => $btw,
	'vkosten' => $verzendkosten
);

$_SESSION['cart'] = $cart;

header("Location: ../winkelwagen/index.php");
/*

cart = array
cart heeft items, tprijs, btw, vkosten


tprijs = totaalprijs
btw = btw
vkosten = verzendkosten

items = array
items heeft:

- id
- naam
- aantal
- prijs

*/
?>