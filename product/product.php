<?php

$productID = filter_input(INPUT_GET, 'product', FILTER_SANITIZE_NUMBER_INT);
$categoryID = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_NUMBER_INT);

$stmt = getProduct($productID, $categoryID);

while($row = $stmt->fetch()) {
	$naam = $row['naam'];
	$categorie = $row['categorie'];
	$herkomst = $row['herkomst'];
	$verpakking = $row['verpakking'];
	$kleur = $row['kleur'];
	$prijs = $row['prijs'];
	$btw = $row['btw'];
	$voorraad = $row['voorraad'];
	$ItemID = $row['itemID'];
	$categorieID = $row['categorieID'];
	$kleurID = $row['kleurID'];
	$verpakkingID = $row['verpakkingID'];
}

$herkomst = str_replace(array('"', "{", "}", "[", "]", "-", ":", ","), "", $herkomst);
$herkomst = explode(" ", $herkomst);